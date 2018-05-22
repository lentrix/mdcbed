<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\models\User;
use app\components\ModalConfirmation;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$user = Yii::$app->user;

$this->title = "Teacher: " . $model->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->fullName;

Modal::begin([
    'id'=>'modal-avatar',
    'header'=>'<h3>Change Avatar</h3>',
    'size' => Modal::SIZE_LARGE,
    'footer'=>'Please crop the picture into a square.'
]);

echo $this->render('/_cropper',['action'=>Url::toRoute(['/teachers/upload']),'id'=>$model->id]);

Modal::end();

$activateDeactivate = $model->active?"Deactivate":"Activate";

ModalConfirmation::confirm(
    'modal-confirm',
    "You are about to $activateDeactivate this teacher <br>Do you want to coninue?",
    "<h3>$activateDeactivate Teacher</h3>",
    ['/teachers/toggle-active', 'id'=>$model->id]
);
?>

<h1><?= Html::encode($this->title) ?></h1>
<hr>
<div class="row">
    <div class="col-md-3">
        <?= Html::img('@web/uploads/avatars/teachers/' . $model->id . '.png', 
            ['width'=>'100%','id'=>'avatar']) ?>
    </div>
    <div class="col-md-9">
        <p>
            
            <?php if($user->identity->role==User::ROLE_ADMIN): ?>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::button($activateDeactivate, ['class'=>'btn btn-' . ($model->active?'danger':'success') . ' pull-right', 
            'data-toggle'=>'modal', 'data-target'=>'#modal-confirm']); ?>
            <?php elseif($user->id==$model->id): ?>
                <?= Html::a('Update', ['update-own'], ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>

            <?php if($user->id === $model->userId 
                || $user->identity->role===User::ROLE_ADMIN
                || $user->identity->role===User::ROLE_HEAD): ?>

                <button class="btn btn-default" data-toggle="modal" 
                        data-target="#modal-avatar">Change Avatar</button>

            <?php endif; ?>

        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'lastName',
                'firstName',
                'phone',
                ['label'=>'Department', 'attribute'=>'department.longName'],
                'specialization',
                'user.username',
            ],
        ]) ?>
    </div>
</div>
<hr>
<div>
    <h2>Class Schedule</h2>
    <table class="table table-striped table-condensed table-hover">
        <tr>
            <th>Time</th>
            <th>Subject</th>
            <th>Venue</th>
        </tr>

        <?php foreach($model->currentClasses as $class): ?>
        <tr class="clickable" value="<?= Url::toRoute(['/classes/view', 'id'=>$class->id]) ?>">
            <td><?= $class->start ?> - <?= $class->end ?> <?= $class->day ?></td>
            <td><?= $class->subject ?></td>
            <td><?= $class->venue->name ?></td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>
