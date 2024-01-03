var clactListTemplate = Handlebars.compile($('#clact_list_template').html());
var clactTableTemplate = Handlebars.compile($('#clact_table_template').html());
var clactFormTemplate = Handlebars.compile($('#clact_form_template').html());
var clactActionTemplate = Handlebars.compile($('#clact_action_template').html());
var clactItemTemplate = Handlebars.compile($('#clact_item_template').html());
var clactViewTemplate = Handlebars.compile($('#clact_view_template').html());
var clactViewItemTemplate = Handlebars.compile($('#clact_view_item_template').html());
var clactUploadChallanTemplate = Handlebars.compile($('#clact_upload_challan_template').html());
var tempContCnt = 1;
var CLACT = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
CLACT.Router = Backbone.Router.extend({
    routes: {
        'clact': 'renderList',
        'clact_form': 'renderListForForm',
        'edit_clact_form': 'renderList',
        'view_clact_form': 'renderList',
    },
    renderList: function () {
        CLACT.listview.listPage();
    },
    renderListForForm: function () {
        CLACT.listview.listPageCLACTForm();
    }
});
CLACT.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_clact');
        CLACT.router.navigate('clact');
        this.$el.html(clactListTemplate);
        this.loadCLACTData(sDistrict, sStatus);
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
                rowData.ADMIN_CLACT_DOC_PATH = ADMIN_CLACT_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return clactActionTemplate(rowData);
    },
    loadCLACTData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTYONE, data);
        };
        var that = this;
        CLACT.router.navigate('clact');
        $('#clact_form_and_datatable_container').html(clactTableTemplate(searchData));
        clactDatatable = $('#clact_datatable').DataTable({
            ajax: {url: 'clact/get_clact_data', dataSrc: "clact_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'establishment_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'establishment_name', 'class': 'v-a-m'},
                {data: 'nature_of_work', 'class': 'v-a-m'},
                {data: 'pe_full_name', 'class': 'v-a-m'},
                {data: 'pe_address', 'class': 'v-a-m'},
                {data: 'establishment_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'establishment_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#clact_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = clactDatatable.row(tr);

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
    listPageCLACTForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_clact');
        this.$el.html(clactListTemplate);
        this.addCLACT(false, {});
    },
    addContractor: function (contractorData) {
        contractorData.cnt = tempContCnt;
        if (contractorData.contractor_start_date) {
            contractorData.contractor_start_date_text = contractorData.contractor_start_date != '0000-00-00' ? dateTo_DD_MM_YYYY(contractorData.contractor_start_date) : '';
        }
        if (contractorData.contractor_termination_date) {
            contractorData.contractor_termination_date_text = contractorData.contractor_termination_date != '0000-00-00' ? dateTo_DD_MM_YYYY(contractorData.contractor_termination_date) : '';
        }
        $('#contractor_container_for_clact').append(clactItemTemplate(contractorData));
        allowOnlyIntegerValue('contractor_mobile_number_' + tempContCnt);
        allowOnlyIntegerValue('contractor_labour_' + tempContCnt);
        resetCounter('display-contractor-item-cnt');
        datePicker();
        tempContCnt++;
    },
    removeContractor: function (itemCnt) {
        $('.contractor_item_for_clact_' + itemCnt).remove();
        resetCounter('display-contractor-item-cnt');
    },
    addCLACT: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.clact_data;
            CLACT.router.navigate('edit_clact_form');
        } else {
            var formData = {};
            CLACT.router.navigate('clact_form');
        }
        tempContCnt = 1;
        formData.VALUE_ONE = VALUE_ONE;
        formData.VALUE_TWO = VALUE_TWO;
        $('#clact_form_and_datatable_container').html(clactFormTemplate(formData));
        allowOnlyIntegerValue('pe_mobile_number_for_clact');
        allowOnlyIntegerValue('mp_mobile_number_for_clact');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            var contData = parseData.contractor_data;
            $.each(contData, function (index, conData) {
                that.addContractor(conData);
            });
            $('#declaration_for_clact').prop('checked', true);
            if (formData.seal_and_stamp != '') {
                $('#seal_and_stamp_container_for_clact').hide();
                $('#seal_and_stamp_name_image_for_clact').attr('src', baseUrl + 'documents/clact/' + formData.seal_and_stamp);
                $('#seal_and_stamp_name_container_for_clact').show();
            }
        }
        generateSelect2();
        $('#clact_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitCLACT(VALUE_ONE);
            }
        });
    },
    checkValidationForCLACT: function (clactDetails) {
        if (!clactDetails.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!clactDetails.establishment_name_for_clact) {
            return getBasicMessageAndFieldJSONArray('establishment_name_for_clact', establishmentNameValidationMessage);
        }
        if (!clactDetails.establishment_location_for_clact) {
            return getBasicMessageAndFieldJSONArray('establishment_location_for_clact', establishmentLocationValidationMessage);
        }
        if (!clactDetails.establishment_postel_address_for_clact) {
            return getBasicMessageAndFieldJSONArray('establishment_postel_address_for_clact', establishmentPostalAddressValidationMessage);
        }
        if (!clactDetails.nature_of_work_for_clact) {
            return getBasicMessageAndFieldJSONArray('nature_of_work_for_clact', contractorNatureOfWorkingValidationMessage);
        }
        if (!clactDetails.pe_full_name_for_clact) {
            return getBasicMessageAndFieldJSONArray('pe_full_name_for_clact', establishmentPrincipalNameValidationMessage);
        }
        if (!clactDetails.pe_address_for_clact) {
            return getBasicMessageAndFieldJSONArray('pe_address_for_clact', establishmentPrincipalAddressValidationMessage);
        }
        if (!clactDetails.pe_mobile_number_for_clact) {
            return getBasicMessageAndFieldJSONArray('pe_mobile_number_for_clact', mobileValidationMessage);
        }
        var peMobileMessage = mobileNumberValidation(clactDetails.pe_mobile_number_for_clact);
        if (peMobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('pe_mobile_number_for_clact', peMobileMessage);
        }
        if (!clactDetails.pe_email_id_for_clact) {
            return getBasicMessageAndFieldJSONArray('pe_email_id_for_clact', emailValidationMessage);
        }
        var peEmailMessage = emailIdValidation(clactDetails.pe_email_id_for_clact);
        if (peEmailMessage != '') {
            return getBasicMessageAndFieldJSONArray('pe_email_id_for_clact', peEmailMessage);
        }
        if (!clactDetails.mp_full_name_for_clact) {
            return getBasicMessageAndFieldJSONArray('mp_full_name_for_clact', establishmentManagerNameValidationMessage);
        }
        if (!clactDetails.mp_address_for_clact) {
            return getBasicMessageAndFieldJSONArray('mp_address_for_clact', establishmentManagerAddressValidationMessage);
        }
        if (!clactDetails.mp_mobile_number_for_clact) {
            return getBasicMessageAndFieldJSONArray('mp_mobile_number_for_clact', mobileValidationMessage);
        }
        var mpMobileMessage = mobileNumberValidation(clactDetails.mp_mobile_number_for_clact);
        if (mpMobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mp_mobile_number_for_clact', mpMobileMessage);
        }
        if (!clactDetails.mp_email_id_for_clact) {
            return getBasicMessageAndFieldJSONArray('mp_email_id_for_clact', emailValidationMessage);
        }
        var mpEmailMessage = emailIdValidation(clactDetails.mp_email_id_for_clact);
        if (mpEmailMessage != '') {
            return getBasicMessageAndFieldJSONArray('mp_email_id_for_clact', mpEmailMessage);
        }
        return '';
    },
    askForSubmitCLACT: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'CLACT.listview.submitCLACT(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitCLACT: function (moduleType) {
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
        var seekerStaffDetailsData = $('#clact_form').serializeFormJSON();
        var validationData = that.checkValidationForCLACT(seekerStaffDetailsData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('clact-' + validationData.field, validationData.message);
            return false;
        }
        var tempCntForContractor = 0;
        var newContractorItems = [];
        var exiContractorItems = [];
        var isContractorItemValidation = false;
        $('.contractor-item-for-clact').each(function () {
            var ciCnt = $(this).find('.contractor-item-cnt').val();
            var contractorItem = {};
            var cpn = $('#contractor_proprietor_name_' + ciCnt).val();
            if (cpn == '' || cpn == null) {
                $('#contractor_proprietor_name_' + ciCnt).focus();
                validationMessageShow('clact-contractor_proprietor_name_' + ciCnt, contractorPropriterNameValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.contractor_proprietor_name = cpn;
            var cn = $('#contractor_name_' + ciCnt).val();
            if (cn == '' || cn == null) {
                $('#contractor_name_' + ciCnt).focus();
                validationMessageShow('clact-contractor_name_' + ciCnt, contractorNameValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.contractor_name = cn;

            var cei = $('#contractor_email_id_' + ciCnt).val();
            if (cei == '' || cei == null) {
                $('#contractor_email_id_' + ciCnt).focus();
                validationMessageShow('clact-contractor_email_id_' + ciCnt, emailValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            var ceiMessage = emailIdValidation(cei);
            if (ceiMessage != '') {
                $('#contractor_email_id_' + ciCnt).focus();
                validationMessageShow('clact-contractor_email_id_' + ciCnt, ceiMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.email_id = cei;

            var cmn = $('#contractor_mobile_number_' + ciCnt).val();
            if (cmn == '' || cmn == null) {
                $('#contractor_mobile_number_' + ciCnt).focus();
                validationMessageShow('clact-contractor_mobile_number_' + ciCnt, mobileValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            var cmnMessage = mobileNumberValidation(cmn);
            if (cmnMessage != '') {
                $('#contractor_mobile_number_' + ciCnt).focus();
                validationMessageShow('clact-contractor_mobile_number_' + ciCnt, cmnMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.mobile_number = cmn;

            var ca = $('#contractor_address_' + ciCnt).val();
            if (ca == '' || ca == null) {
                $('#contractor_address_' + ciCnt).focus();
                validationMessageShow('clact-contractor_address_' + ciCnt, contractorAddressValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.contractor_address = ca;

            var cnow = $('#nature_of_work_' + ciCnt).val();
            if (cnow == '' || cnow == null) {
                $('#nature_of_work_' + ciCnt).focus();
                validationMessageShow('clact-nature_of_work_' + ciCnt, contractorNatureOfWorkingValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.nature_of_work = cnow;

            var cl = $('#contractor_labour_' + ciCnt).val();
            if (cl == '' || cl == null) {
                $('#contractor_labour_' + ciCnt).focus();
                validationMessageShow('clact-contractor_labour_' + ciCnt, contractorLabourValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.contractor_labour = cl;

            var csd = $('#contractor_start_date_' + ciCnt).val();
            if (csd == '' || csd == null) {
                $('#contractor_start_date_' + ciCnt).focus();
                validationMessageShow('clact-contractor_start_date_' + ciCnt, contractorStartDateValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.contractor_start_date = dateTo_YYYY_MM_DD(csd);

            var ctd = $('#contractor_termination_date_' + ciCnt).val();
            if (ctd == '' || ctd == null) {
                $('#contractor_termination_date_' + ciCnt).focus();
                validationMessageShow('clact-contractor_termination_date_' + ciCnt, contractorTerminationDateValidationMessage);
                isContractorItemValidation = true;
                return false;
            }
            contractorItem.contractor_termination_date = dateTo_YYYY_MM_DD(ctd);
            var ci = $('#contractor_id_' + ciCnt).val();
            if (ci != '') {
                contractorItem.establishment_contractor_id = ci;
                exiContractorItems.push(contractorItem);
            } else {
                newContractorItems.push(contractorItem);
            }
            tempCntForContractor++;
        });
        if (isContractorItemValidation) {
            return false;
        }
        if (tempCntForContractor == 0) {
            validationMessageShow('clact', oneContractorValidationMessage);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }
        if ($('#seal_and_stamp_container_for_clact').is(':visible')) {
            var sealAndStamp = $('#seal_and_stamp_for_clact').val();
            if (sealAndStamp == '') {
                $('#seal_and_stamp_for_clact').focus();
                validationMessageShow('clact-seal_and_stamp_for_clact', uploadDocumentValidationMessage);
                return false;
            }
            var sealAndStampMessage = imagefileUploadValidation('seal_and_stamp_for_clact');
            if (sealAndStampMessage != '') {
                $('#seal_and_stamp_for_clact').focus();
                validationMessageShow('clact-seal_and_stamp_for_clact', sealAndStampMessage);
                return false;
            }
        }
        if (!$('#declaration_for_clact').is(':checked')) {
            $('#declaration_for_clact').focus();
            validationMessageShow('clact-declaration_for_clact', establishmentDeclarationValidationMessage);
            return false;
        }
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_clact') : $('#submit_btn_for_clact');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#clact_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("new_contractor_item_for_clact", JSON.stringify(newContractorItems));
        formData.append("exi_contractor_item_for_clact", JSON.stringify(exiContractorItems));
        formData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'clact/submit_clact',
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
                validationMessageShow('clact', textStatus.statusText);
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
                    validationMessageShow('clact', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                CLACT.router.navigate('clact', {'trigger': true});
            }
        });
    },
    editOrViewCLACT: function (btnObj, aeId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!aeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'clact/get_clact_data_by_id',
            type: 'post',
            data: $.extend({}, {'clact_id': aeId}, getTokenData()),
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
                    that.addCLACT(true, parseData);
                } else {
                    that.viewCLACT(parseData);
                }
            }
        });
    },
    viewCLACT: function (parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var formData = parseData.clact_data;
        CLACT.router.navigate('view_clact_form');
        formData.valid_upto_text = formData.valid_upto != '0000-00-00' ? dateTo_DD_MM_YYYY(formData.valid_upto) : '';
        $('#clact_form_and_datatable_container').html(clactViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        var contData = parseData.contractor_data;
        var contCnt = 1;
        $.each(contData, function (index, conData) {
            conData.contractor_start_date_text = conData.contractor_start_date != '0000-00-00' ? dateTo_DD_MM_YYYY(conData.contractor_start_date) : '';
            conData.contractor_termination_date_text = conData.contractor_termination_date != '0000-00-00' ? dateTo_DD_MM_YYYY(conData.contractor_termination_date) : '';
            conData.cnt = contCnt;
            $('#contractor_container_for_clact_view').append(clactViewItemTemplate(conData));
            contCnt++;
        });
        if (formData.seal_and_stamp != '') {
            $('#seal_and_stamp_container_for_clact_view').hide();
            $('#seal_and_stamp_name_image_for_clact_view').attr('src', baseUrl + 'documents/clact/' + formData.seal_and_stamp);
            $('#seal_and_stamp_name_container_for_clact_view').show();
        }
    },
    askForRemove: function (establishmentId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!establishmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'CLACT.listview.removeDocument(\'' + establishmentId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (establishmentId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!establishmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_clact_' + docType).hide();
        $('.spinner_name_container_for_clact_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'clact/remove_document',
            data: $.extend({}, {'establishment_id': establishmentId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_clact_' + docType).hide();
                $('.spinner_name_container_for_clact_' + docType).show();
                validationMessageShow('clact', textStatus.statusText);
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
                    validationMessageShow('clact', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_clact_' + docType).show();
                $('.spinner_name_container_for_clact_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('seal_and_stamp_name_container_for_clact', 'seal_and_stamp_name_image_for_clact', 'seal_and_stamp_container_for_clact', 'seal_and_stamp_for_clact');
                }
//                $('#seal_and_stamp_name_container_for_clact').hide();
//                $('#seal_and_stamp_name_image_for_clact').attr('src', '');
//                $('#seal_and_stamp_container_for_clact').show();
//                $('#seal_and_stamp_for_clact').val('');
            }
        });
    },
    generateForm1: function (establishmentId) {
        if (!establishmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#establishment_id_for_clact_form1').val(establishmentId);
        $('#establishment_form1_pdf_form').submit();
        $('#establishment_id_for_clact_form1').val('');
    },
    downloadUploadChallan: function (establishmentId) {
        if (!establishmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + establishmentId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'clact/get_clact_data_by_clact_id',
            type: 'post',
            data: $.extend({}, {'clact_id': establishmentId}, getTokenData()),
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
                var clactData = parseData.clact_data;
                that.showChallan(clactData);
            }
        });
    },
    showChallan: function (clactData) {
        showPopup();
        if (clactData.status != VALUE_FIVE && clactData.status != VALUE_SIX && clactData.status != VALUE_SEVEN) {
            if (!clactData.hide_submit_btn) {
                clactData.show_fees_paid = true;
            }
        }
        if (clactData.payment_type == VALUE_ONE) {
            clactData.utitle = 'Fees Paid Challan Copy';
        } else {
            clactData.style = 'display: none;';
        }
        if (clactData.payment_type == VALUE_TWO) {
            clactData.show_dd_po_option = true;
            clactData.utitle = 'Demand Draft (DD)';
        }
        clactData.module_type = VALUE_THIRTYONE;
        $('#popup_container').html(clactUploadChallanTemplate(clactData));
        loadFB(VALUE_THIRTYONE, clactData.fb_data);
        loadPH(VALUE_THIRTYONE, clactData.establishment_id, clactData.ph_data);

        if (clactData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'clact_upload_challan', clactData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'clact_upload_challan', 'uc', 'radio');
            if (clactData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_clact_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (clactData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_clact_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_clact_upload_challan').show();
            $('#fees_paid_challan_name_href_for_clact_upload_challan').attr('href', 'documents/clact/' + clactData.fees_paid_challan);
            $('#fees_paid_challan_name_for_clact_upload_challan').html(clactData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_clact_upload_challan').attr('onclick', 'CLACT.listview.removeFeesPaidChallan("' + clactData.establishment_id + '")');
        }
    },
    removeFeesPaidChallan: function (establishmentId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!establishmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'clact/remove_fees_paid_challan',
            data: $.extend({}, {'establishment_id': establishmentId}, getTokenData()),
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
                validationMessageShow('clact-uc', textStatus.statusText);
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
                    validationMessageShow('clact-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-clact-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'clact_upload_challan');
                $('#status_' + establishmentId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-clact-uc').html('');
        validationMessageHide();
        var establishmentId = $('#clact_id_for_clact_upload_challan').val();
        if (!establishmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_clact_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_clact_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_clact_upload_challan').focus();
                validationMessageShow('clact-uc-fees_paid_challan_for_clact_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_clact_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_clact_upload_challan').focus();
                validationMessageShow('clact-uc-fees_paid_challan_for_clact_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_clact_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#clact_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'clact/upload_fees_paid_challan',
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
                validationMessageShow('clact-uc', textStatus.statusText);
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
                    validationMessageShow('clact-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + establishmentId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (establishmentId) {
        if (!establishmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#establishment_id_for_certificate').val(establishmentId);
        $('#establishment_certificate_pdf_form').submit();
        $('#establishment_id_for_certificate').val('');
    },
    getQueryData: function (establishmentId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!establishmentId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THIRTYONE;
        templateData.module_id = establishmentId;
        var btnObj = $('#query_btn_for_app_' + establishmentId);
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
                tmpData.application_number = regNoRenderer(VALUE_THIRTYONE, moduleData.establishment_id);
                tmpData.applicant_name = moduleData.establishment_name;
                tmpData.title = 'Establishment Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForCLACT: function (fileNo) {
        var that = this;

        if ($('#seal_and_stamp_for_clact').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_clact', VALUE_TWO, 'clact');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_clact_' + fileNo).hide();
        $('.spinner_name_container_for_clact_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var clactId = $('#clact_id_for_clact').val();
        var formData = new FormData($('#clact_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("clact_id", clactId);
        $.ajax({
            type: 'POST',
            url: 'clact/upload_clact_document',
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
                $('.spinner_container_for_clact_' + fileNo).show();
                $('.spinner_name_container_for_clact_' + fileNo).hide();
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
                    $('.spinner_container_for_clact_' + fileNo).show();
                    $('.spinner_name_container_for_clact_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_clact_' + fileNo).hide();
                $('.spinner_name_container_for_clact_' + fileNo).show();
                $('#clact_id_for_clact').val(parseData.establishment_id);
                var clactData = parseData.clact_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('seal_and_stamp_container_for_clact', 'seal_and_stamp_name_image_for_clact', 'seal_and_stamp_name_container_for_clact',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', clactData.seal_and_stamp, parseData.establishment_id, VALUE_ONE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/clact/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/clact/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'CLACT.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});