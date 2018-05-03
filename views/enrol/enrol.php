<?php

$this->title = "Enrol Student";

$this->params['breadcrumbs'][] = ['label'=>'Students', 'url'=>['/students/index']];
$this->params['breadcrumbs'][] = ['label'=>$student->formalName, 'url'=>['/students/view','id'=>$student->id,'tab'=>'enrol']];
$this->params['breadcrumbs'][] = $this->title
?>
<h1><?= $this->title ?></h1>

