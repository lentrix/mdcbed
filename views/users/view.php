<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->identity;

Modal::begin([
    'header' => '<h3>Update Avatar</h3>',
    'id'=>'modal-avatar',
    'size' => Modal::SIZE_LARGE
]);

echo $this->render('/_cropper', ['action'=>'/users/upload','id'=>$model->id]);

Modal::end();
?>

<h1><?= Html::encode($this->title) ?></h1>
<hr>
<div class="row">
    <div class="col-md-3">
        <?= Html::img('@web/uploads/avatars/users/' . $model->id . '.png',[
            'width'=>'100%'
        ]); ?>
    </div>
    <div class="col-md-9">
        <p class="pull-right">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::button('Update Avatar',[
                'class'=>'btn btn-default',
                'data-toggle' => 'modal',
                'data-target' => '#modal-avatar'
            ]) ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'fullName',
                'roleString',
                'active',
            ],
        ]) ?>
    </div>
</div>
