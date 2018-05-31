<?php

use yii\helpers\Url;

?>
    <table class="table table-bordered table-condensed table-hover">
        <tr>
            <th>Name</th>
            <th>Level</th>
            <th>Home Room</th>
            <th>Adviser</th>
            <th>Population</th>
        </tr>
    <?php foreach($sections as $section): ?>
        <tr class="clickable" value="<?= Url::toRoute(['/sections/view','id'=>$section->id]);?>">
            <td><?= $section->name ?></td>
            <td><?= $section->level->longName ?></td>
            <td><?= $section->venue->name ?></td>
            <td><?= $section->teacher->fullName ?></td>
            <td>#</td>
        </tr>
    <?php endforeach; ?>
    </table>