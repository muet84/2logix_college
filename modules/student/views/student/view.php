<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\modules\StudentManagement\models\Student */

$this->title = $model->first_name. " ". $model->last_name. "(".$model->refrence_number.")";
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Print Preview', ['view', 'id' => $model->id, 'printView'=>'true'], ['class' => 'btn btn-primary']) ?>
        <? Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

  <?php  echo Tabs::widget([
    'items' => [
        [
            'label' => 'Student Details',
            'content' => DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'refrence_number',
            'first_name',
            'last_name',
            'gender',
            'date_of_birth',
            'nationality',
            'address:ntext',
            'phone',
            'mobile',
            'email:email',
            'cie_registration',
            'class_nine_school',
            'class_nine_city',
            'class_nine_country',
            'class_ten_school',
            'class_ten_city',
            'class_ten_country',
            'class_eleven_school',
            'class_eleven_city',
            'class_eleven_country',
            'suspended_from_school',
            'suspended_details:ntext',
            'languages_spoken:ntext',
            'support_admission_decsion:ntext',
            'emergency_name',
            'emergency_relation',
            'emergency_contact',
            'emergency_address:ntext',
            'emergency_email:email',
            'primary_contact',
            'speaking_event:ntext',
            'drama_theater:ntext',
            'sports_continue',
            'subject_selected:ntext',
            'course_after_alevel',
            'why_bvc:ntext',
            'contribute_bvc:ntext',
            'tenyears_fromnow:ntext',
            'strength_weaknesses:ntext',
            'exampe_leadership:ntext',
//            'essay_topic',
            'essay_content:ntext',
            ['attribute' => 'photo_path',
             'label'=>'Photograph', 
             'format'=>'raw',    
             'value' => (($model->photo_path!="" ) && file_exists("uploads/thumbs/".$model->photo_path))?
                        Html::img("@web/uploads/thumbs/".$model->photo_path)
                : "Image not Available" 
            ] ,
//            'photo_path',
//            'admin_path:ntext',
            
//            'updated',
            'create_date:datetime',
        ],
    ]),
            'active' => true
        ],
//        [
//            'label' => 'Two',
//            'content' => 'Anim pariatur cliche...',
////            'headerOptions' => [...],
//            'options' => ['id' => 'myveryownID'],
//        ],
//        [
//            'label' => 'Example',
//            'url' => 'http://www.example.com',
//        ],
        [
            'label' => 'Parents',
//            'visible'=>FALSE,
            'items' => [
                 
                 [
                     'label' => 'Mother',
                     'content' => $this->render('@app/modules/student/views/student-parent/view_detail', 
                        ['model'=>$modelParent['mother'], 'form'=>$form, 'type'=>'mother']),
                 ],
                [
                     'label' => 'Father',
                     'content' => $this->render('@app/modules/student/views/student-parent/view_detail', 
                        ['model'=>$modelParent['father'], 'form'=>$form, 'type'=>'father']),
                 ],
                 [
                     'label' => 'Guardian',
//                     'url' => 'http://www.example.com',
                     'content' => $this->render('@app/modules/student/views/student-parent/view_detail', 
                        ['model'=>$modelParent['guardian'], 'form'=>$form, 'type'=>'guardian']),
                 ],
            ],
        ],
    ],
]);?>
    
</div>
