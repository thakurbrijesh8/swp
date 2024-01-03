<?php $base_url = base_url(); ?>
<!doctype html>
<html lang="en">
    <head>
        <title>EODB Single Window Portal : Dadra and Nagar Haveli and Daman and Diu</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="EODB Single Window Portal : Dadra and Nagar Haveli and Daman and Diu">

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo $base_url; ?>assets/images/favicon.ico">

        <?php
        $this->load->view('new_common/css_links', array('base_url' => $base_url));
        $this->load->view('common/validation_message');
        $this->load->view('security');
        ?>
    </head>
    <body>
        <?php $this->load->view('new_common/loader', array('base_url' => $base_url)); ?>
        <!-- =======================
        Sign in -->
        <section class="p-0 d-flex align-items-center">
            <div class="container-fluid">
                <div class="row">
                    <!-- left -->
                    <div class="col-12 col-md-5 col-lg-4 d-md-flex align-items-center bg-grad h-sm-100-vh">
                        <div class="w-100 p-3 p-lg-5 all-text-white">
                            <div class="justify-content-center align-self-center mb-2">
                                <img src="<?php echo $base_url; ?>images/industries.png" />
                            </div>
                            <h3 class="font-weight-light text-center">Single Window Portal for Industrial Clearances</h3>
                            <!--<h3 class="font-weight-light text-center">Daman & Diu</h3>-->
                        </div>
                    </div>
                    <!-- Right -->
                    <div class="col-12 col-md-7 col-xl-8 mx-auto my-5">
                        <div class="row h-100">
                            <div class="col-12 col-md-10 col-lg-5 text-left mx-auto d-flex align-items-center">
                                <div class="w-100" id="fp_success_message_container">
                                    <form method="post" id="fp_form" autocomplete="off">
                                        <h2 class="">Forgot Pin</h2>
                                        <div class="form mt-4">
                                            <div>
                                                <div class="text-center mb-2">
                                                    <span class="error-message error-message-fp font-weight-bold" style="border-bottom: 2px solid red;"></span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-left mb-1">Mobile Number</p>
                                                <span class="form-group">
                                                    <input type="text" id="mobile_number_for_fp" name="mobile_number_for_fp" class="form-control mb-0" placeholder="Mobile Number !"
                                                           maxlength="10" onkeyup="checkNumeric($(this));"
                                                           onblur="checkNumeric($(this)); checkValidationForMobileNumber('fp', 'mobile_number_for_fp');">
                                                </span>
                                                <span class="error-message error-message-fp-mobile_number_for_fp"></span>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" id="captcha_code_for_fp" name="captcha_code_for_fp"/>
                                                <div class="row">
                                                    <div class="col-9 col-sm-8 col-md-9 text-center mb-3">
                                                        <span class="btn-block btn-flat captcha-code" id="captcha_container_for_fp"></span>
                                                    </div>
                                                    <div class="col-3 col-sm-4 col-md-3 mb-3">
                                                        <button type="button" class="btn btn-grad mb-0" onclick="setCaptchaCode('fp');"
                                                                style="padding-top: 11px;">
                                                            <i class="fa fa-refresh mr-0" style="font-size: 1.3em;"></i></button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mb-10px">
                                                        <input type="text" id="captcha_code_varification_for_fp" name="captcha_code_varification_for_fp" class="form-control mb-0" placeholder="Enter Answer of Calculation !" onkeypress='checkNumeric($(this));'
                                                               maxlength="3" onblur="checkNumeric($(this));">
                                                        <span class="error-message error-message-fp-captcha_code_varification_for_fp"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-dark" id="submit_btn_for_fp"
                                                            onclick="checkForgotPassword($(this));">Continue</button>
                                                    <a class="btn btn-grad text-white" href="<?php echo $base_url; ?>home">Back to Home</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php $this->load->view('new_common/js_links', array('base_url' => $base_url)); ?>
        <script type="text/javascript">
            allowOnlyIntegerValue('mobile_number_for_fp');
            allowOnlyIntegerValue('captcha_code_varification_for_fp');
            setCaptchaCode('fp');

            $('#fp_form').find('input').keypress(function (e) {
                if (e.which == 13) {
                    checkForgotPassword($('#submit_btn_for_fp'));
                }
            });

            function checkValidationForFP(fpFormData) {
                if (!fpFormData.mobile_number_for_fp) {
                    return getBasicMessageAndFieldJSONArray('mobile_number_for_fp', mobileValidationMessage);
                }
                var mobileMessage = mobileNumberValidation(fpFormData.mobile_number_for_fp);
                if (mobileMessage != '') {
                    return getBasicMessageAndFieldJSONArray('mobile_number_for_fp', mobileMessage);
                }
                if (!fpFormData.captcha_code_varification_for_fp) {
                    return getBasicMessageAndFieldJSONArray('captcha_code_varification_for_fp', captchaValidationMessage);
                }
                if ((fpFormData.captcha_code_varification_for_fp).trim() != (fpFormData.captcha_code_for_fp).trim()) {
                    return getBasicMessageAndFieldJSONArray('captcha_code_varification_for_fp', captchaVerificationValidationMessage);
                }
                return '';
            }

            function checkForgotPassword(btnObj) {
                validationMessageHide();
                var fpFormData = $('#fp_form').serializeFormJSON();
                var validationData = checkValidationForFP(fpFormData);
                if (validationData != '') {
                    setCaptchaCode('fp');
                    $('#' + validationData.field).focus();
                    validationMessageShow('fp-' + validationData.field, validationData.message);
                    return false;
                }
                var ogBtnHTML = btnObj.html();
                var ogBtnOnclick = btnObj.attr('onclick');
                btnObj.html('Processing..');
                btnObj.attr('onclick', '');
                $.ajax({
                    type: 'POST',
                    url: 'forgot_pin/check_forgot_pin',
                    data: $.extend({}, fpFormData, getTokenData()),
                    error: function (textStatus, errorThrown) {
                        generateNewCSRFToken();
                        setCaptchaCode('fp');
                        btnObj.html(ogBtnHTML);
                        btnObj.attr('onclick', ogBtnOnclick);
                        validationMessageShow('fp', textStatus.statusText);
                    },
                    success: function (data) {
                        var parseData = JSON.parse(data);
                        setNewToken(parseData.temp_token);
                        if (parseData.success == false) {
                            setCaptchaCode('fp');
                            btnObj.html(ogBtnHTML);
                            btnObj.attr('onclick', ogBtnOnclick);
                            validationMessageShow('fp', parseData.message);
                            return false;
                        }
                        var template = '<h4 class="mb-4 text-center"><span class="text-primary" style="border-bottom: 2px solid #007bff;">Link Sent Successfully</span></h4>';
                        template += '<h6>' + parseData.message + '</h6><div class="text-center"><a class="btn btn-grad text-white" href="' + baseUrl + 'home">Back to Home</a></div>';
                        $('#fp_success_message_container').html(template);
                    }
                });
            }
        </script>
    </body>
</html>