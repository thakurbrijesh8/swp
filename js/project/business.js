var businessListTemplate = Handlebars.compile($('#business_list_template').html());
var businessTableTemplate = Handlebars.compile($('#business_table_template').html());
var businessActionTemplate = Handlebars.compile($('#business_action_template').html());
var businessViewTemplate = Handlebars.compile($('#business_view_template').html());
var Business = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Business.Router = Backbone.Router.extend({
    routes: {
        'business': 'renderList',
    },
    renderList: function () {
        Business.listview.listPage();
    },
});
Business.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_business');
        Business.router.navigate('business');
        var templateData = {};
        this.$el.html(businessListTemplate(templateData));
        this.loadBusinessData();
    },
    ucnDetails: function (full) {
        return '<div id="ucn_container_for_blist_' + full.business_id + '">' + full.udyam_number + '<hr>' + full.certificate_number + '</div>';
    },
    unitDetails: function (full) {
        return  '<div id="ud_container_for_blist_' + full.business_id + '">'
                + '<b><i class="fas fa-user f-s-10px"></i></b> :- ' + full.unit_name
                + '<hr><b><i class="fas fa-map f-s-10px"></i></b> :- ' + full.unit_address
                + ', District:- ' + full.district_name + ', State:- ' + full.state_name + ', Pin:- ' + full.unit_pin + '</div>';
    },
    certDetails: function (full) {
        var certifiedBy = '';
        certifiedBy += (full.is_bronze_certified != '' ? (full['is_bronze_certified'].toUpperCase() == 'YES' ? 'Bronze' : '') : '');
        certifiedBy += (full.is_silver_certified != '' ? (full['is_silver_certified'].toUpperCase() == 'YES' ? (certifiedBy != '' ? ', ' : '') + 'Silver' : '') : '');
        certifiedBy += (full.is_gold_certified != '' ? (full['is_gold_certified'].toUpperCase() == 'YES' ? (certifiedBy != '' ? ', ' : '') + 'Gold' : '') : '');
        return '<div id="cd_container_for_blist_' + full.business_id + '">' + full.certification_date + '<hr>' + full.expiry_date + '<hr>' + (certifiedBy == '' ? '-' : certifiedBy) + '</div>';
    },
    amountDetails: function (full) {
        return '<div id="amount_container_for_blist_' + full.business_id + '">'
                + 'Certification Fee: &#8377;' + full.certification_fees + '/-<br>'
                + 'Subsidy Amount: &#8377;' + full.subsidy_amount + '/-<br>'
                + 'Amount Paid: &#8377;' + full.amount_paid + '/-</div>';
    },
    loadBusinessData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        var ucnRenderer = function (data, type, full, meta) {
            return that.ucnDetails(full);
        };
        var unitDetailsRenderer = function (data, type, full, meta) {
            return that.unitDetails(full);
        };
        var certDetailsRenderer = function (data, type, full, meta) {
            return that.certDetails(full);
        };
        var amountRenderer = function (data, type, full, meta) {
            return that.amountDetails(full);
        };
        var actionRenderer = function (data, type, full, meta) {
            return businessActionTemplate(full);
        };
        $('#business_form_and_datatable_container').html(businessTableTemplate);
        setCaptchaCode('zed');
        businessDataTable = $('#business_datatable').DataTable({
            ajax: {url: 'business/get_business_data', dataSrc: "business_data", type: "post", data: getTokenData()},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'udyam_number', 'class': 'text-center', 'render': ucnRenderer},
                {data: '', 'render': unitDetailsRenderer},
                {data: '', 'class': 'text-center', 'render': certDetailsRenderer},
                {data: 'udyam_number', 'render': amountRenderer},
                {data: '', 'render': actionRenderer},
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
    },
    getBusinessDetails: function (btnObj, businessId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!businessId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'business/get_business_data_by_id',
            type: 'post',
            data: $.extend({}, {'business_id': businessId}, getTokenData()),
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
                    return false;
                }
                var businessData = parseData.business_data;
                that.viewBusinessForm(businessData);
            }
        });
    },
    viewBusinessForm: function (businessData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(businessViewTemplate(businessData));
    },
    checkValidationForBusiness: function (zedFormData) {
        if (!zedFormData.udyam_number_for_zed) {
            return getBasicMessageAndFieldJSONArray('udyam_number_for_zed', udyamNumberValidationMessage);
        }
        if (!zedFormData.certificate_number_for_zed) {
            return getBasicMessageAndFieldJSONArray('certificate_number_for_zed', isoCertificateNoValidationMessage);
        }
        if (!zedFormData.captcha_code_varification_for_zed) {
            return getBasicMessageAndFieldJSONArray('captcha_code_varification_for_zed', captchaValidationMessage);
        }
        if ((zedFormData.captcha_code_varification_for_zed).trim() != (zedFormData.captcha_code_for_zed).trim()) {
            return getBasicMessageAndFieldJSONArray('captcha_code_varification_for_zed', captchaVerificationValidationMessage);
        }
        return '';
    },
    fetchDetailsFomZED: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var zedFormData = $('#zed_form').serializeFormJSON();
        var validationData = this.checkValidationForBusiness(zedFormData);
        if (validationData != '') {
            setCaptchaCode('zed');
            $('#' + validationData.field).focus();
            validationMessageShow('zed-' + validationData.field, validationData.message);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'business/fetch_details_from_zed',
            type: 'post',
            data: $.extend({}, zedFormData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                setCaptchaCode('zed');
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
                if (parseData.success == false) {
                    setCaptchaCode('zed');
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                Business.listview.listPage();
            }
        });
    },
    reFetchDetailsFomZED: function (btnObj, businessId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!businessId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'business/re_fetch_details_from_zed',
            type: 'post',
            data: $.extend({}, {'business_id': businessId}, getTokenData()),
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
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                if (parseData.business_data) {
                    $('#ucn_container_for_blist_' + businessId).html(that.ucnDetails(parseData.business_data));
                    $('#ud_container_for_blist_' + businessId).html(that.unitDetails(parseData.business_data));
                    $('#cd_container_for_blist_' + businessId).html(that.certDetails(parseData.business_data));
                    $('#amount_container_for_blist_' + businessId).html(that.amountDetails(parseData.business_data));
                }
            }
        });
    },
});