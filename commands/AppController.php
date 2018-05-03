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
    public function actionPopulateLevels()
    {
        echo "Removing levels.. ";
        $this->clearLevels();
        echo "Done.\n";

        echo "Populating new levels.. ";
        $levels = [
	    ['N', 'Nursery', 'presc'],
            ['K1', 'Kindergarten 1', 'presc'],
            ['K2' , 'Kindergarten 2', 'presc'],
            ['Gr1', 'Grade 1', 'elem'],
            ['Gr2', 'Grade 2', 'elem'],
            ['Gr3', 'Grade 3', 'elem'],
            ['Gr4', 'Grade 4', 'elem'],
            ['Gr5', 'Grade 5', 'elem'],
            ['Gr6', 'Grade 6', 'elem'],
            ['Gr7', 'Grade 7', 'jhs'],
            ['Gr8', 'Grade 8', 'jhs'],
            ['Gr9', 'Grade 9', 'jhs'],
            ['Gr10', 'Grade 10', 'jhs'],
            ['Gr11', 'Grade 11', 'shs'],
            ['Gr12', 'Grade 12', 'shs'],
            ['Bacc1', '1st Year College','clg'],
            ['Bacc2', '2nd Year College','clg'],
            ['Bacc3', '3rd Year College','clg'],
            ['Bacc4', '4th Year College','clg'],
            ['Bacc5', '5th Year College','clg'],
            ['Grad', 'Graduate School', 'grad']
        ];

        $size = count($levels);

        foreach($levels as $i=>$level) {
            Yii::$app->db->CreateCommand()->insert('level',[
                'shortName'=>$level[0],
                'longName'=>$level[1],
                'category'=>$level[2],
                'nextLevelId' => $i==($size-1)?null:$i+1,
                'previousLevelId' => $i==0?null:$i-1,
            ])->execute();
        }

        echo "Done.\n";
    }

    private function clearLevels()
    {
        Yii::$app->db->createCommand("DELETE FROM level")->execute();
    }
}
