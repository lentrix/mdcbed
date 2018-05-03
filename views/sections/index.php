<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sections';
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->identity;

?>
<?php if($user->role === User::ROLE_ADMIN || $user->role === User::ROLE_HEAD) : ?>
    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Create Section', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>
<?php endif; ?>

<div class="section-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            ['label'=>'Level', 'attribute'=>'level.longName'],
            ['label'=>'Adviser', 'attribute'=>'teacher.fullName'],
            ['label'=>"Period", 'attribute'=>'period.shortName'],
            //'semesterId',
            //'homeRoom',
        ],
        'rowOptions' => function($model, $key, $index, $grid) {
            return [
                'style' => 'cursor: pointer',
                'value' => Url::toRoute(['/sections/view','id'=>$model->id]),
                'class' => 'clickable',
            ];
        },
        'tableOptions' => [
            'class'=>'table table-bordered table-hover'
        ],
    ]); ?>
</div>
