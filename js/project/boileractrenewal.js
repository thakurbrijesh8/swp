var boilerActRenewalListTemplate = Handlebars.compile($('#boiler_act_renewal_list_template').html());
var boilerActRenewalTableTemplate = Handlebars.compile($('#boiler_act_renewal_table_template').html());
var boilerActRenewalActionTemplate = Handlebars.compile($('#boiler_act_renewal_action_template').html());
var boilerActRenewalFormTemplate = Handlebars.compile($('#boiler_act_renewal_form_template').html());
var boilerActRenewalViewTemplate = Handlebars.compile($('#boiler_act_renewal_view_template').html());
var boilerActRenewalChallanTemplate = Handlebars.compile($('#boiler_act_renewal_upload_challan_template').html());

var BoilerActRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
BoilerActRenewal.Router = Backbone.Router.extend({
    routes: {
        'boileract_renewal': 'renderList',
        'boileract_renewal_form': 'renderListForForm',
        'edit_boileract_renewal_form': 'renderList',
        'view_boileract_renewal_form': 'renderList',
    },
    renderList: function () {
        BoilerActRenewal.listview.listPage();
    },
    renderListForForm: function () {
        BoilerActRenewal.listview.listPageBoilerActRenewalForm();
    }
});
BoilerActRenewal.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_factory');
        addClass('menu_boiler_act_renewal', 'active');
        BoilerActRenewal.router.navigate('boileract_renewal');
        var templateData = {};
        this.$el.html(boilerActRenewalListTemplate(templateData));
        this.loadBoilerActRenewalData(sDistrict, sStatus);

    },
    listPageBoilerActRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_factory');
        addClass('menu_boiler_act_renewal', 'active');
        this.$el.html(boilerActRenewalListTemplate);
        this.newBoilerActRenewalForm(false, {});
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
        return boilerActRenewalActionTemplate(rowData);
    },
    loadBoilerActRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTYFOUR, data);
        };
        var that = this;
        BoilerActRenewal.router.navigate('boileract_renewal');
        $('#boiler_act_renewal_form_and_datatable_container').html(boilerActRenewalTableTemplate(searchData));
        boilerActRenewalDataTable = $('#boiler_act_renewal_datatable').DataTable({
            ajax: {url: 'boileract_renewal/get_boiler_act_renewal_data', dataSrc: "boiler_act_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'boiler_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'owner_name', 'class': 'text-center'},
                {data: 'situation_of_boiler', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'boiler_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'boiler_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}

            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#boiler_act_renewal_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = boilerActRenewalDataTable.row(tr);

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
    askForNewBoilerActRenewalForm: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        that.newBoilerActRenewalForm(false, {});
    },
    newBoilerActRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        tempProductCnt = 1;
        tempDirectorCnt = 1;
        tempEmployeeCnt = 1;

        var that = this;
        if (isEdit) {
            var formData = parseData.boiler_act_renewal_data;
            BoilerActRenewal.router.navigate('edit_boileract_renewal_form');
        } else {
            var formData = {};
            BoilerActRenewal.router.navigate('boileract_renewal_form');
        }

        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.boilerActRenewal_data = parseData.boiler_act_renewal_data;


        $('#boiler_act_renewal_form_and_datatable_container').html(boilerActRenewalFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);

            if (formData.company_letter_head != '') {
                that.showDocument('company_letter_head_container_for_boileract_renewal', 'company_letter_head_name_image_for_boileract_renewal', 'company_letter_head_name_container_for_boileract_renewal',
                        'company_letter_head_download', 'company_letter_head', formData.company_letter_head, formData.boiler_renewal_id, VALUE_ONE);
            }
            if (formData.copy_of_challan != '') {
                that.showDocument('copy_of_challan_container_for_boileract_renewal', 'copy_of_challan_name_image_for_boileract_renewal', 'copy_of_challan_name_container_for_boileract_renewal',
                        'copy_of_challan_download', 'copy_of_challan', formData.copy_of_challan, formData.boiler_renewal_id, VALUE_TWO);
            }
            if (formData.last_boiler_license != '') {
                that.showDocument('last_boiler_license_container_for_boileract_renewal', 'last_boiler_license_name_image_for_boileract_renewal', 'last_boiler_license_name_container_for_boileract_renewal',
                        'last_boiler_license_download', 'last_boiler_license', formData.last_boiler_license, formData.boiler_renewal_id, VALUE_THREE);
            }
            if (formData.sign_of_applicant != '') {
                that.showDocument('sign_of_applicant_container_for_boileract_renewal', 'sign_of_applicant_name_image_for_boileract_renewal', 'sign_of_applicant_name_container_for_boileract_renewal',
                        'sign_of_applicant_download', 'sign_of_applicant', formData.sign_of_applicant, formData.boiler_renewal_id, VALUE_FOUR);
            }
        }

        generateSelect2();
        datePicker();
        $('#boiler_act_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitBoilerActRenewal($('#submit_btn_for_boiler_act_renewal'));
            }
        });
    },
    editOrViewBoilerActRenewal: function (btnObj, boilerActRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!boilerActRenewalId) {
            showError(invalidIdValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnClick = btnObj.attr("onclick");
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'boileract_renewal/get_boiler_act_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'boiler_renewal_id': boilerActRenewalId}, getTokenData()),
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
                // var boilerActRenewalData = parseData.boiler_act_renewal_data;
                // boilerActRenewalData.hydraulically_tested_on = dateTo_DD_MM_YYYY(boilerActRenewalData.hydraulically_tested_on);
                if (isEdit) {
                    that.newBoilerActRenewalForm(isEdit, parseData);
                } else {
                    that.viewBoilerActRenewalForm(parseData);
                }
            }
        });
    },
    viewBoilerActRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        //templateData.boilerActRenewal_data = boilerActRenewalData;
        var formData = parseData.boiler_act_renewal_data;
        BoilerActRenewal.router.navigate('view_boileract_renewal_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#boiler_act_renewal_form_and_datatable_container').html(boilerActRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.company_letter_head != '') {
            that.showDocument('company_letter_head_container_for_boileract_renewal', 'company_letter_head_name_image_for_boileract_renewal', 'company_letter_head_name_container_for_boileract_renewal',
                    'company_letter_head_download', 'company_letter_head', formData.company_letter_head);
        }
        if (formData.copy_of_challan != '') {
            that.showDocument('copy_of_challan_container_for_boileract_renewal', 'copy_of_challan_name_image_for_boileract_renewal', 'copy_of_challan_name_container_for_boileract_renewal',
                    'copy_of_challan_download', 'copy_of_challan', formData.copy_of_challan);
        }
        if (formData.last_boiler_license != '') {
            that.showDocument('last_boiler_license_container_for_boileract_renewal', 'last_boiler_license_name_image_for_boileract_renewal', 'last_boiler_license_name_container_for_boileract_renewal',
                    'last_boiler_license_download', 'last_boiler_license', formData.last_boiler_license);
        }

        if (formData.sign_of_applicant != '') {
            that.showDocument('sign_of_applicant_container_for_boileract_renewal', 'sign_of_applicant_name_image_for_boileract_renewal', 'sign_of_applicant_name_container_for_boileract_renewal',
                    'sign_of_applicant_download', 'sign_of_applicant', formData.sign_of_applicant);
        }
    },
    checkValidationForBoilerActRenewal: function (boilerActRenewalData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!boilerActRenewalData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!boilerActRenewalData.registration_number) {
            return getBasicMessageAndFieldJSONArray('registration_number', licenseNumberValidationMessage);
        }
        if (!boilerActRenewalData.owner_name) {
            return getBasicMessageAndFieldJSONArray('owner_name', ownerNameValidationMessage);
        }
        if (!boilerActRenewalData.situation_of_boiler) {
            return getBasicMessageAndFieldJSONArray('situation_of_boiler', boilerSituationValidationMessage);
        }
        if (!boilerActRenewalData.boiler_type) {
            return getBasicMessageAndFieldJSONArray('boiler_type', boilerTypeValidationMessage);
        }

        if (!boilerActRenewalData.ut) {
            return getBasicMessageAndFieldJSONArray('ut', utValidationMessage);
        }
        if (!boilerActRenewalData.working_pressure) {
            return getBasicMessageAndFieldJSONArray('working_pressure', workingPressureValidationMessage);
        }
        if (!boilerActRenewalData.max_pressure) {
            return getBasicMessageAndFieldJSONArray('max_pressure', maxPressureValidationMessage);
        }
        if (!boilerActRenewalData.heating_surface_area) {
            return getBasicMessageAndFieldJSONArray('heating_surface_area', heatingSurfaceValidationMessage);
        }
        if (!boilerActRenewalData.length_of_pipes) {
            return getBasicMessageAndFieldJSONArray('length_of_pipes', lengthPipesValidationMessage);
        }
        if (!boilerActRenewalData.max_evaporation) {
            return getBasicMessageAndFieldJSONArray('max_evaporation', maxEvaporationValidationMessage);
        }
        if (!boilerActRenewalData.place_of_manufacture) {
            return getBasicMessageAndFieldJSONArray('place_of_manufacture', manufacturePlaceValidationMessage);
        }
        if (!boilerActRenewalData.year_of_manufacture) {
            return getBasicMessageAndFieldJSONArray('year_of_manufacture', manufactureYearValidationMessage);
        }
        if (!boilerActRenewalData.name_of_manufacture) {
            return getBasicMessageAndFieldJSONArray('name_of_manufacture', manufactureNameValidationMessage);
        }
        if (!boilerActRenewalData.manufacture_address) {
            return getBasicMessageAndFieldJSONArray('manufacture_address', manufactureAddressValidationMessage);
        }
        if (!boilerActRenewalData.hydraulically_tested_on) {
            return getBasicMessageAndFieldJSONArray('hydraulically_tested_on', hydrulicallyTestedOnValidationMessage);
        }
        if (!boilerActRenewalData.hydraulically_tested_to) {
            return getBasicMessageAndFieldJSONArray('hydraulically_tested_to', hydrulicallyTestedValidationMessage);
        }
        if (!boilerActRenewalData.repairs && boilerActRenewalData.repairs != 0) {
            return getBasicMessageAndFieldJSONArray('repairs', repairsValidationMessage);
        }


        return '';
    },
    askForBoilerActRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BoilerActRenewal.listview.submitBoilerActRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitBoilerActRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var boilerActRenewalData = $('#boiler_act_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForBoilerActRenewal(boilerActRenewalData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('boiler-act-renewal-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#company_letter_head_container_for_boileract_renewal').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('company_letter_head_for_boileract_renewal', VALUE_ONE, 'boiler-act-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_of_challan_container_for_boileract_renewal').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('copy_of_challan_for_boileract_renewal', VALUE_ONE, 'boiler-act-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#last_boiler_license_container_for_boileract_renewal').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('last_boiler_license_for_boileract_renewal', VALUE_ONE, 'boiler-act-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if ($('#sign_of_applicant_container_for_boileract_renewal').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('sign_of_applicant_for_boileract_renewal', VALUE_TWO, 'boiler-act-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }


        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_bolier') : $('#submit_btn_for_bolier');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var boilerActRenewalData = new FormData($('#boiler_act_renewal_form')[0]);
        boilerActRenewalData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        boilerActRenewalData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'boileract_renewal/submit_boiler_act_renewal',
            data: boilerActRenewalData,
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
                validationMessageShow('boiler-act-renewal', textStatus.statusText);
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
                    validationMessageShow('boiler-act-renewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                BOCW.router.navigate('boileract_renewal', {'trigger': true});
            }
        });
    },
    askForRemove: function (boilerRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!boilerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BoilerActRenewal.listview.removeDocument(\'' + boilerRenewalId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },

    removeDocument: function (boilerRenewalId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!boilerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_boileract_renewal_' + docType).hide();
        $('.spinner_name_container_for_boileract_renewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'boileract_renewal/remove_document',
            data: $.extend({}, {'boiler_renewal_id': boilerRenewalId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_boileract_renewal_' + docType).hide();
                $('.spinner_name_container_for_boileract_renewal_' + docType).show();
                validationMessageShow('boiler-act-renewal', textStatus.statusText);
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
                    validationMessageShow('boiler-act-renewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_boileract_renewal_' + docType).show();
                $('.spinner_name_container_for_boileract_renewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('company_letter_head_name_container_for_boileract_renewal', 'company_letter_head_name_image_for_boileract_renewal', 'company_letter_head_container_for_boileract_renewal', 'company_letter_head_for_boileract_renewal');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('copy_of_challan_name_container_for_boileract_renewal', 'copy_of_challan_name_image_for_boileract_renewal', 'copy_of_challan_container_for_boileract_renewal', 'copy_of_challan_for_boileract_renewal');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('last_boiler_license_name_container_for_boileract_renewal', 'last_boiler_license_name_image_for_boileract_renewal', 'last_boiler_license_container_for_boileract_renewal', 'last_boiler_license_for_boileract_renewal');
                }

                if (docType == VALUE_FOUR) {
                    removeDocumentValue('sign_of_applicant_name_container_for_boileract_renewal', 'sign_of_applicant_name_image_for_boileract_renewal', 'sign_of_applicant_container_for_boileract_renewal', 'sign_of_applicant_for_boileract_renewal');
                }


            }
        });
    },
    generateForm1: function (boilerRenewalId) {
        if (!boilerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#boileract_renewal_id_for_boileract_renewal_form1').val(boilerRenewalId);
        $('#boileract_renewal_form1_pdf_form').submit();
        $('#boileract_renewal_id_for_boileract_renewal_form1').val('');
    },
    downloadUploadChallan: function (boilerRenewalId) {
        if (!boilerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + boilerRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'boileract_renewal/get_boileract_renewal_data_by_boileract_renewal_id',
            type: 'post',
            data: $.extend({}, {'boileract_renewal_id': boilerRenewalId}, getTokenData()),
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
                var boilerActRenewalData = parseData.boiler_act_renewal_data;
                that.showChallan(boilerActRenewalData);
            }
        });
    },
    showChallan: function (boilerActRenewalData) {
        showPopup();
        if (boilerActRenewalData.status != VALUE_FIVE && boilerActRenewalData.status != VALUE_SIX && boilerActRenewalData.status != VALUE_SEVEN) {
            if (!boilerActRenewalData.hide_submit_btn) {
                boilerActRenewalData.show_fees_paid = true;
            }
        }
        if (boilerActRenewalData.payment_type == VALUE_ONE) {
            boilerActRenewalData.utitle = 'Fees Paid Challan Copy';
        } else {
            boilerActRenewalData.style = 'display: none;';
        }
        if (boilerActRenewalData.payment_type == VALUE_TWO) {
            boilerActRenewalData.show_dd_po_option = true;
            boilerActRenewalData.utitle = 'Demand Draft (DD)';
        }
        boilerActRenewalData.module_type = VALUE_FOURTYFOUR;
        $('#popup_container').html(boilerActRenewalChallanTemplate(boilerActRenewalData));
        loadFB(VALUE_FOURTYFOUR, boilerActRenewalData.fb_data);
        loadPH(VALUE_FOURTYFOUR, boilerActRenewalData.boiler_renewal_id, boilerActRenewalData.ph_data);

        if (boilerActRenewalData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'boiler_act_renewal_upload_challan', boilerActRenewalData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'boiler_act_renewal_upload_challan', 'uc', 'radio');
            if (boilerActRenewalData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_boiler_act_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (boilerActRenewalData.challan != '') {
            $('#challan_container_for_boiler_act_renewal_upload_challan').hide();
            $('#challan_name_container_for_boiler_act_renewal_upload_challan').show();
            $('#challan_name_href_for_boiler_act_renewal_upload_challan').attr('href', ADMIN_BOILER_DOC_PATH + boilerActRenewalData.challan);
            $('#challan_name_for_boiler_act_renewal_upload_challan').html(boilerActRenewalData.challan);
        }
        if (boilerActRenewalData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_boiler_act_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_boiler_act_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_boiler_act_renewal_upload_challan').attr('href', 'documents/boileract/' + boilerActRenewalData.fees_paid_challan);
            $('#fees_paid_challan_name_for_boiler_act_renewal_upload_challan').html(boilerActRenewalData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_boiler_act_renewal_upload_challan').attr('onclick', 'BoilerActRenewal.listview.removeFeesPaidChallan("' + boilerActRenewalData.boiler_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (boilerRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!boilerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'boileract_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'boileract_renewal_id': boilerRenewalId}, getTokenData()),
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
                removeDocument('fees_paid_challan', 'boiler_act_renewal_upload_challan');
                $('#status_' + boilerRenewalId).html(appStatusArray[VALUE_THREE]);
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
        var boilerRenewalId = $('#boiler_act_renewal_id_for_boiler_act_renewal_upload_challan').val();
        if (!boilerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_boiler_act_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_boiler_act_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_boiler_act_renewal_upload_challan').focus();
                validationMessageShow('boiler-act-uc-fees_paid_challan_for_boiler_act_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_boiler_act_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_boiler_act_renewal_upload_challan').focus();
                validationMessageShow('boiler-act-uc-fees_paid_challan_for_boiler_act_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_boiler_act_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#boiler_act_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'boileract_renewal/upload_fees_paid_challan',
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
                $('#status_' + boilerRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (boilerRenewalId) {
        if (!boilerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#boiler_renewal_id_for_certificate').val(boilerRenewalId);
        $('#boiler_renewal_certificate_pdf_form').submit();
        $('#boiler_renewal_id_for_certificate').val('');
    },
    getQueryData: function (boilerRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!boilerRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTYFOUR;
        templateData.module_id = boilerRenewalId;
        var btnObj = $('#query_btn_for_app_' + boilerRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOURTYFOUR, moduleData.boiler_renewal_id);
                tmpData.applicant_name = moduleData.owner_name;
                tmpData.title = 'Owner Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getBoilerActData: function (btnObj) {
        var license_number = $('#registration_number').val();
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        // if (!dealerRenewalId) {
        //     showError(invalidUserValidationMessage);
        //     return;
        // }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'boileract_renewal/get_boiler_act_data_by_id',
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
                boilerActData = parseData.boiler_act_data;
                if (boilerActData) {
                    $('#boiler_id').val(boilerActData.boiler_id);
                    $('#owner_name').val(boilerActData.owner_name);
                    $('#situation_of_boiler').val(boilerActData.situation_of_boiler);
                    $('#boiler_type').val(boilerActData.boiler_type);
                    $('#district').val(boilerActData.district);
                    $('#ut').val(boilerActData.ut);
                    $('#working_pressure').val(boilerActData.working_pressure);
                    $('#max_pressure').val(boilerActData.max_pressure);
                    $('#heating_surface_area').val(boilerActData.heating_surface_area);
                    $('#length_of_pipes').val(boilerActData.length_of_pipes);
                    $('#max_evaporation').val(boilerActData.max_evaporation);
                    $('#place_of_manufacture').val(boilerActData.place_of_manufacture);
                    $('#year_of_manufacture').val(boilerActData.year_of_manufacture);
                    $('#name_of_manufacture').val(boilerActData.name_of_manufacture);
                    $('#manufacture_address').val(boilerActData.manufacture_address);
                    var hydraulically_tested_on_date = dateTo_DD_MM_YYYY(boilerActData.hydraulically_tested_on);
                    $('#hydraulically_tested_on').val(hydraulically_tested_on_date);
                    $('#hydraulically_tested_to').val(boilerActData.hydraulically_tested_to);
                    $('#repairs').val(boilerActData.repairs);
                    $('#remarks').val(boilerActData.remarks);
                }
            }
        });
    },
    uploadDocumentForBoilerActRenewal: function (fileNo) {
        var that = this;
        if ($('#company_letter_head_for_boileract_renewal').val() != '') {
            var copyOfRegistration = checkValidationForDocument('company_letter_head_for_boileract_renewal', VALUE_ONE, 'boiler-act-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_of_challan_for_boileract_renewal').val() != '') {
            var copyOfRegistration = checkValidationForDocument('copy_of_challan_for_boileract_renewal', VALUE_ONE, 'boiler-act-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#last_boiler_license_for_boileract_renewal').val() != '') {
            var copyOfRegistration = checkValidationForDocument('last_boiler_license_for_boileract_renewal', VALUE_ONE, 'boiler-act-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if ($('#sign_of_applicant_for_boileract_renewal').val() != '') {
            var copyOfRegistration = checkValidationForDocument('sign_of_applicant_for_boileract_renewal', VALUE_TWO, 'boiler-act-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }



        $('.spinner_container_for_boileract_renewal_' + fileNo).hide();
        $('.spinner_name_container_for_boileract_renewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var boilerId = $('#boiler_renewal_id').val();
        var formData = new FormData($('#boiler_act_renewal_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("boiler_renewal_id", boilerId);
        $.ajax({
            type: 'POST',
            url: 'boileract_renewal/upload_boileract_renewal_document',
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
                $('.spinner_container_for_boileract_renewal_' + fileNo).show();
                $('.spinner_name_container_for_boileract_renewal_' + fileNo).hide();
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
                    $('.spinner_container_for_boileract_renewal_' + fileNo).show();
                    $('.spinner_name_container_for_boileract_renewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_boileract_renewal_' + fileNo).hide();
                $('.spinner_name_container_for_boileract_renewal_' + fileNo).show();
                $('#boiler_renewal_id').val(parseData.boiler_renewal_id);
                var boilerActRenewalData = parseData.boiler_act_renewal_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('company_letter_head_container_for_boileract_renewal', 'company_letter_head_name_image_for_boileract_renewal', 'company_letter_head_name_container_for_boileract_renewal',
                            'company_letter_head_download', 'company_letter_head', boilerActRenewalData.company_letter_head, parseData.boiler_renewal_id, VALUE_ONE);
                }

                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('copy_of_challan_container_for_boileract_renewal', 'copy_of_challan_name_image_for_boileract_renewal', 'copy_of_challan_name_container_for_boileract_renewal',
                            'copy_of_challan_download', 'copy_of_challan', boilerActRenewalData.copy_of_challan, parseData.boiler_renewal_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('last_boiler_license_container_for_boileract_renewal', 'last_boiler_license_name_image_for_boileract_renewal', 'last_boiler_license_name_container_for_boileract_renewal',
                            'last_boiler_license_download', 'last_boiler_license', boilerActRenewalData.last_boiler_license, parseData.boiler_renewal_id, VALUE_THREE);
                }

                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('sign_of_applicant_container_for_boileract_renewal', 'sign_of_applicant_name_image_for_boileract_renewal', 'sign_of_applicant_name_container_for_boileract_renewal',
                            'sign_of_applicant_download', 'sign_of_applicant', boilerActRenewalData.sign_of_applicant, parseData.boiler_renewal_id, VALUE_FOUR);
                }



            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/boileract/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/boileract/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'BoilerActRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
