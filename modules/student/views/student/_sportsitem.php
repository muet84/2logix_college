<?php use wbraganca\dynamicform\DynamicFormWidget; ?>

<div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-soccer-ball"></i> Co-curricular and sports</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_sports', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-sports', // required: css class selector
                'widgetItem' => '.item-sports', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item-sports', // css class
                'deleteButton' => '.remove-item-sports', // css class
                'model' => $modelsSports[0],
                'formId' => 'w0',
                'formFields' => [
                    'activity_name',
                    'class',
                    'position',
                    'details',
                    'awards'
                ],
            ]); ?>
            <div class="alert alert-danger">
                    Please provide details of all co-curricular activity and sports that you have participated in since Class 9.
                    <br />
                    You will need to press the + key for each new activity entry
                </p>
            </div>

            <div class="container-items-sports"><!-- widgetContainer -->
            <?php foreach ($modelsSports as $i => $modelSports): ?>
                <div class="item-sports panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <!--<h3 class="panel-title pull-left">Co-curricular/Sports Activity</h3>-->
                        <div class="pull-right">
                            <button type="button" class="add-item-sports btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item-sports btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelSports->isNewRecord) {
                                echo Html::activeHiddenInput($modelSports, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($modelSports, "[{$i}]activity_name")->textInput(['maxlength' => true]) ?>
                            </div>
                        
                            <div class="col-sm-2">
                                <?php $classOptions =[
//                                    "Class 3"=>"Class 3 ", "Class 4"=>"Class 4",
//                                    "Class 5"=>"Class 5 ", "Class 6"=>"Class 6",
//                                    "Class 7"=>"Class 7 ", "Class 8"=>"Class 8",
                                    "Class 9"=>"Class 9 ", "Class 10"=>"Class 10",
                                    "Class 11"=>"Class 11"]?>
                                <?= $form->field($modelSports, "[{$i}]class")->dropDownList($classOptions ,['prompt' => "Select Class"]) ?>
                            </div>
                            
                       
                            <div class="col-sm-2">
                                <?= $form->field($modelSports, "[{$i}]position")->textInput(['maxlength' => true]) ?>
                            </div>
                        
                            <div class="col-sm-2">
                                <?= $form->field($modelSports, "[{$i}]awards")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelSports, "[{$i}]details")->textarea(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <button type="button" class="add-item-sports btn btn-success btn-md hide"><i class="glyphicon glyphicon-plus"></i>Add</button>
            <?php DynamicFormWidget::end(); ?>
            
    
    
    <?= $form->field($model, 'speaking_event')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'drama_theater')->textarea(['rows' => 6]) ?>
            
    <?= $form->field($model, 'sports_continue')->radioList([ 'yes' => 'Yes', 'no' => 'No', ] ) ?>
        </div>
    </div>
