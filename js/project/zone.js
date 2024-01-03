var zoneListTemplate = Handlebars.compile($('#zone_list_template').html());
var zoneTableTemplate = Handlebars.compile($('#zone_table_template').html());
var zoneActionTemplate = Handlebars.compile($('#zone_action_template').html());
var zoneFormTemplate = Handlebars.compile($('#zone_form_template').html());
var zoneViewTemplate = Handlebars.compile($('#zone_view_template').html());
var tempPersonCnt = 1;

var Zone = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

Zone.Router = Backbone.Router.extend({
    routes: {
        'zone': 'renderList',
        'zone_form': 'renderListForForm',
        'edit_zone_form': 'renderList',
        'view_zone_form': 'renderList',
    },
    renderList: function () {
        Zone.listview.listPage();
    },
    renderListForForm: function () {
        Zone.listview.listPageZoneForm();
    }
});
Zone.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        // activeLink('menu_dic_dnh');
        addClass('zone', 'active');
        Zone.router.navigate('zone');
        var templateData = {};
        this.$el.html(zoneListTemplate(templateData));
        this.loadZoneData();

    },
    listPageZoneForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        //addClass('zone', 'active');
        this.$el.html(zoneListTemplate);
        this.newZoneForm(false, {});
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
                rowData.ADMIN_ZONE_DOC_PATH = ADMIN_ZONE_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return zoneActionTemplate(rowData);
    },
    loadZoneData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var dateRendere = function (data, type, full, meta) {
            return dateTo_DD_MM_YYYY(full.created_time);
        };
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTY, data);
        };
        var that = this;
        Zone.router.navigate('zone');
        $('#zone_form_and_datatable_container').html(zoneTableTemplate);
        zoneDataTable = $('#zone_datatable').DataTable({
            ajax: {url: 'zone/get_zone_data', dataSrc: "zone_data", type: "post", data: getTokenData()},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'zone_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'address', 'class': 'text-center'},
                {data: 'mobile_no', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'zone_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'zone_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#zone_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = zoneDataTable.row(tr);

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
    newZoneForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.zone_data;
            Zone.router.navigate('edit_zone_form');
        } else {
            var formData = {};
            Zone.router.navigate('zone_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.zone_data = parseData.zone_data;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;



        if (isEdit) {
            templateData.application_date = dateTo_DD_MM_YYYY(templateData.zone_data.application_date);
        } else {
            templateData.application_date = dateTo_DD_MM_YYYY();
        }

        $('#zone_form_and_datatable_container').html(zoneFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        if (isEdit) {

            $('#district').val(formData.district);

            if (formData.site_plan != '') {
                that.showDocument('site_plan_container_for_zone', 'site_plan_name_image_for_zone', 'site_plan_name_container_for_zone',
                        'site_plan_download', 'site_plan', formData.site_plan, formData.zone_id, VALUE_ONE);
            }
            if (formData.I_XIV_nakal != '') {
                that.showDocument('I_XIV_nakal_container_for_zone', 'I_XIV_nakal_name_image_for_zone', 'I_XIV_nakal_name_container_for_zone',
                        'I_XIV_nakal_download', 'I_XIV_nakal', formData.I_XIV_nakal, formData.zone_id, VALUE_TWO);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_zone', 'seal_and_stamp_name_image_for_zone', 'seal_and_stamp_name_container_for_zone',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.zone_id, VALUE_THREE);
            }



        }
        generateSelect2();
        datePicker();
        $('#zone_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitZone($('#submit_btn_for_zone'));
            }
        });
    },
    editOrViewZone: function (btnObj, zoneId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!zoneId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'zone/get_zone_data_by_id',
            type: 'post',
            data: $.extend({}, {'zone_id': zoneId}, getTokenData()),
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
                    that.newZoneForm(isEdit, parseData);
                } else {
                    that.viewZoneForm(parseData);
                }
            }
        });
    },
    viewZoneForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.zone_data;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        Zone.router.navigate('view_zone_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        formData.application_date = dateTo_DD_MM_YYYY(formData.application_date);

        $('#zone_form_and_datatable_container').html(zoneViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        $('#district').val(formData.district);

        if (formData.site_plan != '') {
            that.showDocument('site_plan_container_for_zone', 'site_plan_name_image_for_zone', 'site_plan_name_container_for_zone',
                    'site_plan_download', 'site_plan', formData.site_plan);
        }
        if (formData.I_XIV_nakal != '') {
            that.showDocument('I_XIV_nakal_container_for_zone', 'I_XIV_nakal_name_image_for_zone', 'I_XIV_nakal_name_container_for_zone',
                    'I_XIV_nakal_download', 'I_XIV_nakal', formData.I_XIV_nakal);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_zone', 'seal_and_stamp_name_image_for_zone', 'seal_and_stamp_name_container_for_zone',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }
    },
    checkValidationForZone: function (zoneData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!zoneData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!zoneData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!zoneData.address) {
            return getBasicMessageAndFieldJSONArray('address', owneraddressMessage);
        }
        if (!zoneData.mobile_no) {
            return getBasicMessageAndFieldJSONArray('mobile_no', mobileValidationMessage);
        }
        if (!zoneData.village) {
            return getBasicMessageAndFieldJSONArray('village', villageValidationMessage);
        }

        return '';
    },
    askForSubmitZone: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Zone.listview.submitZone(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitZone: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var zoneData = $('#zone_form').serializeFormJSON();
        var validationData = that.checkValidationForZone(zoneData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('zone-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#site_plan_container_for_zone').is(':visible')) {
            var zonePlan = checkValidationForDocument('site_plan_for_zone', VALUE_ONE, 'zone');
            if (zonePlan == false) {
                return false;
            }
        }

        if ($('#I_XIV_nakal_container_for_zone').is(':visible')) {
            var IXIVnakal = checkValidationForDocument('I_XIV_nakal_for_zone', VALUE_ONE, 'zone');
            if (IXIVnakal == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_zone').is(':visible')) {
            var sealandstamp = checkValidationForDocument('seal_and_stamp_for_zone', VALUE_TWO, 'zone');
            if (sealandstamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_zone') : $('#submit_btn_for_zone');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var zoneData = new FormData($('#zone_form')[0]);
        zoneData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        // zoneData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        zoneData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'zone/submit_zone',
            data: zoneData,
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
                validationMessageShow('zone', textStatus.statusText);
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
                    validationMessageShow('zone', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Zone.router.navigate('zone', {'trigger': true});
            }
        });
    },

    askForRemove: function (zoneId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!zoneId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Zone.listview.removeDocument(\'' + zoneId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (zoneId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!zoneId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_zone_' + docType).hide();
        $('.spinner_name_container_for_zone_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'zone/remove_document',
            data: $.extend({}, {'zone_id': zoneId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_zone_' + docType).hide();
                $('.spinner_name_container_for_zone_' + docType).show();
                validationMessageShow('zone', textStatus.statusText);
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
                    validationMessageShow('zone', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_zone_' + docType).show();
                $('.spinner_name_container_for_zone_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('site_plan_name_container_for_zone', 'site_plan_name_image_for_zone', 'site_plan_container_for_zone', 'site_plan_for_zone');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('I_XIV_nakal_name_container_for_zone', 'I_XIV_nakal_name_image_for_zone', 'I_XIV_nakal_container_for_zone', 'I_XIV_nakal_for_zone');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_zone', 'seal_and_stamp_name_image_for_zone', 'seal_and_stamp_container_for_zone', 'seal_and_stamp_for_zone');
                }
            }
        });
    },
    generateForm1: function (zoneId) {
        if (!zoneId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#zone_id_for_zone_form1').val(zoneId);
        $('#zone_form1_pdf_form').submit();
        $('#zone_id_for_zone_form1').val('');
    },

    downloadUploadChallan: function (zoneId) {
        if (!zoneId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + zoneId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'zone/get_zone_data_by_zone_id',
            type: 'post',
            data: $.extend({}, {'zone_id': zoneId}, getTokenData()),
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
                var zoneData = parseData.zone_data;
                that.showChallan(zoneData);
            }
        });
    },
    showChallan: function (zoneData) {
        showPopup();
        if (zoneData.status != VALUE_FIVE && zoneData.status != VALUE_SIX && zoneData.status != VALUE_SEVEN) {
            zoneData.show_fees_paid = true;
        }
        if (zoneData.payment_type == VALUE_ONE) {
            zoneData.utitle = 'Fees Paid Challan Copy';
        } else {
            zoneData.style = 'display: none;';
        }
        if (zoneData.payment_type == VALUE_TWO) {
            zoneData.show_dd_po_option = true;
            zoneData.utitle = 'Demand Draft (DD)';
        }
        $('#popup_container').html(zoneUploadChallanTemplate(zoneData));
        if (zoneData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'zone_upload_challan', zoneData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'zone_upload_challan', 'uc', 'radio');
            if (zoneData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_zone_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (zoneData.challan != '') {
            $('#challan_container_for_zone_upload_challan').hide();
            $('#challan_name_container_for_zone_upload_challan').show();
            $('#challan_name_href_for_zone_upload_challan').attr('href', 'documents/zone/' + zoneData.challan);
            $('#challan_name_for_zone_upload_challan').html(zoneData.challan);
        }
        if (zoneData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_zone_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_zone_upload_challan').show();
            $('#fees_paid_challan_name_href_for_zone_upload_challan').attr('href', 'documents/zone/' + zoneData.fees_paid_challan);
            $('#fees_paid_challan_name_for_zone_upload_challan').html(zoneData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_zone_upload_challan').attr('onclick', 'Zone.listview.removeFeesPaidChallan("' + zoneData.zone_id + '")');
        }
    },
    removeFeesPaidChallan: function (zoneId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!zoneId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'zone/remove_fees_paid_challan',
            data: $.extend({}, {'zone_id': zoneId}, getTokenData()),
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
                validationMessageShow('zone-uc', textStatus.statusText);
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
                    validationMessageShow('zone-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-zone-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'zone_upload_challan');
                $('#status_' + zoneId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-zone-uc').html('');
        validationMessageHide();
        var zoneId = $('#zone_id_for_zone_upload_challan').val();
        if (!zoneId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_zone_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_zone_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_zone_upload_challan').focus();
                validationMessageShow('zone-uc-fees_paid_challan_for_zone_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_zone_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_zone_upload_challan').focus();
                validationMessageShow('zone-uc-fees_paid_challan_for_zone_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_zone_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#zone_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'zone/upload_fees_paid_challan',
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
                validationMessageShow('zone-uc', textStatus.statusText);
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
                    validationMessageShow('zone-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + zoneId).html(appStatusArray[parseData.status]);
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (zoneId) {
        if (!zoneId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#zone_id_for_certificate').val(zoneId);
        $('#zone_certificate_pdf_form').submit();
        $('#zone_id_for_certificate').val('');
    },
    getQueryData: function (zoneId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!zoneId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THIRTY;
        templateData.module_id = zoneId;
        var btnObj = $('#query_btn_for_zone_' + zoneId);
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
                tmpData.application_number = regNoRenderer(VALUE_THIRTY, moduleData.zone_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForZone: function (fileNo) {
        var that = this;
        if ($('#site_plan_for_zone').val() != '') {
            var copyOfRegistration = checkValidationForDocument('site_plan_for_zone', VALUE_ONE, 'zone');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#I_XIV_nakal_for_zone').val() != '') {
            var copyOfRegistration = checkValidationForDocument('I_XIV_nakal_for_zone', VALUE_ONE, 'zone');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_zone').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_zone', VALUE_TWO, 'zone');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_zone_' + fileNo).hide();
        $('.spinner_name_container_for_zone_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var zoneId = $('#zone_id').val();
        var formData = new FormData($('#zone_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("zone_id", zoneId);
        $.ajax({
            type: 'POST',
            url: 'zone/upload_zone_document',
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
                $('.spinner_container_for_zone_' + fileNo).show();
                $('.spinner_name_container_for_zone_' + fileNo).hide();
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
                    $('.spinner_container_for_zone_' + fileNo).show();
                    $('.spinner_name_container_for_zone_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_zone_' + fileNo).hide();
                $('.spinner_name_container_for_zone_' + fileNo).show();
                $('#zone_id').val(parseData.zone_id);
                var zoneData = parseData.zone_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('site_plan_container_for_zone', 'site_plan_name_image_for_zone', 'site_plan_name_container_for_zone',
                            'site_plan_download', 'site_plan', zoneData.site_plan, parseData.zone_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('I_XIV_nakal_container_for_zone', 'I_XIV_nakal_name_image_for_zone', 'I_XIV_nakal_name_container_for_zone',
                            'I_XIV_nakal_download', 'I_XIV_nakal', zoneData.I_XIV_nakal, parseData.zone_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('seal_and_stamp_container_for_zone', 'seal_and_stamp_name_image_for_zone', 'seal_and_stamp_name_container_for_zone',
                            'seal_and_stamp_download', 'seal_and_stamp', zoneData.signature, parseData.zone_id, VALUE_THREE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/zone/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/zone/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Zone.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});

