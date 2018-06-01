<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "classes".
 *
 * @property int $id
 * @property string $subject
 * @property string $start
 * @property string $end
 * @property string $day
 * @property int $sectionId
 * @property int $venueId
 * @property int $teacherId
 *
 * @property Section $section
 * @property Teacher $teacher
 * @property Venue $venue
 */
class Classes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'classes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'sectionId', 'venueId', 'teacherId'], 'required'],
            [['start', 'end'], 'safe'],
            [['day'], 'string', 'max' => 15], 
            [['sectionId', 'venueId', 'teacherId'], 'integer'],
            [['subject'], 'string', 'max' => 45],
            [['sectionId'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['sectionId' => 'id']],
            [['teacherId'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacherId' => 'id']],
            [['venueId'], 'exist', 'skipOnError' => true, 'targetClass' => Venue::className(), 'targetAttribute' => ['venueId' => 'id']],
            ['venueId', 'venueAvailable'],
            ['teacherId', 'teacherAvailable'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'start' => 'Start',
            'end' => 'End',
            'sectionId' => 'Section',
            'venueId' => 'Venue',
            'teacherId' => 'Teacher',
            'periodId' => 'Period',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'sectionId']);
    }

    public function getPeriod() {
        return $this->hasOne(Period::className(), ['id'=>'periodId'])->via('section');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacherId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenue()
    {
        return $this->hasOne(Venue::className(), ['id' => 'venueId']);
    }

    public function getSchedule()
    {
        return $this->start . '-' . $this->end . ' ' . $this->day;
    }

    public function getCount() {
        
    }

    public function teacherAvailable($attribute, $params){
        if(!$this->hasErrors()) {
            $tempId = $this->id ? $this->id : -1;
            foreach(str_split($this->day) as $day) {
                $exStart = $this->adjustTime($this->start,'+1 minutes');
                $exEnd = $this->adjustTime($this->end, '-1 minutes');

                $conflict = Classes::find()->joinWith('period')
                ->where(['OR', ['between', 'classes.start', $this->start, $exEnd],
                    ['between', 'classes.end', $exStart, $this->end]])
                ->andFilterWhere(['classes.teacherId'=>$this->teacherId])
                ->andFilterWhere(['like', 'day', $day])
                ->andFilterWhere(['not', 'classes.id=' . $tempId])
                ->andFilterWhere(['period.active'=>1])
                ->one();

                if ($conflict) {
                    $this->addError($attribute, 'This schedule is in conflict with ' 
                        . $conflict->subject . ' ' . $conflict->schedule);
                }
            }
        }
    }

    public function venueAvailable($attribute, $params)
    {
        if(!$this->hasErrors()) {
            foreach(str_split($this->day) as $day) {
                $tempId = $this->id ? $this->id : -1;
                $exStart = $this->adjustTime($this->start,'+1 minutes');
                $exEnd = $this->adjustTime($this->end, '-1 minutes');
                $command = Classes::find()->joinWith('period')
                ->where(['OR', ['between', 'classes.start', $this->start, $exEnd],
                    ['between', 'classes.end', $exStart, $this->end]])
                ->andFilterWhere(['venueId'=>$this->venueId])
                ->andFilterWhere(['like', 'day', $day])
                ->andFilterWhere(['not', 'classes.id=' . $tempId])
                ->andFilterWhere(['period.active'=>1]);

                $sql = $command->createCommand()->getRawSql();

                $conflict = $command->one();

                if ($conflict) {
                    $this->addError($attribute, 'This schedule is in conflict with ' 
                        . $conflict->subject . ' ' . $conflict->schedule);
                    echo $sql;
                    die();
                }
            }
        }
    }

    private function adjustTime($time, $adjustment){
        $date = strtotime($time);
        $excl = strtotime($adjustment, $date);
        return date('H:i', $excl);
    }
}
