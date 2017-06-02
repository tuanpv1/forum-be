<?php
use backend\assets\AppAsset;
use common\models\Banlist;
use common\models\User;
use common\widgets\Alert;
use common\widgets\Nav2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$this->registerJs("Metronic.init();");
$this->registerJs("Layout.init();");
$arrlang = array();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
<?php $this->beginBody() ?>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">

        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?= Yii::$app->homeUrl ?>">
                <img src="<?= Url::to("@web/img/logo-big.png") ?>" alt="logo" class="logo-default"/>
            </a>

            <div class="menu-toggler sidebar-toggler hide">
            </div>
        </div>

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>

        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->


                <li class="dropdown dropdown-user">
                    <?php
                    if (Yii::$app->user->isGuest) {

                    } else {
                    ?>
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img alt="" class="img-circle" src="<?= Url::to("@web/img/avatar2.jpg") ?>"/>
					<span class="username username-hide-on-mobile">
					<?= Yii::$app->user->identity->username ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?= Url::to(['user/info']) ?>">
                                <i class="icon-user"></i> <?= Yii::t("app", "Thông tin tài khoàn") ?> </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['site/logout']) ?>" data-method='post'>
                                <i class="icon-logout"></i> <?= Yii::t("app", "Đăng xuất") ?> </a>
                        </li>
                    </ul>
                </li>
                <?php
                }
                ?>

                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="<?= Url::to(['site/logout']) ?>" class="dropdown-toggle" data-method='post'>
                        <i class="icon-logout"></i>
                    </a>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <?php


            $rightItems = [
                [
                    'encode' => false,
                    'label' => '<i class="glyphicon glyphicon-cog"></i> ' . Yii::t('app', 'Quản lý quyền hệ thống'),
                    'linkOptions' => ['data-hover' => 'megamenu-dropdown', 'data-close-others' => 'true'],
                    'options' => ['class' => 'menu-dropdown mega-menu-dropdown'],
                    'items' => [
//                        [
//                            'encode' => false,
//                            'label' => '<i class="glyphicon glyphicon-user"></i> ' . Yii::t('app', 'Nhóm người dùng'),
//                            'url' => ['phpbb-groups/index'],
//                        ],
//                        [
//                            'encode' => false,
//                            'label' => '<i class="glyphicon glyphicon-barcode"></i> ' . Yii::t('app', 'Nhóm quyền'),
//                            'url' => ['acl-roles/index'],
//                        ],
//                        [
//                            'encode' => false,
//                            'label' => '<i class="glyphicon glyphicon-th-list"></i> ' . Yii::t('app', 'Quyền chi tiết'),
//                            'url' => ['acl-options/index'],
//                        ],
                        [
                            'encode' => false,
                            'label' => '<i class="glyphicon glyphicon-th-list"></i> ' . Yii::t('app', 'Cấp quyền danh mục'),
                            'url' => ['acl-roles/index-category'],
                        ],
                    ]
                ],
                [
                    'encode' => false,
                    'label' => '<i class="glyphicon glyphicon-pencil"></i> ' . Yii::t('app', 'Quản lý chủ đề'),
                    'linkOptions' => ['data-hover' => 'megamenu-dropdown', 'data-close-others' => 'true'],
                    'options' => ['class' => 'menu-dropdown mega-menu-dropdown'],
                    'items' => [
                        [
                            'encode' => false,
                            'label' => '<i class="glyphicon glyphicon-subtitles"></i> ' . Yii::t('app', 'Chủ đề'),
                            'url' => ['topics/index'],
                        ],
                        [
                            'encode' => false,
                            'label' => '<i class="glyphicon glyphicon-comment"></i> ' . Yii::t('app', 'Bình luận'),
                            'url' => ['posts/index']
                        ],
                        [
                            'encode' => false,
                            'label' => '<i class="glyphicon glyphicon-comment"></i> ' . Yii::t('app', 'Quản lý tags'),
                            'url' => ['tags/index']
                        ],
                    ]
                ],
                [
                    'encode' => false,
                    'label' => '<i class="glyphicon glyphicon-duplicate"></i> ' . Yii::t('app', 'Quản lý danh mục'),
                    'linkOptions' => ['data-hover' => 'megamenu-dropdown', 'data-close-others' => 'true'],
                    'options' => ['class' => 'menu-dropdown mega-menu-dropdown'],
                    'url' => ['category/index'],
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-menu-hamburger"></i> ' . Yii::t('app', 'Quản lý Users'),
                    'url' => 'javascript:;',
                    'encode' => false,
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
                            'label' => '<i class="glyphicon glyphicon-warning-sign"></i> ' . Yii::t('app', 'Thành Viên BanList'),
                            'items' => [
                                [
                                    'encode' => false,
                                    'label' => '<i class="icon-users"></i> ' . Yii::t('app', 'Ban User'),
                                    'url' => ['banlist/index', 'type' => Banlist::TYPE_USER],
                                ],
                                [
                                    'encode' => false,
                                    'label' => '<i class="glyphicon glyphicon-envelope"></i> ' . Yii::t('app', 'Ban Email'),
                                    'url' => ['banlist/index', 'type' => Banlist::TYPE_EMAIL],
                                ],
                                [
                                    'encode' => false,
                                    'label' => '<i class="icon-reload"></i> ' . Yii::t('app', 'Ban IP'),
                                    'url' => ['banlist/index', 'type' => Banlist::TYPE_IP],
                                ],
                            ]
                        ],
                    ]
                ],
            ];


            echo Nav2::widget([
                'options' => ['class' => "page-sidebar-menu  page-sidebar-fixed", 'data-keep-expanded' => "false", 'data-auto-scroll' => "true", 'data-slide-speed' => "200"],
                'items' => $rightItems,
                'activateParents' => true,
                'validateAdminCallback' => function ($user) {
                    /**
                     * @var \yii\web\User $user
                     */
                    if ($user && isset($user->identity->username)) {
                        /**
                         * @var $sp_user User
                         */
                        $sp_user = $user->identity;
                        return false;
                    } else {
                        return false;
                    }
                }
            ]);

            ?>
        </div>
    </div>
    <!-- END SIDEBAR -->


    <!-- BEGIN CONTAINER -->
    <div class="page-content-wrapper">
        <!--    <div class="page-head">-->
        <!--        <div class="container-fluid">-->
        <!--            <div class="page-title">-->
        <!--                <h1>--><?php //echo $this->title ?><!--</h1>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <div class="page-content">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => [
                    'class' => 'page-breadcrumb breadcrumb'
                ],
//                'itemTemplate' => "<li>{link}<i class=\"fa fa-circle\"></i></li>\n",
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
        <p>
            <b>&copy;<?= Yii::t("app", "Copyright") ?>  <?php echo date('Y'); ?> </b><?= Yii::t("app", ". All Rights Reserved.") ?>
            <b><?= Yii::t("app", "CMS Multi Streamming Platform") ?></b>.
            <?= Yii::t("app", "Design By VIVAS Co.,Ltd.") ?></p>
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
