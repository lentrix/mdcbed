<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Level */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="level-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->radioList(
        ['presc'=>'Preschool', 'elem'=>'Elementary', 'jhs'=>'Junior High School', 'shs'=>'Senior High School'],
        ['prompt'=>'Select a category']
    ) ?>

    <?= $form->field($model, 'longName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shortName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nextLevelId')->textInput() ?>

    <?= $form->field($model, 'previousLevelId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
