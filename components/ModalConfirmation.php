<?php 
namespace app\components;

use yii\bootstrap\Modal;
use yii\helpers\Html;

class ModalConfirmation {
	public function confirm($id, $message, $header, $link=[],$toggleButton=false)
	{

		$buttons = '<span class="pull-right">' .
		Html::a('<i class="glyphicon glyphicon-ok"></i> Yes',
		$link, ['class'=>'btn btn-primary', 'data'=>['method'=>'post']]) .
		"&nbsp;" .
		Html::button('<i class="glyphicon glyphicon-remove"></i> No',[
			'class'=>'btn btn-danger', 'data-toggle'=>'modal', 'data-target'=>'#'.$id]) .
		'</span>';

		Modal::begin([
		    'header'=>$header,
			'id' => $id,
			'toggleButton' => $toggleButton,
			'footer' => $buttons
		]) ;

		echo $message;

    	Modal::end();
	}
}
?>