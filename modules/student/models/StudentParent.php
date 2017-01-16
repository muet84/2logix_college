<?php

namespace app\modules\student\models;

use Yii;

/**
 * This is the model class for table "parent".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $parent_type
 * @property string $first_name
 * @property string $last_name
 * @property string $cnic_number
 * @property string $occupation
 * @property string $company
 * @property string $office_address
 * @property string $qualification
 * @property string $qualified_from
 * @property string $office_telephone
 * @property string $mobile
 * @property string $email
 * @property string $primary
 */
class StudentParent extends \yii\db\ActiveRecord
{
    public $has_guardian;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'parent_type', 'first_name', 'last_name'], 'required', 
                'when' => function ($model) {
            return $model->parent_type != 'guardian';},
//             'whenClient' => "function (attribute, value) {
//                 if($('#studentparent-guardian-has_guardian') )
//                return $('#studentparent-guardian-has_guardian').val() == 'yes';
//            }"
                 'enableClientValidation' => false     
                    ],
            [['student_id'], 'integer'],
            [['email'], 'email'],
            [['parent_type', 'office_address', 'primary'], 'string'],
            [['first_name', 'last_name', 'occupation', 'qualification'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],

            [['cnic_number', 'mobile'], 'number'],
            [['cnic_number', 'mobile'], 'string', 'max' => 11],
            [['cnic_number'], 'string', 'max' => 13],
            [['company', 'qualified_from'], 'string', 'max' => 50],
            [['office_telephone'], 'string', 'max' => 20],
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
            'parent_type' => 'Parent Type',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'cnic_number' => 'CNIC Number',
            'occupation' => 'Occupation',
            'company' => 'Employer / Company name',
            'office_address' => 'Office Address',
            'qualification' => 'Qualification',
            'qualified_from' => 'Institution awarding qualification',
            'office_telephone' => 'Office telephone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'primary' => 'Primary contact for school',
        ];
    }
}
