<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'specialization')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departmentId')->dropDownList(
        ArrayHelper::map($departments, 'id', 'longName'),
        ['prompt'=>'Select department']
    ); ?>

    <?= $form->field($model, 'userId')->dropDownList(
        ArrayHelper::map($users, 'id', 'username'),
        ['prompt'=>'Assign User']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-hdd"></i> Save', ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
