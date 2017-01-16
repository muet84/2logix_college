<?php use wbraganca\dynamicform\DynamicFormWidget; ?>

<div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-group"></i>Sibling Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_sibling', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-sibling', // required: css class selector
                'widgetItem' => '.item-sibling', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item-sibling', // css class
                'deleteButton' => '.remove-item-sibling', // css class
                'model' => $modelsSibling[0],
                'formId' => 'w0',
                'formFields' => [
                    'name',
                    'class',
                    'age',
                    'assisiation'
                ],
            ]); ?>
            <div class="alert alert-danger">
                Please tell us about any other siblings not at Bay View High School or College
            </div>
            <div class="container-items-sibling"><!-- widgetContainer -->
            <?php foreach ($modelsSibling as $i => $modelSibling): ?>
                <div class="item-sibling panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Sibling</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item-sibling btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item-sibling btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelSibling->isNewRecord) {
                                echo Html::activeHiddenInput($modelSibling, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                        <?= $form->field($modelSibling, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelSibling, "[{$i}]age")->textInput(['maxlength' => true]) ?>
                            </div>
                       
                            <div class="col-sm-3">
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
                                <?= $form->field($modelSibling, "[{$i}]assosiation")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelSibling, "[{$i}]class")->textInput(['maxlength' => true]);
//                                        dropDownList($classOptions ,['prompt' => "Select Class"]) ?>
                            </div>
                        </div><!-- .row -->
                        
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <button type="button" class="add-item-sibling btn btn-success btn-md hide"><i class="glyphicon glyphicon-plus"></i>Add</button>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
