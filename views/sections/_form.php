<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Section */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="section-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'levelId')->dropDownList(
        ArrayHelper::map(\app\models\Level::find()->all(), 'id', 'longName'),
        ['prompt'=>'Select level']
    ) ?>

    <?= $form->field($model, 'departmentId')->dropDownList(
        ArrayHelper::map(\app\models\Department::find()->all(), 'id', 'longName'),
        ['prompt'=>'Select department']
    ) ?>

    <?= $form->field($model, 'teacherId')->dropDownList(
        ArrayHelper::map(\app\models\Teacher::find()->orderBy('firstName, lastName')->all(),'id','fullName'),
        ['prompt'=>'Select adviser']
    ) ?>

    <?= $form->field($model, 'periodId')->dropDownList(
        ArrayHelper::map(\app\models\Period::getActive(), 'id', 'longName'),
        ['prompt'=> 'Select period']
    ) ?>

    <?= $form->field($model, 'homeRoom')->dropDownList(
        ArrayHelper::map(\app\models\Venue::find()->orderBy('name')->all(), 'id', 'name'),
        ['prompt'=>'Select home room']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
