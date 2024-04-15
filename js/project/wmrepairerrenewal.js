var repairerRenewalListTemplate = Handlebars.compile($('#repairer_renewal_list_template').html());
var repairerRenewalTableTemplate = Handlebars.compile($('#repairer_renewal_table_template').html());
var repairerRenewalActionTemplate = Handlebars.compile($('#repairer_renewal_action_template').html());
var repairerRenewalFormTemplate = Handlebars.compile($('#repairer_renewal_form_template').html());
var repairerRenewalViewTemplate = Handlebars.compile($('#repairer_renewal_view_template').html());
var repairerRenewalProprietorInfoTemplate = Handlebars.compile($('#repairer_renewal_proprietor_info_template').html());
var repairerRenewalUploadChallanTemplate = Handlebars.compile($('#repairer_renewal_upload_challan_template').html());

var tempPersonCnt = 1;

var RepairerRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
RepairerRenewal.Router = Backbone.Router.extend({
    routes: {
        'repairer_renewal': 'renderList',
        'repairer_renewal_form': 'renderListForForm',
        'edit_repairer_renewal_form': 'renderList',
        'view_repairer_renewal_form': 'renderList',
    },
    renderList: function () {
        RepairerRenewal.listview.listPage();
    },
    renderListForForm: function () {
        RepairerRenewal.listview.listPageRepairerRenewalForm();
    }
});
RepairerRenewal.listView = Backbone.View.extend({
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
//        addClass('repairer_renewal', 'active');
        RepairerRenewal.router.navigate('repairer_renewal');
        var templateData = {};
        this.$el.html(repairerRenewalListTemplate(templateData));
        this.loadRepairerRenewalData(sDistrict, sStatus);

    },
    listPageRepairerRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('repairer_renewal', 'active');
        this.$el.html(repairerRenewalListTemplate);
        this.newRepairerRenewalForm(false, {});
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
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE || rowData.status == VALUE_TWO || rowData.status == VALUE_THREE) {
            rowData.show_withdraw_application_btn = true;
        }
        return repairerRenewalActionTemplate(rowData);
    },
    loadRepairerRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTEEN, data)
                    + getFRContainer(VALUE_FOURTEEN, data, full.rating, full.fr_datetime);
        };
        var that = this;
        RepairerRenewal.router.navigate('repairer_renewal');
        $('#repairer_renewal_form_and_datatable_container').html(repairerRenewalTableTemplate(searchData));
        repairerDataTable = $('#repairer_renewal_datatable').DataTable({
            ajax: {url: 'repairer_renewal/get_repairer_renewal_data', dataSrc: "repairer_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'repairer_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_repairer', 'class': 'text-center'},
                {data: 'complete_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'repairer_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'repairer_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#repairer_renewal_datatable tbody').on('click', 'td.details-control', function () {
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
    newRepairerRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.repairer_renewal_data;
            RepairerRenewal.router.navigate('edit_repairer_renewal_form');
        } else {
            var formData = {};
            RepairerRenewal.router.navigate('repairer_renewal_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.repairer_renewal_data = parseData.repairer_renewal_data;
        templateData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        $('#repairer_renewal_form_and_datatable_container').html(repairerRenewalFormTemplate((templateData)));
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


            if (formData.original_licence != '') {
                that.showDocument('original_licence_container_for_repairer', 'original_licence_name_image_for_repairer', 'original_licence_name_container_for_repairer',
                        'original_licence_download', 'original_licence', formData.original_licence, formData.repairer_renewal_id, VALUE_ONE);
            }
            if (formData.renewed_licence != '') {
                that.showDocument('renewed_licence_container_for_repairer', 'renewed_licence_name_image_for_repairer', 'renewed_licence_name_container_for_repairer',
                        'renewed_licence_download', 'renewed_licence', formData.renewed_licence, formData.repairer_renewal_id, VALUE_TWO);
            }
            if (formData.periodical_return != '') {
                that.showDocument('periodical_return_container_for_repairer', 'periodical_return_name_image_for_repairer', 'periodical_return_name_container_for_repairer',
                        'periodical_return_download', 'periodical_return', formData.periodical_return, formData.repairer_renewal_id, VALUE_THREE);
            }
            if (formData.verification_certificate != '') {
                that.showDocument('verification_certificate_container_for_repairer', 'verification_certificate_name_image_for_repairer', 'verification_certificate_name_container_for_repairer',
                        'verification_certificate_download', 'verification_certificate', formData.verification_certificate, formData.repairer_renewal_id, VALUE_FOUR);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_repairer', 'seal_and_stamp_name_image_for_repairer', 'seal_and_stamp_name_container_for_repairer',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.repairer_renewal_id, VALUE_FIVE);
            }

            this.$('.proprietor_info_div').show();

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
        }

        generateSelect2();
        datePicker();
        $('#repairer_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitRepairerRenewal($('#submit_btn_for_repairer'));
            }
        });
    },
    editOrViewRepairerRenewal: function (btnObj, repairerRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!repairerRenewalId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'repairer_renewal/get_repairer_renewal_data_by_repairer_renewal_id',
            type: 'post',
            data: $.extend({}, {'repairer_renewal_id': repairerRenewalId}, getTokenData()),
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
                    that.newRepairerRenewalForm(isEdit, parseData);
                } else {
                    that.viewRepairerRenewalForm(parseData);
                }
            }
        });
    },
    viewRepairerRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.repairer_renewal_data;
        RepairerRenewal.router.navigate('view_repairer_renewal_form');
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#repairer_renewal_form_and_datatable_container').html(repairerRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#declarationone').attr('checked', 'checked');
        $('#declarationtwo').attr('checked', 'checked');
        $('#declarationthree').attr('checked', 'checked');
        $('#identity_choice').val(formData.identity_choice);



        if (formData.original_licence != '') {
            that.showDocument('original_licence_container_for_repairer', 'original_licence_name_image_for_repairer', 'original_licence_name_container_for_repairer',
                    'original_licence_download', 'original_licence', formData.original_licence);
        }
        if (formData.renewed_licence != '') {
            that.showDocument('renewed_licence_container_for_repairer', 'renewed_licence_name_image_for_repairer', 'renewed_licence_name_container_for_repairer',
                    'renewed_licence_download', 'renewed_licence', formData.renewed_licence);
        }
        if (formData.periodical_return != '') {
            that.showDocument('periodical_return_container_for_repairer', 'periodical_return_name_image_for_repairer', 'periodical_return_name_container_for_repairer',
                    'periodical_return_download', 'periodical_return', formData.periodical_return);
        }
        if (formData.verification_certificate != '') {
            that.showDocument('verification_certificate_container_for_repairer', 'verification_certificate_name_image_for_repairer', 'verification_certificate_name_container_for_repairer',
                    'verification_certificate_download', 'verification_certificate', formData.verification_certificate);
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

    },
    checkValidationForRepairerRenewal: function (repairerData) {
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
        if (!repairerData.admin_registration_number) {
            return getBasicMessageAndFieldJSONArray('admin_registration_number', licenseNumberValidationMessage);
        }
        if (!repairerData.name_of_repairmen) {
            return getBasicMessageAndFieldJSONArray('name_of_repairmen', repairmenNameValidationMessage);
        }
        if (!repairerData.complete_address) {
            return getBasicMessageAndFieldJSONArray('complete_address', workshopAddressValidationMessage);
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
        if (repairerData.sufficient_stock == isChecked) {
            if (!repairerData.stock_details) {
                return getBasicMessageAndFieldJSONArray('stock_details', stockDetailValidationMessage);
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
    askForSubmitRepairerRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'RepairerRenewal.listview.submitRepairerRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitRepairerRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var repairerData = $('#repairer_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForRepairerRenewal(repairerData);
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


        if ($('#original_licence_container_for_repairer').is(':visible')) {
            var originalLicense = checkValidationForDocument('original_licence_for_repairer', VALUE_ONE, 'repairer');
            if (originalLicense == false) {
                return false;
            }
        }
        if ($('#renewed_licence_container_for_repairer').is(':visible')) {
            var renewedLicense = checkValidationForDocument('renewed_licence_for_repairer', VALUE_ONE, 'repairer');
            if (renewedLicense == false) {
                return false;
            }
        }
        if ($('#periodical_return_container_for_repairer').is(':visible')) {
            var periodicalReturn = checkValidationForDocument('periodical_return_for_repairer', VALUE_ONE, 'repairer');
            if (periodicalReturn == false) {
                return false;
            }
        }
        if ($('#verification_certificate_container_for_repairer').is(':visible')) {
            var VerificationCertificate = checkValidationForDocument('verification_certificate_for_repairer', VALUE_ONE, 'repairer');
            if (VerificationCertificate == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_repairer').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_repairer', VALUE_TWO, 'repairer');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_repairer') : $('#submit_btn_for_repairer');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var repairerData = new FormData($('#repairer_renewal_form')[0]);
        repairerData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        repairerData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        repairerData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'repairer_renewal/submit_repairer_renewal',
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
                RepairerRenewal.router.navigate('repairer_renewal', {'trigger': true});
            }
        });
    },

    askForRemove: function (repairerRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!repairerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'RepairerRenewal.listview.removeDocument(\'' + repairerRenewalId + '\',\'' + docType + '\')';
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
        $('.spinner_container_for_repairer_renewal_' + docType).hide();
        $('.spinner_name_container_for_repairer_renewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'repairer_renewal/remove_document',
            data: $.extend({}, {'repairer_renewal_id': repairerId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_repairer_renewal_' + docType).hide();
                $('.spinner_name_container_for_repairer_renewal_' + docType).show();
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
                $('.spinner_container_for_repairer_renewal_' + docType).show();
                $('.spinner_name_container_for_repairer_renewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('original_licence_name_container_for_repairer', 'original_licence_name_image_for_repairer', 'original_licence_container_for_repairer', 'original_licence_for_repairer');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('renewed_licence_name_container_for_repairer', 'renewed_licence_name_image_for_repairer', 'renewed_licence_container_for_repairer', 'renewed_licence_for_repairer');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('periodical_return_name_container_for_repairer', 'periodical_return_name_image_for_repairer', 'periodical_return_container_for_repairer', 'periodical_return_for_repairer');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('verification_certificate_name_container_for_repairer', 'verification_certificate_name_image_for_repairer', 'verification_certificate_container_for_repairer', 'verification_certificate_for_repairer');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_repairer', 'seal_and_stamp_name_image_for_repairer', 'seal_and_stamp_container_for_repairer', 'seal_and_stamp_for_repairer');
                }
            }
        });
    },
    addMultipleProprietor: function (templateData) {
        templateData.per_cnt = tempPersonCnt;
        $('#proprietor_info_container').append(repairerRenewalProprietorInfoTemplate(templateData));
        tempPersonCnt++;
        resetCounter('display-cnt');
    },
    removeProprietorInfo: function (perCnt) {
        $('#proprietor_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm1: function (repairerRenewalId) {
        if (!repairerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#repairer_renewal_id_for_repairer_renewal_form1').val(repairerRenewalId);
        $('#repairer_renewal_form1_pdf_form').submit();
        $('#repairer_renewal_id_for_repairer_renewal_form1').val('');
    },

    downloadUploadChallan: function (repairerRenewalId) {
        if (!repairerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + repairerRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'repairer_renewal/get_repairer_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'repairer_renewal_id': repairerRenewalId}, getTokenData()),
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
                var repairerData = parseData.repairer_renewal_data;
                that.showChallan(repairerData);
            }
        });
    },
    showChallan: function (repairerData) {
        showPopup();
        if (repairerData.status != VALUE_FIVE && repairerData.status != VALUE_SIX && repairerData.status != VALUE_SEVEN  && repairerData.status != VALUE_ELEVEN) {
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
        repairerData.module_type = VALUE_FOURTEEN;
        $('#popup_container').html(repairerRenewalUploadChallanTemplate(repairerData));
        loadFB(VALUE_FOURTEEN, repairerData.fb_data);
        loadPH(VALUE_FOURTEEN, repairerData.repairer_renewal_id, repairerData.ph_data);

        if (repairerData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'repairer_renewal_upload_challan', repairerData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'repairer_renewal_upload_challan', 'uc', 'radio');
            if (repairerData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_repairer_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (repairerData.challan != '') {
            $('#challan_container_for_repairer_renewal_upload_challan').hide();
            $('#challan_name_container_for_repairer_renewal_upload_challan').show();
            $('#challan_name_href_for_repairer_renewal_upload_challan').attr('href', 'documents/repairer/' + repairerData.challan);
            $('#challan_name_for_repairer_renewal_upload_challan').html(repairerData.challan);
        }
        if (repairerData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_repairer_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_repairer_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_repairer_renewal_upload_challan').attr('href', 'documents/repairer/' + repairerData.fees_paid_challan);
            $('#fees_paid_challan_name_for_repairer_renewal_upload_challan').html(repairerData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_repairer_renewal_upload_challan').attr('onclick', 'RepairerRenewal.listview.removeFeesPaidChallan("' + repairerData.repairer_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (repairerRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!repairerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'repairer_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'repairer_renewal_id': repairerRenewalId}, getTokenData()),
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
                removeDocument('fees_paid_challan', 'repairer_renewal_upload_challan');
                $('#status_' + repairerRenewalId).html(appStatusArray[VALUE_THREE]);
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
        var repairerRenewalId = $('#repairer_renewal_id_for_repairer_renewal_upload_challan').val();
        if (!repairerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_repairer_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_repairer_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_repairer_renewal_upload_challan').focus();
                validationMessageShow('repairer-uc-fees_paid_challan_for_repairer_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_repairer_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_repairer_renewal_upload_challan').focus();
                validationMessageShow('repairer-uc-fees_paid_challan_for_repairer_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_repairer_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#repairer_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'repairer_renewal/upload_fees_paid_challan',
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
                $('#status_' + repairerRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (repairerRenewalId) {
        if (!repairerRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#repairer_renewal_id_for_certificate').val(repairerRenewalId);
        $('#repairer_renewal_certificate_pdf_form').submit();
        $('#repairer_renewal_id_for_certificate').val('');
    },
    getQueryData: function (repairerRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!repairerRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTEEN;
        templateData.module_id = repairerRenewalId;
        var btnObj = $('#query_btn_for_wm_' + repairerRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOURTEEN, moduleData.repairer_renewal_id);
                tmpData.applicant_name = moduleData.name_of_repairer;
                tmpData.title = 'Repairer Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getRepairerData: function (btnObj) {
        var license_number = $('#admin_registration_number').val();
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        // if (!repairerRenewalId) {
        //     showError(invalidUserValidationMessage);
        //     return;
        // }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'repairer_renewal/get_repairer_data_by_id',
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
                repairerData = parseData.repairer_data;
                if (repairerData) {
                    $('#repairer_renewal_id').val(repairerData.repairer_renewal_id);
                    $('#name_of_repairmen').val(repairerData.name_of_repairer);
                    $('#complete_address').val(repairerData.complete_address);
                    $('#registration_date').val(repairerData.registration_date);
                    $('#registration_number').val(repairerData.registration_number);
                    $('#identity_number').val(repairerData.identity_number);
                    $('#identity_choice').val(repairerData.identity_choice);
                    $('#weights_type').val(repairerData.weights_type);
                    $('#area_operate').val(repairerData.area_operate);
                    $('#signature').val(repairerData.signature);
                    var registration_date = dateTo_DD_MM_YYYY(repairerData.registration_date);
                    $('#registration_date').val(registration_date);

                    if (repairerData.is_limited_company == isChecked) {

                        $('#is_limited_company').attr('checked', 'checked');
                        $('.proprietor_info_div').show();

                        var proprietorInfo = JSON.parse(repairerData.proprietor_details);
                        $.each(proprietorInfo, function (key, value) {
                            that.addMultipleProprietor(value);
                        })
                    }

                    if (repairerData.sufficient_stock == isChecked) {
                        $('#sufficient_stock').attr('checked', 'checked');
                        $('.stock_details_div').show();
                        $('#stock_details').val(repairerData.stock_details);
                    }

                    $('#declarationone').attr('checked', 'checked');
                    $('#declarationtwo').attr('checked', 'checked');
                    $('#declarationthree').attr('checked', 'checked');

                    // if (repairerData.signature != '') {
                    //     $('#seal_and_stamp_container_for_repairer').hide();
                    //     $('#seal_and_stamp_name_image_for_repairer').attr('src', baseUrl + 'documents/repairer/' + repairerData.signature);
                    //     $('#seal_and_stamp_name_container_for_repairer').show();
                    // }
                }
            }
        });
    },

    uploadDocumentForRepairerRenewal: function (fileNo) {
        var that = this;
        if ($('#original_licence_for_repairer').val() != '') {
            var originalLicense = checkValidationForDocument('original_licence_for_repairer', VALUE_ONE, 'repairer');
            if (originalLicense == false) {
                return false;
            }
        }
        if ($('#renewed_licence_for_repairer').val() != '') {
            var renewalLicense = checkValidationForDocument('renewed_licence_for_repairer', VALUE_ONE, 'repairer');
            if (renewalLicense == false) {
                return false;
            }
        }
        if ($('#periodical_return_for_repairer').val() != '') {
            var periodicalReturn = checkValidationForDocument('periodical_return_for_repairer', VALUE_ONE, 'repairer');
            if (periodicalReturn == false) {
                return false;
            }
        }
        if ($('#verification_certificate_for_repairer').val() != '') {
            var VerificationCertificate = checkValidationForDocument('verification_certificate_for_repairer', VALUE_ONE, 'repairer');
            if (VerificationCertificate == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_repairer').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_repairer', VALUE_TWO, 'repairer');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_repairer_renewal_' + fileNo).hide();
        $('.spinner_name_container_for_repairer_renewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var repairerId = $('#repairer_renewal_id').val();
        var formData = new FormData($('#repairer_renewal_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("repairer_renewal_id", repairerId);
        $.ajax({
            type: 'POST',
            url: 'repairer_renewal/upload_repairer_renewal_document',
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
                $('.spinner_container_for_repairer_renewal_' + fileNo).show();
                $('.spinner_name_container_for_repairer_renewal_' + fileNo).hide();
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
                    $('.spinner_container_for_repairer_renewal_' + fileNo).show();
                    $('.spinner_name_container_for_repairer_renewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_repairer_renewal_' + fileNo).hide();
                $('.spinner_name_container_for_repairer_renewal_' + fileNo).show();
                $('#repairer_renewal_id').val(parseData.repairer_renewal_id);
                var repairerData = parseData.repairer_renewal_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('original_licence_container_for_repairer', 'original_licence_name_image_for_repairer', 'original_licence_name_container_for_repairer',
                            'original_licence_download', 'original_licence', repairerData.original_licence, parseData.repairer_renewal_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('renewed_licence_container_for_repairer', 'renewed_licence_name_image_for_repairer', 'renewed_licence_name_container_for_repairer',
                            'renewed_licence_download', 'renewed_licence', repairerData.renewed_licence, parseData.repairer_renewal_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('periodical_return_container_for_repairer', 'periodical_return_name_image_for_repairer', 'periodical_return_name_container_for_repairer',
                            'periodical_return_download', 'periodical_return', repairerData.periodical_return, parseData.repairer_renewal_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('verification_certificate_container_for_repairer', 'verification_certificate_name_image_for_repairer', 'verification_certificate_name_container_for_repairer',
                            'verification_certificate_download', 'verification_certificate', repairerData.verification_certificate, parseData.repairer_renewal_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('seal_and_stamp_container_for_repairer', 'seal_and_stamp_name_image_for_repairer', 'seal_and_stamp_name_container_for_repairer',
                            'seal_and_stamp_download', 'seal_and_stamp', repairerData.signature, parseData.repairer_renewal_id, VALUE_FIVE);
                }

            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/repairer/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/repairer/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'RepairerRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});