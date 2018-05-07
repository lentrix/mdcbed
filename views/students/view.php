<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\models\Period;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = $model->formalName;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'header' => '<h3>Update Avatar</h3>',
    'id'=>'modal-avatar',
    'size' => Modal::SIZE_LARGE
]);

echo $this->render('/_cropper', ['action'=>Url::toRoute(['/students/upload']),'id'=>$model->id]);

Modal::end();

?>
<h1><?= Html::encode($this->title) ?></h1>
<hr>

<div class="student-view row">

    <div class="col-md-3">
        <?= Html::img('@web/uploads/avatars/students/' . $model->id . '.png',[
            'width'=>'100%'
        ]); ?>
    </div>
    <?php $activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'enrol' ?>
    <div class="col-md-9">
        <ul class="nav nav-tabs">
            <li class="<?= $activeTab=='enrol'?'active':'' ?>"><a href="#enrol" data-toggle="tab" aria-expanded="true">Current Enrolment</a></li>
            <li class="<?= $activeTab=='details'?'active':'' ?>"><a href="#details" data-toggle="tab" aria-expanded="true">Student Details</a></li>
            <li class="<?= $activeTab=='history'?'active':'' ?>"><a href="#history" data-toggle="tab" aria-expanded="true">Enrolment History</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade <?= $activeTab=='enrol' ? 'active in' : '' ?>" id="enrol">
                <?php if($model->currentEnrol): ?>
                    <h3><?= $model->currentEnrol->period->longName;?></h3>
                    <table class="table table-condensed table-bordered">
                        <tr>
                            <th>Level</th>
                            <td><?= $model->currentEnrol->level->longName ?></td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <td><?= $model->currentEnrol->section->name ?></td>
                        </tr>
                        <tr>
                            <th>Adviser</th>
                            <td><?= $model->currentEnrol->section->teacher?$model->currentEnrol->section->teacher->fullName:'' ?></td>
                        </tr>
                    </table>

                    <?php if($model->currentEnrol->period->phase > Period::PHASE_ENROLMENT): ?>

                    <?php else: ?>
                        <?= $this->render('_schedule', compact('model')); ?>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Currently not enrolled.</p>
                    <?= $this->render('_enrol_form', ['student'=>$model]); ?>
                <?php endif; ?>
            </div>
            <div class="tab-pane fade <?= $activeTab=='details' ? 'active in' : '' ?>" id="details">
                <p class="pull-right">
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::button('Update Picture',[
                        'class'=>'btn btn-default',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-avatar'
                    ]) ?>
                </p>
                <h3>Student Details</h3>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'lrn',
                        'lastName',
                        'firstName',
                        'middleName',
                        'gender',
                        'birthDate',
                        'nationality',
                        'religion',
                        'fName',
                        'fOccup',
                        'fContact',
                        'mName',
                        'mOccup',
                        'mContact',
                        'barangay',
                        'town',
                        'province',
                        'prevSchool',
                        'prvSchlAddr',
                        'honors',
                        'foodAllergies',
                        'rc',
                        'gmc',
                        'bc',
                        'pic',
                        'entryDate',
                    ],
                ]) ?>
            </div>
            <div class="tab-pane fade <?= $activeTab=='history' ? 'active in' : '' ?>" id="history">
                <h3>Enrolment History</h3>
                <?php if(count($model->enrols)>0) : ?>

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Period</th>
                        <th>Level</th>
                        <th>Section</th>
                        <th>Date Enrolled</th>
                    </tr>
                    <?php foreach($model->enrols as $enrol): ?>
                    <tr>
                        <td><?= $enrol->period->longName ?></td>
                        <td><?= $enrol->level->longName ?></td>
                        <td><?= $enrol->section->name ?></td>
                        <td><?= date('M d, Y', strtotime($enrol->dateEnrolled)) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                    
                <?php else: ?>
                    <p>No enrolment history.</p>
                <?php endif; ?>
            </div>
        </div>
        
    </div>

</div>
