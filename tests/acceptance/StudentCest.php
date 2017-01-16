<?php

use yii\helpers\Url as Url;

class StudentCest 
{
    public function _before(\AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/student-management/student/create'));
    }
    
    public function studentPageWorks(AcceptanceTester $I)
    {
        $I->wantTo('ensure that Student create form works');
        $I->see('A Level Application Form', 'h2');
        $I->dontSee('Powered by Yii Framework', 'h1');
    }

    /**
     * @email "emailnotValid"
     * @email "@email.com"
     * @email "great.com"
     * 
     * @param AcceptanceTester $I
     * @param \Codeception\Example $email
     */
    
    public function ensureEmailValidationWorks(AcceptanceTester $I) {
        
        $I->wantTo('ensure Email Validation works');
        
        $notEmail = "nonEmailText";
//        if(!is_null($email)) $notEmail = $email;
        $I->fillField('input[name="Student[email]"]', $notEmail);
//        $I->see('Father Details');
        $I->fillField('input[name="StudentParent[father][email]"]', $notEmail);
//        $I->see('Mother Details');
//        $I->click( '#ui-id-3');
//                        $I->click('label[for="studentparent-mother-email"]');
        
        $notNumber = "abc123";

        $I->fillField('input[name="Student[mobile]"]', $notNumber);
        $I->fillField('input[name="Student[phone]"]', $notNumber);

        $I->fillField('input[name="StudentParent[father][mobile]"]', $notNumber);
        $I->see('Submit online');
        $I->click('Submit online');
        $I->wait(1);

        $I->see('Email is not a valid email address.', '.field-student-email');
        
        $I->wantTo('ensure Phone and mobile Validation works');
        
        $I->see('Mobile must be a number.', '.field-student-mobile');

  
    }
    
    public function ensureFormValidationWorks(AcceptanceTester $I) {
        
        $I->expectTo('see validations errors');
        $I->see('Submit online');
        $I->click('Submit online');
        if (method_exists($I, 'wait')) {
            $I->wait(3); // only for selenium
        }
        $I->see('First Name cannot be blank.');
        $I->see('Last Name cannot be blank.');

    }
    /**
    *  _studentProvider
    */
    
 /**
    * @dataprovider studentProvider
    */
    public function ensureCreateStudentFormSubmits(AcceptanceTester $I, \Codeception\Example $example)
    {
        $student_data =  $example['student_data'];
        extract(  $student_data);
//        extract(['first_name'=>"2logix",
//                'middle_name'=>'server',
//                'last_name'=>'bayview',
//                'gender'=>'male',
//                'date_of_birth'=>'1999-08-09',
//                'nationality'=> 'pakistani',
//                'mobile' => '03332798582', 'email'=>"email@greatmail.com", 'languages_spoken'=>"urdu, english",
//                'emergency_name'=>'Ali Sh', 'emergency_relation' =>"brother", 'emergency_contact'=>'03332279845',
//                'emergency_address'=>"The House of thumler, Fine Street Luxury road Fonatic City Lego Land",
//                'emergency_email'=>'emergency@greammail.com', 'subject_selected'=>'Mathematics',
//                'why_bvc'=>"BCV IS great", 'essay_content'=>'An Essay to test my skills',
//                'parentArray'=>[
//                'student_id'=>'777', 'first_name'=>'parent F', 'last_name'=>'parent L', 'cnic_number'=>'22149874563',
//                'mobile'=>'03357896541'],
//
//                'verifyCode'=>'testme']);
//        
        $I->amGoingTo('try to fill with correct data');
        $I->wantTo('ensure Create Students works');
//        
        $I->fillField('input[name="Student[first_name]"]', $first_name);
        $I->fillField('input[name="Student[middle_name]"]', $middle_name);
        $I->fillField('input[name="Student[last_name]"]', $last_name);
        $I->selectOption('input[name="Student[gender]"]', $gender);
//        $I->selectOption('select[name="Student[gender]"]', $gender);
        $I->fillField('input[name="Student[date_of_birth]"]', $date_of_birth);
        $I->fillField('input[name="Student[nationality]"]', $nationality);
        $I->fillField('input[name="Student[mobile]"]', $mobile);
        $I->fillField('input[name="Student[email]"]', $email);
        $I->fillField('input[name="Student[cie_registration]"]', $cie_registration);
//        $I->fillField('input[name="Student[address]"]', $address);
        $I->fillField('textarea[name="Student[address]"]', $address);
//        $I->fillField('input[name="Student[first_name]"]', $first_name);
//        $I->click( '#ui-id-1');
       
        if(isset($class_nine_school) )  $I->fillField('input[name="Student[class_nine_school]"]', $class_nine_school);
        if(isset($class_nine_city))  $I->fillField('input[name="Student[class_nine_city]"]', $class_nine_city);
        if(isset($class_nine_country))  $I->fillField('input[name="Student[class_nine_country]"]', $class_nine_country);
        if(isset($class_ten_school))  $I->fillField('input[name="Student[class_ten_school]"]', $class_ten_school);
        if(isset($class_ten_city))  $I->fillField('input[name="Student[class_ten_city]"]', $class_ten_city);
        if(isset($class_ten_country))  $I->fillField('input[name="Student[class_ten_country]"]', $class_ten_country);
        if(isset($class_eleven_school))  $I->fillField('input[name="Student[class_eleven_school]"]', $class_eleven_school);
        if(isset($class_eleven_city))  $I->fillField('input[name="Student[class_eleven_city]"]', $class_eleven_city);
        if(isset($class_eleven_country))  $I->fillField('input[name="Student[class_eleven_country]"]', $class_eleven_country);
        if(isset($suspended_from_school))  $I->selectOption('input[name="Student[suspended_from_school]"]', $suspended_from_school);
        if(isset($suspended_details))  $I->fillField('textarea[name="Student[suspended_details]"]', $suspended_details);
        if(isset($support_admission_decsion))  $I->fillField('textarea[name="Student[support_admission_decsion]"]', $support_admission_decsion);
        
         $this->fillParent($I, 'father', $parentArray);
//        $I->click( 'Mother Details');
        $this->fillParent($I, 'mother', $parentArray);
//        $I->click( 'Guardian Details');
        $this->fillParent($I, 'guardian', $parentArray);
        
//        $I->fillField('textarea[name="Student[languages_spoken]"]', $languages_spoken);
        $I->fillField('input[name="Student[emergency_name]"]', $emergency_name);
        $I->fillField('input[name="Student[emergency_relation]"]', $emergency_relation);
        $I->fillField('input[name="Student[emergency_contact]"]', $emergency_contact);
        $I->fillField('textarea[name="Student[emergency_address]"]', $emergency_address);
        $I->fillField('input[name="Student[emergency_email]"]', $emergency_email);
        
        $I->fillField('input[name="SiblingBvc[0][name]"]', 'Tom n Jerry');
//        $I->fillField('input[name="SiblingBvc[0][class]"]', 'Prep 1');
        $I->selectOption('select[name="SiblingBvc[0][class]"]', 'Prep 1');
        $I->click('.add-item-sibling-bvc');
           $I->fillField('input[name="SiblingBvc[1][name]"]', 'Motoo Patlu');
//           $I->fillField('input[name="SiblingBvc[1][class]"]', 'Class 5');
           $I->selectOption('select[name="SiblingBvc[1][class]"]', 'Class 5');

        $I->fillField('input[name="Sibling[0][name]"]', 'Mashs Dear');
//        $I->selectOption('select[name="Sibling[0][class]"]', 'Not Applicable');
        $I->fillField('input[name="Sibling[0][class]"]', 'Not Applicable');
        $I->fillField('input[name="Sibling[0][age]"]', '10');
        $I->fillField('input[name="Sibling[0][assosiation]"]', 'PAD');
        
        $I->click('.add-item-sibling');
           $I->fillField('input[name="Sibling[1][name]"]', 'Mashs Dear One');
           $I->fillField('input[name="Sibling[1][class]"]', 'Class 9');
//           $I->selectOption('select[name="Sibling[1][class]"]', 'Class 9');

           $I->fillField('input[name="Sibling[1][age]"]', '13');
           $I->fillField('input[name="Sibling[1][assosiation]"]', 'PAD1');
        
        $I->selectOption('select[name="Academic[0][subject]"]', 'Biology');
        $I->selectOption('select[name="Academic[0][grade]"]', 'A');
        $I->click('.add-item-academic');
        
        $I->selectOption('select[name="Academic[1][subject]"]', 'Statistics');
        $I->selectOption('select[name="Academic[1][grade]"]', 'A');
        
        $I->fillField('input[name="Sports[0][activity_name]"]', 'Ping Pong');
        $I->selectOption('select[name="Sports[0][class]"]', 'Class 10');
        $I->fillField('input[name="Sports[0][position]"]', 'First');
        $I->fillField('textarea[name="Sports[0][details]"]', 'Great Achv');
//        
//        $I->fillField('textarea[name="Student[subject_selected]"]', $subject_selected);
        $I->checkOption("//input[@name='Student[languages_spoken][]' and @value='$languages_spoken']");
        $I->checkOption("//input[@name='Student[languages_spoken][]' and @value='Urdu']");
        
        $I->checkOption("//input[@name='Student[subject_selected][]' and @value='Chemistry']");
        $I->checkOption("//input[@name='Student[subject_selected][]' and @value='$subject_selected']");
        $I->checkOption("//input[@name='Student[subject_selected][]' and @value='Sociology']");
//        $I->checkOption("//input[@name='Student[subject_selected][]' and @value='Psychology']");
//        $I->wait(5);
//        if(isset($speaking_event)) $I->fillField('textarea[name="Student[speaking_event]"]', $speaking_event);
//        if(isset($drama_theater)) $I->fillField('textarea[name="Student[drama_theater]"]', $drama_theater);
//        if(isset($sports_continue)) $I->fillField('input[name="Student[sports_continue]"]', $sports_continue);
        if($why_bvc) $I->fillField('textarea[name="Student[why_bvc]"]', $why_bvc);
        if(isset($contribute_bvc)) $I->fillField('textarea[name="Student[contribute_bvc]"]', $contribute_bvc);
        if(isset($tenyears_fromnow)) $I->fillField('textarea[name="Student[tenyears_fromnow]"]', $tenyears_fromnow);
        if(isset($strength_weaknesses)) $I->fillField('textarea[name="Student[strength_weaknesses]"]', $strength_weaknesses);
        if(isset($example_leadership)) $I->fillField('textarea[name="Student[exampe_leadership]"]', $example_leadership);
        if($essay_content) $I->fillField('textarea[name="Student[essay_content]"]', $essay_content);
 
        // file is stored in 'tests/_data/prices.xls'
//        $I->attachFile('input[type="file"]', 'photograph.jpg');
//        $I->attachFile('input[name="Student[photo_path]" type="file"]',  'photograph.jpg');
//        $I->attachFile('input[name="Student[photo_path]"]', 'photograph.jpg');

       
        
//        $I->attachFile('input[name="Student[photo_path]"][type="file"] ', 'photograph.jpg');
//        $I->attachFile('input[name="Student[imageFiles]"][type="file"] ', 'test.xlsx');
        $I->fillField('input[name="Student[verifyCode]"]', $verifyCode); 
        if (method_exists($I, 'wait')) {
            $I->wait(1); // only for selenium
        }
        $I->dontSee('First Name cannot be blank.', '.field-student-first_name');
        $I->dontSee('Email is not a valid email address.');
        $I->dontSee('Emergency Contact is not a valid email address.');
        
//        $I->click('Create');
        if (method_exists($I, 'wait')) {
            $I->wait(3); // only for selenium
        }

//        $I->see("Only files with these extensions are allowed: png, jpg, jpeg.");
                 $I->attachFile('input[name="Student[imageFiles]"][type="file"] ', 'photograph.jpg');

         if (method_exists($I, 'wait')) {
            $I->wait(1); // only for selenium
        }
        
        $I->click('Submit online');
        if (method_exists($I, 'wait')) {
            $I->wait(3); // only for selenium
        }
        $I->see('Email "'.$email.'" has already been taken.');
        $I->fillField('input[name="Student[email]"]', $email_unique);
        
        $I->click('Submit online');
        if (method_exists($I, 'wait')) {
            $I->wait(3); // only for selenium
        }
        $I->see($first_name);
        $I->see("Print Preview");
        
        $this->ensureStudentViewWorks($I);

    }
    /**
     * @return array
     */
    protected function testProvider()
    {
        return[
            ['student_data'=>['first_name'=>"jeddy",
                'middle_name'=>'mike',
                'last_name'=>'merray',]],
            ['student_data'=>['first_name'=>"jeddy",
                'middle_name'=>'mike',
                'last_name'=>'merray',]],
            ['student_data'=>['first_name'=>"jeddy",
                'middle_name'=>'mike',
                'last_name'=>'merray',]],
            
        ];
    }
    /**
     * @return array
     */
    protected function studentProvider()
    {
        return [ 
            ['student_data'=>
                ['first_name'=>"Muhammad",
                'middle_name'=>'Naveed',
                'last_name'=>'naveed',
                'gender'=>'male',
                'date_of_birth'=>'2004-12-06',
                'nationality'=> 'pakistan',
                'address'=>'address',    
                'mobile' => '03332798582', 
                'address'=>"some address", 
                'cie_registration'=>"CIE-22789", 
                'email'=>"jawwad.software@gmail.com", 
                'email_unique'=>"jawwad2". rand(251, 1250).".software@gmail.com", 
//                'email_unique'=>"akmalkhanlaghri.mehran@pakisataneducation.com.pk", 
                'class_nine_school'=>'aaa',    
                'class_nine_city'=>'aaa',    
                'class_nine_country'=>'aaa',    
                'class_ten_school'=>'aaa',    
                'class_ten_city'=>'aaa',    
                'class_ten_country'=>'aaa',    
                'class_eleven_school'=>'aaa',    
                'class_eleven_city'=>'aaa',  
                'class_eleven_country'=>'aaa',  
                'suspended_from_school'=>"yes",
                'suspended_details'=>"aaaaadass",
                'languages_spoken'=>"English",
                'support_admission_decsion'=>"support admission",
                'emergency_name'=>'Ali Sh', 'emergency_relation' =>"brother", 'emergency_contact'=>'03332279845',
                'emergency_address'=>"The House of thumler, Fine Street Luxury road Fonatic City Lego Land",
                'emergency_email'=>'emergency@greammail.com', 'subject_selected'=>'Mathematics',
                'drama_theater'=>'drama theater', 'speaking_event'=>'public speaking',
                'coure_after_alevel'=> 'course after A level will be engineer',
                'why_bvc'=>"BCV IS great", 'essay_content'=>'An Essay to test my skills',
                'tenyears_fromnow' =>'tten years from now','strength_weakness'=>'strength',
                'strength_weaknesses' =>'tten years from now','strength_weakness'=>'strength',
                'contribute_bvc' =>'tten years from now','strength_weakness'=>'strength',
                'example_leadership' =>'tten years from now','strength_weakness'=>'strength',
                'sports_continue'=>'yes iTS ture',    
                'example_leadership'=>'example leader', 'easy_topic'=>'0',    
                'parentArray'=>[
                'student_id'=>'777', 'first_name'=>'parent F', 'last_name'=>'parent L', 'cnic_number'=>'22149874563',
                'mobile'=>'03357896541'],
                'photo_path'=>'abcsssssssssss.png',
                'verifyCode'=>'testme']
            ],
//            ['student_data'=>
//                ['first_name'=>"jeddy",
//                'middle_name'=>'mike',
//                'last_name'=>'merray',
//                'gender'=>'male',
//                'date_of_birth'=>'1999-08-09',
//                'nationality'=> 'pakistani',
//                'mobile' => '03332798582', 'email'=>"email@greatmail.com", 'languages_spoken'=>"urdu, english",
//                'emergency_name'=>'Ali Sh', 'emergency_relation' =>"brother", 'emergency_contact'=>'03332279845',
//                'emergency_address'=>"The House of thumler, Fine Street Luxury road Fonatic City Lego Land",
//                'emergency_email'=>'emergency@greammail.com', 'subject_selected'=>'Mathematics',
//                'why_bvc'=>"BCV IS great", 'essay_content'=>'An Essay to test my skills',
//                'parentArray'=>[
//                'student_id'=>'777', 'first_name'=>'parent F', 'last_name'=>'parent L', 'cnic_number'=>'22149874563',
//                'mobile'=>'03357896541'],
//
//                'verifyCode'=>'testme']
//            ],
//            ['student_data'=>
//                ['first_name'=>"feddy",
//                'middle_name'=>'mike',
//                'last_name'=>'merray',
//                'gender'=>'male',
//                'date_of_birth'=>'1999-08-09',
//                'nationality'=> 'pakistani',
//                'mobile' => '03332798582', 'email'=>"email@greatmail.com", 'languages_spoken'=>"urdu, english",
//                'emergency_name'=>'Ali Sh', 'emergency_relation' =>"brother", 'emergency_contact'=>'03332279845',
//                'emergency_address'=>"The House of thumler, Fine Street Luxury road Fonatic City Lego Land",
//                'emergency_email'=>'emergency@greammail.com', 'subject_selected'=>'Physics/Economics',
//                'why_bvc'=>"BCV IS great", 'essay_content'=>'An Essay to test my skills',
//                'parentArray'=>[
//                'student_id'=>'777', 'first_name'=>'parent F', 'last_name'=>'parent L', 'cnic_number'=>'22149874563',
//                'mobile'=>'03357896541'],
//
//                'verifyCode'=>'testme']
//            ]

                ];
    }
    
    protected function ensureStudentViewWorks($I) {
//        $I->see("Jhonupdate");
        $I->wantTo('ensure Student View works');

        $I->see("Parents");
        $I->click("Parents");

        $I->click("Father");
        if (method_exists($I, 'wait')) {
            $I->wait(2); // only for selenium
        }
        $I->see( 'fatherparent F' );
        $I->click("Parents");

        $I->click("Mother");
        if (method_exists($I, 'wait')) {
            $I->wait(2); // only for selenium
        }

        $I->see( 'motherparent F');
        $I->click("Parents");

        $I->click("Guardian");
        if (method_exists($I, 'wait')) {
            $I->wait(2); // only for selenium
        }

        $I->see('guardianparent F');
    }
    
    protected function fillParent($I, $type, $parentArray) {
        
        extract($parentArray);
//                 $I->wait(1);
        $I->see('Father Details');         
//        $I->fillField('input[name="StudentParent['.$type.'][student_id]"]', $student_id);
//        $I->selectOption('select[name="StudentParent['.$type.'][parent_type]"]', $type);
        $I->fillField('input[name="StudentParent['.$type.'][first_name]"]', $type.$first_name);
        $I->fillField('input[name="StudentParent['.$type.'][last_name]"]', $type.$last_name);
        $I->fillField('input[name="StudentParent['.$type.'][cnic_number]"]', $cnic_number);
//                $I->click('label[for="studentparent-'.$type.'-email"]');

//         $I->wait(1);
        $I->fillField('input[name="StudentParent['.$type.'][mobile]"]', $mobile);
        $I->fillField('input[name="StudentParent['.$type.'][email]"]', $type."@greatemail.com");
//        $I->fillField('input[name="StudentParent['.$type.'][email]"]', $essay_content);
        

    }
    
    public function _studentFormCanBeSubmitted(AcceptanceTester $I)
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
    
     /**
    * @dataprovider studentProvider
    */
   protected function staticPages(AcceptanceTester $I, \Codeception\Example $example)
    {
        $I->amOnPage($example['url']);
        $I->see($example['title'], 'h1');
        $I->seeInTitle($example['title']);
    }

    /**
     * @return array
     */
    protected function pageProvider()
    {
        return [
            ['url'=>"/", 'title'=>"Welcome"],
            ['url'=>"/info", 'title'=>"Info"],
            ['url'=>"/about", 'title'=>"About Us"],
            ['url'=>"/contact", 'title'=>"Contact Us"]
        ];
    }
}
