<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Levels';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if(Yii::$app->user->identity->role==\app\models\User::ROLE_ADMIN): ?>
<p>
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Create Level', ['create'], ['class' => 'btn btn-success pull-right']) ?>
</p>
<?php endif; ?>
<div class="level-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'longName',
            'shortName',
            'category',
            'nextLevelId',
            'previousLevelId',
        ],
        'rowOptions' => function($model, $key, $index, $grid) {
            return [
                'style' => 'cursor: pointer',
                'value' => Url::toRoute(['/levels/view','id'=>$model->id]),
                'class' => 'clickable',
            ];
        },
        'tableOptions' => [
            'class'=>'table table-bordered table-hover'
        ],
    ]); ?>
</div>
