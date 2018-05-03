<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeriodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Periods';
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->identity;

?>

<?php if($user->role === User::ROLE_HEAD || $user->role ===User::ROLE_ADMIN): ?>
    <p class="pull-right">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Create Period', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php endif; ?>
<div class="period-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        
            'shortName',
            'longName',
            'start',
            'end',
            'typeStr',
            'active'
        ],
        'rowOptions' => function($model, $key, $index, $grid) {
            return [
                'style' => 'cursor: pointer',
                'value' => Url::toRoute(['/periods/view','id'=>$model->id]),
                'class' => 'clickable',
            ];
        },
        'tableOptions' => [
            'class'=>'table table-bordered table-hover'
        ],
    ]); ?>
</div>
