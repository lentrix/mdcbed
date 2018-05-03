<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property int $id
 * @property string $lastName
 * @property string $firstName
 * @property string $phone
 * @property string $specialization
 * @property string $avatarPath
 * @property int $userId
 * @property int $departmentId
 *
 * @property User $user
 */
class Teacher extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lastName', 'firstName'], 'required'],
            [['userId','departmentId'], 'integer'],
            [['lastName', 'firstName', 'specialization'], 'string', 'max' => 90],
            [['phone'], 'string', 'max' => 11],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['userId'], 'unique', 'targetAttribute'=>['userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lastName' => 'Last Name',
            'firstName' => 'First Name',
            'phone' => 'Phone',
            'specialization' => 'Specialization',
            'userId' => 'User ID',
            'departmentId' => 'Department',
            'image' => 'Avatar'
        ];
    }

    public function unAssigned($attribute, $params)
    {
        $teacher = static::find()->where(['userId'=>$this->userId])->one();
        if($teacher!=null && $teacher->id!=$this->id) {
            $this->addError($attribute, "User ID is already assigned to $teacher->fullName");
        }
    }

    public function getSections()
    {
        return $this->hasMany(Section::className(), ['teacherId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'departmentId']);
    }

    public static function getNonAdvisers() {
        $sql = "SELECT * FROM teacher WHERE id NOT IN (SELECT teacherId FROM section)";
        return static::findBySql($sql)->all();
    }

    public function getFullName()
    {
        return "$this->lastName, $this->firstName";
    }
}
