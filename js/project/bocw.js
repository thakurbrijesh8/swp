var bocwListTemplate = Handlebars.compile($('#bocw_list_template').html());
var bocwTableTemplate = Handlebars.compile($('#bocw_table_template').html());
var bocwActionTemplate = Handlebars.compile($('#bocw_action_template').html());
var bocwFormTemplate = Handlebars.compile($('#bocw_form_template').html());
var bocwViewTemplate = Handlebars.compile($('#bocw_view_template').html());
var bocwUploadChallanTemplate = Handlebars.compile($('#bocw_upload_challan_template').html());

var BOCW = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
BOCW.Router = Backbone.Router.extend({
    routes: {
        'bocw': 'renderList',
        'bocw_form': 'renderListForForm',
        'edit_bocw_form': 'renderList',
        'view_bocw_form': 'renderList',
    },
    renderList: function () {
        BOCW.listview.listPage();
    },
    renderListForForm: function () {
        BOCW.listview.listPageBOCWForm();
    }
});
BOCW.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        BOCW.router.navigate('bocw');
        var templateData = {};
        this.$el.html(bocwListTemplate(templateData));
        this.loadBOCWData(sDistrict, sStatus);

    },
    listPageBOCWForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(bocwListTemplate);
        this.newBOCWForm(false, {});
    },
    actionRenderer: function (rowData) {
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE) {
            rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_form_one_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE && rowData.status != VALUE_TWO && rowData.status != VALUE_SIX && rowData.status != VALUE_NINE) {
            if (rowData.payment_type != VALUE_THREE) {
                rowData.ADMIN_BOCW_DOC_PATH = ADMIN_BOCW_DOC_PATH;
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
        return bocwActionTemplate(rowData);
    },
    loadBOCWData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTYTWO, data)
                    + getFRContainer(VALUE_THIRTYTWO, data, full.rating, full.fr_datetime);
        };
        var that = this;
        BOCW.router.navigate('bocw');
        $('#bocw_form_and_datatable_container').html(bocwTableTemplate(searchData));
        bocwDataTable = $('#bocw_datatable').DataTable({
            ajax: {url: 'bocw/get_bocw_data', dataSrc: "bocw_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'bocw_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_location_of_est', 'class': 'text-center'},
                {data: 'postal_address_of_est', 'class': 'text-center'},
                {data: 'name_address_of_manager', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'bocw_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'bocw_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#bocw_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = bocwDataTable.row(tr);

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
    newBOCWForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.bocw_data;
            BOCW.router.navigate('edit_bocw_form');
        } else {
            var formData = {};
            BOCW.router.navigate('bocw_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.bocw_data = parseData.bocw_data;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.estimated_date_of_commencement = dateTo_DD_MM_YYYY(formData.estimated_date_of_commencement);
        templateData.estimated_date_of_completion = dateTo_DD_MM_YYYY(formData.estimated_date_of_completion);
        $('#bocw_form_and_datatable_container').html(bocwFormTemplate((templateData)));
        allowOnlyIntegerValue('max_num_building_workers');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#declarationone').attr('checked', 'checked');
            $('#declarationtwo').attr('checked', 'checked');

            if (formData.form_one != '') {
                $('#form_one_container_for_bocw').hide();
                $('#form_one_name_image_for_bocw').attr('src', baseUrl + 'documents/bocw/' + formData.form_one);
                $('#form_one_name_container_for_bocw').show();
                $('#form_one_name_download').attr("href", baseUrl + 'documents/bocw/' + formData.form_one);
            }
            if (formData.workorder_copy != '') {
                $('#workorder_copy_container_for_bocw').hide();
                $('#workorder_copy_name_image_for_bocw').attr('src', baseUrl + 'documents/bocw/' + formData.workorder_copy);
                $('#workorder_copy_name_container_for_bocw').show();
                $('#workorder_copy_name_download').attr("href", baseUrl + 'documents/bocw/' + formData.workorder_copy);
            }
            if (formData.copy_of_challan != '') {
                $('#copy_of_challan_container_for_bocw').hide();
                $('#copy_of_challan_name_image_for_bocw').attr('src', baseUrl + 'documents/bocw/' + formData.copy_of_challan);
                $('#copy_of_challan_name_container_for_bocw').show();
                $('#copy_of_challan_name_download').attr("href", baseUrl + 'documents/bocw/' + formData.copy_of_challan);
            }
            if (formData.sign_of_principal_employee != '') {
                $('#seal_and_stamp_container_for_bocw').hide();
                $('#seal_and_stamp_name_image_for_bocw').attr('src', baseUrl + 'documents/bocw/' + formData.sign_of_principal_employee);
                $('#seal_and_stamp_name_container_for_bocw').show();
                $('#seal_and_stamp_download').attr('src', baseUrl + 'documents/bocw/' + formData.sign_of_principal_employee);
            }
        }
        generateSelect2();
        datePicker();
        $('#bocw_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitBOCW($('#submit_btn_for_bocw'));
            }
        });
    },
    editOrViewBOCW: function (btnObj, bocwId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!bocwId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'bocw/get_bocw_data_by_id',
            type: 'post',
            data: $.extend({}, {'bocw_id': bocwId}, getTokenData()),
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
                    that.newBOCWForm(isEdit, parseData);
                } else {
                    that.viewBOCWForm(parseData);
                }
            }
        });
    },
    viewBOCWForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.bocw_data;
        BOCW.router.navigate('view_bocw_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.estimated_date_of_commencement = dateTo_DD_MM_YYYY(formData.estimated_date_of_commencement);
        formData.estimated_date_of_completion = dateTo_DD_MM_YYYY(formData.estimated_date_of_completion);
        $('#bocw_form_and_datatable_container').html(bocwViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#declarationone').attr('checked', 'checked');
        $('#declarationtwo').attr('checked', 'checked');

        var bocwId = formData.bocw_id;

        if (formData.form_one != '') {
            $('#form_one_container_for_bocw').hide();
            $('#form_one_name_image_for_bocw').attr('src', baseUrl + 'documents/bocw/' + formData.form_one);
            $('#form_one_name_container_for_bocw').show();
            $('#form_one_name_download').attr("href", baseUrl + 'documents/bocw/' + formData.form_one);
        }
        if (formData.workorder_copy != '') {
            $('#workorder_copy_container_for_bocw').hide();
            $('#workorder_copy_name_image_for_bocw').attr('src', baseUrl + 'documents/bocw/' + formData.workorder_copy);
            $('#workorder_copy_name_container_for_bocw').show();
            $('#workorder_copy_name_download').attr("href", baseUrl + 'documents/bocw/' + formData.workorder_copy);
        }
        if (formData.copy_of_challan != '') {
            $('#copy_of_challan_container_for_bocw').hide();
            $('#copy_of_challan_name_image_for_bocw').attr('src', baseUrl + 'documents/bocw/' + formData.copy_of_challan);
            $('#copy_of_challan_name_container_for_bocw').show();
            $('#copy_of_challan_name_download').attr("href", baseUrl + 'documents/bocw/' + formData.copy_of_challan);
        }
        if (formData.sign_of_principal_employee != '') {
            $('#seal_and_stamp_container_for_bocw').hide();
            $('#seal_and_stamp_name_image_for_bocw').attr('src', baseUrl + 'documents/bocw/' + formData.sign_of_principal_employee);
            $('#seal_and_stamp_name_container_for_bocw').show();
        }
    },
    checkValidationForBOCW: function (bocwData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!bocwData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!bocwData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!bocwData.name_location_of_est) {
            return getBasicMessageAndFieldJSONArray('name_location_of_est', nameLocationValidationMessage);
        }
        if (!bocwData.postal_address_of_est) {
            return getBasicMessageAndFieldJSONArray('postal_address_of_est', postalAddressValidationMessage);
        }
        if (!bocwData.name_address_of_manager) {
            return getBasicMessageAndFieldJSONArray('name_address_of_manager', managerNameAddressValidationMessage);
        }
        if (!bocwData.nature_of_building) {
            return getBasicMessageAndFieldJSONArray('nature_of_building', buildingNatureValidationMessage);
        }
        if (!bocwData.max_num_building_workers || bocwData.max_num_building_workers <= 0) {
            return getBasicMessageAndFieldJSONArray('max_num_building_workers', maxnumberValidationMessage);
        }
        if (!bocwData.estimated_date_of_commencement) {
            return getBasicMessageAndFieldJSONArray('estimated_date_of_commencement', commencementDateValidationMessage);
        }
        if (!bocwData.estimated_date_of_completion) {
            return getBasicMessageAndFieldJSONArray('estimated_date_of_completion', completionDateValidationMessage);
        }
        if (!bocwData.declarationone) {
            return getBasicMessageAndFieldJSONArray('declarationone', declarationOneValidationMessage);
        }
        if (!bocwData.declarationtwo) {
            return getBasicMessageAndFieldJSONArray('declarationtwo', declarationTwoValidationMessage);
        }

        return '';
    },
    askForSubmitBOCW: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BOCW.listview.submitBOCW(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitBOCW: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var bocwData = $('#bocw_form').serializeFormJSON();
        var validationData = that.checkValidationForBOCW(bocwData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('bocw-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#workorder_copy_container_for_bocw').is(':visible')) {
            var workorderCopy = $('#workorder_copy_for_bocw').val();
            if (workorderCopy == '') {
                $('#workorder_copy_for_bocw').focus();
                validationMessageShow('bocw-workorder_copy_for_bocw', uploadDocumentValidationMessage);
                return false;
            }
            var workorderCopyMessage = pdffileUploadValidation('workorder_copy_for_bocw');
            if (workorderCopyMessage != '') {
                $('#workorder_copy_for_bocw').focus();
                validationMessageShow('bocw-workorder_copy_for_bocw', workorderCopyMessage);
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_bocw').is(':visible')) {
            var sealAndStamp = $('#seal_and_stamp_for_bocw').val();
            if (sealAndStamp == '') {
                $('#seal_and_stamp_for_bocw').focus();
                validationMessageShow('bocw-seal_and_stamp_for_bocw', uploadDocumentValidationMessage);
                return false;
            }
            var sealAndStampMessage = imagefileUploadValidation('seal_and_stamp_for_bocw');
            if (sealAndStampMessage != '') {
                $('#seal_and_stamp_for_bocw').focus();
                validationMessageShow('bocw-seal_and_stamp_for_bocw', sealAndStampMessage);
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_bocw') : $('#submit_btn_for_bocw');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var bocwData = new FormData($('#bocw_form')[0]);
        bocwData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        bocwData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'bocw/submit_bocw',
            data: bocwData,
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
                validationMessageShow('bocw', textStatus.statusText);
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
                    validationMessageShow('bocw', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                BOCW.router.navigate('bocw', {'trigger': true});
            }
        });
    },

    askForRemove: function (bocwId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!bocwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BOCW.listview.removeDocument(\'' + bocwId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (bocwId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!bocwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_bocw_' + docType).hide();
        $('.spinner_name_container_for_bocw_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'bocw/remove_document',
            data: $.extend({}, {'bocw_id': bocwId, 'document_id': docType}, getTokenData()),
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
                $('.spinner_container_for_bocw_' + docType).hide();
                $('.spinner_name_container_for_bocw_' + docType).show();
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
                $('.spinner_container_for_bocw_' + docType).show();
                $('.spinner_name_container_for_bocw_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('workorder_copy_name_container_for_bocw', 'workorder_copy_name_image_for_bocw', 'workorder_copy_container_for_bocw', 'workorder_copy_for_bocw');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('seal_and_stamp_name_container_for_bocw', 'seal_and_stamp_name_image_for_bocw', 'seal_and_stamp_container_for_bocw', 'seal_and_stamp_for_bocw');
                }
//                $('#' + docType + '_name_container_for_bocw').hide();
//                $('#' + docType + '_name_image_for_bocw').attr('src', '');
//                $('#' + docType + '_container_for_bocw').show();
//                $('#' + docType + '_for_bocw').val('');
            }
        });
    },
    generateForm1: function (bocwId) {
        if (!bocwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#bocw_id_for_bocw_form1').val(bocwId);
        $('#bocw_form1_pdf_form').submit();
        $('#bocw_id_for_bocw_form1').val('');
    },

    downloadUploadChallan: function (bocwId) {
        if (!bocwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + bocwId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'bocw/get_bocw_data_by_bocw_id',
            type: 'post',
            data: $.extend({}, {'bocw_id': bocwId}, getTokenData()),
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
                var bocwData = parseData.bocw_data;
                that.showChallan(bocwData);
            }
        });
    },
    showChallan: function (bocwData) {
        showPopup();
        if (bocwData.status != VALUE_FIVE && bocwData.status != VALUE_SIX && bocwData.status != VALUE_SEVEN) {
            if (!bocwData.hide_submit_btn) {
                bocwData.show_fees_paid = true;
            }
        }
        if (bocwData.payment_type == VALUE_ONE) {
            bocwData.utitle = 'Fees Paid Challan Copy';
        } else {
            bocwData.style = 'display: none;';
        }
        if (bocwData.payment_type == VALUE_TWO) {
            bocwData.show_dd_po_option = true;
            bocwData.utitle = 'Demand Draft (DD)';
        }
        bocwData.module_type = VALUE_THIRTYTWO;
        $('#popup_container').html(bocwUploadChallanTemplate(bocwData));
        loadFB(VALUE_THIRTYTWO, bocwData.fb_data);
        loadPH(VALUE_THIRTYTWO, bocwData.bocw_id, bocwData.ph_data);

        if (bocwData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'bocw_upload_challan', bocwData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'bocw_upload_challan', 'uc', 'radio');
            if (bocwData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_bocw_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (bocwData.challan != '') {
            $('#challan_container_for_bocw_upload_challan').hide();
            $('#challan_name_container_for_bocw_upload_challan').show();
            $('#challan_name_href_for_bocw_upload_challan').attr('href', 'documents/bocw/' + bocwData.challan);
            $('#challan_name_for_bocw_upload_challan').html(bocwData.challan);
        }
        if (bocwData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_bocw_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_bocw_upload_challan').show();
            $('#fees_paid_challan_name_href_for_bocw_upload_challan').attr('href', 'documents/bocw/' + bocwData.fees_paid_challan);
            $('#fees_paid_challan_name_for_bocw_upload_challan').html(bocwData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_bocw_upload_challan').attr('onclick', 'BOCW.listview.removeFeesPaidChallan("' + bocwData.bocw_id + '")');
        }
    },
    removeFeesPaidChallan: function (bocwId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!bocwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'bocw/remove_fees_paid_challan',
            data: $.extend({}, {'bocw_id': bocwId}, getTokenData()),
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
                validationMessageShow('bocw-uc', textStatus.statusText);
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
                    validationMessageShow('bocw-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-bocw-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'bocw_upload_challan');
                $('#status_' + bocwId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-bocw-uc').html('');
        validationMessageHide();
        var bocwId = $('#bocw_id_for_bocw_upload_challan').val();
        if (!bocwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_bocw_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_bocw_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_bocw_upload_challan').focus();
                validationMessageShow('bocw-uc-fees_paid_challan_for_bocw_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_bocw_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_bocw_upload_challan').focus();
                validationMessageShow('bocw-uc-fees_paid_challan_for_bocw_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_bocw_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#bocw_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'bocw/upload_fees_paid_challan',
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
                validationMessageShow('bocw-uc', textStatus.statusText);
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
                    validationMessageShow('bocw-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + bocwId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (bocwId) {
        if (!bocwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#bocw_id_for_certificate').val(bocwId);
        $('#bocw_certificate_pdf_form').submit();
        $('#bocw_id_for_certificate').val('');
    },
    getQueryData: function (bocwId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!bocwId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THIRTYTWO;
        templateData.module_id = bocwId;
        var btnObj = $('#query_btn_for_app_' + bocwId);
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
                tmpData.application_number = regNoRenderer(VALUE_THIRTYTWO, moduleData.bocw_id);
                tmpData.applicant_name = moduleData.name_location_of_est;
                tmpData.title = 'Establishment Name & Location';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForBOCW: function (fileNo) {
        var that = this;

        if ($('#workorder_copy_for_bocw').val() != '') {
            var workorderCopy = checkValidationForDocument('workorder_copy_for_bocw', VALUE_ONE, 'bocw');
            if (workorderCopy == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_for_bocw').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_bocw', VALUE_TWO, 'bocw');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_bocw_' + fileNo).hide();
        $('.spinner_name_container_for_bocw_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var bocwId = $('#bocw_id').val();
        var formData = new FormData($('#bocw_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("bocw_id", bocwId);
        $.ajax({
            type: 'POST',
            url: 'bocw/upload_bocw_document',
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
                $('.spinner_container_for_bocw_' + fileNo).show();
                $('.spinner_name_container_for_bocw_' + fileNo).hide();
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
                    $('.spinner_container_for_bocw_' + fileNo).show();
                    $('.spinner_name_container_for_bocw_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_bocw_' + fileNo).hide();
                $('.spinner_name_container_for_bocw_' + fileNo).show();
                $('#bocw_id').val(parseData.bocw_id);
                var bocwData = parseData.bocw_data;

                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('workorder_copy_container_for_bocw', 'workorder_copy_name_image_for_bocw', 'workorder_copy_name_container_for_bocw',
                            'workorder_copy_name_download', 'workorder_copy_remove_btn', bocwData.workorder_copy, parseData.bocw_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('seal_and_stamp_container_for_bocw', 'seal_and_stamp_name_image_for_bocw', 'seal_and_stamp_name_container_for_bocw',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', bocwData.sign_of_principal_employee, parseData.bocw_id, VALUE_TWO);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/bocw/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/bocw/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'BOCW.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
