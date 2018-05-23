<?php
use yii\helpers\Url;

$this->title = "My Classes";

$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= $this->title; ?></h1>

<?php if($teacher === null): ?>

    <div class="alert alert-warning">
        <span class="large-text"><i class="glyphicon glyphicon-ban-circle"></i> You do not have a teacher account.</span> 
    </div>

<?php else: ?>

<div class="row">
    <div class="col-md-8 col-lg-6">
        <table class="table table-bordered table-hover">
            <tr>
                <th>Subject</th>
                <th>Time</th>
                <th>Venue</th>
            </tr>

            <?php foreach($teacher->currentClasses as $class): ?>
                <tr class="clickable" value="<?= Url::toRoute(['/classes/view','id'=>$class->id]) ?>">
                    <td><?= $class->subject ?></td>
                    <td><?= $class->start ?> - <?= $class->end; ?> <?= $class->day?></td>
                    <td><?= $class->venue->name ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>
        

<?php endif; ?>