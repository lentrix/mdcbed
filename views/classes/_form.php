<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
use app\models\Venue;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */
/* @var $form yii\widgets\ActiveForm */

$venues = Venue::find()->orderBy('name')->all();
$teachers = Teacher::find()->orderBy('lastName, firstName')->all();
?>

<div class="classes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= '<label>Start Time</label>'; ?>
        <?= TimePicker::widget([
            'model' => $model,
            'attribute' => 'start',
            'pluginOptions' => [
                'showSeconds' => false,
                'showMeridian' => false,
                'defaultTime' => false
            ]
        ]); ?>
    </div>

    <div class="form-group">
        <?= '<label>End Time</label>'; ?>
        <?= TimePicker::widget([
            'model' => $model,
            'attribute' => 'end',
            'pluginOptions' => [
                'showSeconds' => false,
                'showMeridian' => false,
                'defaultTime' => false
            ]
        ]); ?>
    </div>

    <?= $form->field($model, 'day')->textInput(['maxlength' => true, 'placeholder'=>'MTWHFSN (Mon-Sun)']) ?>

    <?= $form->field($model, 'sectionId')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'venueId')->dropDownList(
        ArrayHelper::map($venues, 'id', 'name'),
        ['prompt'=>'Select Venue']
    ) ?>

    <?= $form->field($model, 'teacherId')->dropDownList(
        ArrayHelper::map($teachers, 'id','fullName'),
        ['prompt'=>'Select teacher']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
