<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = "Sections Archives";
$this->params['breadcrumbs'][] = ['label'=>'Sections','url'=>['/sections/index']];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
	'id'=>'select-period',
	'header' => '<h2>Select a period</h2>'
]);
	echo $this->render('_periods-list-link',compact('periods'));
Modal::end();
?>

<h1>
	<button class="btn btn-sm btn-default pull-right" 
			data-toggle="modal" data-target="#select-period">
		<i class="glyphicon glyphicon-cog"></i> Select Period
	</button>
	<?= $this->title;?>
</h1>

<?php if($sections): ?>
<?= $this->render('_table-view', compact('sections')); ?>
<?php endif; ?>