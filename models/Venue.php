<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "venue".
 *
 * @property int $id
 * @property string $name
 * @property int $capacity
 */
class Venue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'capacity'], 'required'],
            [['capacity'], 'integer'],
            [['name'], 'string', 'max' => 45],
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
            'capacity' => 'Capacity',
        ];
    }

    public function getActiveStr()
    {
        return $this->active ? 'Active' : 'Inactive';
    }
}
