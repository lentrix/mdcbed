<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Student;

/**
 * StudentSearch represents the model behind the search form of `app\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lrn'], 'integer'],
            [['lastName', 'firstName', 'middleName', 'gender', 'birthDate', 'nationality', 'religion', 'fName', 'fOccup', 'fContact', 'mName', 'mOccup', 'mContact', 'barangay', 'town', 'province', 'prevSchool', 'prvSchlAddr', 'honors', 'foodAllergies', 'rc', 'gmc', 'bc', 'pic', 'entryDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Student::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'lrn' => $this->lrn,
            'birthDate' => $this->birthDate,
            'entryDate' => $this->entryDate,
        ]);

        $query->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'middleName', $this->middleName])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'fName', $this->fName])
            ->andFilterWhere(['like', 'fOccup', $this->fOccup])
            ->andFilterWhere(['like', 'fContact', $this->fContact])
            ->andFilterWhere(['like', 'mName', $this->mName])
            ->andFilterWhere(['like', 'mOccup', $this->mOccup])
            ->andFilterWhere(['like', 'mContact', $this->mContact])
            ->andFilterWhere(['like', 'barangay', $this->barangay])
            ->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'prevSchool', $this->prevSchool])
            ->andFilterWhere(['like', 'prvSchlAddr', $this->prvSchlAddr])
            ->andFilterWhere(['like', 'honors', $this->honors])
            ->andFilterWhere(['like', 'foodAllergies', $this->foodAllergies])
            ->andFilterWhere(['like', 'rc', $this->rc])
            ->andFilterWhere(['like', 'gmc', $this->gmc])
            ->andFilterWhere(['like', 'bc', $this->bc])
            ->andFilterWhere(['like', 'pic', $this->pic]);

        return $dataProvider;
    }
}
