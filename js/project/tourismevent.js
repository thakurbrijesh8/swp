var tourismeventListTemplate = Handlebars.compile($('#tourismevent_list_template').html());
var tourismeventTableTemplate = Handlebars.compile($('#tourismevent_table_template').html());
var tourismeventActionTemplate = Handlebars.compile($('#tourismevent_action_template').html());
var tourismeventFormTemplate = Handlebars.compile($('#tourismevent_form_template').html());
var tourismeventViewTemplate = Handlebars.compile($('#tourismevent_view_template').html());

var Tourismevent = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Tourismevent.Router = Backbone.Router.extend({
    routes: {
        'tourismevent': 'renderList',
        'tourismevent_form': 'renderListForForm',
        'edit_tourismevent_form': 'renderList',
        'view_tourismevent_form': 'renderList',
    },
    renderList: function () {
        Tourismevent.listview.listPage();
    },
    renderListForForm: function () {
        Tourismevent.listview.listPageTourismeventForm();
    }
});
Tourismevent.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        addClass('tourismevent', 'active');
        Tourismevent.router.navigate('tourismevent');
        var templateData = {};
        this.$el.html(tourismeventListTemplate(templateData));
        this.loadTourismeventData(sDistrict, sStatus);

    },
    listPageTourismeventForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(tourismeventListTemplate);
        this.newTourismeventForm(false, {});
    },
    actionRenderer: function (rowData) {
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE) {
            rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_form_one_btn = true;
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return tourismeventActionTemplate(rowData);
    },
    loadTourismeventData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var dateEventRendere = function (data, type, full, meta) {
            if (full.date_of_event != '0000-00-00') {
                return dateTo_DD_MM_YYYY(full.date_of_event);
            } else {
                return '';
            }
        };
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTYFOUR, data);
        };
        var that = this;
        Tourismevent.router.navigate('tourismevent');
        $('#tourismevent_form_and_datatable_container').html(tourismeventTableTemplate(searchData));
        tourismeventDataTable = $('#tourismevent_datatable').DataTable({
            ajax: {url: 'tourismevent/get_tourismevent_data', dataSrc: "tourismevent_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'tourismevent_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render':entityEstablishmentRenderer},
                {data: 'name_of_person', 'class': 'text-center'},
                {data: 'date_of_event', 'class': 'text-center', 'render': dateEventRendere},
                {data: 'time_of_event', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'tourismevent_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'tourismevent_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#tourismevent_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = tourismeventDataTable.row(tr);

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
    newTourismeventForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.tourismevent_data;
            Tourismevent.router.navigate('edit_tourismevent_form');
        } else {
            var formData = {};
            Tourismevent.router.navigate('tourismevent_form');
        }
        var templateData = {};
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.tourismevent_data = parseData.tourismevent_data;
        templateData.date_of_event = dateTo_DD_MM_YYYY(formData.date_of_event);
        $('#tourismevent_form_and_datatable_container').html(tourismeventFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            if (formData.proposal_details_document != '') {
                that.showDocument('proposal_details_document_container_for_tourismevent', 'proposal_details_document_name_image_for_tourismevent', 'proposal_details_document_name_container_for_tourismevent',
                        'proposal_details_document_download', 'proposal_details_document_remove_btn', formData.proposal_details_document, formData.tourismevent_id, VALUE_ONE);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_tourismevent', 'seal_and_stamp_name_image_for_tourismevent', 'seal_and_stamp_name_container_for_tourismevent',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.tourismevent_id, VALUE_TWO);
            }
        }
        generateSelect2();
        datePicker();
        timePicker();
        $('#tourismevent_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitTourismevent($('#submit_btn_for_tourismevent'));
            }
        });
    },
    editOrViewTourismevent: function (btnObj, tourismeventId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!tourismeventId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'tourismevent/get_tourismevent_data_by_id',
            type: 'post',
            data: $.extend({}, {'tourismevent_id': tourismeventId}, getTokenData()),
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
                    that.newTourismeventForm(isEdit, parseData);
                } else {
                    that.viewTourismeventForm(parseData);
                }
            }
        });
    },
    viewTourismeventForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.tourismevent_data;
        Tourismevent.router.navigate('view_tourismevent_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.date_of_event = dateTo_DD_MM_YYYY(formData.date_of_event);
        $('#tourismevent_form_and_datatable_container').html(tourismeventViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        if (formData.proposal_details_document != '') {
            that.showDocument('proposal_details_document_container_for_tourismevent', 'proposal_details_document_name_image_for_tourismevent', 'proposal_details_document_name_container_for_tourismevent',
                    'proposal_details_document_download', 'proposal_details_document_remove_brn', formData.proposal_details_document, formData.tourismevent_id, VALUE_ONE);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_tourismevent', 'seal_and_stamp_name_image_for_tourismevent', 'seal_and_stamp_name_container_for_tourismevent',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.tourismevent_id, VALUE_TWO);
        }
    },
    checkValidationForTourismevent: function (tourismeventData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!tourismeventData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!tourismeventData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!tourismeventData.name_of_person) {
            return getBasicMessageAndFieldJSONArray('name_of_person', personNameValidationMessage);
        }
        if (!tourismeventData.name_of_event) {
            return getBasicMessageAndFieldJSONArray('name_of_event', nameOfEventValidationMessage);
        }
        if (!tourismeventData.location_of_event) {
            return getBasicMessageAndFieldJSONArray('location_of_event', locationOfEventValidationMessage);
        }
        if (!tourismeventData.date_of_event) {
            return getBasicMessageAndFieldJSONArray('date_of_event', dateValidationMessage);
        }
        if (!tourismeventData.time_of_event) {
            return getBasicMessageAndFieldJSONArray('time_of_event', timeOfEventValidationMessage);
        }
        if (!tourismeventData.duration_of_event) {
            return getBasicMessageAndFieldJSONArray('duration_of_event', durationOfEventValidationMessage);
        }
        if (!tourismeventData.mob_no) {
            return getBasicMessageAndFieldJSONArray('mob_no', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(tourismeventData.mob_no);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mob_no', invalidMobileValidationMessage);
        }


        return '';
    },
    askForSubmitTourismevent: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Tourismevent.listview.submitTourismevent(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitTourismevent: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var tourismeventData = $('#tourismevent_form').serializeFormJSON();
        var validationData = that.checkValidationForTourismevent(tourismeventData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('tourismevent-' + validationData.field, validationData.message);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }

        if ($('#proposal_details_document_container_for_tourismevent').is(':visible')) {
            var proposalDetailsDocument = checkValidationForDocument('proposal_details_document_for_tourismevent', VALUE_ONE, 'tourismevent');
            if (proposalDetailsDocument == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_tourismevent').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_tourismevent', VALUE_TWO, 'tourismevent');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_tourismevent') : $('#submit_btn_for_tourismevent');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var tourismeventData = new FormData($('#tourismevent_form')[0]);
        tourismeventData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        tourismeventData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'tourismevent/submit_tourismevent',
            data: tourismeventData,
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
                validationMessageShow('tourismevent', textStatus.statusText);
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
                    validationMessageShow('tourismevent', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Tourismevent.router.navigate('tourismevent', {'trigger': true});
            }
        });
    },

    askForRemove: function (tourismeventId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!tourismeventId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Tourismevent.listview.removeDocument(\'' + tourismeventId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (tourismeventId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        if (!tourismeventId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_tourismevent_' + docType).hide();
        $('.spinner_name_container_for_tourismevent_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'tourismevent/remove_document',
            data: $.extend({}, {'tourismevent_id': tourismeventId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_tourismevent_' + docType).hide();
                $('.spinner_name_container_for_tourismevent_' + docType).show();
                validationMessageShow('tourismevent', textStatus.statusText);
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
                    validationMessageShow('tourismevent', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_tourismevent_' + docType).show();
                $('.spinner_name_container_for_tourismevent_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('proposal_details_document_name_container_for_tourismevent', 'proposal_details_document_name_image_for_tourismevent', 'proposal_details_document_container_for_tourismevent', 'proposal_details_document_for_tourismevent');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('seal_and_stamp_name_container_for_tourismevent', 'seal_and_stamp_name_image_for_tourismevent', 'seal_and_stamp_container_for_tourismevent', 'seal_and_stamp_for_tourismevent');
                }
            }
        });
    },
    generateForm: function (tourismeventId) {
        if (!tourismeventId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#tourismevent_id_for_tourismevent_form').val(tourismeventId);
        $('#tourismevent_form_pdf_form').submit();
        $('#tourismevent_id_for_tourismevent_form').val('');
    },

    downloadUploadChallan: function (tourismeventId) {
        if (!tourismeventId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + tourismeventId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'tourismevent/get_tourismevent_data_by_tourismevent_id',
            type: 'post',
            data: $.extend({}, {'tourismevent_id': tourismeventId}, getTokenData()),
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
                var tourismeventData = parseData.tourismevent_data;
                that.showChallan(tourismeventData);
            }
        });
    },
    generateCertificate: function (tourismeventId) {
        if (!tourismeventId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#tourismevent_id_for_certificate').val(tourismeventId);
        $('#tourismevent_certificate_pdf_form').submit();
        $('#tourismevent_id_for_certificate').val('');
    },
    getQueryData: function (tourismeventId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!tourismeventId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTYFOUR;
        templateData.module_id = tourismeventId;
        var btnObj = $('#query_btn_for_tourismevent_' + tourismeventId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTYFOUR, moduleData.tourismevent_id);
                tmpData.applicant_name = moduleData.name_of_person;
                tmpData.title = 'Tourism Event';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForTourismevent: function (fileNo) {
        var that = this;
        if ($('#proposal_details_document_for_tourismevent').val() != '') {
            var proposalDetailsDocument = checkValidationForDocument('proposal_details_document_for_tourismevent', VALUE_ONE, 'tourismevent');
            if (proposalDetailsDocument == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_tourismevent').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_tourismevent', VALUE_TWO, 'tourismevent');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_tourismevent_' + fileNo).hide();
        $('.spinner_name_container_for_tourismevent_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var tourismeventId = $('#tourismevent_id').val();
        var formData = new FormData($('#tourismevent_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("tourismevent_id", tourismeventId);
        $.ajax({
            type: 'POST',
            url: 'tourismevent/upload_tourismevent_document',
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
                $('.spinner_container_for_tourismevent_' + fileNo).show();
                $('.spinner_name_container_for_tourismevent_' + fileNo).hide();
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
                    $('.spinner_container_for_tourismevent_' + fileNo).show();
                    $('.spinner_name_container_for_tourismevent_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_tourismevent_' + fileNo).hide();
                $('.spinner_name_container_for_tourismevent_' + fileNo).show();
                $('#tourismevent_id').val(parseData.tourismevent_id);
                var tourismeventData = parseData.tourismevent_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('proposal_details_document_container_for_tourismevent', 'proposal_details_document_name_image_for_tourismevent', 'proposal_details_document_name_container_for_tourismevent',
                            'proposal_details_document_download', 'proposal_details_document_remove_btn', tourismeventData.proposal_details_document, parseData.tourismevent_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('seal_and_stamp_container_for_tourismevent', 'seal_and_stamp_name_image_for_tourismevent', 'seal_and_stamp_name_container_for_tourismevent',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', tourismeventData.signature, parseData.tourismevent_id, VALUE_TWO);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/tourismevent/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/tourismevent/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Tourismevent.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
