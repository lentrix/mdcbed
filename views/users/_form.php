<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList(
        ['200'=>'Head', '210'=>'Staff', '220'=>'Teacher'],
        ['prompt'=>'Select role']
    ) ?>
    
    <?php if(Yii::$app->user->identity->role === User::ROLE_ADMIN): ?>
    <?= $form->field($model, 'active')->radioList(
        ['1'=>'Active', '0'=>'Inactive']
    ) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-hdd"></i> Save', ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
