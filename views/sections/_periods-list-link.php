<?php
use yii\helpers\Url;

?>

<div class="list-group">

<?php foreach($periods as $period): ?>
	<a href="<?= Url::toRoute(['/sections/archives','periodId'=>$period->id]);?>" class="list-group-item">
		<?= $period->longName; ?>
	</a>
<?php endforeach; ?>
</div>