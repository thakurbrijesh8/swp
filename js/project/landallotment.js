var landallotmentListTemplate = Handlebars.compile($('#landallotment_list_template').html());
var landallotmentTableTemplate = Handlebars.compile($('#landallotment_table_template').html());
var landallotmentActionTemplate = Handlebars.compile($('#landallotment_action_template').html());
var landallotmentFormTemplate = Handlebars.compile($('#landallotment_form_template').html());
var landallotmentViewTemplate = Handlebars.compile($('#landallotment_view_template').html());
var landallotmentproprietorInfoTemplate = Handlebars.compile($('#landallotment_proprietor_info_template').html());
var landallotmentUploadChallanTemplate = Handlebars.compile($('#landallotment_upload_challan_template').html());
var tempPersonCnt = 1;
var Landallotment = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Landallotment.Router = Backbone.Router.extend({
    routes: {
        'landallotment': 'renderList',
        'landallotment_form': 'renderListForForm',
        'edit_landallotment_form': 'renderList',
        'view_landallotment_form': 'renderList',
    },
    renderList: function () {
        Landallotment.listview.listPage();
    },
    renderListForForm: function () {
        Landallotment.listview.listPageLandallotmentForm();
    }
});
Landallotment.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="obtained_letter_of_intent"]': 'hasObtainedLetter',
        'click input[name="regist_letter_msme"]': 'hasRegistLetterMsme',
        'click input[name="if_project_collaboration"]': 'hasProjectCollab',
        'click input[name="if_project_requires_import"]': 'hasProjectRequImp',
        'click input[name="no_of_persons_likely_emp"]': 'hasNoPersLikely',
        'click input[name="no_of_persons_likely_emp_unskilled"]': 'hasNoPersLikelyUnskilled',
        'click input[name="no_of_persons_likely_emp_staff"]': 'hasNoPersLikelyStaff',
        'click input[name="if_backward_class_bac"]': 'hasBackwardClass',
        'click input[name="if_backward_class_scst"]': 'hasBackwardClassSCST',
        'click input[name="if_backward_class_ex_serv"]': 'hasBackwardExServ',
        'click input[name="if_backward_class_wm"]': 'hasBackwardClassWomen',
        'click input[name="if_backward_class_ph"]': 'hasBackwardClassPH',
        'click input[name="if_belonging_transg"]': 'hasBelongTransg',
        'click input[name="if_bonafide"]': 'hasBonafideCerty',
        'click input[name="ifnot_state_particular_place"]': 'hasStateParticularPlace',
        'click input[name="if_promotion_council"]': 'hasPromotionCouncil',
    },

    hasObtainedLetter: function (event) {
        var val = $('input[name=obtained_letter_of_intent]:checked').val();
        if (val == '1') {
            this.$('.obtained_letter_of_intent_div').show();
        } else {
            this.$('.obtained_letter_of_intent_div').hide();

        }
    },
    hasRegistLetterMsme: function (event) {
        var val = $('input[name=regist_letter_msme]:checked').val();
        if (val == '1') {
            this.$('.regist_letter_msme_div').show();
        } else {
            this.$('.regist_letter_msme_div').hide();

        }
    },
    hasProjectCollab: function (event) {
        var val = $('input[name=if_project_collaboration]:checked').val();
        if (val == '1') {
            this.$('.if_project_collaboration_div').show();
        } else {
            this.$('.if_project_collaboration_div').hide();

        }
    },
    hasProjectRequImp: function (event) {
        var val = $('input[name=if_project_requires_import]:checked').val();
        if (val == '1') {
            this.$('.if_project_requires_import_div').show();
        } else {
            this.$('.if_project_requires_import_div').hide();

        }
    },
    hasNoPersLikely: function (event) {
        var val = $('input[name=no_of_persons_likely_emp]:checked').val();
        if (val == '1') {
            this.$('.no_of_persons_likely_emp_div').show();
        } else {
            this.$('.no_of_persons_likely_emp_div').hide();

        }
    },
    hasNoPersLikelyUnskilled: function (event) {
        var val = $('input[name=no_of_persons_likely_emp_unskilled]:checked').val();
        if (val == '1') {
            this.$('.no_of_persons_likely_emp_unskilled_div').show();
        } else {
            this.$('.no_of_persons_likely_emp_unskilled_div').hide();

        }
    },
    hasNoPersLikelyStaff: function (event) {
        var val = $('input[name=no_of_persons_likely_emp_staff]:checked').val();
        if (val == '1') {
            this.$('.no_of_persons_likely_emp_staff_div').show();
        } else {
            this.$('.no_of_persons_likely_emp_staff_div').hide();

        }
    },
    hasBackwardClass: function (event) {
        var val = $('input[name=if_backward_class_bac]:checked').val();
        if (val == '1') {
            this.$('.if_backward_class_bac_div').show();
        } else {
            this.$('.if_backward_class_bac_div').hide();

        }
    },
    hasBackwardClassSCST: function (event) {
        var val = $('input[name=if_backward_class_scst]:checked').val();
        if (val == '1') {
            this.$('.if_backward_class_scst_div').show();
        } else {
            this.$('.if_backward_class_scst_div').hide();

        }
    },
    hasBackwardExServ: function (event) {
        var val = $('input[name=if_backward_class_ex_serv]:checked').val();
        if (val == '1') {
            this.$('.if_backward_class_ex_serv_div').show();
        } else {
            this.$('.if_backward_class_ex_serv_div').hide();

        }
    },
    hasBackwardClassWomen: function (event) {
        var val = $('input[name=if_backward_class_wm]:checked').val();
        if (val == '1') {
            this.$('.if_backward_class_wm_div').show();
        } else {
            this.$('.if_backward_class_wm_div').hide();

        }
    },
    hasBackwardClassPH: function (event) {
        var val = $('input[name=if_backward_class_ph]:checked').val();
        if (val == '1') {
            this.$('.if_backward_class_ph_div').show();
        } else {
            this.$('.if_backward_class_ph_div').hide();

        }
    },
    hasBonafideCerty: function (event) {
        var val = $('input[name=if_bonafide]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.if_bonafide_div').show();
        } else {
            this.$('.if_bonafide_div').hide();

        }
    },
    hasStateParticularPlace: function (event) {
        var val = $('input[name=ifnot_state_particular_place]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.ifnot_state_particular_place_div').show();
        } else {
            this.$('.ifnot_state_particular_place_div').hide();

        }
    },
    hasBelongTransg: function (event) {
        var val = $('input[name=if_belonging_transg]:checked').val();
        if (val == '1') {
            this.$('.if_belonging_transg_div').show();
        } else {
            this.$('.if_belonging_transg_div').hide();

        }
    },
    hasPromotionCouncil: function (event) {
        var val = $('input[name=if_promotion_council]:checked').val();
        if (val == '1') {
            this.$('.if_promotion_council_div').show();
        } else {
            this.$('.if_promotion_council_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('landallotment', 'active');
        Landallotment.router.navigate('landallotment');
        var templateData = {};
        this.$el.html(landallotmentListTemplate(templateData));
        this.loadLandallotmentData(sDistrict, sStatus);

    },
    listPageLandallotmentForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('landallotment', 'active');
        this.$el.html(landallotmentListTemplate);
        this.newLandallotmentForm(false, {});
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
                rowData.ADMIN_LANDALLOTMENT_DOC_PATH = ADMIN_LANDALLOTMENT_DOC_PATH;
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
        return landallotmentActionTemplate(rowData);
    },
    loadLandallotmentData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_TWENTYFIVE, data)
                    + getFRContainer(VALUE_TWENTYFIVE, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Landallotment.router.navigate('landallotment');
        $('#landallotment_form_and_datatable_container').html(landallotmentTableTemplate(searchData));
        landallotmentDataTable = $('#landallotment_datatable').DataTable({
            ajax: {url: 'landallotment/get_landallotment_data', dataSrc: "landallotment_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'landallotment_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_applicant', 'class': 'text-center'},
                {data: 'email', 'class': 'text-center'},
                {data: 'telehpone_no', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'landallotment_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'landallotment_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#landallotment_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = landallotmentDataTable.row(tr);

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
    newLandallotmentForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            var formData = parseData.landallotment_data;
            Landallotment.router.navigate('edit_landallotment_form');
        } else {
            var formData = {};
            Landallotment.router.navigate('landallotment_form');
        }
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_FIVE = VALUE_FIVE;
        templateData.VALUE_SIX = VALUE_SIX;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.IS_CHECKED_NO = IS_CHECKED_NO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.landallotment_data = parseData.landallotment_data;
        if (isEdit) {
            templateData.application_date = dateTo_DD_MM_YYYY(templateData.landallotment_data.application_date);
        } else {
            templateData.application_date = dateTo_DD_MM_YYYY();
        }
        $('#landallotment_form_and_datatable_container').html(landallotmentFormTemplate((templateData)));
        if (isEdit) {
            $('#constitution_artical').val(formData.constitution_artical);
            that.getConstitution(constitution_artical);
        }
        renderOptionsForTwoDimensionalArray(premisesStatusArray, 'premises_status');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        renderOptionsForTwoDimensionalArray(identityChoiceArray, 'identity_choice');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(tempVillagesData, 'villages_for_noc_data', 'village_id', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForPlot([], 'plot_no_for_landallotment_data', 'plot_no', 'plot_no', 'Plot No');
        if (isEdit) {

            $('#constitution_artical').val(formData.constitution_artical);
            that.getConstitution(constitution_artical);
            $('#entity_establishment_type').val(formData.entity_establishment_type);

            $('#declaration').attr('checked', 'checked');

            $('#application_category').val(formData.application_category);
            $('#villages_for_noc_data').val(formData.village);
            $('#expansion_industry').val(formData.expansion_industry);

            // $('#applicant_type'+ per_cnt).val(formData.applicant_type);


            $('#villages_for_noc_data').val(formData.village == 0 ? '' : formData.village);
            var plotData = tempPlotData[formData.village] ? tempPlotData[formData.village] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForPlot(plotData, 'plot_no_for_landallotment_data', 'plot_id', 'plot_no', 'Plot No');
            $('#plot_no_for_landallotment_data').val(formData.plot_no == 0 ? '' : formData.plot_no);
            var cnt = 1;
            var proprietorInfo = JSON.parse(formData.proprietor_details);
            $.each(proprietorInfo, function (key, value) {
                that.addMultipleProprietor(value);

                $('#applicant_type_' + cnt).val(value.applicant_type);


            })
        } else {
            that.addMultipleProprietor({});
        }

        if (isEdit) {


            if (formData.industrial_license_necessary == isChecked) {
                $('#industrial_license_necessary').attr('checked', 'checked');
            }

            if (formData.obtained_letter_of_intent == isChecked) {
                $('#obtained_letter_of_intent').attr('checked', 'checked');
                this.$('.obtained_letter_of_intent_div').show();
            }
            if (formData.regist_letter_msme == isChecked) {
                $('#regist_letter_msme').attr('checked', 'checked');
                this.$('.regist_letter_msme_div').show();
            }

            if (formData.if_project_collaboration == isChecked) {
                $('#if_project_collaboration').attr('checked', 'checked');
                this.$('.if_project_collaboration_div').show();
            }

            if (formData.if_project_requires_import == isChecked) {
                $('#if_project_requires_import').attr('checked', 'checked');
                this.$('.if_project_requires_import_div').show();
            }

            if (formData.no_of_persons_likely_emp == isChecked) {
                $('#no_of_persons_likely_emp').attr('checked', 'checked');
                this.$('.no_of_persons_likely_emp_div').show();
            }
            if (formData.no_of_persons_likely_emp_unskilled == isChecked) {
                $('#no_of_persons_likely_emp_unskilled').attr('checked', 'checked');
                this.$('.no_of_persons_likely_emp_unskilled_div').show();
            }
            if (formData.no_of_persons_likely_emp_staff == isChecked) {
                $('#no_of_persons_likely_emp_staff').attr('checked', 'checked');
                this.$('.no_of_persons_likely_emp_staff_div').show();
            }
            if (formData.if_backward_class_bac == isChecked) {
                $('#if_backward_class_bac').attr('checked', 'checked');
                this.$('.if_backward_class_bac_div').show();
            }
            if (formData.if_backward_class_scst == isChecked) {
                $('#if_backward_class_scst').attr('checked', 'checked');
                this.$('.if_backward_class_scst_div').show();
            }
            if (formData.if_backward_class_ex_serv == isChecked) {
                $('#if_backward_class_ex_serv').attr('checked', 'checked');
                this.$('.if_backward_class_ex_serv_div').show();
            }
            if (formData.if_backward_class_wm == isChecked) {
                $('#if_backward_class_wm').attr('checked', 'checked');
                this.$('.if_backward_class_wm_div').show();
            }
            if (formData.if_backward_class_ph == isChecked) {
                $('#if_backward_class_ph').attr('checked', 'checked');
                this.$('.if_backward_class_ph_div').show();
            }

            if (formData.if_belonging_transg == isChecked) {
                $('#if_belonging_transg').attr('checked', 'checked');
                this.$('.if_belonging_transg_div').show();
            }
            if (formData.if_belonging_other == isChecked) {
                $('#if_belonging_other').attr('checked', 'checked');
            }

            if (formData.if_bonafide == IS_CHECKED_YES) {
                $('#if_bonafide_yes').attr('checked', 'checked');
                $('.if_bonafide_div').show();
            } else if (formData.if_bonafide == IS_CHECKED_NO) {
                $('#if_bonafide_no').attr('checked', 'checked');
            }

            if (formData.ifnot_state_particular_place == IS_CHECKED_YES) {
                $('#ifnot_state_particular_place_yes').attr('checked', 'checked');
                $('.ifnot_state_particular_place_div').show();
            } else if (formData.ifnot_state_particular_place == IS_CHECKED_NO) {
                $('#ifnot_state_particular_place_no').attr('checked', 'checked');
            }

            if (formData.if_promotion_council == IS_CHECKED_YES) {
                $('#if_promotion_council_yes').attr('checked', 'checked');
                $('.if_promotion_council_div').show();
            } else if (formData.if_promotion_council == IS_CHECKED_NO) {
                $('#if_promotion_council_no').attr('checked', 'checked');
            }


            if (formData.bio_data_doc != '') {
                that.showDocument('bio_data_doc_container_for_landallotment', 'bio_data_doc_name_image_for_landallotment', 'bio_data_doc_name_container_for_landallotment',
                        'bio_data_doc_download', 'bio_data_doc', formData.bio_data_doc, formData.landallotment_id, VALUE_ONE);
            }
            if (formData.constitution_artical_doc != '') {
                that.showDocument('constitution_artical_doc_container_for_landallotment', 'constitution_artical_doc_name_image_for_landallotment', 'constitution_artical_doc_name_container_for_landallotment',
                        'constitution_artical_doc_download', 'constitution_artical_doc', formData.constitution_artical_doc, formData.landallotment_id, VALUE_TWO);
            }
            if (formData.obtained_letter_of_intent_doc != '') {
                that.showDocument('obtained_letter_of_intent_doc_container_for_landallotment', 'obtained_letter_of_intent_doc_name_image_for_landallotment', 'obtained_letter_of_intent_doc_name_container_for_landallotment',
                        'obtained_letter_of_intent_doc_download', 'obtained_letter_of_intent_doc', formData.obtained_letter_of_intent_doc, formData.landallotment_id, VALUE_THREE);
            }
            if (formData.regist_letter_msme_doc != '') {
                that.showDocument('regist_letter_msme_doc_container_for_landallotment', 'regist_letter_msme_doc_name_image_for_landallotment', 'regist_letter_msme_doc_name_container_for_landallotment',
                        'regist_letter_msme_doc_download', 'regist_letter_msme_doc', formData.regist_letter_msme_doc, formData.landallotment_id, VALUE_FOUR);
            }
            if (formData.detailed_project_report_doc != '') {
                that.showDocument('detailed_project_report_doc_container_for_landallotment', 'detailed_project_report_doc_name_image_for_landallotment', 'detailed_project_report_doc_name_container_for_landallotment',
                        'detailed_project_report_doc_download', 'detailed_project_report_doc', formData.detailed_project_report_doc, formData.landallotment_id, VALUE_FIVE);
            }
            if (formData.proposed_finance_terms_doc != '') {
                that.showDocument('proposed_finance_terms_doc_container_for_landallotment', 'proposed_finance_terms_doc_name_image_for_landallotment', 'proposed_finance_terms_doc_name_container_for_landallotment',
                        'proposed_finance_terms_doc_download', 'proposed_finance_terms_doc', formData.proposed_finance_terms_doc, formData.landallotment_id, VALUE_SIX);
            }
            if (formData.details_of_manufacturing_doc != '') {
                that.showDocument('details_of_manufacturing_doc_container_for_landallotment', 'details_of_manufacturing_doc_name_image_for_landallotment', 'details_of_manufacturing_doc_name_container_for_landallotment',
                        'details_of_manufacturing_doc_download', 'details_of_manufacturing_doc', formData.details_of_manufacturing_doc, formData.landallotment_id, VALUE_SEVEN);
            }

            if (formData.if_backward_class_bac_doc != '') {
                that.showDocument('if_backward_class_bac_doc_container_for_landallotment', 'if_backward_class_bac_doc_name_image_for_landallotment', 'if_backward_class_bac_doc_name_container_for_landallotment',
                        'if_backward_class_bac_doc_download', 'if_backward_class_bac_doc', formData.if_backward_class_bac_doc, formData.landallotment_id, VALUE_EIGHT);
            }
            if (formData.if_backward_class_scst_doc != '') {
                that.showDocument('if_backward_class_scst_doc_container_for_landallotment', 'if_backward_class_scst_doc_name_image_for_landallotment', 'if_backward_class_scst_doc_name_container_for_landallotment',
                        'if_backward_class_scst_doc_download', 'if_backward_class_scst_doc', formData.if_backward_class_scst_doc, formData.landallotment_id, VALUE_NINE);
            }
            if (formData.if_backward_class_ex_serv_doc != '') {
                that.showDocument('if_backward_class_ex_serv_doc_container_for_landallotment', 'if_backward_class_ex_serv_doc_name_image_for_landallotment', 'if_backward_class_ex_serv_doc_name_container_for_landallotment',
                        'if_backward_class_ex_serv_doc_download', 'if_backward_class_ex_serv_doc', formData.if_backward_class_ex_serv_doc, formData.landallotment_id, VALUE_TEN);
            }
            if (formData.if_backward_class_wm_doc != '') {
                that.showDocument('if_backward_class_wm_doc_container_for_landallotment', 'if_backward_class_wm_doc_name_image_for_landallotment', 'if_backward_class_wm_doc_name_container_for_landallotment',
                        'if_backward_class_wm_doc_download', 'if_backward_class_wm_doc', formData.if_backward_class_wm_doc, formData.landallotment_id, VALUE_ELEVEN);
            }
            if (formData.if_backward_class_ph_doc != '') {
                that.showDocument('if_backward_class_ph_doc_container_for_landallotment', 'if_backward_class_ph_doc_name_image_for_landallotment', 'if_backward_class_ph_doc_name_container_for_landallotment',
                        'if_backward_class_ph_doc_download', 'if_backward_class_ph_doc', formData.if_backward_class_ph_doc, formData.landallotment_id, VALUE_TWELVE);
            }
            if (formData.if_belonging_transg_doc != '') {
                that.showDocument('if_belonging_transg_doc_container_for_landallotment', 'if_belonging_transg_doc_name_image_for_landallotment', 'if_belonging_transg_doc_name_container_for_landallotment',
                        'if_belonging_transg_doc_download', 'if_belonging_transg_doc', formData.if_belonging_transg_doc, formData.landallotment_id, VALUE_THIRTEEN);
            }
            if (formData.bonafide_of_dnh_doc != '') {
                that.showDocument('bonafide_of_dnh_doc_container_for_landallotment', 'bonafide_of_dnh_doc_name_image_for_landallotment', 'bonafide_of_dnh_doc_name_container_for_landallotment',
                        'bonafide_of_dnh_doc_download', 'bonafide_of_dnh_doc', formData.bonafide_of_dnh_doc, formData.landallotment_id, VALUE_FOURTEEN);
            }

            if (formData.information_raw_materials_doc != '') {
                that.showDocument('information_raw_materials_doc_container_for_landallotment', 'information_raw_materials_doc_name_image_for_landallotment', 'information_raw_materials_doc_name_container_for_landallotment',
                        'information_raw_materials_doc_download', 'information_raw_materials_doc', formData.information_raw_materials_doc, formData.landallotment_id, VALUE_FIFTEEN);
            }
            if (formData.infrastructure_requirement_doc != '') {
                that.showDocument('infrastructure_requirement_doc_container_for_landallotment', 'infrastructure_requirement_doc_name_image_for_landallotment', 'infrastructure_requirement_doc_name_container_for_landallotment',
                        'infrastructure_requirement_doc_download', 'infrastructure_requirement_doc', formData.infrastructure_requirement_doc, formData.landallotment_id, VALUE_SIXTEEN);
            }
            if (formData.effluent_teratment_doc != '') {
                that.showDocument('effluent_teratment_doc_container_for_landallotment', 'effluent_teratment_doc_name_image_for_landallotment', 'effluent_teratment_doc_name_container_for_landallotment',
                        'effluent_teratment_doc_download', 'effluent_teratment_doc', formData.effluent_teratment_doc, formData.landallotment_id, VALUE_SEVENTEEN);
            }
            if (formData.emission_of_gases_doc != '') {
                that.showDocument('emission_of_gases_doc_container_for_landallotment', 'emission_of_gases_doc_name_image_for_landallotment', 'emission_of_gases_doc_name_container_for_landallotment',
                        'emission_of_gases_doc_download', 'emission_of_gases_doc', formData.emission_of_gases_doc, formData.landallotment_id, VALUE_EIGHTEEN);
            }
            if (formData.copy_authority_letter_doc != '') {
                that.showDocument('copy_authority_letter_doc_container_for_landallotment', 'copy_authority_letter_doc_name_image_for_landallotment', 'copy_authority_letter_doc_name_container_for_landallotment',
                        'copy_authority_letter_doc_download', 'copy_authority_letter_doc', formData.copy_authority_letter_doc, formData.landallotment_id, VALUE_NINETEEN);
            }
            if (formData.copy_project_profile_doc != '') {
                that.showDocument('copy_project_profile_doc_container_for_landallotment', 'copy_project_profile_doc_name_image_for_landallotment', 'copy_project_profile_doc_name_container_for_landallotment',
                        'copy_project_profile_doc_download', 'copy_project_profile_doc', formData.copy_project_profile_doc, formData.landallotment_id, VALUE_TWENTY);
            }
            if (formData.demand_of_deposit_draft != '') {
                that.showDocument('demand_of_deposit_draft_container_for_landallotment', 'demand_of_deposit_draft_name_image_for_landallotment', 'demand_of_deposit_draft_name_container_for_landallotment',
                        'demand_of_deposit_draft_download', 'demand_of_deposit_draft', formData.demand_of_deposit_draft, formData.landallotment_id, VALUE_TWENTYONE);
            }

            if (formData.copy_proposed_land_doc != '') {
                that.showDocument('copy_proposed_land_doc_container_for_landallotment', 'copy_proposed_land_doc_name_image_for_landallotment', 'copy_proposed_land_doc_name_container_for_landallotment',
                        'copy_proposed_land_doc_download', 'copy_proposed_land_doc', formData.copy_proposed_land_doc, formData.landallotment_id, VALUE_TWENTYTWO);
            }
            if (formData.copy_of_partnership_deed_doc != '') {
                that.showDocument('copy_of_partnership_deed_doc_container_for_landallotment', 'copy_of_partnership_deed_doc_name_image_for_landallotment', 'copy_of_partnership_deed_doc_name_container_for_landallotment',
                        'copy_of_partnership_deed_doc_download', 'copy_of_partnership_deed_doc', formData.copy_of_partnership_deed_doc, formData.landallotment_id, VALUE_TWENTYTHREE);
            }
            if (formData.relevant_experience_doc != '') {
                that.showDocument('relevant_experience_doc_container_for_landallotment', 'relevant_experience_doc_name_image_for_landallotment', 'relevant_experience_doc_name_container_for_landallotment',
                        'relevant_experience_doc_download', 'relevant_experience_doc', formData.relevant_experience_doc, formData.landallotment_id, VALUE_TWENTYFOUR);
            }
            if (formData.certy_by_direc_indus_doc != '') {
                that.showDocument('certy_by_direc_indus_doc_container_for_landallotment', 'certy_by_direc_indus_doc_name_image_for_landallotment', 'certy_by_direc_indus_doc_name_container_for_landallotment',
                        'certy_by_direc_indus_doc_download', 'certy_by_direc_indus_doc', formData.certy_by_direc_indus_doc, formData.landallotment_id, VALUE_TWENTYFIVE);
            }
            if (formData.other_relevant_doc != '') {
                that.showDocument('other_relevant_doc_container_for_landallotment', 'other_relevant_doc_name_image_for_landallotment', 'other_relevant_doc_name_container_for_landallotment',
                        'other_relevant_doc_download', 'other_relevant_doc', formData.other_relevant_doc, formData.landallotment_id, VALUE_TWENTYSIX);
            }
            if (formData.signature != '') {
                that.showDocument('seal_and_stamp_container_for_landallotment', 'seal_and_stamp_name_image_for_landallotment', 'seal_and_stamp_name_container_for_landallotment',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.signature, formData.landallotment_id, VALUE_TWENTYSEVEN);
            }




        }
        generateSelect2();
        datePicker();
        $('#landallotment_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitLandallotment($('#submit_btn_for_landallotment'));
            }
        });
    },
    editOrViewLandallotment: function (btnObj, landallotmentId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!landallotmentId) {
            showError(invalidUserValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'landallotment/get_landallotment_data_by_id',
            type: 'post',
            data: $.extend({}, {'landallotment_id': landallotmentId}, getTokenData()),
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
                    that.newLandallotmentForm(isEdit, parseData);
                } else {
                    that.viewLandallotmentForm(parseData);
                }
            }
        });
    },
    viewLandallotmentForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.landallotment_data;
        Landallotment.router.navigate('view_landallotment_form');
        formData.establishment_date = dateTo_DD_MM_YYYY(formData.establishment_date);
        formData.registration_date = dateTo_DD_MM_YYYY(formData.registration_date);
        formData.license_application_date = dateTo_DD_MM_YYYY(formData.license_application_date);
        formData.application_date = dateTo_DD_MM_YYYY(formData.application_date);
        formData.VALUE_ONE = VALUE_ONE;
        formData.VALUE_TWO = VALUE_TWO;
        formData.VALUE_THREE = VALUE_THREE;
        formData.VALUE_FOUR = VALUE_FOUR;
        formData.VALUE_FIVE = VALUE_FIVE;
        formData.VALUE_SIX = VALUE_SIX;
        formData.IS_CHECKED_YES = IS_CHECKED_YES;
        formData.IS_CHECKED_NO = IS_CHECKED_NO;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#landallotment_form_and_datatable_container').html(landallotmentViewTemplate(formData));

        $('#constitution_artical').val(formData.constitution_artical);
        that.getConstitution(constitution_artical);
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(tempVillagesData, 'villages_for_noc_data', 'village_id', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForPlot([], 'plot_no_for_landallotment_data', 'plot_no', 'plot_no', 'Plot No');

        $('#villages_for_noc_data').val(formData.village == 0 ? '' : formData.village);
        var plotData = tempPlotData[formData.village] ? tempPlotData[formData.village] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForPlot(plotData, 'plot_no_for_landallotment_data', 'plot_id', 'plot_no', 'Plot No');
        $('#plot_no_for_landallotment_data').val(formData.plot_no == 0 ? '' : formData.plot_no);

        $('#declaration').attr('checked', 'checked');

        // $('#application_category').val(formData.application_category);
        $('#villages_for_noc_data').val(formData.village);
        $('#expansion_industry').val(formData.expansion_industry);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.industrial_license_necessary == isChecked) {
            $('#industrial_license_necessary').attr('checked', 'checked');
        }

        if (formData.obtained_letter_of_intent == isChecked) {
            $('#obtained_letter_of_intent').attr('checked', 'checked');
            this.$('.obtained_letter_of_intent_div').show();
        }
        if (formData.regist_letter_msme == isChecked) {
            $('#regist_letter_msme').attr('checked', 'checked');
            this.$('.regist_letter_msme_div').show();
        }

        if (formData.if_project_collaboration == isChecked) {
            $('#if_project_collaboration').attr('checked', 'checked');
            this.$('.if_project_collaboration_div').show();
        }

        if (formData.if_project_requires_import == isChecked) {
            $('#if_project_requires_import').attr('checked', 'checked');
            this.$('.if_project_requires_import_div').show();
        }

        if (formData.no_of_persons_likely_emp == isChecked) {
            $('#no_of_persons_likely_emp').attr('checked', 'checked');
            this.$('.no_of_persons_likely_emp_div').show();
        }
        if (formData.no_of_persons_likely_emp_unskilled == isChecked) {
            $('#no_of_persons_likely_emp_unskilled').attr('checked', 'checked');
            this.$('.no_of_persons_likely_emp_unskilled_div').show();
        }
        if (formData.no_of_persons_likely_emp_staff == isChecked) {
            $('#no_of_persons_likely_emp_staff').attr('checked', 'checked');
            this.$('.no_of_persons_likely_emp_staff_div').show();
        }
        if (formData.if_backward_class_bac == isChecked) {
            $('#if_backward_class_bac').attr('checked', 'checked');
            this.$('.if_backward_class_bac_div').show();
        }
        if (formData.if_backward_class_scst == isChecked) {
            $('#if_backward_class_scst').attr('checked', 'checked');
            this.$('.if_backward_class_scst_div').show();
        }
        if (formData.if_backward_class_ex_serv == isChecked) {
            $('#if_backward_class_ex_serv').attr('checked', 'checked');
            this.$('.if_backward_class_ex_serv_div').show();
        }
        if (formData.if_backward_class_wm == isChecked) {
            $('#if_backward_class_wm').attr('checked', 'checked');
            this.$('.if_backward_class_wm_div').show();
        }
        if (formData.if_backward_class_ph == isChecked) {
            $('#if_backward_class_ph').attr('checked', 'checked');
            this.$('.if_backward_class_ph_div').show();
        }

        if (formData.if_belonging_transg == isChecked) {
            $('#if_belonging_transg').attr('checked', 'checked');
            this.$('.if_belonging_transg_div').show();
        }
        if (formData.if_belonging_other == isChecked) {
            $('#if_belonging_other').attr('checked', 'checked');
        }

        if (formData.if_bonafide == IS_CHECKED_YES) {
            $('#if_bonafide_yes').attr('checked', 'checked');
            $('.if_bonafide_div').show();
        } else if (formData.if_bonafide == IS_CHECKED_NO) {
            $('#if_bonafide_no').attr('checked', 'checked');
        }

        if (formData.ifnot_state_particular_place == IS_CHECKED_YES) {
            $('#ifnot_state_particular_place_yes').attr('checked', 'checked');
            $('.ifnot_state_particular_place_div').show();
        } else if (formData.ifnot_state_particular_place == IS_CHECKED_NO) {
            $('#ifnot_state_particular_place_no').attr('checked', 'checked');
        }

        if (formData.if_promotion_council == IS_CHECKED_YES) {
            $('#if_promotion_council_yes').attr('checked', 'checked');
            $('.if_promotion_council_div').show();
        } else if (formData.if_promotion_council == IS_CHECKED_NO) {
            $('#if_promotion_council_no').attr('checked', 'checked');
        }

        if (formData.bio_data_doc != '') {
            that.showDocument('bio_data_doc_container_for_landallotment', 'bio_data_doc_name_image_for_landallotment', 'bio_data_doc_name_container_for_landallotment',
                    'bio_data_doc_download', 'bio_data_doc', formData.bio_data_doc);
        }
        if (formData.constitution_artical_doc != '') {
            that.showDocument('constitution_artical_doc_container_for_landallotment', 'constitution_artical_doc_name_image_for_landallotment', 'constitution_artical_doc_name_container_for_landallotment',
                    'constitution_artical_doc_download', 'constitution_artical_doc', formData.constitution_artical_doc);
        }
        if (formData.obtained_letter_of_intent_doc != '') {
            that.showDocument('obtained_letter_of_intent_doc_container_for_landallotment', 'obtained_letter_of_intent_doc_name_image_for_landallotment', 'obtained_letter_of_intent_doc_name_container_for_landallotment',
                    'obtained_letter_of_intent_doc_download', 'obtained_letter_of_intent_doc', formData.obtained_letter_of_intent_doc);
        }
        if (formData.regist_letter_msme_doc != '') {
            that.showDocument('regist_letter_msme_doc_container_for_landallotment', 'regist_letter_msme_doc_name_image_for_landallotment', 'regist_letter_msme_doc_name_container_for_landallotment',
                    'regist_letter_msme_doc_download', 'regist_letter_msme_doc', formData.regist_letter_msme_doc);
        }
        if (formData.detailed_project_report_doc != '') {
            that.showDocument('detailed_project_report_doc_container_for_landallotment', 'detailed_project_report_doc_name_image_for_landallotment', 'detailed_project_report_doc_name_container_for_landallotment',
                    'detailed_project_report_doc_download', 'detailed_project_report_doc', formData.detailed_project_report_doc);
        }
        if (formData.proposed_finance_terms_doc != '') {
            that.showDocument('proposed_finance_terms_doc_container_for_landallotment', 'proposed_finance_terms_doc_name_image_for_landallotment', 'proposed_finance_terms_doc_name_container_for_landallotment',
                    'proposed_finance_terms_doc_download', 'proposed_finance_terms_doc', formData.proposed_finance_terms_doc);
        }
        if (formData.details_of_manufacturing_doc != '') {
            that.showDocument('details_of_manufacturing_doc_container_for_landallotment', 'details_of_manufacturing_doc_name_image_for_landallotment', 'details_of_manufacturing_doc_name_container_for_landallotment',
                    'details_of_manufacturing_doc_download', 'details_of_manufacturing_doc', formData.details_of_manufacturing_doc);
        }

        if (formData.if_backward_class_bac_doc != '') {
            that.showDocument('if_backward_class_bac_doc_container_for_landallotment', 'if_backward_class_bac_doc_name_image_for_landallotment', 'if_backward_class_bac_doc_name_container_for_landallotment',
                    'if_backward_class_bac_doc_download', 'if_backward_class_bac_doc', formData.if_backward_class_bac_doc);
        }
        if (formData.if_backward_class_scst_doc != '') {
            that.showDocument('if_backward_class_scst_doc_container_for_landallotment', 'if_backward_class_scst_doc_name_image_for_landallotment', 'if_backward_class_scst_doc_name_container_for_landallotment',
                    'if_backward_class_scst_doc_download', 'if_backward_class_scst_doc', formData.if_backward_class_scst_doc);
        }
        if (formData.if_backward_class_ex_serv_doc != '') {
            that.showDocument('if_backward_class_ex_serv_doc_container_for_landallotment', 'if_backward_class_ex_serv_doc_name_image_for_landallotment', 'if_backward_class_ex_serv_doc_name_container_for_landallotment',
                    'if_backward_class_ex_serv_doc_download', 'if_backward_class_ex_serv_doc', formData.if_backward_class_ex_serv_doc);
        }
        if (formData.if_backward_class_wm_doc != '') {
            that.showDocument('if_backward_class_wm_doc_container_for_landallotment', 'if_backward_class_wm_doc_name_image_for_landallotment', 'if_backward_class_wm_doc_name_container_for_landallotment',
                    'if_backward_class_wm_doc_download', 'if_backward_class_wm_doc', formData.if_backward_class_wm_doc);
        }
        if (formData.if_backward_class_ph_doc != '') {
            that.showDocument('if_backward_class_ph_doc_container_for_landallotment', 'if_backward_class_ph_doc_name_image_for_landallotment', 'if_backward_class_ph_doc_name_container_for_landallotment',
                    'if_backward_class_ph_doc_download', 'if_backward_class_ph_doc', formData.if_backward_class_ph_doc);
        }
        if (formData.if_belonging_transg_doc != '') {
            that.showDocument('if_belonging_transg_doc_container_for_landallotment', 'if_belonging_transg_doc_name_image_for_landallotment', 'if_belonging_transg_doc_name_container_for_landallotment',
                    'if_belonging_transg_doc_download', 'if_belonging_transg_doc', formData.if_belonging_transg_doc);
        }
        if (formData.bonafide_of_dnh_doc != '') {
            that.showDocument('bonafide_of_dnh_doc_container_for_landallotment', 'bonafide_of_dnh_doc_name_image_for_landallotment', 'bonafide_of_dnh_doc_name_container_for_landallotment',
                    'bonafide_of_dnh_doc_download', 'bonafide_of_dnh_doc', formData.bonafide_of_dnh_doc);
        }

        if (formData.information_raw_materials_doc != '') {
            that.showDocument('information_raw_materials_doc_container_for_landallotment', 'information_raw_materials_doc_name_image_for_landallotment', 'information_raw_materials_doc_name_container_for_landallotment',
                    'information_raw_materials_doc_download', 'information_raw_materials_doc', formData.information_raw_materials_doc);
        }
        if (formData.infrastructure_requirement_doc != '') {
            that.showDocument('infrastructure_requirement_doc_container_for_landallotment', 'infrastructure_requirement_doc_name_image_for_landallotment', 'infrastructure_requirement_doc_name_container_for_landallotment',
                    'infrastructure_requirement_doc_download', 'infrastructure_requirement_doc', formData.infrastructure_requirement_doc);
        }
        if (formData.effluent_teratment_doc != '') {
            that.showDocument('effluent_teratment_doc_container_for_landallotment', 'effluent_teratment_doc_name_image_for_landallotment', 'effluent_teratment_doc_name_container_for_landallotment',
                    'effluent_teratment_doc_download', 'effluent_teratment_doc', formData.effluent_teratment_doc);
        }
        if (formData.emission_of_gases_doc != '') {
            that.showDocument('emission_of_gases_doc_container_for_landallotment', 'emission_of_gases_doc_name_image_for_landallotment', 'emission_of_gases_doc_name_container_for_landallotment',
                    'emission_of_gases_doc_download', 'emission_of_gases_doc', formData.emission_of_gases_doc);
        }
        if (formData.copy_authority_letter_doc != '') {
            that.showDocument('copy_authority_letter_doc_container_for_landallotment', 'copy_authority_letter_doc_name_image_for_landallotment', 'copy_authority_letter_doc_name_container_for_landallotment',
                    'copy_authority_letter_doc_download', 'copy_authority_letter_doc', formData.copy_authority_letter_doc);
        }
        if (formData.copy_project_profile_doc != '') {
            that.showDocument('copy_project_profile_doc_container_for_landallotment', 'copy_project_profile_doc_name_image_for_landallotment', 'copy_project_profile_doc_name_container_for_landallotment',
                    'copy_project_profile_doc_download', 'copy_project_profile_doc', formData.copy_project_profile_doc);
        }
        if (formData.demand_of_deposit_draft != '') {
            that.showDocument('demand_of_deposit_draft_container_for_landallotment', 'demand_of_deposit_draft_name_image_for_landallotment', 'demand_of_deposit_draft_name_container_for_landallotment',
                    'demand_of_deposit_draft_download', 'demand_of_deposit_draft', formData.demand_of_deposit_draft);
        }
        if (formData.copy_proposed_land_doc != '') {
            that.showDocument('copy_proposed_land_doc_container_for_landallotment', 'copy_proposed_land_doc_name_image_for_landallotment', 'copy_proposed_land_doc_name_container_for_landallotment',
                    'copy_proposed_land_doc_download', 'copy_proposed_land_doc', formData.copy_proposed_land_doc);
        }
        if (formData.copy_of_partnership_deed_doc != '') {
            that.showDocument('copy_of_partnership_deed_doc_container_for_landallotment', 'copy_of_partnership_deed_doc_name_image_for_landallotment', 'copy_of_partnership_deed_doc_name_container_for_landallotment',
                    'copy_of_partnership_deed_doc_download', 'copy_of_partnership_deed_doc', formData.copy_of_partnership_deed_doc);
        }
        if (formData.relevant_experience_doc != '') {
            that.showDocument('relevant_experience_doc_container_for_landallotment', 'relevant_experience_doc_name_image_for_landallotment', 'relevant_experience_doc_name_container_for_landallotment',
                    'relevant_experience_doc_download', 'relevant_experience_doc', formData.relevant_experience_doc);
        }
        if (formData.certy_by_direc_indus_doc != '') {
            that.showDocument('certy_by_direc_indus_doc_container_for_landallotment', 'certy_by_direc_indus_doc_name_image_for_landallotment', 'certy_by_direc_indus_doc_name_container_for_landallotment',
                    'certy_by_direc_indus_doc_download', 'certy_by_direc_indus_doc', formData.certy_by_direc_indus_doc);
        }
        if (formData.other_relevant_doc != '') {
            that.showDocument('other_relevant_doc_container_for_landallotment', 'other_relevant_doc_name_image_for_landallotment', 'other_relevant_doc_name_container_for_landallotment',
                    'other_relevant_doc_download', 'other_relevant_doc', formData.other_relevant_doc);
        }
        if (formData.signature != '') {
            that.showDocument('seal_and_stamp_container_for_landallotment', 'seal_and_stamp_name_image_for_landallotment', 'seal_and_stamp_name_container_for_landallotment',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.signature);
        }







        var cnt = 1;
        var proprietorInfo = JSON.parse(formData.proprietor_details);
        $.each(proprietorInfo, function (key, value) {
            that.addMultipleProprietor(value);
            $('#applicant_type_' + cnt).val(value.applicant_type);
        })
    },
    checkValidationForLandallotment: function (landallotmentData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!landallotmentData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant', applicantNameValidationMessage);
        }
        if (!landallotmentData.applicant_address) {
            return getBasicMessageAndFieldJSONArray('applicant_address', applicantAddressValidationMessage);
        }
        if (!landallotmentData.email) {
            return getBasicMessageAndFieldJSONArray('email', emailValidationMessage);
        }
        if (!landallotmentData.telehpone_no) {
            return getBasicMessageAndFieldJSONArray('telehpone_no', telephoneNoValidationMessage);
        }
        if (!landallotmentData.villages_for_noc_data) {
            return getBasicMessageAndFieldJSONArray('villages_for_noc_data', villageNameValidationMessage);
        }
        if (!landallotmentData.plot_no_for_landallotment_data) {
            return getBasicMessageAndFieldJSONArray('plot_no_for_landallotment_data', plotnoValidationMessage);
        }
        if (!landallotmentData.constitution_artical) {
            return getBasicMessageAndFieldJSONArray('constitution_artical', reasonofloanValidationMessage);
        }
        if (!landallotmentData.expansion_industry) {
            return getBasicMessageAndFieldJSONArray('expansion_industry', expansionIndustryValidationMessage);
        }
        if (!landallotmentData.nature_of_industry) {
            return getBasicMessageAndFieldJSONArray('nature_of_industry', natureOfIndustryValidationMessage);
        }
        if (!landallotmentData.possession_of_industry_plot) {
            return getBasicMessageAndFieldJSONArray('possession_of_industry_plot', possessionOfIndustryValidationMessage);
        }
        if (!landallotmentData.detail_of_space) {
            return getBasicMessageAndFieldJSONArray('detail_of_space', detailValidationMessage);
        }
        if (!landallotmentData.treatment_indicate) {
            return getBasicMessageAndFieldJSONArray('treatment_indicate', detailValidationMessage);
        }
        if (!landallotmentData.detail_of_emission_of_gases) {
            return getBasicMessageAndFieldJSONArray('detail_of_emission_of_gases', detailValidationMessage);
        }

        if (!landallotmentData.no_of_persons_likely_emp == isChecked && !landallotmentData.no_of_persons_likely_emp_unskilled == isChecked && !landallotmentData.no_of_persons_likely_emp_staff == isChecked) {
            $('#no_of_persons_likely_emp_staff').focus();
            return getBasicMessageAndFieldJSONArray('no_of_persons_likely_emp_staff', noOfPersonsLiklyEmpValidationMessage);
        }

        if (!landallotmentData.if_backward_class_bac == isChecked && !landallotmentData.if_backward_class_scst == isChecked && !landallotmentData.if_backward_class_ex_serv == isChecked && !landallotmentData.if_backward_class_wm == isChecked && !landallotmentData.if_backward_class_ph == isChecked && !landallotmentData.if_belonging_transg == isChecked && !landallotmentData.if_belonging_other == isChecked) {
            $('#if_belonging_other').focus();
            return getBasicMessageAndFieldJSONArray('if_belonging_other', socialStatusValidationMessage);
        }

        var if_bonafide = $('input[name=if_bonafide]:checked').val();
        if (if_bonafide == '' || if_bonafide == null) {
            $('#if_bonafide_yes').focus();
            return getBasicMessageAndFieldJSONArray('if_bonafide', reasonofloanValidationMessage);
        }

        var ifnot_state_particular_place = $('input[name=ifnot_state_particular_place]:checked').val();
        if (ifnot_state_particular_place == '' || ifnot_state_particular_place == null) {
            $('#ifnot_state_particular_place_yes').focus();
            return getBasicMessageAndFieldJSONArray('ifnot_state_particular_place', reasonofloanValidationMessage);
        }

        var if_promotion_council = $('input[name=if_promotion_council]:checked').val();
        if (if_promotion_council == '' || if_promotion_council == null) {
            $('#if_promotion_council_yes').focus();
            return getBasicMessageAndFieldJSONArray('if_promotion_council', reasonofloanValidationMessage);
        }

        return '';
    },
    askForSubmitLandallotment: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Landallotment.listview.submitLandallotment(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitLandallotment: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var landallotmentData = $('#landallotment_form').serializeFormJSON();
        var validationData = that.checkValidationForLandallotment(landallotmentData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('landallotment-' + validationData.field, validationData.message);
            return false;
        }

        var proprietorInfoItem = [];
        var isproprietorValidation = false;

        $('.landallot_proprietor_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var proprietorInfo = {};
            var Name = $('#name_' + cnt).val();
            if (Name == '' || Name == null) {
                $('#name_' + cnt).focus();
                validationMessageShow('landallotment-' + cnt, applicantNameValidationMessage);
                isproprietorValidation = true;
                return false;
            }
            proprietorInfo.name = Name;

            var address = $('#address_' + cnt).val();
            if (address == '' || address == null) {
                $('#address_' + cnt).focus();
                validationMessageShow('landallotment-' + cnt, applicantAddressValidationMessage);
                isproprietorValidation = true;
                return false;
            }
            proprietorInfo.address = address;

            var ApplicantType = $('#applicant_type_' + cnt).val();
            if (ApplicantType == '' || ApplicantType == null) {
                $('#applicant_type_' + cnt).focus();
                validationMessageShow('landallotment-' + cnt, applicantTypeValidationMessage);
                isproprietorValidation = true;
                return false;
            }
            proprietorInfo.applicant_type = ApplicantType;
            proprietorInfoItem.push(proprietorInfo);
        });


        if (isproprietorValidation) {
            return false;
        }

        if ($('#bio_data_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('bio_data_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if (landallotmentData.constitution_artical == isChecked) {
            if ($('#constitution_artical_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('constitution_artical_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }

        if (landallotmentData.obtained_letter_of_intent == isChecked) {
            if ($('#obtained_letter_of_intent_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('obtained_letter_of_intent_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }

        if (landallotmentData.regist_letter_msme == isChecked) {
            if ($('#regist_letter_msme_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('regist_letter_msme_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }

        if ($('#detailed_project_report_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('detailed_project_report_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if ($('#proposed_finance_terms_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('proposed_finance_terms_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if ($('#details_of_manufacturing_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('details_of_manufacturing_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if (landallotmentData.if_backward_class_bac == isChecked) {
            if ($('#if_backward_class_bac_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('if_backward_class_bac_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }
        if (landallotmentData.if_backward_class_scst == isChecked) {
            if ($('#if_backward_class_scst_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('if_backward_class_scst_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }

        if (landallotmentData.if_backward_class_ex_serv == isChecked) {
            if ($('#if_backward_class_ex_serv_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('if_backward_class_ex_serv_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }
        if (landallotmentData.if_backward_class_wm == isChecked) {
            if ($('#if_backward_class_wm_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('if_backward_class_wm_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }
        if (landallotmentData.if_backward_class_ph == isChecked) {
            if ($('#if_backward_class_ph_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('if_backward_class_ph_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }

        if (landallotmentData.if_belonging_transg == isChecked) {
            if ($('#if_belonging_transg_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('if_belonging_transg_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }

        if (landallotmentData.if_bonafide == isChecked) {
            if ($('#bonafide_of_dnh_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('bonafide_of_dnh_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }

        if ($('#information_raw_materials_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('information_raw_materials_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if ($('#infrastructure_requirement_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('infrastructure_requirement_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if ($('#effluent_teratment_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('effluent_teratment_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#emission_of_gases_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('emission_of_gases_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_authority_letter_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('copy_authority_letter_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_project_profile_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('copy_project_profile_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if ($('#demand_of_deposit_draft_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('demand_of_deposit_draft_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if ($('#copy_proposed_land_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('copy_proposed_land_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_of_partnership_deed_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('copy_of_partnership_deed_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#relevant_experience_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('relevant_experience_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if (landallotmentData.if_promotion_council == isChecked) {
            if ($('#certy_by_direc_indus_doc_container_for_landallotment').is(':visible')) {
                var copyOfRegistration = checkValidationForDocument('certy_by_direc_indus_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
                if (copyOfRegistration == false) {
                    return false;
                }
            }
        }
        if ($('#other_relevant_doc_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('other_relevant_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_container_for_landallotment').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('seal_and_stamp_for_landallotment', VALUE_TWO, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }

        if (!$('#declaration').is(':checked')) {
            $('#declaration').focus();
            validationMessageShow('landallotment-declaration', declarationOneValidationMessage);
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_landallotment') : $('#submit_btn_for_landallotment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var landallotmentData = new FormData($('#landallotment_form')[0]);
        landallotmentData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        landallotmentData.append("proprietor_data", JSON.stringify(proprietorInfoItem));
        landallotmentData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'landallotment/submit_landallotment',
            data: landallotmentData,
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
                validationMessageShow('landallotment', textStatus.statusText);
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
                    validationMessageShow('landallotment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Landallotment.router.navigate('landallotment', {'trigger': true});
            }
        });
    },

    askForRemove: function (landallotmentId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!landallotmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Landallotment.listview.removeDocument(\'' + landallotmentId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (landallotmentId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!landallotmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'landallotment/remove_document',
            data: $.extend({}, {'landallotment_id': landallotmentId, 'document_type': docType}, getTokenData()),
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
                validationMessageShow('landallotment', textStatus.statusText);
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
                    validationMessageShow('landallotment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);

                if (docType == VALUE_ONE) {
                    removeDocumentValue('bio_data_doc_name_container_for_landallotment', 'bio_data_doc_name_image_for_landallotment', 'bio_data_doc_container_for_landallotment', 'bio_data_doc_for_landallotment');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('constitution_artical_doc_name_container_for_landallotment', 'constitution_artical_doc_name_image_for_landallotment', 'constitution_artical_doc_container_for_landallotment', 'constitution_artical_doc_for_landallotment');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('obtained_letter_of_intent_doc_name_container_for_landallotment', 'obtained_letter_of_intent_doc_name_image_for_landallotment', 'obtained_letter_of_intent_doc_container_for_landallotment', 'obtained_letter_of_intent_doc_for_landallotment');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('regist_letter_msme_doc_name_container_for_landallotment', 'regist_letter_msme_doc_name_image_for_landallotment', 'regist_letter_msme_doc_container_for_landallotment', 'regist_letter_msme_doc_for_landallotment');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('detailed_project_report_doc_name_container_for_landallotment', 'detailed_project_report_doc_name_image_for_landallotment', 'detailed_project_report_doc_container_for_landallotment', 'detailed_project_report_doc_for_landallotment');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('proposed_finance_terms_doc_name_container_for_landallotment', 'proposed_finance_terms_doc_name_image_for_landallotment', 'proposed_finance_terms_doc_container_for_landallotment', 'proposed_finance_terms_doc_for_landallotment');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('details_of_manufacturing_doc_name_container_for_landallotment', 'details_of_manufacturing_doc_name_image_for_landallotment', 'details_of_manufacturing_doc_container_for_landallotment', 'details_of_manufacturing_doc_for_landallotment');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('if_backward_class_bac_doc_name_container_for_landallotment', 'if_backward_class_bac_doc_name_image_for_landallotment', 'if_backward_class_bac_doc_container_for_landallotment', 'if_backward_class_bac_doc_for_landallotment');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('if_backward_class_scst_doc_name_container_for_landallotment', 'if_backward_class_scst_doc_name_image_for_landallotment', 'if_backward_class_scst_doc_container_for_landallotment', 'if_backward_class_scst_doc_for_landallotment');
                }
                if (docType == VALUE_TEN) {
                    removeDocumentValue('if_backward_class_ex_serv_doc_name_container_for_landallotment', 'if_backward_class_ex_serv_doc_name_image_for_landallotment', 'if_backward_class_ex_serv_doc_container_for_landallotment', 'if_backward_class_ex_serv_doc_for_landallotment');
                }
                if (docType == VALUE_ELEVEN) {
                    removeDocumentValue('if_backward_class_wm_doc_name_container_for_landallotment', 'if_backward_class_wm_doc_name_image_for_landallotment', 'if_backward_class_wm_doc_container_for_landallotment', 'if_backward_class_wm_doc_for_landallotment');
                }
                if (docType == VALUE_TWELVE) {
                    removeDocumentValue('if_backward_class_ph_doc_name_container_for_landallotment', 'if_backward_class_ph_doc_name_image_for_landallotment', 'if_backward_class_ph_doc_container_for_landallotment', 'if_backward_class_ph_doc_for_landallotment');
                }
                if (docType == VALUE_THIRTEEN) {
                    removeDocumentValue('if_belonging_transg_doc_name_container_for_landallotment', 'if_belonging_transg_doc_name_image_for_landallotment', 'if_belonging_transg_doc_container_for_landallotment', 'if_belonging_transg_doc_for_landallotment');
                }
                if (docType == VALUE_FOURTEEN) {
                    removeDocumentValue('bonafide_of_dnh_doc_name_container_for_landallotment', 'bonafide_of_dnh_doc_name_image_for_landallotment', 'bonafide_of_dnh_doc_container_for_landallotment', 'bonafide_of_dnh_doc_for_landallotment');
                }
                if (docType == VALUE_FIFTEEN) {
                    removeDocumentValue('information_raw_materials_doc_name_container_for_landallotment', 'information_raw_materials_doc_name_image_for_landallotment', 'information_raw_materials_doc_container_for_landallotment', 'information_raw_materials_doc_for_landallotment');
                }
                if (docType == VALUE_SIXTEEN) {
                    removeDocumentValue('infrastructure_requirement_doc_name_container_for_landallotment', 'infrastructure_requirement_doc_name_image_for_landallotment', 'infrastructure_requirement_doc_container_for_landallotment', 'infrastructure_requirement_doc_for_landallotment');
                }
                if (docType == VALUE_SEVENTEEN) {
                    removeDocumentValue('effluent_teratment_doc_name_container_for_landallotment', 'effluent_teratment_doc_name_image_for_landallotment', 'effluent_teratment_doc_container_for_landallotment', 'effluent_teratment_doc_for_landallotment');
                }

                if (docType == VALUE_EIGHTEEN) {
                    removeDocumentValue('emission_of_gases_doc_name_container_for_landallotment', 'emission_of_gases_doc_name_image_for_landallotment', 'emission_of_gases_doc_container_for_landallotment', 'emission_of_gases_doc_for_landallotment');
                }
                if (docType == VALUE_NINETEEN) {
                    removeDocumentValue('copy_authority_letter_doc_name_container_for_landallotment', 'copy_authority_letter_doc_name_image_for_landallotment', 'copy_authority_letter_doc_container_for_landallotment', 'copy_authority_letter_doc_for_landallotment');
                }
                if (docType == VALUE_TWENTY) {
                    removeDocumentValue('copy_project_profile_doc_name_container_for_landallotment', 'copy_project_profile_doc_name_image_for_landallotment', 'copy_project_profile_doc_container_for_landallotment', 'copy_project_profile_doc_for_landallotment');
                }
                if (docType == VALUE_TWENTYONE) {
                    removeDocumentValue('demand_of_deposit_draft_name_container_for_landallotment', 'demand_of_deposit_draft_name_image_for_landallotment', 'demand_of_deposit_draft_container_for_landallotment', 'demand_of_deposit_draft_for_landallotment');
                }
                if (docType == VALUE_TWENTYTWO) {
                    removeDocumentValue('copy_proposed_land_doc_name_container_for_landallotment', 'copy_proposed_land_doc_name_image_for_landallotment', 'copy_proposed_land_doc_container_for_landallotment', 'copy_proposed_land_doc_for_landallotment');
                }
                if (docType == VALUE_TWENTYTHREE) {
                    removeDocumentValue('copy_of_partnership_deed_doc_name_container_for_landallotment', 'copy_of_partnership_deed_doc_name_image_for_landallotment', 'copy_of_partnership_deed_doc_container_for_landallotment', 'copy_of_partnership_deed_doc_for_landallotment');
                }
                if (docType == VALUE_TWENTYFOUR) {
                    removeDocumentValue('relevant_experience_doc_name_container_for_landallotment', 'relevant_experience_doc_name_image_for_landallotment', 'relevant_experience_doc_container_for_landallotment', 'relevant_experience_doc_for_landallotment');
                }
                if (docType == VALUE_TWENTYFIVE) {
                    removeDocumentValue('certy_by_direc_indus_doc_name_container_for_landallotment', 'certy_by_direc_indus_doc_name_image_for_landallotment', 'certy_by_direc_indus_doc_container_for_landallotment', 'certy_by_direc_indus_doc_for_landallotment');
                }
                if (docType == VALUE_TWENTYSIX) {
                    removeDocumentValue('other_relevant_doc_name_container_for_landallotment', 'other_relevant_doc_name_image_for_landallotment', 'other_relevant_doc_container_for_landallotment', 'other_relevant_doc_for_landallotment');
                }
                if (docType == VALUE_TWENTYSEVEN) {
                    removeDocumentValue('seal_and_stamp_name_container_for_landallotment', 'seal_and_stamp_name_image_for_landallotment', 'seal_and_stamp_container_for_landallotment', 'seal_and_stamp_for_landallotment');
                }



            }
        });
    },
    addMultipleProprietor: function (templateData) {
        templateData.per_cnt = tempPersonCnt;
        $('#proprietor_info_container').append(landallotmentproprietorInfoTemplate(templateData));
        resetCounter('display-cnt');
    },
    removeProprietorInfo: function (perCnt) {
        $('#landallot_proprietor_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    generateForm1: function (landallotmentId) {
        if (!landallotmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#landallotment_id_for_landallotment_form1').val(landallotmentId);
        $('#landallotment_form1_pdf_form').submit();
        $('#landallotment_id_for_landallotment_form1').val('');
    },

    downloadUploadChallan: function (landallotmentId) {
        if (!landallotmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + landallotmentId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'landallotment/get_landallotment_data_by_landallotment_id',
            type: 'post',
            data: $.extend({}, {'landallotment_id': landallotmentId}, getTokenData()),
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
                var landallotmentData = parseData.landallotment_data;
                that.showChallan(landallotmentData);
            }
        });
    },
    showChallan: function (landallotmentData) {
        showPopup();
        if (landallotmentData.status != VALUE_FIVE && landallotmentData.status != VALUE_SIX && landallotmentData.status != VALUE_SEVEN) {
            if (!landallotmentData.hide_submit_btn) {
                landallotmentData.show_fees_paid = true;
            }
        }
        if (landallotmentData.payment_type == VALUE_ONE) {
            landallotmentData.utitle = 'Fees Paid Challan Copy';
        } else {
            landallotmentData.style = 'display: none;';
        }
        if (landallotmentData.payment_type == VALUE_TWO) {
            landallotmentData.show_dd_po_option = true;
            landallotmentData.utitle = 'Demand Draft (DD)';
        }
        landallotmentData.module_type = VALUE_TWENTYFIVE;
        $('#popup_container').html(landallotmentUploadChallanTemplate(landallotmentData));
        loadFB(VALUE_TWENTYFIVE, landallotmentData.fb_data);
        loadPH(VALUE_TWENTYFIVE, landallotmentData.landallotment_id, landallotmentData.ph_data);

        if (landallotmentData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'landallotment_upload_challan', landallotmentData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'landallotment_upload_challan', 'uc', 'radio');
            if (landallotmentData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_landallotment_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (landallotmentData.challan != '') {
            $('#challan_container_for_landallotment_upload_challan').hide();
            $('#challan_name_container_for_landallotment_upload_challan').show();
            $('#challan_name_href_for_landallotment_upload_challan').attr('href', 'documents/landallotment/' + landallotmentData.challan);
            $('#challan_name_for_landallotment_upload_challan').html(landallotmentData.challan);
        }
        if (landallotmentData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_landallotment_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_landallotment_upload_challan').show();
            $('#fees_paid_challan_name_href_for_landallotment_upload_challan').attr('href', 'documents/landallotment/' + landallotmentData.fees_paid_challan);
            $('#fees_paid_challan_name_for_landallotment_upload_challan').html(landallotmentData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_landallotment_upload_challan').attr('onclick', 'Landallotment.listview.removeFeesPaidChallan("' + landallotmentData.landallotment_id + '")');
        }
    },
    removeFeesPaidChallan: function (landallotmentId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!landallotmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'landallotment/remove_fees_paid_challan',
            data: $.extend({}, {'landallotment_id': landallotmentId}, getTokenData()),
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
                validationMessageShow('landallotment-uc', textStatus.statusText);
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
                    validationMessageShow('landallotment-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-landallotment-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'landallotment_upload_challan');
                $('#status_' + landallotmentId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-landallotment-uc').html('');
        validationMessageHide();
        var landallotmentId = $('#landallotment_id_for_landallotment_upload_challan').val();
        if (!landallotmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_landallotment_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_landallotment_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_landallotment_upload_challan').focus();
                validationMessageShow('landallotment-uc-fees_paid_challan_for_landallotment_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_landallotment_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_landallotment_upload_challan').focus();
                validationMessageShow('landallotment-uc-fees_paid_challan_for_landallotment_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_landallotment_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#landallotment_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'landallotment/upload_fees_paid_challan',
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
                validationMessageShow('landallotment-uc', textStatus.statusText);
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
                    validationMessageShow('landallotment-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + landallotmentId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (landallotmentId) {
        if (!landallotmentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#landallotment_id_for_certificate').val(landallotmentId);
        $('#landallotment_certificate_pdf_form').submit();
        $('#landallotment_id_for_certificate').val('');
    },
    getQueryData: function (landallotmentId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!landallotmentId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_TWENTYFIVE;
        templateData.module_id = landallotmentId;
        var btnObj = $('#query_btn_for_land_' + landallotmentId);
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
                tmpData.application_number = regNoRenderer(VALUE_TWENTYFIVE, moduleData.landallotment_id);
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },

    getConstitution: function (constitution) {
        var categoryOfHotel = constitution.value;
        if (categoryOfHotel == '') {
            return false;
        }

        if (categoryOfHotel == 'proprietary') {
            $('.constitution_artical_div').show();
        } else if (categoryOfHotel == 'partnership') {
            $('.constitution_artical_div').show();
        } else if (categoryOfHotel == 'private') {
            $('.constitution_artical_div').show();
        } else if (categoryOfHotel == 'public') {
            $('.constitution_artical_div').show();
        } else if (categoryOfHotel == 'limited_liability_partnership') {
            $('.constitution_artical_div').show();
        } else if (categoryOfHotel == 'others') {
            $('.constitution_artical_div').show();
        }

    },

    uploadDocumentForLandallotment: function (fileNo) {
        var that = this;
        if ($('#bio_data_doc_for_landallotment').val() != '') {
            var copyOfRegistration = checkValidationForDocument('bio_data_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#constitution_artical_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('constitution_artical_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#obtained_letter_of_intent_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('obtained_letter_of_intent_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#regist_letter_msme_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('regist_letter_msme_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#detailed_project_report_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('detailed_project_report_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#proposed_finance_terms_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('proposed_finance_terms_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#details_of_manufacturing_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('details_of_manufacturing_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#if_backward_class_bac_doc_for_landallotment').val() != '') {
            var copyOfRegistration = checkValidationForDocument('if_backward_class_bac_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#if_backward_class_scst_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('if_backward_class_scst_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#if_backward_class_ex_serv_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('if_backward_class_ex_serv_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#if_backward_class_wm_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('if_backward_class_wm_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#if_backward_class_ph_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('if_backward_class_ph_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#if_belonging_transg_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('if_belonging_transg_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#bonafide_of_dnh_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('bonafide_of_dnh_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#information_raw_materials_doc_for_landallotment').val() != '') {
            var copyOfRegistration = checkValidationForDocument('information_raw_materials_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#infrastructure_requirement_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('infrastructure_requirement_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#effluent_teratment_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('effluent_teratment_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#emission_of_gases_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('emission_of_gases_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#copy_authority_letter_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('copy_authority_letter_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#copy_project_profile_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('copy_project_profile_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#demand_of_deposit_draft_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('demand_of_deposit_draft_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#copy_proposed_land_doc_for_landallotment').val() != '') {
            var copyOfRegistration = checkValidationForDocument('copy_proposed_land_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_of_partnership_deed_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('copy_of_partnership_deed_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#relevant_experience_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('relevant_experience_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#certy_by_direc_indus_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('certy_by_direc_indus_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#other_relevant_doc_for_landallotment').val() != '') {
            var formIIdoc = checkValidationForDocument('other_relevant_doc_for_landallotment', VALUE_ONE, 'landallotment', 2048);
            if (formIIdoc == false) {
                return false;
            }
        }

        if ($('#seal_and_stamp_for_landallotment').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_landallotment', VALUE_TWO, 'landallotment');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_landallotment_' + fileNo).hide();
        $('.spinner_name_container_for_landallotment_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var landallotmentId = $('#landallotment_id').val();
        var formData = new FormData($('#landallotment_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("landallotment_id", landallotmentId);
        $.ajax({
            type: 'POST',
            url: 'landallotment/upload_landallotment_document',
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
                $('.spinner_container_for_landallotment_' + fileNo).show();
                $('.spinner_name_container_for_landallotment_' + fileNo).hide();
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
                    $('.spinner_container_for_landallotment_' + fileNo).show();
                    $('.spinner_name_container_for_landallotment_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_landallotment_' + fileNo).hide();
                $('.spinner_name_container_for_landallotment_' + fileNo).show();
                $('#landallotment_id').val(parseData.landallotment_id);
                var landallotmentData = parseData.landallotment_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('bio_data_doc_container_for_landallotment', 'bio_data_doc_name_image_for_landallotment', 'bio_data_doc_name_container_for_landallotment',
                            'bio_data_doc_download', 'bio_data_doc', landallotmentData.bio_data_doc, parseData.landallotment_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('constitution_artical_doc_container_for_landallotment', 'constitution_artical_doc_name_image_for_landallotment', 'constitution_artical_doc_name_container_for_landallotment',
                            'constitution_artical_doc_download', 'constitution_artical_doc', landallotmentData.constitution_artical_doc, parseData.landallotment_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('obtained_letter_of_intent_doc_container_for_landallotment', 'obtained_letter_of_intent_doc_name_image_for_landallotment', 'obtained_letter_of_intent_doc_name_container_for_landallotment',
                            'obtained_letter_of_intent_doc_download', 'obtained_letter_of_intent_doc', landallotmentData.obtained_letter_of_intent_doc, parseData.landallotment_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('regist_letter_msme_doc_container_for_landallotment', 'regist_letter_msme_doc_name_image_for_landallotment', 'regist_letter_msme_doc_name_container_for_landallotment',
                            'regist_letter_msme_doc_download', 'regist_letter_msme_doc', landallotmentData.regist_letter_msme_doc, parseData.landallotment_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('detailed_project_report_doc_container_for_landallotment', 'detailed_project_report_doc_name_image_for_landallotment', 'detailed_project_report_doc_name_container_for_landallotment',
                            'detailed_project_report_doc_download', 'detailed_project_report_doc', landallotmentData.detailed_project_report_doc, parseData.landallotment_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('proposed_finance_terms_doc_container_for_landallotment', 'proposed_finance_terms_doc_name_image_for_landallotment', 'proposed_finance_terms_doc_name_container_for_landallotment',
                            'proposed_finance_terms_doc_download', 'proposed_finance_terms_doc', landallotmentData.proposed_finance_terms_doc, parseData.landallotment_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('details_of_manufacturing_doc_container_for_landallotment', 'details_of_manufacturing_doc_name_image_for_landallotment', 'details_of_manufacturing_doc_name_container_for_landallotment',
                            'details_of_manufacturing_doc_download', 'details_of_manufacturing_doc', landallotmentData.details_of_manufacturing_doc, parseData.landallotment_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('if_backward_class_bac_doc_container_for_landallotment', 'if_backward_class_bac_doc_name_image_for_landallotment', 'if_backward_class_bac_doc_name_container_for_landallotment',
                            'if_backward_class_bac_doc_download', 'if_backward_class_bac_doc', landallotmentData.if_backward_class_bac_doc, parseData.landallotment_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('if_backward_class_scst_doc_container_for_landallotment', 'if_backward_class_scst_doc_name_image_for_landallotment', 'if_backward_class_scst_doc_name_container_for_landallotment',
                            'if_backward_class_scst_doc_download', 'if_backward_class_scst_doc', landallotmentData.if_backward_class_scst_doc, parseData.landallotment_id, VALUE_NINE);
                }
                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('if_backward_class_ex_serv_doc_container_for_landallotment', 'if_backward_class_ex_serv_doc_name_image_for_landallotment', 'if_backward_class_ex_serv_doc_name_container_for_landallotment',
                            'if_backward_class_ex_serv_doc_download', 'if_backward_class_ex_serv_doc', landallotmentData.if_backward_class_ex_serv_doc, parseData.landallotment_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('if_backward_class_wm_doc_container_for_landallotment', 'if_backward_class_wm_doc_name_image_for_landallotment', 'if_backward_class_wm_doc_name_container_for_landallotment',
                            'if_backward_class_wm_doc_download', 'if_backward_class_wm_doc', landallotmentData.if_backward_class_wm_doc, parseData.landallotment_id, VALUE_ELEVEN);
                }
                if (parseData.file_no == VALUE_TWELVE) {
                    that.showDocument('if_backward_class_ph_doc_container_for_landallotment', 'if_backward_class_ph_doc_name_image_for_landallotment', 'if_backward_class_ph_doc_name_container_for_landallotment',
                            'if_backward_class_ph_doc_download', 'if_backward_class_ph_doc', landallotmentData.if_backward_class_ph_doc, parseData.landallotment_id, VALUE_TWELVE);
                }
                if (parseData.file_no == VALUE_THIRTEEN) {
                    that.showDocument('if_belonging_transg_doc_container_for_landallotment', 'if_belonging_transg_doc_name_image_for_landallotment', 'if_belonging_transg_doc_name_container_for_landallotment',
                            'if_belonging_transg_doc_download', 'if_belonging_transg_doc', landallotmentData.if_belonging_transg_doc, parseData.landallotment_id, VALUE_THIRTEEN);
                }

                if (parseData.file_no == VALUE_FOURTEEN) {
                    that.showDocument('bonafide_of_dnh_doc_container_for_landallotment', 'bonafide_of_dnh_doc_name_image_for_landallotment', 'bonafide_of_dnh_doc_name_container_for_landallotment',
                            'bonafide_of_dnh_doc_download', 'bonafide_of_dnh_doc', landallotmentData.bonafide_of_dnh_doc, parseData.landallotment_id, VALUE_FOURTEEN);
                }
                if (parseData.file_no == VALUE_FIFTEEN) {
                    that.showDocument('information_raw_materials_doc_container_for_landallotment', 'information_raw_materials_doc_name_image_for_landallotment', 'information_raw_materials_doc_name_container_for_landallotment',
                            'information_raw_materials_doc_download', 'information_raw_materials_doc', landallotmentData.information_raw_materials_doc, parseData.landallotment_id, VALUE_FOURTEEN);
                }
                if (parseData.file_no == VALUE_SIXTEEN) {
                    that.showDocument('infrastructure_requirement_doc_container_for_landallotment', 'infrastructure_requirement_doc_name_image_for_landallotment', 'infrastructure_requirement_doc_name_container_for_landallotment',
                            'infrastructure_requirement_doc_download', 'infrastructure_requirement_doc', landallotmentData.infrastructure_requirement_doc, parseData.landallotment_id, VALUE_FIFTEEN);
                }
                if (parseData.file_no == VALUE_SEVENTEEN) {
                    that.showDocument('effluent_teratment_doc_container_for_landallotment', 'effluent_teratment_doc_name_image_for_landallotment', 'effluent_teratment_doc_name_container_for_landallotment',
                            'effluent_teratment_doc_download', 'effluent_teratment_doc', landallotmentData.effluent_teratment_doc, parseData.landallotment_id, VALUE_SIXTEEN);
                }
                if (parseData.file_no == VALUE_EIGHTEEN) {
                    that.showDocument('emission_of_gases_doc_container_for_landallotment', 'emission_of_gases_doc_name_image_for_landallotment', 'emission_of_gases_doc_name_container_for_landallotment',
                            'emission_of_gases_doc_download', 'emission_of_gases_doc', landallotmentData.emission_of_gases_doc, parseData.landallotment_id, VALUE_EIGHTEEN);
                }
                if (parseData.file_no == VALUE_NINETEEN) {
                    that.showDocument('copy_authority_letter_doc_container_for_landallotment', 'copy_authority_letter_doc_name_image_for_landallotment', 'copy_authority_letter_doc_name_container_for_landallotment',
                            'copy_authority_letter_doc_download', 'copy_authority_letter_doc', landallotmentData.copy_authority_letter_doc, parseData.landallotment_id, VALUE_NINETEEN);
                }
                if (parseData.file_no == VALUE_TWENTY) {
                    that.showDocument('copy_project_profile_doc_container_for_landallotment', 'copy_project_profile_doc_name_image_for_landallotment', 'copy_project_profile_doc_name_container_for_landallotment',
                            'copy_project_profile_doc_download', 'copy_project_profile_doc', landallotmentData.copy_project_profile_doc, parseData.landallotment_id, VALUE_TWENTY);
                }
                if (parseData.file_no == VALUE_TWENTYONE) {
                    that.showDocument('demand_of_deposit_draft_container_for_landallotment', 'demand_of_deposit_draft_name_image_for_landallotment', 'demand_of_deposit_draft_name_container_for_landallotment',
                            'demand_of_deposit_draft_download', 'demand_of_deposit_draft', landallotmentData.demand_of_deposit_draft, parseData.landallotment_id, VALUE_TWENTYONE);
                }
                if (parseData.file_no == VALUE_TWENTYTWO) {
                    that.showDocument('copy_proposed_land_doc_container_for_landallotment', 'copy_proposed_land_doc_name_image_for_landallotment', 'copy_proposed_land_doc_name_container_for_landallotment',
                            'copy_proposed_land_doc_download', 'copy_proposed_land_doc', landallotmentData.copy_proposed_land_doc, parseData.landallotment_id, VALUE_TWENTYTWO);
                }
                if (parseData.file_no == VALUE_TWENTYTHREE) {
                    that.showDocument('copy_of_partnership_deed_doc_container_for_landallotment', 'copy_of_partnership_deed_doc_name_image_for_landallotment', 'copy_of_partnership_deed_doc_name_container_for_landallotment',
                            'copy_of_partnership_deed_doc_download', 'copy_of_partnership_deed_doc', landallotmentData.copy_of_partnership_deed_doc, parseData.landallotment_id, VALUE_TWENTYTHREE);
                }
                if (parseData.file_no == VALUE_TWENTYFOUR) {
                    that.showDocument('relevant_experience_doc_container_for_landallotment', 'relevant_experience_doc_name_image_for_landallotment', 'relevant_experience_doc_name_container_for_landallotment',
                            'relevant_experience_doc_download', 'relevant_experience_doc', landallotmentData.relevant_experience_doc, parseData.landallotment_id, VALUE_TWENTYFOUR);
                }
                if (parseData.file_no == VALUE_TWENTYFIVE) {
                    that.showDocument('certy_by_direc_indus_doc_container_for_landallotment', 'certy_by_direc_indus_doc_name_image_for_landallotment', 'certy_by_direc_indus_doc_name_container_for_landallotment',
                            'certy_by_direc_indus_doc_download', 'certy_by_direc_indus_doc', landallotmentData.certy_by_direc_indus_doc, parseData.landallotment_id, VALUE_TWENTYFIVE);
                }
                if (parseData.file_no == VALUE_TWENTYSIX) {
                    that.showDocument('other_relevant_doc_container_for_landallotment', 'other_relevant_doc_name_image_for_landallotment', 'other_relevant_doc_name_container_for_landallotment',
                            'other_relevant_doc_download', 'other_relevant_doc', landallotmentData.other_relevant_doc, parseData.landallotment_id, VALUE_TWENTYSIX);
                }

                if (parseData.file_no == VALUE_TWENTYSEVEN) {
                    that.showDocument('seal_and_stamp_container_for_landallotment', 'seal_and_stamp_name_image_for_landallotment', 'seal_and_stamp_name_container_for_landallotment',
                            'seal_and_stamp_download', 'seal_and_stamp', landallotmentData.signature, parseData.landallotment_id, VALUE_TWENTYSEVEN);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/landallotment/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/landallotment/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Landallotment.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
