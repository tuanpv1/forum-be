<?php
use frontend\widgets\FooterWidget;
use frontend\widgets\HeaderWidget;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title>Telstra Login</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content="Telstra Corporate is the gateway into the range of products and services offered by Telstra Consumer and Telstra Business and Enterprise."/>
    <meta name="keywords" content="telstra corporate, telstra consumer, telstra business, telstra enterprise and government, consumer, business and enterprise, enterprise and government"/>
    <meta name="robots" content="INDEX, FOLLOW"/>
    <meta name="language" content="English"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=0.7, user-scalable=yes">
    <link rel="shortcut icon" href="https://www.telstra.com.au/etc/designs/tcom/global/img/telstra/favicon-base-blue.ico">

    <!-- Sitelet settings -->
    <script type="text/javascript">
        var telstra_global_lhnav_id = "hom";
        var telstra_global_tabId = 1;
        var telstra_global_loginState = -1;
        var isSSL = 0;
        var telstra_application = true;
        //var isSSL = true;// Must be uncommented when there is an SSL version available
    </script>

    <script type="text/javascript">
        var tcom = tcom || {};
        tcom.baseUrl = '';
        tcom.runmodes = ["publ03stl","crx2","publish","nosamplecontent","crx3mongo","prod"];
        tcom.isAuthor = false;
        tcom.siteSection = 'personal';
        tcom.isPersonal = true;
    </script>

    <script type="text/javascript">
        /* Based on https://github.com/filamentgroup/loadCSS */
        var fontPath = 'https://www.telstra.com.au/etc/designs/tcom/tcom-core/css/fonts/font-{0}.css';
        var ua = navigator.userAgent;
        // android webkit browser, non-chrome
        if(ua.indexOf('Android') > -1 && ua.indexOf('like Gecko') > -1 && ua.indexOf('Chrome') === -1 ){
            fontPath = fontPath.replace('{0}', 'ttf');
        }
        else if(document.documentElement.className.indexOf('lt-ie9') > -1){
            fontPath = fontPath.replace('{0}', 'eot');
        }
        else {
            fontPath = fontPath.replace('{0}', 'woff');
        }
        var injectref = document.getElementsByTagName('script')[0];

        function loadCSS(href){
            var fontslink = document.createElement('link');
            fontslink.rel = 'stylesheet';
            fontslink.href= href;
            if(injectref && injectref.parentNode) {
                injectref.parentNode.insertBefore(fontslink, injectref);
            } else {
                // uncommon, but oldIE timing
                window.setTimeout(function() { loadCSS(href); }, 15);
            }
        }

        loadCSS(fontPath);
    </script>

    <link rel="stylesheet" href="https://www.telstra.com.au/etc/designs/tcom/tcom-core/css/bootstrap-responsive.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://www.telstra.com.au/etc/designs/tcom/tcom-core/css/styles-responsive.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://www.telstra.com.au/etc/designs/tcom/global/css/aem-global-responsive.css" type="text/css" media="all">
    <!--[if lte IE 9]>
    <link href="https://www.telstra.com.au/etc/designs/tcom/tcom-core/css/styles-responsive-ie.css" rel="stylesheet" media="all">
    <![endif]-->
    <link rel="stylesheet" href="https://www.telstra.com.au/etc/designs/tcom/tcom-core/css/styles-print.css" media="print">
    <link rel='stylesheet' href='https://www.telstra.com.au/etc/designs/tcom/service-qualifier/css/service-qualifier.css' type='text/css'>

    <!-- Overlay headInclude.jsp to include additional scripts in page header -->
    <script src="https://www.telstra.com.au/etc/designs/tcom/tcom-core/js/modernizr.js"></script>

    <!--Line below to include telstra-auth.csss only in IE browsers above 9 and all other browsers -->
    <!--[if gt IE 9]><!-->
    <link rel="stylesheet" href="https://www.telstra.com.au/content/dam/tcom/css/telstra-auth.css">
    <!--<![endif]-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://www.telstra.com.au/etc/designs/tcom/tcom-core/js/respond.js"></script>
    <![endif]-->

    <script type="text/javascript">
        var lpTag = lpTag || {}; lpTag.vars = lpTag.vars  || [];
        lpTag.section = 'default';
        var arrLPvars = [
            { scope:'page', name:'title', value: 'Home broadband' },
            /*{ scope:'session', name:'SESSION_VARIABLE_NAME', value:'VARIABLE_VALUE' },
             { scope:'visitor', name:'VISITOR_VARIABLE_NAME', value:'VARIABLE_VALUE' }*/
        ];
        lpTag.vars.push(arrLPvars);
    </script>


    <!--Styles defined as part of Rebrand changes -->
    <style type="text/css">
        #spectrum { visibility: visible !important; }

        body{
            background-image: none;
        }

        @font-face {
            font-family: 'Akkurat-Light';
            src: url('/res/fonts/telstra/onePortal/Akkurat-Light.eot');
            src: url('/res/fonts/telstra/onePortal/Akkurat-Light.eot?#iefix') format('embedded-opentype'),
            url('/res/fonts/telstra/onePortal/Akkurat-Light.woff') format('woff'),
            url('/res/fonts/telstra/onePortal/Akkurat-Light.ttf') format('truetype'),
            url('/res/fonts/telstra/onePortal/Akkurat-Light.svg#Akkurat-Light') format('svg');
        }

        .button, .btn{
            padding: 14px 4px 14px 20px;
        }
        .button:after, .btn:after{
            right: -43px;
        }

        input[type="text"],input[type="number"],input[type="tel"],input[type="email"],input[type="password"]
        {
            float:left;
            border:1px solid #ccc;
            width:100%;
            height:34px;
            line-height:1.42857;
            margin:1px 0 5px;
            max-width:712px;
            padding:0;
            transition:border-color .15s ease-in-out 0,box-shadow .15s ease-in-out 0;
            -webkit-appearance:none;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            -o-border-radius: 0px;
            border-radius: 0px;
            -webkit-box-shadow:rgba(0,0,0,0.07451) 0 1px 1px 0 inset;
            -webkit-rtl-ordering:logical;
            -webkit-transition-delay:0,0;
            -webkit-transition-duration:.15s,0.15s;
            -webkit-transition-property:border-color,box-shadow;
            -webkit-transition-timing-function:ease-in-out,ease-in-out;
            -webkit-user-select:text;
            -webkit-writing-mode:horizontal-tb;
            background-color:#fff;
            background-image:none;
            border-image-outset:0;
            border-image-repeat:stretch;
            border-image-slice:100%;
            border-image-source:none;
            border-image-width:1;
            box-shadow:rgba(0,0,0,0.07451) 0 1px 1px 0 inset;
            box-sizing:border-box;
            color:#555;
            cursor:auto;
            display:block;
            font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
            font-size:14px;
            font-style:normal;
            font-variant:normal;
            font-weight:400;
            height:34px;
            letter-spacing:normal;
            line-height:20px;
            margin-bottom:0;
            margin-left:0;
            margin-right:0;
            margin-top:0;
            padding-bottom:6px;
            padding-left:12px;
            padding-right:12px;
            padding-top:6px;
            text-align:start;
            text-indent:0;
            text-shadow:none;
            text-transform:none;
            transition-delay:0,0;
            transition-duration:.15s,0.15s;
            transition-property:border-color,box-shadow;
            transition-timing-function:ease-in-out,ease-in-out;
            width:100%;
            word-spacing:0;
            border-color:#ccc;
            border-style:solid;
            border-width:1px}

        input[type="text"]:focus,input[type="number"]:focus,input[type="tel"]:focus,input[type="email"]:focus,select:focus,input[type="password"]:focus
        {
            border-color:#aaa;
            outline:0;
            -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6);
            box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6)
        }

        select
        {
            margin-right:3px;
            background-color:#fff;
            background-image:none;
            border:1px solid #ccc;
            box-shadow:0 1px 1px rgba(0,0,0,0.075) inset;
            color:#555;
            display:block;
            font-size:14px;
            height:34px;
            line-height:1.42857;
            padding:6px 12px;
            transition:border-color .15s ease-in-out 0,box-shadow .15s ease-in-out 0;
            width:auto;
            height:33px!important;
            overflow:hidden;
            white-space:nowrap;
            text-overflow:ellipsis
        }

        input[type=checkbox],input[type=radio]
        {
            width:20px;
            height:20px;
            margin-top:0;
            margin-right:10px!important;
            float:left
        }

        .input-wrapper{
            margin-bottom: 15px;
            float: left;
            width: 100%;
            clear:both;
        }

        .input-container
        {
            width:80%;float: left;
            -webkit-appearance:none;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            -o-border-radius: 0px;
            border-radius: 0px;
        }

        .link-helper
        {
            display: block;
            float: left;
            background-color: #004d9d;margin-left: 5px
        }

        .left
        {
            float:left;
        }

        .icons-register
        {
            margin-bottom: 15px
        }

        .field-group
        {
            position: relative
        }

        #spectrum_local span{
            background-image: url("/res/images/commonLogin/v2.1-spectrum-blue.jpg");
            background-position: 50% 0;
            background-repeat: no-repeat;
            background-size: cover;
            display: block;
            height: 580px;
            margin-top: 81px;
            max-height: 580px;
            position: absolute;
            visibility: hidden;
            width: 100%;
        }

        .msg-error {
            background: #fff none repeat scroll 0 0;
            border: 2px solid #A1283E;
            border-radius: 0px;
            font-size: 14px;
            max-height: 380px;
            margin-left: 0px;
            margin-bottom: 20px;
            overflow: visible;
            padding-top: 5px; padding-bottom: 5px;
            min-width:250px;
            max-width: 400px;
        }

        .legend {
            display: inline-block;
        }

        .loginerrmsg {
            font-size:14px;
            overflow: visible; display:inline-block;
            margin-top: 5px;
            margin-bottom: 5px;
            font-weight:normal; color:#A1283E;
            max-width: 90%;
        }

        .rebrandHeadingFont{
            font-family: 'Akkurat-Light';
            text-align: left;
            font-style: normal;
        }

        .rebrandLoginheading{
            font-size: 36px;
            color: #0F0F0F;
            padding-left: 0px;
            padding-top: 0px;
        }

        .rebrandregisterheading{
            font-size: 25px;
            color: #1964c8;
            /*height: 45px;*/
        }

        .rebrandErrMsgContainerDiv{
            padding-top: 0px;
            vertical-align: bottom;
            margin-top: 0px;
            margin-left: 0px;
            padding-bottom: 0px;
        }

        .rebrandColumns{
            margin: 0px;
            padding: 0px;
        }

        .rebrandColumn2{
            border: 0px solid orange;
        }

        .rebrandTextFont{
            font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
            font-size: 14px;
            text-align: left;
            color: #333333;
            font-style: normal;
        }

        .rebrandBusinessIdText{
            font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
            font-size: 14px;
            text-align: left;
            color: #0F0F0F;
            font-weight: bold;
        }

        .rebrandDigitalCert{
            font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
            font-size: 14px;
            text-align: left;
            color: #1964c8;
            font-weight: bold;
            padding: 0px;
            margin: 0 0 15px 0;
        }

        .img-spectrum{
            position:absolute;
            width:150%;
            left:-48%;
            height:500px;
            display:block;
            clip:rect(0px,2560px,100px,0px);
        }

        .facebook-btn-new {
            background: url("/res/images/telstra/csup/login-sprite.png") no-repeat scroll 0 -243px;
            display: block;
            height: 33px;
            line-height: 29px;
        }

        .facebook-btn-new:hover {
            background: url("/res/images/telstra/csup/login-sprite.png") no-repeat scroll 0 -210px;
        }

        .facebook-privacy-disclaimer {
            background: url("/res/images/telstra/csup/FB_lock.jpg") no-repeat scroll 1px -2px;
        }
        @media only screen and (device-width: 768px) {
            #rebrandMainContent{
                margin-top:80px !important;
            }
        }
        @media only screen and (min-width: 800px){
            .rebrandloginHeadingDiv{
                height: 80px;
            }

            .rebrandBlankDiv{
                height: 75px;
            }

            #tooltip0
            {
                top: -70%;
                left: 89%;
            }

            #tooltip1
            {
                top: -50%;
                left: 48%;
            }

            .tooltip-left{
                border: 1px solid #ddd;
                position:absolute;
                margin:0;
                padding:12px;
                display:none;
                background-color: #fff;
                width: 400px;
                z-index:9999;
                font-size: 12px;
            }
            .tooltip-left:after, .tooltip-left:before {
                right: 100%;
                top: 30%;
                border: solid transparent;
                content: " ";
                height: 0;
                width: 0;
                position: absolute;
                pointer-events: none;
            }
            .tooltip-left:after {
                border-color: rgba(255, 255, 255, 0);
                border-right-color: #fff;
                border-width: 10px;
                margin-top: -10px;
            }
            .tooltip-left:before {
                border-color: rgba(221, 221, 221, 0);
                border-right-color: #ddd;
                border-width: 11px;
                margin-top: -11px;
            }

            .rebrandColumn1{
                border: 1px solid #dddddd;
                border-bottom: 1px solid #dddddd;
            }
        }

        @media only screen and (max-width:800px) {
            .rebrandloginHeadingDiv{
                height: 35px;
                padding-left: 25px;
            }

            .tooltip-left
            {
                position: relative;
                display: block;
                float: left;
                border: 1px solid #ddd;
                width: 100%;
                margin: 0px;
                margin-top: 10px;
                padding: 1px;
                box-sizing:border-box;
                top:8px;
                left:0;
            }
            .tooltip-left:after , .tooltip-left:before
            {
                display: none
            }

            #tooltip0
            {
                top: 0%;
                left: 0%;
            }

            #tooltip1
            {
                top: 0%;
                left: -6%;
            }

            .rebrandColumn1{
                border: 0px solid #dddddd;
                border-bottom: 1px solid #dddddd;
            }
        }

        ::-webkit-input-placeholder {
            padding-left: 15px; height: 40px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 14px;text-align: left;color: #a5a5a5;font-weight: bold;
        }

        :-moz-placeholder {
            padding-left: 15px; height: 40px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 14px;text-align: left;color: #a5a5a5;font-weight: bold;
        }

        ::-moz-placeholder {
            padding-left: 15px; height: 40px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 14px;text-align: left;color: #a5a5a5;font-weight: bold;
        }

        :-ms-input-placeholder {
            padding-left: 15px; height: 40px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 14px;text-align: left;color: #a5a5a5;font-weight: bold;
        }
    </style>

</head>
<body role="document" class="base-blue  white-bkg">
<!-- Application settings -->
<script type="text/javascript">
    // <![CDATA[
    telstra_global_header_search_shop = false;

    if (typeof(telstra_application) != "undefined" && telstra_application == true) {
        var telstra_global_header_search = false;
        var telstra_global_header_displaytabs = false;
    }
    // ]]>
</script>

<div class="parbase clientcontext">
    <script type="text/javascript" src="https://www.telstra.com.au/etc/clientlibs/granite/jquery.js"></script>
    <script type="text/javascript" src="https://www.telstra.com.au/etc/clientlibs/granite/utils.js"></script>
    <script type="text/javascript" src="https://www.telstra.com.au/etc/clientlibs/granite/jquery/granite.js"></script>
    <script type="text/javascript" src="https://www.telstra.com.au/etc/clientlibs/foundation/jquery.js"></script>
    <script type="text/javascript" src="https://www.telstra.com.au/etc/clientlibs/foundation/shared.js"></script>
    <script type="text/javascript" src="https://www.telstra.com.au/etc/clientlibs/granite/underscore.js"></script>
    <script type="text/javascript" src="https://www.telstra.com.au/etc/clientlibs/foundation/personalization/kernel.js"></script>
</div>

<?= Alert::widget() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
