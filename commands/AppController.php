<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class AppController extends Controller
{
    public function actionIndex()
    {
        echo "\nApplication Custom Command\n";

        return ExitCode::OK;
    }

    public function actionCreateUser($username, $fullName, $role, $password)
    {
      $user = new \app\models\User;
      $user->username = $username;
      $user->fullName = $fullName;
      $user->role = $role;
      $user->setPassword($password);

      $user->save();
      echo "User created successfully!!!\n";
    }
}
