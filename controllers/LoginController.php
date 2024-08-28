<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class LoginController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'corsFilter' => [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['http://localhost:5173'],
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
        $model = new User();

        // Check if the form is submitted and the data is valid
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Hash the password before saving
            $model->password = Yii::$app->security->generatePasswordHash($model->password);

            if ($model->save()) {
                // Redirect to a view page or any other page after successful signup
                return $this->redirect("signin");
            } else {
                Yii::$app->session->setFlash('error', 'There was a problem saving your information.');
            }
        }

        // Render the sign-up view and pass the model
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionSignin()
    {
        $model = new User();

        // Render the sign-in view and pass the model
        return $this->render('signin', [
            'model' => $model,
        ]);
    }
}
