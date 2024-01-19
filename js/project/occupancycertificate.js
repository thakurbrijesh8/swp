var occupancyCertificateListTemplate = Handlebars.compile($('#occupancycertificate_list_template').html());
var occupancyCertificateTableTemplate = Handlebars.compile($('#occupancycertificate_table_template').html());
var occupancyCertificateActionTemplate = Handlebars.compile($('#occupancycertificate_action_template').html());
var occupancyCertificateFormTemplate = Handlebars.compile($('#occupancycertificate_form_template').html());
var occupancyCertificateViewTemplate = Handlebars.compile($('#occupancycertificate_view_template').html());
var occupancyCertificateUploadChallanTemplate = Handlebars.compile($('#occupancycertificate_upload_challan_template').html());

var tempPersonCnt = 1;

var OccupancyCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
OccupancyCertificate.Router = Backbone.Router.extend({
    routes: {
        'occupancycertificate': 'renderList',
        'occupancycertificate_form': 'renderListForForm',
        'edit_occupancycertificate_form': 'renderList',
        'view_occupancycertificate_form': 'renderList',
    },
    renderList: function () {
        OccupancyCertificate.listview.listPage();
    },
    renderListForForm: function () {
        OccupancyCertificate.listview.listPageShootingForm();
    }
});
OccupancyCertificate.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="is_fire_noc"]': 'hasFireNOCEvent',
        'click input[name="is_existing_building_plan"]': 'hasBuildingPlanEvent',
        'click input[name="is_form_of_indemnity"]': 'hasformOfIndemnityEvent',
        'click input[name="is_stability_certificate"]': 'hasStabilityCertificateEvent',
        'click input[name="is_occupancy_certificate_dnh"]': 'hasOccupancyCertificatednhEvent',
    },
    hasStabilityCertificateEvent: function (event) {
        var val = $('input[name=is_stability_certificate]:checked').val();
        if (val === '1') {
            this.$('.stability_certificate_div').show();
        } else {
            this.$('.stability_certificate_div').hide();

        }
    },
    hasFireNOCEvent: function (event) {
        var val = $('input[name=is_fire_noc]:checked').val();
        if (val === '1') {
            this.$('.fire_noc_div').show();
        } else {
            this.$('.fire_noc_div').hide();

        }
    },
    hasBuildingPlanEvent: function (event) {
        var val = $('input[name=is_existing_building_plan]:checked').val();
        if (val === '2') {
            this.$('.existing_building_plan_div').show();
        } else {
            this.$('.existing_building_plan_div').hide();

        }
    },
    hasformOfIndemnityEvent: function (event) {
        var val = $('input[name=is_form_of_indemnity]:checked').val();
        if (val === '1') {
            this.$('.form_of_indemnity_div').show();
        } else {
            this.$('.form_of_indemnity_div').hide();

        }
    },
    hasOccupancyCertificatednhEvent: function (event) {
        var val = $('input[name=is_occupancy_certificate_dnh]:checked').val();
        if (val === '1') {
            this.$('.occupancy_certificate_dnh_div').show();
        } else {
            this.$('.occupancy_certificate_dnh_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('occupancycertificate', 'active');
        OccupancyCertificate.router.navigate('occupancycertificate');
        var templateData = {};
        this.$el.html(occupancyCertificateListTemplate(templateData));
        this.loadOccupancyCertificateData(sDistrict, sStatus);

    },
    listPageShootingForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('occupancycertificate', 'active');
        this.$el.html(occupancyCertificateListTemplate);
        this.newOccupancyCertificateForm(false, {});
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
                rowData.ADMIN_OCCUPANCY_DOC_PATH = ADMIN_OCCUPANCY_DOC_PATH;
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
        return occupancyCertificateActionTemplate(rowData);
    },
    loadOccupancyCertificateData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTYEIGHT, data)
                    + getFRContainer(VALUE_TWENTYEIGHT, data, full.rating, full.fr_datetime);
        };
        var that = this;
        OccupancyCertificate.router.navigate('occupancycertificate');
        $('#occupancycertificate_form_and_datatable_container').html(occupancyCertificateTableTemplate(searchData));
        occupancyCertificateDataTable = $('#occupancycertificate_datatable').DataTable({
            ajax: {url: 'occupancy_certificate/get_occupancycertificate_data', dataSrc: "occupancycertificate_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'occupancy_certificate_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'plot_no', 'class': 'text-center'},
                {data: 'license_no', 'class': 'text-center'},
                {data: 'situated_at', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'occupancy_certificate_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'occupancy_certificate_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#occupancycertificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = occupancyCertificateDataTable.row(tr);

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
    newOccupancyCertificateForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.occupancycertificate_data;
            OccupancyCertificate.router.navigate('edit_occupancycertificate_form');
        } else {
            var formData = {};
            OccupancyCertificate.router.navigate('occupancycertificate_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.occupancycertificate_data = parseData.occupancycertificate_data;
        if (isEdit) {

            templateData.completed_on = dateTo_DD_MM_YYYY(formData.completed_on);
            templateData.occupancy_valid_upto = dateTo_DD_MM_YYYY(formData.occupancy_valid_upto);
        }
        $('#occupancycertificate_form_and_datatable_container').html(occupancyCertificateFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            that.getDepartmentdata(district);

            if (formData.is_fire_noc == VALUE_ONE) {
                $('#is_fire_noc_yes').attr('checked', 'checked');
                this.$('.fire_noc_div').show();
            }
            if (formData.is_existing_building_plan == VALUE_TWO) {
                $('#is_existing_building_plan_no').attr('checked', 'checked');
                this.$('.existing_building_plan_div').show();
            }
            if (formData.is_form_of_indemnity == VALUE_ONE) {
                $('#is_form_of_indemnity_yes').attr('checked', 'checked');
                this.$('.form_of_indemnity_div').show();
            }
            if (formData.is_stability_certificate == VALUE_ONE) {
                $('#is_stability_certificate_yes').attr('checked', 'checked');
                this.$('.stability_certificate_div').show();
            }
            // if (formData.is_occupancy_certificate_dnh == VALUE_ONE) {
            //     $('#is_occupancy_certificate_dnh_yes').attr('checked', 'checked');
            //     this.$('.').show();
            // }occupancy_certificate_dnh_div

            if (formData.is_occupancy_certificate_dnh == IS_CHECKED_YES) {
                $('#is_occupancy_certificate_dnh_yes').attr('checked', 'checked');
                $('.occupancy_certificate_dnh_div').show();
            } else if (formData.is_occupancy_certificate_dnh == IS_CHECKED_NO) {
                $('#is_occupancy_certificate_dnh_no').attr('checked', 'checked');
            }


            if (formData.annexure_14 != '') {
                that.showDocument('annexure_14_container_for_occupancycertificate', 'annexure_14_name_image_for_occupancycertificate', 'annexure_14_name_container_for_occupancycertificate',
                        'annexure_14_download', 'annexure_14', formData.annexure_14, formData.occupancy_certificate_id, VALUE_ONE);
            }
            if (formData.oc_part_oc != '') {
                that.showDocument('oc_part_oc_container_for_occupancycertificate', 'oc_part_oc_name_image_for_occupancycertificate', 'oc_part_oc_name_container_for_occupancycertificate',
                        'oc_part_oc_download', 'oc_part_oc', formData.oc_part_oc, formData.occupancy_certificate_id, VALUE_TWO);
            }
            if (formData.copy_of_construction_permission != '') {
                that.showDocument('copy_of_construction_permission_container_for_occupancycertificate', 'copy_of_construction_permission_name_image_for_occupancycertificate', 'copy_of_construction_permission_name_container_for_occupancycertificate',
                        'copy_of_construction_permission_download', 'copy_of_construction_permission', formData.copy_of_construction_permission, formData.occupancy_certificate_id, VALUE_THREE);
            }
            if (formData.copy_of_building_plan != '') {
                that.showDocument('copy_of_building_plan_container_for_occupancycertificate', 'copy_of_building_plan_name_image_for_occupancycertificate', 'copy_of_building_plan_name_container_for_occupancycertificate',
                        'copy_of_building_plan_download', 'copy_of_building_plan', formData.copy_of_building_plan, formData.occupancy_certificate_id, VALUE_FOUR);
            }
            if (formData.stability_certificate != '') {
                that.showDocument('stability_certificate_container_for_occupancycertificate', 'stability_certificate_name_image_for_occupancycertificate', 'stability_certificate_name_container_for_occupancycertificate',
                        'stability_certificate_download', 'stability_certificate', formData.stability_certificate, formData.occupancy_certificate_id, VALUE_FIVE);
            }
            if (formData.building_height_noc != '') {
                that.showDocument('building_height_noc_container_for_occupancycertificate', 'building_height_noc_name_image_for_occupancycertificate', 'building_height_noc_name_container_for_occupancycertificate',
                        'building_height_noc_download', 'building_height_noc', formData.building_height_noc, formData.occupancy_certificate_id, VALUE_SIX);
            }
            if (formData.fire_noc != '') {
                that.showDocument('fire_noc_container_for_occupancycertificate', 'fire_noc_name_image_for_occupancycertificate', 'fire_noc_name_container_for_occupancycertificate',
                        'fire_noc_download', 'fire_noc', formData.fire_noc, formData.occupancy_certificate_id, VALUE_SEVEN);
            }
            if (formData.copy_of_water_harvesting != '') {
                that.showDocument('copy_of_water_harvesting_container_for_occupancycertificate', 'copy_of_water_harvesting_name_image_for_occupancycertificate', 'copy_of_water_harvesting_name_container_for_occupancycertificate',
                        'copy_of_water_harvesting_download', 'copy_of_water_harvesting', formData.copy_of_water_harvesting, formData.occupancy_certificate_id, VALUE_EIGHT);
            }
            if (formData.existing_building_plan != '') {
                that.showDocument('existing_building_plan_container_for_occupancycertificate', 'existing_building_plan_name_image_for_occupancycertificate', 'existing_building_plan_name_container_for_occupancycertificate',
                        'existing_building_plan_download', 'existing_building_plan', formData.existing_building_plan, formData.occupancy_certificate_id, VALUE_NINE);
            }
            if (formData.form_of_indemnity != '') {
                that.showDocument('form_of_indemnity_container_for_occupancycertificate', 'form_of_indemnity_name_image_for_occupancycertificate', 'form_of_indemnity_name_container_for_occupancycertificate',
                        'form_of_indemnity_download', 'form_of_indemnity', formData.form_of_indemnity, formData.occupancy_certificate_id, VALUE_TEN);
            }
            if (formData.fire_emergency != '') {
                that.showDocument('fire_emergency_container_for_occupancycertificate', 'fire_emergency_name_image_for_occupancycertificate', 'fire_emergency_name_container_for_occupancycertificate',
                        'fire_emergency_download', 'fire_emergency', formData.fire_emergency, formData.occupancy_certificate_id, VALUE_ELEVEN);
            }
            if (formData.building_plan != '') {
                that.showDocument('building_plan_container_for_occupancycertificate', 'building_plan_name_image_for_occupancycertificate', 'building_plan_name_container_for_occupancycertificate',
                        'building_plan_download', 'building_plan', formData.building_plan, formData.occupancy_certificate_id, VALUE_TWELVE);
            }
            if (formData.stability_certificate_dnh != '') {
                that.showDocument('stability_certificate_dnh_container_for_occupancycertificate', 'stability_certificate_dnh_name_image_for_occupancycertificate', 'stability_certificate_dnh_name_container_for_occupancycertificate',
                        'stability_certificate_dnh_download', 'stability_certificate_dnh', formData.stability_certificate_dnh, formData.occupancy_certificate_id, VALUE_THIRTEEN);
            }
            if (formData.occupancy_certificate_dnh != '') {
                that.showDocument('occupancy_certificate_dnh_container_for_occupancycertificate', 'occupancy_certificate_dnh_name_image_for_occupancycertificate', 'occupancy_certificate_dnh_name_container_for_occupancycertificate',
                        'occupancy_certificate_dnh_download', 'occupancy_certificate_dnh', formData.occupancy_certificate_dnh, formData.occupancy_certificate_id, VALUE_FOURTEEN);
            }
            if (formData.existing_cp != '') {
                that.showDocument('existing_cp_container_for_occupancycertificate', 'existing_cp_name_image_for_occupancycertificate', 'existing_cp_name_container_for_occupancycertificate',
                        'existing_cp_download', 'existing_cp', formData.existing_cp, formData.occupancy_certificate_id, VALUE_FIFTEEN);
            }
            if (formData.labour_cess_certificate != '') {
                that.showDocument('labour_cess_certificate_container_for_occupancycertificate', 'labour_cess_certificate_name_image_for_occupancycertificate', 'labour_cess_certificate_name_container_for_occupancycertificate',
                        'labour_cess_certificate_download', 'labour_cess_certificate', formData.labour_cess_certificate, formData.occupancy_certificate_id, VALUE_SIXTEEN);
            }
            if (formData.valuation_certificate != '') {
                that.showDocument('valuation_certificate_container_for_occupancycertificate', 'valuation_certificate_name_image_for_occupancycertificate', 'valuation_certificate_name_container_for_occupancycertificate',
                        'valuation_certificate_download', 'valuation_certificate', formData.valuation_certificate, formData.occupancy_certificate_id, VALUE_SEVENTEEN);
            }
            if (formData.bank_deposit_sleep != '') {
                that.showDocument('bank_deposit_sleep_container_for_occupancycertificate', 'bank_deposit_sleep_name_image_for_occupancycertificate', 'bank_deposit_sleep_name_container_for_occupancycertificate',
                        'bank_deposit_sleep_download', 'bank_deposit_sleep', formData.bank_deposit_sleep, formData.occupancy_certificate_id, VALUE_EIGHTEEN);
            }
            if (formData.deviation_photographs != '') {
                that.showDocument('deviation_photographs_container_for_occupancycertificate', 'deviation_photographs_name_image_for_occupancycertificate', 'deviation_photographs_name_container_for_occupancycertificate',
                        'deviation_photographs_download', 'deviation_photographs', formData.deviation_photographs, formData.occupancy_certificate_id, VALUE_NINETEEN);
            }
            if (formData.copy_7_12 != '') {
                that.showDocument('copy_7_12_container_for_occupancycertificate', 'copy_7_12_name_image_for_occupancycertificate', 'copy_7_12_name_container_for_occupancycertificate',
                        'copy_7_12_download', 'copy_7_12', formData.copy_7_12, formData.occupancy_certificate_id, VALUE_TWENTY);
            }
            if (formData.certificate_map != '') {
                that.showDocument('certificate_map_container_for_occupancycertificate', 'certificate_map_name_image_for_occupancycertificate', 'certificate_map_name_container_for_occupancycertificate',
                        'certificate_map_download', 'certificate_map', formData.certificate_map, formData.occupancy_certificate_id, VALUE_TWENTYONE);
            }
        }
        generateSelect2();
        datePicker();
        $('#occupancycertificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitOccupancyCertificate($('#submit_btn_for_occupancyCertificate'));
            }
        });
    },
    editOrViewOccupancyCertificate: function (btnObj, occupancyCertificateId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!occupancyCertificateId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'occupancy_certificate/get_occupancycertificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'occupancy_certificate_id': occupancyCertificateId}, getTokenData()),
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
                    that.newOccupancyCertificateForm(isEdit, parseData);
                } else {
                    that.viewOccupancyCertificateForm(parseData);
                }
            }
        });
    },
    viewOccupancyCertificateForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.occupancycertificate_data;
        OccupancyCertificate.router.navigate('view_occupancycertificate_form');
        formData.occupancycertificate_data = parseData.occupancycertificate_data;
        // formData.completed_on = dateTo_DD_MM_YYYY(formData.completed_on);

        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#occupancycertificate_form_and_datatable_container').html(occupancyCertificateViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');

        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        that.getDepartmentdata(district);

        if (formData.is_fire_noc == VALUE_ONE) {
            $('#is_fire_noc_yes').attr('checked', 'checked');
            this.$('.fire_noc_div').show();
        }
        if (formData.is_existing_building_plan == VALUE_TWO) {
            $('#is_existing_building_plan_no').attr('checked', 'checked');
            this.$('.existing_building_plan_div').show();
        }
        if (formData.is_form_of_indemnity == VALUE_ONE) {
            $('#is_form_of_indemnity_yes').attr('checked', 'checked');
            this.$('.form_of_indemnity_div').show();
        }
        if (formData.is_stability_certificate == VALUE_ONE) {
            $('#is_stability_certificate_yes').attr('checked', 'checked');
            this.$('.stability_certificate_div').show();
        }
        if (formData.is_occupancy_certificate_dnh == IS_CHECKED_YES) {
            $('#is_occupancy_certificate_dnh_yes').attr('checked', 'checked');
            $('.occupancy_certificate_dnh_div').show();
        } else if (formData.is_occupancy_certificate_dnh == IS_CHECKED_NO) {
            $('#is_occupancy_certificate_dnh_no').attr('checked', 'checked');
        }

        if (formData.annexure_14 != '') {
            that.showDocument('annexure_14_container_for_occupancycertificate', 'annexure_14_name_image_for_occupancycertificate', 'annexure_14_name_container_for_occupancycertificate',
                    'annexure_14_download', 'annexure_14', formData.annexure_14);
        }
        if (formData.oc_part_oc != '') {
            that.showDocument('oc_part_oc_container_for_occupancycertificate', 'oc_part_oc_name_image_for_occupancycertificate', 'oc_part_oc_name_container_for_occupancycertificate',
                    'oc_part_oc_download', 'oc_part_oc', formData.oc_part_oc);
        }
        if (formData.copy_of_construction_permission != '') {
            that.showDocument('copy_of_construction_permission_container_for_occupancycertificate', 'copy_of_construction_permission_name_image_for_occupancycertificate', 'copy_of_construction_permission_name_container_for_occupancycertificate',
                    'copy_of_construction_permission_download', 'copy_of_construction_permission', formData.copy_of_construction_permission);
        }
        if (formData.copy_of_building_plan != '') {
            that.showDocument('copy_of_building_plan_container_for_occupancycertificate', 'copy_of_building_plan_name_image_for_occupancycertificate', 'copy_of_building_plan_name_container_for_occupancycertificate',
                    'copy_of_building_plan_download', 'copy_of_building_plan', formData.copy_of_building_plan);
        }
        if (formData.stability_certificate != '') {
            that.showDocument('stability_certificate_container_for_occupancycertificate', 'stability_certificate_name_image_for_occupancycertificate', 'stability_certificate_name_container_for_occupancycertificate',
                    'stability_certificate_download', 'stability_certificate', formData.stability_certificate);
        }
        if (formData.building_height_noc != '') {
            that.showDocument('building_height_noc_container_for_occupancycertificate', 'building_height_noc_name_image_for_occupancycertificate', 'building_height_noc_name_container_for_occupancycertificate',
                    'building_height_noc_download', 'building_height_noc', formData.building_height_noc);
        }
        if (formData.fire_noc != '') {
            that.showDocument('fire_noc_container_for_occupancycertificate', 'fire_noc_name_image_for_occupancycertificate', 'fire_noc_name_container_for_occupancycertificate',
                    'fire_noc_download', 'fire_noc', formData.fire_noc);
        }
        if (formData.copy_of_water_harvesting != '') {
            that.showDocument('copy_of_water_harvesting_container_for_occupancycertificate', 'copy_of_water_harvesting_name_image_for_occupancycertificate', 'copy_of_water_harvesting_name_container_for_occupancycertificate',
                    'copy_of_water_harvesting_download', 'copy_of_water_harvesting', formData.copy_of_water_harvesting);
        }
        if (formData.existing_building_plan != '') {
            that.showDocument('existing_building_plan_container_for_occupancycertificate', 'existing_building_plan_name_image_for_occupancycertificate', 'existing_building_plan_name_container_for_occupancycertificate',
                    'existing_building_plan_download', 'existing_building_plan', formData.existing_building_plan);
        }
        if (formData.form_of_indemnity != '') {
            that.showDocument('form_of_indemnity_container_for_occupancycertificate', 'form_of_indemnity_name_image_for_occupancycertificate', 'form_of_indemnity_name_container_for_occupancycertificate',
                    'form_of_indemnity_download', 'form_of_indemnity', formData.form_of_indemnity);
        }
        if (formData.fire_emergency != '') {
            that.showDocument('fire_emergency_container_for_occupancycertificate', 'fire_emergency_name_image_for_occupancycertificate', 'fire_emergency_name_container_for_occupancycertificate',
                    'fire_emergency_download', 'fire_emergency', formData.fire_emergency);
        }
        if (formData.building_plan != '') {
            that.showDocument('building_plan_container_for_occupancycertificate', 'building_plan_name_image_for_occupancycertificate', 'building_plan_name_container_for_occupancycertificate',
                    'building_plan_download', 'building_plan', formData.building_plan);
        }
        if (formData.stability_certificate_dnh != '') {
            that.showDocument('stability_certificate_dnh_container_for_occupancycertificate', 'stability_certificate_dnh_name_image_for_occupancycertificate', 'stability_certificate_dnh_name_container_for_occupancycertificate',
                    'stability_certificate_dnh_download', 'stability_certificate_dnh', formData.stability_certificate_dnh);
        }
        if (formData.occupancy_certificate_dnh != '') {
            that.showDocument('occupancy_certificate_dnh_container_for_occupancycertificate', 'occupancy_certificate_dnh_name_image_for_occupancycertificate', 'occupancy_certificate_dnh_name_container_for_occupancycertificate',
                    'occupancy_certificate_dnh_download', 'occupancy_certificate_dnh', formData.occupancy_certificate_dnh);
        }
        if (formData.existing_cp != '') {
            that.showDocument('existing_cp_container_for_occupancycertificate', 'existing_cp_name_image_for_occupancycertificate', 'existing_cp_name_container_for_occupancycertificate',
                    'existing_cp_download', 'existing_cp', formData.existing_cp);
        }
        if (formData.labour_cess_certificate != '') {
            that.showDocument('labour_cess_certificate_container_for_occupancycertificate', 'labour_cess_certificate_name_image_for_occupancycertificate', 'labour_cess_certificate_name_container_for_occupancycertificate',
                    'labour_cess_certificate_download', 'labour_cess_certificate', formData.labour_cess_certificate);
        }
        if (formData.valuation_certificate != '') {
            that.showDocument('valuation_certificate_container_for_occupancycertificate', 'valuation_certificate_name_image_for_occupancycertificate', 'valuation_certificate_name_container_for_occupancycertificate',
                    'valuation_certificate_download', 'valuation_certificate', formData.valuation_certificate);
        }
        if (formData.bank_deposit_sleep != '') {
            that.showDocument('bank_deposit_sleep_container_for_occupancycertificate', 'bank_deposit_sleep_name_image_for_occupancycertificate', 'bank_deposit_sleep_name_container_for_occupancycertificate',
                    'bank_deposit_sleep_download', 'bank_deposit_sleep', formData.bank_deposit_sleep);
        }
        if (formData.deviation_photographs != '') {
            that.showDocument('deviation_photographs_container_for_occupancycertificate', 'deviation_photographs_name_image_for_occupancycertificate', 'deviation_photographs_name_container_for_occupancycertificate',
                    'deviation_photographs_download', 'deviation_photographs', formData.deviation_photographs);
        }
        if (formData.copy_7_12 != '') {
            that.showDocument('copy_7_12_container_for_occupancycertificate', 'copy_7_12_name_image_for_occupancycertificate', 'copy_7_12_name_container_for_occupancycertificate',
                    'copy_7_12_download', 'copy_7_12', formData.copy_7_12);
        }
        if (formData.certificate_map != '') {
            that.showDocument('certificate_map_container_for_occupancycertificate', 'certificate_map_name_image_for_occupancycertificate', 'certificate_map_name_container_for_occupancycertificate',
                    'certificate_map_download', 'certificate_map', formData.certificate_map);
        }

    },
    checkValidationForOccupancyCertificate: function (occupancyCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!occupancyCertificateData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!occupancyCertificateData.situated_at) {
            return getBasicMessageAndFieldJSONArray('situated_at', situatedAtValidationMessage);
        }
        if (!occupancyCertificateData.license_no) {
            return getBasicMessageAndFieldJSONArray('license_no', licenseNoValidationMessage);
        }
        if (!occupancyCertificateData.occupancy_registration_no) {
            return getBasicMessageAndFieldJSONArray('occupancy_registration_no', occupancyRegistrationNoValidationMessage);
        }
        if (!occupancyCertificateData.address) {
            return getBasicMessageAndFieldJSONArray('address', occupancyAddressValidationMessage);
        }

        // var annexureV = $('input[name=is_occupancy_certificate_dnh]:checked').val();
        // if (annexureV == '' || annexureV == null) {
        //     $('#is_occupancy_certificate_dnh').focus();
        //     return getBasicMessageAndFieldJSONArray('is_occupancy_certificate_dnh', uploadValidationMessage);
        // }

        return '';
    },
    askForSubmitOccupancyCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'OccupancyCertificate.listview.submitOccupancyCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitOccupancyCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var occupancyCertificateData = $('#occupancycertificate_form').serializeFormJSON();
        var validationData = that.checkValidationForOccupancyCertificate(occupancyCertificateData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('occupancycertificate-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#annexure_14_container_for_occupancycertificate').is(':visible')) {
            var annexure14 = checkValidationForDocument('annexure_14_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (annexure14 == false) {
                return false;
            }
        }

        if ($('#oc_part_oc_container_for_occupancycertificate').is(':visible')) {
            var ocpartOC = checkValidationForDocument('oc_part_oc_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (ocpartOC == false) {
                return false;
            }
        }
        if ($('#copy_of_construction_permission_container_for_occupancycertificate').is(':visible')) {
            var copyofConstruction = checkValidationForDocument('copy_of_construction_permission_for_occupancycertificate', VALUE_ONE, 'occupancycertificate', 5120);
            if (copyofConstruction == false) {
                return false;
            }
        }

        if ($('#copy_of_building_plan_container_for_occupancycertificate').is(':visible')) {
            var copyofBuildingplan = checkValidationForDocument('copy_of_building_plan_for_occupancycertificate', VALUE_ONE, 'occupancycertificate', 25600);
            if (copyofBuildingplan == false) {
                return false;
            }
        }
        if ($('#stability_certificate_container_for_occupancycertificate').is(':visible')) {
            var stabilityCertificate = checkValidationForDocument('stability_certificate_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (stabilityCertificate == false) {
                return false;
            }
        }
        if ($('#building_height_noc_container_for_occupancycertificate').is(':visible')) {
            var buildingHeight = checkValidationForDocument('building_height_noc_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (buildingHeight == false) {
                return false;
            }
        }
        if ($('#fire_noc_container_for_occupancycertificate').is(':visible')) {
            var fireNoc = checkValidationForDocument('fire_noc_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (fireNoc == false) {
                return false;
            }
        }

        if ($('#copy_of_water_harvesting_container_for_occupancycertificate').is(':visible')) {
            var stabilityCertificate = checkValidationForDocument('copy_of_water_harvesting_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (stabilityCertificate == false) {
                return false;
            }
        }
        if ($('#existing_building_plan_container_for_occupancycertificate').is(':visible')) {
            var existingBuildingplan = checkValidationForDocument('existing_building_plan_for_occupancycertificate', VALUE_ONE, 'occupancycertificate', 25600);
            if (existingBuildingplan == false) {
                return false;
            }
        }
        if ($('#fire_emergency_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('fire_emergency_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#building_plan_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('building_plan_for_occupancycertificate', VALUE_ONE, 'occupancycertificate', 25600);
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#stability_certificate_dnh_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('stability_certificate_dnh_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#occupancy_certificate_dnh_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('occupancy_certificate_dnh_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#existing_cp_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('existing_cp_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#labour_cess_certificate_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('labour_cess_certificate_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#valuation_certificate_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('valuation_certificate_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#bank_deposit_sleep_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('bank_deposit_sleep_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#deviation_photographs_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('deviation_photographs_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#copy_7_12_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('copy_7_12_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#certificate_map_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('certificate_map_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#form_of_indemnity_container_for_occupancycertificate').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('form_of_indemnity_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (provisionalNoc == false) {
                return false;
            }
        }


        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_occupancycertificate') : $('#submit_btn_for_occupancycertificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var occupancyCertificateData = new FormData($('#occupancycertificate_form')[0]);
        occupancyCertificateData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        occupancyCertificateData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'occupancy_certificate/submit_occupancycertificate',
            data: occupancyCertificateData,
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
                validationMessageShow('occupancycertificate', textStatus.statusText);
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
                    validationMessageShow('occupancycertificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                OccupancyCertificate.router.navigate('occupancycertificate', {'trigger': true});
            }
        });
    },

    askForRemove: function (occupancyCertificateId, docId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!occupancyCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'OccupancyCertificate.listview.removeDocument(\'' + occupancyCertificateId + '\',\'' + docId + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (occupancycertificateId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!occupancycertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_occupancycertificate_' + docType).hide();
        $('.spinner_name_container_for_occupancycertificate_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'occupancy_certificate/remove_document',
            data: $.extend({}, {'occupancy_certificate_id': occupancycertificateId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_occupancycertificate_' + docType).hide();
                $('.spinner_name_container_for_occupancycertificate_' + docType).show();
                validationMessageShow('occupancycertificate', textStatus.statusText);
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
                    validationMessageShow('occupancycertificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_occupancycertificate_' + docType).show();
                $('.spinner_name_container_for_occupancycertificate_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('annexure_14_name_container_for_occupancycertificate', 'annexure_14_name_image_for_occupancycertificate', 'annexure_14_container_for_occupancycertificate', 'annexure_14_for_occupancycertificate');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('oc_part_oc_name_container_for_occupancycertificate', 'oc_part_oc_name_image_for_occupancycertificate', 'oc_part_oc_container_for_occupancycertificate', 'oc_part_oc_for_occupancycertificate');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('copy_of_construction_permission_name_container_for_occupancycertificate', 'copy_of_construction_permission_name_image_for_occupancycertificate', 'copy_of_construction_permission_container_for_occupancycertificate', 'copy_of_construction_permission_for_occupancycertificate');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('copy_of_building_plan_name_container_for_occupancycertificate', 'copy_of_building_plan_name_image_for_occupancycertificate', 'copy_of_building_plan_container_for_occupancycertificate', 'copy_of_building_plan_for_occupancycertificate');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('stability_certificate_name_container_for_occupancycertificate', 'stability_certificate_name_image_for_occupancycertificate', 'stability_certificate_container_for_occupancycertificate', 'stability_certificate_for_occupancycertificate');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('building_height_noc_name_container_for_occupancycertificate', 'building_height_noc_name_image_for_occupancycertificate', 'building_height_noc_container_for_occupancycertificate', 'building_height_noc_for_occupancycertificate');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('fire_noc_name_container_for_occupancycertificate', 'cost_estimat_name_image_for_occupancycertificate', 'fire_noc_container_for_occupancycertificate', 'fire_noc_for_occupancycertificate');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('copy_of_water_harvesting_name_container_for_occupancycertificate', 'copy_of_water_harvesting_name_image_for_occupancycertificate', 'copy_of_water_harvesting_container_for_occupancycertificate', 'copy_of_water_harvesting_for_occupancycertificate');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('existing_building_plan_name_container_for_occupancycertificate', 'existing_building_plan_name_image_for_occupancycertificate', 'existing_building_plan_container_for_occupancycertificate', 'existing_building_plan_for_occupancycertificate');
                }
                if (docType == VALUE_TEN) {
                    removeDocumentValue('form_of_indemnity_name_container_for_occupancycertificate', 'form_of_indemnity_name_image_for_occupancycertificate', 'form_of_indemnity_container_for_occupancycertificate', 'form_of_indemnity_for_occupancycertificate');
                }
                if (docType == VALUE_ELEVEN) {
                    removeDocumentValue('fire_emergency_name_container_for_occupancycertificate', 'fire_emergency_name_image_for_occupancycertificate', 'fire_emergency_container_for_occupancycertificate', 'fire_emergency_for_occupancycertificate');
                }
                if (docType == VALUE_TWELVE) {
                    removeDocumentValue('building_plan_name_container_for_occupancycertificate', 'building_plan_name_image_for_occupancycertificate', 'building_plan_container_for_occupancycertificate', 'building_plan_for_occupancycertificate');
                }
                if (docType == VALUE_THIRTEEN) {
                    removeDocumentValue('stability_certificate_dnh_name_container_for_occupancycertificate', 'stability_certificate_dnh_name_image_for_occupancycertificate', 'stability_certificate_dnh_container_for_occupancycertificate', 'stability_certificate_dnh_for_occupancycertificate');
                }
                if (docType == VALUE_FOURTEEN) {
                    removeDocumentValue('occupancy_certificate_dnh_name_container_for_occupancycertificate', 'occupancy_certificate_dnh_name_image_for_occupancycertificate', 'occupancy_certificate_dnh_container_for_occupancycertificate', 'occupancy_certificate_dnh_for_occupancycertificate');
                }
                if (docType == VALUE_FIFTEEN) {
                    removeDocumentValue('existing_cp_name_container_for_occupancycertificate', 'existing_cp_name_image_for_occupancycertificate', 'existing_cp_container_for_occupancycertificate', 'existing_cp_for_occupancycertificate');
                }
                if (docType == VALUE_SIXTEEN) {
                    removeDocumentValue('labour_cess_certificate_name_container_for_occupancycertificate', 'labour_cess_certificate_name_image_for_occupancycertificate', 'labour_cess_certificate_container_for_occupancycertificate', 'labour_cess_certificate_for_occupancycertificate');
                }
                if (docType == VALUE_SEVENTEEN) {
                    removeDocumentValue('valuation_certificate_name_container_for_occupancycertificate', 'valuation_certificate_name_image_for_occupancycertificate', 'valuation_certificate_container_for_occupancycertificate', 'valuation_certificate_for_occupancycertificate');
                }
                if (docType == VALUE_EIGHTEEN) {
                    removeDocumentValue('bank_deposit_sleep_name_container_for_occupancycertificate', 'bank_deposit_sleep_name_image_for_occupancycertificate', 'bank_deposit_sleep_container_for_occupancycertificate', 'bank_deposit_sleep_for_occupancycertificate');
                }
                if (docType == VALUE_NINETEEN) {
                    removeDocumentValue('deviation_photographs_name_container_for_occupancycertificate', 'deviation_photographs_name_image_for_occupancycertificate', 'deviation_photographs_container_for_occupancycertificate', 'deviation_photographs_for_occupancycertificate');
                }
                if (docType == VALUE_TWENTY) {
                    removeDocumentValue('copy_7_12_name_container_for_occupancycertificate', 'copy_7_12_name_image_for_occupancycertificate', 'copy_7_12_container_for_occupancycertificate', 'copy_7_12_for_occupancycertificate');
                }
                if (docType == VALUE_TWENTYONE) {
                    removeDocumentValue('certificate_map_name_container_for_occupancycertificate', 'certificate_map_name_image_for_occupancycertificate', 'certificate_map_container_for_occupancycertificate', 'certificate_map_for_occupancycertificate');
                }
            }
        });
    },
    generateForm1: function (occupancyCertificateId) {
        if (!occupancyCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#occupancycertificate_id_for_occupancycertificate_form1').val(occupancyCertificateId);
        $('#occupancycertificate_form1_pdf_form').submit();
        $('#occupancycertificate_id_for_occupancycertificate_form1').val('');
    },

    downloadUploadChallan: function (occupancyCertificateId) {
        if (!occupancyCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + occupancyCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'occupancy_certificate/get_occupancycertificate_data_by_occupancycertificate_id',
            type: 'post',
            data: $.extend({}, {'occupancycertificate_id': occupancyCertificateId}, getTokenData()),
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
                var occupancyCertificateData = parseData.occupancycertificate_data;
                that.showChallan(occupancyCertificateData);
            }
        });
    },
    showChallan: function (occupancyCertificateData) {
        showPopup();
        if (occupancyCertificateData.status != VALUE_FIVE && occupancyCertificateData.status != VALUE_SIX && occupancyCertificateData.status != VALUE_SEVEN) {
            if (!occupancyCertificateData.hide_submit_btn) {
                occupancyCertificateData.show_fees_paid = true;
            }
        }
        if (occupancyCertificateData.payment_type == VALUE_ONE) {
            occupancyCertificateData.utitle = 'Fees Paid Challan Copy';
        } else {
            occupancyCertificateData.style = 'display: none;';
        }
        if (occupancyCertificateData.payment_type == VALUE_TWO) {
            occupancyCertificateData.show_dd_po_option = true;
            occupancyCertificateData.utitle = 'Demand Draft (DD)';
        }
        occupancyCertificateData.module_type = VALUE_TWENTYEIGHT;
        $('#popup_container').html(occupancyCertificateUploadChallanTemplate(occupancyCertificateData));
        loadFB(VALUE_TWENTYEIGHT, occupancyCertificateData.fb_data);
        loadPH(VALUE_TWENTYEIGHT, occupancyCertificateData.occupancy_certificate_id, occupancyCertificateData.ph_data);

        if (occupancyCertificateData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'occupancycertificate_upload_challan', occupancyCertificateData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'occupancycertificate_upload_challan', 'uc', 'radio');
            if (occupancyCertificateData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_occupancycertificate_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (occupancyCertificateData.challan != '') {
            $('#challan_container_for_occupancycertificate_upload_challan').hide();
            $('#challan_name_container_for_occupancycertificate_upload_challan').show();
            $('#challan_name_href_for_occupancycertificate_upload_challan').attr('href', 'documents/occupancy_certificate/' + occupancyCertificateData.challan);
            $('#challan_name_for_occupancycertificate_upload_challan').html(occupancyCertificateData.challan);
        }
        if (occupancyCertificateData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_occupancycertificate_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_occupancycertificate_upload_challan').show();
            $('#fees_paid_challan_name_href_for_occupancycertificate_upload_challan').attr('href', 'documents/occupancy_certificate/' + occupancyCertificateData.fees_paid_challan);
            $('#fees_paid_challan_name_for_occupancycertificate_upload_challan').html(occupancyCertificateData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_occupancycertificate_upload_challan').attr('onclick', 'OccupancyCertificate.listview.removeFeesPaidChallan("' + occupancyCertificateData.occupancy_certificate_id + '")');
        }
    },
    removeFeesPaidChallan: function (occupancyCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!occupancyCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'occupancy_certificate/remove_fees_paid_challan',
            data: $.extend({}, {'occupancy_certificate_id': occupancyCertificateId}, getTokenData()),
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
                validationMessageShow('occupancycertificate-uc', textStatus.statusText);
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
                    validationMessageShow('occupancycertificate-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-occupancycertificate-uc').html(parseData.message);
                // console.log(parseData);
                removeDocument('fees_paid_challan', 'occupancycertificate_upload_challan');
                $('#status_' + occupancyCertificateId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-occupancycertificate-uc').html('');
        validationMessageHide();
        var occupancyCertificateId = $('#occupancycertificate_id_for_occupancycertificate_upload_challan').val();
        if (!occupancyCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_occupancycertificate_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_occupancycertificate_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_occupancycertificate_upload_challan').focus();
                validationMessageShow('occupancycertificate-uc-fees_paid_challan_for_occupancycertificate_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_occupancycertificate_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_occupancycertificate_upload_challan').focus();
                validationMessageShow('occupancycertificate-uc-fees_paid_challan_for_occupancycertificate_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_occupancycertificate_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#occupancycertificate_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'occupancy_certificate/upload_fees_paid_challan',
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
                validationMessageShow('occupancycertificate-uc', textStatus.statusText);
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
                    validationMessageShow('occupancycertificate-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + occupancyCertificateId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (occupancyCertificateId) {
        if (!occupancyCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#occupancycertificate_id_for_certificate').val(occupancyCertificateId);
        $('#occupancycertificate_certificate_pdf_form').submit();
        $('#occupancycertificate_id_for_certificate').val('');
    },
    getQueryData: function (occupancyCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!occupancyCertificateId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTYEIGHT;
        templateData.module_id = occupancyCertificateId;
        var btnObj = $('#query_btn_for_wm_' + occupancyCertificateId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTYEIGHT, moduleData.occupancy_certificate_id);
                tmpData.applicant_name = moduleData.plot_no;
                tmpData.title = 'Plot No.';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForOccupancyCertificate: function (fileNo) {
        var that = this;
        if ($('#annexure_14_for_occupancycertificate').val() != '') {
            var licensedEngineer = checkValidationForDocument('annexure_14_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (licensedEngineer == false) {
                return false;
            }
        }
        if ($('#oc_part_oc_for_occupancycertificate').val() != '') {
            var ownerSignature = checkValidationForDocument('oc_part_oc_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (ownerSignature == false) {
                return false;
            }
        }
        if ($('#copy_of_construction_permission_for_occupancycertificate').val() != '') {
            var copyofConstruction = checkValidationForDocument('copy_of_construction_permission_for_occupancycertificate', VALUE_ONE, 'occupancycertificate', 5120);
            if (copyofConstruction == false) {
                return false;
            }
        }
        if ($('#copy_of_building_plan_for_occupancycertificate').val() != '') {
            var copyofBuildingplan = checkValidationForDocument('copy_of_building_plan_for_occupancycertificate', VALUE_ONE, 'occupancycertificate', 25600);
            if (copyofBuildingplan == false) {
                return false;
            }
        }
        if ($('#stability_certificate_for_occupancycertificate').val() != '') {
            var stabilityCertificate = checkValidationForDocument('stability_certificate_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (stabilityCertificate == false) {
                return false;
            }
        }
        if ($('#building_height_noc_for_occupancycertificate').val() != '') {
            var buildingHeight = checkValidationForDocument('building_height_noc_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (buildingHeight == false) {
                return false;
            }
        }
        if ($('#fire_noc_for_occupancycertificate').val() != '') {
            var fireNoc = checkValidationForDocument('fire_noc_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (fireNoc == false) {
                return false;
            }
        }
        if ($('#copy_of_water_harvesting_for_occupancycertificate').val() != '') {
            var copyofwaterHarvesting = checkValidationForDocument('copy_of_water_harvesting_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (copyofwaterHarvesting == false) {
                return false;
            }
        }
        if ($('#existing_building_plan_for_occupancycertificate').val() != '') {
            var existingBuildingplan = checkValidationForDocument('existing_building_plan_for_occupancycertificate', VALUE_ONE, 'occupancycertificate', 25600);
            if (existingBuildingplan == false) {
                return false;
            }
        }
        if ($('#form_of_indemnity_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('form_of_indemnity_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#fire_emergency_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('fire_emergency_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#building_plan_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('building_plan_for_occupancycertificate', VALUE_ONE, 'occupancycertificate', 25600);
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#stability_certificate_dnh_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('stability_certificate_dnh_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#occupancy_certificate_dnh_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('occupancy_certificate_dnh_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#existing_cp_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('existing_cp_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#labour_cess_certificate_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('labour_cess_certificate_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#valuation_certificate_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('valuation_certificate_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#bank_deposit_sleep_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('bank_deposit_sleep_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#deviation_photographs_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('deviation_photographs_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        // if ($('#copy_7_12_for_occupancycertificate').val() != '') {
        //     var formofIndemnity = checkValidationForDocument('copy_7_12_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
        //     if (formofIndemnity == false) {
        //         return false;
        //     }
        // }
        if ($('#copy_7_12_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('copy_7_12_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }
        if ($('#certificate_map_for_occupancycertificate').val() != '') {
            var formofIndemnity = checkValidationForDocument('certificate_map_for_occupancycertificate', VALUE_ONE, 'occupancycertificate');
            if (formofIndemnity == false) {
                return false;
            }
        }

        $('.spinner_container_for_occupancycertificate_' + fileNo).hide();
        $('.spinner_name_container_for_occupancycertificate_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var occupancycertificateId = $('#occupancy_certificate_id').val();
        var formData = new FormData($('#occupancycertificate_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("occupancy_certificate_id", occupancycertificateId);
        $.ajax({
            type: 'POST',
            url: 'occupancy_certificate/upload_occupancy_certificate_document',
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
                $('.spinner_container_for_occupancycertificate_' + fileNo).show();
                $('.spinner_name_container_for_occupancycertificate_' + fileNo).hide();
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
                    $('.spinner_container_for_occupancycertificate_' + fileNo).show();
                    $('.spinner_name_container_for_occupancycertificate_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_occupancycertificate_' + fileNo).hide();
                $('.spinner_name_container_for_occupancycertificate_' + fileNo).show();
                $('#occupancy_certificate_id').val(parseData.occupancy_certificate_id);
                var occupancycertificateData = parseData.occupancycertificate_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('annexure_14_container_for_occupancycertificate', 'annexure_14_name_image_for_occupancycertificate', 'annexure_14_name_container_for_occupancycertificate',
                            'annexure_14_download', 'annexure_14', occupancycertificateData.annexure_14, parseData.occupancy_certificate_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('oc_part_oc_container_for_occupancycertificate', 'oc_part_oc_name_image_for_occupancycertificate', 'oc_part_oc_name_container_for_occupancycertificate',
                            'oc_part_oc_download', 'oc_part_oc', occupancycertificateData.oc_part_oc, parseData.occupancy_certificate_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('copy_of_construction_permission_container_for_occupancycertificate', 'copy_of_construction_permission_name_image_for_occupancycertificate', 'copy_of_construction_permission_name_container_for_occupancycertificate',
                            'copy_of_construction_permission_download', 'copy_of_construction_permission', occupancycertificateData.copy_of_construction_permission, parseData.occupancy_certificate_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('copy_of_building_plan_container_for_occupancycertificate', 'copy_of_building_plan_name_image_for_occupancycertificate', 'copy_of_building_plan_name_container_for_occupancycertificate',
                            'copy_of_building_plan_download', 'copy_of_building_plan', occupancycertificateData.copy_of_building_plan, parseData.occupancy_certificate_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('stability_certificate_container_for_occupancycertificate', 'stability_certificate_name_image_for_occupancycertificate', 'stability_certificate_name_container_for_occupancycertificate',
                            'stability_certificate_download', 'stability_certificate', occupancycertificateData.stability_certificate, parseData.occupancy_certificate_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('building_height_noc_container_for_occupancycertificate', 'building_height_noc_name_image_for_occupancycertificate', 'building_height_noc_name_container_for_occupancycertificate',
                            'building_height_noc_download', 'building_height_noc', occupancycertificateData.building_height_noc, parseData.occupancy_certificate_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('fire_noc_container_for_occupancycertificate', 'fire_noc_name_image_for_occupancycertificate', 'fire_noc_name_container_for_occupancycertificate',
                            'fire_noc_download', 'fire_noc', occupancycertificateData.fire_noc, parseData.occupancy_certificate_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('copy_of_water_harvesting_container_for_occupancycertificate', 'copy_of_water_harvesting_name_image_for_occupancycertificate', 'copy_of_water_harvesting_name_container_for_occupancycertificate',
                            'copy_of_water_harvesting_download', 'copy_of_water_harvesting', occupancycertificateData.copy_of_water_harvesting, parseData.occupancy_certificate_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('existing_building_plan_container_for_occupancycertificate', 'existing_building_plan_name_image_for_occupancycertificate', 'existing_building_plan_name_container_for_occupancycertificate',
                            'existing_building_plan_download', 'existing_building_plan', occupancycertificateData.existing_building_plan, parseData.occupancy_certificate_id, VALUE_NINE);
                }
                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('form_of_indemnity_container_for_occupancycertificate', 'form_of_indemnity_name_image_for_occupancycertificate', 'form_of_indemnity_name_container_for_occupancycertificate',
                            'form_of_indemnity_download', 'form_of_indemnity', occupancycertificateData.form_of_indemnity, parseData.occupancy_certificate_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('fire_emergency_container_for_occupancycertificate', 'fire_emergency_name_image_for_occupancycertificate', 'fire_emergency_name_container_for_occupancycertificate',
                            'fire_emergency_download', 'fire_emergency', occupancycertificateData.fire_emergency, parseData.occupancy_certificate_id, VALUE_ELEVEN);
                }
                if (parseData.file_no == VALUE_TWELVE) {
                    that.showDocument('building_plan_container_for_occupancycertificate', 'building_plan_name_image_for_occupancycertificate', 'building_plan_name_container_for_occupancycertificate',
                            'building_plan_download', 'building_plan', occupancycertificateData.building_plan, parseData.occupancy_certificate_id, VALUE_TWELVE);
                }
                if (parseData.file_no == VALUE_THIRTEEN) {
                    that.showDocument('stability_certificate_dnh_container_for_occupancycertificate', 'stability_certificate_dnh_name_image_for_occupancycertificate', 'stability_certificate_dnh_name_container_for_occupancycertificate',
                            'stability_certificate_dnh_download', 'stability_certificate_dnh', occupancycertificateData.stability_certificate_dnh, parseData.occupancy_certificate_id, VALUE_THIRTEEN);
                }
                if (parseData.file_no == VALUE_FOURTEEN) {
                    that.showDocument('occupancy_certificate_dnh_container_for_occupancycertificate', 'occupancy_certificate_dnh_name_image_for_occupancycertificate', 'occupancy_certificate_dnh_name_container_for_occupancycertificate',
                            'occupancy_certificate_dnh_download', 'occupancy_certificate_dnh', occupancycertificateData.occupancy_certificate_dnh, parseData.occupancy_certificate_id, VALUE_FOURTEEN);
                }
                if (parseData.file_no == VALUE_FIFTEEN) {
                    that.showDocument('existing_cp_container_for_occupancycertificate', 'existing_cp_name_image_for_occupancycertificate', 'existing_cp_name_container_for_occupancycertificate',
                            'existing_cp_download', 'existing_cp', occupancycertificateData.existing_cp, parseData.occupancy_certificate_id, VALUE_FIFTEEN);
                }
                if (parseData.file_no == VALUE_SIXTEEN) {
                    that.showDocument('labour_cess_certificate_container_for_occupancycertificate', 'labour_cess_certificate_name_image_for_occupancycertificate', 'labour_cess_certificate_name_container_for_occupancycertificate',
                            'labour_cess_certificate_download', 'labour_cess_certificate', occupancycertificateData.labour_cess_certificate, parseData.occupancy_certificate_id, VALUE_SIXTEEN);
                }
                if (parseData.file_no == VALUE_SEVENTEEN) {
                    that.showDocument('valuation_certificate_container_for_occupancycertificate', 'valuation_certificate_name_image_for_occupancycertificate', 'valuation_certificate_name_container_for_occupancycertificate',
                            'valuation_certificate_download', 'valuation_certificate', occupancycertificateData.valuation_certificate, parseData.occupancy_certificate_id, VALUE_SEVENTEEN);
                }
                if (parseData.file_no == VALUE_EIGHTEEN) {
                    that.showDocument('bank_deposit_sleep_container_for_occupancycertificate', 'bank_deposit_sleep_name_image_for_occupancycertificate', 'bank_deposit_sleep_name_container_for_occupancycertificate',
                            'bank_deposit_sleep_download', 'bank_deposit_sleep', occupancycertificateData.bank_deposit_sleep, parseData.occupancy_certificate_id, VALUE_EIGHTEEN);
                }
                if (parseData.file_no == VALUE_NINETEEN) {
                    that.showDocument('deviation_photographs_container_for_occupancycertificate', 'deviation_photographs_name_image_for_occupancycertificate', 'deviation_photographs_name_container_for_occupancycertificate',
                            'deviation_photographs_download', 'deviation_photographs', occupancycertificateData.deviation_photographs, parseData.occupancy_certificate_id, VALUE_NINETEEN);
                }
                if (parseData.file_no == VALUE_TWENTY) {
                    that.showDocument('copy_7_12_container_for_occupancycertificate', 'copy_7_12_name_image_for_occupancycertificate', 'copy_7_12_name_container_for_occupancycertificate',
                            'copy_7_12_download', 'copy_7_12', occupancycertificateData.copy_7_12, parseData.occupancy_certificate_id, VALUE_TWENTY);
                }
                if (parseData.file_no == VALUE_TWENTYONE) {
                    that.showDocument('certificate_map_container_for_occupancycertificate', 'certificate_map_name_image_for_occupancycertificate', 'certificate_map_name_container_for_occupancycertificate',
                            'certificate_map_download', 'certificate_map', occupancycertificateData.certificate_map, parseData.occupancy_certificate_id, VALUE_TWENTYONE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/occupancycertificate/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/occupancycertificate/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'OccupancyCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
    getDepartmentdata: function (department) {
        var val = department.value;
        if (val == '') {
            return false;
            dd_for_oc_div
        }
        if (val === '1') {

            this.$('.dd_for_oc_div').show();
            this.$('.dnh_for_oc_div').hide();

            this.$('.copy_of_construction_permission_item_container_for_occupancycertificate').show();
            this.$('.copy_of_building_plan_item_container_for_occupancycertificate').show();
            this.$('.stability_certificate_item_container_for_occupancycertificate').show();
            this.$('.building_height_noc_item_container_for_occupancycertificate').show();
            this.$('.fire_noc_item_container_for_occupancycertificate').show();
            this.$('.copy_of_water_harvesting_item_container_for_occupancycertificate').show();
            this.$('.existing_building_plan_item_container_for_occupancycertificate').show();
            this.$('.form_of_indemnity_item_container_for_occupancycertificate').show();
            this.$('.annexure_14_item_container_for_occupancycertificate').hide();
            this.$('.oc_part_oc_item_container_for_occupancycertificate').hide();
            this.$('.fire_emergency_item_container_for_occupancycertificate').hide();
            this.$('.building_plan_item_container_for_occupancycertificate').hide();
            this.$('.stability_certificate_dnh_item_container_for_occupancycertificate').hide();
            this.$('.occupancy_certificate_dnh_item_container_for_occupancycertificate').hide();
            this.$('.existing_cp_item_container_for_occupancycertificate').hide();
            this.$('.labour_cess_certificate_item_container_for_occupancycertificate').hide();
            this.$('.valuation_certificate_item_container_for_occupancycertificate').hide();
            this.$('.bank_deposit_sleep_item_container_for_occupancycertificate').hide();
            this.$('.deviation_photographs_item_container_for_occupancycertificate').hide();
            this.$('.copy_7_12_item_container_for_occupancycertificate').hide();
            this.$('.certificate_map_item_container_for_occupancycertificate').hide();

        }
        if (val === '2') {

            this.$('.dd_for_oc_div').show();
            this.$('.dnh_for_oc_div').hide();

            this.$('.copy_of_construction_permission_item_container_for_occupancycertificate').show();
            this.$('.copy_of_building_plan_item_container_for_occupancycertificate').show();
            this.$('.stability_certificate_item_container_for_occupancycertificate').show();
            this.$('.building_height_noc_item_container_for_occupancycertificate').show();
            this.$('.fire_noc_item_container_for_occupancycertificate').show();
            this.$('.copy_of_water_harvesting_item_container_for_occupancycertificate').show();
            this.$('.existing_building_plan_item_container_for_occupancycertificate').show();
            this.$('.form_of_indemnity_item_container_for_occupancycertificate').show();
            this.$('.annexure_14_item_container_for_occupancycertificate').hide();
            this.$('.oc_part_oc_item_container_for_occupancycertificate').hide();
            this.$('.fire_emergency_item_container_for_occupancycertificate').hide();
            this.$('.building_plan_item_container_for_occupancycertificate').hide();
            this.$('.stability_certificate_dnh_item_container_for_occupancycertificate').hide();
            this.$('.occupancy_certificate_dnh_item_container_for_occupancycertificate').hide();
            this.$('.existing_cp_item_container_for_occupancycertificate').hide();
            this.$('.labour_cess_certificate_item_container_for_occupancycertificate').hide();
            this.$('.valuation_certificate_item_container_for_occupancycertificate').hide();
            this.$('.bank_deposit_sleep_item_container_for_occupancycertificate').hide();
            this.$('.deviation_photographs_item_container_for_occupancycertificate').hide();
            this.$('.copy_7_12_item_container_for_occupancycertificate').hide();
            this.$('.certificate_map_item_container_for_occupancycertificate').hide();


        }
        if (val === '3') {
            this.$('.dd_for_oc_div').hide();
            this.$('.dnh_for_oc_div').show();

            this.$('.copy_of_construction_permission_item_container_for_occupancycertificate').show();
            this.$('.copy_of_building_plan_item_container_for_occupancycertificate').show();
            this.$('.stability_certificate_item_container_for_occupancycertificate').hide();
            this.$('.building_height_noc_item_container_for_occupancycertificate').hide();
            this.$('.fire_noc_item_container_for_occupancycertificate').hide();
            this.$('.copy_of_water_harvesting_item_container_for_occupancycertificate').show();
            this.$('.existing_building_plan_item_container_for_occupancycertificate').hide();
            this.$('.form_of_indemnity_item_container_for_occupancycertificate').show();
            this.$('.annexure_14_item_container_for_occupancycertificate').show();
            this.$('.oc_part_oc_item_container_for_occupancycertificate').show();
            this.$('.fire_emergency_item_container_for_occupancycertificate').show();
            this.$('.building_plan_item_container_for_occupancycertificate').show();
            this.$('.stability_certificate_dnh_item_container_for_occupancycertificate').show();
            this.$('.occupancy_certificate_dnh_item_container_for_occupancycertificate').show();
            this.$('.existing_cp_item_container_for_occupancycertificate').show();
            this.$('.labour_cess_certificate_item_container_for_occupancycertificate').show();
            this.$('.valuation_certificate_item_container_for_occupancycertificate').show();
            this.$('.bank_deposit_sleep_item_container_for_occupancycertificate').show();
            this.$('.deviation_photographs_item_container_for_occupancycertificate').show();
            this.$('.copy_7_12_item_container_for_occupancycertificate').show();
            this.$('.certificate_map_item_container_for_occupancycertificate').show();


        }
    },
});
