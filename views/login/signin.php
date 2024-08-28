<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



$this->title = 'Sign In';
?>
<div class="site-signin"
    style="background-image: url('./banner2.jpg') no-repeat center center; background-size: cover; padding: 2rem;">

    <div style="text-align: center; margin-top: 7.5rem;">
        <h1 style="color: yellow; font-weight: bold; font-size: 5rem; text-shadow: 2px 2px 4px yellow;">Crypto Hunter
        </h1>
        <p style="position: relative; padding-bottom: 50px;">To change the Trading Plan</p>
    </div>

    <div class="signin-container"
        style="width: 30%; padding: 2rem; box-shadow: 0px 4px 20px #77DD77; border-radius: 16px; background-color: #fff; margin: 5rem auto;">
        <?php $form = ActiveForm::begin([
            'id' => 'signin-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "<div class=\"form-group\">{label}\n{input}\n{error}</div>",
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>

        <div class="form-title" style="text-align: center; margin-bottom: 2rem;">
            <h2 style="color: #77DD77; font-weight: bold; font-size: 2rem;">Sign In</h2>
        </div>

        <?= $form->field($model, 'email')->textInput([
            'maxlength' => true,
            'placeholder' => 'Enter your email',
            'style' => 'border-radius: 16px; box-shadow: 0px 0px 0px #77DD77;'
        ])->label('Email')->error(['class' => 'text-danger']) ?>

        <?= $form->field($model, 'password')->passwordInput([
            'maxlength' => true,
            'placeholder' => 'Enter your password',
            'style' => 'border-radius: 16px; box-shadow: 0px 0px 0px #77DD77;'
        ])->label('Password')->error(['class' => 'text-danger']) ?>

        <div class="d-flex align-items-center justify-content-around mt-5">
            <div class="form-group" style="text-align: center;">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary', 'style' => 'background-color: #34B335; font-weight: bold; font-size: 1.1rem;']) ?>
            </div>

            <div class="form-group" style="text-align: center;">
                <?= Html::a('Sign Up', ['login/signup'], ['class' => 'btn btn-primary', 'style' => 'background-color: #34B335; font-weight: bold; font-size: 1.1rem;']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>