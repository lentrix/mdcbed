<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = 'Update Teacher: ' . $model->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<h1><?= Html::encode($this->title) ?></h1>
<hr>
<div class="row">
	<div class="col-md-6">
		<?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'departments' => $departments,
    ]) ?>
	</div>
   <div class="col-md-6">
   	<!-- Avatar upload form -->
   </div>

</div>
