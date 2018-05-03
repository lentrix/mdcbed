<?php
use yii\helpers\Html;

$identity = Yii::$app->user->identity;
?>
<div class="profile">
	<span class="pull-right">
		<?= Html::a('<i class="glyphicon glyphicon-cog"></i>',
			['/users/view', 'id'=>$identity->id],
			['id'=>'profile-button', 'title'=>'User Profile Settings']) ?>
	</span>
	 <div class="picture">
	   <?= Html::img('@web/uploads/avatars/users/' . $identity->id . '.png'); ?>
	 </div>
	 <div class="details">
	   <strong class="username"><?= $identity->username ?></strong><br>
	   <span class="full-name"><?= $identity->fullName ?></span><br>
	   <span class="role"><?= $identity->roleString ?></span>
	 </div>   
</div>
