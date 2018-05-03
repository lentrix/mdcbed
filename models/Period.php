<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "period".
 *
 * @property int $id
 * @property string $shortName
 * @property string $longName
 * @property string $start
 * @property string $end
 * @property int $type
 * @property int $active
 *
 * @property Section[] $sections
 */
class Period extends \yii\db\ActiveRecord
{

    const PHASE_ENROLMENT = 0;
    const PHASE_FIRST_QUARTER = 1;
    const PHASE_SECOND_QUARTER = 2;
    const PHASE_THIRD_QUARTER = 3;
    const PHASE_FOURTH_QUARTER = 4;
    const PHASE_END_OF_PERIOD = 5;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'period';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortName', 'longName', 'start', 'end', 'type'], 'required'],
            [['start', 'end'], 'safe'],
            [['phase'], 'integer'], 
            [['shortName'], 'string', 'max' => 45],
            [['longName'], 'string', 'max' => 200],
            [['type', 'active'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shortName' => 'Short Name',
            'longName' => 'Long Name',
            'start' => 'Start',
            'end' => 'End',
            'type' => 'Type',
            'typeStr' => 'Type',
            'active' => 'Active',
            'phase' => 'Phase'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Section::className(), ['periodId' => 'id']);
    }

    public static function getActive()
    {
        return static::find()->where(['active'=>1])->all();
    }
    
    public function getTypeStr()
    {
        switch($this->type){
            case 0 : return "Annual";
            case 1 : return "Semestral";
        }
    }

    public function getPhaseStr()
    {
        switch($this->phase) {
            case 0 : return "Enrolment Phase";
            case 1 : return "First Quarter";
            case 2 : return "Second Quarter";
            case 3 : return "Third Quarter";
            case 4 : return "Fourth Quarter";
            case 5 : return "End of Period";
        }
    }

    public function getEnrols()
    {
        return $this->hasMany(Enrol::className(), ['periodId' => 'id']);
    }
}

