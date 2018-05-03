<?php

namespace app\controllers;

class UploadsController extends \yii\web\Controller
{
    public function actionUpload()
    {
        if(isset($_POST['cropped'])) {
            $img = $_POST['cropped'];
            return "<img src='$img'/>";
        }
    }

    public function actionIndex(){
        return "Uploader.";
    }

}
