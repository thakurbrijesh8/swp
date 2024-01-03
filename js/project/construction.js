var constructionListTemplate = Handlebars.compile($('#construction_list_template').html());
var constructionTableTemplate = Handlebars.compile($('#construction_table_template').html());
var constructionActionTemplate = Handlebars.compile($('#construction_action_template').html());
var constructionFormTemplate = Handlebars.compile($('#construction_form_template').html());
var constructionViewTemplate = Handlebars.compile($('#construction_view_template').html());
var constructionUploadChallanTemplate = Handlebars.compile($('#construction_upload_challan_template').html());
var tempPersonCnt = 1;

var Construction = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

Construction.Router = Backbone.Router.extend({
    routes: {
        'construction': 'renderList',
        'construction_form': 'renderListForForm',
        'edit_construction_form': 'renderList',
        'view_construction_form': 'renderList',
    },
    renderList: function () {
        Construction.listview.listPage();
    },
    renderListForForm: function () {
        Construction.listview.listPageConstructionForm();
    }
});
Construction.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="provisional_noc"]': 'hasProvisionalnocEvent',
        'click input[name="crz_clearance"]': 'hasCrzclearanceEvent',
        'click input[name="sub_division"]': 'hasSubdivisionEvent',
        'click input[name="amalgamation"]': 'hasAmalgamationEvent',
        'click input[name="occupancy"]': 'hasOccupancyEvent',
        'click input[name="certificate_land"]': 'hasCertificatelandEvent',
        'click input[name="annexureV"]': 'hasannexureVEvent',
        'click input[name="annexureVI"]': 'hasannexureVIEvent',
        'click input[name="layoutplan"]': 'haslayoutplanEvent',

    },

    hasProvisionalnocEvent: function (event) {
        var val = $('input[name=provisional_noc]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.provisional_noc_div').show();
        } else {
            this.$('.provisional_noc_div').hide();

        }
    },
    hasCrzclearanceEvent: function (event) {
        var val = $('input[name=crz_clearance]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.crz_clearance_div').show();
        } else {
            this.$('.crz_clearance_div').hide();

        }
    },
    hasSubdivisionEvent: function (event) {
        var val = $('input[name=sub_division]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.sub_division_div').show();
        } else {
            this.$('.sub_division_div').hide();

        }
    },
    hasAmalgamationEvent: function (event) {
        var val = $('input[name=amalgamation]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.amalgamation_div').show();
        } else {
            this.$('.amalgamation_div').hide();

        }
    },
    hasOccupancyEvent: function (event) {
        var val = $('input[name=occupancy]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.occupancy_div').show();
        } else {
            this.$('.occupancy_div').hide();

        }
    },
    hasCertificatelandEvent: function (event) {
        var val = $('input[name=certificate_land]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.certificate_land_div').show();
        } else {
            this.$('.certificate_land_div').hide();

        }
    },
    hasannexureVEvent: function (event) {
        var val = $('input[name=annexureV]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.annexureV_div').show();
        } else {
            this.$('.annexureV_div').hide();

        }
    },
    hasannexureVIEvent: function (event) {
        var val = $('input[name=annexureVI]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.annexureVI_div').show();
        } else {
            this.$('.annexureVI_div').hide();

        }
    },
    haslayoutplanEvent: function (event) {
        var val = $('input[name=layoutplan]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.layoutplan_div').show();
        } else {
            this.$('.layoutplan_div').hide();

        }
    },

    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        // activeLink('menu_dic_dnh');
        addClass('construction', 'active');
        Construction.router.navigate('construction');
        var templateData = {};
        this.$el.html(constructionListTemplate(templateData));
        this.loadConstructionData(sDistrict, sStatus);

    },
    listPageConstructionForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        // addClass('construction', 'active');
        this.$el.html(constructionListTemplate);
        this.newConstructionForm(false, {});
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
                rowData.ADMIN_CONSTRUCTION_DOC_PATH = ADMIN_CONSTRUCTION_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return constructionActionTemplate(rowData);
    },
    loadConstructionData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTYSIX, data);
        };
        var that = this;
        Construction.router.navigate('construction');
        $('#construction_form_and_datatable_container').html(constructionTableTemplate(searchData));
        constructionDataTable = $('#construction_datatable').DataTable({
            ajax: {url: 'construction/get_construction_data', dataSrc: "construction_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'construction_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_owner', 'class': 'text-center'},
                {data: 'address_of_owner', 'class': 'text-center'},
                {data: 'name', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'construction_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'construction_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#construction_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = constructionDataTable.row(tr);

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
    newConstructionForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.construction_data;
            Construction.router.navigate('edit_construction_form');
        } else {
            var formData = {};
            Construction.router.navigate('construction_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.construction_data = parseData.construction_data;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;

        if (isEdit) {
            templateData.application_date = dateTo_DD_MM_YYYY(templateData.construction_data.application_date);
            templateData.valid_upto_date = dateTo_DD_MM_YYYY(formData.valid_upto_date);
        } else {
            templateData.application_date = dateTo_DD_MM_YYYY();
        }

        $('#construction_form_and_datatable_container').html(constructionFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');

        if (isEdit) {

            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            that.getDepartmentdata(district);

            if (formData.provisional_noc == IS_CHECKED_YES) {
                $('#provisional_noc_yes').attr('checked', 'checked');
                $('.provisional_noc_div').show();
            } else if (formData.provisional_noc == IS_CHECKED_NO) {
                $('#provisional_noc_no').attr('checked', 'checked');
            }
            if (formData.crz_clearance == IS_CHECKED_YES) {
                $('#crz_clearance_yes').attr('checked', 'checked');
                $('.crz_clearance_div').show();
            } else if (formData.crz_clearance == IS_CHECKED_NO) {
                $('#crz_clearance_no').attr('checked', 'checked');
            }
            if (formData.sub_division == IS_CHECKED_YES) {
                $('#sub_division_yes').attr('checked', 'checked');
                $('.sub_division_div').show();
            } else if (formData.sub_division == IS_CHECKED_NO) {
                $('#sub_division_no').attr('checked', 'checked');
            }
            if (formData.amalgamation == IS_CHECKED_YES) {
                $('#amalgamation_yes').attr('checked', 'checked');
                $('.amalgamation_div').show();
            } else if (formData.amalgamation == IS_CHECKED_NO) {
                $('#amalgamation_no').attr('checked', 'checked');
            }
            if (formData.occupancy == IS_CHECKED_YES) {
                $('#occupancy_yes').attr('checked', 'checked');
                $('.occupancy_div').show();
            } else if (formData.occupancy == IS_CHECKED_NO) {
                $('#occupancy_no').attr('checked', 'checked');
            }
            if (formData.certificate_land == IS_CHECKED_YES) {
                $('#certificate_land_yes').attr('checked', 'checked');
                $('.certificate_land_div').show();
            } else if (formData.certificate_land == IS_CHECKED_NO) {
                $('#certificate_land_no').attr('checked', 'checked');
            }
            if (formData.annexureV == IS_CHECKED_YES) {
                $('#annexureV_yes').attr('checked', 'checked');
                $('.annexureV_div').show();
            } else if (formData.annexureV == IS_CHECKED_NO) {
                $('#annexureV_no').attr('checked', 'checked');
            }
            if (formData.annexureVI == IS_CHECKED_YES) {
                $('#annexureVI_yes').attr('checked', 'checked');
                $('.annexureVI_div').show();
            } else if (formData.annexureVI == IS_CHECKED_NO) {
                $('#annexureVI_no').attr('checked', 'checked');
            }
            if (formData.layoutplan == IS_CHECKED_YES) {
                $('#layoutplan_yes').attr('checked', 'checked');
                $('.layoutplan_div').show();
            } else if (formData.layoutplan == IS_CHECKED_NO) {
                $('#layoutplan_no').attr('checked', 'checked');
            }

            if (formData.annexure_III != '') {
                that.showDocument('annexure_III_container_for_construction', 'annexure_III_name_image_for_construction', 'annexure_III_name_container_for_construction',
                        'annexure_III_download', 'annexure_III', formData.annexure_III, formData.construction_id, VALUE_ONE);
            }
            if (formData.annexure_IV != '') {
                that.showDocument('annexure_IV_container_for_construction', 'annexure_IV_name_image_for_construction', 'annexure_IV_name_container_for_construction',
                        'annexure_IV_download', 'annexure_IV', formData.annexure_IV, formData.construction_id, VALUE_TWO);
            }
            if (formData.copy_of_na != '') {
                that.showDocument('copy_of_na_container_for_construction', 'copy_of_na_name_image_for_construction', 'copy_of_na_name_container_for_construction',
                        'copy_of_na_download', 'copy_of_na', formData.copy_of_na, formData.construction_id, VALUE_THREE);
            }
            if (formData.original_certified_map != '') {
                that.showDocument('original_certified_map_container_for_construction', 'original_certified_map_name_image_for_construction', 'original_certified_map_name_container_for_construction',
                        'original_certified_map_download', 'original_certified_map', formData.original_certified_map, formData.construction_id, VALUE_FOUR);
            }
            if (formData.I_and_XIV_nakal != '') {
                that.showDocument('I_and_XIV_nakal_container_for_construction', 'I_and_XIV_nakal_name_image_for_construction', 'I_and_XIV_nakal_name_container_for_construction',
                        'I_and_XIV_nakal_download', 'I_and_XIV_nakal', formData.I_and_XIV_nakal, formData.construction_id, VALUE_FIVE);
            }
            if (formData.building_plan_dcr != '') {
                that.showDocument('building_plan_dcr_container_for_construction', 'building_plan_dcr_name_image_for_construction', 'building_plan_dcr_name_container_for_construction',
                        'building_plan_dcr_download', 'building_plan_dcr', formData.building_plan_dcr, formData.construction_id, VALUE_SIX);
            }
            if (formData.cost_estimate != '') {
                that.showDocument('cost_estimate_container_for_construction', 'cost_estimate_name_image_for_construction', 'cost_estimate_name_container_for_construction',
                        'cost_estimate_download', 'cost_estimate', formData.cost_estimate, formData.construction_id, VALUE_SEVEN);
            }
            if (formData.noc_coast_guard != '') {
                that.showDocument('noc_coast_guard_container_for_construction', 'noc_coast_guard_name_image_for_construction', 'noc_coast_guard_name_container_for_construction',
                        'noc_coast_guard_download', 'noc_coast_guard', formData.noc_coast_guard, formData.construction_id, VALUE_EIGHT);
            }
            if (formData.annexure_V != '') {
                that.showDocument('annexure_V_container_for_construction', 'annexure_V_name_image_for_construction', 'annexure_V_name_container_for_construction',
                        'annexure_V_download', 'annexure_V', formData.annexure_V, formData.construction_id, VALUE_NINE);
            }
            if (formData.provisional_noc_fire != '') {
                that.showDocument('provisional_noc_fire_container_for_construction', 'provisional_noc_fire_name_image_for_construction', 'provisional_noc_fire_name_container_for_construction',
                        'provisional_noc_fire_download', 'provisional_noc_fire', formData.provisional_noc_fire, formData.construction_id, VALUE_TEN);
            }
            if (formData.crz_clearance_certificate != '') {
                that.showDocument('crz_clearance_certificate_container_for_construction', 'crz_clearance_certificate_name_image_for_construction', 'crz_clearance_certificate_name_container_for_construction',
                        'crz_clearance_certificate_download', 'crz_clearance_certificate', formData.crz_clearance_certificate, formData.construction_id, VALUE_ELEVEN);
            }
            if (formData.sub_division_order != '') {
                that.showDocument('sub_division_order_container_for_construction', 'sub_division_order_name_image_for_construction', 'sub_division_order_name_container_for_construction',
                        'sub_division_order_download', 'sub_division_order', formData.sub_division_order, formData.construction_id, VALUE_TWELVE);
            }
            if (formData.amalgamation_order != '') {
                that.showDocument('amalgamation_order_container_for_construction', 'amalgamation_order_name_image_for_construction', 'amalgamation_order_name_container_for_construction',
                        'amalgamation_order_download', 'amalgamation_order', formData.amalgamation_order, formData.construction_id, VALUE_THIRTEEN);
            }
            if (formData.occupancy_certificate != '') {
                that.showDocument('occupancy_certificate_container_for_construction', 'occupancy_certificate_name_image_for_construction', 'occupancy_certificate_name_container_for_construction',
                        'occupancy_certificate_download', 'occupancy_certificate', formData.occupancy_certificate, formData.construction_id, VALUE_FOURTEEN);
            }
            if (formData.certificate_land_acquisition != '') {
                that.showDocument('certificate_land_acquisition_container_for_construction', 'certificate_land_acquisition_name_image_for_construction', 'certificate_land_acquisition_name_container_for_construction',
                        'certificate_land_acquisition_download', 'certificate_land_acquisition', formData.certificate_land_acquisition, formData.construction_id, VALUE_FIFTEEN);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_construction', 'seal_and_stamp_name_image_for_construction', 'seal_and_stamp_name_container_for_construction',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.construction_id, VALUE_SIXTEEN);
            }
            if (formData.annexure_VI != '') {
                that.showDocument('annexure_VI_container_for_construction', 'annexure_VI_name_image_for_construction', 'annexure_VI_name_container_for_construction',
                        'annexure_VI_download', 'annexure_VI', formData.annexure_VI, formData.construction_id, VALUE_SEVENTEEN);
            }
            if (formData.layout_plan != '') {
                that.showDocument('layout_plan_container_for_construction', 'layout_plan_name_image_for_construction', 'layout_plan_name_container_for_construction',
                        'layout_plan_download', 'layout_plan', formData.layout_plan, formData.construction_id, VALUE_EIGHTEEN);
            }
            if (formData.licensed_engineer_signature != '') {
                that.showDocument('licensed_engineer_signature_container_for_construction', 'licensed_engineer_signature_name_image_for_construction', 'licensed_engineer_signature_name_container_for_construction',
                        'licensed_engineer_signature_download', 'licensed_engineer_signature', formData.licensed_engineer_signature, formData.construction_id, VALUE_NINETEEN);
            }
            if (formData.labour_cess != '') {
                that.showDocument('labour_cess_container_for_construction', 'labour_cess_name_image_for_construction', 'labour_cess_name_container_for_construction',
                        'labour_cess_download', 'labour_cess', formData.labour_cess, formData.construction_id, VALUE_TWENTY);
            }
            if (formData.undertaking != '') {
                that.showDocument('undertaking_container_for_construction', 'undertaking_name_image_for_construction', 'undertaking_name_container_for_construction',
                        'undertaking_download', 'undertaking', formData.undertaking, formData.construction_id, VALUE_TWENTYONE);
            }
            if (formData.fire_noc != '') {
                that.showDocument('fire_noc_container_for_construction', 'fire_noc_name_image_for_construction', 'fire_noc_name_container_for_construction',
                        'fire_noc_download', 'fire_noc', formData.fire_noc, formData.construction_id, VALUE_TWENTYTWO);
            }
            if (formData.owner_signature != '') {
                that.showDocument('owner_signature_container_for_construction', 'owner_signature_name_image_for_construction', 'owner_signature_name_container_for_construction',
                        'owner_signature_download', 'owner_signature', formData.owner_signature, formData.construction_id, VALUE_TWENTYTHREE);
            }

        }
        generateSelect2();
        datePicker();
        $('#construction_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitConstruction($('#submit_btn_for_construction'));
            }
        });
    },
    editOrViewConstruction: function (btnObj, constructionId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!constructionId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'construction/get_construction_data_by_id',
            type: 'post',
            data: $.extend({}, {'construction_id': constructionId}, getTokenData()),
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
                    that.newConstructionForm(isEdit, parseData);
                } else {
                    that.viewConstructionForm(parseData);
                }
            }
        });
    },
    viewConstructionForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.construction_data;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        Construction.router.navigate('view_construction_form');
        formData.application_date = dateTo_DD_MM_YYYY(formData.application_date);

        $('#construction_form_and_datatable_container').html(constructionViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');

        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        that.getDepartmentdata(district);

        if (formData.provisional_noc == IS_CHECKED_YES) {
            $('#provisional_noc_yes').attr('checked', 'checked');
            $('.provisional_noc_div').show();
        } else if (formData.provisional_noc == IS_CHECKED_NO) {
            $('#provisional_noc_no').attr('checked', 'checked');
        }
        if (formData.crz_clearance == IS_CHECKED_YES) {
            $('#crz_clearance_yes').attr('checked', 'checked');
            $('.crz_clearance_div').show();
        } else if (formData.crz_clearance == IS_CHECKED_NO) {
            $('#crz_clearance_no').attr('checked', 'checked');
        }
        if (formData.sub_division == IS_CHECKED_YES) {
            $('#sub_division_yes').attr('checked', 'checked');
            $('.sub_division_div').show();
        } else if (formData.sub_division == IS_CHECKED_NO) {
            $('#sub_division_no').attr('checked', 'checked');
        }
        if (formData.amalgamation == IS_CHECKED_YES) {
            $('#amalgamation_yes').attr('checked', 'checked');
            $('.amalgamation_div').show();
        } else if (formData.amalgamation == IS_CHECKED_NO) {
            $('#amalgamation_no').attr('checked', 'checked');
        }
        if (formData.occupancy == IS_CHECKED_YES) {
            $('#occupancy_yes').attr('checked', 'checked');
            $('.occupancy_div').show();
        } else if (formData.occupancy == IS_CHECKED_NO) {
            $('#occupancy_no').attr('checked', 'checked');
        }
        if (formData.certificate_land == IS_CHECKED_YES) {
            $('#certificate_land_yes').attr('checked', 'checked');
            $('.certificate_land_div').show();
        } else if (formData.certificate_land == IS_CHECKED_NO) {
            $('#certificate_land_no').attr('checked', 'checked');
        }

        if (formData.annexureV == IS_CHECKED_YES) {
            $('#annexureV_yes').attr('checked', 'checked');
            $('.annexureV_div').show();
        } else if (formData.annexureV == IS_CHECKED_NO) {
            $('#annexureV_no').attr('checked', 'checked');
        }

        if (formData.annexureVI == IS_CHECKED_YES) {
            $('#annexureVI_yes').attr('checked', 'checked');
            $('.annexureVI_div').show();
        } else if (formData.annexureVI == IS_CHECKED_NO) {
            $('#annexureVI_no').attr('checked', 'checked');
        }
        if (formData.layoutplan == IS_CHECKED_YES) {
            $('#layoutplan_yes').attr('checked', 'checked');
            $('.layoutplan_div').show();
        } else if (formData.layoutplan == IS_CHECKED_NO) {
            $('#layoutplan_no').attr('checked', 'checked');
        }



        if (formData.annexure_III != '') {
            that.showDocument('annexure_III_container_for_construction', 'annexure_III_name_image_for_construction', 'annexure_III_name_container_for_construction',
                    'annexure_III_download', 'annexure_III', formData.annexure_III);
        }
        if (formData.annexure_IV != '') {
            that.showDocument('annexure_IV_container_for_construction', 'annexure_IV_name_image_for_construction', 'annexure_IV_name_container_for_construction',
                    'annexure_IV_download', 'annexure_IV', formData.annexure_IV);
        }
        if (formData.copy_of_na != '') {
            that.showDocument('copy_of_na_container_for_construction', 'copy_of_na_name_image_for_construction', 'copy_of_na_name_container_for_construction',
                    'copy_of_na_download', 'copy_of_na', formData.copy_of_na);
        }
        if (formData.original_certified_map != '') {
            that.showDocument('original_certified_map_container_for_construction', 'original_certified_map_name_image_for_construction', 'original_certified_map_name_container_for_construction',
                    'original_certified_map_download', 'original_certified_map', formData.original_certified_map);
        }
        if (formData.I_and_XIV_nakal != '') {
            that.showDocument('I_and_XIV_nakal_container_for_construction', 'I_and_XIV_nakal_name_image_for_construction', 'I_and_XIV_nakal_name_container_for_construction',
                    'I_and_XIV_nakal_download', 'I_and_XIV_nakal', formData.I_and_XIV_nakal);
        }
        if (formData.building_plan_dcr != '') {
            that.showDocument('building_plan_dcr_container_for_construction', 'building_plan_dcr_name_image_for_construction', 'building_plan_dcr_name_container_for_construction',
                    'building_plan_dcr_download', 'building_plan_dcr', formData.building_plan_dcr);
        }
        if (formData.cost_estimate != '') {
            that.showDocument('cost_estimate_container_for_construction', 'cost_estimate_name_image_for_construction', 'cost_estimate_name_container_for_construction',
                    'cost_estimate_download', 'cost_estimate', formData.cost_estimate);
        }
        if (formData.noc_coast_guard != '') {
            that.showDocument('noc_coast_guard_container_for_construction', 'noc_coast_guard_name_image_for_construction', 'noc_coast_guard_name_container_for_construction',
                    'noc_coast_guard_download', 'noc_coast_guard', formData.noc_coast_guard);
        }
        if (formData.annexure_V != '') {
            that.showDocument('annexure_V_container_for_construction', 'annexure_V_name_image_for_construction', 'annexure_V_name_container_for_construction',
                    'annexure_V_download', 'annexure_V', formData.annexure_V);
        }
        if (formData.provisional_noc_fire != '') {
            that.showDocument('provisional_noc_fire_container_for_construction', 'provisional_noc_fire_name_image_for_construction', 'provisional_noc_fire_name_container_for_construction',
                    'provisional_noc_fire_download', 'provisional_noc_fire', formData.provisional_noc_fire);
        }
        if (formData.crz_clearance_certificate != '') {
            that.showDocument('crz_clearance_certificate_container_for_construction', 'crz_clearance_certificate_name_image_for_construction', 'crz_clearance_certificate_name_container_for_construction',
                    'crz_clearance_certificate_download', 'crz_clearance_certificate', formData.crz_clearance_certificate);
        }
        if (formData.sub_division_order != '') {
            that.showDocument('sub_division_order_container_for_construction', 'sub_division_order_name_image_for_construction', 'sub_division_order_name_container_for_construction',
                    'sub_division_order_download', 'sub_division_order', formData.sub_division_order);
        }
        if (formData.amalgamation_order != '') {
            that.showDocument('amalgamation_order_container_for_construction', 'amalgamation_order_name_image_for_construction', 'amalgamation_order_name_container_for_construction',
                    'amalgamation_order_download', 'amalgamation_order', formData.amalgamation_order);
        }
        if (formData.occupancy_certificate != '') {
            that.showDocument('occupancy_certificate_container_for_construction', 'occupancy_certificate_name_image_for_construction', 'occupancy_certificate_name_container_for_construction',
                    'occupancy_certificate_download', 'occupancy_certificate', formData.occupancy_certificate);
        }
        if (formData.certificate_land_acquisition != '') {
            that.showDocument('certificate_land_acquisition_container_for_construction', 'certificate_land_acquisition_name_image_for_construction', 'certificate_land_acquisition_name_container_for_construction',
                    'certificate_land_acquisition_download', 'certificate_land_acquisition', formData.certificate_land_acquisition);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_construction', 'seal_and_stamp_name_image_for_construction', 'seal_and_stamp_name_container_for_construction',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }
        if (formData.annexure_VI != '') {
            that.showDocument('annexure_VI_container_for_construction', 'annexure_VI_name_image_for_construction', 'annexure_VI_name_container_for_construction',
                    'annexure_VI_download', 'annexure_VI', formData.annexure_VI);
        }
        if (formData.layout_plan != '') {
            that.showDocument('layout_plan_container_for_construction', 'layout_plan_name_image_for_construction', 'layout_plan_name_container_for_construction',
                    'layout_plan_download', 'layout_plan', formData.layout_plan);
        }
        if (formData.licensed_engineer_signature != '') {
            that.showDocument('licensed_engineer_signature_container_for_construction', 'licensed_engineer_signature_name_image_for_construction', 'licensed_engineer_signature_name_container_for_construction',
                    'licensed_engineer_signature_download', 'licensed_engineer_signature', formData.licensed_engineer_signature);
        }
        if (formData.labour_cess != '') {
            that.showDocument('labour_cess_container_for_construction', 'labour_cess_name_image_for_construction', 'labour_cess_name_container_for_construction',
                    'labour_cess_download', 'labour_cess', formData.labour_cess);
        }
        if (formData.undertaking != '') {
            that.showDocument('undertaking_container_for_construction', 'undertaking_name_image_for_construction', 'undertaking_name_container_for_construction',
                    'undertaking_download', 'undertaking', formData.undertaking);
        }
        if (formData.fire_noc != '') {
            that.showDocument('fire_noc_container_for_construction', 'fire_noc_name_image_for_construction', 'fire_noc_name_container_for_construction',
                    'fire_noc_download', 'fire_noc', formData.fire_noc);
        }
        if (formData.owner_signature != '') {
            that.showDocument('owner_signature_container_for_construction', 'owner_signature_name_image_for_construction', 'owner_signature_name_container_for_construction',
                    'owner_signature_download', 'owner_signature', formData.owner_signature);
        }


    },
    checkValidationForConstruction: function (constructionData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!constructionData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!constructionData.name_of_owner) {
            return getBasicMessageAndFieldJSONArray('name_of_owner', ownerNameValidationMessage);
        }
        if (!constructionData.address_of_owner) {
            return getBasicMessageAndFieldJSONArray('address_of_owner', owneraddressMessage);
        }
        if (!constructionData.village) {
            return getBasicMessageAndFieldJSONArray('village', villageValidationMessage);
        }
        if (!constructionData.name) {
            return getBasicMessageAndFieldJSONArray('name', architectNameValidationMessage);
        }
        // if (!constructionData.license_no) {
        //     return getBasicMessageAndFieldJSONArray('license_no', architectlicenseNoValidationMessage);
        // }
        // if (!constructionData.valid_upto_date) {
        //     return getBasicMessageAndFieldJSONArray('valid_upto_date', occupancyValidUptoValidationMessage);
        // }
        var annexureV = $('input[name=annexureV]:checked').val();
        if (annexureV == '' || annexureV == null) {
            $('#annexureV').focus();
            return getBasicMessageAndFieldJSONArray('annexureV', uploadValidationMessage);
        }
        var annexureVI = $('input[name=annexureVI]:checked').val();
        if (annexureVI == '' || annexureVI == null) {
            $('#annexureVI').focus();
            return getBasicMessageAndFieldJSONArray('annexureVI', uploadValidationMessage);
        }
        var layoutplan = $('input[name=layoutplan]:checked').val();
        if (layoutplan == '' || layoutplan == null) {
            $('#layoutplan').focus();
            return getBasicMessageAndFieldJSONArray('layoutplan', uploadValidationMessage);
        }
        var provisional_noc = $('input[name=provisional_noc]:checked').val();
        if (provisional_noc == '' || provisional_noc == null) {
            $('#provisional_noc').focus();
            return getBasicMessageAndFieldJSONArray('provisional_noc', uploadValidationMessage);
        }
        var crz_clearance = $('input[name=crz_clearance]:checked').val();
        if (crz_clearance == '' || crz_clearance == null) {
            $('#crz_clearance').focus();
            return getBasicMessageAndFieldJSONArray('crz_clearance', uploadValidationMessage);
        }
        var sub_division = $('input[name=sub_division]:checked').val();
        if (sub_division == '' || sub_division == null) {
            $('#sub_division').focus();
            return getBasicMessageAndFieldJSONArray('sub_division', uploadValidationMessage);
        }
        var amalgamation = $('input[name=amalgamation]:checked').val();
        if (amalgamation == '' || amalgamation == null) {
            $('#amalgamation').focus();
            return getBasicMessageAndFieldJSONArray('amalgamation', uploadValidationMessage);
        }
        var occupancy = $('input[name=occupancy]:checked').val();
        if (occupancy == '' || occupancy == null) {
            $('#occupancy').focus();
            return getBasicMessageAndFieldJSONArray('occupancy', uploadValidationMessage);
        }
        var certificate_land = $('input[name=certificate_land]:checked').val();
        if (certificate_land == '' || certificate_land == null) {
            $('#certificate_land').focus();
            return getBasicMessageAndFieldJSONArray('certificate_land', uploadValidationMessage);
        }
        return '';
    },
    askForSubmitConstruction: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Construction.listview.submitConstruction(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitConstruction: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var constructionData = $('#construction_form').serializeFormJSON();
        var validationData = that.checkValidationForConstruction(constructionData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('construction-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#annexure_III_container_for_construction').is(':visible')) {
            var annexureIII = checkValidationForDocument('annexure_III_for_construction', VALUE_ONE, 'construction', 25600);
            if (annexureIII == false) {
                return false;
            }
        }

        if ($('#annexure_IV_container_for_construction').is(':visible')) {
            var annexureIV = checkValidationForDocument('annexure_IV_for_construction', VALUE_ONE, 'construction', 5120);
            if (annexureIV == false) {
                return false;
            }
        }
        if ($('#copy_of_na_container_for_construction').is(':visible')) {
            var copyofNa = checkValidationForDocument('copy_of_na_for_construction', VALUE_ONE, 'construction', 5120);
            if (copyofNa == false) {
                return false;
            }
        }

        if ($('#original_certified_map_container_for_construction').is(':visible')) {
            var originalcerificateMap = checkValidationForDocument('original_certified_map_for_construction', VALUE_ONE, 'construction', 5120);
            if (originalcerificateMap == false) {
                return false;
            }
        }
        if ($('#I_and_XIV_nakal_container_for_construction').is(':visible')) {
            var IXIVnakal = checkValidationForDocument('I_and_XIV_nakal_for_construction', VALUE_ONE, 'construction', 5120);
            if (IXIVnakal == false) {
                return false;
            }
        }
        if ($('#building_plan_dcr_container_for_construction').is(':visible')) {
            var buildingplanDcr = checkValidationForDocument('building_plan_dcr_for_construction', VALUE_ONE, 'construction', 25600);
            if (buildingplanDcr == false) {
                return false;
            }
        }
        if ($('#cost_estimate_container_for_construction').is(':visible')) {
            var costEstimate = checkValidationForDocument('cost_estimate_for_construction', VALUE_ONE, 'construction', 5120);
            if (costEstimate == false) {
                return false;
            }
        }

        if ($('#noc_coast_guard_container_for_construction').is(':visible')) {
            var IXIVnakal = checkValidationForDocument('noc_coast_guard_for_construction', VALUE_ONE, 'construction', 5120);
            if (IXIVnakal == false) {
                return false;
            }
        }
        if ($('#annexure_V_container_for_construction').is(':visible')) {
            var annexureV = checkValidationForDocument('annexure_V_for_construction', VALUE_ONE, 'construction', 5120);
            if (annexureV == false) {
                return false;
            }
        }
        if ($('#provisional_noc_fire_container_for_construction').is(':visible')) {
            var provisionalNoc = checkValidationForDocument('provisional_noc_fire_for_construction', VALUE_ONE, 'construction', 5120);
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#crz_clearance_certificate_container_for_construction').is(':visible')) {
            var crzCertificate = checkValidationForDocument('crz_clearance_certificate_for_construction', VALUE_ONE, 'construction', 5120);
            if (crzCertificate == false) {
                return false;
            }
        }
        if ($('#sub_division_order_container_for_construction').is(':visible')) {
            var subdivisionOrder = checkValidationForDocument('sub_division_order_for_construction', VALUE_ONE, 'construction', 5120);
            if (subdivisionOrder == false) {
                return false;
            }
        }
        if ($('#amalgamation_order_container_for_construction').is(':visible')) {
            var amalgamationOrder = checkValidationForDocument('amalgamation_order_for_construction', VALUE_ONE, 'construction', 5120);
            if (amalgamationOrder == false) {
                return false;
            }
        }
        if ($('#occupancy_certificate_container_for_construction').is(':visible')) {
            var occupancyCerificate = checkValidationForDocument('occupancy_certificate_for_construction', VALUE_ONE, 'construction', 25600);
            if (occupancyCerificate == false) {
                return false;
            }
        }
        if ($('#certificate_land_acquisition_container_for_construction').is(':visible')) {
            var certifiacateLand = checkValidationForDocument('certificate_land_acquisition_for_construction', VALUE_ONE, 'construction', 5120);
            if (certifiacateLand == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_construction').is(':visible')) {
            var sealandstamp = checkValidationForDocument('seal_and_stamp_for_construction', VALUE_TWO, 'construction', 5120);
            if (sealandstamp == false) {
                return false;
            }
        }
        if ($('#annexure_VI_container_for_construction').is(':visible')) {
            var annaxureVI = checkValidationForDocument('annexure_VI_for_construction', VALUE_ONE, 'construction', 5120);
            if (annaxureVI == false) {
                return false;
            }
        }
        if ($('#layout_plan_container_for_construction').is(':visible')) {
            var layoutplan = checkValidationForDocument('layout_plan_for_construction', VALUE_ONE, 'construction', 5120);
            if (layoutplan == false) {
                return false;
            }
        }
        if ($('#licensed_engineer_signature_container_for_construction').is(':visible')) {
            var engineerSignature = checkValidationForDocument('licensed_engineer_signature_for_construction', VALUE_TWO, 'construction', 5120);
            if (engineerSignature == false) {
                return false;
            }
        }
        if ($('#labour_cess_container_for_construction').is(':visible')) {
            var labourCess = checkValidationForDocument('labour_cess_for_construction', VALUE_ONE, 'construction', 5120);
            if (labourCess == false) {
                return false;
            }
        }
        if ($('#undertaking_container_for_construction').is(':visible')) {
            var undertaking = checkValidationForDocument('undertaking_for_construction', VALUE_ONE, 'construction', 5120);
            if (undertaking == false) {
                return false;
            }
        }
        if ($('#fire_noc_container_for_construction').is(':visible')) {
            var fireNoc = checkValidationForDocument('fire_noc_for_construction', VALUE_ONE, 'construction', 5120);
            if (fireNoc == false) {
                return false;
            }
        }
        //  if ($('#owner_signature_container_for_construction').is(':visible')) {
        //     var ownerSignature = checkValidationForDocument('owner_signature_for_construction', VALUE_TWO, 'construction', 5120);
        //     if (ownerSignature == false) {
        //         return false;
        //     }
        // }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_construction') : $('#submit_btn_for_construction', 5120);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var constructionData = new FormData($('#construction_form')[0]);
        constructionData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        // constructionData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        constructionData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'construction/submit_construction',
            data: constructionData,
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
                validationMessageShow('construction', textStatus.statusText);
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
                    validationMessageShow('construction', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Construction.router.navigate('construction', {'trigger': true});
            }
        });
    },

    askForRemove: function (constructionId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!constructionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Construction.listview.removeDocument(\'' + constructionId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (constructionId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!constructionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_construction_' + docType).hide();
        $('.spinner_name_container_for_construction_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'construction/remove_document',
            data: $.extend({}, {'construction_id': constructionId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_construction_' + docType).hide();
                $('.spinner_name_container_for_construction_' + docType).show();
                validationMessageShow('construction', textStatus.statusText);
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
                    validationMessageShow('construction', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_construction_' + docType).show();
                $('.spinner_name_container_for_construction_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('annexure_III_name_container_for_construction', 'annexure_III_name_image_for_construction', 'annexure_III_container_for_construction', 'annexure_III_for_construction');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('annexure_IV_name_container_for_construction', 'annexure_IV_name_image_for_construction', 'annexure_IV_container_for_construction', 'annexure_IV_for_construction');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('copy_of_na_name_container_for_construction', 'copy_of_na_name_image_for_construction', 'copy_of_na_container_for_construction', 'copy_of_na_for_construction');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('original_certified_map_name_container_for_construction', 'original_certified_map_name_image_for_construction', 'original_certified_map_container_for_construction', 'original_certified_map_for_construction');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('I_and_XIV_nakal_name_container_for_construction', 'I_and_XIV_nakal_name_image_for_construction', 'I_and_XIV_nakal_container_for_construction', 'I_and_XIV_nakal_for_construction');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('building_plan_dcr_name_container_for_construction', 'building_plan_dcr_name_image_for_construction', 'building_plan_dcr_container_for_construction', 'building_plan_dcr_for_construction');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('cost_estimate_name_container_for_construction', 'cost_estimat_name_image_for_construction', 'cost_estimate_container_for_construction', 'cost_estimate_for_construction');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('noc_coast_guard_name_container_for_construction', 'noc_coast_guard_name_image_for_construction', 'noc_coast_guard_container_for_construction', 'noc_coast_guard_for_construction');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('annexure_V_name_container_for_construction', 'annexure_V_name_image_for_construction', 'annexure_V_container_for_construction', 'annexure_V_for_construction');
                }
                if (docType == VALUE_TEN) {
                    removeDocumentValue('provisional_noc_fire_name_container_for_construction', 'provisional_noc_fire_name_image_for_construction', 'provisional_noc_fire_container_for_construction', 'provisional_noc_fire_for_construction');
                }
                if (docType == VALUE_ELEVEN) {
                    removeDocumentValue('crz_clearance_certificate_name_container_for_construction', 'crz_clearance_certificate_name_image_for_construction', 'crz_clearance_certificate_container_for_construction', 'crz_clearance_certificate_for_construction');
                }
                if (docType == VALUE_TWELVE) {
                    removeDocumentValue('sub_division_order_name_container_for_construction', 'sub_division_order_name_image_for_construction', 'sub_division_order_container_for_construction', 'sub_division_order_for_construction');
                }
                if (docType == VALUE_THIRTEEN) {
                    removeDocumentValue('amalgamation_order_name_container_for_construction', 'amalgamation_order_name_image_for_construction', 'amalgamation_order_container_for_construction', 'amalgamation_order_for_construction');
                }
                if (docType == VALUE_FOURTEEN) {
                    removeDocumentValue('occupancy_certificate_name_container_for_construction', 'occupancy_certificate_name_image_for_construction', 'occupancy_certificate_container_for_construction', 'occupancy_certificate_for_construction');
                }
                if (docType == VALUE_FIFTEEN) {
                    removeDocumentValue('certificate_land_acquisition_name_container_for_construction', 'certificate_land_acquisition_name_image_for_construction', 'certificate_land_acquisition_container_for_construction', 'certificate_land_acquisition_for_construction');
                }
                if (docType == VALUE_SIXTEEN) {
                    removeDocumentValue('seal_and_stamp_name_container_for_construction', 'seal_and_stamp_name_image_for_construction', 'seal_and_stamp_container_for_construction', 'seal_and_stamp_for_construction');
                }
                if (docType == VALUE_SEVENTEEN) {
                    removeDocumentValue('annexure_VI_name_container_for_construction', 'annexure_VI_name_image_for_construction', 'annexure_VI_container_for_construction', 'annexure_VI_for_construction');
                }
                if (docType == VALUE_EIGHTEEN) {
                    removeDocumentValue('layout_plan_name_container_for_construction', 'layout_plan_name_image_for_construction', 'layout_plan_container_for_construction', 'layout_plan_for_construction');
                }
                if (docType == VALUE_NINETEEN) {
                    removeDocumentValue('licensed_engineer_signature_name_container_for_construction', 'licensed_engineer_signature_name_image_for_construction', 'licensed_engineer_signature_container_for_construction', 'licensed_engineer_signature_for_construction');
                }
                if (docType == VALUE_TWENTY) {
                    removeDocumentValue('labour_cess_name_container_for_construction', 'labour_cess_name_image_for_construction', 'labour_cess_container_for_construction', 'labour_cess_for_construction');
                }
                if (docType == VALUE_TWENTYONE) {
                    removeDocumentValue('undertaking_name_container_for_construction', 'undertaking_name_image_for_construction', 'undertaking_container_for_construction', 'undertaking_for_construction');
                }
                if (docType == VALUE_TWENTYTWO) {
                    removeDocumentValue('fire_noc_name_container_for_construction', 'fire_noc_name_image_for_construction', 'fire_noc_container_for_construction', 'fire_noc_for_construction');
                }
                if (docType == VALUE_TWENTYTHREE) {
                    removeDocumentValue('owner_signature_name_container_for_construction', 'owner_signature_name_image_for_construction', 'owner_signature_container_for_construction', 'owner_signature_for_construction');
                }
            }
        });
    },
    generateForm1: function (constructionId) {
        if (!constructionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#construction_id_for_construction_form1').val(constructionId);
        $('#construction_form1_pdf_form').submit();
        $('#construction_id_for_construction_form1').val('');
    },

    downloadUploadChallan: function (constructionId) {
        if (!constructionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + constructionId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'construction/get_construction_data_by_construction_id',
            type: 'post',
            data: $.extend({}, {'construction_id': constructionId}, getTokenData()),
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
                var constructionData = parseData.construction_data;
                that.showChallan(constructionData);
            }
        });
    },
    showChallan: function (constructionData) {
        showPopup();
        if (constructionData.status != VALUE_FIVE && constructionData.status != VALUE_SIX && constructionData.status != VALUE_SEVEN) {
            if (!constructionData.hide_submit_btn) {
                constructionData.show_fees_paid = true;
            }
        }
        if (constructionData.payment_type == VALUE_ONE) {
            constructionData.utitle = 'Fees Paid Challan Copy';
        } else {
            constructionData.style = 'display: none;';
        }
        if (constructionData.payment_type == VALUE_TWO) {
            constructionData.show_dd_po_option = true;
            constructionData.utitle = 'Demand Draft (DD)';
        }
        constructionData.module_type = VALUE_TWENTYSIX;
        $('#popup_container').html(constructionUploadChallanTemplate(constructionData));
        loadFB(VALUE_TWENTYSIX, constructionData.fb_data);
        loadPH(VALUE_TWENTYSIX, constructionData.construction_id, constructionData.ph_data);

        if (constructionData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'construction_upload_challan', constructionData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'construction_upload_challan', 'uc', 'radio');
            if (constructionData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_construction_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (constructionData.challan != '') {
            $('#challan_container_for_construction_upload_challan').hide();
            $('#challan_name_container_for_construction_upload_challan').show();
            $('#challan_name_href_for_construction_upload_challan').attr('href', 'documents/construction/' + constructionData.challan);
            $('#challan_name_for_construction_upload_challan').html(constructionData.challan);
        }
        if (constructionData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_construction_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_construction_upload_challan').show();
            $('#fees_paid_challan_name_href_for_construction_upload_challan').attr('href', 'documents/construction/' + constructionData.fees_paid_challan);
            $('#fees_paid_challan_name_for_construction_upload_challan').html(constructionData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_construction_upload_challan').attr('onclick', 'Construction.listview.removeFeesPaidChallan("' + constructionData.construction_id + '")');
        }
    },
    removeFeesPaidChallan: function (constructionId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!constructionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'construction/remove_fees_paid_challan',
            data: $.extend({}, {'construction_id': constructionId}, getTokenData()),
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
                validationMessageShow('construction-uc', textStatus.statusText);
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
                    validationMessageShow('construction-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-construction-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'construction_upload_challan');
                $('#status_' + constructionId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-construction-uc').html('');
        validationMessageHide();
        var constructionId = $('#construction_id_for_construction_upload_challan').val();
        if (!constructionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_construction_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_construction_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_construction_upload_challan').focus();
                validationMessageShow('construction-uc-fees_paid_challan_for_construction_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_construction_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_construction_upload_challan').focus();
                validationMessageShow('construction-uc-fees_paid_challan_for_construction_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_construction_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#construction_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'construction/upload_fees_paid_challan',
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
                validationMessageShow('construction-uc', textStatus.statusText);
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
                    validationMessageShow('construction-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + constructionId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (constructionId) {
        if (!constructionId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#construction_id_for_certificate').val(constructionId);
        $('#construction_certificate_pdf_form').submit();
        $('#construction_id_for_certificate').val('');
    },
    getQueryData: function (constructionId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!constructionId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTYSIX;
        templateData.module_id = constructionId;
        var btnObj = $('#query_btn_for_construction_' + constructionId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTYSIX, moduleData.construction_id);
                tmpData.applicant_name = moduleData.name_of_owner;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForConstruction: function (fileNo) {
        var that = this;
        if ($('#annexure_III_for_construction').val() != '') {
            var annexureIII = checkValidationForDocument('annexure_III_for_construction', VALUE_ONE, 'construction', 25600);
            if (annexureIII == false) {
                return false;
            }
        }
        if ($('#annexure_IV_for_construction').val() != '') {
            var annexureIV = checkValidationForDocument('annexure_IV_for_construction', VALUE_ONE, 'construction', 5120);
            if (annexureIV == false) {
                return false;
            }
        }
        if ($('#copy_of_na_for_construction').val() != '') {
            var copyofNa = checkValidationForDocument('copy_of_na_for_construction', VALUE_ONE, 'construction', 5120);
            if (copyofNa == false) {
                return false;
            }
        }
        if ($('#original_certified_map_for_construction').val() != '') {
            var originalcerificateMap = checkValidationForDocument('original_certified_map_for_construction', VALUE_ONE, 'construction', 5120);
            if (originalcerificateMap == false) {
                return false;
            }
        }
        if ($('#I_and_XIV_nakal_for_construction').val() != '') {
            var IXIVnakal = checkValidationForDocument('I_and_XIV_nakal_for_construction', VALUE_ONE, 'construction', 5120);
            if (IXIVnakal == false) {
                return false;
            }
        }
        if ($('#building_plan_dcr_for_construction').val() != '') {
            var buildingplanDcr = checkValidationForDocument('building_plan_dcr_for_construction', VALUE_ONE, 'construction', 25600);
            if (buildingplanDcr == false) {
                return false;
            }
        }
        if ($('#cost_estimate_for_construction').val() != '') {
            var costEstimate = checkValidationForDocument('cost_estimate_for_construction', VALUE_ONE, 'construction', 5120);
            if (costEstimate == false) {
                return false;
            }
        }
        if ($('#noc_coast_guard_for_construction').val() != '') {
            var annexureV = checkValidationForDocument('noc_coast_guard_for_construction', VALUE_ONE, 'construction', 5120);
            if (annexureV == false) {
                return false;
            }
        }
        if ($('#annexure_V_for_construction').val() != '') {
            var provisionalNoc = checkValidationForDocument('annexure_V_for_construction', VALUE_ONE, 'construction', 5120);
            if (provisionalNoc == false) {
                return false;
            }
        }
        if ($('#provisional_noc_fire_for_construction').val() != '') {
            var provisionalnoc = checkValidationForDocument('provisional_noc_fire_for_construction', VALUE_ONE, 'construction', 5120);
            if (provisionalnoc == false) {
                return false;
            }
        }
        if ($('#crz_clearance_certificate_for_construction').val() != '') {
            var crzCertificate = checkValidationForDocument('crz_clearance_certificate_for_construction', VALUE_ONE, 'construction', 5120);
            if (crzCertificate == false) {
                return false;
            }
        }
        if ($('#sub_division_order_for_construction').val() != '') {
            var subdivisionOrder = checkValidationForDocument('sub_division_order_for_construction', VALUE_ONE, 'construction', 5120);
            if (subdivisionOrder == false) {
                return false;
            }
        }
        if ($('#amalgamation_order_for_construction').val() != '') {
            var amalgamationOrder = checkValidationForDocument('amalgamation_order_for_construction', VALUE_ONE, 'construction', 5120);
            if (amalgamationOrder == false) {
                return false;
            }
        }
        if ($('#occupancy_certificate_for_construction').val() != '') {
            var occupancyCerificate = checkValidationForDocument('occupancy_certificate_for_construction', VALUE_ONE, 'construction', 25600);
            if (occupancyCerificate == false) {
                return false;
            }
        }
        if ($('#certificate_land_acquisition_for_construction').val() != '') {
            var certifiacateLand = checkValidationForDocument('certificate_land_acquisition_for_construction', VALUE_ONE, 'construction', 5120);
            if (certifiacateLand == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_construction').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_construction', VALUE_TWO, 'construction', 5120);
            if (sealAndStamp == false) {
                return false;
            }
        }
        if ($('#annexure_VI_for_construction').val() != '') {
            var annaxureVI = checkValidationForDocument('annexure_VI_for_construction', VALUE_ONE, 'construction', 5120);
            if (annaxureVI == false) {
                return false;
            }
        }
        if ($('#layout_plan_for_construction').val() != '') {
            var layoutplan = checkValidationForDocument('layout_plan_for_construction', VALUE_ONE, 'construction', 5120);
            if (layoutplan == false) {
                return false;
            }
        }
        if ($('#licensed_engineer_signature_for_construction').val() != '') {
            var layoutplan = checkValidationForDocument('licensed_engineer_signature_for_construction', VALUE_TWO, 'construction', 5120);
            if (layoutplan == false) {
                return false;
            }
        }
        if ($('#labour_cess_for_construction').val() != '') {
            var labourCess = checkValidationForDocument('labour_cess_for_construction', VALUE_ONE, 'construction', 5120);
            if (labourCess == false) {
                return false;
            }
        }
        if ($('#undertaking_for_construction').val() != '') {
            var undertaking = checkValidationForDocument('undertaking_for_construction', VALUE_ONE, 'construction', 5120);
            if (undertaking == false) {
                return false;
            }
        }
        if ($('#fire_noc_for_construction').val() != '') {
            var fireNoc = checkValidationForDocument('fire_noc_for_construction', VALUE_ONE, 'construction', 5120);
            if (fireNoc == false) {
                return false;
            }
        }
        if ($('#owner_signature_for_construction').val() != '') {
            var ownerSignature = checkValidationForDocument('owner_signature_for_construction', VALUE_TWO, 'construction', 5120);
            if (ownerSignature == false) {
                return false;
            }
        }
        $('.spinner_container_for_construction_' + fileNo).hide();
        $('.spinner_name_container_for_construction_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var constructionId = $('#construction_id').val();
        var formData = new FormData($('#construction_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("construction_id", constructionId);
        $.ajax({
            type: 'POST',
            url: 'construction/upload_construction_document',
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
                $('.spinner_container_for_construction_' + fileNo).show();
                $('.spinner_name_container_for_construction_' + fileNo).hide();
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
                    $('.spinner_container_for_construction_' + fileNo).show();
                    $('.spinner_name_container_for_construction_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_construction_' + fileNo).hide();
                $('.spinner_name_container_for_construction_' + fileNo).show();
                $('#construction_id').val(parseData.construction_id);
                var constructionData = parseData.construction_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('annexure_III_container_for_construction', 'annexure_III_name_image_for_construction', 'annexure_III_name_container_for_construction',
                            'annexure_III_download', 'annexure_III', constructionData.annexure_III, parseData.construction_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('annexure_IV_container_for_construction', 'annexure_IV_name_image_for_construction', 'annexure_IV_name_container_for_construction',
                            'annexure_IV_download', 'annexure_IV', constructionData.annexure_IV, parseData.construction_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('copy_of_na_container_for_construction', 'copy_of_na_name_image_for_construction', 'copy_of_na_name_container_for_construction',
                            'copy_of_na_download', 'copy_of_na', constructionData.copy_of_na, parseData.construction_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('original_certified_map_container_for_construction', 'original_certified_map_name_image_for_construction', 'original_certified_map_name_container_for_construction',
                            'original_certified_map_download', 'original_certified_map', constructionData.original_certified_map, parseData.construction_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('I_and_XIV_nakal_container_for_construction', 'I_and_XIV_nakal_name_image_for_construction', 'I_and_XIV_nakal_name_container_for_construction',
                            'I_and_XIV_nakal_download', 'I_and_XIV_nakal', constructionData.I_and_XIV_nakal, parseData.construction_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('building_plan_dcr_container_for_construction', 'building_plan_dcr_name_image_for_construction', 'building_plan_dcr_name_container_for_construction',
                            'building_plan_dcr_download', 'building_plan_dcr', constructionData.building_plan_dcr, parseData.construction_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('cost_estimate_container_for_construction', 'cost_estimate_name_image_for_construction', 'cost_estimate_name_container_for_construction',
                            'cost_estimate_download', 'cost_estimate', constructionData.cost_estimate, parseData.construction_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('noc_coast_guard_container_for_construction', 'noc_coast_guard_name_image_for_construction', 'noc_coast_guard_name_container_for_construction',
                            'noc_coast_guard_download', 'noc_coast_guard', constructionData.noc_coast_guard, parseData.construction_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('annexure_V_container_for_construction', 'annexure_V_name_image_for_construction', 'annexure_V_name_container_for_construction',
                            'annexure_V_download', 'annexure_V', constructionData.annexure_V, parseData.construction_id, VALUE_NINE);
                }
                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('provisional_noc_fire_container_for_construction', 'provisional_noc_fire_name_image_for_construction', 'provisional_noc_fire_name_container_for_construction',
                            'provisional_noc_fire_download', 'provisional_noc_fire', constructionData.provisional_noc_fire, parseData.construction_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('crz_clearance_certificate_container_for_construction', 'crz_clearance_certificate_name_image_for_construction', 'crz_clearance_certificate_name_container_for_construction',
                            'crz_clearance_certificate_download', 'crz_clearance_certificate', constructionData.crz_clearance_certificate, parseData.construction_id, VALUE_ELEVEN);
                }
                if (parseData.file_no == VALUE_TWELVE) {
                    that.showDocument('sub_division_order_container_for_construction', 'sub_division_order_name_image_for_construction', 'sub_division_order_name_container_for_construction',
                            'sub_division_order_download', 'sub_division_order', constructionData.sub_division_order, parseData.construction_id, VALUE_TWELVE);
                }
                if (parseData.file_no == VALUE_THIRTEEN) {
                    that.showDocument('amalgamation_order_container_for_construction', 'amalgamation_order_name_image_for_construction', 'amalgamation_order_name_container_for_construction',
                            'amalgamation_order_download', 'amalgamation_order', constructionData.amalgamation_order, parseData.construction_id, VALUE_THIRTEEN);
                }
                if (parseData.file_no == VALUE_FOURTEEN) {
                    that.showDocument('occupancy_certificate_container_for_construction', 'occupancy_certificate_name_image_for_construction', 'occupancy_certificate_name_container_for_construction',
                            'occupancy_certificate_download', 'occupancy_certificate', constructionData.occupancy_certificate, parseData.construction_id, VALUE_FOURTEEN);
                }
                if (parseData.file_no == VALUE_FIFTEEN) {
                    that.showDocument('certificate_land_acquisition_container_for_construction', 'certificate_land_acquisition_name_image_for_construction', 'certificate_land_acquisition_name_container_for_construction',
                            'certificate_land_acquisition_download', 'certificate_land_acquisition', constructionData.certificate_land_acquisition, parseData.construction_id, VALUE_FIFTEEN);
                }
                if (parseData.file_no == VALUE_SIXTEEN) {
                    that.showDocument('seal_and_stamp_container_for_construction', 'seal_and_stamp_name_image_for_construction', 'seal_and_stamp_name_container_for_construction',
                            'seal_and_stamp_download', 'seal_and_stamp', constructionData.signature, parseData.construction_id, VALUE_SIXTEEN);
                }
                if (parseData.file_no == VALUE_SEVENTEEN) {
                    that.showDocument('annexure_VI_container_for_construction', 'annexure_VI_name_image_for_construction', 'annexure_VI_name_container_for_construction',
                            'annexure_VI_download', 'annexure_VI', constructionData.annexure_VI, parseData.construction_id, VALUE_SEVENTEEN);
                }
                if (parseData.file_no == VALUE_EIGHTEEN) {
                    that.showDocument('layout_plan_container_for_construction', 'layout_plan_name_image_for_construction', 'layout_plan_name_container_for_construction',
                            'layout_plan_download', 'layout_plan', constructionData.layout_plan, parseData.construction_id, VALUE_EIGHTEEN);
                }
                if (parseData.file_no == VALUE_NINETEEN) {
                    that.showDocument('licensed_engineer_signature_container_for_construction', 'licensed_engineer_signature_name_image_for_construction', 'licensed_engineer_signature_name_container_for_construction',
                            'licensed_engineer_signature_download', 'licensed_engineer_signature', constructionData.licensed_engineer_signature, parseData.construction_id, VALUE_NINETEEN);
                }
                if (parseData.file_no == VALUE_TWENTY) {
                    that.showDocument('labour_cess_container_for_construction', 'labour_cess_name_image_for_construction', 'labour_cess_name_container_for_construction',
                            'labour_cess_download', 'labour_cess', constructionData.labour_cess, parseData.construction_id, VALUE_TWENTY);
                }
                if (parseData.file_no == VALUE_TWENTYONE) {
                    that.showDocument('undertaking_container_for_construction', 'undertaking_name_image_for_construction', 'undertaking_name_container_for_construction',
                            'undertaking_download', 'undertaking', constructionData.undertaking, parseData.construction_id, VALUE_TWENTYONE);
                }
                if (parseData.file_no == VALUE_TWENTYTWO) {
                    that.showDocument('fire_noc_container_for_construction', 'fire_noc_name_image_for_construction', 'fire_noc_name_container_for_construction',
                            'fire_noc_download', 'fire_noc', constructionData.fire_noc, parseData.construction_id, VALUE_TWENTYTWO);
                }
                if (parseData.file_no == VALUE_TWENTYTHREE) {
                    that.showDocument('owner_signature_container_for_construction', 'owner_signature_name_image_for_construction', 'owner_signature_name_container_for_construction',
                            'owner_signature_download', 'owner_signature', constructionData.owner_signature, parseData.construction_id, VALUE_TWENTYTHREE);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/construction/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/construction/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Construction.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
    getDepartmentdata: function (department) {
        var val = department.value;
        if (val == '') {
            return false;
        }
        if (val === '1') {

            this.$('.dd_for_cp_div').show();
            this.$('.dnh_for_cp_div').hide();

            this.$('.annexure_III_item_container_for_construction').show();
            this.$('.annexure_IV_item_container_for_construction').show();
            this.$('.copy_of_na_item_container_for_construction').show();
            this.$('.original_certified_map_item_container_for_construction').show();
            this.$('.I_and_XIV_nakal_item_container_for_construction').show();
            this.$('.building_plan_dcr_item_container_for_construction').show();
            this.$('.cost_estimate_item_container_for_construction').show();
            this.$('.noc_coast_guard_item_container_for_construction').show();
            this.$('.annexure_V_item_container_for_construction').show();
            this.$('.annexureVI_item_container_for_construction').show();
            this.$('.layout_plan_item_container_for_construction').show();
            this.$('.provisional_noc_fire_item_container_for_construction').show();
            this.$('.crz_clearance_certificate_item_container_for_construction').show();
            this.$('.sub_division_order_item_container_for_construction').show();
            this.$('.amalgamation_order_item_container_for_construction').show();
            this.$('.occupancy_certificate_item_container_for_construction').show();
            this.$('.certificate_land_acquisition_item_container_for_construction').show();
            this.$('.seal_and_stamp_item_container_for_construction').show();
            this.$('.licensed_engineer_signature_item_container_for_construction').show();
            this.$('.labour_cess_item_container_for_construction').hide();
            this.$('.undertaking_item_container_for_construction').hide();
            this.$('.fire_noc_item_container_for_construction').hide();
            this.$('.owner_signature_item_container_for_construction').hide();

        }
        if (val === '2') {

            this.$('.dd_for_cp_div').show();
            this.$('.dnh_for_cp_div').hide();


            this.$('.annexure_III_item_container_for_construction').show();
            this.$('.annexure_IV_item_container_for_construction').show();
            this.$('.copy_of_na_item_container_for_construction').show();
            this.$('.original_certified_map_item_container_for_construction').show();
            this.$('.I_and_XIV_nakal_item_container_for_construction').show();
            this.$('.building_plan_dcr_item_container_for_construction').show();
            this.$('.cost_estimate_item_container_for_construction').show();
            this.$('.noc_coast_guard_item_container_for_construction').show();
            this.$('.annexure_V_item_container_for_construction').show();
            this.$('.annexureVI_item_container_for_construction').show();
            this.$('.layout_plan_item_container_for_construction').show();
            this.$('.provisional_noc_fire_item_container_for_construction').show();
            this.$('.crz_clearance_certificate_item_container_for_construction').show();
            this.$('.sub_division_order_item_container_for_construction').show();
            this.$('.amalgamation_order_item_container_for_construction').show();
            this.$('.occupancy_certificate_item_container_for_construction').show();
            this.$('.certificate_land_acquisition_item_container_for_construction').show();
            this.$('.seal_and_stamp_item_container_for_construction').show();
            this.$('.licensed_engineer_signature_item_container_for_construction').show();
            this.$('.labour_cess_item_container_for_construction').hide();
            this.$('.undertaking_item_container_for_construction').hide();
            this.$('.fire_noc_item_container_for_construction').hide();
            this.$('.owner_signature_item_container_for_construction').hide();

        }
        if (val === '3') {
            this.$('.dd_for_cp_div').hide();
            this.$('.dnh_for_cp_div').show();

            this.$('.annexure_III_item_container_for_construction').show();
            this.$('.annexure_IV_item_container_for_construction').hide();
            this.$('.copy_of_na_item_container_for_construction').show();
            this.$('.original_certified_map_item_container_for_construction').show();
            this.$('.I_and_XIV_nakal_item_container_for_construction').show();
            this.$('.building_plan_dcr_item_container_for_construction').show();
            this.$('.cost_estimate_item_container_for_construction').hide();
            this.$('.noc_coast_guard_item_container_for_construction').hide();
            this.$('.annexure_V_item_container_for_construction').hide();
            this.$('.annexureVI_item_container_for_construction').hide();
            this.$('.layout_plan_item_container_for_construction').show();
            this.$('.provisional_noc_fire_item_container_for_construction').hide();
            this.$('.crz_clearance_certificate_item_container_for_construction').hide();
            this.$('.sub_division_order_item_container_for_construction').show();
            this.$('.amalgamation_order_item_container_for_construction').hide();
            this.$('.occupancy_certificate_item_container_for_construction').show();
            this.$('.certificate_land_acquisition_item_container_for_construction').hide();
            this.$('.seal_and_stamp_item_container_for_construction').hide();
            this.$('.licensed_engineer_signature_item_container_for_construction').hide();
            this.$('.labour_cess_item_container_for_construction').show();
            this.$('.undertaking_item_container_for_construction').show();
            this.$('.fire_noc_item_container_for_construction').show();
            this.$('.owner_signature_item_container_for_construction').show();


        }
    },
});
