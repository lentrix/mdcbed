<?php
use yii\helpers\Html;
use app\models\User;
?>
<?php $user = Yii::$app->user->identity; ?>
<div class="sidebar-nav">

	<?= $this->render('/sidebars/_header') ?>
	<?php if($user->role==User::ROLE_ADMIN): ?>
		<?= Html::a('<i class="glyphicon glyphicon-user"></i> User Management', ['/users/index']) ?>
		<?= Html::a('<i class="glyphicon glyphicon-time"></i> Periods', ['/periods/index']) ?>
		<?= Html::a('<i class="glyphicon glyphicon-certificate"></i> Departments', ['/departments/index']) ?>
		<?= Html::a('<i class="glyphicon glyphicon-education"></i> Programs', ['/programs/index']) ?>
	<?php endif; ?>

	<?php if($user->role<=User::ROLE_STAFF): ?>
		<?= Html::a('<i class="glyphicon glyphicon-th"></i> Venues', ['/venues/index']) ?>
		<?= Html::a('<i class="glyphicon glyphicon-education"></i> Levels', ['/levels/index']) ?>
		<?= Html::a('<i class="glyphicon glyphicon-sunglasses"></i> Teachers', ['/teachers/index']) ?>
		<?= Html::a('<i class="glyphicon glyphicon-th-large"></i> Sections', ['/sections/index']) ?>
		<?= Html::a('<i class="glyphicon glyphicon-education"></i> Students', ['/students/index']) ?>
		<?= Html::a('<i class="glyphicon glyphicon-blackboard"></i> Classes', ['/classes/index']) ?>
	<?php endif; ?>

	<?php if($user->role <= User::ROLE_TEACHER): ?>
		<?= Html::a('<i class="glyphicon glyphicon-education"></i> My Advisory', ['/teachers/advisory']) ?>
		<?= Html::a('<i class="glyphicon glyphicon-blackboard"></i> My Classes', ['/teachers/classes']) ?>
		
	<?php endif; ?>
</div>