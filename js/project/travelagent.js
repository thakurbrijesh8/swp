var travelagentListTemplate = Handlebars.compile($('#travelagent_list_template').html());
var travelagentTableTemplate = Handlebars.compile($('#travelagent_table_template').html());
var travelagentActionTemplate = Handlebars.compile($('#travelagent_action_template').html());
var travelagentFormTemplate = Handlebars.compile($('#travelagent_form_template').html());
var travelagentViewTemplate = Handlebars.compile($('#travelagent_view_template').html());
var travelagentUploadChallanTemplate = Handlebars.compile($('#travelagent_upload_challan_template').html());

var tempPersonCnt = 1;

var TravelAgent = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
TravelAgent.Router = Backbone.Router.extend({
    routes: {
        'travelagent': 'renderList',
        'travelagent_form': 'renderListForForm',
        'edit_travelagent_form': 'renderList',
        'view_travelagent_form': 'renderList',
    },
    renderList: function () {
        TravelAgent.listview.listPage();
    },
    renderListForForm: function () {
        TravelAgent.listview.listPageTravelAgentForm();
    }
});
TravelAgent.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('travelagent', 'active');
        TravelAgent.router.navigate('travelagent');
        var templateData = {};
        this.$el.html(travelagentListTemplate(templateData));
        this.loadTravelAgentData(sDistrict, sStatus);

    },
    listPageTravelAgentForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(travelagentListTemplate);
        this.newTravelAgentForm(false, {});
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
                rowData.ADMIN_TRAVELAGENT_DOC_PATH = ADMIN_TRAVELAGENT_DOC_PATH;
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
        return travelagentActionTemplate(rowData);
    },
    loadTravelAgentData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_NINETEEN, data)
                    + getFRContainer(VALUE_NINETEEN, data, full.rating, full.fr_datetime);
        };

        var that = this;
        TravelAgent.router.navigate('travelagent');
        $('#travelagent_form_and_datatable_container').html(travelagentTableTemplate(searchData));
        travelagentDataTable = $('#travelagent_datatable').DataTable({
            ajax: {url: 'travelagent/get_travelagent_data', dataSrc: "travelagent_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'travelagent_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_person', 'class': 'text-center'},
                {data: 'name_of_travel_agency', 'class': 'text-center'},
                {data: 'area_of_agency', 'class': 'text-center', 'render': districtRenderer},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'travelagent_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'travelagent_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#travelagent_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = travelagentDataTable.row(tr);

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
    newTravelAgentForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.travelagent_data;
            TravelAgent.router.navigate('edit_travelagent_form');
        } else {
            var formData = {};
            TravelAgent.router.navigate('travelagent_form');
        }
        var templateData = {};
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.TRAVEL_AGENCY_FEES = TRAVEL_AGENCY_FEES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.travelagent_data = parseData.travelagent_data;
        $('#travelagent_form_and_datatable_container').html(travelagentFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'area_of_agency');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');

        if (isEdit) {
            $('#area_of_agency').val(formData.area_of_agency);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            if (formData.copy_of_registration != '') {
                that.showDocument('copy_of_registration_container_for_travelagent', 'copy_of_registration_name_image_for_travelagent', 'copy_of_registration_name_container_for_travelagent',
                        'copy_of_registration_download', 'copy_of_registration', formData.copy_of_registration, formData.travelagent_id, VALUE_ONE);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_travelagent', 'seal_and_stamp_name_image_for_travelagent', 'seal_and_stamp_name_container_for_travelagent',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.travelagent_id, VALUE_TWO);
            }
        }
        generateSelect2();
        datePicker();
        $('#travelagent_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitTravelAgent($('#submit_btn_for_travelagent'));
            }
        });
    },
    editOrViewTravelAgent: function (btnObj, travelagentId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!travelagentId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'travelagent/get_travelagent_data_by_id',
            type: 'post',
            data: $.extend({}, {'travelagent_id': travelagentId}, getTokenData()),
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
                    that.newTravelAgentForm(isEdit, parseData);
                } else {
                    that.viewTravelAgentForm(parseData);
                }
            }
        });
    },
    viewTravelAgentForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.travelagent_data;
        TravelAgent.router.navigate('view_travelagent_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.TRAVEL_AGENCY_FEES = TRAVEL_AGENCY_FEES;
        $('#travelagent_form_and_datatable_container').html(travelagentViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'area_of_agency');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#area_of_agency').val(formData.area_of_agency);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        if (formData.copy_of_registration != '') {
            that.showDocument('copy_of_registration_container_for_travelagent', 'copy_of_registration_name_image_for_travelagent', 'copy_of_registration_name_container_for_travelagent',
                    'copy_of_registration_download', 'copy_of_registration', formData.copy_of_registration);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_travelagent', 'seal_and_stamp_name_image_for_travelagent', 'seal_and_stamp_name_container_for_travelagent',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }

    },
    checkValidationForTravelAgent: function (travelagentData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!travelagentData.name_of_person) {
            return getBasicMessageAndFieldJSONArray('name_of_person', personNameValidationMessage);
        }
        if (!travelagentData.name_of_travel_agency) {
            return getBasicMessageAndFieldJSONArray('name_of_travel_agency', travelAgencyNameValidationMessage);
        }
        if (!travelagentData.address_of_agency) {
            return getBasicMessageAndFieldJSONArray('address_of_agency', addressOfAgencyValidationMessage);
        }
        if (!travelagentData.area_of_agency) {
            return getBasicMessageAndFieldJSONArray('area_of_agency', areaOfAgencyValidationMessage);
        }
        if (!travelagentData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!travelagentData.mob_no) {
            return getBasicMessageAndFieldJSONArray('mob_no', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(travelagentData.mob_no);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mob_no', invalidMobileValidationMessage);
        }

        return '';
    },
    askForSubmitTravelAgent: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'TravelAgent.listview.submitTravelAgent(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitTravelAgent: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var travelagentData = $('#travelagent_form').serializeFormJSON();
        var validationData = that.checkValidationForTravelAgent(travelagentData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('travelagent-' + validationData.field, validationData.message);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }

        if ($('#copy_of_registration_container_for_travelagent').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('copy_of_registration_for_travelagent', VALUE_ONE, 'travelagent');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_travelagent').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_travelagent', VALUE_TWO, 'travelagent');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_travelagent') : $('#submit_btn_for_travelagent');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var travelagentData = new FormData($('#travelagent_form')[0]);
        travelagentData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        travelagentData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'travelagent/submit_travelagent',
            data: travelagentData,
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
                validationMessageShow('travelagent', textStatus.statusText);
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
                    validationMessageShow('travelagent', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                TravelAgent.router.navigate('travelagent', {'trigger': true});
            }
        });
    },

    askForRemove: function (travelagentId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!travelagentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'TravelAgent.listview.removeDocument(\'' + travelagentId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (travelagentId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!travelagentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_travelagent_' + docType).hide();
        $('.spinner_name_container_for_travelagent_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'travelagent/remove_document',
            data: $.extend({}, {'travelagent_id': travelagentId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_travelagent_' + docType).hide();
                $('.spinner_name_container_for_travelagent_' + docType).show();
                validationMessageShow('travelagent', textStatus.statusText);
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
                    validationMessageShow('travelagent', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_travelagent_' + docType).show();
                $('.spinner_name_container_for_travelagent_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('copy_of_registration_name_container_for_travelagent', 'copy_of_registration_name_image_for_travelagent', 'copy_of_registration_container_for_travelagent', 'copy_of_registration_for_travelagent');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('seal_and_stamp_name_container_for_travelagent', 'seal_and_stamp_name_image_for_travelagent', 'seal_and_stamp_container_for_travelagent', 'seal_and_stamp_for_travelagent');
                }
            }
        });
    },
    generateForm: function (travelagentId) {
        if (!travelagentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#travelagent_id_for_travelagent_form').val(travelagentId);
        $('#travelagent_form_pdf_form').submit();
        $('#travelagent_id_for_travelagent_form').val('');
    },

    downloadUploadChallan: function (travelagentId) {
        if (!travelagentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + travelagentId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'travelagent/get_travelagent_data_by_travelagent_id',
            type: 'post',
            data: $.extend({}, {'travelagent_id': travelagentId}, getTokenData()),
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
                var travelagentData = parseData.travelagent_data;
                that.showChallan(travelagentData);
            }
        });
    },
    showChallan: function (travelagentData) {
        showPopup();
        if (travelagentData.status != VALUE_FIVE && travelagentData.status != VALUE_SIX && travelagentData.status != VALUE_SEVEN && travelagentData.status != VALUE_ELEVEN) {
            if (!travelagentData.hide_submit_btn) {
                travelagentData.show_fees_paid = true;
            }
        }
        if (travelagentData.payment_type == VALUE_ONE) {
            travelagentData.utitle = 'Fees Paid Challan Copy';
        } else {
            travelagentData.style = 'display: none;';
        }
        if (travelagentData.payment_type == VALUE_TWO) {
            travelagentData.show_dd_po_option = true;
            travelagentData.utitle = 'Demand Draft (DD)';
        }
        travelagentData.module_type = VALUE_NINETEEN;
        $('#popup_container').html(travelagentUploadChallanTemplate(travelagentData));
        loadFB(VALUE_NINETEEN, travelagentData.fb_data);
        loadPH(VALUE_NINETEEN, travelagentData.travelagent_id, travelagentData.ph_data);

        if (travelagentData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'travelagent_upload_challan', travelagentData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'travelagent_upload_challan', 'uc', 'radio');
            if (travelagentData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_travelagent_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (travelagentData.challan != '') {
            $('#challan_container_for_travelagent_upload_challan').hide();
            $('#challan_name_container_for_travelagent_upload_challan').show();
            $('#challan_name_href_for_travelagent_upload_challan').attr('href', 'documents/travelagent/' + travelagentData.challan);
            $('#challan_name_for_travelagent_upload_challan').html(travelagentData.challan);
        }
        if (travelagentData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_travelagent_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_travelagent_upload_challan').show();
            $('#fees_paid_challan_name_href_for_travelagent_upload_challan').attr('href', 'documents/travelagent/' + travelagentData.fees_paid_challan);
            $('#fees_paid_challan_name_for_travelagent_upload_challan').html(travelagentData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_travelagent_upload_challan').attr('onclick', 'TravelAgent.listview.removeFeesPaidChallan("' + travelagentData.travelagent_id + '")');
        }
    },
    removeFeesPaidChallan: function (travelagentId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!travelagentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'travelagent/remove_fees_paid_challan',
            data: $.extend({}, {'travelagent_id': travelagentId}, getTokenData()),
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
                validationMessageShow('travelagent-uc', textStatus.statusText);
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
                    validationMessageShow('travelagent-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-travelagent-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'travelagent_upload_challan');
                $('#status_' + travelagentId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-travelagent-uc').html('');
        validationMessageHide();
        var travelagentId = $('#travelagent_id_for_travelagent_upload_challan').val();
        if (!travelagentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_travelagent_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_travelagent_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_travelagent_upload_challan').focus();
                validationMessageShow('travelagent-uc-fees_paid_challan_for_travelagent_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_travelagent_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_travelagent_upload_challan').focus();
                validationMessageShow('travelagent-uc-fees_paid_challan_for_travelagent_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_travelagent_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#travelagent_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'travelagent/upload_fees_paid_challan',
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
                validationMessageShow('travelagent-uc', textStatus.statusText);
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
                    validationMessageShow('travelagent-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + travelagentId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (travelagentId) {
        if (!travelagentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#travelagent_id_for_certificate').val(travelagentId);
        $('#travelagent_certificate_pdf_form').submit();
        $('#travelagent_id_for_certificate').val('');
    },
    getQueryData: function (travelagentId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!travelagentId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_NINETEEN;
        templateData.module_id = travelagentId;
        var btnObj = $('#query_btn_for_travelagent_' + travelagentId);
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
                tmpData.application_number = regNoRenderer(VALUE_NINETEEN, moduleData.travelagent_id);
                tmpData.applicant_name = moduleData.name_of_travel_agency;
                tmpData.title = 'Travel Agency Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForTravelAgent: function (fileNo) {
        var that = this;
        if ($('#copy_of_registration_for_travelagent').val() != '') {
            var copyOfRegistration = checkValidationForDocument('copy_of_registration_for_travelagent', VALUE_ONE, 'travelagent');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_travelagent').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_travelagent', VALUE_TWO, 'travelagent');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_travelagent_' + fileNo).hide();
        $('.spinner_name_container_for_travelagent_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var travelagentId = $('#travelagent_id').val();
        var formData = new FormData($('#travelagent_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("travelagent_id", travelagentId);
        $.ajax({
            type: 'POST',
            url: 'travelagent/upload_travelagent_document',
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
                $('.spinner_container_for_travelagent_' + fileNo).show();
                $('.spinner_name_container_for_travelagent_' + fileNo).hide();
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
                    $('.spinner_container_for_travelagent_' + fileNo).show();
                    $('.spinner_name_container_for_travelagent_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_travelagent_' + fileNo).hide();
                $('.spinner_name_container_for_travelagent_' + fileNo).show();
                $('#travelagent_id').val(parseData.travelagent_id);
                var travelagentData = parseData.travelagent_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('copy_of_registration_container_for_travelagent', 'copy_of_registration_name_image_for_travelagent', 'copy_of_registration_name_container_for_travelagent',
                            'copy_of_registration_download', 'copy_of_registration', travelagentData.copy_of_registration, parseData.travelagent_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('seal_and_stamp_container_for_travelagent', 'seal_and_stamp_name_image_for_travelagent', 'seal_and_stamp_name_container_for_travelagent',
                            'seal_and_stamp_download', 'seal_and_stamp', travelagentData.signature, parseData.travelagent_id, VALUE_TWO);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/travelagent/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/travelagent/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'TravelAgent.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
