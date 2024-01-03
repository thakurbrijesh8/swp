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

        <?php $this->load->view('new_common/css_links', array('base_url' => $base_url)); ?>
        <?php $this->load->view('common/validation_message'); ?>
        <?php $this->load->view('security'); ?>
    </head>
    <body>
        <?php $this->load->view('new_common/loader', array('base_url' => $base_url)); ?>
        <!-- =======================
                Sign up -->
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
                            <h6 class="font-weight-light text-center">U.T. Administration of<br>Dadra Nagar Haveli & Daman and Diu</h6>
                        </div>
                    </div>
                    <!-- Right -->
                    <div class="col-12 col-md-7 col-xl-8 mx-auto my-2">
                        <div class="row h-100">
                            <div class="col-12 col-md-10 col-lg-6 text-left mx-auto d-flex align-items-center">
                                <div class="w-100" id="registration_success_message_container">

                                    <form method="post" id="registration_form" autocomplete="off">
                                        <h2>Register your account!</h2>
                                        <div class="form mt-4">
                                            <div>
                                                <div class="text-center mb-2">
                                                    <span class="error-message error-message-registration font-weight-bold" style="border-bottom: 2px solid red;"></span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-left mb-1">Applicant Name</p>
                                                <span class="form-group">
                                                    <input type="text" id="applicant_name_for_registration" name="applicant_name_for_registration" class="form-control mb-0" placeholder="Enter Applicant Name !"
                                                           maxlength="150" onblur="checkValidation('registration', 'applicant_name_for_registration', nameValidationMessage);">
                                                </span>
                                                <span class="error-message error-message-registration-applicant_name_for_registration"></span>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-left mb-1">Applicant Address</p>
                                                <span class="form-group">
                                                    <textarea id="applicant_address_for_registration" name="applicant_address_for_registration" class="form-control mb-0" placeholder="Enter Applicant Address !"
                                                              maxlength="200" onblur="checkValidation('registration', 'applicant_address_for_registration', addressValidationMessage);"></textarea>
                                                </span>
                                                <span class="error-message error-message-registration-applicant_address_for_registration"></span>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-left mb-1">Mobile Number</p>
                                                <span class="form-group">
                                                    <input type="text" id="mobile_number_for_registration" name="mobile_number_for_registration" class="form-control mb-0" placeholder="Mobile Number !"
                                                           maxlength="10" onkeyup="checkNumeric($(this));"
                                                           onblur="checkNumeric($(this)); checkValidationForMobileNumber('registration', 'mobile_number_for_registration');">
                                                </span>
                                                <span class="error-message error-message-registration-mobile_number_for_registration"></span>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-left mb-1">Email</p>
                                                <span class="form-group">
                                                    <input type="text" id="email_for_registration" name="email_for_registration" class="form-control mb-0" placeholder="Enter Applicant Email Address !"
                                                           maxlength="80" onkeypress="emailIdValidation($(this));" onblur="checkValidationForEmail('registration', 'email_for_registration', emailValidationMessage);">
                                                </span>
                                                <span class="error-message error-message-registration-email_for_registration"></span>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" id="captcha_code_for_registration" name="captcha_code_for_registration"/>
                                                <div class="row">
                                                    <div class="col-9 col-sm-8 col-md-9 text-center mb-3">
                                                        <span class="btn-block btn-flat captcha-code" id="captcha_container_for_registration"></span>
                                                    </div>
                                                    <div class="col-3 col-sm-4 col-md-3 mb-3">
                                                        <button type="button" class="btn btn-grad mb-0" onclick="setCaptchaCode('registration');"
                                                                style="padding-top: 11px;">
                                                            <i class="fa fa-refresh mr-0" style="font-size: 1.3em;"></i></button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mb-10px">
                                                        <input type="text" id="captcha_code_varification_for_registration" name="captcha_code_varification_for_registration" class="form-control mb-0" placeholder="Enter Answer of Calculation !" onkeypress='checkNumeric($(this));'
                                                               maxlength="3" onblur="checkNumeric($(this));">
                                                        <span class="error-message error-message-registration-captcha_code_varification_for_registration"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-dark" id="submit_btn_for_registration"
                                                            onclick="checkRegistration($(this));">Register</button>
                                                    <a class="btn btn-grad text-white" href="<?php echo $base_url; ?>home">Back to Home</a>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-12 p-0"><span class="text-muted">Already have an account ? <a href="<?php echo $base_url; ?>login">Login</a></span></div>
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
        <!-- =======================
        Sign up -->
        <?php $this->load->view('new_common/js_links', array('base_url' => $base_url)); ?>
        <script type="text/javascript">

            allowOnlyIntegerValue('mobile_number_for_registration');
            allowOnlyIntegerValue('captcha_code_varification_for_registration');
            setCaptchaCode('registration');

            $('#registration_form').find('input').keypress(function (e) {
                if (e.which == 13) {
                    checkRegistration($('#submit_btn_for_registration'));
                }
            });

            function checkValidationForRegistration(registrationFormData) {
                if (!registrationFormData.applicant_name_for_registration) {
                    return getBasicMessageAndFieldJSONArray('applicant_name_for_registration', nameValidationMessage);
                }
                if (!registrationFormData.applicant_address_for_registration) {
                    return getBasicMessageAndFieldJSONArray('applicant_address_for_registration', addressValidationMessage);
                }
                if (!registrationFormData.mobile_number_for_registration) {
                    return getBasicMessageAndFieldJSONArray('mobile_number_for_registration', mobileValidationMessage);
                }
                var mobileMessage = mobileNumberValidation(registrationFormData.mobile_number_for_registration);
                if (mobileMessage != '') {
                    return getBasicMessageAndFieldJSONArray('mobile_number_for_registration', mobileMessage);
                }
                if (!registrationFormData.email_for_registration) {
                    return getBasicMessageAndFieldJSONArray('email_for_registration', emailValidationMessage);
                }
                var emailMessage = emailIdValidation(registrationFormData.email_for_registration);
                if (emailMessage != '') {
                    return getBasicMessageAndFieldJSONArray('email_for_registration', emailMessage);
                }
                if (!registrationFormData.captcha_code_varification_for_registration) {
                    return getBasicMessageAndFieldJSONArray('captcha_code_varification_for_registration', captchaValidationMessage);
                }
                if ((registrationFormData.captcha_code_varification_for_registration).trim() != (registrationFormData.captcha_code_for_registration).trim()) {
                    return getBasicMessageAndFieldJSONArray('captcha_code_varification_for_registration', captchaVerificationValidationMessage);
                }
                return '';
            }

            function checkRegistration(btnObj) {
                validationMessageHide();
                var registrationData = $('#registration_form').serializeFormJSON();
                var validationData = checkValidationForRegistration(registrationData);
                if (validationData != '') {
                    setCaptchaCode('registration');
                    $('#' + validationData.field).focus();
                    validationMessageShow('registration-' + validationData.field, validationData.message);
                    return false;
                }
                btnObj.html('Processing..');
                btnObj.attr('onclick', '');
                $.ajax({
                    type: 'POST',
                    url: 'registration/new_registration',
                    data: $.extend({}, registrationData, getTokenData()),
                    error: function (textStatus, errorThrown) {
                        generateNewCSRFToken();
                        setCaptchaCode('registration');
                        btnObj.html('Register');
                        btnObj.attr('onclick', 'checkRegistration($(this))');
                        validationMessageShow('registration', textStatus.statusText);
                        $('html, body').animate({scrollTop: '0px'}, 0);
                    },
                    success: function (data) {
                        btnObj.html('Register');
                        btnObj.attr('onclick', 'checkRegistration($(this))');
                        var parseData = JSON.parse(data);
                        setNewToken(parseData.temp_token);
                        setCaptchaCode('registration');
                        if (parseData.success == false) {
                            validationMessageShow('registration', parseData.message);
                            $('html, body').animate({scrollTop: '0px'}, 0);
                            return false;
                        }
                        var template = '<h4 class="mb-4"><span class="text-primary text-center" style="border-bottom: 2px solid #007bff;">Registration Details Submitted Successfully</span></h4>';
                        template += '<h6>' + parseData.message + '</h6><div class="text-center"><a class="btn btn-grad text-white" href="' + baseUrl + 'home">Back to Home</a></div>';
                        $('#registration_success_message_container').html(template);
                    }
                });
            }
        </script>
    </body>
</html>