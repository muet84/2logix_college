<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\StudentManagement\models\StudentParent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-parent-form">

    <?php //$form = ActiveForm::begin(); ?>
    <?php // $form = ActiveForm::begin(); ?>

    
    <?php //$model->parent_type = $type; 
        $addType = '['.$type.']';
    ?>
    <h3><?= ucfirst($type)?> Details</h3>
    <div class="row">
        <div class="col-md-6">     
    <?= $form->field($model, $addType.'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, $addType.'last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, $addType.'cnic_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, $addType.'occupation')->textInput(['maxlength' => true]) ?>
    
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-12">
    <?= $form->field($model, $addType.'company')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, $addType.'office_address')->textarea(['rows' => 3]) ?>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, $addType.'qualification')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6"> 
    <?= $form->field($model, $addType.'qualified_from')->textInput(['maxlength' => true]) ?>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, $addType.'mobile')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, $addType.'office_telephone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, $addType.'email')->textInput(['maxlength' => true]) ?>

    <?php $model->primary = "no"; ?>
    <? $form->field($model, $addType.'primary')->radioList([ 'yes' => 'Yes', 'no' => 'No', ], ['prompt' => '']) ?>

    <div class="form-group">
        <? Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php //ActiveForm::end(); ?>

</div>
