<?php

namespace app\modules\student\models;

use Yii;

/**
 * This is the model class for table "sibling".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $name
 * @property string $class
 * @property string $age
 * @property string $assosiation
 */
class Sibling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sibling';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id', 'student_id'], 'required'],
            [['id', 'student_id'], 'integer'],
            [['name', 'assosiation'], 'string', 'max' => 50],
            [['class'], 'string', 'max' => 25],
            [['age'], 'string', 'max' => 10],
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
            'age' => 'Age',
            'assosiation' => 'School / College / Employer',
        ];
    }
}
