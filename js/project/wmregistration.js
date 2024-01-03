var wmregistrationListTemplate = Handlebars.compile($('#wmregistration_list_template').html());
var wmregistrationTableTemplate = Handlebars.compile($('#wmregistration_table_template').html());
var wmregistrationActionTemplate = Handlebars.compile($('#wmregistration_action_template').html());
var wmregistrationFormTemplate = Handlebars.compile($('#wmregistration_form_template').html());
var wmregistrationViewTemplate = Handlebars.compile($('#wmregistration_view_template').html());
var wmregistrationProprietorInfoTemplate = Handlebars.compile($('#wmregistration_proprietor_info_template').html());
var wmregistrationUploadChallanTemplate = Handlebars.compile($('#wmregistration_upload_challan_template').html());
var tempPersonCnt = 1;
var Wmregistration = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Wmregistration.Router = Backbone.Router.extend({
    routes: {
        'wmregistration': 'renderList',
        'wmregistration_form': 'renderListForForm',
        'edit_wmregistration_form': 'renderList',
        'view_wmregistration_form': 'renderList',
    },
    renderList: function () {
        Wmregistration.listview.listPage();
    },
    renderListForForm: function () {
        Wmregistration.listview.listPageWmregistrationForm();
    }
});
Wmregistration.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('wmregistration', 'active');
        Wmregistration.router.navigate('wmregistration');
        var templateData = {};
        this.$el.html(wmregistrationListTemplate(templateData));
        this.loadWmregistrationData(sDistrict, sStatus);

    },
    listPageWmregistrationForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('wmregistration', 'active');
        this.$el.html(wmregistrationListTemplate);
        this.newWmregistrationForm(false, {});
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
                rowData.ADMIN_WMREG_DOC_PATH = ADMIN_WMREG_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return wmregistrationActionTemplate(rowData);
    },
    loadWmregistrationData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_ONE, data);
        };
        var that = this;
        Wmregistration.router.navigate('wmregistration');
        $('#wmregistration_form_and_datatable_container').html(wmregistrationTableTemplate(searchData));
        wmregistrationDataTable = $('#wmregistration_datatable').DataTable({
            ajax: {
                url: 'wmregistration/get_wmregistration_data',
                dataSrc: "wmregistration_data",
                type: "post",
                data: $.extend({}, searchData, getTokenData()),
            },
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'wmregistration_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'application_category', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'wmregistration_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'wmregistration_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#wmregistration_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = wmregistrationDataTable.row(tr);

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
    newWmregistrationForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.wmregistration_data;
            Wmregistration.router.navigate('edit_wmregistration_form');
        } else {
            var formData = {};
            Wmregistration.router.navigate('wmregistration_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.wmregistration_data = parseData.wmregistration_data;
        $('#wmregistration_form_and_datatable_container').html(wmregistrationFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(premisesStatusArray, 'premises_status');
        renderOptionsForTwoDimensionalArray(identityChoiceArray, 'identity_choice');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#declarationone').attr('checked', 'checked');
            $('#declarationtwo').attr('checked', 'checked');
            $('#declarationthree').attr('checked', 'checked');

            $('#application_category').val(formData.application_category);

            if (formData.trade_licence != '') {
                that.showDocument('trade_licence_container_for_wmregistration', 'trade_licence_name_image_for_wmregistration', 'trade_licence_name_container_for_wmregistration',
                        'trade_licence_download', 'trade_licence', formData.trade_licence, formData.wmregistration_id, VALUE_ONE);
            }
            if (formData.proof_of_ownership != '') {
                that.showDocument('proof_of_ownership_container_for_wmregistration', 'proof_of_ownership_name_image_for_wmregistration', 'proof_of_ownership_name_container_for_wmregistration',
                        'proof_of_ownership_download', 'proof_of_ownership', formData.proof_of_ownership, formData.wmregistration_id, VALUE_TWO);
            }
            if (formData.gst_certificate != '') {
                that.showDocument('gst_certificate_container_for_wmregistration', 'gst_certificate_name_image_for_wmregistration', 'gst_certificate_name_container_for_wmregistration',
                        'gst_certificate_download', 'gst_certificate', formData.gst_certificate, formData.wmregistration_id, VALUE_THREE);
            }
            if (formData.partnership_deed != '') {
                that.showDocument('partnership_deed_container_for_wmregistration', 'partnership_deed_name_image_for_wmregistration', 'partnership_deed_name_container_for_wmregistration',
                        'partnership_deed_download', 'partnership_deed', formData.partnership_deed, formData.wmregistration_id, VALUE_FOUR);
            }
            if (formData.memorandum_articles != '') {
                that.showDocument('memorandum_articles_container_for_wmregistration', 'memorandum_articles_name_image_for_wmregistration', 'memorandum_articles_name_container_for_wmregistration',
                        'memorandum_articles_download', 'memorandum_articles', formData.memorandum_articles, formData.wmregistration_id, VALUE_FIVE);
            }
            if (formData.item_to_be_packed != '') {
                that.showDocument('item_to_be_packed_container_for_wmregistration', 'item_to_be_packed_name_image_for_wmregistration', 'item_to_be_packed_name_container_for_wmregistration',
                        'item_to_be_packed_download', 'item_to_be_packed', formData.item_to_be_packed, formData.wmregistration_id, VALUE_SIX);
            }
            if (formData.list_of_directors != '') {
                that.showDocument('list_of_directors_container_for_wmregistration', 'list_of_directors_name_image_for_wmregistration', 'list_of_directors_name_container_for_wmregistration',
                        'list_of_directors_download', 'list_of_directors', formData.list_of_directors, formData.wmregistration_id, VALUE_SEVEN);
            }
            if (formData.code_certificate != '') {
                that.showDocument('code_certificate_container_for_wmregistration', 'code_certificate_name_image_for_wmregistration', 'code_certificate_name_container_for_wmregistration',
                        'code_certificate_download', 'code_certificate', formData.code_certificate, formData.wmregistration_id, VALUE_EIGHT);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_wmregistration', 'seal_and_stamp_name_image_for_wmregistration', 'seal_and_stamp_name_container_for_wmregistration',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.wmregistration_id, VALUE_NINE);
            }

            var proprietorInfo = JSON.parse(formData.proprietor_details);
            $.each(proprietorInfo, function (key, value) {
                that.addMultipleProprietor(value);
            })
        } else {
            that.addMultipleProprietor({});
        }
        generateSelect2();
        datePicker();
        $('#wmregistration_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitWmregistration($('#submit_btn_for_wmregistration'));
            }
        });
    },
    editOrViewWmregistration: function (btnObj, wmregistrationId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!wmregistrationId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'wmregistration/get_wmregistration_data_by_id',
            type: 'post',
            data: $.extend({}, {'wmregistration_id': wmregistrationId}, getTokenData()),
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
                    that.newWmregistrationForm(isEdit, parseData);
                } else {
                    that.viewWmregistrationForm(parseData);
                }
            }
        });
    },
    viewWmregistrationForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.wmregistration_data;
        Wmregistration.router.navigate('view_wmregistration_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#wmregistration_form_and_datatable_container').html(wmregistrationViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');

        $('#declarationone').attr('checked', 'checked');
        $('#declarationtwo').attr('checked', 'checked');
        $('#declarationthree').attr('checked', 'checked');
        $('#application_category').val(formData.application_category);
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.trade_licence != '') {
            that.showDocument('trade_licence_container_for_wmregistration', 'trade_licence_name_image_for_wmregistration', 'trade_licence_name_container_for_wmregistration',
                    'trade_licence_download', 'trade_licence', formData.trade_licence);
        }
        if (formData.proof_of_ownership != '') {
            that.showDocument('proof_of_ownership_container_for_wmregistration', 'proof_of_ownership_name_image_for_wmregistration', 'proof_of_ownership_name_container_for_wmregistration',
                    'proof_of_ownership_download', 'proof_of_ownership', formData.proof_of_ownership);
        }
        if (formData.gst_certificate != '') {
            that.showDocument('gst_certificate_container_for_wmregistration', 'gst_certificate_name_image_for_wmregistration', 'gst_certificate_name_container_for_wmregistration',
                    'gst_certificate_download', 'gst_certificate', formData.gst_certificate);
        }
        if (formData.partnership_deed != '') {
            that.showDocument('partnership_deed_container_for_wmregistration', 'partnership_deed_name_image_for_wmregistration', 'partnership_deed_name_container_for_wmregistration',
                    'partnership_deed_download', 'partnership_deed', formData.partnership_deed);
        }
        if (formData.memorandum_articles != '') {
            that.showDocument('memorandum_articles_container_for_wmregistration', 'memorandum_articles_name_image_for_wmregistration', 'memorandum_articles_name_container_for_wmregistration',
                    'memorandum_articles_download', 'memorandum_articles', formData.memorandum_articles);
        }
        if (formData.item_to_be_packed != '') {
            that.showDocument('item_to_be_packed_container_for_wmregistration', 'item_to_be_packed_name_image_for_wmregistration', 'item_to_be_packed_name_container_for_wmregistration',
                    'item_to_be_packed_download', 'item_to_be_packed', formData.item_to_be_packed);
        }
        if (formData.list_of_directors != '') {
            that.showDocument('list_of_directors_container_for_wmregistration', 'list_of_directors_name_image_for_wmregistration', 'list_of_directors_name_container_for_wmregistration',
                    'list_of_directors_download', 'list_of_directors', formData.list_of_directors);
        }
        if (formData.code_certificate != '') {
            that.showDocument('code_certificate_container_for_wmregistration', 'code_certificate_name_image_for_wmregistration', 'code_certificate_name_container_for_wmregistration',
                    'code_certificate_download', 'code_certificate', formData.code_certificate);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_wmregistration', 'seal_and_stamp_name_image_for_wmregistration', 'seal_and_stamp_name_container_for_wmregistration',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }

        var proprietorInfo = JSON.parse(formData.proprietor_details);
        $.each(proprietorInfo, function (key, value) {
            that.addMultipleProprietor(value);
        })
    },
    checkValidationForWmregistration: function (wmregistrationData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!wmregistrationData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!wmregistrationData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!wmregistrationData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!wmregistrationData.location_of_factory) {
            return getBasicMessageAndFieldJSONArray('location_of_factory', completeAddressValidationMessage);
        }
        if (!wmregistrationData.branches) {
            return getBasicMessageAndFieldJSONArray('branches', branchValidationMessage);
        }
        if (!wmregistrationData.application_category) {
            return getBasicMessageAndFieldJSONArray('application_category', applicantCategoryValidationMessage);
        }
        if (!wmregistrationData.item_detail) {
            return getBasicMessageAndFieldJSONArray('item_detail', itemDetailValidationMessage);
        }
        return '';
    },
    askForSubmitWmregistration: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Wmregistration.listview.submitWmregistration(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitWmregistration: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var wmregistrationData = $('#wmregistration_form').serializeFormJSON();
        var validationData = that.checkValidationForWmregistration(wmregistrationData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('wmregistration-' + validationData.field, validationData.message);
            return false;
        }

        var proprietorInfoItem = [];
        var isproprietorValidation = false;

        $('.proprietor_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var proprietorInfo = {};
            var occupierName = $('#occupier_name_' + cnt).val();
            if (occupierName == '' || occupierName == null) {
                $('#occupier_name_' + cnt).focus();
                validationMessageShow('wmregistration-' + cnt, occupierNameValidationMessage);
                isproprietorValidation = true;
                return false;
            }
            proprietorInfo.occupier_name = occupierName;

            var fatherName = $('#father_name_' + cnt).val();
            if (fatherName == '' || fatherName == null) {
                $('#father_name_' + cnt).focus();
                validationMessageShow('wmregistration-' + cnt, fatherNameValidationMessage);
                isproprietorValidation = true;
                return false;
            }
            proprietorInfo.father_name = fatherName;

            var address = $('#address_' + cnt).val();
            if (address == '' || address == null) {
                $('#address_' + cnt).focus();
                validationMessageShow('wmregistration-' + cnt, proprietorAddressValidationMessage);
                isproprietorValidation = true;
                return false;
            }
            proprietorInfo.address = address;
            proprietorInfoItem.push(proprietorInfo);
        });


        if (isproprietorValidation) {
            return false;
        }

        if ($('#trade_licence_container_for_wmregistration').is(':visible')) {
            var tradeLicence = checkValidationForDocument('trade_licence_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (tradeLicence == false) {
                return false;
            }
        }

        if ($('#proof_of_ownership_container_for_wmregistration').is(':visible')) {
            var proofOfOwnership = checkValidationForDocument('proof_of_ownership_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (proofOfOwnership == false) {
                return false;
            }
        }
        if ($('#gst_certificate_container_for_wmregistration').is(':visible')) {
            var tradeLicence = checkValidationForDocument('gst_certificate_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (tradeLicence == false) {
                return false;
            }
        }

        if ($('#partnership_deed_container_for_wmregistration').is(':visible')) {
            var proofOfOwnership = checkValidationForDocument('partnership_deed_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (proofOfOwnership == false) {
                return false;
            }
        }
        if ($('#memorandum_articles_container_for_wmregistration').is(':visible')) {
            var tradeLicence = checkValidationForDocument('memorandum_articles_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (tradeLicence == false) {
                return false;
            }
        }

        if ($('#item_to_be_packed_container_for_wmregistration').is(':visible')) {
            var proofOfOwnership = checkValidationForDocument('item_to_be_packed_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (proofOfOwnership == false) {
                return false;
            }
        }
        if ($('#list_of_directors_container_for_wmregistration').is(':visible')) {
            var tradeLicence = checkValidationForDocument('list_of_directors_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (tradeLicence == false) {
                return false;
            }
        }

        if ($('#code_certificate_container_for_wmregistration').is(':visible')) {
            var proofOfOwnership = checkValidationForDocument('code_certificate_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (proofOfOwnership == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_wmregistration').is(':visible')) {
            var sealandstamp = checkValidationForDocument('seal_and_stamp_for_wmregistration', VALUE_TWO, 'wmregistration');
            if (sealandstamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_wmregistration') : $('#submit_btn_for_wmregistration');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var wmregistrationData = new FormData($('#wmregistration_form')[0]);
        wmregistrationData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        wmregistrationData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        wmregistrationData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'wmregistration/submit_wmregistration',
            data: wmregistrationData,
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
                validationMessageShow('wmregistration', textStatus.statusText);
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
                    validationMessageShow('wmregistration', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Wmregistration.router.navigate('wmregistration', {'trigger': true});
            }
        });
    },

    askForRemove: function (wmregistrationId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!wmregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Wmregistration.listview.removeDocument(\'' + wmregistrationId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (wmregistrationId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!wmregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_wmregistration_' + docType).hide();
        $('.spinner_name_container_for_wmregistration_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'wmregistration/remove_document',
            data: $.extend({}, {'wmregistration_id': wmregistrationId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_wmregistration_' + docType).hide();
                $('.spinner_name_container_for_wmregistration_' + docType).show();
                validationMessageShow('wmregistration', textStatus.statusText);
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
                    validationMessageShow('wmregistration', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_wmregistration_' + docType).show();
                $('.spinner_name_container_for_wmregistration_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('trade_licence_name_container_for_wmregistration', 'trade_licence_name_image_for_wmregistration', 'trade_licence_container_for_wmregistration', 'trade_licence_for_wmregistration');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('proof_of_ownership_name_container_for_wmregistration', 'proof_of_ownership_name_image_for_wmregistration', 'proof_of_ownership_container_for_wmregistration', 'proof_of_ownership_for_wmregistration');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('gst_certificate_name_container_for_wmregistration', 'gst_certificate_name_image_for_wmregistration', 'gst_certificate_container_for_wmregistration', 'gst_certificate_for_wmregistration');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('partnership_deed_name_container_for_wmregistration', 'partnership_deed_name_image_for_wmregistration', 'partnership_deed_container_for_wmregistration', 'partnership_deed_for_wmregistration');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('memorandum_articles_name_container_for_wmregistration', 'memorandum_articles_name_image_for_wmregistration', 'memorandum_articles_container_for_wmregistration', 'memorandum_articles_for_wmregistration');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('item_to_be_packed_name_container_for_wmregistration', 'item_to_be_packed_name_image_for_wmregistration', 'item_to_be_packed_container_for_wmregistration', 'item_to_be_packed_for_wmregistration');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('list_of_directors_name_container_for_wmregistration', 'list_of_directors_name_image_for_wmregistration', 'list_of_directors_container_for_wmregistration', 'list_of_directors_for_wmregistration');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('code_certificate_name_container_for_wmregistration', 'code_certificate_name_image_for_wmregistration', 'code_certificate_container_for_wmregistration', 'code_certificate_for_wmregistration');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_wmregistration', 'seal_and_stamp_name_image_for_wmregistration', 'seal_and_stamp_container_for_wmregistration', 'seal_and_stamp_for_wmregistration');
                }
            }
        });
    },
    addMultipleProprietor: function (templateData) {
        templateData.per_cnt = tempPersonCnt;
        $('#proprietor_info_container').append(wmregistrationProprietorInfoTemplate(templateData));
        tempPersonCnt++;
        resetCounter('display-cnt');
    },
    removeProprietorInfo: function (perCnt) {
        $('#proprietor_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm1: function (wmregistrationId) {
        if (!wmregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#wmregistration_id_for_wmregistration_form1').val(wmregistrationId);
        $('#wmregistration_form1_pdf_form').submit();
        $('#wmregistration_id_for_wmregistration_form1').val('');
    },

    downloadUploadChallan: function (wmregistrationId) {
        if (!wmregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + wmregistrationId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'wmregistration/get_wmregistration_data_by_wmregistration_id',
            type: 'post',
            data: $.extend({}, {'wmregistration_id': wmregistrationId}, getTokenData()),
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
                var wmregistrationData = parseData.wmregistration_data;
                that.showChallan(wmregistrationData);
            }
        });
    },
    showChallan: function (wmregistrationData) {
        showPopup();
        if (wmregistrationData.status != VALUE_FIVE && wmregistrationData.status != VALUE_SIX && wmregistrationData.status != VALUE_SEVEN) {
            if (!wmregistrationData.hide_submit_btn) {
                wmregistrationData.show_fees_paid = true;
            }
        }
        if (wmregistrationData.payment_type == VALUE_ONE) {
            wmregistrationData.utitle = 'Fees Paid Challan Copy';
        } else {
            wmregistrationData.style = 'display: none;';
        }
        if (wmregistrationData.payment_type == VALUE_TWO) {
            wmregistrationData.show_dd_po_option = true;
            wmregistrationData.utitle = 'Demand Draft (DD)';
        }
        wmregistrationData.module_type = VALUE_ONE;
        $('#popup_container').html(wmregistrationUploadChallanTemplate(wmregistrationData));
        loadFB(VALUE_ONE, wmregistrationData.fb_data);
        loadPH(VALUE_ONE, wmregistrationData.wmregistration_id, wmregistrationData.ph_data);

        if (wmregistrationData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'wmregistration_upload_challan', wmregistrationData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'wmregistration_upload_challan', 'uc', 'radio');
            if (wmregistrationData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_wmregistration_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (wmregistrationData.challan != '') {
            $('#challan_container_for_wmregistration_upload_challan').hide();
            $('#challan_name_container_for_wmregistration_upload_challan').show();
            $('#challan_name_href_for_wmregistration_upload_challan').attr('href', 'documents/wmregistration/' + wmregistrationData.challan);
            $('#challan_name_for_wmregistration_upload_challan').html(wmregistrationData.challan);
        }
        if (wmregistrationData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_wmregistration_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_wmregistration_upload_challan').show();
            $('#fees_paid_challan_name_href_for_wmregistration_upload_challan').attr('href', 'documents/wmregistration/' + wmregistrationData.fees_paid_challan);
            $('#fees_paid_challan_name_for_wmregistration_upload_challan').html(wmregistrationData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_wmregistration_upload_challan').attr('onclick', 'Wmregistration.listview.removeFeesPaidChallan("' + wmregistrationData.wmregistration_id + '")');
        }
    },
    removeFeesPaidChallan: function (wmregistrationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!wmregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'wmregistration/remove_fees_paid_challan',
            data: $.extend({}, {'wmregistration_id': wmregistrationId}, getTokenData()),
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
                validationMessageShow('wmregistration-uc', textStatus.statusText);
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
                    validationMessageShow('wmregistration-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-wmregistration-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'wmregistration_upload_challan');
                $('#status_' + wmregistrationId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-wmregistration-uc').html('');
        validationMessageHide();
        var wmregistrationId = $('#wmregistration_id_for_wmregistration_upload_challan').val();
        if (!wmregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_wmregistration_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_wmregistration_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_wmregistration_upload_challan').focus();
                validationMessageShow('wmregistration-uc-fees_paid_challan_for_wmregistration_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_wmregistration_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_wmregistration_upload_challan').focus();
                validationMessageShow('wmregistration-uc-fees_paid_challan_for_wmregistration_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_wmregistration_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#wmregistration_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'wmregistration/upload_fees_paid_challan',
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
                validationMessageShow('wmregistration-uc', textStatus.statusText);
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
                    validationMessageShow('wmregistration-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + wmregistrationId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (wmregistrationId) {
        if (!wmregistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#wmregistration_id_for_certificate').val(wmregistrationId);
        $('#wmregistration_certificate_pdf_form').submit();
        $('#wmregistration_id_for_certificate').val('');
    },
    getQueryData: function (wmregistrationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!wmregistrationId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_ONE;
        templateData.module_id = wmregistrationId;
        var btnObj = $('#query_btn_for_wm_' + wmregistrationId);
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
                tmpData.application_number = regNoRenderer(VALUE_ONE, moduleData.wmregistration_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForWmregistration: function (fileNo) {
        var that = this;
        if ($('#trade_licence_for_wmregistration').val() != '') {
            var tradeLicence = checkValidationForDocument('trade_licence_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (tradeLicence == false) {
                return false;
            }
        }
        if ($('#proof_of_ownership_for_wmregistration').val() != '') {
            var proofOfOwnership = checkValidationForDocument('proof_of_ownership_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (proofOfOwnership == false) {
                return false;
            }
        }
        if ($('#gst_certificate_for_wmregistration').val() != '') {
            var gstCertificate = checkValidationForDocument('gst_certificate_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (gstCertificate == false) {
                return false;
            }
        }
        if ($('#partnership_deed_for_wmregistration').val() != '') {
            var partnershipDeed = checkValidationForDocument('partnership_deed_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (partnershipDeed == false) {
                return false;
            }
        }
        if ($('#memorandum_articles_for_wmregistration').val() != '') {
            var memorandumArticles = checkValidationForDocument('memorandum_articles_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (memorandumArticles == false) {
                return false;
            }
        }
        if ($('#item_to_be_packed_for_wmregistration').val() != '') {
            var itemToBePacked = checkValidationForDocument('item_to_be_packed_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (itemToBePacked == false) {
                return false;
            }
        }
        if ($('#list_of_directors_for_wmregistration').val() != '') {
            var listOfDirectors = checkValidationForDocument('list_of_directors_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (listOfDirectors == false) {
                return false;
            }
        }
        if ($('#code_certificate_for_wmregistration').val() != '') {
            var codeCertificate = checkValidationForDocument('code_certificate_for_wmregistration', VALUE_ONE, 'wmregistration');
            if (codeCertificate == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_wmregistration').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_wmregistration', VALUE_TWO, 'wmregistration');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_wmregistration_' + fileNo).hide();
        $('.spinner_name_container_for_wmregistration_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var wmregistrationId = $('#wmregistration_id').val();
        var formData = new FormData($('#wmregistration_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("wmregistration_id", wmregistrationId);
        $.ajax({
            type: 'POST',
            url: 'wmregistration/upload_wmregistration_document',
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
                $('.spinner_container_for_wmregistration_' + fileNo).show();
                $('.spinner_name_container_for_wmregistration_' + fileNo).hide();
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
                    $('.spinner_container_for_wmregistration_' + fileNo).show();
                    $('.spinner_name_container_for_wmregistration_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_wmregistration_' + fileNo).hide();
                $('.spinner_name_container_for_wmregistration_' + fileNo).show();
                $('#wmregistration_id').val(parseData.wmregistration_id);
                var wmregistrationData = parseData.wmregistration_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('trade_licence_container_for_wmregistration', 'trade_licence_name_image_for_wmregistration', 'trade_licence_name_container_for_wmregistration',
                            'trade_licence_download', 'trade_licence', wmregistrationData.trade_licence, parseData.wmregistration_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('proof_of_ownership_container_for_wmregistration', 'proof_of_ownership_name_image_for_wmregistration', 'proof_of_ownership_name_container_for_wmregistration',
                            'proof_of_ownership_download', 'proof_of_ownership', wmregistrationData.proof_of_ownership, parseData.wmregistration_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('gst_certificate_container_for_wmregistration', 'gst_certificate_name_image_for_wmregistration', 'gst_certificate_name_container_for_wmregistration',
                            'gst_certificate_download', 'gst_certificate', wmregistrationData.gst_certificate, parseData.wmregistration_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('partnership_deed_container_for_wmregistration', 'partnership_deed_name_image_for_wmregistration', 'partnership_deed_name_container_for_wmregistration',
                            'partnership_deed_download', 'partnership_deed', wmregistrationData.partnership_deed, parseData.wmregistration_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('memorandum_articles_container_for_wmregistration', 'memorandum_articles_name_image_for_wmregistration', 'memorandum_articles_name_container_for_wmregistration',
                            'memorandum_articles_download', 'memorandum_articles', wmregistrationData.memorandum_articles, parseData.wmregistration_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('item_to_be_packed_container_for_wmregistration', 'item_to_be_packed_name_image_for_wmregistration', 'item_to_be_packed_name_container_for_wmregistration',
                            'item_to_be_packed_download', 'item_to_be_packed', wmregistrationData.item_to_be_packed, parseData.wmregistration_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('list_of_directors_container_for_wmregistration', 'list_of_directors_name_image_for_wmregistration', 'list_of_directors_name_container_for_wmregistration',
                            'list_of_directors_download', 'list_of_directors', wmregistrationData.list_of_directors, parseData.wmregistration_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('code_certificate_container_for_wmregistration', 'code_certificate_name_image_for_wmregistration', 'code_certificate_name_container_for_wmregistration',
                            'code_certificate_download', 'code_certificate', wmregistrationData.code_certificate, parseData.wmregistration_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('seal_and_stamp_container_for_wmregistration', 'seal_and_stamp_name_image_for_wmregistration', 'seal_and_stamp_name_container_for_wmregistration',
                            'seal_and_stamp_download', 'seal_and_stamp', wmregistrationData.signature, parseData.wmregistration_id, VALUE_NINE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/wmregistration/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/wmregistration/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Wmregistration.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});