<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ModalConfirmation;

/* @var $this yii\web\View */
/* @var $model app\models\Venue */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$activateDeactivate = $model->active?"Deactivate":"Activate";

ModalConfirmation::confirm(
    'modal-confirm',
    "You are about to $activateDeactivate this venue <br>Do you want to coninue?",
    "<h3>$activateDeactivate Venue</h3>",
    ['/venues/toggle-active', 'id'=>$model->id]
);
?>
<div class="venue-view">

    <p class="pull-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::button($activateDeactivate, ['class'=>'btn btn-' . ($model->active?'danger':'success'), 
            'data-toggle'=>'modal', 'data-target'=>'#modal-confirm']); ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'capacity',
        ],
    ]) ?>

</div>
