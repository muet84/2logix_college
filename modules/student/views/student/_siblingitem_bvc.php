<?php use wbraganca\dynamicform\DynamicFormWidget; 
//use yii\helpers\Html;
//$modelsSiblingBVC = $modelsSiblingBVC;?>

<div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-group"></i> Sibling(s) studying at Bay View High School or Bay View College</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_sibling_bvc', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-sibling-bvc', // required: css class selector
                'widgetItem' => '.item-sibling-bvc', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item-sibling-bvc', // css class
                'deleteButton' => '.remove-item-sibling-bvc', // css class
                'model' => $modelsSiblingBvc[0],
                'formId' => 'w0',
                'formFields' => [
                    'name',
                    'class',
//                    'age',
//                    'assisiation'
                ],
            ]); ?>
            <div class="alert alert-danger">
                Please let us know if you have any siblings studying or who have studied at any Bay View High School or College.
            </div>
            <div class="container-items-sibling-bvc"><!-- widgetContainer -->
            <?php  foreach ($modelsSiblingBvc as $i => $modelSiblingB): ?>
                <div class="item-sibling-bvc panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Sibling(s) At Bay View High School or College</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item-sibling-bvc btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item-sibling-bvc btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelSiblingB->isNewRecord) {
                                echo Html::activeHiddenInput($modelSiblingB, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                        <?= $form->field($modelSiblingB, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                            </div>
                            
                       
                            <div class="col-sm-6">
                                <?php
                                $classOptions =[
                                    'Not Applicable' => 'Not Applicable',
                                    'Reception' => 'Reception',
                                    'Prep 1'=>'Prep 1',              'Prep 2'=>'Prep 2',                  'Class 1'=>'Class 1',
                                    'Class 2'=>'Class 2',            'Class 3'=>'Class 3',                'Class 4'=>'Class 4',
                                    'Class 5' =>'Class 5',           'Class 6'=>'Class 6',                'Class 7'=>'Class 7',
                                    'Class 8'=>'Class 8',            'Class 9'=>'Class 9',                'Class 10'=>'Class 10',  
                                    'Class 11'=>'Class 11',          'A Level First Year'=>'A Level First Year',     
                                    'A Level Second Year'=>'A Level Second Year',          'IFP'=>'IFP',               
                                    'UOL'=>'UOL',        'Graduated'=>'Graduated'
                                    
                                    
                                ]
                                ?>
                                <?= $form->field($modelSiblingB, "[{$i}]class")->dropDownList($classOptions ,['prompt' => "Select Class"]) ?>
                             
                            </div>
                        </div><!-- .row -->
                        
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <button type="button" class="add-item-sibling-bvc btn btn-success btn-md hide"><i class="glyphicon glyphicon-plus"></i>Add</button>    
            
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
