<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class EnrolForm extends Model
{
    public $sectionId;
    public $studentId;

    public function rules()
    {
        return [
            [['sectionId','studentId'], 'required'],
            [['sectionId','studentId'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'sectionId' => 'Section',
            'studentId' => 'Student'
        ];
    }
}