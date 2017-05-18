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

    <span id="spectrum" class="spectrum-page-takeover hidden-xs"
          style="background-image: url(https://www.telstra.com.au/etc/designs/tcom/tcom-core/img/telstra/3.0-spectrum-gradient-blue.png);"></span>

<div id="shade"></div>
<header class="hide-header">
    <!--[if lt IE 8]>
    <div id="browser-warning">
        <div class="container">
            <i class="td-icon-sm icon-information text-theme-dark"></i>
            <div>
                <p>&nbsp;</p>
                <p>It looks like you are using Internet Explorer 7.</p>
                <p>telstra.com.au may not display correctly and some of the features may be unavailable to you.<br>If you are not using this version, please check that <a href="http://windows.microsoft.com/en-US/internet-explorer/use-compatibility-view#ie=ie-10-win-7" target="_blank">compatibility mode</a> is turned off, otherwise you may need to <a href="http://windows.microsoft.com/en-au/internet-explorer/download-ie" target="_blank">update your browser</a>.</p>
            </div>
        </div>
    </div>
    <![endif]-->

    <div id="global-nav" class="navbar navbar-inverse offcanvas" role="navigation">
        <div class="container">
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav" id="global-nav-menu">
                    <li>
                        <a href="http://www.telstra.com.au/?direct">Telstra.com</a>
                    </li>
                    <li class="active">
                        <a href="https://www.telstra.com.au/personal">Personal</a>
                    </li>
                    <li>
                        <a href="https://www.telstra.com.au/small-business">Small Business</a>
                    </li>
                    <li>
                        <a href="https://www.telstra.com.au/business-enterprise">Business &amp; Enterprise</a>
                    </li>
                    <li>
                        <a href="https://www.telstra.com.au/telstra-health">Health</a>
                    </li>
                    <li>
                        <a href="https://www.telstra.com.au/tv-movies-music">Sport &amp; Entertainment</a>
                    </li>
                </ul>
                <!-- Login Tile -->
                <div id="login-placeholder"></div>
            </div>
        </div>
    </div>

    <div id="primary-nav" class="navbar visible-lg" role="navigation">
        <div class="container">
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="https://www.telstra.com.au" title="" class="site-title"><span class="site-logo">&nbsp;</span></a>
                        <a href="https://www.telstra.com.au/personal" title="" class="site-title"><span class="site-title">PERSONAL</span></a>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" role="search" action="https://telstra.com.au/search/simple-search/index.htm"
                      method="GET" id="searchDesktop">
                    <div class="form-group search-telstra">
                            <span class="twitter-typeahead" style="position: relative; display: inline-block; direction: ltr;">
                                <input data-search-input-desktop="" type="text" class="form-control search-telstra-input tt-input"
                                       placeholder="Search Telstra.com" name="inpSearch" autocomplete="off" spellcheck="false" dir="auto"
                                       style="position: relative; vertical-align: top; background-color: #dadada;">
                                <pre aria-hidden="true"
                                     style="position: absolute; visibility: hidden; white-space: pre; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
                                     font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal;
                                     font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;">
                                </pre>
                                <span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none; right: auto;">
                                    <div class="tt-dataset-search"></div>
                                </span>
                            </span>
                        <input type="hidden" name="requestSiteId" value="personal">
                        <input type="hidden" name="searchFormSubmited" value="Yes">
                        <button class="search-telstra-btn" type="submit" id="searchSubmit">
                            <i class="td-icon icon-ui-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="site-header" role="navigation">
        <div class="container">
            <button type="button" class="nav-toggle" data-nav-id="nav">
                <span class="menu">Menu</span>
                <div class="icon">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
            </button>
            <a href="https://www.telstra.com.au/" class="site-logo"><span class="vh">Telstra.com</span></a>
            <ul class="site-actions">
                <li>
                    <button data-popover-id="site-search" class="btn-search btn square search-toggle fn_popover" aria-controls="site-search">
                        <i class="td-icon icon-ui-search"></i>
                        <span class="vh">Open search panel</span>
                    </button>
                    <div id="site-search" class="feature-popover site-search" data-popover-focusto="#telstra-search" data-popover-position="search" data-popover-animate="slide-right">
                        <div class="popover-content">
                            <form class="telstra-search" role="search" action="https://telstra.com.au/search/simple-search/index.htm" method="GET">
                                <input type="text" id="telstra-search" title="telstra-search" name="inpSearch" placeholder="Search Telstra.com" autocomplete="off" spellcheck="false" dir="auto" data-search-input-mobile />
                                <input type="hidden" name="requestSiteId" value="personal">
                                <input type="hidden" name="searchFormSubmited" value="Yes" />
                                <button type="submit" class="btn-search btn square">
                                    <i class="td-icon icon-ui-search"></i>
                                    <span class="vh">Submit Search</span>
                                </button>
                                <button class="popover-close btn square">
                                    <i class="td-icon icon-ui-cross"></i>
                                    <span class="vh">Close Search</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="site-header is-fixed headroom active headroom--top" role="navigation" style="top: 0px; display: block;">
        <div class="container">
            <button type="button" class="nav-toggle" data-nav-id="nav">
                <span class="menu">Menu</span>
                <div class="icon">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
            </button>
            <a href="https://www.telstra.com.au/" class="site-logo is-light is-small"><span class="vh">Telstra.com</span></a>
            <ul class="site-actions">
                <li>
                    <button data-popover-id="site-search" class="btn-search btn square search-toggle fn_popover" aria-controls="site-search">
                        <i class="td-icon icon-ui-search"></i>
                        <span class="vh">Open search panel</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="row transparent rebrandBlankDiv"></div>

    <div class="visible-xs" style="height:100px;">
        <img class="img-spectrum visible-xs" src="https://www.telstra.com.au/etc/designs/tcom/tcom-core/img/telstra/3.0-spectrum-gradient-blue.png" alt="">
    </div>
</header>

<div id="nav" class="offscreen-nav fn_scrollbar ps-container" role="navigation" tabindex="-1" data-scrollbar-x="false"
     aria-hidden="false" style="overflow-x: hidden;">
    <nav>
        <div class="nav-inner">
            <span class="site-logo is-small"><span class="vh">Telstra.com</span></span>
            <ul class="offscreen-nav-primary">
                <li class="is-expanded is-active">
                    <a href="https://www.telstra.com.au/personal" class="nav-lvl-1 has-children">Personal</a>
                    <div class="children" tabindex="-1">
                        <ul>
                            <li>
                                <a href="https://www.telstra.com.au/tv-movies-music" class="has-children"><i class="td-icon icon-foxtel"></i>TV, Movies &amp; Music</a>
                                <div class="children" tabindex="-1">
                                    <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Personal</a></div>
                                    <a href="https://www.telstra.com.au/tv-movies-music" class="parent-link has-icon"><i class="td-icon icon-foxtel"></i>TV, Movies &amp; Music</a>
                                    <ul>
                                        <li>
                                            <a href="https://www.telstra.com.au/tv-movies-music/products" class="has-children">Products</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to TV, Movies &amp; Music</a></div>
                                                <a href="https://www.telstra.com.au/tv-movies-music/products" class="parent-link">Products</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/products/entertainment-on-the-move">Entertainment on the move</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/products/bigpond-movies">BigPond Movies - Telstra Entertainment</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/products/presto">Presto</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/products/netball-live">Netball Live</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="https://www.telstra.com.au/tv-movies-music/tv-shows">TV Shows</a></li>
                                        <li>
                                            <a href="https://www.telstra.com.au/tv-movies-music/sport" class="has-children">Sport</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to TV, Movies &amp; Music</a></div>
                                                <a href="https://www.telstra.com.au/tv-movies-music/sport" class="parent-link">Sport</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/sport/barclays-premier-league">Barclays Premier League</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/sport/v8-supercars-championship">V8  Supercars Championship</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/sport/nfl">NFL</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="https://www.telstra.com.au/tv-movies-music/telstratvplusapp">Telstra TV Plus App</a></li>
                                        <li>
                                            <a href="https://www.telstra.com.au/tv-movies-music/telstra-tv" class="has-children">Telstra TV</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to TV, Movies &amp; Music</a></div>
                                                <a href="https://www.telstra.com.au/tv-movies-music/telstra-tv" class="parent-link">Telstra TV</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/telstra-tv/movies-and-tv-shows-lightbox">Movies and TV Shows</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/telstra-tv/catchup-tv-lightbox">Catch Up TV</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/telstra-tv/sport-lightbox">Sports</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/telstra-tv/kids-and-family-lightbox">Kids &amp; Family</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/telstra-tv/lifestyle-lightbox">Lifestyle</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/telstra-tv/music-and-media-lightbox">Music &amp; Media</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/telstra-tv/news-and-weather-lightbox">News &amp; Weather</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/telstra-tv/yupptv-lightbox">YUPP TV</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="https://www.telstra.com.au/tv-movies-music/sports-offer-eoi">Footy Pass</a></li>
                                        <li>
                                            <a href="https://www.telstra.com.au/tv-movies-music/why-foxtel-from-telstra" class="has-children">Foxtel From Telstra</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to TV, Movies &amp; Music</a></div>
                                                <a href="https://www.telstra.com.au/tv-movies-music/why-foxtel-from-telstra" class="parent-link">Foxtel From Telstra</a>
                                                <ul>
                                                    <li>
                                                        <a href="https://www.telstra.com.au/tv-movies-music/why-foxtel-from-telstra/foxtel-channel-packs" class="has-children">Channel Packs</a>
                                                        <div class="children" tabindex="-1">
                                                            <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Foxtel From Telstra</a></div>
                                                            <a href="https://www.telstra.com.au/tv-movies-music/why-foxtel-from-telstra/foxtel-channel-packs" class="parent-link">Channel Packs</a>
                                                            <ul>
                                                                <li><a href="https://www.telstra.com.au/tv-movies-music/why-foxtel-from-telstra/foxtel-channel-packs/hd-channels">HD Channels</a></li>
                                                                <li><a href="https://www.telstra.com.au/tv-movies-music/why-foxtel-from-telstra/foxtel-channel-packs/Presto-Entertainment">Presto Entertainment</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/why-foxtel-from-telstra/foxtel-features-and-extras">Features and Extras</a></li>
                                                    <li><a href="https://www.telstra.com.au/tv-movies-music/why-foxtel-from-telstra/terms">Terms</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="https://www.telstra.com.au/tv-movies-music/foxtel-from-telstra" class="has-children">Foxtel Packages</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to TV, Movies &amp; Music</a></div>
                                                <a href="https://www.telstra.com.au/tv-movies-music/foxtel-from-telstra" class="parent-link">Foxtel Packages</a>
                                                <ul>
                                                    <li>
                                                        <a href="https://www.telstra.com.au/tv-movies-music/foxtel-from-telstra/foxtel-channel-packs" class="has-children">Channel Packs</a>
                                                        <div class="children" tabindex="-1">
                                                            <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Foxtel Packages</a></div>
                                                            <a href="https://www.telstra.com.au/tv-movies-music/foxtel-from-telstra/foxtel-channel-packs" class="parent-link">Channel Packs</a>
                                                            <ul>
                                                                <li><a href="https://www.telstra.com.au/tv-movies-music/foxtel-from-telstra/foxtel-channel-packs/hd-channels">HD Channels</a></li>
                                                                <li><a href="https://www.telstra.com.au/tv-movies-music/foxtel-from-telstra/foxtel-channel-packs/Presto-Entertainment">Presto Entertainment</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="https://www.telstra.com.au/tv-movies-music/movies">Movies</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="https://www.telstra.com.au/mobile-phones" class="has-children"><i class="td-icon icon-mobile"></i>Mobile Phones</a>
                                <div class="children" tabindex="-1">
                                    <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Personal</a></div>
                                    <a href="https://www.telstra.com.au/mobile-phones" class="parent-link has-icon"><i class="td-icon icon-mobile"></i>Mobile Phones</a>
                                    <ul>
                                        <li><a href="https://www.telstra.com.au/mobile-phones/mobiles-on-a-plan">Mobiles on a plan</a></li>
                                        <li>
                                            <a href="https://www.telstra.com.au/mobile-phones/plans-and-rates" class="has-children">Plans and rates</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Mobile Phones</a></div>
                                                <a href="https://www.telstra.com.au/mobile-phones/plans-and-rates" class="parent-link">Plans and rates</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/plans-and-rates/data-packs">Data Packs</a></li>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/plans-and-rates/calling-overseas-from-australia">Calling overseas</a></li>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/plans-and-rates/new-phone-feeling">New Phone Feeling</a></li>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/plans-and-rates/stayconnected">StayConnected</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="https://www.telstra.com.au/mobile-phones/prepaid-mobiles" class="has-children">Pre-Paid mobiles</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Mobile Phones</a></div>
                                                <a href="https://www.telstra.com.au/mobile-phones/prepaid-mobiles" class="parent-link">Pre-Paid mobiles</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/prepaid-mobiles/offers-and-rates">Offers &amp; rates</a></li>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/prepaid-mobiles/mobiles-and-starter-kits">Mobiles &amp; Starter Kits</a></li>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/prepaid-mobiles/plus-packs">Data top-up &amp; Plus Packs</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="https://www.telstra.com.au/mobile-phones/moreonyourmobile" class="has-children">More on your mobile</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Mobile Phones</a></div>
                                                <a href="https://www.telstra.com.au/mobile-phones/moreonyourmobile" class="parent-link">More on your mobile</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/moreonyourmobile/features-and-services">Features &amp; services</a></li>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/moreonyourmobile/apps">Apps</a></li>
                                                    <li><a href="https://www.telstra.com.au/mobile-phones/moreonyourmobile/manageyourcontent">Manage your content</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="https://www.telstra.com.au/mobile-phones/wearables">Wearables</a></li>
                                        <li><a href="https://www.telstra.com.au/mobile-phones/international-roaming">International Roaming</a></li>
                                        <li><a href="https://www.telstra.com.au/mobile-phones/coverage-networks">Coverage &amp; networks</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="https://www.telstra.com.au/tablets" class="has-children"><i class="td-icon icon-tablet"></i>Tablets</a>
                                <div class="children" tabindex="-1">
                                    <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Personal</a></div>
                                    <a href="https://www.telstra.com.au/tablets" class="parent-link has-icon"><i class="td-icon icon-tablet"></i>Tablets</a>
                                    <ul>
                                        <li>
                                            <a href="https://www.telstra.com.au/tablets/tablets-on-a-plan" class="has-children">Tablets and Plans</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Tablets</a></div>
                                                <a href="https://www.telstra.com.au/tablets/tablets-on-a-plan" class="parent-link">Tablets and Plans</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/tablets/tablets-on-a-plan/compare-ipads">Compare iPads</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="https://www.telstra.com.au/tablets/tablet-plans">Tablet plans</a></li>
                                        <li><a href="https://www.telstra.com.au/tablets/prepaid-for-tablets">Pre-Paid Tablets</a></li>
                                        <li><a href="https://www.telstra.com.au/tablets/stayconnected">StayConnected Plus for tablets</a></li>
                                        <li><a href="https://www.telstra.com.au/tablets/new-tablet-feeling">New Tablet Feeling</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="https://www.telstra.com.au/broadband" class="has-children"><i class="td-icon icon-internet"></i>Broadband</a>
                                <div class="children" tabindex="-1">
                                    <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Personal</a></div>
                                    <a href="https://www.telstra.com.au/broadband" class="parent-link has-icon"><i class="td-icon icon-internet"></i>Broadband</a>
                                    <ul>
                                        <li><a href="https://www.telstra.com.au/broadband/home-wireless-broadband">Home Wireless broadband</a></li>
                                        <li><a href="https://www.telstra.com.au/broadband/home-broadband">Home Broadband Plans from Telstra</a></li>
                                        <li>
                                            <a href="https://www.telstra.com.au/broadband/mobile-broadband" class="has-children">Mobile broadband</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Broadband</a></div>
                                                <a href="https://www.telstra.com.au/broadband/mobile-broadband" class="parent-link">Mobile broadband</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/broadband/mobile-broadband/plans">Mobile Broadband Plans</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/mobile-broadband/coverage-networks">Coverage &amp; networks</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/mobile-broadband/prepaid">Pre-Paid</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="https://www.telstra.com.au/broadband/extras" class="has-children">Extras</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Broadband</a></div>
                                                <a href="https://www.telstra.com.au/broadband/extras" class="parent-link">Extras</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/broadband/extras/t-cloud">T-Cloud</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/extras/broadbandprotect"><i class="td-icon icon-bundle"></i>Telstra Broadband Protect</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/extras/t-voice-app">T-Voice App</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/extras/telstra-mail">Telstra Mail</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/extras/getwifi">Wi-Fi Gateways &amp; Range Extenders</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="https://www.telstra.com.au/broadband/nbn" class="has-children">nbn</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Broadband</a></div>
                                                <a href="https://www.telstra.com.au/broadband/nbn" class="parent-link">nbn</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/broadband/nbn/nbn-plans">nbn ? Plans</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/nbn/nbn-bundles">nbn? Bundles</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/nbn/nbn-rollout">nbn? Network Rollout</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/nbn/what-is-the-nbn">What is the nbn??</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/nbn/fibre-to-the-building">Fibre to the building</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/nbn/fibre-to-the-premises">Fibre to the premises</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/nbn/fixed-wireless">Fixed wireless</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/nbn/help-me-choose">Help me choose</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/nbn/how-to-connect">How to connect</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="https://www.telstra.com.au/broadband/telstra-air" class="has-children">Telstra Air</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Broadband</a></div>
                                                <a href="https://www.telstra.com.au/broadband/telstra-air" class="parent-link">Telstra Air</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/broadband/telstra-air/how-it-works">How it Works</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/telstra-air/how-to-join">How to Join</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/telstra-air/app">Telstra Air App</a></li>
                                                    <li><a href="https://www.telstra.com.au/broadband/telstra-air/discover">Discover Telstra Air</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="https://www.telstra.com.au/bundles" class="has-children"><i class="td-icon icon-bundle"></i>Bundles</a>
                                <div class="children" tabindex="-1">
                                    <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Personal</a></div>
                                    <a href="https://www.telstra.com.au/bundles" class="parent-link has-icon"><i class="td-icon icon-bundle"></i>Bundles</a>
                                    <ul>
                                        <li><a href="https://www.telstra.com.au/bundles/check-availability">Check Availability</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="https://www.telstra.com.au/home-phone" class="has-children"><i class="td-icon icon-phone"></i>Home Phone</a>
                                <div class="children" tabindex="-1">
                                    <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Personal</a></div>
                                    <a href="https://www.telstra.com.au/home-phone" class="parent-link has-icon"><i class="td-icon icon-phone"></i>Home Phone</a>
                                    <ul>
                                        <li><a href="https://www.telstra.com.au/home-phone/plans-rates">Plans &amp; Rates</a></li>
                                        <li>
                                            <a href="https://www.telstra.com.au/home-phone/features-services" class="has-children">Features &amp; services</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Home Phone</a></div>
                                                <a href="https://www.telstra.com.au/home-phone/features-services" class="parent-link">Features &amp; services</a>
                                                <ul>
                                                    <li>
                                                        <a href="https://www.telstra.com.au/home-phone/features-services/directory-voice-services">Telstra Directory Voice Services</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="https://www.telstra.com.au/home-phone/international-calling" class="has-children">International calling</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Home Phone</a></div>
                                                <a href="https://www.telstra.com.au/home-phone/international-calling" class="parent-link">International calling</a>
                                                <ul>
                                                    <li>
                                                        <a href="https://www.telstra.com.au/home-phone/international-calling/international-dialling-codes">International dialling</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a href="https://www.telstra.com.au/home-phone/calling-cards">Calling cards</a></li><li>
                                            <a href="https://www.telstra.com.au/home-phone/handsets">Handsets</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="https://www.telstra.com.au/connectedhome" class="has-children"><i class="td-icon icon-tv-clear"></i>Connected Home</a>
                                <div class="children" tabindex="-1">
                                    <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Personal</a></div>
                                    <a href="https://www.telstra.com.au/connectedhome" class="parent-link has-icon"><i class="td-icon icon-tv-clear"></i>Connected Home</a>
                                    <ul>
                                        <li>
                                            <a href="https://www.telstra.com.au/connectedhome/enhancements" class="has-children">Enhancements</a>
                                            <div class="children" tabindex="-1">
                                                <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to Connected Home</a></div>
                                                <a href="https://www.telstra.com.au/connectedhome/enhancements" class="parent-link">Enhancements</a>
                                                <ul>
                                                    <li><a href="https://www.telstra.com.au/connectedhome/enhancements/getwifi">Wi-Fi Gateways &amp; Range Extenders</a></li>
                                                    <li><a href="https://www.telstra.com.au/connectedhome/enhancements/platinum">Telstra Platinum</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a target="_self" href="https://www.telstra.com.au/support" class="nav-lvl-1 has-children"> Support </a>
                    <div class="children" tabindex="-1">
                        <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to </a></div>
                        <a target="_self" href="https://www.telstra.com.au/support" class="parent-link"> Support </a>
                        <ul>
                            <li><a href="https://www.telstra.com.au/support/category/account-billing" target="_self"><i class="td-icon icon-billing"></i> Accounts &amp; Billing </a></li>
                            <li><a href="https://www.telstra.com.au/support/category/broadband" target="_self"><i class="td-icon icon-internet"></i> Broadband </a></li>
                            <li><a href="https://www.telstra.com.au/support/category/email" target="_self"><i class="td-icon icon-email"></i> Email </a></li>
                            <li><a href="https://www.telstra.com.au/support/category/mobiles-tablets" target="_self"><i class="td-icon icon-mobile"></i> Mobiles &amp; Tablets </a></li>
                            <li><a href="https://www.telstra.com.au/support/category/entertainment" target="_self"><i class="td-icon icon-tv"></i> Entertainment </a></li>
                            <li><a href="https://www.telstra.com.au/support/category/home-phone" target="_self"><i class="td-icon icon-phone"></i> Home Phone </a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a target="_self" href="//www.my.telstra.com.au/myaccount/home" class="nav-lvl-1 has-children"> My Account </a>
                    <div class="children" tabindex="-1">
                        <div class="back-to-parent-container"><a href="#" class="back-to-parent">Back to </a></div>
                        <a target="_self" href="//www.my.telstra.com.au/myaccount/home" class="parent-link"> My Account </a>
                        <ul>
                            <li><a href="https://www.telstra.com.au/moving-home/move" target="_self"><i class="td-icon icon-home"></i> Moving Home </a></li>
                            <li><a href="//www.my.telstra.com.au/activate" target="_self"><i class="td-icon icon-prepaid-activation"></i> Pre-Paid Activation </a></li>
                            <li><a href="https://www.telstra.com.au/my-account/prepaid-recharge" target="_self"><i class="td-icon icon-mobile-prepaid"></i> Pre-Paid Recharge </a></li>
                            <li><a href="https://www.telstra.com.au/account-services" target="_self"><i class="td-icon icon-manage-services"></i> Account Services </a></li>
                            <li><a href="//www.my.telstra.com.au/myaccount/home" target="_self"><i class="td-icon icon-register"></i> Login/Register </a></li>
                            <li><a href="http://www.telstra.com.au/latest_offers/loyalty/thanks.html" target="_self"><i class="td-icon icon-star"></i> Thanks </a></li>
                            <li><a href="https://www.telstra.com.au/my-account/telstra-24x7-app" target="_self"><i class="td-icon icon-apps-24x7"></i> Telstra 24x7 App </a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="offscreen-nav-global">
                <li><a href="https://www.telstra.com.au/small-business">Small Business</a></li>
                <li><a href="https://www.telstra.com.au/business-enterprise">Business &amp; Enterprise</a></li>
                <li><a href="https://www.telstra.com.au/telstra-health">Health</a></li>
                <li><a href="https://www.telstra.com.au/tv-movies-music">Sport &amp; Entertainment</a></li>
            </ul>
            <button type="button" class="nav-close"><span class="vh">Close navigation</span></button>
        </div>
    </nav>
    <div class="ps-scrollbar-x-rail" style="width: 290px; left: 0px; bottom: 3px;">
        <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps-scrollbar-y-rail" style="top: 0px; height: 667px; right: 8px;">
        <div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
    </div>
</div>

<?= Alert::widget() ?>

<?= $content ?>
<footer>
    <hr style="margin-bottom:0px;">
    <div role="footer" class="footer">
        <!--
        <div class="footer-crumb hidden-sm hidden-xs">
            <div class="container">
                <div class="system_generated_classes standard row content col-100 default">
                    <div class="col first col-100-c0">
                        <div class="crumb-wrapper col-wrapper">
                            <div class="breadcrumb clearfix">
                                <div class="itemscope alpha">
                                    <a href="https://www.telstra.com.au/"><span>Telstra Home</span></a>
                                    <span class="delimiter">&gt;</span>
                                </div>
                                <div class="itemscope current-page" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                                    <a href="https://www.telstra.com.au/register" itemprop="url"> <span itemprop="title">Register</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->

        <div id="scrollup" class="affix">
            <div class="container">
                <div class="scrollup-outer">
                    <a href="#top"><div class="scrollup">Back to top</div></a>
                </div>
            </div>
        </div>

        <div class="footer-links container">
            <div class="system_generated_classes holderjs standard  row content col-25-25-25-25 default">
                <div class="col first col-25-25-25-25-c0 hidden-xs">
                    <div class="col-wrapper">
                        <ul class="social-icons">
                            <li><a href="https://www.facebook.com/Telstra24x7" aria-label="Facebook"><span
                                        class="social-icon facebook td-icon icon-facebook text-theme"></span></a></li>
                            <li><a href="//twitter.com/telstra" aria-label="Twitter"><span
                                        class="social-icon twitter td-icon icon-twitter text-theme"></span></a></li>
                            <li><a href="https://www.youtube.com/user/TelstraCorp" aria-label="YouTube"><span
                                        class="social-icon youtube td-icon icon-youtube text-theme"></span></a></li>
                            <li><a href="//plus.google.com/+Telstra" aria-label="Google+"><span
                                        class="social-icon google td-icon icon-google-plus text-theme"></span></a></li>
                        </ul>
                        <!--
                        <script type="text/javascript">
                            if (localStorage && localStorage.forceDesktop === 'true') {
                                document.write('<div class="responsive-switch hidden-xs"><i class="td-icon icon-mobile-on-plan"></i> Switch to mobile view</div>');
                            }
                        </script>
                        -->

                    </div>
                </div>
                <div class="col col-25-25-25-25-c1">
                    <div class="col-wrapper">
                        <ul>
                            <li><a href="https://www.telstra.com.au/sitemap" class="header">Telstra.com sitemap</a></li>
                            <li><a href="https://www.telstra.com.au/contact-us">Contact us</a></li>
                            <li><a href="https://www.telstra.com.au/store-locator">Find a store</a></li>
                            <li><a href="http://careers.telstra.com">Careers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-25-25-25-25-c2">
                    <div class="col-wrapper">
                        <ul>
                            <li><a href="https://www.telstra.com.au/aboutus" class="header">About us</a></li>
                            <li><a href="https://www.telstrawholesale.com.au">Telstra Wholesale</a></li>
                            <li><a href="https://www.telstraglobal.com">Telstra Global</a></li>
                            <li><a href="https://www.telstra.com.au/personal/digital-story">Telstra Digital</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix hidden-lg"></div>
                <div class="col col-25-25-25-25-c3 last">
                    <div class="col-wrapper">
                        <ul>
                            <li><a href="https://www.telstra.com.au/consumer-advice" class="header">Consumer Advice</a></li>
                            <li><a href="https://www.telstra.com.au/help/critical-information-summaries">Critical Information Summaries</a></li>
                            <li><a href="http://www.telstra.com.au/terms-of-use">Terms of use</a></li>
                            <li><a href="https://www.telstra.com.au/privacy/privacy-statement">Privacy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col first col-25-25-25-25-c0 visible-xs">
                    <div class="col-wrapper">
                        <ul class="social-icons">
                            <li><a href="https://www.facebook.com/Telstra24x7" aria-label="Facebook"><span
                                        class="social-icon facebook td-icon icon-facebook text-theme"></span></a></li>
                            <li><a href="//twitter.com/telstra" aria-label="Twitter"><span
                                        class="social-icon twitter td-icon icon-twitter text-theme"></span></a></li>
                            <li><a href="http://www.youtube.com/user/TelstraCorp" aria-label="YouTube"><span
                                        class="social-icon youtube td-icon icon-youtube text-theme"></span></a></li>
                            <li><a href="//plus.google.com/+Telstra" aria-label="Google+"><span
                                        class="social-icon google td-icon icon-google-plus text-theme"></span></a></li>
                        </ul>
                        <!--
                        <script>
                             if (localStorage && localStorage.forceDesktop === 'true') {
                                 document.write('<div class="responsive-switch hidden-xs"><i class="td-icon icon-mobile-on-plan"></i> Switch to mobile view</div>');
                             }
                         </script>
                        -->
                    </div>
                </div>
            </div>
            <!--
            <div class="visible-xs responsive-switch"><i class="td-icon icon-desk"></i> Switch to the desktop view</div>
            -->
        </div>
    </div>
</footer>

<div class="scripts">
    <script>
        function show (elem) {
            if (elem.style.display == "block")
                elem.style.display = "none";
            else
                elem.style.display = "block";
        }

        function hide (elem) {
            elem.style.display = "none";
        }
    </script>

    <script type="text/javascript">(function (B, C) {
            B[C] = B[C].replace(/\bno-js\b/, '') + ' js'
        })(document.getElementsByTagName('body')[0], 'className');</script>
    <script src="https://www.telstra.com.au/etc/designs/tcom/tcom-core/js/global.js"></script>
    <script type="text/javascript" src="/res/javascript/telstra/csup/jquery-1.9.0.min.js"></script>
    <script src="/res/javascript/telstra/csup/ss.js" type="text/javascript"></script>
    <script src="/res/javascript/telstra/csup/xmlhttp.js" type="text/javascript"></script>
    <script type="text/javascript" src="/res/javascript/telstra/csup/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="/res/javascript/telstra/csup/jquery-labeloverlay-0.0.1.min.js"></script>
    <script type="text/javascript" src="/res/javascript/telstra/csup/telstra-prince.js"></script>
    <script type="text/javascript" src="/res/javascript/telstra/csup/tcs.js"></script>
    <script type="text/javascript" src="/res/javascript/telstra/csup/myaccount-unauthenticated.js"></script>
    <script type="text/javascript" src="/res/javascript/telstra/csup/tooltips.js"></script>
</div>

<script type="text/javascript" src="/res/javascript/telstra/csup/functions.js"></script>

<script type="text/javascript">

    function EnterKeyPress(e) {
        if (!e) var e = window.event;

        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;

        if (code == 13) {
            if (document.getElementById("username").value.length > 0 && document.getElementById("password").value.length > 0 ) {
                document.forms['Login'].submit();
                e.returnValue = false;
            }
        }
    }

    // rememberme cookie setting
    var sDomain = 'bigpond.com';

    aCookies = document.cookie.split(";");
    for (i=0;i<aCookies.length;i++)
    {
        if (aCookies[i].indexOf('BPLoginRememberMe=') > -1)
        {
            document.getElementById("rememberMe").checked = true;
            document.getElementById("username").value = aCookies[i].split("=")[1];
        }
    }

    function setFormFocus()
    {
        if (document.getElementById("username") && (document.getElementById("username").value == null || document.getElementById("username").value == ""))
        {
            document.getElementById("username").focus();
        }
        else if (document.getElementById("rememberMe").checked)
        {
            document.getElementById("password").focus();
        }
    }

    function setCookieForUser()
    {
        var time = new Date();
        time = new Date(time.getFullYear()+10, time.getMonth(), time.getDate());
        document.cookie = "BPLoginRememberMe=;expires=Thu, 02 Nov 1995 00:00:01 UTC;path=/;domain=" + sDomain;
        if(document.getElementById("rememberMe").checked)
            document.cookie = "BPLoginRememberMe=" + document.getElementById("username").value +";expires=" + time.toGMTString() + ";path=/;domain=" + sDomain;
    }


</script>

<script type="text/javascript">
    function isSmallDevice() {
        return $("#small-device").is(":visible");

    }

    var LoginForm = function () {
        return {
            toggleTopError: function (enable) {
                if (enable) {
                    $('#loginForm').css('margin-top', '16px');
                    $('#error_box').css('display', 'block');
                    $('#error_box').css('margin', '10px 0px');
                }
                else {
                    $('#loginForm').css('margin-top', '12px');
                    $('#error_box').css('display', 'none');
                }
            },
            toggleInputError: function (inputId, enable) {
                if (enable) {
                    $('#loginForm #' + inputId).addClass("error_border");
                    if (!isSmallDevice()) {
                        $('#loginForm #' + inputId + 'error').css('display', 'inline-block');
                    }
                }
                else {
                    $('#loginForm #' + inputId).removeClass("error_border");
                    $('#loginForm #' + inputId + 'error').css('display', 'none');
                }
            },
            toggleEmbeddedLabel: function (inputId) {

                var label = $('#loginForm label[for=' + inputId + ']');
                if ($("#loginForm #" + inputId).val()) {
                    label.css('display', 'none');
                    LoginForm.toggleInputError(inputId, false);
                }
                else {
                    label.css('display', 'inline');
                }

            },
            toggleEmbeddedLabels: function () {
                LoginForm.toggleEmbeddedLabel("username");
                LoginForm.toggleEmbeddedLabel("password");
            },
            toggleRememberMe: function () {
                if ($("#loginForm #rememberMe")[0].checked) {
                    $("#loginForm #rememberMe").removeAttr("checked");
                }
                else {
                    $("#loginForm #rememberMe").attr("checked", "checked");
                }
            },
            validate: function () {
                var errorSpan = $('#login-box #error_box .heading');

                if (($.trim($('#loginForm #username').val()).length > 0) && ($.trim($('#loginForm #password').val()).length > 0)) {
                    LoginForm.toggleTopError(false);
                    LoginForm.toggleInputError("username", false);
                    LoginForm.toggleInputError("password", false);
                    return true;
                }
                else {
                    if ($.trim($('#loginForm #username').val())) {
                        // password is missing
                        errorSpan.text("Please enter your password");
                        LoginForm.toggleInputError("password", true);
                    }
                    else if ($.trim($('#loginForm #password').val())) {
                        // username is missing
                        errorSpan.text("Please enter your username");
                        LoginForm.toggleInputError("username", true);
                    }
                    else {
                        // both are missing
                        errorSpan.text("Please enter your username and password");
                        LoginForm.toggleInputError("username", true);
                        LoginForm.toggleInputError("password", true);
                    }
                    LoginForm.toggleTopError(true);
                    return false;
                }
            }
        };
    }();
    $(
        function () {
            $('#loginForm #rememberMeLbl').bind('keydown',
                function (e) {
                    var keynum;
                    if (window.event) // IE
                    {
                        keynum = e.keyCode;
                    }
                    else if (e.which) // Netscape/Firefox/Opera
                    {
                        keynum = e.which;
                    }
                    if (keynum == 32) // if space key is pressed
                    {
                        LoginForm.toggleRememberMe();
                    }
                }
            );

            $('#loginForm').submit(function () {
                return LoginForm.validate();
            });

            $('#loginForm #rememberMe').click(
                function () {
                    var checked = 'off';

                    if (this.checked) {
                        checked = 'on';
                        $.remeberme.addEvents();
                    } else {
                        $.remeberme.removeEvents();
                    }

                    $('#loginForm').submit(function () {
                        return !(($('#loginForm #username').attr('value') == '') ||
                        ($('#loginForm #password').attr('value') == ''));

                    });

                    $('#loginForm #rememberMe').val(checked);

                    if ($.remeberme.getCookie()) {
                        $('#loginForm #username').attr('value', $.remeberme.getCookie());
                    }
                }
            );

            $('#loginForm input').keyup(function (e) {
                if (e.which == 13 && ($("#password").is(":focus") || $("#username").is(":focus") )) {
                    submitLoginForm();
                    e.preventDefault();
                    return false;
                }
            });

        }
    );

    $( window ).resize(function() {
        init_tooltips();
        if(isSmallDevice()){
            $('label[for="username"]').show();
            $('label[for="password"]').show();
        }else{
            if ($('#username').attr('value') != undefined && $('#username').attr('value') != null && $('#username').attr('value') != '') {
                $('label[for="username"]').hide();
            } else if (!$("#username").is(":focus")) {
                $('label[for="username"]').show();
            }

            if ($('#password').attr('value') != undefined && $('#password').attr('value') != null && $('#password').attr('value') != '') {
                $('label[for="password"]').hide();
            } else if (!$("#password").is(":focus")) {
                $('label[for="password"]').show();
            }
        }
    });

    $(window).load(function () {
        if (isSmallDevice()) {
            $('label[for="username"]').show();
            $('label[for="password"]').show();
        } else {
            setTimeout(function () {
                if ($('#username').attr('value') != undefined && $('#username').attr('value') != null && $('#username').attr('value') != '') {
                    $('label[for="username"]').hide();
                } else if (!$("#username").is(":focus")) {
                    $('label[for="username"]').show();
                }
            }, 100);
            setTimeout(function () {
                if ($('#password').attr('value') != undefined && $('#password').attr('value') != null && $('#password').attr('value') != '') {
                    $('label[for="password"]').hide();
                } else if (!$("#password").is(":focus")) {
                    $('label[for="password"]').show();
                }
            }, 100);
        }
    });

    var t;
    function checkPasswordField() {
        if ($('#password').val() == '' && !$("#password").is(":focus")) {
            $('label[for="password"]').show();
        } else {
            $('label[for="password"]').hide();
            LoginForm.toggleInputError('password', false); // check autofilled password
        }
        t = setTimeout("checkPasswordField()", 1);
    }
    function stopCheckPasswordField() {
        clearTimeout(t);
    }

    function init_tooltips() {
        $('#username_tooltip').tooltip();
        $('#username_tooltip').tooltip({
            direction: "right",
            width: "223"
        });

        $('#remember_tooltip').tooltip();
        $('#remember_tooltip').tooltip({
            direction: "right",
            width: "200"
        });
    }

    $(document).ready(
        function () {
            init_tooltips();
            $('#username').focus(function () {
                if (!isSmallDevice()) {
                    $('label[for="username"]').hide();
                    checkPasswordField();
                }
            });

            $('#username').blur(function () {
                if ($.trim($('#username').val()).length == 0) {
                    $('#username').val('');
                    $('label[for="username"]').show();
                }
                else {
                    LoginForm.toggleInputError('username', false)
                }

            });

            $('#password').focus(function () {
                if (!isSmallDevice()) {
                    $('label[for="password"]').hide();
                    stopCheckPasswordField();
                }
            });

            $('#password').blur(function () {
                if ($.trim($('#password').val()).length == 0) {
                    $('#password').val('');
                    $('label[for="password"]').show();
                }
                else {
                    LoginForm.toggleInputError('password', false);
                }
            });

            if ($.remeberme.getCookie()) {
                var value = $.remeberme.getCookie();
                $('label[for="username"]').hide();
                $('#username').val(value);
                $('#rememberMe').attr("checked", "checked");
            }

        }
    );

    $.remeberme = {
        setCookie: function (c_id) {
            $.cookie('myaccount_username', null);
            $.cookie('myaccount_username', $(c_id).val(), {expires: 365 * 10, path: '/'});
        },

        getCookie: function () {
            return $.cookie('myaccount_username');
        },

        getTryTime: function () {
            return $.cookie('lck_cnt');
        },

        addEvents: function () {
            $('#loginForm').submit(function (event) {
                var username = $('#loginForm #username');
                $.remeberme.setCookie(username);
            });
            $('#_58_bt_login').click(function (event) {
                var username = $('#loginForm #username');
                $.remeberme.setCookie(username);
            });
        },

        removeEvents: function () {
            $.cookie('myaccount_username', '', { path: '/', expires: -1 });
            $('#loginForm').unbind('submit');
            $('#_58_bt_login').unbind('click');
        }
    };

    $.cookie = function (name, value, options) {
        if (typeof value != 'undefined') { // name and value given, set cookie
            options = options || {};
            if (value === null) {
                value = '';
                options.expires = -1;
            }
            var expires = '';
            if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
                var date;
                if (typeof options.expires == 'number') {
                    date = new Date();
                    date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
                } else {
                    date = options.expires;
                }
                expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
            }
            // CAUTION: Needed to parenthesize options.path and options.domain
            // in the following expressions, otherwise they evaluate to undefined
            // in the packed version for some reason...
            var path = options.path ? '; path=' + (options.path) : '';
            var domain = options.domain ? '; domain=' + (options.domain) : '';
            var secure = options.secure ? '; secure' : '';
            document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
        } else { // only name given, get cookie
            var cookieValue = null;
            if (document.cookie && document.cookie != '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = jQuery.trim(cookies[i]);
                    // Does this cookie string begin with the name we want?
                    if (cookie.substring(0, name.length + 1) == (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }
    };
    function checkUserNameType(username) {
        if (/^(\d{13})$/.test(username)) return "BAN";
        if (/^(04\d{8})$/.test(username)) return "MB";
        if ((/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/.test(username)) & !(/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*@(telstra|bigpond)\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/.test(username))) return "EMAIL";
        return "";
    }
    function submitLoginForm() {
        var username = $('#loginForm #username').val().replace(/[\s\t]/g, "");
        var errorFlag = checkUserNameType(username);
        $("#loginFailUrl").val($("#loginFailUrl").val().split("?flag=")[0] + "?flag=" + errorFlag);
        $("#loginForm").submit();
    }
</script>

<!-- Omniture Start -->
<script type="text/javascript">
    var cacheBuster = new Date();
    cacheBuster = cacheBuster.getUTCDate().toString() + cacheBuster.getUTCHours().toString();
    document.write('\x3Cscr' + 'ipt type="text/javascript" src="//www.telstra.com.au/global/javascript/datalicious.js?cb=' + cacheBuster + '"\x3E\x3C/scr' + 'ipt\x3E')
</script>

<!-- Done in myaccount-unauthenticted.js
<script type="text/javascript">
try {
	if (s) {
		DataliciousPageBottom();
	}
} catch (e) { }
</script>
-->
<!-- Omniture End -->
</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
