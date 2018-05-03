<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property int $lrn
 * @property string $lastName
 * @property string $firstName
 * @property string $middleName
 * @property string $gender
 * @property string $birthDate
 * @property string $nationality
 * @property string $religion
 * @property string $fName
 * @property string $fOccup
 * @property string $fContact
 * @property string $mName
 * @property string $mOccup
 * @property string $mContact
 * @property string $barangay
 * @property string $town
 * @property string $province
 * @property string $prevSchool
 * @property string $prvSchlAddr
 * @property string $honors
 * @property string $foodAllergies
 * @property int $rc
 * @property int $gmc
 * @property int $bc
 * @property int $pic
 * @property string $entryDate
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lrn'], 'integer'],
            [['lastName', 'firstName', 'gender', 'birthDate'], 'required'],
            [['birthDate', 'entryDate'], 'safe'],
            [['lastName', 'firstName', 'middleName', 'nationality', 'fContact', 'mContact', 'barangay', 'town', 'province'], 'string', 'max' => 60],
            [['gender', 'rc', 'gmc', 'bc', 'pic'], 'string', 'max' => 1],
            [['religion', 'fName', 'fOccup', 'mName', 'mOccup', 'honors', 'foodAllergies'], 'string', 'max' => 191],
            [['prevSchool', 'prvSchlAddr'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lrn' => 'Lrn',
            'lastName' => 'Last Name',
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'gender' => 'Gender',
            'birthDate' => 'Birth Date',
            'nationality' => 'Nationality',
            'religion' => 'Religion',
            'fName' => 'Father\'s Name',
            'fOccup' => 'Father\'s Occupation',
            'fContact' => 'Father\'s Contact',
            'mName' => 'Mother\'s Name',
            'mOccup' => 'Mother\'s Occupation',
            'mContact' => 'Mother\'s Contact',
            'barangay' => 'Barangay',
            'town' => 'Town',
            'province' => 'Province',
            'prevSchool' => 'Previous School Attended',
            'prvSchlAddr' => 'Previous School Address',
            'honors' => 'Honors Received',
            'foodAllergies' => 'Food Allergies',
            'rc' => 'Report Card',
            'gmc' => 'Good Moral Character',
            'bc' => 'Birth Certificate',
            'pic' => '2pcs. 2x2 Picture',
            'entryDate' => 'Entry Date',
        ];
    }

    public function getAddress()
    {
        return "$this->barangay, $this->town, $this->province";
    }

    public function getFormalName()
    {
        $mi = substr($this->middleName,0,1);
        return "$this->lastName, $this->firstName $mi.";
    }

    public function getEnrols()
    {
        return $this->hasMany(Enrol::className(), ['studentId' => 'id']);
    }

    public function getCurrentEnrol()
    {
        $sql = "SELECT * FROM enrol WHERE studentId=$this->id AND periodId IN (SELECT id FROM period WHERE active = 1)";
        return Enrol::findBySql($sql)->one();
    }
}
