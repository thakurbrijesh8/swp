var hotelRenewalListTemplate = Handlebars.compile($('#hotel_renewal_list_template').html());
var hotelRenewalTableTemplate = Handlebars.compile($('#hotel_renewal_table_template').html());
var hotelRenewalActionTemplate = Handlebars.compile($('#hotel_renewal_action_template').html());
var hotelRenewalFormTemplate = Handlebars.compile($('#hotel_renewal_form_template').html());
var hotelRenewalViewTemplate = Handlebars.compile($('#hotel_renewal_view_template').html());
var newEmployeesDetailsTemplate = Handlebars.compile($('#hotel_newemployees_info_template').html());
var hotelRenewalUploadChallanTemplate = Handlebars.compile($('#hotel_renewal_upload_challan_template').html());

var tempPersonCnt = 1;

var HotelRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
HotelRenewal.Router = Backbone.Router.extend({
    routes: {
        'hotel_renewal': 'renderList',
        'hotel_renewal_form': 'renderListForForm',
        'edit_hotel_renewal_form': 'renderList',
        'view_hotel_renewal_form': 'renderList',
    },
    renderList: function () {
        HotelRenewal.listview.listPage();
    },
    renderListForForm: function () {
        HotelRenewal.listview.listPageHotelRenewalForm();
    }
});
HotelRenewal.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('hotelrenewal', 'active');
        HotelRenewal.router.navigate('hotel_renewal');
        var templateData = {};
        this.$el.html(hotelRenewalListTemplate(templateData));
        this.loadHotelRenewalData(sDistrict, sStatus);

    },
    listPageHotelRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('hotelrenewal', 'active');
        this.$el.html(hotelRenewalListTemplate);
        this.newHotelRenewalForm(false, {});
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
                rowData.ADMIN_HOTELREGI_DOC_PATH = ADMIN_HOTELREGI_DOC_PATH;
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
        return hotelRenewalActionTemplate(rowData);
    },
    loadHotelRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTY, data)
                    + getFRContainer(VALUE_TWENTY, data, full.rating, full.fr_datetime);
        };
        var that = this;
        HotelRenewal.router.navigate('hotel_renewal');
        $('#hotel_renewal_form_and_datatable_container').html(hotelRenewalTableTemplate(searchData));
        hotelRenewalDataTable = $('#hotel_renewal_datatable').DataTable({
            ajax: {url: 'hotel_renewal/get_hotel_renewal_data', dataSrc: "hotel_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'hotel_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_hotel', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'hotel_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'hotel_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#hotel_renewal_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = hotelRenewalDataTable.row(tr);

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
    newHotelRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.hotel_renewal_data;
            HotelRenewal.router.navigate('edit_hotel_renewal_form');
        } else {
            var formData = {};
            HotelRenewal.router.navigate('hotel_renewal_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.hotelrenewal_data = parseData.hotel_renewal_data;
        templateData.last_valid_upto = dateTo_DD_MM_YYYY(formData.last_valid_upto);
        $('#hotel_renewal_form_and_datatable_container').html(hotelRenewalFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'name_of_tourist_area');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#name_of_tourist_area').val(formData.name_of_tourist_area);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            if (formData.noc_fire != '') {
                that.showDocument('noc_fire_container_for_hotelrenewal', 'noc_fire_name_image_for_hotelrenewal', 'noc_fire_name_container_for_hotelrenewal',
                        'noc_fire_download', 'noc_fire_remove_btn', formData.noc_fire, formData.hotel_renewal_id, VALUE_ONE);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_hotelrenewal', 'seal_and_stamp_name_image_for_hotelrenewal', 'seal_and_stamp_name_container_for_hotelrenewal',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.hotel_renewal_id, VALUE_TWO);
            }

            if (formData.new_employees_details != '') {
                var newEmployeesDetails = JSON.parse(formData.new_employees_details);
                $.each(newEmployeesDetails, function (key, value) {
                    that.addMultipleNewEmployees(value);
                })
            }
        }
        generateSelect2();
        datePicker();
        $('#hotel_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitHotelRenewal($('#submit_btn_for_hotelrenewal'));
            }
        });
    },
    editOrViewHotelRenewal: function (btnObj, hotelRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!hotelRenewalId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'hotel_renewal/get_hotel_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'hotel_renewal_id': hotelRenewalId}, getTokenData()),
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
                    that.newHotelRenewalForm(isEdit, parseData);
                } else {
                    that.viewHotelRenewalForm(parseData);
                }
            }
        });
    },
    viewHotelRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.hotel_renewal_data;
        HotelRenewal.router.navigate('view_hotel_renewal_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.last_valid_upto = dateTo_DD_MM_YYYY(formData.last_valid_upto);
        $('#hotel_renewal_form_and_datatable_container').html(hotelRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'name_of_tourist_area');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#name_of_tourist_area').val(formData.name_of_tourist_area);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        if (formData.noc_fire != '') {
            that.showDocument('noc_fire_container_for_hotelrenewal', 'noc_fire_name_image_for_hotelrenewal', 'noc_fire_name_container_for_hotelrenewal',
                    'noc_fire_download', 'noc_fire_remove_btn', formData.noc_fire, formData.hotel_renewal_id, VALUE_ONE);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_hotelrenewal', 'seal_and_stamp_name_image_for_hotelrenewal', 'seal_and_stamp_name_container_for_hotelrenewal',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.hotel_renewal_id, VALUE_TWO);
        }

        if (formData.new_employees_details != '') {
            var newEmployeesDetails = JSON.parse(formData.new_employees_details);
            $.each(newEmployeesDetails, function (key, value) {
                that.addMultipleNewEmployees(value);
                $('.view_hideen').hide();
                $('.name').attr('readonly', true);
            })
        }
    },
    checkValidationForHotelRenewal: function (hotelRenewalData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!hotelRenewalData.registration_number) {
            return getBasicMessageAndFieldJSONArray('registration_number', registrationNumberValidationMessage);
        }
        if (!hotelRenewalData.name_of_hotel) {
            return getBasicMessageAndFieldJSONArray('name_of_hotel', hotelNameValidationMessage);
        }
        if (!hotelRenewalData.name_of_proprietor) {
            return getBasicMessageAndFieldJSONArray('name_of_proprietor', nameOfProprietorValidationMessage);
        }
        if (!hotelRenewalData.last_valid_upto) {
            return getBasicMessageAndFieldJSONArray('last_valid_upto', dateValidationMessage);
        }
        if (!hotelRenewalData.mob_no) {
            return getBasicMessageAndFieldJSONArray('mob_no', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(hotelRenewalData.mob_no);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mob_no', invalidMobileValidationMessage);
        }
        if (!hotelRenewalData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }

        return '';
    },
    askForSubmitHotelRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'HotelRenewal.listview.submitHotelRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitHotelRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var hotelRenewalData = $('#hotel_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForHotelRenewal(hotelRenewalData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('hotelrenewal-' + validationData.field, validationData.message);
            return false;
        }

        var newEmployeesDetailsItem = [];
        var isnewemployeesValidation = false;
        $('.newemployees_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var newEmployeesDetails = {};
            var name = $('#name_' + cnt).val();
            if (name == '' || name == null) {
                $('#name_' + cnt).focus();
                validationMessageShow('hotelrenewal-' + cnt, nameValidationMessage);
                isnewemployeesValidation = true;
                return false;
            }
            newEmployeesDetails.name = name;
            newEmployeesDetailsItem.push(newEmployeesDetails);
        });

        if (isnewemployeesValidation) {
            return false;
        }

        if ($('#noc_fire_container_for_hotelrenewal').is(':visible')) {
            var nocFire = checkValidationForDocument('noc_fire_for_hotelrenewal', VALUE_ONE, 'hotelrenewal');
            if (nocFire == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_hotelrenewal').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_hotelrenewal', VALUE_TWO, 'hotelrenewal');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_hotelrenewal') : $('#submit_btn_for_hotelrenewal');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var hotelRenewalData = new FormData($('#hotel_renewal_form')[0]);
        hotelRenewalData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        hotelRenewalData.append("newemployees_data", JSON.stringify(newEmployeesDetailsItem));
        hotelRenewalData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'hotel_renewal/submit_hotel_renewal',
            data: hotelRenewalData,
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
                validationMessageShow('hotelrenewal', textStatus.statusText);
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
                    validationMessageShow('hotelrenewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                HotelRenewal.router.navigate('hotel_renewal', {'trigger': true});
            }
        });
    },

    askForRemove: function (hotelRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!hotelRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'HotelRenewal.listview.removeDocument(\'' + hotelRenewalId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (hotelRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!hotelRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_hotelrenewal_' + docType).hide();
        $('.spinner_name_container_for_hotelrenewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'hotel_renewal/remove_document',
            data: $.extend({}, {'hotel_renewal_id': hotelRenewalId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_hotelrenewal_' + docType).hide();
                $('.spinner_name_container_for_hotelrenewal_' + docType).show();
                validationMessageShow('hotelrenewal', textStatus.statusText);
                validationMessageShow('hotelrenewal', textStatus.statusText);
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
                    validationMessageShow('hotelrenewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_hotelrenewal_' + docType).show();
                $('.spinner_name_container_for_hotelrenewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('noc_fire_name_container_for_hotelrenewal', 'noc_fire_name_image_for_hotelrenewal', 'noc_fire_container_for_hotelrenewal', 'noc_fire_for_hotelrenewal');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('seal_and_stamp_name_container_for_hotelrenewal', 'seal_and_stamp_name_image_for_hotelrenewal', 'seal_and_stamp_container_for_hotelrenewal', 'seal_and_stamp_for_hotelrenewal');
                }

            }
        });
    },
    addMultipleNewEmployees: function (templateData) {
        templateData.per_cnt = tempPersonCnt;
        $('#newemployees_info_container').append(newEmployeesDetailsTemplate(templateData));
        tempPersonCnt++;
        resetCounter('display-cnt');
    },
    removeNewEmployeesInfo: function (perCnt) {
        $('#newemployees_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm: function (hotelRenewalId) {
        if (!hotelRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#hotel_renewal_id_for_hotel_renewal_form').val(hotelRenewalId);
        $('#hotel_renewal_form_pdf_form').submit();
        $('#hotel_renewal_id_for_hotel_renewal_form').val('');
    },

    downloadUploadChallan: function (hotelRenewalId) {
        if (!hotelRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + hotelRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'hotel_renewal/get_hotel_renewal_data_by_hotel_renewal_id',
            type: 'post',
            data: $.extend({}, {'hotel_renewal_id': hotelRenewalId}, getTokenData()),
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
                var hotelRenewalData = parseData.hotel_renewal_data;
                that.showChallan(hotelRenewalData);
            }
        });
    },
    showChallan: function (hotelRenewalData) {
        showPopup();
        if (hotelRenewalData.status != VALUE_FIVE && hotelRenewalData.status != VALUE_SIX && hotelRenewalData.status != VALUE_SEVEN && hotelRenewalData.status != VALUE_ELEVEN) {
            if (!hotelRenewalData.hide_submit_btn) {
                hotelRenewalData.show_fees_paid = true;
            }
        }
        if (hotelRenewalData.payment_type == VALUE_ONE) {
            hotelRenewalData.utitle = 'Fees Paid Challan Copy';
        } else {
            hotelRenewalData.style = 'display: none;';
        }
        if (hotelRenewalData.payment_type == VALUE_TWO) {
            hotelRenewalData.show_dd_po_option = true;
            hotelRenewalData.utitle = 'Demand Draft (DD)';
        }
        hotelRenewalData.module_type = VALUE_TWENTY;
        $('#popup_container').html(hotelRenewalUploadChallanTemplate(hotelRenewalData));
        loadFB(VALUE_TWENTY, hotelRenewalData.fb_data);
        loadPH(VALUE_TWENTY, hotelRenewalData.hotel_renewal_id, hotelRenewalData.ph_data);

        if (hotelRenewalData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'hotel_renewal_upload_challan', hotelRenewalData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'hotel_renewal_upload_challan', 'uc', 'radio');
            if (hotelRenewalData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_hotel_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (hotelRenewalData.challan != '') {
            $('#challan_container_for_hotel_renewal_upload_challan').hide();
            $('#challan_name_container_for_hotel_renewal_upload_challan').show();
            $('#challan_name_href_for_hotel_renewal_upload_challan').attr('href', 'documents/hotelregi/' + hotelRenewalData.challan);
            $('#challan_name_for_hotel_renewal_upload_challan').html(hotelRenewalData.challan);
        }
        if (hotelRenewalData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_hotel_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_hotel_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_hotel_renewal_upload_challan').attr('href', 'documents/hotelregi/' + hotelRenewalData.fees_paid_challan);
            $('#fees_paid_challan_name_for_hotel_renewal_upload_challan').html(hotelRenewalData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_hotel_renewal_upload_challan').attr('onclick', 'HotelRenewal.listview.removeFeesPaidChallan("' + hotelRenewalData.hotel_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (hotelRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!hotelRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'hotel_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'hotel_renewal_id': hotelRenewalId}, getTokenData()),
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
                validationMessageShow('hotel-uc', textStatus.statusText);
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
                    validationMessageShow('hotel-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-hotel-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'hotel_renewal_upload_challan');
                $('#status_' + hotelRenewalId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-hotel-uc').html('');
        validationMessageHide();
        var hotelRenewalId = $('#hotel_renewal_id_for_hotel_renewal_upload_challan').val();
        if (!hotelRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_hotel_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_hotel_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_hotel_renewal_upload_challan').focus();
                validationMessageShow('hotel-uc-fees_paid_challan_for_hotel_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_hotel_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_hotel_renewal_upload_challan').focus();
                validationMessageShow('hotel-uc-fees_paid_challan_for_hotel_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_hotel_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#hotel_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'hotel_renewal/upload_fees_paid_challan',
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
                validationMessageShow('hotel-uc', textStatus.statusText);
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
                    validationMessageShow('hotel-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + hotelRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (hotelRenewalId) {
        if (!hotelRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#hotel_renewal_id_for_certificate').val(hotelRenewalId);
        $('#hotel_renewal_certificate_pdf_form').submit();
        $('#hotel_renewal_id_for_certificate').val('');
    },
    getQueryData: function (hotelRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!hotelRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTY;
        templateData.module_id = hotelRenewalId;
        var btnObj = $('#query_btn_for_wm_' + hotelRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTY, moduleData.hotel_renewal_id);
                tmpData.applicant_name = moduleData.name_of_hotel;
                tmpData.title = 'Hotel Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getHotelData: function (btnObj) {
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
            url: 'hotel_renewal/get_hotel_data_by_id',
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
                hotelRenewalData = parseData.hotel_data;
                if (hotelRenewalData == null) {
//                    $('#hotelregi_id').val('');
//                    $('#name_of_hotel').val('');
//                    $('#name_of_proprietor').val('');
//                    $('#registration_number').val('');
//                    $('#last_valid_upto').val('');
//                    $('#fees').attr('readonly', true);
//                    $('#fees').val('');
//                    $('#mob_no').val('');
//                    $('#name_of_tourist_area').val('');
//                    // showError(licenseNoNotAvailable);
//                    $('html, body').animate({scrollTop: '0px'}, 0);
                }
                if (hotelRenewalData) {
                    $('#hotelregi_id').val(hotelRenewalData.hotelregi_id);
                    $('#name_of_hotel').val(hotelRenewalData.name_of_hotel);
                    $('#name_of_proprietor').val(hotelRenewalData.name_of_proprietor);
                    $('#registration_number').val(hotelRenewalData.registration_number);
                    var last_valid_upto = dateTo_DD_MM_YYYY(hotelRenewalData.last_valid_upto);
                    if (hotelRenewalData.last_valid_upto != '0000-00-00') {
                        $('#last_valid_upto').val(last_valid_upto);
                    } else {
                        $('#last_valid_upto').val('');
                    }
                    $('#fees').attr('readonly', true);
                    $('#fees').val(hotelRenewalData.fees);
                    $('#mob_no').val(hotelRenewalData.mob_no);
                    renderOptionsForTwoDimensionalArray(talukaArray, 'name_of_tourist_area');
                    $('#name_of_tourist_area').val(hotelRenewalData.name_of_tourist_area);
                    $('#entity_establishment_type').val(hotelRenewalData.entity_establishment_type);
                }
            }
        });
    },
    uploadDocumentForHotelRenewal: function (fileNo) {
        var that = this;
        if ($('#noc_fire_for_hotelrenewal').val() != '') {
            var nocFire = checkValidationForDocument('noc_fire_for_hotelrenewal', VALUE_ONE, 'hotelrenewal');
            if (nocFire == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_hotelrenewal').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_hotelrenewal', VALUE_TWO, 'hotelrenewal');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_hotelrenewal_' + fileNo).hide();
        $('.spinner_name_container_for_hotelrenewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var hotelrenewalId = $('#hotel_renewal_id').val();
        var formData = new FormData($('#hotel_renewal_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("hotel_renewal_id", hotelrenewalId);
        $.ajax({
            type: 'POST',
            url: 'hotel_renewal/upload_hotel_renewal_document',
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
                $('.spinner_container_for_hotelrenewal_' + fileNo).show();
                $('.spinner_name_container_for_hotelrenewal_' + fileNo).hide();
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
                    $('.spinner_container_for_hotelrenewal_' + fileNo).show();
                    $('.spinner_name_container_for_hotelrenewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_hotelrenewal_' + fileNo).hide();
                $('.spinner_name_container_for_hotelrenewal_' + fileNo).show();
                $('#hotel_renewal_id').val(parseData.hotel_renewal_id);
                var hotelRenewalData = parseData.hotel_renewal_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('noc_fire_container_for_hotelrenewal', 'noc_fire_name_image_for_hotelrenewal', 'noc_fire_name_container_for_hotelrenewal',
                            'noc_fire_download', 'noc_fire_remove_btn', hotelRenewalData.noc_fire, parseData.hotel_renewal_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('seal_and_stamp_container_for_hotelrenewal', 'seal_and_stamp_name_image_for_hotelrenewal', 'seal_and_stamp_name_container_for_hotelrenewal',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', hotelRenewalData.signature, parseData.hotel_renewal_id, VALUE_TWO);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/hotelregi/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/hotelregi/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'HotelRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
