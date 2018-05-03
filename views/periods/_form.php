<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Period */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="period-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shortName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longName')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label for="start" class="form-label">Start Date</label>
        <?= DatePicker::widget([
            'model' => $model,
            'id'=>'start',
            'attribute' => 'start',
            'value' => date('yyyy-mm-dd'),
            'options' => ['placeholder' => 'Select start date ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoClose'=>true
            ]
        ]); ?>
    </div>

    <div class="form-group">
        <label for="start" class="form-label">End Date</label>
        <?= DatePicker::widget([
            'model' => $model,
            'id'=>'end',
            'attribute' => 'end',
            'value' => date('yyyy-mm-dd'),
            'options' => ['placeholder' => 'Select start date ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoClose'=>true
            ]
        ]); ?>
    </div>

    <?= $form->field($model, 'type')->dropDownList(
        ['0'=>'Annual', '1'=>'Semestral'],['prompt'=>'Select type']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save Period', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
