<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\EnrolForm;
use yii\helpers\ArrayHelper;
use app\models\Section;
use yii\helpers\Url;

$model = new EnrolForm;
$model->studentId = $student->id;
?>

<?php $form = ActiveForm::begin(['method'=>'post','action'=>Url::toRoute(['/enrol/enrol'])]); ?>

<?= $form->field($model, 'sectionId')->dropDownList(
    ArrayHelper::map(Section::getActive(), 'id', 'name'),
    ['prompt'=>'Select section']
); ?>

<?= $form->field($model, 'studentId')->hiddenInput()->label(false); ?>

<div class="form-group">
    <?= Html::submitButton('<i class="glyphicon glyphicon-star"></i>Enrol Student', ['class'=>'btn btn-primary']); ?>
</div>

<?php ActiveForm::end(); ?>