<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property int $id
 * @property string $name
 * @property int $levelId
 * @property int $teacherId
 * @property int $periodId
 * @property string $homeRoom
 * @property int $departmentId
 *
 * @property Level $level
 * @property Period $period
 * @property Teacher $teacher
 * @property Department $department
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'levelId','periodId'], 'required'],
            [['levelId', 'teacherId', 'periodId','homeRoom', 'departmentId'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['levelId'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['levelId' => 'id']],
            [['departmentId'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departmentId' => 'id']],
            [['periodId'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['periodId' => 'id']],
            [['teacherId'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacherId' => 'id']],
            [['teacherId'], 'unique', 'targetAttribute'=>['teacherId','periodId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'levelId' => 'Level',
            'teacherId' => 'Adviser',
            'periodId' => 'Period',
            'departmentId' => 'Department',
            'homeRoom' => 'Home Room',
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
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacherId']);
    }

    public function getVenue()
    {
        return $this->hasOne(Venue::className(), ['id'=>'homeRoom']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id'=>'departmentId']);
    }

    public function getEnrols()
    {
        return $this->hasMany(Enrol::className(), ['sectionId' => 'id']);
    }

    public static function getActive()
    {
        $sql = "SELECT * FROM section WHERE periodId IN (SELECT id FROM period WHERE active=1)";
        return Section::findBySql($sql)->all();
    }

    public function getClasses(){
        return $this->hasMany(Classes::className(), ['sectionId'=>'id']);
    }

    public function getStudentEnrols()
    {
        return Enrol::find()->joinWith('student')->where(['sectionId'=>$this->id])->all();
    }
}
