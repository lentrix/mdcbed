<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form row">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'lrn')->textInput() ?>

        <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'middleName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'gender')->dropDownList([
            'F'=>'Female', 'M'=>'Male'
        ], ['prompt'=>'Select gender']) ?>

        <div class="form-group">
            <label for="start" class="form-label">Birth Date</label>
            <?= DatePicker::widget([
                'model' => $model,
                'id'=>'birthDate',
                'attribute' => 'birthDate',
                'value' => date('yyyy-mm-dd'),
                'options' => ['placeholder' => 'Select birth date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => false,
                    'autoClose'=>true
                ]
            ]); ?>
        </div>

        <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'fName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'fOccup')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'fContact')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'mName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'mOccup')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'mContact')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">

        <?= $form->field($model, 'barangay')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'prevSchool')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'prvSchlAddr')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'honors')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'foodAllergies')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <label>Documents Presented:</label>

            <?= $form->field($model, 'rc')->checkBox() ?>

            <?= $form->field($model, 'gmc')->checkBox() ?>

            <?= $form->field($model, 'bc')->checkBox() ?>

            <?= $form->field($model, 'pic')->checkBox() ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
        </div>
        
    </div>    

    <?php ActiveForm::end(); ?>

</div>
