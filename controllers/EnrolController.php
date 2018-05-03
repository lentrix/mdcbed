<?php

namespace app\controllers;

use yii;
use app\models\Student;
use app\models\Enrol;
use app\models\Section;
use app\models\EnrolForm;

class EnrolController extends \yii\web\Controller
{
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
