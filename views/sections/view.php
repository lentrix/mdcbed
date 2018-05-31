<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ModalConfirmation;
use yii\bootstrap\Modal;
use app\models\User;
use app\models\Period;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Section */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->identity;

$class = new \app\models\Classes;
$class->sectionId = $model->id;

Modal::begin([
    'header' => '<h3>Add Class</h3>',
    'id' => 'modal-add-class',
]); 

echo "<div id='modal-add-content'></div>";
Modal::end(); 

?>

<?php if($user->role < User::ROLE_TEACHER && $model->period->phase == Period::PHASE_ENROLMENT): ?>
<p class="pull-right">
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</p>
<?php endif; ?>

<div class="row">

    <div class="col-md-4">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                ['label'=>'Level', 'attribute' => 'level.longName'],
                ['label'=>'Department', 'attribute' => 'department.longName'],
                ['label'=>'Adviser', 'attribute' => 'teacher.fullName'],
                ['label'=>'Period', 'attribute' => 'period.longName'],
                ['label'=>'Home Room', 'attribute'=>'venue.name'],
            ],
        ]) ?>
    </div>
    <?php $activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'students' ?>
    <div class="col-md-8">
        <ul class="nav nav-tabs">
            <li class="<?= $activeTab=='students'?'active':'' ?>"><a href="#students" data-toggle="tab" aria-expanded="true">Learners</a></li>
            <li class="<?= $activeTab=='schedule'?'active':'' ?>"><a href="#schedule" data-toggle="tab" aria-expanded="true">Schedule</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            
            <div class="tab-pane fade <?= $activeTab=='students' ? 'active in' : '' ?>" id="students">
                <h3>Learners</h3>
                <table class="table table-striped table-hover">
                    <tr>
                        <th>LRN</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                    </tr>
                    <?php foreach($model->studentEnrols as $enrol): ?>
                    <tr class="clickable" value="<?= Url::toRoute(['/students/view','id'=>$enrol->student->id]);?>">
                        <td><?= $enrol->student->lrn ?></td>
                        <td><?= $enrol->student->lastName ?></td>
                        <td><?= $enrol->student->firstName ?></td>
                        <td><?= $enrol->student->middleName ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="tab-pane fade <?= $activeTab=='schedule'?'active in':'' ?>" id="schedule">
                <?php if($user->role < User::ROLE_TEACHER && $model->period->phase == Period::PHASE_ENROLMENT): ?>
                <span class="pull-right">
                    <?= Html::a('<i class="glyphicon glyphicon-plus"></i>', 
                        ['/classes/create','sectionId'=>$model->id],
                        ['class'=>'btn btn-primary', 'title'=>'Add class']
                    ) ?>
                </span>
                <?php endif; ?>
                <?= $this->render('_schedule', compact('model')) ?>
            </div>
        </div>
    </div>
</div>
