<?php use wbraganca\dynamicform\DynamicFormWidget; ?>

<div class="panel panel-default">
        <div class="panel-heading"><h4> Academics</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_academic', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-academic', // required: css class selector
                'widgetItem' => '.item-academic', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item-academic', // css class
                'deleteButton' => '.remove-item-academic', // css class
                'model' => $modelsAcademic[0],
                'formId' => 'w0',
                'formFields' => [
                    'class',
                    'subject',
                    'grade',
                    'class_nine_first_term',
                    'class_nine_second_term',
                    'class_ten_first_term',
                    'class_ten_second_term',
                    'class_eleven_first_term',
                    'class_eleven_second_term',
                ],
            ]); ?>
            <div class="alert alert-danger">
 
1. Please provide your grades for all subjects that you have studied in Class 9, Class 10 and Class 11.
<br />
2. You must Select all the O Level/IGCSE subjects you are going to appear for in the upcoming

examinations or have already taken in the past from the list available.
<br />
3. If you do not have complete grades for a subject for any reason, you must still select that subject to

indicate that you already have or will be appearing for that examination and select PLANNED from

the DROPDOWN menu.
<br />
4. If you have taken a subject in one class only, please still select and enter the grades for that class

and leave blank for the classes you have not taken it. For example, if you have done Sociology in

Class 10 but not in Class 9, please select Sociology and enter your grades that you have for Class 10.
<br />
5. You will need to press the + key for each new subject entry.
<br />
6. Please ensure that the information entered is correct and matches your report card or result sheet.
            </div>
            <div class="container-items-academic"><!-- widgetContainer -->
            <?php foreach ($modelsAcademic as $i => $modelAcademic): ?>
                <div class="item-academic panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <!--<h3 class="panel-title pull-left">Academic</h3>-->
                        <div class="pull-right">
                            <button type="button" class="add-item-academic btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item-academic btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelAcademic->isNewRecord) {
                                echo Html::activeHiddenInput($modelAcademic, "[{$i}]id");
                            }
                        ?>
                        
                        <div class="row">
                            
                            <div class="col-sm-12">
                               <?php
                                    $subjectOptions =[
                                      
                                        'Additional Maths'=>"Additional Maths",
                                        "Art"=>"Art",
                                        "Biology"=>"Biology",
                                        "Business Studies"=>"Business Studies",
                                        "Chemistry"=>"Chemistry",
                                        "Computer Studies"=>"Computer Studies",
                                        "Economics"=>"Economics",
                                        "English Language"=>"English Language",
                                        "English Literature"=>"English Literature",
                                        "History"=>"History",
                                        "Islamiyat"=>"Islamiyat",
                                        "Mathematics"=>"Mathematics",
                                        "Pakistan Studies"=>"Pakistan Studies",
                                        "Physics"=>"Physics",
                                        "Sociology"=>"Sociology",
                                        "Statistics"=>"Statistics",
                                        "Urdu"=>"Urdu",
                                        "Other"=>"Other",
                                    ];
                               ?>
                                <?= $form->field($modelAcademic, "[{$i}]subject")->dropDownList($subjectOptions ,
                                        ['prompt' => "Select Subject", 'class'=>'form-control subject-dd']) ?>
                            </div>
                        
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-3 text-center bg-info"><strong>Class 9</strong>
                            <div class="row">
                            
                                <div class="col-sm-6 bg-info">
                                    First Tem Overall %
                                </div>
                                <div class="col-sm-6 bg-info">
                                    Second Tem Overall %
                                </div>
                            
                            </div>    
                                
                                <div class="row">
                                    <div class="col-sm-6 bg-info">
                                <?= $form->field($modelAcademic, "[{$i}]class_nine_first_term",['template' => '<div class=\"\">{input}</div><div class=\"\">{error}</div>'])->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6 bg-info">
                                <?= $form->field($modelAcademic, "[{$i}]class_nine_second_term", ['template' => '<div class=\"\">{input}</div><div class=\"\">{error}</div>'])->textInput(['maxlength' => true]) ?>
                                </div> 
                                    
                                </div>   
                            
                            </div>
                            <div class="col-sm-3 text-center bg-danger "><strong>Class 10</strong>
                            <div class="row">
                            
                                <div class="col-sm-6 bg-danger">
                                    First Tem Overall %
                                </div>
                                <div class="col-sm-6 bg-danger">
                                    Second Tem Overall %
                                </div>
                            
                            </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                <?= $form->field($modelAcademic, "[{$i}]class_ten_first_term",['template' => '<div class=\"\">{input}</div><div class=\"\">{error}</div>'])->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6 ">
                                <?= $form->field($modelAcademic, "[{$i}]class_ten_second_term", ['template' => '<div class=\"\">{input}</div><div class=\"\">{error}</div>'])->textInput(['maxlength' => true]) ?>
                                </div> 
                                    
                                </div>    
                            
                            </div>
                            <div class="col-sm-3 text-center bg-success"><strong>Class 11</strong>
                            
                            <div class="row">
                            
                                <div class="col-sm-6 bg-success">
                                    First Tem Overall %
                                </div>
                                <div class="col-sm-6 bg-success">
                                    Second Tem Overall %
                                </div>
                            
                            </div>
                                <div class="row">
                                     <div class="col-sm-6 ">
                                <?= $form->field($modelAcademic, "[{$i}]class_eleven_first_term",['template' => '<div class=\"\">{input}</div><div class=\"\">{error}</div>'])->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6 ">
                                <?= $form->field($modelAcademic, "[{$i}]class_eleven_second_term", ['template' => '<div class=\"\">{input}</div><div class=\"\">{error}</div>'])->textInput(['maxlength' => true]) ?>
                                </div>
                                    
                                </div>    
                            </div>
                            <div class="col-sm-3">
                                    <?php $gradeOptions = [ "A*"=>"A*", "A"=>"A", "B"=>"B", "C"=>"C", "D"=>"D", "E"=>"E", "F"=>"F", "U"=>"U" ]?>
                                    <?= $form->field($modelAcademic, "[{$i}]grade")->dropDownList($gradeOptions,['prompt' => "Select Grade"]) ?>
                            </div>
                            
                            
                            
                        </div>    
                            
                        <!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
                
            </div>
            <button type="button" class="add-item-academic btn btn-success btn-md hide"> <i class="glyphicon glyphicon-plus"></i> Add</button>
            <?php DynamicFormWidget::end(); ?>
            
        </div>
    </div>
