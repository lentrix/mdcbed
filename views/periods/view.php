<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\components\ModalConfirmation;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Period */

$this->title = $model->shortName;
$this->params['breadcrumbs'][] = ['label' => 'Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->identity;

ModalConfirmation::confirm(
    'modal-confirm',
    'This action will deactivate the currently active <strong>' . $model->typeStr . 
    '</strong> period.<br>Do you want to coninue?',
    '<h3>Activate Period</h3>',
    ['/periods/activate', 'id'=>$model->id]
);

?>

<?php 
Modal::begin([
    'id' => 'modal-change-phase',
    'header' => '<h3>Change Period Phase</h3>',
]);?>

<div class="list-group">
    <?= Html::a('Enrolment Phase',['/periods/change-phase', 'id'=>$model->id,'phase'=>'0'],['class'=>'list-group-item']) ?>
    <?= Html::a('First Quarter',['/periods/change-phase', 'id'=>$model->id,'phase'=>'1'],['class'=>'list-group-item']) ?>
    <?= Html::a('Second Quarter',['/periods/change-phase', 'id'=>$model->id,'phase'=>'2'],['class'=>'list-group-item']) ?>
    <?= Html::a('Third Quarter',['/periods/change-phase', 'id'=>$model->id,'phase'=>'3'],['class'=>'list-group-item']) ?>
    <?= Html::a('Fourth Quarter',['/periods/change-phase', 'id'=>$model->id,'phase'=>'4'],['class'=>'list-group-item']) ?>
    <?= Html::a('End of Period',['/periods/change-phase', 'id'=>$model->id,'phase'=>'5'],['class'=>'list-group-item']) ?>
</div>

<?php Modal::end(); ?>


<?php if($user->role === User::ROLE_ADMIN || $user->role===User::ROLE_HEAD): ?>
    <p class="pull-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <button class="btn btn-info" data-toggle="modal" data-target="#modal-change-phase">Change Phase</button>
        <?php if(!$model->active): ?>
            <?= Html::button('Activate', ['class'=>'btn btn-success', 
                'data-toggle'=>'modal', 'data-target'=>'#modal-confirm']); ?>
        <?php endif; ?>
    </p>
<?php endif; ?>

<div class="period-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'shortName',
            'longName',
            'start',
            'end',
            'typeStr',
            'phaseStr',
            'active',
        ],
    ]) ?>

</div>
