var migrantworkersRenewalListTemplate = Handlebars.compile($('#migrantworkers_renewal_list_template').html());
var migrantworkersRenewalTableTemplate = Handlebars.compile($('#migrantworkers_renewal_table_template').html());
var migrantworkersRenewalActionTemplate = Handlebars.compile($('#migrantworkers_renewal_action_template').html());
var migrantworkersRenewalFormTemplate = Handlebars.compile($('#migrantworkers_renewal_form_template').html());
var migrantworkersRenewalViewTemplate = Handlebars.compile($('#migrantworkers_renewal_view_template').html());
var migrantworkersRenewalItemInfoTemplate = Handlebars.compile($('#migrantworkers_renewal_item_info_template').html());
var migrantworkersRenewalUploadChallanTemplate = Handlebars.compile($('#migrantworkers_renewal_upload_challan_template').html());

var tempProprietorInfoCnt = 1;

var MigrantworkersRenewal = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
MigrantworkersRenewal.Router = Backbone.Router.extend({
    routes: {
        'migrantworkers_renewal': 'renderList',
        'migrantworkers_renewal_form': 'renderListForForm',
        'edit_migrantworkers_renewal_form': 'renderList',
        'view_migrantworkers_renewal_form': 'renderList',
    },
    renderList: function () {
        MigrantworkersRenewal.listview.listPage();
    },
    renderListForForm: function () {
        MigrantworkersRenewal.listview.listPageMigrantworkersRenewalForm();
    }
});
MigrantworkersRenewal.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('menu_migrantworkers_renewal', 'active');
        MigrantworkersRenewal.router.navigate('migrantworkers_renewal');
        var templateData = {};
        this.$el.html(migrantworkersRenewalListTemplate(templateData));
        this.loadMigrantworkersRenewalData(sDistrict, sStatus);

    },
    listPageMigrantworkersRenewalForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('menu_migrantworkers_renewal', 'active');
        this.$el.html(migrantworkersRenewalListTemplate);
        this.newMigrantworkersRenewalForm(false, {});
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
                rowData.ADMIN_MIGRANTWORKERS_DOC_PATH = ADMIN_MIGRANTWORKERS_DOC_PATH;
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
        return migrantworkersRenewalActionTemplate(rowData);
    },
    loadMigrantworkersRenewalData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FOURTYFIVE, data)
                    + getFRContainer(VALUE_FOURTYFIVE, data, full.rating, full.fr_datetime);
        };
        var that = this;
        MigrantworkersRenewal.router.navigate('migrantworkers_renewal');
        $('#migrantworkers_renewal_form_and_datatable_container').html(migrantworkersRenewalTableTemplate(searchData));
        migrantworkersrenewalDataTable = $('#migrantworkers_renewal_datatable').DataTable({
            ajax: {url: 'migrantworkers_renewal/get_migrantworkers_renewal_data', dataSrc: "migrantworkers_renewal_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'migrantworkers_renewal_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_establishment', 'class': 'text-center'},
                {data: 'nature_of_work_of_establishment', 'class': 'text-center'},
                {data: 'principal_employer_name', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'migrantworkers_renewal_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'migrantworkers_renewal_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#migrantworkers_renewal_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = migrantworkersrenewalDataTable.row(tr);

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
    newMigrantworkersRenewalForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.migrantworkers_renewal_data;
            MigrantworkersRenewal.router.navigate('edit_migrantworkers_renewal_form');
        } else {
            var formData = {};
            MigrantworkersRenewal.router.navigate('migrantworkers_renewal_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.migrantworkersrenewal_data = parseData.migrantworkers_renewal_data;
        templateData.last_valid_upto = dateTo_DD_MM_YYYY(formData.last_valid_upto);
        $('#migrantworkers_renewal_form_and_datatable_container').html(migrantworkersRenewalFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_migrantworkersrenewal', 'seal_and_stamp_name_image_for_migrantworkersrenewal', 'seal_and_stamp_name_container_for_migrantworkersrenewal',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.migrantworkers_renewal_id, VALUE_ONE);
            }

            if (formData.contractor_details != '') {
                var itemInfo = JSON.parse(formData.contractor_details);
                $.each(itemInfo, function (key, value) {
                    that.addMultipleContractor(value);
                })
            }
        }
        generateSelect2();
        datePicker();
        $('#migrantworkers_renewal_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitMigrantworkersRenewal($('#submit_btn_for_migrantworkers'));
            }
        });
    },
    editOrViewMigrantworkersRenewal: function (btnObj, migrantworkersRenewalId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!migrantworkersRenewalId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'migrantworkers_renewal/get_migrantworkers_renewal_data_by_id',
            type: 'post',
            data: $.extend({}, {'migrantworkers_renewal_id': migrantworkersRenewalId}, getTokenData()),
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
                    that.newMigrantworkersRenewalForm(isEdit, parseData);
                } else {
                    that.viewMigrantworkersRenewalForm(parseData);
                }
            }
        });
    },
    viewMigrantworkersRenewalForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.migrantworkers_renewal_data;
        MigrantworkersRenewal.router.navigate('view_migrantworkers_renewal_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.last_valid_upto = dateTo_DD_MM_YYYY(formData.last_valid_upto);
        $('#migrantworkers_renewal_form_and_datatable_container').html(migrantworkersRenewalViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        if (formData.contractor_details != '') {
            var itemInfo = JSON.parse(formData.contractor_details);
            $.each(itemInfo, function (key, value) {
                that.addMultipleContractor(value);
                $('.view_hideen').hide();
                $('.hide').attr('readonly', true);
            })
        }

        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_migrantworkersrenewal', 'seal_and_stamp_name_image_for_migrantworkersrenewal', 'seal_and_stamp_name_container_for_migrantworkersrenewal',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.migrantworkers_renewal_id, VALUE_ONE);
        }
    },
    checkValidationForMigrantworkersRenewal: function (migrantworkersrenewalFormData) {
        if (!migrantworkersrenewalFormData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!migrantworkersrenewalFormData.name_of_migrantworkersrenewal_registration) {
            return getBasicMessageAndFieldJSONArray('name_of_migrantworkersrenewal_registration', establishmentNameValidationMessage);
        }
        if (!migrantworkersrenewalFormData.loaction_for_migrantworkersrenewal_registration) {
            return getBasicMessageAndFieldJSONArray('loaction_for_migrantworkersrenewal_registration', establishmentLocationValidationMessage);
        }
        if (!migrantworkersrenewalFormData.postal_address_for_migrantworkersrenewal_registration) {
            return getBasicMessageAndFieldJSONArray('postal_address_for_migrantworkersrenewal_registration', establishmentPostelAddressValidationMessage);
        }
        if (!migrantworkersrenewalFormData.nature_of_work_for_migrantworkersrenewal_registration) {
            return getBasicMessageAndFieldJSONArray('nature_of_work_for_migrantworkersrenewal_registration', establishmentTypeValidationMessage);
        }
        if (!migrantworkersrenewalFormData.principle_employer_full_name_for_migrantworkersrenewal_registration) {
            return getBasicMessageAndFieldJSONArray('principle_employer_full_name_for_migrantworkersrenewal_registration', establishmentPrincipalNameValidationMessage);
        }
        if (!migrantworkersrenewalFormData.principle_employer_address_for_migrantworkersrenewal_registration) {
            return getBasicMessageAndFieldJSONArray('principle_employer_address_for_migrantworkersrenewal_registration', establishmentPrincipalAddressValidationMessage);
        }
        if (!migrantworkersrenewalFormData.manager_or_person_full_name_migrantworkersrenewal_registration) {
            return getBasicMessageAndFieldJSONArray('manager_or_person_full_name_migrantworkersrenewal_registration', establishmentManagerNameValidationMessage);
        }
        if (!migrantworkersrenewalFormData.manager_or_person_address_for_migrantworkersrenewal_registration) {
            return getBasicMessageAndFieldJSONArray('manager_or_person_address_for_migrantworkersrenewal_registration', establishmentManagerAddressValidationMessage);
        }
        return '';
    },
    askForSubmitMigrantworkersRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'MigrantworkersRenewal.listview.submitMigrantworkersRenewal(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitMigrantworkersRenewal: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var migrantworkersrenewalData = $('#migrantworkers_renewal_form').serializeFormJSON();
        var validationData = that.checkValidationForMigrantworkersRenewal(migrantworkersrenewalData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('migrantworkersrenewal-' + validationData.field, validationData.message);
            return false;
        }

        var newContractorItems = [];
        var isContractorItemValidation = false;
        $('.migrant_contractor_workers_name').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var contractorItem = {};
            var cpn = $('#migrant_contractor_proprietor_name_' + cnt).val();
            if (cpn == '' || cpn == null) {
                $('#migrant_contractor_proprietor_name_' + cnt).focus();
                validationMessageShow('migrantworkers-migrant_contractor_proprietor_name_' + cnt, contractorPropriterNameValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.mc_proprietor_name = cpn;
            var cn = $('#migrant_contractor_name_' + cnt).val();
            if (cn == '' || cn == null) {
                $('#migrant_contractor_name_' + cnt).focus();
                validationMessageShow('migrantworkers-migrant_contractor_name_' + cnt, contractorNameValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.mc_name = cn;
            var ca = $('#migrant_contractor_address_' + cnt).val();
            if (ca == '' || ca == null) {
                $('#migrant_contractor_address_' + cnt).focus();
                validationMessageShow('migrantworkers-migrant_contractor_address_' + cnt, contractorAddressValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.mc_address = ca;
            var cnow = $('#migrant_contractor_nature_of_working_' + cnt).val();
            if (cnow == '' || cnow == null) {
                $('#migrant_contractor_nature_of_working_' + cnt).focus();
                validationMessageShow('migrantworkers-migrant_contractor_nature_of_working_' + cnt, contractorNatureOfWorkingValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.mc_nature_of_work = cnow;
            var cl = $('#migrant_contractor_maximum_no_of_workers_' + cnt).val();
            if (cl == '' || cl == null) {
                $('#migrant_contractor_maximum_no_of_workers_' + cnt).focus();
                validationMessageShow('migrantworkers-migrant_contractor_maximum_no_of_workers_' + cnt, contractorLabourValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.mc_maximum_no_of_workers = cl;
            var csd = $('#migrant_contractor_commencement_date_' + cnt).val();
            if (csd == '' || csd == null) {
                $('#migrant_contractor_commencement_date_' + cnt).focus();
                validationMessageShow('migrantworkers-migrant_contractor_commencement_date_' + cnt, contractorStartDateValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.mc_date_of_commencement = csd;
            var ctd = $('#migrant_contractor_termination_date_' + cnt).val();
            if (ctd == '' || ctd == null) {
                $('#migrant_contractor_termination_date_' + cnt).focus();
                validationMessageShow('migrantworkers-migrant_contractor_termination_date_' + cnt, contractorTerminationDateValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.mc_date_of_termination = ctd;

            newContractorItems.push(contractorItem);
        });
        if (isContractorItemValidation) {
            return false;
        }

        if ($('#seal_and_stamp_container_for_migrantworkersrenewal').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_migrantworkersrenewal', VALUE_TWO, 'migrantworkersrenewal');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_migrantworkers') : $('#submit_btn_for_migrantworkers');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var migrantworkersrenewalData = new FormData($('#migrantworkers_renewal_form')[0]);
        migrantworkersrenewalData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        migrantworkersrenewalData.append("new_contractor_data", JSON.stringify(newContractorItems));
//        migrantworkersrenewalData.append("exi_contractor_data", JSON.stringify(exiContractorItems));
        migrantworkersrenewalData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'migrantworkers_renewal/submit_migrantworkers_renewal',
            data: migrantworkersrenewalData,
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
                validationMessageShow('migrantworkersrenewal', textStatus.statusText);
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
                    validationMessageShow('migrantworkersrenewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                MigrantworkersRenewal.router.navigate('migrantworkers_renewal', {'trigger': true});
            }
        });
    },

    askForRemove: function (migrantworkersRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!migrantworkersRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'MigrantworkersRenewal.listview.removeDocument(\'' + migrantworkersRenewalId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (migrantworkersRenewalId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!migrantworkersRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_migrantworkersrenewal_' + docType).hide();
        $('.spinner_name_container_for_migrantworkersrenewal_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'migrantworkers_renewal/remove_document',
            data: $.extend({}, {'migrantworkers_renewal_id': migrantworkersRenewalId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_migrantworkersrenewal_' + docType).hide();
                $('.spinner_name_container_for_migrantworkersrenewal_' + docType).show();
                validationMessageShow('migrantworkersrenewal', textStatus.statusText);
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
                    validationMessageShow('migrantworkersrenewal', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_migrantworkersrenewal_' + docType).show();
                $('.spinner_name_container_for_migrantworkersrenewal_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    $('#seal_and_stamp_name_container_for_migrantworkersrenewal').hide();
                    $('#seal_and_stamp_name_image_for_migrantworkersrenewal').attr('src', '');
                    $('#seal_and_stamp_container_for_migrantworkersrenewal').show();
                    $('#seal_and_stamp_for_migrantworkersrenewal').val('');
                }

            }
        });
    },
    addMultipleContractor: function (templateData) {
        templateData.item_cnt = tempMigrantWorkersCnt;
        $('#contractors_and_migrant_workman_details_container').append(migrantworkersRenewalItemInfoTemplate(templateData));
        allowOnlyIntegerValue('migrant_contractor_maximum_no_of_workers_' + tempMigrantWorkersCnt);
        tempMigrantWorkersCnt++;
        datePicker();
        resetCounter('display-cnt');
    },
    removeContractor: function (itemCnt) {
        $('#migrant_contractor_workers_name_' + itemCnt).remove();
        $('#migrant_contractor_workers_name_id_' + itemCnt).remove();
        resetCounter('display-cnt');
    },

    generateForm: function (migrantworkersRenewalId) {
        if (!migrantworkersRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#migrantworkers_renewal_id_for_migrantworkers_renewal_form').val(migrantworkersRenewalId);
        $('#migrantworkers_renewal_form_pdf_form').submit();
        $('#migrantworkers_renewal_id_for_migrantworkers_renewal_form').val('');
    },

    downloadUploadChallan: function (migrantworkersRenewalId) {
        if (!migrantworkersRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + migrantworkersRenewalId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'migrantworkers_renewal/get_migrantworkers_renewal_data_by_migrantworkers_renewal_id',
            type: 'post',
            data: $.extend({}, {'migrantworkers_renewal_id': migrantworkersRenewalId}, getTokenData()),
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
                var migrantworkersrenewalData = parseData.migrantworkers_renewal_data;
                that.showChallan(migrantworkersrenewalData);
            }
        });
    },
    showChallan: function (migrantworkersrenewalData) {
        showPopup();
        if (migrantworkersrenewalData.status != VALUE_FIVE && migrantworkersrenewalData.status != VALUE_SIX && migrantworkersrenewalData.status != VALUE_SEVEN && migrantworkersrenewalData.status != VALUE_ELEVEN) {
            if (!migrantworkersrenewalData.hide_submit_btn) {
                migrantworkersrenewalData.show_fees_paid = true;
            }
        }
        if (migrantworkersrenewalData.payment_type == VALUE_ONE) {
            migrantworkersrenewalData.utitle = 'Fees Paid Challan Copy';
        } else {
            migrantworkersrenewalData.style = 'display: none;';
        }
        if (migrantworkersrenewalData.payment_type == VALUE_TWO) {
            migrantworkersrenewalData.show_dd_po_option = true;
            migrantworkersrenewalData.utitle = 'Demand Draft (DD)';
        }
        migrantworkersrenewalData.module_type = VALUE_FOURTYFIVE;
        $('#popup_container').html(migrantworkersRenewalUploadChallanTemplate(migrantworkersrenewalData));
        loadFB(VALUE_FOURTYFIVE, migrantworkersrenewalData.fb_data);
        loadPH(VALUE_FOURTYFIVE, migrantworkersrenewalData.migrantworkers_renewal_id, migrantworkersrenewalData.ph_data);

        if (migrantworkersrenewalData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'migrantworkers_renewal_upload_challan', migrantworkersrenewalData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'migrantworkers_renewal_upload_challan', 'uc', 'radio');
            if (migrantworkersrenewalData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_migrantworkers_renewal_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (migrantworkersrenewalData.challan != '') {
            $('#challan_container_for_migrantworkers_renewal_upload_challan').hide();
            $('#challan_name_container_for_migrantworkers_renewal_upload_challan').show();
            $('#challan_name_href_for_migrantworkers_renewal_upload_challan').attr('href', 'documents/migrantworkers/' + migrantworkersrenewalData.challan);
            $('#challan_name_for_migrantworkers_renewal_upload_challan').html(migrantworkersrenewalData.challan);
        }
        if (migrantworkersrenewalData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_migrantworkers_renewal_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_migrantworkers_renewal_upload_challan').show();
            $('#fees_paid_challan_name_href_for_migrantworkers_renewal_upload_challan').attr('href', 'documents/migrantworkers/' + migrantworkersrenewalData.fees_paid_challan);
            $('#fees_paid_challan_name_for_migrantworkers_renewal_upload_challan').html(migrantworkersrenewalData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_migrantworkers_renewal_upload_challan').attr('onclick', 'MigrantworkersRenewal.listview.removeFeesPaidChallan("' + migrantworkersrenewalData.migrantworkers_renewal_id + '")');
        }
    },
    removeFeesPaidChallan: function (migrantworkersRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!migrantworkersRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'migrantworkers_renewal/remove_fees_paid_challan',
            data: $.extend({}, {'migrantworkers_renewal_id': migrantworkersRenewalId}, getTokenData()),
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
                validationMessageShow('migrantworkers-uc', textStatus.statusText);
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
                    validationMessageShow('migrantworkers-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-migrantworkers-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'migrantworkers_renewal_upload_challan');
                $('#status_' + migrantworkersRenewalId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-migrantworkers-uc').html('');
        validationMessageHide();
        var migrantworkersRenewalId = $('#migrantworkers_renewal_id_for_migrantworkers_renewal_upload_challan').val();
        if (!migrantworkersRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_migrantworkers_renewal_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_migrantworkers_renewal_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_migrantworkers_renewal_upload_challan').focus();
                validationMessageShow('migrantworkers-uc-fees_paid_challan_for_migrantworkers_renewal_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_migrantworkers_renewal_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_migrantworkers_renewal_upload_challan').focus();
                validationMessageShow('migrantworkers-uc-fees_paid_challan_for_migrantworkers_renewal_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_migrantworkers_renewal_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#migrantworkers_renewal_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'migrantworkers_renewal/upload_fees_paid_challan',
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
                validationMessageShow('migrantworkers-uc', textStatus.statusText);
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
                    validationMessageShow('migrantworkers-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + migrantworkersRenewalId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (migrantworkersRenewalId) {
        if (!migrantworkersRenewalId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#migrantworkers_renewal_id_for_certificate').val(migrantworkersRenewalId);
        $('#migrantworkers_renewal_certificate_pdf_form').submit();
        $('#migrantworkers_renewal_id_for_certificate').val('');
    },
    getQueryData: function (migrantworkersRenewalId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!migrantworkersRenewalId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FOURTYFIVE;
        templateData.module_id = migrantworkersRenewalId;
        var btnObj = $('#query_btn_for_migrantworkersrenewal_' + migrantworkersRenewalId);
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
                tmpData.application_number = regNoRenderer(VALUE_FOURTYFIVE, moduleData.migrantworkers_renewal_id);
                tmpData.applicant_name = moduleData.name_of_establishment;
                tmpData.title = 'Name of Establishment';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getMigrantworkersData: function (btnObj) {
        var license_number = $('#registration_number').val();
        var migrantworkers_id = $('#migrantworkers_id').val();
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
            url: 'migrantworkers_renewal/get_migrantworkers_data_by_id',
            type: 'post',
            data: $.extend({}, {'license_number': license_number, 'migrantworkers_id': migrantworkers_id}, getTokenData()),
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
                migrantworkersrenewalData = parseData.migrantworkers_data;
                contractorData = parseData.migrantcontractors_data;
                if (migrantworkersrenewalData == null) {
                    $('#migrantworkers_id').val('');
                    $('#name_of_migrantworkersrenewal_registration').val('');
                    $('#loaction_for_migrantworkersrenewal_registration').val('');
                    $('#postal_address_for_migrantworkersrenewal_registration').val('');
                    $('#nature_of_work_for_migrantworkersrenewal_registration').val('');
                    $('#principle_employer_full_name_for_migrantworkersrenewal_registration').val('');
                    $('#principle_employer_address_for_migrantworkersrenewal_registration').val('');
                    $('#directors_or_partners_name_migrantworkersrenewal_registration').val('');
                    $('#directors_or_partners_address_for_migrantworkersrenewal_registration').val('');
                    $('#manager_or_person_full_name_migrantworkersrenewal_registration').val('');
                    $('#manager_or_person_address_for_migrantworkersrenewal_registration').val('');
//                    showError(licenseNoNotAvailable);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                }
                if (migrantworkersrenewalData.migrantworkers_renewal_id != null) {
                    $('#migrantworkers_id').val(migrantworkersrenewalData.mw_id);
                    $('#name_of_migrantworkersrenewal_registration').val(migrantworkersrenewalData.name_of_establishment);
                    $('#loaction_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.location_of_establishment);
                    $('#postal_address_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.postal_address_of_establishment);
                    $('#nature_of_work_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.nature_of_work_of_establishment);
                    $('#principle_employer_full_name_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.principal_employer_name);
                    $('#principle_employer_address_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.principal_employer_address);
                    $('#directors_or_partners_name_migrantworkersrenewal_registration').val(migrantworkersrenewalData.directors_or_partners_name);
                    $('#directors_or_partners_address_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.directors_or_partners_address);
                    $('#manager_or_person_full_name_migrantworkersrenewal_registration').val(migrantworkersrenewalData.manager_or_persons_name);
                    $('#manager_or_person_address_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.manager_or_persons_address);
                    $('#registration_number').val(migrantworkersrenewalData.registration_number);
                    var itemInfo = JSON.parse(migrantworkersrenewalData.contractor_details);
                    $.each(itemInfo, function (key, value) {
                        that.addMultipleContractor(value);
                    })
                } else {
                    $('#migrantworkers_id').val(migrantworkersrenewalData.mw_id);
                    $('#name_of_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_name_of_establishment);
                    $('#loaction_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_location_of_establishment);
                    $('#postal_address_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_postal_address_of_establishment);
                    $('#nature_of_work_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_nature_of_work_of_establishment);
                    $('#principle_employer_full_name_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_principal_employer_name);
                    $('#principle_employer_address_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_principal_employer_address);
                    $('#directors_or_partners_name_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_directors_or_partners_name);
                    $('#directors_or_partners_address_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_directors_or_partners_address);
                    $('#manager_or_person_full_name_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_manager_or_persons_name);
                    $('#manager_or_person_address_for_migrantworkersrenewal_registration').val(migrantworkersrenewalData.mw_manager_or_persons_address);
                    $('#registration_number').val(migrantworkersrenewalData.mw_registration_no);
                    $.each(contractorData, function (index, value) {
                        that.addMultipleContractor(value);
                    });
                }
            }
        });
    },
    uploadDocumentForMigrantworkersRenewal: function (fileNo) {
        var that = this;
        if ($('#seal_and_stamp_for_migrantworkersrenewal').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_migrantworkersrenewal', VALUE_TWO, 'migrantworkersrenewal');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_migrantworkersrenewal_' + fileNo).hide();
        $('.spinner_name_container_for_migrantworkersrenewal_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var migrantworkersRenewalId = $('#migrantworkers_renewal_id').val();
        var formData = new FormData($('#migrantworkers_renewal_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("migrantworkers_renewal_id", migrantworkersRenewalId);
        $.ajax({
            type: 'POST',
            url: 'migrantworkers_renewal/upload_migrantworkersrenewal_document',
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
                $('.spinner_container_for_migrantworkersrenewal_' + fileNo).show();
                $('.spinner_name_container_for_migrantworkersrenewal_' + fileNo).hide();
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
                    $('.spinner_container_for_migrantworkersrenewal_' + fileNo).show();
                    $('.spinner_name_container_for_migrantworkersrenewal_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_migrantworkersrenewal_' + fileNo).hide();
                $('.spinner_name_container_for_migrantworkersrenewal_' + fileNo).show();
                $('#migrantworkers_renewal_id').val(parseData.migrantworkers_renewal_id);
                var migrantworkersData = parseData.migrantworkers_renewal_data;

                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('seal_and_stamp_container_for_migrantworkersrenewal', 'seal_and_stamp_name_image_for_migrantworkersrenewal', 'seal_and_stamp_name_container_for_migrantworkersrenewal',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', migrantworkersData.signature, parseData.migrantworkers_renewal_id, VALUE_ONE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/migrantworkers/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/migrantworkers/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'MigrantworkersRenewal.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },

});
