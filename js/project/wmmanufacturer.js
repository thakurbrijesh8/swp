var manufacturerListTemplate = Handlebars.compile($('#manufacturer_list_template').html());
var manufacturerTableTemplate = Handlebars.compile($('#manufacturer_table_template').html());
var manufacturerActionTemplate = Handlebars.compile($('#manufacturer_action_template').html());
var manufacturerFormTemplate = Handlebars.compile($('#manufacturer_form_template').html());
var manufacturerViewTemplate = Handlebars.compile($('#manufacturer_view_template').html());
var manufactureProprietorInfoTemplate = Handlebars.compile($('#manufacture_proprietor_info_template').html());
var manufacturerUploadChallanTemplate = Handlebars.compile($('#manufacturer_upload_challan_template').html());

var tempPersonCnt = 1;

var Manufacturer = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Manufacturer.Router = Backbone.Router.extend({
    routes: {
        'manufacturer': 'renderList',
        'manufacturer_form': 'renderListForForm',
        'edit_manufacturer_form': 'renderList',
        'view_manufacturer_form': 'renderList',
    },
    renderList: function () {
        Manufacturer.listview.listPage();
    },
    renderListForForm: function () {
        Manufacturer.listview.listPageManufacturerForm();
    }
});
Manufacturer.listView = Backbone.View.extend({
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
//        addClass('manufacturer', 'active');
        Manufacturer.router.navigate('manufacturer');
        var templateData = {};
        this.$el.html(manufacturerListTemplate(templateData));
        this.loadManufacturerData(sDistrict, sStatus);

    },
    listPageManufacturerForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('manufacturer', 'active');
        this.$el.html(manufacturerListTemplate);
        this.newManufacturerForm(false, {});
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
                rowData.ADMIN_MANUFACT_DOC_PATH = ADMIN_MANUFACT_DOC_PATH;
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
        return manufacturerActionTemplate(rowData);
    },
    loadManufacturerData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOUR, data)
                    + getFRContainer(VALUE_FOUR, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Manufacturer.router.navigate('manufacturer');
        $('#manufacturer_form_and_datatable_container').html(manufacturerTableTemplate(searchData));
        manufacturerDataTable = $('#manufacturer_datatable').DataTable({
            ajax: {url: 'manufacturer/get_manufacturer_data', dataSrc: "manufacturer_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'manufacturer_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_manufacturer', 'class': 'text-center'},
                {data: 'complete_address', 'class': 'text-center'},
                {data: 'premises_status', 'class': 'text-center', 'render': premisesStatusRenderer},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'manufacturer_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'manufacturer_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#manufacturer_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = manufacturerDataTable.row(tr);

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
    newManufacturerForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.manufacturer_data;
            Manufacturer.router.navigate('edit_manufacturer_form');
        } else {
            var formData = {};
            Manufacturer.router.navigate('manufacturer_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.manufacturer_data = parseData.manufacturer_data;
        templateData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        templateData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        templateData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        templateData.inspection_sample_date = dateTo_DD_MM_YYYY(formData.inspection_sample_date);
        $('#manufacturer_form_and_datatable_container').html(manufacturerFormTemplate((templateData)));
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
            $('#location_of_selling').val(formData.location_of_selling);

            if (formData.support_document != '') {
                that.showDocument('support_document_container_for_manufacturer', 'support_document_name_image_for_manufacturer', 'support_document_name_container_for_manufacturer',
                        'support_document_download', 'support_document', formData.support_document, formData.manufacturer_id, VALUE_ONE);
            }
            if (formData.monogram_uploader != '') {
                that.showDocument('monogram_uploader_container_for_manufacturer', 'monogram_uploader_name_image_for_manufacturer', 'monogram_uploader_name_container_for_manufacturer',
                        'monogram_uploader_download', 'monogram_uploader', formData.monogram_uploader, formData.manufacturer_id, VALUE_TWO);
            }
            if (formData.model_approval_certificate != '') {
                that.showDocument('model_approval_certificate_container_for_manufacturer', 'model_approval_certificate_name_image_for_manufacturer', 'model_approval_certificate_name_container_for_manufacturer',
                        'model_approval_certificate_download', 'model_approval_certificate', formData.model_approval_certificate, formData.manufacturer_id, VALUE_THREE);
            }
            if (formData.proof_of_ownership != '') {
                that.showDocument('proof_of_ownership_container_for_manufacturer', 'proof_of_ownership_name_image_for_manufacturer', 'proof_of_ownership_name_container_for_manufacturer',
                        'proof_of_ownership_download', 'proof_of_ownership', formData.proof_of_ownership, formData.manufacturer_id, VALUE_FOUR);
            }
            if (formData.gst_certificate != '') {
                that.showDocument('gst_certificate_container_for_manufacturer', 'gst_certificate_name_image_for_manufacturer', 'gst_certificate_name_container_for_manufacturer',
                        'gst_certificate_download', 'gst_certificate', formData.gst_certificate, formData.manufacturer_id, VALUE_FIVE);
            }
            if (formData.partnership_deed != '') {
                that.showDocument('partnership_deed_container_for_manufacturer', 'partnership_deed_name_image_for_manufacturer', 'partnership_deed_name_container_for_manufacturer',
                        'partnership_deed_download', 'partnership_deed', formData.partnership_deed, formData.manufacturer_id, VALUE_SIX);
            }
            if (formData.memorandum_of_association != '') {
                that.showDocument('memorandum_of_association_container_for_manufacturer', 'memorandum_of_association_name_image_for_manufacturer', 'memorandum_of_association_name_container_for_manufacturer',
                        'memorandum_of_association_download', 'memorandum_of_association', formData.memorandum_of_association, formData.manufacturer_id, VALUE_SEVEN);
            }
            if (formData.list_of_raw_material != '') {
                that.showDocument('list_of_raw_material_container_for_manufacturer', 'list_of_raw_material_name_image_for_manufacturer', 'list_of_raw_material_name_container_for_manufacturer',
                        'list_of_raw_material_download', 'list_of_raw_material', formData.list_of_raw_material, formData.manufacturer_id, VALUE_EIGHT);
            }
            if (formData.list_of_machinery != '') {
                that.showDocument('list_of_machinery_container_for_manufacturer', 'list_of_machinery_name_image_for_manufacturer', 'list_of_machinery_name_container_for_manufacturer',
                        'list_of_machinery_download', 'list_of_machinery', formData.list_of_machinery, formData.manufacturer_id, VALUE_NINE);
            }
            if (formData.list_of_wm != '') {
                that.showDocument('list_of_wm_container_for_manufacturer', 'list_of_wm_name_image_for_manufacturer', 'list_of_wm_name_container_for_manufacturer',
                        'list_of_wm_download', 'list_of_wm', formData.list_of_wm, formData.manufacturer_id, VALUE_TEN);
            }
            if (formData.list_of_directors != '') {
                that.showDocument('list_of_directors_container_for_manufacturer', 'list_of_directors_name_image_for_manufacturer', 'list_of_directors_name_container_for_manufacturer',
                        'list_of_directors_download', 'list_of_directors', formData.list_of_directors, formData.manufacturer_id, VALUE_ELEVEN);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_manufacturer', 'seal_and_stamp_name_image_for_manufacturer', 'seal_and_stamp_name_container_for_manufacturer',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.manufacturer_id, VALUE_TWELVE);
            }

            if (formData.is_limited_company == isChecked) {
                $('#is_limited_company').attr('checked', 'checked');
                this.$('.proprietor_info_div').show();

                var proprietorInfo = JSON.parse(formData.proprietor_details);
                $.each(proprietorInfo, function (key, value) {
                    that.addMultipleProprietor(value);
                })

            }

            if (formData.any_previous_application == isChecked) {
                $('#any_previous_application').attr('checked', 'checked');
                this.$('.any_previous_application_div').show();
            }
        }

        generateSelect2();
        datePicker();
        $('#manufacturer_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitManufacturer($('#submit_btn_for_manufacturer'));
            }
        });
    },
    editOrViewManufacturer: function (btnObj, manufacturerId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!manufacturerId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'manufacturer/get_manufacturer_data_by_id',
            type: 'post',
            data: $.extend({}, {'manufacturer_id': manufacturerId}, getTokenData()),
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
                    that.newManufacturerForm(isEdit, parseData);
                } else {
                    that.viewManufacturerForm(parseData);
                }
            }
        });
    },
    viewManufacturerForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.manufacturer_data;
        Manufacturer.router.navigate('view_manufacturer_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        formData.inspection_sample_date = dateTo_DD_MM_YYYY(formData.inspection_sample_date);
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#manufacturer_form_and_datatable_container').html(manufacturerViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#declarationone').attr('checked', 'checked');
        $('#declarationtwo').attr('checked', 'checked');
        $('#declarationthree').attr('checked', 'checked');
        // console.log(formData.premises_status);
        $('#premises_status').val(formData.premises_status);
        $('#identity_choice').val(formData.identity_choice);
        $('#location_of_selling').val(formData.location_of_selling);


        if (formData.support_document != '') {
            that.showDocument('support_document_container_for_manufacturer', 'support_document_name_image_for_manufacturer', 'support_document_name_container_for_manufacturer',
                    'support_document_download', 'support_document', formData.support_document);
        }
        if (formData.monogram_uploader != '') {
            that.showDocument('monogram_uploader_container_for_manufacturer', 'monogram_uploader_name_image_for_manufacturer', 'monogram_uploader_name_container_for_manufacturer',
                    'monogram_uploader_download', 'monogram_uploader', formData.monogram_uploader);
        }
        if (formData.model_approval_certificate != '') {
            that.showDocument('model_approval_certificate_container_for_manufacturer', 'model_approval_certificate_name_image_for_manufacturer', 'model_approval_certificate_name_container_for_manufacturer',
                    'model_approval_certificate_download', 'model_approval_certificate', formData.model_approval_certificate);
        }
        if (formData.proof_of_ownership != '') {
            that.showDocument('proof_of_ownership_container_for_manufacturer', 'proof_of_ownership_name_image_for_manufacturer', 'proof_of_ownership_name_container_for_manufacturer',
                    'proof_of_ownership_download', 'proof_of_ownership', formData.proof_of_ownership);
        }
        if (formData.gst_certificate != '') {
            that.showDocument('gst_certificate_container_for_manufacturer', 'gst_certificate_name_image_for_manufacturer', 'gst_certificate_name_container_for_manufacturer',
                    'gst_certificate_download', 'gst_certificate', formData.gst_certificate);
        }
        if (formData.partnership_deed != '') {
            that.showDocument('partnership_deed_container_for_manufacturer', 'partnership_deed_name_image_for_manufacturer', 'partnership_deed_name_container_for_manufacturer',
                    'partnership_deed_download', 'partnership_deed', formData.partnership_deed);
        }
        if (formData.memorandum_of_association != '') {
            that.showDocument('memorandum_of_association_container_for_manufacturer', 'memorandum_of_association_name_image_for_manufacturer', 'memorandum_of_association_name_container_for_manufacturer',
                    'memorandum_of_association_download', 'memorandum_of_association', formData.memorandum_of_association);
        }
        if (formData.list_of_raw_material != '') {
            that.showDocument('list_of_raw_material_container_for_manufacturer', 'list_of_raw_material_name_image_for_manufacturer', 'list_of_raw_material_name_container_for_manufacturer',
                    'list_of_raw_material_download', 'list_of_raw_material', formData.list_of_raw_material);
        }
        if (formData.list_of_machinery != '') {
            that.showDocument('list_of_machinery_container_for_manufacturer', 'list_of_machinery_name_image_for_manufacturer', 'list_of_machinery_name_container_for_manufacturer',
                    'list_of_machinery_download', 'list_of_machinery', formData.list_of_machinery);
        }
        if (formData.list_of_wm != '') {
            that.showDocument('list_of_wm_container_for_manufacturer', 'list_of_wm_name_image_for_manufacturer', 'list_of_wm_name_container_for_manufacturer',
                    'list_of_wm_download', 'list_of_wm', formData.list_of_wm);
        }
        if (formData.list_of_directors != '') {
            that.showDocument('list_of_directors_container_for_manufacturer', 'list_of_directors_name_image_for_manufacturer', 'list_of_directors_name_container_for_manufacturer',
                    'list_of_directors_download', 'list_of_directors', formData.list_of_directors);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_manufacturer', 'seal_and_stamp_name_image_for_manufacturer', 'seal_and_stamp_name_container_for_manufacturer',
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
        if (formData.any_previous_application == isChecked) {
            $('#any_previous_application').attr('checked', 'checked');
            this.$('.any_previous_application_div').show();
        }
    },
    checkValidationForManufacturer: function (manufacturerData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!manufacturerData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!manufacturerData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!manufacturerData.name_of_manufacturer) {
            return getBasicMessageAndFieldJSONArray('name_of_manufacturer', manufacturerNameValidationMessage);
        }
        if (!manufacturerData.complete_address) {
            return getBasicMessageAndFieldJSONArray('complete_address', workshopAddressValidationMessage);
        }
        if (!manufacturerData.premises_status) {
            return getBasicMessageAndFieldJSONArray('premises_status', premisesStatusValidationMessage);
        }
        if (!manufacturerData.establishment_date) {
            return getBasicMessageAndFieldJSONArray('establishment_date', establishmentDateValidationMessage);
        }
        if (!manufacturerData.registration_date) {
            return getBasicMessageAndFieldJSONArray('registration_date', shopDateValidationMessage);
        }
        if (!manufacturerData.registration_number) {
            return getBasicMessageAndFieldJSONArray('registration_number', shopRegNoValidationMessage);
        }
        if (!manufacturerData.manufacturing_activity) {
            return getBasicMessageAndFieldJSONArray('manufacturing_activity', activityValidationMessage);
        }
        if (!manufacturerData.weights_type) {
            return getBasicMessageAndFieldJSONArray('weights_type', weightTypeValidationMessage);
        }
        if (!manufacturerData.measures_type) {
            return getBasicMessageAndFieldJSONArray('measures_type', measureTypeValidationMessage);
        }
        if (!manufacturerData.weighing_instruments_type) {
            return getBasicMessageAndFieldJSONArray('weighing_instruments_type', weightInstrumrntValidationMessage);
        }
        if (!manufacturerData.measuring_instruments_type) {
            return getBasicMessageAndFieldJSONArray('measuring_instruments_type', measureInstumentValidationMessage);
        }
        if (!manufacturerData.no_of_skilled) {
            return getBasicMessageAndFieldJSONArray('no_of_skilled', skilledNoValidationMessage);
        }
        if (!manufacturerData.no_of_semiskilled) {
            return getBasicMessageAndFieldJSONArray('no_of_semiskilled', semiskilledNoValidationMessage);
        }
        if (!manufacturerData.no_of_unskilled) {
            return getBasicMessageAndFieldJSONArray('no_of_unskilled', unskilledNoValidationMessage);
        }
        if (!manufacturerData.no_of_specialist) {
            return getBasicMessageAndFieldJSONArray('no_of_specialist', trainEmpValidationMessage);
        }
        if (!manufacturerData.details_of_personnel) {
            return getBasicMessageAndFieldJSONArray('details_of_personnel', personnelDetailValidationMessage);
        }
        if (!manufacturerData.details_of_machinery) {
            return getBasicMessageAndFieldJSONArray('details_of_machinery', machineryValidationMessage);
        }
        if (!manufacturerData.details_of_foundry) {
            return getBasicMessageAndFieldJSONArray('details_of_foundry', foundryValidationMessage);
        }
        if (!manufacturerData.steel_casting_facility) {
            return getBasicMessageAndFieldJSONArray('steel_casting_facility', castingFacilityValidationMessage);
        }
        if (!manufacturerData.electric_energy_availability) {
            return getBasicMessageAndFieldJSONArray('electric_energy_availability', electricEnergyValidationMessage);
        }
        if (!manufacturerData.details_of_loan) {
            return getBasicMessageAndFieldJSONArray('details_of_loan', loanDetailValidationMessage);
        }
        if (!manufacturerData.banker_names) {
            return getBasicMessageAndFieldJSONArray('banker_names', bankNameValidationMessage);
        }
        if (!manufacturerData.identity_choice) {
            return getBasicMessageAndFieldJSONArray('identity_choice', identityChoiceValidationMessage);
        }
        if (!manufacturerData.identity_number) {
            return getBasicMessageAndFieldJSONArray('identity_number', identityNoValidationMessage);
        }
        if (manufacturerData.any_previous_application == isChecked) {
            if (!manufacturerData.license_application_date) {
                return getBasicMessageAndFieldJSONArray('license_application_date', appliedDateValidationMessage);
            }
            if (!manufacturerData.license_application_result) {
                return getBasicMessageAndFieldJSONArray('license_application_result', licenseResultValidationMessage);
            }
        }
        if (!manufacturerData.location_of_selling) {
            return getBasicMessageAndFieldJSONArray('location_of_selling', sellingLocationStatusValidationMessage);
        }
        if (!manufacturerData.model_approval_detail) {
            return getBasicMessageAndFieldJSONArray('model_approval_detail', approvalModelValidationMessage);
        }
        if (!manufacturerData.inspection_sample_date) {
            return getBasicMessageAndFieldJSONArray('inspection_sample_date', inspectionDateValidationMessage);
        }
        if (!manufacturerData.declarationone) {
            return getBasicMessageAndFieldJSONArray('declarationone', declarationOneValidationMessage);
        }
        if (!manufacturerData.declarationtwo) {
            return getBasicMessageAndFieldJSONArray('declarationtwo', declarationTwoValidationMessage);
        }
        if (!manufacturerData.declarationthree) {
            return getBasicMessageAndFieldJSONArray('declarationthree', declarationThreeValidationMessage);
        }

        return '';
    },
    askForSubmitManufacturer: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Manufacturer.listview.submitManufacturer(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitManufacturer: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var manufacturerData = $('#manufacturer_form').serializeFormJSON();
        var validationData = that.checkValidationForManufacturer(manufacturerData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('manufacturer-' + validationData.field, validationData.message);
            return false;
        }

        var proprietorInfoItem = [];
        var isproprietorValidation = false;
        if (manufacturerData.is_limited_company == isChecked) {
            $('.proprietor_info').each(function () {
                var cnt = $(this).find('.temp_cnt').val();
                var proprietorInfo = {};
                var occupierName = $('#occupier_name_' + cnt).val();
                if (occupierName == '' || occupierName == null) {
                    $('#occupier_name_' + cnt).focus();
                    validationMessageShow('manufacturer-' + cnt, occupierNameValidationMessage);
                    isproprietorValidation = true;
                    return false;
                }
                proprietorInfo.occupier_name = occupierName;

                var fatherName = $('#father_name_' + cnt).val();
                if (fatherName == '' || fatherName == null) {
                    $('#father_name_' + cnt).focus();
                    validationMessageShow('manufacturer-' + cnt, fatherNameValidationMessage);
                    isproprietorValidation = true;
                    return false;
                }
                proprietorInfo.father_name = fatherName;

                var address = $('#address_' + cnt).val();
                if (address == '' || address == null) {
                    $('#address_' + cnt).focus();
                    validationMessageShow('manufacturer-' + cnt, proprietorAddressValidationMessage);
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

        if ($('#support_document_container_for_manufacturer').is(':visible')) {
            var importModel = checkValidationForDocument('support_document_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (importModel == false) {
                return false;
            }
        }
        if ($('#monogram_uploader_container_for_manufacturer').is(':visible')) {
            var importModel = checkValidationForDocument('monogram_uploader_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (importModel == false) {
                return false;
            }
        }
        if ($('#model_approval_certificate_container_for_manufacturer').is(':visible')) {
            var modelApproval = checkValidationForDocument('model_approval_certificate_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (modelApproval == false) {
                return false;
            }
        }

        if ($('#proof_of_ownership_container_for_manufacturer').is(':visible')) {
            var proofOfOwnership = checkValidationForDocument('proof_of_ownership_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (proofOfOwnership == false) {
                return false;
            }
        }
        if ($('#gst_certificate_container_for_manufacturer').is(':visible')) {
            var gstCertificate = checkValidationForDocument('gst_certificate_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (gstCertificate == false) {
                return false;
            }
        }

        if ($('#partnership_deed_container_for_manufacturer').is(':visible')) {
            var partnershipDeed = checkValidationForDocument('partnership_deed_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (partnershipDeed == false) {
                return false;
            }
        }
        if ($('#memorandum_of_association_container_for_manufacturer').is(':visible')) {
            var memorandumofAssociation = checkValidationForDocument('memorandum_of_association_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (memorandumofAssociation == false) {
                return false;
            }
        }

        if ($('#list_of_raw_material_container_for_manufacturer').is(':visible')) {
            var listofrawMaterial = checkValidationForDocument('list_of_raw_material_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (listofrawMaterial == false) {
                return false;
            }
        }
        if ($('#list_of_machinery_container_for_manufacturer').is(':visible')) {
            var listofMachinery = checkValidationForDocument('list_of_machinery_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (listofMachinery == false) {
                return false;
            }
        }

        if ($('#list_of_wm_container_for_manufacturer').is(':visible')) {
            var listofWm = checkValidationForDocument('list_of_wm_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (listofWm == false) {
                return false;
            }
        }
        if ($('#list_of_directors_container_for_manufacturer').is(':visible')) {
            var listOfDirectors = checkValidationForDocument('list_of_directors_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (listOfDirectors == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_manufacturer').is(':visible')) {
            var sealandstamp = checkValidationForDocument('seal_and_stamp_for_manufacturer', VALUE_TWO, 'manufacturer');
            if (sealandstamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_manufacturer') : $('#submit_btn_for_manufacturer');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var manufacturerData = new FormData($('#manufacturer_form')[0]);
        manufacturerData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        manufacturerData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        manufacturerData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'manufacturer/submit_manufacturer',
            data: manufacturerData,
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
                validationMessageShow('manufacturer', textStatus.statusText);
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
                    validationMessageShow('manufacturer', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Manufacturer.router.navigate('manufacturer', {'trigger': true});
            }
        });
    },

    askForRemove: function (manufacturerId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!manufacturerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Manufacturer.listview.removeDocument(\'' + manufacturerId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (manufacturerId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!manufacturerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_manufacturer_' + docType).hide();
        $('.spinner_name_container_for_manufacturer_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'manufacturer/remove_document',
            data: $.extend({}, {'manufacturer_id': manufacturerId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_manufacturer_' + docType).hide();
                $('.spinner_name_container_for_manufacturer_' + docType).show();
                validationMessageShow('manufacturer', textStatus.statusText);
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
                    validationMessageShow('manufacturer', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_manufacturer_' + docType).show();
                $('.spinner_name_container_for_manufacturer_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('support_document_name_container_for_manufacturer', 'support_document_name_image_for_manufacturer', 'support_document_container_for_manufacturer', 'support_document_for_manufacturer');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('monogram_uploader_name_container_for_manufacturer', 'monogram_uploader_name_image_for_manufacturer', 'monogram_uploader_container_for_manufacturer', 'monogram_uploader_for_manufacturer');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('model_approval_certificate_name_container_for_manufacturer', 'model_approval_certificate_name_image_for_manufacturer', 'model_approval_certificate_container_for_manufacturer', 'model_approval_certificate_for_manufacturer');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('proof_of_ownership_name_container_for_manufacturer', 'proof_of_ownership_name_image_for_manufacturer', 'proof_of_ownership_container_for_manufacturer', 'proof_of_ownership_for_manufacturer');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('gst_certificate_name_container_for_manufacturer', 'gst_certificate_name_image_for_manufacturer', 'gst_certificate_container_for_manufacturer', 'gst_certificate_for_manufacturer');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('partnership_deed_name_container_for_manufacturer', 'partnership_deed_name_image_for_manufacturer', 'partnership_deed_container_for_manufacturer', 'partnership_deed_for_manufacturer');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('memorandum_of_association_name_container_for_manufacturer', 'memorandum_of_association_name_image_for_manufacturer', 'memorandum_of_association_container_for_manufacturer', 'memorandum_of_association_for_manufacturer');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('list_of_raw_material_name_container_for_manufacturer', 'list_of_raw_material_name_image_for_manufacturer', 'list_of_raw_material_container_for_manufacturer', 'list_of_raw_material_for_manufacturer');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('list_of_machinery_name_container_for_manufacturer', 'list_of_machinery_name_image_for_manufacturer', 'list_of_machinery_container_for_manufacturer', 'list_of_machinery_for_manufacturer');
                }
                if (docType == VALUE_TEN) {
                    removeDocumentValue('list_of_wm_name_container_for_manufacturer', 'list_of_wm_name_image_for_manufacturer', 'list_of_wm_container_for_manufacturer', 'list_of_wm_for_manufacturer');
                }
                if (docType == VALUE_ELEVEN) {
                    removeDocumentValue('list_of_directors_name_container_for_manufacturer', 'list_of_directors_name_image_for_manufacturer', 'list_of_directors_container_for_manufacturer', 'list_of_directors_for_manufacturer');
                }
                if (docType == VALUE_TWELVE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_manufacturer', 'seal_and_stamp_name_image_for_manufacturer', 'seal_and_stamp_container_for_manufacturer', 'seal_and_stamp_for_manufacturer');
                }

            }
        });
    },
    addMultipleProprietor: function (templateData) {
        templateData.per_cnt = tempPersonCnt;
        $('#proprietor_info_container').append(manufactureProprietorInfoTemplate(templateData));
        tempPersonCnt++;
        resetCounter('display-cnt');
    },
    removeProprietorInfo: function (perCnt) {
        $('#proprietor_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm1: function (manufacturerId) {
        if (!manufacturerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#manufacturer_id_for_manufacturer_form1').val(manufacturerId);
        $('#manufacturer_form1_pdf_form').submit();
        $('#manufacturer_id_for_manufacturer_form1').val('');
    },

    downloadUploadChallan: function (manufacturerId) {
        if (!manufacturerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + manufacturerId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'manufacturer/get_manufacturer_data_by_manufacturer_id',
            type: 'post',
            data: $.extend({}, {'manufacturer_id': manufacturerId}, getTokenData()),
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
                var manufacturerData = parseData.manufacturer_data;
                that.showChallan(manufacturerData);
            }
        });
    },
    showChallan: function (manufacturerData) {
        showPopup();
        if (manufacturerData.status != VALUE_FIVE && manufacturerData.status != VALUE_SIX && manufacturerData.status != VALUE_SEVEN) {
            if (!manufacturerData.hide_submit_btn) {
                manufacturerData.show_fees_paid = true;
            }
        }
        if (manufacturerData.payment_type == VALUE_ONE) {
            manufacturerData.utitle = 'Fees Paid Challan Copy';
        } else {
            manufacturerData.style = 'display: none;';
        }
        if (manufacturerData.payment_type == VALUE_TWO) {
            manufacturerData.show_dd_po_option = true;
            manufacturerData.utitle = 'Demand Draft (DD)';
        }
        manufacturerData.module_type = VALUE_FOUR;
        $('#popup_container').html(manufacturerUploadChallanTemplate(manufacturerData));
        loadFB(VALUE_FOUR, manufacturerData.fb_data);
        loadPH(VALUE_FOUR, manufacturerData.manufacturer_id, manufacturerData.ph_data);

        if (manufacturerData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'manufacturer_upload_challan', manufacturerData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'manufacturer_upload_challan', 'uc', 'radio');
            if (manufacturerData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_manufacturer_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (manufacturerData.challan != '') {
            $('#challan_container_for_manufacturer_upload_challan').hide();
            $('#challan_name_container_for_manufacturer_upload_challan').show();
            $('#challan_name_href_for_manufacturer_upload_challan').attr('href', 'documents/manufacturer/' + manufacturerData.challan);
            $('#challan_name_for_manufacturer_upload_challan').html(manufacturerData.challan);
        }
        if (manufacturerData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_manufacturer_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_manufacturer_upload_challan').show();
            $('#fees_paid_challan_name_href_for_manufacturer_upload_challan').attr('href', 'documents/manufacturer/' + manufacturerData.fees_paid_challan);
            $('#fees_paid_challan_name_for_manufacturer_upload_challan').html(manufacturerData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_manufacturer_upload_challan').attr('onclick', 'Manufacturer.listview.removeFeesPaidChallan("' + manufacturerData.manufacturer_id + '")');
        }
    },
    removeFeesPaidChallan: function (manufacturerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!manufacturerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'manufacturer/remove_fees_paid_challan',
            data: $.extend({}, {'manufacturer_id': manufacturerId}, getTokenData()),
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
                validationMessageShow('manufacturer-uc', textStatus.statusText);
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
                    validationMessageShow('manufacturer-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-manufacturer-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'manufacturer_upload_challan');
                $('#status_' + manufacturerId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-manufacturer-uc').html('');
        validationMessageHide();
        var manufacturerId = $('#manufacturer_id_for_manufacturer_upload_challan').val();
        if (!manufacturerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_manufacturer_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_manufacturer_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_manufacturer_upload_challan').focus();
                validationMessageShow('manufacturer-uc-fees_paid_challan_for_manufacturer_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_manufacturer_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_manufacturer_upload_challan').focus();
                validationMessageShow('manufacturer-uc-fees_paid_challan_for_manufacturer_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_manufacturer_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#manufacturer_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'manufacturer/upload_fees_paid_challan',
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
                validationMessageShow('manufacturer-uc', textStatus.statusText);
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
                    validationMessageShow('manufacturer-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + manufacturerId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (manufacturerId) {
        if (!manufacturerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#manufacturer_id_for_certificate').val(manufacturerId);
        $('#manufacturer_certificate_pdf_form').submit();
        $('#manufacturer_id_for_certificate').val('');
    },
    getQueryData: function (manufacturerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!manufacturerId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOUR;
        templateData.module_id = manufacturerId;
        var btnObj = $('#query_btn_for_wm_' + manufacturerId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOUR, moduleData.manufacturer_id);
                tmpData.applicant_name = moduleData.name_of_manufacturer;
                tmpData.title = 'Manufacturer Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForManufacturer: function (fileNo) {
        var that = this;
        if ($('#support_document_for_manufacturer').val() != '') {
            var importModel = checkValidationForDocument('support_document_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (importModel == false) {
                return false;
            }
        }
        if ($('#monogram_uploader_for_manufacturer').val() != '') {
            var importModel = checkValidationForDocument('monogram_uploader_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (importModel == false) {
                return false;
            }
        }
        if ($('#model_approval_certificate_for_manufacturer').val() != '') {
            var modelApproval = checkValidationForDocument('model_approval_certificate_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (modelApproval == false) {
                return false;
            }
        }
        if ($('#proof_of_ownership_for_manufacturer').val() != '') {
            var proofOfOwnership = checkValidationForDocument('proof_of_ownership_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (proofOfOwnership == false) {
                return false;
            }
        }
        if ($('#gst_certificate_for_manufacturer').val() != '') {
            var gstCertificate = checkValidationForDocument('gst_certificate_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (gstCertificate == false) {
                return false;
            }
        }
        if ($('#partnership_deed_for_manufacturer').val() != '') {
            var partnershipDeed = checkValidationForDocument('partnership_deed_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (partnershipDeed == false) {
                return false;
            }
        }
        if ($('#memorandum_of_association_for_manufacturer').val() != '') {
            var memorandumofAssociation = checkValidationForDocument('memorandum_of_association_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (memorandumofAssociation == false) {
                return false;
            }
        }
        if ($('#list_of_raw_material_for_manufacturer').val() != '') {
            var listofrawMaterial = checkValidationForDocument('list_of_raw_material_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (listofrawMaterial == false) {
                return false;
            }
        }
        if ($('#list_of_machinery_for_manufacturer').val() != '') {
            var listofMachinery = checkValidationForDocument('list_of_machinery_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (listofMachinery == false) {
                return false;
            }
        }
        if ($('#list_of_wm_for_manufacturer').val() != '') {
            var listofWm = checkValidationForDocument('list_of_wm_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (listofWm == false) {
                return false;
            }
        }
        if ($('#list_of_directors_for_manufacturer').val() != '') {
            var listOfDirectors = checkValidationForDocument('list_of_directors_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (listOfDirectors == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_for_manufacturer').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_manufacturer', VALUE_TWO, 'manufacturer');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_manufacturer_' + fileNo).hide();
        $('.spinner_name_container_for_manufacturer_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var manufacturerId = $('#manufacturer_id').val();
        var formData = new FormData($('#manufacturer_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("manufacturer_id", manufacturerId);
        $.ajax({
            type: 'POST',
            url: 'manufacturer/upload_manufacturer_document',
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
                $('.spinner_container_for_manufacturer_' + fileNo).show();
                $('.spinner_name_container_for_manufacturer_' + fileNo).hide();
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
                    $('.spinner_container_for_manufacturer_' + fileNo).show();
                    $('.spinner_name_container_for_manufacturer_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_manufacturer_' + fileNo).hide();
                $('.spinner_name_container_for_manufacturer_' + fileNo).show();
                $('#manufacturer_id').val(parseData.manufacturer_id);
                var manufacturerData = parseData.manufacturer_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('support_document_container_for_manufacturer', 'support_document_name_image_for_manufacturer', 'support_document_name_container_for_manufacturer',
                            'support_document_download', 'support_document', manufacturerData.support_document, parseData.manufacturer_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('monogram_uploader_container_for_manufacturer', 'monogram_uploader_name_image_for_manufacturer', 'monogram_uploader_name_container_for_manufacturer',
                            'monogram_uploader_download', 'monogram_uploader', manufacturerData.monogram_uploader, parseData.manufacturer_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('model_approval_certificate_container_for_manufacturer', 'model_approval_certificate_name_image_for_manufacturer', 'model_approval_certificate_name_container_for_manufacturer',
                            'model_approval_certificate_download', 'model_approval_certificate', manufacturerData.model_approval_certificate, parseData.manufacturer_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('proof_of_ownership_container_for_manufacturer', 'proof_of_ownership_name_image_for_manufacturer', 'proof_of_ownership_name_container_for_manufacturer',
                            'proof_of_ownership_download', 'proof_of_ownership', manufacturerData.proof_of_ownership, parseData.manufacturer_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('gst_certificate_container_for_manufacturer', 'gst_certificate_name_image_for_manufacturer', 'gst_certificate_name_container_for_manufacturer',
                            'gst_certificate_download', 'gst_certificate', manufacturerData.gst_certificate, parseData.manufacturer_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('partnership_deed_container_for_manufacturer', 'partnership_deed_name_image_for_manufacturer', 'partnership_deed_name_container_for_manufacturer',
                            'partnership_deed_download', 'partnership_deed', manufacturerData.partnership_deed, parseData.manufacturer_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('memorandum_of_association_container_for_manufacturer', 'memorandum_of_association_name_image_for_manufacturer', 'memorandum_of_association_name_container_for_manufacturer',
                            'memorandum_of_association_download', 'memorandum_of_association', manufacturerData.memorandum_of_association, parseData.manufacturer_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('list_of_raw_material_container_for_manufacturer', 'list_of_raw_material_name_image_for_manufacturer', 'list_of_raw_material_name_container_for_manufacturer',
                            'list_of_raw_material_download', 'list_of_raw_material', manufacturerData.memorandum_of_association, parseData.manufacturer_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('list_of_machinery_container_for_manufacturer', 'list_of_machinery_name_image_for_manufacturer', 'list_of_machinery_name_container_for_manufacturer',
                            'list_of_machinery_download', 'list_of_machinery', manufacturerData.list_of_machinery, parseData.manufacturer_id, VALUE_NINE);
                }
                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('list_of_wm_container_for_manufacturer', 'list_of_wm_name_image_for_manufacturer', 'list_of_wm_name_container_for_manufacturer',
                            'list_of_wm_download', 'list_of_wm', manufacturerData.list_of_wm, parseData.manufacturer_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('list_of_directors_container_for_manufacturer', 'list_of_directors_name_image_for_manufacturer', 'list_of_directors_name_container_for_manufacturer',
                            'list_of_directors_download', 'list_of_directors', manufacturerData.list_of_directors, parseData.manufacturer_id, VALUE_ELEVEN);
                }
                if (parseData.file_no == VALUE_TWELVE) {
                    that.showDocument('seal_and_stamp_container_for_manufacturer', 'seal_and_stamp_name_image_for_manufacturer', 'seal_and_stamp_name_container_for_manufacturer',
                            'seal_and_stamp_download', 'seal_and_stamp', manufacturerData.signature, parseData.manufacturer_id, VALUE_TWELVE);
                }

            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/manufacturer/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/manufacturer/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Manufacturer.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});