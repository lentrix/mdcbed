<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Update Class: ' . $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['/sections/index']];
$this->params['breadcrumbs'][] = ['label' => $model->section->name, 'url' => ['/sections/view', 'id'=>$model->sectionId]];
$this->params['breadcrumbs'][] = ['label' => $model->subject, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-md-6 col-md-offset-1">
	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>		
    

    

