var siteListTemplate = Handlebars.compile($('#site_list_template').html());
var siteTableTemplate = Handlebars.compile($('#site_table_template').html());
var siteActionTemplate = Handlebars.compile($('#site_action_template').html());
var siteFormTemplate = Handlebars.compile($('#site_form_template').html());
var siteViewTemplate = Handlebars.compile($('#site_view_template').html());
var siteUploadChallanTemplate = Handlebars.compile($('#site_upload_challan_template').html());
var tempPersonCnt = 1;

var Site = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

Site.Router = Backbone.Router.extend({
    routes: {
        'site': 'renderList',
        'site_form': 'renderListForForm',
        'edit_site_form': 'renderList',
        'view_site_form': 'renderList',
    },
    renderList: function () {
        Site.listview.listPage();
    },
    renderListForForm: function () {
        Site.listview.listPageSiteForm();
    }
});
Site.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        // activeLink('menu_dic_dnh');
        addClass('site', 'active');
        Site.router.navigate('site');
        var templateData = {};
        this.$el.html(siteListTemplate(templateData));
        this.loadSiteData(sDistrict, sStatus);

    },
    listPageSiteForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        // addClass('site', 'active');
        this.$el.html(siteListTemplate);
        this.newSiteForm(false, {});
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
                rowData.ADMIN_SITE_DOC_PATH = ADMIN_SITE_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return siteActionTemplate(rowData);
    },
    loadSiteData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTYNINE, data);
        };
        var that = this;
        Site.router.navigate('site');
        $('#site_form_and_datatable_container').html(siteTableTemplate(searchData));
        siteDataTable = $('#site_datatable').DataTable({
            ajax: {url: 'site/get_site_data', dataSrc: "site_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'site_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'address', 'class': 'text-center'},
                {data: 'mobile_no', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'site_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'site_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#site_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = siteDataTable.row(tr);

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
    newSiteForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.site_data;
            Site.router.navigate('edit_site_form');
        } else {
            var formData = {};
            Site.router.navigate('site_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.site_data = parseData.site_data;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;

        if (isEdit) {

            templateData.application_date = dateTo_DD_MM_YYYY(templateData.site_data.application_date);
        } else {
            templateData.application_date = dateTo_DD_MM_YYYY();
        }

        $('#site_form_and_datatable_container').html(siteFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        if (isEdit) {

            $('#district').val(formData.district);
            $('#plot_area').val(formData.plot_area);
            that.getFees(plot_area);

            if (formData.site_plan != '') {
                that.showDocument('site_plan_container_for_site', 'site_plan_name_image_for_site', 'site_plan_name_container_for_site',
                        'site_plan_download', 'site_plan', formData.site_plan, formData.site_id, VALUE_ONE);
            }
            if (formData.I_XIV_nakal != '') {
                that.showDocument('I_XIV_nakal_container_for_site', 'I_XIV_nakal_name_image_for_site', 'I_XIV_nakal_name_container_for_site',
                        'I_XIV_nakal_download', 'I_XIV_nakal', formData.I_XIV_nakal, formData.site_id, VALUE_TWO);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_site', 'seal_and_stamp_name_image_for_site', 'seal_and_stamp_name_container_for_site',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.site_id, VALUE_THREE);
            }

        }
        generateSelect2();
        datePicker();
        $('#site_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitSite($('#submit_btn_for_site'));
            }
        });
    },
    editOrViewSite: function (btnObj, siteId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!siteId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'site/get_site_data_by_id',
            type: 'post',
            data: $.extend({}, {'site_id': siteId}, getTokenData()),
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
                    that.newSiteForm(isEdit, parseData);
                } else {
                    that.viewSiteForm(parseData);
                }
            }
        });
    },
    viewSiteForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.site_data;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        Site.router.navigate('view_site_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        formData.application_date = dateTo_DD_MM_YYYY(formData.application_date);

        $('#site_form_and_datatable_container').html(siteViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');

        $('#district').val(formData.district);
        $('#plot_area').val(formData.plot_area);
        that.getFees(plot_area);

        if (formData.site_plan != '') {
            that.showDocument('site_plan_container_for_site', 'site_plan_name_image_for_site', 'site_plan_name_container_for_site',
                    'site_plan_download', 'site_plan', formData.site_plan);
        }
        if (formData.I_XIV_nakal != '') {
            that.showDocument('I_XIV_nakal_container_for_site', 'I_XIV_nakal_name_image_for_site', 'I_XIV_nakal_name_container_for_site',
                    'I_XIV_nakal_download', 'I_XIV_nakal', formData.I_XIV_nakal);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_site', 'seal_and_stamp_name_image_for_site', 'seal_and_stamp_name_container_for_site',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }

    },
    checkValidationForSite: function (siteData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!siteData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!siteData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!siteData.address) {
            return getBasicMessageAndFieldJSONArray('address', owneraddressMessage);
        }
        if (!siteData.mobile_no) {
            return getBasicMessageAndFieldJSONArray('mobile_no', mobileValidationMessage);
        }
        if (!siteData.village) {
            return getBasicMessageAndFieldJSONArray('village', villageValidationMessage);
        }
        if (!siteData.plot_area) {
            return getBasicMessageAndFieldJSONArray('plot_area', plotAreaValidationMessage);
        }
        return '';
    },
    askForSubmitSite: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Site.listview.submitSite(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitSite: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var siteData = $('#site_form').serializeFormJSON();
        var validationData = that.checkValidationForSite(siteData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('site-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#site_plan_container_for_site').is(':visible')) {
            var sitePlan = checkValidationForDocument('site_plan_for_site', VALUE_ONE, 'site');
            if (sitePlan == false) {
                return false;
            }
        }

        if ($('#I_XIV_nakal_container_for_site').is(':visible')) {
            var IXIVnakal = checkValidationForDocument('I_XIV_nakal_for_site', VALUE_ONE, 'site');
            if (IXIVnakal == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_site').is(':visible')) {
            var sealandstamp = checkValidationForDocument('seal_and_stamp_for_site', VALUE_TWO, 'site');
            if (sealandstamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_site') : $('#submit_btn_for_site');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var siteData = new FormData($('#site_form')[0]);
        siteData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        // siteData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        siteData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'site/submit_site',
            data: siteData,
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
                validationMessageShow('site', textStatus.statusText);
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
                    validationMessageShow('site', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Site.router.navigate('site', {'trigger': true});
            }
        });
    },

    askForRemove: function (siteId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!siteId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Site.listview.removeDocument(\'' + siteId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (siteId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!siteId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_site_' + docType).hide();
        $('.spinner_name_container_for_site_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'site/remove_document',
            data: $.extend({}, {'site_id': siteId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_site_' + docType).hide();
                $('.spinner_name_container_for_site_' + docType).show();
                validationMessageShow('site', textStatus.statusText);
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
                    validationMessageShow('site', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_site_' + docType).show();
                $('.spinner_name_container_for_site_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('site_plan_name_container_for_site', 'site_plan_name_image_for_site', 'site_plan_container_for_site', 'site_plan_for_site');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('I_XIV_nakal_name_container_for_site', 'I_XIV_nakal_name_image_for_site', 'I_XIV_nakal_container_for_site', 'I_XIV_nakal_for_site');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_site', 'seal_and_stamp_name_image_for_site', 'seal_and_stamp_container_for_site', 'seal_and_stamp_for_site');
                }
            }
        });
    },
    generateForm1: function (siteId) {
        if (!siteId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#site_id_for_site_form1').val(siteId);
        $('#site_form1_pdf_form').submit();
        $('#site_id_for_site_form1').val('');
    },

    downloadUploadChallan: function (siteId) {
        if (!siteId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + siteId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'site/get_site_data_by_site_id',
            type: 'post',
            data: $.extend({}, {'site_id': siteId}, getTokenData()),
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
                var siteData = parseData.site_data;
                that.showChallan(siteData);
            }
        });
    },
    showChallan: function (siteData) {
        showPopup();
        if (siteData.status != VALUE_FIVE && siteData.status != VALUE_SIX && siteData.status != VALUE_SEVEN) {
            siteData.show_fees_paid = true;
        }
        if (siteData.payment_type == VALUE_ONE) {
            siteData.utitle = 'Fees Paid Challan Copy';
        } else {
            siteData.style = 'display: none;';
        }
        if (siteData.payment_type == VALUE_TWO) {
            siteData.show_dd_po_option = true;
            siteData.utitle = 'Demand Draft (DD)';
        }
        $('#popup_container').html(siteUploadChallanTemplate(siteData));
        if (siteData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'site_upload_challan', siteData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'site_upload_challan', 'uc', 'radio');
            if (siteData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_site_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (siteData.challan != '') {
            $('#challan_container_for_site_upload_challan').hide();
            $('#challan_name_container_for_site_upload_challan').show();
            $('#challan_name_href_for_site_upload_challan').attr('href', 'documents/site/' + siteData.challan);
            $('#challan_name_for_site_upload_challan').html(siteData.challan);
        }
        if (siteData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_site_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_site_upload_challan').show();
            $('#fees_paid_challan_name_href_for_site_upload_challan').attr('href', 'documents/site/' + siteData.fees_paid_challan);
            $('#fees_paid_challan_name_for_site_upload_challan').html(siteData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_site_upload_challan').attr('onclick', 'Site.listview.removeFeesPaidChallan("' + siteData.site_id + '")');
        }
    },
    removeFeesPaidChallan: function (siteId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!siteId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'site/remove_fees_paid_challan',
            data: $.extend({}, {'site_id': siteId}, getTokenData()),
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
                validationMessageShow('site-uc', textStatus.statusText);
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
                    validationMessageShow('site-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-site-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'site_upload_challan');
                $('#status_' + siteId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-site-uc').html('');
        validationMessageHide();
        var siteId = $('#site_id_for_site_upload_challan').val();
        if (!siteId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_site_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_site_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_site_upload_challan').focus();
                validationMessageShow('site-uc-fees_paid_challan_for_site_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_site_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_site_upload_challan').focus();
                validationMessageShow('site-uc-fees_paid_challan_for_site_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_site_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#site_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'site/upload_fees_paid_challan',
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
                validationMessageShow('site-uc', textStatus.statusText);
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
                    validationMessageShow('site-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + siteId).html(appStatusArray[parseData.status]);
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (siteId) {
        if (!siteId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#site_id_for_certificate').val(siteId);
        $('#site_certificate_pdf_form').submit();
        $('#site_id_for_certificate').val('');
    },
    getQueryData: function (siteId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!siteId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTYNINE;
        templateData.module_id = siteId;
        var btnObj = $('#query_btn_for_site_' + siteId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTYNINE, moduleData.site_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getFees: function (category) {
        $("#fees").prop("readonly", true);
        var ploatareaFees = category.value;
        if (ploatareaFees == '') {
            return false;
        }

        if (ploatareaFees == '500sqm') {
            $('#fees').val('Rs. 500');
            $('.site').show();
            $('.homestay').hide();
        } else if (ploatareaFees == '501to1000sqm') {
            $('#fees').val('Rs. 1000');
            $('.site').show();
            $('.homestay').hide();
        } else if (ploatareaFees == 'above1000') {
            $('#fees').val('Rs. 2000');
            $('.site').show();
            $('.homestay').hide();
        }

    },
    uploadDocumentForSite: function (fileNo) {
        var that = this;
        if ($('#site_plan_for_site').val() != '') {
            var copyOfRegistration = checkValidationForDocument('site_plan_for_site', VALUE_ONE, 'site');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#I_XIV_nakal_for_site').val() != '') {
            var copyOfRegistration = checkValidationForDocument('I_XIV_nakal_for_site', VALUE_ONE, 'site');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_site').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_site', VALUE_TWO, 'site');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_site_' + fileNo).hide();
        $('.spinner_name_container_for_site_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var siteId = $('#site_id').val();
        var formData = new FormData($('#site_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("site_id", siteId);
        $.ajax({
            type: 'POST',
            url: 'site/upload_site_document',
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
                $('.spinner_container_for_site_' + fileNo).show();
                $('.spinner_name_container_for_site_' + fileNo).hide();
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
                    $('.spinner_container_for_site_' + fileNo).show();
                    $('.spinner_name_container_for_site_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_site_' + fileNo).hide();
                $('.spinner_name_container_for_site_' + fileNo).show();
                $('#site_id').val(parseData.site_id);
                var siteData = parseData.site_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('site_plan_container_for_site', 'site_plan_name_image_for_site', 'site_plan_name_container_for_site',
                            'site_plan_download', 'site_plan', siteData.site_plan, parseData.site_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('I_XIV_nakal_container_for_site', 'I_XIV_nakal_name_image_for_site', 'I_XIV_nakal_name_container_for_site',
                            'I_XIV_nakal_download', 'I_XIV_nakal', siteData.I_XIV_nakal, parseData.site_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('seal_and_stamp_container_for_site', 'seal_and_stamp_name_image_for_site', 'seal_and_stamp_name_container_for_site',
                            'seal_and_stamp_download', 'seal_and_stamp', siteData.signature, parseData.site_id, VALUE_THREE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/site/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/site/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Site.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});

