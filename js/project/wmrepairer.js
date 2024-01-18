var repairerListTemplate = Handlebars.compile($('#repairer_list_template').html());
var repairerTableTemplate = Handlebars.compile($('#repairer_table_template').html());
var repairerActionTemplate = Handlebars.compile($('#repairer_action_template').html());
var repairerFormTemplate = Handlebars.compile($('#repairer_form_template').html());
var repairerViewTemplate = Handlebars.compile($('#repairer_view_template').html());
var repairerProprietorInfoTemplate = Handlebars.compile($('#repairer_proprietor_info_template').html());
var repairerUploadChallanTemplate = Handlebars.compile($('#repairer_upload_challan_template').html());

var tempPersonCnt = 1;

var Repairer = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Repairer.Router = Backbone.Router.extend({
    routes: {
        'repairer': 'renderList',
        'repairer_form': 'renderListForForm',
        'edit_repairer_form': 'renderList',
        'view_repairer_form': 'renderList',
    },
    renderList: function () {
        Repairer.listview.listPage();
    },
    renderListForForm: function () {
        Repairer.listview.listPageRepairerForm();
    }
});
Repairer.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="sufficient_stock"]': 'hasSufficientStockEvent',
        'click input[name="any_previous_application"]': 'hasAnyPreviousApplicationsEvent',
        'click input[name="is_limited_company"]': 'hasLimitedCompanyEvent',
    },
    hasSufficientStockEvent: function (event) {
        var val = $('input[name=sufficient_stock]:checked').val();
        if (val === '1') {
            this.$('.stock_details_div').show();
        } else {
            this.$('.stock_details_div').hide();

        }
    },
    hasAnyPreviousApplicationsEvent: function (event) {
        var val = $('input[name=any_previous_application]:checked').val();
        if (val === '1') {
            this.$('.any_previous_application_div').show();
        } else {
            this.$('.any_previous_application_div').hide();

        }
    },
    hasLimitedCompanyEvent: function (event) {
        var val = $('input[name=is_limited_company]:checked').val();
        if (val === '1') {
            this.$('.proprietor_info_div').show();
        } else {
            this.$('.proprietor_info_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('repairer', 'active');
        Repairer.router.navigate('repairer');
        var templateData = {};
        this.$el.html(repairerListTemplate(templateData));
        this.loadRepairerData(sDistrict, sStatus);

    },
    listPageRepairerForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('repairer', 'active');
        this.$el.html(repairerListTemplate);
        this.newRepairerForm(false, {});
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
                rowData.ADMIN_REPAIRER_DOC_PATH = ADMIN_REPAIRER_DOC_PATH;
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
        return repairerActionTemplate(rowData);
    },
    loadRepairerData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWO, data)
                    + getFRContainer(VALUE_TWO, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Repairer.router.navigate('repairer');
        $('#repairer_form_and_datatable_container').html(repairerTableTemplate(searchData));
        repairerDataTable = $('#repairer_datatable').DataTable({
            ajax: {url: 'repairer/get_repairer_data', dataSrc: "repairer_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'repairer_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_repairer', 'class': 'text-center'},
                {data: 'complete_address', 'class': 'text-center'},
                {data: 'premises_status', 'class': 'text-center', 'render': premisesStatusRenderer},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'repairer_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'repairer_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#repairer_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = repairerDataTable.row(tr);

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
    newRepairerForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.repairer_data;
            Repairer.router.navigate('edit_repairer_form');
        } else {
            var formData = {};
            Repairer.router.navigate('repairer_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.repairer_data = parseData.repairer_data;
        templateData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        templateData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        templateData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        $('#repairer_form_and_datatable_container').html(repairerFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(premisesStatusArray, 'premises_status', false);
        renderOptionsForTwoDimensionalArray(identityChoiceArray, 'identity_choice', false);
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {

            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#declarationone').attr('checked', 'checked');
            $('#declarationtwo').attr('checked', 'checked');
            $('#declarationthree').attr('checked', 'checked');

            $('#premises_status').val(formData.premises_status);
            $('#identity_choice').val(formData.identity_choice);

            if (formData.support_document != '') {
                that.showDocument('support_document_container_for_repairer', 'support_document_name_image_for_repairer', 'support_document_name_container_for_repairer',
                        'support_document_download', 'support_document', formData.support_document, formData.repairer_id, VALUE_ONE);
            }
            if (formData.proof_of_ownership != '') {
                that.showDocument('proof_of_ownership_container_for_repairer', 'proof_of_ownership_name_image_for_repairer', 'proof_of_ownership_name_container_for_repairer',
                        'proof_of_ownership_download', 'proof_of_ownership', formData.proof_of_ownership, formData.repairer_id, VALUE_TWO);
            }
            if (formData.gst_certificate != '') {
                that.showDocument('gst_certificate_container_for_repairer', 'gst_certificate_name_image_for_repairer', 'gst_certificate_name_container_for_repairer',
                        'gst_certificate_download', 'gst_certificate', formData.gst_certificate, formData.repairer_id, VALUE_THREE);
            }
            if (formData.education_qualification != '') {
                that.showDocument('education_qualification_container_for_repairer', 'education_qualification_name_image_for_repairer', 'education_qualification_name_container_for_repairer',
                        'education_qualification_download', 'education_qualification', formData.education_qualification, formData.repairer_id, VALUE_FOUR);
            }
            if (formData.experience_certificate != '') {
                that.showDocument('experience_certificate_container_for_repairer', 'experience_certificate_name_image_for_repairer', 'experience_certificate_name_container_for_repairer',
                        'experience_certificate_download', 'experience_certificate', formData.experience_certificate, formData.repairer_id, VALUE_FIVE);
            }
            if (formData.partnership_deed != '') {
                that.showDocument('partnership_deed_container_for_repairer', 'partnership_deed_name_image_for_repairer', 'partnership_deed_name_container_for_repairer',
                        'partnership_deed_download', 'partnership_deed', formData.partnership_deed, formData.repairer_id, VALUE_SIX);
            }
            if (formData.memorandum_of_association != '') {
                that.showDocument('memorandum_of_association_container_for_repairer', 'memorandum_of_association_name_image_for_repairer', 'memorandum_of_association_name_container_for_repairer',
                        'memorandum_of_association_download', 'memorandum_of_association', formData.memorandum_of_association, formData.repairer_id, VALUE_SEVEN);
            }
            if (formData.list_of_raw_material != '') {
                that.showDocument('list_of_raw_material_container_for_repairer', 'list_of_raw_material_name_image_for_repairer', 'list_of_raw_material_name_container_for_repairer',
                        'list_of_raw_material_download', 'list_of_raw_material', formData.list_of_raw_material, formData.repairer_id, VALUE_EIGHT);
            }
            if (formData.list_of_machinery != '') {
                that.showDocument('list_of_machinery_container_for_repairer', 'list_of_machinery_name_image_for_repairer', 'list_of_machinery_name_container_for_repairer',
                        'list_of_machinery_download', 'list_of_machinery', formData.list_of_machinery, formData.repairer_id, VALUE_NINE);
            }
            if (formData.list_of_wm != '') {
                that.showDocument('list_of_wm_container_for_repairer', 'list_of_wm_name_image_for_repairer', 'list_of_wm_name_container_for_repairer',
                        'list_of_wm_download', 'list_of_wm', formData.list_of_wm, formData.repairer_id, VALUE_TEN);
            }
            if (formData.list_of_directors != '') {
                that.showDocument('list_of_directors_container_for_repairer', 'list_of_directors_name_image_for_repairer', 'list_of_directors_name_container_for_repairer',
                        'list_of_directors_download', 'list_of_directors', formData.list_of_directors, formData.repairer_id, VALUE_ELEVEN);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_repairer', 'seal_and_stamp_name_image_for_repairer', 'seal_and_stamp_name_container_for_repairer',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.repairer_id, VALUE_TWELVE);
            }



            if (formData.is_limited_company == isChecked) {
                $('#is_limited_company').attr('checked', 'checked');
                this.$('.proprietor_info_div').show();

                var proprietorInfo = JSON.parse(formData.proprietor_details);
                $.each(proprietorInfo, function (key, value) {
                    that.addMultipleProprietor(value);
                })

            }

            if (formData.sufficient_stock == isChecked) {
                $('#sufficient_stock').attr('checked', 'checked');
                this.$('.stock_details_div').show();
            }
            if (formData.any_previous_application == isChecked) {
                $('#any_previous_application').attr('checked', 'checked');
                this.$('.any_previous_application_div').show();
            }
        }

        generateSelect2();
        datePicker();
        $('#repairer_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitRepairer($('#submit_btn_for_repairer'));
            }
        });
    },
    editOrViewRepairer: function (btnObj, repairerId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!repairerId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'repairer/get_repairer_data_by_id',
            type: 'post',
            data: $.extend({}, {'repairer_id': repairerId}, getTokenData()),
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
                    that.newRepairerForm(isEdit, parseData);
                } else {
                    that.viewRepairerForm(parseData);
                }
            }
        });
    },
    viewRepairerForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.repairer_data;
        Repairer.router.navigate('view_repairer_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#repairer_form_and_datatable_container').html(repairerViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#declarationone').attr('checked', 'checked');
        $('#declarationtwo').attr('checked', 'checked');
        $('#declarationthree').attr('checked', 'checked');
        $('#premises_status').val(formData.premises_status);
        $('#identity_choice').val(formData.identity_choice);

        if (formData.support_document != '') {
            that.showDocument('support_document_container_for_repairer', 'support_document_name_image_for_repairer', 'support_document_name_container_for_repairer',
                    'support_document_download', 'support_document', formData.support_document);
        }
        if (formData.proof_of_ownership != '') {
            that.showDocument('proof_of_ownership_container_for_repairer', 'proof_of_ownership_name_image_for_repairer', 'proof_of_ownership_name_container_for_repairer',
                    'proof_of_ownership_download', 'proof_of_ownership', formData.proof_of_ownership);
        }
        if (formData.gst_certificate != '') {
            that.showDocument('gst_certificate_container_for_repairer', 'gst_certificate_name_image_for_repairer', 'gst_certificate_name_container_for_repairer',
                    'gst_certificate_download', 'gst_certificate', formData.gst_certificate);
        }
        if (formData.education_qualification != '') {
            that.showDocument('education_qualification_container_for_repairer', 'education_qualification_name_image_for_repairer', 'education_qualification_name_container_for_repairer',
                    'education_qualification_download', 'education_qualification', formData.education_qualification);
        }
        if (formData.experience_certificate != '') {
            that.showDocument('experience_certificate_container_for_repairer', 'experience_certificate_name_image_for_repairer', 'experience_certificate_name_container_for_repairer',
                    'experience_certificate_download', 'experience_certificate', formData.experience_certificate);
        }
        if (formData.partnership_deed != '') {
            that.showDocument('partnership_deed_container_for_repairer', 'partnership_deed_name_image_for_repairer', 'partnership_deed_name_container_for_repairer',
                    'partnership_deed_download', 'partnership_deed', formData.partnership_deed);
        }
        if (formData.memorandum_of_association != '') {
            that.showDocument('memorandum_of_association_container_for_repairer', 'memorandum_of_association_name_image_for_repairer', 'memorandum_of_association_name_container_for_repairer',
                    'memorandum_of_association_download', 'memorandum_of_association', formData.memorandum_of_association);
        }
        if (formData.list_of_raw_material != '') {
            that.showDocument('list_of_raw_material_container_for_repairer', 'list_of_raw_material_name_image_for_repairer', 'list_of_raw_material_name_container_for_repairer',
                    'list_of_raw_material_download', 'list_of_raw_material', formData.list_of_raw_material);
        }
        if (formData.list_of_machinery != '') {
            that.showDocument('list_of_machinery_container_for_repairer', 'list_of_machinery_name_image_for_repairer', 'list_of_machinery_name_container_for_repairer',
                    'list_of_machinery_download', 'list_of_machinery', formData.list_of_machinery);
        }
        if (formData.list_of_wm != '') {
            that.showDocument('list_of_wm_container_for_repairer', 'list_of_wm_name_image_for_repairer', 'list_of_wm_name_container_for_repairer',
                    'list_of_wm_download', 'list_of_wm', formData.list_of_wm);
        }
        if (formData.list_of_directors != '') {
            that.showDocument('list_of_directors_container_for_repairer', 'list_of_directors_name_image_for_repairer', 'list_of_directors_name_container_for_repairer',
                    'list_of_directors_download', 'list_of_directors', formData.list_of_directors);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_repairer', 'seal_and_stamp_name_image_for_repairer', 'seal_and_stamp_name_container_for_repairer',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }


        if (formData.is_limited_company == isChecked) {
            $('#is_limited_company').attr('checked', 'checked');
            this.$('.proprietor_info_div').show();

            var proprietorInfo = JSON.parse(formData.proprietor_details);
            $.each(proprietorInfo, function (key, value) {
                that.addMultipleProprietor(value);
            })

        }

        if (formData.sufficient_stock == isChecked) {
            $('#sufficient_stock').attr('checked', 'checked');
            this.$('.stock_details_div').show();
        }
        if (formData.any_previous_application == isChecked) {
            $('#any_previous_application').attr('checked', 'checked');
            this.$('.any_previous_application_div').show();
        }

    },
    checkValidationForRepairer: function (repairerData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!repairerData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!repairerData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!repairerData.name_of_repairmen) {
            return getBasicMessageAndFieldJSONArray('name_of_repairmen', repairmenNameValidationMessage);
        }
        if (!repairerData.complete_address) {
            return getBasicMessageAndFieldJSONArray('complete_address', workshopAddressValidationMessage);
        }
        if (!repairerData.premises_status) {
            return getBasicMessageAndFieldJSONArray('premises_status', premisesStatusValidationMessage);
        }
        if (!repairerData.establishment_date) {
            return getBasicMessageAndFieldJSONArray('establishment_date', establishmentDateValidationMessage);
        }
        if (!repairerData.registration_date) {
            return getBasicMessageAndFieldJSONArray('registration_date', shopDateValidationMessage);
        }
        if (!repairerData.registration_number) {
            return getBasicMessageAndFieldJSONArray('registration_number', shopRegNoValidationMessage);
        }
        if (!repairerData.identity_choice) {
            return getBasicMessageAndFieldJSONArray('identity_choice', identityChoiceValidationMessage);
        }
        if (!repairerData.identity_number) {
            return getBasicMessageAndFieldJSONArray('identity_number', identityNoValidationMessage);
        }
        if (!repairerData.weights_type) {
            return getBasicMessageAndFieldJSONArray('weights_type', weightTypeValidationMessage);
        }
        if (!repairerData.area_operate) {
            return getBasicMessageAndFieldJSONArray('area_operate', areaOperateValidationMessage);
        }
        if (!repairerData.previous_experience) {
            return getBasicMessageAndFieldJSONArray('previous_experience', prevexperienceValidationMessage);
        }
        if (!repairerData.no_of_skilled) {
            return getBasicMessageAndFieldJSONArray('no_of_skilled', skilledNoValidationMessage);
        }
        if (!repairerData.no_of_semiskilled) {
            return getBasicMessageAndFieldJSONArray('no_of_semiskilled', semiskilledNoValidationMessage);
        }
        if (!repairerData.no_of_unskilled) {
            return getBasicMessageAndFieldJSONArray('no_of_unskilled', unskilledNoValidationMessage);
        }
        if (!repairerData.no_of_specialist) {
            return getBasicMessageAndFieldJSONArray('no_of_specialist', trainEmpValidationMessage);
        }
        if (!repairerData.details_of_personnel) {
            return getBasicMessageAndFieldJSONArray('details_of_personnel', personnelDetailValidationMessage);
        }
        if (!repairerData.details_of_machinery) {
            return getBasicMessageAndFieldJSONArray('details_of_machinery', machineryValidationMessage);
        }
        if (!repairerData.electric_energy_availability) {
            return getBasicMessageAndFieldJSONArray('electric_energy_availability', electricEnergyValidationMessage);
        }
        if (repairerData.sufficient_stock == isChecked) {
            if (!repairerData.stock_details) {
                return getBasicMessageAndFieldJSONArray('stock_details', stockDetailValidationMessage);
            }
        }
        if (repairerData.any_previous_application == isChecked) {
            if (!repairerData.license_application_date) {
                return getBasicMessageAndFieldJSONArray('license_application_date', appliedDateValidationMessage);
            }
            if (!repairerData.license_application_result) {
                return getBasicMessageAndFieldJSONArray('license_application_result', licenseResultValidationMessage);
            }
        }
        if (!repairerData.declarationone) {
            return getBasicMessageAndFieldJSONArray('declarationone', declarationOneValidationMessage);
        }
        if (!repairerData.declarationtwo) {
            return getBasicMessageAndFieldJSONArray('declarationtwo', declarationTwoValidationMessage);
        }
        if (!repairerData.declarationthree) {
            return getBasicMessageAndFieldJSONArray('declarationthree', declarationThreeValidationMessage);
        }

        return '';
    },
    askForSubmitRepairer: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Repairer.listview.submitRepairer(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitRepairer: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var repairerData = $('#repairer_form').serializeFormJSON();
        var validationData = that.checkValidationForRepairer(repairerData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('repairer-' + validationData.field, validationData.message);
            return false;
        }

        var proprietorInfoItem = [];
        var isproprietorValidation = false;
        if (repairerData.is_limited_company == isChecked) {
            $('.proprietor_info').each(function () {
                var cnt = $(this).find('.temp_cnt').val();
                var proprietorInfo = {};
                var occupierName = $('#occupier_name_' + cnt).val();
                if (occupierName == '' || occupierName == null) {
                    $('#occupier_name_' + cnt).focus();
                    validationMessageShow('repairer-' + cnt, occupierNameValidationMessage);
                    isproprietorValidation = true;
                    return false;
                }
                proprietorInfo.occupier_name = occupierName;

                var fatherName = $('#father_name_' + cnt).val();
                if (fatherName == '' || fatherName == null) {
                    $('#father_name_' + cnt).focus();
                    validationMessageShow('repairer-' + cnt, fatherNameValidationMessage);
                    isproprietorValidation = true;
                    return false;
                }
                proprietorInfo.father_name = fatherName;

                var address = $('#address_' + cnt).val();
                if (address == '' || address == null) {
                    $('#address_' + cnt).focus();
                    validationMessageShow('repairer-' + cnt, proprietorAddressValidationMessage);
                    isproprietorValidation = true;
                    return false;
                }
                proprietorInfo.address = address;
                proprietorInfoItem.push(proprietorInfo);
            });
        }

        if (isproprietorValidation) {
            return false;
        }

        if ($('#support_document_container_for_repairer').is(':visible')) {
            var supportDocument = checkValidationForDocument('support_document_for_repairer', VALUE_ONE, 'repairer');
            if (supportDocument == false) {
                return false;
            }
        }
        if ($('#proof_of_ownership_container_for_repairer').is(':visible')) {
            var proofOfOwnership = checkValidationForDocument('proof_of_ownership_for_repairer', VALUE_ONE, 'repairer');
            if (proofOfOwnership == false) {
                return false;
            }
        }

        if ($('#gst_certificate_container_for_repairer').is(':visible')) {
            var gstCertificate = checkValidationForDocument('gst_certificate_for_repairer', VALUE_ONE, 'repairer');
            if (gstCertificate == false) {
                return false;
            }
        }
        if ($('#education_qualification_container_for_repairer').is(':visible')) {
            var educationQualification = checkValidationForDocument('education_qualification_for_repairer', VALUE_ONE, 'repairer');
            if (educationQualification == false) {
                return false;
            }
        }

        if ($('#experience_certificate_container_for_repairer').is(':visible')) {
            var experienceCertificate = checkValidationForDocument('experience_certificate_for_repairer', VALUE_ONE, 'repairer');
            if (experienceCertificate == false) {
                return false;
            }
        }
        if ($('#partnership_deed_container_for_repairer').is(':visible')) {
            var partnershipDeed = checkValidationForDocument('partnership_deed_for_repairer', VALUE_ONE, 'repairer');
            if (partnershipDeed == false) {
                return false;
            }
        }

        if ($('#memorandum_of_association_container_for_repairer').is(':visible')) {
            var memorandumofAssociation = checkValidationForDocument('memorandum_of_association_for_repairer', VALUE_ONE, 'repairer');
            if (memorandumofAssociation == false) {
                return false;
            }
        }
        if ($('#list_of_raw_material_container_for_repairer').is(':visible')) {
            var listofrawMaterial = checkValidationForDocument('list_of_raw_material_for_repairer', VALUE_ONE, 'repairer');
            if (listofrawMaterial == false) {
                return false;
            }
        }

        if ($('#list_of_machinery_container_for_repairer').is(':visible')) {
            var listofMachinery = checkValidationForDocument('list_of_machinery_for_repairer', VALUE_ONE, 'repairer');
            if (listofMachinery == false) {
                return false;
            }
        }
        if ($('#list_of_wm_container_for_repairer').is(':visible')) {
            var listofWm = checkValidationForDocument('list_of_wm_for_repairer', VALUE_ONE, 'repairer');
            if (listofWm == false) {
                return false;
            }
        }
        if ($('#list_of_directors_container_for_repairer').is(':visible')) {
            var listOfDirectors = checkValidationForDocument('list_of_directors_for_repairer', VALUE_ONE, 'repairer');
            if (listOfDirectors == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_repairer').is(':visible')) {
            var sealandstamp = checkValidationForDocument('seal_and_stamp_for_repairer', VALUE_TWO, 'repairer');
            if (sealandstamp == false) {
                return false;
            }
        }


        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_repairer') : $('#submit_btn_for_repairer');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var repairerData = new FormData($('#repairer_form')[0]);
        repairerData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        repairerData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        repairerData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'repairer/submit_repairer',
            data: repairerData,
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
                validationMessageShow('repairer', textStatus.statusText);
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
                    validationMessageShow('repairer', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Repairer.router.navigate('repairer', {'trigger': true});
            }
        });
    },

    askForRemove: function (repairerId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!repairerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Repairer.listview.removeDocument(\'' + repairerId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (repairerId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!repairerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_repairer_' + docType).hide();
        $('.spinner_name_container_for_repairer_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'repairer/remove_document',
            data: $.extend({}, {'repairer_id': repairerId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_repairer_' + docType).hide();
                $('.spinner_name_container_for_repairer_' + docType).show();
                validationMessageShow('repairer', textStatus.statusText);
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
                    validationMessageShow('repairer', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_repairer_' + docType).show();
                $('.spinner_name_container_for_repairer_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('support_document_name_container_for_repairer', 'support_document_name_image_for_repairer', 'support_document_container_for_repairer', 'support_document_for_repairer');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('proof_of_ownership_name_container_for_repairer', 'proof_of_ownership_name_image_for_repairer', 'proof_of_ownership_container_for_repairer', 'proof_of_ownership_for_repairer');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('gst_certificate_name_container_for_repairer', 'gst_certificate_name_image_for_repairer', 'gst_certificate_container_for_repairer', 'gst_certificate_for_repairer');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('education_qualification_name_container_for_repairer', 'education_qualification_name_image_for_repairer', 'education_qualification_container_for_repairer', 'education_qualification_for_repairer');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('experience_certificate_name_container_for_repairer', 'experience_certificate_name_image_for_repairer', 'experience_certificate_container_for_repairer', 'experience_certificate_for_repairer');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('partnership_deed_name_container_for_repairer', 'partnership_deed_name_image_for_repairer', 'partnership_deed_container_for_repairer', 'partnership_deed_for_repairer');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('memorandum_of_association_name_container_for_repairer', 'memorandum_of_association_name_image_for_repairer', 'memorandum_of_association_container_for_repairer', 'memorandum_of_association_for_repairer');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('list_of_raw_material_name_container_for_repairer', 'list_of_raw_material_name_image_for_repairer', 'list_of_raw_material_container_for_repairer', 'list_of_raw_material_for_repairer');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('list_of_machinery_name_container_for_repairer', 'list_of_machinery_name_image_for_repairer', 'list_of_machinery_container_for_repairer', 'list_of_machinery_for_repairer');
                }
                if (docType == VALUE_TEN) {
                    removeDocumentValue('list_of_wm_name_container_for_repairer', 'list_of_wm_name_image_for_repairer', 'list_of_wm_container_for_repairer', 'list_of_wm_for_repairer');
                }
                if (docType == VALUE_ELEVEN) {
                    removeDocumentValue('list_of_directors_name_container_for_repairer', 'list_of_directors_name_image_for_repairer', 'list_of_directors_container_for_repairer', 'list_of_directors_for_repairer');
                }
                if (docType == VALUE_TWELVE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_repairer', 'seal_and_stamp_name_image_for_repairer', 'seal_and_stamp_container_for_repairer', 'seal_and_stamp_for_repairer');
                }

            }
        });
    },
    addMultipleProprietor: function (templateData) {
        templateData.per_cnt = tempPersonCnt;
        $('#proprietor_info_container').append(repairerProprietorInfoTemplate(templateData));
        tempPersonCnt++;
        resetCounter('display-cnt');
    },
    removeProprietorInfo: function (perCnt) {
        $('#proprietor_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm1: function (repairerId) {
        if (!repairerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#repairer_id_for_repairer_form1').val(repairerId);
        $('#repairer_form1_pdf_form').submit();
        $('#repairer_id_for_repairer_form1').val('');
    },

    downloadUploadChallan: function (repairerId) {
        if (!repairerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + repairerId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'repairer/get_repairer_data_by_repairer_id',
            type: 'post',
            data: $.extend({}, {'repairer_id': repairerId}, getTokenData()),
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
                var repairerData = parseData.repairer_data;
                that.showChallan(repairerData);
            }
        });
    },
    showChallan: function (repairerData) {
        showPopup();
        if (repairerData.status != VALUE_FIVE && repairerData.status != VALUE_SIX && repairerData.status != VALUE_SEVEN) {
            if (!repairerData.hide_submit_btn) {
                repairerData.show_fees_paid = true;
            }
        }
        if (repairerData.payment_type == VALUE_ONE) {
            repairerData.utitle = 'Fees Paid Challan Copy';
        } else {
            repairerData.style = 'display: none;';
        }
        if (repairerData.payment_type == VALUE_TWO) {
            repairerData.show_dd_po_option = true;
            repairerData.utitle = 'Demand Draft (DD)';
        }
        repairerData.module_type = VALUE_TWO;
        $('#popup_container').html(repairerUploadChallanTemplate(repairerData));
        loadFB(VALUE_TWO, repairerData.fb_data);
        loadPH(VALUE_TWO, repairerData.repairer_id, repairerData.ph_data);

        if (repairerData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'repairer_upload_challan', repairerData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'repairer_upload_challan', 'uc', 'radio');
            if (repairerData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_repairer_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (repairerData.challan != '') {
            $('#challan_container_for_repairer_upload_challan').hide();
            $('#challan_name_container_for_repairer_upload_challan').show();
            $('#challan_name_href_for_repairer_upload_challan').attr('href', 'documents/repairer/' + repairerData.challan);
            $('#challan_name_for_repairer_upload_challan').html(repairerData.challan);
        }
        if (repairerData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_repairer_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_repairer_upload_challan').show();
            $('#fees_paid_challan_name_href_for_repairer_upload_challan').attr('href', 'documents/repairer/' + repairerData.fees_paid_challan);
            $('#fees_paid_challan_name_for_repairer_upload_challan').html(repairerData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_repairer_upload_challan').attr('onclick', 'Repairer.listview.removeFeesPaidChallan("' + repairerData.repairer_id + '")');
        }
    },
    removeFeesPaidChallan: function (repairerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!repairerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'repairer/remove_fees_paid_challan',
            data: $.extend({}, {'repairer_id': repairerId}, getTokenData()),
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
                validationMessageShow('repairer-uc', textStatus.statusText);
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
                    validationMessageShow('repairer-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-repairer-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'repairer_upload_challan');
                $('#status_' + repairerId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-repairer-uc').html('');
        validationMessageHide();
        var repairerId = $('#repairer_id_for_repairer_upload_challan').val();
        if (!repairerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_repairer_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_repairer_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_repairer_upload_challan').focus();
                validationMessageShow('repairer-uc-fees_paid_challan_for_repairer_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_repairer_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_repairer_upload_challan').focus();
                validationMessageShow('repairer-uc-fees_paid_challan_for_repairer_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_repairer_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#repairer_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'repairer/upload_fees_paid_challan',
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
                validationMessageShow('repairer-uc', textStatus.statusText);
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
                    validationMessageShow('repairer-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + repairerId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (repairerId) {
        if (!repairerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#repairer_id_for_certificate').val(repairerId);
        $('#repairer_certificate_pdf_form').submit();
        $('#repairer_id_for_certificate').val('');
    },
    getQueryData: function (repairerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!repairerId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWO;
        templateData.module_id = repairerId;
        var btnObj = $('#query_btn_for_wm_' + repairerId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWO, moduleData.repairer_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Repairer Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForRepairer: function (fileNo) {
        var that = this;
        if ($('#support_document_for_repairer').val() != '') {
            var supportDocument = checkValidationForDocument('support_document_for_repairer', VALUE_ONE, 'repairer');
            if (supportDocument == false) {
                return false;
            }
        }
        if ($('#proof_of_ownership_for_repairer').val() != '') {
            var proofOfOwnership = checkValidationForDocument('proof_of_ownership_for_repairer', VALUE_ONE, 'repairer');
            if (proofOfOwnership == false) {
                return false;
            }
        }
        if ($('#gst_certificate_for_repairer').val() != '') {
            var gstCertificate = checkValidationForDocument('gst_certificate_for_repairer', VALUE_ONE, 'repairer');
            if (gstCertificate == false) {
                return false;
            }
        }
        if ($('#education_qualification_for_repairer').val() != '') {
            var educationQualificationu = checkValidationForDocument('education_qualification_for_repairer', VALUE_ONE, 'repairer');
            if (educationQualificationu == false) {
                return false;
            }
        }
        if ($('#experience_certificate_for_repairer').val() != '') {
            var experienceCertificate = checkValidationForDocument('experience_certificate_for_repairer', VALUE_ONE, 'repairer');
            if (experienceCertificate == false) {
                return false;
            }
        }
        if ($('#partnership_deed_for_repairer').val() != '') {
            var partnershipDeed = checkValidationForDocument('partnership_deed_for_repairer', VALUE_ONE, 'repairer');
            if (partnershipDeed == false) {
                return false;
            }
        }
        if ($('#memorandum_of_association_for_repairer').val() != '') {
            var memorandumofAssociation = checkValidationForDocument('memorandum_of_association_for_repairer', VALUE_ONE, 'repairer');
            if (memorandumofAssociation == false) {
                return false;
            }
        }
        if ($('#list_of_raw_material_for_repairer').val() != '') {
            var listofrawMaterial = checkValidationForDocument('list_of_raw_material_for_repairer', VALUE_ONE, 'repairer');
            if (listofrawMaterial == false) {
                return false;
            }
        }
        if ($('#list_of_machinery_for_repairer').val() != '') {
            var listofMachinery = checkValidationForDocument('list_of_machinery_for_repairer', VALUE_ONE, 'repairer');
            if (listofMachinery == false) {
                return false;
            }
        }
        if ($('#list_of_wm_for_repairer').val() != '') {
            var listofWm = checkValidationForDocument('list_of_wm_for_repairer', VALUE_ONE, 'repairer');
            if (listofWm == false) {
                return false;
            }
        }
        if ($('#list_of_directors_for_repairer').val() != '') {
            var listOfDirectors = checkValidationForDocument('list_of_directors_for_repairer', VALUE_ONE, 'repairer');
            if (listOfDirectors == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_for_repairer').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_repairer', VALUE_TWO, 'repairer');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_repairer_' + fileNo).hide();
        $('.spinner_name_container_for_repairer_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var repairerId = $('#repairer_id').val();
        var formData = new FormData($('#repairer_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("repairer_id", repairerId);
        $.ajax({
            type: 'POST',
            url: 'repairer/upload_repairer_document',
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
                $('.spinner_container_for_repairer_' + fileNo).show();
                $('.spinner_name_container_for_repairer_' + fileNo).hide();
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
                    $('.spinner_container_for_repairer_' + fileNo).show();
                    $('.spinner_name_container_for_repairer_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_repairer_' + fileNo).hide();
                $('.spinner_name_container_for_repairer_' + fileNo).show();
                $('#repairer_id').val(parseData.repairer_id);
                var repairerData = parseData.repairer_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('support_document_container_for_repairer', 'support_document_name_image_for_repairer', 'support_document_name_container_for_repairer',
                            'support_document_download', 'support_document', repairerData.support_document, parseData.repairer_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('proof_of_ownership_container_for_repairer', 'proof_of_ownership_name_image_for_repairer', 'proof_of_ownership_name_container_for_repairer',
                            'proof_of_ownership_download', 'proof_of_ownership', repairerData.proof_of_ownership, parseData.repairer_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('gst_certificate_container_for_repairer', 'gst_certificate_name_image_for_repairer', 'gst_certificate_name_container_for_repairer',
                            'gst_certificate_download', 'gst_certificate', repairerData.gst_certificate, parseData.repairer_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('education_qualification_container_for_repairer', 'education_qualification_name_image_for_repairer', 'education_qualification_name_container_for_repairer',
                            'education_qualification_download', 'education_qualification', repairerData.education_qualification, parseData.repairer_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('experience_certificate_container_for_repairer', 'experience_certificate_name_image_for_repairer', 'experience_certificate_name_container_for_repairer',
                            'experience_certificate_download', 'experience_certificate', repairerData.experience_certificate, parseData.repairer_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('partnership_deed_container_for_repairer', 'partnership_deed_name_image_for_repairer', 'partnership_deed_name_container_for_repairer',
                            'partnership_deed_download', 'partnership_deed', repairerData.partnership_deed, parseData.repairer_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('memorandum_of_association_container_for_repairer', 'memorandum_of_association_name_image_for_repairer', 'memorandum_of_association_name_container_for_repairer',
                            'memorandum_of_association_download', 'memorandum_of_association', repairerData.memorandum_of_association, parseData.repairer_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('list_of_raw_material_container_for_repairer', 'list_of_raw_material_name_image_for_repairer', 'list_of_raw_material_name_container_for_repairer',
                            'list_of_raw_material_download', 'list_of_raw_material', repairerData.list_of_raw_material, parseData.repairer_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('list_of_machinery_container_for_repairer', 'list_of_machinery_name_image_for_repairer', 'list_of_machinery_name_container_for_repairer',
                            'list_of_machinery_download', 'list_of_machinery', repairerData.list_of_machinery, parseData.repairer_id, VALUE_NINE);
                }
                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('list_of_wm_container_for_repairer', 'list_of_wm_name_image_for_repairer', 'list_of_wm_name_container_for_repairer',
                            'list_of_wm_download', 'list_of_wm', repairerData.list_of_wm, parseData.repairer_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('list_of_directors_container_for_repairer', 'list_of_directors_name_image_for_repairer', 'list_of_directors_name_container_for_repairer',
                            'list_of_directors_download', 'list_of_directors', repairerData.list_of_directors, parseData.repairer_id, VALUE_ELEVEN);
                }
                if (parseData.file_no == VALUE_TWELVE) {
                    that.showDocument('seal_and_stamp_container_for_repairer', 'seal_and_stamp_name_image_for_repairer', 'seal_and_stamp_name_container_for_repairer',
                            'seal_and_stamp_download', 'seal_and_stamp', repairerData.signature, parseData.repairer_id, VALUE_TWELVE);
                }

            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/repairer/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/repairer/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Repairer.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});