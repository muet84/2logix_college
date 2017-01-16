<?php

namespace app\modules\student\models;

use Yii;

/**
 * This is the model class for table "sports".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $activity_name
 * @property string $class
 * @property string $position
 * @property string $details
 * @property string $awards
 */
class Sports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['student_id'], 'required'],
            [['student_id'], 'integer'],
            [['details', 'awards'], 'string', 'max' => 50],
            [['activity_name', 'class', 'position'], 'string', 'max' => 30],
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
            'activity_name' => 'Activity Name',
            'class' => 'Class participated in',
            'position' => 'Position if applicable',
            'details' => 'Please provide brief details',
            'awards' => 'Awards/accomplishments',
        ];
    }
}
