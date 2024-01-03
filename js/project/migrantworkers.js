var migrantWorkersListTemplate = Handlebars.compile($('#migrantworkers_list_template').html());
var migrantWorkersTableTemplate = Handlebars.compile($('#migrantworkers_table_template').html());
var migrantWorkersActionTemplate = Handlebars.compile($('#migrantworkers_action_template').html());
var migrantWorkersFormTemplate = Handlebars.compile($('#migrantworkers_form_template').html());
var migrantWorkersViewTemplate = Handlebars.compile($('#migrantworkers_view_template').html());
var migrantWorkersApproveTemplate = Handlebars.compile($('#migrantworkers_approve_template').html());
var migrantWorkersViewItemTemplate = Handlebars.compile($('#migrantworkers_view_item_template').html());
var migrantWorkersItemTemplate = Handlebars.compile($('#migrantworkers_item_template').html());
var migrantWorkersUploadChallanTemplate = Handlebars.compile($('#migrantworkers_upload_challan_template').html());
var tempMigrantWorkersData = [];
var tempMigrantWorkersCnt = 1;
var MigrantWorkers = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
MigrantWorkers.Router = Backbone.Router.extend({
    routes: {
        'migrantworkers': 'renderList',
        'migrantworkers_form': 'renderListForForm',
    },
    renderList: function () {
        MigrantWorkers.listview.listPage();
    },
    renderListForForm: function () {
        MigrantWorkers.listview.listPageMigrantWorkersForm();
    }
});
MigrantWorkers.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_interstate_mw');
        addClass('menu_interstate_mw', 'active');
        MigrantWorkers.router.navigate('migrantworkers');
        var templateData = {};
        this.$el.html(migrantWorkersListTemplate(templateData));
        this.loadMigrantWorkersData(sDistrict, sStatus);
    },
    listPageMigrantWorkersForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('repairer', 'active');
        this.$el.html(migrantWorkersListTemplate);
        this.askForNewMigrantworkers();
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
        return migrantWorkersActionTemplate(rowData);
    },
    loadMigrantWorkersData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTYFOUR, data);
        };
        var that = this;
        $('#migrantworkers_form_and_table_container').html(migrantWorkersTableTemplate(searchData));
        migrantWorkersDataTable = $('#migrantworkers_datatable').DataTable({
            ajax: {url: 'migrantworkers/get_all_migrantworkers', dataSrc: "migrantworkers_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            ordering: false,
            pageLength: 10,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'mw_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'mw_name_of_establishment'},
                {data: 'mw_nature_of_work_of_establishment'},
                {data: 'mw_principal_employer_name'},
                {data: 'mw_principal_employer_address', 'class': 'v-a-m'},
                {data: 'mw_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'mw_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ]
        });
        $('#migrantworkers_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = migrantWorkersDataTable.row(tr);
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
    askForNewMigrantworkers: function (btnObj) {
        var that = this;
        that.newMigrantworkers(false, {}, {});
        that.addMultipleContractor({});
    },
    newMigrantworkers: function (isEdit, migrantWorkersData, contractorData) {
        var that = this;
        if (isEdit) {
            MigrantWorkers.router.navigate('edit_migrantworkers_form');
        } else {
            MigrantWorkers.router.navigate('migrantworkers_form');
        }
        var templateData = {};
        tempMigrantWorkersCnt = 1;
        templateData.migrantworkers_data = migrantWorkersData;
        templateData.contractor_data = contractorData;
        templateData.is_checked = IS_CHECKED_YES;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        $('#migrantworkers_form_and_table_container').html(migrantWorkersFormTemplate(templateData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(migrantWorkersData.district);
            $('#entity_establishment_type').val(migrantWorkersData.entity_establishment_type);
            $('#declaration_for_migrantworkers_registration').attr('checked', 'checked');
        }
        if (migrantWorkersData.mw_sign_of_principal_employer != '' && migrantWorkersData.mw_sign_of_principal_employer != null) {
            that.showDocument('seal_and_stamp_container_for_migrantworkers', 'seal_and_stamp_name_image_for_migrantworkers', 'seal_and_stamp_name_container_for_migrantworkers',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', migrantWorkersData.mw_sign_of_principal_employer, migrantWorkersData.mw_id, VALUE_ONE);
        }
        if (isEdit) {
            var cnt = 1;
            $.each(contractorData, function (index, value) {
                that.addMultipleContractor(value);
            });
            datePicker();
        }
        generateSelect2();
        $('#migrantworkers_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitMigrantworkers($('#submit_btn_for_migrantWorkers'));
            }
        });
    },
    askForSubmitMigrantworkers: function (moduleType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType == VALUE_TWO) {
            var yesEvent = 'MigrantWorkers.listview.submitMigrantworkers(\'' + moduleType + '\')';
            showConfirmation(yesEvent, 'Submit');
        } else {
            that.submitMigrantworkers(moduleType);
        }
    },
    submitMigrantworkers: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var migrantWorkersFormData = $('#migrantworkers_form').serializeFormJSON();
        var validationData = that.checkValidation(migrantWorkersFormData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('migrantworkers-' + validationData.field, validationData.message);
            return false;
        }

        var newContractorItems = [];
        var exiContractorItems = [];
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
            contractorItem.mc_date_of_commencement = dateTo_YYYY_MM_DD(csd);
            var ctd = $('#migrant_contractor_termination_date_' + cnt).val();
            if (ctd == '' || ctd == null) {
                $('#migrant_contractor_termination_date_' + cnt).focus();
                validationMessageShow('migrantworkers-migrant_contractor_termination_date_' + cnt, contractorTerminationDateValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.mc_date_of_termination = dateTo_YYYY_MM_DD(ctd);
            var mcid = $('#mc_id_' + cnt).val();
            if (mcid != '') {
                contractorItem.mc_id = mcid;
                exiContractorItems.push(contractorItem);
                console.log(exiContractorItems);
            } else {
                newContractorItems.push(contractorItem);
            }
        });
        if (isContractorItemValidation) {
            return false;
        }

        if ($('#seal_and_stamp_container_for_migrantworkers').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_migrantworkers', VALUE_TWO, 'migrantworkers');
            if (sealAndStamp == false) {
                return false;
            }
        }
        if (!$('#declaration_for_migrantworkers_registration').is(':checked')) {
            $('#declaration_for_migrantworkers_registration').focus();
            validationMessageShow('migrantworkers-declaration_for_migrantworkers_registration', establishmentDeclarationValidationMessage);
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#submit_btn_for_migrantworkers') : $('#draft_btn_for_migrantworkers');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#migrantworkers_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("new_contractor_data", JSON.stringify(newContractorItems));
        formData.append("exi_contractor_data", JSON.stringify(exiContractorItems));
        formData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'migrantworkers/submit_migrantworkers',
            data: formData,
            mimeType: 'multipart/form-data',
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
                validationMessageShow('migrantworkers', textStatus.statusText);
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
                    validationMessageShow('migrantworkers', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                that.listPage();
            }
        });
    },
    checkValidation: function (migrantWorkersFormData) {
        if (!migrantWorkersFormData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!migrantWorkersFormData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!migrantWorkersFormData.name_of_migrantworkers_registration) {
            return getBasicMessageAndFieldJSONArray('name_of_migrantworkers_registration', establishmentNameValidationMessage);
        }
        if (!migrantWorkersFormData.loaction_for_migrantworkers_registration) {
            return getBasicMessageAndFieldJSONArray('loaction_for_migrantworkers_registration', establishmentLocationValidationMessage);
        }
        if (!migrantWorkersFormData.postal_address_for_migrantworkers_registration) {
            return getBasicMessageAndFieldJSONArray('postal_address_for_migrantworkers_registration', establishmentPostelAddressValidationMessage);
        }
        if (!migrantWorkersFormData.nature_of_work_for_migrantworkers_registration) {
            return getBasicMessageAndFieldJSONArray('nature_of_work_for_migrantworkers_registration', establishmentTypeValidationMessage);
        }
        if (!migrantWorkersFormData.principle_employer_full_name_for_migrantworkers_registration) {
            return getBasicMessageAndFieldJSONArray('principle_employer_full_name_for_migrantworkers_registration', establishmentPrincipalNameValidationMessage);
        }
        if (!migrantWorkersFormData.principle_employer_address_for_migrantworkers_registration) {
            return getBasicMessageAndFieldJSONArray('principle_employer_address_for_migrantworkers_registration', establishmentPrincipalAddressValidationMessage);
        }
        if (!migrantWorkersFormData.manager_or_person_full_name_migrantworkers_registration) {
            return getBasicMessageAndFieldJSONArray('manager_or_person_full_name_migrantworkers_registration', establishmentManagerNameValidationMessage);
        }
        if (!migrantWorkersFormData.manager_or_person_address_for_migrantworkers_registration) {
            return getBasicMessageAndFieldJSONArray('manager_or_person_address_for_migrantworkers_registration', establishmentManagerAddressValidationMessage);
        }

        return '';
    },
    editOrViewMigrantworkers: function (btnObj, mwId, isEdit, tempId) {
        var that = this;
        if (!mwId) {
            validationMessageShow('migrantworkers-', 'Please select proper Details');
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }
        btnObj.html(spinnerTemplate);
        btnObj.attr('onclick', '');
        var template = isEdit ? 'Edit' : 'View';
        $.ajax({
            url: 'migrantworkers/get_migrantworkers_by_id',
            type: 'post',
            data: $.extend({}, {'mw_id': mwId}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(template);
                btnObj.attr('onclick', 'MigrantWorkers.listview.editOrViewMigrantworkers($(this),"' + mwId + '", ' + isEdit + ',"' + tempId + '"  )');
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
                btnObj.html(template);
                btnObj.attr('onclick', 'MigrantWorkers.listview.editOrViewMigrantworkers($(this),"' + mwId + '", ' + isEdit + ',"' + tempId + '")');
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
                var migrantWorkersData = parseData.migrantworkers_data;
                migrantWorkersData.mw_challan_date = dateTo_DD_MM_YYYY(migrantWorkersData.mw_challan_date);
                migrantWorkersData.mw_certificate_expiry_date = dateTo_DD_MM_YYYY(migrantWorkersData.mw_certificate_expiry_date);
                var contractorData = parseData.contractor_data;
                if (isEdit) {
                    that.newMigrantworkers(isEdit, migrantWorkersData, contractorData);
                } else {
                    that.viewMigrantworkers(migrantWorkersData, contractorData);
                }
            }
        });
    },
    viewMigrantworkers: function (migrantWorkersData, contractorData) {
        var that = this;
        var templateData = {};
        templateData.migrantworkers_data = migrantWorkersData;
        templateData.contractor_data = contractorData;
        if (migrantWorkersData.mw_challan_date == 'NaN-NaN-NaN') {
            var challanDate = templateData.migrantworkers_data;
            challanDate.mw_challan_date = '';
        }
        if (migrantWorkersData.mw_certificate_expiry_date == 'NaN-NaN-NaN') {
            var certificateExpiryDate = templateData.migrantworkers_data;
            certificateExpiryDate.mw_certificate_expiry_date = '';
        }
        $('#migrantworkers_form_and_table_container').html(migrantWorkersViewTemplate(templateData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(migrantWorkersData.district);
        $('#entity_establishment_type').val(migrantWorkersData.entity_establishment_type);
        if (migrantWorkersData.status == VALUE_ONE || migrantWorkersData.status == VALUE_TWO) {
            $('.migrantworkers_hidden').hide();
        } else if (migrantWorkersData.status == VALUE_THREE) {
            $('.migrantworkers_hidden').show();
        }

        if (migrantWorkersData.mw_sign_of_principal_employer != '') {
            that.showDocument('seal_and_stamp_container_for_migrantworkers_view', 'seal_and_stamp_name_image_for_migrantworkers_view', 'seal_and_stamp_name_container_for_migrantworkers_view',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', migrantWorkersData.mw_sign_of_principal_employer, migrantWorkersData.mw_id, VALUE_ONE);
        }
        $('#declaration_for_migrantworkers_registration').attr('checked', 'checked');

        var cnt = 1;
        $.each(contractorData, function (index, value) {
            value.cnt = cnt;
            $('#migrant_contractor_name_container_for_view').append(migrantWorkersViewItemTemplate(value));
            cnt++;
        });
    },
    generateFormIPDF: function (mwId) {
        if (!mwId) {
            showError('Please select proper Establishment Details');
            return false;
        }
        $('#mw_id_for_pdf').val(mwId);
        $('#mw_pdf_form').submit();
    },
    generateCertificate: function (mwId) {
        if (!mwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#mw_id_for_certificate').val(mwId);
        $('#mw_certificate_pdf_form').submit();
        $('#mw_id_for_certificate').val('');
    },
    addMultipleContractor: function (templateData) {
        templateData.item_cnt = tempMigrantWorkersCnt;
        $('#contractors_and_migrant_workman_details_container').append(migrantWorkersItemTemplate(templateData));
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
    downloadUploadChallan: function (mwId) {
        if (!mwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + mwId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'migrantworkers/get_migrantworkers_data_by_migrantworkers_id',
            type: 'post',
            data: $.extend({}, {'mw_id': mwId}, getTokenData()),
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
                var migrantworkersData = parseData.migrantworkers_data;
                that.showChallan(migrantworkersData);
            }
        });
    },
    showChallan: function (migrantworkersData) {
        showPopup();
        if (migrantworkersData.status != VALUE_FIVE && migrantworkersData.status != VALUE_SIX && migrantworkersData.status != VALUE_SEVEN) {
            if (!migrantworkersData.hide_submit_btn) {
                migrantworkersData.show_fees_paid = true;
            }
        }
        if (migrantworkersData.payment_type == VALUE_ONE) {
            migrantworkersData.utitle = 'Fees Paid Challan Copy';
        } else {
            migrantworkersData.style = 'display: none;';
        }
        if (migrantworkersData.payment_type == VALUE_TWO) {
            migrantworkersData.show_dd_po_option = true;
            migrantworkersData.utitle = 'Demand Draft (DD)';
        }
        migrantworkersData.module_type = VALUE_THIRTYFOUR;
        $('#popup_container').html(migrantWorkersUploadChallanTemplate(migrantworkersData));
        loadFB(VALUE_THIRTYFOUR, migrantworkersData.fb_data);
        loadPH(VALUE_THIRTYFOUR, migrantworkersData.mw_id, migrantworkersData.ph_data);

        if (migrantworkersData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'migrantworkers_upload_challan', migrantworkersData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'migrantworkers_upload_challan', 'uc', 'radio');
            if (migrantworkersData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_migrantworkers_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (migrantworkersData.challan != '') {
            $('#challan_container_for_migrantworkers_upload_challan').hide();
            $('#challan_name_container_for_migrantworkers_upload_challan').show();
            $('#challan_name_href_for_migrantworkers_upload_challan').attr('href', ADMIN_MIGRANTWORKERS_DOC_PATH + migrantworkersData.challan);
            $('#challan_name_for_migrantworkers_upload_challan').html(migrantworkersData.challan);
        }
        if (migrantworkersData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_migrantworkers_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_migrantworkers_upload_challan').show();
            $('#fees_paid_challan_name_href_for_migrantworkers_upload_challan').attr('href', 'documents/migrantworkers/' + migrantworkersData.fees_paid_challan);
            $('#fees_paid_challan_name_for_migrantworkers_upload_challan').html(migrantworkersData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_migrantworkers_upload_challan').attr('onclick', 'MigrantWorkers.listview.removeFeesPaidChallan("' + migrantworkersData.mw_id + '")');
        }
    },
    removeFeesPaidChallan: function (mwId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!mwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'migrantworkers/remove_fees_paid_challan',
            data: $.extend({}, {'mw_id': mwId}, getTokenData()),
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
                removeDocument('fees_paid_challan', 'migrantworkers_upload_challan');
                $('#status_' + mwId).html(appStatusArray[VALUE_THREE]);
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
        var mwId = $('#migrantworkers_id_for_migrantworkers_upload_challan').val();
        if (!mwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_migrantworkers_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_migrantworkers_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_migrantworkers_upload_challan').focus();
                validationMessageShow('migrantworkers-uc-fees_paid_challan_for_migrantworkers_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_migrantworkers_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_migrantworkers_upload_challan').focus();
                validationMessageShow('migrantworkers-uc-fees_paid_challan_for_migrantworkers_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_migrantworkers_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#migrantworkers_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'migrantworkers/upload_fees_paid_challan',
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
                $('#status_' + mwId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    askForRemove: function (mwId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!mwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'MigrantWorkers.listview.removeDocument(\'' + mwId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (mwId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!mwId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_migrantworkers_' + docType).hide();
        $('.spinner_name_container_for_migrantworkers_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'migrantworkers/remove_document',
            data: $.extend({}, {'mw_id': mwId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_migrantworkers_' + docType).hide();
                $('.spinner_name_container_for_migrantworkers_' + docType).show
                validationMessageShow('migrantworkers', textStatus.statusText);
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
                    validationMessageShow('migrantworkers', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_migrantworkers_' + docType).show();
                $('.spinner_name_container_for_migrantworkers_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_migrantworkers', 'seal_and_stamp_name_image_for_migrantworkers', 'seal_and_stamp_container_for_migrantworkers', 'seal_and_stamp_for_migrantworkers');
                }
            }
        });
    },
    getQueryData: function (mwId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!mwId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THIRTYFOUR;
        templateData.module_id = mwId;
        var btnObj = $('#query_btn_for_app_' + mwId);
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
                tmpData.application_number = regNoRenderer(VALUE_THIRTYFOUR, moduleData.mw_id);
                tmpData.applicant_name = moduleData.mw_name_of_establishment;
                tmpData.title = 'Establishment Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForMigrantWorkers: function (fileNo) {
        var that = this;
        if ($('#seal_and_stamp_for_migrantworkers').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_migrantworkers', VALUE_TWO, 'migrantworkers');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_migrantworkers_' + fileNo).hide();
        $('.spinner_name_container_for_migrantworkers_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var migrantworkersId = $('#mw_id').val();
        var formData = new FormData($('#migrantworkers_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("mw_id", migrantworkersId);
        $.ajax({
            type: 'POST',
            url: 'migrantworkers/upload_migrantworkers_document',
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
                $('.spinner_container_for_migrantworkers_' + fileNo).show();
                $('.spinner_name_container_for_migrantworkers_' + fileNo).hide();
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
                    $('.spinner_container_for_migrantworkers_' + fileNo).show();
                    $('.spinner_name_container_for_migrantworkers_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_migrantworkers_' + fileNo).hide();
                $('.spinner_name_container_for_migrantworkers_' + fileNo).show();
                $('#mw_id').val(parseData.mw_id);
                var migrantworkersData = parseData.migrantworkers_data;

                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('seal_and_stamp_container_for_migrantworkers', 'seal_and_stamp_name_image_for_migrantworkers', 'seal_and_stamp_name_container_for_migrantworkers',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', migrantworkersData.mw_sign_of_principal_employer, parseData.mw_id, VALUE_ONE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/migrantworkers/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/migrantworkers/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'MigrantWorkers.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});