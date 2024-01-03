var filmShootingListTemplate = Handlebars.compile($('#filmshooting_list_template').html());
var filmShootingTableTemplate = Handlebars.compile($('#filmshooting_table_template').html());
var filmShootingActionTemplate = Handlebars.compile($('#filmshooting_action_template').html());
var filmShootingFormTemplate = Handlebars.compile($('#filmshooting_form_template').html());
var filmShootingViewTemplate = Handlebars.compile($('#filmshooting_view_template').html());
var filmShootingUploadChallanTemplate = Handlebars.compile($('#filmshooting_upload_challan_template').html());

var tempPersonCnt = 1;

var FilmShooting = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
FilmShooting.Router = Backbone.Router.extend({
    routes: {
        'filmshooting': 'renderList',
        'filmshooting_form': 'renderListForForm',
        'edit_filmshooting_form': 'renderList',
        'view_filmshooting_form': 'renderList',
    },
    renderList: function () {
        FilmShooting.listview.listPage();
    },
    renderListForForm: function () {
        FilmShooting.listview.listPageShootingForm();
    }
});
FilmShooting.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('filmshooting', 'active');
        FilmShooting.router.navigate('filmshooting');
        var templateData = {};
        this.$el.html(filmShootingListTemplate(templateData));
        this.loadFilmShootingData(sDistrict, sStatus);

    },
    listPageShootingForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('filmshooting', 'active');
        this.$el.html(filmShootingListTemplate);
        this.newFilmShootingForm(false, {});
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
                rowData.ADMIN_FILMSHOOTING_DOC_PATH = ADMIN_FILMSHOOTING_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return filmShootingActionTemplate(rowData);
    },
    loadFilmShootingData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTYTWO, data);
        };
        var that = this;
        FilmShooting.router.navigate('filmshooting');
        $('#filmshooting_form_and_datatable_container').html(filmShootingTableTemplate(searchData));
        filmShootingDataTable = $('#filmshooting_datatable').DataTable({
            ajax: {url: 'filmshooting/get_filmshooting_data', dataSrc: "filmshooting_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'filmshooting_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'production_house', 'class': 'text-center'},
                {data: 'address', 'class': 'text-center'},
                {data: 'contact_no', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'filmshooting_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'filmshooting_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#filmshooting_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = filmShootingDataTable.row(tr);

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
    newFilmShootingForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.filmshooting_data;
            FilmShooting.router.navigate('edit_filmshooting_form');
        } else {
            var formData = {};
            FilmShooting.router.navigate('filmshooting_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.filmshooting_data = parseData.filmshooting_data;
        templateData.shooting_date_time = dateTo_DD_MM_YYYY(formData.shooting_date_time);
        $('#filmshooting_form_and_datatable_container').html(filmShootingFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {

            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            if (formData.declaration != '') {
                that.showDocument('declaration_container_for_filmshooting', 'declaration_name_image_for_filmshooting',
                        'declaration_name_container_for_filmshooting',
                        'declaration_download', 'declaration', formData.declaration, formData.filmshooting_id, VALUE_ONE);
            }

            if (formData.producer_signature != '') {
                that.showDocument('producer_signature_container_for_filmshooting', 'producer_signature_name_image_for_filmshooting',
                        'producer_signature_name_container_for_filmshooting',
                        'producer_signature_download', 'producer_signature', formData.producer_signature, formData.filmshooting_id, VALUE_TWO);
            }

            if (formData.authorized_representative_sign != '') {
                that.showDocument('authorized_representative_sign_container_for_filmshooting', 'authorized_representative_sign_name_image_for_filmshooting',
                        'authorized_representative_sign_name_container_for_filmshooting',
                        'authorized_representative_sign_download', 'authorized_representative_sign', formData.authorized_representative_sign, formData.filmshooting_id, VALUE_THREE);
            }
            if (formData.seal_of_company != '') {
                that.showDocument('seal_of_company_container_for_filmshooting', 'seal_of_company_name_image_for_filmshooting',
                        'seal_of_company_name_container_for_filmshooting',
                        'seal_of_company_download', 'seal_of_company', formData.seal_of_company, formData.filmshooting_id, VALUE_FOUR);
            }

            if (formData.witness_one_sign != '') {
                that.showDocument('witness_one_sign_container_for_filmshooting', 'witness_one_sign_name_image_for_filmshooting',
                        'witness_one_sign_name_container_for_filmshooting',
                        'witness_one_sign_download', 'witness_one_sign', formData.witness_one_sign, formData.filmshooting_id, VALUE_FIVE);
            }
            // if (formData.witness_one_sign != '') {
            //     $('#witness_one_sign_container_for_filmshooting').hide();
            //     $('#witness_one_sign_name_image_for_filmshooting').attr('src', baseUrl + 'documents/filmshooting/' + formData.witness_one_sign);
            //     $('#witness_one_sign_name_container_for_filmshooting').show();
            // }
            if (formData.witness_two_sign != '') {
                that.showDocument('witness_two_sign_container_for_filmshooting', 'witness_two_sign_name_image_for_filmshooting',
                        'witness_two_sign_name_container_for_filmshooting',
                        'witness_two_sign_download', 'witness_two_sign', formData.witness_two_sign, formData.filmshooting_id, VALUE_SIX);
            }
            // if (formData.witness_two_sign != '') {
            //     $('#witness_two_sign_container_for_filmshooting').hide();
            //     $('#witness_two_sign_name_image_for_filmshooting').attr('src', baseUrl + 'documents/filmshooting/' + formData.witness_two_sign);
            //     $('#witness_two_sign_name_container_for_filmshooting').show();
            // }
        }
        generateSelect2();
        datePicker();
        $('#filmshooting_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitFilmShooting($('#submit_btn_for_filmShooting'));
            }
        });
    },
    editOrViewFilmShooting: function (btnObj, filmShootingId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!filmShootingId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'filmshooting/get_filmshooting_data_by_id',
            type: 'post',
            data: $.extend({}, {'filmshooting_id': filmShootingId}, getTokenData()),
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
                    that.newFilmShootingForm(isEdit, parseData);
                } else {
                    that.viewFilmShootingForm(parseData);
                }
            }
        });
    },
    viewFilmShootingForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.filmshooting_data;
        FilmShooting.router.navigate('view_filmshooting_form');
        formData.shooting_date_time = dateTo_DD_MM_YYYY(formData.shooting_date_time);
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#filmshooting_form_and_datatable_container').html(filmShootingViewTemplate(formData));
        if (formData.declaration != '') {
            that.showDocument('declaration_container_for_filmshooting', 'declaration_name_image_for_filmshooting',
                    'declaration_name_container_for_filmshooting',
                    'declaration_download', 'declaration', formData.declaration);
        }
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.producer_signature != '') {
            that.showDocument('producer_signature_container_for_filmshooting', 'producer_signature_name_image_for_filmshooting',
                    'producer_signature_name_container_for_filmshooting',
                    'producer_signature_download', 'producer_signature', formData.producer_signature);
        }

        if (formData.authorized_representative_sign != '') {
            that.showDocument('authorized_representative_sign_container_for_filmshooting', 'authorized_representative_sign_name_image_for_filmshooting',
                    'authorized_representative_sign_name_container_for_filmshooting',
                    'authorized_representative_sign_download', 'authorized_representative_sign', formData.authorized_representative_sign);
        }
        if (formData.seal_of_company != '') {
            that.showDocument('seal_of_company_container_for_filmshooting', 'seal_of_company_name_image_for_filmshooting',
                    'seal_of_company_name_container_for_filmshooting',
                    'seal_of_company_download', 'seal_of_company', formData.seal_of_company);
        }

        if (formData.witness_one_sign != '') {
            that.showDocument('witness_one_sign_container_for_filmshooting', 'witness_one_sign_name_image_for_filmshooting',
                    'witness_one_sign_name_container_for_filmshooting',
                    'witness_one_sign_download', 'witness_one_sign', formData.witness_one_sign);
        }
        // if (formData.witness_one_sign != '') {
        //     $('#witness_one_sign_container_for_filmshooting').hide();
        //     $('#witness_one_sign_name_image_for_filmshooting').attr('src', baseUrl + 'documents/filmshooting/' + formData.witness_one_sign);
        //     $('#witness_one_sign_name_container_for_filmshooting').show();
        // }
        if (formData.witness_two_sign != '') {
            that.showDocument('witness_two_sign_container_for_filmshooting', 'witness_two_sign_name_image_for_filmshooting',
                    'witness_two_sign_name_container_for_filmshooting',
                    'witness_two_sign_download', 'witness_two_sign', formData.witness_two_sign);
        }
        // if (formData.witness_two_sign != '') {
        //     $('#witness_two_sign_container_for_filmshooting').hide();
        //     $('#witness_two_sign_name_image_for_filmshooting').attr('src', baseUrl + 'documents/filmshooting/' + formData.witness_two_sign);
        //     $('#witness_two_sign_name_container_for_filmshooting').show();
        // }

    },
    checkValidationForFilmShooting: function (filmShootingData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!filmShootingData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!filmShootingData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!filmShootingData.production_house) {
            return getBasicMessageAndFieldJSONArray('production_house', productionHouseValidationMessage);
        }
        if (!filmShootingData.address) {
            return getBasicMessageAndFieldJSONArray('address', permanentAddressValidationMessage);
        }
        if (!filmShootingData.production_manager) {
            return getBasicMessageAndFieldJSONArray('production_manager', productionManagerValidationMessage);
        }
        if (!filmShootingData.contact_no) {
            return getBasicMessageAndFieldJSONArray('contact_no', contactNoValidationMessage);
        }
        if (!filmShootingData.email) {
            return getBasicMessageAndFieldJSONArray('email', emailValidationMessage);
        }
        if (!filmShootingData.director_cast) {
            return getBasicMessageAndFieldJSONArray('director_cast', directorValidationMessage);
        }
        if (!filmShootingData.film_title) {
            return getBasicMessageAndFieldJSONArray('film_title', filmTitleValidationMessage);
        }
        if (!filmShootingData.film_synopsis) {
            return getBasicMessageAndFieldJSONArray('film_synopsis', filmSynopsisValidationMessage);
        }
        if (!filmShootingData.film_shooting_days) {
            return getBasicMessageAndFieldJSONArray('film_shooting_days', filmShootingDaysValidationMessage);
        }
        if (!filmShootingData.shooting_location) {
            return getBasicMessageAndFieldJSONArray('shooting_location', shootingLocationValidationMessage);
        }
        if (!filmShootingData.shooting_date_time) {
            return getBasicMessageAndFieldJSONArray('shooting_date_time', shootingDateValidationMessage);
        }
        if (!filmShootingData.defense_installation) {
            return getBasicMessageAndFieldJSONArray('defense_installation', defenseInstallationValidationMessage);
        }

        if (!filmShootingData.undersigned) {
            return getBasicMessageAndFieldJSONArray('undersigned', undersignedValidationMessage);
        }
        if (!filmShootingData.aged) {
            return getBasicMessageAndFieldJSONArray('aged', agedYearValidationMessage);
        }
        if (!filmShootingData.resident) {
            return getBasicMessageAndFieldJSONArray('resident', residentValidationMessage);
        }
        if (!filmShootingData.purpose) {
            return getBasicMessageAndFieldJSONArray('purpose', purposeValidationMessage);
        }
        if (!filmShootingData.witness_one_name) {
            return getBasicMessageAndFieldJSONArray('witness_one_name', witnessNameValidationMessage);
        }
        if (!filmShootingData.witness_two_name) {
            return getBasicMessageAndFieldJSONArray('witness_two_name', witnessNameValidationMessage);
        }
        return '';
    },
    askForSubmitFilmShooting: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'FilmShooting.listview.submitFilmShooting(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitFilmShooting: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var filmShootingData = $('#filmshooting_form').serializeFormJSON();
        var validationData = that.checkValidationForFilmShooting(filmShootingData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('filmshooting-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#declaration_container_for_filmshooting').is(':visible')) {
            var declarationDocument = checkValidationForDocument('declaration_for_filmshooting', VALUE_ONE, 'filmshooting');
            if (declarationDocument == false) {
                return false;
            }
        }

        if ($('#producer_signature_container_for_filmshooting').is(':visible')) {
            var producerSignatureDocument = checkValidationForDocument('producer_signature_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (producerSignatureDocument == false) {
                return false;
            }
        }

        if ($('#authorized_representative_sign_container_for_filmshooting').is(':visible')) {
            var authorizedRepresentativeSign = checkValidationForDocument('authorized_representative_sign_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (authorizedRepresentativeSign == false) {
                return false;
            }
        }
        if ($('#seal_of_company_container_for_filmshooting').is(':visible')) {
            var sealOfCompany = checkValidationForDocument('seal_of_company_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (sealOfCompany == false) {
                return false;
            }
        }


        if ($('#witness_one_sign_container_for_filmshooting').is(':visible')) {
            var witnessOneSign = checkValidationForDocument('witness_one_sign_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (witnessOneSign == false) {
                return false;
            }
        }

        if ($('#witness_two_sign_container_for_filmshooting').is(':visible')) {
            var witnessTwoSign = checkValidationForDocument('witness_two_sign_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (witnessTwoSign == false) {
                return false;
            }
        }


        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_filmshooting') : $('#submit_btn_for_filmshooting');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var filmShootingData = new FormData($('#filmshooting_form')[0]);
        filmShootingData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        filmShootingData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'filmshooting/submit_filmshooting',
            data: filmShootingData,
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
                validationMessageShow('filmshooting', textStatus.statusText);
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
                    validationMessageShow('filmshooting', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FilmShooting.router.navigate('filmshooting', {'trigger': true});
            }
        });
    },

    askForRemove: function (filmShootingId, docType, tableName) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!filmShootingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        // var yesEvent = 'FilmShooting.listview.removeDocument(\'' + filmShootingId + '\',\'' + docId + '\')';
        // showConfirmation(yesEvent, 'Remove');
        var yesEvent = 'FilmShooting.listview.removeDocument(\'' + filmShootingId + '\',\'' + docType + '\',\'' + tableName + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (filmShootingId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!filmShootingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_filmshooting_' + docType).hide();
        $('.spinner_name_container_for_filmshooting_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'filmshooting/remove_document',
            // data: $.extend({}, {'filmshooting_id': filmShootingId, 'document_id': docId}, getTokenData()),
            data: $.extend({}, {'filmshooting_id': filmShootingId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_filmshooting_' + docType).hide();
                $('.spinner_name_container_for_filmshooting_' + docType).show();
                validationMessageShow('filmshooting', textStatus.statusText);
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
                    validationMessageShow('filmshooting', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_filmshooting_' + docType).show();
                $('.spinner_name_container_for_filmshooting_' + docType).hide();
                showSuccess(parseData.message);
                // $('#' + docId + '_name_container_for_filmshooting').hide();
                // $('#' + docId + '_name_image_for_filmshooting').attr('src', '');
                // $('#' + docId + '_container_for_filmshooting').show();
                // $('#' + docId + '_for_filmshooting').val('');
                if (docType == VALUE_ONE) {
                    removeDocumentValue('declaration_name_container_for_filmshooting',
                            'declaration_name_image_for_filmshooting', 'declaration_container_for_filmshooting',
                            'declaration_for_filmshooting');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('producer_signature_name_container_for_filmshooting',
                            'producer_signature_name_image_for_filmshooting', 'producer_signature_container_for_filmshooting',
                            'producer_signature_for_filmshooting');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('authorized_representative_sign_name_container_for_filmshooting',
                            'authorized_representative_sign_name_image_for_filmshooting', 'authorized_representative_sign_container_for_filmshooting',
                            'authorized_representative_sign_for_filmshooting');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('seal_of_company_name_container_for_filmshooting',
                            'seal_of_company_name_image_for_filmshooting', 'seal_of_company_container_for_filmshooting',
                            'seal_of_company_for_filmshooting');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('witness_one_sign_name_container_for_filmshooting',
                            'witness_one_sign_name_image_for_filmshooting', 'witness_one_sign_container_for_filmshooting',
                            'witness_one_sign_for_filmshooting');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('witness_two_sign_name_container_for_filmshooting',
                            'witness_two_sign_name_image_for_filmshooting', 'witness_two_sign_container_for_filmshooting',
                            'witness_two_sign_for_filmshooting');
                }
            }
        });
    },
    generateForm1: function (filmShootingId) {
        if (!filmShootingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#filmshooting_id_for_filmshooting_form1').val(filmShootingId);
        $('#filmshooting_form1_pdf_form').submit();
        $('#filmshooting_id_for_filmshooting_form1').val('');
    },

    downloadUploadChallan: function (filmShootingId) {
        if (!filmShootingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + filmShootingId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'filmshooting/get_filmshooting_data_by_filmshooting_id',
            type: 'post',
            data: $.extend({}, {'filmshooting_id': filmShootingId}, getTokenData()),
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
                var filmShootingData = parseData.filmshooting_data;
                that.showChallan(filmShootingData);
            }
        });
    },
    showChallan: function (filmShootingData) {
        showPopup();
        if (filmShootingData.status != VALUE_FIVE && filmShootingData.status != VALUE_SIX && filmShootingData.status != VALUE_SEVEN) {
            if (!filmShootingData.hide_submit_btn) {
                filmShootingData.show_fees_paid = true;
            }
        }
        if (filmShootingData.payment_type == VALUE_ONE) {
            filmShootingData.utitle = 'Fees Paid Challan Copy';
        } else {
            filmShootingData.style = 'display: none;';
        }
        if (filmShootingData.payment_type == VALUE_TWO) {
            filmShootingData.show_dd_po_option = true;
            filmShootingData.utitle = 'Demand Draft (DD)';
        }
        filmShootingData.module_type = VALUE_TWENTYTWO;
        $('#popup_container').html(filmShootingUploadChallanTemplate(filmShootingData));
        loadFB(VALUE_TWENTYTWO, filmShootingData.fb_data);
        loadPH(VALUE_TWENTYTWO, filmShootingData.filmshooting_id, filmShootingData.ph_data);

        if (filmShootingData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'filmshooting_upload_challan', filmShootingData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'filmshooting_upload_challan', 'uc', 'radio');
            if (filmShootingData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_filmshooting_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (filmShootingData.challan != '') {
            $('#challan_container_for_filmshooting_upload_challan').hide();
            $('#challan_name_container_for_filmshooting_upload_challan').show();
            $('#challan_name_href_for_filmshooting_upload_challan').attr('href', 'documents/filmshooting/' + filmShootingData.challan);
            $('#challan_name_for_filmshooting_upload_challan').html(filmShootingData.challan);
        }
        if (filmShootingData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_filmshooting_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_filmshooting_upload_challan').show();
            $('#fees_paid_challan_name_href_for_filmshooting_upload_challan').attr('href', 'documents/filmshooting/' + filmShootingData.fees_paid_challan);
            $('#fees_paid_challan_name_for_filmshooting_upload_challan').html(filmShootingData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_filmshooting_upload_challan').attr('onclick', 'FilmShooting.listview.removeFeesPaidChallan("' + filmShootingData.filmshooting_id + '")');
        }
    },
    removeFeesPaidChallan: function (filmShootingId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!filmShootingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'filmshooting/remove_fees_paid_challan',
            data: $.extend({}, {'filmshooting_id': filmShootingId}, getTokenData()),
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
                validationMessageShow('filmshooting-uc', textStatus.statusText);
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
                    validationMessageShow('filmshooting-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-filmshooting-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'filmshooting_upload_challan');
                $('#status_' + filmShootingId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-filmshooting-uc').html('');
        validationMessageHide();
        var filmShootingId = $('#filmshooting_id_for_filmshooting_upload_challan').val();
        if (!filmShootingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_filmshooting_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_filmshooting_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_filmshooting_upload_challan').focus();
                validationMessageShow('filmshooting-uc-fees_paid_challan_for_filmshooting_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_filmshooting_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_filmshooting_upload_challan').focus();
                validationMessageShow('filmshooting-uc-fees_paid_challan_for_filmshooting_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_filmshooting_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#filmshooting_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'filmshooting/upload_fees_paid_challan',
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
                validationMessageShow('filmshooting-uc', textStatus.statusText);
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
                    validationMessageShow('filmshooting-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + filmShootingId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (filmShootingId) {
        if (!filmShootingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#filmshooting_id_for_certificate').val(filmShootingId);
        $('#filmshooting_certificate_pdf_form').submit();
        $('#filmshooting_id_for_certificate').val('');
    },
    getQueryData: function (filmShootingId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!filmShootingId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTYTWO;
        templateData.module_id = filmShootingId;
        var btnObj = $('#query_btn_for_wm_' + filmShootingId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTYTWO, moduleData.filmshooting_id);
                tmpData.applicant_name = moduleData.production_house;
                tmpData.title = 'Production House';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },

    // drct upload code
    uploadDocumentForFilmShooting: function (fileNo) {
        var that = this;

        if ($('#declaration_for_filmshooting').val() != '') {
            var declarationDocument = checkValidationForDocument('declaration_for_filmshooting', VALUE_ONE, 'filmshooting');
            if (declarationDocument == false) {
                return false;
            }
        }
        if ($('#producer_signature_for_filmshooting').val() != '') {
            var producerSignatureDocument = checkValidationForDocument('producer_signature_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (producerSignatureDocument == false) {
                return false;
            }
        }
        if ($('#authorized_representative_sign_for_filmshooting').val() != '') {
            var authorizedRepresentativeSign = checkValidationForDocument('authorized_representative_sign_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (authorizedRepresentativeSign == false) {
                return false;
            }
        }
        if ($('#seal_of_company_for_filmshooting').val() != '') {
            var sealOfCompany = checkValidationForDocument('seal_of_company_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (sealOfCompany == false) {
                return false;
            }
        }
        if ($('#witness_one_sign_for_filmshooting').val() != '') {
            var witnessOneSign = checkValidationForDocument('witness_one_sign_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (witnessOneSign == false) {
                return false;
            }
        }
        if ($('#witness_two_sign_for_filmshooting').val() != '') {
            var witnessTwoSign = checkValidationForDocument('witness_two_sign_for_filmshooting', VALUE_TWO, 'filmshooting');
            if (witnessTwoSign == false) {
                return false;
            }
        }

        $('.spinner_container_for_filmshooting_' + fileNo).hide();
        $('.spinner_name_container_for_filmshooting_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var filmshootingId = $('#filmshooting_id').val();
        var formData = new FormData($('#filmshooting_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("filmshooting_id", filmshootingId);
        $.ajax({
            type: 'POST',
            url: 'filmshooting/upload_filmshooting_document',
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
                $('.spinner_container_for_filmshooting_' + fileNo).show();
                $('.spinner_name_container_for_filmshooting_' + fileNo).hide();
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
                    $('.spinner_container_for_filmshooting_' + fileNo).show();
                    $('.spinner_name_container_for_filmshooting_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_filmshooting_' + fileNo).hide();
                $('.spinner_name_container_for_filmshooting_' + fileNo).show();
                $('#filmshooting_id').val(parseData.filmshooting_id);
                var filmshootingData = parseData.filmshooting_data;

                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('declaration_container_for_filmshooting', 'declaration_name_image_for_filmshooting', 'declaration_name_container_for_filmshooting',
                            'declaration_download', 'declaration', filmshootingData.declaration, parseData.filmshooting_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('producer_signature_container_for_filmshooting', 'producer_signature_name_image_for_filmshooting', 'producer_signature_name_container_for_filmshooting',
                            'producer_signature_download', 'producer_signature', filmshootingData.producer_signature, parseData.filmshooting_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('authorized_representative_sign_container_for_filmshooting', 'authorized_representative_sign_name_image_for_filmshooting', 'authorized_representative_sign_name_container_for_filmshooting',
                            'authorized_representative_sign_download', 'authorized_representative_sign', filmshootingData.authorized_representative_sign, parseData.filmshooting_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('seal_of_company_container_for_filmshooting', 'seal_of_company_name_image_for_filmshooting', 'seal_of_company_name_container_for_filmshooting',
                            'seal_of_company_download', 'seal_of_company', filmshootingData.seal_of_company, parseData.filmshooting_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('witness_one_sign_container_for_filmshooting', 'witness_one_sign_name_image_for_filmshooting', 'witness_one_sign_name_container_for_filmshooting',
                            'witness_one_sign_download', 'witness_one_sign', filmshootingData.witness_one_sign, parseData.filmshooting_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('witness_two_sign_container_for_filmshooting', 'witness_two_sign_name_image_for_filmshooting', 'witness_two_sign_name_container_for_filmshooting',
                            'witness_two_sign_download', 'witness_two_sign', filmshootingData.witness_two_sign, parseData.filmshooting_id, VALUE_SIX);
                }

            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/filmshooting/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/filmshooting/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'FilmShooting.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
