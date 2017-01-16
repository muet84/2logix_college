<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use mickgeek\actionbar\Widget as ActionBar;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>  <?php 
    Yii::$container->set('yii\data\Pagination', [
   'pageSizeLimit' => [1, 200],
]);
    ?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        
   <div class="col-md-4">
        <?= Html::a('Create Student', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Export All to Excel', ['excel-export'], ['class' => 'btn btn-info']) ?>
    </div>     
        <?php print ActionBar::widget([
            'grid' => 'student-grid',
            'options' => ['class' => "col-md-8"],

                'templates' => [
                '{bulk-actions}' => ['class' => 'pull-right col-xs-4 '],
        //        '{create}' => ['class' => 'btn btn-success col-xs-8 text-right'],
            ],
            'bulkActionsItems' => [
//                'Update Status' => [
//                    'status-active' => 'Active',
//                    'status-blocked' => 'In Active',
//                ],
                'Batch Print'=>['batch-print'=>'Print'],
                'Excel Export'=>['batch-export'=>'Export']
                
//                'General' => ['general-delete' => 'Delete'],
            ],
            'bulkActionsOptions' => [
        'options' => [
//            'status-active' => [
//                'url' => Url::toRoute(['update-status', 'status' => 'active']),
//                'disabled' => !Yii::$app->user->can('updateUserStatus'),
//            ],
//            'status-blocked' => [
//                'url' => Url::toRoute(['update-status', 'status' => 'blocked']),
//                'disabled' => !Yii::$app->user->can('updateUserStatus'),
//            ],
            'batch-print' => ['url' => Url::toRoute(['batch-print']),],
            'batch-export' => ['url' => Url::toRoute(['excel-export']),]
        ]
        ,'class' => 'form-control'],
        ]) ?>
    </div>
<?php Pjax::begin([
				'id'=>'student-grid-pjax',
			]); ?>    <?= GridView::widget([
        'id'=>'student-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => 'select[name="per-page"]',
        'layout'=>"{summary}\n{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn', 'options'=>['style'=>'width:10px'] ],

//            'id',
            ['attribute' => 'refrence_number',
             'options'=>[
                            'width'=>'200px',
                    ],   
                ],
//            'course_code',
            ['attribute' => 'first_name',
//             'header' =>'Firtname middle name'   ,
             'value' =>function($model) { return $model->first_name." ".$model->middle_name;},  
             'options'=>[
                        'width'=>'100px',
                    ],   
            ],
//            ['attribute' => 'middle_name',
//             'options'=>[
//                        'width'=>'25px',
//                    ],   
//            ],
            ['attribute' => 'last_name',
             'options'=>[
                        'width'=>'25px',
                    ],   
            ],
//             'gender',
            ['attribute' => 'gender',
             'options'=>[
                        'width'=>'25px',
                    ],   
            ],
            // 'date_of_birth',
            // 'nationality',
            // 'address:ntext',
            // 'phone',
             'mobile',
             'email:email',
            // 'class_nine_school',
            // 'class_nine_city',
            // 'class_nine_country',
            // 'class_ten_school',
            // 'class_ten_city',
            // 'class_ten_country',
            // 'class_eleven_school',
            // 'class_eleven_city',
            // 'class_eleven_country',
            // 'suspended_from_school',
            // 'suspended_details:ntext',
            // 'languages_spoken:ntext',
            // 'support_admission_decsion:ntext',
            // 'emergency_name',
            // 'emergency_relation',
            // 'emergency_contact',
            // 'emergency_address:ntext',
            // 'emergency_email:email',
            // 'primary_contact',
            // 'speaking_event:ntext',
            // 'drama_theater:ntext',
            // 'sports_continue',
            // 'subject_selected:ntext',
            // 'course_after_alevel',
            // 'why_bvc:ntext',
            // 'contribute_bvc:ntext',
            // 'tenyears_fromnow:ntext',
            // 'strength_weaknesses:ntext',
            // 'exampe_leadership:ntext',
            // 'essay_topic',
            // 'essay_content:ntext',
            // 'event_news:ntext',
            // 'under_statement:ntext',
            // 'experience_failure:ntext',
            // 'photo_path',
            // 'admin_path:ntext',
            [
            'attribute' => 'status',
            'format'=>'raw',    
            'value' => function($model) { return $model->status == '1' ? 
                            "<span class='label label-success'>Viewed</span>" : "<span class='label label-danger'>New</span>";},
            'filter' =>   Html::dropdownList(
            'StudentSearch[status]',$_GET['StudentSearch']['status'],
            ['0'=> 'New', '1'=>'Viewed'],        
            ['class'=>'form-control', 'prompt'=>'Select Status']
            )     
            ],
            // 'updated',
             'create_date:date',

            
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}',//&nbsp;{delete}
                'headerOptions' => ['style' => 'width:7%']
                ],
            
        ],
    ]); ?>
  
    <div class="col-md-2 pull-right" 
        <?php if( $dataProvider->getPagination()->pageCount > 1){?>style="margin-top: -73px"<?php }?> > 
        <?php echo \nterms\pagesize\PageSize::widget([
            'template' =>'{label}{list} ',
            'label'=> 'Items per page',
            'options' => ['class' =>'form-control' ],
            'labelOptions'=>['class' =>'control-label'], ]); ?>
    </div>    
<?php Pjax::end(); ?></div>
