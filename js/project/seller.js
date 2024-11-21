var sellerListTemplate = Handlebars.compile($('#seller_list_template').html());
var sellerTableTemplate = Handlebars.compile($('#seller_table_template').html());
var sellerActionTemplate = Handlebars.compile($('#seller_action_template').html());
var sellerFormTemplate = Handlebars.compile($('#seller_form_template').html());
var sellerViewTemplate = Handlebars.compile($('#seller_view_template').html());
var sellerUploadChallanTemplate = Handlebars.compile($('#seller_upload_challan_template').html());
var tempPersonCnt = 1;

var Seller = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

Seller.Router = Backbone.Router.extend({
    routes: {
        'seller': 'renderList',
        'seller_form': 'renderListForForm',
        'edit_seller_form': 'renderList',
        'view_seller_form': 'renderList',
    },
    renderList: function () {
        Seller.listview.listPage();
    },
    renderListForForm: function () {
        Seller.listview.listPageSellerForm();
    }
});
Seller.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="request_letter_reason"]': 'hasReasonOfLeased',
        'click input[name="original_extract"]': 'hasOriginalextract',
        'click input[name="nodue_from_mamlatdar"]': 'hasNoDueMaml',
        'click input[name="nodue_from_electricity"]': 'hasNoDueElect',
        'click input[name="nodue_from_bank"]': 'hasNoDueBank',
        'click input[name="nodues_from_grampanchayat"]': 'hasNoDuePanchayat',
        'click input[name="challan_of_lease"]': 'hasChallanLease',
        'click input[name="occupancy_certy"]': 'hasOccupCerty',
        'click input[name="nodue_from_excise"]': 'hasNoDueExc',
        'click input[name="sign_behalf_lessee"]': 'hasSignBehalf',
    },
    hasReasonOfLeased: function (event) {
        var val = $('input[name=request_letter_reason]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.request_letter_reason_div').show();
        } else {
            this.$('.request_letter_reason_div').hide();

        }
    },
    hasOriginalextract: function (event) {
        var val = $('input[name=original_extract]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.original_extract_div').show();
        } else {
            this.$('.original_extract_div').hide();

        }
    },
    hasNoDueMaml: function (event) {
        var val = $('input[name=nodue_from_mamlatdar]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.nodue_from_mamlatdar_div').show();
        } else {
            this.$('.nodue_from_mamlatdar_div').hide();

        }
    },
    hasNoDueElect: function (event) {
        var val = $('input[name=nodue_from_electricity]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.nodue_from_electricity_div').show();
        } else {
            this.$('.nodue_from_electricity_div').hide();

        }
    },
    hasNoDueBank: function (event) {
        var val = $('input[name=nodue_from_bank]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.nodue_from_bank_div').show();
        } else {
            this.$('.nodue_from_bank_div').hide();

        }
    },
    hasNoDuePanchayat: function (event) {
        var val = $('input[name=nodues_from_grampanchayat]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.nodues_from_grampanchayat_div').show();
        } else {
            this.$('.nodues_from_grampanchayat_div').hide();

        }
    },
    hasChallanLease: function (event) {
        var val = $('input[name=challan_of_lease]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.challan_of_lease_div').show();
        } else {
            this.$('.challan_of_lease_div').hide();

        }
    },
    hasOccupCerty: function (event) {
        var val = $('input[name=occupancy_certy]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.occupancy_certy_div').show();
        } else {
            this.$('.occupancy_certy_div').hide();

        }
    },
    hasNoDueExc: function (event) {
        var val = $('input[name=nodue_from_excise]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.nodue_from_excise_div').show();
        } else {
            this.$('.nodue_from_excise_div').hide();

        }
    },
    hasSignBehalf: function (event) {
        var val = $('input[name=sign_behalf_lessee]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.sign_behalf_lessee_div').show();
        } else {
            this.$('.sign_behalf_lessee_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('seller', 'active');
        Seller.router.navigate('seller');
        var templateData = {};
        this.$el.html(sellerListTemplate(templateData));
        this.loadSellerData(sDistrict, sStatus);

    },
    listPageSellerForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('seller', 'active');
        this.$el.html(sellerListTemplate);
        this.newSellerForm(false, {});
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
                rowData.ADMIN_SHOP_DOC_PATH = ADMIN_SHOP_DOC_PATH;
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
        return sellerActionTemplate(rowData);
    },
    loadSellerData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_EIGHTEEN, data)
                    + getFRContainer(VALUE_EIGHTEEN, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Seller.router.navigate('seller');
        $('#seller_form_and_datatable_container').html(sellerTableTemplate(searchData));
        sellerDataTable = $('#seller_datatable').DataTable({
            ajax: {url: 'seller/get_seller_data', dataSrc: "seller_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'seller_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'survey_no', 'class': 'text-center'},
                {data: 'transferer_name', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'seller_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'seller_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#seller_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = sellerDataTable.row(tr);

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
    newSellerForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.seller_data;
            Seller.router.navigate('edit_seller_form');
        } else {
            var formData = {};
            Seller.router.navigate('seller_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.seller_data = parseData.seller_data;
        if (isEdit) {
            templateData.application_date = dateTo_DD_MM_YYYY(templateData.seller_data.application_date);
        } else {
            templateData.application_date = dateTo_DD_MM_YYYY();
        }
        $('#seller_form_and_datatable_container').html(sellerFormTemplate((templateData)));

        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(tempVillagesData, 'villages_for_seller_data', 'village_name', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(tempVillagesData, 'villages_for_seller_data', 'village_id', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor([], 'plot_no_for_seller_data', 'plot_no', 'plot_no', 'Plot No');
        if (isEdit) {

            $('#state').val(formData.state);
            $('#district').val(formData.district);
            $('#taluka').val(formData.taluka);
            // $('#villages_for_seller_data').val(formData.village);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#villages_for_seller_data').val(formData.village == 0 ? '' : formData.village);
            var plotData = tempPlotData[formData.village] ? tempPlotData[formData.village] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(plotData, 'plot_no_for_seller_data', 'plot_id', 'plot_no', 'Plot No');
            $('#plot_no_for_seller_data').val(formData.plot_no == 0 ? '' : formData.plot_no);

            if (formData.request_letter_reason_doc != '') {
                $('#request_letter_reason_doc_container_for_seller').hide();
                $('#request_letter_reason_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.request_letter_reason_doc);
                $('#request_letter_reason_doc_name_container_for_seller').show();
                $('#request_letter_reason_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.request_letter_reason_doc);
            }
            if (formData.original_extract_doc != '') {
                $('#original_extract_doc_container_for_seller').hide();
                $('#original_extract_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.original_extract_doc);
                $('#original_extract_doc_name_container_for_seller').show();
                $('#original_extract_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.original_extract_doc);
            }
            if (formData.nodue_from_mamlatdar_doc != '') {
                $('#nodue_from_mamlatdar_doc_container_for_seller').hide();
                $('#nodue_from_mamlatdar_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.nodue_from_mamlatdar_doc);
                $('#nodue_from_mamlatdar_doc_name_container_for_seller').show();
                $('#nodue_from_mamlatdar_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodue_from_mamlatdar_doc);
            }
            if (formData.nodue_from_electricity_doc != '') {
                $('#nodue_from_electricity_doc_container_for_seller').hide();
                $('#nodue_from_electricity_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.nodue_from_electricity_doc);
                $('#nodue_from_electricity_doc_name_container_for_seller').show();
                $('#nodue_from_electricity_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodue_from_electricity_doc);
            }
            if (formData.nodue_from_bank_doc != '') {
                $('#nodue_from_bank_doc_container_for_seller').hide();
                $('#nodue_from_bank_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.nodue_from_bank_doc);
                $('#nodue_from_bank_doc_name_container_for_seller').show();
                $('#nodue_from_bank_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodue_from_bank_doc);
            }
            if (formData.nodues_from_grampanchayat_doc != '') {
                $('#nodues_from_grampanchayat_doc_container_for_seller').hide();
                $('#nodues_from_grampanchayat_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.nodues_from_grampanchayat_doc);
                $('#nodues_from_grampanchayat_doc_name_container_for_seller').show();
                $('#nodues_from_grampanchayat_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodues_from_grampanchayat_doc);
            }
            if (formData.challan_of_lease_doc != '') {
                $('#challan_of_lease_doc_container_for_seller').hide();
                $('#challan_of_lease_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.challan_of_lease_doc);
                $('#challan_of_lease_doc_name_container_for_seller').show();
                $('#challan_of_lease_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.challan_of_lease_doc);
            }
            if (formData.occupancy_certy_doc != '') {
                $('#occupancy_certy_doc_container_for_seller').hide();
                $('#occupancy_certy_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.occupancy_certy_doc);
                $('#occupancy_certy_doc_name_container_for_seller').show();
                $('#occupancy_certy_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.occupancy_certy_doc);
            }
            if (formData.nodue_from_excise_doc != '') {
                $('#nodue_from_excise_doc_container_for_seller').hide();
                $('#nodue_from_excise_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.nodue_from_excise_doc);
                $('#nodue_from_excise_doc_name_container_for_seller').show();
                $('#nodue_from_excise_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodue_from_excise_doc);
            }
            if (formData.sign_behalf_lessee_doc != '') {
                $('#sign_behalf_lessee_doc_container_for_seller').hide();
                $('#sign_behalf_lessee_doc_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.sign_behalf_lessee_doc);
                $('#sign_behalf_lessee_doc_name_container_for_seller').show();
                $('#sign_behalf_lessee_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.sign_behalf_lessee_doc);
            }
            if (formData.signature != '') {
                $('#seal_and_stamp_container_for_seller').hide();
                $('#seal_and_stamp_name_image_for_seller').attr('src', baseUrl + 'documents/seller/' + formData.signature);
                $('#seal_and_stamp_name_container_for_seller').show();
                $('#seal_and_stamp_download').attr("href", baseUrl + 'documents/seller/' + formData.signature);
            }

        }

        if (formData.request_letter_reason == IS_CHECKED_YES) {
            $('#request_letter_reason_yes').attr('checked', 'checked');
            $('.request_letter_reason_div').show();
        } else if (formData.request_letter_reason == IS_CHECKED_NO) {
            $('#request_letter_reason_no').attr('checked', 'checked');
        }

        if (formData.original_extract == IS_CHECKED_YES) {
            $('#original_extract_yes').attr('checked', 'checked');
            $('.original_extract_div').show();
        } else if (formData.original_extract == IS_CHECKED_NO) {
            $('#original_extract_no').attr('checked', 'checked');
        }

        if (formData.nodue_from_mamlatdar == IS_CHECKED_YES) {
            $('#nodue_from_mamlatdar_yes').attr('checked', 'checked');
            $('.nodue_from_mamlatdar_div').show();
        } else if (formData.nodue_from_mamlatdar == IS_CHECKED_NO) {
            $('#nodue_from_mamlatdar_no').attr('checked', 'checked');
        }

        if (formData.nodue_from_electricity == IS_CHECKED_YES) {
            $('#nodue_from_electricity_yes').attr('checked', 'checked');
            $('.nodue_from_electricity_div').show();
        } else if (formData.nodue_from_electricity == IS_CHECKED_NO) {
            $('#nodue_from_electricity_no').attr('checked', 'checked');
        }

        if (formData.nodue_from_bank == IS_CHECKED_YES) {
            $('#nodue_from_bank_yes').attr('checked', 'checked');
            $('.nodue_from_bank_div').show();
        } else if (formData.nodue_from_bank == IS_CHECKED_NO) {
            $('#nodue_from_bank_no').attr('checked', 'checked');
        }
        if (formData.nodues_from_grampanchayat == IS_CHECKED_YES) {
            $('#nodues_from_grampanchayat_yes').attr('checked', 'checked');
            $('.nodues_from_grampanchayat_div').show();
        } else if (formData.nodues_from_grampanchayat == IS_CHECKED_NO) {
            $('#nodues_from_grampanchayat_no').attr('checked', 'checked');
        }

        if (formData.challan_of_lease == IS_CHECKED_YES) {
            $('#challan_of_lease_yes').attr('checked', 'checked');
            $('.challan_of_lease_div').show();
        } else if (formData.challan_of_lease == IS_CHECKED_NO) {
            $('#challan_of_lease_no').attr('checked', 'checked');
        }

        if (formData.occupancy_certy == IS_CHECKED_YES) {
            $('#occupancy_certy_yes').attr('checked', 'checked');
            $('.occupancy_certy_div').show();
        } else if (formData.occupancy_certy == IS_CHECKED_NO) {
            $('#occupancy_certy_no').attr('checked', 'checked');
        }

        if (formData.nodue_from_excise == IS_CHECKED_YES) {
            $('#nodue_from_excise_yes').attr('checked', 'checked');
            $('.nodue_from_excise_div').show();
        } else if (formData.nodue_from_excise == IS_CHECKED_NO) {
            $('#nodue_from_excise_no').attr('checked', 'checked');
        }

        if (formData.sign_behalf_lessee == IS_CHECKED_YES) {
            $('#sign_behalf_lessee_yes').attr('checked', 'checked');
            $('.sign_behalf_lessee_div').show();
        } else if (formData.sign_behalf_lessee == IS_CHECKED_NO) {
            $('#sign_behalf_lessee_no').attr('checked', 'checked');
        }

        generateSelect2();
        datePicker();
        $('#seller_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitSeller($('#submit_btn_for_seller'));
            }
        });
    },
    editOrViewSeller: function (btnObj, sellerId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!sellerId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'seller/get_seller_data_by_id',
            type: 'post',
            data: $.extend({}, {'seller_id': sellerId}, getTokenData()),
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
                    that.newSellerForm(isEdit, parseData);
                } else {
                    that.viewSellerForm(parseData);
                }
            }
        });
    },
    viewSellerForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.seller_data;
        Seller.router.navigate('view_seller_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        formData.application_date = dateTo_DD_MM_YYYY(formData.application_date);
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#seller_form_and_datatable_container').html(sellerViewTemplate(formData));
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(tempVillagesData, 'villages_for_seller_data', 'village_id', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'plot_no_for_seller_data', 'plot_no', 'plot_no', 'Plot No');

        //formData.application_date = dateTo_DD_MM_YYYY(templateData.seller_data.application_date);
        $('#state').val(formData.state);
        $('#district').val(formData.district);
        $('#taluka').val(formData.taluka);
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#villages_for_seller_data').val(formData.village == 0 ? '' : formData.village);
        var plotData = tempPlotData[formData.village] ? tempPlotData[formData.village] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(plotData, 'plot_no_for_seller_data', 'plot_id', 'plot_no', 'Plot No');
        $('#plot_no_for_seller_data').val(formData.plot_no == 0 ? '' : formData.plot_no);

        if (formData.request_letter_reason == IS_CHECKED_YES) {
            $('#request_letter_reason_yes').attr('checked', 'checked');
            $('.request_letter_reason_div').show();
        } else if (formData.request_letter_reason == IS_CHECKED_NO) {
            $('#request_letter_reason_no').attr('checked', 'checked');
        }
        if (formData.original_extract == IS_CHECKED_YES) {
            $('#original_extract_yes').attr('checked', 'checked');
            $('.original_extract_div').show();
        } else if (formData.original_extract == IS_CHECKED_NO) {
            $('#original_extract_no').attr('checked', 'checked');
        }

        if (formData.nodue_from_mamlatdar == IS_CHECKED_YES) {
            $('#nodue_from_mamlatdar_yes').attr('checked', 'checked');
            $('.nodue_from_mamlatdar_div').show();
        } else if (formData.nodue_from_mamlatdar == IS_CHECKED_NO) {
            $('#nodue_from_mamlatdar_no').attr('checked', 'checked');
        }

        if (formData.nodue_from_electricity == IS_CHECKED_YES) {
            $('#nodue_from_electricity_yes').attr('checked', 'checked');
            $('.nodue_from_electricity_div').show();
        } else if (formData.nodue_from_electricity == IS_CHECKED_NO) {
            $('#nodue_from_electricity_no').attr('checked', 'checked');
        }

        if (formData.nodue_from_bank == IS_CHECKED_YES) {
            $('#nodue_from_bank_yes').attr('checked', 'checked');
            $('.nodue_from_bank_div').show();
        } else if (formData.nodue_from_bank == IS_CHECKED_NO) {
            $('#nodue_from_bank_no').attr('checked', 'checked');
        }
        if (formData.nodues_from_grampanchayat == IS_CHECKED_YES) {
            $('#nodues_from_grampanchayat_yes').attr('checked', 'checked');
            $('.nodues_from_grampanchayat_div').show();
        } else if (formData.nodues_from_grampanchayat == IS_CHECKED_NO) {
            $('#nodues_from_grampanchayat_no').attr('checked', 'checked');
        }

        if (formData.challan_of_lease == IS_CHECKED_YES) {
            $('#challan_of_lease_yes').attr('checked', 'checked');
            $('.challan_of_lease_div').show();
        } else if (formData.challan_of_lease == IS_CHECKED_NO) {
            $('#challan_of_lease_no').attr('checked', 'checked');
        }

        if (formData.occupancy_certy == IS_CHECKED_YES) {
            $('#occupancy_certy_yes').attr('checked', 'checked');
            $('.occupancy_certy_div').show();
        } else if (formData.occupancy_certy == IS_CHECKED_NO) {
            $('#occupancy_certy_no').attr('checked', 'checked');
        }

        if (formData.nodue_from_excise == IS_CHECKED_YES) {
            $('#nodue_from_excise_yes').attr('checked', 'checked');
            $('.nodue_from_excise_div').show();
        } else if (formData.nodue_from_excise == IS_CHECKED_NO) {
            $('#nodue_from_excise_no').attr('checked', 'checked');
        }

        if (formData.sign_behalf_lessee == IS_CHECKED_YES) {
            $('#sign_behalf_lessee_yes').attr('checked', 'checked');
            $('.sign_behalf_lessee_div').show();
        } else if (formData.sign_behalf_lessee == IS_CHECKED_NO) {
            $('#sign_behalf_lessee_no').attr('checked', 'checked');
        }


        if (formData.request_letter_reason_doc != '') {
            $('#request_letter_reason_doc_container_for_seller_view').hide();
            $('#request_letter_reason_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.request_letter_reason_doc);
            $('#request_letter_reason_doc_name_container_for_seller_view').show();
            $('#request_letter_reason_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.request_letter_reason_doc);
        }
        if (formData.original_extract_doc != '') {
            $('#original_extract_doc_container_for_seller_view').hide();
            $('#original_extract_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.original_extract_doc);
            $('#original_extract_doc_name_container_for_seller_view').show();
            $('#original_extract_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.original_extract_doc);
        }
        if (formData.nodue_from_mamlatdar_doc != '') {
            $('#nodue_from_mamlatdar_doc_container_for_seller_view').hide();
            $('#nodue_from_mamlatdar_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.nodue_from_mamlatdar_doc);
            $('#nodue_from_mamlatdar_doc_name_container_for_seller_view').show();
            $('#nodue_from_mamlatdar_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodue_from_mamlatdar_doc);
        }
        if (formData.nodue_from_electricity_doc != '') {
            $('#nodue_from_electricity_doc_container_for_seller_view').hide();
            $('#nodue_from_electricity_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.nodue_from_electricity_doc);
            $('#nodue_from_electricity_doc_name_container_for_seller_view').show();
            $('#nodue_from_electricity_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodue_from_electricity_doc);
        }
        if (formData.nodue_from_bank_doc != '') {
            $('#nodue_from_bank_doc_container_for_seller_view').hide();
            $('#nodue_from_bank_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.nodue_from_bank_doc);
            $('#nodue_from_bank_doc_name_container_for_seller_view').show();
            $('#nodue_from_bank_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodue_from_bank_doc);
        }
        if (formData.nodues_from_grampanchayat_doc != '') {
            $('#nodues_from_grampanchayat_doc_container_for_seller_view').hide();
            $('#nodues_from_grampanchayat_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.nodues_from_grampanchayat_doc);
            $('#nodues_from_grampanchayat_doc_name_container_for_seller_view').show();
            $('#nodues_from_grampanchayat_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodues_from_grampanchayat_doc);
        }
        if (formData.challan_of_lease_doc != '') {
            $('#challan_of_lease_doc_container_for_seller_view').hide();
            $('#challan_of_lease_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.challan_of_lease_doc);
            $('#challan_of_lease_doc_name_container_for_seller_view').show();
            $('#challan_of_lease_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.challan_of_lease_doc);
        }
        if (formData.occupancy_certy_doc != '') {
            $('#occupancy_certy_doc_container_for_seller_view').hide();
            $('#occupancy_certy_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.occupancy_certy_doc);
            $('#occupancy_certy_doc_name_container_for_seller_view').show();
            $('#occupancy_certy_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.occupancy_certy_doc);
        }
        if (formData.nodue_from_excise_doc != '') {
            $('#nodue_from_excise_doc_container_for_seller_view').hide();
            $('#nodue_from_excise_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.nodue_from_excise_doc);
            $('#nodue_from_excise_doc_name_container_for_seller_view').show();
            $('#nodue_from_excise_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.nodue_from_excise_doc);
        }
        if (formData.sign_behalf_lessee_doc != '') {
            $('#sign_behalf_lessee_doc_container_for_seller_view').hide();
            $('#sign_behalf_lessee_doc_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.sign_behalf_lessee_doc);
            $('#sign_behalf_lessee_doc_name_container_for_seller_view').show();
            $('#sign_behalf_lessee_doc_name_download').attr("href", baseUrl + 'documents/seller/' + formData.sign_behalf_lessee_doc);
        }
        if (formData.signature != '') {
            $('#seal_and_stamp_container_for_seller_view').hide();
            $('#seal_and_stamp_name_image_for_seller_view').attr('src', baseUrl + 'documents/seller/' + formData.signature);
            $('#seal_and_stamp_name_container_for_seller_view').show();
            $('#seal_and_stamp_download').attr("href", baseUrl + 'documents/seller/' + formData.signature);
        }

    },
    checkValidationForSeller: function (sellerData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!sellerData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!sellerData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!sellerData.state) {
            return getBasicMessageAndFieldJSONArray('state', stateValidationMessage);
        }
        if (!sellerData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!sellerData.taluka) {
            return getBasicMessageAndFieldJSONArray('taluka', talukaValidationMessage);
        }
        if (!sellerData.villages_for_seller_data) {
            return getBasicMessageAndFieldJSONArray('villages_for_seller_data', villageNameValidationMessage);
        }

        if (!sellerData.plot_no_for_seller_data) {
            return getBasicMessageAndFieldJSONArray('plot_no_for_seller_data', plotnoValidationMessage);
        }
//        if (!sellerData.govt_industrial_estate_area) {
//            return getBasicMessageAndFieldJSONArray('govt_industrial_estate_area');
//        }
        if (!sellerData.survey_no) {
            return getBasicMessageAndFieldJSONArray('survey_no', surveynoValidationMessage);
        }
        if (!sellerData.admeasuring_square_metre) {
            return getBasicMessageAndFieldJSONArray('admeasuring_square_metre', admeasuringValidationMessage);
        }

        if (!sellerData.reason_of_transfer) {
            return getBasicMessageAndFieldJSONArray('reason_of_transfer', nameofservicingValidationMessage);
        }

        if (!sellerData.transferer_name) {
            return getBasicMessageAndFieldJSONArray('transferer_name', acNumberValidationMessage);
        }
        if (!sellerData.name_of_servicing) {
            return getBasicMessageAndFieldJSONArray('name_of_servicing', banknameValidationMessage);
        }
        if (!sellerData.udyog_aadhar_memo_no) {
            return getBasicMessageAndFieldJSONArray('udyog_aadhar_memo_no', nameofservicingValidationMessage);
        }
        if (!sellerData.pan_no) {
            return getBasicMessageAndFieldJSONArray('pan_no', nameofservicingValidationMessage);
        }

        if (!sellerData.gst_no) {
            return getBasicMessageAndFieldJSONArray('gst_no', nameofservicingValidationMessage);
        }
        if (!sellerData.trans_account_no) {
            return getBasicMessageAndFieldJSONArray('trans_account_no', nameofservicingValidationMessage);
        }
        var request_letter_reason = $('input[name=request_letter_reason]:checked').val();
        if (request_letter_reason == '' || request_letter_reason == null) {
            $('#request_letter_reason').focus();
            return getBasicMessageAndFieldJSONArray('request_letter_reason', reasonofloanValidationMessage);
        }
        var original_extract = $('input[name=original_extract]:checked').val();
        if (original_extract == '' || original_extract == null) {
            $('#original_extract').focus();
            return getBasicMessageAndFieldJSONArray('original_extract', reasonofloanValidationMessage);
        }
        var nodue_from_mamlatdar = $('input[name=nodue_from_mamlatdar]:checked').val();
        if (nodue_from_mamlatdar == '' || nodue_from_mamlatdar == null) {
            $('#nodue_from_mamlatdar').focus();
            return getBasicMessageAndFieldJSONArray('nodue_from_mamlatdar', reasonofloanValidationMessage);
        }
        var nodue_from_electricity = $('input[name=nodue_from_electricity]:checked').val();
        if (nodue_from_electricity == '' || nodue_from_electricity == null) {
            $('#nodue_from_electricity').focus();
            return getBasicMessageAndFieldJSONArray('nodue_from_electricity', reasonofloanValidationMessage);
        }
        var nodue_from_bank = $('input[name=nodue_from_bank]:checked').val();
        if (nodue_from_bank == '' || nodue_from_bank == null) {
            $('#nodue_from_bank').focus();
            return getBasicMessageAndFieldJSONArray('nodue_from_bank', reasonofloanValidationMessage);
        }
        var nodues_from_grampanchayat = $('input[name=nodues_from_grampanchayat]:checked').val();
        if (nodues_from_grampanchayat == '' || nodues_from_grampanchayat == null) {
            $('#nodues_from_grampanchayat').focus();
            return getBasicMessageAndFieldJSONArray('nodues_from_grampanchayat', reasonofloanValidationMessage);
        }
        var challan_of_lease = $('input[name=challan_of_lease]:checked').val();
        if (challan_of_lease == '' || challan_of_lease == null) {
            $('#challan_of_lease').focus();
            return getBasicMessageAndFieldJSONArray('challan_of_lease', reasonofloanValidationMessage);
        }
        var occupancy_certy = $('input[name=occupancy_certy]:checked').val();
        if (occupancy_certy == '' || occupancy_certy == null) {
            $('#occupancy_certy').focus();
            return getBasicMessageAndFieldJSONArray('occupancy_certy', reasonofloanValidationMessage);
        }
        var nodue_from_excise = $('input[name=nodue_from_excise]:checked').val();
        if (nodue_from_excise == '' || nodue_from_excise == null) {
            $('#nodue_from_excise').focus();
            return getBasicMessageAndFieldJSONArray('nodue_from_excise', reasonofloanValidationMessage);
        }
        var sign_behalf_lessee = $('input[name=sign_behalf_lessee]:checked').val();
        if (sign_behalf_lessee == '' || sign_behalf_lessee == null) {
            $('#sign_behalf_lessee').focus();
            return getBasicMessageAndFieldJSONArray('sign_behalf_lessee', reasonofloanValidationMessage);
        }
        return '';
    },
    askForSubmitSeller: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Seller.listview.submitSeller(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitSeller: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var sellerData = $('#seller_form').serializeFormJSON();
        var validationData = that.checkValidationForSeller(sellerData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('seller-' + validationData.field, validationData.message);
            return false;
        }

        if (sellerData.request_letter_reason == isChecked) {
            if ($('#request_letter_reason_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#request_letter_reason_doc_for_seller').val();
                if (reasonform == '') {
                    $('#request_letter_reason_doc_for_seller').focus();
                    validationMessageShow('seller-request_letter_reason_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('request_letter_reason_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#request_letter_reason_doc_for_seller').focus();
                    validationMessageShow('seller-request_letter_reason_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }
        if (sellerData.original_extract == isChecked) {
            if ($('#original_extract_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#original_extract_doc_for_seller').val();
                if (reasonform == '') {
                    $('#original_extract_doc_for_seller').focus();
                    validationMessageShow('seller-original_extract_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('original_extract_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#original_extract_doc_for_seller').focus();
                    validationMessageShow('seller-original_extract_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }
        if (sellerData.nodue_from_mamlatdar == isChecked) {
            if ($('#nodue_from_mamlatdar_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#nodue_from_mamlatdar_doc_for_seller').val();
                if (reasonform == '') {
                    $('#nodue_from_mamlatdar_doc_for_seller').focus();
                    validationMessageShow('seller-nodue_from_mamlatdar_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('nodue_from_mamlatdar_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#nodue_from_mamlatdar_doc_for_seller').focus();
                    validationMessageShow('seller-nodue_from_mamlatdar_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }
        if (sellerData.nodue_from_electricity == isChecked) {
            if ($('#nodue_from_electricity_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#nodue_from_electricity_doc_for_seller').val();
                if (reasonform == '') {
                    $('#nodue_from_electricity_doc_for_seller').focus();
                    validationMessageShow('seller-nodue_from_electricity_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('nodue_from_electricity_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#nodue_from_electricity_doc_for_seller').focus();
                    validationMessageShow('seller-nodue_from_electricity_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }

        if (sellerData.nodue_from_bank == isChecked) {
            if ($('#nodue_from_bank_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#nodue_from_bank_doc_for_seller').val();
                if (reasonform == '') {
                    $('#nodue_from_bank_doc_for_seller').focus();
                    validationMessageShow('seller-nodue_from_bank_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('nodue_from_bank_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#nodue_from_bank_doc_for_seller').focus();
                    validationMessageShow('seller-nodue_from_bank_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }
        if (sellerData.nodues_from_grampanchayat == isChecked) {
            if ($('#nodues_from_grampanchayat_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#nodues_from_grampanchayat_doc_for_seller').val();
                if (reasonform == '') {
                    $('#nodues_from_grampanchayat_doc_for_seller').focus();
                    validationMessageShow('seller-nodues_from_grampanchayat_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('nodues_from_grampanchayat_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#nodues_from_grampanchayat_doc_for_seller').focus();
                    validationMessageShow('seller-nodues_from_grampanchayat_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }
        if (sellerData.challan_of_lease == isChecked) {
            if ($('#challan_of_lease_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#challan_of_lease_doc_for_seller').val();
                if (reasonform == '') {
                    $('#challan_of_lease_doc_for_seller').focus();
                    validationMessageShow('seller-challan_of_lease_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('challan_of_lease_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#challan_of_lease_doc_for_seller').focus();
                    validationMessageShow('seller-challan_of_lease_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }
        if (sellerData.occupancy_certy == isChecked) {
            if ($('#occupancy_certy_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#occupancy_certy_doc_for_seller').val();
                if (reasonform == '') {
                    $('#occupancy_certy_doc_for_seller').focus();
                    validationMessageShow('seller-occupancy_certy_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('occupancy_certy_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#occupancy_certy_doc_for_seller').focus();
                    validationMessageShow('seller-occupancy_certy_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }
        if (sellerData.nodue_from_excise == isChecked) {
            if ($('#nodue_from_excise_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#nodue_from_excise_doc_for_seller').val();
                if (reasonform == '') {
                    $('#nodue_from_excise_doc_for_seller').focus();
                    validationMessageShow('seller-nodue_from_excise_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('nodue_from_excise_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#nodue_from_excise_doc_for_seller').focus();
                    validationMessageShow('seller-nodue_from_excise_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }

        if (sellerData.sign_behalf_lessee == isChecked) {
            if ($('#sign_behalf_lessee_doc_container_for_seller').is(':visible')) {
                var reasonform = $('#sign_behalf_lessee_doc_for_seller').val();
                if (reasonform == '') {
                    $('#sign_behalf_lessee_doc_for_seller').focus();
                    validationMessageShow('seller-sign_behalf_lessee_doc_for_seller', uploadDocumentValidationMessage);
                    return false;
                }
                var reasonformMessage = pdffileUploadValidation('sign_behalf_lessee_doc_for_seller');
                if (reasonformMessage != '') {
                    $('#sign_behalf_lessee_doc_for_seller').focus();
                    validationMessageShow('seller-sign_behalf_lessee_doc_for_seller', reasonformMessage);
                    return false;
                }
            }
        }

        if ($('#seal_and_stamp_container_for_seller').is(':visible')) {
            var sealAndStamp = $('#seal_and_stamp_for_seller').val();
            if (sealAndStamp == '') {
                $('#seal_and_stamp_for_seller').focus();
                validationMessageShow('seller-seal_and_stamp_for_seller', uploadDocumentValidationMessage);
                return false;
            }
            var sealAndStampMessage = imagefileUploadValidation('seal_and_stamp_for_seller');
            if (sealAndStampMessage != '') {
                $('#seal_and_stamp_for_seller').focus();
                validationMessageShow('seller-seal_and_stamp_for_seller', sealAndStampMessage);
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_seller') : $('#submit_btn_for_seller');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var sellerData = new FormData($('#seller_form')[0]);
        sellerData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        sellerData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'seller/submit_seller',
            data: sellerData,
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
                validationMessageShow('seller', textStatus.statusText);
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
                    validationMessageShow('seller', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Seller.router.navigate('seller', {'trigger': true});
            }
        });
    },

    askForRemove: function (sellerId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!sellerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Seller.listview.removeDocument(\'' + sellerId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (sellerId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!sellerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'seller/remove_document',
            data: $.extend({}, {'seller_id': sellerId, 'document_type': docType}, getTokenData()),
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
                validationMessageShow('seller', textStatus.statusText);
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
                    validationMessageShow('seller', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    $('#request_letter_reason_doc_name_container_for_seller').hide();
                    $('#request_letter_reason_doc_name_image_for_seller').attr('src', '');
                    $('#request_letter_reason_doc_container_for_seller').show();
                    $('#request_letter_reason_doc_for_seller').val('');
                }
                if (docType == VALUE_TWO) {
                    $('#original_extract_doc_name_container_for_seller').hide();
                    $('#original_extract_doc_name_image_for_seller').attr('src', '');
                    $('#original_extract_doc_container_for_seller').show();
                    $('#original_extract_doc_for_seller').val('');
                }
                if (docType == VALUE_THREE) {
                    $('#nodue_from_mamlatdar_doc_name_container_for_seller').hide();
                    $('#nodue_from_mamlatdar_doc_name_image_for_seller').attr('src', '');
                    $('#nodue_from_mamlatdar_doc_container_for_seller').show();
                    $('#nodue_from_mamlatdar_doc_for_seller').val('');
                }
                if (docType == VALUE_FOUR) {
                    $('#nodue_from_electricity_doc_name_container_for_seller').hide();
                    $('#nodue_from_electricity_doc_name_image_for_seller').attr('src', '');
                    $('#nodue_from_electricity_doc_container_for_seller').show();
                    $('#nodue_from_electricity_doc_for_seller').val('');
                }
                if (docType == VALUE_FIVE) {
                    $('#nodue_from_bank_doc_name_container_for_seller').hide();
                    $('#nodue_from_bank_doc_name_image_for_seller').attr('src', '');
                    $('#nodue_from_bank_doc_container_for_seller').show();
                    $('#nodue_from_bank_doc_for_seller').val('');
                }
                if (docType == VALUE_SIX) {
                    $('#nodues_from_grampanchayat_doc_name_container_for_seller').hide();
                    $('#nodues_from_grampanchayat_doc_name_image_for_seller').attr('src', '');
                    $('#nodues_from_grampanchayat_doc_container_for_seller').show();
                    $('#nodues_from_grampanchayat_doc_for_seller').val('');
                }
                if (docType == VALUE_SEVEN) {
                    $('#challan_of_lease_doc_name_container_for_seller').hide();
                    $('#challan_of_lease_doc_name_image_for_seller').attr('src', '');
                    $('#challan_of_lease_doc_container_for_seller').show();
                    $('#challan_of_lease_doc_for_seller').val('');
                }
                if (docType == VALUE_EIGHT) {
                    $('#occupancy_certy_doc_name_container_for_seller').hide();
                    $('#occupancy_certy_doc_name_image_for_seller').attr('src', '');
                    $('#occupancy_certy_doc_container_for_seller').show();
                    $('#occupancy_certy_doc_for_seller').val('');
                }
                if (docType == VALUE_NINE) {
                    $('#nodue_from_excise_doc_name_container_for_seller').hide();
                    $('#nodue_from_excise_doc_name_image_for_seller').attr('src', '');
                    $('#nodue_from_excise_doc_container_for_seller').show();
                    $('#nodue_from_excise_doc_for_seller').val('');
                }
                if (docType == VALUE_TEN) {
                    $('#sign_behalf_lessee_doc_name_container_for_seller').hide();
                    $('#sign_behalf_lessee_doc_name_image_for_seller').attr('src', '');
                    $('#sign_behalf_lessee_doc_container_for_seller').show();
                    $('#sign_behalf_lessee_doc_for_seller').val('');
                }
                if (docType == VALUE_ELEVEN) {
                    $('#seal_and_stamp_name_container_for_seller').hide();
                    $('#seal_and_stamp_name_image_for_seller').attr('src', '');
                    $('#seal_and_stamp_container_for_seller').show();
                    $('#seal_and_stamp_for_seller').val('');
                }
            }
        });
    },

    generateForm1: function (sellerId) {
        if (!sellerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#seller_id_for_seller_form1').val(sellerId);
        $('#seller_form1_pdf_form').submit();
        $('#seller_id_for_seller_form1').val('');
    },

    downloadUploadChallan: function (sellerId) {
        if (!sellerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + sellerId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'seller/get_seller_data_by_seller_id',
            type: 'post',
            data: $.extend({}, {'seller_id': sellerId}, getTokenData()),
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
                var sellerData = parseData.seller_data;
                that.showChallan(sellerData);
            }
        });
    },
    showChallan: function (sellerData) {
        showPopup();
        if (sellerData.status != VALUE_FIVE && sellerData.status != VALUE_SIX && sellerData.status != VALUE_SEVEN && sellerData.status != VALUE_ELEVEN) {
            if (!sellerData.hide_submit_btn) {
                sellerData.show_fees_paid = true;
            }
        }
        if (sellerData.payment_type == VALUE_ONE) {
            sellerData.utitle = 'Fees Paid Challan Copy';
        } else {
            sellerData.style = 'display: none;';
        }
        if (sellerData.payment_type == VALUE_TWO) {
            sellerData.show_dd_po_option = true;
            sellerData.utitle = 'Demand Draft (DD)';
        }
        sellerData.module_type = VALUE_EIGHTEEN;
        $('#popup_container').html(sellerUploadChallanTemplate(sellerData));
        loadFB(VALUE_EIGHTEEN, sellerData.fb_data);
        loadPH(VALUE_EIGHTEEN, sellerData.seller_id, sellerData.ph_data);

        if (sellerData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'seller_upload_challan', sellerData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'seller_upload_challan', 'uc', 'radio');
            if (sellerData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_seller_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }

        if (sellerData.challan != '') {
            $('#challan_container_for_seller_upload_challan').hide();
            $('#challan_name_container_for_seller_upload_challan').show();
            $('#challan_name_href_for_seller_upload_challan').attr('href', 'documents/seller/' + sellerData.challan);
            $('#challan_name_for_seller_upload_challan').html(sellerData.challan);
        }
        if (sellerData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_seller_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_seller_upload_challan').show();
            $('#fees_paid_challan_name_href_for_seller_upload_challan').attr('href', 'documents/seller/' + sellerData.fees_paid_challan);
            $('#fees_paid_challan_name_for_seller_upload_challan').html(sellerData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_seller_upload_challan').attr('onclick', 'Seller.listview.removeFeesPaidChallan("' + sellerData.seller_id + '")');
        }
    },
    removeFeesPaidChallan: function (sellerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!sellerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'seller/remove_fees_paid_challan',
            data: $.extend({}, {'seller_id': sellerId}, getTokenData()),
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
                validationMessageShow('seller-uc', textStatus.statusText);
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
                    validationMessageShow('seller-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-seller-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'seller_upload_challan');
                $('#status_' + sellerId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-seller-uc').html('');
        validationMessageHide();
        var sellerId = $('#seller_id_for_seller_upload_challan').val();
        if (!sellerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_seller_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_seller_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_seller_upload_challan').focus();
                validationMessageShow('seller-uc-fees_paid_challan_for_seller_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_seller_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_seller_upload_challan').focus();
                validationMessageShow('seller-uc-fees_paid_challan_for_seller_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_seller_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#seller_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'seller/upload_fees_paid_challan',
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
                validationMessageShow('seller-uc', textStatus.statusText);
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
                    validationMessageShow('seller-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + sellerId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (sellerId) {
        if (!sellerId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#seller_id_for_certificate').val(sellerId);
        $('#seller_certificate_pdf_form').submit();
        $('#seller_id_for_certificate').val('');
    },
    getQueryData: function (sellerId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!sellerId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_EIGHTEEN;
        templateData.module_id = sellerId;
        var btnObj = $('#query_btn_for_seller_' + sellerId);
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
                tmpData.application_number = regNoRenderer(VALUE_EIGHTEEN, moduleData.seller_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForSeller: function (fileNo) {
        var that = this;
        if ($('#request_letter_reason_doc_for_seller').val() != '') {
            var requestLetterReasonDocument = checkValidationForDocument('request_letter_reason_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (requestLetterReasonDocument == false) {
                return false;
            }
        }
        if ($('#original_extract_doc_for_seller').val() != '') {
            var originalExtractDocument = checkValidationForDocument('original_extract_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (originalExtractDocument == false) {
                return false;
            }
        }
        if ($('#nodue_from_mamlatdar_doc_for_seller').val() != '') {
            var nodueFromMamlatdarDocument = checkValidationForDocument('nodue_from_mamlatdar_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (nodueFromMamlatdarDocument == false) {
                return false;
            }
        }
        if ($('#nodue_from_electricity_doc_for_seller').val() != '') {
            var nodueFromElectricityDocument = checkValidationForDocument('nodue_from_electricity_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (nodueFromElectricityDocument == false) {
                return false;
            }
        }
        if ($('#nodue_from_bank_doc_for_seller').val() != '') {
            var nodueFromBankDocument = checkValidationForDocument('nodue_from_bank_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (nodueFromBankDocument == false) {
                return false;
            }
        }
        if ($('#nodues_from_grampanchayat_doc_for_seller').val() != '') {
            var noduesFromGrampanchayatDocument = checkValidationForDocument('nodues_from_grampanchayat_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (noduesFromGrampanchayatDocument == false) {
                return false;
            }
        }
        if ($('#challan_of_lease_doc_for_seller').val() != '') {
            var challanOfLeaseDocument = checkValidationForDocument('challan_of_lease_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (challanOfLeaseDocument == false) {
                return false;
            }
        }
        if ($('#occupancy_certy_doc_for_seller').val() != '') {
            var occupancyCertyDocument = checkValidationForDocument('occupancy_certy_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (occupancyCertyDocument == false) {
                return false;
            }
        }
        if ($('#nodue_from_excise_doc_for_seller').val() != '') {
            var nodueFromExciseDocument = checkValidationForDocument('nodue_from_excise_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (nodueFromExciseDocument == false) {
                return false;
            }
        }
        if ($('#sign_behalf_lessee_doc_for_seller').val() != '') {
            var signBehalfLesseeDocument = checkValidationForDocument('sign_behalf_lessee_doc_for_seller', VALUE_ONE, 'seller', 10240);
            if (signBehalfLesseeDocument == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_seller').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_seller', VALUE_TWO, 'seller', 10240);
            if (sealAndStamp == false) {
                return false;
            }
        }

        $('.spinner_container_for_seller_' + fileNo).hide();
        $('.spinner_name_container_for_seller_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        openFullPageOverlay();
        var sellerId = $('#seller_id').val();
        var formData = new FormData($('#seller_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("seller_id", sellerId);
        $.ajax({
            type: 'POST',
            url: 'seller/upload_seller_document',
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
                $('.spinner_container_for_seller_' + fileNo).show();
                $('.spinner_name_container_for_seller_' + fileNo).hide();
                closeFullPageOverlay();
                showError(textStatus.statusText);
            },
            success: function (data) {
                closeFullPageOverlay();
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    $('#spinner_template_' + fileNo).hide();
                    $('.spinner_container_for_seller_' + fileNo).show();
                    $('.spinner_name_container_for_seller_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_seller_' + fileNo).hide();
                $('.spinner_name_container_for_seller_' + fileNo).show();
                $('#seller_id').val(parseData.seller_id);
                var sellerData = parseData.seller_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('request_letter_reason_doc_container_for_seller', 'request_letter_reason_doc_name_image_for_seller', 'request_letter_reason_doc_name_container_for_seller',
                            'request_letter_reason_doc_name_download', 'request_letter_reason_doc_remove_btn', sellerData.request_letter_reason_doc, parseData.seller_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('original_extract_doc_container_for_seller', 'original_extract_doc_name_image_for_seller', 'original_extract_doc_name_container_for_seller',
                            'original_extract_doc_name_download', 'original_extract_doc_remove_btn', sellerData.original_extract_doc, parseData.seller_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('nodue_from_mamlatdar_doc_container_for_seller', 'nodue_from_mamlatdar_doc_name_image_for_seller', 'nodue_from_mamlatdar_doc_name_container_for_seller',
                            'nodue_from_mamlatdar_doc_name_download', 'nodue_from_mamlatdar_doc_remove_btn', sellerData.nodue_from_mamlatdar_doc, parseData.seller_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('nodue_from_electricity_doc_container_for_seller', 'nodue_from_electricity_doc_name_image_for_seller', 'nodue_from_electricity_doc_name_container_for_seller',
                            'nodue_from_electricity_doc_name_download', 'nodue_from_electricity_doc_remove_btn', sellerData.nodue_from_electricity_doc, parseData.seller_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('nodue_from_bank_doc_container_for_seller', 'nodue_from_bank_doc_name_image_for_seller', 'nodue_from_bank_doc_name_container_for_seller',
                            'nodue_from_bank_doc_name_download', 'nodue_from_bank_doc_remove_btn', sellerData.nodue_from_bank_doc, parseData.seller_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('nodues_from_grampanchayat_doc_container_for_seller', 'nodues_from_grampanchayat_doc_name_image_for_seller', 'nodues_from_grampanchayat_doc_name_container_for_seller',
                            'nodues_from_grampanchayat_doc_name_download', 'nodues_from_grampanchayat_doc_remove_btn', sellerData.nodues_from_grampanchayat_doc, parseData.seller_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('challan_of_lease_doc_container_for_seller', 'challan_of_lease_doc_name_image_for_seller', 'challan_of_lease_doc_name_container_for_seller',
                            'challan_of_lease_doc_name_download', 'challan_of_lease_doc_remove_btn', sellerData.challan_of_lease_doc, parseData.seller_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('occupancy_certy_doc_container_for_seller', 'occupancy_certy_doc_name_image_for_seller', 'occupancy_certy_doc_name_container_for_seller',
                            'occupancy_certy_doc_name_download', 'occupancy_certy_doc_remove_btn', sellerData.occupancy_certy_doc, parseData.seller_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('nodue_from_excise_doc_container_for_seller', 'nodue_from_excise_doc_name_image_for_seller', 'nodue_from_excise_doc_name_container_for_seller',
                            'nodue_from_excise_doc_name_download', 'nodue_from_excise_doc_remove_btn', sellerData.nodue_from_excise_doc, parseData.seller_id, VALUE_NINE);
                }
                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('sign_behalf_lessee_doc_container_for_seller', 'sign_behalf_lessee_doc_name_image_for_seller', 'sign_behalf_lessee_doc_name_container_for_seller',
                            'sign_behalf_lessee_doc_name_download', 'sign_behalf_lessee_doc_remove_btn', sellerData.sign_behalf_lessee_doc, parseData.seller_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('seal_and_stamp_container_for_seller', 'seal_and_stamp_name_image_for_seller', 'seal_and_stamp_name_container_for_seller',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', sellerData.signature, parseData.seller_id, VALUE_ELEVEN);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/seller/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/seller/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Seller.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
