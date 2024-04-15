var boilerActListTemplate = Handlebars.compile($('#boiler_act_list_template').html());
var boilerActTableTemplate = Handlebars.compile($('#boiler_act_table_template').html());
var boilerActActionTemplate = Handlebars.compile($('#boiler_act_action_template').html());
var boilerActFormTemplate = Handlebars.compile($('#boiler_act_form_template').html());
var boilerActViewTemplate = Handlebars.compile($('#boiler_act_view_template').html());
var boilerActChallanTemplate = Handlebars.compile($('#boiler_act_upload_challan_template').html());

var BoilerAct = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
BoilerAct.Router = Backbone.Router.extend({
    routes: {
        'boileract': 'renderList',
        'boileract_form': 'renderListForForm',
        'edit_boileract_form': 'renderList',
        'view_boileract_form': 'renderList',
    },
    renderList: function () {
        BoilerAct.listview.listPage();
    },
    renderListForForm: function () {
        BoilerAct.listview.listPageBoilerActForm();
    }
});
BoilerAct.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('menu_boiler_act', 'active');
        BoilerAct.router.navigate('boileract');
        var templateData = {};
        this.$el.html(boilerActListTemplate(templateData));
        this.loadBoilerActData(sDistrict, sStatus);

    },
    listPageBoilerActForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('menu_boiler_act', 'active');
        this.$el.html(boilerActListTemplate);
        this.newBoilerActForm(false, {});
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
                rowData.ADMIN_BOILER_DOC_PATH = ADMIN_BOILER_DOC_PATH;
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
        return boilerActActionTemplate(rowData);
    },
    loadBoilerActData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTYSEVEN, data)
                    + getFRContainer(VALUE_THIRTYSEVEN, data, full.rating, full.fr_datetime);
        };
        var that = this;
        BoilerAct.router.navigate('boileract');
        $('#boiler_act_form_and_datatable_container').html(boilerActTableTemplate(searchData));
        boilerActDataTable = $('#boiler_act_datatable').DataTable({
            ajax: {url: 'boileract/get_boiler_act_data', dataSrc: "boiler_act_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'boiler_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'owner_name', 'class': 'text-center'},
                {data: 'boiler_type', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'boiler_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'boiler_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}

            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#boiler_act_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = boilerActDataTable.row(tr);

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
    askForNewBoilerActForm: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        that.newBoilerActForm(false, {});
    },
    newBoilerActForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        tempProductCnt = 1;
        tempDirectorCnt = 1;
        tempEmployeeCnt = 1;

        var that = this;
        if (isEdit) {
            var formData = parseData.boiler_act_data;
            BoilerAct.router.navigate('edit_boileract_form');
        } else {
            var formData = {};
            BoilerAct.router.navigate('boileract_form');
        }

        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.boilerAct_data = parseData.boiler_act_data;


        $('#boiler_act_form_and_datatable_container').html(boilerActFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);

            if (formData.company_letter_head != '') {
                that.showDocument('company_letter_head_container_for_boileract', 'company_letter_head_name_image_for_boileract', 'company_letter_head_name_container_for_boileract',
                        'company_letter_head_download', 'company_letter_head', formData.company_letter_head, formData.boiler_id, VALUE_ONE);
            }
            if (formData.copy_of_challan != '') {
                that.showDocument('copy_of_challan_container_for_boileract', 'copy_of_challan_name_image_for_boileract', 'copy_of_challan_name_container_for_boileract',
                        'copy_of_challan_download', 'copy_of_challan', formData.copy_of_challan, formData.boiler_id, VALUE_TWO);
            }
            if (formData.pipe_line_deawing != '') {
                that.showDocument('pipe_line_deawing_container_for_boileract', 'pipe_line_deawing_name_image_for_boileract', 'pipe_line_deawing_name_container_for_boileract',
                        'pipe_line_deawing_download', 'pipe_line_deawing', formData.pipe_line_deawing, formData.boiler_id, VALUE_THREE);
            }
            if (formData.ibr_document != '') {
                that.showDocument('ibr_document_container_for_boileract', 'ibr_document_name_image_for_boileract', 'ibr_document_name_container_for_boileract',
                        'ibr_document_download', 'ibr_document', formData.ibr_document, formData.boiler_id, VALUE_FOUR);
            }
            if (formData.sign_of_applicant != '') {
                that.showDocument('sign_of_applicant_container_for_boileract', 'sign_of_applicant_name_image_for_boileract', 'sign_of_applicant_name_container_for_boileract',
                        'sign_of_applicant_download', 'sign_of_applicant', formData.sign_of_applicant, formData.boiler_id, VALUE_FIVE);
            }

        }

        generateSelect2();
        datePicker();
        $('#boiler_act_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitBoilerAct($('#submit_btn_for_boiler_act'));
            }
        });
    },
    editOrViewBoilerAct: function (btnObj, boilerActId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!boilerActId) {
            showError(invalidIdValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnClick = btnObj.attr("onclick");
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'boileract/get_boiler_act_data_by_id',
            type: 'post',
            data: $.extend({}, {'boiler_id': boilerActId}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnClick);
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
                btnObj.attr('onclick', ogBtnOnClick);
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
                // var boilerActData = parseData.boiler_act_data;
                // boilerActData.hydraulically_tested_on = dateTo_DD_MM_YYYY(boilerActData.hydraulically_tested_on);
                if (isEdit) {
                    that.newBoilerActForm(isEdit, parseData);
                } else {
                    that.viewBoilerActForm(parseData);
                }
            }
        });
    },
    viewBoilerActForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        //templateData.boilerAct_data = boilerActData;
        var formData = parseData.boiler_act_data;
        BoilerAct.router.navigate('view_boileract_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#boiler_act_form_and_datatable_container').html(boilerActViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.company_letter_head != '') {
            that.showDocument('company_letter_head_container_for_boileract', 'company_letter_head_name_image_for_boileract', 'company_letter_head_name_container_for_boileract',
                    'company_letter_head_download', 'company_letter_head', formData.company_letter_head);
        }
        if (formData.copy_of_challan != '') {
            that.showDocument('copy_of_challan_container_for_boileract', 'copy_of_challan_name_image_for_boileract', 'copy_of_challan_name_container_for_boileract',
                    'copy_of_challan_download', 'copy_of_challan', formData.copy_of_challan);
        }
        if (formData.pipe_line_deawing != '') {
            that.showDocument('pipe_line_deawing_container_for_boileract', 'pipe_line_deawing_name_image_for_boileract', 'pipe_line_deawing_name_container_for_boileract',
                    'pipe_line_deawing_download', 'pipe_line_deawing', formData.pipe_line_deawing);
        }
        if (formData.ibr_document != '') {
            that.showDocument('ibr_document_container_for_boileract', 'ibr_document_name_image_for_boileract', 'ibr_document_name_container_for_boileract',
                    'ibr_document_download', 'ibr_document', formData.ibr_document);
        }
        if (formData.sign_of_applicant != '') {
            that.showDocument('sign_of_applicant_container_for_boileract', 'sign_of_applicant_name_image_for_boileract', 'sign_of_applicant_name_container_for_boileract',
                    'sign_of_applicant_download', 'sign_of_applicant', formData.sign_of_applicant);
        }
    },
    checkValidationForBoilerAct: function (boilerActData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!boilerActData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!boilerActData.owner_name) {
            return getBasicMessageAndFieldJSONArray('owner_name', ownerNameValidationMessage);
        }
        if (!boilerActData.situation_of_boiler) {
            return getBasicMessageAndFieldJSONArray('situation_of_boiler', boilerSituationValidationMessage);
        }
        if (!boilerActData.boiler_type) {
            return getBasicMessageAndFieldJSONArray('boiler_type', boilerTypeValidationMessage);
        }
        if (!boilerActData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!boilerActData.ut) {
            return getBasicMessageAndFieldJSONArray('ut', utValidationMessage);
        }
        if (!boilerActData.working_pressure) {
            return getBasicMessageAndFieldJSONArray('working_pressure', workingPressureValidationMessage);
        }
        if (!boilerActData.max_pressure) {
            return getBasicMessageAndFieldJSONArray('max_pressure', maxPressureValidationMessage);
        }
        if (!boilerActData.heating_surface_area) {
            return getBasicMessageAndFieldJSONArray('heating_surface_area', heatingSurfaceValidationMessage);
        }
        if (!boilerActData.length_of_pipes) {
            return getBasicMessageAndFieldJSONArray('length_of_pipes', lengthPipesValidationMessage);
        }
        if (!boilerActData.max_evaporation) {
            return getBasicMessageAndFieldJSONArray('max_evaporation', maxEvaporationValidationMessage);
        }
        if (!boilerActData.place_of_manufacture) {
            return getBasicMessageAndFieldJSONArray('place_of_manufacture', manufacturePlaceValidationMessage);
        }
        if (!boilerActData.year_of_manufacture) {
            return getBasicMessageAndFieldJSONArray('year_of_manufacture', manufactureYearValidationMessage);
        }
        if (!boilerActData.name_of_manufacture) {
            return getBasicMessageAndFieldJSONArray('name_of_manufacture', manufactureNameValidationMessage);
        }
        if (!boilerActData.manufacture_address) {
            return getBasicMessageAndFieldJSONArray('manufacture_address', manufactureAddressValidationMessage);
        }
        if (!boilerActData.hydraulically_tested_on) {
            return getBasicMessageAndFieldJSONArray('hydraulically_tested_on', hydrulicallyTestedOnValidationMessage);
        }
        if (!boilerActData.hydraulically_tested_to) {
            return getBasicMessageAndFieldJSONArray('hydraulically_tested_to', hydrulicallyTestedValidationMessage);
        }
        if (!boilerActData.repairs && boilerActData.repairs != 0) {
            return getBasicMessageAndFieldJSONArray('repairs', repairsValidationMessage);
        }


        return '';
    },
    askForBoilerAct: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BoilerAct.listview.submitBoilerAct(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitBoilerAct: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var boilerActData = $('#boiler_act_form').serializeFormJSON();
        var validationData = that.checkValidationForBoilerAct(boilerActData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('boiler-act-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#company_letter_head_container_for_boileract').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('company_letter_head_for_boileract', VALUE_ONE, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_of_challan_container_for_boileract').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('copy_of_challan_for_boileract', VALUE_ONE, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#pipe_line_deawing_container_for_boileract').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('pipe_line_deawing_for_boileract', VALUE_ONE, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#ibr_document_container_for_boileract').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('ibr_document_for_boileract', VALUE_ONE, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#sign_of_applicant_container_for_boileract').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('sign_of_applicant_for_boileract', VALUE_TWO, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_bolier') : $('#submit_btn_for_bolier');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var boilerActData = new FormData($('#boiler_act_form')[0]);
        boilerActData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        boilerActData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'boileract/submit_boiler_act',
            data: boilerActData,
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
                validationMessageShow('boiler-act', textStatus.statusText);
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
                    validationMessageShow('boiler-act', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                BOCW.router.navigate('boileract', {'trigger': true});
            }
        });
    },
    askForRemove: function (boilerId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!boilerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BoilerAct.listview.removeDocument(\'' + boilerId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },

    removeDocument: function (boilerId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!boilerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_boileract_' + docType).hide();
        $('.spinner_name_container_for_boileract_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'boileract/remove_document',
            data: $.extend({}, {'boiler_id': boilerId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_boileract_' + docType).hide();
                $('.spinner_name_container_for_boileract_' + docType).show();
                validationMessageShow('boiler-act', textStatus.statusText);
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
                    validationMessageShow('boiler-act', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_boileract_' + docType).show();
                $('.spinner_name_container_for_boileract_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('company_letter_head_name_container_for_boileract', 'company_letter_head_name_image_for_boileract', 'company_letter_head_container_for_boileract', 'company_letter_head_for_boileract');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('copy_of_challan_name_container_for_boileract', 'copy_of_challan_name_image_for_boileract', 'copy_of_challan_container_for_boileract', 'copy_of_challan_for_boileract');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('pipe_line_deawing_name_container_for_boileract', 'pipe_line_deawing_name_image_for_boileract', 'pipe_line_deawing_container_for_boileract', 'pipe_line_deawing_for_boileract');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('ibr_document_name_container_for_boileract', 'ibr_document_name_image_for_boileract', 'ibr_document_container_for_boileract', 'ibr_document_for_boileract');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('sign_of_applicant_name_container_for_boileract', 'sign_of_applicant_name_image_for_boileract', 'sign_of_applicant_container_for_boileract', 'sign_of_applicant_for_boileract');
                }


            }
        });
    },
    generateForm1: function (boilerId) {
        if (!boilerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#boileract_id_for_boileract_form1').val(boilerId);
        $('#boileract_form1_pdf_form').submit();
        $('#boileract_id_for_boileract_form1').val('');
    },
    downloadUploadChallan: function (boilerId) {
        if (!boilerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + boilerId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'boileract/get_boileract_data_by_boileract_id',
            type: 'post',
            data: $.extend({}, {'boileract_id': boilerId}, getTokenData()),
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
                var boilerActData = parseData.boiler_act_data;
                that.showChallan(boilerActData);
            }
        });
    },
    showChallan: function (boilerActData) {
        showPopup();
        if (boilerActData.status != VALUE_FIVE && boilerActData.status != VALUE_SIX && boilerActData.status != VALUE_SEVEN && boilerActData.status != VALUE_ELEVEN) {
            if (!boilerActData.hide_submit_btn) {
                boilerActData.show_fees_paid = true;
            }
        }
        if (boilerActData.payment_type == VALUE_ONE) {
            boilerActData.utitle = 'Fees Paid Challan Copy';
        } else {
            boilerActData.style = 'display: none;';
        }
        if (boilerActData.payment_type == VALUE_TWO) {
            boilerActData.show_dd_po_option = true;
            boilerActData.utitle = 'Demand Draft (DD)';
        }
        boilerActData.module_type = VALUE_THIRTYSEVEN;
        $('#popup_container').html(boilerActChallanTemplate(boilerActData));
        loadFB(VALUE_THIRTYSEVEN, boilerActData.fb_data);
        loadPH(VALUE_THIRTYSEVEN, boilerActData.boiler_id, boilerActData.ph_data);

        if (boilerActData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'boiler_act_upload_challan', boilerActData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'boiler_act_upload_challan', 'uc', 'radio');
            if (boilerActData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_boiler_act_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (boilerActData.challan != '') {
            $('#challan_container_for_boiler_act_upload_challan').hide();
            $('#challan_name_container_for_boiler_act_upload_challan').show();
            $('#challan_name_href_for_boiler_act_upload_challan').attr('href', ADMIN_BOILER_DOC_PATH + boilerActData.challan);
            $('#challan_name_for_boiler_act_upload_challan').html(boilerActData.challan);
        }
        if (boilerActData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_boiler_act_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_boiler_act_upload_challan').show();
            $('#fees_paid_challan_name_href_for_boiler_act_upload_challan').attr('href', 'documents/boileract/' + boilerActData.fees_paid_challan);
            $('#fees_paid_challan_name_for_boiler_act_upload_challan').html(boilerActData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_boiler_act_upload_challan').attr('onclick', 'BoilerAct.listview.removeFeesPaidChallan("' + boilerActData.boiler_id + '")');
        }
    },
    removeFeesPaidChallan: function (boilerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!boilerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'boileract/remove_fees_paid_challan',
            data: $.extend({}, {'boileract_id': boilerId}, getTokenData()),
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
                validationMessageShow('boiler-act-uc', textStatus.statusText);
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
                    validationMessageShow('boiler-act-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-boiler-act-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'boiler_act_upload_challan');
                $('#status_' + boilerId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-boiler-act-uc').html('');
        validationMessageHide();
        var boilerId = $('#boiler_act_id_for_boiler_act_upload_challan').val();
        if (!boilerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_boiler_act_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_boiler_act_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_boiler_act_upload_challan').focus();
                validationMessageShow('boiler-act-uc-fees_paid_challan_for_boiler_act_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_boiler_act_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_boiler_act_upload_challan').focus();
                validationMessageShow('boiler-act-uc-fees_paid_challan_for_boiler_act_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_boiler_act_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#boiler_act_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'boileract/upload_fees_paid_challan',
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
                validationMessageShow('boiler-act-uc', textStatus.statusText);
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
                    validationMessageShow('boiler-act-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + boilerId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (boilerId) {
        if (!boilerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#boiler_id_for_certificate').val(boilerId);
        $('#boiler_certificate_pdf_form').submit();
        $('#boiler_id_for_certificate').val('');
    },
    getQueryData: function (boilerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!boilerId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THIRTYSEVEN;
        templateData.module_id = boilerId;
        var btnObj = $('#query_btn_for_app_' + boilerId);
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
                tmpData.application_number = regNoRenderer(VALUE_THIRTYSEVEN, moduleData.boiler_id);
                tmpData.applicant_name = moduleData.owner_name;
                tmpData.title = 'Owner Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },

    uploadDocumentForBoilerAct: function (fileNo) {
        var that = this;
        if ($('#company_letter_head_for_boileract').val() != '') {
            var copyOfRegistration = checkValidationForDocument('company_letter_head_for_boileract', VALUE_ONE, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_of_challan_for_boileract').val() != '') {
            var copyOfRegistration = checkValidationForDocument('copy_of_challan_for_boileract', VALUE_ONE, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#pipe_line_deawing_for_boileract').val() != '') {
            var copyOfRegistration = checkValidationForDocument('pipe_line_deawing_for_boileract', VALUE_ONE, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#ibr_document_for_boileract').val() != '') {
            var copyOfRegistration = checkValidationForDocument('ibr_document_for_boileract', VALUE_ONE, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#sign_of_applicant_for_boileract').val() != '') {
            var copyOfRegistration = checkValidationForDocument('sign_of_applicant_for_boileract', VALUE_TWO, 'boiler-act');
            if (copyOfRegistration == false) {
                return false;
            }
        }



        $('.spinner_container_for_boileract_' + fileNo).hide();
        $('.spinner_name_container_for_boileract_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var boilerId = $('#boiler_id').val();
        var formData = new FormData($('#boiler_act_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("boiler_id", boilerId);
        $.ajax({
            type: 'POST',
            url: 'boileract/upload_boileract_document',
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
                $('.spinner_container_for_boileract_' + fileNo).show();
                $('.spinner_name_container_for_boileract_' + fileNo).hide();
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
                    $('.spinner_container_for_boileract_' + fileNo).show();
                    $('.spinner_name_container_for_boileract_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_boileract_' + fileNo).hide();
                $('.spinner_name_container_for_boileract_' + fileNo).show();
                $('#boiler_id').val(parseData.boiler_id);
                var boileractData = parseData.boiler_act_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('company_letter_head_container_for_boileract', 'company_letter_head_name_image_for_boileract', 'company_letter_head_name_container_for_boileract',
                            'company_letter_head_download', 'company_letter_head', boileractData.company_letter_head, parseData.boiler_id, VALUE_ONE);
                }

                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('copy_of_challan_container_for_boileract', 'copy_of_challan_name_image_for_boileract', 'copy_of_challan_name_container_for_boileract',
                            'copy_of_challan_download', 'copy_of_challan', boileractData.copy_of_challan, parseData.boiler_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('pipe_line_deawing_container_for_boileract', 'pipe_line_deawing_name_image_for_boileract', 'pipe_line_deawing_name_container_for_boileract',
                            'pipe_line_deawing_download', 'pipe_line_deawing', boileractData.pipe_line_deawing, parseData.boiler_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('ibr_document_container_for_boileract', 'ibr_document_name_image_for_boileract', 'ibr_document_name_container_for_boileract',
                            'ibr_document_download', 'ibr_document', boileractData.ibr_document, parseData.boiler_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('sign_of_applicant_container_for_boileract', 'sign_of_applicant_name_image_for_boileract', 'sign_of_applicant_name_container_for_boileract',
                            'sign_of_applicant_download', 'sign_of_applicant', boileractData.sign_of_applicant, parseData.boiler_id, VALUE_FIVE);
                }



            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/boileract/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/boileract/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'BoilerAct.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
