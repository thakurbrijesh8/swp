var cinemaListTemplate = Handlebars.compile($('#cinema_list_template').html());
var cinemaTableTemplate = Handlebars.compile($('#cinema_table_template').html());
var cinemaActionTemplate = Handlebars.compile($('#cinema_action_template').html());
var cinemaFormTemplate = Handlebars.compile($('#cinema_form_template').html());
var cinemaViewTemplate = Handlebars.compile($('#cinema_view_template').html());
var cinemaUploadChallanTemplate = Handlebars.compile($('#cinema_upload_challan_template').html());

var tempPersonCnt = 1;

var Cinema = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Cinema.Router = Backbone.Router.extend({
    routes: {
        'cinema': 'renderList',
        'cinema_form': 'renderListForForm',
        'edit_cinema_form': 'renderList',
        'view_cinema_form': 'renderList',
    },
    renderList: function () {
        Cinema.listview.listPage();
    },
    renderListForForm: function () {
        Cinema.listview.listPageCinemaForm();
    }
});
Cinema.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="is_case_of_building"]': 'hasCaseOfBuilding',
    },
    hasCaseOfBuilding: function (event) {
        var val = $('input[name=is_case_of_building]:checked').val();
        if (val == VALUE_ONE) {
            this.$('.building_details_div').show();
        } else {
            this.$('.building_details_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        Cinema.router.navigate('cinema');
        var templateData = {};
        this.$el.html(cinemaListTemplate(templateData));
        this.loadCinemaData(sDistrict, sStatus);

    },
    listPageCinemaForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(cinemaListTemplate);
        this.newCinemaForm(false, {});
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
                rowData.ADMIN_CINEMA_DOC_PATH = ADMIN_CINEMA_DOC_PATH;
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
        return cinemaActionTemplate(rowData);
    },
    loadCinemaData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var dateRendereDOB = function (data, type, full, meta) {
            if (full.dob != '0000-00-00') {
                return dateTo_DD_MM_YYYY(full.dob);
            } else {
                return '';
            }
        };
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_EIGHT, data)
                    + getFRContainer(VALUE_EIGHT, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Cinema.router.navigate('cinema');
        $('#cinema_form_and_datatable_container').html(cinemaTableTemplate(searchData));
        cinemaDataTable = $('#cinema_datatable').DataTable({
            ajax: {url: 'Cinema/get_cinema_data', dataSrc: "cinema_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'cinema_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'father_name', 'class': 'text-center'},
                {data: 'dob', 'class': 'text-center', 'render': dateRendereDOB},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'cinema_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'cinema_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#cinema_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = cinemaDataTable.row(tr);

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
    newCinemaForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.cinema_data;
            Cinema.router.navigate('edit_cinema_form');
        } else {
            var formData = {};
            Cinema.router.navigate('cinema_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.cinema_data = parseData.cinema_data;
        if (isEdit) {
            templateData.dob = dateTo_DD_MM_YYYY(templateData.cinema_data.dob);
        }
        $('#cinema_form_and_datatable_container').html(cinemaFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            if (formData.is_case_of_building == isChecked) {
                $('#is_case_of_building').attr('checked', 'checked');
                $('.building_details_div').show();
            }
            if (formData.plan_of_building_document != '') {
                that.showDocument('plan_of_building_document_container', 'plan_of_building_document_name_image', 'plan_of_building_document_name_container',
                        'plan_of_building_document_download', 'plan_of_building_document_remove_btn', formData.plan_of_building_document, formData.cinema_id, VALUE_TWO);
            }
            if (formData.character_licence_certificate != '') {
                that.showDocument('character_licence_certificate_container', 'character_licence_certificate_name_image', 'character_licence_certificate_name_container',
                        'character_licence_certificate_download', 'character_licence_certificate_remove_btn', formData.character_licence_certificate, formData.cinema_id, VALUE_THREE);
            }
            if (formData.photo_state_copy != '') {
                that.showDocument('photo_state_copy_container', 'photo_state_copy_name_image', 'photo_state_copy_name_container',
                        'photo_state_copy_download', 'photo_state_copy_remove_btn', formData.photo_state_copy, formData.cinema_id, VALUE_FOUR);
            }            
            if (formData.ownership_document != '') {
                that.showDocument('ownership_document_container', 'ownership_document_name_image', 'ownership_document_name_container',
                        'ownership_document_download', 'ownership_document_remove_btn', formData.ownership_document, formData.cinema_id, VALUE_FIVE);
            }
            if (formData.motor_vehicles_document != '') {
                that.showDocument('motor_vehicles_document_container', 'motor_vehicles_document_name_image', 'motor_vehicles_document_name_container',
                        'motor_vehicles_document_download', 'motor_vehicles_document_remove_btn', formData.motor_vehicles_document, formData.cinema_id, VALUE_SIX);
            }
            if (formData.business_trade_authority_license != '') {
                that.showDocument('business_trade_authority_license_container', 'business_trade_authority_license_name_image', 'business_trade_authority_license_name_container',
                        'business_trade_authority_license_download', 'business_trade_authority_license_remove_btn', formData.business_trade_authority_license, formData.cinema_id, VALUE_SEVEN);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_cinema', 'seal_and_stamp_name_image_for_cinema', 'seal_and_stamp_name_container_for_cinema',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.cinema_id, VALUE_EIGHT);
            }
        }
        generateSelect2();
        datePicker();
        $('#cinema_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitCinema($('#submit_btn_for_cinema'));
            }
        });
    },
    editOrViewCinema: function (btnObj, cinemaId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!cinemaId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'Cinema/get_cinema_data_by_id',
            type: 'post',
            data: $.extend({}, {'cinema_id': cinemaId}, getTokenData()),
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
                    that.newCinemaForm(isEdit, parseData);
                } else {
                    that.viewCinemaForm(parseData);
                }
            }
        });
    },
    viewCinemaForm: function (parseData, isPrint) {
		var that = this;
        var templateData = {};       
		if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
		 var formData = parseData.cinema_data;
		 Cinema.router.navigate('view_cinema_form');
		 formData.title = 'View'
		 formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
         formData.VALUE_TWO = VALUE_TWO;
         formData.VALUE_THREE = VALUE_THREE;
         formData.VALUE_FOUR = VALUE_FOUR;
         formData.VALUE_FIVE = VALUE_FIVE;
         formData.VALUE_SEVEN = VALUE_SEVEN;
         formData.VALUE_SIX = VALUE_SIX;
         formData.VALUE_EIGHT = VALUE_EIGHT;
         formData.application_number = regNoRenderer(VALUE_ONE, formData.cinema_id);
		 formData.district_text = talukaArray[formData.district] ? talukaArray[formData.district] : '';
         formData.entity_establishment_type = entityEstablishmentTypeArray[formData.entity_establishment_type] ? entityEstablishmentTypeArray[formData.entity_establishment_type] : '';
         formData.dob = dateTo_DD_MM_YYYY(formData.dob);
         if (formData.dob == 'NaN-NaN-NaN') {
            formData.dob = '';
         }
		 $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        if (formData.is_case_of_building == isChecked) {
            formData.show_bd_div = true;
        }
        formData.show_plan_of_building_document = formData.plan_of_building_document != '' ? true : false;
        formData.show_character_licence_certificate = formData.character_licence_certificate != '' ? true : false;
        formData.show_photo_state_copy = formData.photo_state_copy != '' ? true : false;    
        formData.show_ownership_document = formData.ownership_document != '' ? true : false; 
        formData.show_motor_vehicles_document = formData.motor_vehicles_document != '' ? true : false;  
        formData.show_business_trade_authority_license = formData.business_trade_authority_license != '' ? true : false; 
        formData.show_signature_cinema = formData.signature != '' ? true : false; 
          
        
		 showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(cinemaViewTemplate(formData));
        if (formData.is_case_of_building == isChecked) {
            $('#is_case_of_building').attr('checked', 'checked');
            $('.building_details_div').show();
         }           
		if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_icview').click();
            }, 500);
        }
    },
    checkValidationForCinema: function (cinemaData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!cinemaData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!cinemaData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!cinemaData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!cinemaData.father_name) {
            return getBasicMessageAndFieldJSONArray('father_name', fatherNameValidationMessage);
        }
        if (!cinemaData.dob) {
            return getBasicMessageAndFieldJSONArray('dob', dobValidationMessage);
        }
        if (!cinemaData.permanent_address) {
            return getBasicMessageAndFieldJSONArray('permanent_address', permanentAddressValidationMessage);
        }
        if (!cinemaData.temporary_address) {
            return getBasicMessageAndFieldJSONArray('temporary_address', temporaryAddressValidationMessage);
        }
        if (!cinemaData.video_cassette_recorder) {
            return getBasicMessageAndFieldJSONArray('video_cassette_recorder', videoCassetteRecorderLinkValidationMessage);
        }
        if (cinemaData.is_case_of_building == isChecked) {
            cinemaData.is_case_of_building == isChecked;
            if (!cinemaData.name_of_building) {
                return getBasicMessageAndFieldJSONArray('name_of_building', nameOfBuildingValidationMessage);
            }
            if (!cinemaData.place_of_building) {
                return getBasicMessageAndFieldJSONArray('place_of_building', placeOfBuildingValidationMessage);
            }
            if (!cinemaData.distance_of_building) {
                return getBasicMessageAndFieldJSONArray('distance_of_building', distanceOfBuildingValidationMessage);
            }
        }
        if (!cinemaData.tb_license_affected) {
            return getBasicMessageAndFieldJSONArray('tb_license_affected', tbLicenseAffectedValidationMessage);
        }
        if (!cinemaData.building_as) {
            return getBasicMessageAndFieldJSONArray('building_as', buildingASValidationMessage);
        }
        if (!cinemaData.auditorium_as) {
            return getBasicMessageAndFieldJSONArray('auditorium_as', auditoriumASValidationMessage);
        }
        if (!cinemaData.passages_and_gangways_as) {
            return getBasicMessageAndFieldJSONArray('passages_and_gangways_as', passagesAndGangwaysASValidationMessage);
        }
        if (!cinemaData.urinals_and_wc_as) {
            return getBasicMessageAndFieldJSONArray('urinals_and_wc_as', urinalsAndWcASValidationMessage);
        }
        if (!cinemaData.time_schedule_film) {
            return getBasicMessageAndFieldJSONArray('time_schedule_film', timeScheduleFilmValidationMessage);
        }
        if (!cinemaData.screen_width) {
            return getBasicMessageAndFieldJSONArray('screen_width', screenWidthValidationMessage);
        }
        return '';
    },
    askForSubmitCinema: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Cinema.listview.submitCinema(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitCinema: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var cinemaData = $('#cinema_form').serializeFormJSON();
        var validationData = that.checkValidationForCinema(cinemaData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('cinema-' + validationData.field, validationData.message);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }
        if ($('#is_case_of_building').is(':checked')) {
            if ($('#plan_of_building_document_container').is(':visible')) {
                var planOfBuildingDocument = checkValidationForDocument('plan_of_building_document', VALUE_ONE, 'cinema');
                if (planOfBuildingDocument == false) {
                    return false;
                }
            }
            if ($('#character_licence_certificate_container').is(':visible')) {
                var characterLicenceCertificate = checkValidationForDocument('character_licence_certificate', VALUE_ONE, 'cinema');
                if (characterLicenceCertificate == false) {
                    return false;
                }
            }
            if ($('#photo_state_copy_container').is(':visible')) {
                var photoStateCopy = checkValidationForDocument('photo_state_copy', VALUE_ONE, 'cinema');
                if (photoStateCopy == false) {
                    return false;
                }
            }
            if ($('#ownership_document_container').is(':visible')) {
                var ownershipDocument = checkValidationForDocument('ownership_document', VALUE_ONE, 'cinema');
                if (ownershipDocument == false) {
                    return false;
                }
            }

            if ($('#motor_vehicles_document_container').is(':visible')) {
                var motorVehiclesDocument = checkValidationForDocument('motor_vehicles_document', VALUE_ONE, 'cinema');
                if (motorVehiclesDocument == false) {
                    return false;
                }
            }
        }

        if ($('#business_trade_authority_license_container').is(':visible')) {
            var businessTradeAuthorityLicense = checkValidationForDocument('business_trade_authority_license', VALUE_ONE, 'cinema');
            if (businessTradeAuthorityLicense == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_cinema').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_cinema', VALUE_TWO, 'cinema');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_cinema') : $('#submit_btn_for_cinema');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var cinemaData = new FormData($('#cinema_form')[0]);
        cinemaData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        cinemaData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'Cinema/submit_cinema',
            data: cinemaData,
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
                validationMessageShow('cinema', textStatus.statusText);
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
                    validationMessageShow('cinema', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Cinema.router.navigate('cinema', {'trigger': true});
            }
        });
    },

    askForRemove: function (cinemaId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!cinemaId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Cinema.listview.removeDocument(\'' + cinemaId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (cinemaId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!cinemaId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_cinema_' + docType).hide();
        $('.spinner_name_container_for_cinema_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'Cinema/remove_document',
            data: $.extend({}, {'cinema_id': cinemaId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_cinema_' + docType).hide();
                $('.spinner_name_container_for_cinema_' + docType).show();
                validationMessageShow('cinema', textStatus.statusText);
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
                    validationMessageShow('cinema', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_cinema_' + docType).show();
                $('.spinner_name_container_for_cinema_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_TWO) {
                    removeDocumentValue('plan_of_building_document_name_container', 'plan_of_building_document_name_image', 'plan_of_building_document_container', 'plan_of_building_document');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('character_licence_certificate_name_container', 'character_licence_certificate_name_image', 'character_licence_certificate_container', 'character_licence_certificate');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('photo_state_copy_name_container', 'photo_state_copy_name_image', 'photo_state_copy_container', 'photo_state_copy');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('ownership_document_name_container', 'ownership_document_name_image', 'ownership_document_container', 'ownership_document');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('motor_vehicles_document_name_container', 'motor_vehicles_document_name_image', 'motor_vehicles_document_container', 'motor_vehicles_document');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('business_trade_authority_license_name_container', 'business_trade_authority_license_name_image', 'business_trade_authority_license_container', 'business_trade_authority_license');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('seal_and_stamp_name_container_for_cinema', 'seal_and_stamp_name_image_for_cinema', 'seal_and_stamp_container_for_cinema', 'seal_and_stamp_for_cinema');
                }
            }
        });
    },
    generateForm1: function (cinemaId) {
        if (!cinemaId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#cinema_id_for_cinema_form1').val(cinemaId);
        $('#cinema_form1_pdf_form').submit();
        $('#cinema_id_for_cinema_form1').val('');
    },

    downloadUploadChallan: function (cinemaId) {
        if (!cinemaId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + cinemaId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'Cinema/get_cinema_data_by_cinema_id',
            type: 'post',
            data: $.extend({}, {'cinema_id': cinemaId}, getTokenData()),
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
                var cinemaData = parseData.cinema_data;
                that.showChallan(cinemaData);
            }
        });
    },
    showChallan: function (cinemaData) {
        showPopup();
        if (cinemaData.status != VALUE_FIVE && cinemaData.status != VALUE_SIX && cinemaData.status != VALUE_SEVEN && cinemaData.status != VALUE_ELEVEN) {
            if (!cinemaData.hide_submit_btn) {
                cinemaData.show_fees_paid = true;
            }
        }
        if (cinemaData.payment_type == VALUE_ONE) {
            cinemaData.utitle = 'Fees Paid Challan Copy';
        } else {
            cinemaData.style = 'display: none;';
        }
        if (cinemaData.payment_type == VALUE_TWO) {
            cinemaData.show_dd_po_option = true;
            cinemaData.utitle = 'Demand Draft (DD)';
        }
        cinemaData.module_type = VALUE_EIGHT;
        $('#popup_container').html(cinemaUploadChallanTemplate(cinemaData));
        loadFB(VALUE_EIGHT, cinemaData.fb_data);
        loadPH(VALUE_EIGHT, cinemaData.cinema_id, cinemaData.ph_data);

        if (cinemaData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'cinema_upload_challan', cinemaData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'cinema_upload_challan', 'uc', 'radio');
            if (cinemaData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_cinema_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (cinemaData.challan != '') {
            $('#challan_container_for_cinema_upload_challan').hide();
            $('#challan_name_container_for_cinema_upload_challan').show();
            $('#challan_name_href_for_cinema_upload_challan').attr('href', 'documents/cinema/' + cinemaData.challan);
            $('#challan_name_for_cinema_upload_challan').html(cinemaData.challan);
        }
        if (cinemaData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_cinema_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_cinema_upload_challan').show();
            $('#fees_paid_challan_name_href_for_cinema_upload_challan').attr('href', 'documents/cinema/' + cinemaData.fees_paid_challan);
            $('#fees_paid_challan_name_for_cinema_upload_challan').html(cinemaData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_cinema_upload_challan').attr('onclick', 'Cinema.listview.removeFeesPaidChallan("' + cinemaData.cinema_id + '")');
        }
    },
    removeFeesPaidChallan: function (cinemaId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!cinemaId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'Cinema/remove_fees_paid_challan',
            data: $.extend({}, {'cinema_id': cinemaId}, getTokenData()),
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
                validationMessageShow('cinema-uc', textStatus.statusText);
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
                    validationMessageShow('cinema-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-cinema-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'cinema_upload_challan');
                $('#status_' + cinemaId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-cinema-uc').html('');
        validationMessageHide();
        var cinemaId = $('#cinema_id_for_cinema_upload_challan').val();
        if (!cinemaId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_cinema_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_cinema_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_cinema_upload_challan').focus();
                validationMessageShow('cinema-uc-fees_paid_challan_for_cinema_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_cinema_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_cinema_upload_challan').focus();
                validationMessageShow('cinema-uc-fees_paid_challan_for_cinema_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_cinema_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#cinema_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'Cinema/upload_fees_paid_challan',
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
                validationMessageShow('cinema-uc', textStatus.statusText);
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
                    validationMessageShow('cinema-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + cinemaId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (cinemaId) {
        if (!cinemaId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#cinema_id_for_certificate').val(cinemaId);
        $('#cinema_certificate_pdf_form').submit();
        $('#cinema_id_for_certificate').val('');
    },
    getQueryData: function (cinemaId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!cinemaId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_EIGHT;
        templateData.module_id = cinemaId;
        var btnObj = $('#query_btn_for_cinema_' + cinemaId);
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
                tmpData.application_number = regNoRenderer(VALUE_EIGHT, moduleData.cinema_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForCinema: function (fileNo) {
        var that = this;
        if ($('#plan_of_building_document').val() != '') {
            var planOfBuildingDocument = checkValidationForDocument('plan_of_building_document', VALUE_ONE, 'cinema');
            if (planOfBuildingDocument == false) {
                return false;
            }
        }
        if ($('#character_licence_certificate').val() != '') {
            var characterLicenceCertificate = checkValidationForDocument('character_licence_certificate', VALUE_ONE, 'cinema');
            if (characterLicenceCertificate == false) {
                return false;
            }
        }
        if ($('#photo_state_copy').val() != '') {
            var photoStateCopy = checkValidationForDocument('photo_state_copy', VALUE_ONE, 'cinema');
            if (photoStateCopy == false) {
                return false;
            }
        }
        if ($('#ownership_document').val() != '') {
            var ownershipDocument = checkValidationForDocument('ownership_document', VALUE_ONE, 'cinema');
            if (ownershipDocument == false) {
                return false;
            }
        }
        if ($('#motor_vehicles_document').val() != '') {
            var motorVehiclesDocument = checkValidationForDocument('motor_vehicles_document', VALUE_ONE, 'cinema');
            if (motorVehiclesDocument == false) {
                return false;
            }
        }
        if ($('#business_trade_authority_license').val() != '') {
            var businessTradeAuthorityLicense = checkValidationForDocument('business_trade_authority_license', VALUE_ONE, 'cinema');
            if (businessTradeAuthorityLicense == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_cinema').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_cinema', VALUE_TWO, 'cinema');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_cinema_' + fileNo).hide();
        $('.spinner_name_container_for_cinema_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var cinemaId = $('#cinema_id').val();
        var formData = new FormData($('#cinema_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("cinema_id", cinemaId);
        $.ajax({
            type: 'POST',
            url: 'cinema/upload_cinema_document',
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
                $('.spinner_container_for_cinema_' + fileNo).show();
                $('.spinner_name_container_for_cinema_' + fileNo).hide();
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
                    $('.spinner_container_for_cinema_' + fileNo).show();
                    $('.spinner_name_container_for_cinema_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_cinema_' + fileNo).hide();
                $('.spinner_name_container_for_cinema_' + fileNo).show();
                $('#cinema_id').val(parseData.cinema_id);
                var cinemaData = parseData.cinema_data;

                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('plan_of_building_document_container', 'plan_of_building_document_name_image', 'plan_of_building_document_name_container',
                            'plan_of_building_document_download', 'plan_of_building_document_remove_btn', cinemaData.plan_of_building_document, parseData.cinema_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('character_licence_certificate_container', 'character_licence_certificate_name_image', 'character_licence_certificate_name_container',
                            'character_licence_certificate_download', 'character_licence_certificate_remove_btn', cinemaData.character_licence_certificate, parseData.cinema_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('photo_state_copy_container', 'photo_state_copy_name_image', 'photo_state_copy_name_container',
                            'photo_state_copy_download', 'photo_state_copy_remove_btn', cinemaData.photo_state_copy, parseData.cinema_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('ownership_document_container', 'ownership_document_name_image', 'ownership_document_name_container',
                            'ownership_document_download', 'ownership_document_remove_btn', cinemaData.ownership_document, parseData.cinema_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('motor_vehicles_document_container', 'motor_vehicles_document_name_image', 'motor_vehicles_document_name_container',
                            'motor_vehicles_document_download', 'motor_vehicles_document_remove_btn', cinemaData.motor_vehicles_document, parseData.cinema_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('business_trade_authority_license_container', 'business_trade_authority_license_name_image', 'business_trade_authority_license_name_container',
                            'business_trade_authority_license_download', 'business_trade_authority_license_remove_btn', cinemaData.business_trade_authority_license, parseData.cinema_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('seal_and_stamp_container_for_cinema', 'seal_and_stamp_name_image_for_cinema', 'seal_and_stamp_name_container_for_cinema',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', cinemaData.signature, parseData.cinema_id, VALUE_EIGHT);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/cinema/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/cinema/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Cinema.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
