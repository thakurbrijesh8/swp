<?php
if (!isset($temp_access_token)) {
    print_r('Invalid Access');
    return;
}
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url));
$this->load->view('common/validation_message');
$this->load->view('security');
?>


<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Mobile Number Verification</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-md-4"></div>
            <div class="col-sm-8 col-md-4">
                <div class="feature-box f-style-2 icon-grad h-100">
                    <h4 class="text-center text-primary" id="success_message_for_verification_title">Mobile Number Verification</h4>
                    <hr class="mb-1">
                    <div class="form mt-3" id="success_message_for_verification">
                        <div>
                            <div class="text-center mb-2">
                                <span class="error-message error-message-login font-weight-bold" style="border-bottom: 2px solid red;"></span>
                            </div>
                        </div>
                        <?php if (isset($email_verify_message)) { ?>
                            <div class="text-center mb-2">
                                <span class="font-weight-bold error-message">Your Email Address Verified Successfully.</span><br>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <span class="text-success"><?php echo $message; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span class="error-message font-weight-bold">Enter OTP : 111111</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3 text-center">
                                <span class="font-weight-bold" style="border-bottom: 2px solid red; color: blue;" id="success_message_for_otp"></span>
                            </div>
                        </div>
                        <form method="post" id="otp_form" autocomplete="off" onsubmit="return false;">
                            <input type="hidden" id="temp_access_token" name="temp_access_token" value="<?php echo $temp_access_token; ?>"/>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <input type="text" id="temp_otp" name="temp_otp" class="form-control mb-0" placeholder="Enter OTP" onkeypress='checkNumeric($(this));'
                                           maxlength="6" onblur="checkNumeric($(this));
                                                   checkValidation('verification', 'temp_otp', OTPValidationMessage);
                                                   $('#success_message_for_otp').html('');">
                                    <span class="error-message error-message-verification-temp_otp"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-grad mb-0 btn-block" id="save_otp_btn"
                                            onclick="verifyOTP($(this));">Verify</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-grad mb-0 btn-block" id="resend_otp_btn_for_mobile_verification"
                                            onclick="resendOTPForMobileVerification($(this));">Resend OTP</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>
<script type="text/javascript">
    $('#otp_form').find('input').keypress(function (e) {
        if (e.which == 13) {
            verifyOTP($('#save_otp_btn'));
        }
    });
    function checkValidationForOTP(otpverifyFormData) {
        if (!otpverifyFormData.temp_otp) {
            return getBasicMessageAndFieldJSONArray('temp_otp', OTPValidationMessage);
        }
        return '';
    }
    function verifyOTP(btnObj) {
        $('#success_message_for_otp').html('');
        var otpverifyFormData = $('#otp_form').serializeFormJSON();

        var validationData = checkValidationForOTP(otpverifyFormData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('verification-' + validationData.field, validationData.message);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html('Processing..');
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: "confirmation/check_otp_verification",
            data: $.extend({}, otpverifyFormData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('verification-temp_otp', textStatus.statusText);
            },
            success: function (data) {
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    btnObj.html(ogBtnHTML);
                    btnObj.attr('onclick', ogBtnOnclick);
                    validationMessageShow('verification-temp_otp', parseData.message);
                    return false;
                }
                var template = '<h6 class="text-success">' + parseData.message + '</h6><div class="text-center"><br><a class="btn btn-grad text-white" href="' + baseUrl + 'home">Back to Home</a></div>';
                $('#success_message_for_verification').html(template);
                $('#success_message_for_verification_title').html('Verification Successfull !');
            }
        });
    }

    function resendOTPForMobileVerification(btnObj) {
        if (!btnObj) {
            return false;
        }
        $('#success_message_for_otp').html('');
        var tempAccessToken = $('#temp_access_token').val();
        if (!tempAccessToken) {
            validationMessageShow('verification-temp_otp', invalidAccessValidationMessage);
            return false;
        }
        btnObj.html('Processing..');
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: "confirmation/resend_otp_by_temp_access_token",
            data: $.extend({}, {'temp_access_token': tempAccessToken}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html('Resend OTP');
                btnObj.attr('onclick', 'resendOTPForMobileVerification($(this));');
                validationMessageShow('verification-temp_otp', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    btnObj.html('Resend OTP');
                    btnObj.attr('onclick', 'resendOTPForMobileVerification($(this));');
                    validationMessageShow('verification-temp_otp', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#success_message_for_otp').html(parseData.message);
                countDownForOTP(btnObj);
            }
        });
    }
</script>