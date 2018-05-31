<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

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

    <?= $this->render('_table-view', compact('sections')); ?>

    <?= Html::a('Go to Section Archives', ['/sections/archives'], ['class'=>'btn btn-default btn-xs']);?>
</div>
