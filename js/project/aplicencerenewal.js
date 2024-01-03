var aplicenceRenewalListTemplate = Handlebars.compile($('#aplicence_renewal_list_template').html());
var aplicenceRenewalTableTemplate = Handlebars.compile($('#aplicence_renewal_table_template').html());
var aplicenceRenewalActionTemplate = Handlebars.compile($('#aplicence_renewal_action_template').html());
var aplicenceRenewalFormTemplate = Handlebars.compile($('#aplicence_renewal_form_template').html());
var aplicenceRenewalViewTemplate = Handlebars.compile($('#aplicence_renewal_view_template').html());
var aplicenceRenewalUploadChallanTemplate = Handlebars.compile($('#aplicence_renewal_upload_challan_template').html());
var tempPersonCnt = 1;
var AplicenceRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
AplicenceRenewal.Router = Backbone.Router.extend({
    routes: {
        'aplicence_renewal': 'renderList',
        'aplicence_renewal_form': 'renderListForForm',
        'edit_aplicence_renewal_form': 'renderList',
        'view_aplicence_renewal_form': 'renderList',
    },
    renderList: function () {
        AplicenceRenewal.listview.listPage();
    },
    renderListForForm: function () {
        AplicenceRenewal.listview.listPageAplicenceRenewalForm();
    }
});
AplicenceRenewal.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="if_contractor_work_other_place"]': 'hasOtherWorkEvent',
    },
    hasOtherWorkEvent: function (event) {
        var val = $('input[name=if_contractor_work_other_place]:checked').val();
        if (val === '1') {
            this.$('.if_contractor_work_other_place_div').show();
        } else {
            this.$('.if_contractor_work_other_place_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('aplicence', 'active');
        AplicenceRenewal.router.navigate('aplicence_renewal');
        var templateData = {};
        this.$el.html(aplicenceRenewalListTemplate(templateData));
        this.loadAplicenceRenewalData(sDistrict, sStatus);

    },
    listPageAplicenceRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('aplicence', 'active');
        this.$el.html(aplicenceRenewalListTemplate);
        this.newAplicenceRenewalForm(false, {});
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
                rowData.ADMIN_APLICENCE_DOC_PATH = ADMIN_APLICENCE_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return aplicenceRenewalActionTemplate(rowData);
    },
    loadAplicenceRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTYSIX, data);
        };
        var that = this;
        AplicenceRenewal.router.navigate('aplicence_renewal');
        $('#aplicence_renewal_form_and_datatable_container').html(aplicenceRenewalTableTemplate(searchData));
        aplicenceRenewalDataTable = $('#aplicence_renewal_datatable').DataTable({
            ajax: {url: 'aplicence_renewal/get_aplicence_renewal_data', dataSrc: "aplicence_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'aplicence_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'contractor_name', 'class': 'text-center'},
                {data: 'contractor_contact', 'class': 'text-center'},
                {data: 'contractor_email', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'aplicence_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'aplicence_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#aplicence_renewal_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = aplicenceRenewalDataTable.row(tr);

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
    newAplicenceRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.aplicence_renewal_data;
            AplicenceRenewal.router.navigate('edit_aplicence_renewal_form');
        } else {
            var formData = {};
            AplicenceRenewal.router.navigate('aplicence_renewal_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.aplicence_renewal_data = parseData.aplicence_renewal_data;
        if (isEdit) {
            templateData.date_of_certificate = dateTo_DD_MM_YYYY(templateData.aplicence_renewal_data.date_of_certificate);
            templateData.expiry_date_of_prev_licence = dateTo_DD_MM_YYYY(templateData.aplicence_renewal_data.expiry_date_of_prev_licence);
        }
        $('#aplicence_renewal_form_and_datatable_container').html(aplicenceRenewalFormTemplate((templateData)));
        allowOnlyIntegerValue('contractor_contact');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#declarationone').attr('checked', 'checked');

            if (formData.formvii_doc != '') {
                $('#formvii_doc_container_for_aplicence_renewal').hide();
                $('#formvii_doc_name_image_for_aplicence_renewal').attr('src', baseUrl + 'documents/aplicence/' + formData.formvii_doc);
                $('#formvii_doc_name_container_for_aplicence_renewal').show();
                $('#formvii_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.formvii_doc);
            }
            if (formData.register_certification_doc != '') {
                $('#register_certification_doc_container_for_aplicence_renewal').hide();
                $('#register_certification_doc_name_image_for_aplicence_renewal').attr('src', baseUrl + 'documents/aplicence/' + formData.register_certification_doc);
                $('#register_certification_doc_name_container_for_aplicence_renewal').show();
                $('#register_certification_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.register_certification_doc);
            }
            if (formData.signature != '') {
                $('#seal_and_stamp_container_for_aplicence_renewal').hide();
                $('#seal_and_stamp_name_image_for_aplicence_renewal').attr('src', baseUrl + 'documents/aplicence/' + formData.signature);
                $('#seal_and_stamp_name_container_for_aplicence_renewal').show();
                $('#seal_and_stamp_download').attr("href", baseUrl + 'documents/aplicence/' + formData.signature);
            }
        }
        generateSelect2();
        datePicker();
        $('#aplicence_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitAplicenceRenewal($('#submit_btn_for_aplicence'));
            }
        });
    },
    editOrViewAplicenceRenewal: function (btnObj, aplicenceRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!aplicenceRenewalId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'aplicence_renewal/get_aplicence_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'aplicence_renewal_id': aplicenceRenewalId}, getTokenData()),
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
                    that.newAplicenceRenewalForm(isEdit, parseData);
                } else {
                    that.viewAplicenceRenewalForm(parseData);
                }
            }
        });
    },
    viewAplicenceRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.aplicence_renewal_data;
        AplicenceRenewal.router.navigate('view_aplicence_renewal_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.date_of_certificate = dateTo_DD_MM_YYYY(formData.date_of_certificate);
        formData.expiry_date_of_prev_licence = dateTo_DD_MM_YYYY(formData.expiry_date_of_prev_licence);
        $('#aplicence_renewal_form_and_datatable_container').html(aplicenceRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#declarationone').attr('checked', 'checked');

        if (formData.formvii_doc != '') {
            $('#formvii_doc_container_for_aplicence_renewal').hide();
            $('#formvii_doc_name_image_for_aplicence_renewal').attr('src', baseUrl + 'documents/aplicence/' + formData.formvii_doc);
            $('#formvii_doc_name_container_for_aplicence_renewal').show();
            $('#formvii_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.formvii_doc);
        }
        if (formData.register_certification_doc != '') {
            $('#register_certification_doc_container_for_aplicence_renewal').hide();
            $('#register_certification_doc_name_image_for_aplicence_renewal').attr('src', baseUrl + 'documents/aplicence/' + formData.register_certification_doc);
            $('#register_certification_doc_name_container_for_aplicence_renewal').show();
            $('#register_certification_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.register_certification_doc);
        }
        if (formData.signature != '') {
            $('#seal_and_stamp_container_for_aplicence_renewal').hide();
            $('#seal_and_stamp_name_image_for_aplicence_renewal').attr('src', baseUrl + 'documents/aplicence/' + formData.signature);
            $('#seal_and_stamp_name_container_for_aplicence_renewal').show();
            $('#seal_and_stamp_download').attr("href", baseUrl + 'documents/aplicence/' + formData.signature);
        }
    },
    checkValidationForAplicenceRenewal: function (aplicenceRenewalData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!aplicenceRenewalData.registration_number) {
            return getBasicMessageAndFieldJSONArray('registration_number', licenseNumberValidationMessage);
        }
        if (!aplicenceRenewalData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!aplicenceRenewalData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!aplicenceRenewalData.contractor_name) {
            return getBasicMessageAndFieldJSONArray('contractor_name', contractorNameValidationMessage);
        }
        if (!aplicenceRenewalData.contractor_address) {
            return getBasicMessageAndFieldJSONArray('contractor_address', contractorAddressValidationMessage);
        }
        if (!aplicenceRenewalData.contractor_contact) {
            return getBasicMessageAndFieldJSONArray('contractor_contact', contractorCcontactValidationMessage);
        }
        if (!aplicenceRenewalData.contractor_email) {
            return getBasicMessageAndFieldJSONArray('contractor_email', emailValidationMessage);
        }
        if (!aplicenceRenewalData.no_of_certificate) {
            return getBasicMessageAndFieldJSONArray('no_of_certificate', certificateNoValidationMessage);
        }
        if (!aplicenceRenewalData.date_of_certificate) {
            return getBasicMessageAndFieldJSONArray('date_of_certificate', certificateDateValidationMessage);
        }
        if (!aplicenceRenewalData.expiry_date_of_prev_licence) {
            return getBasicMessageAndFieldJSONArray('expiry_date_of_prev_licence', expiryDateValidationMessage);
        }
        if (!aplicenceRenewalData.max_no_of_empl) {
            return getBasicMessageAndFieldJSONArray('max_no_of_empl', maxNoEmpValidationMessage);
        }
        if (!aplicenceRenewalData.licence_status) {
            return getBasicMessageAndFieldJSONArray('licence_status', licenceStatusValidationMessage);
        }
        if (!aplicenceRenewalData.duration_of_work) {
            return getBasicMessageAndFieldJSONArray('duration_of_work', durationOfWorkValidationMessage);
        }
        if (!aplicenceRenewalData.establi_name) {
            return getBasicMessageAndFieldJSONArray('establi_name', establishmentNameValidationMessage);
        }
        if (!aplicenceRenewalData.establi_address) {
            return getBasicMessageAndFieldJSONArray('establi_address', establishmentAddressValidationMessage);
        }

        return '';
    },
    askForSubmitAplicenceRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'AplicenceRenewal.listview.submitAplicenceRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitAplicenceRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var aplicenceRenewalData = $('#aplicence_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForAplicenceRenewal(aplicenceRenewalData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('aplicence-renewal-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#register_certification_doc_container_for_aplicence_renewal').is(':visible')) {
            var formv = $('#register_certification_doc_for_aplicence_renewal').val();
            if (formv == '') {
                $('#register_certification_doc_for_aplicence_renewal').focus();
                validationMessageShow('aplicence-renewal-register_certification_doc_for_aplicence_renewal', uploadDocumentValidationMessage);
                return false;
            }
            var formvMessage = pdffileUploadValidation('register_certification_doc_for_aplicence_renewal');
            if (formvMessage != '') {
                $('#register_certification_doc_for_aplicence_renewal').focus();
                validationMessageShow('aplicence-renewal-register_certification_doc_for_aplicence_renewal', formvMessage);
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_aplicence_renewal').is(':visible')) {
            var sealAndStamp = $('#seal_and_stamp_for_aplicence_renewal').val();
            if (sealAndStamp == '') {
                $('#seal_and_stamp_for_aplicence_renewal').focus();
                validationMessageShow('aplicence-renewal-seal_and_stamp_for_aplicence_renewal', uploadDocumentValidationMessage);
                return false;
            }
            var sealAndStampMessage = imagefileUploadValidation('seal_and_stamp_for_aplicence_renewal');
            if (sealAndStampMessage != '') {
                $('#seal_and_stamp_for_aplicence_renewal').focus();
                validationMessageShow('aplicence-renewal-seal_and_stamp_for_aplicence_renewal', sealAndStampMessage);
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_aplicence') : $('#submit_btn_for_aplicence');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var aplicenceRenewalData = new FormData($('#aplicence_renewal_form')[0]);
        aplicenceRenewalData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        // aplicenceRenewalData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        aplicenceRenewalData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'aplicence_renewal/submit_aplicence_renewal',
            data: aplicenceRenewalData,
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
                validationMessageShow('aplicence-renewal', textStatus.statusText);
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
                    validationMessageShow('aplicence-renewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                AplicenceRenewal.router.navigate('aplicence_renewal', {'trigger': true});
            }
        });
    },

    askForRemove: function (aplicenceRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!aplicenceRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'AplicenceRenewal.listview.removeDocument(\'' + aplicenceRenewalId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (aplicenceRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!aplicenceRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_aplicence_renewal_' + docType).hide();
        $('.spinner_name_container_for_aplicence_renewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'aplicence_renewal/remove_document',
            data: $.extend({}, {'aplicence_renewal_id': aplicenceRenewalId, 'document_id': docType}, getTokenData()),
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
                $('.spinner_container_for_aplicence_renewal_' + docType).hide();
                $('.spinner_name_container_for_aplicence_renewal_' + docType).show();
                validationMessageShow('aplicence', textStatus.statusText);
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
                    validationMessageShow('aplicence_renewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_aplicence_renewal_' + docType).show();
                $('.spinner_name_container_for_aplicence_renewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_THREE) {
                    removeDocumentValue('register_certification_doc_name_container_for_aplicence_renewal', 'register_certification_doc_name_image_for_aplicence_renewal', 'register_certification_doc_container_for_aplicence_renewal', 'register_certification_doc_for_aplicence_renewal');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('seal_and_stamp_name_container_for_aplicence_renewal', 'seal_and_stamp_name_image_for_aplicence_renewal', 'seal_and_stamp_container_for_aplicence_renewal', 'seal_and_stamp_for_aplicence_renewal');
                }
//                $('#' + docId + '_name_container_for_aplicence_renewal').hide();
//                $('#' + docId + '_name_image_for_aplicence_renewal').attr('src', '');
//                $('#' + docId + '_container_for_aplicence_renewal').show();   
//                $('#' + docId + '_for_aplicence_renewal').val('');
            }
        });
    },
    generateForm1: function (aplicenceRenewalId) {
        if (!aplicenceRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#aplicence_renewal_id_for_aplicence_renewal_form1').val(aplicenceRenewalId);
        $('#aplicence_renewal_form1_pdf_form').submit();
        $('#aplicence_renewal_id_for_aplicence_renewal_form1').val('');
    },

    downloadUploadChallan: function (aplicenceRenewalId) {
        if (!aplicenceRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + aplicenceRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'aplicence_renewal/get_aplicence_renewal_data_by_aplicence_renewal_id',
            type: 'post',
            data: $.extend({}, {'aplicence_renewal_id': aplicenceRenewalId}, getTokenData()),
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
                var aplicenceRenewalData = parseData.aplicence_renewal_data;
                that.showChallan(aplicenceRenewalData);
            }
        });
    },
    showChallan: function (aplicenceRenewalData) {
        showPopup();
        if (aplicenceRenewalData.status != VALUE_FIVE && aplicenceRenewalData.status != VALUE_SIX && aplicenceRenewalData.status != VALUE_SEVEN) {
            if (!aplicenceRenewalData.hide_submit_btn) {
                aplicenceRenewalData.show_fees_paid = true;
            }
        }
        if (aplicenceRenewalData.payment_type == VALUE_ONE) {
            aplicenceRenewalData.utitle = 'Fees Paid Challan Copy';
        } else {
            aplicenceRenewalData.style = 'display: none;';
        }
        if (aplicenceRenewalData.payment_type == VALUE_TWO) {
            aplicenceRenewalData.show_dd_po_option = true;
            aplicenceRenewalData.utitle = 'Demand Draft (DD)';
        }
        aplicenceRenewalData.module_type = VALUE_FOURTYSIX;
        $('#popup_container').html(aplicenceRenewalUploadChallanTemplate(aplicenceRenewalData));
        loadFB(VALUE_FOURTYSIX, aplicenceRenewalData.fb_data);
        loadPH(VALUE_FOURTYSIX, aplicenceRenewalData.aplicence_renewal_id, aplicenceRenewalData.ph_data);

        if (aplicenceRenewalData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'aplicence_renewal_upload_challan', aplicenceRenewalData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'aplicence_renewal_upload_challan', 'uc', 'radio');
            if (aplicenceRenewalData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_aplicence_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (aplicenceRenewalData.challan != '') {
            $('#challan_container_for_aplicence_renewal_upload_challan').hide();
            $('#challan_name_container_for_aplicence_renewal_upload_challan').show();
            $('#challan_name_href_for_aplicence_renewal_upload_challan').attr('href', 'documents/aplicence/' + aplicenceRenewalData.challan);
            $('#challan_name_for_aplicence_renewal_upload_challan').html(aplicenceRenewalData.challan);
        }
        if (aplicenceRenewalData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_aplicence_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_aplicence_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_aplicence_renewal_upload_challan').attr('href', 'documents/aplicence/' + aplicenceRenewalData.fees_paid_challan);
            $('#fees_paid_challan_name_for_aplicence_renewal_upload_challan').html(aplicenceRenewalData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_aplicence_renewal_upload_challan').attr('onclick', 'AplicenceRenewal.listview.removeFeesPaidChallan("' + aplicenceRenewalData.aplicence_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (aplicenceRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!aplicenceRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'aplicence_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'aplicence_renewal_id': aplicenceRenewalId}, getTokenData()),
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
                validationMessageShow('aplicence-renewal-uc', textStatus.statusText);
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
                    validationMessageShow('aplicence-renewal-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-aplicence-renewal-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'aplicence_renewal_upload_challan');
                $('#status_' + aplicenceRenewalId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-aplicence-renewal-uc').html('');
        validationMessageHide();
        var aplicenceRenewalId = $('#aplicence_renewal_id_for_aplicence_renewal_upload_challan').val();
        if (!aplicenceRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_aplicence_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_aplicence_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_aplicence_renewal_upload_challan').focus();
                validationMessageShow('aplicence-renewal-uc-fees_paid_challan_for_aplicence_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_aplicence_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_aplicence_renewal_upload_challan').focus();
                validationMessageShow('aplicence-renewal-uc-fees_paid_challan_for_aplicence_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_aplicence_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#aplicence_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'aplicence_renewal/upload_fees_paid_challan',
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
                validationMessageShow('aplicence-renewal-uc', textStatus.statusText);
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
                    validationMessageShow('aplicence-renewal-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + aplicenceRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (aplicenceRenewalId) {
        if (!aplicenceRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#aplicence_renewal_id_for_certificate').val(aplicenceRenewalId);
        $('#aplicence_renewal_certificate_pdf_form').submit();
        $('#aplicence_renewal_id_for_certificate').val('');
    },
    getQueryData: function (aplicenceRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!aplicenceRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTYSIX;
        templateData.module_id = aplicenceRenewalId;
        var btnObj = $('#query_btn_for_lice_' + aplicenceRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOURTYSIX, moduleData.aplicence_renewal_id);
                tmpData.applicant_name = moduleData.contractor_name;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getAplicenceData: function (btnObj) {
        var license_number = $('#registration_number').val();
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!license_number || license_number == null) {
            showError('Enter License Number !');
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'aplicence_renewal/get_aplicence_data_by_id',
            type: 'post',
            data: $.extend({}, {'license_number': license_number}, getTokenData()),
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
                AplicenceData = parseData.aplicence_data;
                if (AplicenceData == null) {
                    $('#aplicence_id').val('');
                    $('#district').val('');
                    $('#contractor_name').val('');
                    $('#contractor_address').val('');
                    $('#contractor_contact').val('');
                    $('#contractor_email').val('');
                    $('#no_of_certificate').val('');
                    $('#date_of_certificate').val('');
                    $('#duration_of_work').val('');
                    $('#establi_name').val('');
                    $('#establi_address').val('');
                    $('#max_no_of_empl').val('');
                    $('html, body').animate({scrollTop: '0px'}, 0);
                }
                if (AplicenceData.aplicence_renewal_id != null) {
                    $('#aplicence_id').val(AplicenceData.aplicence_id);
                    $('#district').val(AplicenceData.district);
                    $('#contractor_name').val(AplicenceData.contractor_name);
                    $('#contractor_address').val(AplicenceData.contractor_address);
                    $('#contractor_contact').val(AplicenceData.contractor_contact);
                    $('#contractor_email').val(AplicenceData.contractor_email);
                    $('#no_of_certificate').val(AplicenceData.no_of_certificate);
                    var date_of_certificate = dateTo_DD_MM_YYYY(AplicenceData.date_of_certificate);
                    $('#date_of_certificate').val(date_of_certificate);
                    $('#establi_name').val(AplicenceData.establi_name);
                    $('#establi_address').val(AplicenceData.establi_address);
                    renderOptionsForTwoDimensionalArray(talukaArray, 'district');
                    $('#district').val(AplicenceData.district);
                    $('#max_no_of_empl').val(AplicenceData.max_no_of_empl);
                } else {
                    $('#aplicence_id').val(AplicenceData.aplicence_id);
                    $('#district').val(AplicenceData.district);
                    $('#contractor_name').val(AplicenceData.contractor_name);
                    $('#contractor_address').val(AplicenceData.contractor_address);
                    $('#contractor_contact').val(AplicenceData.contractor_contact);
                    $('#contractor_email').val(AplicenceData.contractor_email);
                    $('#no_of_certificate').val(AplicenceData.no_of_certificate);
                    var date_of_certificate = dateTo_DD_MM_YYYY(AplicenceData.date_of_certificate);
                    $('#date_of_certificate').val(date_of_certificate);
                    $('#establi_name').val(AplicenceData.establi_name);
                    $('#establi_address').val(AplicenceData.establi_address);
                    renderOptionsForTwoDimensionalArray(talukaArray, 'district');
                    $('#district').val(AplicenceData.district);
                    $('#max_no_of_empl').val(AplicenceData.max_no_of_empl);
                }
            }
        });
    },
    uploadDocumentForAplicenceRenewal: function (fileNo) {
        var that = this;

        if ($('#register_certification_doc_for_aplicence_renewal').val() != '') {
            var registerCertificationDoc = checkValidationForDocument('register_certification_doc_for_aplicence_renewal', VALUE_ONE, 'aplicence_renewal');
            if (registerCertificationDoc == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_aplicence_renewal').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_aplicence_renewal', VALUE_TWO, 'aplicence_renewal');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_aplicence_renewal_' + fileNo).hide();
        $('.spinner_name_container_for_aplicence_renewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var aplicence_renewalId = $('#aplicence_renewal_id').val();
        var formData = new FormData($('#aplicence_renewal_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("aplicence_renewal_id", aplicence_renewalId);
        $.ajax({
            type: 'POST',
            url: 'aplicence_renewal/upload_aplicence_renewal_document',
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
                $('.spinner_container_for_aplicence_renewal_' + fileNo).show();
                $('.spinner_name_container_for_aplicence_renewal_' + fileNo).hide();
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
                    $('.spinner_container_for_aplicence_renewal_' + fileNo).show();
                    $('.spinner_name_container_for_aplicence_renewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_aplicence_renewal_' + fileNo).hide();
                $('.spinner_name_container_for_aplicence_renewal_' + fileNo).show();
                $('#aplicence_renewal_id').val(parseData.aplicence_renewal_id);
                var aplicence_renewalData = parseData.aplicence_renewal_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('formvii_doc_container_for_aplicence_renewal', 'formvii_doc_name_image_for_aplicence_renewal', 'formvii_doc_name_container_for_aplicence_renewal',
                            'formvii_doc_name_download', 'formvii_doc_remove_btn', aplicence_renewalData.formvii_doc, parseData.aplicence_renewal_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('register_certification_doc_container_for_aplicence_renewal', 'register_certification_doc_name_image_for_aplicence_renewal', 'register_certification_doc_name_container_for_aplicence_renewal',
                            'register_certification_doc_name_download', 'register_certification_doc_remove_btn', aplicence_renewalData.register_certification_doc, parseData.aplicence_renewal_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('seal_and_stamp_container_for_aplicence_renewal', 'seal_and_stamp_name_image_for_aplicence_renewal', 'seal_and_stamp_name_container_for_aplicence_renewal',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', aplicence_renewalData.signature, parseData.aplicence_renewal_id, VALUE_FOUR);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/aplicence/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/aplicence/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'AplicenceRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
