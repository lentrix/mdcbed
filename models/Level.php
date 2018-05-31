<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property int $id
 * @property string $longName
 * @property string $shortName
 * @property string $category
 * @property int $nextLevelId
 * @property int $previousLevelId
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['longName', 'shortName', 'category'], 'required'],
            [['nextLevelId', 'previousLevelId'], 'integer'],
            [['longName'], 'string', 'max' => 45],
            [['shortName'], 'string', 'max' => 200],
            [['category'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'longName' => 'Long Name',
            'shortName' => 'Short Name',
            'category' => 'Category',
            'nextLevelId' => 'Next Level ID',
            'previousLevelId' => 'Previous Level ID',
        ];
    }

    public function getEnrols()
    {
        return $this->hasMany(Enrol::className(), ['levelId' => 'id']);
    }

    public function getCurrentEnrols() {
        return Enrol::find()->joinWith('period')->joinWith('student')
            ->where(['period.active'=>1])
            ->andFilterWhere(['levelId'=>$this->id])
            ->orderBy('student.lastName, student.firstName')
            ->all();
    }
}
