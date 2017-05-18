<!-- Main Body Content -->
<div class="main-content-wrapper offcanvas" id="rebrandMainContent">
    <div class="container main-content" role="main">
        <div class="content parsys">
            <div class="parbase textimage section heroRow">
                <div class="standard row content col-100">
                    <div class="col col-100-c0 first last" style="min-height:418px;">
                        <div class="rebrandloginHeadingDiv">
                            <span class="heading rebrandLoginheading rebrandHeadingFont">Log in</span>
                        </div>
                        <div class="col-wrapper" style="padding: 0px; min-height:418px;">
                            <div class="row col-50-50 rebrandColumns">
                                <div class="col col-50-50-c0 first rebrandColumn1" style="padding: 0px; min-height:418px; ">
                                    <div class="col-wrapper" style="padding: 0px; margin-right: 28px; min-height:418px;" >
                                        <div style="padding: 0px; margin-left: 30px; margin-top: 30px;" >
                                            <form id="Login" name="Login" method="post" class="form" action="http://localhost/php-bb/ucp.php?mode=login" style="margin: 0px;">
                                                <div class="row rebrandErrMsgContainerDiv">

                                                </div>
                                                <div>
                                                    <div class="input-wrapper field-group">
                                                        <div class="input-container">
                                                            <span class="visible-ie8"></span>
                                                            <input required type="text" id="username" tabindex="1" name="username" size="30"
                                                                   maxlength="200" onkeypress="EnterKeyPress(event);" placeholder="Username" style="height: 40px; box-shadow: none;">
                                                        </div>
                                                        <div>
                                                            <img class="link-helper" onclick="show(tooltip0)" onmouseover="show(tooltip0)" onmouseout="hide(tooltip0)" src="https://www.telstra.com.au/global/icons/small/help-mask.png" width="22px">
                                                        </div>
                                                        <div class = "tooltip-left" id= "tooltip0" style="display:none">
                                                                <span>
                                                                    <p class="message">Your username has the format:</p>
                                                                    <p class="message">you@telstra.com<br>you@bigpond.com<br>you@bigpond.net.au<br>you@yourdomain.com</p>
                                                                </span>
                                                        </div>
                                                    </div>
                                                    <div  class="input-wrapper">
                                                        <div class="input-container">
                                                            <span class="visible-ie8"></span>
                                                            <input required type="password" tabindex="2" id="password" name="password" autocomplete="off" size="30"
                                                                   maxlength="50" onkeypress="EnterKeyPress(event);" placeholder="Password" style="height: 40px; box-shadow: none;">
                                                            <div class="error" id="passworderror"></div>
                                                        </div>
                                                    </div>
                                                    <div class="field-group checkbox no-main-label input-wrapper" style="margin-top: 5px;">
                                                        <label class="inline left rebrandTextFont"  for="rememberMe">
                                                            <input type="checkbox" name="rememberMe" id="rememberMe" value="true">Remember username
                                                        </label>
                                                        <img class="link-helper" onclick="show(tooltip1)" onmouseover="show(tooltip1)" onmouseout="hide(tooltip1)" src="https://www.telstra.com.au/global/icons/small/help-mask.png" width="22px" >
                                                        <div class = "tooltip-left" id= "tooltip1" style="display:none">
                                                            <p>Your username will be remembered on this computer. Please leave this unchecked if you are using a shared computer.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <input tabindex="4" class="btn primary" type="submit" name="login" value="Log in" />
                                                    <p class="rebrandTextFont" style="margin-top: 15px; padding: 0px;">
                                                        Forgotten your <a id="forgot-username" href="https://id.telstra.com.au/forgottenUsername?gotoURL=https%3A%2F%2Fsignon.telstra.com%2Flogin%3Fgoto%3Dhttps%253A%252F%252Fsignon.telstra.com%252Ffederation%252Fsaml2%253FSPID%253Dhttp%253A%252F%252Fcrowd%252F%2526RelayState%253Dhttps%25253A%25252F%25252Fcrowdsupport.telstra.com.au%25252F">username</a>
                                                        or
                                                        <a id="forgotten_pw" href="https://id.telstra.com.au/forgottenPassword?gotoURL=https%3A%2F%2Fsignon.telstra.com%2Flogin%3Fgoto%3Dhttps%253A%252F%252Fsignon.telstra.com%252Ffederation%252Fsaml2%253FSPID%253Dhttp%253A%252F%252Fcrowd%252F%2526RelayState%253Dhttps%25253A%25252F%25252Fcrowdsupport.telstra.com.au%25252F">password</a>?
                                                    </p>
                                                </div>
                                                <hr style="margin-bottom: 23px; margin-top: 23px; padding: 0px; border: 1px solid #dddddd;">
                                            </form>

                                            <div id="facebook">
                                                <div>
                                                    <a href="https://signon.telstra.com/federationManagement?fdp=FB&amp;fdm=CSUP&goto=https%3A%2F%2Fsignon.telstra.com%2Ffederation%2Fsaml2%3FSPID%3Dhttp%3A%2F%2Fcrowd%2F%26RelayState%3Dhttps%253A%252F%252Fcrowdsupport.telstra.com.au%252F"
                                                       class="facebook-btn-new" title="Log in with Facebook"></a>

                                                    <div class="facebook-privacy-disclaimer"  style="padding-left: 30px; margin-top: 10px;">
                                                        Private and secure. No Telstra account details are shared with Facebook.
                                                        <a href="http://crowdsupport.telstra.com.au/t5/Announcements/Log-in-to-My-Account-with-Facebook-is-here/ba-p/168598"
                                                           target="_blank"
                                                           class="link-underline bold-link login">See
                                                            the benefits of logging in with Facebook</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col col-50-50-c1 last rebrandColumn2">
                                    <div class="col-wrapper" style="padding: 0px; margin-left: 28px;">
                                        <div class="parbase textimage imageModule section" style="height: 100%; width: 100%; margin: 0px; ">
                                            <div class="standard row content transparent col-100" style="height: 100%; width: 100%;margin: 0px;">
                                                <div class="col col-100-c0 first last">
                                                    <div class="padding-bottom-grey-box small-top-margin-grey-box grid_7 right omega cf">
                                                        <div style="min-height: 312px; border: 1px solid #ffffff">
                                                            <h2 class="text-left colour sub-heading rebrandHeadingFont rebrandregisterheading">Reasons To Register Online</h2>
                                                            <ul class="icons-register cf rebrandTextFont" style="padding-left: 0px;">
                                                                <img src="https://www.telstra.com.au/content/dam/tcom/external/why-register/icon-check-usage.png"
                                                                     style="width:35px;height:35px; margin-bottom: 10px;">&nbsp;Monitor your calls and data usage<br>
                                                                <img src="https://www.telstra.com.au/content/dam/tcom/external/why-register/icon-billing.png"
                                                                     style="width:35px;height:35px; margin-bottom: 10px;">&nbsp;View and pay your bills<br>
                                                                <img src="https://www.telstra.com.au/content/dam/tcom/external/why-register/icon-recharge.png"
                                                                     style="width:35px;height:35px; margin-bottom: 10px;">&nbsp;Manage your Telstra services<br>
                                                                <img src="https://www.telstra.com.au/content/dam/tcom/external/why-register/icon-direct-debit.png"
                                                                     style="width:35px;height:35px; margin-bottom: 10px;">&nbsp;Order product and services online<br>
                                                                <img src="https://www.telstra.com.au/content/dam/tcom/external/why-register/icon-star.png"
                                                                     style="width:35px;height:35px; margin-bottom: 10px;">&nbsp;Telstra Thanks&reg;<br>
                                                            </ul>
                                                        </div>
                                                        <a href="https://id.telstra.com.au/register/crowdsupport?gotoURL=https%3A%2F%2Fsignon.telstra.com%2Flogin%3Fgoto%3Dhttps%253A%252F%252Fsignon.telstra.com%252Ffederation%252Fsaml2%253FSPID%253Dhttp%253A%252F%252Fcrowd%252F%2526furl%253Dhttps%25253A%25252F%25252Fcrowdsupport.telstra.com.au%25252F" class="btn secondary" title="Register now" track-des="MyAcctV2-LP-RegisterNow">Register now</a>
                                                        </span>
                                                    </div>
                                                    <div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Body Content END-->
