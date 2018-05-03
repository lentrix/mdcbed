<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
	<div class="col-md-6">
		<?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
	<div class="col-md-6">
		
	</div>
</div>
