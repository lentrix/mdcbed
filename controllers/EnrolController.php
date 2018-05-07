<?php

namespace app\controllers;

use yii;
use app\models\Student;
use app\models\Enrol;
use app\models\Section;
use app\models\EnrolForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\models\User;

class EnrolController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access'=>[
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className()
                ],
                'only' => ['enrol','transfer','withdraw','promote'],
                'rules' => [
                    [
                        'actions' => ['enrol','transfer','withdraw','promote'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN, User::ROLE_HEAD]
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionEnrol()
    {
        $model = new EnrolForm;
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $section = Section::findOne($model->sectionId);
            
            $enrol = new Enrol;

            $enrol->sectionId = $model->sectionId;
            $enrol->studentId = $model->studentId;
            $enrol->levelId = $section->levelId;
            $enrol->periodId = $section->periodId;
            $enrol->dateEnrolled = date('Y-m-d h:i:s');
            $enrol->status = 1;
            $enrol->save();

            return $this->redirect(['students/view','id'=>$model->studentId]);
        }
    }

    public function actionPromote()
    {
        return $this->render('promote');
    }

    public function actionTransfer()
    {
        return $this->render('transfer');
    }

    public function actionWithdraw()
    {
        return $this->render('withdraw');
    }

}
