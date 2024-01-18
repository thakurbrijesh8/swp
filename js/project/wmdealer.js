var dealerListTemplate = Handlebars.compile($('#dealer_list_template').html());
var dealerTableTemplate = Handlebars.compile($('#dealer_table_template').html());
var dealerActionTemplate = Handlebars.compile($('#dealer_action_template').html());
var dealerFormTemplate = Handlebars.compile($('#dealer_form_template').html());
var dealerViewTemplate = Handlebars.compile($('#dealer_view_template').html());
var dealerProprietorInfoTemplate = Handlebars.compile($('#dealer_proprietor_info_template').html());
var dealerUploadChallanTemplate = Handlebars.compile($('#dealer_upload_challan_template').html());

var tempPersonCnt = 1;

var Dealer = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Dealer.Router = Backbone.Router.extend({
    routes: {
        'dealer': 'renderList',
        'dealer_form': 'renderListForForm',
        'edit_dealer_form': 'renderList',
        'view_dealer_form': 'renderList',
    },
    renderList: function () {
        Dealer.listview.listPage();
    },
    renderListForForm: function () {
        Dealer.listview.listPageDealerForm();
    }
});
Dealer.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="import_from_outside"]': 'hasOutsideImportEvent',
        'click input[name="any_previous_application"]': 'hasAnyPreviousApplicationsEvent',
        'click input[name="is_limited_company"]': 'hasLimitedCompanyEvent',
    },
    hasOutsideImportEvent: function (event) {
        var val = $('input[name=import_from_outside]:checked').val();
        if (val === '1') {
            this.$('.import_from_outside_div').show();
        } else {
            this.$('.import_from_outside_div').hide();

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
//        addClass('dealer', 'active');
        Dealer.router.navigate('dealer');
        var templateData = {};
        this.$el.html(dealerListTemplate(templateData));
        this.loadDealerData(sDistrict, sStatus);

    },
    listPageDealerForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('dealer', 'active');
        this.$el.html(dealerListTemplate);
        this.newDealerForm(false, {});
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
        return dealerActionTemplate(rowData);
    },
    loadDealerData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THREE, data)
                    + getFRContainer(VALUE_THREE, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Dealer.router.navigate('dealer');
        $('#dealer_form_and_datatable_container').html(dealerTableTemplate(searchData));
        dealerDataTable = $('#dealer_datatable').DataTable({
            ajax: {url: 'dealer/get_dealer_data', dataSrc: "dealer_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'dealer_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_dealer', 'class': 'text-center'},
                {data: 'complete_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'dealer_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'dealer_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#dealer_datatable tbody').on('click', 'td.details-control', function () {
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
    newDealerForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.dealer_data;
            Dealer.router.navigate('edit_dealer_form');
        } else {
            var formData = {};
            Dealer.router.navigate('dealer_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.dealer_data = parseData.dealer_data;
        templateData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        templateData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        templateData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        $('#dealer_form_and_datatable_container').html(dealerFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');

        renderOptionsForTwoDimensionalArray(identityChoiceArray, 'identity_choice', false);
        if (isEdit) {

            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#declarationone').attr('checked', 'checked');
            $('#declarationtwo').attr('checked', 'checked');
            $('#declarationthree').attr('checked', 'checked');


            $('#identity_choice').val(formData.identity_choice);

            if (formData.import_model != '') {
                that.showDocument('import_model_container_for_dealer', 'import_model_name_image_for_dealer', 'import_model_name_container_for_dealer',
                        'import_model_download', 'import_model', formData.import_model, formData.dealer_id, VALUE_ONE);
            }
            if (formData.model_approval_certificate != '') {
                that.showDocument('model_approval_certificate_container_for_dealer', 'model_approval_certificate_name_image_for_dealer', 'model_approval_certificate_name_container_for_dealer',
                        'model_approval_certificate_download', 'model_approval_certificate', formData.model_approval_certificate, formData.dealer_id, VALUE_TWO);
            }
            if (formData.proof_of_ownership != '') {
                that.showDocument('proof_of_ownership_container_for_dealer', 'proof_of_ownership_name_image_for_dealer', 'proof_of_ownership_name_container_for_dealer',
                        'proof_of_ownership_download', 'proof_of_ownership', formData.proof_of_ownership, formData.dealer_id, VALUE_THREE);
            }
            if (formData.gst_certificate != '') {
                that.showDocument('gst_certificate_container_for_dealer', 'gst_certificate_name_image_for_dealer', 'gst_certificate_name_container_for_dealer',
                        'gst_certificate_download', 'gst_certificate', formData.gst_certificate, formData.dealer_id, VALUE_FOUR);
            }
            if (formData.partnership_deed != '') {
                that.showDocument('partnership_deed_container_for_dealer', 'partnership_deed_name_image_for_dealer', 'partnership_deed_name_container_for_dealer',
                        'partnership_deed_download', 'partnership_deed', formData.partnership_deed, formData.dealer_id, VALUE_FIVE);
            }
            if (formData.memorandum_of_association != '') {
                that.showDocument('memorandum_of_association_container_for_dealer', 'memorandum_of_association_name_image_for_dealer', 'memorandum_of_association_name_container_for_dealer',
                        'memorandum_of_association_download', 'memorandum_of_association', formData.memorandum_of_association, formData.dealer_id, VALUE_SIX);
            }
            if (formData.list_of_raw_material != '') {
                that.showDocument('list_of_raw_material_container_for_dealer', 'list_of_raw_material_name_image_for_dealer', 'list_of_raw_material_name_container_for_dealer',
                        'list_of_raw_material_download', 'list_of_raw_material', formData.list_of_raw_material, formData.dealer_id, VALUE_SEVEN);
            }
            if (formData.list_of_machinery != '') {
                that.showDocument('list_of_machinery_container_for_dealer', 'list_of_machinery_name_image_for_dealer', 'list_of_machinery_name_container_for_dealer',
                        'list_of_machinery_download', 'list_of_machinery', formData.list_of_machinery, formData.dealer_id, VALUE_EIGHT);
            }
            if (formData.list_of_wm != '') {
                that.showDocument('list_of_wm_container_for_dealer', 'list_of_wm_name_image_for_dealer', 'list_of_wm_name_container_for_dealer',
                        'list_of_wm_download', 'list_of_wm', formData.list_of_wm, formData.dealer_id, VALUE_NINE);
            }
            if (formData.list_of_directors != '') {
                that.showDocument('list_of_directors_container_for_dealer', 'list_of_directors_name_image_for_dealer', 'list_of_directors_name_container_for_dealer',
                        'list_of_directors_download', 'list_of_directors', formData.list_of_directors, formData.dealer_id, VALUE_TEN);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_dealer', 'seal_and_stamp_name_image_for_dealer', 'seal_and_stamp_name_container_for_dealer',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.dealer_id, VALUE_ELEVEN);
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
        $('#dealer_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDealer($('#submit_btn_for_dealer'));
            }
        });
    },
    editOrViewDealer: function (btnObj, dealerId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!dealerId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dealer/get_dealer_data_by_id',
            type: 'post',
            data: $.extend({}, {'dealer_id': dealerId}, getTokenData()),
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
                    that.newDealerForm(isEdit, parseData);
                } else {
                    that.viewDealerForm(parseData);
                }
            }
        });
    },
    viewDealerForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.dealer_data;
        Dealer.router.navigate('view_dealer_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#dealer_form_and_datatable_container').html(dealerViewTemplate(formData));
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
        if (formData.model_approval_certificate != '') {
            that.showDocument('model_approval_certificate_container_for_dealer', 'model_approval_certificate_name_image_for_dealer', 'model_approval_certificate_name_container_for_dealer',
                    'model_approval_certificate_download', 'model_approval_certificate', formData.model_approval_certificate);
        }
        if (formData.proof_of_ownership != '') {
            that.showDocument('proof_of_ownership_container_for_dealer', 'proof_of_ownership_name_image_for_dealer', 'proof_of_ownership_name_container_for_dealer',
                    'proof_of_ownership_download', 'proof_of_ownership', formData.proof_of_ownership);
        }
        if (formData.gst_certificate != '') {
            that.showDocument('gst_certificate_container_for_dealer', 'gst_certificate_name_image_for_dealer', 'gst_certificate_name_container_for_dealer',
                    'gst_certificate_download', 'gst_certificate', formData.gst_certificate);
        }
        if (formData.partnership_deed != '') {
            that.showDocument('partnership_deed_container_for_dealer', 'partnership_deed_name_image_for_dealer', 'partnership_deed_name_container_for_dealer',
                    'partnership_deed_download', 'partnership_deed', formData.partnership_deed);
        }
        if (formData.memorandum_of_association != '') {
            that.showDocument('memorandum_of_association_container_for_dealer', 'memorandum_of_association_name_image_for_dealer', 'memorandum_of_association_name_container_for_dealer',
                    'memorandum_of_association_download', 'memorandum_of_association', formData.memorandum_of_association);
        }
        if (formData.list_of_raw_material != '') {
            that.showDocument('list_of_raw_material_container_for_dealer', 'list_of_raw_material_name_image_for_dealer', 'list_of_raw_material_name_container_for_dealer',
                    'list_of_raw_material_download', 'list_of_raw_material', formData.list_of_raw_material);
        }
        if (formData.list_of_machinery != '') {
            that.showDocument('list_of_machinery_container_for_dealer', 'list_of_machinery_name_image_for_dealer', 'list_of_machinery_name_container_for_dealer',
                    'list_of_machinery_download', 'list_of_machinery', formData.list_of_machinery);
        }
        if (formData.list_of_wm != '') {
            that.showDocument('list_of_wm_container_for_dealer', 'list_of_wm_name_image_for_dealer', 'list_of_wm_name_container_for_dealer',
                    'list_of_wm_download', 'list_of_wm', formData.list_of_wm);
        }
        if (formData.list_of_directors != '') {
            that.showDocument('list_of_directors_container_for_dealer', 'list_of_directors_name_image_for_dealer', 'list_of_directors_name_container_for_dealer',
                    'list_of_directors_download', 'list_of_directors', formData.list_of_directors);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_dealer', 'seal_and_stamp_name_image_for_dealer', 'seal_and_stamp_name_container_for_dealer',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }
    },
    checkValidationForDealer: function (dealerData) {
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
        if (dealerData.any_previous_application == isChecked) {
            if (!dealerData.license_application_date) {
                return getBasicMessageAndFieldJSONArray('license_application_date', appliedDateValidationMessage);
            }
            if (!dealerData.license_application_result) {
                return getBasicMessageAndFieldJSONArray('license_application_result', licenseResultValidationMessage);
            }
        }
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
    askForSubmitDealer: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Dealer.listview.submitDealer(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitDealer: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var dealerData = $('#dealer_form').serializeFormJSON();
        var validationData = that.checkValidationForDealer(dealerData);
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
        if ($('#model_approval_certificate_container_for_dealer').is(':visible')) {
            var modelApproval = checkValidationForDocument('model_approval_certificate_for_dealer', VALUE_ONE, 'dealer');
            if (modelApproval == false) {
                return false;
            }
        }

        if ($('#proof_of_ownership_container_for_dealer').is(':visible')) {
            var proofOfOwnership = checkValidationForDocument('proof_of_ownership_for_dealer', VALUE_ONE, 'dealer');
            if (proofOfOwnership == false) {
                return false;
            }
        }
        if ($('#gst_certificate_container_for_dealer').is(':visible')) {
            var gstCertificate = checkValidationForDocument('gst_certificate_for_dealer', VALUE_ONE, 'dealer');
            if (gstCertificate == false) {
                return false;
            }
        }

        if ($('#partnership_deed_container_for_dealer').is(':visible')) {
            var partnershipDeed = checkValidationForDocument('partnership_deed_for_dealer', VALUE_ONE, 'dealer');
            if (partnershipDeed == false) {
                return false;
            }
        }
        if ($('#memorandum_of_association_container_for_dealer').is(':visible')) {
            var memorandumofAssociation = checkValidationForDocument('memorandum_of_association_for_dealer', VALUE_ONE, 'dealer');
            if (memorandumofAssociation == false) {
                return false;
            }
        }

        if ($('#list_of_raw_material_container_for_dealer').is(':visible')) {
            var listofrawMaterial = checkValidationForDocument('list_of_raw_material_for_dealer', VALUE_ONE, 'dealer');
            if (listofrawMaterial == false) {
                return false;
            }
        }
        if ($('#list_of_machinery_container_for_dealer').is(':visible')) {
            var listofMachinery = checkValidationForDocument('list_of_machinery_for_dealer', VALUE_ONE, 'dealer');
            if (listofMachinery == false) {
                return false;
            }
        }

        if ($('#list_of_wm_container_for_dealer').is(':visible')) {
            var listofWm = checkValidationForDocument('list_of_wm_for_dealer', VALUE_ONE, 'dealer');
            if (listofWm == false) {
                return false;
            }
        }
        if ($('#list_of_directors_container_for_dealer').is(':visible')) {
            var listOfDirectors = checkValidationForDocument('list_of_directors_for_dealer', VALUE_ONE, 'dealer');
            if (listOfDirectors == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_dealer').is(':visible')) {
            var sealandstamp = checkValidationForDocument('seal_and_stamp_for_dealer', VALUE_TWO, 'dealer');
            if (sealandstamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_dealer') : $('#submit_btn_for_dealer');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var dealerData = new FormData($('#dealer_form')[0]);
        dealerData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        dealerData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        dealerData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'dealer/submit_dealer',
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
                Dealer.router.navigate('dealer', {'trigger': true});
            }
        });
    },

    askForRemove: function (dealerId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!dealerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Dealer.listview.removeDocument(\'' + dealerId + '\',\'' + docType + '\')';
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
        $('.spinner_container_for_dealer_' + docType).hide();
        $('.spinner_name_container_for_dealer_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'dealer/remove_document',
            data: $.extend({}, {'dealer_id': dealerId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_dealer_' + docType).hide();
                $('.spinner_name_container_for_dealer_' + docType).show();
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
                $('.spinner_container_for_dealer_' + docType).show();
                $('.spinner_name_container_for_dealer_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('import_model_name_container_for_dealer', 'import_model_name_image_for_dealer', 'import_model_container_for_dealer', 'import_model_for_dealer');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('model_approval_certificate_name_container_for_dealer', 'model_approval_certificate_name_image_for_dealer', 'model_approval_certificate_container_for_dealer', 'model_approval_certificate_for_dealer');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('proof_of_ownership_name_container_for_dealer', 'proof_of_ownership_name_image_for_dealer', 'proof_of_ownership_container_for_dealer', 'proof_of_ownership_for_dealer');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('gst_certificate_name_container_for_dealer', 'gst_certificate_name_image_for_dealer', 'gst_certificate_container_for_dealer', 'gst_certificate_for_dealer');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('partnership_deed_name_container_for_dealer', 'partnership_deed_name_image_for_dealer', 'partnership_deed_container_for_dealer', 'partnership_deed_for_dealer');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('memorandum_of_association_name_container_for_dealer', 'memorandum_of_association_name_image_for_dealer', 'memorandum_of_association_container_for_dealer', 'memorandum_of_association_for_dealer');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('list_of_raw_material_name_container_for_dealer', 'list_of_raw_material_name_image_for_dealer', 'list_of_raw_material_container_for_dealer', 'list_of_raw_material_for_dealer');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('list_of_machinery_name_container_for_dealer', 'list_of_machinery_name_image_for_dealer', 'list_of_machinery_container_for_dealer', 'list_of_machinery_for_dealer');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('list_of_wm_name_container_for_dealer', 'list_of_wm_name_image_for_dealer', 'list_of_wm_container_for_dealer', 'list_of_wm_for_dealer');
                }
                if (docType == VALUE_TEN) {
                    removeDocumentValue('list_of_directors_name_container_for_dealer', 'list_of_directors_name_image_for_dealer', 'list_of_directors_container_for_dealer', 'list_of_directors_for_dealer');
                }
                if (docType == VALUE_ELEVEN) {
                    removeDocumentValue('seal_and_stamp_name_container_for_dealer', 'seal_and_stamp_name_image_for_dealer', 'seal_and_stamp_container_for_dealer', 'seal_and_stamp_for_dealer');
                }

            }
        });
    },
    addMultipleProprietor: function (templateData) {
        templateData.per_cnt = tempPersonCnt;
        $('#proprietor_info_container').append(dealerProprietorInfoTemplate(templateData));
        tempPersonCnt++;
        resetCounter('display-cnt');
    },
    removeProprietorInfo: function (perCnt) {
        $('#proprietor_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm1: function (dealerId) {
        if (!dealerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#dealer_id_for_dealer_form1').val(dealerId);
        $('#dealer_form1_pdf_form').submit();
        $('#dealer_id_for_dealer_form1').val('');
    },

    downloadUploadChallan: function (dealerId) {
        if (!dealerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + dealerId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dealer/get_dealer_data_by_dealer_id',
            type: 'post',
            data: $.extend({}, {'dealer_id': dealerId}, getTokenData()),
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
                var dealerData = parseData.dealer_data;
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
        dealerData.module_type = VALUE_THREE;
        $('#popup_container').html(dealerUploadChallanTemplate(dealerData));
        loadFB(VALUE_THREE, dealerData.fb_data);
        loadPH(VALUE_THREE, dealerData.dealer_id, dealerData.ph_data);

        if (dealerData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'dealer_upload_challan', dealerData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'dealer_upload_challan', 'uc', 'radio');
            if (dealerData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_dealer_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (dealerData.challan != '') {
            $('#challan_container_for_dealer_upload_challan').hide();
            $('#challan_name_container_for_dealer_upload_challan').show();
            $('#challan_name_href_for_dealer_upload_challan').attr('href', 'documents/dealer/' + dealerData.challan);
            $('#challan_name_for_dealer_upload_challan').html(dealerData.challan);
        }
        if (dealerData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_dealer_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_dealer_upload_challan').show();
            $('#fees_paid_challan_name_href_for_dealer_upload_challan').attr('href', 'documents/dealer/' + dealerData.fees_paid_challan);
            $('#fees_paid_challan_name_for_dealer_upload_challan').html(dealerData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_dealer_upload_challan').attr('onclick', 'Dealer.listview.removeFeesPaidChallan("' + dealerData.dealer_id + '")');
        }
    },
    removeFeesPaidChallan: function (dealerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!dealerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'dealer/remove_fees_paid_challan',
            data: $.extend({}, {'dealer_id': dealerId}, getTokenData()),
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
                removeDocument('fees_paid_challan', 'dealer_upload_challan');
                $('#status_' + dealerId).html(appStatusArray[VALUE_THREE]);
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
        var dealerId = $('#dealer_id_for_dealer_upload_challan').val();
        if (!dealerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_dealer_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_dealer_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_dealer_upload_challan').focus();
                validationMessageShow('dealer-uc-fees_paid_challan_for_dealer_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_dealer_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_dealer_upload_challan').focus();
                validationMessageShow('dealer-uc-fees_paid_challan_for_dealer_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_dealer_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#dealer_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'dealer/upload_fees_paid_challan',
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
                $('#status_' + dealerId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (dealerId) {
        if (!dealerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#dealer_id_for_certificate').val(dealerId);
        $('#dealer_certificate_pdf_form').submit();
        $('#dealer_id_for_certificate').val('');
    },
    getQueryData: function (dealerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!dealerId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THREE;
        templateData.module_id = dealerId;
        var btnObj = $('#query_btn_for_wm_' + dealerId);
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
                tmpData.application_number = regNoRenderer(VALUE_THREE, moduleData.dealer_id);
                tmpData.applicant_name = moduleData.name_of_dealer;
                tmpData.title = 'Dealer Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForDealer: function (fileNo) {
        var that = this;
        if ($('#import_model_for_dealer').val() != '') {
            var importModel = checkValidationForDocument('import_model_for_dealer', VALUE_ONE, 'dealer');
            if (importModel == false) {
                return false;
            }
        }
        if ($('#model_approval_certificate_for_dealer').val() != '') {
            var modelApproval = checkValidationForDocument('model_approval_certificate_for_dealer', VALUE_ONE, 'dealer');
            if (modelApproval == false) {
                return false;
            }
        }
        if ($('#proof_of_ownership_for_dealer').val() != '') {
            var proofOfOwnership = checkValidationForDocument('proof_of_ownership_for_dealer', VALUE_ONE, 'dealer');
            if (proofOfOwnership == false) {
                return false;
            }
        }
        if ($('#gst_certificate_for_dealer').val() != '') {
            var gstCertificate = checkValidationForDocument('gst_certificate_for_dealer', VALUE_ONE, 'dealer');
            if (gstCertificate == false) {
                return false;
            }
        }
        if ($('#partnership_deed_for_dealer').val() != '') {
            var partnershipDeed = checkValidationForDocument('partnership_deed_for_dealer', VALUE_ONE, 'dealer');
            if (partnershipDeed == false) {
                return false;
            }
        }
        if ($('#memorandum_of_association_for_dealer').val() != '') {
            var memorandumofAssociation = checkValidationForDocument('memorandum_of_association_for_dealer', VALUE_ONE, 'dealer');
            if (memorandumofAssociation == false) {
                return false;
            }
        }
        if ($('#list_of_raw_material_for_dealer').val() != '') {
            var listofrawMaterial = checkValidationForDocument('list_of_raw_material_for_dealer', VALUE_ONE, 'dealer');
            if (listofrawMaterial == false) {
                return false;
            }
        }
        if ($('#list_of_machinery_for_dealer').val() != '') {
            var listofMachinery = checkValidationForDocument('list_of_machinery_for_dealer', VALUE_ONE, 'dealer');
            if (listofMachinery == false) {
                return false;
            }
        }
        if ($('#list_of_wm_for_dealer').val() != '') {
            var listofWm = checkValidationForDocument('list_of_wm_for_dealer', VALUE_ONE, 'dealer');
            if (listofWm == false) {
                return false;
            }
        }
        if ($('#list_of_directors_for_dealer').val() != '') {
            var listOfDirectors = checkValidationForDocument('list_of_directors_for_dealer', VALUE_ONE, 'dealer');
            if (listOfDirectors == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_for_dealer').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_dealer', VALUE_TWO, 'dealer');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_dealer_' + fileNo).hide();
        $('.spinner_name_container_for_dealer_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var dealerId = $('#dealer_id').val();
        var formData = new FormData($('#dealer_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("dealer_id", dealerId);
        $.ajax({
            type: 'POST',
            url: 'dealer/upload_dealer_document',
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
                $('.spinner_container_for_dealer_' + fileNo).show();
                $('.spinner_name_container_for_dealer_' + fileNo).hide();
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
                    $('.spinner_container_for_dealer_' + fileNo).show();
                    $('.spinner_name_container_for_dealer_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_dealer_' + fileNo).hide();
                $('.spinner_name_container_for_dealer_' + fileNo).show();
                $('#dealer_id').val(parseData.dealer_id);
                var dealerData = parseData.dealer_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('import_model_container_for_dealer', 'import_model_name_image_for_dealer', 'import_model_name_container_for_dealer',
                            'import_model_download', 'import_model', dealerData.import_model, parseData.dealer_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('model_approval_certificate_container_for_dealer', 'model_approval_certificate_name_image_for_dealer', 'model_approval_certificate_name_container_for_dealer',
                            'model_approval_certificate_download', 'model_approval_certificate', dealerData.model_approval_certificate, parseData.dealer_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('proof_of_ownership_container_for_dealer', 'proof_of_ownership_name_image_for_dealer', 'proof_of_ownership_name_container_for_dealer',
                            'proof_of_ownership_download', 'proof_of_ownership', dealerData.proof_of_ownership, parseData.dealer_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('gst_certificate_container_for_dealer', 'gst_certificate_name_image_for_dealer', 'gst_certificate_name_container_for_dealer',
                            'gst_certificate_download', 'gst_certificate', dealerData.gst_certificate, parseData.dealer_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('partnership_deed_container_for_dealer', 'partnership_deed_name_image_for_dealer', 'partnership_deed_name_container_for_dealer',
                            'partnership_deed_download', 'partnership_deed', dealerData.partnership_deed, parseData.dealer_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('memorandum_of_association_container_for_dealer', 'memorandum_of_association_name_image_for_dealer', 'memorandum_of_association_name_container_for_dealer',
                            'memorandum_of_association_download', 'memorandum_of_association', dealerData.memorandum_of_association, parseData.dealer_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('list_of_raw_material_container_for_dealer', 'list_of_raw_material_name_image_for_dealer', 'list_of_raw_material_name_container_for_dealer',
                            'list_of_raw_material_download', 'list_of_raw_material', dealerData.memorandum_of_association, parseData.dealer_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('list_of_machinery_container_for_dealer', 'list_of_machinery_name_image_for_dealer', 'list_of_machinery_name_container_for_dealer',
                            'list_of_machinery_download', 'list_of_machinery', dealerData.list_of_machinery, parseData.dealer_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('list_of_wm_container_for_dealer', 'list_of_wm_name_image_for_dealer', 'list_of_wm_name_container_for_dealer',
                            'list_of_wm_download', 'list_of_wm', dealerData.list_of_wm, parseData.dealer_id, VALUE_NINE);
                }
                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('list_of_directors_container_for_dealer', 'list_of_directors_name_image_for_dealer', 'list_of_directors_name_container_for_dealer',
                            'list_of_directors_download', 'list_of_directors', dealerData.list_of_directors, parseData.dealer_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('seal_and_stamp_container_for_dealer', 'seal_and_stamp_name_image_for_dealer', 'seal_and_stamp_name_container_for_dealer',
                            'seal_and_stamp_download', 'seal_and_stamp', dealerData.signature, parseData.dealer_id, VALUE_ELEVEN);
                }

            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/dealer/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/dealer/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Dealer.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});