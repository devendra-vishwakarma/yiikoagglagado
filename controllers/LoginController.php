<?php
namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\User;
use yii\web\Response;

class LoginController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    'Origin' => ['http://localhost:3000'], // changeb acoording to react port
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                    'Access-Control-Allow-Headers' => ['Authorization', 'Content-Type', 'X-Requested-With'],
                    'Access-Control-Allow-Origin' => true,
                ],
            ],
        ]);
    }

    public function actionSignup()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new User();

        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            $model->setPassword($model->password);
            if ($model->save()) {
                return [
                    'status' => 'success',
                    'message' => 'Signup successful',
                    'data' => $model,
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Signup failed',
                    'errors' => $model->errors,
                ];
            }
        }

        return $this->render('signup');
        
    }

    public function actionSignin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new User();

        $request = Yii::$app->request->post();
        $user = User::findOne(['email' => $request['email']]);

        if ($user && $user->validatePassword($request['password'])) {
            return [
                'status' => 'success',
                'message' => 'Signin successful',
                'data' => $user,
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Invalid email or password',
        ];
    }
}
