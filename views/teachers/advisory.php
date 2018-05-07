<?php

$this->title="My Advisory Class";

$this->params['breadcrumbs'][] = 'My Advisory';

?>

<h1><?= $this->title; ?></h1>
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

</div>