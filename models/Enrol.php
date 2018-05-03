<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enrol".
 *
 * @property int $id
 * @property int $studentId
 * @property int $levelId
 * @property int $periodId
 * @property int $sectionId
 * @property string $dateEnrolled
 * @property int $status
 *
 * @property Level $level
 * @property Period $period
 * @property Section $section
 * @property Student $student
 */
class Enrol extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_WITHDRAWN = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enrol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['studentId', 'levelId', 'periodId'], 'required'],
            [['studentId', 'levelId', 'periodId', 'sectionId', 'status'], 'integer'],
            [['dateEnrolled'], 'safe'],
            [['levelId'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['levelId' => 'id']],
            [['periodId'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['periodId' => 'id']],
            [['sectionId'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['sectionId' => 'id']],
            [['studentId'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['studentId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'studentId' => 'Student ID',
            'levelId' => 'Level ID',
            'periodId' => 'Period ID',
            'sectionId' => 'Section ID',
            'dateEnrolled' => 'Date Enrolled',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'levelId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(Period::className(), ['id' => 'periodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'sectionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'studentId']);
    }

    public function getStatusStr()
    {
        return $this->status?"Active":"Withdrawn";
    }

    public function getClasses()
    {
        return [];
    }
}
