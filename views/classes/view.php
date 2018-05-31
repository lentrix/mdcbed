<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

use app\models\User;
use app\components\TimeCheck;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-view">
    <?php if(Yii::$app->user->identity->role < User::ROLE_TEACHER): ?>
    <p class="pull-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-5">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'subject',
                    'start',
                    'end',
                    'day',
                    ['label'=>'Section','attribute'=>'section.name'],
                    ['label'=>'Venue','attribute'=>'venue.name'],
                    ['label'=>'Teacher','attribute'=>'teacher.fullName'],
                ],
            ]) ?>
        </div>
        <div class="col-md-7">
            <h2>Class List</h2>
            <table class="table table-striped table-hover table-condensed">
                <tr>
                    <th>#</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                </tr>
                <tr>
                <?php foreach($model->section->studentEnrols as $idx=>$enrolee): ?>
                    <tr class="clickable" value="<?= Url::toRoute(['/students/view','id'=>$enrolee->studentId]);?>">
                        <td><?= $idx+1 ?>.</td>
                        <td><?= $enrolee->student->lastName ?></td>
                        <td><?= $enrolee->student->firstName ?></td>
                        <td><?= $enrolee->student->middleName ?></td>
                    </tr>
                <?php endforeach; ?>
                </tr>
        </div>
    </div>

    

</div>
