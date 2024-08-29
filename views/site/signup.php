<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Sign Up';
?>
<div class="site-signup">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="signup-container"
        style="display: flex; justify-content: center; align-items: center; padding: 2rem; background: url('banner2.jpg') no-repeat center center; background-size: cover; border-radius: 25px;">

        <div
            style="width: 35%; padding: 2rem; box-shadow: 0px 4px 20px #77DD77; border-radius: 16px; background-color: #fff;">
            <?php $form = ActiveForm::begin([
                'id' => 'signup-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "<div class=\"form-group\">{label}\n{input}\n{error}</div>",
                    'labelOptions' => ['class' => 'control-label'],
                ],
            ]); ?>

            <div class="form-title" style="text-align: center; margin-bottom: 2rem;">
                <h2 class="text-center" style="color: #77DD77; font-weight: bold; font-size: 2rem;">Sign Up</h2>
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

            <?= $form->field($model, 'mobile_number')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your mobile number',
                'style' => 'border-radius: 16px; box-shadow: 0px 0px 0px #77DD77;'
            ])->label('Mobile Number')->error(['class' => 'text-danger']) ?>

            <div class="d-flex align-items-center justify-content-around mt-5">
                <div class="form-group" style="text-align: center;">
                    <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary', 'style' => 'background-color: #34B335; font-weight: bold; font-size: 1.1rem;']) ?>
                </div>

                <div class="form-group" style="text-align: center;">
                    <?= Html::a('Sign In', ['site/signin'], ['class' => 'btn btn-primary', 'style' => 'background-color: #34B335; font-weight: bold; font-size: 1.1rem;']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>