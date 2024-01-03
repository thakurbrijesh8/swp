var industryProfileListTemplate = Handlebars.compile($('#industry_profile_list_template').html());
var industryProfileTableTemplate = Handlebars.compile($('#industry_profile_table_template').html());
var industryProfileActionTemplate = Handlebars.compile($('#industry_profile_action_template').html());
var industryProfileFormTemplate = Handlebars.compile($('#industry_profile_form_template').html());
var industryProfileViewTemplate = Handlebars.compile($('#industry_profile_view_template').html());
var surveyIPCTemplate = Handlebars.compile($('#survey_ipc_template').html());
var surveyStateWisePeTemplate = Handlebars.compile($('#survey_state_wise_template').html());
var surveyViewIPCTemplate = Handlebars.compile($('#survey_view_ipc_template').html());
var surveyViewStateWisePeTemplate = Handlebars.compile($('#survey_view_state_wise_template').html());

var ipcCnt = 1;
var stateWisePeCnt = 1;

var IndustryProfile = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
IndustryProfile.Router = Backbone.Router.extend({
    routes: {
        'industryprofile': 'renderList',
        'industryprofile_form': 'renderListForForm',
        'edit_industryprofile_form': 'renderList',
        'view_industryprofile_form': 'renderList',
    },
    renderList: function () {
        IndustryProfile.listview.listPage();
    },
    renderListForForm: function () {
        IndustryProfile.listview.listPageIndustryProfileForm();
    }
});
IndustryProfile.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_industry_profile');
        addClass('menu_industry_profile', 'active');
        IndustryProfile.router.navigate('industryprofile');
        var templateData = {};
        this.$el.html(industryProfileListTemplate(templateData));
        this.loadIndustryProfileData(sDistrict, sStatus);

    },
    listPageIndustryProfileForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_industry_profile');
        addClass('menu_industry_profile', 'active');
        this.$el.html(industryProfileListTemplate);
        this.newIndustryProfileForm(false, {});
    },
    actionRenderer: function (rowData) {
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE) {
            rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_form_one_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE && rowData.status != VALUE_TWO && rowData.status != VALUE_SIX) {
            rowData.ADMIN_BOILER_DOC_PATH = ADMIN_BOILER_DOC_PATH;
            rowData.show_download_upload_challan_btn = true;
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return industryProfileActionTemplate(rowData);
    },
    loadIndustryProfileData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTYSEVEN, data);
        };
        var that = this;
        IndustryProfile.router.navigate('industryprofile');
        $('#industry_profile_form_and_datatable_container').html(industryProfileTableTemplate(searchData));
        industryProfileDataTable = $('#industry_profile_datatable').DataTable({
            ajax: {url: 'industryprofile/get_industry_profile_data', dataSrc: "industry_profile_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'company_name', 'class': 'v-a-m text-center f-w-b'},
                {data: 'entrepreneur_name', 'class': 'text-center'},
                {data: 'estate_name', 'class': 'text-center'},
                {data: 'official_address', 'class': 'text-center'},
                {data: 'authorized_person_contactno', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                // {data: 'company_survey_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                // {data: 'company_survey_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}

            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#industry_profile_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = industryProfileDataTable.row(tr);

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
    askForNewIndustryProfileForm: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        that.newIndustryProfileForm(false, {});
    },
    newIndustryProfileForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var templateData = parseData.industry_profile_data;
            IndustryProfile.router.navigate('edit_industryprofile_form');
        } else {
            var templateData = {};
            IndustryProfile.router.navigate('industryprofile_form');
        }
        ipcCnt = 1;
        templateData.ESTATE_GOVERNMENT = ESTATE_GOVERNMENT;
        templateData.ESTATE_PRIVATE = ESTATE_PRIVATE;
        templateData.ESTATE_OTHER = ESTATE_OTHER;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.CATEGORY_SC = CATEGORY_SC;
        templateData.CATEGORY_ST = CATEGORY_ST;
        templateData.CATEGORY_OBC = CATEGORY_OBC;
        templateData.CATEGORY_GENERAL = CATEGORY_GENERAL;
        templateData.O_PROPRIETARY = O_PROPRIETARY;
        templateData.O_PARTNERSHIP = O_PARTNERSHIP;
        templateData.O_PRIVATE_LIMITED = O_PRIVATE_LIMITED;
        templateData.O_PUBLIC_LIMITED = O_PUBLIC_LIMITED;
        templateData.O_CO_OPERATIVE = O_CO_OPERATIVE;
        templateData.O_SELF_HALP_GROUP = O_SELF_HALP_GROUP;
        templateData.O_HUF = O_HUF;
        templateData.O_OTHERS = O_OTHERS;
        templateData.PCC_RED = PCC_RED;
        templateData.PCC_ORANGE = PCC_ORANGE;
        templateData.PCC_GREEN = PCC_GREEN;
        templateData.SOLID_WASTE = SOLID_WASTE;
        templateData.HAZARDOUS_WASTE = HAZARDOUS_WASTE;
        templateData.E_WASTE = E_WASTE;
        templateData.NA_WASTE = NA_WASTE;
        templateData.GENDER_MALE = GENDER_MALE;
        templateData.GENDER_FEMALE = GENDER_FEMALE;
        templateData.GENDER_OTHER = GENDER_OTHER;
        $('#industry_profile_form_and_datatable_container').html(industryProfileFormTemplate(templateData));
        renderOptionsForTwoDimensionalArray(INDUSTRY_TYPE_ARRAY, 'industry_type_for_survey', false);
        $('#industry_type_for_survey').val(templateData.industry_type);
        $("input[name=estate_details_for_survey][value='" + templateData.estate_details + "']").prop("checked", true);
        $("input[name=major_activity_for_survey][value='" + templateData.major_activity + "']").prop("checked", true);
        $("input[name=nature_activity_for_survey][value='" + templateData.nature_activity + "']").prop("checked", true);
        $("input[name=social_category_for_survey][value='" + templateData.social_category + "']").prop("checked", true);
        $("input[name=gender_for_survey][value='" + templateData.gender + "']").prop("checked", true);
        $("input[name=differently_abled_for_survey][value='" + templateData.differently_abled + "']").prop("checked", true);
        $("input[name=organization_type_for_survey][value='" + templateData.organization_type + "']").click();
        $("input[name=pcc_category_for_survey][value='" + templateData.pcc_category + "']").prop("checked", true);
        $("input[name=emp_tlc_for_survey][value='" + templateData.emp_tlc + "']").prop("checked", true);
        $("input[name=is_gstin_for_survey][value='" + templateData.is_gstin + "']").click();
        $("input[name=social_distancing_for_survey][value='" + templateData.social_distancing + "']").prop("checked", true);
        $("input[name=thermal_screening_for_survey][value='" + templateData.thermal_screening + "']").prop("checked", true);
        $("input[name=mask_availability_for_survey][value='" + templateData.mask_availability + "']").prop("checked", true);
        $("input[name=face_shield_for_survey][value='" + templateData.face_shield + "']").prop("checked", true);
        $("input[name=washing_hands_for_survey][value='" + templateData.washing_hands + "']").prop("checked", true);
        $("input[name=avoiding_water_for_survey][value='" + templateData.avoiding_water + "']").prop("checked", true);
        $("input[name=overcrowding_for_survey][value='" + templateData.overcrowding + "']").prop("checked", true);
        $("input[name=arrangements_for_survey][value='" + templateData.arrangements + "']").prop("checked", true);
        $("input[name=washing_facilities_for_survey][value='" + templateData.washing_facilities + "']").prop("checked", true);
        $("input[name=workers_quarters_for_survey][value='" + templateData.workers_quarters + "']").click();
        $("input[name=canteen_for_survey][value='" + templateData.canteen + "']").prop("checked", true);
        $("input[name=commu_fiber_for_survey][value='" + templateData.commu_fiber + "']").prop("checked", true);
        $("input[name=srl_for_survey][value='" + templateData.srl + "']").prop("checked", true);

        if (templateData.connectivity) {
            var connectivity = (templateData.connectivity).split(',');
            $.each(connectivity, function (index, value) {
                $('input[name=connectivity_for_survey][value="' + value + '"]').click();
            });
        }
        if (templateData.pe) {
            var peObj = JSON.parse(templateData.pe);
            $.each(peObj, function (key, value) {
                that.addPE(value);
            });
        } else {
            that.addPE({});
        }

        if (templateData.ipc) {
            var ipcObj = JSON.parse(templateData.ipc);
            $.each(ipcObj, function (index, value) {
                that.addIPC({ipc_value: value});
            });
        } else {
            that.addIPC({});
        }
        $("input[name=air_pcm_for_survey][value='" + templateData.air_pcm + "']").prop("checked", true);
        $("input[name=wpit_for_survey][value='" + templateData.wpit + "']").prop("checked", true);
        $("input[name=unit_status_for_survey][value='" + templateData.unit_status + "']").prop("checked", true);
        $('#industry_profile_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitIndustryProfile($('#submit_btn_for_industry_profile'));
            }
        });
    },
    editOrViewIndustryProfile: function (btnObj, industryProfileId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!industryProfileId) {
            showError(invalidIdValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnClick = btnObj.attr("onclick");
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'industryprofile/get_industry_profile_data_by_id',
            type: 'post',
            data: $.extend({}, {'company_survey_id': industryProfileId}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnClick);
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
                btnObj.attr('onclick', ogBtnOnClick);
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
                // var industryProfileData = parseData.industry_profile_data;
                // industryProfileData.hydraulically_tested_on = dateTo_DD_MM_YYYY(industryProfileData.hydraulically_tested_on);
                if (isEdit) {
                    that.newIndustryProfileForm(isEdit, parseData);
                } else {
                    that.viewIndustryProfileForm(parseData);
                }
            }
        });
    },
    viewIndustryProfileForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        //templateData.industryProfile_data = industryProfileData;
        var templateData = parseData.industry_profile_data;
        IndustryProfile.router.navigate('view_industryprofile_form');
        templateData.ESTATE_GOVERNMENT = ESTATE_GOVERNMENT;
        templateData.ESTATE_PRIVATE = ESTATE_PRIVATE;
        templateData.ESTATE_OTHER = ESTATE_OTHER;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.CATEGORY_SC = CATEGORY_SC;
        templateData.CATEGORY_ST = CATEGORY_ST;
        templateData.CATEGORY_OBC = CATEGORY_OBC;
        templateData.CATEGORY_GENERAL = CATEGORY_GENERAL;
        templateData.O_PROPRIETARY = O_PROPRIETARY;
        templateData.O_PARTNERSHIP = O_PARTNERSHIP;
        templateData.O_PRIVATE_LIMITED = O_PRIVATE_LIMITED;
        templateData.O_PUBLIC_LIMITED = O_PUBLIC_LIMITED;
        templateData.O_CO_OPERATIVE = O_CO_OPERATIVE;
        templateData.O_SELF_HALP_GROUP = O_SELF_HALP_GROUP;
        templateData.O_HUF = O_HUF;
        templateData.O_OTHERS = O_OTHERS;
        templateData.PCC_RED = PCC_RED;
        templateData.PCC_ORANGE = PCC_ORANGE;
        templateData.PCC_GREEN = PCC_GREEN;
        templateData.SOLID_WASTE = SOLID_WASTE;
        templateData.HAZARDOUS_WASTE = HAZARDOUS_WASTE;
        templateData.E_WASTE = E_WASTE;
        templateData.NA_WASTE = NA_WASTE;
        templateData.GENDER_MALE = GENDER_MALE;
        templateData.GENDER_FEMALE = GENDER_FEMALE;
        templateData.GENDER_OTHER = GENDER_OTHER;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#industry_profile_form_and_datatable_container').html(industryProfileViewTemplate(templateData));
        renderOptionsForTwoDimensionalArray(INDUSTRY_TYPE_ARRAY, 'industry_type_for_survey', false);
        $('#industry_type_for_survey').val(templateData.industry_type);
        $("input[name=estate_details_for_survey][value='" + templateData.estate_details + "']").prop("checked", true);
        $("input[name=major_activity_for_survey][value='" + templateData.major_activity + "']").prop("checked", true);
        $("input[name=nature_activity_for_survey][value='" + templateData.nature_activity + "']").prop("checked", true);
        $("input[name=social_category_for_survey][value='" + templateData.social_category + "']").prop("checked", true);
        $("input[name=gender_for_survey][value='" + templateData.gender + "']").prop("checked", true);
        $("input[name=differently_abled_for_survey][value='" + templateData.differently_abled + "']").prop("checked", true);
        $("input[name=organization_type_for_survey][value='" + templateData.organization_type + "']").click();
        $("input[name=pcc_category_for_survey][value='" + templateData.pcc_category + "']").prop("checked", true);
        $("input[name=emp_tlc_for_survey][value='" + templateData.emp_tlc + "']").prop("checked", true);
        $("input[name=is_gstin_for_survey][value='" + templateData.is_gstin + "']").click();
        $("input[name=social_distancing_for_survey][value='" + templateData.social_distancing + "']").prop("checked", true);
        $("input[name=thermal_screening_for_survey][value='" + templateData.thermal_screening + "']").prop("checked", true);
        $("input[name=mask_availability_for_survey][value='" + templateData.mask_availability + "']").prop("checked", true);
        $("input[name=face_shield_for_survey][value='" + templateData.face_shield + "']").prop("checked", true);
        $("input[name=washing_hands_for_survey][value='" + templateData.washing_hands + "']").prop("checked", true);
        $("input[name=avoiding_water_for_survey][value='" + templateData.avoiding_water + "']").prop("checked", true);
        $("input[name=overcrowding_for_survey][value='" + templateData.overcrowding + "']").prop("checked", true);
        $("input[name=arrangements_for_survey][value='" + templateData.arrangements + "']").prop("checked", true);
        $("input[name=washing_facilities_for_survey][value='" + templateData.washing_facilities + "']").prop("checked", true);
        $("input[name=workers_quarters_for_survey][value='" + templateData.workers_quarters + "']").click();
        $("input[name=canteen_for_survey][value='" + templateData.canteen + "']").prop("checked", true);
        $("input[name=commu_fiber_for_survey][value='" + templateData.commu_fiber + "']").prop("checked", true);
        $("input[name=srl_for_survey][value='" + templateData.srl + "']").prop("checked", true);

        if (templateData.connectivity) {
            var connectivity = (templateData.connectivity).split(',');
            $.each(connectivity, function (index, value) {
                $('input[name=connectivity_for_survey][value="' + value + '"]').click();
            });
        }
        if (templateData.pe) {
            var peObj = JSON.parse(templateData.pe);
            $.each(peObj, function (key, value) {
                that.viewPE(value);
            });
        } else {
            that.viewPE({});
        }

        if (templateData.ipc) {
            var ipcObj = JSON.parse(templateData.ipc);
            $.each(ipcObj, function (index, value) {
                that.viewIPC({ipc_value: value});
            });
        } else {
            that.viewIPC({});
        }
        $("input[name=air_pcm_for_survey][value='" + templateData.air_pcm + "']").prop("checked", true);
        $("input[name=wpit_for_survey][value='" + templateData.wpit + "']").prop("checked", true);
        $("input[name=unit_status_for_survey][value='" + templateData.unit_status + "']").prop("checked", true);
    },
    checkValidationForIndustryProfile: function (industryProfileData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!industryProfileData.company_name_for_survey) {
            return getBasicMessageAndFieldJSONArray('company_name_for_survey', companyNameValidationMessage);
        }
        if (!industryProfileData.entrepreneur_name_for_survey) {
            return getBasicMessageAndFieldJSONArray('entrepreneur_name_for_survey', entrepreneurNameValidationMessage);
        }
        if (!industryProfileData.company_address_for_survey) {
            return getBasicMessageAndFieldJSONArray('company_address_for_survey', companyAddressValidationMessage);
        }
        if (!industryProfileData.estate_name_for_survey) {
            return getBasicMessageAndFieldJSONArray('estate_name_for_survey', eStateNameValidationMessage);
        }
        if (!industryProfileData.estate_details_for_survey) {
            return getBasicMessageAndFieldJSONArray('estate_details_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.udyog_aadhar_memorandum_for_survey) {
            return getBasicMessageAndFieldJSONArray('udyog_aadhar_memorandum_for_survey', udyogAadharMemorandumValidationMessage);
        }
        if (industryProfileData.pan_number_for_survey) {
            var panMessage = PANValidation(industryProfileData.pan_number_for_survey);
            if (panMessage != '') {
                return getBasicMessageAndFieldJSONArray('pan_number_for_survey', panMessage);
            }
        }
        if (!industryProfileData.official_address_for_survey) {
            return getBasicMessageAndFieldJSONArray('official_address_for_survey', officialAddressValidationMessage);
        }
        if (!industryProfileData.authorized_person_name_for_survey) {
            return getBasicMessageAndFieldJSONArray('authorized_person_name_for_survey', personNameValidationMessage);
        }
        if (!industryProfileData.authorized_person_contactno_for_survey) {
            return getBasicMessageAndFieldJSONArray('authorized_person_contactno_for_survey', mobileValidationMessage);
        }
        if (!industryProfileData.authorized_person_email_for_survey) {
            return getBasicMessageAndFieldJSONArray('authorized_person_email_for_survey', emailValidationMessage);
        }
        if (!industryProfileData.industry_type_for_survey) {
            return getBasicMessageAndFieldJSONArray('industry_type_for_survey', selectIndustryTypeValidationMessage);
        }
        if (!industryProfileData.turnover_for_survey) {
            return getBasicMessageAndFieldJSONArray('turnover_for_survey', turnoverValidationMessage);
        }
        if (!industryProfileData.major_activity_for_survey) {
            return getBasicMessageAndFieldJSONArray('major_activity_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.nature_activity_for_survey) {
            return getBasicMessageAndFieldJSONArray('nature_activity_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.social_category_for_survey) {
            return getBasicMessageAndFieldJSONArray('social_category_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.gender_for_survey) {
            return getBasicMessageAndFieldJSONArray('gender_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.differently_abled_for_survey) {
            return getBasicMessageAndFieldJSONArray('differently_abled_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.organization_type_for_survey) {
            return getBasicMessageAndFieldJSONArray('organization_type_for_survey', selectOneOptionValidationMessage);
        }
        if (industryProfileData.organization_type_for_survey == O_OTHERS && !industryProfileData.other_organization_for_survey) {
            return getBasicMessageAndFieldJSONArray('other_organization_for_survey', otherOrgValidationMessage);
        }
        if (!industryProfileData.pcc_category_for_survey) {
            return getBasicMessageAndFieldJSONArray('pcc_category_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.total_employment_for_survey) {
            return getBasicMessageAndFieldJSONArray('total_employment_for_survey', employmentValidationMessage);
        }
        if (!industryProfileData.emp_tlc_for_survey) {
            return getBasicMessageAndFieldJSONArray('emp_tlc_for_survey', selectOneOptionValidationMessage);
        }
        var tempCntForPE = 0;
        var isValidate = false;
        var tempObj = [];
        $('.state_wise_pe').each(function () {
            var arr = {};
            var cnt = parseInt($(this).find('.og_state_wise_pe_cnt').val());
            var state = $('#state_for_survey_' + cnt).val();
            if (!state) {
                isValidate = true;
                tempCntForPE = cnt;
                return false;
            }
            arr.state = state;
            arr.skilled = $('#skilled_others_pe_for_survey_' + cnt).val();
            arr.semi_skilled = $('#semi_skilled_others_pe_for_survey_' + cnt).val();
            arr.unskilled = $('#unskilled_others_pe_for_survey_' + cnt).val();
            tempObj.push(arr);
            tempCntForPE++;
        });
        if (isValidate) {
            return getBasicMessageAndFieldJSONArray('state_for_survey_' + tempCntForPE, selectStateValidationMessage);
        }
        if (!industryProfileData.investment_for_survey) {
            return getBasicMessageAndFieldJSONArray('investment_for_survey', amountValidationMessage);
        }
        if (!industryProfileData.raw_material_for_survey) {
            return getBasicMessageAndFieldJSONArray('raw_material_for_survey', rawMaterialValidationMessage);
        }
        var tempCnt = 0;
        var isValidate = false;
        $('.ipc_row').each(function () {
            var cnt = parseInt($(this).find('.og_ipc_cnt').val());
            var ipc = $('#ipc_for_survey_' + cnt).val();
            if (!ipc) {
                isValidate = true;
                tempCnt = cnt;
                return false;
            }
            tempCnt++;
        });
        if (tempCnt == 0) {
            $('#add_btn_for_ipc').focus();
            showError(oneRowValidationMessage);
            return getBasicMessageAndFieldJSONArray('', '');
        }
        if (isValidate) {
            if (tempCnt == 0) {
                tempCnt++;
            }
            return getBasicMessageAndFieldJSONArray('ipc_for_survey_' + tempCnt, detailsValidationMessage);
        }
        if (!industryProfileData.major_product_for_survey) {
            return getBasicMessageAndFieldJSONArray('major_product_for_survey', majorProductValidationMessage);
        }
        if (!industryProfileData.industrial_process_for_survey) {
            return getBasicMessageAndFieldJSONArray('industrial_process_for_survey', industrialProductValidationMessage);
        }
        if (!industryProfileData.past_year_turnover_for_survey) {
            return getBasicMessageAndFieldJSONArray('past_year_turnover_for_survey', pastYearTurnOverValidationMessage);
        }
        if (!industryProfileData.intial_production_year_for_survey) {
            return getBasicMessageAndFieldJSONArray('intial_production_year_for_survey', yearValidationMessage);
        }
        if (!industryProfileData.is_gstin_for_survey) {
            return getBasicMessageAndFieldJSONArray('is_gstin_for_survey', selectOneOptionValidationMessage);
        }
        if (industryProfileData.is_gstin_for_survey == VALUE_ONE && !industryProfileData.gstin_number_for_survey) {
            return getBasicMessageAndFieldJSONArray('gstin_number_for_survey', gstinNumberValidationMessage);
        }
        if (!industryProfileData.social_distancing_for_survey) {
            return getBasicMessageAndFieldJSONArray('social_distancing_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.thermal_screening_for_survey) {
            return getBasicMessageAndFieldJSONArray('thermal_screening_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.mask_availability_for_survey) {
            return getBasicMessageAndFieldJSONArray('mask_availability_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.face_shield_for_survey) {
            return getBasicMessageAndFieldJSONArray('face_shield_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.washing_hands_for_survey) {
            return getBasicMessageAndFieldJSONArray('washing_hands_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.avoiding_water_for_survey) {
            return getBasicMessageAndFieldJSONArray('avoiding_water_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.phsw_for_survey) {
            return getBasicMessageAndFieldJSONArray('phsw_for_survey', detailsValidationMessage);
        }
        if (!industryProfileData.cleanliness_for_survey) {
            return getBasicMessageAndFieldJSONArray('cleanliness_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.overcrowding_for_survey) {
            return getBasicMessageAndFieldJSONArray('overcrowding_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.arrangements_for_survey) {
            return getBasicMessageAndFieldJSONArray('arrangements_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.fire_saftey_measures_for_survey) {
            return getBasicMessageAndFieldJSONArray('fire_saftey_measures_for_survey', fireSafteyMeasuresValidationMessage);
        }
        if (!industryProfileData.washing_facilities_for_survey) {
            return getBasicMessageAndFieldJSONArray('washing_facilities_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.first_aid_appliances_for_survey) {
            return getBasicMessageAndFieldJSONArray('first_aid_appliances_for_survey', firstAidAppliancesValidationMessage);
        }
        if (!industryProfileData.workers_quarters_for_survey) {
            return getBasicMessageAndFieldJSONArray('workers_quarters_for_survey', selectOneOptionValidationMessage);
        }
        if (industryProfileData.workers_quarters_for_survey == VALUE_ONE && !industryProfileData.quarters_number_for_survey) {
            return getBasicMessageAndFieldJSONArray('quarters_number_for_survey', quartersNumberValidationMessage);
        }
        if (!industryProfileData.canteen_for_survey) {
            return getBasicMessageAndFieldJSONArray('canteen_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.commu_fiber_for_survey) {
            return getBasicMessageAndFieldJSONArray('commu_fiber_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.srl_for_survey) {
            return getBasicMessageAndFieldJSONArray('srl_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.connectivity_for_survey) {
            return getBasicMessageAndFieldJSONArray('connectivity_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.saftey_measures_for_survey) {
            return getBasicMessageAndFieldJSONArray('saftey_measures_for_survey', safteyMeasuresValidationMessage);
        }
        if (!industryProfileData.pollution_control_measures_for_survey) {
            return getBasicMessageAndFieldJSONArray('pollution_control_measures_for_survey', pollutionControlValidationMessage);
        }
        if (!industryProfileData.air_pcm_for_survey) {
            return getBasicMessageAndFieldJSONArray('air_pcm_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.wpit_for_survey) {
            return getBasicMessageAndFieldJSONArray('wpit_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.unit_status_for_survey) {
            return getBasicMessageAndFieldJSONArray('unit_status_for_survey', selectOneOptionValidationMessage);
        }
        if (!industryProfileData.tax_due_ppy_for_survey) {
            return getBasicMessageAndFieldJSONArray('tax_due_ppy_for_survey', taxDuePPYValidationMessage);
        }


        return '';
    },
    askForIndustryProfile: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'IndustryProfile.listview.submitIndustryProfile(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitIndustryProfile: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var industryProfileData = $('#industry_profile_form').serializeFormJSON();
        var validationData = that.checkValidationForIndustryProfile(industryProfileData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('survey-' + validationData.field, validationData.message);
            return false;
        }

        var tempObj = [];
        $('.state_wise_pe').each(function () {
            var arr = {};
            var cnt = parseInt($(this).find('.og_state_wise_pe_cnt').val());
            arr.state = $('#state_for_survey_' + cnt).val();
            arr.skilled = $('#skilled_others_pe_for_survey_' + cnt).val();
            arr.semi_skilled = $('#semi_skilled_others_pe_for_survey_' + cnt).val();
            arr.unskilled = $('#unskilled_others_pe_for_survey_' + cnt).val();
            tempObj.push(arr);
        });
        industryProfileData.state_wise_pe_details_for_survey = tempObj;

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_industry_profile') : $('#submit_btn_for_industry_profile');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var industryProfileData = new FormData($('#industry_profile_form')[0]);
        industryProfileData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        industryProfileData.append("module_type", moduleType);
        industryProfileData.append("state_wise_pe_details_for_survey", JSON.stringify(tempObj));
        $.ajax({
            type: 'POST',
            url: 'industryprofile/submit_industry_profile',
            data: industryProfileData,
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
                validationMessageShow('industryprofile', textStatus.statusText);
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
                    validationMessageShow('industryprofile', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                IndustryProfile.router.navigate('industryprofile', {'trigger': true});
            }
        });
    },
    isGSTINChangeEvent: function (type) {
        $('#gstin_number_container').hide();
        if (type == VALUE_ONE) {
            $('#gstin_number_container').show();
            return false;
        }
    },
    orgTypeChangeEvent: function (type) {
        $('#other_org_container').hide();
        if (type == O_OTHERS) {
            $('#other_org_container').show();
            return false;
        }
    },
    quartersNumberChangeEvent: function (type) {
        $('#quarters_number_container').hide();
        if (type == VALUE_ONE) {
            $('#quarters_number_container').show();
            return false;
        }
    },
    removeIPC: function (cnt) {
        if (getTotalRowColunt('ipc-cnt') == 2) {
            showError(oneRowValidationMessage);
            return false;
        }
        $('#ipc_row_' + cnt).remove();
        resetCounter('ipc-cnt');
    },
    removePE: function (cnt) {
        $('#state_wise_pe_' + cnt).remove();
        resetCounter('state-wise-pe-cnt');
    },
    showSurveyPopup: function () {
        $('#default_model_body_container').html(surveyTemplate);
        $('#default_model').modal('show');
    },
    addIPC: function (templateData) {
        if (getTotalRowColunt('ipc-cnt') > 10) {
            showError(limitMaxTenValidationMessage);
            return false;
        }
        templateData.cnt = ipcCnt;
        $('#ipc_container').append(surveyIPCTemplate(templateData));
        resetCounter('ipc-cnt');
        ipcCnt++;
    },
    addPE: function (templateData) {
        templateData.cnt = stateWisePeCnt;
        $('#state_wise_pe_container').append(surveyStateWisePeTemplate(templateData));
        //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForDistrict(tempStateData, 'state_for_survey_' + stateWisePeCnt, 'state_code', 'state_name', 'State/UT');
        $('#state_for_survey_' + stateWisePeCnt).val(templateData.state);
        resetCounter('state-wise-pe-cnt');
        stateWisePeCnt++;
    },
    viewIPC: function (templateData) {
        if (getTotalRowColunt('ipc-cnt') > 10) {
            showError(limitMaxTenValidationMessage);
            return false;
        }
        templateData.cnt = ipcCnt;
        $('#ipc_container').append(surveyViewIPCTemplate(templateData));
        resetCounter('ipc-cnt');
        ipcCnt++;
    },
    viewPE: function (templateData) {
        templateData.cnt = stateWisePeCnt;
        $('#state_wise_pe_container').append(surveyViewStateWisePeTemplate(templateData));
        //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForDistrict(tempStateData, 'state_for_survey_' + stateWisePeCnt, 'state_code', 'state_name', 'State/UT');
        $('#state_for_survey_' + stateWisePeCnt).val(templateData.state);
        resetCounter('state-wise-pe-cnt');
        stateWisePeCnt++;
    },

});
