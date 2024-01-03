var msmeListTemplate = Handlebars.compile($('#msme_list_template').html());
var msmeTableTemplate = Handlebars.compile($('#msme_table_template').html());
var msmeActionTemplate = Handlebars.compile($('#msme_action_template').html());
var msmeFormTemplate = Handlebars.compile($('#msme_form_template').html());
var msmeViewTemplate = Handlebars.compile($('#msme_view_template').html());
var msmeUploadChallanTemplate = Handlebars.compile($('#msme_upload_challan_template').html());
var msmeViewDocumentTemplate = Handlebars.compile($('#msme_view_document_template').html());

var MSME = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
MSME.Router = Backbone.Router.extend({
    routes: {
        'msme': 'renderList',
        'msme_form': 'renderList',
        'edit_msme_form': 'renderList',
        'view_msme_form': 'renderList',
    },
    renderList: function () {
        MSME.listview.listPage();
    },
    renderListForForm: function () {
        MSME.listview.listPageMSMEForm();
    }
});
MSME.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        MSME.router.navigate('msme');
        var templateData = {};
        this.$el.html(msmeListTemplate(templateData));
        this.loadMSMEData(sDistrict, sStatus);

    },
    listPageMSMEForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(msmeListTemplate);
        this.newMSMEForm(false, {});
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
                rowData.ADMIN_MSME_DOC_PATH = ADMIN_MSME_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        rowData.module_type = VALUE_NINE;
        return msmeActionTemplate(rowData);
    },
    loadMSMEData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_NINE, data);
        };
        var that = this;
        MSME.router.navigate('msme');
        $('#msme_form_and_datatable_container').html(msmeTableTemplate(searchData));
        msmeDataTable = $('#msme_datatable').DataTable({
            ajax: {url: 'msme/get_msme_data', dataSrc: "msme_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'msme_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'enterprise_name'},
                {data: 'office_address'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'msme_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'msme_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#msme_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = msmeDataTable.row(tr);

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
    newMSMEForm: function (isEdit, msmeData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            MSME.router.navigate('edit_msme_form');
        } else {
            MSME.router.navigate('msme_form');
        }
        msmeData = that.basicDetailsForForm(msmeData);
        $('#msme_form_and_datatable_container').html(msmeFormTemplate(msmeData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_msme');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        renderOptionsForTwoDimensionalArray(cbTypeArray, 'unit_type_for_msme');
        generateBoxes('radio', constitutionArray, 'constitution', 'msme', msmeData.constitution, true);
        generateBoxes('checkbox', socialStatusArray, 'social_status', 'msme', msmeData.social_status, true);
        if (isEdit) {
            $('#district_for_msme').val(msmeData.district);
            $('#unit_type_for_msme').val(msmeData.unit_type);
            $('#entity_establishment_type').val(msmeData.entity_establishment_type);
            var docData = {};
            docData.msme_id = msmeData.msme_id;
            if (msmeData.application_form_file != '') {
                docData.file_name = msmeData.application_form_file;
                that.loadMSMEDocument(VALUE_TWO, docData);
            }
//            if (msmeData.declaration_file != '') {
//                docData.file_name = msmeData.declaration_file;
//                that.loadMSMEDocument(VALUE_ONE, docData);
//            }
//            if (msmeData.ci_is_file != '') {
//                docData.file_name = msmeData.ci_is_file;
//                that.loadMSMEDocument(VALUE_TWO, docData);
//            }
//            if (msmeData.afqc_file != '') {
//                docData.file_name = msmeData.afqc_file;
//                that.loadMSMEDocument(VALUE_THREE, docData);
//            }
//            if (msmeData.afpr_file != '') {
//                docData.file_name = msmeData.afpr_file;
//                that.loadMSMEDocument(VALUE_FOUR, docData);
//            }
//            if (msmeData.afscew_file != '') {
//                docData.file_name = msmeData.afscew_file;
//                that.loadMSMEDocument(VALUE_FIVE, docData);
//            }
//            if (msmeData.ifle_file != '') {
//                docData.file_name = msmeData.ifle_file;
//                that.loadMSMEDocument(VALUE_SIX, docData);
//            }
            if (msmeData.doc_1 != '') {
                docData.file_name = msmeData.doc_1;
                that.loadMSMEDocument(VALUE_SEVEN, docData);
            }
            if (msmeData.doc_2 != '') {
                docData.file_name = msmeData.doc_2;
                that.loadMSMEDocument(VALUE_EIGHT, docData);
            }
            if (msmeData.doc_3 != '') {
                docData.file_name = msmeData.doc_3;
                that.loadMSMEDocument(VALUE_NINE, docData);
            }
            if (msmeData.doc_4 != '') {
                docData.file_name = msmeData.doc_4;
                that.loadMSMEDocument(VALUE_TEN, docData);
            }
            if (msmeData.doc_5 != '') {
                docData.file_name = msmeData.doc_5;
                that.loadMSMEDocument(VALUE_ELEVEN, docData);
            }
            if (msmeData.doc_6 != '') {
                docData.file_name = msmeData.doc_6;
                that.loadMSMEDocument(VALUE_TWELVE, docData);
            }
            if (msmeData.doc_7 != '') {
                docData.file_name = msmeData.doc_7;
                that.loadMSMEDocument(VALUE_THIRTEEN, docData);
            }
            if (msmeData.doc_8 != '') {
                docData.file_name = msmeData.doc_8;
                that.loadMSMEDocument(VALUE_FOURTEEN, docData);
            }
            if (msmeData.doc_9 != '') {
                docData.file_name = msmeData.doc_9;
                that.loadMSMEDocument(VALUE_FIFTEEN, docData);
            }
            if (msmeData.doc_10 != '') {
                docData.file_name = msmeData.doc_10;
                that.loadMSMEDocument(VALUE_SIXTEEN, docData);
            }
            if (msmeData.doc_11 != '') {
                docData.file_name = msmeData.doc_11;
                that.loadMSMEDocument(VALUE_SEVENTEEN, docData);
            }
            if (msmeData.doc_12 != '') {
                docData.file_name = msmeData.doc_12;
                that.loadMSMEDocument(VALUE_EIGHTEEN, docData);
            }
            if (msmeData.doc_13 != '') {
                docData.file_name = msmeData.doc_13;
                that.loadMSMEDocument(VALUE_NINETEEN, docData);
            }
            if (msmeData.doc_14 != '') {
                docData.file_name = msmeData.doc_14;
                that.loadMSMEDocument(VALUE_TWENTY, docData);
            }
            if (msmeData.doc_15 != '') {
                docData.file_name = msmeData.doc_15;
                that.loadMSMEDocument(VALUE_TWENTYONE, docData);
            }
            if (msmeData.doc_16 != '') {
                docData.file_name = msmeData.doc_16;
                that.loadMSMEDocument(VALUE_TWENTYTWO, docData);
            }
            if (msmeData.doc_17 != '') {
                docData.file_name = msmeData.doc_17;
                that.loadMSMEDocument(VALUE_TWENTYTHREE, docData);
            }
            if (msmeData.doc_18 != '') {
                docData.file_name = msmeData.doc_18;
                that.loadMSMEDocument(VALUE_TWENTYFOUR, docData);
            }
            if (msmeData.doc_19 != '') {
                docData.file_name = msmeData.doc_19;
                that.loadMSMEDocument(VALUE_TWENTYFIVE, docData);
            }
            if (msmeData.doc_20 != '') {
                docData.file_name = msmeData.doc_20;
                that.loadMSMEDocument(VALUE_TWENTYSIX, docData);
            }
            if (msmeData.doc_21 != '') {
                docData.file_name = msmeData.doc_21;
                that.loadMSMEDocument(VALUE_TWENTYSEVEN, docData);
            }
            if (msmeData.doc_22 != '') {
                docData.file_name = msmeData.doc_22;
                that.loadMSMEDocument(VALUE_TWENTYEIGHT, docData);
            }
            if (msmeData.doc_23 != '') {
                docData.file_name = msmeData.doc_23;
                that.loadMSMEDocument(VALUE_TWENTYNINE, docData);
            }
            if (msmeData.doc_24 != '') {
                docData.file_name = msmeData.doc_24;
                that.loadMSMEDocument(VALUE_THIRTY, docData);
            }
        } else {
            $('input[name=form_application_checklist_for_msme][value="' + VALUE_TWO + '"]').click();
        }
        resetCounter('scheme-sr-no');
        resetCounter('doc-sr-no');
        if (isEdit) {
            that.loadFAC(msmeData);
        }
        generateSelect2();
        $('#msme_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitMSME($('#submit_btn_for_msme'));
            }
        });
    },
    editOrViewMSME: function (btnObj, msmeId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!msmeId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'msme/get_msme_data_by_id',
            type: 'post',
            data: $.extend({}, {'msme_id': msmeId}, getTokenData()),
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
                var msmeData = parseData.msme_data;
                if (isEdit) {
                    that.newMSMEForm(isEdit, msmeData);
                } else {
                    that.viewMSMEForm(msmeData);
                }
            }
        });
    },
    basicDetailsForForm: function (msmeData) {
        msmeData.VALUE_ONE = VALUE_ONE;
        msmeData.VALUE_TWO = VALUE_TWO;
        msmeData.VALUE_THREE = VALUE_THREE;
        msmeData.VALUE_FOUR = VALUE_FOUR;
        msmeData.VALUE_FIVE = VALUE_FIVE;
        msmeData.VALUE_SIX = VALUE_SIX;
        msmeData.VALUE_SEVEN = VALUE_SEVEN;
        msmeData.VALUE_EIGHT = VALUE_EIGHT;
        msmeData.VALUE_NINE = VALUE_NINE;
        msmeData.VALUE_TEN = VALUE_TEN;
        msmeData.VALUE_ELEVEN = VALUE_ELEVEN;
        msmeData.VALUE_TWELVE = VALUE_TWELVE;
        msmeData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        msmeData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        msmeData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        msmeData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        msmeData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        msmeData.VALUE_EIGHTEEN = VALUE_EIGHTEEN;
        msmeData.VALUE_NINETEEN = VALUE_NINETEEN;
        msmeData.VALUE_TWENTY = VALUE_TWENTY;
        msmeData.VALUE_TWENTYONE = VALUE_TWENTYONE;
        msmeData.VALUE_TWENTYTWO = VALUE_TWENTYTWO;
        msmeData.VALUE_TWENTYTHREE = VALUE_TWENTYTHREE;
        msmeData.VALUE_TWENTYFOUR = VALUE_TWENTYFOUR;
        msmeData.VALUE_TWENTYFIVE = VALUE_TWENTYFIVE;
        msmeData.VALUE_TWENTYSIX = VALUE_TWENTYSIX;
        msmeData.VALUE_TWENTYSEVEN = VALUE_TWENTYSEVEN;
        msmeData.VALUE_TWENTYEIGHT = VALUE_TWENTYEIGHT;
        msmeData.VALUE_TWENTYNINE = VALUE_TWENTYNINE;
        msmeData.VALUE_THIRTY = VALUE_THIRTY;
        msmeData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        return msmeData;
    },
    viewMSMEForm: function (msmeData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        MSME.router.navigate('view_msme_form');
        msmeData = that.basicDetailsForForm(msmeData);
        msmeData.district_text = talukaArray[msmeData.district] ? talukaArray[msmeData.district] : '';
        msmeData.unit_type_text = cbTypeArray[msmeData.unit_type] ? cbTypeArray[msmeData.unit_type] : '';
        $('#msme_form_and_datatable_container').html(msmeViewTemplate(msmeData));
        $('#view_document_container_for_msme').html(msmeViewDocumentTemplate(msmeData));
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        generateBoxes('radio', constitutionArray, 'constitution', 'msme_view', msmeData.constitution, true);
        generateBoxes('checkbox', socialStatusArray, 'social_status', 'msme_view', msmeData.social_status, true);
        var docData = {};
        $('#entity_establishment_type').val(msmeData.entity_establishment_type);
        if (msmeData.application_form_file != '') {
            docData.file_name = msmeData.application_form_file;
            that.loadMSMEDocumentForView(VALUE_TWO, docData);
        }
//        if (msmeData.declaration_file != '') {
//            docData.file_name = msmeData.declaration_file;
//            that.loadMSMEDocumentForView(VALUE_ONE, docData);
//        }
//        if (msmeData.ci_is_file != '') {
//            docData.file_name = msmeData.ci_is_file;
//            that.loadMSMEDocumentForView(VALUE_TWO, docData);
//        }
//        if (msmeData.afqc_file != '') {
//            docData.file_name = msmeData.afqc_file;
//            that.loadMSMEDocumentForView(VALUE_THREE, docData);
//        }
//        if (msmeData.afpr_file != '') {
//            docData.file_name = msmeData.afpr_file;
//            that.loadMSMEDocumentForView(VALUE_FOUR, docData);
//        }
//        if (msmeData.afscew_file != '') {
//            docData.file_name = msmeData.afscew_file;
//            that.loadMSMEDocumentForView(VALUE_FIVE, docData);
//        }
//        if (msmeData.ifle_file != '') {
//            docData.file_name = msmeData.ifle_file;
//            that.loadMSMEDocumentForView(VALUE_SIX, docData);
//        }
        if (msmeData.doc_1 != '') {
            docData.file_name = msmeData.doc_1;
            that.loadMSMEDocumentForView(VALUE_SEVEN, docData);
        }
        if (msmeData.doc_2 != '') {
            docData.file_name = msmeData.doc_2;
            that.loadMSMEDocumentForView(VALUE_EIGHT, docData);
        }
        if (msmeData.doc_3 != '') {
            docData.file_name = msmeData.doc_3;
            that.loadMSMEDocumentForView(VALUE_NINE, docData);
        }
        if (msmeData.doc_4 != '') {
            docData.file_name = msmeData.doc_4;
            that.loadMSMEDocumentForView(VALUE_TEN, docData);
        }
        if (msmeData.doc_5 != '') {
            docData.file_name = msmeData.doc_5;
            that.loadMSMEDocumentForView(VALUE_ELEVEN, docData);
        }
        if (msmeData.doc_6 != '') {
            docData.file_name = msmeData.doc_6;
            that.loadMSMEDocumentForView(VALUE_TWELVE, docData);
        }
        if (msmeData.doc_7 != '') {
            docData.file_name = msmeData.doc_7;
            that.loadMSMEDocumentForView(VALUE_THIRTEEN, docData);
        }
        if (msmeData.doc_8 != '') {
            docData.file_name = msmeData.doc_8;
            that.loadMSMEDocumentForView(VALUE_FOURTEEN, docData);
        }
        if (msmeData.doc_9 != '') {
            docData.file_name = msmeData.doc_9;
            that.loadMSMEDocumentForView(VALUE_FIFTEEN, docData);
        }
        if (msmeData.doc_10 != '') {
            docData.file_name = msmeData.doc_10;
            that.loadMSMEDocumentForView(VALUE_SIXTEEN, docData);
        }
        if (msmeData.doc_11 != '') {
            docData.file_name = msmeData.doc_11;
            that.loadMSMEDocumentForView(VALUE_SEVENTEEN, docData);
        }
        if (msmeData.doc_12 != '') {
            docData.file_name = msmeData.doc_12;
            that.loadMSMEDocumentForView(VALUE_EIGHTEEN, docData);
        }
        if (msmeData.doc_13 != '') {
            docData.file_name = msmeData.doc_13;
            that.loadMSMEDocumentForView(VALUE_NINETEEN, docData);
        }
        if (msmeData.doc_14 != '') {
            docData.file_name = msmeData.doc_14;
            that.loadMSMEDocumentForView(VALUE_TWENTY, docData);
        }
        if (msmeData.doc_15 != '') {
            docData.file_name = msmeData.doc_15;
            that.loadMSMEDocumentForView(VALUE_TWENTYONE, docData);
        }
        if (msmeData.doc_16 != '') {
            docData.file_name = msmeData.doc_16;
            that.loadMSMEDocumentForView(VALUE_TWENTYTWO, docData);
        }
        if (msmeData.doc_17 != '') {
            docData.file_name = msmeData.doc_17;
            that.loadMSMEDocumentForView(VALUE_TWENTYTHREE, docData);
        }
        if (msmeData.doc_18 != '') {
            docData.file_name = msmeData.doc_18;
            that.loadMSMEDocumentForView(VALUE_TWENTYFOUR, docData);
        }
        if (msmeData.doc_19 != '') {
            docData.file_name = msmeData.doc_19;
            that.loadMSMEDocumentForView(VALUE_TWENTYFIVE, docData);
        }
        if (msmeData.doc_20 != '') {
            docData.file_name = msmeData.doc_20;
            that.loadMSMEDocumentForView(VALUE_TWENTYSIX, docData);
        }
        if (msmeData.doc_21 != '') {
            docData.file_name = msmeData.doc_21;
            that.loadMSMEDocumentForView(VALUE_TWENTYSEVEN, docData);
        }
        if (msmeData.doc_22 != '') {
            docData.file_name = msmeData.doc_22;
            that.loadMSMEDocumentForView(VALUE_TWENTYEIGHT, docData);
        }
        if (msmeData.doc_23 != '') {
            docData.file_name = msmeData.doc_23;
            that.loadMSMEDocumentForView(VALUE_TWENTYNINE, docData);
        }
        if (msmeData.doc_24 != '') {
            docData.file_name = msmeData.doc_24;
            that.loadMSMEDocumentForView(VALUE_THIRTY, docData);
        }
        resetCounter('scheme-sr-no');
        resetCounter('doc-sr-no');
        that.loadFAC(msmeData);
        $('[name=form_application_checklist_for_msme]').attr('disabled', 'disabled');
        $('[name=form_application_checklist_for_msme]').removeAttr('onclick');
    },
    checkValidationForMSME: function (msmeData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!msmeData.district_for_msme) {
            return getBasicMessageAndFieldJSONArray('district_for_msme', selectDistrictValidationMessage);
        }
        if (!msmeData.enterprise_name_for_msme) {
            return getBasicMessageAndFieldJSONArray('enterprise_name_for_msme', enterpriseNameValidationMessage);
        }
        if (!msmeData.office_address_for_msme) {
            return getBasicMessageAndFieldJSONArray('office_address_for_msme', officeAddressValidationMessage);
        }
        if (!msmeData.office_contact_number_for_msme) {
            return getBasicMessageAndFieldJSONArray('office_contact_number_for_msme', officeContactNoValidationMessage);
        }
        if (!msmeData.factory_contact_number_for_msme) {
            return getBasicMessageAndFieldJSONArray('factory_contact_number_for_msme', factoryContactNoValidationMessage);
        }
        if (!msmeData.constitution_for_msme) {
            $('#constitution_for_msme_1').focus();
            return getBasicMessageAndFieldJSONArray('constitution_for_msme', oneOptionValidationMessage);
        }
        if (!msmeData.promoter_name_for_msme) {
            return getBasicMessageAndFieldJSONArray('promoter_name_for_msme', promoterNameValidationMessage);
        }
        if (!msmeData.promoter_designation_for_msme) {
            return getBasicMessageAndFieldJSONArray('promoter_designation_for_msme', promoterDesignationValidationMessage);
        }
        if (!msmeData.social_status_for_msme) {
            $('#social_status_for_msme_1').focus();
            return getBasicMessageAndFieldJSONArray('social_status_for_msme', oneOptionValidationMessage);
        }
        if (!msmeData.ap_name_for_msme) {
            return getBasicMessageAndFieldJSONArray('ap_name_for_msme', apNameValidationMessage);
        }
        if (!msmeData.ap_designation_for_msme) {
            return getBasicMessageAndFieldJSONArray('ap_designation_for_msme', apDesignationValidationMessage);
        }
        if (!msmeData.unit_type_for_msme) {
            return getBasicMessageAndFieldJSONArray('unit_type_for_msme', oneOptionValidationMessage);
        }
        return '';
    },
    askForSubmitMSME: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'MSME.listview.submitMSME(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitMSME: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var msmeData = $('#msme_form').serializeFormJSON();
        var validationData = that.checkValidationForMSME(msmeData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('msme-' + validationData.field, validationData.message);
            return false;
        }

        if (!msmeData.form_application_checklist_for_msme) {
            $('#is_is').focus();
            validationMessageShow('msme-form_application_checklist_for_msme', oneOptionValidationMessage);
            return false;
        }

        msmeData.module_type = moduleType;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_msme') : $('#submit_btn_for_msme');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'msme/submit_msme',
            data: $.extend({}, msmeData, getTokenData()),
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
                validationMessageShow('msme', textStatus.statusText);
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
                    validationMessageShow('msme', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                MSME.listview.loadMSMEData();
                showSuccess(parseData.message);
            }
        });
    },
    downloadUploadChallan: function (msmeId) {
        if (!msmeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + msmeId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'msme/get_msme_data_by_msme_id',
            type: 'post',
            data: $.extend({}, {'msme_id': msmeId}, getTokenData()),
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
                var msmeData = parseData.msme_data;
                that.showChallan(msmeData);
            }
        });
    },
    showChallan: function (msmeData) {
        showPopup();
        if (msmeData.status != VALUE_FIVE && msmeData.status != VALUE_SIX && msmeData.status != VALUE_SEVEN) {
            if (!msmeData.hide_submit_btn) {
                msmeData.show_fees_paid = true;
            }
        }
        if (msmeData.payment_type == VALUE_ONE) {
            msmeData.utitle = 'Fees Paid Challan Copy';
        } else {
            msmeData.style = 'display: none;';
        }
        if (msmeData.payment_type == VALUE_TWO) {
            msmeData.show_dd_po_option = true;
            msmeData.utitle = 'Demand Draft (DD)';
        }
        msmeData.module_type = VALUE_NINE;
        $('#popup_container').html(msmeUploadChallanTemplate(msmeData));
        loadFB(VALUE_NINE, msmeData.fb_data);
        loadPH(VALUE_NINE, msmeData.msme_id, msmeData.ph_data);

        if (msmeData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'msme_upload_challan', msmeData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'msme_upload_challan', 'uc', 'radio');
            if (msmeData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_msme_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (msmeData.challan != '') {
            $('#challan_container_for_msme_upload_challan').hide();
            $('#challan_name_container_for_msme_upload_challan').show();
            $('#challan_name_href_for_msme_upload_challan').attr('href', 'documents/msme/' + msmeData.challan);
            $('#challan_name_for_msme_upload_challan').html(msmeData.challan);
        }
        if (msmeData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_msme_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_msme_upload_challan').show();
            $('#fees_paid_challan_name_href_for_msme_upload_challan').attr('href', 'documents/msme/' + msmeData.fees_paid_challan);
            $('#fees_paid_challan_name_for_msme_upload_challan').html(msmeData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_msme_upload_challan').attr('onclick', 'MSME.listview.removeFeesPaidChallan("' + msmeData.msme_id + '")');
        }
    },
    removeFeesPaidChallan: function (msmeId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!msmeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'msme/remove_fees_paid_challan',
            data: $.extend({}, {'msme_id': msmeId}, getTokenData()),
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
                validationMessageShow('msme-uc', textStatus.statusText);
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
                    validationMessageShow('msme-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-msme-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'msme_upload_challan');
                $('#status_' + msmeId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-msme-uc').html('');
        validationMessageHide();
        var msmeId = $('#msme_id_for_msme_upload_challan').val();
        if (!msmeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_msme_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_msme_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_msme_upload_challan').focus();
                validationMessageShow('msme-uc-fees_paid_challan_for_msme_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_msme_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_msme_upload_challan').focus();
                validationMessageShow('msme-uc-fees_paid_challan_for_msme_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_msme_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#msme_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'msme/upload_fees_paid_challan',
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
                validationMessageShow('msme-uc', textStatus.statusText);
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
                    validationMessageShow('msme-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + msmeId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (msmeId) {
        if (!msmeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#msme_id_for_certificate').val(msmeId);
        $('#msme_certificate_pdf_form').submit();
        $('#msme_id_for_certificate').val('');
    },
    getQueryData: function (msmeId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!msmeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_NINE;
        templateData.module_id = msmeId;
        var btnObj = $('#query_btn_for_msme_' + msmeId);
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
                tmpData.application_number = regNoRenderer(VALUE_NINE, moduleData.msme_id);
                tmpData.applicant_name = moduleData.enterprise_name;
                tmpData.title = 'Enterprise Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForMSME: function (fileNo) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (!fileNo) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var msmeId = $('#msme_id_for_msme').val();
        if ($('#upload_for_msme_' + fileNo).val() != '') {
            var tradeLicence = checkValidationForDocument('upload_for_msme_' + fileNo, VALUE_ONE, 'msme', 10240);
            if (tradeLicence == false) {
                $('#upload_for_msme_' + fileNo).val('');
                return false;
            }
        }
        $('#upload_container_for_msme_' + fileNo).hide();
        $('#upload_name_container_for_msme_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();

        var formData = new FormData();
        formData.append('file_number_for_msme', fileNo);
        formData.append('msme_id_for_msme', msmeId);
        formData.append('document_file', $('#upload_for_msme_' + fileNo)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'msme/upload_msme_document',
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
                $('#upload_name_container_for_msme_' + fileNo).hide();
                $('#spinner_template_' + fileNo).hide();
                $('#upload_container_for_msme_' + fileNo).show();
                showError(textStatus.statusText);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    $('#upload_name_container_for_msme_' + fileNo).hide();
                    $('#spinner_template_' + fileNo).hide();
                    $('#upload_container_for_msme_' + fileNo).show();
                    showError(parseData.message);
                    return false;
                }
                var msmeData = parseData.msme_data;
                $('#msme_id_for_msme').val(msmeData.msme_id);
                that.loadMSMEDocument(fileNo, msmeData);
            }
        });
    },
    loadMSMEDocument: function (fileNo, msmeData) {
        $('#upload_for_msme_' + fileNo).val('');
        $('#upload_name_href_for_msme_' + fileNo).attr('href', 'documents/msme/' + msmeData.file_name);
        $('#remove_document_btn_for_msme_' + fileNo).attr('onclick', 'MSME.listview.askForRemove("' + msmeData.msme_id + '", "' + fileNo + '")');
        $('#upload_container_for_msme_' + fileNo).hide();
        $('#upload_name_container_for_msme_' + fileNo).show();
        $('#spinner_template_' + fileNo).hide();
    },
    loadMSMEDocumentForView: function (fileNo, msmeData) {
        $('#upload_name_href_for_msme_view_' + fileNo).attr('href', 'documents/msme/' + msmeData.file_name);
        $('#upload_container_for_msme_view_' + fileNo).hide();
        $('#upload_name_container_for_msme_view_' + fileNo).show();
    },
    askForRemove: function (msmeId, fileNo) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!msmeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'MSME.listview.removeDocument(\'' + msmeId + '\',\'' + fileNo + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (msmeId, fileNo) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!msmeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#upload_container_for_msme_' + fileNo).hide();
        $('#upload_name_container_for_msme_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        $.ajax({
            type: 'POST',
            url: 'msme/remove_document',
            data: $.extend({}, {'msme_id_for_msme': msmeId, 'file_number_for_msme': fileNo}, getTokenData()),
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
                $('#upload_container_for_msme_' + fileNo).hide();
                $('#upload_name_container_for_msme_' + fileNo).show();
                $('#spinner_template_' + fileNo).hide();
                validationMessageShow('msme', textStatus.statusText);
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
                    $('#upload_container_for_msme_' + fileNo).hide();
                    $('#upload_name_container_for_msme_' + fileNo).show();
                    $('#spinner_template_' + fileNo).hide();
                    validationMessageShow('msme', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#upload_for_msme_' + fileNo).val('');
                $('#upload_name_href_for_msme_' + fileNo).attr('href', '');
                $('#remove_document_btn_for_msme_' + fileNo).attr('onclick', '');
                $('#upload_name_container_for_msme_' + fileNo).hide();
                $('#upload_container_for_msme_' + fileNo).show();
                $('#spinner_template_' + fileNo).hide();
            }
        });
    },
    loadFAC: function (msmeData) {
        var facData = [];
        if (msmeData.form_application_checklist.indexOf(',') != -1) {
            facData = (msmeData.form_application_checklist).split(',');
        } else {
            facData.push(msmeData.form_application_checklist)
        }
        $.each(facData, function (index, value) {
            $('input[name=form_application_checklist_for_msme][value="' + value + '"]').click();
        });
    },
    FACChangeEvent: function () {
        var facArray = [];
        $('[name="form_application_checklist_for_msme"]:checked').each(function (i, e) {
            facArray.push(parseInt(e.value));
        });
        this.hideShowFAC(facArray);
    },
    hideShowFAC: function (facArray) {
        if (facArray.length == VALUE_ONE && facArray.indexOf(VALUE_TWO) != -1) {
            $('.doc-for-all').hide();
            $('.doc-for-is').show();
            resetCounter('is-doc-sr-no');
            return false;
        }
        if (facArray.indexOf(VALUE_TWO) != -1) {
            $('.doc-for-all').show();
            $('.doc-for-is').show();
            resetCounter('doc-sr-no');
            return false;
        }
        $('.doc-for-is').hide();
        $('.doc-for-all').show();
    }
});
