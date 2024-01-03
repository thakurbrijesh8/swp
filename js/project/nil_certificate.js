var nilCertificateListTemplate = Handlebars.compile($('#nil_certificate_list_template').html());
var nilCertificateTableTemplate = Handlebars.compile($('#nil_certificate_table_template').html());
var nilCertificateActionTemplate = Handlebars.compile($('#nil_certificate_action_template').html());
var nilCertificateFormTemplate = Handlebars.compile($('#nil_certificate_form_template').html());
var nilCertificateViewTemplate = Handlebars.compile($('#nil_certificate_view_template').html());
var nilCertificateUploadChallanTemplate = Handlebars.compile($('#nil_certificate_upload_challan_template').html());
var NilCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
NilCertificate.Router = Backbone.Router.extend({
    routes: {
        'nil_certificate': 'renderList',
        'nil_certificate_form': 'renderList'
    },
    renderList: function () {
        NilCertificate.listview.listPage();
    },
    renderListForForm: function () {
        NilCertificate.listview.listPageNilCertificateForm();
    }
});
NilCertificate.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        NilCertificate.router.navigate('nil_certificate');
        var templateData = {};
        this.$el.html(nilCertificateListTemplate(templateData));
        this.loadNilCertificateData(sDistrict, sStatus);

    },
    listPageNilCertificateForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        NilCertificate.router.navigate('nil_certificate');
        this.$el.html(nilCertificateListTemplate);
        this.newNilCertificateForm(false, {});
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
            if (rowData.payment_type != VALUE_THREE) {
                rowData.ADMIN_NIL_CERTIFICATE_DOC_PATH = ADMIN_NIL_CERTIFICATE_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        rowData.module_type = VALUE_SIXTYONE;
        return nilCertificateActionTemplate(rowData);
    },
    loadNilCertificateData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_SIXTYONE, data);
        };
        var dvRenderer = function (data, type, full, meta) {
            var villageData = full.district == VALUE_ONE ? damanVillagesArray : (full.district == VALUE_TWO ? diuVillagesArray : (full.district == VALUE_THREE ? dnhVillagesArray : []));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village_dmc_ward] ? villageData[full.village_dmc_ward] : '');
        };
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i></b> :- ' + full.applicant_name +
                    '<hr><b><i class="fas fa-map f-s-10px"></i></b> :- ' + full.applicant_address +
                    '<hr><b><i class="fas fa-phone-volume f-s-10px"></i></b> :- ' + full.applicant_mobile_number;
        };
        var propertyDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fa fa-archive f-s-10px"></i></b> :- ' + full.purpose +
                    '<hr><b><i class="fas fa-map f-s-10px"></i></b> :- ' + full.property_detail;
        };
        var that = this;
        NilCertificate.router.navigate('nil_certificate');
        $('#nil_certificate_form_and_datatable_container').html(nilCertificateTableTemplate(searchData));
        nilCertificateDataTable = $('#nil_certificate_datatable').DataTable({
            ajax: {url: 'nil_certificate/get_nil_certificate_data', dataSrc: "nil_certificate_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'nil_certificate_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'district', 'class': 'text-center', 'render': dvRenderer},
                {data: '', 'class': 'f-s-13px', 'render': appDetailsRenderer},
                {data: '', 'class': 'f-s-13px', 'render': propertyDetailsRenderer},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'nil_certificate_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'nil_certificate_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#nil_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = nilCertificateDataTable.row(tr);

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
    districtChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'village_dmc_ward_for_nil_certificate');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_dmc_ward_for_nil_certificate');
    },
    newNilCertificateForm: function (isEdit, nilCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (isEdit) {
            if (nilCertificateData.status != VALUE_FIVE && nilCertificateData.status != VALUE_SIX && nilCertificateData.query_status == VALUE_ONE) {
                nilCertificateData.show_submit_qr_details = true;
            }
        } else {
            nilCertificateData.m_doc = [];
        }
        var that = this;
        nilCertificateData.module_type = VALUE_SIXTYONE;
        $('#nil_certificate_form_and_datatable_container').html(nilCertificateFormTemplate(nilCertificateData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_nil_certificate');
        var villageData = isEdit ? (nilCertificateData.district == VALUE_ONE ? damanVillagesArray : (nilCertificateData.district == VALUE_TWO ? diuVillagesArray : (nilCertificateData.district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_dmc_ward_for_nil_certificate');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type_for_nil_certificate');
        if (isEdit) {
            $('#district_for_nil_certificate').val(nilCertificateData.district);
            $('#village_dmc_ward_for_nil_certificate').val(nilCertificateData.village_dmc_ward);
            $('#entity_establishment_type_for_nil_certificate').val(nilCertificateData.entity_establishment_type);
        }
        loadMRefDoc(VALUE_SIXTYONE);
        loadMDoc(VALUE_SIXTYONE, nilCertificateData.m_doc);
        loadMOtherDoc(VALUE_SIXTYONE, nilCertificateData.m_other_doc);
        allowOnlyIntegerValue('applicant_mobile_number_for_nil_certificate');
        generateSelect2();
        $('#nil_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitNilCertificate(nilCertificateData.show_submit_qr_details ? VALUE_FOUR : VALUE_THREE);
            }
        });
    },
    editOrViewNilCertificate: function (btnObj, nilCertificateId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!nilCertificateId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'nil_certificate/get_nil_certificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'nil_certificate_id': nilCertificateId, 'is_edit': (isEdit ? VALUE_ZERO : VALUE_ONE)}, getTokenData()),
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
                var nilCertificateData = parseData.nil_certificate_data;
                if (isEdit) {
                    that.newNilCertificateForm(isEdit, nilCertificateData);
                } else {
                    that.viewNilCertificateForm(nilCertificateData);
                }
            }
        });
    },
    viewNilCertificateForm: function (nilCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        nilCertificateData.module_type = VALUE_SIXTYONE;
        nilCertificateData.application_number = regNoRenderer(VALUE_SIXTYONE, nilCertificateData.nil_certificate_id);
        nilCertificateData.district_text = talukaArray[nilCertificateData.district] ? talukaArray[nilCertificateData.district] : '';
        var villageData = nilCertificateData.district == VALUE_ONE ? damanVillagesArray : (nilCertificateData.district == VALUE_TWO ? diuVillagesArray : (nilCertificateData.district == VALUE_THREE ? dnhVillagesArray : []));
        nilCertificateData.village_dmc_ward_text = villageData[nilCertificateData.village_dmc_ward] ? villageData[nilCertificateData.village_dmc_ward] : '';
        nilCertificateData.entity_establishment_type_text = entityEstablishmentTypeArray[nilCertificateData.entity_establishment_type] ? entityEstablishmentTypeArray[nilCertificateData.entity_establishment_type] : '';
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(nilCertificateViewTemplate(nilCertificateData));

        loadMDoc(VALUE_SIXTYONE, nilCertificateData.m_doc, '_view');
        if (nilCertificateData['m_other_doc'].length != VALUE_ZERO) {
            loadMOtherDoc(VALUE_SIXTYONE, nilCertificateData.m_other_doc, '_view');
        }
    },
    checkValidationForNilCertificate: function (nilCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!nilCertificateData.district_for_nil_certificate) {
            return getBasicMessageAndFieldJSONArray('district_for_nil_certificate', selectDistrictValidationMessage);
        }
        if (!nilCertificateData.village_dmc_ward_for_nil_certificate) {
            return getBasicMessageAndFieldJSONArray('village_dmc_ward_for_nil_certificate', oneOptionValidationMessage);
        }
        if (!nilCertificateData.entity_establishment_type_for_nil_certificate) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type_for_nil_certificate', entityEstablishmentTypeValidationMessage);
        }
        if (!nilCertificateData.applicant_name_for_nil_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_nil_certificate', applicantNameValidationMessage);
        }
        if (!nilCertificateData.applicant_address_for_nil_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_address_for_nil_certificate', addressValidationMessage);
        }
        if (!nilCertificateData.applicant_mobile_number_for_nil_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_mobile_number_for_nil_certificate', mobileValidationMessage);
        }
        var mobMessage = mobileNumberValidation(nilCertificateData.applicant_mobile_number_for_nil_certificate);
        if (mobMessage != '') {
            return getBasicMessageAndFieldJSONArray('applicant_mobile_number_for_nil_certificate', mobMessage);
        }
        if (!nilCertificateData.purpose_for_nil_certificate) {
            return getBasicMessageAndFieldJSONArray('purpose_for_nil_certificate', purposeValidationMessage);
        }
        if (!nilCertificateData.property_detail_for_nil_certificate) {
            return getBasicMessageAndFieldJSONArray('property_detail_for_nil_certificate', propertyDetailValidationMessage);
        }
        return '';
    },
    askForSubmitNilCertificate: function (moduleType) {
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
        var yesEvent = 'NilCertificate.listview.submitNilCertificate(' + newMType + ')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitNilCertificate: function (moduleType) {
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
        var nilCertificateData = $('#nil_certificate_form').serializeFormJSON();
        var validationData = that.checkValidationForNilCertificate(nilCertificateData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('nil-certificate-' + validationData.field, validationData.message);
            return false;
        }
        if (moduleType != VALUE_ONE) {
            var isDocValidation = checkValidationForMDoc(VALUE_SIXTYONE);
            if (isDocValidation) {
                return false;
            }
        }
        var isMODItemValidation = checkValidationForMOtherDoc(moduleType, VALUE_SIXTYONE);
        if (!isMODItemValidation) {
            return false;
        }
        nilCertificateData.new_mod_items = isMODItemValidation.new_mod_items;
        nilCertificateData.exi_mod_items = isMODItemValidation.exi_mod_items;
        if (moduleType == VALUE_THREE) {
            that.askForSubmitNilCertificate(moduleType);
            return false;
        }
        if (moduleType == VALUE_FOUR || moduleType == VALUE_FIVE) {
            var status = $('#status_for_nil_certificate').val();
            var queryStatus = $('#query_status_for_nil_certificate').val();
            if (status != VALUE_FIVE && status != VALUE_SIX && queryStatus == VALUE_ONE) {
                var qrRemarks = $('#remarks_for_nil_certificate').val();
                if (!qrRemarks) {
                    $('#remarks_for_nil_certificate').focus();
                    validationMessageShow('qrnc-remarks_for_nil_certificate', remarksValidationMessage);
                    return false;
                }
                nilCertificateData.qr_remarks = qrRemarks;
            } else {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (moduleType == VALUE_FOUR) {
                that.askForSubmitNilCertificate(moduleType);
                return false;
            }
        }
        nilCertificateData.module_type = moduleType;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_nil_certificate') : $('#submit_btn_for_nil_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'nil_certificate/submit_nil_certificate',
            data: $.extend({}, nilCertificateData, getTokenData()),
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
                validationMessageShow('nil-certificate', textStatus.statusText);
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
                    validationMessageShow('nil-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                NilCertificate.listview.loadNilCertificateData();
                showSuccess(parseData.message);
            }
        });
    },
    downloadUploadChallan: function (nilCertificateId) {
        if (!nilCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + nilCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'nil_certificate/get_nil_certificate_data_by_nil_certificate_id',
            type: 'post',
            data: $.extend({}, {'nil_certificate_id': nilCertificateId}, getTokenData()),
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
                var nilCertificateData = parseData.nil_certificate_data;
                that.showChallan(nilCertificateData);
            }
        });
    },
    showChallan: function (nilCertificateData) {
        showPopup();
        if (nilCertificateData.status != VALUE_FIVE && nilCertificateData.status != VALUE_SIX && nilCertificateData.status != VALUE_SEVEN) {
            if (!nilCertificateData.hide_submit_btn) {
                nilCertificateData.show_fees_paid = true;
            }
        }
        if (nilCertificateData.payment_type == VALUE_ONE) {
            nilCertificateData.utitle = 'Fees Paid Challan Copy';
        } else {
            nilCertificateData.style = 'display: none;';
        }
        if (nilCertificateData.payment_type == VALUE_TWO) {
            nilCertificateData.show_dd_po_option = true;
            nilCertificateData.utitle = 'Demand Draft (DD)';
        }
        nilCertificateData.module_type = VALUE_SIXTYONE;
        $('#popup_container').html(nilCertificateUploadChallanTemplate(nilCertificateData));
        loadFB(VALUE_SIXTYONE, nilCertificateData.fb_data);
        loadPH(VALUE_SIXTYONE, nilCertificateData.nil_certificate_id, nilCertificateData.ph_data);

        if (nilCertificateData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'nil_certificate_upload_challan', nilCertificateData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'nil_certificate_upload_challan', 'uc', 'radio');
            if (nilCertificateData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_nil_certificate_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (nilCertificateData.challan != '') {
            $('#challan_container_for_nil_certificate_upload_challan').hide();
            $('#challan_name_container_for_nil_certificate_upload_challan').show();
            $('#challan_name_href_for_nil_certificate_upload_challan').attr('href', 'documents/nil_certificate/' + nilCertificateData.challan);
            $('#challan_name_for_nil_certificate_upload_challan').html(nilCertificateData.challan);
        }
        if (nilCertificateData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_nil_certificate_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_nil_certificate_upload_challan').show();
            $('#fees_paid_challan_name_href_for_nil_certificate_upload_challan').attr('href', 'documents/nil_certificate/' + nilCertificateData.fees_paid_challan);
            $('#fees_paid_challan_name_for_nil_certificate_upload_challan').html(nilCertificateData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_nil_certificate_upload_challan').attr('onclick', 'NilCertificate.listview.removeFeesPaidChallan("' + nilCertificateData.nil_certificate_id + '")');
        }
    },
    removeFeesPaidChallan: function (nilCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!nilCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'nil_certificate/remove_fees_paid_challan',
            data: $.extend({}, {'nil_certificate_id': nilCertificateId}, getTokenData()),
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
                validationMessageShow('nil-certificate-uc', textStatus.statusText);
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
                    validationMessageShow('nil-certificate-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-nil-certificate-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'nil_certificate_upload_challan');
                $('#status_' + nilCertificateId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-nil-certificate-uc').html('');
        validationMessageHide();
        var nilCertificateId = $('#nil_certificate_id_for_nil_certificate_upload_challan').val();
        if (!nilCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_nil_certificate_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_nil_certificate_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_nil_certificate_upload_challan').focus();
                validationMessageShow('nil-certificate-uc-fees_paid_challan_for_nil_certificate_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_nil_certificate_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_nil_certificate_upload_challan').focus();
                validationMessageShow('nil-certificate-uc-fees_paid_challan_for_nil_certificate_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_nil_certificate_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#nil_certificate_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'nil_certificate/upload_fees_paid_challan',
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
                validationMessageShow('nil-certificate-uc', textStatus.statusText);
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
                    validationMessageShow('nil-certificate-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + nilCertificateId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    getQueryData: function (nilCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!nilCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_SIXTYONE;
        templateData.module_id = nilCertificateId;
        var btnObj = $('#query_btn_for_nil_certificate_' + nilCertificateId);
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
                tmpData.application_number = regNoRenderer(VALUE_SIXTYONE, moduleData.nil_certificate_id);
                tmpData.applicant_name = moduleData.applicant_name;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
});
