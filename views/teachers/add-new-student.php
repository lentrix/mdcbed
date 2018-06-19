<?php

$this->title = "Add New Student to Advisory";

$this->params['breadcrumbs'][] = ['label'=>'My Advisory', 'url'=>['/teachers/advisory']];
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= $this->title; ?></h1>
<div class="alert alert-warning">
<span><i class="glyphicon glyphicon-exclamation-sign pull-left" style="font-size: 3.5em; padding-right: 10px"></i></span> 
Notice: This facility is meant to add a new student into your advisory class. <br>
Please make sure that the student you are adding is not yet in the system. <br>
Duplication of data in a system is a VERY BAD IDEA.
</div>

<?= $this->render('/students/_form', ['model'=>$student]); ?>