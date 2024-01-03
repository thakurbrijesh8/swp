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
                        <li class="breadcrumb-item">New Pin</li>
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
                    <h4 class="text-center text-primary" id="np_success_title_container">New Pin Form</h4>
                    <hr class="mb-1">
                    <div class="form mt-3" id="np_success_message_container">
                        <div>
                            <div class="text-center mb-2">
                                <span class="error-message error-message-login font-weight-bold" style="border-bottom: 2px solid red;"></span>
                            </div>
                        </div>
                        <form method="post" id="new_pin_form" autocomplete="off" onsubmit="return false;">
                            <input type="hidden" id="temp_access_token" name="temp_access_token" value="<?php echo $temp_access_token; ?>"/>
                            <div class="mb-3">
                                <p class="text-left mb-1">New Pin</p>
                                <input type="password" id="new_pin_for_np" name="new_pin_for_np" class="form-control mb-0" placeholder="New Pin !"
                                       onkeyup="checkNumeric($(this));"
                                       onblur="checkNumeric($(this)); checkValidationForPin('np', 'new_pin_for_np', newPinValidationMessage);"
                                       maxlength="6">
                                <span class="error-message error-message-np-new_pin_for_np"></span>
                            </div>
                            <div class="mb-3">
                                <p class="text-left mb-1">Retype New Pin</p>
                                <input type="pin" id="retype_new_pin_for_np" name="retype_new_pin_for_np" class="form-control mb-0" placeholder="Retype New Pin !"
                                       onkeyup="checkNumeric($(this));"
                                       onblur="checkNumeric($(this)); checkValidationForPin('np', 'retype_new_pin_for_np', retypeNewPinValidationMessage);"
                                       maxlength="6">
                                <span class="error-message error-message-np-retype_new_pin_for_np"></span>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <button type="button" class="btn btn-grad" id="change_pin_btn"
                                            onclick="changePin($(this));">Change Pin</button>
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
    allowOnlyIntegerValue('new_pin_for_np');
    allowOnlyIntegerValue('retype_new_pin_for_np');

    $('#new_pin_form').find('input').keypress(function (e) {
        if (e.which == 13) {
            changePin($('#change_pin_btn'));
        }
    });

    function checkValidationforNewPin(newPinData) {
        if (newPinData.new_pin_for_np == '') {
            return getBasicMessageAndFieldJSONArray('new_pin_for_np', newPinValidationMessage);
        }
        if (newPinData['new_pin_for_np'].length != 6) {
            return getBasicMessageAndFieldJSONArray('new_pin_for_np', sixDigitPinValidationMessage);
        }
        if (newPinData.retype_new_pin_for_np == '') {
            return getBasicMessageAndFieldJSONArray('retype_new_pin_for_np', retypeNewPinValidationMessage);
        }
        if (newPinData.new_pin_for_np != newPinData.retype_new_pin_for_np) {
            return getBasicMessageAndFieldJSONArray('retype_new_pin_for_np', notMatchPinValidationMessage);
        }
        return '';
    }

    function changePin(btnObj) {
        var that = this;
        validationMessageHide();
        var newPinData = $('#new_pin_form').serializeFormJSON();
        var validationData = checkValidationforNewPin(newPinData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('np-' + validationData.field, validationData.message);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html('Processing..');
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'forgot_pin/change_new_pin',
            data: $.extend({}, newPinData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('np', textStatus.statusText);
            },
            success: function (data) {
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    btnObj.html(ogBtnHTML);
                    btnObj.attr('onclick', ogBtnOnclick);
                    validationMessageShow('np', parseData.message);
                    return false;
                }
                $('#np_success_title_container').html('Pin Changed Successfully');
                var template = '<h6 class="text-success text-center">Click here to Login</h6><div class="text-center"><br><a class="btn btn-grad text-white" href="' + baseUrl + 'login">Login</a></div>';
                $('#np_success_message_container').html(template);
            }
        });
    }
</script>