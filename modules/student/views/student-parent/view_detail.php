<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\StudentManagement\models\StudentParent */

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Student Parents', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'student_id',
//            'parent_type',
            'first_name',
            'last_name',
            'cnic_number',
            'occupation',
            'company',
            'office_address:ntext',
            'qualification',
            'qualified_from',
            'office_telephone',
            'mobile',
            'email:email',
//            'primary',
        ],
    ]) ?>