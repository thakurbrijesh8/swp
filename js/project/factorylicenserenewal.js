var factoryLicenseRenewalListTemplate = Handlebars.compile($('#factory_license_renewal_list_template').html());
var factoryLicenseRenewalTableTemplate = Handlebars.compile($('#factory_license_renewal_table_template').html());
var factoryLicenseRenewalActionTemplate = Handlebars.compile($('#factory_license_renewal_action_template').html());
var factoryLicenseRenewalFormTemplate = Handlebars.compile($('#factory_license_renewal_form_template').html());
var factoryLicenseRenewalViewTemplate = Handlebars.compile($('#factory_license_renewal_view_template').html());
var factoryLicenseRenewalChallanTemplate = Handlebars.compile($('#factory_license_renewal_upload_challan_template').html());

var tempProductCnt = 1;
var tempDirectorCnt = 1;
var tempEmployeeCnt = 1;

var FactoryLicenseRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
FactoryLicenseRenewal.Router = Backbone.Router.extend({
    routes: {
        'factorylicense_renewal': 'renderList',
        'factorylicense_renewal_form': 'renderListForForm',
        'edit_factorylicense_renewal_form': 'renderList',
        'view_factorylicense_renewal_form': 'renderList',
    },
    renderList: function () {
        FactoryLicenseRenewal.listview.listPage();
    },
    renderListForForm: function () {
        FactoryLicenseRenewal.listview.listPageFactoryLicenseRenewalForm();
    }
});
FactoryLicenseRenewal.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="is_factory_exists"]': 'hasFactoryExistsEvent',
        'click input[name="factory_extend"]': 'hasFactoryExtendEvent',
    },
    hasFactoryExistsEvent: function (event) {
        var val = $('input[name=is_factory_exists]:checked').val();
        if (val === '1') {
            this.$('.factory_exists_div').show();
        } else {
            this.$('.factory_exists_div').hide();

        }
    },
    hasFactoryExtendEvent: function (event) {
        var val = $('input[name=factory_extend]:checked').val();
        if (val === '1') {
            this.$('.factory_extend_div').show();
        } else {
            this.$('.factory_extend_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_factory');
        addClass('menu_factory_license_renewal', 'active');
        FactoryLicenseRenewal.router.navigate('factorylicense');
        var templateData = {};
        this.$el.html(factoryLicenseRenewalListTemplate(templateData));
        this.loadFactoryLicenseRenewalData(sDistrict, sStatus);

    },
    listPageFactoryLicenseRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_factory');
        this.$el.html(factoryLicenseRenewalListTemplate);
        this.newFactoryLicenseRenewalForm(false, {});
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
                rowData.ADMIN_FACTORY_DOC_PATH = ADMIN_FACTORY_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return factoryLicenseRenewalActionTemplate(rowData);
    },
    loadFactoryLicenseRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTYONE, data);
        };
        var that = this;
        FactoryLicenseRenewal.router.navigate('factorylicense_renewal');
        $('#factory_license_renewal_form_and_datatable_container').html(factoryLicenseRenewalTableTemplate(searchData));
        factoryLicenseRenewalDataTable = $('#factory_license_renewal_datatable').DataTable({
            ajax: {url: 'factorylicense_renewal/get_factory_license_renewal_data', dataSrc: "factory_license_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'factorylicence_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_factory', 'class': 'text-center'},
                {data: 'max_power_to_be_used', 'class': 'text-center'},
                {data: 'factory_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'factorylicence_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'factorylicence_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#factory_license_renewal_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = factoryLicenseRenewalDataTable.row(tr);

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
    askForNewFactoryLicenseRenewalForm: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        that.newFactoryLicenseRenewalForm(false, {});
    },
    newFactoryLicenseRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.factory_license_renewal_data;
            FactoryLicenseRenewal.router.navigate('edit_factorylicense_renewal_form');
        } else {
            var formData = {};
            FactoryLicenseRenewal.router.navigate('factorylicense_renewal_form');
        }

        tempProductCnt = 1;
        tempDirectorCnt = 1;
        tempEmployeeCnt = 1;
        var that = this;
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.factoryLicenseRenewal_data = parseData.factory_license_renewal_data;
        if (isEdit) {
            //templateData['factoryLicenseRenewal_data']['receipt_date'] = dateTo_DD_MM_YYYY(templateData['factoryLicenseRenewal_data']['receipt_date']);
        }
        $('#factory_license_renewal_form_and_datatable_container').html(factoryLicenseRenewalFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);

            if (formData.sign_of_occupier != '') {
                that.showDocument('sign_of_occupier_container_for_factorylicense_renewal', 'sign_of_occupier_name_image_for_factorylicense_renewal', 'sign_of_occupier_name_container_for_factorylicense_renewal',
                        'sign_of_occupier_download', 'sign_of_occupier', formData.sign_of_occupier, formData.factorylicence_renewal_id, VALUE_ONE);
            }

            if (formData.sign_of_manager != '') {
                that.showDocument('sign_of_manager_container_for_factorylicense_renewal', 'sign_of_manager_name_image_for_factorylicense_renewal', 'sign_of_manager_name_container_for_factorylicense_renewal',
                        'sign_of_manager_download', 'sign_of_manager', formData.sign_of_manager, formData.factorylicence_renewal_id, VALUE_TWO);
            }




        }
        generateSelect2();
        datePicker();
        $('#factory_license_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitFactoryLicenseRenewal($('#submit_btn_for_factory_license_renewal'));
            }
        });
    },
    editOrViewFactoryLicenseRenewal: function (btnObj, factoryLicenseRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!factoryLicenseRenewalId) {
            showError(invalidIdValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnClick = btnObj.attr("onclick");
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'factorylicense_renewal/get_factory_license_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'factorylicense_id': factoryLicenseRenewalId}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnClick);
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
                btnObj.attr('onclick', ogBtnOnClick);
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
                    that.newFactoryLicenseRenewalForm(isEdit, parseData);
                } else {
                    that.viewFactoryLicenseRenewalForm(parseData);
                }
            }
        });
    },
    viewFactoryLicenseRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.factory_license_renewal_data;
        FactoryLicenseRenewal.router.navigate('view_factorylicense_renewal_form');
        //formData.receipt_date = dateTo_DD_MM_YYYY(formData.receipt_date);
        $('#factory_license_renewal_form_and_datatable_container').html(factoryLicenseRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.sign_of_occupier != '') {
            that.showDocument('sign_of_occupier_container_for_factorylicense_renewal', 'sign_of_occupier_name_image_for_factorylicense_renewal', 'sign_of_occupier_name_container_for_factorylicense_renewal',
                    'sign_of_occupier_download', 'sign_of_occupier', formData.sign_of_occupier);
        }

        if (formData.sign_of_manager != '') {
            that.showDocument('sign_of_manager_container_for_factorylicense_renewal', 'sign_of_manager_name_image_for_factorylicense_renewal', 'sign_of_manager_name_container_for_factorylicense_renewal',
                    'sign_of_manager_download', 'sign_of_manager', formData.sign_of_manager);
        }
    },
    checkValidationForFactoryLicenseRenewal: function (factoryLicenseRenewalData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!factoryLicenseRenewalData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!factoryLicenseRenewalData.registration_number) {
            return getBasicMessageAndFieldJSONArray('registration_number', licenseNumberValidationMessage);
        }
        if (!factoryLicenseRenewalData.name_of_factory) {
            return getBasicMessageAndFieldJSONArray('name_of_factory', factoryNameValidationMessage);
        }
        if (!factoryLicenseRenewalData.factory_address) {
            return getBasicMessageAndFieldJSONArray('factory_address', factoryAddressValidationMessage);
        }
        if (!factoryLicenseRenewalData.factory_postal_address) {
            return getBasicMessageAndFieldJSONArray('factory_postal_address', factoryPostalAddressValidationMessage);
        }
        if (!factoryLicenseRenewalData.max_no_of_worker_year) {
            return getBasicMessageAndFieldJSONArray('max_no_of_worker_year', maxWorkerValidationMessage);
        }
        if (!factoryLicenseRenewalData.max_power_to_be_used) {
            return getBasicMessageAndFieldJSONArray('max_power_to_be_used', maxPowerValidationMessage);
        }
//        if (!factoryLicenseRenewalData.fee_paid_ammount) {
//            return getBasicMessageAndFieldJSONArray('fee_paid_ammount', feePaidAmountValidationMessage);
//        }
//        if (!factoryLicenseRenewalData.receipt_number) {
//            return getBasicMessageAndFieldJSONArray('receipt_number', receiptNumberValidationMessage);
//        }
//        if (!factoryLicenseRenewalData.receipt_date) {
//            return getBasicMessageAndFieldJSONArray('receipt_date', receiptDateValidationMessage);
//        }
        if (!factoryLicenseRenewalData.manager_detail) {
            return getBasicMessageAndFieldJSONArray('manager_detail', managerValidationMessage);
        }
        if (!factoryLicenseRenewalData.occupier_detail) {
            return getBasicMessageAndFieldJSONArray('occupier_detail', occupierValidationMessage);
        }
        return '';
    },
    askForSubmitFactoryLicenseRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'FactoryLicenseRenewal.listview.submitFactoryLicenseRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitFactoryLicenseRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var factoryLicenseRenewalData = $('#factory_license_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForFactoryLicenseRenewal(factoryLicenseRenewalData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('factory-license-renewal-' + validationData.field, validationData.message);
            return false;
        }
        if ($('#sign_of_occupier_container_for_factorylicense_renewal').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('sign_of_occupier_for_factorylicense_renewal', VALUE_TWO, 'factory-license-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#sign_of_manager_container_for_factorylicense_renewal').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('sign_of_manager_for_factorylicense_renewal', VALUE_TWO, 'factory-license-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_factory') : $('#submit_btn_for_factory');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var factoryLicenseRenewalData = new FormData($('#factory_license_renewal_form')[0]);
        factoryLicenseRenewalData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        factoryLicenseRenewalData.append("module_type", moduleType);

        $.ajax({
            type: 'POST',
            url: 'factorylicense_renewal/submit_factory_license_renewal',
            data: factoryLicenseRenewalData,
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
                validationMessageShow('factory-license-renewal', textStatus.statusText);
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
                    validationMessageShow('factory-license-renewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FactoryLicenseRenewal.router.navigate('factorylicense_renewal', {'trigger': true});
            }
        });
    },
    addMultiplePrincipleProduct: function (templateData) {
        templateData.prod_cnt = tempProductCnt;
        $('#principle_product_info_container').append(principleProductTemplate(templateData));
        tempProductCnt++;
        resetCounter('display-cnt');
    },
    removeProductInfo: function (prodCnt) {
        $('#principle_product_info_' + prodCnt).remove();
        resetCounter('display-cnt');
    },

    addMultipleDirector: function (templateData) {
        templateData.director_cnt = tempDirectorCnt;
        $('#director_info_container').append(directorInfoTemplate(templateData));
        tempDirectorCnt++;
        resetCounter('display-cnt-dir');
    },
    removeDirectorInfo: function (dirCnt) {
        $('#director_info_' + dirCnt).remove();
        resetCounter('display-cnt-dir');
    },

    addMultipleEmployee: function (templateData) {
        templateData.emp_cnt = tempEmployeeCnt;
        $('#employee_info_container').append(employeeInfoTemplate(templateData));
        tempEmployeeCnt++;
        resetCounter('display-cnt-emp');
    },
    removeEmployeeInfo: function (empCnt) {
        $('#employee_info_' + empCnt).remove();
        resetCounter('display-cnt-emp');
    },
    askForRemove: function (factoryLicenseRenewalId, docId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!factoryLicenseRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'FactoryLicenseRenewal.listview.removeDocument(\'' + factoryLicenseRenewalId + '\',\'' + docId + '\')';
        showConfirmation(yesEvent, 'Remove');
    },

    removeDocument: function (factoryLicenseRenewalId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!factoryLicenseRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_factorylicense_renewal_' + docType).hide();
        $('.spinner_name_container_for_factorylicense_renewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'factorylicense_renewal/remove_document',
            data: $.extend({}, {'factorylicence_renewal_id': factoryLicenseRenewalId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_factorylicense_renewal_' + docType).hide();
                $('.spinner_name_container_for_factorylicense_renewal_' + docType).show();
                validationMessageShow('factory-license-renewal', textStatus.statusText);
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
                    validationMessageShow('factory-license-renewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_factorylicense_renewal_' + docType).show();
                $('.spinner_name_container_for_factorylicense_renewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('sign_of_occupier_name_container_for_factorylicense_renewal', 'sign_of_occupier_name_image_for_factorylicense_renewal', 'sign_of_occupier_container_for_factorylicense_renewal', 'sign_of_occupier_for_factorylicense_renewal');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('sign_of_manager_name_container_for_factorylicense_renewal', 'sign_of_manager_name_image_for_factorylicense_renewal', 'sign_of_manager_container_for_factorylicense_renewal', 'sign_of_manager_for_factorylicense_renewal');
                }

            }
        });
    },
    generateForm1: function (factoryLicenseRenewalId) {
        if (!factoryLicenseRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#factorylicense_renewal_id_for_factorylicense_renewal_form1').val(factoryLicenseRenewalId);
        $('#factorylicense_renewal_form1_pdf_form').submit();
        $('#factorylicense_renewal_id_for_factorylicense_renewal_form1').val('');
    },
    downloadUploadChallan: function (factoryLicenseRenewalId) {
        if (!factoryLicenseRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + factoryLicenseRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'factorylicense_renewal/get_factorylicense_renewal_data_by_factorylicense_renewal_id',
            type: 'post',
            data: $.extend({}, {'factorylicence_renewal_id': factoryLicenseRenewalId}, getTokenData()),
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
                var factoryLicenseRenewalData = parseData.factory_license_renewal_data;
                that.showChallan(factoryLicenseRenewalData);
            }
        });
    },
    showChallan: function (factoryLicenseRenewalData) {
        showPopup();
        if (factoryLicenseRenewalData.status != VALUE_FIVE && factoryLicenseRenewalData.status != VALUE_SIX && factoryLicenseRenewalData.status != VALUE_SEVEN) {
            if (!factoryLicenseRenewalData.hide_submit_btn) {
                factoryLicenseRenewalData.show_fees_paid = true;
            }
        }
        if (factoryLicenseRenewalData.payment_type == VALUE_ONE) {
            factoryLicenseRenewalData.utitle = 'Fees Paid Challan Copy';
        } else {
            factoryLicenseRenewalData.style = 'display: none;';
        }
        if (factoryLicenseRenewalData.payment_type == VALUE_TWO) {
            factoryLicenseRenewalData.show_dd_po_option = true;
            factoryLicenseRenewalData.utitle = 'Demand Draft (DD)';
        }
        factoryLicenseRenewalData.module_type = VALUE_FOURTYONE;
        $('#popup_container').html(factoryLicenseRenewalChallanTemplate(factoryLicenseRenewalData));
        loadFB(VALUE_FOURTYONE, factoryLicenseRenewalData.fb_data);
        loadPH(VALUE_FOURTYONE, factoryLicenseRenewalData.factorylicence_renewal_id, factoryLicenseRenewalData.ph_data);

        if (factoryLicenseRenewalData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'factory_license_renewal_upload_challan', factoryLicenseRenewalData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'factory_license_renewal_upload_challan', 'uc', 'radio');
            if (factoryLicenseRenewalData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_factory_license_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (factoryLicenseRenewalData.challan != '') {
            $('#challan_container_for_factory_license_renewal_upload_challan').hide();
            $('#challan_name_container_for_factory_license_renewal_upload_challan').show();
            $('#challan_name_href_for_factory_license_renewal_upload_challan').attr('href', ADMIN_FACTORY_DOC_PATH + factoryLicenseRenewalData.challan);
            $('#challan_name_for_factory_license_renewal_upload_challan').html(factoryLicenseRenewalData.challan);
        }
        if (factoryLicenseRenewalData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_factory_license_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_factory_license_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_factory_license_renewal_upload_challan').attr('href', 'documents/factorylicense/' + factoryLicenseRenewalData.fees_paid_challan);
            $('#fees_paid_challan_name_for_factory_license_renewal_upload_challan').html(factoryLicenseRenewalData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_factory_license_renewal_upload_challan').attr('onclick', 'FactoryLicenseRenewal.listview.removeFeesPaidChallan("' + factoryLicenseRenewalData.factorylicence_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (factoryLicenseRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!factoryLicenseRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'factorylicense_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'factorylicence_renewal_id': factoryLicenseRenewalId}, getTokenData()),
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
                validationMessageShow('factory-license-renewal-uc', textStatus.statusText);
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
                    validationMessageShow('factory-license-renewal-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-factory-license-renewal-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'factory_license_renewal_upload_challan');
                $('#status_' + factoryLicenseRenewalId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-factory-license-renewal-uc').html('');
        validationMessageHide();
        var factoryLicenseRenewalId = $('#factory_license_renewal_id_for_factory_license_renewal_upload_challan').val();
        if (!factoryLicenseRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_factory_license_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_factory_license_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_factory_license_renewal_upload_challan').focus();
                validationMessageShow('factory-license-renewal-uc-fees_paid_challan_for_factory_license_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_factory_license_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_factory_license_renewal_upload_challan').focus();
                validationMessageShow('factory-license-renewal-uc-fees_paid_challan_for_factory_license_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_factory_license_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#factory_license_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'factorylicense_renewal/upload_fees_paid_challan',
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
                validationMessageShow('factory-license-renewal-uc', textStatus.statusText);
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
                    validationMessageShow('factory-license-renewal-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + factoryLicenseRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (factoryLicenseRenewalId) {
        if (!factoryLicenseRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#factorylicense_renewal_id_for_certificate').val(factoryLicenseRenewalId);
        $('#factorylicense_renewal_certificate_pdf_form').submit();
        $('#factorylicense_renewal_id_for_certificate').val('');
    },
    getQueryData: function (factoryLicenseRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!factoryLicenseRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTYONE;
        templateData.module_id = factoryLicenseRenewalId;
        var btnObj = $('#query_btn_for_app_' + factoryLicenseRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOURTYONE, moduleData.factorylicence_renewal_id);
                tmpData.applicant_name = moduleData.name_of_factory;
                tmpData.title = 'Factory Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getFactoryLicenseData: function (btnObj) {
        var license_number = $('#registration_number').val();
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        // if (!dealerRenewalId) {
        //     showError(invalidUserValidationMessage);
        //     return;
        // }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'factorylicense_renewal/get_factory_license_data_by_id',
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
                factoryLicenseData = parseData.factory_license_data;
                if (factoryLicenseData) {
                    $('#registration_number').val(factoryLicenseData.registration_number);
                    $('#factorylicence_renewal_id').val(factoryLicenseData.factorylicence_renewal_id);
                    $('#name_of_factory').val(factoryLicenseData.name_of_factory);
                    $('#factory_address').val(factoryLicenseData.factory_address);
                    $('#factory_postal_address').val(factoryLicenseData.factory_postal_address);
                    $('#max_no_of_worker_year').val(factoryLicenseData.max_no_of_worker_year);
                    $('#max_power_to_be_used').val(factoryLicenseData.max_power_to_be_used);
                    $('#manager_detail').val(factoryLicenseData.manager_detail);
                    $('#occupier_detail').val(factoryLicenseData.occupier_detail);
                }
            }
        });
    },

    uploadDocumentForFactoryLicenseRenewal: function (fileNo) {
        var that = this;

        if ($('#sign_of_occupier_for_factorylicense_renewal').val() != '') {
            var copyOfRegistration = checkValidationForDocument('sign_of_occupier_for_factorylicense_renewal', VALUE_TWO, 'factory-license-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#sign_of_manager_for_factorylicense_renewal').val() != '') {
            var copyOfRegistration = checkValidationForDocument('sign_of_manager_for_factorylicense_renewal', VALUE_TWO, 'factory-license-renewal');
            if (copyOfRegistration == false) {
                return false;
            }
        }

        $('.spinner_container_for_factorylicense_renewal_' + fileNo).hide();
        $('.spinner_name_container_for_factorylicense_renewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var factoryLicenseRenewalId = $('#factorylicence_renewal_id').val();
        var formData = new FormData($('#factory_license_renewal_form')[0]);
        formData.append("file_no", fileNo);
        formData.append("factorylicence_renewal_id", factoryLicenseRenewalId);
        $.ajax({
            type: 'POST',
            url: 'factorylicense_renewal/upload_factorylicence_renewal_document',
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
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_factorylicense_renewal_' + fileNo).show();
                $('.spinner_name_container_for_factorylicense_renewal_' + fileNo).hide();
                showError(textStatus.statusText);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    $('#spinner_template_' + fileNo).hide();
                    $('.spinner_container_for_factorylicense_renewal_' + fileNo).show();
                    $('.spinner_name_container_for_factorylicense_renewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_factorylicense_renewal_' + fileNo).hide();
                $('.spinner_name_container_for_factorylicense_renewal_' + fileNo).show();
                $('#factorylicence_renewal_id').val(parseData.factorylicence_renewal_id);
                var factorylicense_renewalData = parseData.factory_license_renewal_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('sign_of_occupier_container_for_factorylicense_renewal', 'sign_of_occupier_name_image_for_factorylicense_renewal', 'sign_of_occupier_name_container_for_factorylicense_renewal',
                            'sign_of_occupier_download', 'sign_of_occupier', factorylicense_renewalData.sign_of_occupier, parseData.factorylicence_renewal_id, VALUE_ONE);
                }

                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('sign_of_manager_container_for_factorylicense_renewal', 'sign_of_manager_name_image_for_factorylicense_renewal', 'sign_of_manager_name_container_for_factorylicense_renewal',
                            'sign_of_manager_download', 'sign_of_manager', factorylicense_renewalData.sign_of_manager, parseData.factorylicence_renewal_id, VALUE_TWO);
                }

            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/factorylicense/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/factorylicense/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'FactoryLicenseRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
