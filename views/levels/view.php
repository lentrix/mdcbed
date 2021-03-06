<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ModalConfirmation;
use yii\helpers\Url;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Level */

$this->title = 'View Level: ' . $model->shortName;
$this->params['breadcrumbs'][] = ['label' => 'Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->shortName;

$user = Yii::$app->user->identity;
?>

<?php ModalConfirmation::confirm('modal-delete', 
    '<p>Are you sure you want to delete this Level?</p>',
    '<h4>Delete School Year</h4>',
    ['/levels/delete', 'id'=>$model->id]) ?>


<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-5">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'longName',
                'shortName',
                'category',
                'nextLevelId',
                'previousLevelId',
            ],
        ]) ?>
        <?php if($user->role < User::ROLE_TEACHER): ?>
        <p>
            <?= Html::a('<i class="glyphicon glyphicon-edit"></i> Update', 
                ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>
        <?php endif; ?>
    </div>
    <div class="col-md-7">
        <h2 style="margin-top: -34px; border-bottom: 1px solid #ccc"><?= $model->shortName ?> Students</h2>
        <table class="table table-bordered table-hover table-condensed">
            <tr>
                <th>#</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
            </tr>
            
        <?php foreach($model->currentEnrols as $index=>$enrol): ?>
            <tr class="clickable" value="<?= Url::toRoute(['/students/view','id'=>$enrol->student->id]);?>">
                <td><?= $index+1 ?>.</td>
                <td><?= $enrol->student->lastName;?></td>
                <td><?= $enrol->student->firstName; ?></td>
                <td><?= $enrol->student->middleName; ?></td>
            </tr>
        <?php endforeach; ?>
            
        </table>
    </div>
</div>
