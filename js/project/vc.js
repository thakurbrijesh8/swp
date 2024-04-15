var vcListTemplate = Handlebars.compile($('#vc_list_template').html());
var vcTableTemplate = Handlebars.compile($('#vc_table_template').html());
var vcActionTemplate = Handlebars.compile($('#vc_action_template').html());
var vcFormTemplate = Handlebars.compile($('#vc_form_template').html());
var vcViewTemplate = Handlebars.compile($('#vc_view_template').html());
var vcUploadChallanTemplate = Handlebars.compile($('#vc_upload_challan_template').html());

var tempPersonCnt = 1;

var VC = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
VC.Router = Backbone.Router.extend({
    routes: {
        'vc': 'renderList',
        'vc_form': 'renderListForForm',
        'edit_vc_form': 'renderList',
        'view_vc_form': 'renderList',
    },
    renderList: function () {
        VC.listview.listPage();
    },
    renderListForForm: function () {
        VC.listview.listPageVCForm();
    }
});
VC.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('vc', 'active');
        VC.router.navigate('vc');
        var templateData = {};
        this.$el.html(vcListTemplate(templateData));
        this.loadVCData(sDistrict, sStatus);

    },
    listPageVCForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(vcListTemplate);
        this.newVCForm(false, {});
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
                rowData.ADMIN_VC_DOC_PATH = ADMIN_VC_DOC_PATH;
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
        return vcActionTemplate(rowData);
    },
    loadVCData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTYEIGHT, data)
                    + getFRContainer(VALUE_FOURTYEIGHT, data, full.rating, full.fr_datetime);
        };
        var that = this;
        VC.router.navigate('vc');
        $('#vc_form_and_datatable_container').html(vcTableTemplate(searchData));
        vcDataTable = $('#vc_datatable').DataTable({
            ajax: {url: 'vc/get_vc_data', dataSrc: "vc_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'vc_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'model_no', 'class': 'text-center'},
                {data: 'serial_no', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'vc_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'vc_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#vc_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = vcDataTable.row(tr);

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
    newVCForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.vc_data;
            VC.router.navigate('edit_vc_form');
        } else {
            var formData = {};
            VC.router.navigate('vc_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.vc_data = parseData.vc_data;
        $('#vc_form_and_datatable_container').html(vcFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        renderOptionsForTwoDimensionalArray(tradeArray, 'trade');
        renderOptionsForTwoDimensionalArray(capacityTypeArray, 'capacity_type');
        renderOptionsForTwoDimensionalArray(classArray, 'class');
        renderOptionsForTwoDimensionalArray(verificationPlaceArray, 'verification_at');
        renderOptionsForTwoDimensionalArray(quantityUnitsArray, 'quantity_units');
        if (isEdit) {
            $('#application_category').val(formData.application_category);
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#trade').val(formData.trade);
            $('#capacity_type').val(formData.capacity_type);
            $('#class').val(formData.class);
            $('#verification_at').val(formData.verification_at);
            $('#quantity_units').val(formData.quantity_units);

            if (formData.invoice_doc != '') {
                that.showDocument('invoice_doc_container', 'invoice_doc_name_image', 'invoice_doc_name_container',
                        'invoice_doc_download', 'invoice_doc_remove_btn', formData.invoice_doc, formData.vc_id, VALUE_ONE);
            }
        }
        generateSelect2();
        datePicker();
        $('#vc_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitVC($('#submit_btn_for_vc'));
            }
        });
    },
    editOrViewVC: function (btnObj, vcId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!vcId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'vc/get_vc_data_by_id',
            type: 'post',
            data: $.extend({}, {'vc_id': vcId}, getTokenData()),
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
                    that.newVCForm(isEdit, parseData);
                } else {
                    that.viewVCForm(parseData);
                }
            }
        });
    },
    viewVCForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.vc_data;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        VC.router.navigate('view_vc_form');
//        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        $('#vc_form_and_datatable_container').html(vcViewTemplate(formData));
        $('input[type=text]').attr('disabled', 'disabled');
        $('.hideView').prop('disabled', true);

        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        renderOptionsForTwoDimensionalArray(tradeArray, 'trade');
        renderOptionsForTwoDimensionalArray(capacityTypeArray, 'capacity_type');
        renderOptionsForTwoDimensionalArray(classArray, 'class');
        renderOptionsForTwoDimensionalArray(verificationPlaceArray, 'verification_at');
        renderOptionsForTwoDimensionalArray(quantityUnitsArray, 'quantity_units');

        $('#application_category').val(formData.application_category);
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#trade').val(formData.trade);
        $('#capacity_type').val(formData.capacity_type);
        $('#class').val(formData.class);
        $('#verification_at').val(formData.verification_at);
        $('#quantity_units').val(formData.quantity_units);

        if (formData.invoice_doc != '') {
            that.showDocument('invoice_doc_container', 'invoice_doc_name_image', 'invoice_doc_name_container',
                    'invoice_doc_download', 'invoice_doc_remove_btn', formData.invoice_doc, formData.vc_id, VALUE_ONE);
        }
    },
    checkValidationForVC: function (vcData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!vcData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!vcData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!vcData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!vcData.address) {
            return getBasicMessageAndFieldJSONArray('address', addressValidationMessage);
        }
        if (!vcData.trade) {
            return getBasicMessageAndFieldJSONArray('trade', selectOneOptionValidationMessage);
        }
//        if (!vcData.type) {
//            return getBasicMessageAndFieldJSONArray('type', selectOneOptionValidationMessage);
//        }
//        if (!vcData.sub_type) {
//            return getBasicMessageAndFieldJSONArray('sub_type', selectOneOptionValidationMessage);
//        }
        if (!vcData.capacity) {
            return getBasicMessageAndFieldJSONArray('capacity', capacityValidationMessage);
        }
        if (!vcData.capacity_type) {
            return getBasicMessageAndFieldJSONArray('capacity_type', selectOneOptionValidationMessage);
        }
        if (!vcData.class) {
            return getBasicMessageAndFieldJSONArray('class', selectOneOptionValidationMessage);
        }
        if (!vcData.make) {
            return getBasicMessageAndFieldJSONArray('make', makeValidationMessage);
        }
        if (!vcData.model_no) {
            return getBasicMessageAndFieldJSONArray('model_no', modelNoValidationMessage);
        }
        if (!vcData.serial_no) {
            return getBasicMessageAndFieldJSONArray('serial_no', serialNoValidationMessage);
        }
        if (!vcData.verification_at) {
            return getBasicMessageAndFieldJSONArray('verification_at', selectOneOptionValidationMessage);
        }
        if (!vcData.quantity_units) {
            return getBasicMessageAndFieldJSONArray('quantity_units', selectOneOptionValidationMessage);
        }

        return '';
    },
    askForSubmitVC: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'VC.listview.submitVC(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitVC: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var vcData = $('#vc_form').serializeFormJSON();
        var validationData = that.checkValidationForVC(vcData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('vc-' + validationData.field, validationData.message);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }

        if ($('#invoice_doc_container').is(':visible')) {
            var receiptIncomeTax = checkValidationForDocument('invoice_doc', VALUE_ONE, 'vc');
            if (receiptIncomeTax == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_vc') : $('#submit_btn_for_vc');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var vcData = new FormData($('#vc_form')[0]);
        vcData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        vcData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'vc/submit_vc',
            data: vcData,
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
                validationMessageShow('vc', textStatus.statusText);
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
                    validationMessageShow('vc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                VC.router.navigate('vc', {'trigger': true});
            }
        });
    },

    askForRemove: function (vcId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!vcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'VC.listview.removeDocument(\'' + vcId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (vcId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!vcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_vc_' + docType).hide();
        $('.spinner_name_container_for_vc_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'vc/remove_document',
            data: $.extend({}, {'vc_id': vcId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_vc_' + docType).hide();
                $('.spinner_name_container_for_vc_' + docType).show();
                validationMessageShow('vc', textStatus.statusText);
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
                    validationMessageShow('vc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_vc_' + docType).show();
                $('.spinner_name_container_for_vc_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('invoice_doc_name_container', 'invoice_doc_name_image', 'invoice_doc_container', 'invoice_doc');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('seal_and_stamp_name_container_for_vc', 'seal_and_stamp_name_image_for_vc', 'seal_and_stamp_container_for_vc', 'seal_and_stamp_for_vc');
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
    generateForm1: function (vcId) {
        if (!vcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#vc_id_for_vc_form1').val(vcId);
        $('#vc_form1_pdf_form').submit();
        $('#vc_id_for_vc_form1').val('');
    },

    downloadUploadChallan: function (vcId) {
        if (!vcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + vcId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'vc/get_vc_data_by_vc_id',
            type: 'post',
            data: $.extend({}, {'vc_id': vcId}, getTokenData()),
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
                var vcData = parseData.vc_data;
                that.showChallan(vcData);
            }
        });
    },
    showChallan: function (vcData) {
        showPopup();
        if (vcData.status != VALUE_FIVE && vcData.status != VALUE_SIX && vcData.status != VALUE_SEVEN && vcData.status != VALUE_ELEVEN) {
            if (!vcData.hide_submit_btn) {
                vcData.show_fees_paid = true;
            }
        }
        if (vcData.payment_type == VALUE_ONE) {
            vcData.utitle = 'Fees Paid Challan Copy';
        } else {
            vcData.style = 'display: none;';
        }
        if (vcData.payment_type == VALUE_TWO) {
            vcData.show_dd_po_option = true;
            vcData.utitle = 'Demand Draft (DD)';
        }
        vcData.module_type = VALUE_FOURTYEIGHT;
        $('#popup_container').html(vcUploadChallanTemplate(vcData));
        loadFB(VALUE_FOURTYEIGHT, vcData.fb_data);
        loadPH(VALUE_FOURTYEIGHT, vcData.vc_id, vcData.ph_data);

        if (vcData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'vc_upload_challan', vcData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'vc_upload_challan', 'uc', 'radio');
            if (vcData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_vc_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (vcData.challan != '') {
            $('#challan_container_for_vc_upload_challan').hide();
            $('#challan_name_container_for_vc_upload_challan').show();
            $('#challan_name_href_for_vc_upload_challan').attr('href', 'documents/vc/' + vcData.challan);
            $('#challan_name_for_vc_upload_challan').html(vcData.challan);
        }
        if (vcData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_vc_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_vc_upload_challan').show();
            $('#fees_paid_challan_name_href_for_vc_upload_challan').attr('href', 'documents/vc/' + vcData.fees_paid_challan);
            $('#fees_paid_challan_name_for_vc_upload_challan').html(vcData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_vc_upload_challan').attr('onclick', 'VC.listview.removeFeesPaidChallan("' + vcData.vc_id + '")');
        }
    },
    removeFeesPaidChallan: function (vcId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!vcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'vc/remove_fees_paid_challan',
            data: $.extend({}, {'vc_id': vcId}, getTokenData()),
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
                validationMessageShow('vc-uc', textStatus.statusText);
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
                    validationMessageShow('vc-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-vc-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'vc_upload_challan');
                $('#status_' + vcId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-vc-uc').html('');
        validationMessageHide();
        var vcId = $('#vc_id_for_vc_upload_challan').val();
        if (!vcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_vc_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_vc_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_vc_upload_challan').focus();
                validationMessageShow('vc-uc-fees_paid_challan_for_vc_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_vc_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_vc_upload_challan').focus();
                validationMessageShow('vc-uc-fees_paid_challan_for_vc_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_vc_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#vc_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'vc/upload_fees_paid_challan',
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
                validationMessageShow('vc-uc', textStatus.statusText);
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
                    validationMessageShow('vc-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + vcId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (vcId) {
        if (!vcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#vc_id_for_certificate').val(vcId);
        $('#vc_certificate_pdf_form').submit();
        $('#vc_id_for_certificate').val('');
    },
    getQueryData: function (vcId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!vcId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTYEIGHT;
        templateData.module_id = vcId;
        var btnObj = $('#query_btn_for_vc_' + vcId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOURTYEIGHT, moduleData.vc_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForVC: function (fileNo) {
        var that = this;
        if ($('#invoice_doc').val() != '') {
            var invoiceDoc = checkValidationForDocument('invoice_doc', VALUE_ONE, 'vc');
            if (invoiceDoc == false) {
                return false;
            }
        }

        $('.spinner_container_for_vc_' + fileNo).hide();
        $('.spinner_name_container_for_vc_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var vcId = $('#vc_id').val();
        var formData = new FormData($('#vc_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("vc_id", vcId);
        $.ajax({
            type: 'POST',
            url: 'vc/upload_vc_document',
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
                $('.spinner_container_for_vc_' + fileNo).show();
                $('.spinner_name_container_for_vc_' + fileNo).hide();
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
                    $('.spinner_container_for_vc_' + fileNo).show();
                    $('.spinner_name_container_for_vc_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_vc_' + fileNo).hide();
                $('.spinner_name_container_for_vc_' + fileNo).show();
                $('#vc_id').val(parseData.vc_id);
                var vcData = parseData.vc_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('invoice_doc_container', 'invoice_doc_name_image', 'invoice_doc_name_container',
                            'invoice_doc_download', 'invoice_doc_remove_btn', vcData.invoice_doc, parseData.vc_id, VALUE_ONE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/vc/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/vc/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'VC.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
