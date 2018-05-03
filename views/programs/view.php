<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ModalConfirmation;

/* @var $this yii\web\View */
/* @var $model app\models\Program */

$this->title = $model->shortName;
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$activateDeactivate = $model->active?"Deactivate":"Activate";

ModalConfirmation::confirm(
    'modal-confirm',
    "You are about to $activateDeactivate this program <br>Do you want to coninue?",
    "<h3>$activateDeactivate Program</h3>",
    ['/programs/toggle-active', 'id'=>$model->id]
);

?>
<div class="program-view">
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
            'shortName',
            'longName',
            'departmentId',
            'remarks',
        ],
    ]) ?>

</div>
