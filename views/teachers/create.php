<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = 'Create Teacher';
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
	<div class="col-md-6">
		<?= $this->render('_form', [
		  'model' => $model,
		  'users' => $users,
		  'departments' => $departments
		]) ?>	
	</div>
	<div class="col-md-6">
		
	</div>
</div>
