var naListTemplate = Handlebars.compile($('#na_list_template').html());
var naTableTemplate = Handlebars.compile($('#na_table_template').html());
var naActionTemplate = Handlebars.compile($('#na_action_template').html());
var naFormTemplate = Handlebars.compile($('#na_form_template').html());
var naViewTemplate = Handlebars.compile($('#na_view_template').html());
var naUploadChallanTemplate = Handlebars.compile($('#na_upload_challan_template').html());
var naApplicantInfoTemplate = Handlebars.compile($('#na_applicant_info_template').html());

var tempApplicantCnt = 1;

var Na = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Na.Router = Backbone.Router.extend({
    routes: {
        'na': 'renderList',
        'na_form': 'renderList',
        'edit_na_form': 'renderList',
        'view_na_form': 'renderList',
    },
    renderList: function () {
        Na.listview.listPage();
    },
    renderListForForm: function () {
        Na.listview.listPageNaForm();
    }
});
Na.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        Na.router.navigate('na');
        var templateData = {};
        this.$el.html(naListTemplate(templateData));
        this.loadNaData(sDistrict, sStatus);

    },
    listPageNaForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(naListTemplate);
        this.newNaForm(false, {});
    },
    actionRenderer: function (rowData) {
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE) {
            rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_form_one_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE && rowData.status != VALUE_TWO && rowData.status != VALUE_SIX && rowData.status != VALUE_NINE) {
            if (rowData.payment_type != VALUE_THREE && rowData.payment_type != VALUE_ZERO) {
                rowData.ADMIN_NA_DOC_PATH = ADMIN_NA_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        if (rowData.status == VALUE_FIVE || rowData.status == VALUE_SIX) {
            rowData.show_fr_btn = true;
        }
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE || rowData.status == VALUE_TWO || rowData.status == VALUE_THREE) {
            rowData.show_withdraw_application_btn = true;
        }
        return naActionTemplate(rowData);
    },
    loadNaData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTY, data)
                    + getFRContainer(VALUE_FOURTY, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Na.router.navigate('na');
        $('#na_form_and_datatable_container').html(naTableTemplate(searchData));
        naDataTable = $('#na_datatable').DataTable({
            ajax: {url: 'na/get_na_data', dataSrc: "na_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'na_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'area_of_site_used', 'class': 'text-center'},
                {data: 'occupation', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'na_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'na_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#na_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = naDataTable.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(that.actionRenderer(row.data())).show();
                tr.addClass('shown');
            }
        });
    },
    newNaForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.na_data;
            Na.router.navigate('edit_na_form');
        } else {
            var formData = {};
            Na.router.navigate('na_form');
        }
        var templateData = {};
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.na_data = parseData.na_data;
        $('#na_form_and_datatable_container').html(naFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#declaration_for_na').attr('checked', 'checked');
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);

            if (formData.certified_copy != '') {
                that.showDocument('certified_copy_container', 'certified_copy_name_image', 'certified_copy_name_container',
                        'certified_copy_download', 'certified_copy_remove_btn', formData.certified_copy, formData.na_id, VALUE_FOUR);
            }
            if (formData.sketch_layout != '') {
                that.showDocument('sketch_layout_container', 'sketch_layout_name_image', 'sketch_layout_name_container',
                        'sketch_layout_download', 'sketch_layout_remove_btn', formData.sketch_layout, formData.na_id, VALUE_FIVE);
            }
            if (formData.written_consent != '') {
                that.showDocument('written_consent_container', 'written_consent_name_image', 'written_consent_name_container',
                        'written_consent_download', 'written_consent_remove_btn', formData.written_consent, formData.na_id, VALUE_SIX);
            }
            if (formData.form_land_document != '') {
                that.showDocument('form_land_document_container', 'form_land_document_name_image', 'form_land_document_name_container',
                        'form_land_document_download', 'form_land_document_remove_btn', formData.form_land_document, formData.na_id, VALUE_ONE);
            }
            if (formData.site_plan_document != '') {
                that.showDocument('site_plan_document_container', 'site_plan_document_name_image', 'site_plan_document_name_container',
                        'site_plan_document_download', 'site_plan_document_remove_btn', formData.site_plan_document, formData.na_id, VALUE_TWO);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_na', 'seal_and_stamp_name_image_for_na', 'seal_and_stamp_name_container_for_na',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.na_id, VALUE_THREE);
            }

            if (formData.multiple_applicant != '') {
                var applicantInfo = JSON.parse(formData.multiple_applicant);
                $.each(applicantInfo, function (key, value) {
                    that.addMultipleApplicant(value);
                })
            }
        } else {
            that.addMultipleApplicant({});
        }
        generateSelect2();
        datePicker();
        $('#na_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitNa($('#submit_btn_for_na'));
            }
        });
    },
    editOrViewNa: function (btnObj, naId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!naId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'na/get_na_data_by_id',
            type: 'post',
            data: $.extend({}, {'na_id': naId}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                showError(textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                if (isEdit) {
                    that.newNaForm(isEdit, parseData);
                } else {
                    that.viewNaForm(parseData);
                }
            }
        });
    },
    viewNaForm: function (parseData , isPrint) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.na_data;
        Na.router.navigate('view_na_form');
        formData.title = 'View'
        formData.IS_CHECKED_YES = IS_CHECKED_YES;
        formData.IS_CHECKED_NO = IS_CHECKED_NO;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.VALUE_TWO = VALUE_TWO;
        formData.VALUE_THREE = VALUE_THREE;
        formData.VALUE_FOUR = VALUE_FOUR;
        formData.VALUE_FIVE = VALUE_FIVE;
        formData.VALUE_SEVEN = VALUE_SEVEN;
        formData.VALUE_SIX = VALUE_SIX;
        formData.application_number = regNoRenderer(VALUE_FOURTY, formData.na_id);
        formData.district_text = talukaArray[formData.district] ? talukaArray[formData.district] : '';
        formData.entity_establishment_type = entityEstablishmentTypeArray[formData.entity_establishment_type] ? entityEstablishmentTypeArray[formData.entity_establishment_type] : '';        
        formData.show_certified_copy = formData.certified_copy != '' ? true : false;
        formData.show_sketch_layout = formData.sketch_layout != '' ? true : false;
        formData.show_written_consent = formData.written_consent !='' ? true : false;
        formData.show_form_land_document = formData.form_land_document !='' ? true : false;
        formData.show_site_plan_document = formData.site_plan_document !='' ? true : false;
        formData.show_signature_na = formData.signature != '' ? true : false; 
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(naViewTemplate(formData));
        $('#declaration_for_na').attr('checked', 'checked');
        $('.remove_btn_hidden').hide();
        if(formData.multiple_applicant){

        }
        var applicantInfo = JSON.parse(formData.multiple_applicant);
        var tableHTML = '<table table class="table table-bordered m-b-0px" style="margin-top: 10px;"><thead  class="bg-beige"><tr style="color: #000;"><th style="width: 50px">Sr No.</th><th style="width: 330px">Full Name of the Applicant</th><th style="width: 330px">Full Postel Address of the Applicant</th></tr></thead><tbody>';
        $.each(applicantInfo, function(index, value) {
            tableHTML += '<tr><td class="text-center">' + (index + 1) + '</td><td>' + value.name + '</td><td>' + value.address + '</td></tr>';
        });
        tableHTML += '</tbody></table>';
        $('#applicant_display_for_na_view').html(tableHTML);

        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_icview').click();
            }, 500);
        }
    },
    checkValidationForNa: function (naData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!naData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!naData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!naData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!naData.postel_address) {
            return getBasicMessageAndFieldJSONArray('postel_address', addressValidationMessage);
        }
        if (!naData.occupation) {
            return getBasicMessageAndFieldJSONArray('occupation', occupationValidationMessage);
        }
        if (!naData.village) {
            return getBasicMessageAndFieldJSONArray('village', villageValidationMessage);
        }
        if (!naData.survey_no) {
            return getBasicMessageAndFieldJSONArray('survey_no', naSurveyNoValidationMessage);
        }
        if (!naData.area_assessment) {
            return getBasicMessageAndFieldJSONArray('area_assessment', naAreaAssessmentValidationMessage);
        }
        if (!naData.area_of_site_used) {
            return getBasicMessageAndFieldJSONArray('area_of_site_used', naAreaSiteValidationMessage);
        }
        if (!naData.occupant_class) {
            return getBasicMessageAndFieldJSONArray('occupant_class', naOccupantClassValidationMessage);
        }
        if (!naData.present_use_land) {
            return getBasicMessageAndFieldJSONArray('present_use_land', naPresentUseValidationMessage);
        }
        if (!naData.situated_land) {
            return getBasicMessageAndFieldJSONArray('situated_land', naSituatedLandValidationMessage);
        }
        if (!naData.electrical_distance_land) {
            return getBasicMessageAndFieldJSONArray('electrical_distance_land', naElectricalDistanceLandValidationMessage);
        }
        if (!naData.acquisition_under_land) {
            return getBasicMessageAndFieldJSONArray('acquisition_under_land', naAcquisitionsUnderLandValidationMessage);
        }
        if (!naData.accessible_land) {
            return getBasicMessageAndFieldJSONArray('accessible_land', naAccessibleLandValidationMessage);
        }
        if (!naData.site_access_land) {
            return getBasicMessageAndFieldJSONArray('site_access_land', naSiteAccessLandValidationMessage);
        }
        if (!naData.rejected_land) {
            return getBasicMessageAndFieldJSONArray('rejected_land', naRejectedLandValidationMessage);
        }
        return '';
    },
    askForSubmitNa: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Na.listview.submitNa(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitNa: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var naData = $('#na_form').serializeFormJSON();
        var validationData = that.checkValidationForNa(naData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('na-' + validationData.field, validationData.message);
            return false;
        }
        var applicantInfoItem = [];
        var isapplicantValidation = false;

        $('.applicant_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var applicantInfo = {};
            var applicantName = $('#name_of_applicant_' + cnt).val();
            if (applicantName == '' || applicantName == null) {
                $('#name_of_applicant_' + cnt).focus();
                validationMessageShow('na-name_of_applicant_' + cnt, applicantNameValidationMessage);
                isapplicantValidation = true;
                return false;
            }
            applicantInfo.name = applicantName;
            var applicantAddress = $('#address_of_applicant_' + cnt).val();
            if (applicantAddress == '' || applicantAddress == null) {
                $('#address_of_applicant_' + cnt).focus();
                validationMessageShow('na-address_of_applicant_' + cnt, applicantAddressValidationMessage);
                isapplicantValidation = true;
                return false;
            }
            applicantInfo.address = applicantAddress;

            applicantInfoItem.push(applicantInfo);
        });

        if (isapplicantValidation) {
            return false;
        }

        if ($('#certified_copy_container').is(':visible')) {
            var certifiedCopy = checkValidationForDocument('certified_copy', VALUE_ONE, 'na');
            if (certifiedCopy == false) {
                return false;
            }
        }

        if ($('#sketch_layout_container').is(':visible')) {
            var sketchLayout = checkValidationForDocument('sketch_layout', VALUE_ONE, 'na');
            if (sketchLayout == false) {
                return false;
            }
        }
        if ($('#form_land_document_container').is(':visible')) {
            var formLandDocument = checkValidationForDocument('form_land_document', VALUE_ONE, 'na');
            if (formLandDocument == false) {
                return false;
            }
        }

        if ($('#site_plan_document_container').is(':visible')) {
            var sitePlanDocument = checkValidationForDocument('site_plan_document', VALUE_ONE, 'na');
            if (sitePlanDocument == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_na').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_na', VALUE_TWO, 'na');
            if (sealAndStamp == false) {
                return false;
            }
        }

        if (!$('#declaration_for_na').is(':checked')) {
            $('#declaration_for_na').focus();
            validationMessageShow('na-declaration_for_na', declarationOneValidationMessage);
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_na') : $('#submit_btn_for_na');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var naData = new FormData($('#na_form')[0]);
        naData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        naData.append("applicant_data", JSON.stringify(applicantInfoItem));
        naData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'na/submit_na',
            data: naData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                validationMessageShow('na', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    validationMessageShow('na', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Na.router.navigate('na', {'trigger': true});
            }
        });
    },

    askForRemove: function (naId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!naId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Na.listview.removeDocument(\'' + naId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (naId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!naId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_na_' + docType).hide();
        $('.spinner_name_container_for_na_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'na/remove_document',
            data: $.extend({}, {'na_id': naId, 'document_type': docType}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_na_' + docType).hide();
                $('.spinner_name_container_for_na_' + docType).show();
                validationMessageShow('na', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    validationMessageShow('na', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_na_' + docType).show();
                $('.spinner_name_container_for_na_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('form_land_document_name_container', 'form_land_document_name_image', 'form_land_document_container', 'form_land_document');

                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('site_plan_document_name_container', 'site_plan_document_name_image', 'site_plan_document_container', 'site_plan_document');

                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_na', 'seal_and_stamp_name_image_for_na', 'seal_and_stamp_container_for_na', 'seal_and_stamp_for_na');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('certified_copy_name_container', 'certified_copy_name_image', 'certified_copy_container', 'certified_copy');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('sketch_layout_name_container', 'sketch_layout_name_image', 'sketch_layout_container', 'sketch_layout');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('written_consent_name_container', 'written_consent_name_image', 'written_consent_container', 'written_consent');
                }
            }
        });
    },
    generateForm: function (naId) {
        if (!naId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#na_id_for_na_form').val(naId);
        $('#na_form_pdf_form').submit();
        $('#na_id_for_na_form').val('');
    },

    downloadUploadChallan: function (naId) {
        if (!naId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + naId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'na/get_na_data_by_na_id',
            type: 'post',
            data: $.extend({}, {'na_id': naId}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                showError(textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                var naData = parseData.na_data;
                that.showChallan(naData);
            }
        });
    },
    showChallan: function (naData) {
        showPopup();
        if (naData.status != VALUE_FIVE && naData.status != VALUE_SIX && naData.status != VALUE_SEVEN && naData.status != VALUE_ELEVEN) {
            if (!naData.hide_submit_btn) {
                naData.show_fees_paid = true;
            }
        }
        if (naData.payment_type == VALUE_ONE) {
            naData.utitle = 'Fees Paid Challan Copy';
        } else {
            naData.style = 'display: none;';
        }
        if (naData.payment_type == VALUE_TWO) {
            naData.show_dd_po_option = true;
            naData.utitle = 'Demand Draft (DD)';
        }
        naData.module_type = VALUE_FOURTY;
        $('#popup_container').html(naUploadChallanTemplate(naData));
        loadFB(VALUE_FOURTY, naData.fb_data);
        loadPH(VALUE_FOURTY, naData.na_id, naData.ph_data);

        if (naData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'na_upload_challan', naData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'na_upload_challan', 'uc', 'radio');
            if (naData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_na_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (naData.challan != '') {
            $('#challan_container_for_na_upload_challan').hide();
            $('#challan_name_container_for_na_upload_challan').show();
            $('#challan_name_href_for_na_upload_challan').attr('href', 'documents/na/' + naData.challan);
            $('#challan_name_for_na_upload_challan').html(naData.challan);
        }
        if (naData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_na_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_na_upload_challan').show();
            $('#fees_paid_challan_name_href_for_na_upload_challan').attr('href', 'documents/na/' + naData.fees_paid_challan);
            $('#fees_paid_challan_name_for_na_upload_challan').html(naData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_na_upload_challan').attr('onclick', 'Na.listview.removeFeesPaidChallan("' + naData.na_id + '")');
        }
    },
    removeFeesPaidChallan: function (naId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!naId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'na/remove_fees_paid_challan',
            data: $.extend({}, {'na_id': naId}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                validationMessageShow('na-uc', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    validationMessageShow('na-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-na-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'na_upload_challan');
                $('#status_' + naId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-na-uc').html('');
        validationMessageHide();
        var naId = $('#na_id_for_na_upload_challan').val();
        if (!naId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_na_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_na_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_na_upload_challan').focus();
                validationMessageShow('na-uc-fees_paid_challan_for_na_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_na_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_na_upload_challan').focus();
                validationMessageShow('na-uc-fees_paid_challan_for_na_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_na_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#na_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'na/upload_fees_paid_challan',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                validationMessageShow('na-uc', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    validationMessageShow('na-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + naId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (naId) {
        if (!naId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#na_id_for_certificate').val(naId);
        $('#na_certificate_pdf_form').submit();
        $('#na_id_for_certificate').val('');
    },
    getQueryData: function (naId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!naId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTY;
        templateData.module_id = naId;
        var btnObj = $('#query_btn_for_na_' + naId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'utility/get_query_data',
            type: 'post',
            data: $.extend({}, templateData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                showError(textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
                return false;
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(response);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                var moduleData = parseData.module_data;
                var tmpData = {};
                tmpData.application_number = regNoRenderer(VALUE_FOURTY, moduleData.na_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForNa: function (fileNo) {
        var that = this;
        if ($('#sketch_layout').val() != '') {
            var sketchLayout = checkValidationForDocument('sketch_layout', VALUE_ONE, 'na', 10240);
            if (sketchLayout == false) {
                return false;
            }
        }
        if ($('#written_consent').val() != '') {
            var writtenConsent = checkValidationForDocument('written_consent', VALUE_ONE, 'na', 10240);
            if (writtenConsent == false) {
                return false;
            }
        }
        if ($('#form_land_document').val() != '') {
            var formLandDocument = checkValidationForDocument('form_land_document', VALUE_ONE, 'na');
            if (formLandDocument == false) {
                return false;
            }
        }
        if ($('#site_plan_document').val() != '') {
            var sitePlanDocument = checkValidationForDocument('site_plan_document', VALUE_ONE, 'na');
            if (sitePlanDocument == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_na').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_na', VALUE_TWO, 'na');
            if (sealAndStamp == false) {
                return false;
            }
        }
        if ($('#certified_copy').val() != '') {
            var certifiedCopy = checkValidationForDocument('certified_copy', VALUE_ONE, 'na', 10240);
            if (certifiedCopy == false) {
                return false;
            }
        }
        $('.spinner_container_for_na_' + fileNo).hide();
        $('.spinner_name_container_for_na_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var naId = $('#na_id').val();
        var formData = new FormData($('#na_form')[0]);
        formData.append("file_no", fileNo);
        formData.append("na_id", naId);
        $.ajax({
            type: 'POST',
            url: 'na/upload_na_document',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function (textStatus, errorThrown) {
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_na_' + fileNo).show();
                $('.spinner_name_container_for_na_' + fileNo).hide();
                showError(textStatus.statusText);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    $('#spinner_template_' + fileNo).hide();
                    $('.spinner_container_for_na_' + fileNo).show();
                    $('.spinner_name_container_for_na_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_na_' + fileNo).hide();
                $('.spinner_name_container_for_na_' + fileNo).show();
                $('#na_id').val(parseData.na_id);
                var naData = parseData.na_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('form_land_document_container', 'form_land_document_name_image', 'form_land_document_name_container',
                            'form_land_document_download', 'form_land_document_remove_btn', naData.form_land_document, parseData.na_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('site_plan_document_container', 'site_plan_document_name_image', 'site_plan_document_name_container',
                            'site_plan_document_download', 'site_plan_document_remove_btn', naData.site_plan_document, parseData.na_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('seal_and_stamp_container_for_na', 'seal_and_stamp_name_image_for_na', 'seal_and_stamp_name_container_for_na',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', naData.signature, parseData.na_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('certified_copy_container', 'certified_copy_name_image', 'certified_copy_name_container',
                            'certified_copy_download', 'certified_copy_remove_btn', naData.certified_copy, parseData.na_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('sketch_layout_container', 'sketch_layout_name_image', 'sketch_layout_name_container',
                            'sketch_layout_download', 'sketch_layout_remove_btn', naData.sketch_layout, parseData.na_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('written_consent_container', 'written_consent_name_image', 'written_consent_name_container',
                            'written_consent_download', 'written_consent_remove_btn', naData.written_consent, parseData.na_id, VALUE_SIX);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/na/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/na/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Na.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
    addMultipleApplicant: function (templateData) {
        templateData.per_cnt = tempApplicantCnt;
        $('#applicant_info_container').append(naApplicantInfoTemplate(templateData));
        tempApplicantCnt++;
        resetCounter('display-cnt');
    },
    removeApplicantInfo: function (perCnt) {
        $('#applicant_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
});
