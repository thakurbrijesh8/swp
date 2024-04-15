var psfregistrationListTemplate = Handlebars.compile($('#psfregistration_list_template').html());
var psfregistrationTableTemplate = Handlebars.compile($('#psfregistration_table_template').html());
var psfregistrationActionTemplate = Handlebars.compile($('#psfregistration_action_template').html());
var psfregistrationFormTemplate = Handlebars.compile($('#psfregistration_form_template').html());
var psfregistrationViewTemplate = Handlebars.compile($('#psfregistration_view_template').html());
var psfregistrationUploadChallanTemplate = Handlebars.compile($('#psfregistration_upload_challan_template').html());

var tempPersonCnt = 1;

var Psfregistration = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Psfregistration.Router = Backbone.Router.extend({
    routes: {
        'psfregistration': 'renderList',
        'psfregistration_form': 'renderListForForm',
        'edit_psfregistration_form': 'renderList',
        'view_psfregistration_form': 'renderList',
    },
    renderList: function () {
        Psfregistration.listview.listPage();
    },
    renderListForForm: function () {
        Psfregistration.listview.listPagePsfregistrationForm();
    }
});
Psfregistration.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="import_from_outside"]': 'hasOutsideImportEvent',
        'click input[name="import_from_outside_ret"]': 'hasOutsideImportEventRetirement',
        'click input[name="aadharcard_all_parties"]': 'hasAadharCard',
        'click input[name="pancard_all_parties"]': 'hasPanCard',
        'click input[name="alteration_name_firm"]': 'hasAlteration',
    },
    hasOutsideImportEvent: function (event) {
        var val = $('input[name=import_from_outside]:checked').val();
        if (val === '1') {
            this.$('.import_from_outside_div').show();
        } else {
            this.$('.import_from_outside_div').hide();

        }
    },
    hasOutsideImportEventRetirement: function (event) {
        var val = $('input[name=import_from_outside_ret]:checked').val();
        if (val === '1') {
            this.$('.import_from_outside_ret_div').show();
        } else {
            this.$('.import_from_outside_ret_div').hide();

        }
    },
    hasAadharCard: function (event) {
        var val = $('input[name=aadharcard_all_parties]:checked').val();
        if (val === '1') {
            this.$('.aadharcard_all_parties_div').show();
        } else {
            this.$('.aadharcard_all_parties_div').hide();

        }
    },
    hasPanCard: function (event) {
        var val = $('input[name=pancard_all_parties]:checked').val();
        if (val === '1') {
            this.$('.pancard_all_parties_div').show();
        } else {
            this.$('.pancard_all_parties_div').hide();

        }
    },
    hasAlteration: function (event) {
        var val = $('input[name=alteration_name_firm]:checked').val();
        if (val === '1') {
            this.$('.alteration_name_firm_div').show();
        } else {
            this.$('.alteration_name_firm_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('psfregistration', 'active');
        Psfregistration.router.navigate('psfregistration');
        var templateData = {};
        this.$el.html(psfregistrationListTemplate(templateData));
        this.loadPsfregistrationData(sDistrict, sStatus);

    },
    listPagePsfregistrationForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        //    addClass('psfregistration', 'active');
        this.$el.html(psfregistrationListTemplate);
        this.newPsfregistrationForm(false, {});
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
                rowData.ADMIN_PSFREG_DOC_PATH = ADMIN_PSFREG_DOC_PATH;
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
        return psfregistrationActionTemplate(rowData);
    },
    loadPsfregistrationData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_SEVEN, data)
                    + getFRContainer(VALUE_SEVEN, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Psfregistration.router.navigate('psfregistration');
        $('#psfregistration_form_and_datatable_container').html(psfregistrationTableTemplate(searchData));
        psfregistrationDataTable = $('#psfregistration_datatable').DataTable({
            ajax: {url: 'psfregistration/get_psfregistration_data', dataSrc: "psfregistration_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'psfregistration_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'firm_name', 'class': 'text-center'},
                {data: 'principal_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'psfregistration_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'psfregistration_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#psfregistration_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = psfregistrationDataTable.row(tr);

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
    newPsfregistrationForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.psfregistration_data;
            Psfregistration.router.navigate('edit_psfregistration_form');
        } else {
            var formData = {};
            Psfregistration.router.navigate('psfregistration_form');
        }
        var templateData = {};
        templateData.AT_WILL = AT_WILL;
        templateData.is_checked = isChecked;
        templateData.VALUE_SEVEN = VALUE_SEVEN;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.psfregistration_data = parseData.psfregistration_data;
        $('#psfregistration_form_and_datatable_container').html(psfregistrationFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(premisesStatusArray, 'premises_status');
        renderOptionsForTwoDimensionalArray(identityChoiceArray, 'identity_choice');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#declarationone').attr('checked', 'checked');
            $('#declarationtwo').attr('checked', 'checked');
            $('#declarationthree').attr('checked', 'checked');

            if (formData.application_of_firm_document != '') {
                that.showDocument('application_of_firm_document_container_for_psfregistration', 'application_of_firm_document_name_image_for_psfregistration', 'application_of_firm_document_name_container_for_psfregistration',
                        'application_of_firm_document_download', 'application_of_firm_document', formData.application_of_firm_document, formData.psfregistration_id, VALUE_ONE);
            }
            if (formData.formII_document != '') {
                that.showDocument('formII_document_container_for_psfregistration', 'formII_document_name_image_for_psfregistration', 'formII_document_name_container_for_psfregistration',
                        'formII_document_download', 'formII_document', formData.formII_document, formData.psfregistration_id, VALUE_TWO);
            }
            if (formData.partnership_deed != '') {
                that.showDocument('partnership_deed_container_for_psfregistration', 'partnership_deed_name_image_for_psfregistration', 'partnership_deed_name_container_for_psfregistration',
                        'partnership_deed_download', 'partnership_deed', formData.partnership_deed, formData.psfregistration_id, VALUE_THREE);
            }
            if (formData.aadharcard != '') {
                that.showDocument('aadharcard_container_for_psfregistration', 'aadharcard_name_image_for_psfregistration', 'aadharcard_name_container_for_psfregistration',
                        'aadharcard_download', 'aadharcard', formData.aadharcard, formData.psfregistration_id, VALUE_FOUR);
            }
            if (formData.pancard != '') {
                that.showDocument('pancard_container_for_psfregistration', 'pancard_name_image_for_psfregistration', 'pancard_name_container_for_psfregistration',
                        'pancard_download', 'pancard', formData.pancard, formData.psfregistration_id, VALUE_FIVE);
            }
            if (formData.alteration_name_firm_doc != '') {
                that.showDocument('alteration_name_firm_doc_container_for_psfregistration', 'alteration_name_firm_doc_name_image_for_psfregistration', 'alteration_name_firm_doc_name_container_for_psfregistration',
                        'alteration_name_firm_doc_download', 'alteration_name_firm_doc', formData.alteration_name_firm_doc, formData.psfregistration_id, VALUE_SIX);
            }
            if (formData.retirement_form != '') {
                that.showDocument('retirement_form_container_for_psfregistration', 'retirement_form_name_image_for_psfregistration', 'retirement_form_name_container_for_psfregistration',
                        'retirement_form_download', 'retirement_form', formData.retirement_form, formData.psfregistration_id, VALUE_SEVEN);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_psfregistration', 'seal_and_stamp_name_image_for_psfregistration', 'seal_and_stamp_name_container_for_psfregistration',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.psfregistration_id, VALUE_EIGHT);
            }


            if (formData.import_from_outside == isChecked) {
                $('#import_from_outside').attr('checked', 'checked');
                this.$('.import_from_outside_div').show();
            }

            if (formData.import_from_outside_ret == isChecked) {
                $('#import_from_outside_ret').attr('checked', 'checked');
                this.$('.import_from_outside_ret_div').show();
            }
            if (formData.aadharcard_all_parties == isChecked) {
                $('#aadharcard_all_parties').attr('checked', 'checked');
                this.$('.aadharcard_all_parties_div').show();
            }

            if (formData.pancard_all_parties == isChecked) {
                $('#pancard_all_parties').attr('checked', 'checked');
                this.$('.pancard_all_parties_div').show();
            }
            if (formData.alteration_name_firm == isChecked) {
                $('#alteration_name_firm').attr('checked', 'checked');
                this.$('.alteration_name_firm_div').show();
            }
        }

        generateSelect2();
        datePicker();
        $('#psfregistration_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitPsfregistration($('#submit_btn_for_psfregistration'));
            }
        });
        //psfregistration
    },
    editOrViewPsfregistration: function (btnObj, psfregistrationId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!psfregistrationId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'psfregistration/get_psfregistration_data_by_id',
            type: 'post',
            data: $.extend({}, {'psfregistration_id': psfregistrationId}, getTokenData()),
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
                    that.newPsfregistrationForm(isEdit, parseData);
                } else {
                    that.viewPsfregistrationForm(parseData);
                }
            }
        });
    },
    viewPsfregistrationForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.psfregistration_data;
        formData.AT_WILL = AT_WILL;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        Psfregistration.router.navigate('view_psfregistration_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        $('#psfregistration_form_and_datatable_container').html(psfregistrationViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#declarationone').attr('checked', 'checked');
        $('#declarationtwo').attr('checked', 'checked');
        $('#declarationthree').attr('checked', 'checked');

        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        //$('#application_category').val(formData.application_category);

        if (formData.import_from_outside == isChecked) {
            $('#import_from_outside').attr('checked', 'checked');
            this.$('.import_from_outside_div').show();
        }

        if (formData.import_from_outside_ret == isChecked) {
            $('#import_from_outside_ret').attr('checked', 'checked');
            this.$('.import_from_outside_ret_div').show();
        }
        if (formData.aadharcard_all_parties == isChecked) {
            $('#aadharcard_all_parties').attr('checked', 'checked');
            this.$('.aadharcard_all_parties_div').show();
        }

        if (formData.pancard_all_parties == isChecked) {
            $('#pancard_all_parties').attr('checked', 'checked');
            this.$('.pancard_all_parties_div').show();
        }
        if (formData.alteration_name_firm == isChecked) {
            $('#alteration_name_firm').attr('checked', 'checked');
            this.$('.alteration_name_firm_div').show();
        }


        if (formData.application_of_firm_document != '') {
            that.showDocument('application_of_firm_document_container_for_psfregistration', 'application_of_firm_document_name_image_for_psfregistration', 'application_of_firm_document_name_container_for_psfregistration',
                    'application_of_firm_document_download', 'application_of_firm_document', formData.application_of_firm_document);
        }
        if (formData.formII_document != '') {
            that.showDocument('formII_document_container_for_psfregistration', 'formII_document_name_image_for_psfregistration', 'formII_document_name_container_for_psfregistration',
                    'formII_document_download', 'formII_document', formData.formII_document);
        }
        if (formData.partnership_deed != '') {
            that.showDocument('partnership_deed_container_for_psfregistration', 'partnership_deed_name_image_for_psfregistration', 'partnership_deed_name_container_for_psfregistration',
                    'partnership_deed_download', 'partnership_deed', formData.partnership_deed);
        }
        if (formData.aadharcard != '') {
            that.showDocument('aadharcard_container_for_psfregistration', 'aadharcard_name_image_for_psfregistration', 'aadharcard_name_container_for_psfregistration',
                    'aadharcard_download', 'aadharcard', formData.aadharcard);
        }
        if (formData.pancard != '') {
            that.showDocument('pancard_container_for_psfregistration', 'pancard_name_image_for_psfregistration', 'pancard_name_container_for_psfregistration',
                    'pancard_download', 'pancard', formData.pancard);
        }
        if (formData.alteration_name_firm_doc != '') {
            that.showDocument('alteration_name_firm_doc_container_for_psfregistration', 'alteration_name_firm_doc_name_image_for_psfregistration', 'alteration_name_firm_doc_name_container_for_psfregistration',
                    'alteration_name_firm_doc_download', 'alteration_name_firm_doc', formData.alteration_name_firm_doc);
        }
        if (formData.retirement_form != '') {
            that.showDocument('retirement_form_container_for_psfregistration', 'retirement_form_name_image_for_psfregistration', 'retirement_form_name_container_for_psfregistration',
                    'retirement_form_download', 'retirement_form', formData.retirement_form);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_psfregistration', 'seal_and_stamp_name_image_for_psfregistration', 'seal_and_stamp_name_container_for_psfregistration',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }

    },
    checkValidationForPsfregistration: function (psfregistrationData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!psfregistrationData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!psfregistrationData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!psfregistrationData.firm_name) {
            return getBasicMessageAndFieldJSONArray('firm_name', firmNameValidationMessage);
        }
        if (!psfregistrationData.email) {
            return getBasicMessageAndFieldJSONArray('email', emailValidationMessage);
        }
        if (!psfregistrationData.principal_address) {
            return getBasicMessageAndFieldJSONArray('principal_address', principaladdressValidationMessage);
        }
        // if (!psfregistrationData.other_address) {
        //     return getBasicMessageAndFieldJSONArray('other_address',otheraddressValidationMessage);
        // }
        if (!psfregistrationData.firm_duration) {
            return getBasicMessageAndFieldJSONArray('firm_duration');
        }
        return '';
    },
    askForSubmitPsfregistration: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Psfregistration.listview.submitPsfregistration(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitPsfregistration: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var psfregistrationData = $('#psfregistration_form').serializeFormJSON();
        var validationData = that.checkValidationForPsfregistration(psfregistrationData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('psfregistration-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#application_of_firm_document_container_for_psfregistration').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('application_of_firm_document_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#formII_document_container_for_psfregistration').is(':visible')) {
            var formIIdoc = checkValidationForDocument('formII_document_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#partnership_deed_container_for_psfregistration').is(':visible')) {
            var formIIdoc = checkValidationForDocument('partnership_deed_for_psfregistration', VALUE_ONE, 'psfregistration', 10240);
            if (formIIdoc == false) {
                return false;
            }
        }
        if (psfregistrationData.aadharcard_all_parties == isChecked) {
            if ($('#aadharcard_container_for_psfregistration').is(':visible')) {
                var formIIdoc = checkValidationForDocument('aadharcard_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
                if (formIIdoc == false) {
                    return false;
                }
            }
        }
        if (psfregistrationData.pancard_all_parties == isChecked) {
            if ($('#pancard_container_for_psfregistration').is(':visible')) {
                var formIIdoc = checkValidationForDocument('pancard_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
                if (formIIdoc == false) {
                    return false;
                }
            }
        }
        if (psfregistrationData.alteration_name_firm == isChecked) {
            if ($('#alteration_name_firm_doc_container_for_psfregistration').is(':visible')) {
                var formIIdoc = checkValidationForDocument('alteration_name_firm_doc_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
                if (formIIdoc == false) {
                    return false;
                }
            }
        }
        if (psfregistrationData.import_from_outside_ret == isChecked) {
            if ($('#retirement_form_container_for_psfregistration').is(':visible')) {
                var formIIdoc = checkValidationForDocument('retirement_form_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
                if (formIIdoc == false) {
                    return false;
                }
            }
        }
        if ($('#seal_and_stamp_container_for_psfregistration').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_psfregistration', VALUE_TWO, 'psfregistration');
            if (sealAndStamp == false) {
                return false;
            }
        }


        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_psfregistration') : $('#submit_btn_for_psfregistration');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var psfregistrationData = new FormData($('#psfregistration_form')[0]);
        psfregistrationData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        psfregistrationData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'psfregistration/submit_psfregistration',
            data: psfregistrationData,
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
                validationMessageShow('psfregistration', textStatus.statusText);
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
                    validationMessageShow('psfregistration', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Psfregistration.router.navigate('psfregistration', {'trigger': true});
            }
        });
    },

    askForRemove: function (psfregistrationId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!psfregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Psfregistration.listview.removeDocument(\'' + psfregistrationId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (psfregistrationId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!psfregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_psfregistration_' + docType).hide();
        $('.spinner_name_container_for_psfregistration_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'psfregistration/remove_document',
            data: $.extend({}, {'psfregistration_id': psfregistrationId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_psfregistration_' + docType).hide();
                $('.spinner_name_container_for_psfregistration_' + docType).show();
                validationMessageShow('psfregistration', textStatus.statusText);
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
                    validationMessageShow('psfregistration', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_psfregistration_' + docType).show();
                $('.spinner_name_container_for_psfregistration_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('application_of_firm_document_name_container_for_psfregistration', 'application_of_firm_document_name_image_for_psfregistration', 'application_of_firm_document_container_for_psfregistration', 'application_of_firm_document_for_psfregistration');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('formII_document_name_container_for_psfregistration', 'formII_document_name_image_for_psfregistration', 'formII_document_container_for_psfregistration', 'formII_document_for_psfregistration');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('partnership_deed_name_container_for_psfregistration', 'partnership_deed_name_image_for_psfregistration', 'partnership_deed_container_for_psfregistration', 'partnership_deed_for_psfregistration');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('aadharcard_name_container_for_psfregistration', 'aadharcard_name_image_for_psfregistration', 'aadharcard_container_for_psfregistration', 'aadharcard_for_psfregistration');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('pancard_name_container_for_psfregistration', 'pancard_name_image_for_psfregistration', 'pancard_container_for_psfregistration', 'pancard_for_psfregistration');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('alteration_name_firm_doc_name_container_for_psfregistration', 'alteration_name_firm_doc_name_image_for_psfregistration', 'alteration_name_firm_doc_container_for_psfregistration', 'alteration_name_firm_doc_for_psfregistration');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('retirement_form_name_container_for_psfregistration', 'retirement_form_name_image_for_psfregistration', 'retirement_form_container_for_psfregistration', 'retirement_form_for_psfregistration');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('seal_and_stamp_name_container_for_psfregistration', 'seal_and_stamp_name_image_for_psfregistration', 'seal_and_stamp_container_for_psfregistration', 'seal_and_stamp_for_psfregistration');
                }
            }
        });
    },
    generateForm1: function (psfregistrationId) {
        if (!psfregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#psfregistration_id_for_psfregistration_form1').val(psfregistrationId);
        $('#psfregistration_form1_pdf_form').submit();
        $('#psfregistration_id_for_psfregistration_form1').val('');
    },

    downloadUploadChallan: function (psfregistrationId) {
        if (!psfregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + psfregistrationId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'psfregistration/get_psfregistration_data_by_psfregistration_id',
            type: 'post',
            data: $.extend({}, {'psfregistration_id': psfregistrationId}, getTokenData()),
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
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
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
                var psfregistrationData = parseData.psfregistration_data;
                that.showChallan(psfregistrationData);
            }
        });
    },
    showChallan: function (psfregistrationData) {
        showPopup();
        if (psfregistrationData.status != VALUE_FIVE && psfregistrationData.status != VALUE_SIX && psfregistrationData.status != VALUE_SEVEN && psfregistrationData.status != VALUE_ELEVEN) {
            if (!psfregistrationData.hide_submit_btn) {
                psfregistrationData.show_fees_paid = true;
            }
        }
        if (psfregistrationData.payment_type == VALUE_ONE) {
            psfregistrationData.utitle = 'Fees Paid Challan Copy';
        } else {
            psfregistrationData.style = 'display: none;';
        }
        if (psfregistrationData.payment_type == VALUE_TWO) {
            psfregistrationData.show_dd_po_option = true;
            psfregistrationData.utitle = 'Demand Draft (DD)';
        }
        psfregistrationData.module_type = VALUE_SEVEN;
        $('#popup_container').html(psfregistrationUploadChallanTemplate(psfregistrationData));
        loadFB(VALUE_SEVEN, psfregistrationData.fb_data);
        loadPH(VALUE_SEVEN, psfregistrationData.psfregistration_id, psfregistrationData.ph_data);

        if (psfregistrationData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'psfregistration_upload_challan', psfregistrationData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'psfregistration_upload_challan', 'uc', 'radio');
            if (psfregistrationData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_psfregistration_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (psfregistrationData.challan != '') {
            $('#challan_container_for_psfregistration_upload_challan').hide();
            $('#challan_name_container_for_psfregistration_upload_challan').show();
            $('#challan_name_href_for_psfregistration_upload_challan').attr('href', 'documents/psfregistration/' + psfregistrationData.challan);
            $('#challan_name_for_psfregistration_upload_challan').html(psfregistrationData.challan);
        }
        if (psfregistrationData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_psfregistration_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_psfregistration_upload_challan').show();
            $('#fees_paid_challan_name_href_for_psfregistration_upload_challan').attr('href', 'documents/psfregistration/' + psfregistrationData.fees_paid_challan);
            $('#fees_paid_challan_name_for_psfregistration_upload_challan').html(psfregistrationData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_psfregistration_upload_challan').attr('onclick', 'Psfregistration.listview.removeFeesPaidChallan("' + psfregistrationData.psfregistration_id + '")');
        }
    },
    removeFeesPaidChallan: function (psfregistrationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!psfregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'psfregistration/remove_fees_paid_challan',
            data: $.extend({}, {'psfregistration_id': psfregistrationId}, getTokenData()),
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
                validationMessageShow('psfregistration-uc', textStatus.statusText);
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
                    validationMessageShow('psfregistration-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-psfregistration-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'psfregistration_upload_challan');
                $('#status_' + psfregistrationId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },

    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-psfregistration-uc').html('');
        validationMessageHide();
        var psfregistrationId = $('#psfregistration_id_for_psfregistration_upload_challan').val();
        if (!psfregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_psfregistration_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_psfregistration_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_psfregistration_upload_challan').focus();
                validationMessageShow('psfregistration-uc-fees_paid_challan_for_psfregistration_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_psfregistration_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_psfregistration_upload_challan').focus();
                validationMessageShow('psfregistration-uc-fees_paid_challan_for_psfregistration_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_psfregistration_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#psfregistration_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'psfregistration/upload_fees_paid_challan',
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
                validationMessageShow('psfregistration-uc', textStatus.statusText);
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
                    validationMessageShow('psfregistration-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + psfregistrationId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (psfregistrationId) {
        if (!psfregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#psfregistration_id_for_certificate').val(psfregistrationId);
        $('#psfregistration_certificate_pdf_form').submit();
        $('#psfregistration_id_for_certificate').val('');
    },
    getQueryData: function (psfregistrationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!psfregistrationId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_SEVEN;
        templateData.module_id = psfregistrationId;
        var btnObj = $('#query_btn_for_psf_' + psfregistrationId);
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
                tmpData.application_number = regNoRenderer(VALUE_SEVEN, moduleData.psfregistration_id);
                tmpData.applicant_name = moduleData.firm_name;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },

    uploadDocumentForPsfregistration: function (fileNo) {
        var that = this;
        if ($('#application_of_firm_document_for_psfregistration').val() != '') {
            var copyOfRegistration = checkValidationForDocument('application_of_firm_document_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#formII_document_for_psfregistration').val() != '') {
            var formIIdoc = checkValidationForDocument('formII_document_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#partnership_deed_for_psfregistration').val() != '') {
            var formIIdoc = checkValidationForDocument('partnership_deed_for_psfregistration', VALUE_ONE, 'psfregistration', 10240);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#aadharcard_for_psfregistration').val() != '') {
            var formIIdoc = checkValidationForDocument('aadharcard_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#pancard_for_psfregistration').val() != '') {
            var formIIdoc = checkValidationForDocument('pancard_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#alteration_name_firm_doc_for_psfregistration').val() != '') {
            var formIIdoc = checkValidationForDocument('alteration_name_firm_doc_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#retirement_form_for_psfregistration').val() != '') {
            var formIIdoc = checkValidationForDocument('retirement_form_for_psfregistration', VALUE_ONE, 'psfregistration', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_psfregistration').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_psfregistration', VALUE_TWO, 'psfregistration');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_psfregistration_' + fileNo).hide();
        $('.spinner_name_container_for_psfregistration_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var psfregistrationId = $('#psfregistration_id').val();
        var formData = new FormData($('#psfregistration_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("psfregistration_id", psfregistrationId);
        $.ajax({
            type: 'POST',
            url: 'psfregistration/upload_psfregistration_document',
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
                $('.spinner_container_for_psfregistration_' + fileNo).show();
                $('.spinner_name_container_for_psfregistration_' + fileNo).hide();
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
                    $('.spinner_container_for_psfregistration_' + fileNo).show();
                    $('.spinner_name_container_for_psfregistration_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_psfregistration_' + fileNo).hide();
                $('.spinner_name_container_for_psfregistration_' + fileNo).show();
                $('#psfregistration_id').val(parseData.psfregistration_id);
                var psfregistrationData = parseData.psfregistration_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('application_of_firm_document_container_for_psfregistration', 'application_of_firm_document_name_image_for_psfregistration', 'application_of_firm_document_name_container_for_psfregistration',
                            'application_of_firm_document_download', 'application_of_firm_document', psfregistrationData.application_of_firm_document, parseData.psfregistration_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('formII_document_container_for_psfregistration', 'formII_document_name_image_for_psfregistration', 'formII_document_name_container_for_psfregistration',
                            'formII_document_download', 'formII_document', psfregistrationData.formII_document, parseData.psfregistration_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('partnership_deed_container_for_psfregistration', 'partnership_deed_name_image_for_psfregistration', 'partnership_deed_name_container_for_psfregistration',
                            'partnership_deed_download', 'partnership_deed', psfregistrationData.partnership_deed, parseData.psfregistration_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('aadharcard_container_for_psfregistration', 'aadharcard_name_image_for_psfregistration', 'aadharcard_name_container_for_psfregistration',
                            'aadharcard_download', 'aadharcard', psfregistrationData.aadharcard, parseData.psfregistration_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('pancard_container_for_psfregistration', 'pancard_name_image_for_psfregistration', 'pancard_name_container_for_psfregistration',
                            'pancard_download', 'pancard', psfregistrationData.pancard, parseData.psfregistration_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('alteration_name_firm_doc_container_for_psfregistration', 'alteration_name_firm_doc_name_image_for_psfregistration', 'alteration_name_firm_doc_name_container_for_psfregistration',
                            'alteration_name_firm_doc_download', 'alteration_name_firm_doc', psfregistrationData.alteration_name_firm_doc, parseData.psfregistration_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('retirement_form_container_for_psfregistration', 'retirement_form_name_image_for_psfregistration', 'retirement_form_name_container_for_psfregistration',
                            'retirement_form_download', 'retirement_form', psfregistrationData.retirement_form, parseData.psfregistration_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('seal_and_stamp_container_for_psfregistration', 'seal_and_stamp_name_image_for_psfregistration', 'seal_and_stamp_name_container_for_psfregistration',
                            'seal_and_stamp_download', 'seal_and_stamp', psfregistrationData.signature, parseData.psfregistration_id, VALUE_EIGHT);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/psfregistration/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/psfregistration/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Psfregistration.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
