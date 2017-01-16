<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Parents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-parent-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Student Parent', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'student_id',
            'parent_type',
            'first_name',
            'last_name',
            // 'cnic_number',
            // 'occupation',
            // 'company',
            // 'office_address:ntext',
            // 'qualification',
            // 'qualified_from',
            // 'office_telephone',
            // 'mobile',
            // 'email:email',
            // 'primary',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
