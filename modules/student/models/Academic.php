<?php

namespace app\modules\student\models;

use Yii;

/**
 * This is the model class for table "academic".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $subject
 * @property string $grade
 * @property string $class_nine_first_term
 * @property string $class_nine_second_term
 * @property string $class_ten_first_term
 * @property string $class_ten_second_term
 */
class Academic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'academic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'subject', 'grade'], 'required'],
            [['student_id'], 'integer'],
            [['subject'], 'string', 'max' => 25],
            [['grade'], 'string', 'max' => 5],
            [['class_nine_first_term', 'class_nine_second_term', 'class_ten_first_term',
                'class_ten_second_term','class_eleven_first_term','class_eleven_second_term'], 'string', 'max' => 3],
            [['class_nine_first_term', 'class_nine_second_term', 'class_ten_first_term', 
                'class_ten_second_term','class_eleven_first_term','class_eleven_second_term'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'subject' => 'Subject',
            'grade' => 'O Level Grade',
            'class_nine_first_term' => 'First Term Overall %',
            'class_nine_second_term' => 'Second Term Overall %',
            'class_ten_first_term' => 'First Term Overall %',
            'class_ten_second_term' => 'Second Term Overall %',
            'class_eleven_first_term' => 'First Term Overall %',
            'class_eleven_second_term' => 'Second Term Overall %',
        ];
    }
}
