<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\student\models\Student */

$this->title = 'A Level Application Form';
if(!\Yii::$app->user->isGuest) $this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

   
    <div class="container-fluid main-cnt-lg header">
		<div class="row">
			<div class="col-xs-12 logo">
				<?= yii\bootstrap\Html::img('@web/imgs/logo.jpg', ['height'=>'110px', 'class'=>"img-responsive"])?>     
			</div>
		</div>
	</div>
	<div class="container-fluid main-cnt-lg  hero">
		<div class="row">
			<div class="col-xs-12">
				<h2><?= Html::encode($this->title) ?></h2>
			</div>
		</div>
	</div>
	<div class="container-fluid main-cnt-lg  hero-image">
		<div class="row">
			<div class="col-xs-12 pad0">
				<?= yii\bootstrap\Html::img('@web/imgs/img01.png', ['height'=>'110px', 'class'=>"img-responsive"])?>
			</div>
		</div>
	</div>
    <?= $this->render('_form', [
        'model' => $model,
        'modelParent' => $modelParent,
        'modelsSibling' => $modelsSibling,
        'modelsSiblingBvc' => $modelsSiblingBvc,
        'modelsAcademic' => $modelsAcademic,    
        'modelsSports' => $modelsSports    
    ]) ?>

</div>
