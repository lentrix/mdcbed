<?php
namespace app\components;
use app\models\User;

class Sidebar  {
	public static function render(\yii\base\View $view) 
	{
		switch(Yii::$app->user->identity->role) {
			case User::ROLE_ADMIN : return $view->render('/sidebars/_admin');
			case User::ROLE_HEAD : return $view->render('/sidebars/_head');
			case User::ROLE_STAFF : return $view->render('/sidebars/_staff');
			case User::ROLE_TEACHER : return $view->render('/sidebars/_teacher');
		}
	}
}