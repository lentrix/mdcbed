<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'lrn') ?>

    <?= $form->field($model, 'lastName') ?>

    <?= $form->field($model, 'firstName') ?>

    <?= $form->field($model, 'middleName') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'birthDate') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'fName') ?>

    <?php // echo $form->field($model, 'fOccup') ?>

    <?php // echo $form->field($model, 'fContact') ?>

    <?php // echo $form->field($model, 'mName') ?>

    <?php // echo $form->field($model, 'mOccup') ?>

    <?php // echo $form->field($model, 'mContact') ?>

    <?php // echo $form->field($model, 'barangay') ?>

    <?php // echo $form->field($model, 'town') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'prevSchool') ?>

    <?php // echo $form->field($model, 'prvSchlAddr') ?>

    <?php // echo $form->field($model, 'honors') ?>

    <?php // echo $form->field($model, 'foodAllergies') ?>

    <?php // echo $form->field($model, 'rc') ?>

    <?php // echo $form->field($model, 'gmc') ?>

    <?php // echo $form->field($model, 'bc') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'entryDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
