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
                        <li class="breadcrumb-item"> Track Query / Grievance Redressal</li>
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
                    <h4 class="text-center text-primary">Track Query / Grievance Redressal</h4>
                    <hr class="mb-1">
                    <div class="form mt-3">
                        <div>
                            <div class="text-center mb-2">
                                <span class="error-message error-message-grievance font-weight-bold" style="border-bottom: 2px solid red;"></span>
                            </div>
                        </div>
                        <div class="w-100" id="query_grievance_success_message_container">
                            <form method="post" id="track_query_grievance_form" autocomplete="off" onsubmit="return false;">
                                
                                <div class="row">
                                    <div class="form-group col-12 mb-3">
                                        <label class="mb-0" style="color: black;">Query Reference Number <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="reference_number" name="reference_number" class="form-control" placeholder="Enter Query Reference Number !"
                                                   maxlength="100" onblur="checkValidation('grievance', 'reference_number', queryReferenceNumberValidationMessage);" value="">
                                        </div>
                                        <span class="error-message error-message-grievance-reference_number"></span>
                                    </div>
                                </div>
                                <div class="row query_div" style="display: none;">
                                    <div class="form-group col-12 mb-3">
                                        <label class="mb-0" style="color: black;">Query.<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <textarea id="query" name="query" class="form-control" placeholder="Query Status !" maxlength="100" onblur="checkValidation('grievance', 'query', queryDetailValidationMessage);" readonly=""></textarea>
                                        </div>
                                        <span class="error-message error-message-grievance-query"></span>
                                    </div>
                                </div>
                                <div class="row query_div" style="display: none;">
                                    <div class="form-group col-12 mb-3">
                                        <label class="mb-0" style="color: black;">Query Response.<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <textarea id="query_response" name="query_response" class="form-control" placeholder="Query Status !" maxlength="100" onblur="checkValidation('grievance', 'query_response', queryDetailValidationMessage);" readonly=""></textarea>
                                        </div>
                                        <span class="error-message error-message-grievance-query_response"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 submit_btn">
                                        <button type="button" class="btn btn-grad mb-0 btn-block" id="track_query_grievance_btn"
                                                onclick="getQueryGrievance($(this));">Submit</button>
                                    </div>
                                    <div class="col-12 cancel_btn" style="display: none;">
                                        <button type="button" class="btn btn-grad mb-0 btn-block" id="track_query_grievance_btn"
                                                onclick="clearQueryGrievance();">Cancel</button>
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
    var queryReferenceNumberValidationMessage = '<?php echo QUERY_REFERENCE_NUMBER_MESSAGE; ?>';

    $('#track_query_grievance_form').find('input').keypress(function (e) {
        if (e.which == 13) {
            getQueryGrievance($('#track_query_grievance_btn'));
        }
    });

    function checkValidationForTrackQueryGrievance(trackQueryGrievanceData) {
        if (!trackQueryGrievanceData.reference_number) {
            return getBasicMessageAndFieldJSONArray('reference_number', queryReferenceNumberValidationMessage);
        }
        return '';
    }
    function clearQueryGrievance() {
        $('#reference_number').val('');
        $('.submit_btn').show();
        $('.cancel_btn').hide();
        $('.query_div').hide();
    }
    function getQueryGrievance(btnObj) {
        validationMessageHide();
        var reference_number = $('#reference_number').val();
        var trackQueryGrievanceData = $('#track_query_grievance_form').serializeFormJSON();
        var validationData = checkValidationForTrackQueryGrievance(trackQueryGrievanceData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('grievance-' + validationData.field, validationData.message);
            return false;
        }
        btnObj.html('Processing..');
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: "track_query_grievance/get_query_grievance_data",
            data: $.extend({}, {'reference_number': reference_number}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                setCaptchaCode('grievance');
                btnObj.html('Submit');
                btnObj.attr('onclick', 'getQueryGrievance($(this))');
                validationMessageShow('grievance', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                btnObj.html('Submit');
                btnObj.attr('onclick', 'getQueryGrievance($(this))');
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                setCaptchaCode('grievance');
                if (parseData.success == false) {
                    validationMessageShow('grievance', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                //window.open(baseURL + 'query_grievance', '_blank');
                if(parseData.query_grievance_data.query_response == ''){
                    $('.query_div').show();
                    $('#query').val(parseData.query_grievance_data.query);
                    $('#query_response').val('Your Query is Pendding');
                    $('.submit_btn').hide();
                    $('.cancel_btn').show();
                }else{
                   $('.query_div').show();
                   $('#query').val(parseData.query_grievance_data.query); 
                   $('#query_response').val(parseData.query_grievance_data.query_response); 
                   $('.submit_btn').hide();
                   $('.cancel_btn').show();
                } 
            }
        });
    }
</script>