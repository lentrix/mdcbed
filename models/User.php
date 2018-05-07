<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $fullName
 * @property string $authKey
 * @property string $accessToken
 * @property int $teacherId
 * @property int $active
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public const ROLE_ADMIN = 100;
    public const ROLE_HEAD = 200;
    public const ROLE_STAFF = 210;
    public const ROLE_TEACHER = 220;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'fullName', 'role'], 'required'],
            [['role'], 'integer'],
            [['username'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 255],
            [['fullName'], 'string', 'max' => 191],
            [['authKey', 'accessToken'], 'string', 'max' => 100],
            [['active'], 'integer'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'fullName' => 'Full Name',
            'authKey' => 'Auth Key',
            'role' => 'Role',
            'accessToken' => 'Access Token',
            'active' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()->where(['accessToken'=>$token])->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['username'=>$username])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTeachers()
    {
        return $this->hasOne(Teacher::className(), ['userId' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
        $this->save();
    }

    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['userId'=>'id']);
    }

    public function getRoleString()
    {
        switch($this->role)
        {
            case static::ROLE_ADMIN: return "Administrator";
            case static::ROLE_HEAD: return "Head Teacher";
            case static::ROLE_STAFF: return "Staff";
            case static::ROLE_TEACHER: return "Teacher";
            //case static::ROLE_STUDENT: return "Student";
        }
    }
}
