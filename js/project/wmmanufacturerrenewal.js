var manufacturerRenewalListTemplate = Handlebars.compile($('#manufacturer_renewal_list_template').html());
var manufacturerRenewalTableTemplate = Handlebars.compile($('#manufacturer_renewal_table_template').html());
var manufacturerRenewalActionTemplate = Handlebars.compile($('#manufacturer_renewal_action_template').html());
var manufacturerRenewalFormTemplate = Handlebars.compile($('#manufacturer_renewal_form_template').html());
var manufacturerRenewalViewTemplate = Handlebars.compile($('#manufacturer_renewal_view_template').html());
var manufacturerRenewalProprietorInfoTemplate = Handlebars.compile($('#manufacturer_renewal_proprietor_info_template').html());
var manufacturerRenewalUploadChallanTemplate = Handlebars.compile($('#manufacturer_renewal_upload_challan_template').html());

var tempPersonCnt = 1;

var ManufacturerRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
ManufacturerRenewal.Router = Backbone.Router.extend({
    routes: {
        'manufacturer_renewal': 'renderList',
        'manufacturer_renewal_form': 'renderListForForm',
        'edit_manufacturer_renewal_form': 'renderList',
        'view_manufacturer_renewal_form': 'renderList',
    },
    renderList: function () {
        ManufacturerRenewal.listview.listPage();
    },
    renderListForForm: function () {
        ManufacturerRenewal.listview.listPageManufacturerRenewalForm();
    }
});
ManufacturerRenewal.listView = Backbone.View.extend({
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
//        addClass('manufacturer_renewal', 'active');
        ManufacturerRenewal.router.navigate('manufacturer_renewal');
        var templateData = {};
        this.$el.html(manufacturerRenewalListTemplate(templateData));
        this.loadManufacturerRenewalData(sDistrict, sStatus);

    },
    listPageManufacturerRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('manufacturer_renewal', 'active');
        this.$el.html(manufacturerRenewalListTemplate);
        this.newManufacturerRenewalForm(false, {});
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
        return manufacturerRenewalActionTemplate(rowData);
    },
    loadManufacturerRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_SIXTEEN, data);
        };
        var that = this;
        ManufacturerRenewal.router.navigate('manufacturer_renewal');
        $('#manufacturer_renewal_form_and_datatable_container').html(manufacturerRenewalTableTemplate(searchData));
        manufacturerDataTable = $('#manufacturer_renewal_datatable').DataTable({
            ajax: {url: 'manufacturer_renewal/get_manufacturer_renewal_data', dataSrc: "manufacturer_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'manufacturer_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_manufacturer', 'class': 'text-center'},
                {data: 'complete_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'manufacturer_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'manufacturer_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#manufacturer_renewal_datatable tbody').on('click', 'td.details-control', function () {
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
    newManufacturerRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.manufacturer_renewal_data;
            ManufacturerRenewal.router.navigate('edit_manufacturer_renewal_form');
        } else {
            var formData = {};
            ManufacturerRenewal.router.navigate('manufacturer_renewal_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.manufacturer_renewal_data = parseData.manufacturer_renewal_data;
        templateData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        $('#manufacturer_renewal_form_and_datatable_container').html(manufacturerRenewalFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        // renderOptionsForTwoDimensionalArray(premisesStatusArray, 'premises_status', false);
        // renderOptionsForTwoDimensionalArray(identityChoiceArray, 'identity_choice', false);
        if (isEdit) {

            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#declarationone').attr('checked', 'checked');
            $('#declarationtwo').attr('checked', 'checked');
            $('#declarationthree').attr('checked', 'checked');

            //$('#premises_status').val(formData.premises_status);
            $('#identity_choice').val(formData.identity_choice);
            //$('#location_of_selling').val(formData.location_of_selling);

            if (formData.monogram_uploader != '') {
                that.showDocument('monogram_uploader_container_for_manufacturer', 'monogram_uploader_name_image_for_manufacturer', 'monogram_uploader_name_container_for_manufacturer',
                        'monogram_uploader_download', 'monogram_uploader', formData.monogram_uploader, formData.manufacturer_renewal_id, VALUE_ONE);
            }
            if (formData.original_licence != '') {
                that.showDocument('original_licence_container_for_manufacturer', 'original_licence_name_image_for_manufacturer', 'original_licence_name_container_for_manufacturer',
                        'original_licence_download', 'original_licence', formData.original_licence, formData.manufacturer_renewal_id, VALUE_TWO);
            }
            if (formData.renewed_licence != '') {
                that.showDocument('renewed_licence_container_for_manufacturer', 'renewed_licence_name_image_for_manufacturer', 'renewed_licence_name_container_for_manufacturer',
                        'renewed_licence_download', 'renewed_licence', formData.renewed_licence, formData.manufacturer_renewal_id, VALUE_THREE);
            }
            if (formData.periodical_return != '') {
                that.showDocument('periodical_return_container_for_manufacturer', 'periodical_return_name_image_for_manufacturer', 'periodical_return_name_container_for_manufacturer',
                        'periodical_return_download', 'periodical_return', formData.periodical_return, formData.manufacturer_renewal_id, VALUE_FOUR);
            }
            if (formData.verification_certificate != '') {
                that.showDocument('verification_certificate_container_for_manufacturer', 'verification_certificate_name_image_for_manufacturer', 'verification_certificate_name_container_for_manufacturer',
                        'verification_certificate_download', 'verification_certificate', formData.verification_certificate, formData.manufacturer_renewal_id, VALUE_FIVE);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_manufacturer', 'seal_and_stamp_name_image_for_manufacturer', 'seal_and_stamp_name_container_for_manufacturer',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.manufacturer_renewal_id, VALUE_SIX);
            }


            if (formData.is_limited_company == isChecked) {
                $('#is_limited_company').attr('checked', 'checked');
                this.$('.proprietor_info_div').show();

                var proprietorInfo = JSON.parse(formData.proprietor_details);
                $.each(proprietorInfo, function (key, value) {
                    that.addMultipleProprietor(value);
                })

            }

            // if (formData.any_previous_application == isChecked) {
            //     $('#any_previous_application').attr('checked', 'checked');
            //     this.$('.any_previous_application_div').show();
            // }
        }

        generateSelect2();
        datePicker();
        $('#manufacturer_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitManufacturerRenewal($('#submit_btn_for_manufacturer'));
            }
        });
    },
    editOrViewManufacturerRenewal: function (btnObj, manufacturerRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!manufacturerRenewalId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'manufacturer_renewal/get_manufacturer_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'manufacturer_renewal_id': manufacturerRenewalId}, getTokenData()),
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
                    that.newManufacturerRenewalForm(isEdit, parseData);
                } else {
                    that.viewManufacturerRenewalForm(parseData);
                }
            }
        });
    },
    viewManufacturerRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.manufacturer_renewal_data;
        ManufacturerRenewal.router.navigate('view_manufacturer_renewal_form');
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#manufacturer_renewal_form_and_datatable_container').html(manufacturerRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#declarationone').attr('checked', 'checked');
        $('#declarationtwo').attr('checked', 'checked');
        $('#declarationthree').attr('checked', 'checked');
        // console.log(formData.premises_status);
        // $('#premises_status').val(formData.premises_status);
        $('#identity_choice').val(formData.identity_choice);
        // $('#location_of_selling').val(formData.location_of_selling);


        if (formData.monogram_uploader != '') {
            that.showDocument('monogram_uploader_container_for_manufacturer', 'monogram_uploader_name_image_for_manufacturer', 'monogram_uploader_name_container_for_manufacturer',
                    'monogram_uploader_download', 'monogram_uploader', formData.monogram_uploader);
        }
        if (formData.original_licence != '') {
            that.showDocument('original_licence_container_for_manufacturer', 'original_licence_name_image_for_manufacturer', 'original_licence_name_container_for_manufacturer',
                    'original_licence_download', 'original_licence', formData.original_licence);
        }
        if (formData.renewed_licence != '') {
            that.showDocument('renewed_licence_container_for_manufacturer', 'renewed_licence_name_image_for_manufacturer', 'renewed_licence_name_container_for_manufacturer',
                    'renewed_licence_download', 'renewed_licence', formData.renewed_licence);
        }
        if (formData.periodical_return != '') {
            that.showDocument('periodical_return_container_for_manufacturer', 'periodical_return_name_image_for_manufacturer', 'periodical_return_name_container_for_manufacturer',
                    'periodical_return_download', 'periodical_return', formData.periodical_return);
        }
        if (formData.verification_certificate != '') {
            that.showDocument('verification_certificate_container_for_manufacturer', 'verification_certificate_name_image_for_manufacturer', 'verification_certificate_name_container_for_manufacturer',
                    'verification_certificate_download', 'verification_certificate', formData.verification_certificate);
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
        // if (formData.any_previous_application == isChecked) {
        //     $('#any_previous_application').attr('checked', 'checked');
        //     this.$('.any_previous_application_div').show();
        // }

    },
    checkValidationForManufacturerRenewal: function (manufacturerData) {
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
        if (!manufacturerData.admin_registration_number) {
            return getBasicMessageAndFieldJSONArray('admin_registration_number', licenseNumberValidationMessage);
        }
        if (!manufacturerData.name_of_manufacturer) {
            return getBasicMessageAndFieldJSONArray('name_of_manufacturer', manufacturerNameValidationMessage);
        }
        if (!manufacturerData.complete_address) {
            return getBasicMessageAndFieldJSONArray('complete_address', workshopAddressValidationMessage);
        }
        if (!manufacturerData.registration_date) {
            return getBasicMessageAndFieldJSONArray('registration_date', shopDateValidationMessage);
        }
        if (!manufacturerData.registration_number) {
            return getBasicMessageAndFieldJSONArray('registration_number', shopRegNoValidationMessage);
        }
        if (!manufacturerData.weights_type) {
            return getBasicMessageAndFieldJSONArray('weights_type', weightTypeValidationMessage);
        }
        if (!manufacturerData.propose_change) {
            return getBasicMessageAndFieldJSONArray('propose_change', proposeChangeValidationMessage);
        }
        if (!manufacturerData.details_of_foundry) {
            return getBasicMessageAndFieldJSONArray('details_of_foundry', foundryValidationMessage);
        }
        if (!manufacturerData.production_sales) {
            return getBasicMessageAndFieldJSONArray('production_sales', productionSalesValidationMessage);
        }
        if (!manufacturerData.identity_choice) {
            return getBasicMessageAndFieldJSONArray('identity_choice', identityChoiceValidationMessage);
        }
        if (!manufacturerData.identity_number) {
            return getBasicMessageAndFieldJSONArray('identity_number', identityNoValidationMessage);
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
    askForSubmitManufacturerRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'ManufacturerRenewal.listview.submitManufacturerRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitManufacturerRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var manufacturerData = $('#manufacturer_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForManufacturerRenewal(manufacturerData);
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

        if ($('#monogram_uploader_container_for_manufacturer').is(':visible')) {
            var monogramUploader = checkValidationForDocument('monogram_uploader_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (monogramUploader == false) {
                return false;
            }
        }
        if ($('#original_licence_container_for_manufacturer').is(':visible')) {
            var originalLicense = checkValidationForDocument('original_licence_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (originalLicense == false) {
                return false;
            }
        }
        if ($('#renewed_licence_container_for_manufacturer').is(':visible')) {
            var renewedLicense = checkValidationForDocument('renewed_licence_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (renewedLicense == false) {
                return false;
            }
        }
        if ($('#periodical_return_container_for_manufacturer').is(':visible')) {
            var periodicalReturn = checkValidationForDocument('periodical_return_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (periodicalReturn == false) {
                return false;
            }
        }
        if ($('#verification_certificate_container_for_manufacturer').is(':visible')) {
            var VerificationCertificate = checkValidationForDocument('verification_certificate_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (VerificationCertificate == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_manufacturer').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_manufacturer', VALUE_TWO, 'manufacturer');
            if (sealAndStamp == false) {
                return false;
            }
        }


        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_manufacturer') : $('#submit_btn_for_manufacturer');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var manufacturerData = new FormData($('#manufacturer_renewal_form')[0]);
        manufacturerData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        manufacturerData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        manufacturerData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'manufacturer_renewal/submit_manufacturer_renewal',
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
                ManufacturerRenewal.router.navigate('manufacturer_renewal', {'trigger': true});
            }
        });
    },

    askForRemove: function (manufacturerRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!manufacturerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'ManufacturerRenewal.listview.removeDocument(\'' + manufacturerRenewalId + '\',\'' + docType + '\')';
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
        $('.spinner_container_for_manufacturer_renewal_' + docType).hide();
        $('.spinner_name_container_for_manufacturer_renewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'manufacturer_renewal/remove_document',
            data: $.extend({}, {'manufacturer_renewal_id': manufacturerId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_manufacturer_renewal_' + docType).hide();
                $('.spinner_name_container_for_manufacturer_renewal_' + docType).show();
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
                $('.spinner_container_for_manufacturer_renewal_' + docType).show();
                $('.spinner_name_container_for_manufacturer_renewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('monogram_uploader_name_container_for_manufacturer', 'monogram_uploader_name_image_for_manufacturer', 'monogram_uploader_container_for_manufacturer', 'monogram_uploader_for_manufacturer');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('original_licence_name_container_for_manufacturer', 'original_licence_name_image_for_manufacturer', 'original_licence_container_for_manufacturer', 'original_licence_for_manufacturer');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('renewed_licence_name_container_for_manufacturer', 'renewed_licence_name_image_for_manufacturer', 'renewed_licence_container_for_manufacturer', 'renewed_licence_for_manufacturer');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('periodical_return_name_container_for_manufacturer', 'periodical_return_name_image_for_manufacturer', 'periodical_return_container_for_manufacturer', 'periodical_return_for_manufacturer');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('verification_certificate_name_container_for_manufacturer', 'verification_certificate_name_image_for_manufacturer', 'verification_certificate_container_for_manufacturer', 'verification_certificate_for_manufacturer');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('seal_and_stamp_name_container_for_manufacturer', 'seal_and_stamp_name_image_for_manufacturer', 'seal_and_stamp_container_for_manufacturer', 'seal_and_stamp_for_manufacturer');
                }

                // if (docType == VALUE_TWELVE) {
                //     removeDocumentValue('seal_and_stamp_name_container_for_manufacturer', 'seal_and_stamp_name_image_for_manufacturer', 'seal_and_stamp_container_for_manufacturer', 'seal_and_stamp_for_manufacturer');
                // }

            }
        });
    },
    addMultipleProprietor: function (templateData) {
        templateData.per_cnt = tempPersonCnt;
        $('#proprietor_info_container').append(manufacturerRenewalProprietorInfoTemplate(templateData));
        tempPersonCnt++;
        resetCounter('display-cnt');
    },
    removeProprietorInfo: function (perCnt) {
        $('#proprietor_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm1: function (manufacturerRenewalId) {
        if (!manufacturerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#manufacturer_renewal_id_for_manufacturer_renewal_form1').val(manufacturerRenewalId);
        $('#manufacturer_renewal_form1_pdf_form').submit();
        $('#manufacturer_renewal_id_for_manufacturer_renewal_form1').val('');
    },

    downloadUploadChallan: function (manufacturerRenewalId) {
        if (!manufacturerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + manufacturerRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'manufacturer_renewal/get_manufacturer_renewal_data_by_manufacturer_renewal_id',
            type: 'post',
            data: $.extend({}, {'manufacturer_renewal_id': manufacturerRenewalId}, getTokenData()),
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
                var manufacturerData = parseData.manufacturer_renewal_data;
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
        manufacturerData.module_type = VALUE_SIXTEEN;
        $('#popup_container').html(manufacturerRenewalUploadChallanTemplate(manufacturerData));
        loadFB(VALUE_SIXTEEN, manufacturerData.fb_data);
        loadPH(VALUE_SIXTEEN, manufacturerData.manufacturer_renewal_id, manufacturerData.ph_data);

        if (manufacturerData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'manufacturer_renewal_upload_challan', manufacturerData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'manufacturer_renewal_upload_challan', 'uc', 'radio');
            if (manufacturerData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_manufacturer_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (manufacturerData.challan != '') {
            $('#challan_container_for_manufacturer_renewal_upload_challan').hide();
            $('#challan_name_container_for_manufacturer_renewal_upload_challan').show();
            $('#challan_name_href_for_manufacturer_renewal_upload_challan').attr('href', 'documents/manufacturer/' + manufacturerData.challan);
            $('#challan_name_for_manufacturer_renewal_upload_challan').html(manufacturerData.challan);
        }
        if (manufacturerData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_manufacturer_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_manufacturer_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_manufacturer_renewal_upload_challan').attr('href', 'documents/manufacturer/' + manufacturerData.fees_paid_challan);
            $('#fees_paid_challan_name_for_manufacturer_renewal_upload_challan').html(manufacturerData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_manufacturer_renewal_upload_challan').attr('onclick', 'ManufacturerRenewal.listview.removeFeesPaidChallan("' + manufacturerData.manufacturer_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (manufacturerRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!manufacturerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'manufacturer_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'manufacturer_renewal_id': manufacturerRenewalId}, getTokenData()),
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
                removeDocument('fees_paid_challan', 'manufacturer_renewal_upload_challan');
                $('#status_' + manufacturerRenewalId).html(appStatusArray[VALUE_THREE]);
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
        var manufacturerRenewalId = $('#manufacturer_renewal_id_for_manufacturer_renewal_upload_challan').val();
        if (!manufacturerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_manufacturer_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_manufacturer_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_manufacturer_renewal_upload_challan').focus();
                validationMessageShow('manufacturer-uc-fees_paid_challan_for_manufacturer_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_manufacturer_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_manufacturer_renewal_upload_challan').focus();
                validationMessageShow('manufacturer-uc-fees_paid_challan_for_manufacturer_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_manufacturer_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#manufacturer_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'manufacturer_renewal/upload_fees_paid_challan',
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
                $('#status_' + manufacturerRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (manufacturerRenewalId) {
        if (!manufacturerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#manufacturer_renewal_id_for_certificate').val(manufacturerRenewalId);
        $('#manufacturer_renewal_certificate_pdf_form').submit();
        $('#manufacturer_renewal_id_for_certificate').val('');
    },
    getQueryData: function (manufacturerRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!manufacturerRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_SIXTEEN;
        templateData.module_id = manufacturerRenewalId;
        var btnObj = $('#query_btn_for_wm_' + manufacturerRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_SIXTEEN, moduleData.manufacturer_renewal_id);
                tmpData.applicant_name = moduleData.name_of_manufacturer;
                tmpData.title = 'Manufacturer Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getManufacturerData: function (btnObj) {
        var license_number = $('#admin_registration_number').val();
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        // if (!manufacturerRenewalId) {
        //     showError(invalidUserValidationMessage);
        //     return;
        // }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'manufacturer_renewal/get_manufacturer_data_by_id',
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
                manufacturerData = parseData.manufacturer_data;
                if (manufacturerData) {
                    $('#manufacturer_renewal_id').val(manufacturerData.manufacturer_renewal_id);
                    $('#name_of_manufacturer').val(manufacturerData.name_of_manufacturer);
                    $('#complete_address').val(manufacturerData.complete_address);
                    $('#registration_date').val(manufacturerData.registration_date);
                    $('#registration_number').val(manufacturerData.registration_number);
                    $('#identity_number').val(manufacturerData.identity_number);
                    $('#identity_choice').val(manufacturerData.identity_choice);
                    $('#details_of_foundry').val(manufacturerData.details_of_foundry);
                    $('#production_sales').val(manufacturerData.production_sales);
                    $('#signature').val(manufacturerData.signature);
                    $('#monogram_uploader').val(manufacturerData.monogram_uploader);
                    var registration_date = dateTo_DD_MM_YYYY(manufacturerData.registration_date);
                    $('#registration_date').val(registration_date);

                    if (manufacturerData.is_limited_company == isChecked) {
                        $('#is_limited_company').attr('checked', 'checked');
                        $('.proprietor_info_div').show();

                        var proprietorInfo = JSON.parse(manufacturerData.proprietor_details);
                        $.each(proprietorInfo, function (key, value) {
                            that.addMultipleProprietor(value);
                        })
                    }

                    // if (manufacturerData.sufficient_stock == isChecked) {
                    //     $('#sufficient_stock').attr('checked', 'checked');
                    //     this.$('.stock_details_div').show();
                    // }

                    $('#declarationone').attr('checked', 'checked');
                    $('#declarationtwo').attr('checked', 'checked');
                    $('#declarationthree').attr('checked', 'checked');

                    // if (manufacturerData.signature != '') {
                    //     $('#seal_and_stamp_container_for_manufacturer').hide();
                    //     $('#seal_and_stamp_name_image_for_manufacturer').attr('src', baseUrl + 'documents/manufacturer/' + manufacturerData.signature);
                    //     $('#seal_and_stamp_name_container_for_manufacturer').show();
                    // }
                    // if (manufacturerData.monogram_uploader != '') {
                    //     $('#monogram_uploader_container_for_manufacturer').hide();
                    //     $('#monogram_uploader_name_image_for_manufacturer').attr('src', baseUrl + 'documents/dealer/' + manufacturerData.monogram_uploader);
                    //     $('#monogram_uploader_name_container_for_manufacturer').show();
                    //     $('#monogram_uploader_name_image_for_manufacturer_download').attr("href", baseUrl + 'documents/dealer/' + manufacturerData.monogram_uploader);
                    // }
                }
            }
        });
    },

    uploadDocumentForManufacturerRenewal: function (fileNo) {
        var that = this;
        if ($('#monogram_uploader_for_manufacturer').val() != '') {
            var monogramUploader = checkValidationForDocument('monogram_uploader_for_manufacturer', VALUE_ONE, 'manufacturer_renewal');
            if (monogramUploader == false) {
                return false;
            }
        }
        if ($('#original_licence_for_manufacturer').val() != '') {
            var originalLicense = checkValidationForDocument('original_licence_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (originalLicense == false) {
                return false;
            }
        }
        if ($('#renewed_licence_for_manufacturer').val() != '') {
            var renewalLicense = checkValidationForDocument('renewed_licence_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (renewalLicense == false) {
                return false;
            }
        }
        if ($('#periodical_return_for_manufacturer').val() != '') {
            var periodicalReturn = checkValidationForDocument('periodical_return_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (periodicalReturn == false) {
                return false;
            }
        }
        if ($('#verification_certificate_for_manufacturer').val() != '') {
            var VerificationCertificate = checkValidationForDocument('verification_certificate_for_manufacturer', VALUE_ONE, 'manufacturer');
            if (VerificationCertificate == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_manufacturer').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_manufacturer', VALUE_TWO, 'manufacturer');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_manufacturer_renewal_' + fileNo).hide();
        $('.spinner_name_container_for_manufacturer_renewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var manufacturerId = $('#manufacturer_renewal_id').val();
        var formData = new FormData($('#manufacturer_renewal_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("manufacturer_renewal_id", manufacturerId);
        $.ajax({
            type: 'POST',
            url: 'manufacturer_renewal/upload_manufacturer_renewal_document',
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
                $('.spinner_container_for_manufacturer_renewal_' + fileNo).show();
                $('.spinner_name_container_for_manufacturer_renewal_' + fileNo).hide();
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
                    $('.spinner_container_for_manufacturer_renewal_' + fileNo).show();
                    $('.spinner_name_container_for_manufacturer_renewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_manufacturer_renewal_' + fileNo).hide();
                $('.spinner_name_container_for_manufacturer_renewal_' + fileNo).show();
                $('#manufacturer_renewal_id').val(parseData.manufacturer_renewal_id);
                var manufacturerData = parseData.manufacturer_renewal_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('monogram_uploader_container_for_manufacturer', 'monogram_uploader_name_image_for_manufacturer', 'monogram_uploader_name_container_for_manufacturer',
                            'monogram_uploader_download', 'monogram_uploader', manufacturerData.monogram_uploader, parseData.manufacturer_renewal_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('original_licence_container_for_manufacturer', 'original_licence_name_image_for_manufacturer', 'original_licence_name_container_for_manufacturer',
                            'original_licence_download', 'original_licence', manufacturerData.original_licence, parseData.manufacturer_renewal_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('renewed_licence_container_for_manufacturer', 'renewed_licence_name_image_for_manufacturer', 'renewed_licence_name_container_for_manufacturer',
                            'renewed_licence_download', 'renewed_licence', manufacturerData.renewed_licence, parseData.manufacturer_renewal_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('periodical_return_container_for_manufacturer', 'periodical_return_name_image_for_manufacturer', 'periodical_return_name_container_for_manufacturer',
                            'periodical_return_download', 'periodical_return', manufacturerData.periodical_return, parseData.manufacturer_renewal_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('verification_certificate_container_for_manufacturer', 'verification_certificate_name_image_for_manufacturer', 'verification_certificate_name_container_for_manufacturer',
                            'verification_certificate_download', 'verification_certificate', manufacturerData.verification_certificate, parseData.manufacturer_renewal_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('seal_and_stamp_container_for_manufacturer', 'seal_and_stamp_name_image_for_manufacturer', 'seal_and_stamp_name_container_for_manufacturer',
                            'seal_and_stamp_download', 'seal_and_stamp', manufacturerData.signature, parseData.manufacturer_renewal_id, VALUE_SIX);
                }

            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/manufacturer/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/manufacturer/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'ManufacturerRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});