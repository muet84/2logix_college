<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php if(Yii::$app->controller->action->id != "create"): ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->controller->action->id != "create"? yii\bootstrap\Html::img('@web/imgs/logo_1.jpg', ['height'=>'110px', 'class'=>"img-responsive"]):"",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar ',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
            [
            'label' => 'Student',
            'items' => [
                 ['label' => 'Create Student', 'url' =>[ '/student-management/student/create'], 'visible'=>  !Yii::$app->user->isGuest],
                 '<li class="divider"></li>',   
                 ['label' => 'Students List', 'url' =>[ '/student-management/student/index'], 'visible'=>  !Yii::$app->user->isGuest],
                 '<li class="divider"></li>', ], 'visible' => !\Yii::$app->user->isGuest],
            ['label' => 'Users', 'url' => ['/user/admin/index'],
                'visible' => !\Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/user/security/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/user/security/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    
    endif;
    ?>

    <div class="container">
        <? Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Bay View College <?= date('Y') ?></p>

        <p class="pull-right"><? Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
