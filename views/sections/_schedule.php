<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\components\TimeCheck;

?>

<h3>Schedule</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Subject</th><th>Time</th><th>Venue</th><th>Teacher</th><th>*</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($model->classes as $cls): ?>
            <?php date_default_timezone_set("Asia/Manila"); ?>
            <tr <?= TimeCheck::classIsOnGoing($cls, (new DateTime("now"))->getTimeStamp()) ? 'class="highlight-row"' : '' ?>>
                <td><?= $cls->subject ?></td>
                <td>
                    <?= $cls->start ?> - <?= $cls->end ?> <?= $cls->day ?>
                </td>
                <td><?= $cls->venue->name ?></td>
                <td><?= $cls->teacher->fullName ?></td>
                <td>
                    <button class="btn btn-warning btn-xs delete-button"
                        data-message="Are you sure you want to delete this class?"
                        data-url="<?= Url::toRoute(['/classes/delete', 'id'=>$cls->id]) ?>"
                        title="Delete class" >
                        <i class="glyphicon glyphicon-remove"></i>
                    </button>
                    <?= Html::a('<i class="glyphicon glyphicon-edit"></i>',
                        ['/classes/update', 'id'=>$cls->id],
                        ['class'=>'btn btn-info btn-xs', 'title'=>'Update class']
                    ) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>