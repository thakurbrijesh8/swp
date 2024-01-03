var riiListTemplate = Handlebars.compile($('#rii_list_template').html());
var riiTableTemplate = Handlebars.compile($('#rii_table_template').html());
var riiActionTemplate = Handlebars.compile($('#rii_action_template').html());
var riiFormTemplate = Handlebars.compile($('#rii_form_template').html());
var riiViewTemplate = Handlebars.compile($('#rii_view_template').html());
var riiUploadChallanTemplate = Handlebars.compile($('#rii_upload_challan_template').html());

var RII = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
RII.Router = Backbone.Router.extend({
    routes: {
        'rii': 'renderList',
        'rii_form': 'renderListForForm',
        'edit_rii_form': 'renderList',
        'view_rii_form': 'renderList',
    },
    renderList: function () {
        RII.listview.listPage();
    },
    renderListForForm: function () {
        RII.listview.listPageRIIForm();
    }
});
RII.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_rii');
        RII.router.navigate('rii');
        var templateData = {};
        this.$el.html(riiListTemplate(templateData));
        this.loadRIIData(sDistrict, sStatus);

    },
    listPageRIIForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_rii');
        this.$el.html(riiListTemplate);
        this.newRIIForm(false, {});
    },
    actionRenderer: function (rowData) {
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE) {
            rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_form_one_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE && rowData.status != VALUE_TWO && rowData.status != VALUE_SIX) {
            rowData.ADMIN_RII_DOC_PATH = ADMIN_RII_DOC_PATH;
            rowData.show_download_upload_challan_btn = true;
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return riiActionTemplate(rowData);
    },
    loadRIIData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTYNINE, data);
        };
        var dateRendere = function (data, type, full, meta) {
            return dateTo_DD_MM_YYYY(full.created_time);
        };
        var that = this;
        RII.router.navigate('rii');
        $('#rii_form_and_datatable_container').html(riiTableTemplate(searchData));
        riiDataTable = $('#rii_datatable').DataTable({
            ajax: {url: 'rii/get_rii_data', dataSrc: "rii_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'rii_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'user_name', 'class': 'text-center'},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'address', 'class': 'text-center'},
                {data: 'created_time', 'class': 'text-center', 'render': dateRendere},
                {data: 'rii_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'rii_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#rii_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = riiDataTable.row(tr);

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
    newRIIForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.rii_data;
            RII.router.navigate('edit_rii_form');
        } else {
            var formData = {};
            RII.router.navigate('rii_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.rii_data = parseData.rii_data;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.estimated_date_of_commencement = dateTo_DD_MM_YYYY(formData.estimated_date_of_commencement);
        templateData.estimated_date_of_completion = dateTo_DD_MM_YYYY(formData.estimated_date_of_completion);
        $('#rii_form_and_datatable_container').html(riiFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        renderOptionsForTwoDimensionalArray(treadeArray, 'trade');
        renderOptionsForTwoDimensionalArray(reportArray, 'reporting');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#trade').val(formData.trade);
            $('#reporting').val(formData.reporting);

        }
        generateSelect2();
        datePicker();
        $('#rii_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitRII($('#submit_btn_for_rii'));
            }
        });
    },
    editOrViewRII: function (btnObj, riiId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!riiId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'rii/get_rii_data_by_id',
            type: 'post',
            data: $.extend({}, {'rii_id': riiId}, getTokenData()),
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
                    that.newRIIForm(isEdit, parseData);
                } else {
                    that.viewRIIForm(parseData);
                }
            }
        });
    },
    viewRIIForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.rii_data;
        RII.router.navigate('view_rii_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#rii_form_and_datatable_container').html(riiViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        renderOptionsForTwoDimensionalArray(treadeArray, 'trade');
        renderOptionsForTwoDimensionalArray(reportArray, 'reporting');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#trade').val(formData.trade);
        $('#reporting').val(formData.reporting);
    },
    checkValidationForRII: function (riiData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!riiData.user_name) {
            return getBasicMessageAndFieldJSONArray('user_name', userNameValidationMessage);
        }
        if (!riiData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!riiData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!riiData.address) {
            return getBasicMessageAndFieldJSONArray('address', addressValidationMessage);
        }
        if (!riiData.trade) {
            return getBasicMessageAndFieldJSONArray('trade', tradeValidationMessage);
        }
        if (!riiData.reporting) {
            return getBasicMessageAndFieldJSONArray('reporting', reportValidationMessage);
        }

        return '';
    },
    askForSubmitRII: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'RII.listview.submitRII(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitRII: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var riiData = $('#rii_form').serializeFormJSON();
        var validationData = that.checkValidationForRII(riiData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('rii-' + validationData.field, validationData.message);
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_rii') : $('#submit_btn_for_rii');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var riiData = new FormData($('#rii_form')[0]);
        riiData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        riiData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'rii/submit_rii',
            data: riiData,
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
                validationMessageShow('rii', textStatus.statusText);
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
                    validationMessageShow('rii', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                RII.router.navigate('rii', {'trigger': true});
            }
        });
    },

    askForRemove: function (riiId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!riiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'RII.listview.removeDocument(\'' + riiId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (riiId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!riiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_rii_' + docType).hide();
        $('.spinner_name_container_for_rii_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'rii/remove_document',
            data: $.extend({}, {'rii_id': riiId, 'document_id': docType}, getTokenData()),
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
                $('.spinner_container_for_rii_' + docType).hide();
                $('.spinner_name_container_for_rii_' + docType).show();
                validationMessageShow('clact', textStatus.statusText);
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
                    validationMessageShow('clact', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_rii_' + docType).show();
                $('.spinner_name_container_for_rii_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('form_one_name_container_for_rii', 'form_one_name_image_for_rii', 'form_one_container_for_rii', 'form_one_for_rii');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('workorder_copy_name_container_for_rii', 'workorder_copy_name_image_for_rii', 'workorder_copy_container_for_rii', 'workorder_copy_for_rii');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('copy_of_challan_name_container_for_rii', 'copy_of_challan_name_image_for_rii', 'copy_of_challan_container_for_rii', 'copy_of_challan_for_rii');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('seal_and_stamp_name_container_for_rii', 'seal_and_stamp_name_image_for_rii', 'seal_and_stamp_container_for_rii', 'seal_and_stamp_for_rii');
                }
//                $('#' + docType + '_name_container_for_rii').hide();
//                $('#' + docType + '_name_image_for_rii').attr('src', '');
//                $('#' + docType + '_container_for_rii').show();
//                $('#' + docType + '_for_rii').val('');
            }
        });
    },
    generateForm1: function (riiId) {
        if (!riiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#rii_id_for_rii_form1').val(riiId);
        $('#rii_form1_pdf_form').submit();
        $('#rii_id_for_rii_form1').val('');
    },

    downloadUploadChallan: function (riiId) {
        if (!riiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + riiId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'rii/get_rii_data_by_rii_id',
            type: 'post',
            data: $.extend({}, {'rii_id': riiId}, getTokenData()),
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
                var riiData = parseData.rii_data;
                that.showChallan(riiData);
            }
        });
    },
    showChallan: function (riiData) {
        showPopup();
        if (riiData.status != VALUE_FIVE && riiData.status != VALUE_SIX && riiData.status != VALUE_SEVEN) {
            if (!riiData.hide_submit_btn) {
                riiData.show_fees_paid = true;
            }
        }
        if (riiData.payment_type == VALUE_ONE) {
            riiData.utitle = 'Fees Paid Challan Copy';
        } else {
            riiData.style = 'display: none;';
        }
        if (riiData.payment_type == VALUE_TWO) {
            riiData.show_dd_po_option = true;
            riiData.utitle = 'Demand Draft (DD)';
        }
        riiData.module_type = VALUE_FOURTYNINE;
        $('#popup_container').html(riiUploadChallanTemplate(riiData));
        loadFB(VALUE_FOURTYNINE, riiData.fb_data);
        loadPH(VALUE_FOURTYNINE, riiData.rii_id, riiData.ph_data);

        if (riiData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'rii_upload_challan', riiData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'rii_upload_challan', 'uc', 'radio');
            if (riiData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_rii_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (riiData.challan != '') {
            $('#challan_container_for_rii_upload_challan').hide();
            $('#challan_name_container_for_rii_upload_challan').show();
            $('#challan_name_href_for_rii_upload_challan').attr('href', ADMIN_RII_DOC_PATH + riiData.challan);
            $('#challan_name_for_rii_upload_challan').html(riiData.challan);
        }
        if (riiData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_rii_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_rii_upload_challan').show();
            $('#fees_paid_challan_name_href_for_rii_upload_challan').attr('href', 'documents/rii/' + riiData.fees_paid_challan);
            $('#fees_paid_challan_name_for_rii_upload_challan').html(riiData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_rii_upload_challan').attr('onclick', 'RII.listview.removeFeesPaidChallan("' + riiData.rii_id + '")');
        }
    },
    removeFeesPaidChallan: function (riiId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!riiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'rii/remove_fees_paid_challan',
            data: $.extend({}, {'rii_id': riiId}, getTokenData()),
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
                validationMessageShow('rii-uc', textStatus.statusText);
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
                    validationMessageShow('rii-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-rii-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'rii_upload_challan');
                $('#status_' + riiId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-rii-uc').html('');
        validationMessageHide();
        var riiId = $('#rii_id_for_rii_upload_challan').val();
        if (!riiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_rii_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_rii_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_rii_upload_challan').focus();
                validationMessageShow('rii-uc-fees_paid_challan_for_rii_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_rii_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_rii_upload_challan').focus();
                validationMessageShow('rii-uc-fees_paid_challan_for_rii_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_rii_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#rii_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'rii/upload_fees_paid_challan',
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
                validationMessageShow('rii-uc', textStatus.statusText);
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
                    validationMessageShow('rii-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + riiId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (riiId) {
        if (!riiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#rii_id_for_certificate').val(riiId);
        $('#rii_certificate_pdf_form').submit();
        $('#rii_id_for_certificate').val('');
    },
    getQueryData: function (riiId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!riiId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTYNINE;
        templateData.module_id = riiId;
        var btnObj = $('#query_btn_for_app_' + riiId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOURTYNINE, moduleData.rii_id);
                tmpData.applicant_name = moduleData.user_name;
                tmpData.title = 'Name of User/ Premises';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForRII: function (fileNo) {
        var that = this;
        if ($('#form_one_for_rii').val() != '') {
            var formOne = checkValidationForDocument('form_one_for_rii', VALUE_ONE, 'rii');
            if (formOne == false) {
                return false;
            }
        }
        if ($('#workorder_copy_for_rii').val() != '') {
            var workorderCopy = checkValidationForDocument('workorder_copy_for_rii', VALUE_ONE, 'rii');
            if (workorderCopy == false) {
                return false;
            }
        }
        if ($('#copy_of_challan_for_rii').val() != '') {
            var copyOfChallan = checkValidationForDocument('copy_of_challan_for_rii', VALUE_ONE, 'rii');
            if (copyOfChallan == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_rii').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_rii', VALUE_TWO, 'rii');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_rii_' + fileNo).hide();
        $('.spinner_name_container_for_rii_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var riiId = $('#rii_id').val();
        var formData = new FormData($('#rii_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("rii_id", riiId);
        $.ajax({
            type: 'POST',
            url: 'rii/upload_rii_document',
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
                $('.spinner_container_for_rii_' + fileNo).show();
                $('.spinner_name_container_for_rii_' + fileNo).hide();
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
                    $('#spinner_template').hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_rii_' + fileNo).hide();
                $('.spinner_name_container_for_rii_' + fileNo).show();
                $('#rii_id').val(parseData.rii_id);
                var riiData = parseData.rii_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('form_one_container_for_rii', 'form_one_name_image_for_rii', 'form_one_name_container_for_rii',
                            'form_one_name_download', 'form_one_remove_btn', riiData.form_one, parseData.rii_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('workorder_copy_container_for_rii', 'workorder_copy_name_image_for_rii', 'workorder_copy_name_container_for_rii',
                            'workorder_copy_name_download', 'workorder_copy_remove_btn', riiData.workorder_copy, parseData.rii_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('copy_of_challan_container_for_rii', 'copy_of_challan_name_image_for_rii', 'copy_of_challan_name_container_for_rii',
                            'copy_of_challan_name_download', 'copy_of_challan_remove_btn', riiData.copy_of_challan, parseData.rii_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('seal_and_stamp_container_for_rii', 'seal_and_stamp_name_image_for_rii', 'seal_and_stamp_name_container_for_rii',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', riiData.sign_of_principal_employee, parseData.rii_id, VALUE_FOUR);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/rii/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/rii/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'RII.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
