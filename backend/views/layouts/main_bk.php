<?php
use backend\assets\AppAsset;
use common\widgets\Alert;
use common\widgets\Nav;
use common\widgets\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$this->registerJs("Metronic.init();");
$this->registerJs("Layout.init();");
$tilte = Yii::t('app', "CMS Viettel Forum - Trang quản trị");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $tilte ?></title>
    <?php $this->head() ?>
</head>
<body class="page-header-menu-fixed">
<?php $this->beginBody() ?>
<div class="page-header">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="' . Url::to("@web/img/logo_vettel.png") . '" alt="logo" class="logo-default"  width="115" style="margin-top:4px;"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'class' => 'page-logo'
        ],
        'renderInnerContainer' => true,
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ],
        'options' => [
            'class' => 'page-header-top',
        ],
        'containerOptions' => [
            'class' => 'top-menu'
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $rightItems[] = [
            'encode' => false,
            'label' => '<i class="icon-user"></i><span class="username username-hide-on-mobile">' . Yii::t('app', 'Đăng nhập') . '</span>',
            'url' => Yii::$app->urlManager->createUrl("site/login"),
            'options' => [
                'class' => 'dropdown dropdown-user'
            ],
            'linkOptions' => [
                'class' => "dropdown-toggle",
            ],
        ];
    } else {
        $rightItems[] = [
            'encode' => false,
            'label' => '<img alt="" class="img-circle" src="' . Url::to("@web/img/scorn.ico") . '"/>
					<span class="username username-hide-on-mobile">
						 ' . Yii::$app->user->identity->username . '
					</span>',
            'options' => ['class' => 'dropdown dropdown-user dropdown-dark'],
            'linkOptions' => [
                'data-hover' => "dropdown",
                'data-close-others' => "true"
            ],
            'url' => 'javascript:;',
            'items' => [
                [
                    'encode' => false,
                    'label' => '<i class="icon-user"></i> ' . Yii::t('app', 'Thông tin tài khoàn') . ' </a>',
                    'url' => ['user/info']
                ],
                [
                    'encode' => false,
                    'label' => '<i class="icon-key"></i> ' . Yii::t('app', 'Đăng xuất'),
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post'],
                ],
            ]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav pull-right'],
        'items' => $rightItems,
        'activateParents' => true
    ]);
    NavBar::end();
    ?>

    <?php
    NavBar::begin([
        'renderInnerContainer' => true,
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ],
        'options' => [
            'class' => 'page-header-menu',
            'style' => 'display: block;'
        ],
        'containerOptions' => [
            'class' => 'hor-menu'
        ],
        'toggleBtn' => false
    ]);
    $menuItems = [
        [
            'encode' => false,
            'label' => Yii::t('app', 'Quản lý Topic'),
            'url' => ['topics/index'],
        ],
        [
            'label' => Yii::t('app', 'Quản lý Users'),
            'url' => 'javascript:;',
            'options' => ['class' => 'menu-dropdown mega-menu-dropdown'],
            'linkOptions' => ['data-hover' => 'megamenu-dropdown', 'data-close-others' => 'true'],
            'items' => [
                [
                    'encode' => false,
                    'label' => '<i class="icon-users"></i> ' . Yii::t('app', 'Thành Viên'),
                    'url' => ['users/index'],
                ],
                [
                    'encode' => false,
                    'label' => '<i class="icon-users"></i> ' . Yii::t('app', 'Thành Viên BanList'),
                    'url' => ['users/index'],
                ],
            ]
        ],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
        'activateParents' => true
    ]);
    NavBar::end();
    ?>
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <div class="page-content">
        <div class="container-fluid">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => [
                    'class' => 'page-breadcrumb breadcrumb'
                ],
                'itemTemplate' => "<li>{link}<i class=\"fa fa-circle\"></i></li>\n",
                'activeItemTemplate' => "<li class=\"active\">{link}</li>\n"
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="page-footer footer">
    <div class="container-fluid">
        <p><b>&copy;Copyright <?php echo date('Y'); ?> </b>. All Rights Reserved. <b> forum-backend </b></p>
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

