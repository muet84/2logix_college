<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\bootstrap\Collapse;
use yii\captcha\Captcha;
use wbraganca\dynamicform\DynamicFormWidget;
use jlorente\remainingcharacters\RemainingCharacters;
/* @var $this yii\web\View */
/* @var $model app\modules\StudentManagement\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    table tr td{padding: 0 0px 0 4px; text-align: left; }
    table tr:first-child td{padding: 0 2px; text-align: center; }
    .gray_class { background-color: #d4d4d4}
</style>    
<div class="student-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' =>'true','options' => ['enctype' => 'multipart/form-data', 
            
           'layout' => 'horizontal',
            'action' => ['index'],
            'method' => 'get',
            'fieldConfig' => [
            'horizontalCssClasses' => [
            'label' => 'col-sm-2',
            'offset' => 'col-sm-offset-2',
            'wrapper' => 'col-sm-4',
                ],
            ], 
        ] ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 >
                <a data-toggle="collapse" href=".student-details">Student Details</a></h4></div>
        <div class="panel-body student-details collapse in"> 
            <?php $form->field($model, 'refrence_number')->textInput(['maxlength' => true]) ?>

            <?php $form->field($model, 'course_code')->textInput(['maxlength' => true]) ?>
            <div class="row">
                <div class="col-md-6">         
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
            </div>
                <div class="col-md-6">  
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6"> 
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">     
            <?= $form->field($model, 'gender')->radioList([ 'male' => 'Male', 'female' => 'Female', ], 
                    ['prompt' => '']) ?>
                </div>
            </div>
             <div class="row">
                <div class="col-md-6">
            <?php //$model->date_of_birth  = date('Y-m-d',strtotime('-15 y'));
                    print $form->field($model, 'date_of_birth', ['enableAjaxValidation' => true])->widget(\yii\jui\DatePicker::classname(), [
            //'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
             'clientOptions' =>['showAnim'=>'fold',
                                'changeMonth'=> true,
                                'changeYear'=> true,
                                'autoSize'=>true,
                                'defaultDate'=> "date('Y-m-d',strtotime('-20 y'))",//"-15y",
        //                        'minDate'=> "-25y", 'maxDate'=> "-10y"
                                ],    
        ]) ?>
            </div>
                 <div class="col-md-6">
            <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>
                 </div>
             </div>
            
            <div class="">
                <h3>Student primary contact details </h3>(please ensure that these are correct as
                Bay View College will use these to contact you)    
            </div>
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
            <div class="row">
                <div class="col-md-6"> 
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                </div>   
            </div> 
            <?= $form->field($model, 'email', ['enableAjaxValidation' => true])
                    ->textInput(['maxlength' => false]) ?>
            
            <?= $form->field($model, 'cie_registration', ['enableAjaxValidation' => true])
                    ->textInput(['maxlength' => false]) ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><a data-toggle="collapse" href=".student-attend">Other Student information</a></h4>
        </div>
    <div class="panel-body student-attend collapse in">	
            <h4>Previous School attended</h4>
            <p>
                Please provide us with the name of the school you have attended

for Class 9, Class 10, and Class 11. If you have appeared only as a private candidate, please write

PRIVATE under name of school attended and the city and country you appeared for your exams in.
            </p>
    
            <div class="row bg-success">
                <div class="col-md-2"><strong>Class 9</strong></div> 
                <div class="col-md-4"> 
            <?= $form->field($model, 'class_nine_school')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
            <?= $form->field($model, 'class_nine_city')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
            <?= $form->field($model, 'class_nine_country')->textInput(['maxlength' => true]) ?>
               </div>
            </div>
            <div class="row bg-info">
                <div class="col-md-2"><strong> Class 10</strong></div> 
                
                <div class="col-md-4">
            <?= $form->field($model, 'class_ten_school')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3"> 
            <?= $form->field($model, 'class_ten_city')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">    
            <?= $form->field($model, 'class_ten_country')->textInput(['maxlength' => true]) ?>
                 </div>
            </div>    
            <div class="row bg-warning">
                <div class="col-md-2"><strong> Class 11</strong></div> 
                
                <div class="col-md-4">   
            <?= $form->field($model, 'class_eleven_school')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">    
            <?= $form->field($model, 'class_eleven_city')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">    
            <?= $form->field($model, 'class_eleven_country')->textInput(['maxlength' => true]) ?>
                </div>
            </div>    
            <?php $model->suspended_from_school = 'no';?>
            <?= $form->field($model, 'suspended_from_school')->radioList([ 'yes' => 'Yes', 'no' => 'No', ],
                    ['prompt' => 'no']) ?>

            <?= $form->field($model, 'suspended_details')->textarea(['rows' => 3]) ?>
            <div class="row">
                <div class="col-md-4"> 
            <?= $form->field($model, 'languages_spoken')->checkboxList(['English'=>'English',
                    'Urdu'=>'Urdu', 'Sindhi'=>'Sindhi'],//, 'Other'=>'Other'  
                    ['rows' => 6]) ?>
                </div>
                <div class="col-md-8">
            <?= $form->field($model, 'languages_spoken_other')->textInput(['maxlength' => true]) ?>
                </div>
            </div>    
            <?= $form->field($model, 'support_admission_decsion')->textarea(['rows' => 3]) ?>

        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Parents Details</h4>
        </div>
        <div class="panel-body"> 
        <?php 

        echo $this->render('@app/modules/student/views/student-parent/_form',
                            ['model'=>$modelParent['mother'], 'form'=>$form, 'type'=>'mother']);
        echo $this->render('@app/modules/student/views/student-parent/_form', 
                            ['model'=>$modelParent['father'], 'form'=>$form, 'type'=>'father']);
        echo $this->render('@app/modules/student/views/student-parent/_form', 
                            ['model'=>$modelParent['guardian'], 'form'=>$form, 'type'=>'guardian']);
        ?>
        </div>
    </div>    
   <p>&nbsp;</p>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Person to contact in the event of an emergency</h4>
        </div>
    <div class="panel-body">    
        <div class="row">
            <div class="col-md-6">
        <?= $form->field($model, 'emergency_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
        <?= $form->field($model, 'emergency_relation')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
        <?= $form->field($model, 'emergency_contact')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
        <?= $form->field($model, 'emergency_email')->textInput(['maxlength' => false]) ?>
            </div>
        </div>    
        <?= $form->field($model, 'emergency_address')->textarea(['rows' => 3]) ?>
        
        
        </div>
    </div>
    
    
    <?php $model->primary_contact = 'father'?>
        <?= $form->field($model, 'primary_contact')->dropDownList([ 'father' => 'Father', 
            'mother' => 'Mother', 'guardian' => 'Guardian', ], ['prompt' => '']) ?>

    <?php 
    echo
    $this->render('_siblingitem_bvc', [
        'model' => $model,
        'modelsSiblingBvc' => $modelsSiblingBvc   ,
        'form'=>$form    
    ]) ?>
   
    <?php echo
    $this->render('_siblingitem', [
        'model' => $model,
        'modelsSibling' => $modelsSibling    ,
        'form'=>$form    
    ]) ?>
    
    <?= $this->render('_academicitem', [
        'model' => $model,
        'modelsAcademic' => $modelsAcademic    ,
        'form'=>$form    
    ]) ?>
    
    
    <?= $this->render('_sportsitem', [
        'model' => $model,
        'modelsSports' => $modelsSports    ,
        'form'=>$form    
    ]) ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Subject choices</h4>
        </div>
    <div class="panel-body">
        <div class="alert alert-danger">Please indicate your subject choices that you wish to pursue at Bay View College. You must select a
minimum of 2 subjects and a maximum of 5 subjects. You cannot select more than subject from each block.
        </div>
        <div class="row field-student-subject_selected">
            
            <div class="col-md-12">
                
            <?php 
            
            $subjects = [
                "Chemistry"=>"Chemistry",                "Accounts"=>"Accounts",
                "Mathematics"=>"Mathematics",
                "Physics"=>"Physics",               "Economics"=>"Economics", 
                "Bio"=>"Biology",                "Law"=>"Law",
                "Business Studies"=>"Business Studies",  
                "Psychology"=>"Psychology",
                "Sociology"=>"Sociology",
                "History"=>"History",                "Urdu"=>"Urdu",
                ];
            ?>
                
                <table   border= " lightgrey; 1px;" cellpadding="10" >
                    <tr>
                        <td class="col-md-1 gray_class"><strong>1</strong></td>
                        <td class="col-md-1" ><strong>2</strong></td>
                        <td class="col-md-1 gray_class"><strong>3</strong></td>

                        <td class="col-md-1" ><strong>4</strong></td>

                        <td class="col-md-1 gray_class"><strong>5</strong></td>
                        <td class="col-md-1" ><strong>6</strong></td>
                        <td class="col-md-1 gray_class"><strong>7</strong></td>
                        <td class="col-md-1" ><strong>8</strong></td>
                    </tr>
                    <tr>
                        <td class = "gray_class"><strong> 
               <?php print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Chemistry'], 'id'=>$subjects['Chemistry'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Chemistry'],$subjects['Chemistry']);
            ?></strong></td>
                        <td ><strong><?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Mathematics'], 'id'=>$subjects['Mathematics'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Mathematics'],$subjects['Mathematics']);?></strong></td>
                        <td class = "gray_class"><strong><?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Physics'], 'id'=>$subjects['Physics'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Physics'],$subjects['Physics']);?></strong></td>

                        <td><strong><?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Bio'], 'id'=>$subjects['Bio'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Bio'],$subjects['Bio']);?></strong></td>
                        
                        <td class = "gray_class"><strong><?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Business Studies'], 'id'=>$subjects['Business Studies'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Business Studies'],$subjects['Business Studies']);?></strong></td>

                        <td><strong><?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Psychology'], 'id'=>$subjects['Psychology'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Psychology'],$subjects['Psychology']);?></strong></td>
                        <td class = "gray_class"><strong><?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Sociology'], 'id'=>$subjects['Sociology'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Sociology'],$subjects['Sociology']);?></strong></td>
                        <td><strong><?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['History'], 'id'=>$subjects['History'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['History'],$subjects['History']);?></strong></td>
                        
                    </tr>
                    <tr>
                        <td class = "gray_class"><strong> <?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Accounts'], 'id'=>$subjects['Accounts'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Accounts'],$subjects['Accounts']);?></strong></td>
                        <td><strong></strong></td>
                        <td class = "gray_class"><strong></strong></td>
                        
                        <td><strong> <?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Economics'], 'id'=>$subjects['Economics'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Economics'],$subjects['Economics']);?></strong></td>

                        <td class = "gray_class"><strong></strong></td><td><strong> <?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Law'], 'id'=>$subjects['Law'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Law'],$subjects['Law']);?></strong></td>

                        <td class = "gray_class"><strong></strong></td>
                        
                        <td><strong> <?php
            
            print Html::checkbox('Student[subject_selected][]', false,
                        ['value'=>$subjects['Urdu'], 'id'=>$subjects['Urdu'],
                         'name'=>'Student[subject_selected][]'   
                            ]
                        );
                 print Html::label($subjects['Urdu'],$subjects['Urdu']);?></strong></td></strong></td>
                    </tr>
                </table><br />
               <?php 
            
            $subjects = [
                "Chemistry/Accounts"=>"Chemistry/Accounts",
                "Mathematics"=>"Mathematics",
                "Physics/Economics"=>"Physics/Economics",    "Bio/Law"=>"Bio/Law",
                "Business Studies"=>"Business Studies",    "Psychology"=>"Psycology",
                "Sociology"=>"Sociology",    "History/Urdu"=>"History/Urdu",
                ];
            ?>    
            <? $form->field($model, 'subject_selected')->checkboxList($subjects) ?>
            <? $form->field($model, 'subject_selected')->checkboxList([
                "Chemistry/Accounts"=>"Chemistry/Accounts",    "Mathematics"=>"Mathematics",
                "Physics/Economics"=>"Physics/Economics",    "Bio/Law"=>"Bio/Law",
                "Business Studies"=>"Business Studies",    "Psychology"=>"Psycology",
                "Sociology"=>"Sociology",    "History/Urdu"=>"History/Urdu",
                ]) ?>     
            </div>
            <div class="help-block"></div>
                </div>
        
            

            <div class="row">
                <div class="col-md-12">
            <?= $form->field($model, 'course_after_alevel')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div> 
    </div>
    <div class="panel panel-default">
       <div class="panel-heading">
           <h4>Short questions</h4>
       </div>
        <div class="panel-body">
            <div class="alert alert-danger"> Please answer each of the following 5 questions.
                Each answer has a 75 word word-limit.</div>  
            <?php $shortQuestionLength  = 350; ?>
         <?= $form->field($model, 'why_bvc')->widget(RemainingCharacters::classname(), [
                'type' => RemainingCharacters::INPUT_TEXTAREA,
                'text' => Yii::t('app', '{n} characters remaining'),
                'label' => [
                    'tag' => 'p',
//                    'id' => 'my-counter',
                    'class' => 'counter pull-right',
                    'invalidClass' => 'error'
                ],
                'options' => [
                    'rows' => '3',
                    'class' => 'form-control',
                    'maxlength' => $shortQuestionLength,
//                    'placeholder' => Yii::t('app', 'Essay Content')
                ]
            ]); ?> 

         <?= $form->field($model, 'contribute_bvc')->widget(RemainingCharacters::classname(), [
                'type' => RemainingCharacters::INPUT_TEXTAREA,
                'text' => Yii::t('app', '{n} characters remaining'),
                'label' => [
                    'tag' => 'p',
//                    'id' => 'my-counter',
                    'class' => 'counter pull-right',
                    'invalidClass' => 'error'
                ],
                'options' => [
                    'rows' => '3',
                    'class' => 'form-control',
                    'maxlength' => $shortQuestionLength,
//                    'placeholder' => Yii::t('app', 'Essay Content')
                ]
            ]); ?>

         <?= $form->field($model, 'tenyears_fromnow')->widget(RemainingCharacters::classname(), [
                'type' => RemainingCharacters::INPUT_TEXTAREA,
                'text' => Yii::t('app', '{n} characters remaining'),
                'label' => [
                    'tag' => 'p',
//                    'id' => 'my-counter',
                    'class' => 'counter pull-right',
                    'invalidClass' => 'error'
                ],
                'options' => [
                    'rows' => '3',
                    'class' => 'form-control',
                    'maxlength' => $shortQuestionLength,
//                    'placeholder' => Yii::t('app', 'Essay Content')
                ]
            ]); ?> 

         <?= $form->field($model, 'strength_weaknesses')->widget(RemainingCharacters::classname(), [
                'type' => RemainingCharacters::INPUT_TEXTAREA,
                'text' => Yii::t('app', '{n} characters remaining'),
                'label' => [
                    'tag' => 'p',
//                    'id' => 'my-counter',
                    'class' => 'counter pull-right',
                    'invalidClass' => 'error'
                ],
                'options' => [
                    'rows' => '3',
                    'class' => 'form-control',
                    'maxlength' => $shortQuestionLength,
//                    'placeholder' => Yii::t('app', 'Essay Content')
                ]
            ]); ?> 

         <?= $form->field($model, 'exampe_leadership')->widget(RemainingCharacters::classname(), [
                'type' => RemainingCharacters::INPUT_TEXTAREA,
                'text' => Yii::t('app', '{n} characters remaining'),
                'label' => [
                    'tag' => 'p',
//                    'id' => 'my-counter',
                    'class' => 'counter pull-right',
                    'invalidClass' => 'error'
                ],
                'options' => [
                    'rows' => '3',
                    'class' => 'form-control',
                    'maxlength' => $shortQuestionLength,
//                    'placeholder' => Yii::t('app', 'Essay Content')
                ]
            ]); ?> 
        </div>
    </div>
    <div class="panel panel-default">
       <div class="panel-heading">
           <h4>Personal Statement</h4>
       </div>
        <div class="panel-body">
            <p>
             Please note if you are submitting your personal statement online, you will be required to bring your

latest English Language exercise book with you. Please ensure that this has a reasonable amount of

written work done over the academic year in it.   
            </p>
            <?php 
            $model->essay_topic = 0;

            $essayTopicOptions = [
                '0' =>'Describe a current event that you have read about in the newspaper'
                . ' or heard on the news. How did you feel about this event and why?',
                '1' =>'Tolerance is critical to the progress of a society".'
                . ' What do you understand by this statement and do you agree with it',
                '2' =>'"Picking up the pieces". Recount an incident or time when you experienced failure.'
                . ' How did it affect you, and what did you learn from the experience?',
            ]?>
            <?= $form->field($model, 'essay_topic')->radioList($essayTopicOptions, 
                    ['prompt' => "Select Class"]) ?>

            <? $form->field($model, 'essay_content')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'essay_content')->widget(RemainingCharacters::classname(), [
                'type' => RemainingCharacters::INPUT_TEXTAREA,
                'text' => Yii::t('app', '{n} characters remaining'),
                'label' => [
                    'tag' => 'p',
//                    'id' => 'my-counter',
                    'class' => 'counter pull-right',
                    'invalidClass' => 'error'
                ],
                'options' => [
                    'rows' => '6',
                    'class' => 'form-control',
                    'maxlength' => 1500,
//                    'placeholder' => Yii::t('app', 'Essay Content')
                ]
            ]); ?>
             
        </div>
    </div>     
<div class="panel panel-default">
       <div class="panel-heading">
           <h4>Photograph</h4>
       </div>
        <div class="panel-body">
            <?= $form->field($model, 'imageFiles')->fileInput() ?>
        </div></div>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div>'
                                  . '<div class="col-lg-6">{input}</div>',
                                'captchaAction' => '/student-management/student/captcha'
                            ]) ?>
   
   <div>
       <h4>List of documents to bring to the College at the time of Interview</h4>
       
        <ol class="text-black">
                <li>Report cards from Class 9 to 11</li>
                <li>CIE Certificates  (original and photocopy)</li>
                <li>Any awards or recognitions received</li>
                <li>4 Photographs on white background</li>
                <li>Personal Essay (Topics mentioned above)</li>
                <li>Copies of B-form/CNIC</li>
                <li>Sealed Principals Report and Teachers Recommendation (download template from BVC website)</li>
                <li>Any other documents you wish to share with the admissions committee</li>
        </ol>
       
   </div>
   
   <div class="col-md-12"> 
   
				
    </div>
				
			
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 >
                <a data-toggle="collapse" href=".disclaimer">Disclaimer</a></h4></div>
        <div class="panel-body disclaimer collapse in"> 
				
				<p class="text-black text-justify text-wrap">
                                    <strong>By clicking the submit button, I/we do hereby declare that 
                                        all the details provided above are true. 
                                        If any misinformation is found at any stage of the application,
                                        my registration may be cancelled and any action taken by 
                                        Bay View College will be accepted by me/us. 
                                        We agree to abide by all rules and regulations of Bay View College,
                                        including any additions or amendments to the rules and regulations.
                                    </strong></p>
			</div>
    </div>    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit online' : 'Update', ['name'=>'student-btn',
            'class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
