<?php

namespace app\modules\student\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $refrence_number
 * @property string $cie_registration
 * @property string $course_code
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $gender
 * @property string $date_of_birth
 * @property string $nationality
 * @property string $address
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $class_nine_school
 * @property string $class_nine_city
 * @property string $class_nine_country
 * @property string $class_ten_school
 * @property string $class_ten_city
 * @property string $class_ten_country
 * @property string $class_eleven_school
 * @property string $class_eleven_city
 * @property string $class_eleven_country
 * @property string $suspended_from_school
 * @property string $suspended_details
 * @property string $languages_spoken
 * @property string $languages_spoken_other
 * @property string $support_admission_decsion
 * @property string $emergency_name
 * @property string $emergency_relation
 * @property string $emergency_contact
 * @property string $emergency_address
 * @property string $emergency_email
 * @property string $primary_contact
 * @property string $speaking_event
 * @property string $drama_theater
 * @property string $sports_continue
 * @property string $subject_selected
 * @property string $course_after_alevel
 * @property string $why_bvc
 * @property string $contribute_bvc
 * @property string $tenyears_fromnow
 * @property string $strength_weaknesses
 * @property string $exampe_leadership
 * @property string $essay_topic
 * @property string $essay_content
 * @property string $event_news
 * @property string $under_statement
 * @property string $experience_failure
 * @property string $photo_path
 * @property string $admin_path
 * @property integer $status
 * @property string $updated
 * @property string $create_date
 * 
 * @property StudentParent $StudentParent
 * @property Sibling $sibling
 * @property Sibling $siblingBVC
 * @property Academic $academic
 * @property Sports $sports
 * 
 *  */
class Student extends \yii\db\ActiveRecord
{
     public $verifyCode;
     public $imageFiles ;
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
            [['refrence_number', 'first_name', 'last_name', 'gender', 'date_of_birth', 
                'mobile', 'email', 'address',  'languages_spoken',  'emergency_name',
                'emergency_relation', 'emergency_contact', 'primary_contact',
                'class_nine_school', 'class_nine_city', 'class_nine_country', 'class_ten_school', 'class_ten_city', 'class_ten_country', 'class_eleven_school', 'class_eleven_city', 'class_eleven_country',
                'suspended_from_school', 'subject_selected', 'why_bvc',
                 'contribute_bvc', 'tenyears_fromnow', 'strength_weaknesses', 'exampe_leadership',
                'essay_content'], 'required'],
            [['cie_registration', 'gender', 'address', 'languages_spoken_other', 'suspended_from_school', 'suspended_details',  'support_admission_decsion', 'emergency_address', 'primary_contact', 'speaking_event', 'drama_theater', 'sports_continue', 'why_bvc', 'contribute_bvc', 'tenyears_fromnow', 'strength_weaknesses', 'exampe_leadership', 'essay_content', 'event_news', 'under_statement', 'experience_failure', 'admin_path'], 'string'],
            [['date_of_birth', 'updated', 'create_date'], 'date', 'format' => 'php:Y-m-d'],
            [['status'], 'integer'],
            [['address', 'suspended_details'], 'string', 'max' => 100],
            [['course_code', 'first_name', 'middle_name', 'last_name', 'refrence_number', 'cie_registration', 'nationality', 'class_nine_school', 'class_nine_city', 'class_nine_country', 'class_ten_school', 'class_ten_city', 'class_ten_country', 'class_eleven_school', 'class_eleven_city', 'class_eleven_country', 'emergency_name', 'emergency_relation', 'course_after_alevel', 'essay_topic', 'sports_continue'], 'string', 'max' => 30],
            [['phone'], 'number'],
            [['mobile'], 'number'],
            [['email'], 'unique'],
            [['email', 'emergency_email'], 'email'],
            [['email', 'emergency_email', 'photo_path'], 'string', 'max' => 50],
            [['mobile','emergency_contact', 'phone'], 'string', 'max' => 15],
            [['mobile'], 'string', 'max' => 11],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType'=>false, 
                'extensions' => 'png, jpg, jpeg', 'maxSize' => 2048000, 'tooBig' => 'Limit is 2MB'],
            ['verifyCode', 'required'],
            ['verifyCode', 'captcha','captchaAction'=>'/student-management/student/captcha'],
//           // removed in PDF by client
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'refrence_number' => 'Reference Number',
            'course_code' => 'ALVL',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'nationality' => 'Nationality',
            'address' => 'Address',
            'phone' => 'Telephone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'cie_registration' => 'CIE registration',
            'class_nine_school' => 'Name of School attended',
            'class_nine_city' => 'City',
            'class_nine_country' => 'Country',
            'class_ten_school' => 'Name of School attended',
            'class_ten_city' => 'City',
            'class_ten_country' => 'Country',
            'class_eleven_school' => 'Name of School attended',
            'class_eleven_city' => 'City',
            'class_eleven_country' => 'Country',
            'suspended_from_school' => 'Have you ever been suspended, expelled or removed from any school?',
            'suspended_details' => 'If yes please provide details.',
            'languages_spoken' => 'Languages Spoken',
            'languages_spoken_other' => 'Please list any other languages your speak',
            'support_admission_decsion' => 'Please provide us with any other
            information that you feel will assist the admissions committee in making its decision',
            'emergency_name' => 'Name',
            'emergency_relation' => 'Relation to the applicant',
            'emergency_contact' => 'Contact number',
            'emergency_address' => 'Address',
            'emergency_email' => 'Email',
            'primary_contact' => 'Who will be the primary contact for the school?',
            'speaking_event' => 'Have you participated in any public speaking events?',
            'drama_theater' => 'Have you participated in drama or theatre?',
            'sports_continue' => 'Do you wish to continue your involvement with co-curricular activities and sports if you attend Bay View College?',
            'subject_selected' => 'Please Select minimum 2 maximum 5 Subjects',
            'course_after_alevel' => 'What course of study do you wish to pursue after '
            . 'A Levels to Do you know what you plan to study at college or university, '
            . 'or an interest in a career. If yes, please provide details below:',
            'why_bvc' => 'Why do you want to attend Bay View College?',
            'contribute_bvc' => 'How can you as an individual contribute to Bay View College?',
            'tenyears_fromnow' => 'What do you expect to be doing ten years from now?',
            'strength_weaknesses' => 'What are your strengths and weaknesses?',
            'exampe_leadership' => 'Give an example of a time when you demonstrated leadership qualities.',
            'essay_topic' => 'Write an essay on ONE of the following topics (300 words maximum):',
            'essay_content' => 'Essay Content',
            'event_news' => 'Event News',
            'under_statement' => 'Under Statement',
            'experience_failure' => 'Experience Failure',
            'photo_path' => 'Please upload a passport photograph with a white background. The photo must not be more than 3 months old.',
            'imageFiles' => 'Please upload a passport photograph with a white background. The photo must not be more than 3 months old.',
            'admin_path' => 'Admin Path',
            'status' => 'Status',
            'updated' => 'Updated',
            'create_date' => 'Date',
        ];
    }
    
     public function upload()
    {
//        if ($this->validate()) {
            $this->photo_path->saveAs('uploads/' . $this->photo_path->baseName . '.' . $this->photo_path->extension);
            return true;
//        } else {
//            return false;
//        }
    }
    
//    function getSubjectSelected()
//    {
//        return explode(',', $this->subject_selected);
//    }
//
//    function setSubjectSelected(array $value)
//    {
//        $this->modules = implode(',', $value);
//    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentParent()
    {
        return $this->hasMany(StudentParent::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSibling()
    {
        return $this->hasMany(Sibling::className(), ['student_id' => 'id']);
    }
    
    public function getSiblingBvc()
    {
        return $this->hasMany(SiblingBvc::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcademic()
    {
        return $this->hasMany(Academic::className(), ['student_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSports()
    {
        return $this->hasMany(Sports::className(), ['student_id' => 'id']);
    }
    
    public function generateReceiptEmail() {
        
        Yii::$app->mailer->compose('/emailtemplates/receipt', [
//        'user' => Yii::$app->user->identity,
        'model' => $this,
        'parent' => $this->studentParent,
        'academic' => $this->academic,
        'sibling' => $this->sibling,
        'sports' => $this->sports,
        ]) // a view rendering result becomes the message body here
        ->setFrom(Yii::$app->params['adminEmail'] )
        ->setTo($this->email)
        ->setBcc('jawwad.software@gmail.com')
        ->setSubject(Yii::$app->params['receiptEmailSubject'])
        ->send();
    }
    
    public function beforeSave($insert){
        if (parent::beforeSave($insert)) {
        
              // for example
        try{    
            if(is_array($this->subject_selected) )
                $this->subject_selected = implode(',', $this->subject_selected);
            if(is_array($this->languages_spoken) )
                $this->languages_spoken = implode(',', $this->languages_spoken);
             $this->create_date = date('Y-m-d H:i:g'); // if you save dates as INT
             } catch (Exception $e){};
             return true;
        }
        return false;
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);    
         try {
                $this->generateReceiptEmail();
//                $session->setFlash('sentInvoice', 'Registration Receipt have successfully sent.');

            }  catch (Exception $e){
                Yii::warning('Problem in generation of invoice');
            };
        
//        return  parent::afterSave($insert);
    }
    
}
