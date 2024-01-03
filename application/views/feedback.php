<?php
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url, 'help' => 'active'));
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
                        <li class="breadcrumb-item">Comments / Feedback on Regulation</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-12">
                <div class="feature-box f-style-2 icon-grad h-100" id="cfr_success_message_container">
                    <h4 class="text-center text-primary">Comments / Feedback on Regulation</h4>
                    <hr class="mb-1">
                    <div class="form mt-3">
                        <div>
                            <div class="text-center mb-2">
                                <span class="error-message error-message-cfr font-weight-bold" style="border-bottom: 2px solid red;"></span>
                            </div>
                        </div>
                        <div class="w-100">
                            <form method="post" id="cfr_form" autocomplete="off" onsubmit="return false;">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Select Regulation</label>
                                        <div class="input-group">
                                            <select class="form-control" data-placeholder="">
                                                <option value="">Select Regulation</option>
                                                <option value="1">No Draft Regulation Available for Feedback Submission</option>
                                            </select>
                                        </div>
                                        <span class="error-message error-message-grievance-district"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Your Full Name <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="full_name_for_cfr" name="full_name_for_cfr" class="form-control" placeholder="Enter Your Full Name !"
                                                   maxlength="100" onblur="checkValidation('cfr', 'full_name_for_cfr', applicantFullNameValidationMessage);" value="">
                                        </div>
                                        <span class="error-message error-message-cfr-full_name_for_cfr"></span>
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Enter Your Land Line Number</label>
                                        <div class="input-group">
                                            <input type="text" id="landline_number_for_cfr" name="landline_number_for_cfr" class="form-control" 
                                                   placeholder="Enter Your Land Line Number  !" maxlength="15" value="">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Enter Your Mobile Number Registered on <a href="https://swp.dddgov.in/" >www.swp.dddgov.in</a> (if Registered).<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="mobile_number_for_cfr" name="mobile_number_for_cfr" class="form-control" placeholder="Enter Your Mobile Number  !"
                                                   maxlength="10" onblur="checkValidationForMobileNumber('cfr', 'mobile_number_for_cfr');" value="">
                                        </div>
                                        <span class="error-message error-message-cfr-mobile_number_for_cfr"></span>
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Enter your Email Address Registered on <a href="https://swp.dddgov.in/" >www.swp.dddgov.in</a> (if Registered).<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="email_for_cfr" name="email_for_cfr" class="form-control" placeholder="Enter Your Email Address  !"
                                                   maxlength="50" onblur="checkValidationForEmail('cfr', 'email_for_cfr');" value="">
                                        </div>
                                        <span class="error-message error-message-cfr-email_for_cfr"></span>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Comments / Feedback on Regulation <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <textarea id="feedback_for_cfr" name="feedback_for_cfr" class="form-control" 
                                                      placeholder="Enter Comments / Feedback on Regulation !" maxlength="1200"
                                                      onblur="checkValidation('cfr', 'feedback_for_cfr', cfrValidationMessage);"></textarea>
                                        </div>
                                        <span class="error-message error-message-cfr-feedback_for_cfr"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <button type="button" class="btn btn-grad mb-0 btn-block" id="submit_cfr_btn"
                                                onclick="submitFeedback($(this));">Submit</button>
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
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>
<script type="text/javascript">

    var baseURL = '<?php echo base_url(); ?>';
    var applicantFullNameValidationMessage = '<?php echo APPLICANT_FULL_NAME_MESSAGE; ?>';
    var mobileValidationMessage = '<?php echo MOBILE_NUMBER_MESSAGE; ?>';
    var invalidMobileValidationMessage = '<?php echo INVALID_MOBILE_NUMBER_MESSAGE; ?>';
    var emailValidationMessage = '<?php echo EMAIL_MESSAGE; ?>';
    var invalidEmailValidationMessage = '<?php echo INVALID_EMAIL_MESSAGE; ?>';
    var cfrValidationMessage = '<?php echo CFR_MESSAGE; ?>';
    
    allowOnlyIntegerValue('mobile_number_for_cfr');
    
    $('#cfr_form').find('input').keypress(function (e) {
        if (e.which == 13) {
            submitFeedback($('#submit_cfr_btn'));
        }
    });

    function checkValidationForFeedback(feedbackData) {
        if (!feedbackData.full_name_for_cfr) {
            return getBasicMessageAndFieldJSONArray('full_name_for_cfr', applicantFullNameValidationMessage);
        }
        if (!feedbackData.mobile_number_for_cfr) {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_cfr', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(feedbackData.mobile_number_for_cfr);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_cfr', mobileMessage);
        }
        if (!feedbackData.email_for_cfr) {
            return getBasicMessageAndFieldJSONArray('email_for_cfr', emailValidationMessage);
        }
        var emailMessage = emailIdValidation(feedbackData.email_for_cfr);
        if (emailMessage != '') {
            return getBasicMessageAndFieldJSONArray('email_for_cfr', emailMessage);
        }
        if (!feedbackData.feedback_for_cfr) {
            return getBasicMessageAndFieldJSONArray('feedback_for_cfr', cfrValidationMessage);
        }
        return '';
    }

    function submitFeedback(btnObj) {
        validationMessageHide();
        var feedbackData = $('#cfr_form').serializeFormJSON();
        var validationData = checkValidationForFeedback(feedbackData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('cfr-' + validationData.field, validationData.message);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html('Processing..');
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: "feedback/submit_cfr",
            data: $.extend({}, feedbackData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('cfr', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    validationMessageShow('cfr', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                var template = ' <h4 class="text-center text-primary">' + parseData.message + '</h4>';
                template += '<div class="text-center"><hr class="mb-1"><div class="form mt-3"><a class="btn btn-grad text-white mb-0" href="' + baseUrl + 'home">Back to Home</a></div></div>';
                $('#cfr_success_message_container').html(template);
            }
        });
    }
</script>