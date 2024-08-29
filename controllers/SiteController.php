<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use app\models\User;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;
use app\models\ProductSearch;
use app\models\Coin;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Allow-Origin' => ['*'],
                    'Access-Control-Allow-Methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                    'Access-Control-Allow-Headers' => ['X-Requested-With', 'Content-Type', 'Authorization'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signup action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        $model = new User();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate()) {
                $model->setPassword($model->password);
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Signup successful');
                    return $this->redirect(['signin']); // Redirect to signin page after successful signup
                } else {
                    Yii::$app->session->setFlash('error', 'Signup failed');
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Signin action.
     *
     * @return Response|string
     */
    public function actionSignin()
    {
        // Handle JSON requests
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $email = Yii::$app->request->post('email');
            $password = Yii::$app->request->post('password');

            if (!$email || !$password) {
                return [
                    'status' => 'error',
                    'message' => 'Email and password are required',
                ];
            }

            $user = User::findOne(['email' => $email]);

            if ($user && $user->validatePassword($password)) {
                return [
                    'status' => 'success',
                    'message' => 'Signin successful',
                    'data' => $user,
                    'redirectUrl' => '/coin/page', // URL to redirect to
                ];
            }

            return [
                'status' => 'error',
                'message' => 'Invalid email or password',
            ];
        }

        $model = new User();
        return $this->render('signin', [
            'model' => $model,
        ]);
    }

    /**
     * Displays Coin page.
     *
     * @return string
     */
    public function actionPage()
    {
        $coins = Coin::getDummyData();
        return $this->render('page', [
            'coins' => $coins,
        ]);
    }

    /**
     * Displays Coin service page.
     *
     * @return string
     */
    public function actionService()
    {
        $coins = Coin::getDummyData();
        return $this->render('service', [
            "coins" => $coins,
        ]);
    }

    /**
     * Adds a coin to the cart.
     *
     * @param int $id
     * @return Response
     */
    public function actionAddToCart($id)
    {
        Coin::addToCart($id);
        return $this->redirect(['viewcart']);
    }

    /**
     * Displays the cart.
     *
     * @return string
     */
    public function actionViewcart()
    {
        $cartItems = Coin::getCartItems();
        return $this->render('viewcart', [
            'cartItems' => $cartItems,
        ]);
    }

    /**
     * Displays the list of products.
     *
     * @return string
     */
    public function actionIndexProduct()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single product.
     *
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewProduct($id)
    {
        return $this->render('view', [
            'model' => $this->findProductModel($id),
        ]);
    }

    /**
     * Creates a new product.
     *
     * @return string|Response
     */
    public function actionCreateProduct()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-product', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing product.
     *
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateProduct($id)
    {
        $model = $this->findProductModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-product', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing product.
     *
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteProduct($id)
    {
        $this->findProductModel($id)->delete();
        return $this->redirect(['index-product']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProductModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
