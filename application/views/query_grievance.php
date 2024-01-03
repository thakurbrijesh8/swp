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
                        <li class="breadcrumb-item">Query and Grievance Redressal</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <!-- <div class="col-sm-2 col-md-2"></div> -->
            <div class="col-sm-8 col-md-12">
                <div class="feature-box f-style-2 icon-grad h-100">
                    <h4 class="text-center text-primary">Query and Grievance Redressal</h4>
                    <hr class="mb-1">
                    <div class="form mt-3">
                        <div>
                            <div class="text-center mb-2">
                                <span class="error-message error-message-grievance font-weight-bold" style="border-bottom: 2px solid red;"></span>
                            </div>
                        </div>
                        <div class="w-100" id="query_grievance_success_message_container">
                            <form method="post" id="query_grievance_form" autocomplete="off" onsubmit="return false;">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Select District
                                            <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <select class="form-control" id="district" name="district"
                                                data-placeholder="" onblur="checkValidation('grievance', 'district', queryDistrictValidationMessage);">
                                                <option value="">Select District</option>
                                                <option value="1">Daman</option>
                                                <option value="2">Diu</option>
                                                <option value="3">Dadra and Nagar Haveli</option>
                                            </select>
                                        </div>
                                        <span class="error-message error-message-grievance-district"></span>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Select Issue Category
                                            <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <select class="form-control" id="issue_category" name="issue_category"
                                                data-placeholder="" onblur="checkValidation('grievance', 'issue_category', issueCategoryValidationMessage);">
                                                <option value="">Select Issue Category</option>
                                                <option value="1">Application Approval Status</option>
                                                <option value="2">Enquiries Requiring Other Department Input</option>
                                                <option value="3">General Enquiry & Guidance</option>
                                                <option value="4">Grievance</option>
                                                <option value="5">Procurement Related</option>
                                            </select>
                                        </div>
                                        <span class="error-message error-message-grievance-issue_category"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Select Department
                                            <span class="color-nic-red">*</span> </label>
                                        <div class="input-group">
                                            <select class="form-control" id="department" name="department"
                                                data-placeholder="" onblur="checkValidation('grievance', 'department', queryDepartmentValidationMessage);">
                                                <option value="">Select Department</option>
                                                <option value="1">Pollution Control Committee</option>
                                                <option value="2">Fire & Emergency Service</option>
                                                <option value="3">District Industries Center</option>
                                                <option value="4">Labour & Employment</option>
                                                <option value="5">Weight & Measure</option>
                                                <option value="6">Revenue</option>
                                                <option value="11">Civil Registrar Cum Sub Registrar</option>
                                                <option value="7">Factories & Boiler</option>
                                                <option value="8">Electricity Department</option>
                                                <option value="9">Public Works Department(PWD)</option>
                                                <option value="10">Other</option>
                                            </select>
                                        </div>
                                        <span class="error-message error-message-grievance-department"></span>
                                    </div>
                                    <div class="form-group col-6 mb-3 other_department_div" style="display: none;">
                                        <label class="mb-0" style="color: black;">Enter Other Department Name <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="other_department" name="other_department" class="form-control" placeholder="Enter Other Department Name !"
                                                   maxlength="100" onblur="checkValidation('grievance', 'other_department', queryOtherDepartmentValidationMessage);" value="">
                                        </div>
                                        <span class="error-message error-message-grievance-other_department"></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Your Full Name <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter Your Full Name !"
                                                   maxlength="100" onblur="checkValidation('grievance', 'full_name', applicantFullNameValidationMessage);" value="">
                                        </div>
                                        <span class="error-message error-message-grievance-full_name"></span>
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Your Business Name (if any).</label>
                                        <div class="input-group">
                                            <input type="text" id="business_name" name="business_name" class="form-control" placeholder="Enter Your Business Name (if any)!"
                                                   maxlength="100" value="">
                                        </div>
                                        <span class="error-message error-message-grievance-business_name"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Select Classification of Industry
                                            <span class="color-nic-red">*</span> </label>
                                        <div class="input-group">
                                            <select class="form-control" id="industry_classification" name="industry_classification"
                                                data-placeholder="" onblur="checkValidation('grievance', 'industry_classification', industryClassificationValidationMessage);">
                                                <option value="">Select Classification of Industry</option>
                                                <option value="1">Micro</option>
                                                <option value="2">Small</option>
                                                <option value="3">Medium</option>
                                                <option value="4">Large</option>
                                            </select>
                                        </div>
                                        <span class="error-message error-message-grievance-industry_classification"></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Enter your Mobile Number Registered on <a href="https://swp.dddgov.in/" >www.swp.dddgov.in</a> (if Registered).<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="mobile_no" name="mobile_no" class="form-control" placeholder="Enter your Mobile Number  !"
                                                   maxlength="10" onblur="checkValidationForMobileNumber('grievance', 'mobile_no', mobileNumberValidationMessage);" value="">
                                        </div>
                                        <span class="error-message error-message-grievance-mobile_no"></span>
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Enter your Email Address Registered on <a href="https://swp.dddgov.in/" >www.swp.dddgov.in</a> (if Registered).<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="email_id" name="email_id" class="form-control" placeholder="Enter your Email Address  !"
                                                   maxlength="100" onblur="checkValidationForEmail('grievance', 'email_id', emailValidationMessage);" value="">
                                        </div>
                                        <span class="error-message error-message-grievance-email_id"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Submitted Application Number (if Any).</label>
                                        <div class="input-group">
                                            <input type="text" id="application_no" name="application_no" class="form-control" placeholder="Enter Submitted Application Number (if Any) !"
                                                   maxlength="100" value="">
                                        </div>
                                        <span class="error-message error-message-grievance-application_no"></span>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="form-group col-6 mb-3">
                                        <label class="mb-0" style="color: black;">Query.<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <textarea id="query" name="query" class="form-control" placeholder="Enter Query !" maxlength="100" onblur="checkValidation('grievance', 'query', queryDetailValidationMessage);"></textarea>
                                        </div>
                                        <span class="error-message error-message-grievance-query"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <button type="button" class="btn btn-grad mb-0 btn-block" id="query_grievance_btn"
                                                onclick="submitQueryGrievance($(this));">Submit</button>
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

    $(document).ready(function(){
        $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue == 10){
                //$("#other_department").not("." + optionValue).hide();
                $(".other_department_div").show();
            } else{
                $(".other_department_div").hide();
            }
        });
    }).change();
    });

    var baseURL = '<?php echo base_url(); ?>';
    var queryDistrictValidationMessage = '<?php echo QUERY_DISTRICT_MESSAGE; ?>';
    var issueCategoryValidationMessage = '<?php echo ISSUE_CATEGORY_MESSAGE; ?>';
    var queryDepartmentValidationMessage = '<?php echo QUERY_DEPARTMENT_MESSAGE; ?>';
    var queryOtherDepartmentValidationMessage = '<?php echo QUERY_OTHER_DEPARTMENT_MESSAGE; ?>';
    var applicantFullNameValidationMessage = '<?php echo APPLICANT_FULL_NAME_MESSAGE; ?>';
    var businessNameValidationMessage = '<?php echo BUSINESS_NAME_MESSAGE; ?>';
    var industryClassificationValidationMessage = '<?php echo INDUSTRY_CLASSIFICATION_MESSAGE; ?>';
    var mobileNumberValidationMessage = '<?php echo MOBILE_NUMBER_MESSAGE; ?>';
    var emailValidationMessage = '<?php echo EMAIL_MESSAGE; ?>';
    var applicationNumberValidationMessage = '<?php echo APPLICATION_NUMBER_MESSAGE; ?>';
    var queryDetailValidationMessage = '<?php echo QUERY_DETAIL_MESSAGE; ?>';


    $('#query_grievance_form').find('input').keypress(function (e) {
        if (e.which == 13) {
            submitQueryGrievance($('#query_grievance_btn'));
        }
    });

    function checkValidationForQueryGrievance(queryGrievanceData) {
        if (!queryGrievanceData.district) {
            return getBasicMessageAndFieldJSONArray('district', queryDistrictValidationMessage);
        }
        if (!queryGrievanceData.issue_category) {
            return getBasicMessageAndFieldJSONArray('issue_category', issueCategoryValidationMessage);
        }
        if (!queryGrievanceData.department) {
            return getBasicMessageAndFieldJSONArray('department', queryDepartmentValidationMessage);
        }
        if(queryGrievanceData.department == 10)
        {
            if (!queryGrievanceData.other_department) {
                return getBasicMessageAndFieldJSONArray('other_department', queryOtherDepartmentValidationMessage);
            }
        }
        if (!queryGrievanceData.full_name) {
            return getBasicMessageAndFieldJSONArray('full_name', applicantFullNameValidationMessage);
        }
        // if (!queryGrievanceData.business_name) {
        //     return getBasicMessageAndFieldJSONArray('business_name', businessNameValidationMessage);
        // }
        if (!queryGrievanceData.industry_classification) {
            return getBasicMessageAndFieldJSONArray('industry_classification', industryClassificationValidationMessage);
        }
        if (!queryGrievanceData.mobile_no) {
            return getBasicMessageAndFieldJSONArray('mobile_no', mobileNumberValidationMessage);
        }
        if (!queryGrievanceData.email_id) {
            return getBasicMessageAndFieldJSONArray('email_id', emailValidationMessage);
        }
        if (!queryGrievanceData.query) {
            return getBasicMessageAndFieldJSONArray('query', queryDetailValidationMessage);
        }
        return '';
    }
    function submitQueryGrievance(btnObj) {
        validationMessageHide();
        var queryGrievanceData = $('#query_grievance_form').serializeFormJSON();
        var validationData = checkValidationForQueryGrievance(queryGrievanceData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('grievance-' + validationData.field, validationData.message);
            return false;
        }
        btnObj.html('Processing..');
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: "query_grievance/submit_query_grievance",
            data: $.extend({}, queryGrievanceData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                setCaptchaCode('grievance');
                btnObj.html('Submit');
                btnObj.attr('onclick', 'submitQueryGrievance($(this))');
                validationMessageShow('grievance', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                btnObj.html('Submit');
                btnObj.attr('onclick', 'submitQueryGrievance($(this))');
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                setCaptchaCode('grievance');
                if (parseData.success == false) {
                    validationMessageShow('grievance', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                //window.open(baseURL + 'query_grievance', '_blank');
                var template = '<h4 class="mb-4"><span class="text-primary text-center" style="border-bottom: 2px solid #007bff;">Query Details Submitted Successfully</span></h4>';
                template += '<h6>' + parseData.message + '</h6><div class="text-center"><a class="btn btn-grad text-white" href="' + baseUrl + 'home">Back to Home</a></div>';
                        $('#query_grievance_success_message_container').html(template);
            }
        });
    }
</script>