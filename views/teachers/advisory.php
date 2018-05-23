<?php

$this->title="My Advisory Class";

$this->params['breadcrumbs'][] = 'My Advisory';

$user = Yii::$app->user->identity;

?>
<h1><?= $this->title; ?></h1>
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