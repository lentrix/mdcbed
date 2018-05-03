<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semester".
 *
 * @property int $id
 * @property string $shortName
 * @property string $longName
 * @property string $start
 * @property string $end
 * @property int $active
 *
 * @property Section[] $sections
 */
class Semester extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semester';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortName', 'longName', 'start', 'end'], 'required'],
            [['start', 'end'], 'safe'],
            [['shortName'], 'string', 'max' => 15],
            [['longName'], 'string', 'max' => 45],
            [['active'], 'string', 'max' => 1],
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
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Section::className(), ['semesterId' => 'id']);
    }
}
