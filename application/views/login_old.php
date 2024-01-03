<?php $base_url = base_url(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FACILITATION PORTAL FOR SERVICES OF LABOUR & EMPLOYMENT AND FACTORIES & BOILERS | Log In</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->load->view('common/css_links', array('base_url' => $base_url)); ?>
        <?php $this->load->view('common/js_links', array('base_url' => $base_url)); ?>
        <?php $this->load->view('common/validation_message'); ?>
    </head>
    <body class="hold-transition layout-top-nav">
        <?php $this->load->view('security'); ?>
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <span class="brand-text font-weight-light" style="font-weight: bold !important;">
                        <span class="d-sm-block d-md-none d-lg-none" style="font-size: 15px !important;">FACILITATION PORTAL FOR SERVICES OF LABOUR & EMPLOYMENT AND FACTORIES & BOILERS</span>
                        <span class="d-none d-md-block d-lg-block" style="font-size: 25px !important;">FACILITATION PORTAL FOR SERVICES OF LABOUR & EMPLOYMENT AND FACTORIES & BOILERS</span>
                    </span>
                </div>
            </nav>
            <div class="content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-lg-4"></div>
                        <div class="col-sm-6 col-lg-4" style="margin-top: 12%;">
                            <div class="card">
                                <div class="card-body login-card-body">
                                    <p class="login-box-msg color-black" style="font-size: 20px;"><b>Login</b></p>
                                    <div class="text-center">
                                        <span class="error-message error-message-login f-w-b" style="border-bottom: 2px solid red;"></span>
                                    </div>
                                    <form id="login_form" method="post" style="padding-top: 20px;" onsubmit="return false;">
                                        <div class="col-xs-12 mb-3">
                                            <div class="input-group">
                                                <input type="text" id="mobile_number_for_login" name="mobile_number_for_login" class="form-control" placeholder="Mobile Number !"
                                                       maxlength="10" onkeyup="checkNumeric($(this));"
                                                       onblur="checkNumeric($(this)); checkValidationForMobileNumber('login', 'mobile_number_for_login');">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                                </div>
                                            </div>
                                            <span class="error-message error-message-login-mobile_number_for_login"></span>
                                        </div>
                                        <div class="col-xs-12 mb-3">
                                            <div class="input-group">
                                                <input type="password" id="pin_for_login" name="pin_for_login" class="form-control" placeholder="Pin !"
                                                       onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                                       maxlength ="6">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                                                </div>
                                            </div>
                                            <span class="error-message error-message-login-pin_for_login"></span>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" id="submit_btn_for_login" class="btn btn-nic-blue btn-block" onclick="checkLogin($(this));">Login</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-nic-blue btn-block" onclick="resetForm('login_form');">Clear</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('common/footer_text'); ?>
        </div>
    </body>
    <script type="text/javascript">
        allowOnlyIntegerValue('mobile_number_for_login');
        allowOnlyIntegerValue('pin_for_login');
        $('#login_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                checkLogin($('#submit_btn_for_login'));

            }
        });
        function checkValidationForLogin(loginFormData) {
            if (!loginFormData.mobile_number_for_login) {
                return getBasicMessageAndFieldJSONArray('mobile_number_for_login', mobileValidationMessage);
            }
            var mobileNumberMessage = mobileNumberValidation(loginFormData.mobile_number_for_login);
            if (mobileNumberMessage != '') {
                return getBasicMessageAndFieldJSONArray('mobile_number_for_login', mobileNumberMessage);
            }
            if (!loginFormData.pin_for_login) {
                return getBasicMessageAndFieldJSONArray('pin_for_login', pinValidationMessage);
            }
            if ((loginFormData.pin_for_login).length != 6) {
                return getBasicMessageAndFieldJSONArray('pin_for_login', invalidPinValidationMessage);
            }
            return '';
        }

        function checkLogin(btnObj) {
            validationMessageHide();
            var loginFormData = $('#login_form').serializeFormJSON();
            var validationData = checkValidationForLogin(loginFormData);
            if (validationData != '') {
                $('#' + validationData.field).focus();
                validationMessageShow('login-' + validationData.field, validationData.message);
                return false;
            }
            btnObj.html('Processing..');
            btnObj.attr('onclick', '');
            $.ajax({
                type: 'POST',
                url: 'login/check_login',
                data: $.extend({}, loginFormData, getTokenData()),
                error: function (textStatus, errorThrown) {
                    generateNewCSRFToken();
                    btnObj.html('Login');
                    btnObj.attr('onclick', 'checkLogin($(this))');
                    validationMessageShow('login', textStatus.statusText);
                },
                success: function (data) {
                    var parseData = JSON.parse(data);
                    setNewToken(parseData.temp_token);
                    if (parseData.success == false) {
                        btnObj.html('Login');
                        btnObj.attr('onclick', 'checkLogin($(this))');
                        validationMessageShow('login', parseData.message);
                        return false;
                    }
                    window.location = baseUrl + 'main';
                }
            });
        }
    </script>
</html>
