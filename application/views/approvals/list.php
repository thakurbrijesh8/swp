<?php
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url, 'swp' => 'active'));
?>
<script src="<?php echo $base_url; ?>js/mordanizr.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>js/underscore.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>js/backbone.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>js/handlebars.js" type="text/javascript"></script>
<?php
$this->load->view('common/validation_message');
$this->load->view('common/utility_template');
$this->load->view('security');
?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Information Wizard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left">
                    <h2 class="fs-30px text-grad">Information Wizard</h2>
                    <h6 class="lh-15">Department will include additional new regulation or license in the online wizard/system within 30 days of it's implementation.</h6>
                    <hr>
                    <div id="clearance_form_template"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade text-left" id="popup_modal" tabindex="-1" role="dialog"
     aria-labelledby="popup_modal" aria-hidden="true" style="z-index: 9999 !important;">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="model_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-2" id="model_body"></div>
        </div>
    </div>
</div>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>
<script type="text/javascript">
    var optionTemplate = Handlebars.compile($('#option_template').html());
    var spinnerTemplate = Handlebars.compile($('#spinner_template').html());
    var approvalFormTemplate = Handlebars.compile($('#approval_form_template').html());
    var approvalRadioTemplate = Handlebars.compile($('#approval_radio_template').html());
    var approvalClearanceTemplate = Handlebars.compile($('#approval_clearance_template').html());
    var approvalClearanceRowTemplate = Handlebars.compile($('#approval_clearance_row_template').html());
    var approvalBasicDetailsTemplate = Handlebars.compile($('#approval_basic_details_template').html());
    var iconSpinnerTemplate = spinnerTemplate({'type': 'light', 'extra_class': 'spinner-border-small'});
    var IS_DELETE = <?php echo IS_DELETE ?>;
    var talukaArray = <?php echo json_encode($this->config->item('taluka_array')); ?>;
    var riskCategoryArray = <?php echo json_encode($this->config->item('risk_category_array')); ?>;
    var foreignDomesticInvestorArray = <?php echo json_encode($this->config->item('foreign_domestic_investor_array')); ?>;
    var cbTypeArray = <?php echo json_encode($this->config->item('cb_type_array')); ?>;
    var TALUKA_DAMAN = <?php echo TALUKA_DAMAN; ?>;
    var TALUKA_DIU = <?php echo TALUKA_DIU; ?>;
    var TALUKA_DNH = <?php echo TALUKA_DNH; ?>;
    var VALUE_ZERO = <?php echo VALUE_ZERO; ?>;
    var VALUE_ONE = <?php echo VALUE_ONE; ?>;
    var VALUE_TWO = <?php echo VALUE_TWO; ?>;
    var VALUE_THREE = <?php echo VALUE_THREE; ?>;
    var VALUE_FOUR = <?php echo VALUE_FOUR; ?>;
    var VALUE_FIVE = <?php echo VALUE_FIVE; ?>;
    var VALUE_SIX = <?php echo VALUE_SIX; ?>;
    var VALUE_SEVEN = <?php echo VALUE_SEVEN; ?>;
    $('#clearance_form_template').html(approvalFormTemplate);
    renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_approvals', false);
    renderOptionsForTwoDimensionalArray(riskCategoryArray, 'risk_category_for_approvals', false);
    renderOptionsForTwoDimensionalArray(cbTypeArray, 'size_of_firm_for_approvals', false);
    renderOptionsForTwoDimensionalArray(foreignDomesticInvestorArray, 'foreign_domestic_investor_for_approvals', false);
    var tempDeptData = <?php echo json_encode($temp_dept_data); ?>;
    var tempDeptWiseQueData = [];
    var tempServiceData = [];
    var tempQuestionsData = [];
    function getDepartmentData(obj) {
        tempDeptWiseQueData = [];
        tempServiceData = [];
        tempQuestionsData = [];
        //$('#spinner_container_for_clearances').html('');
        $('#tab_main_container_for_approval').hide();
        $('#tabs_container_for_approval').html('');
        $('#tabs_content_container_for_approval').html('');
        validationMessageHide('approvals');
        //var district = obj.val();
        var district = $('#district_for_approvals').val();
        var riskCategory = $('#risk_category_for_approvals').val();
        var sizeOfFirm = $('#size_of_firm_for_approvals').val();
        var foreignDomesticInvestor = $('#foreign_domestic_investor_for_approvals').val();
        if (district != TALUKA_DAMAN && district != TALUKA_DIU && district != TALUKA_DNH) {
            $('#district_for_approvals').focus();
            validationMessageShow('approvals-district_for_approvals', districtValidationMessage);
            return false;
        }
//        if (!district || !riskCategory || !sizeOfFirm || !foreignDomesticInvestor) {
//            return false;
//        }
       // $('#spinner_container_for_clearances').html(spinnerTemplate({'type': 'primary', 'extra_class': 'mb-4'}));
        $.ajax({
            type: 'POST',
            url: 'utility/get_dept_wise_questionary_data',
            data: {'district_for_clearances': district, 'risk_category_for_clearances': riskCategory, 'size_of_firm_for_clearances': sizeOfFirm,
                'foreign_domestic_investor_for_clearances': foreignDomesticInvestor},
            error: function (textStatus, errorThrown) {
               // $('#spinner_container_for_clearances').html('');
                validationMessageShow('clact', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                //$('#spinner_container_for_clearances').html('');
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    validationMessageShow('clact', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                tempDeptWiseQueData = parseData.dept_wise_questionary_data;
                tempServiceData = parseData.service_data;
                tempQuestionsData = parseData.questions_data;
              //  loadDeptQuestionary();
            }
        });
    }

//    function loadDeptQuestionary() {
//        var deptCnt = 1;
//        var questionCnt = 1;
//        var tabHtml = '';
//        var tabContentHtml = '';
//        var deptName = '';
//        var questionData = [];
//        $.each(tempDeptWiseQueData, function (deptId, serviceIds) {
//            deptName = tempDeptData[deptId] ? tempDeptData[deptId]['department_name'] : '';
//            tabHtml = '<li class="nav-item"><a class="nav-link' + (deptCnt == 1 ? ' active' : '') + '" data-toggle="tab" href="#tab-1-' + deptId + '">' + deptName + '</a></li>';
//            $('#tabs_container_for_approval').append(tabHtml);
//            tabContentHtml = '<div class="tab-pane' + (deptCnt == 1 ? ' show active' : '') + '" id="tab-1-' + deptId + '"></div>';
//            $('#tabs_content_container_for_approval').append(tabContentHtml);
//            questionCnt = 1;
//            $.each(serviceIds, function (index, serviceId) {
//                $.each(tempServiceData[serviceId]['questionary_items'], function (index, questionaryId) {
//                    questionData = tempQuestionsData[questionaryId];
//                    questionData.department_id = deptId;
//                    questionData.VALUE_ONE = VALUE_ONE;
//                    questionData.VALUE_TWO = VALUE_TWO;
//                    questionData.cnt = questionCnt;
//                    $('#tab-1-' + deptId).append(approvalRadioTemplate(questionData));
//                    questionCnt++;
//                });
//            });
//            deptCnt++;
//        });
//        if (deptCnt == 1) {
//            return false;
//        }
//        $('#tab_main_container_for_approval').show();
//    }

    function showClearances() {
        validationMessageHide('approvals-district_for_approvals');
        var district = $('#district_for_approvals').val();
        var riskCategory = $('#risk_category_for_approvals').val();
        var sizeOfFirm = $('#size_of_firm_for_approvals').val();
        var foreignDomesticInvestor = $('#foreign_domestic_investor_for_approvals').val();
        if (!district) {
            validationMessageShow('approvals-district_for_approvals', districtValidationMessage);
            return false;
        }
//        if (!riskCategory) {
//            validationMessageShow('approvals-risk_category_for_approvals', oneOptionValidationMessage);
//            return false;
//        }
//        if (!sizeOfFirm) {
//            validationMessageShow('approvals-size_of_firm_for_approvals', oneOptionValidationMessage);
//            return false;
//        }
//        if (!foreignDomesticInvestor) {
//            validationMessageShow('approvals-foreign_domestic_investor_for_approvals', oneOptionValidationMessage);
//            return false;
//        }
        var selectedServiceIds = [];
        var trueAnsCnt = 0;
        var totalQuestion = 0;
        var exiAnswer = 0;
        var ans = 0;
        var notConnected = 0;
        $.each(tempServiceData, function (serviceId, serviceData) {
            totalQuestion = 0;
            trueAnsCnt = 0;
            notConnected = 0;
            $.each(serviceData['questionary_items'], function (index, questionaryId) {
                // Existing  answer check karavvanu
                exiAnswer = tempQuestionsData[questionaryId]['answer'];
                ans = parseInt($('input[name="answer_for_approval_' + questionaryId + '"]:checked').val());
                if (exiAnswer == ans) {
                    trueAnsCnt++;
                }
                if (isNaN(ans)) {
                    notConnected++;
                }
                totalQuestion++;
            });
            if (totalQuestion == trueAnsCnt || totalQuestion == notConnected) {
                selectedServiceIds.push(serviceId);
            }
        });
        $('#clearance_form_template').html(approvalClearanceTemplate);
        var serviceCnt = 1;
        var districtName = talukaArray[district] ? talukaArray[district] : '';
        var serviceData = [];
        $.each(selectedServiceIds, function (index, serviceId) {
            serviceData = tempServiceData[serviceId];
            serviceData.service_id = serviceId;
            serviceData.department_name = tempDeptData[serviceData['department_id']] ? tempDeptData[serviceData['department_id']]['department_name'] : '';
            serviceData.district_name_text = districtName;
            if (serviceData['service_type'] == VALUE_ONE) {
                $('.pre_establishment_clearance').show();
                serviceData['table-counter-classname'] = 'pre_establishment_cnt';
                appendData('pre_establishment_clearance_container', serviceData);
            }
            if (serviceData['service_type'] == VALUE_TWO) {
                $('.pre_operation_clearance').show();
                serviceData['table-counter-classname'] = 'pre_operation_cnt';
                appendData('pre_operation_clearance_container', serviceData);
            }
            if (serviceData['service_type'] == VALUE_THREE) {
                $('.pre_establishment_clearance').show();
                serviceData['table-counter-classname'] = 'pre_establishment_cnt';
                appendData('pre_establishment_clearance_container', serviceData);
                
                $('.pre_operation_clearance').show();
                serviceData['table-counter-classname'] = 'pre_operation_cnt';
                appendData('pre_operation_clearance_container', serviceData);
            }
            if (serviceData['service_type'] == VALUE_FOUR) {
                $('.renewals_clearance').show();
                serviceData['table-counter-classname'] = 'renewals_cnt';
                appendData('renewals_clearance_container', serviceData);
            }
            if (serviceData['service_type'] == VALUE_FIVE) {
                $('.post_establishment_clearance').show();
                serviceData['table-counter-classname'] = 'post_establishment_cnt';
                appendData('post_establishment_clearance_container', serviceData);
            }
            if (serviceData['service_type'] == VALUE_SIX) {
                $('.post_operation_clearance').show();
                serviceData['table-counter-classname'] = 'post_operation_cnt';
                appendData('post_operation_clearance_container', serviceData);
            }
            if (serviceData['service_type'] == VALUE_SEVEN) {
                $('.pre_operation_clearance').show();
                serviceData['table-counter-classname'] = 'pre_operation_cnt';
                appendData('pre_operation_clearance_container', serviceData);

                $('.post_operation_clearance').show();
                serviceData['table-counter-classname'] = 'post_operation_cnt';
                appendData('post_operation_clearance_container', serviceData);
            }
            serviceCnt++;
        });
        resetCounter('pre_establishment_cnt');
        resetCounter('post_establishment_cnt');
        resetCounter('pre_operation_cnt');
        resetCounter('post_operation_cnt');
        resetCounter('renewals_cnt');
    }

    function appendData(id, data) {
        $('#' + id).append(approvalClearanceRowTemplate(data));
    }

    function backFromClearance(district) {
        $('#clearance_form_template').html(approvalFormTemplate);
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_approvals', false);
        renderOptionsForTwoDimensionalArray(riskCategoryArray, 'risk_category_for_approvals', false);
        renderOptionsForTwoDimensionalArray(cbTypeArray, 'size_of_firm_for_approvals', false);
        renderOptionsForTwoDimensionalArray(foreignDomesticInvestorArray, 'foreign_domestic_investor_for_approvals', false);
    }

    function showBasicDetails(serviceId) {
        if (!serviceId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempServiceData[serviceId]) {
            var tempData = tempServiceData[serviceId];
            $('#model_title').html(tempData.service_name);
            $('#model_body').html(approvalBasicDetailsTemplate(tempData));
            $('#popup_modal').modal('show');
        }
    }
</script>