var hotelregiListTemplate = Handlebars.compile($('#hotelregi_list_template').html());
var hotelregiTableTemplate = Handlebars.compile($('#hotelregi_table_template').html());
var hotelregiActionTemplate = Handlebars.compile($('#hotelregi_action_template').html());
var hotelregiFormTemplate = Handlebars.compile($('#hotelregi_form_template').html());
var hotelregiViewTemplate = Handlebars.compile($('#hotelregi_view_template').html());
var hotelregiUploadChallanTemplate = Handlebars.compile($('#hotelregi_upload_challan_template').html());
var hotelregiAgentInfoTemplate = Handlebars.compile($('#hotelregi_agent_info_template').html());

var tempAgentInfoCnt = 1;

var Hotelregi = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Hotelregi.Router = Backbone.Router.extend({
    routes: {
        'hotelregi': 'renderList',
        'hotelregi_form': 'renderListForForm',
        'edit_hotelregi_form': 'renderList',
        'view_hotelregi_form': 'renderList',
    },
    renderList: function () {
        Hotelregi.listview.listPage();
    },
    renderListForForm: function () {
        Hotelregi.listview.listPageHotelregiForm();
    }
});
Hotelregi.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        addClass('hotelregi', 'active');
        Hotelregi.router.navigate('hotelregi');
        var templateData = {};
        this.$el.html(hotelregiListTemplate(templateData));
        this.loadHotelregiData(sDistrict, sStatus);

    },
    listPageHotelregiForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(hotelregiListTemplate);
        this.newHotelregiForm(false, {});
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
        return hotelregiActionTemplate(rowData);
    },
    loadHotelregiData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_SIX, data)
                    + getFRContainer(VALUE_SIX, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Hotelregi.router.navigate('hotelregi');
        $('#hotelregi_form_and_datatable_container').html(hotelregiTableTemplate(searchData));
        hotelregiDataTable = $('#hotelregi_datatable').DataTable({
            ajax: {url: 'Hotelregi/get_hotelregi_data', dataSrc: "hotelregi_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'hotelregi_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_hotel', 'class': 'text-center'},
                {data: 'name_of_person', 'class': 'text-center'},
                {data: 'full_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'hotelregi_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'hotelregi_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#hotelregi_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = hotelregiDataTable.row(tr);

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
    newHotelregiForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.hotelregi_data;
            Hotelregi.router.navigate('edit_hotelregi_form');
        } else {
            var formData = {};
            Hotelregi.router.navigate('hotelregi_form');
        }
        var templateData = {};
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.hotelregi_data = parseData.hotelregi_data;
        $('#hotelregi_form_and_datatable_container').html(hotelregiFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'name_of_tourist_area');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#category_of_hotel').val(formData.category_of_hotel);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            that.getFees(category_of_hotel);
            $('#name_of_tourist_area').val(formData.name_of_tourist_area);
            if (formData.permanent_resident_of_ut == IS_CHECKED_YES) {
                $('#permanent_resident_of_ut_yes').attr('checked', 'checked');
            } else if (formData.permanent_resident_of_ut == IS_CHECKED_NO) {
                $('#permanent_resident_of_ut_no').attr('checked', 'checked');
            }

            if (formData.other_business_of_applicant == IS_CHECKED_YES) {
                $('#other_business_of_applicant_yes').attr('checked', 'checked');
            } else if (formData.other_business_of_applicant == IS_CHECKED_NO) {
                $('#other_business_of_applicant_no').attr('checked', 'checked');
            }

            if (formData.site_plan != '') {
                that.showDocument('site_plan_container_for_hotelregi', 'site_plan_name_image_for_hotelregi', 'site_plan_name_container_for_hotelregi',
                        'site_plan_download', 'site_plan_remove_btn', formData.site_plan, formData.hotelregi_id, VALUE_ONE);
            }
            if (formData.construction_plan != '') {
                that.showDocument('construction_plan_container_for_hotelregi', 'construction_plan_name_image_for_hotelregi', 'construction_plan_name_container_for_hotelregi',
                        'construction_plan_download', 'construction_plan_remove_btn', formData.construction_plan, formData.hotelregi_id, VALUE_TWO);
            }
            if (formData.occupancy_certificate != '') {
                that.showDocument('occupancy_certificate_container_for_hotelregi', 'occupancy_certificate_name_image_for_hotelregi', 'occupancy_certificate_name_container_for_hotelregi',
                        'occupancy_certificate_download', 'occupancy_certificate_remove_btn', formData.occupancy_certificate, formData.hotelregi_id, VALUE_THREE);
            }
            if (formData.noc_medical != '') {
                that.showDocument('noc_medical_container_for_hotelregi', 'noc_medical_name_image_for_hotelregi', 'noc_medical_name_container_for_hotelregi',
                        'noc_medical_download', 'noc_medical_remove_btn', formData.noc_medical, formData.hotelregi_id, VALUE_FOUR);
            }
            if (formData.noc_concerned != '') {
                that.showDocument('noc_concerned_container_for_hotelregi', 'noc_concerned_name_image_for_hotelregi', 'noc_concerned_name_container_for_hotelregi',
                        'noc_concerned_download', 'noc_concerned_remove_btn', formData.noc_concerned, formData.hotelregi_id, VALUE_FIVE);
            }
            if (formData.noc_electricity != '') {
                that.showDocument('noc_electricity_container_for_hotelregi', 'noc_electricity_name_image_for_hotelregi', 'noc_electricity_name_container_for_hotelregi',
                        'noc_electricity_download', 'noc_electricity_remove_btn', formData.noc_electricity, formData.hotelregi_id, VALUE_SIX);
            }
            if (formData.aadhar_card_homestay != '') {
                that.showDocument('aadhar_card_container_for_homestay', 'aadhar_card_name_image_for_homestay', 'aadhar_card_name_container_for_homestay',
                        'aadhar_card_download', 'aadhar_card_remove_btn', formData.aadhar_card_homestay, formData.hotelregi_id, VALUE_SEVEN);
            }
            if (formData.form_xiv_homestay != '') {
                that.showDocument('form_xiv_container_for_homestay', 'form_xiv_name_image_for_homestay', 'form_xiv_name_container_for_homestay',
                        'form_xiv_download', 'form_xiv_remove_btn', formData.form_xiv_homestay, formData.hotelregi_id, VALUE_EIGHT);
            }
            if (formData.site_plan_homestay != '') {
                that.showDocument('site_plan_container_for_homestay', 'site_plan_name_image_for_homestay', 'site_plan_name_container_for_homestay   ',
                        'site_plan_homestay_download', 'site_plan_remove_btn', formData.site_plan_homestay, formData.hotelregi_id, VALUE_NINE);
            }
            if (formData.na_order_homestay != '') {
                that.showDocument('na_order_container_for_homestay', 'na_order_name_image_for_homestay', 'na_order_name_container_for_homestay',
                        'na_order_download', 'na_order_remove_btn', formData.na_order_homestay, formData.hotelregi_id, VALUE_TEN);
            }
            if (formData.completion_certificate_homestay != '') {
                that.showDocument('completion_certificate_container_for_homestay', 'completion_certificate_name_image_for_homestay', 'completion_certificate_name_container_for_homestay',
                        'completion_certificate_download', 'completion_certificate_remove_btn', formData.completion_certificate_homestay, formData.hotelregi_id, VALUE_ELEVEN);
            }
            if (formData.house_tax_receipt_homestay != '') {
                that.showDocument('house_tax_receipt_container_for_homestay', 'house_tax_receipt_name_image_for_homestay', 'house_tax_receipt_name_container_for_homestay',
                        'house_tax_receipt_download', 'house_tax_receipt_remove_btn', formData.house_tax_receipt_homestay, formData.hotelregi_id, VALUE_TWELVE);
            }
            if (formData.electricity_bill_homestay != '') {
                that.showDocument('electricity_bill_container_for_homestay', 'electricity_bill_name_image_for_homestay', 'electricity_bill_name_container_for_homestay',
                        'electricity_bill_download', 'electricity_bill_remove_btn', formData.electricity_bill_homestay, formData.hotelregi_id, VALUE_THIRTEEN);
            }
            if (formData.noc_fire != '') {
                that.showDocument('noc_fire_container_for_hotelregi', 'noc_fire_name_image_for_hotelregi', 'noc_fire_name_container_for_hotelregi',
                        'noc_fire_download', 'noc_fire_remove_btn', formData.noc_fire, formData.hotelregi_id, VALUE_FOURTEEN);
            }
            if (formData.police_clearance_certificate != '') {
                that.showDocument('police_clearance_certificate_container_for_hotelregi', 'police_clearance_certificate_name_image_for_hotelregi', 'police_clearance_certificate_name_container_for_hotelregi',
                        'police_clearance_certificate_download', 'police_clearance_certificate_remove_btn', formData.police_clearance_certificate, formData.hotelregi_id, VALUE_FIFTEEN);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_hotelregi', 'seal_and_stamp_name_image_for_hotelregi', 'seal_and_stamp_name_container_for_hotelregi',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.hotelregi_id, VALUE_SIXTEEN);
            }

            if (formData.name_of_agent != '') {
                var agentInfo = JSON.parse(formData.name_of_agent);
                $.each(agentInfo, function (key, value) {
                    that.addMultipleAgent(value);
                })
            }
        } else {
            that.addMultipleAgent({});
        }
        generateSelect2();
        datePicker();
        $('#hotelregi_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitHotelregi($('#submit_btn_for_hotelregi'));
            }
        });
    },
    editOrViewHotelregi: function (btnObj, hotelregiId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!hotelregiId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'Hotelregi/get_hotelregi_data_by_id',
            type: 'post',
            data: $.extend({}, {'hotelregi_id': hotelregiId}, getTokenData()),
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
                    that.newHotelregiForm(isEdit, parseData);
                } else {
                    that.viewHotelregiForm(parseData);
                }
            }
        });
    },
    viewHotelregiForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.hotelregi_data;
        Hotelregi.router.navigate('view_hotelregi_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#hotelregi_form_and_datatable_container').html(hotelregiViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'name_of_tourist_area');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#category_of_hotel').val(formData.category_of_hotel);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#name_of_tourist_area').val(formData.name_of_tourist_area);
        that.getFees(category_of_hotel);
        if (formData.permanent_resident_of_ut == IS_CHECKED_YES) {
            $('#permanent_resident_of_ut_yes').attr('checked', 'checked');
        } else if (formData.permanent_resident_of_ut == IS_CHECKED_NO) {
            $('#permanent_resident_of_ut_no').attr('checked', 'checked');
        }

        if (formData.other_business_of_applicant == IS_CHECKED_YES) {
            $('#other_business_of_applicant_yes').attr('checked', 'checked');
        } else if (formData.other_business_of_applicant == IS_CHECKED_NO) {
            $('#other_business_of_applicant_no').attr('checked', 'checked');
        }

        if (formData.site_plan != '') {
            that.showDocument('site_plan_container_for_hotelregi', 'site_plan_name_image_for_hotelregi', 'site_plan_name_container_for_hotelregi',
                    'site_plan_download', 'site_plan_remove_btn', formData.site_plan, formData.hotelregi_id, VALUE_ONE);
        }
        if (formData.construction_plan != '') {
            that.showDocument('construction_plan_container_for_hotelregi', 'construction_plan_name_image_for_hotelregi', 'construction_plan_name_container_for_hotelregi',
                    'construction_plan_download', 'construction_plan_remove_btn', formData.construction_plan, formData.hotelregi_id, VALUE_TWO);
        }
        if (formData.occupancy_certificate != '') {
            that.showDocument('occupancy_certificate_container_for_hotelregi', 'occupancy_certificate_name_image_for_hotelregi', 'occupancy_certificate_name_container_for_hotelregi',
                    'occupancy_certificate_download', 'occupancy_certificate_remove_btn', formData.occupancy_certificate, formData.hotelregi_id, VALUE_THREE);
        }
        if (formData.noc_medical != '') {
            that.showDocument('noc_medical_container_for_hotelregi', 'noc_medical_name_image_for_hotelregi', 'noc_medical_name_container_for_hotelregi',
                    'noc_medical_download', 'noc_medical_remove_btn', formData.noc_medical, formData.hotelregi_id, VALUE_FOUR);
        }
        if (formData.noc_concerned != '') {
            that.showDocument('noc_concerned_container_for_hotelregi', 'noc_concerned_name_image_for_hotelregi', 'noc_concerned_name_container_for_hotelregi',
                    'noc_concerned_download', 'noc_concerned_remove_btn', formData.noc_concerned, formData.hotelregi_id, VALUE_FIVE);
        }
        if (formData.noc_electricity != '') {
            that.showDocument('noc_electricity_container_for_hotelregi', 'noc_electricity_name_image_for_hotelregi', 'noc_electricity_name_container_for_hotelregi',
                    'noc_electricity_download', 'noc_electricity_remove_btn', formData.noc_electricity, formData.hotelregi_id, VALUE_SIX);
        }
        if (formData.aadhar_card_homestay != '') {
            that.showDocument('aadhar_card_container_for_homestay', 'aadhar_card_name_image_for_homestay', 'aadhar_card_name_container_for_homestay',
                    'aadhar_card_download', 'aadhar_card_remove_btn', formData.aadhar_card_homestay, formData.hotelregi_id, VALUE_SEVEN);
        }
        if (formData.form_xiv_homestay != '') {
            that.showDocument('form_xiv_container_for_homestay', 'form_xiv_name_image_for_homestay', 'form_xiv_name_container_for_homestay',
                    'form_xiv_download', 'form_xiv_remove_btn', formData.form_xiv_homestay, formData.hotelregi_id, VALUE_EIGHT);
        }
        if (formData.site_plan_homestay != '') {
            that.showDocument('site_plan_container_for_homestay', 'site_plan_name_image_for_homestay', 'site_plan_name_container_for_homestay   ',
                    'site_plan_homestay_download', 'site_plan_remove_btn', formData.site_plan_homestay, formData.hotelregi_id, VALUE_NINE);
        }
        if (formData.na_order_homestay != '') {
            that.showDocument('na_order_container_for_homestay', 'na_order_name_image_for_homestay', 'na_order_name_container_for_homestay',
                    'na_order_download', 'na_order_remove_btn', formData.na_order_homestay, formData.hotelregi_id, VALUE_TEN);
        }
        if (formData.completion_certificate_homestay != '') {
            that.showDocument('completion_certificate_container_for_homestay', 'completion_certificate_name_image_for_homestay', 'completion_certificate_name_container_for_homestay',
                    'completion_certificate_download', 'completion_certificate_remove_btn', formData.completion_certificate_homestay, formData.hotelregi_id, VALUE_ELEVEN);
        }
        if (formData.house_tax_receipt_homestay != '') {
            that.showDocument('house_tax_receipt_container_for_homestay', 'house_tax_receipt_name_image_for_homestay', 'house_tax_receipt_name_container_for_homestay',
                    'house_tax_receipt_download', 'house_tax_receipt_remove_btn', formData.house_tax_receipt_homestay, formData.hotelregi_id, VALUE_TWELVE);
        }
        if (formData.electricity_bill_homestay != '') {
            that.showDocument('electricity_bill_container_for_homestay', 'electricity_bill_name_image_for_homestay', 'electricity_bill_name_container_for_homestay',
                    'electricity_bill_download', 'electricity_bill_remove_btn', formData.electricity_bill_homestay, formData.hotelregi_id, VALUE_THIRTEEN);
        }
        if (formData.noc_fire != '') {
            that.showDocument('noc_fire_container_for_hotelregi', 'noc_fire_name_image_for_hotelregi', 'noc_fire_name_container_for_hotelregi',
                    'noc_fire_download', 'noc_fire_remove_btn', formData.noc_fire, formData.hotelregi_id, VALUE_FOURTEEN);
        }
        if (formData.police_clearance_certificate != '') {
            that.showDocument('police_clearance_certificate_container_for_hotelregi', 'police_clearance_certificate_name_image_for_hotelregi', 'police_clearance_certificate_name_container_for_hotelregi',
                    'police_clearance_certificate_download', 'police_clearance_certificate_remove_btn', formData.police_clearance_certificate, formData.hotelregi_id, VALUE_FIFTEEN);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_hotelregi', 'seal_and_stamp_name_image_for_hotelregi', 'seal_and_stamp_name_container_for_hotelregi',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.signature, formData.hotelregi_id, VALUE_SIXTEEN);
        }

        $('.remove_btn_hidden').hide();
        var agentInfo = JSON.parse(formData.name_of_agent);
        $.each(agentInfo, function (key, value) {
            that.addMultipleAgent(value);
            $(".name_of_agent").prop("readonly", true);
            $('.remove_btn_hidden').hide();
        })
    },
    checkValidationForHotelregi: function (hotelregiData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!hotelregiData.name_of_hotel) {
            return getBasicMessageAndFieldJSONArray('name_of_hotel', hotelNameValidationMessage);
        }
        if (!hotelregiData.name_of_person) {
            return getBasicMessageAndFieldJSONArray('name_of_person', applicantNameValidationMessage);
        }
        if (!hotelregiData.full_address) {
            return getBasicMessageAndFieldJSONArray('full_address', fullAddressValidationMessage);
        }
        if (!hotelregiData.name_of_tourist_area) {
            return getBasicMessageAndFieldJSONArray('name_of_tourist_area', nameOfTouristAreaValidationMessage);
        }
        if (!hotelregiData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!hotelregiData.name_of_proprietor) {
            return getBasicMessageAndFieldJSONArray('name_of_proprietor', nameOfProprietorValidationMessage);
        }
        if (!hotelregiData.category_of_hotel) {
            return getBasicMessageAndFieldJSONArray('category_of_hotel', categoryOfHotelValidationMessage);
        }
        hotelregiData.fees;
        if (!hotelregiData.mob_no) {
            return getBasicMessageAndFieldJSONArray('mob_no', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(hotelregiData.mob_no);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mob_no', invalidMobileValidationMessage);
        }
        if (!hotelregiData.name_of_manager) {
            return getBasicMessageAndFieldJSONArray('name_of_manager', nameOfManagerValidationMessage);
        }
        if (!hotelregiData.manager_permanent_address) {
            return getBasicMessageAndFieldJSONArray('manager_permanent_address', managerPermanentAddressValidationMessage);
        }
        var permanent_resident_of_ut = $('input[name=permanent_resident_of_ut]:checked').val();
        if (permanent_resident_of_ut == '' || permanent_resident_of_ut == null) {
            $('#permanent_resident_of_ut').focus();
            return getBasicMessageAndFieldJSONArray('permanent_resident_of_ut', permanentResidentUTValidationMessage);
        }
        var other_business_of_applicant = $('input[name=other_business_of_applicant]:checked').val();
        if (other_business_of_applicant == '' || other_business_of_applicant == null) {
            $('#other_business_of_applicant').focus();
            return getBasicMessageAndFieldJSONArray('other_business_of_applicant', otherBusinessOfApplicantValidationMessage);
        }

        return '';
    },
    askForSubmitHotelregi: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Hotelregi.listview.submitHotelregi(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitHotelregi: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var hotelregiData = $('#hotelregi_form').serializeFormJSON();
        var validationData = that.checkValidationForHotelregi(hotelregiData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('hotelregi-' + validationData.field, validationData.message);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }

        var agentInfoItem = [];
        var isagentValidation = false;

        $('.agent_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var agentInfo = {};
            var agentName = $('#name_of_agent_' + cnt).val();
            if (agentName == '' || agentName == null) {
                $('#name_of_agent_' + cnt).focus();
                validationMessageShow('hotelregi-' + cnt, agentNameValidationMessage);
                isagentValidation = true;
                return false;
            }
            agentInfo.name = agentName;

            agentInfoItem.push(agentInfo);
        });

        if (isagentValidation) {
            return false;
        }

        var categoryOfHotel = $('#category_of_hotel').val();
        if (categoryOfHotel == '') {
            return false;
        }
        if (categoryOfHotel == 'A' || categoryOfHotel == 'B' || categoryOfHotel == 'C' || categoryOfHotel == 'D') {
            if ($('#site_plan_container_for_hotelregi').is(':visible')) {
                var sitePlan = checkValidationForDocument('site_plan_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (sitePlan == false) {
                    return false;
                }
            }
            if ($('#construction_plan_container_for_hotelregi').is(':visible')) {
                var constructionPlan = checkValidationForDocument('construction_plan_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (constructionPlan == false) {
                    return false;
                }
            }
            if ($('#occupancy_certificate_container_for_hotelregi').is(':visible')) {
                var occupancyCertificate = checkValidationForDocument('occupancy_certificate_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (occupancyCertificate == false) {
                    return false;
                }
            }
            if ($('#noc_medical_container_for_hotelregi').is(':visible')) {
                var nocMedical = checkValidationForDocument('noc_medical_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (nocMedical == false) {
                    return false;
                }
            }
            if ($('#noc_concerned_container_for_hotelregi').is(':visible')) {
                var nocConcerned = checkValidationForDocument('noc_concerned_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (nocConcerned == false) {
                    return false;
                }
            }
            if ($('#noc_electricity_container_for_hotelregi').is(':visible')) {
                var nocElectricity = checkValidationForDocument('noc_electricity_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (nocElectricity == false) {
                    return false;
                }
            }
        } else
        if (categoryOfHotel == 'E') {
            if ($('#aadhar_card_container_for_homestay').is(':visible')) {
                var aadharCard = checkValidationForDocument('aadhar_card_for_homestay', VALUE_ONE, 'hotelregi');
                if (aadharCard == false) {
                    return false;
                }
            }
            if ($('#form_xiv_container_for_homestay').is(':visible')) {
                var formXiv = checkValidationForDocument('form_xiv_for_homestay', VALUE_ONE, 'hotelregi');
                if (formXiv == false) {
                    return false;
                }
            }
            if ($('#site_plan_container_for_homestay').is(':visible')) {
                var sitePlanHomestay = checkValidationForDocument('site_plan_for_homestay', VALUE_ONE, 'hotelregi');
                if (sitePlanHomestay == false) {
                    return false;
                }
            }
            if ($('#na_order_container_for_homestay').is(':visible')) {
                var naOrder = checkValidationForDocument('na_order_for_homestay', VALUE_ONE, 'hotelregi');
                if (naOrder == false) {
                    return false;
                }
            }
            if ($('#completion_certificate_container_for_homestay').is(':visible')) {
                var completionOccupancyCertificate = checkValidationForDocument('completion_certificate_for_homestay', VALUE_ONE, 'hotelregi');
                if (completionOccupancyCertificate == false) {
                    return false;
                }
            }
            if ($('#house_tax_receipt_container_for_homestay').is(':visible')) {
                var houseTaxReceipt = $('#house_tax_receipt_for_homestay').val();
                var completionOccupancyCertificate = checkValidationForDocument('completion_certificate_for_homestay', VALUE_ONE, 'hotelregi');
                if (completionOccupancyCertificate == false) {
                    return false;
                }
            }
            if ($('#electricity_bill_container_for_homestay').is(':visible')) {
                var electricityBill = checkValidationForDocument('electricity_bill_for_homestay', VALUE_ONE, 'hotelregi');
                if (electricityBill == false) {
                    return false;
                }
            }
        }
        if ($('#noc_fire_container_for_hotelregi').is(':visible')) {
            var nocFire = checkValidationForDocument('noc_fire_for_hotelregi', VALUE_ONE, 'hotelregi');
            if (nocFire == false) {
                return false;
            }
        }
        if ($('#police_clearance_certificate_container_for_hotelregi').is(':visible')) {
            var policeClearanceCertificate = checkValidationForDocument('police_clearance_certificate_for_hotelregi', VALUE_ONE, 'hotelregi');
            if (policeClearanceCertificate == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_hotelregi').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_hotelregi', VALUE_TWO, 'hotelregi');
            if (sealAndStamp == false) {
                return false;
            }
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_hotelregi') : $('#submit_btn_for_hotelregi');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var hotelregiData = new FormData($('#hotelregi_form')[0]);
        hotelregiData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        hotelregiData.append("agent_data", JSON.stringify(agentInfoItem));
        hotelregiData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'Hotelregi/submit_hotelregi',
            data: hotelregiData,
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
                validationMessageShow('hotelregi', textStatus.statusText);
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
                    validationMessageShow('hotelregi', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Hotelregi.router.navigate('hotelregi', {'trigger': true});
            }
        });
    },

    askForRemove: function (hotelregiId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!hotelregiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Hotelregi.listview.removeDocument(\'' + hotelregiId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (hotelregiId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!hotelregiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_hotelregi_' + docType).hide();
        $('.spinner_name_container_for_hotelregi_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'Hotelregi/remove_document',
            data: $.extend({}, {'hotelregi_id': hotelregiId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_hotelregi_' + docType).hide();
                $('.spinner_name_container_for_hotelregi_' + docType).show();
                validationMessageShow('hotelregi', textStatus.statusText);
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
                    validationMessageShow('hotelregi', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_hotelregi_' + docType).show();
                $('.spinner_name_container_for_hotelregi_' + docType).hide();
                showSuccess(parseData.message);

                if (docType == VALUE_ONE) {
                    removeDocumentValue('site_plan_name_container_for_hotelregi', 'site_plan_name_image_for_hotelregi', 'site_plan_container_for_hotelregi', 'site_plan_for_hotelregi');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('construction_plan_name_container_for_hotelregi', 'construction_plan_name_image_for_hotelregi', 'construction_plan_container_for_hotelregi', 'construction_plan_for_hotelregi');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('occupancy_certificate_name_container_for_hotelregi', 'occupancy_certificate_name_image_for_hotelregi', 'occupancy_certificate_container_for_hotelregi', 'occupancy_certificate_for_hotelregi');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('noc_medical_name_container_for_hotelregi', 'noc_medical_name_image_for_hotelregi', 'noc_medical_container_for_hotelregi', 'noc_medical_for_hotelregi');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('noc_concerned_name_container_for_hotelregi', 'noc_concerned_name_image_for_hotelregi', 'noc_concerned_container_for_hotelregi', 'noc_concerned_for_hotelregi');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('noc_electricity_name_container_for_hotelregi', 'noc_electricity_name_image_for_hotelregi', 'noc_electricity_container_for_hotelregi', 'noc_electricity_for_hotelregi');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('aadhar_card_name_container_for_homestay', 'aadhar_card_name_image_for_homestay', 'aadhar_card_container_for_homestay', 'aadhar_card_for_homestay');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('form_xiv_name_container_for_homestay', 'form_xiv_name_image_for_homestay', 'form_xiv_container_for_homestay', 'form_xiv_for_homestay');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('site_plan_name_container_for_homestay', 'site_plan_name_image_for_homestay', 'site_plan_container_for_homestay', 'site_plan_for_homestay');
                }
                if (docType == VALUE_TEN) {
                    removeDocumentValue('na_order_name_container_for_homestay', 'na_order_name_image_for_homestay', 'na_order_container_for_homestay', 'na_order_for_homestay');
                }
                if (docType == VALUE_ELEVEN) {
                    removeDocumentValue('completion_certificate_name_container_for_homestay', 'completion_certificate_name_image_for_homestay', 'completion_certificate_container_for_homestay', 'completion_certificate_for_homestay');
                }
                if (docType == VALUE_TWELVE) {
                    removeDocumentValue('house_tax_receipt_name_container_for_homestay', 'house_tax_receipt_name_image_for_homestay', 'house_tax_receipt_container_for_homestay', 'house_tax_receipt_for_homestay');
                }
                if (docType == VALUE_THIRTEEN) {
                    removeDocumentValue('electricity_bill_name_container_for_homestay', 'electricity_bill_name_image_for_homestay', 'electricity_bill_container_for_homestay', 'electricity_bill_for_homestay');
                }
                if (docType == VALUE_FOURTEEN) {
                    removeDocumentValue('noc_fire_name_container_for_hotelregi', 'noc_fire_name_image_for_hotelregi', 'noc_fire_container_for_hotelregi', 'noc_fire_for_hotelregi');
                }
                if (docType == VALUE_FIFTEEN) {
                    removeDocumentValue('police_clearance_certificate_name_container_for_hotelregi', 'police_clearance_certificate_name_image_for_hotelregi', 'police_clearance_certificate_container_for_hotelregi', 'police_clearance_certificate_for_hotelregi');
                }
                if (docType == VALUE_SIXTEEN) {
                    removeDocumentValue('seal_and_stamp_name_container_for_hotelregi', 'seal_and_stamp_name_image_for_hotelregi', 'seal_and_stamp_container_for_hotelregi', 'seal_and_stamp_for_hotelregi');
                }
            }
        });
    },
    generateFormII: function (hotelregiId) {
        if (!hotelregiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#hotelregi_id_for_hotelregi_formII').val(hotelregiId);
        $('#hotelregi_form1_pdf_form').submit();
        $('#hotelregi_id_for_hotelregi_formII').val('');
    },

    downloadUploadChallan: function (hotelregiId) {
        if (!hotelregiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + hotelregiId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'Hotelregi/get_hotelregi_data_by_hotelregi_id',
            type: 'post',
            data: $.extend({}, {'hotelregi_id': hotelregiId}, getTokenData()),
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
                var hotelregiData = parseData.hotelregi_data;
                that.showChallan(hotelregiData);
            }
        });
    },
    showChallan: function (hotelregiData) {
        showPopup();
        if (hotelregiData.status != VALUE_FIVE && hotelregiData.status != VALUE_SIX && hotelregiData.status != VALUE_SEVEN && hotelregiData.status != VALUE_ELEVEN) {
            if (!hotelregiData.hide_submit_btn) {
                hotelregiData.show_fees_paid = true;
            }
        }
        if (hotelregiData.payment_type == VALUE_ONE) {
            hotelregiData.utitle = 'Fees Paid Challan Copy';
        } else {
            hotelregiData.style = 'display: none;';
        }
        if (hotelregiData.payment_type == VALUE_TWO) {
            hotelregiData.show_dd_po_option = true;
            hotelregiData.utitle = 'Demand Draft (DD)';
        }
        hotelregiData.module_type = VALUE_SIX;
        $('#popup_container').html(hotelregiUploadChallanTemplate(hotelregiData));
        loadFB(VALUE_SIX, hotelregiData.fb_data);
        loadPH(VALUE_SIX, hotelregiData.hotelregi_id, hotelregiData.ph_data);

        if (hotelregiData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'hotelregi_upload_challan', hotelregiData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'hotelregi_upload_challan', 'uc', 'radio');
            if (hotelregiData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_hotelregi_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (hotelregiData.challan != '') {
            $('#challan_container_for_hotelregi_upload_challan').hide();
            $('#challan_name_container_for_hotelregi_upload_challan').show();
            $('#challan_name_href_for_hotelregi_upload_challan').attr('href', 'documents/hotelregi/' + hotelregiData.challan);
            $('#challan_name_for_hotelregi_upload_challan').html(hotelregiData.challan);
        }
        if (hotelregiData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_hotelregi_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_hotelregi_upload_challan').show();
            $('#fees_paid_challan_name_href_for_hotelregi_upload_challan').attr('href', 'documents/hotelregi/' + hotelregiData.fees_paid_challan);
            $('#fees_paid_challan_name_for_hotelregi_upload_challan').html(hotelregiData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_hotelregi_upload_challan').attr('onclick', 'Hotelregi.listview.removeFeesPaidChallan("' + hotelregiData.hotelregi_id + '")');
        }
    },
    removeFeesPaidChallan: function (hotelregiId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!hotelregiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'Hotelregi/remove_fees_paid_challan',
            data: $.extend({}, {'hotelregi_id': hotelregiId}, getTokenData()),
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
                validationMessageShow('hotelregi-uc', textStatus.statusText);
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
                    validationMessageShow('hotelregi-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-hotelregi-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'hotelregi_upload_challan');
                $('#status_' + hotelregiId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-hotelregi-uc').html('');
        validationMessageHide();
        var hotelregiId = $('#hotelregi_id_for_hotelregi_upload_challan').val();
        if (!hotelregiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_hotelregi_upload_challan').is(':visible')) {
            var challan = $('#fees_paid_challan_for_hotelregi_upload_challan').val();
            if (challan == '') {
                $('#fees_paid_challan_for_hotelregi_upload_challan').focus();
                validationMessageShow('hotelregi-uc-fees_paid_challan_for_hotelregi_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_hotelregi_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_hotelregi_upload_challan').focus();
                validationMessageShow('hotelregi-uc-fees_paid_challan_for_hotelregi_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_hotelregi_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#hotelregi_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'Hotelregi/upload_fees_paid_challan',
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
                validationMessageShow('hotelregi-uc', textStatus.statusText);
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
                    validationMessageShow('hotelregi-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + hotelregiId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (hotelregiId) {
        if (!hotelregiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#hotelregi_id_for_certificate').val(hotelregiId);
        $('#hotelregi_certificate_pdf_form').submit();
        $('#hotelregi_id_for_certificate').val('');
    },
    addMultipleAgent: function (templateData) {
        templateData.per_cnt = tempAgentInfoCnt;
        $('#agent_info_container').append(hotelregiAgentInfoTemplate(templateData));
        tempAgentInfoCnt++;
        resetCounter('display-cnt');
    },
    removeAgentInfo: function (perCnt) {
        $('#agent_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    getQueryData: function (hotelregiId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!hotelregiId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_SIX;
        templateData.module_id = hotelregiId;
        var btnObj = $('#query_btn_for_hotelregi_' + hotelregiId);
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
                tmpData.application_number = regNoRenderer(VALUE_SIX, moduleData.hotelregi_id);
                tmpData.applicant_name = moduleData.name_of_hotel;
                tmpData.title = 'Hotel Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getFees: function (category) {
        $("#fees").prop("readonly", true);
        var categoryOfHotel = category.value;
        if (categoryOfHotel == '') {
            return false;
        }

        if (categoryOfHotel == 'A') {
            $('#fees').val('Rs. 5000');
            $('.hotel').show();
            $('.homestay').hide();
        } else if (categoryOfHotel == 'B') {
            $('#fees').val('Rs. 4000');
            $('.hotel').show();
            $('.homestay').hide();
        } else if (categoryOfHotel == 'C') {
            $('#fees').val('Rs. 3000');
            $('.hotel').show();
            $('.homestay').hide();
        } else if (categoryOfHotel == 'D') {
            $('#fees').val('Rs. 2000');
            $('.hotel').show();
            $('.homestay').hide();
        } else if (categoryOfHotel == 'E') {
            $('#fees').val('Rs. 200');
            $('.hotel').hide();
            $('.homestay').show();
        }
    },
    uploadDocumentForHotelregi: function (fileNo) {
        var that = this;
        var categoryOfHotel = $('#category_of_hotel').val();
        if (categoryOfHotel == '') {
            return false;
        }
        if (categoryOfHotel == 'A' || categoryOfHotel == 'B' || categoryOfHotel == 'C' || categoryOfHotel == 'D') {
            if ($('#site_plan_for_hotelregi').val() != '') {
                var sitePlan = checkValidationForDocument('site_plan_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (sitePlan == false) {
                    return false;
                }
            }
            if ($('#construction_plan_for_hotelregi').val() != '') {
                var constructionPlan = checkValidationForDocument('construction_plan_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (constructionPlan == false) {
                    return false;
                }
            }
            if ($('#occupancy_certificate_for_hotelregi').val() != '') {
                var occupancyCertificate = checkValidationForDocument('occupancy_certificate_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (occupancyCertificate == false) {
                    return false;
                }
            }
            if ($('#noc_medical_for_hotelregi').val() != '') {
                var nocMedical = checkValidationForDocument('noc_medical_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (nocMedical == false) {
                    return false;
                }
            }
            if ($('#noc_concerned_for_hotelregi').val() != '') {
                var nocConcerned = checkValidationForDocument('noc_concerned_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (nocConcerned == false) {
                    return false;
                }
            }
            if ($('#noc_electricity_for_hotelregi').val() != '') {
                var nocElectricity = checkValidationForDocument('noc_electricity_for_hotelregi', VALUE_ONE, 'hotelregi');
                if (nocElectricity == false) {
                    return false;
                }
            }
        } else
        if (categoryOfHotel == 'E') {
            if ($('#aadhar_card_for_homestay').val() != '') {
                var aadharCard = checkValidationForDocument('aadhar_card_for_homestay', VALUE_ONE, 'hotelregi');
                if (aadharCard == false) {
                    return false;
                }
            }
            if ($('#form_xiv_for_homestay').val() != '') {
                var formXiv = checkValidationForDocument('form_xiv_for_homestay', VALUE_ONE, 'hotelregi');
                if (formXiv == false) {
                    return false;
                }
            }
            if ($('#site_plan_for_homestay').val() != '') {
                var sitePlanHomestay = checkValidationForDocument('site_plan_for_homestay', VALUE_ONE, 'hotelregi');
                if (sitePlanHomestay == false) {
                    return false;
                }
            }
            if ($('#na_order_for_homestay').val() != '') {
                var naOrder = checkValidationForDocument('na_order_for_homestay', VALUE_ONE, 'hotelregi');
                if (naOrder == false) {
                    return false;
                }
            }
            if ($('#completion_certificate_for_homestay').val() != '') {
                var completionOccupancyCertificate = checkValidationForDocument('completion_certificate_for_homestay', VALUE_ONE, 'hotelregi');
                if (completionOccupancyCertificate == false) {
                    return false;
                }
            }
            if ($('#house_tax_receipt_for_homestay').val() != '') {
                var houseTaxReceipt = checkValidationForDocument('house_tax_receipt_for_homestay', VALUE_ONE, 'hotelregi');
                if (houseTaxReceipt == false) {
                    return false;
                }
            }
            if ($('#electricity_bill_for_homestay').val() != '') {
                var electricityBill = checkValidationForDocument('electricity_bill_for_homestay', VALUE_ONE, 'hotelregi');
                if (electricityBill == false) {
                    return false;
                }
            }
        }
        if ($('#noc_fire_for_hotelregi').val() != '') {
            var nocFire = checkValidationForDocument('noc_fire_for_hotelregi', VALUE_ONE, 'hotelregi');
            if (nocFire == false) {
                return false;
            }
        }
        if ($('#police_clearance_certificate_for_hotelregi').val() != '') {
            var policeClearanceCertificate = checkValidationForDocument('police_clearance_certificate_for_hotelregi', VALUE_ONE, 'hotelregi');
            if (policeClearanceCertificate == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_for_hotelregi').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_hotelregi', VALUE_TWO, 'hotelregi');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_hotelregi_' + fileNo).hide();
        $('.spinner_name_container_for_hotelregi_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var hotelregiId = $('#hotelregi_id').val();
        var formData = new FormData($('#hotelregi_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("hotelregi_id", hotelregiId);
        $.ajax({
            type: 'POST',
            url: 'hotelregi/upload_hotelregi_document',
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
                $('.spinner_container_for_hotelregi_' + fileNo).show();
                $('.spinner_name_container_for_hotelregi_' + fileNo).hide();
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
                    $('.spinner_container_for_hotelregi_' + fileNo).show();
                    $('.spinner_name_container_for_hotelregi_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_hotelregi_' + fileNo).hide();
                $('.spinner_name_container_for_hotelregi_' + fileNo).show();
                $('#hotelregi_id').val(parseData.hotelregi_id);
                var hotelregiData = parseData.hotelregi_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('site_plan_container_for_hotelregi', 'site_plan_name_image_for_hotelregi', 'site_plan_name_container_for_hotelregi',
                            'site_plan_download', 'site_plan_remove_btn', hotelregiData.site_plan, parseData.hotelregi_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('construction_plan_container_for_hotelregi', 'construction_plan_name_image_for_hotelregi', 'construction_plan_name_container_for_hotelregi',
                            'construction_plan_download', 'construction_plan_remove_btn', hotelregiData.construction_plan, parseData.hotelregi_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('occupancy_certificate_container_for_hotelregi', 'occupancy_certificate_name_image_for_hotelregi', 'occupancy_certificate_name_container_for_hotelregi',
                            'occupancy_certificate_download', 'occupancy_certificate_remove_btn', hotelregiData.occupancy_certificate, parseData.hotelregi_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('noc_medical_container_for_hotelregi', 'noc_medical_name_image_for_hotelregi', 'noc_medical_name_container_for_hotelregi',
                            'noc_medical_download', 'noc_medical_remove_btn', hotelregiData.noc_medical, parseData.hotelregi_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('noc_concerned_container_for_hotelregi', 'noc_concerned_name_image_for_hotelregi', 'noc_concerned_name_container_for_hotelregi',
                            'noc_concerned_download', 'noc_concerned_remove_btn', hotelregiData.noc_concerned, parseData.hotelregi_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('noc_electricity_container_for_hotelregi', 'noc_electricity_name_image_for_hotelregi', 'noc_electricity_name_container_for_hotelregi',
                            'noc_electricity_download', 'noc_electricity_remove_btn', hotelregiData.noc_electricity, parseData.hotelregi_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('aadhar_card_container_for_homestay', 'aadhar_card_name_image_for_homestay', 'aadhar_card_name_container_for_homestay',
                            'aadhar_card_download', 'aadhar_card_remove_btn', hotelregiData.aadhar_card_homestay, parseData.hotelregi_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('form_xiv_container_for_homestay', 'form_xiv_name_image_for_homestay', 'form_xiv_name_container_for_homestay',
                            'form_xiv_download', 'form_xiv_remove_btn', hotelregiData.form_xiv_homestay, parseData.hotelregi_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('site_plan_container_for_homestay', 'site_plan_name_image_for_homestay', 'site_plan_name_container_for_homestay   ',
                            'site_plan_homestay_download', 'site_plan_remove_btn', hotelregiData.site_plan_homestay, parseData.hotelregi_id, VALUE_NINE);
                }
                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('na_order_container_for_homestay', 'na_order_name_image_for_homestay', 'na_order_name_container_for_homestay',
                            'na_order_download', 'na_order_remove_btn', hotelregiData.na_order_homestay, parseData.hotelregi_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('completion_certificate_container_for_homestay', 'completion_certificate_name_image_for_homestay', 'completion_certificate_name_container_for_homestay',
                            'completion_certificate_download', 'completion_certificate_remove_btn', hotelregiData.completion_certificate_homestay, parseData.hotelregi_id, VALUE_ELEVEN);
                }
                if (parseData.file_no == VALUE_TWELVE) {
                    that.showDocument('house_tax_receipt_container_for_homestay', 'house_tax_receipt_name_image_for_homestay', 'house_tax_receipt_name_container_for_homestay',
                            'house_tax_receipt_download', 'house_tax_receipt_remove_btn', hotelregiData.house_tax_receipt_homestay, parseData.hotelregi_id, VALUE_TWELVE);
                }
                if (parseData.file_no == VALUE_THIRTEEN) {
                    that.showDocument('electricity_bill_container_for_homestay', 'electricity_bill_name_image_for_homestay', 'electricity_bill_name_container_for_homestay',
                            'electricity_bill_download', 'electricity_bill_remove_btn', hotelregiData.electricity_bill_homestay, parseData.hotelregi_id, VALUE_THIRTEEN);
                }
                if (parseData.file_no == VALUE_FOURTEEN) {
                    that.showDocument('noc_fire_container_for_hotelregi', 'noc_fire_name_image_for_hotelregi', 'noc_fire_name_container_for_hotelregi',
                            'noc_fire_download', 'noc_fire_remove_btn', hotelregiData.noc_fire, parseData.hotelregi_id, VALUE_FOURTEEN);
                }
                if (parseData.file_no == VALUE_FIFTEEN) {
                    that.showDocument('police_clearance_certificate_container_for_hotelregi', 'police_clearance_certificate_name_image_for_hotelregi', 'police_clearance_certificate_name_container_for_hotelregi',
                            'police_clearance_certificate_download', 'police_clearance_certificate_remove_btn', hotelregiData.police_clearance_certificate, parseData.hotelregi_id, VALUE_FIFTEEN);
                }
                if (parseData.file_no == VALUE_SIXTEEN) {
                    that.showDocument('seal_and_stamp_container_for_hotelregi', 'seal_and_stamp_name_image_for_hotelregi', 'seal_and_stamp_name_container_for_hotelregi',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', hotelregiData.signature, parseData.hotelregi_id, VALUE_SIXTEEN);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/hotelregi/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/hotelregi/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Hotelregi.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
