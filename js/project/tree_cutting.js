var treeCuttingListTemplate = Handlebars.compile($('#tree_cutting_list_template').html());
var treeCuttingTableTemplate = Handlebars.compile($('#tree_cutting_table_template').html());
var treeCuttingActionTemplate = Handlebars.compile($('#tree_cutting_action_template').html());
var treeCuttingFormTemplate = Handlebars.compile($('#tree_cutting_form_template').html());
var treeCuttingViewTemplate = Handlebars.compile($('#tree_cutting_view_template').html());
var treeCuttingUploadChallanTemplate = Handlebars.compile($('#tree_cutting_upload_challan_template').html());
var TreeCutting = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
TreeCutting.Router = Backbone.Router.extend({
    routes: {
        'tree_cutting': 'renderList',
        'tree_cutting_form': 'renderList'
    },
    renderList: function () {
        TreeCutting.listview.listPage();
    },
    renderListForForm: function () {
        TreeCutting.listview.listPageTreeCuttingForm();
    }
});
TreeCutting.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        TreeCutting.router.navigate('tree_cutting');
        var templateData = {};
        this.$el.html(treeCuttingListTemplate(templateData));
        this.loadTreeCuttingData(sDistrict, sStatus);

    },
    listPageTreeCuttingForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        TreeCutting.router.navigate('tree_cutting');
        this.$el.html(treeCuttingListTemplate);
        this.newTreeCuttingForm(false, {});
    },
    actionRenderer: function (rowData) {
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE ||
                (rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX && rowData.query_status == VALUE_ONE)) {
            rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_form_one_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE && rowData.status != VALUE_TWO && rowData.status != VALUE_SIX && rowData.status != VALUE_NINE) {
            if (rowData.payment_type != VALUE_THREE) {
                rowData.ADMIN_TREE_CUTTING_DOC_PATH = ADMIN_TREE_CUTTING_DOC_PATH;
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
        rowData.module_type = VALUE_FIFTYNINE;
        return treeCuttingActionTemplate(rowData);
    },
    loadTreeCuttingData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FIFTYNINE, data)
                    + getFRContainer(VALUE_FIFTYNINE, data, full.rating, full.fr_datetime);
        };
        var dvRenderer = function (data, type, full, meta) {
            var villageData = full.district == VALUE_ONE ? damanVillagesArray : (full.district == VALUE_TWO ? diuVillagesArray : (full.district == VALUE_THREE ? dnhVillagesArray : []));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village_dmc_ward] ? villageData[full.village_dmc_ward] : '');
        };
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i></b> :- ' + full.applicant_name +
                    '<hr><b><i class="fas fa-map f-s-10px"></i></b> :- ' + full.applicant_address +
                    '<hr><b><i class="fas fa-phone-volume f-s-10px"></i></b> :- ' + full.applicant_mobile_number;
        };
        var ownerDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i></b> :- ' + full.owner_name +
                    '<hr><b><i class="fas fa-map f-s-10px"></i></b> :- ' + full.owner_address;
        };
        var that = this;
        TreeCutting.router.navigate('tree_cutting');
        $('#tree_cutting_form_and_datatable_container').html(treeCuttingTableTemplate(searchData));
        treeCuttingDataTable = $('#tree_cutting_datatable').DataTable({
            ajax: {url: 'tree_cutting/get_tree_cutting_data', dataSrc: "tree_cutting_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'tree_cutting_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'district', 'class': 'text-center', 'render': dvRenderer},
                {data: '', 'class': 'f-s-13px', 'render': appDetailsRenderer},
                {data: '', 'class': 'f-s-13px', 'render': ownerDetailsRenderer},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'tree_cutting_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'tree_cutting_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#tree_cutting_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = treeCuttingDataTable.row(tr);

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
    districtChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'village_dmc_ward_for_tree_cutting');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_dmc_ward_for_tree_cutting');
    },
    newTreeCuttingForm: function (isEdit, treeCuttingData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (isEdit) {
            if (treeCuttingData.status != VALUE_FIVE && treeCuttingData.status != VALUE_SIX && treeCuttingData.query_status == VALUE_ONE) {
                treeCuttingData.show_submit_qr_details = true;
            }
        } else {
            treeCuttingData.m_doc = [];
        }
        var that = this;
        treeCuttingData.module_type = VALUE_FIFTYNINE;
        $('#tree_cutting_form_and_datatable_container').html(treeCuttingFormTemplate(treeCuttingData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_tree_cutting');
        var villageData = isEdit ? (treeCuttingData.district == VALUE_ONE ? damanVillagesArray : (treeCuttingData.district == VALUE_TWO ? diuVillagesArray : (treeCuttingData.district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_dmc_ward_for_tree_cutting');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type_for_tree_cutting');
        if (isEdit) {
            $('#district_for_tree_cutting').val(treeCuttingData.district);
            $('#village_dmc_ward_for_tree_cutting').val(treeCuttingData.village_dmc_ward);
            $('#entity_establishment_type_for_tree_cutting').val(treeCuttingData.entity_establishment_type);
        }
        loadMRefDoc(VALUE_FIFTYNINE);
        loadMDoc(VALUE_FIFTYNINE, treeCuttingData.m_doc);
        loadMOtherDoc(VALUE_FIFTYNINE, treeCuttingData.m_other_doc);
        allowOnlyIntegerValue('applicant_mobile_number_for_tree_cutting');
        generateSelect2();
        $('#tree_cutting_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitTreeCutting(treeCuttingData.show_submit_qr_details ? VALUE_FOUR : VALUE_THREE);
            }
        });
    },
    editOrViewTreeCutting: function (btnObj, treeCuttingId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!treeCuttingId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'tree_cutting/get_tree_cutting_data_by_id',
            type: 'post',
            data: $.extend({}, {'tree_cutting_id': treeCuttingId, 'is_edit': (isEdit ? VALUE_ZERO : VALUE_ONE)}, getTokenData()),
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
                var treeCuttingData = parseData.tree_cutting_data;
                if (isEdit) {
                    that.newTreeCuttingForm(isEdit, treeCuttingData);
                } else {
                    that.viewTreeCuttingForm(treeCuttingData);
                }
            }
        });
    },
    viewTreeCuttingForm: function (treeCuttingData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        treeCuttingData.module_type = VALUE_FIFTYNINE;
        treeCuttingData.application_number = regNoRenderer(VALUE_FIFTYNINE, treeCuttingData.tree_cutting_id);
        treeCuttingData.district_text = talukaArray[treeCuttingData.district] ? talukaArray[treeCuttingData.district] : '';
        var villageData = treeCuttingData.district == VALUE_ONE ? damanVillagesArray : (treeCuttingData.district == VALUE_TWO ? diuVillagesArray : (treeCuttingData.district == VALUE_THREE ? dnhVillagesArray : []));
        treeCuttingData.village_dmc_ward_text = villageData[treeCuttingData.village_dmc_ward] ? villageData[treeCuttingData.village_dmc_ward] : '';
        treeCuttingData.entity_establishment_type_text = entityEstablishmentTypeArray[treeCuttingData.entity_establishment_type] ? entityEstablishmentTypeArray[treeCuttingData.entity_establishment_type] : '';
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(treeCuttingViewTemplate(treeCuttingData));

        loadMDoc(VALUE_FIFTYNINE, treeCuttingData.m_doc, '_view');
        if (treeCuttingData['m_other_doc'].length != VALUE_ZERO) {
            loadMOtherDoc(VALUE_FIFTYNINE, treeCuttingData.m_other_doc, '_view');
        }
    },
    checkValidationForTreeCutting: function (treeCuttingData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!treeCuttingData.district_for_tree_cutting) {
            return getBasicMessageAndFieldJSONArray('district_for_tree_cutting', selectDistrictValidationMessage);
        }
        if (!treeCuttingData.village_dmc_ward_for_tree_cutting) {
            return getBasicMessageAndFieldJSONArray('village_dmc_ward_for_tree_cutting', oneOptionValidationMessage);
        }
        if (!treeCuttingData.entity_establishment_type_for_tree_cutting) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type_for_tree_cutting', entityEstablishmentTypeValidationMessage);
        }
        if (!treeCuttingData.applicant_name_for_tree_cutting) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_tree_cutting', applicantNameValidationMessage);
        }
        if (!treeCuttingData.applicant_address_for_tree_cutting) {
            return getBasicMessageAndFieldJSONArray('applicant_address_for_tree_cutting', addressValidationMessage);
        }
        if (!treeCuttingData.applicant_mobile_number_for_tree_cutting) {
            return getBasicMessageAndFieldJSONArray('applicant_mobile_number_for_tree_cutting', mobileValidationMessage);
        }
        var mobMessage = mobileNumberValidation(treeCuttingData.applicant_mobile_number_for_tree_cutting);
        if (mobMessage != '') {
            return getBasicMessageAndFieldJSONArray('applicant_mobile_number_for_tree_cutting', mobMessage);
        }
        if (!treeCuttingData.owner_name_for_tree_cutting) {
            return getBasicMessageAndFieldJSONArray('owner_name_for_tree_cutting', ownerNameValidationMessage);
        }
        if (!treeCuttingData.owner_address_for_tree_cutting) {
            return getBasicMessageAndFieldJSONArray('owner_address_for_tree_cutting', ownerAddressValidationMessage);
        }
        return '';
    },
    askForSubmitTreeCutting: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_THREE && moduleType != VALUE_FOUR) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var newMType = moduleType == VALUE_THREE ? VALUE_TWO : VALUE_FIVE;
        var yesEvent = 'TreeCutting.listview.submitTreeCutting(' + newMType + ')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitTreeCutting: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FOUR && moduleType != VALUE_FIVE) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        validationMessageHide();
        var treeCuttingData = $('#tree_cutting_form').serializeFormJSON();
        var validationData = that.checkValidationForTreeCutting(treeCuttingData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('tree-cutting-' + validationData.field, validationData.message);
            return false;
        }
        if (moduleType != VALUE_ONE) {
            var isDocValidation = checkValidationForMDoc(VALUE_FIFTYNINE);
            if (isDocValidation) {
                return false;
            }
        }
        var isMODItemValidation = checkValidationForMOtherDoc(moduleType, VALUE_FIFTYNINE);
        if (!isMODItemValidation) {
            return false;
        }
        treeCuttingData.new_mod_items = isMODItemValidation.new_mod_items;
        treeCuttingData.exi_mod_items = isMODItemValidation.exi_mod_items;
        if (moduleType == VALUE_THREE) {
            that.askForSubmitTreeCutting(moduleType);
            return false;
        }
        if (moduleType == VALUE_FOUR || moduleType == VALUE_FIVE) {
            var status = $('#status_for_tree_cutting').val();
            var queryStatus = $('#query_status_for_tree_cutting').val();
            if (status != VALUE_FIVE && status != VALUE_SIX && queryStatus == VALUE_ONE) {
                var qrRemarks = $('#remarks_for_tree_cutting').val();
                if (!qrRemarks) {
                    $('#remarks_for_tree_cutting').focus();
                    validationMessageShow('qrtc-remarks_for_tree_cutting', remarksValidationMessage);
                    return false;
                }
                treeCuttingData.qr_remarks = qrRemarks;
            } else {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (moduleType == VALUE_FOUR) {
                that.askForSubmitTreeCutting(moduleType);
                return false;
            }
        }
        treeCuttingData.module_type = moduleType;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_tree_cutting') : $('#submit_btn_for_tree_cutting');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'tree_cutting/submit_tree_cutting',
            data: $.extend({}, treeCuttingData, getTokenData()),
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
                validationMessageShow('tree-cutting', textStatus.statusText);
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
                    validationMessageShow('tree-cutting', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                TreeCutting.listview.loadTreeCuttingData();
                showSuccess(parseData.message);
            }
        });
    },
    downloadUploadChallan: function (treeCuttingId) {
        if (!treeCuttingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + treeCuttingId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'tree_cutting/get_tree_cutting_data_by_tree_cutting_id',
            type: 'post',
            data: $.extend({}, {'tree_cutting_id': treeCuttingId}, getTokenData()),
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
                var treeCuttingData = parseData.tree_cutting_data;
                that.showChallan(treeCuttingData);
            }
        });
    },
    showChallan: function (treeCuttingData) {
        showPopup();
        if (treeCuttingData.status != VALUE_FIVE && treeCuttingData.status != VALUE_SIX && treeCuttingData.status != VALUE_SEVEN) {
            if (!treeCuttingData.hide_submit_btn) {
                treeCuttingData.show_fees_paid = true;
            }
        }
        if (treeCuttingData.payment_type == VALUE_ONE) {
            treeCuttingData.utitle = 'Fees Paid Challan Copy';
        } else {
            treeCuttingData.style = 'display: none;';
        }
        if (treeCuttingData.payment_type == VALUE_TWO) {
            treeCuttingData.show_dd_po_option = true;
            treeCuttingData.utitle = 'Demand Draft (DD)';
        }
        treeCuttingData.module_type = VALUE_FIFTYNINE;
        $('#popup_container').html(treeCuttingUploadChallanTemplate(treeCuttingData));
        loadFB(VALUE_FIFTYNINE, treeCuttingData.fb_data);
        loadPH(VALUE_FIFTYNINE, treeCuttingData.tree_cutting_id, treeCuttingData.ph_data);

        if (treeCuttingData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'tree_cutting_upload_challan', treeCuttingData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'tree_cutting_upload_challan', 'uc', 'radio');
            if (treeCuttingData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_tree_cutting_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (treeCuttingData.challan != '') {
            $('#challan_container_for_tree_cutting_upload_challan').hide();
            $('#challan_name_container_for_tree_cutting_upload_challan').show();
            $('#challan_name_href_for_tree_cutting_upload_challan').attr('href', 'documents/tree_cutting/' + treeCuttingData.challan);
            $('#challan_name_for_tree_cutting_upload_challan').html(treeCuttingData.challan);
        }
        if (treeCuttingData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_tree_cutting_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_tree_cutting_upload_challan').show();
            $('#fees_paid_challan_name_href_for_tree_cutting_upload_challan').attr('href', 'documents/tree_cutting/' + treeCuttingData.fees_paid_challan);
            $('#fees_paid_challan_name_for_tree_cutting_upload_challan').html(treeCuttingData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_tree_cutting_upload_challan').attr('onclick', 'TreeCutting.listview.removeFeesPaidChallan("' + treeCuttingData.tree_cutting_id + '")');
        }
    },
    removeFeesPaidChallan: function (treeCuttingId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!treeCuttingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'tree_cutting/remove_fees_paid_challan',
            data: $.extend({}, {'tree_cutting_id': treeCuttingId}, getTokenData()),
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
                validationMessageShow('tree-cutting-uc', textStatus.statusText);
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
                    validationMessageShow('tree-cutting-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-tree-cutting-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'tree_cutting_upload_challan');
                $('#status_' + treeCuttingId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-tree-cutting-uc').html('');
        validationMessageHide();
        var treeCuttingId = $('#tree_cutting_id_for_tree_cutting_upload_challan').val();
        if (!treeCuttingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_tree_cutting_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_tree_cutting_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_tree_cutting_upload_challan').focus();
                validationMessageShow('tree-cutting-uc-fees_paid_challan_for_tree_cutting_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_tree_cutting_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_tree_cutting_upload_challan').focus();
                validationMessageShow('tree-cutting-uc-fees_paid_challan_for_tree_cutting_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_tree_cutting_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#tree_cutting_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'tree_cutting/upload_fees_paid_challan',
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
                validationMessageShow('tree-cutting-uc', textStatus.statusText);
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
                    validationMessageShow('tree-cutting-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + treeCuttingId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    getQueryData: function (treeCuttingId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!treeCuttingId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FIFTYNINE;
        templateData.module_id = treeCuttingId;
        var btnObj = $('#query_btn_for_tree_cutting_' + treeCuttingId);
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
                tmpData.application_number = regNoRenderer(VALUE_FIFTYNINE, moduleData.tree_cutting_id);
                tmpData.applicant_name = moduleData.applicant_name;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
});
