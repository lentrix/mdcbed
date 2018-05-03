<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Create Classes';
$this->params['breadcrumbs'][] = ['label'=>'Sections', 'url'=> ['/sections/index']];
$this->params['breadcrumbs'][] = ['label' => $model->section->name, 'url' => ['/sections/view', 'id'=>$model->sectionId,'tab'=>'schedule']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
	<div class="col-md-6 col-md-offset-1">
		<h1><?= Html::encode($this->title) ?></h1>

		<?= $this->render('_form', [
		  'model' => $model,
		]) ?>
	</div>
</div>
