var propertyListTemplate = Handlebars.compile($('#property_list_template').html());
var propertyTableTemplate = Handlebars.compile($('#property_table_template').html());
var propertyActionTemplate = Handlebars.compile($('#property_action_template').html());
var propertyFormTemplate = Handlebars.compile($('#property_form_template').html());
var propertyViewTemplate = Handlebars.compile($('#property_view_template').html());
var propertyUploadChallanTemplate = Handlebars.compile($('#property_upload_challan_template').html());

var appointmentFormTemplate = Handlebars.compile($('#appointment_form_template').html());
var AppointmentViewTemplate = Handlebars.compile($('#appointment_view_template').html());
var appointmentSlipTemplate = Handlebars.compile($('#appointment_slip_template').html());


var tempDetailCnt = 1;
var tempEquipCnt = 1;
var tempShareCnt = 1;

var Property = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Property.Router = Backbone.Router.extend({
    routes: {
        'property': 'renderList',
        'property_form': 'renderListForForm',
        'edit_property_form': 'renderList',
        'view_property_form': 'renderList',
        'appointment_form/:id': 'renderList',

    },
    renderList: function () {
        Property.listview.listPage();
    },
    renderListForForm: function () {
        Property.listview.listPagePropertyForm();
    }
});
Property.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="pancard_all_parties"]': 'hasPanCard',
    },
    hasPanCard: function (event) {
        var val = $('input[name=pancard_all_parties]:checked').val();
        if (val === '1') {
            this.$('.pancard_all_parties_div').show();
        } else {
            this.$('.pancard_all_parties_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        Home.listview.listPage();
        return false;
        activeLink('menu_dept_services');
//        addClass('property', 'active');
        Property.router.navigate('property');
        var templateData = {};
        this.$el.html(propertyListTemplate(templateData));
        this.loadPropertyData(sDistrict, sStatus);

    },
    listPagePropertyForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('property', 'active');
        this.$el.html(propertyListTemplate);
        this.newPropertyForm(false, {});
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
                rowData.ADMIN_PROPERTY_DOC_PATH = ADMIN_PROPERTY_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return propertyActionTemplate(rowData);
    },
    loadPropertyData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTYONE, data);
        };
        var that = this;
        Property.router.navigate('property');
        $('#property_form_and_datatable_container').html(propertyTableTemplate(searchData));
        propertyDataTable = $('#property_datatable').DataTable({
            ajax: {url: 'property/get_property_data', dataSrc: "property_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'property_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'party_name', 'class': 'text-center'},
                {data: 'party_address', 'class': 'text-center'},
                {data: 'digit_mobile_number', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'property_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'property_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#property_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = propertyDataTable.row(tr);

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
    newPropertyForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.property_data;
            Property.router.navigate('edit_property_form');
        } else {
            var formData = {};
            Property.router.navigate('property_form');
        }
        var templateData = {};
        tempShareCnt = 1;
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_FIVE = VALUE_FIVE;
        templateData.VALUE_SIX = VALUE_SIX;
        templateData.VALUE_SEVEN = VALUE_SEVEN;

        // templateData.VALUE_ONE = date_one;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.property_data = parseData.property_data;

        if (isEdit) {
            templateData.application_date = dateTo_DD_MM_YYYY(templateData.property_data.application_date);
            templateData.appointment_date = dateTo_DD_MM_YYYY(templateData.property_data.appointment_date);
        } else {
            templateData.application_date = dateTo_DD_MM_YYYY();
        }


        $('#property_form_and_datatable_container').html(propertyFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        generateBoxes('radio', partyTypeArray, 'party_type', 'property_data', formData.party_type, false);

        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#document_type').val(formData.document_type);
            $('#select_time').val(formData.select_time);


            if (formData.pancard_all_parties == isChecked) {
                $('#pancard_all_parties').attr('checked', 'checked');
                this.$('.pancard_all_parties_div').show();
            }

            if (formData.pan_card != '') {
                that.showDocument('pan_card_container_for_property', 'pan_card_name_image_for_property', 'pan_card_name_container_for_property',
                        'pan_card_download', 'pan_card', formData.pan_card, formData.property_id, VALUE_ONE);
            }
            if (formData.aadhaar_card != '') {
                that.showDocument('aadhaar_card_container_for_property', 'aadhaar_card_name_image_for_property', 'aadhaar_card_name_container_for_property',
                        'aadhaar_card_download', 'aadhaar_card', formData.aadhaar_card, formData.property_id, VALUE_TWO);
            }
        }
        generateSelect2();
        datePicker();
        $('#property_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitProperty($('#submit_btn_for_property'));
            }
        });
    },

    appointmentForm: function (appointmentData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        Property.router.navigate('appointment_form/' + appointmentData.encrypt_id);
        tempShareCnt = 1;
        appointmentData.is_checked = isChecked;
        appointmentData.VALUE_ONE = VALUE_ONE;
        appointmentData.VALUE_TWO = VALUE_TWO;
        appointmentData.VALUE_THREE = VALUE_THREE;
        appointmentData.VALUE_FOUR = VALUE_FOUR;
        appointmentData.VALUE_FIVE = VALUE_FIVE;
        appointmentData.VALUE_SIX = VALUE_SIX;
        appointmentData.VALUE_SEVEN = VALUE_SEVEN;
        appointmentData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;

        $('#property_form_and_datatable_container').html(appointmentFormTemplate(appointmentData));
        $('#select_time').val(appointmentData.select_time);

        generateBoxes('radio', appointmentData.dates_array, 'appointment_date', 'appointment', appointmentData.appointment_date, true);


        datePicker();
        $('#appointment_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },
    editOrViewProperty: function (btnObj, propertyId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!propertyId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'property/get_property_data_by_id',
            type: 'post',
            data: $.extend({}, {'property_id': propertyId}, getTokenData()),
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
                    that.newPropertyForm(isEdit, parseData);
                } else {
                    that.viewPropertyForm(parseData);
                }
            }
        });
    },

    editOrViewAppointment: function (btnObj, propertyId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!propertyId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'property/get_appointment_data_by_id',
            type: 'post',
            data: $.extend({}, {'property_id': propertyId}, getTokenData()),
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
                $('#property_id').val(parseData.encrypt_id);
                if (isEdit) {
                    that.appointmentForm(parseData.appointment_data);
                } else {
                    that.viewAppointmentForm(parseData);
                }
            }
        });
    },
    viewPropertyForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        tempShareCnt = 1;
        var formData = parseData.property_data;
        Property.router.navigate('view_property_form');
        formData.appointment_date = dateTo_DD_MM_YYYY(formData.appointment_date);
        formData.application_date = dateTo_DD_MM_YYYY(formData.application_date);
        formData.is_checked = isChecked;
        formData.VALUE_ONE = VALUE_ONE;
        formData.VALUE_TWO = VALUE_TWO;
        formData.VALUE_THREE = VALUE_THREE;
        formData.VALUE_FOUR = VALUE_FOUR;
        formData.VALUE_FIVE = VALUE_FIVE;
        formData.VALUE_SIX = VALUE_SIX;
        formData.VALUE_SEVEN = VALUE_SEVEN;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#property_form_and_datatable_container').html(propertyViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');

        generateBoxes('radio', partyTypeArray, 'party_type', 'property_data', formData.party_type, false);

        $('#document_type').val(formData.document_type);
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.pancard_all_parties == isChecked) {
            $('#pancard_all_parties').attr('checked', 'checked');
            this.$('.pancard_all_parties_div').show();
        }


        if (formData.pan_card != '') {
            that.showDocument('pan_card_container_for_property', 'pan_card_name_image_for_property', 'pan_card_name_container_for_property',
                    'pan_card_download', 'pan_card', formData.pan_card);
        }
        if (formData.aadhaar_card != '') {
            that.showDocument('aadhaar_card_container_for_property', 'aadhaar_card_name_image_for_property', 'aadhaar_card_name_container_for_property',
                    'aadhaar_card_download', 'aadhaar_card', formData.aadhaar_card);
        }

    },

    viewAppointmentForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        // tempShareCnt = 1;
        var formData = parseData.appointment_data;
        Property.router.navigate('view_property_form');
        formData.is_checked = isChecked;
        // alert(VALUE_ONE);
        formData.date_one = VALUE_ONE;
        formData.VALUE_ONE = VALUE_ONE;
        formData.date_two = VALUE_TWO;
        formData.VALUE_TWO = VALUE_TWO;
        formData.VALUE_THREE = VALUE_THREE;
        formData.VALUE_FOUR = VALUE_FOUR;
        formData.VALUE_FIVE = VALUE_FIVE;
        formData.VALUE_SIX = VALUE_SIX;
        formData.VALUE_SEVEN = VALUE_SEVEN;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#property_form_and_datatable_container').html(AppointmentViewTemplate(formData));

        $('#select_time').val(formData.select_time);

        $('#appointment_date').val(formData.appointment_date);
    },
    checkValidationForProperty: function (propertyData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!propertyData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!propertyData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!propertyData.party_type_for_property_data) {
            return getBasicMessageAndFieldJSONArray('party_type_for_property_data', partyTypeNameValidationMessage);
        }
        if (!propertyData.document_type) {
            return getBasicMessageAndFieldJSONArray('document_type', documentTypeValidationMessage);
        }
        if (!propertyData.party_name) {
            return getBasicMessageAndFieldJSONArray('party_name', partyNameValidationMessage);
        }
        if (!propertyData.party_address) {
            return getBasicMessageAndFieldJSONArray('party_address', partyAddressNameValidationMessage);
        }
        if (!propertyData.digit_mobile_number) {
            return getBasicMessageAndFieldJSONArray('digit_mobile_number', mobileValidationMessage);
        }
        if (!propertyData.email) {
            return getBasicMessageAndFieldJSONArray('email', emailValidationMessage);
        }
        if (!propertyData.document) {
            return getBasicMessageAndFieldJSONArray('document', propertyDescriptionValidationMessage);
        }

        return '';
    },
    submitProperty: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var propertyData = $('#property_form').serializeFormJSON();
        var validationData = that.checkValidationForProperty(propertyData);
        if (validationData != '') {

            $('#' + validationData.field).focus();
            validationMessageShow('property-' + validationData.field, validationData.message);
            return false;
        }

        //     if (propertyData.pancard_all_parties == isChecked) {
        //      if ($('#pan_card_container_for_property').is(':visible')) {
        //         var pancard = $('#pan_card_for_property').val();
        //         if (pancard == '') {
        //             $('#pan_card_for_property').focus();
        //             validationMessageShow('property-pan_card_for_property', uploadDocumentValidationMessage);
        //             return false;
        //         }
        //         var pancardMessage = imagefileUploadValidation('pan_card_for_property',2048);
        //         if (pancardMessage != '') {
        //             $('#pan_card_for_property').focus();
        //             validationMessageShow('property-pan_card_for_property', pancardMessage);
        //             return false;
        //         }
        //     }
        // }

        //     if ($('#aadhaar_card_container_for_property').is(':visible')) {
        //         var aadhaar = $('#aadhaar_card_for_property').val();
        //         if (aadhaar == '') {
        //             $('#aadhaar_card_for_property').focus();
        //             validationMessageShow('property-aadhaar_card_for_property', uploadDocumentValidationMessage);
        //             return false;
        //         }
        //         var aadhaarMessage = imagefileUploadValidation('aadhaar_card_for_property',2048);
        //         if (aadhaarMessage != '') {
        //             $('#aadhaar_card_for_property').focus();
        //             validationMessageShow('property-aadhaar_card_for_property', aadhaarMessage);
        //             return false;
        //         }
        //     }

        if ($('#pan_card_container_for_property').is(':visible')) {
            var panCard = checkValidationForDocument('pan_card_for_property', VALUE_TWO, 'property');
            if (panCard == false) {
                return false;
            }
        }

        if ($('#aadhaar_card_container_for_property').is(':visible')) {
            var aadhaarCard = checkValidationForDocument('aadhaar_card_for_property', VALUE_TWO, 'property');
            if (aadhaarCard == false) {
                return false;
            }
        }

        //var btnObj = moduleType == VALUE_ONE ? $('#submit_btn_for_single_return') : $('#submit_btn_for_property');
        var btnObj = $('#submit_btn_for_property');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var propertyData = new FormData($('#property_form')[0]);
        propertyData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        // propertyData.append("proprietor_share_data", JSON.stringify(proprietorShareInfoItem));
        propertyData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'property/submit_property',
            data: propertyData,
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
                validationMessageShow('property', textStatus.statusText);
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
                    validationMessageShow('property', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#property_id').val(parseData.encrypt_id);
                that.appointmentForm(parseData.appointment_data);

                //console.log(parseData.dates_array);
            }
        });
    },

    askForSubmitProperty: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Property.listview.submitAppointment(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    checkValidationForAppointment: function (appointmentData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        //  var appointment_date = $('input[name=appointment_date]:checked').val();
        // if(!appointmentData.appointment_date_for_appointment){
        //      return getBasicMessageAndFieldJSONArray('appointment_date',appoinmentdateValidation);
        //  }
        if (!appointmentData.appointment_date_for_appointment) {
            return getBasicMessageAndFieldJSONArray('appointment_date_for_appointment', appoinmentdateValidation);
        }
        if (!appointmentData.select_time) {
            return getBasicMessageAndFieldJSONArray('select_time', selectTimeValidationMessage);
        }

        return '';
    },
    submitAppointment: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var appointmentData = $('#appointment_form').serializeFormJSON();
        var validationData = that.checkValidationForAppointment(appointmentData);
        if (validationData != '') {
            //  $('#' + validationData.field).focus();
            validationMessageShow('appointment-' + validationData.field, validationData.message);
            return false;
        }

        //var btnObj = moduleType == VALUE_ONE ? $('#submit_btn_for_single_return') : $('#submit_btn_for_property');
        var btnObj = $('#submit_btn_for_appointment_form');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var appointmentData = new FormData($('#appointment_form')[0]);
        appointmentData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        appointmentData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'property/submit_appointment',
            data: appointmentData,
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
                validationMessageShow('property', textStatus.statusText);
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
                    validationMessageShow('property', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Property.router.navigate('property', {'trigger': true});
                if (moduleType == VALUE_TWO)
                {
                    // Property.router.navigate('property', {'trigger': true});
                    that.showAppointmentSlip(parseData);
                }

            }
        });
    },
    showAppointmentSlip: function (parseData)
    {
        // console.log(parseData);
        var templateData = {};
        templateData.appointment_data = parseData.appointment_data;
        templateData.property_data = parseData.property_data;
        $('#model_title').html('Appointment Slip');
        $('#model_body').html(appointmentSlipTemplate(templateData));
        $('#popup_modal').modal('show');

    },

    askForRemove: function (propertyId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!propertyId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Property.listview.removeDocument(\'' + propertyId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (propertyId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!propertyId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_property_' + docType).hide();
        $('.spinner_name_container_for_property_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'property/remove_document',
            data: $.extend({}, {'property_id': propertyId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_property_' + docType).hide();
                $('.spinner_name_container_for_property_' + docType).show();
                validationMessageShow('property', textStatus.statusText);
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
                    validationMessageShow('property', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_property_' + docType).show();
                $('.spinner_name_container_for_property_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('pan_card_name_container_for_property', 'pan_card_name_image_for_property', 'pan_card_container_for_property', 'pan_card_for_property');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('aadhaar_card_name_container_for_property', 'aadhaar_card_name_image_for_property', 'aadhaar_card_container_for_property', 'aadhaar_card_for_property');
                }
            }
        });
    },

    generateForm1: function (incentiveId) {
        if (!incentiveId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#property_id_for_property_form1').val(incentiveId);
        $('#property_form1_pdf_form').submit();
        $('#property_id_for_property_form1').val('');
    },

    downloadUploadChallan: function (propertyId) {
        if (!propertyId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + propertyId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'property/get_property_data_by_property_id',
            type: 'post',
            data: $.extend({}, {'property_id': propertyId}, getTokenData()),
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
                var propertyData = parseData.property_data;
                that.showChallan(propertyData);
            }
        });
    },
    showChallan: function (propertyData) {
        showPopup();
        if (propertyData.status != VALUE_FIVE && propertyData.status != VALUE_SIX && propertyData.status != VALUE_SEVEN) {
            if (!propertyData.hide_submit_btn) {
                propertyData.show_fees_paid = true;
            }
        }
        if (propertyData.payment_type == VALUE_ONE) {
            propertyData.utitle = 'Fees Paid Challan Copy';
        } else {
            propertyData.style = 'display: none;';
        }
        if (propertyData.payment_type == VALUE_TWO) {
            propertyData.show_dd_po_option = true;
            propertyData.utitle = 'Demand Draft (DD)';
        }
        propertyData.module_type = VALUE_TWENTYONE;
        $('#popup_container').html(propertyUploadChallanTemplate(propertyData));
        loadFB(VALUE_TWENTYONE, propertyData.fb_data);
        loadPH(VALUE_TWENTYONE, propertyData.property_id, propertyData.ph_data);

        if (propertyData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'property_upload_challan', propertyData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'property_upload_challan', 'uc', 'radio');
            if (propertyData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_property_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }

        if (propertyData.challan != '') {
            $('#challan_container_for_property_upload_challan').hide();
            $('#challan_name_container_for_property_upload_challan').show();
            $('#challan_name_href_for_property_upload_challan').attr('href', 'documents/property/' + propertyData.challan);
            $('#challan_name_for_property_upload_challan').html(propertyData.challan);
        }
        if (propertyData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_property_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_property_upload_challan').show();
            $('#fees_paid_challan_name_href_for_property_upload_challan').attr('href', 'documents/property/' + propertyData.fees_paid_challan);
            $('#fees_paid_challan_name_for_property_upload_challan').html(propertyData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_property_upload_challan').attr('onclick', 'Property.listview.removeFeesPaidChallan("' + propertyData.property_id + '")');
        }
    },
    removeFeesPaidChallan: function (propertyId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!propertyId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'property/remove_fees_paid_challan',
            data: $.extend({}, {'property_id': propertyId}, getTokenData()),
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
                validationMessageShow('property-uc', textStatus.statusText);
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
                    validationMessageShow('property-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-property-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'property_upload_challan');
                $('#status_' + propertyId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-property-uc').html('');
        validationMessageHide();
        var propertyId = $('#property_id_for_property_upload_challan').val();
        if (!propertyId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_property_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_property_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_property_upload_challan').focus();
                validationMessageShow('property-uc-fees_paid_challan_for_property_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_property_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_property_upload_challan').focus();
                validationMessageShow('property-uc-fees_paid_challan_for_property_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_property_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#property_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'property/upload_fees_paid_challan',
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
                validationMessageShow('property-uc', textStatus.statusText);
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
                    validationMessageShow('property-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + propertyId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (propertyId) {
        if (!propertyId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#property_id_for_certificate').val(propertyId);
        $('#property_certificate_pdf_form').submit();
        $('#property_id_for_certificate').val('');
    },

    getQueryData: function (propertyId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!propertyId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTYONE;
        templateData.module_id = propertyId;
        var btnObj = $('#query_btn_for_ms_' + propertyId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTYONE, moduleData.property_id);
                tmpData.applicant_name = moduleData.enterprise_name;
                tmpData.title = 'Enterprise Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForProperty: function (fileNo) {
        var that = this;
        if ($('#pan_card_for_property').val() != '') {
            var panCard = checkValidationForDocument('pan_card_for_property', VALUE_TWO, 'property');
            if (panCard == false) {
                return false;
            }
        }
        if ($('#aadhaar_card_for_property').val() != '') {
            var aadhaarCard = checkValidationForDocument('aadhaar_card_for_property', VALUE_TWO, 'property');
            if (aadhaarCard == false) {
                return false;
            }
        }
        $('.spinner_container_for_property_' + fileNo).hide();
        $('.spinner_name_container_for_property_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var propertyId = $('#property_id').val();
        var formData = new FormData($('#property_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("property_id", propertyId);
        $.ajax({
            type: 'POST',
            url: 'property/upload_property_document',
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
                $('.spinner_container_for_property_' + fileNo).show();
                $('.spinner_name_container_for_property_' + fileNo).hide();
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
                    $('.spinner_container_for_property_' + fileNo).show();
                    $('.spinner_name_container_for_property_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_property_' + fileNo).hide();
                $('.spinner_name_container_for_property_' + fileNo).show();
                $('#property_id').val(parseData.property_id);
                var propertyData = parseData.property_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('pan_card_container_for_property', 'pan_card_name_image_for_property', 'pan_card_name_container_for_property',
                            'pan_card_download', 'pan_card', propertyData.pan_card, parseData.property_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('aadhaar_card_container_for_property', 'aadhaar_card_name_image_for_property', 'aadhaar_card_name_container_for_property',
                            'aadhaar_card_download', 'aadhaar_card', propertyData.aadhaar_card, parseData.property_id, VALUE_TWO);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/property/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/property/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Property.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
    print_current_page: function ()
    {
        window.print();
    },
});


