<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="student-index">
    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Create Student', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'lrn',
            'lastName',
            'firstName',
            'middleName',
            //'gender',
            //'birthDate',
            //'nationality',
            //'religion',
            //'fName',
            //'fOccup',
            //'fContact',
            //'mName',
            //'mOccup',
            //'mContact',
            'barangay',
            'town',
            'province',
            //'prevSchool',
            //'prvSchlAddr',
            //'honors',
            //'foodAllergies',
            //'rc',
            //'gmc',
            //'bc',
            //'pic',
            //'entryDate',

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'rowOptions' => function($model, $key, $index, $grid) {
            return [
                'style' => 'cursor: pointer',
                'value' => Url::toRoute(['/students/view','id'=>$model->id]),
                'class' => 'clickable',
            ];
        },
        'tableOptions' => [
            'class'=>'table table-bordered table-hover'
        ],
    ]); ?>
</div>
