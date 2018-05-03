<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VenueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Venues';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Create Venue', ['create'], ['class' => 'btn btn-success pull-right']) ?>
</p>
<div class="venue-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'capacity',
            ['label'=>'Active','attribute'=>'activeStr'],
        ],
        'rowOptions' => function($model, $key, $index, $grid) {
            return [
                'style' => 'cursor: pointer',
                'value' => Url::toRoute(['/venues/view','id'=>$model->id]),
                'class' => 'clickable',
            ];
        },
        'tableOptions' => [
            'class'=>'table table-bordered table-hover'
        ],
    ]); ?>
</div>
