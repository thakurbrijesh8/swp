var buildingPlanListTemplate = Handlebars.compile($('#building_plan_list_template').html());
var buildingPlanTableTemplate = Handlebars.compile($('#building_plan_table_template').html());
var buildingPlanActionTemplate = Handlebars.compile($('#building_plan_action_template').html());
var buildingPlanFormTemplate = Handlebars.compile($('#building_plan_form_template').html());
var buildingPlanViewTemplate = Handlebars.compile($('#building_plan_view_template').html());
var buildingPlanUploadChallanTemplate = Handlebars.compile($('#building_plan_upload_challan_template').html());


var BuildingPlan = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
BuildingPlan.Router = Backbone.Router.extend({
    routes: {
        'buildingplan': 'renderList',
        'buildingplan_form': 'renderListForForm',
        'edit_buildingplan_form': 'renderList',
        'view_buildingplan_form': 'renderList',
    },
    renderList: function () {
        BuildingPlan.listview.listPage();
    },
    renderListForForm: function () {
        BuildingPlan.listview.listPageBuildingPlanForm();
    }
});
BuildingPlan.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_factory');
        addClass('menu_building_plan', 'active');
        BuildingPlan.router.navigate('buildingplan');
        var templateData = {};
        this.$el.html(buildingPlanListTemplate(templateData));
        this.loadBuildingPlanData(sDistrict, sStatus);

    },
    listPageBuildingPlanForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_building_plan');
        this.$el.html(buildingPlanListTemplate);
        this.newBuildingPlanForm(false, {});
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
                rowData.ADMIN_BUILD_DOC_PATH = ADMIN_BUILD_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return buildingPlanActionTemplate(rowData);
    },
    loadBuildingPlanData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTYSIX, data);
        };
        var that = this;
        BuildingPlan.router.navigate('buildingplan');
        $('#building_plan_form_and_datatable_container').html(buildingPlanTableTemplate(searchData));
        buildingPlanDataTable = $('#building_plan_datatable').DataTable({
            ajax: {url: 'buildingplan/get_building_plan_data', dataSrc: "building_plan_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'buildingplan_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'applicant_name', 'class': 'text-center'},
                {data: 'factory_name', 'class': 'text-center'},
                {data: 'factory_building', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                //{data: 'status', 'class': 'text-center', 'render': appStatusRenderer, 'orderable': false},
                {data: 'buildingplan_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'buildingplan_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
                // {
                //     "orderable": false,
                //     "data": 'buildingplan_id',
                //     "render": buildingPlanActionRenderer,
                //     'class': 'text-center'
                // }
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#building_plan_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = buildingPlanDataTable.row(tr);

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
    askForNewBuildingPlanForm: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        that.newBuildingPlanForm(false, {});
    },
    newBuildingPlanForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        tempProductCnt = 1;
        tempDirectorCnt = 1;
        tempEmployeeCnt = 1;

        var that = this;
        if (isEdit) {
            var formData = parseData.building_plan_data;
            BuildingPlan.router.navigate('edit_buildingplan_form');
        } else {
            var formData = {};
            BuildingPlan.router.navigate('buildingplan_form');
        }

        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.buildingPlan_data = parseData.building_plan_data;


        $('#building_plan_form_and_datatable_container').html(buildingPlanFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');

        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);

            if (formData.building_drawing_plans != '') {
                that.showDocument('building_drawing_plans_container_for_buildingplan', 'building_drawing_plans_name_image_for_buildingplan', 'building_drawing_plans_name_container_for_buildingplan',
                        'building_drawing_plans_download', 'building_drawing_plans', formData.building_drawing_plans, formData.buildingplan_id, VALUE_ONE);
            }
            if (formData.provisional_registration != '') {
                that.showDocument('provisional_registration_container_for_buildingplan', 'provisional_registration_name_image_for_buildingplan', 'provisional_registration_name_container_for_buildingplan',
                        'provisional_registration_download', 'provisional_registration', formData.provisional_registration, formData.buildingplan_id, VALUE_TWO);
            }
            if (formData.project_report != '') {
                that.showDocument('project_report_container_for_buildingplan', 'project_report_name_image_for_buildingplan', 'project_report_name_container_for_buildingplan',
                        'project_report_download', 'project_report', formData.project_report, formData.buildingplan_id, VALUE_THREE);
            }
            if (formData.mode_of_storage != '') {
                that.showDocument('mode_of_storage_container_for_buildingplan', 'mode_of_storage_name_image_for_buildingplan', 'mode_of_storage_name_container_for_buildingplan',
                        'mode_of_storage_download', 'mode_of_storage', formData.mode_of_storage, formData.buildingplan_id, VALUE_FOUR);
            }
            if (formData.drawing_of_treatment_plant != '') {
                that.showDocument('drawing_of_treatment_plant_container_for_buildingplan', 'drawing_of_treatment_plant_name_image_for_buildingplan', 'drawing_of_treatment_plant_name_container_for_buildingplan',
                        'drawing_of_treatment_plant_download', 'drawing_of_treatment_plant', formData.drawing_of_treatment_plant, formData.buildingplan_id, VALUE_FIVE);
            }
            if (formData.machinery_layout != '') {
                that.showDocument('machinery_layout_container_for_buildingplan', 'machinery_layout_name_image_for_buildingplan', 'machinery_layout_name_container_for_buildingplan',
                        'machinery_layout_download', 'machinery_layout', formData.machinery_layout, formData.buildingplan_id, VALUE_SIX);
            }
            if (formData.questionnaire_copy != '') {
                that.showDocument('questionnaire_copy_container_for_buildingplan', 'questionnaire_copy_name_image_for_buildingplan', 'questionnaire_copy_name_container_for_buildingplan',
                        'questionnaire_copy_download', 'questionnaire_copy', formData.questionnaire_copy, formData.buildingplan_id, VALUE_SEVEN);
            }
            if (formData.sign_of_applicant != '') {
                that.showDocument('sign_of_applicant_container_for_buildingplan', 'sign_of_applicant_name_image_for_buildingplan', 'sign_of_applicant_name_container_for_buildingplan',
                        'sign_of_applicant_download', 'sign_of_applicant', formData.sign_of_applicant, formData.buildingplan_id, VALUE_EIGHT);
            }
        }
        generateSelect2();
        datePicker();
        $('#building_plan_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitBuildingPlan($('#submit_btn_for_building_plan'));
            }
        });
    },
    editOrViewBuildingPlan: function (btnObj, buildingPlanId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!buildingPlanId) {
            showError(invalidIdValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnClick = btnObj.attr("onclick");
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'buildingplan/get_building_plan_data_by_id',
            type: 'post',
            data: $.extend({}, {'buildingplan_id': buildingPlanId}, getTokenData()),
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
                //var buildingPlanData = parseData.building_plan_data;
                // buildingPlanData.date_of_approval = dateTo_DD_MM_YYYY(buildingPlanData.date_of_approval);
                if (isEdit) {
                    that.newBuildingPlanForm(isEdit, parseData);
                } else {
                    that.viewBuildingPlanForm(parseData);
                }
            }
        });
    },
    viewBuildingPlanForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var formData = parseData.building_plan_data;
        BuildingPlan.router.navigate('view_buildingplan_form');
        //templateData.buildingPlan_data = buildingPlanData;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#building_plan_form_and_datatable_container').html(buildingPlanViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.building_drawing_plans != '') {
            that.showDocument('building_drawing_plans_container_for_buildingplan', 'building_drawing_plans_name_image_for_buildingplan', 'building_drawing_plans_name_container_for_buildingplan',
                    'building_drawing_plans_download', 'building_drawing_plans', formData.building_drawing_plans);
        }
        if (formData.provisional_registration != '') {
            that.showDocument('provisional_registration_container_for_buildingplan', 'provisional_registration_name_image_for_buildingplan', 'provisional_registration_name_container_for_buildingplan',
                    'provisional_registration_download', 'provisional_registration', formData.provisional_registration);
        }
        if (formData.project_report != '') {
            that.showDocument('project_report_container_for_buildingplan', 'project_report_name_image_for_buildingplan', 'project_report_name_container_for_buildingplan',
                    'project_report_download', 'project_report', formData.project_report);
        }
        if (formData.mode_of_storage != '') {
            that.showDocument('mode_of_storage_container_for_buildingplan', 'mode_of_storage_name_image_for_buildingplan', 'mode_of_storage_name_container_for_buildingplan',
                    'mode_of_storage_download', 'mode_of_storage', formData.mode_of_storage);
        }
        if (formData.drawing_of_treatment_plant != '') {
            that.showDocument('drawing_of_treatment_plant_container_for_buildingplan', 'drawing_of_treatment_plant_name_image_for_buildingplan', 'drawing_of_treatment_plant_name_container_for_buildingplan',
                    'drawing_of_treatment_plant_download', 'drawing_of_treatment_plant', formData.drawing_of_treatment_plant);
        }
        if (formData.machinery_layout != '') {
            that.showDocument('machinery_layout_container_for_buildingplan', 'machinery_layout_name_image_for_buildingplan', 'machinery_layout_name_container_for_buildingplan',
                    'machinery_layout_download', 'machinery_layout', formData.machinery_layout);
        }
        if (formData.questionnaire_copy != '') {
            that.showDocument('questionnaire_copy_container_for_buildingplan', 'questionnaire_copy_name_image_for_buildingplan', 'questionnaire_copy_name_container_for_buildingplan',
                    'questionnaire_copy_download', 'questionnaire_copy', formData.questionnaire_copy);
        }
        if (formData.sign_of_applicant != '') {
            that.showDocument('sign_of_applicant_container_for_buildingplan', 'sign_of_applicant_name_image_for_buildingplan', 'sign_of_applicant_name_container_for_buildingplan',
                    'sign_of_applicant_download', 'sign_of_applicant', formData.sign_of_applicant);
        }
    },
    checkValidationForBuildingPlan: function (buildingPlanData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!buildingPlanData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!buildingPlanData.applicant_name) {
            return getBasicMessageAndFieldJSONArray('applicant_name', applicantNameValidationMessage);
        }
        if (!buildingPlanData.applicant_phoneno) {
            return getBasicMessageAndFieldJSONArray('applicant_phoneno', applicantPhnoValidationMessage);
        }
        if (!buildingPlanData.email) {
            return getBasicMessageAndFieldJSONArray('email', applicantEmailValidationMessage);
        }
        if (!buildingPlanData.applicant_address) {
            return getBasicMessageAndFieldJSONArray('applicant_address', factoryAddressValidationMessage);
        }
        if (!buildingPlanData.factory_name) {
            return getBasicMessageAndFieldJSONArray('factory_name', factoryNameValidationMessage);
        }
        if (!buildingPlanData.factory_building) {
            return getBasicMessageAndFieldJSONArray('factory_building', factoryBuildingValidationMessage);
        }
        if (!buildingPlanData.factory_streetno) {
            return getBasicMessageAndFieldJSONArray('factory_streetno', factorySectorValidationMessage);
        }
        if (!buildingPlanData.factory_city) {
            return getBasicMessageAndFieldJSONArray('factory_city', factoryCityValidationMessage);
        }
        if (!buildingPlanData.factory_pincode) {
            return getBasicMessageAndFieldJSONArray('factory_pincode', factoryPincodeValidationMessage);
        }
        if (!buildingPlanData.factory_district) {
            return getBasicMessageAndFieldJSONArray('factory_district', factoryDistrictValidationMessage);
        }
        if (!buildingPlanData.factory_town) {
            return getBasicMessageAndFieldJSONArray('factory_town', factoryTownValidationMessage);
        }
        if (!buildingPlanData.nearest_police_station) {
            return getBasicMessageAndFieldJSONArray('nearest_police_station', policeStationValidationMessage);
        }
        if (!buildingPlanData.nrearest_railway_station) {
            return getBasicMessageAndFieldJSONArray('nrearest_railway_station', railwayStationValidationMessage);
        }
        if (!buildingPlanData.particulars_of_plant) {
            return getBasicMessageAndFieldJSONArray('particulars_of_plant', planValidationMessage);
        }

        return '';
    },
    askForSubmitBuildingPlan: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BuildingPlan.listview.submitBuildingPlan(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitBuildingPlan: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var buildingPlanData = $('#building_plan_form').serializeFormJSON();
        var validationData = that.checkValidationForBuildingPlan(buildingPlanData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('building-plan-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#building_drawing_plans_container_for_buildingplan').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('building_drawing_plans_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#provisional_registration_container_for_buildingplan').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('provisional_registration_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#project_report_container_for_buildingplan').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('project_report_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#mode_of_storage_container_for_buildingplan').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('mode_of_storage_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#drawing_of_treatment_plant_container_for_buildingplan').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('drawing_of_treatment_plant_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#machinery_layout_container_for_buildingplan').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('machinery_layout_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#questionnaire_copy_container_for_buildingplan').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('questionnaire_copy_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#sign_of_applicant_container_for_buildingplan').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('sign_of_applicant_for_buildingplan', VALUE_TWO, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_buildingplan') : $('#submit_btn_for_buildingplan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var buildingPlanData = new FormData($('#building_plan_form')[0]);
        buildingPlanData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        buildingPlanData.append("module_type", moduleType);

        $.ajax({
            type: 'POST',
            url: 'buildingplan/submit_building_plan',
            data: buildingPlanData,
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
                validationMessageShow('buildingplan', textStatus.statusText);
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
                    validationMessageShow('buildingplan', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                BuildingPlan.router.navigate('buildingplan', {'trigger': true});
            }
        });
    },
    askForRemove: function (buildingplanId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!buildingplanId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BuildingPlan.listview.removeDocument(\'' + buildingplanId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (buildingplanId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!buildingplanId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_buildingplan_' + docType).hide();
        $('.spinner_name_container_for_buildingplan_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'buildingplan/remove_document',
            data: $.extend({}, {'buildingplan_id': buildingplanId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_buildingplan_' + docType).hide();
                $('.spinner_name_container_for_buildingplan_' + docType).show();
                validationMessageShow('building-plan', textStatus.statusText);
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
                    validationMessageShow('building-plan', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_buildingplan_' + docType).show();
                $('.spinner_name_container_for_buildingplan_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('building_drawing_plans_name_container_for_buildingplan', 'building_drawing_plans_name_image_for_buildingplan', 'building_drawing_plans_container_for_buildingplan', 'building_drawing_plans_for_buildingplan');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('provisional_registration_name_container_for_buildingplan', 'provisional_registration_name_image_for_buildingplan', 'provisional_registration_container_for_buildingplan', 'provisional_registration_for_buildingplan');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('project_report_name_container_for_buildingplan', 'project_report_name_image_for_buildingplan', 'project_report_container_for_buildingplan', 'project_report_for_buildingplan');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('mode_of_storage_name_container_for_buildingplan', 'mode_of_storage_name_image_for_buildingplan', 'mode_of_storage_container_for_buildingplan', 'mode_of_storage_for_buildingplan');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('drawing_of_treatment_plant_name_container_for_buildingplan', 'drawing_of_treatment_plant_name_image_for_buildingplan', 'drawing_of_treatment_plant_container_for_buildingplan', 'drawing_of_treatment_plant_for_buildingplan');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('machinery_layout_name_container_for_buildingplan', 'machinery_layout_name_image_for_buildingplan', 'machinery_layout_container_for_buildingplan', 'machinery_layout_for_buildingplan');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('questionnaire_copy_name_container_for_buildingplan', 'questionnaire_copy_name_image_for_buildingplan', 'questionnaire_copy_container_for_buildingplan', 'questionnaire_copy_for_buildingplan');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('sign_of_applicant_name_container_for_buildingplan', 'sign_of_applicant_name_image_for_buildingplan', 'sign_of_applicant_container_for_buildingplan', 'sign_of_applicant_for_buildingplan');
                }

            }
        });
    },

    generateForm1: function (buildingplanId) {
        if (!buildingplanId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#buildingplan_id_for_buildingplan_form1').val(buildingplanId);
        $('#buildingplan_form1_pdf_form').submit();
        $('#buildingplan_id_for_buildingplan_form1').val('');
    },
    downloadUploadChallan: function (buildingplanId) {
        if (!buildingplanId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + buildingplanId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'buildingplan/get_buildingplan_data_by_buildingplan_id',
            type: 'post',
            data: $.extend({}, {'buildingplan_id': buildingplanId}, getTokenData()),
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
                var buildingPlanData = parseData.building_plan_data;
                that.showChallan(buildingPlanData);
            }
        });
    },
    showChallan: function (buildingPlanData) {
        showPopup();
        if (buildingPlanData.status != VALUE_FIVE && buildingPlanData.status != VALUE_SIX && buildingPlanData.status != VALUE_SEVEN) {
            if (!buildingPlanData.hide_submit_btn) {
                buildingPlanData.show_fees_paid = true;
            }
        }
        if (buildingPlanData.payment_type == VALUE_ONE) {
            buildingPlanData.utitle = 'Fees Paid Challan Copy';
        } else {
            buildingPlanData.style = 'display: none;';
        }
        if (buildingPlanData.payment_type == VALUE_TWO) {
            buildingPlanData.show_dd_po_option = true;
            buildingPlanData.utitle = 'Demand Draft (DD)';
        }
        buildingPlanData.module_type = VALUE_THIRTYSIX;
        $('#popup_container').html(buildingPlanUploadChallanTemplate(buildingPlanData));
        loadFB(VALUE_THIRTYSIX, buildingPlanData.fb_data);
        loadPH(VALUE_THIRTYSIX, buildingPlanData.buildingplan_id, buildingPlanData.ph_data);

        if (buildingPlanData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'building_plan_upload_challan', buildingPlanData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'building_plan_upload_challan', 'uc', 'radio');
            if (buildingPlanData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_building_plan_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (buildingPlanData.challan != '') {
            $('#challan_container_for_building_plan_upload_challan').hide();
            $('#challan_name_container_for_building_plan_upload_challan').show();
            $('#challan_name_href_for_building_plan_upload_challan').attr('href', ADMIN_BUILD_DOC_PATH + buildingPlanData.challan);
            $('#challan_name_for_building_plan_upload_challan').html(buildingPlanData.challan);
        }
        if (buildingPlanData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_building_plan_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_building_plan_upload_challan').show();
            $('#fees_paid_challan_name_href_for_building_plan_upload_challan').attr('href', 'documents/buildingplan/' + buildingPlanData.fees_paid_challan);
            $('#fees_paid_challan_name_for_building_plan_upload_challan').html(buildingPlanData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_building_plan_upload_challan').attr('onclick', 'BuildingPlan.listview.removeFeesPaidChallan("' + buildingPlanData.buildingplan_id + '")');
        }
    },
    removeFeesPaidChallan: function (buildingplanId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!buildingplanId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'buildingplan/remove_fees_paid_challan',
            data: $.extend({}, {'buildingplan_id': buildingplanId}, getTokenData()),
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
                validationMessageShow('building-plan-uc', textStatus.statusText);
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
                    validationMessageShow('building-plan-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-building-plan-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'building_plan_upload_challan');
                $('#status_' + buildingplanId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-building-plan-uc').html('');
        validationMessageHide();
        var buildingplanId = $('#building_plan_id_for_building_plan_upload_challan').val();
        if (!buildingplanId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_building_plan_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_building_plan_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_building_plan_upload_challan').focus();
                validationMessageShow('building-plan-uc-fees_paid_challan_for_building_plan_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_building_plan_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_building_plan_upload_challan').focus();
                validationMessageShow('building-plan-uc-fees_paid_challan_for_building_plan_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_building_plan_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#building_plan_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'buildingplan/upload_fees_paid_challan',
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
                validationMessageShow('building-plan-uc', textStatus.statusText);
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
                    validationMessageShow('building-plan-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + buildingplanId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (buildingPlanId) {
        if (!buildingPlanId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#buildingplan_id_for_certificate').val(buildingPlanId);
        $('#buildingplan_certificate_pdf_form').submit();
        $('#buildingplan_id_for_certificate').val('');
    },
    getQueryData: function (buildingplanId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!buildingplanId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THIRTYSIX;
        templateData.module_id = buildingplanId;
        var btnObj = $('#query_btn_for_app_' + buildingplanId);
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
                tmpData.application_number = regNoRenderer(VALUE_THIRTYSIX, moduleData.buildingplan_id);
                tmpData.applicant_name = moduleData.applicant_name;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },

    uploadDocumentForBuildingPlan: function (fileNo) {
        var that = this;
        if ($('#building_drawing_plans_for_buildingplan').val() != '') {
            var copyOfRegistration = checkValidationForDocument('building_drawing_plans_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#provisional_registration_for_buildingplan').val() != '') {
            var copyOfRegistration = checkValidationForDocument('provisional_registration_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#project_report_for_buildingplan').val() != '') {
            var copyOfRegistration = checkValidationForDocument('project_report_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#mode_of_storage_for_buildingplan').val() != '') {
            var copyOfRegistration = checkValidationForDocument('mode_of_storage_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#drawing_of_treatment_plant_for_buildingplan').val() != '') {
            var copyOfRegistration = checkValidationForDocument('drawing_of_treatment_plant_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#machinery_layout_for_buildingplan').val() != '') {
            var copyOfRegistration = checkValidationForDocument('machinery_layout_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#questionnaire_copy_for_buildingplan').val() != '') {
            var copyOfRegistration = checkValidationForDocument('questionnaire_copy_for_buildingplan', VALUE_ONE, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#sign_of_applicant_for_buildingplan').val() != '') {
            var copyOfRegistration = checkValidationForDocument('sign_of_applicant_for_buildingplan', VALUE_TWO, 'building-plan');
            if (copyOfRegistration == false) {
                return false;
            }
        }


        $('.spinner_container_for_buildingplan_' + fileNo).hide();
        $('.spinner_name_container_for_buildingplan_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var buildingplanId = $('#buildingplan_id').val();
        var formData = new FormData($('#building_plan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("buildingplan_id", buildingplanId);
        $.ajax({
            type: 'POST',
            url: 'buildingplan/upload_buildingplan_document',
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
                $('.spinner_container_for_buildingplan_' + fileNo).show();
                $('.spinner_name_container_for_buildingplan_' + fileNo).hide();
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
                    $('.spinner_container_for_buildingplan_' + fileNo).show();
                    $('.spinner_name_container_for_buildingplan_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_buildingplan_' + fileNo).hide();
                $('.spinner_name_container_for_buildingplan_' + fileNo).show();
                $('#buildingplan_id').val(parseData.buildingplan_id);
                var buildingplanData = parseData.building_plan_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('building_drawing_plans_container_for_buildingplan', 'building_drawing_plans_name_image_for_buildingplan', 'building_drawing_plans_name_container_for_buildingplan',
                            'building_drawing_plans_download', 'building_drawing_plans', buildingplanData.building_drawing_plans, parseData.buildingplan_id, VALUE_ONE);
                }

                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('provisional_registration_container_for_buildingplan', 'provisional_registration_name_image_for_buildingplan', 'provisional_registration_name_container_for_buildingplan',
                            'provisional_registration_download', 'provisional_registration', buildingplanData.provisional_registration, parseData.buildingplan_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('project_report_container_for_buildingplan', 'project_report_name_image_for_buildingplan', 'project_report_name_container_for_buildingplan',
                            'project_report_download', 'project_report', buildingplanData.project_report, parseData.buildingplan_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('mode_of_storage_container_for_buildingplan', 'mode_of_storage_name_image_for_buildingplan', 'mode_of_storage_name_container_for_buildingplan',
                            'mode_of_storage_download', 'mode_of_storage', buildingplanData.mode_of_storage, parseData.buildingplan_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('drawing_of_treatment_plant_container_for_buildingplan', 'drawing_of_treatment_plant_name_image_for_buildingplan', 'drawing_of_treatment_plant_name_container_for_buildingplan',
                            'drawing_of_treatment_plant_download', 'drawing_of_treatment_plant', buildingplanData.drawing_of_treatment_plant, parseData.buildingplan_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('machinery_layout_container_for_buildingplan', 'machinery_layout_name_image_for_buildingplan', 'machinery_layout_name_container_for_buildingplan',
                            'machinery_layout_download', 'machinery_layout', buildingplanData.machinery_layout, parseData.buildingplan_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('questionnaire_copy_container_for_buildingplan', 'questionnaire_copy_name_image_for_buildingplan', 'questionnaire_copy_name_container_for_buildingplan',
                            'questionnaire_copy_download', 'questionnaire_copy', buildingplanData.questionnaire_copy, parseData.buildingplan_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('sign_of_applicant_container_for_buildingplan', 'sign_of_applicant_name_image_for_buildingplan', 'sign_of_applicant_name_container_for_buildingplan',
                            'sign_of_applicant_download', 'sign_of_applicant', buildingplanData.sign_of_applicant, parseData.buildingplan_id, VALUE_EIGHT);
                }


            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/buildingplan/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/buildingplan/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'BuildingPlan.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
