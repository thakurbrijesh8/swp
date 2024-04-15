var wcListTemplate = Handlebars.compile($('#wc_list_template').html());
var wcTableTemplate = Handlebars.compile($('#wc_table_template').html());
var wcActionTemplate = Handlebars.compile($('#wc_action_template').html());
var wcFormTemplate = Handlebars.compile($('#wc_form_template').html());
var wcViewTemplate = Handlebars.compile($('#wc_view_template').html());
var wcUploadChallanTemplate = Handlebars.compile($('#wc_upload_challan_template').html());

var tempPersonCnt = 1;

var WC = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
WC.Router = Backbone.Router.extend({
    routes: {
        'wc': 'renderList',
        'wc_form': 'renderListForForm',
        'edit_wc_form': 'renderList',
        'view_wc_form': 'renderList',
    },
    renderList: function () {
        WC.listview.listPage();
    },
    renderListForForm: function () {
        WC.listview.listPageWCForm();
    }
});
WC.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('wc', 'active');
        WC.router.navigate('wc');
        var templateData = {};
        this.$el.html(wcListTemplate(templateData));
        this.loadWCData(sDistrict, sStatus);

    },
    listPageWCForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(wcListTemplate);
        this.newWCForm(false, {});
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
                rowData.ADMIN_WC_DOC_PATH = ADMIN_WC_DOC_PATH;
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
        return wcActionTemplate(rowData);
    },
    loadWCData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FIVE, data)
                    + getFRContainer(VALUE_FIVE, data, full.rating, full.fr_datetime);
        };
        var that = this;
        WC.router.navigate('wc');
        $('#wc_form_and_datatable_container').html(wcTableTemplate(searchData));
        wcDataTable = $('#wc_datatable').DataTable({
            ajax: {url: 'wc/get_wc_data', dataSrc: "wc_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'wc_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'application_category', 'class': 'text-center'},
                {data: 'house_ownership', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'wc_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'wc_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#wc_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = wcDataTable.row(tr);

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
    newWCForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.wc_data;
            WC.router.navigate('edit_wc_form');
        } else {
            var formData = {};
            WC.router.navigate('wc_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.wc_data = parseData.wc_data;
        $('#wc_form_and_datatable_container').html(wcFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#declaration_for_wc').attr('checked', 'checked');
            $('#application_category').val(formData.application_category);
            $('#house_ownership').val(formData.house_ownership);
            $('#wc_type').val(formData.wc_type);
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);

            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_wc', 'seal_and_stamp_name_image_for_wc', 'seal_and_stamp_name_container_for_wc',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.wc_id, VALUE_TWO);
            }
            if (formData.receipt_of_last_years_house_tax != '') {
                that.showDocument('receipt_of_last_years_house_tax_container', 'receipt_of_last_years_house_tax_name_image', 'receipt_of_last_years_house_tax_name_container',
                        'receipt_of_last_years_house_tax_download', 'receipt_of_last_years_house_tax_remove_btn', formData.receipt_of_last_years_house_tax, formData.wc_id, VALUE_ONE);
            }
            if (formData.id_proof != '') {
                that.showDocument('id_proof_container', 'id_proof_name_image', 'id_proof_name_container',
                        'id_proof_download', 'id_proof_remove_btn', formData.id_proof, formData.wc_id, VALUE_THREE);
            }
            if (formData.electricity_bill != '') {
                that.showDocument('electricity_bill_container', 'electricity_bill_name_image', 'electricity_bill_name_container',
                        'electricity_bill_download', 'electricity_bill_remove_btn', formData.id_proof, formData.wc_id, VALUE_FOUR);
            }
        }
        generateSelect2();
        datePicker();
        $('#wc_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitWC($('#submit_btn_for_wc'));
            }
        });
    },
    editOrViewWC: function (btnObj, wcId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!wcId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'wc/get_wc_data_by_id',
            type: 'post',
            data: $.extend({}, {'wc_id': wcId}, getTokenData()),
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
                    that.newWCForm(isEdit, parseData);
                } else {
                    that.viewWCForm(parseData);
                }
            }
        });
    },
    viewWCForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.wc_data;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        WC.router.navigate('view_wc_form');
//        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        $('#wc_form_and_datatable_container').html(wcViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#declaration_for_wc').attr('checked', 'checked');
        $('#application_category').val(formData.application_category);
        $('#house_ownership').val(formData.house_ownership);
        $('#wc_type').val(formData.wc_type);
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_wc_view', 'seal_and_stamp_name_image_for_wc_view', 'seal_and_stamp_name_container_for_wc_view',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.wc_id, VALUE_TWO);
        }
        if (formData.receipt_of_last_years_house_tax != '') {
            that.showDocument('receipt_of_last_years_house_tax_container_for_wc_view', 'receipt_of_last_years_house_tax_name_image_for_wc_view', 'receipt_of_last_years_house_tax_name_container_for_wc_view',
                    'receipt_of_last_years_house_tax_download', 'receipt_of_last_years_house_tax_remove_btn', formData.receipt_of_last_years_house_tax, formData.wc_id, VALUE_ONE);
        }
        if (formData.id_proof != '') {
            that.showDocument('id_proof_container_for_wc_view', 'id_proof_name_image_for_wc_view', 'id_proof_name_container_for_wc_view',
                    'id_proof_download', 'id_proof_remove_btn', formData.id_proof, formData.wc_id, VALUE_THREE);
        }
        if (formData.electricity_bill != '') {
            that.showDocument('electricity_bill_container_for_wc_view', 'electricity_bill_name_image_for_wc_view', 'electricity_bill_name_container_for_wc_view',
                    'electricity_bill_download', 'electricity_bill_remove_btn', formData.id_proof, formData.wc_id, VALUE_FOUR);
        }
    },
    checkValidationForWC: function (wcData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!wcData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!wcData.house_no) {
            return getBasicMessageAndFieldJSONArray('house_no', houseNoValidationMessage);
        }
        if (!wcData.ward_no) {
            return getBasicMessageAndFieldJSONArray('ward_no', wardNoValidationMessage);
        }
        if (!wcData.village) {
            return getBasicMessageAndFieldJSONArray('village', villageValidationMessage);
        }
        if (!wcData.panchayat_or_dmc) {
            return getBasicMessageAndFieldJSONArray('panchayat_or_dmc', panchayatOrDmcValidationMessage);
        }
        if (!wcData.application_category) {
            return getBasicMessageAndFieldJSONArray('application_category', applicantCategoryWcValidationMessage);
        }
        if (!wcData.house_ownership) {
            return getBasicMessageAndFieldJSONArray('house_ownership', houseOwnershipValidationMessage);
        }
        if (!wcData.wc_type) {
            return getBasicMessageAndFieldJSONArray('wc_type', wcTypeValidationMessage);
        }
        if (!wcData.diameter_service_connection) {
            return getBasicMessageAndFieldJSONArray('diameter_service_connection', diameterServiceConnectionValidationMessage);
        }
        if (!wcData.water_meter) {
            return getBasicMessageAndFieldJSONArray('water_meter', waterMeterValidationMessage);
        }
        if (!wcData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!wcData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        return '';
    },
    askForSubmitWC: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'WC.listview.submitWC(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitWC: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var wcData = $('#wc_form').serializeFormJSON();
        var validationData = that.checkValidationForWC(wcData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('wc-' + validationData.field, validationData.message);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }

        if ($('#receipt_of_last_years_house_tax_container').is(':visible')) {
            var receiptIncomeTax = checkValidationForDocument('receipt_of_last_years_house_tax', VALUE_ONE, 'wc');
            if (receiptIncomeTax == false) {
                return false;
            }
        }

        if ($('#id_proof_container').is(':visible')) {
            var idProof = checkValidationForDocument('id_proof', VALUE_ONE, 'wc');
            if (idProof == false) {
                return false;
            }
        }

        if ($('#electricity_bill_container').is(':visible')) {
            var electricityBill = checkValidationForDocument('electricity_bill', VALUE_ONE, 'wc');
            if (electricityBill == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_wc').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_wc', VALUE_TWO, 'wc');
            if (sealAndStamp == false) {
                return false;
            }
        }

        if (!$('#declaration_for_wc').is(':checked')) {
            $('#declaration_for_wc').focus();
            validationMessageShow('wc-declaration_for_wc', declarationOneValidationMessage);
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_wc') : $('#submit_btn_for_wc');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var wcData = new FormData($('#wc_form')[0]);
        wcData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        wcData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'wc/submit_wc',
            data: wcData,
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
                validationMessageShow('wc', textStatus.statusText);
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
                    validationMessageShow('wc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                WC.router.navigate('wc', {'trigger': true});
            }
        });
    },

    askForRemove: function (wcId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!wcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'WC.listview.removeDocument(\'' + wcId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (wcId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!wcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_wc_' + docType).hide();
        $('.spinner_name_container_for_wc_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'wc/remove_document',
            data: $.extend({}, {'wc_id': wcId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_wc_' + docType).hide();
                $('.spinner_name_container_for_wc_' + docType).show();
                validationMessageShow('wc', textStatus.statusText);
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
                    validationMessageShow('wc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_wc_' + docType).show();
                $('.spinner_name_container_for_wc_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('receipt_of_last_years_house_tax_name_container', 'receipt_of_last_years_house_tax_name_image', 'receipt_of_last_years_house_tax_container', 'receipt_of_last_years_house_tax');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('seal_and_stamp_name_container_for_wc', 'seal_and_stamp_name_image_for_wc', 'seal_and_stamp_container_for_wc', 'seal_and_stamp_for_wc');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('id_proof_name_container', 'id_proof_name_image', 'id_proof_container', 'id_proof');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('electricity_bill_name_container', 'electricity_bill_name_image', 'electricity_bill_container', 'electricity_bill');
                }
            }
        });
    },
    generateForm1: function (wcId) {
        if (!wcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#wc_id_for_wc_form1').val(wcId);
        $('#wc_form1_pdf_form').submit();
        $('#wc_id_for_wc_form1').val('');
    },

    downloadUploadChallan: function (wcId) {
        if (!wcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + wcId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'wc/get_wc_data_by_wc_id',
            type: 'post',
            data: $.extend({}, {'wc_id': wcId}, getTokenData()),
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
                var wcData = parseData.wc_data;
                that.showChallan(wcData);
            }
        });
    },
    showChallan: function (wcData) {
        showPopup();
        if (wcData.status != VALUE_FIVE && wcData.status != VALUE_SIX && wcData.status != VALUE_SEVEN && wcData.status != VALUE_ELEVEN) {
            if (!wcData.hide_submit_btn) {
                wcData.show_fees_paid = true;
            }
        }
        if (wcData.payment_type == VALUE_ONE) {
            wcData.utitle = 'Fees Paid Challan Copy';
        } else {
            wcData.style = 'display: none;';
        }
        if (wcData.payment_type == VALUE_TWO) {
            wcData.show_dd_po_option = true;
            wcData.utitle = 'Demand Draft (DD)';
        }
        wcData.module_type = VALUE_FIVE;
        $('#popup_container').html(wcUploadChallanTemplate(wcData));
        loadFB(VALUE_FIVE, wcData.fb_data);
        loadPH(VALUE_FIVE, wcData.wc_id, wcData.ph_data);

        if (wcData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'wc_upload_challan', wcData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'wc_upload_challan', 'uc', 'radio');
            if (wcData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_wc_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (wcData.challan != '') {
            $('#challan_container_for_wc_upload_challan').hide();
            $('#challan_name_container_for_wc_upload_challan').show();
            $('#challan_name_href_for_wc_upload_challan').attr('href', 'documents/wc/' + wcData.challan);
            $('#challan_name_for_wc_upload_challan').html(wcData.challan);
        }
        if (wcData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_wc_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_wc_upload_challan').show();
            $('#fees_paid_challan_name_href_for_wc_upload_challan').attr('href', 'documents/wc/' + wcData.fees_paid_challan);
            $('#fees_paid_challan_name_for_wc_upload_challan').html(wcData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_wc_upload_challan').attr('onclick', 'WC.listview.removeFeesPaidChallan("' + wcData.wc_id + '")');
        }
    },
    removeFeesPaidChallan: function (wcId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!wcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'wc/remove_fees_paid_challan',
            data: $.extend({}, {'wc_id': wcId}, getTokenData()),
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
                validationMessageShow('wc-uc', textStatus.statusText);
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
                    validationMessageShow('wc-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-wc-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'wc_upload_challan');
                $('#status_' + wcId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-wc-uc').html('');
        validationMessageHide();
        var wcId = $('#wc_id_for_wc_upload_challan').val();
        if (!wcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_wc_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_wc_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_wc_upload_challan').focus();
                validationMessageShow('wc-uc-fees_paid_challan_for_wc_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_wc_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_wc_upload_challan').focus();
                validationMessageShow('wc-uc-fees_paid_challan_for_wc_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_wc_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#wc_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'wc/upload_fees_paid_challan',
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
                validationMessageShow('wc-uc', textStatus.statusText);
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
                    validationMessageShow('wc-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + wcId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (wcId) {
        if (!wcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#wc_id_for_certificate').val(wcId);
        $('#wc_certificate_pdf_form').submit();
        $('#wc_id_for_certificate').val('');
    },
    getQueryData: function (wcId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!wcId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FIVE;
        templateData.module_id = wcId;
        var btnObj = $('#query_btn_for_wc_' + wcId);
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
                tmpData.application_number = regNoRenderer(VALUE_FIVE, moduleData.wc_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForWC: function (fileNo) {
        var that = this;
        if ($('#receipt_of_last_years_house_tax').val() != '') {
            var receiptOfLastYearsHouseTax = checkValidationForDocument('receipt_of_last_years_house_tax', VALUE_ONE, 'wc', 10240);
            if (receiptOfLastYearsHouseTax == false) {
                return false;
            }
        }
        if ($('#id_proof').val() != '') {
            var idProof = checkValidationForDocument('id_proof', VALUE_ONE, 'wc');
            if (idProof == false) {
                return false;
            }
        }
        if ($('#electricity_bill').val() != '') {
            var electricityBill = checkValidationForDocument('electricity_bill', VALUE_ONE, 'wc');
            if (electricityBill == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_wc').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_wc', VALUE_TWO, 'wc');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_wc_' + fileNo).hide();
        $('.spinner_name_container_for_wc_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var wcId = $('#wc_id').val();
        var formData = new FormData($('#wc_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("wc_id", wcId);
        $.ajax({
            type: 'POST',
            url: 'wc/upload_wc_document',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
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
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_wc_' + fileNo).show();
                $('.spinner_name_container_for_wc_' + fileNo).hide();
                showError(textStatus.statusText);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    $('#spinner_template_' + fileNo).hide();
                    $('.spinner_container_for_wc_' + fileNo).show();
                    $('.spinner_name_container_for_wc_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_wc_' + fileNo).hide();
                $('.spinner_name_container_for_wc_' + fileNo).show();
                $('#wc_id').val(parseData.wc_id);
                var wcData = parseData.wc_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('receipt_of_last_years_house_tax_container', 'receipt_of_last_years_house_tax_name_image', 'receipt_of_last_years_house_tax_name_container',
                            'receipt_of_last_years_house_tax_download', 'receipt_of_last_years_house_tax_remove_btn', wcData.receipt_of_last_years_house_tax, parseData.wc_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('seal_and_stamp_container_for_wc', 'seal_and_stamp_name_image_for_wc', 'seal_and_stamp_name_container_for_wc',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', wcData.signature, parseData.wc_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('id_proof_container', 'id_proof_name_image', 'id_proof_name_container',
                            'id_proof_download', 'id_proof_remove_btn', wcData.id_proof, parseData.wc_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('electricity_bill_container', 'electricity_bill_name_image', 'electricity_bill_name_container',
                            'electricity_bill_download', 'electricity_bill_remove_btn', wcData.electricity_bill, parseData.wc_id, VALUE_FOUR);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/wc/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/wc/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'WC.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
