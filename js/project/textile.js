var textileListTemplate = Handlebars.compile($('#textile_list_template').html());
var textileTableTemplate = Handlebars.compile($('#textile_table_template').html());
var textileActionTemplate = Handlebars.compile($('#textile_action_template').html());
var textileFormTemplate = Handlebars.compile($('#textile_form_template').html());
var textileViewTemplate = Handlebars.compile($('#textile_view_template').html());
var textileUploadChallanTemplate = Handlebars.compile($('#textile_upload_challan_template').html());
var textileViewDocumentTemplate = Handlebars.compile($('#textile_view_document_template').html());

var Textile = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Textile.Router = Backbone.Router.extend({
    routes: {
        'textile': 'renderList',
        'textile_form': 'renderList',
        'edit_textile_form': 'renderList',
        'view_textile_form': 'renderList',
    },
    renderList: function () {
        Textile.listview.listPage();
    },
    renderListForForm: function () {
        Textile.listview.listPageTextileForm();
    }
});
Textile.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        Textile.router.navigate('textile');
        var templateData = {};
        this.$el.html(textileListTemplate(templateData));
        this.loadTextileData(sDistrict, sStatus);

    },
    listPageTextileForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(textileListTemplate);
        this.newTextileForm(false, {});
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
                rowData.ADMIN_TEXTILE_DOC_PATH = ADMIN_TEXTILE_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return textileActionTemplate(rowData);
    },
    loadTextileData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TEN, data);
        };
        var that = this;
        Textile.router.navigate('textile');
        $('#textile_form_and_datatable_container').html(textileTableTemplate(searchData));
        textileDataTable = $('#textile_datatable').DataTable({
            ajax: {url: 'textile/get_textile_data', dataSrc: "textile_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'textile_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'enterprise_name', 'class': 'text-center'},
                {data: 'office_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'textile_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'textile_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#textile_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = textileDataTable.row(tr);

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
    newTextileForm: function (isEdit, textileData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            Textile.router.navigate('edit_textile_form');
        } else {
            Textile.router.navigate('textile_form');
        }
        textileData = that.basicDetailsForForm(textileData);
        $('#textile_form_and_datatable_container').html(textileFormTemplate(textileData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_textile');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        renderOptionsForTwoDimensionalArray(cbTypeArray, 'unit_type_for_textile');
        generateBoxes('radio', constitutionArray, 'constitution', 'textile', textileData.constitution, true);
        generateBoxes('checkbox', socialStatusArray, 'social_status', 'textile', textileData.social_status, true);
        if (isEdit) {
            $('#district_for_textile').val(textileData.district);
            $('#unit_type_for_textile').val(textileData.unit_type);
            $('#entity_establishment_type').val(textileData.entity_establishment_type);
            var docData = {};
            docData.textile_id = textileData.textile_id;
            if (textileData.application_form_file != '') {
                docData.file_name = textileData.application_form_file;
                that.loadTextileDocument(VALUE_ONE, docData);
            }
            if (textileData.doc_1 != '') {
                docData.file_name = textileData.doc_1;
                that.loadTextileDocument(VALUE_TWO, docData);
            }
            if (textileData.doc_2 != '') {
                docData.file_name = textileData.doc_2;
                that.loadTextileDocument(VALUE_THREE, docData);
            }
            if (textileData.doc_3 != '') {
                docData.file_name = textileData.doc_3;
                that.loadTextileDocument(VALUE_FOUR, docData);
            }
            if (textileData.doc_4 != '') {
                docData.file_name = textileData.doc_4;
                that.loadTextileDocument(VALUE_FIVE, docData);
            }
            if (textileData.doc_5 != '') {
                docData.file_name = textileData.doc_5;
                that.loadTextileDocument(VALUE_SIX, docData);
            }
            if (textileData.doc_6 != '') {
                docData.file_name = textileData.doc_6;
                that.loadTextileDocument(VALUE_SEVEN, docData);
            }
            if (textileData.doc_7 != '') {
                docData.file_name = textileData.doc_7;
                that.loadTextileDocument(VALUE_EIGHT, docData);
            }
            if (textileData.doc_8 != '') {
                docData.file_name = textileData.doc_8;
                that.loadTextileDocument(VALUE_NINE, docData);
            }
            if (textileData.doc_9 != '') {
                docData.file_name = textileData.doc_9;
                that.loadTextileDocument(VALUE_TEN, docData);
            }
            if (textileData.doc_10 != '') {
                docData.file_name = textileData.doc_10;
                that.loadTextileDocument(VALUE_ELEVEN, docData);
            }
            if (textileData.doc_11 != '') {
                docData.file_name = textileData.doc_11;
                that.loadTextileDocument(VALUE_TWELVE, docData);
            }
            if (textileData.doc_12 != '') {
                docData.file_name = textileData.doc_12;
                that.loadTextileDocument(VALUE_THIRTEEN, docData);
            }
            if (textileData.doc_13 != '') {
                docData.file_name = textileData.doc_13;
                that.loadTextileDocument(VALUE_FOURTEEN, docData);
            }
            if (textileData.doc_14 != '') {
                docData.file_name = textileData.doc_14;
                that.loadTextileDocument(VALUE_FIFTEEN, docData);
            }
            if (textileData.doc_15 != '') {
                docData.file_name = textileData.doc_15;
                that.loadTextileDocument(VALUE_SIXTEEN, docData);
            }
            if (textileData.doc_16 != '') {
                docData.file_name = textileData.doc_16;
                that.loadTextileDocument(VALUE_SEVENTEEN, docData);
            }
            if (textileData.doc_17 != '') {
                docData.file_name = textileData.doc_17;
                that.loadTextileDocument(VALUE_EIGHTEEN, docData);
            }
        }
        resetCounter('scheme-sr-no');
        resetCounter('doc-sr-no');
        if (isEdit) {
            that.loadFAC(textileData);
        }
        generateSelect2();
        $('#textile_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitTextile($('#submit_btn_for_textile'));
            }
        });
    },
    editOrViewTextile: function (btnObj, textileId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!textileId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'textile/get_textile_data_by_id',
            type: 'post',
            data: $.extend({}, {'textile_id': textileId}, getTokenData()),
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
                var textileData = parseData.textile_data;
                if (isEdit) {
                    that.newTextileForm(isEdit, textileData);
                } else {
                    that.viewTextileForm(textileData);
                }
            }
        });
    },
    basicDetailsForForm: function (textileData) {
        textileData.VALUE_ONE = VALUE_ONE;
        textileData.VALUE_TWO = VALUE_TWO;
        textileData.VALUE_THREE = VALUE_THREE;
        textileData.VALUE_FOUR = VALUE_FOUR;
        textileData.VALUE_FIVE = VALUE_FIVE;
        textileData.VALUE_SIX = VALUE_SIX;
        textileData.VALUE_SEVEN = VALUE_SEVEN;
        textileData.VALUE_EIGHT = VALUE_EIGHT;
        textileData.VALUE_NINE = VALUE_NINE;
        textileData.VALUE_TEN = VALUE_TEN;
        textileData.VALUE_ELEVEN = VALUE_ELEVEN;
        textileData.VALUE_TWELVE = VALUE_TWELVE;
        textileData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        textileData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        textileData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        textileData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        textileData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        textileData.VALUE_EIGHTEEN = VALUE_EIGHTEEN;
        textileData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        return textileData;
    },
    viewTextileForm: function (textileData) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        Textile.router.navigate('view_textile_form');
        textileData = that.basicDetailsForForm(textileData);
        textileData.district_text = talukaArray[textileData.district] ? talukaArray[textileData.district] : '';
        textileData.unit_type_text = cbTypeArray[textileData.unit_type] ? cbTypeArray[textileData.unit_type] : '';
        $('#textile_form_and_datatable_container').html(textileViewTemplate(textileData));
        $('#view_document_container_for_textile').html(textileViewDocumentTemplate(textileData));
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        generateBoxes('radio', constitutionArray, 'constitution', 'textile_view', textileData.constitution, true);
        generateBoxes('checkbox', socialStatusArray, 'social_status', 'textile_view', textileData.social_status, true);
        var docData = {};
        $('#entity_establishment_type').val(textileData.entity_establishment_type);
        if (textileData.application_form_file != '') {
            docData.file_name = textileData.application_form_file;
            that.loadTextileDocumentForView(VALUE_ONE, docData);
        }
        if (textileData.doc_1 != '') {
            docData.file_name = textileData.doc_1;
            that.loadTextileDocumentForView(VALUE_TWO, docData);
        }
        if (textileData.doc_2 != '') {
            docData.file_name = textileData.doc_2;
            that.loadTextileDocumentForView(VALUE_THREE, docData);
        }
        if (textileData.doc_3 != '') {
            docData.file_name = textileData.doc_3;
            that.loadTextileDocumentForView(VALUE_FOUR, docData);
        }
        if (textileData.doc_4 != '') {
            docData.file_name = textileData.doc_4;
            that.loadTextileDocumentForView(VALUE_FIVE, docData);
        }
        if (textileData.doc_5 != '') {
            docData.file_name = textileData.doc_5;
            that.loadTextileDocumentForView(VALUE_SIX, docData);
        }
        if (textileData.doc_6 != '') {
            docData.file_name = textileData.doc_6;
            that.loadTextileDocumentForView(VALUE_SEVEN, docData);
        }
        if (textileData.doc_7 != '') {
            docData.file_name = textileData.doc_7;
            that.loadTextileDocumentForView(VALUE_EIGHT, docData);
        }
        if (textileData.doc_8 != '') {
            docData.file_name = textileData.doc_8;
            that.loadTextileDocumentForView(VALUE_NINE, docData);
        }
        if (textileData.doc_9 != '') {
            docData.file_name = textileData.doc_9;
            that.loadTextileDocumentForView(VALUE_TEN, docData);
        }
        if (textileData.doc_10 != '') {
            docData.file_name = textileData.doc_10;
            that.loadTextileDocumentForView(VALUE_ELEVEN, docData);
        }
        if (textileData.doc_11 != '') {
            docData.file_name = textileData.doc_11;
            that.loadTextileDocumentForView(VALUE_TWELVE, docData);
        }
        if (textileData.doc_12 != '') {
            docData.file_name = textileData.doc_12;
            that.loadTextileDocumentForView(VALUE_THIRTEEN, docData);
        }
        if (textileData.doc_13 != '') {
            docData.file_name = textileData.doc_13;
            that.loadTextileDocumentForView(VALUE_FOURTEEN, docData);
        }
        if (textileData.doc_14 != '') {
            docData.file_name = textileData.doc_14;
            that.loadTextileDocumentForView(VALUE_FIFTEEN, docData);
        }
        if (textileData.doc_15 != '') {
            docData.file_name = textileData.doc_15;
            that.loadTextileDocumentForView(VALUE_SIXTEEN, docData);
        }
        if (textileData.doc_16 != '') {
            docData.file_name = textileData.doc_16;
            that.loadTextileDocumentForView(VALUE_SEVENTEEN, docData);
        }
        if (textileData.doc_17 != '') {
            docData.file_name = textileData.doc_17;
            that.loadTextileDocumentForView(VALUE_EIGHTEEN, docData);
        }
        resetCounter('scheme-sr-no');
        resetCounter('doc-sr-no');
        that.loadFAC(textileData);
        $('[name=form_application_checklist_for_textile]').attr('disabled', 'disabled');
        $('[name=form_application_checklist_for_textile]').removeAttr('onclick');
        generateSelect2();
    },
    checkValidationForTextile: function (textileData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!textileData.district_for_textile) {
            return getBasicMessageAndFieldJSONArray('district_for_textile', selectDistrictValidationMessage);
        }
        if (!textileData.enterprise_name_for_textile) {
            return getBasicMessageAndFieldJSONArray('enterprise_name_for_textile', enterpriseNameValidationMessage);
        }
        if (!textileData.office_address_for_textile) {
            return getBasicMessageAndFieldJSONArray('office_address_for_textile', officeAddressValidationMessage);
        }
        if (!textileData.office_contact_number_for_textile) {
            return getBasicMessageAndFieldJSONArray('office_contact_number_for_textile', officeContactNoValidationMessage);
        }
        if (!textileData.factory_contact_number_for_textile) {
            return getBasicMessageAndFieldJSONArray('factory_contact_number_for_textile', factoryContactNoValidationMessage);
        }
        if (!textileData.constitution_for_textile) {
            $('#constitution_for_textile_1').focus();
            return getBasicMessageAndFieldJSONArray('constitution_for_textile', oneOptionValidationMessage);
        }
        if (!textileData.promoter_name_for_textile) {
            return getBasicMessageAndFieldJSONArray('promoter_name_for_textile', promoterNameValidationMessage);
        }
        if (!textileData.promoter_designation_for_textile) {
            return getBasicMessageAndFieldJSONArray('promoter_designation_for_textile', promoterDesignationValidationMessage);
        }
        if (!textileData.social_status_for_textile) {
            $('#social_status_for_textile_1').focus();
            return getBasicMessageAndFieldJSONArray('social_status_for_textile', oneOptionValidationMessage);
        }
        if (!textileData.ap_name_for_textile) {
            return getBasicMessageAndFieldJSONArray('ap_name_for_textile', apNameValidationMessage);
        }
        if (!textileData.ap_designation_for_textile) {
            return getBasicMessageAndFieldJSONArray('ap_designation_for_textile', apDesignationValidationMessage);
        }
        if (!textileData.unit_type_for_textile) {
            return getBasicMessageAndFieldJSONArray('unit_type_for_textile', oneOptionValidationMessage);
        }
        return '';
    },
    askForSubmitTextile: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Textile.listview.submitTextile(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitTextile: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var textileData = $('#textile_form').serializeFormJSON();
        var validationData = that.checkValidationForTextile(textileData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('textile-' + validationData.field, validationData.message);
            return false;
        }
        textileData.module_type = moduleType;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_textile') : $('#submit_btn_for_textile');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'textile/submit_textile',
            data: $.extend({}, textileData, getTokenData()),
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
                validationMessageShow('textile', textStatus.statusText);
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
                    validationMessageShow('textile', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Textile.listview.loadTextileData();
                showSuccess(parseData.message);
            }
        });
    },
    downloadUploadChallan: function (textileId) {
        if (!textileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + textileId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'textile/get_textile_data_by_textile_id',
            type: 'post',
            data: $.extend({}, {'textile_id': textileId}, getTokenData()),
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
                var textileData = parseData.textile_data;
                that.showChallan(textileData);
            }
        });
    },
    showChallan: function (textileData) {
        showPopup();
        if (textileData.status != VALUE_FIVE && textileData.status != VALUE_SIX && textileData.status != VALUE_SEVEN) {
            if (!textileData.hide_submit_btn) {
                textileData.show_fees_paid = true;
            }
        }
        if (textileData.payment_type == VALUE_ONE) {
            textileData.utitle = 'Fees Paid Challan Copy';
        } else {
            textileData.style = 'display: none;';
        }
        if (textileData.payment_type == VALUE_TWO) {
            textileData.show_dd_po_option = true;
            textileData.utitle = 'Demand Draft (DD)';
        }
        textileData.module_type = VALUE_TEN;
        $('#popup_container').html(textileUploadChallanTemplate(textileData));
        loadFB(VALUE_TEN, textileData.fb_data);
        loadPH(VALUE_TEN, textileData.textile_id, textileData.ph_data);

        if (textileData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'textile_upload_challan', textileData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'textile_upload_challan', 'uc', 'radio');
            if (textileData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_textile_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (textileData.challan != '') {
            $('#challan_container_for_textile_upload_challan').hide();
            $('#challan_name_container_for_textile_upload_challan').show();
            $('#challan_name_href_for_textile_upload_challan').attr('href', 'documents/textile/' + textileData.challan);
            $('#challan_name_for_textile_upload_challan').html(textileData.challan);
        }
        if (textileData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_textile_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_textile_upload_challan').show();
            $('#fees_paid_challan_name_href_for_textile_upload_challan').attr('href', 'documents/textile/' + textileData.fees_paid_challan);
            $('#fees_paid_challan_name_for_textile_upload_challan').html(textileData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_textile_upload_challan').attr('onclick', 'Textile.listview.removeFeesPaidChallan("' + textileData.textile_id + '")');
        }
    },
    removeFeesPaidChallan: function (textileId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!textileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'textile/remove_fees_paid_challan',
            data: $.extend({}, {'textile_id': textileId}, getTokenData()),
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
                validationMessageShow('textile-uc', textStatus.statusText);
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
                    validationMessageShow('textile-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-textile-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'textile_upload_challan');
                $('#status_' + textileId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-textile-uc').html('');
        validationMessageHide();
        var textileId = $('#textile_id_for_textile_upload_challan').val();
        if (!textileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_textile_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_textile_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_textile_upload_challan').focus();
                validationMessageShow('textile-uc-fees_paid_challan_for_textile_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_textile_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_textile_upload_challan').focus();
                validationMessageShow('textile-uc-fees_paid_challan_for_textile_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_textile_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#textile_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'textile/upload_fees_paid_challan',
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
                validationMessageShow('textile-uc', textStatus.statusText);
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
                    validationMessageShow('textile-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + textileId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (textileId) {
        if (!textileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#textile_id_for_certificate').val(textileId);
        $('#textile_certificate_pdf_form').submit();
        $('#textile_id_for_certificate').val('');
    },
    getQueryData: function (textileId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!textileId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TEN;
        templateData.module_id = textileId;
        var btnObj = $('#query_btn_for_textile_' + textileId);
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
                tmpData.application_number = regNoRenderer(VALUE_TEN, moduleData.textile_id);
                tmpData.applicant_name = moduleData.enterprise_name;
                tmpData.title = 'Enterprise Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForTextile: function (fileNo) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (!fileNo) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var textileId = $('#textile_id_for_textile').val();
        if ($('#upload_for_textile_' + fileNo).val() != '') {
            var tradeLicence = checkValidationForDocument('upload_for_textile_' + fileNo, VALUE_ONE, 'textile', 10240);
            if (tradeLicence == false) {
                $('#upload_for_textile_' + fileNo).val('');
                return false;
            }
        }
        $('#upload_container_for_textile_' + fileNo).hide();
        $('#upload_name_container_for_textile_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();

        var formData = new FormData();
        formData.append('file_number_for_textile', fileNo);
        formData.append('textile_id_for_textile', textileId);
        formData.append('document_file', $('#upload_for_textile_' + fileNo)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'textile/upload_textile_document',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function (textStatus, errorThrown) {
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                $('#upload_name_container_for_textile_' + fileNo).hide();
                $('#spinner_template_' + fileNo).hide();
                $('#upload_container_for_textile_' + fileNo).show();
                showError(textStatus.statusText);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    $('#upload_name_container_for_textile_' + fileNo).hide();
                    $('#spinner_template_' + fileNo).hide();
                    $('#upload_container_for_textile_' + fileNo).show();
                    showError(parseData.message);
                    return false;
                }
                var textileData = parseData.textile_data;
                $('#textile_id_for_textile').val(textileData.textile_id);
                that.loadTextileDocument(fileNo, textileData);
            }
        });
    },
    loadTextileDocument: function (fileNo, textileData) {
        $('#upload_for_textile_' + fileNo).val('');
        $('#upload_name_href_for_textile_' + fileNo).attr('href', 'documents/textile/' + textileData.file_name);
        $('#remove_document_btn_for_textile_' + fileNo).attr('onclick', 'Textile.listview.askForRemove("' + textileData.textile_id + '", "' + fileNo + '")');
        $('#upload_container_for_textile_' + fileNo).hide();
        $('#upload_name_container_for_textile_' + fileNo).show();
        $('#spinner_template_' + fileNo).hide();
    },
    loadTextileDocumentForView: function (fileNo, textileData) {
        $('#upload_name_href_for_textile_view_' + fileNo).attr('href', 'documents/textile/' + textileData.file_name);
        $('#upload_container_for_textile_view_' + fileNo).hide();
        $('#upload_name_container_for_textile_view_' + fileNo).show();
    },
    askForRemove: function (textileId, fileNo) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!textileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Textile.listview.removeDocument(\'' + textileId + '\',\'' + fileNo + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (textileId, fileNo) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!textileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#upload_container_for_textile_' + fileNo).hide();
        $('#upload_name_container_for_textile_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        $.ajax({
            type: 'POST',
            url: 'textile/remove_document',
            data: $.extend({}, {'textile_id_for_textile': textileId, 'file_number_for_textile': fileNo}, getTokenData()),
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
                $('#upload_container_for_textile_' + fileNo).hide();
                $('#upload_name_container_for_textile_' + fileNo).show();
                $('#spinner_template_' + fileNo).hide();
                validationMessageShow('textile', textStatus.statusText);
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
                    $('#upload_container_for_textile_' + fileNo).hide();
                    $('#upload_name_container_for_textile_' + fileNo).show();
                    $('#spinner_template_' + fileNo).hide();
                    validationMessageShow('textile', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#upload_for_textile_' + fileNo).val('');
                $('#upload_name_href_for_textile_' + fileNo).attr('href', '');
                $('#remove_document_btn_for_textile_' + fileNo).attr('onclick', '');
                $('#upload_name_container_for_textile_' + fileNo).hide();
                $('#upload_container_for_textile_' + fileNo).show();
                $('#spinner_template_' + fileNo).hide();
            }
        });
    },
    loadFAC: function (textileData) {
        var facData = [];
        if (textileData.form_application_checklist.indexOf(',') != -1) {
            facData = (textileData.form_application_checklist).split(',');
        } else {
            facData.push(textileData.form_application_checklist)
        }
        $.each(facData, function (index, value) {
            $('input[name=form_application_checklist_for_textile][value="' + value + '"]').click();
        });
    },
    FACChangeEvent: function () {
        var facArray = [];
        $('[name="form_application_checklist_for_textile"]:checked').each(function (i, e) {
            facArray.push(parseInt(e.value));
        });
        this.hideShowFAC(facArray);
    },
    hideShowFAC: function (facArray) {
        if (facArray.indexOf(VALUE_ONE) != -1) {
            $('.doc-for-all').show();
            $('.doc-for-is').show();
            resetCounter('doc-sr-no');
            return false;
        }
        $('.doc-for-is').hide();
        $('.doc-for-all').show();
    }
});
