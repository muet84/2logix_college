<?php

use yii\helpers\Url as Url;

class StudentCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/index-test.php/student-management/student/create'));
    }
    
    public function studentPageWorks(FunctionalTester $I)
    {
        $I->wantTo('ensure that Student create form works');
        $I->see('Create Student', 'h1');
    }
    
    /**
     * @email "emailnotValid"
     * @email "@email.com"
     * @email "great.com"
     * 
     * @param FunctionalTester $I
     * @param \Codeception\Example $email
     */
    
    public function ensureEmailValidationWorks(FunctionalTester $I) {
        
        $I->wantTo('ensure Email Validation works');
        
        $notEmail = "nonEmailText";
//        if(!is_null($email)) $notEmail = $email;
        $I->fillField('input[name="Student[email]"]', $notEmail);
        $I->see('Father Details');
        $I->fillField('input[name="StudentParent[father][email]"]', $notEmail);
        $I->see('Mother Details');
        $I->click( '#ui-id-3');
//                        $I->click('label[for="studentparent-mother-email"]');
//                        $I->wait(2);
//        $I->click('Create');
        $I->see('Email is not a valid email address.');
  
    }
    
    public function ensureFormValidationWorks(FunctionalTester $I) {
        
        $I->expectTo('see validations errors');
        $I->click('Create');
        if (method_exists($I, 'wait')) {
            $I->wait(1); // only for selenium
        }
        $I->see('First Name cannot be blank.');
        $I->see('Last Name cannot be blank.');

    }

    /**
    *  _studentProvider
    */
    
    public function ensureCreateFormSubmits(FunctionalTester $I)
    {
        extract(['first_name'=>"jeddy",
                'middle_name'=>'mike',
                'last_name'=>'merray',
                'gender'=>'male',
                'date_of_birth'=>'1999-08-09',
                'nationality'=> 'pakistani',
                'mobile' => '03332798582', 'email'=>"email@greatmail.com", 'languages_spoken'=>"urdu, english",
                'emergency_name'=>'Ali Sh', 'emergency_relation' =>"brother", 'emergency_contact'=>'03332279845',
                'emergency_address'=>"The House of thumler, Fine Street Luxury road Fonatic City Lego Land",
                'emergency_email'=>'emergency@greammail.com', 'subject_selected'=>'Mathematics',
                'why_bvc'=>"BCV IS great", 'essay_content'=>'An Essay to test my skills',
                'parentArray'=>[
                'student_id'=>'777', 'first_name'=>'parent F', 'last_name'=>'parent L', 'cnic_number'=>'22149874563',
                'mobile'=>'03357896541'],

                'verifyCode'=>'testme']);
        
        $I->amGoingTo('try to fill with correct data');
        $I->wantTo('ensure Create Students works');
        
        $I->fillField('input[name="Student[first_name]"]', $first_name);
        $I->fillField('input[name="Student[last_name]"]', $last_name);
        $I->selectOption('input[name="Student[gender]"]', $gender);
        $I->fillField('input[name="Student[date_of_birth]"]', $date_of_birth);
        $I->fillField('input[name="Student[nationality]"]', $nationality);
        $I->fillField('input[name="Student[mobile]"]', $mobile);
        $I->fillField('input[name="Student[email]"]', $email);
        $I->fillField('input[name="Student[first_name]"]', $first_name);
//        $I->click( '#ui-id-1');
        $this->fillParent($I, 'father', $parentArray);
        $I->click( '#ui-id-3');
        $this->fillParent($I, 'mother', $parentArray);
        $I->click( '#ui-id-5');
        $this->fillParent($I, 'guardian', $parentArray);
        
        $I->fillField('textarea[name="Student[languages_spoken]"]', $languages_spoken);
        $I->fillField('input[name="Student[emergency_name]"]', $emergency_name);
        $I->fillField('input[name="Student[emergency_relation]"]', $emergency_relation);
        $I->fillField('input[name="Student[emergency_contact]"]', $emergency_contact);
        $I->fillField('textarea[name="Student[emergency_address]"]', $emergency_address);
        $I->fillField('input[name="Student[emergency_email]"]', $emergency_email);
        $I->checkOption('input[name="Student[subject_selected][]"]', $subject_selected);
        $I->fillField('textarea[name="Student[why_bvc]"]', $why_bvc);
        $I->fillField('textarea[name="Student[essay_content]"]', $essay_content);
        
        
        $I->selectOption('select[name="Academic[0][subject]"]', 'Biology');
        $I->selectOption('select[name="Academic[0][grade]"]', 'A');
        
        $I->fillField('input[name="Student[verifyCode]"]', $verifyCode);
        
        if (method_exists($I, 'wait')) {
            $I->wait(1); // only for selenium
        }
        $I->dontSee('First Name cannot be blank.', '.field-student-first_name');
        $I->dontSee('Email is not a valid email address.');

        $I->click('Create');
        
        if (method_exists($I, 'wait')) {
            $I->wait(35); // only for selenium
        }
        $I->see($first_name);
        $I->see("Update");
    }
    /**
     * @return array
     */
    public function _studentProvider()
    {
        return [
                ['first_name'=>"jeddy",
                'middle_name'=>'mike',
                'last_name'=>'merray',
                'gender'=>'male',
                'date_of_birth'=>'1999-08-09',
                'nationality'=> 'pakistani',
                'mobile' => '03332798582', 'email'=>"email@greatmail.com", 'languages_spoken'=>"urdu, english",
                'emergency_name'=>'Ali Sh', 'emergency_relation' =>"brother", 'emergency_contact'=>'03332279845',
                'emergency_address'=>"The House of thumler, Fine Street Luxury road Fonatic City Lego Land",
                'emergency_email'=>'emergency@greammail.com', 'subject_selected'=>'Mathematics',
                'why_bvc'=>"BCV IS great", 'essay_content'=>'An Essay to test my skills',
                'parentArray'=>[
                'student_id'=>'777', 'first_name'=>'parent F', 'last_name'=>'parent L', 'cnic_number'=>'22149874563',
                'mobile'=>'03357896541'],

                'verifyCode'=>'testme'],
            
//                ['first_name'=>"feddy",
//                'middle_name'=>'mike',
//                'last_name'=>'merray',
//                'gender'=>'male',
//                'date_of_birth'=>'1999-08-09',
//                'nationality'=> 'pakistani',
//                'mobile' => '03332798582', 'email'=>"email@greatmail.com", 'languages_spoken'=>"urdu, english",
//                'emergency_name'=>'Ali Sh', 'emergency_relation' =>"brother", 'emergency_contact'=>'03332279845',
//                'emergency_address'=>"The House of thumler, Fine Street Luxury road Fonatic City Lego Land",
//                'emergency_email'=>'emergency@greammail.com', 'subject_selected'=>'Engineer',
//                'why_bvc'=>"BCV IS great", 'essay_content'=>'An Essay to test my skills',
//                'parentArray'=>[
//                'student_id'=>'777', 'first_name'=>'parent F', 'last_name'=>'parent L', 'cnic_number'=>'22149874563',
//                'mobile'=>'03357896541'],
//
//                'verifyCode'=>'testme']

                ];
    }
    
    protected function fillParent($I, $type, $parentArray) {
        
        extract($parentArray);
                 $I->wait(1);
                 
        $I->fillField('input[name="StudentParent['.$type.'][student_id]"]', $student_id);
        $I->selectOption('select[name="StudentParent['.$type.'][parent_type]"]', $type);
        $I->fillField('input[name="StudentParent['.$type.'][first_name]"]', $type.$first_name);
        $I->fillField('input[name="StudentParent['.$type.'][last_name]"]', $type.$last_name);
        $I->fillField('input[name="StudentParent['.$type.'][cnic_number]"]', $cnic_number);
//                $I->click('label[for="studentparent-'.$type.'-email"]');

         $I->wait(1);
        $I->fillField('input[name="StudentParent['.$type.'][mobile]"]', $mobile);
        $I->fillField('input[name="StudentParent['.$type.'][email]"]', $type."@greatemail.com");
//        $I->fillField('input[name="StudentParent['.$type.'][email]"]', $essay_content);
        

    }
    
    public function _studentFormCanBeSubmitted(FunctionalTester $I)
    {
        $I->amGoingTo('submit contact form with correct data');
        $I->fillField('#contactform-name', 'tester');
        $I->fillField('#contactform-email', 'tester@example.com');
        $I->fillField('#contactform-subject', 'test subject');
        $I->fillField('#contactform-body', 'test content');
        $I->fillField('#contactform-verifycode', 'testme');

        $I->click('contact-button');
        
        $I->wait(2); // wait for button to be clicked

        $I->dontSeeElement('#contact-form');
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');
    }
}
