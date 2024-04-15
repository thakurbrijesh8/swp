var aplicenceListTemplate = Handlebars.compile($('#aplicence_list_template').html());
var aplicenceTableTemplate = Handlebars.compile($('#aplicence_table_template').html());
var aplicenceActionTemplate = Handlebars.compile($('#aplicence_action_template').html());
var aplicenceFormTemplate = Handlebars.compile($('#aplicence_form_template').html());
var aplicenceViewTemplate = Handlebars.compile($('#aplicence_view_template').html());
var aplicenceUploadChallanTemplate = Handlebars.compile($('#aplicence_upload_challan_template').html());
var tempPersonCnt = 1;
var Aplicence = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Aplicence.Router = Backbone.Router.extend({
    routes: {
        'aplicence': 'renderList',
        'aplicence_form': 'renderListForForm',
        'edit_aplicence_form': 'renderList',
        'view_aplicence_form': 'renderList',
    },
    renderList: function () {
        Aplicence.listview.listPage();
    },
    renderListForForm: function () {
        Aplicence.listview.listPageAplicenceForm();
    }
});
Aplicence.listView = Backbone.View.extend({
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
        Aplicence.router.navigate('aplicence');
        var templateData = {};
        this.$el.html(aplicenceListTemplate(templateData));
        this.loadAplicenceData(sDistrict, sStatus);

    },
    listPageAplicenceForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('aplicence', 'active');
        this.$el.html(aplicenceListTemplate);
        this.newAplicenceForm(false, {});
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
        if (rowData.status == VALUE_FIVE || rowData.status == VALUE_SIX) {
            rowData.show_fr_btn = true;
        }
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE || rowData.status == VALUE_TWO || rowData.status == VALUE_THREE) {
            rowData.show_withdraw_application_btn = true;
        }
        return aplicenceActionTemplate(rowData);
    },
    loadAplicenceData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTYTHREE, data)
                    + getFRContainer(VALUE_FOURTYTHREE, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Aplicence.router.navigate('aplicence');
        $('#aplicence_form_and_datatable_container').html(aplicenceTableTemplate(searchData));
        aplicenceDataTable = $('#aplicence_datatable').DataTable({
            ajax: {url: 'aplicence/get_aplicence_data', dataSrc: "aplicence_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'aplicence_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'contractor_name', 'class': 'text-center'},
                {data: 'employer_name', 'class': 'text-center'},
                {data: 'establi_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'aplicence_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'aplicence_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#aplicence_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = aplicenceDataTable.row(tr);

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
    newAplicenceForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.aplicence_data;
            Aplicence.router.navigate('edit_aplicence_form');
        } else {
            var formData = {};
            Aplicence.router.navigate('aplicence_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.aplicence_data = parseData.aplicence_data;
        if (isEdit) {
            templateData.date_of_certificate = dateTo_DD_MM_YYYY(templateData.aplicence_data.date_of_certificate);
        }
        $('#aplicence_form_and_datatable_container').html(aplicenceFormTemplate((templateData)));
        allowOnlyIntegerValue('contractor_contact');
        allowOnlyIntegerValue('max_no_of_empl');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#declarationone').attr('checked', 'checked');
            if (formData.formv_doc != '') {
                $('#formv_doc_container_for_aplicence').hide();
                $('#formv_doc_name_image_for_aplicence').attr('src', baseUrl + 'documents/aplicence/' + formData.formv_doc);
                $('#formv_doc_name_container_for_aplicence').show();
                $('#formv_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.formv_doc);
            }
            if (formData.formiv_doc != '') {
                $('#formiv_doc_container_for_aplicence').hide();
                $('#formiv_doc_name_image_for_aplicence').attr('src', baseUrl + 'documents/aplicence/' + formData.formiv_doc);
                $('#formiv_doc_name_container_for_aplicence').show();
                $('#formiv_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.formiv_doc);
            }
            if (formData.register_certification_doc != '') {
                $('#register_certification_doc_container_for_aplicence').hide();
                $('#register_certification_doc_name_image_for_aplicence').attr('src', baseUrl + 'documents/aplicence/' + formData.register_certification_doc);
                $('#register_certification_doc_name_container_for_aplicence').show();
                $('#register_certification_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.register_certification_doc);
            }
            if (formData.signature != '') {
                $('#seal_and_stamp_container_for_aplicence').hide();
                $('#seal_and_stamp_name_image_for_aplicence').attr('src', baseUrl + 'documents/aplicence/' + formData.signature);
                $('#seal_and_stamp_name_container_for_aplicence').show();
                $('#seal_and_stamp_download').attr("href", baseUrl + 'documents/aplicence/' + formData.signature);
            }
            if (formData.if_contractor_work_other_place == isChecked) {
                $('#if_contractor_work_other_place').attr('checked', 'checked');
                this.$('.if_contractor_work_other_place_div').show();
            }
            //     var proprietorInfo = JSON.parse(formData.proprietor_details);
            //     $.each(proprietorInfo, function (key, value) {
            //         that.addMultipleProprietor(value);
            //     })
            // } else {
            //     that.addMultipleProprietor({});
        }
        generateSelect2();
        datePicker();
        $('#aplicence_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitAplicence($('#submit_btn_for_aplicence'));
            }
        });
    },
    editOrViewAplicence: function (btnObj, aplicenceId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!aplicenceId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'aplicence/get_aplicence_data_by_id',
            type: 'post',
            data: $.extend({}, {'aplicence_id': aplicenceId}, getTokenData()),
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
                    that.newAplicenceForm(isEdit, parseData);
                } else {
                    that.viewAplicenceForm(parseData);
                }
            }
        });
    },
    viewAplicenceForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.aplicence_data;
        Aplicence.router.navigate('view_aplicence_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.date_of_certificate = dateTo_DD_MM_YYYY(formData.date_of_certificate);
        $('#aplicence_form_and_datatable_container').html(aplicenceViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#declarationone').attr('checked', 'checked');

        if (formData.formv_doc != '') {
            $('#formv_doc_container_for_aplicence_view').hide();
            $('#formv_doc_name_image_for_aplicence_view').attr('src', baseUrl + 'documents/aplicence/' + formData.formv_doc);
            $('#formv_doc_name_container_for_aplicence_view').show();
            $('#formv_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.formv_doc);
        }
        if (formData.formiv_doc != '') {
            $('#formiv_doc_container_for_aplicence_view').hide();
            $('#formiv_doc_name_image_for_aplicence_view').attr('src', baseUrl + 'documents/aplicence/' + formData.formiv_doc);
            $('#formiv_doc_name_container_for_aplicence_view').show();
            $('#formiv_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.formiv_doc);
        }
        if (formData.register_certification_doc != '') {
            $('#register_certification_doc_container_for_aplicence_view').hide();
            $('#register_certification_doc_name_image_for_aplicence_view').attr('src', baseUrl + 'documents/aplicence/' + formData.register_certification_doc);
            $('#register_certification_doc_name_container_for_aplicence_view').show();
            $('#register_certification_doc_name_download').attr("href", baseUrl + 'documents/aplicence/' + formData.register_certification_doc);
        }
        if (formData.signature != '') {
            $('#seal_and_stamp_container_for_aplicence_view').hide();
            $('#seal_and_stamp_name_image_for_aplicence_view').attr('src', baseUrl + 'documents/aplicence/' + formData.signature);
            $('#seal_and_stamp_name_container_for_aplicence_view').show();
            $('#seal_and_stamp_download').attr("href", baseUrl + 'documents/aplicence/' + formData.signature);
        }
        if (formData.if_contractor_work_other_place == isChecked) {
            $('#if_contractor_work_other_place').attr('checked', 'checked');
            this.$('.if_contractor_work_other_place_div').show();
        }


        // var proprietorInfo = JSON.parse(formData.proprietor_details);
        // $.each(proprietorInfo, function (key, value) {
        //     that.addMultipleProprietor(value);
        // })
    },
    checkValidationForAplicence: function (aplicenceData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!aplicenceData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!aplicenceData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!aplicenceData.contractor_name) {
            return getBasicMessageAndFieldJSONArray('contractor_name', contractorNameValidationMessage);
        }
        if (!aplicenceData.contractor_fathername) {
            return getBasicMessageAndFieldJSONArray('contractor_fathername', contractorFatherNameValidationMessage);
        }
        if (!aplicenceData.contractor_address) {
            return getBasicMessageAndFieldJSONArray('contractor_address', contractorAddressValidationMessage);
        }
        if (!aplicenceData.contractor_contact) {
            return getBasicMessageAndFieldJSONArray('contractor_contact', contractorCcontactValidationMessage);
        }
        if (!aplicenceData.contractor_email) {
            return getBasicMessageAndFieldJSONArray('contractor_email', emailValidationMessage);
        }
        if (!aplicenceData.establi_name) {
            return getBasicMessageAndFieldJSONArray('establi_name', establishmentNameValidationMessage);
        }
        if (!aplicenceData.establi_address) {
            return getBasicMessageAndFieldJSONArray('establi_address', establishmentAddressValidationMessage);
        }
        if (!aplicenceData.no_of_certificate) {
            return getBasicMessageAndFieldJSONArray('no_of_certificate', certificateNoValidationMessage);
        }
        if (!aplicenceData.date_of_certificate) {
            return getBasicMessageAndFieldJSONArray('date_of_certificate', certificateDateValidationMessage);
        }
        if (!aplicenceData.employer_name) {
            return getBasicMessageAndFieldJSONArray('employer_name', employerNameValidationMessage);
        }
        if (!aplicenceData.employer_address) {
            return getBasicMessageAndFieldJSONArray('employer_address', employerAddressValidationMessage);
        }
        if (!aplicenceData.nature_of_process_for_establi) {
            return getBasicMessageAndFieldJSONArray('nature_of_process_for_establi', natureOfProcessValidationMessage);
        }
        if (!aplicenceData.nature_of_process_for_labour) {
            return getBasicMessageAndFieldJSONArray('nature_of_process_for_labour', natureOfProcesslabourValidationMessage);
        }
        if (!aplicenceData.duration_of_work) {
            return getBasicMessageAndFieldJSONArray('duration_of_work', durationOfWorkValidationMessage);
        }
        if (!aplicenceData.name_of_agent) {
            return getBasicMessageAndFieldJSONArray('name_of_agent', agentNameValidationMessage);
        }
        if (!aplicenceData.address_of_agent) {
            return getBasicMessageAndFieldJSONArray('address_of_agent', agentAddressValidationMessage);
        }
        if (!aplicenceData.max_no_of_empl) {
            return getBasicMessageAndFieldJSONArray('max_no_of_empl', maxNoEmpValidationMessage);
        }
        if (!aplicenceData.estimeted_value) {
            return getBasicMessageAndFieldJSONArray('estimeted_value', estimetedValueValidationMessage);
        }

        return '';
    },
    askForSubmitAplicence: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Aplicence.listview.submitAplicence(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitAplicence: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var aplicenceData = $('#aplicence_form').serializeFormJSON();
        var validationData = that.checkValidationForAplicence(aplicenceData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('aplicence-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#formv_doc_container_for_aplicence').is(':visible')) {
            var formv = $('#formv_doc_for_aplicence').val();
            if (formv == '') {
                $('#formv_doc_for_aplicence').focus();
                validationMessageShow('aplicence-formv_doc_for_aplicence', uploadDocumentValidationMessage);
                return false;
            }
            var formvMessage = pdffileUploadValidation('formv_doc_for_aplicence');
            if (formvMessage != '') {
                $('#formv_doc_for_aplicence').focus();
                validationMessageShow('aplicence-formv_doc_for_aplicence', formvMessage);
                return false;
            }
        }

        if ($('#formiv_doc_container_for_aplicence').is(':visible')) {
            var formiv = $('#formiv_doc_for_aplicence').val();
            if (formiv == '') {
                $('#formiv_doc_for_aplicence').focus();
                validationMessageShow('aplicence-formiv_doc_for_aplicence', uploadDocumentValidationMessage);
                return false;
            }
            var formivMessage = pdffileUploadValidation('formiv_doc_for_aplicence');
            if (formivMessage != '') {
                $('#formiv_doc_for_aplicence').focus();
                validationMessageShow('aplicence-formiv_doc_for_aplicence', formivMessage);
                return false;
            }
        }

        if ($('#register_certification_doc_container_for_aplicence').is(':visible')) {
            var formv = $('#register_certification_doc_for_aplicence').val();
            if (formv == '') {
                $('#register_certification_doc_for_aplicence').focus();
                validationMessageShow('aplicence-register_certification_doc_for_aplicence', uploadDocumentValidationMessage);
                return false;
            }
            var formvMessage = pdffileUploadValidation('register_certification_doc_for_aplicence');
            if (formvMessage != '') {
                $('#register_certification_doc_for_aplicence').focus();
                validationMessageShow('aplicence-register_certification_doc_for_aplicence', formvMessage);
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_aplicence').is(':visible')) {
            var sealAndStamp = $('#seal_and_stamp_for_aplicence').val();
            if (sealAndStamp == '') {
                $('#seal_and_stamp_for_aplicence').focus();
                validationMessageShow('aplicence-seal_and_stamp_for_aplicence', uploadDocumentValidationMessage);
                return false;
            }
            var sealAndStampMessage = imagefileUploadValidation('seal_and_stamp_for_aplicence');
            if (sealAndStampMessage != '') {
                $('#seal_and_stamp_for_aplicence').focus();
                validationMessageShow('aplicence-seal_and_stamp_for_aplicence', sealAndStampMessage);
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_aplicence') : $('#submit_btn_for_aplicence');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var aplicenceData = new FormData($('#aplicence_form')[0]);
        aplicenceData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        // aplicenceData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        aplicenceData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'aplicence/submit_aplicence',
            data: aplicenceData,
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
                validationMessageShow('aplicence', textStatus.statusText);
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
                    validationMessageShow('aplicence', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Aplicence.router.navigate('aplicence', {'trigger': true});
            }
        });
    },

    askForRemove: function (aplicenceId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!aplicenceId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Aplicence.listview.removeDocument(\'' + aplicenceId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (aplicenceId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!aplicenceId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_aplicence_' + docType).hide();
        $('.spinner_name_container_for_aplicence_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'aplicence/remove_document',
            data: $.extend({}, {'aplicence_id': aplicenceId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_aplicence_' + docType).hide();
                $('.spinner_name_container_for_aplicence_' + docType).show();
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
                    validationMessageShow('aplicence', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_aplicence_' + docType).show();
                $('.spinner_name_container_for_aplicence_' + docType).hide();
                showSuccess(parseData.message);

                if (docType == VALUE_ONE) {
                    removeDocumentValue('formv_doc_name_container_for_aplicence', 'formv_doc_name_image_for_aplicence', 'formv_doc_container_for_aplicence', 'formv_doc_for_aplicence');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('formiv_doc_name_container_for_aplicence', 'formiv_doc_name_image_for_aplicence', 'formiv_doc_container_for_aplicence', 'formiv_doc_for_aplicence');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('register_certification_doc_name_container_for_aplicence', 'register_certification_doc_name_image_for_aplicence', 'register_certification_doc_container_for_aplicence', 'register_certification_doc_for_aplicence');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('seal_and_stamp_name_container_for_aplicence', 'seal_and_stamp_name_image_for_aplicence', 'seal_and_stamp_container_for_aplicence', 'seal_and_stamp_for_aplicence');
                }

            }
        });
    },
    generateForm1: function (aplicenceId) {
        if (!aplicenceId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#aplicence_id_for_aplicence_form1').val(aplicenceId);
        $('#aplicence_form1_pdf_form').submit();
        $('#aplicence_id_for_aplicence_form1').val('');
    },

    downloadUploadChallan: function (aplicenceId) {
        if (!aplicenceId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + aplicenceId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'aplicence/get_aplicence_data_by_aplicence_id',
            type: 'post',
            data: $.extend({}, {'aplicence_id': aplicenceId}, getTokenData()),
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
                var aplicenceData = parseData.aplicence_data;
                that.showChallan(aplicenceData);
            }
        });
    },
    showChallan: function (aplicenceData) {
        showPopup();
        if (aplicenceData.status != VALUE_FIVE && aplicenceData.status != VALUE_SIX && aplicenceData.status != VALUE_SEVEN && aplicenceData.status != VALUE_ELEVEN) {
            if (!aplicenceData.hide_submit_btn) {
                aplicenceData.show_fees_paid = true;
            }
        }
        if (aplicenceData.payment_type == VALUE_ONE) {
            aplicenceData.utitle = 'Fees Paid Challan Copy';
        } else {
            aplicenceData.style = 'display: none;';
        }
        if (aplicenceData.payment_type == VALUE_TWO) {
            aplicenceData.show_dd_po_option = true;
            aplicenceData.utitle = 'Demand Draft (DD)';
        }
        aplicenceData.module_type = VALUE_FOURTYTHREE;
        $('#popup_container').html(aplicenceUploadChallanTemplate(aplicenceData));
        loadFB(VALUE_FOURTYTHREE, aplicenceData.fb_data);
        loadPH(VALUE_FOURTYTHREE, aplicenceData.aplicence_id, aplicenceData.ph_data);

        if (aplicenceData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'aplicence_upload_challan', aplicenceData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'aplicence_upload_challan', 'uc', 'radio');
            if (aplicenceData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_aplicence_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (aplicenceData.challan != '') {
            $('#challan_container_for_aplicence_upload_challan').hide();
            $('#challan_name_container_for_aplicence_upload_challan').show();
            $('#challan_name_href_for_aplicence_upload_challan').attr('href', 'documents/aplicence/' + aplicenceData.challan);
            $('#challan_name_for_aplicence_upload_challan').html(aplicenceData.challan);
        }
        if (aplicenceData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_aplicence_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_aplicence_upload_challan').show();
            $('#fees_paid_challan_name_href_for_aplicence_upload_challan').attr('href', 'documents/aplicence/' + aplicenceData.fees_paid_challan);
            $('#fees_paid_challan_name_for_aplicence_upload_challan').html(aplicenceData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_aplicence_upload_challan').attr('onclick', 'Aplicence.listview.removeFeesPaidChallan("' + aplicenceData.aplicence_id + '")');
        }
    },
    removeFeesPaidChallan: function (aplicenceId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!aplicenceId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'aplicence/remove_fees_paid_challan',
            data: $.extend({}, {'aplicence_id': aplicenceId}, getTokenData()),
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
                validationMessageShow('aplicence-uc', textStatus.statusText);
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
                    validationMessageShow('aplicence-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-aplicence-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'aplicence_upload_challan');
                $('#status_' + aplicenceId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-aplicence-uc').html('');
        validationMessageHide();
        var aplicenceId = $('#aplicence_id_for_aplicence_upload_challan').val();
        if (!aplicenceId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_aplicence_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_aplicence_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_aplicence_upload_challan').focus();
                validationMessageShow('aplicence-uc-fees_paid_challan_for_aplicence_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_aplicence_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_aplicence_upload_challan').focus();
                validationMessageShow('aplicence-uc-fees_paid_challan_for_aplicence_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_aplicence_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#aplicence_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'aplicence/upload_fees_paid_challan',
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
                validationMessageShow('aplicence-uc', textStatus.statusText);
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
                    validationMessageShow('aplicence-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + aplicenceId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (aplicenceId) {
        if (!aplicenceId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#aplicence_id_for_certificate').val(aplicenceId);
        $('#aplicence_certificate_pdf_form').submit();
        $('#aplicence_id_for_certificate').val('');
    },
    getQueryData: function (aplicenceId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!aplicenceId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTYTHREE;
        templateData.module_id = aplicenceId;
        var btnObj = $('#query_btn_for_lice_' + aplicenceId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOURTYTHREE, moduleData.aplicence_id);
                tmpData.applicant_name = moduleData.contractor_name;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForAplicence: function (fileNo) {
        var that = this;
        if ($('#formv_doc_for_aplicence').val() != '') {
            var formVDocForAplicence = checkValidationForDocument('formv_doc_for_aplicence', VALUE_ONE, 'aplicence');
            if (formVDocForAplicence == false) {
                return false;
            }
        }
        if ($('#formiv_doc_for_aplicence').val() != '') {
            var formIVDocForAplicence = checkValidationForDocument('formiv_doc_for_aplicence', VALUE_ONE, 'aplicence');
            if (formIVDocForAplicence == false) {
                return false;
            }
        }
        if ($('#register_certification_doc_for_aplicence').val() != '') {
            var registerCertificationDocForAplicence = checkValidationForDocument('register_certification_doc_for_aplicence', VALUE_ONE, 'aplicence');
            if (registerCertificationDocForAplicence == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_aplicence').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_aplicence', VALUE_TWO, 'aplicence');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_aplicence_' + fileNo).hide();
        $('.spinner_name_container_for_aplicence_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var aplicenceId = $('#aplicence_id').val();
        var formData = new FormData($('#aplicence_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("aplicence_id", aplicenceId);
        $.ajax({
            type: 'POST',
            url: 'aplicence/upload_aplicence_document',
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
                $('.spinner_container_for_aplicence_' + fileNo).show();
                $('.spinner_name_container_for_aplicence_' + fileNo).hide();
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
                    $('.spinner_container_for_aplicence_' + fileNo).show();
                    $('.spinner_name_container_for_aplicence_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_aplicence_' + fileNo).hide();
                $('.spinner_name_container_for_aplicence_' + fileNo).show();
                $('#aplicence_id').val(parseData.aplicence_id);
                var aplicenceData = parseData.aplicence_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('formv_doc_container_for_aplicence', 'formv_doc_name_image_for_aplicence', 'formv_doc_name_container_for_aplicence',
                            'formv_doc_name_download', 'formv_doc_remove_btn', aplicenceData.formv_doc, parseData.aplicence_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('formiv_doc_container_for_aplicence', 'formiv_doc_name_image_for_aplicence', 'formiv_doc_name_container_for_aplicence',
                            'formiv_doc_name_download', 'formiv_doc_remove_btn', aplicenceData.formiv_doc, parseData.aplicence_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('register_certification_doc_container_for_aplicence', 'register_certification_doc_name_image_for_aplicence', 'register_certification_doc_name_container_for_aplicence',
                            'register_certification_doc_name_download', 'register_certification_doc_remove_btn', aplicenceData.register_certification_doc, parseData.aplicence_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('seal_and_stamp_container_for_aplicence', 'seal_and_stamp_name_image_for_aplicence', 'seal_and_stamp_name_container_for_aplicence',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', aplicenceData.signature, parseData.aplicence_id, VALUE_FOUR);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/aplicence/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/aplicence/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Aplicence.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
