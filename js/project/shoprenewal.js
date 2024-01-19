var shopRenewalListTemplate = Handlebars.compile($('#shop_renewal_list_template').html());
var shopRenewalTableTemplate = Handlebars.compile($('#shop_renewal_table_template').html());
var shopRenewalActionTemplate = Handlebars.compile($('#shop_renewal_action_template').html());
var shopRenewalFormTemplate = Handlebars.compile($('#shop_renewal_form_template').html());
var shopRenewalViewTemplate = Handlebars.compile($('#shop_renewal_view_template').html());
var shopRenewalUploadChallanTemplate = Handlebars.compile($('#shop_renewal_upload_challan_template').html());

var tempPersonCnt = 1;

var ShopRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
ShopRenewal.Router = Backbone.Router.extend({
    routes: {
        'shop_renewal': 'renderList',
        'shop_renewal_form': 'renderListForForm',
        'edit_shop_renewal_form': 'renderList',
        'view_shop_renewal_form': 'renderList',
    },
    renderList: function () {
        ShopRenewal.listview.listPage();
    },
    renderListForForm: function () {
        ShopRenewal.listview.listPageShopRenewalForm();
    }
});
ShopRenewal.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('shoprenewal', 'active');
        ShopRenewal.router.navigate('shop_renewal');
        var templateData = {};
        this.$el.html(shopRenewalListTemplate(templateData));
        this.loadShopRenewalData(sDistrict, sStatus);

    },
    listPageShopRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('shoprenewal', 'active');
        this.$el.html(shopRenewalListTemplate);
        this.newShopRenewalForm(false, {});
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
                rowData.ADMIN_SHOP_DOC_PATH = ADMIN_SHOP_DOC_PATH;
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
        return shopRenewalActionTemplate(rowData);
    },
    loadShopRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTYTWO, data)
                    + getFRContainer(VALUE_FOURTYTWO, data, full.rating, full.fr_datetime);
        };
        var that = this;
        ShopRenewal.router.navigate('shop_renewal');
        $('#shop_renewal_form_and_datatable_container').html(shopRenewalTableTemplate(searchData));
        shopRenewalDataTable = $('#shop_renewal_datatable').DataTable({
            ajax: {url: 'shop_renewal/get_shop_renewal_data', dataSrc: "shop_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'shop_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_shop', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'shop_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'shop_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#shop_renewal_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = shopRenewalDataTable.row(tr);

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
    newShopRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.shop_renewal_data;
            ShopRenewal.router.navigate('edit_shop_renewal_form');
        } else {
            var formData = {};
            ShopRenewal.router.navigate('shop_renewal_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.shoprenewal_data = parseData.shop_renewal_data;
        $('#shop_renewal_form_and_datatable_container').html(shopRenewalFormTemplate((templateData)));
        allowOnlyIntegerValue('mobile_no_employer_for_shop');
        allowOnlyIntegerValue('total_employees');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_shoprenewal', 'seal_and_stamp_name_image_for_shoprenewal', 'seal_and_stamp_name_container_for_shoprenewal',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.shop_renewal_id, VALUE_ONE);
            }

        }
        generateSelect2();
        datePicker();
        $('#shop_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitShopRenewal($('#submit_btn_for_shop'));
            }
        });
    },
    editOrViewShopRenewal: function (btnObj, shopRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!shopRenewalId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'shop_renewal/get_shop_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'shop_renewal_id': shopRenewalId}, getTokenData()),
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
                    that.newShopRenewalForm(isEdit, parseData);
                } else {
                    that.viewShopRenewalForm(parseData);
                }
            }
        });
    },
    viewShopRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.shop_renewal_data;
        ShopRenewal.router.navigate('view_shop_renewal_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.last_valid_upto = dateTo_DD_MM_YYYY(formData.last_valid_upto);
        $('#shop_renewal_form_and_datatable_container').html(shopRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_shoprenewal', 'seal_and_stamp_name_image_for_shoprenewal', 'seal_and_stamp_name_container_for_shoprenewal',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.shop_renewal_id, VALUE_ONE);
        }
    },
    checkValidationForShopRenewal: function (shopRenewalData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!shopRenewalData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!shopRenewalData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!shopRenewalData.name_of_shop) {
            return getBasicMessageAndFieldJSONArray('name_of_shop', shopNameValidationMessage);
        }
        if (!shopRenewalData.door_no_for_shop) {
            return getBasicMessageAndFieldJSONArray('door_no_for_shop', shopDoorNoValidationMessage);
        }
        if (!shopRenewalData.street_name_for_shop) {
            return getBasicMessageAndFieldJSONArray('street_name_for_shop', shopStreetNameValidationMessage);
        }
        if (!shopRenewalData.loaction_for_shop) {
            return getBasicMessageAndFieldJSONArray('loaction_for_shop', shopLocationValidationMessage);
        }
        if (!shopRenewalData.total_employees || shopRenewalData.total_employees == '0') {
            $('#total_employees').focus();
            $('html, body').animate({scrollTop: '0px'}, 0);
            return getBasicMessageAndFieldJSONArray('total_employees', totalTotalValidationMessage);
        }
        if (!shopRenewalData.nature_of_business_for_shop) {
            return getBasicMessageAndFieldJSONArray('nature_of_business_for_shop', shopNatureOfBusinessValidationMessage);
        }
        if (!shopRenewalData.name_of_employer_for_shop) {
            return getBasicMessageAndFieldJSONArray('name_of_employer_for_shop', shopEmployerNameValidationMessage);
        }
        if (!shopRenewalData.mobile_no_employer_for_shop) {
            return getBasicMessageAndFieldJSONArray('mobile_no_employer_for_shop', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(shopRenewalData.mobile_no_employer_for_shop);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_no_employer_for_shop', invalidMobileValidationMessage);
        }
        if (!shopRenewalData.residential_address_employer_for_shop) {
            return getBasicMessageAndFieldJSONArray('residential_address_employer_for_shop', shopEmployerResidentialAddressValidationMessage);
        }
        if (!shopRenewalData.manager_name_for_shop) {
            return getBasicMessageAndFieldJSONArray('manager_name_for_shop', shopManagerNameValidationMessage);
        }
        if (!shopRenewalData.residential_address_manager_for_shop) {
            return getBasicMessageAndFieldJSONArray('residential_address_manager_for_shop', shopManagerNameValidationMessage);
        }
        if (!shopRenewalData.category_for_shop) {
            return getBasicMessageAndFieldJSONArray('category_for_shop', shopCategoryValidationMessage);
        }
        return '';
    },
    askForSubmitShopRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'ShopRenewal.listview.submitShopRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitShopRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var shopRenewalData = $('#shop_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForShopRenewal(shopRenewalData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('shoprenewal-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#seal_and_stamp_container_for_shoprenewal').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_shoprenewal', VALUE_TWO, 'shoprenewal');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_shop') : $('#submit_btn_for_shop');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var shopRenewalData = new FormData($('#shop_renewal_form')[0]);
        shopRenewalData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        shopRenewalData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'shop_renewal/submit_shop_renewal',
            data: shopRenewalData,
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
                validationMessageShow('shoprenewal', textStatus.statusText);
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
                    validationMessageShow('shoprenewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                ShopRenewal.router.navigate('shop_renewal', {'trigger': true});
            }
        });
    },

    askForRemove: function (shopRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!shopRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'ShopRenewal.listview.removeDocument(\'' + shopRenewalId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (shopRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!shopRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_shoprenewal_' + docType).hide();
        $('.spinner_name_container_for_shoprenewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'shop_renewal/remove_document',
            data: $.extend({}, {'shop_renewal_id': shopRenewalId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_shoprenewal_' + docType).hide();
                $('.spinner_name_container_for_shoprenewal_' + docType).show();
                validationMessageShow('shoprenewal', textStatus.statusText);
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
                    validationMessageShow('shoprenewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_shoprenewal_' + docType).show();
                $('.spinner_name_container_for_shoprenewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_shoprenewal', 'seal_and_stamp_name_image_for_shoprenewal', 'seal_and_stamp_container_for_shoprenewal', 'seal_and_stamp_for_shoprenewal');
                }

            }
        });
    },
    generateForm: function (shopRenewalId) {
        if (!shopRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#shop_renewal_id_for_shop_renewal_form').val(shopRenewalId);
        $('#shop_renewal_form_pdf_form').submit();
        $('#shop_renewal_id_for_shop_renewal_form').val('');
    },

    downloadUploadChallan: function (shopRenewalId) {
        if (!shopRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + shopRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'shop_renewal/get_shop_renewal_data_by_shop_renewal_id',
            type: 'post',
            data: $.extend({}, {'shop_renewal_id': shopRenewalId}, getTokenData()),
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
                var shopRenewalData = parseData.shop_renewal_data;
                that.showChallan(shopRenewalData);
            }
        });
    },
    showChallan: function (shopRenewalData) {
        showPopup();
        if (shopRenewalData.status != VALUE_FIVE && shopRenewalData.status != VALUE_SIX && shopRenewalData.status != VALUE_SEVEN) {
            if (!shopRenewalData.hide_submit_btn) {
                shopRenewalData.show_fees_paid = true;
            }
        }
        if (shopRenewalData.payment_type == VALUE_ONE) {
            shopRenewalData.utitle = 'Fees Paid Challan Copy';
        } else {
            shopRenewalData.style = 'display: none;';
        }
        if (shopRenewalData.payment_type == VALUE_TWO) {
            shopRenewalData.show_dd_po_option = true;
            shopRenewalData.utitle = 'Demand Draft (DD)';
        }
        shopRenewalData.module_type = VALUE_FOURTYTWO;
        $('#popup_container').html(shopRenewalUploadChallanTemplate(shopRenewalData));
        loadFB(VALUE_FOURTYTWO, shopRenewalData.fb_data);
        loadPH(VALUE_FOURTYTWO, shopRenewalData.shop_renewal_id, shopRenewalData.ph_data);

        if (shopRenewalData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'shop_renewal_upload_challan', shopRenewalData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'shop_renewal_upload_challan', 'uc', 'radio');
            if (shopRenewalData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_shop_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (shopRenewalData.challan != '') {
            $('#challan_container_for_shop_renewal_upload_challan').hide();
            $('#challan_name_container_for_shop_renewal_upload_challan').show();
            $('#challan_name_href_for_shop_renewal_upload_challan').attr('href', 'documents/shop/' + shopRenewalData.challan);
            $('#challan_name_for_shop_renewal_upload_challan').html(shopRenewalData.challan);
        }
        if (shopRenewalData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_shop_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_shop_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_shop_renewal_upload_challan').attr('href', 'documents/shop/' + shopRenewalData.fees_paid_challan);
            $('#fees_paid_challan_name_for_shop_renewal_upload_challan').html(shopRenewalData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_shop_renewal_upload_challan').attr('onclick', 'ShopRenewal.listview.removeFeesPaidChallan("' + shopRenewalData.shop_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (shopRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!shopRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'shop_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'shop_renewal_id': shopRenewalId}, getTokenData()),
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
                validationMessageShow('shop-uc', textStatus.statusText);
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
                    validationMessageShow('shop-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-shop-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'shop_renewal_upload_challan');
                $('#status_' + shopRenewalId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-shop-uc').html('');
        validationMessageHide();
        var shopRenewalId = $('#shop_renewal_id_for_shop_renewal_upload_challan').val();
        if (!shopRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_shop_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_shop_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_shop_renewal_upload_challan').focus();
                validationMessageShow('shop-uc-fees_paid_challan_for_shop_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_shop_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_shop_renewal_upload_challan').focus();
                validationMessageShow('shop-uc-fees_paid_challan_for_shop_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_shop_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#shop_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'shop_renewal/upload_fees_paid_challan',
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
                validationMessageShow('shop-uc', textStatus.statusText);
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
                    validationMessageShow('shop-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + shopRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (shopRenewalId) {
        if (!shopRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#shop_renewal_id_for_certificate').val(shopRenewalId);
        $('#shop_renewal_certificate_pdf_form').submit();
        $('#shop_renewal_id_for_certificate').val('');
    },
    getQueryData: function (shopRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!shopRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTYTWO;
        templateData.module_id = shopRenewalId;
        var btnObj = $('#query_btn_for_wm_' + shopRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOURTYTWO, moduleData.shop_renewal_id);
                tmpData.applicant_name = moduleData.name_of_shop;
                tmpData.title = 'Shop & Establishment Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getShopData: function (btnObj) {
        var license_number = $('#registration_number').val();
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!license_number || license_number == null) {
            showError('Enter Shop & Establishment License Number !');
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'shop_renewal/get_shop_data_by_id',
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
                shopRenewalData = parseData.shop_data;
                if (shopRenewalData == null) {
                    $('#shop_id').val('');
                    $('#name_of_shop').val('');
                    $('#door_no_for_shop').val('');
                    $('#street_name_for_shop').val('');
                    $('#loaction_for_shop').val('');
                    $('#name_of_employer_for_shop').val('');
                    $('#mobile_no_employer_for_shop').val('');
                    $('#residential_address_employer_for_shop').val('');
                    $('#manager_name_for_shop').val('');
                    $('#residential_address_manager_for_shop').val('');
                    $('#category_for_shop').val('');
                    $('#nature_of_business_for_shop').val('');
                    $('html, body').animate({scrollTop: '0px'}, 0);
                }
                if (shopRenewalData) {
                    if (shopRenewalData.shop_renewal_id != null) {
                        $('#shop_id').val(shopRenewalData.shop_id);
                        $('#name_of_shop').val(shopRenewalData.name_of_shop);
                        $('#door_no_for_shop').val(shopRenewalData.door_no);
                        $('#street_name_for_shop').val(shopRenewalData.street_name);
                        $('#loaction_for_shop').val(shopRenewalData.location);
                        $('#name_of_employer_for_shop').val(shopRenewalData.employer_name);
                        $('#mobile_no_employer_for_shop').val(shopRenewalData.employer_mobile_no);
                        $('#residential_address_employer_for_shop').val(shopRenewalData.employer_residential_address);
                        $('#manager_name_for_shop').val(shopRenewalData.manager_name);
                        $('#residential_address_manager_for_shop').val(shopRenewalData.manager_residential_address);
                        $('#category_for_shop').val(shopRenewalData.category);
                        $('#nature_of_business_for_shop').val(shopRenewalData.nature_of_business);
                        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
                        $('#district').val(shopRenewalData.district);

                    } else {
                        $('#shop_id').val(shopRenewalData.s_id);
                        $('#name_of_shop').val(shopRenewalData.s_name);
                        $('#door_no_for_shop').val(shopRenewalData.s_door_no);
                        $('#street_name_for_shop').val(shopRenewalData.s_street_name);
                        $('#loaction_for_shop').val(shopRenewalData.s_location);
                        $('#name_of_employer_for_shop').val(shopRenewalData.s_employer_name);
                        $('#mobile_no_employer_for_shop').val(shopRenewalData.s_employer_mobile_no);
                        $('#residential_address_employer_for_shop').val(shopRenewalData.s_employer_residential_address);
                        $('#manager_name_for_shop').val(shopRenewalData.s_manager_name);
                        $('#residential_address_manager_for_shop').val(shopRenewalData.s_manager_residential_address);
                        $('#category_for_shop').val(shopRenewalData.s_category);
                        $('#nature_of_business_for_shop').val(shopRenewalData.s_nature_of_business);
                        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
                        $('#district').val(shopRenewalData.district);
                    }
                }
            }
        });
    },
    uploadDocumentForShopRenewal: function (fileNo) {
        var that = this;

        if ($('#seal_and_stamp_for_shoprenewal').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_shoprenewal', VALUE_TWO, 'shoprenewal');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_shoprenewal_' + fileNo).hide();
        $('.spinner_name_container_for_shoprenewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var shopRenewalId = $('#shop_renewal_id').val();
        var formData = new FormData($('#shop_renewal_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("shop_renewal_id", shopRenewalId);
        $.ajax({
            type: 'POST',
            url: 'shop_renewal/upload_shoprenewal_document',
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
                $('.spinner_container_for_shoprenewal_' + fileNo).show();
                $('.spinner_name_container_for_shoprenewal_' + fileNo).hide();
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
                    $('.spinner_container_for_shoprenewal_' + fileNo).show();
                    $('.spinner_name_container_for_shoprenewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_shoprenewal_' + fileNo).hide();
                $('.spinner_name_container_for_shoprenewal_' + fileNo).show();
                $('#shop_renewal_id').val(parseData.shop_renewal_id);
                var shopRenewalData = parseData.shop_renewal_data;

                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('seal_and_stamp_container_for_shoprenewal', 'seal_and_stamp_name_image_for_shoprenewal', 'seal_and_stamp_name_container_for_shoprenewal',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', shopRenewalData.signature, parseData.shop_renewal_id, VALUE_ONE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/shop/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/shop/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'ShopRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },

});
