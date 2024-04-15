var inspectionListTemplate = Handlebars.compile($('#inspection_list_template').html());
var inspectionTableTemplate = Handlebars.compile($('#inspection_table_template').html());
var inspectionActionTemplate = Handlebars.compile($('#inspection_action_template').html());
var inspectionFormTemplate = Handlebars.compile($('#inspection_form_template').html());
var inspectionViewTemplate = Handlebars.compile($('#inspection_view_template').html());
var tempPersonCnt = 1;

var Inspection = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

Inspection.Router = Backbone.Router.extend({
    routes: {
        'inspection': 'renderList',
        'inspection_form': 'renderListForForm',
        'edit_inspection_form': 'renderList',
        'view_inspection_form': 'renderList',
    },
    renderList: function () {
        Inspection.listview.listPage();
    },
    renderListForForm: function () {
        Inspection.listview.listPageInspectionForm();
    }
});
Inspection.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        Inspection.router.navigate('inspection');
        var templateData = {};
        this.$el.html(inspectionListTemplate(templateData));
        this.loadInspectionData(sDistrict, sStatus);

    },
    listPageInspectionForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(inspectionListTemplate);
        this.newInspectionForm(false, {});
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
                rowData.ADMIN_INSPECTION_DOC_PATH = ADMIN_INSPECTION_DOC_PATH;
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
        return inspectionActionTemplate(rowData);
    },
    loadInspectionData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTYSEVEN, data)
                    + getFRContainer(VALUE_TWENTYSEVEN, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Inspection.router.navigate('inspection');
        $('#inspection_form_and_datatable_container').html(inspectionTableTemplate(searchData));
        inspectionDataTable = $('#inspection_datatable').DataTable({
            ajax: {url: 'inspection/get_inspection_data', dataSrc: "inspection_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'inspection_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'application_date', 'class': 'text-center'},
                {data: 'communication_number', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'inspection_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'inspection_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#inspection_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = inspectionDataTable.row(tr);

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
    newInspectionForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.inspection_data;
            Inspection.router.navigate('edit_inspection_form');
        } else {
            var formData = {};
            Inspection.router.navigate('inspection_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.inspection_data = parseData.inspection_data;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;

        if (isEdit) {

            templateData.application_date = dateTo_DD_MM_YYYY(templateData.inspection_data.application_date);
            templateData.valid_upto_date = dateTo_DD_MM_YYYY(formData.valid_upto_date);
        } else {
            templateData.application_date = dateTo_DD_MM_YYYY();
        }
        $('#inspection_form_and_datatable_container').html(inspectionFormTemplate((templateData)));

        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);

            if (formData.signature_architecture != '') {
                that.showDocument('signature_architecture_container_for_inspection', 'signature_architecture_name_image_for_inspection', 'signature_architecture_name_container_for_inspection',
                        'signature_architecture_download', 'signature_architecture', formData.signature_architecture, formData.inspection_id, VALUE_ONE);
            }

            if (formData.sign_seal != '') {
                that.showDocument('sign_seal_container_for_inspection', 'sign_seal_name_image_for_inspection', 'sign_seal_name_container_for_inspection',
                        'sign_seal_download', 'sign_seal', formData.sign_seal, formData.inspection_id, VALUE_TWO);
            }
            if (formData.annexure_9 != '') {
                that.showDocument('annexure_9_container_for_inspection', 'annexure_9_name_image_for_inspection', 'annexure_9_name_container_for_inspection',
                        'annexure_9_download', 'annexure_9', formData.annexure_9, formData.inspection_id, VALUE_THREE);
            }
            if (formData.approved_license != '') {
                that.showDocument('approved_license_container_for_inspection', 'approved_license_name_image_for_inspection', 'approved_license_name_container_for_inspection',
                        'approved_license_download', 'approved_license', formData.approved_license, formData.inspection_id, VALUE_FOUR);
            }

        }
        generateSelect2();
        datePicker();
        $('#inspection_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitInspection($('#submit_btn_for_inspection'));
            }
        });
    },
    editOrViewInspection: function (btnObj, inspectionId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!inspectionId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'inspection/get_inspection_data_by_id',
            type: 'post',
            data: $.extend({}, {'inspection_id': inspectionId}, getTokenData()),
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
                    that.newInspectionForm(isEdit, parseData);
                } else {
                    that.viewInspectionForm(parseData);
                }
            }
        });
    },
    viewInspectionForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.inspection_data;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        Inspection.router.navigate('view_inspection_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        formData.application_date = dateTo_DD_MM_YYYY(formData.application_date);
        $('#inspection_form_and_datatable_container').html(inspectionViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.signature_architecture != '') {
            that.showDocument('signature_architecture_container_for_inspection', 'signature_architecture_name_image_for_inspection',
                    'signature_architecture_name_container_for_inspection',
                    'signature_architecture_download', 'signature_architecture', formData.signature_architecture);
        }

        if (formData.sign_seal != '') {
            that.showDocument('sign_seal_container_for_inspection', 'sign_seal_name_image_for_inspection',
                    'sign_seal_name_container_for_inspection',
                    'sign_seal_download', 'sign_seal', formData.sign_seal);
        }

        if (formData.annexure_9 != '') {
            that.showDocument('annexure_9_container_for_inspection', 'annexure_9_name_image_for_inspection',
                    'annexure_9_name_container_for_inspection',
                    'annexure_9_download', 'annexure_9', formData.annexure_9);
        }
        if (formData.approved_license != '') {
            that.showDocument('approved_license_container_for_inspection', 'approved_license_name_image_for_inspection',
                    'approved_license_name_container_for_inspection',
                    'approved_license_download', 'approved_license', formData.approved_license);
        }
    },
    checkValidationForInspection: function (inspectionData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!inspectionData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!inspectionData.communication_number) {
            return getBasicMessageAndFieldJSONArray('communication_number', CommunicationValidationMessage);
        }
        if (!inspectionData.name_licensed) {
            return getBasicMessageAndFieldJSONArray('name_licensed', LicensedNameValidationMessage);
        }
        if (!inspectionData.address) {
            return getBasicMessageAndFieldJSONArray('address', FullAddressValidationMessage);
        }
        if (!inspectionData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!inspectionData.application_date) {
            return getBasicMessageAndFieldJSONArray('application_date', appDateValidationMessage);
        }
        if (!inspectionData.village) {
            return getBasicMessageAndFieldJSONArray('village', villageValidationMessage);
        }


        return '';
    },
    askForSubmitInspection: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Inspection.listview.submitInspection(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitInspection: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var inspectionData = $('#inspection_form').serializeFormJSON();
        var validationData = that.checkValidationForInspection(inspectionData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('inspection-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#signature_architecture_container_for_inspection').is(':visible')) {
            var SignatureAndArchitecture = checkValidationForDocument('signature_architecture_for_inspection', VALUE_TWO, 'inspection');
            if (SignatureAndArchitecture == false) {
                return false;
            }
        }
        if ($('#sign_seal_container_for_inspection').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('sign_seal_for_inspection', VALUE_TWO, 'inspection');
            if (sealAndStamp == false) {
                return false;
            }
        }


        // if ($('#annexure_9_container_for_inspection').is(':visible')) {
        //     var annexure_9Document = checkValidationForDocument('annexure_9_for_inspection', VALUE_ONE, 'inspection');
        //     if (annexure_9Document == false) {
        //         return false;
        //     }
        // }

        if ($('#approved_license_container_for_inspection').is(':visible')) {
            var approved_licenseDocument = checkValidationForDocument('approved_license_for_inspection', VALUE_ONE, 'inspection', 25600);
            if (approved_licenseDocument == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_inspection') : $('#submit_btn_for_inspection');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var inspectionData = new FormData($('#inspection_form')[0]);
        inspectionData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        // inspectionData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        inspectionData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'inspection/submit_inspection',
            data: inspectionData,
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
                validationMessageShow('inspection', textStatus.statusText);
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
                    validationMessageShow('inspection', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Inspection.router.navigate('inspection', {'trigger': true});
            }
        });
    },

    askForRemove: function (inspectionId, docType, tableName) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!inspectionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Inspection.listview.removeDocument(\'' + inspectionId + '\',\'' + docType + '\',\'' + tableName + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (inspectionId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!inspectionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_inspection_' + docType).hide();
        $('.spinner_name_container_for_inspection_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'inspection/remove_document',
            //data: $.extend({}, {'inspection_id': inspectionId, 'document_id': docId, 'table_name': tableName}, getTokenData()),
            data: $.extend({}, {'inspection_id': inspectionId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_inspection_' + docType).hide();
                $('.spinner_name_container_for_inspection_' + docType).show();
                validationMessageShow('inspection', textStatus.statusText);
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
                    validationMessageShow('inspection', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_inspection_' + docType).show();
                $('.spinner_name_container_for_inspection_' + docType).hide();
                showSuccess(parseData.message);
                //removeDocument(docId, 'inspection');
                if (docType == VALUE_ONE) {
                    removeDocumentValue('signature_architecture_name_container_for_inspection',
                            'signature_architecture_name_image_for_inspection', 'signature_architecture_container_for_inspection',
                            'signature_architecture_for_inspection');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('sign_seal_name_container_for_inspection',
                            'sign_seal_name_image_for_inspection', 'sign_seal_container_for_inspection',
                            'sign_seal_for_inspection');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('annexure_9_name_container_for_inspection',
                            'annexure_9_name_image_for_inspection', 'annexure_9_container_for_inspection',
                            'annexure_9_for_inspection');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('approved_license_name_container_for_inspection',
                            'approved_license_name_image_for_inspection', 'approved_license_container_for_inspection',
                            'approved_license_for_inspection');
                }

            }
        });
    },

    generateForm1: function (inspectionId) {
        if (!inspectionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#inspection_id_for_inspection_form1').val(inspectionId);
        $('#inspection_form1_pdf_form').submit();
        $('#inspection_id_for_inspection_form1').val('');
    },

    downloadUploadChallan: function (inspectionId) {
        if (!inspectionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + inspectionId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'inspection/get_inspection_data_by_inspection_id',
            type: 'post',
            data: $.extend({}, {'inspection_id': inspectionId}, getTokenData()),
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
                var inspectionData = parseData.inspection_data;
                that.showChallan(inspectionData);
            }
        });
    },
    showChallan: function (inspectionData) {
        showPopup();
        if (inspectionData.status != VALUE_FIVE && inspectionData.status != VALUE_SIX && inspectionData.status != VALUE_SEVEN && inspectionData.status != VALUE_ELEVEN) {
            inspectionData.show_fees_paid = true;
        }
        if (inspectionData.payment_type == VALUE_ONE) {
            inspectionData.utitle = 'Fees Paid Challan Copy';
        } else {
            inspectionData.style = 'display: none;';
        }
        if (inspectionData.payment_type == VALUE_TWO) {
            inspectionData.show_dd_po_option = true;
            inspectionData.utitle = 'Demand Draft (DD)';
        }
        inspectionData.module_type = VALUE_TWENTYSEVEN;
        $('#popup_container').html(inspectionUploadChallanTemplate(inspectionData));
        loadFB(VALUE_TWENTYSEVEN, inspectionData.fb_data);

        if (inspectionData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'inspection_upload_challan', inspectionData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'inspection_upload_challan', 'uc', 'radio');
            if (inspectionData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_inspection_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (inspectionData.challan != '') {
            $('#challan_container_for_inspection_upload_challan').hide();
            $('#challan_name_container_for_inspection_upload_challan').show();
            $('#challan_name_href_for_inspection_upload_challan').attr('href', 'documents/inspection/' + inspectionData.challan);
            $('#challan_name_for_inspection_upload_challan').html(inspectionData.challan);
        }
        if (inspectionData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_inspection_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_inspection_upload_challan').show();
            $('#fees_paid_challan_name_href_for_inspection_upload_challan').attr('href', 'documents/inspection/' + inspectionData.fees_paid_challan);
            $('#fees_paid_challan_name_for_inspection_upload_challan').html(inspectionData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_inspection_upload_challan').attr('onclick', 'Inspection.listview.removeFeesPaidChallan("' + inspectionData.inspection_id + '")');
        }
    },
    removeFeesPaidChallan: function (inspectionId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!inspectionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'inspection/remove_fees_paid_challan',
            data: $.extend({}, {'inspection_id': inspectionId}, getTokenData()),
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
                validationMessageShow('inspection-uc', textStatus.statusText);
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
                    validationMessageShow('inspection-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-inspection-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'inspection_upload_challan');
                $('#status_' + inspectionId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-inspection-uc').html('');
        validationMessageHide();
        var inspectionId = $('#inspection_id_for_inspection_upload_challan').val();
        if (!inspectionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_inspection_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_inspection_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_inspection_upload_challan').focus();
                validationMessageShow('inspection-uc-fees_paid_challan_for_inspection_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_inspection_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_inspection_upload_challan').focus();
                validationMessageShow('inspection-uc-fees_paid_challan_for_inspection_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_inspection_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#inspection_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'inspection/upload_fees_paid_challan',
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
                validationMessageShow('inspection-uc', textStatus.statusText);
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
                    validationMessageShow('inspection-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + inspectionId).html(appStatusArray[parseData.status]);
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (inspectionId) {
        if (!inspectionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#inspection_id_for_certificate').val(inspectionId);
        $('#inspection_certificate_pdf_form').submit();
        $('#inspection_id_for_certificate').val('');
    },
    getQueryData: function (inspectionId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!inspectionId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTYSEVEN;
        templateData.module_id = inspectionId;
        var btnObj = $('#query_btn_for_inspection_' + inspectionId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTYSEVEN, moduleData.inspection_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForInspection: function (fileNo) {
        var that = this;
        if ($('#signature_architecture_for_inspection').val() != '') {
            var SignatureAndArchitecture = checkValidationForDocument('signature_architecture_for_inspection', VALUE_TWO, 'inspection');
            if (SignatureAndArchitecture == false) {
                return false;
            }
        }
        if ($('#sign_seal_for_inspection').val() != '') {
            var sealAndStamp = checkValidationForDocument('sign_seal_for_inspection', VALUE_TWO, 'inspection');
            if (sealAndStamp == false) {
                return false;
            }
        }
        if ($('#annexure_9_for_inspection').val() != '') {
            var annexure_9Document = checkValidationForDocument('annexure_9_for_inspection', VALUE_ONE, 'inspection');
            if (annexure_9Document == false) {
                return false;
            }
        }
        if ($('#approved_license_for_inspection').val() != '') {
            var approved_licenseDocument = checkValidationForDocument('approved_license_for_inspection', VALUE_ONE, 'inspection', 25600);
            if (approved_licenseDocument == false) {
                return false;
            }
        }
        $('.spinner_container_for_inspection_' + fileNo).hide();
        $('.spinner_name_container_for_inspection_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var inspectionId = $('#inspection_id').val();
        var formData = new FormData($('#inspection_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("inspection_id", inspectionId);
        $.ajax({
            type: 'POST',
            url: 'inspection/upload_inspection_document',
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
                $('.spinner_container_for_inspection_' + fileNo).show();
                $('.spinner_name_container_for_inspection_' + fileNo).hide();
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
                    $('.spinner_container_for_inspection_' + fileNo).show();
                    $('.spinner_name_container_for_inspection_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_inspection_' + fileNo).hide();
                $('.spinner_name_container_for_inspection_' + fileNo).show();
                $('#inspection_id').val(parseData.inspection_id);
                var inspectionData = parseData.inspection_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('signature_architecture_container_for_inspection', 'signature_architecture_name_image_for_inspection', 'signature_architecture_name_container_for_inspection',
                            'signature_architecture_download', 'signature_architecture', inspectionData.signature_architecture, parseData.inspection_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('sign_seal_container_for_inspection', 'sign_seal_name_image_for_inspection', 'sign_seal_name_container_for_inspection',
                            'sign_seal_download', 'sign_seal', inspectionData.sign_seal, parseData.inspection_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('annexure_9_container_for_inspection', 'annexure_9_name_image_for_inspection', 'annexure_9_name_container_for_inspection',
                            'annexure_9_download', 'annexure_9', inspectionData.annexure_9, parseData.inspection_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('approved_license_container_for_inspection', 'approved_license_name_image_for_inspection', 'approved_license_name_container_for_inspection',
                            'approved_license_download', 'approved_license', inspectionData.approved_license, parseData.inspection_id, VALUE_FOUR);
                }

            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/inspection/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/inspection/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Inspection.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
