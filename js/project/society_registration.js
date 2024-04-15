var societyRegistrationListTemplate = Handlebars.compile($('#society_registration_list_template').html());
var societyRegistrationTableTemplate = Handlebars.compile($('#society_registration_table_template').html());
var societyRegistrationActionTemplate = Handlebars.compile($('#society_registration_action_template').html());
var societyRegistrationFormTemplate = Handlebars.compile($('#society_registration_form_template').html());
var societyRegistrationViewTemplate = Handlebars.compile($('#society_registration_view_template').html());
var societyRegistrationUploadChallanTemplate = Handlebars.compile($('#society_registration_upload_challan_template').html());
var societyRegistrationUploadPassbookTemplate = Handlebars.compile($('#society_registration_upload_passbook_template').html());
var SocietyRegistration = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
SocietyRegistration.Router = Backbone.Router.extend({
    routes: {
        'society_registration': 'renderList',
        'society_registration_form': 'renderList'
    },
    renderList: function () {
        SocietyRegistration.listview.listPage();
    },
    renderListForForm: function () {
        SocietyRegistration.listview.listPageSocietyRegistrationForm();
    }
});
SocietyRegistration.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        SocietyRegistration.router.navigate('society_registration');
        var templateData = {};
        this.$el.html(societyRegistrationListTemplate(templateData));
        this.loadSocietyRegistrationData(sDistrict, sStatus);

    },
    listPageSocietyRegistrationForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        SocietyRegistration.router.navigate('society_registration');
        this.$el.html(societyRegistrationListTemplate);
        this.newSocietyRegistrationForm(false, {});
    },
    actionRenderer: function (rowData) {
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE ||
                (rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX && rowData.query_status == VALUE_ONE)) {
            rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_form_one_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE && rowData.status != VALUE_TWO && rowData.status != VALUE_SIX && rowData.status != VALUE_NINE) {
            if (rowData.payment_type != VALUE_THREE && rowData.payment_type != VALUE_ZERO) {
                rowData.ADMIN_SOCIETY_REGISTRATION_DOC_PATH = ADMIN_SOCIETY_REGISTRATION_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.letter_status == VALUE_ONE || rowData.letter_status == VALUE_TWO) {
            rowData.show_download_letter_btn = true;
        } else {
            rowData.show_download_letter_btn = false;
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
        rowData.module_type = VALUE_SIXTY;
        return societyRegistrationActionTemplate(rowData);
    },
    loadSocietyRegistrationData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_SIXTY, data)
                    + getFRContainer(VALUE_SIXTY, data, full.rating, full.fr_datetime);
        };
        var dvRenderer = function (data, type, full, meta) {
            return (talukaArray[data] ? talukaArray[data] : '');
        };
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i></b> :- ' + full.applicant_name +
                    '<hr><b><i class="fas fa-map f-s-10px"></i></b> :- ' + full.applicant_address +
                    '<hr><b><i class="fas fa-phone-volume f-s-10px"></i></b> :- ' + full.applicant_mobile_number;
        };
        var ownerDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i></b> :- ' + full.society_name +
                    '<hr><b><i class="fas fa-map f-s-10px"></i></b> :- ' + full.society_address;
        };
        var that = this;
        SocietyRegistration.router.navigate('society_registration');
        $('#society_registration_form_and_datatable_container').html(societyRegistrationTableTemplate(searchData));
        societyRegistrationDataTable = $('#society_registration_datatable').DataTable({
            ajax: {url: 'society_registration/get_society_registration_data', dataSrc: "society_registration_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'society_registration_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'district', 'class': 'text-center', 'render': dvRenderer},
                {data: '', 'class': 'f-s-13px', 'render': appDetailsRenderer},
                {data: '', 'class': 'f-s-13px', 'render': ownerDetailsRenderer},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'society_registration_id', 'class': 'v-a-m text-center', 'render': AppStatusforSRRenderer},
                {data: 'society_registration_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#society_registration_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = societyRegistrationDataTable.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(that.actionRenderer(row.data())).show();
                tr.addClass('shown');
            }
        });
    },
    newSocietyRegistrationForm: function (isEdit, societyRegistrationData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (isEdit) {
            if (societyRegistrationData.status != VALUE_FIVE && societyRegistrationData.status != VALUE_SIX && societyRegistrationData.query_status == VALUE_ONE) {
                societyRegistrationData.show_submit_qr_details = true;
            }
        } else {
            societyRegistrationData.m_doc = [];
        }
        var that = this;
        societyRegistrationData.module_type = VALUE_SIXTY;
        $('#society_registration_form_and_datatable_container').html(societyRegistrationFormTemplate(societyRegistrationData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_society_registration');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type_for_society_registration');
        if (isEdit) {
            $('#district_for_society_registration').val(societyRegistrationData.district);
            $('#entity_establishment_type_for_society_registration').val(societyRegistrationData.entity_establishment_type);
        }
        loadMRefDoc(VALUE_SIXTY);
        loadMDoc(VALUE_SIXTY, societyRegistrationData.m_doc);
        loadMOtherDoc(VALUE_SIXTY, societyRegistrationData.m_other_doc);
        allowOnlyIntegerValue('applicant_mobile_number_for_society_registration');
        generateSelect2();
        $('#society_registration_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitSocietyRegistration(societyRegistrationData.show_submit_qr_details ? VALUE_FOUR : VALUE_THREE);
            }
        });
    },
    editOrViewSocietyRegistration: function (btnObj, societyRegistrationId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!societyRegistrationId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'society_registration/get_society_registration_data_by_id',
            type: 'post',
            data: $.extend({}, {'society_registration_id': societyRegistrationId, 'is_edit': (isEdit ? VALUE_ZERO : VALUE_ONE)}, getTokenData()),
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
                var societyRegistrationData = parseData.society_registration_data;
                if (isEdit) {
                    that.newSocietyRegistrationForm(isEdit, societyRegistrationData);
                } else {
                    that.viewSocietyRegistrationForm(societyRegistrationData);
                }
            }
        });
    },
    viewSocietyRegistrationForm: function (societyRegistrationData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        societyRegistrationData.module_type = VALUE_SIXTY;
        societyRegistrationData.application_number = regNoRenderer(VALUE_SIXTY, societyRegistrationData.society_registration_id);
        societyRegistrationData.district_text = talukaArray[societyRegistrationData.district] ? talukaArray[societyRegistrationData.district] : '';
        societyRegistrationData.entity_establishment_type_text = entityEstablishmentTypeArray[societyRegistrationData.entity_establishment_type] ? entityEstablishmentTypeArray[societyRegistrationData.entity_establishment_type] : '';
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(societyRegistrationViewTemplate(societyRegistrationData));

        loadMDoc(VALUE_SIXTY, societyRegistrationData.m_doc, '_view');
        if (societyRegistrationData['m_other_doc'].length != VALUE_ZERO) {
            loadMOtherDoc(VALUE_SIXTY, societyRegistrationData.m_other_doc, '_view');
        }
    },
    checkValidationForSocietyRegistration: function (societyRegistrationData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!societyRegistrationData.district_for_society_registration) {
            return getBasicMessageAndFieldJSONArray('district_for_society_registration', selectDistrictValidationMessage);
        }
        if (!societyRegistrationData.entity_establishment_type_for_society_registration) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type_for_society_registration', entityEstablishmentTypeValidationMessage);
        }
        if (!societyRegistrationData.applicant_name_for_society_registration) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_society_registration', applicantNameValidationMessage);
        }
        if (!societyRegistrationData.applicant_address_for_society_registration) {
            return getBasicMessageAndFieldJSONArray('applicant_address_for_society_registration', addressValidationMessage);
        }
        if (!societyRegistrationData.applicant_mobile_number_for_society_registration) {
            return getBasicMessageAndFieldJSONArray('applicant_mobile_number_for_society_registration', mobileValidationMessage);
        }
        var mobMessage = mobileNumberValidation(societyRegistrationData.applicant_mobile_number_for_society_registration);
        if (mobMessage != '') {
            return getBasicMessageAndFieldJSONArray('applicant_mobile_number_for_society_registration', mobMessage);
        }
        if (!societyRegistrationData.society_name_for_society_registration) {
            return getBasicMessageAndFieldJSONArray('society_name_for_society_registration', societyNameValidationMessage);
        }
        if (!societyRegistrationData.society_address_for_society_registration) {
            return getBasicMessageAndFieldJSONArray('society_address_for_society_registration', societyAddressValidationMessage);
        }
        return '';
    },
    askForSubmitSocietyRegistration: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_THREE && moduleType != VALUE_FOUR) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var newMType = moduleType == VALUE_THREE ? VALUE_TWO : VALUE_FIVE;
        var yesEvent = 'SocietyRegistration.listview.submitSocietyRegistration(' + newMType + ')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitSocietyRegistration: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FOUR && moduleType != VALUE_FIVE) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        validationMessageHide();
        var societyRegistrationData = $('#society_registration_form').serializeFormJSON();
        var validationData = that.checkValidationForSocietyRegistration(societyRegistrationData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('society-registration-' + validationData.field, validationData.message);
            return false;
        }
        if (moduleType != VALUE_ONE) {
            var isDocValidation = checkValidationForMDoc(VALUE_SIXTY);
            if (isDocValidation) {
                return false;
            }
        }
        var isMODItemValidation = checkValidationForMOtherDoc(moduleType, VALUE_SIXTY);
        if (!isMODItemValidation) {
            return false;
        }
        societyRegistrationData.new_mod_items = isMODItemValidation.new_mod_items;
        societyRegistrationData.exi_mod_items = isMODItemValidation.exi_mod_items;
        if (moduleType == VALUE_THREE) {
            that.askForSubmitSocietyRegistration(moduleType);
            return false;
        }
        if (moduleType == VALUE_FOUR || moduleType == VALUE_FIVE) {
            var status = $('#status_for_society_registration').val();
            var queryStatus = $('#query_status_for_society_registration').val();
            if (status != VALUE_FIVE && status != VALUE_SIX && queryStatus == VALUE_ONE) {
                var qrRemarks = $('#remarks_for_society_registration').val();
                if (!qrRemarks) {
                    $('#remarks_for_society_registration').focus();
                    validationMessageShow('qrtc-remarks_for_society_registration', remarksValidationMessage);
                    return false;
                }
                societyRegistrationData.qr_remarks = qrRemarks;
            } else {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (moduleType == VALUE_FOUR) {
                that.askForSubmitSocietyRegistration(moduleType);
                return false;
            }
        }
        societyRegistrationData.module_type = moduleType;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_society_registration') : $('#submit_btn_for_society_registration');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'society_registration/submit_society_registration',
            data: $.extend({}, societyRegistrationData, getTokenData()),
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
                validationMessageShow('society-registration', textStatus.statusText);
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
                    validationMessageShow('society-registration', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                SocietyRegistration.listview.loadSocietyRegistrationData();
                showSuccess(parseData.message);
            }
        });
    },
    downloadUploadChallan: function (societyRegistrationId) {
        if (!societyRegistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + societyRegistrationId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'society_registration/get_society_registration_data_by_society_registration_id',
            type: 'post',
            data: $.extend({}, {'society_registration_id': societyRegistrationId}, getTokenData()),
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
                var societyRegistrationData = parseData.society_registration_data;
                that.showChallan(societyRegistrationData);
            }
        });
    },
    showChallan: function (societyRegistrationData) {
        showPopup();
        if (societyRegistrationData.status != VALUE_FIVE && societyRegistrationData.status != VALUE_SIX && societyRegistrationData.status != VALUE_SEVEN && societyRegistrationData.status != VALUE_ELEVEN) {
            if (!societyRegistrationData.hide_submit_btn) {
                societyRegistrationData.show_fees_paid = true;
            }
        }
        if (societyRegistrationData.payment_type == VALUE_ONE) {
            societyRegistrationData.utitle = 'Fees Paid Challan Copy';
        } else {
            societyRegistrationData.style = 'display: none;';
        }
        if (societyRegistrationData.payment_type == VALUE_TWO) {
            societyRegistrationData.show_dd_po_option = true;
            societyRegistrationData.utitle = 'Demand Draft (DD)';
        }
        societyRegistrationData.module_type = VALUE_SIXTY;
        $('#popup_container').html(societyRegistrationUploadChallanTemplate(societyRegistrationData));
        loadFB(VALUE_SIXTY, societyRegistrationData.fb_data);
        loadPH(VALUE_SIXTY, societyRegistrationData.society_registration_id, societyRegistrationData.ph_data);

        if (societyRegistrationData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'society_registration_upload_challan', societyRegistrationData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'society_registration_upload_challan', 'uc', 'radio');
            if (societyRegistrationData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_society_registration_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (societyRegistrationData.challan != '') {
            $('#challan_container_for_society_registration_upload_challan').hide();
            $('#challan_name_container_for_society_registration_upload_challan').show();
            $('#challan_name_href_for_society_registration_upload_challan').attr('href', 'documents/society_registration/' + societyRegistrationData.challan);
            $('#challan_name_for_society_registration_upload_challan').html(societyRegistrationData.challan);
        }
        if (societyRegistrationData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_society_registration_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_society_registration_upload_challan').show();
            $('#fees_paid_challan_name_href_for_society_registration_upload_challan').attr('href', 'documents/society_registration/' + societyRegistrationData.fees_paid_challan);
            $('#fees_paid_challan_name_for_society_registration_upload_challan').html(societyRegistrationData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_society_registration_upload_challan').attr('onclick', 'SocietyRegistration.listview.removeFeesPaidChallan("' + societyRegistrationData.society_registration_id + '")');
        }
    },
    removeFeesPaidChallan: function (societyRegistrationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!societyRegistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'society_registration/remove_fees_paid_challan',
            data: $.extend({}, {'society_registration_id': societyRegistrationId}, getTokenData()),
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
                validationMessageShow('society-registration-uc', textStatus.statusText);
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
                    validationMessageShow('society-registration-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-society-registration-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'society_registration_upload_challan');
                $('#status_' + societyRegistrationId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-society-registration-uc').html('');
        validationMessageHide();
        var societyRegistrationId = $('#society_registration_id_for_society_registration_upload_challan').val();
        if (!societyRegistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_society_registration_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_society_registration_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_society_registration_upload_challan').focus();
                validationMessageShow('society-registration-uc-fees_paid_challan_for_society_registration_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_society_registration_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_society_registration_upload_challan').focus();
                validationMessageShow('society-registration-uc-fees_paid_challan_for_society_registration_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_society_registration_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#society_registration_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'society_registration/upload_fees_paid_challan',
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
                validationMessageShow('society-registration-uc', textStatus.statusText);
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
                    validationMessageShow('society-registration-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + societyRegistrationId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
//    
    uploadPassbook: function (societyRegistrationId) {
        if (!societyRegistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#upload_passbook_btn_' + societyRegistrationId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'society_registration/get_society_registration_data_by_society_registration_id',
            type: 'post',
            data: $.extend({}, {'society_registration_id': societyRegistrationId}, getTokenData()),
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
                var societyRegistrationData = parseData.society_registration_data;
                that.showPassbook(societyRegistrationData);
            }
        });
    },
    showPassbook: function (societyRegistrationData) {
        showPopup();
        if (societyRegistrationData.letter_status = VALUE_ONE) {
            societyRegistrationData.utitle = 'Passbook';
            societyRegistrationData.show_fees_paid = true;
        }
        societyRegistrationData.module_type = VALUE_SIXTY;
        $('#popup_container').html(societyRegistrationUploadPassbookTemplate(societyRegistrationData));
        if (societyRegistrationData.passbook != '') {
            $('#passbook_container_for_society_registration_upload_passbook').hide();
            $('#passbook_name_container_for_society_registration_upload_passbook').show();
            $('#passbook_name_href_for_society_registration_upload_passbook').attr('href', 'documents/society_registration/' + societyRegistrationData.passbook);
            $('#passbook_name_for_society_registration_upload_passbook').html(societyRegistrationData.passbook);
            $('#passbook_remove_btn_for_society_registration_upload_passbook').attr('onclick', 'SocietyRegistration.listview.removePassbook("' + societyRegistrationData.society_registration_id + '")');
        }
    },
    submituploadPassbook: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-society-registration-up').html('');
        validationMessageHide();
        var societyRegistrationId = $('#society_registration_id_for_society_registration_upload_passbook').val();
        if (!societyRegistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#passbook_container_for_society_registration_upload_passbook').is(':visible')) {
            var sealAndStamp = $('#passbook_for_society_registration_upload_passbook').val();
            if (sealAndStamp == '') {
                $('#passbook_for_society_registration_upload_passbook').focus();
                validationMessageShow('society-registration-up-passbook_for_society_registration_upload_passbook', uploadDocumentValidationMessage);
                return false;
            }
            var passbookMessage = fileUploadValidation('passbook_for_society_registration_upload_passbook', 2048);
            if (passbookMessage != '') {
                $('#passbook_for_society_registration_upload_passbook').focus();
                validationMessageShow('society-registration-up-passbook_for_society_registration_upload_passbook', passbookMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_society_registration_upload_passbook');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#society_registration_upload_passbook_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'society_registration/upload_passbook',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('society-registration-up', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    validationMessageShow('society-registration-up', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + societyRegistrationId).html(socRegUlStatusArray[parseData.letter_status]);//               
                SocietyRegistration.listview.loadSocietyRegistrationData();
                showSuccess(parseData.message);

            }
        });
    },
    removePassbook: function (societyRegistrationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!societyRegistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'society_registration/remove_passbook',
            data: $.extend({}, {'society_registration_id': societyRegistrationId}, getTokenData()),
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
                validationMessageShow('society-registration-up', textStatus.statusText);
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
                    validationMessageShow('society-registration-up', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-society-registration-up').html(parseData.message);
                removeDocument('passbook', 'society_registration_upload_passbook');
                SocietyRegistration.listview.listPage();
                $('#status_' + societyRegistrationId).html(socRegUlStatusArray[VALUE_ONE]);

            }
        });
    },
    getQueryData: function (societyRegistrationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!societyRegistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_SIXTY;
        templateData.module_id = societyRegistrationId;
        var btnObj = $('#query_btn_for_society_registration_' + societyRegistrationId);
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
                tmpData.application_number = regNoRenderer(VALUE_SIXTY, moduleData.society_registration_id);
                tmpData.applicant_name = moduleData.applicant_name;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
});
