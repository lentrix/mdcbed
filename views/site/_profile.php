<?php use yii\helpers\Url; ?>
<?php use yii\helpers\Html; ?>

<?php $identity = Yii::$app->user->identity; ?>
<div class="well profile row">
    <div class="picture">
      <?= Html::img('../uploads/avatars/' . Yii::$app->user->id . '.png'); ?>
    </div>
    <div class="details">
      <strong class="username"><?= $identity->username ?></strong><br>
      <span class="full-name"><?= $identity->fullName ?></span><br>
      <span class="role"><?= $identity->roleString ?></span>
    </div>
</div>
