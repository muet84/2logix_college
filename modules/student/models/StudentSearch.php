<?php

namespace app\modules\student\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\student\models\Student;

/**
 * StudentSearch represents the model behind the search form about `app\modules\student\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['refrence_number', 'course_code', 'first_name', 'middle_name', 'last_name', 'gender', 
                'date_of_birth', 'nationality', 'address', 'phone', 'mobile', 'email','cie_registration',
                'class_nine_school', 'class_nine_city', 'class_nine_country', 'class_ten_school', 'class_ten_city', 'class_ten_country', 'class_eleven_school', 'class_eleven_city', 'class_eleven_country', 'suspended_from_school', 'suspended_details', 'languages_spoken', 'support_admission_decsion', 'emergency_name', 'emergency_relation', 'emergency_contact', 'emergency_address', 'emergency_email', 'primary_contact', 'speaking_event', 'drama_theater', 'sports_continue', 'subject_selected', 'course_after_alevel', 'why_bvc', 'contribute_bvc', 'tenyears_fromnow', 'strength_weaknesses', 'exampe_leadership', 'essay_topic', 'essay_content', 'event_news', 'under_statement', 'experience_failure', 'photo_path', 'admin_path', 'updated', 'create_date'], 'safe'],
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
            'sort'=> ['defaultOrder' => ['create_date'=>SORT_DESC]]
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
            'date_of_birth' => $this->date_of_birth,
            'status' => $this->status,
            'updated' => $this->updated,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'refrence_number', $this->refrence_number])
            ->andFilterWhere(['like', 'course_code', $this->course_code])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'class_nine_school', $this->class_nine_school])
            ->andFilterWhere(['like', 'class_nine_city', $this->class_nine_city])
            ->andFilterWhere(['like', 'class_nine_country', $this->class_nine_country])
            ->andFilterWhere(['like', 'class_ten_school', $this->class_ten_school])
            ->andFilterWhere(['like', 'class_ten_city', $this->class_ten_city])
            ->andFilterWhere(['like', 'class_ten_country', $this->class_ten_country])
            ->andFilterWhere(['like', 'class_eleven_school', $this->class_eleven_school])
            ->andFilterWhere(['like', 'class_eleven_city', $this->class_eleven_city])
            ->andFilterWhere(['like', 'class_eleven_country', $this->class_eleven_country])
            ->andFilterWhere(['like', 'suspended_from_school', $this->suspended_from_school])
            ->andFilterWhere(['like', 'suspended_details', $this->suspended_details])
            ->andFilterWhere(['like', 'languages_spoken', $this->languages_spoken])
            ->andFilterWhere(['like', 'support_admission_decsion', $this->support_admission_decsion])
            ->andFilterWhere(['like', 'emergency_name', $this->emergency_name])
            ->andFilterWhere(['like', 'emergency_relation', $this->emergency_relation])
            ->andFilterWhere(['like', 'emergency_contact', $this->emergency_contact])
            ->andFilterWhere(['like', 'emergency_address', $this->emergency_address])
            ->andFilterWhere(['like', 'emergency_email', $this->emergency_email])
            ->andFilterWhere(['like', 'primary_contact', $this->primary_contact])
            ->andFilterWhere(['like', 'speaking_event', $this->speaking_event])
            ->andFilterWhere(['like', 'drama_theater', $this->drama_theater])
            ->andFilterWhere(['like', 'sports_continue', $this->sports_continue])
            ->andFilterWhere(['like', 'subject_selected', $this->subject_selected])
            ->andFilterWhere(['like', 'course_after_alevel', $this->course_after_alevel])
            ->andFilterWhere(['like', 'why_bvc', $this->why_bvc])
            ->andFilterWhere(['like', 'contribute_bvc', $this->contribute_bvc])
            ->andFilterWhere(['like', 'tenyears_fromnow', $this->tenyears_fromnow])
            ->andFilterWhere(['like', 'strength_weaknesses', $this->strength_weaknesses])
            ->andFilterWhere(['like', 'exampe_leadership', $this->exampe_leadership])
            ->andFilterWhere(['like', 'essay_topic', $this->essay_topic])
            ->andFilterWhere(['like', 'essay_content', $this->essay_content])
            ->andFilterWhere(['like', 'event_news', $this->event_news])
            ->andFilterWhere(['like', 'under_statement', $this->under_statement])
            ->andFilterWhere(['like', 'experience_failure', $this->experience_failure])
            ->andFilterWhere(['like', 'photo_path', $this->photo_path])
            ->andFilterWhere(['like', 'admin_path', $this->admin_path]);

        return $dataProvider;
    }
}
