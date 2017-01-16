<?php

namespace app\modules\student\models;

use Yii;

/**
 * This is the model class for table "sibling_bvc".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $name
 * @property string $class
 */
class SiblingBvc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sibling_bvc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['student_id'], 'required'],
            [['student_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['class'], 'string', 'max' => 25],
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
            'name' => 'Name',
            'class' => 'Class',
        ];
    }
}
