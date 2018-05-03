<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Department;

/* @var $this yii\web\View */
/* @var $model app\models\Program */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shortName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departmentId')->dropDownList(
        ArrayHelper::map(Department::find()->orderBy('shortName')->all(), 'id', 'shortName'),
        ['prompt'=>'Select department']
    ) ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
