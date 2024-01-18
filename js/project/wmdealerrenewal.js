var dealerRenewalListTemplate = Handlebars.compile($('#dealer_renewal_list_template').html());
var dealerRenewalTableTemplate = Handlebars.compile($('#dealer_renewal_table_template').html());
var dealerRenewalActionTemplate = Handlebars.compile($('#dealer_renewal_action_template').html());
var dealerRenewalFormTemplate = Handlebars.compile($('#dealer_renewal_form_template').html());
var dealerRenewalViewTemplate = Handlebars.compile($('#dealer_renewal_view_template').html());
var dealerRenewalProprietorInfoTemplate = Handlebars.compile($('#dealer_renewal_proprietor_info_template').html());
var dealerRenewalUploadChallanTemplate = Handlebars.compile($('#dealer_renewal_upload_challan_template').html());

var tempPersonCnt = 1;

var DealerRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
DealerRenewal.Router = Backbone.Router.extend({
    routes: {
        'dealer_renewal': 'renderList',
        'dealer_renewal_form': 'renderListForForm',
        'edit_dealer_renewal_form': 'renderList',
        'view_dealer_renewal_form': 'renderList',
    },
    renderList: function () {
        DealerRenewal.listview.listPage();
    },
    renderListForForm: function () {
        DealerRenewal.listview.listPageDealerRenewalForm();
    }
});
DealerRenewal.listView = Backbone.View.extend({
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
//        addClass('dealer_renewal', 'active');
        DealerRenewal.router.navigate('dealer_renewal');
        var templateData = {};
        this.$el.html(dealerRenewalListTemplate(templateData));
        this.loadDealerRenewalData(sDistrict, sStatus);

    },
    listPageDealerRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('dealer_renewal', 'active');
        this.$el.html(dealerRenewalListTemplate);
        this.newDealerRenewalForm(false, {});
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
                rowData.ADMIN_DEALER_DOC_PATH = ADMIN_DEALER_DOC_PATH;
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
        return dealerRenewalActionTemplate(rowData);
    },
    loadDealerRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FIFTEEN, data)
                    + getFRContainer(VALUE_FIFTEEN, data, full.rating, full.fr_datetime);
        };
        var that = this;
        DealerRenewal.router.navigate('dealer_renewal');
        $('#dealer_renewal_form_and_datatable_container').html(dealerRenewalTableTemplate(searchData));
        dealerDataTable = $('#dealer_renewal_datatable').DataTable({
            ajax: {url: 'dealer_renewal/get_dealer_renewal_data', dataSrc: "dealer_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'dealer_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_dealer', 'class': 'text-center'},
                {data: 'complete_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'dealer_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'dealer_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#dealer_renewal_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = dealerDataTable.row(tr);

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
    newDealerRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.dealer_renewal_data;
            DealerRenewal.router.navigate('edit_dealer_renewal_form');
        } else {
            var formData = {};
            DealerRenewal.router.navigate('dealer_renewal_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.dealer_renewal_data = parseData.dealer_renewal_data;
        templateData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        templateData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        $('#dealer_renewal_form_and_datatable_container').html(dealerRenewalFormTemplate((templateData)));
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


            $('#identity_choice').val(formData.identity_choice);

            if (formData.import_model != '') {
                that.showDocument('import_model_container_for_dealer', 'import_model_name_image_for_dealer', 'import_model_name_container_for_dealer',
                        'import_model_download', 'import_model', formData.import_model, formData.dealer_renewal_id, VALUE_ONE);
            }
            if (formData.original_licence != '') {
                that.showDocument('original_licence_container_for_dealer', 'original_licence_name_image_for_dealer', 'original_licence_name_container_for_dealer',
                        'original_licence_download', 'original_licence', formData.original_licence, formData.dealer_renewal_id, VALUE_TWO);
            }
            if (formData.renewed_licence != '') {
                that.showDocument('renewed_licence_container_for_dealer', 'renewed_licence_name_image_for_dealer', 'renewed_licence_name_container_for_dealer',
                        'renewed_licence_download', 'renewed_licence', formData.renewed_licence, formData.dealer_renewal_id, VALUE_THREE);
            }
            if (formData.periodical_return != '') {
                that.showDocument('periodical_return_container_for_dealer', 'periodical_return_name_image_for_dealer', 'periodical_return_name_container_for_dealer',
                        'periodical_return_download', 'periodical_return', formData.periodical_return, formData.dealer_renewal_id, VALUE_FOUR);
            }
            if (formData.verification_certificate != '') {
                that.showDocument('verification_certificate_container_for_dealer', 'verification_certificate_name_image_for_dealer', 'verification_certificate_name_container_for_dealer',
                        'verification_certificate_download', 'verification_certificate', formData.verification_certificate, formData.dealer_renewal_id, VALUE_FIVE);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_dealer', 'seal_and_stamp_name_image_for_dealer', 'seal_and_stamp_name_container_for_dealer',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.dealer_renewal_id, VALUE_SIX);
            }

            if (formData.is_limited_company == isChecked) {
                $('#is_limited_company').attr('checked', 'checked');
                this.$('.proprietor_info_div').show();

                var proprietorInfo = JSON.parse(formData.proprietor_details);
                $.each(proprietorInfo, function (key, value) {
                    that.addMultipleProprietor(value);
                })

            }
            if (formData.import_from_outside == isChecked) {
                $('#import_from_outside').attr('checked', 'checked');
                this.$('.import_from_outside_div').show();
            }
            if (formData.any_previous_application == isChecked) {
                $('#any_previous_application').attr('checked', 'checked');
                this.$('.any_previous_application_div').show();
            }
        }

        generateSelect2();
        datePicker();
        $('#dealer_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDealerRenewal($('#submit_btn_for_dealer'));
            }
        });
    },
    editOrViewDealerRenewal: function (btnObj, dealerRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!dealerRenewalId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dealer_renewal/get_dealer_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'dealer_renewal_id': dealerRenewalId}, getTokenData()),
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
                    that.newDealerRenewalForm(isEdit, parseData);
                } else {
                    that.viewDealerRenewalForm(parseData);
                }
            }
        });
    },
    viewDealerRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.dealer_renewal_data;
        DealerRenewal.router.navigate('view_dealer_renewal_form');
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#dealer_renewal_form_and_datatable_container').html(dealerRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#declarationone').attr('checked', 'checked');
        $('#declarationtwo').attr('checked', 'checked');
        $('#declarationthree').attr('checked', 'checked');

        $('#identity_choice').val(formData.identity_choice);
        if (formData.is_limited_company == isChecked) {
            $('#is_limited_company').attr('checked', 'checked');
            this.$('.proprietor_info_div').show();

            var proprietorInfo = JSON.parse(formData.proprietor_details);
            $.each(proprietorInfo, function (key, value) {
                that.addMultipleProprietor(value);
            })

        }
        if (formData.import_from_outside == isChecked) {
            $('#import_from_outside').attr('checked', 'checked');
            this.$('.import_from_outside_div').show();
        }
        if (formData.any_previous_application == isChecked) {
            $('#any_previous_application').attr('checked', 'checked');
            this.$('.any_previous_application_div').show();
        }


        if (formData.import_model != '') {
            that.showDocument('import_model_container_for_dealer', 'import_model_name_image_for_dealer', 'import_model_name_container_for_dealer',
                    'import_model_download', 'import_model', formData.import_model);
        }
        if (formData.original_licence != '') {
            that.showDocument('original_licence_container_for_dealer', 'original_licence_name_image_for_dealer', 'original_licence_name_container_for_dealer',
                    'original_licence_download', 'original_licence', formData.original_licence);
        }
        if (formData.renewed_licence != '') {
            that.showDocument('renewed_licence_container_for_dealer', 'renewed_licence_name_image_for_dealer', 'renewed_licence_name_container_for_dealer',
                    'renewed_licence_download', 'renewed_licence', formData.renewed_licence);
        }
        if (formData.periodical_return != '') {
            that.showDocument('periodical_return_container_for_dealer', 'periodical_return_name_image_for_dealer', 'periodical_return_name_container_for_dealer',
                    'periodical_return_download', 'periodical_return', formData.periodical_return);
        }
        if (formData.verification_certificate != '') {
            that.showDocument('verification_certificate_container_for_dealer', 'verification_certificate_name_image_for_dealer', 'verification_certificate_name_container_for_dealer',
                    'verification_certificate_download', 'verification_certificate', formData.verification_certificate);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_dealer', 'seal_and_stamp_name_image_for_dealer', 'seal_and_stamp_name_container_for_dealer',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }

    },
    checkValidationForDealerRenewal: function (dealerData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!dealerData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!dealerData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!dealerData.admin_registration_number) {
            return getBasicMessageAndFieldJSONArray('admin_registration_number', licenseNumberValidationMessage);
        }
        if (!dealerData.name_of_dealer) {
            return getBasicMessageAndFieldJSONArray('name_of_dealer', dealerNameValidationMessage);
        }
        if (!dealerData.complete_address) {
            return getBasicMessageAndFieldJSONArray('complete_address', workshopAddressValidationMessage);
        }
        if (!dealerData.establishment_date) {
            return getBasicMessageAndFieldJSONArray('establishment_date', establishmentDateValidationMessage);
        }
        if (!dealerData.registration_date) {
            return getBasicMessageAndFieldJSONArray('registration_date', shopDateValidationMessage);
        }
        if (!dealerData.registration_number) {
            return getBasicMessageAndFieldJSONArray('registration_number', shopRegNoValidationMessage);
        }
        if (!dealerData.categories_sold) {
            return getBasicMessageAndFieldJSONArray('categories_sold', categoriesSoldValidationMessage);
        }
        if (!dealerData.identity_choice) {
            return getBasicMessageAndFieldJSONArray('identity_choice', identityChoiceValidationMessage);
        }
        if (!dealerData.identity_number) {
            return getBasicMessageAndFieldJSONArray('identity_number', identityNoValidationMessage);
        }
        // if (dealerData.any_previous_application == isChecked) {
        //     if (!dealerData.license_application_date) {
        //         return getBasicMessageAndFieldJSONArray('license_application_date', appliedDateValidationMessage);
        //     }
        //     if (!dealerData.license_application_result) {
        //         return getBasicMessageAndFieldJSONArray('license_application_result', licenseResultValidationMessage);
        //     }
        // }
        if (!dealerData.declarationone) {
            return getBasicMessageAndFieldJSONArray('declarationone', declarationOneValidationMessage);
        }
        if (!dealerData.declarationtwo) {
            return getBasicMessageAndFieldJSONArray('declarationtwo', declarationTwoValidationMessage);
        }
        if (!dealerData.declarationthree) {
            return getBasicMessageAndFieldJSONArray('declarationthree', declarationThreeValidationMessage);
        }

        return '';
    },
    askForSubmitDealerRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'DealerRenewal.listview.submitDealerRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitDealerRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var dealerData = $('#dealer_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForDealerRenewal(dealerData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('dealer-' + validationData.field, validationData.message);
            return false;
        }

        var proprietorInfoItem = [];
        var isproprietorValidation = false;
        if (dealerData.is_limited_company == isChecked) {
            $('.proprietor_info').each(function () {
                var cnt = $(this).find('.temp_cnt').val();
                var proprietorInfo = {};
                var occupierName = $('#occupier_name_' + cnt).val();
                if (occupierName == '' || occupierName == null) {
                    $('#occupier_name_' + cnt).focus();
                    validationMessageShow('dealer-' + cnt, occupierNameValidationMessage);
                    isproprietorValidation = true;
                    return false;
                }
                proprietorInfo.occupier_name = occupierName;

                var address = $('#address_' + cnt).val();
                if (address == '' || address == null) {
                    $('#address_' + cnt).focus();
                    validationMessageShow('dealer-' + cnt, proprietorAddressValidationMessage);
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

        if ($('#import_model_container_for_dealer').is(':visible')) {
            var importModel = checkValidationForDocument('import_model_for_dealer', VALUE_ONE, 'dealer');
            if (importModel == false) {
                return false;
            }
        }
        if ($('#original_licence_container_for_dealer').is(':visible')) {
            var originalLicense = checkValidationForDocument('original_licence_for_dealer', VALUE_ONE, 'dealer');
            if (originalLicense == false) {
                return false;
            }
        }
        if ($('#renewed_licence_container_for_dealer').is(':visible')) {
            var renewedLicense = checkValidationForDocument('renewed_licence_for_dealer', VALUE_ONE, 'dealer');
            if (renewedLicense == false) {
                return false;
            }
        }
        if ($('#periodical_return_container_for_dealer').is(':visible')) {
            var periodicalReturn = checkValidationForDocument('periodical_return_for_dealer', VALUE_ONE, 'dealer');
            if (periodicalReturn == false) {
                return false;
            }
        }
        if ($('#verification_certificate_container_for_dealer').is(':visible')) {
            var VerificationCertificate = checkValidationForDocument('verification_certificate_for_dealer', VALUE_ONE, 'dealer');
            if (VerificationCertificate == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_dealer').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_dealer', VALUE_TWO, 'dealer');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_dealer') : $('#submit_btn_for_dealer');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var dealerData = new FormData($('#dealer_renewal_form')[0]);
        dealerData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        dealerData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        dealerData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'dealer_renewal/submit_dealer_renewal',
            data: dealerData,
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
                validationMessageShow('dealer', textStatus.statusText);
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
                    validationMessageShow('dealer', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                DealerRenewal.router.navigate('dealer_renewal', {'trigger': true});
            }
        });
    },

    askForRemove: function (dealerRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!dealerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'DealerRenewal.listview.removeDocument(\'' + dealerRenewalId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (dealerId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!dealerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_dealer_renewal_' + docType).hide();
        $('.spinner_name_container_for_dealer_renewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'dealer_renewal/remove_document',
            data: $.extend({}, {'dealer_renewal_id': dealerId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_dealer_renewal_' + docType).hide();
                $('.spinner_name_container_for_dealer_renewal_' + docType).show();
                validationMessageShow('dealer', textStatus.statusText);
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
                    validationMessageShow('dealer', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_dealer_renewal_' + docType).show();
                $('.spinner_name_container_for_dealer_renewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('import_model_name_container_for_dealer', 'import_model_name_image_for_dealer', 'import_model_container_for_dealer', 'import_model_for_dealer');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('original_licence_name_container_for_dealer', 'original_licence_name_image_for_dealer', 'original_licence_container_for_dealer', 'original_licence_for_dealer');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('renewed_licence_name_container_for_dealer', 'renewed_licence_name_image_for_dealer', 'renewed_licence_container_for_dealer', 'renewed_licence_for_dealer');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('periodical_return_name_container_for_dealer', 'periodical_return_name_image_for_dealer', 'periodical_return_container_for_dealer', 'periodical_return_for_dealer');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('verification_certificate_name_container_for_dealer', 'verification_certificate_name_image_for_dealer', 'verification_certificate_container_for_dealer', 'verification_certificate_for_dealer');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('seal_and_stamp_name_container_for_dealer', 'seal_and_stamp_name_image_for_dealer', 'seal_and_stamp_container_for_dealer', 'seal_and_stamp_for_dealer');
                }

            }
        });
    },
    addMultipleProprietor: function (templateData) {
        templateData.per_cnt = tempPersonCnt;
        $('#proprietor_info_container').append(dealerRenewalProprietorInfoTemplate(templateData));
        tempPersonCnt++;
        resetCounter('display-cnt');
    },
    removeProprietorInfo: function (perCnt) {
        $('#proprietor_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm1: function (dealerRenewalId) {
        if (!dealerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#dealer_renewal_id_for_dealer_renewal_form1').val(dealerRenewalId);
        $('#dealer_renewal_form1_pdf_form').submit();
        $('#dealer_renewal_id_for_dealer_renewal_form1').val('');
    },

    downloadUploadChallan: function (dealerRenewalId) {
        if (!dealerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + dealerRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dealer_renewal/get_dealer_renewal_data_by_dealer_renewal_id',
            type: 'post',
            data: $.extend({}, {'dealer_renewal_id': dealerRenewalId}, getTokenData()),
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
                var dealerData = parseData.dealer_renewal_data;
                that.showChallan(dealerData);
            }
        });
    },
    showChallan: function (dealerData) {
        showPopup();
        if (dealerData.status != VALUE_FIVE && dealerData.status != VALUE_SIX && dealerData.status != VALUE_SEVEN) {
            if (!dealerData.hide_submit_btn) {
                dealerData.show_fees_paid = true;
            }
        }
        if (dealerData.payment_type == VALUE_ONE) {
            dealerData.utitle = 'Fees Paid Challan Copy';
        } else {
            dealerData.style = 'display: none;';
        }
        if (dealerData.payment_type == VALUE_TWO) {
            dealerData.show_dd_po_option = true;
            dealerData.utitle = 'Demand Draft (DD)';
        }
        dealerData.module_type = VALUE_FIFTEEN;
        $('#popup_container').html(dealerRenewalUploadChallanTemplate(dealerData));
        loadFB(VALUE_FIFTEEN, dealerData.fb_data);
        loadPH(VALUE_FIFTEEN, dealerData.dealer_renewal_id, dealerData.ph_data);

        if (dealerData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'dealer_renewal_upload_challan', dealerData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'dealer_renewal_upload_challan', 'uc', 'radio');
            if (dealerData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_dealer_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (dealerData.challan != '') {
            $('#challan_container_for_dealer_renewal_upload_challan').hide();
            $('#challan_name_container_for_dealer_renewal_upload_challan').show();
            $('#challan_name_href_for_dealer_renewal_upload_challan').attr('href', 'documents/dealer/' + dealerData.challan);
            $('#challan_name_for_dealer_renewal_upload_challan').html(dealerData.challan);
        }
        if (dealerData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_dealer_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_dealer_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_dealer_renewal_upload_challan').attr('href', 'documents/dealer/' + dealerData.fees_paid_challan);
            $('#fees_paid_challan_name_for_dealer_renewal_upload_challan').html(dealerData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_dealer_renewal_upload_challan').attr('onclick', 'DealerRenewal.listview.removeFeesPaidChallan("' + dealerData.dealer_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (dealerRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!dealerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'dealer_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'dealer_renewal_id': dealerRenewalId}, getTokenData()),
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
                validationMessageShow('dealer-uc', textStatus.statusText);
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
                    validationMessageShow('dealer-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-dealer-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'dealer_renewal_upload_challan');
                $('#status_' + dealerRenewalId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-dealer-uc').html('');
        validationMessageHide();
        var dealerRenewalId = $('#dealer_renewal_id_for_dealer_renewal_upload_challan').val();
        if (!dealerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_dealer_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_dealer_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_dealer_renewal_upload_challan').focus();
                validationMessageShow('dealer-uc-fees_paid_challan_for_dealer_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_dealer_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_dealer_renewal_upload_challan').focus();
                validationMessageShow('dealer-uc-fees_paid_challan_for_dealer_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_dealer_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#dealer_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'dealer_renewal/upload_fees_paid_challan',
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
                validationMessageShow('dealer-uc', textStatus.statusText);
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
                    validationMessageShow('dealer-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + dealerRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (dealerRenewalId) {
        if (!dealerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#dealer_renewal_id_for_certificate').val(dealerRenewalId);
        $('#dealer_renewal_certificate_pdf_form').submit();
        $('#dealer_renewal_id_for_certificate').val('');
    },
    getQueryData: function (dealerRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!dealerRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FIFTEEN;
        templateData.module_id = dealerRenewalId;
        var btnObj = $('#query_btn_for_wm_' + dealerRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_FIFTEEN, moduleData.dealer_renewal_id);
                tmpData.applicant_name = moduleData.name_of_dealer;
                tmpData.title = 'Dealer Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getDealerData: function (btnObj) {
        var license_number = $('#admin_registration_number').val();
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
            url: 'dealer_renewal/get_dealer_data_by_id',
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
                dealerData = parseData.dealer_data;
                if (dealerData) {
                    $('#dealer_id').val(dealerData.dealer_id);
                    $('#name_of_dealer').val(dealerData.name_of_dealer);
                    $('#complete_address').val(dealerData.complete_address);
                    var establishment_date = dateTo_DD_MM_YYYY(dealerData.establishment_date);
                    $('#establishment_date').val(establishment_date);
                    $('#registration_date').val(dealerData.registration_date);
                    $('#registration_number').val(dealerData.registration_number);
                    $('#identity_number').val(dealerData.identity_number);
                    $('#identity_choice').val(dealerData.identity_choice);
                    $('#weights_type').val(dealerData.weights_type);
                    $('#categories_sold').val(dealerData.categories_sold);
                    $('#area_operate').val(dealerData.area_operate);
                    $('#signature').val(dealerData.signature);
                    var registration_date = dateTo_DD_MM_YYYY(dealerData.registration_date);
                    $('#registration_date').val(registration_date);
                    if (dealerData.is_limited_company == isChecked) {

                        $('#is_limited_company').attr('checked', 'checked');
                        $('.proprietor_info_div').show();

                        var proprietorInfo = JSON.parse(dealerData.proprietor_details);
                        $.each(proprietorInfo, function (key, value) {
                            that.addMultipleProprietor(value);
                        })
                    }
                    if (dealerData.import_from_outside == isChecked) {
                        $('#import_from_outside').attr('checked', 'checked');
                        $('.import_from_outside_div').show();
                        $('#registration_of_importer').val(dealerData.registration_of_importer);
                    }

                    $('#declarationone').attr('checked', 'checked');
                    $('#declarationtwo').attr('checked', 'checked');
                    $('#declarationthree').attr('checked', 'checked');

                    // if (dealerData.signature != '') {
                    //     $('#seal_and_stamp_container_for_dealer').hide();
                    //     $('#seal_and_stamp_name_image_for_dealer').attr('src', baseUrl + 'documents/dealer/' + dealerData.signature);
                    //     $('#seal_and_stamp_name_container_for_dealer').show();
                    // }
                    // if (dealerData.import_model != '') {
                    //     $('#import_model_container_for_dealer').hide();
                    //     $('#import_model_name_image_for_dealer').attr('src', baseUrl + 'documents/dealer/' + dealerData.import_model);
                    //     $('#import_model_name_container_for_dealer').show();
                    //     $('#import_model_name_image_for_dealer_download').attr("href", baseUrl + 'documents/dealer/' + dealerData.import_model);
                    // }
                }
            }
        });
    },

    uploadDocumentForDealerRenewal: function (fileNo) {
        var that = this;
        if ($('#import_model_for_dealer').val() != '') {
            var importModel = checkValidationForDocument('import_model_for_dealer', VALUE_ONE, 'dealer_renewal');
            if (importModel == false) {
                return false;
            }
        }
        if ($('#original_licence_for_dealer').val() != '') {
            var originalLicense = checkValidationForDocument('original_licence_for_dealer', VALUE_ONE, 'dealer');
            if (originalLicense == false) {
                return false;
            }
        }
        if ($('#renewed_licence_for_dealer').val() != '') {
            var renewalLicense = checkValidationForDocument('renewed_licence_for_dealer', VALUE_ONE, 'dealer');
            if (renewalLicense == false) {
                return false;
            }
        }
        if ($('#periodical_return_for_dealer').val() != '') {
            var periodicalReturn = checkValidationForDocument('periodical_return_for_dealer', VALUE_ONE, 'dealer');
            if (periodicalReturn == false) {
                return false;
            }
        }
        if ($('#verification_certificate_for_dealer').val() != '') {
            var VerificationCertificate = checkValidationForDocument('verification_certificate_for_dealer', VALUE_ONE, 'dealer');
            if (VerificationCertificate == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_dealer').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_dealer', VALUE_TWO, 'dealer');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_dealer_renewal_' + fileNo).hide();
        $('.spinner_name_container_for_dealer_renewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var dealerId = $('#dealer_renewal_id').val();
        var formData = new FormData($('#dealer_renewal_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("dealer_renewal_id", dealerId);
        $.ajax({
            type: 'POST',
            url: 'dealer_renewal/upload_dealer_renewal_document',
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
                $('.spinner_container_for_dealer_renewal_' + fileNo).show();
                $('.spinner_name_container_for_dealer_renewal_' + fileNo).hide();
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
                    $('.spinner_container_for_dealer_renewal_' + fileNo).show();
                    $('.spinner_name_container_for_dealer_renewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_dealer_renewal_' + fileNo).hide();
                $('.spinner_name_container_for_dealer_renewal_' + fileNo).show();
                $('#dealer_renewal_id').val(parseData.dealer_renewal_id);
                var dealerData = parseData.dealer_renewal_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('import_model_container_for_dealer', 'import_model_name_image_for_dealer', 'import_model_name_container_for_dealer',
                            'import_model_download', 'import_model', dealerData.import_model, parseData.dealer_renewal_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('original_licence_container_for_dealer', 'original_licence_name_image_for_dealer', 'original_licence_name_container_for_dealer',
                            'original_licence_download', 'original_licence', dealerData.original_licence, parseData.dealer_renewal_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('renewed_licence_container_for_dealer', 'renewed_licence_name_image_for_dealer', 'renewed_licence_name_container_for_dealer',
                            'renewed_licence_download', 'renewed_licence', dealerData.renewed_licence, parseData.dealer_renewal_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('periodical_return_container_for_dealer', 'periodical_return_name_image_for_dealer', 'periodical_return_name_container_for_dealer',
                            'periodical_return_download', 'periodical_return', dealerData.periodical_return, parseData.dealer_renewal_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('verification_certificate_container_for_dealer', 'verification_certificate_name_image_for_dealer', 'verification_certificate_name_container_for_dealer',
                            'verification_certificate_download', 'verification_certificate', dealerData.verification_certificate, parseData.dealer_renewal_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('seal_and_stamp_container_for_dealer', 'seal_and_stamp_name_image_for_dealer', 'seal_and_stamp_name_container_for_dealer',
                            'seal_and_stamp_download', 'seal_and_stamp', dealerData.signature, parseData.dealer_renewal_id, VALUE_SIX);
                }

            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/dealer/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/dealer/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'DealerRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});