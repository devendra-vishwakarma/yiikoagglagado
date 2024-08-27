<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\User;
use yii\web\Response;

class AuthController extends Controller
{
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
    public function actionSignup()
    {
        return $this->render('signup');
    }
    public function actionSignup()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $request = Yii::$app->request->post();
        $user = new User();
        
        $user->email = $request['email'];
        $user->password = Yii::$app->security->generatePasswordHash($request['password']);
        $user->mobile_number = $request['mobile_number'];
        
        if ($user->validate() && $user->save()) {
            return [
                'status' => 'success',
                'message' => 'User registered successfully.',
                'redirectUrl' => '/signin'
            ];
        } else {
            return $this->render('signup');
        }
    }

    public function actionSignin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $request = Yii::$app->request->post();
        $user = User::findOne(['email' => $request['email']]);
        
        if ($user && Yii::$app->security->validatePassword($request['password'], $user->password)) {
            return [
                'status' => 'success',
                'message' => 'Signin successful.'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Invalid email or password.'
            ];
        }
    }
}
