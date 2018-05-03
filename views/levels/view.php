<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ModalConfirmation;

/* @var $this yii\web\View */
/* @var $model app\models\Level */

$this->title = 'View Level: ' . $model->shortName;
$this->params['breadcrumbs'][] = ['label' => 'Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->shortName;
?>

<?php ModalConfirmation::confirm('modal-delete', 
    '<p>Are you sure you want to delete this Level?</p>',
    '<h4>Delete School Year</h4>',
    ['/levels/delete', 'id'=>$model->id]) ?>

<p class="pull-right">
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</p>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-5">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'longName',
                'shortName',
                'category',
                'nextLevelId',
                'previousLevelId',
            ],
        ]) ?>
    </div>
    <div class="col-md-7">
        <h2 style="margin-top: -34px; border-bottom: 1px solid #ccc"><?= $model->shortName ?> Students</h2>
    </div>
</div>
