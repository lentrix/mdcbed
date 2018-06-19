<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title="My Advisory Class";

$this->params['breadcrumbs'][] = 'My Advisory';

$user = Yii::$app->user->identity;

?>

<?php if($user->teacher==null): ?>
<div class="alert alert-warning">
    <span class="large-text"><i class="glyphicon glyphicon-ban-circle"></i> You do not have teacher account. <?php return; ?></span>
</div>
<?php endif; ?>

<?php if($user->teacher->advisory==null): ?>
<div class="alert alert-warning">
    <span class="large-text"><i class="glyphicon glyphicon-ban-circle"></i> You do not have an advisory. <?php return; ?></span>
</div>
<?php endif; ?>

<?php if($advisory = $user->teacher->advisory): ?>

<h1>
    <?= $this->title; ?>
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Add New Student',['/teachers/add-new-student'],['class'=>'btn btn-primary pull-right']); ?>
</h1>

<div class="row">

    <div class="col-md-4">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Section</th><td><?= $advisory->name ?></td>
            </tr>
            <tr>
                <th>Level</th><td><?= $advisory->level->longName ?></td>
            </tr>
            <tr>
                <th>Home Room</th><td><?= $advisory->venue->name ?></td>
            </tr>
        </table>
    </div>

    <div class="col-md-8">
        <table class="table table-condensed table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
            </tr>
        <?php foreach($user->teacher->advisory->studentEnrols as $index=>$enrol): ?>
            <tr class="clickable" value="<?= Url::toRoute(['/students/view','id'=>$enrol->student->id]) ?>">
                <td><?= $index+1 ?>.</td>
                <td><?= $enrol->student->lastName ?></td>
                <td><?= $enrol->student->firstName ?></td>
                <td><?= $enrol->student->middleName ?></td>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>

</div>

<?php endif; ?>