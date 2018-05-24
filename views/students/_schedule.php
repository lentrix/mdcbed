<?php
use app\models\Period;
use app\components\TimeCheck;

if($model->currentEnrol->period->phase > Period::PHASE_ENROLMENT){
    $classes = $model->currentEnrol->classes;
} else {
    $classes = $model->currentEnrol->section->classes;
}
?>

<h3>Schedule</h3>
<table class="table table-condensed table-striped">
    <thead>
        <tr>
            <th>Subject</th><th>Time</th><th>Venue</th><th>Teacher</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($classes as $cls): ?>
            <?php date_default_timezone_set("Asia/Manila"); ?>
            <tr <?= TimeCheck::classIsOnGoing($cls, (new DateTime("now"))->getTimeStamp()) ? 'class="highlight-row"' : '' ?>>
                <td><?= $cls->subject ?></td>
                <td>
                    <?= $cls->start ?> - <?= $cls->end ?> <?= $cls->day ?>
                </td>
                <td><?= $cls->venue->name ?></td>
                <td><?= $cls->teacher->fullName ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>