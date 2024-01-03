var travelagentRenewalListTemplate = Handlebars.compile($('#travelagent_renewal_list_template').html());
var travelagentRenewalTableTemplate = Handlebars.compile($('#travelagent_renewal_table_template').html());
var travelagentRenewalActionTemplate = Handlebars.compile($('#travelagent_renewal_action_template').html());
var travelagentRenewalFormTemplate = Handlebars.compile($('#travelagent_renewal_form_template').html());
var travelagentRenewalViewTemplate = Handlebars.compile($('#travelagent_renewal_view_template').html());
var travelagentRenewalProprietorInfoTemplate = Handlebars.compile($('#travelagent_renewal_proprietor_info_template').html());
var travelagentRenewalUploadChallanTemplate = Handlebars.compile($('#travelagent_renewal_upload_challan_template').html());

var tempProprietorInfoCnt = 1;

var TravelagentRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
TravelagentRenewal.Router = Backbone.Router.extend({
    routes: {
        'travelagent_renewal': 'renderList',
        'travelagent_renewal_form': 'renderListForForm',
        'edit_travelagent_renewal_form': 'renderList',
        'view_travelagent_renewal_form': 'renderList',
    },
    renderList: function () {
        TravelagentRenewal.listview.listPage();
    },
    renderListForForm: function () {
        TravelagentRenewal.listview.listPageTravelagentRenewalForm();
    }
});
TravelagentRenewal.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_tourism');
        addClass('travelagentrenewal', 'active');
        TravelagentRenewal.router.navigate('travelagent_renewal');
        var templateData = {};
        this.$el.html(travelagentRenewalListTemplate(templateData));
        this.loadTravelagentRenewalData(sDistrict, sStatus);

    },
    listPageTravelagentRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_tourism');
        addClass('travelagentrenewal', 'active');
        this.$el.html(travelagentRenewalListTemplate);
        this.newTravelagentRenewalForm(false, {});
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
                rowData.ADMIN_TRAVELAGENT_DOC_PATH = ADMIN_TRAVELAGENT_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return travelagentRenewalActionTemplate(rowData);
    },
    loadTravelagentRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTYTHREE, data);
        };
        var that = this;
        TravelagentRenewal.router.navigate('travelagent_renewal');
        $('#travelagent_renewal_form_and_datatable_container').html(travelagentRenewalTableTemplate(searchData));
        travelagentrenewalDataTable = $('#travelagent_renewal_datatable').DataTable({
            ajax: {url: 'travelagent_renewal/get_travelagent_renewal_data', dataSrc: "travelagent_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'travelagent_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_travel_agency', 'class': 'text-center'},
                {data: 'address_of_agency', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'travelagent_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'travelagent_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#travelagent_renewal_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = travelagentrenewalDataTable.row(tr);

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
    newTravelagentRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.travelagent_renewal_data;
            TravelagentRenewal.router.navigate('edit_travelagent_renewal_form');
        } else {
            var formData = {};
            TravelagentRenewal.router.navigate('travelagent_renewal_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.TRAVEL_AGENCY_FEES = TRAVEL_AGENCY_FEES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.travelagentrenewal_data = parseData.travelagent_renewal_data;
        templateData.last_valid_upto = dateTo_DD_MM_YYYY(formData.last_valid_upto);
        $('#travelagent_renewal_form_and_datatable_container').html(travelagentRenewalFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'area_of_agency');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#area_of_agency').val(formData.area_of_agency);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_travelagentrenewal', 'seal_and_stamp_name_image_for_travelagentrenewal', 'seal_and_stamp_name_container_for_travelagentrenewal',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.travelagent_renewal_id, VALUE_ONE);
            }

            var proprietorInfo = JSON.parse(formData.name_of_proprietor);
            $.each(proprietorInfo, function (key, value) {
                that.addMultipleProprietor(value);
            })
        }
        generateSelect2();
        datePicker();
        $('#travelagent_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitTravelagentRenewal($('#submit_btn_for_travelagentrenewal'));
            }
        });
    },
    editOrViewTravelagentRenewal: function (btnObj, travelagentRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!travelagentRenewalId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'travelagent_renewal/get_travelagent_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'travelagent_renewal_id': travelagentRenewalId}, getTokenData()),
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
                    that.newTravelagentRenewalForm(isEdit, parseData);
                } else {
                    that.viewTravelagentRenewalForm(parseData);
                }
            }
        });
    },
    viewTravelagentRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.travelagent_renewal_data;
        TravelagentRenewal.router.navigate('view_travelagent_renewal_form');
        formData.TRAVEL_AGENCY_FEES = TRAVEL_AGENCY_FEES;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.last_valid_upto = dateTo_DD_MM_YYYY(formData.last_valid_upto);
        $('#travelagent_renewal_form_and_datatable_container').html(travelagentRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'area_of_agency');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#area_of_agency').val(formData.area_of_agency);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        var proprietorInfo = JSON.parse(formData.name_of_proprietor);
        $.each(proprietorInfo, function (key, value) {
            that.addMultipleProprietor(value);
            $('.view_hideen').hide();
            $('.name').attr('readonly', true);
        })

        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_travelagentrenewal', 'seal_and_stamp_name_image_for_travelagentrenewal', 'seal_and_stamp_name_container_for_travelagentrenewal',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.travelagent_renewal_id, VALUE_ONE);
        }
    },
    checkValidationForTravelagentRenewal: function (travelagentrenewalData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!travelagentrenewalData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!travelagentrenewalData.name_of_travel_agency) {
            return getBasicMessageAndFieldJSONArray('name_of_travel_agency', travelAgencyNameValidationMessage);
        }
        if (!travelagentrenewalData.address_of_agency) {
            return getBasicMessageAndFieldJSONArray('address_of_agency', addressOfAgencyValidationMessage);
        }
        if (!travelagentrenewalData.last_valid_upto) {
            return getBasicMessageAndFieldJSONArray('last_valid_upto', dateValidationMessage);
        }
        if (!travelagentrenewalData.mob_no) {
            return getBasicMessageAndFieldJSONArray('mob_no', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(travelagentrenewalData.mob_no);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mob_no', invalidMobileValidationMessage);
        }
        if (!travelagentrenewalData.area_of_agency) {
            return getBasicMessageAndFieldJSONArray('area_of_agency', areaOfAgencyValidationMessage);
        }
        return '';
    },
    askForSubmitTravelagentRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'TravelagentRenewal.listview.submitTravelagentRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitTravelagentRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var travelagentrenewalData = $('#travelagent_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForTravelagentRenewal(travelagentrenewalData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('travelagentrenewal-' + validationData.field, validationData.message);
            return false;
        }

        var proprietorInfoItem = [];
        var isproprietorValidation = false;
        $('.proprietor_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var proprietorInfo = {};
            var name = $('#name_' + cnt).val();
            if (name == '' || name == null) {
                $('#name_' + cnt).focus();
                validationMessageShow('travelagentrenewal-' + cnt, nameValidationMessage);
                isproprietorValidation = true;
                return false;
            }
            proprietorInfo.name = name;
            proprietorInfoItem.push(proprietorInfo);
        });

        if (isproprietorValidation) {
            return false;
        }

        if ($('#seal_and_stamp_container_for_travelagentrenewal').is(':visible')) {
            var sealAndStamp = $('#seal_and_stamp_for_travelagentrenewal').val();
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_travelagentrenewal', VALUE_TWO, 'travelagentrenewal');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_travelagentrenewal') : $('#submit_btn_for_travelagentrenewal');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var travelagentrenewalData = new FormData($('#travelagent_renewal_form')[0]);
        travelagentrenewalData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        travelagentrenewalData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        travelagentrenewalData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'travelagent_renewal/submit_travelagent_renewal',
            data: travelagentrenewalData,
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
                validationMessageShow('travelagentrenewal', textStatus.statusText);
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
                    validationMessageShow('travelagentrenewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                TravelagentRenewal.router.navigate('travelagent_renewal', {'trigger': true});
            }
        });
    },

    askForRemove: function (travelagentRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!travelagentRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'TravelagentRenewal.listview.removeDocument(\'' + travelagentRenewalId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (travelagentRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!travelagentRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_travelagentrenewal_' + docType).hide();
        $('.spinner_name_container_for_travelagentrenewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'travelagent_renewal/remove_document',
            data: $.extend({}, {'travelagent_renewal_id': travelagentRenewalId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_travelagentrenewal_' + docType).hide();
                $('.spinner_name_container_for_travelagentrenewal_' + docType).show();
                validationMessageShow('travelagentrenewal', textStatus.statusText);
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
                    validationMessageShow('travelagentrenewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_travelagentrenewal_' + docType).show();
                $('.spinner_name_container_for_travelagentrenewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_travelagentrenewal', 'seal_and_stamp_name_image_for_travelagentrenewal', 'seal_and_stamp_container_for_travelagentrenewal', 'seal_and_stamp_for_travelagentrenewal');
                }
            }
        });
    },
    addMultipleProprietor: function (templateData) {
        templateData.per_cnt = tempProprietorInfoCnt;
        $('#proprietor_info_container').append(travelagentRenewalProprietorInfoTemplate(templateData));
        tempProprietorInfoCnt++;
        resetCounter('display-cnt');
    },
    removeProprietorInfo: function (perCnt) {
        $('#proprietor_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm: function (travelagentRenewalId) {
        if (!travelagentRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#travelagent_renewal_id_for_travelagent_renewal_form').val(travelagentRenewalId);
        $('#travelagent_renewal_form_pdf_form').submit();
        $('#travelagent_renewal_id_for_travelagent_renewal_form').val('');
    },

    downloadUploadChallan: function (travelagentRenewalId) {
        if (!travelagentRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + travelagentRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'travelagent_renewal/get_travelagent_renewal_data_by_travelagent_renewal_id',
            type: 'post',
            data: $.extend({}, {'travelagent_renewal_id': travelagentRenewalId}, getTokenData()),
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
                var travelagentrenewalData = parseData.travelagent_renewal_data;
                that.showChallan(travelagentrenewalData);
            }
        });
    },
    showChallan: function (travelagentrenewalData) {
        showPopup();
        if (travelagentrenewalData.status != VALUE_FIVE && travelagentrenewalData.status != VALUE_SIX && travelagentrenewalData.status != VALUE_SEVEN) {
            if (!travelagentrenewalData.hide_submit_btn) {
                travelagentrenewalData.show_fees_paid = true;
            }
        }
        if (travelagentrenewalData.payment_type == VALUE_ONE) {
            travelagentrenewalData.utitle = 'Fees Paid Challan Copy';
        } else {
            travelagentrenewalData.style = 'display: none;';
        }
        if (travelagentrenewalData.payment_type == VALUE_TWO) {
            travelagentrenewalData.show_dd_po_option = true;
            travelagentrenewalData.utitle = 'Demand Draft (DD)';
        }
        travelagentrenewalData.module_type = VALUE_TWENTYTHREE;
        $('#popup_container').html(travelagentRenewalUploadChallanTemplate(travelagentrenewalData));
        loadFB(VALUE_TWENTYTHREE, travelagentrenewalData.fb_data);
        loadPH(VALUE_TWENTYTHREE, travelagentrenewalData.travelagent_renewal_id, travelagentrenewalData.ph_data);

        if (travelagentrenewalData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'travelagent_renewal_upload_challan', travelagentrenewalData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'travelagent_renewal_upload_challan', 'uc', 'radio');
            if (travelagentrenewalData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_travelagent_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (travelagentrenewalData.challan != '') {
            $('#challan_container_for_travelagent_renewal_upload_challan').hide();
            $('#challan_name_container_for_travelagent_renewal_upload_challan').show();
            $('#challan_name_href_for_travelagent_renewal_upload_challan').attr('href', 'documents/travelagent/' + travelagentrenewalData.challan);
            $('#challan_name_for_travelagent_renewal_upload_challan').html(travelagentrenewalData.challan);
        }
        if (travelagentrenewalData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_travelagent_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_travelagent_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_travelagent_renewal_upload_challan').attr('href', 'documents/travelagent/' + travelagentrenewalData.fees_paid_challan);
            $('#fees_paid_challan_name_for_travelagent_renewal_upload_challan').html(travelagentrenewalData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_travelagent_renewal_upload_challan').attr('onclick', 'TravelagentRenewal.listview.removeFeesPaidChallan("' + travelagentrenewalData.travelagent_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (travelagentRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!travelagentRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'travelagent_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'travelagent_renewal_id': travelagentRenewalId}, getTokenData()),
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
                validationMessageShow('travelagent-uc', textStatus.statusText);
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
                    validationMessageShow('travelagent-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-travelagent-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'travelagent_renewal_upload_challan');
                $('#status_' + travelagentRenewalId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-travelagent-uc').html('');
        validationMessageHide();
        var travelagentRenewalId = $('#travelagent_renewal_id_for_travelagent_renewal_upload_challan').val();
        if (!travelagentRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_travelagent_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_travelagent_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_travelagent_renewal_upload_challan').focus();
                validationMessageShow('travelagent-uc-fees_paid_challan_for_travelagent_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_travelagent_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_travelagent_renewal_upload_challan').focus();
                validationMessageShow('travelagent-uc-fees_paid_challan_for_travelagent_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_travelagent_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#travelagent_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'travelagent_renewal/upload_fees_paid_challan',
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
                validationMessageShow('travelagent-uc', textStatus.statusText);
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
                    validationMessageShow('travelagent-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + travelagentRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (travelagentRenewalId) {
        if (!travelagentRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#travelagent_renewal_id_for_certificate').val(travelagentRenewalId);
        $('#travelagent_renewal_certificate_pdf_form').submit();
        $('#travelagent_renewal_id_for_certificate').val('');
    },
    getQueryData: function (travelagentRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!travelagentRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTYTHREE;
        templateData.module_id = travelagentRenewalId;
        var btnObj = $('#query_btn_for_travelagentrenewal_' + travelagentRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTYTHREE, moduleData.travelagent_renewal_id);
                tmpData.applicant_name = moduleData.name_of_travel_agency;
                tmpData.title = 'Travel Agency Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getTravelagentData: function (btnObj) {
        var license_number = $('#registration_number').val();
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'travelagent_renewal/get_travelagent_data_by_id',
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
                travelagentrenewalData = parseData.travelagent_data;
                if (travelagentrenewalData == null) {
//                    $('#travelagent_id').val('');
//                    $('#name_of_travel_agency').val('');
//                    $('#address_of_agency').val('');
//                    $('#registration_number').val('');
//                    $('#last_valid_upto').val('');
//                    $('#fees').attr('readonly', true);
//                    $('#fees').val('');
//                    $('#mob_no').val('');
//                    $('#name_of_tourist_area').val(travelagentrenewalData.name_of_tourist_area);
//                    showError(licenseNoNotAvailable);
//                    $('html, body').animate({scrollTop: '0px'}, 0);
                }
                if (travelagentrenewalData) {
                    $('#travelagent_id').val(travelagentrenewalData.travelagent_id);
                    $('#name_of_travel_agency').val(travelagentrenewalData.name_of_travel_agency);
                    $('#address_of_agency').val(travelagentrenewalData.address_of_agency);
                    $('#registration_number').val(travelagentrenewalData.registration_number);
                    var last_valid_upto = dateTo_DD_MM_YYYY(travelagentrenewalData.last_valid_upto);
                    if (travelagentrenewalData.last_valid_upto != '0000-00-00') {
                        $('#last_valid_upto').val(last_valid_upto);
                    } else {
                        $('#last_valid_upto').val('');
                    }
                    $('#fees').attr('readonly', true);
                    $('#fees').val(travelagentrenewalData.fees);
                    $('#mob_no').val(travelagentrenewalData.mob_no);
                    $('#name_of_tourist_area').val(travelagentrenewalData.name_of_tourist_area);
                }
            }
        });
    },
    uploadDocumentForTravelagentRenewal: function (fileNo) {
        var that = this;
        if ($('#seal_and_stamp_for_travelagentrenewal').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_travelagentrenewal', VALUE_TWO, 'travelagentrenewal');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_travelagentrenewal_' + fileNo).hide();
        $('.spinner_name_container_for_travelagentrenewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var travelagentRenewalId = $('#travelagent_renewal_id').val();
        var formData = new FormData($('#travelagent_renewal_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("travelagent_renewal_id", travelagentRenewalId);
        $.ajax({
            type: 'POST',
            url: 'travelagent_renewal/upload_travelagentrenewal_document',
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
                $('.spinner_container_for_travelagentrenewal_' + fileNo).show();
                $('.spinner_name_container_for_travelagentrenewal_' + fileNo).hide();
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
                    $('.spinner_container_for_travelagentrenewal_' + fileNo).show();
                    $('.spinner_name_container_for_travelagentrenewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_travelagentrenewal_' + fileNo).hide();
                $('.spinner_name_container_for_travelagentrenewal_' + fileNo).show();
                $('#travelagent_renewal_id').val(parseData.travelagent_renewal_id);
                var travelagentRenewalData = parseData.travelagent_renewal_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('seal_and_stamp_container_for_travelagentrenewal', 'seal_and_stamp_name_image_for_travelagentrenewal', 'seal_and_stamp_name_container_for_travelagentrenewal',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', travelagentRenewalData.signature, parseData.travelagent_renewal_id, VALUE_ONE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/travelagent/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/travelagent/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'TravelagentRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
