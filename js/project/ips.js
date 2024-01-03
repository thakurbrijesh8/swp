var ipsListTemplate = Handlebars.compile($('#ips_list_template').html());
var ipsTableTemplate = Handlebars.compile($('#ips_table_template').html());
var ipsActionTemplate = Handlebars.compile($('#ips_action_template').html());
var ipsFormTemplate = Handlebars.compile($('#ips_form_template').html());
var ipsViewTemplate = Handlebars.compile($('#ips_view_template').html());
var ipsDetailsTemplate = Handlebars.compile($('#ips_details_template').html());
var ipsMapTemplate = Handlebars.compile($('#ips_map_template').html());
var ipsIncListTemplate = Handlebars.compile($('#ips_inc_list_template').html());
var ipsIncTableTemplate = Handlebars.compile($('#ips_inc_table_template').html());
var ipsIncFormTemplate = Handlebars.compile($('#ips_inc_form_template').html());
var ipsIncActionTemplate = Handlebars.compile($('#ips_inc_action_template').html());
var ipsIncViewTemplate = Handlebars.compile($('#ips_inc_view_template').html());
var ipsIncRefDocItemTemplate = Handlebars.compile($('#ips_inc_ref_doc_item_template').html());
var ipsIncDocItemTemplate = Handlebars.compile($('#ips_inc_doc_item_template').html());
var ipsIncDocItemViewTemplate = Handlebars.compile($('#ips_inc_doc_item_view_template').html());
var ipsIncUploadChallanTemplate = Handlebars.compile($('#ips_inc_upload_challan_template').html());
var Ips = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Ips.Router = Backbone.Router.extend({
    routes: {
        'ips': 'renderList',
        'ips_incentives/:id': 'renderListForShowIncentives'
    },
    renderList: function () {
        Ips.listview.listPage();
    },
    renderListForShowIncentives: function (ipsId) {
        Ips.listview.showIncentives(ipsId);
    },
});
Ips.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        Ips.router.navigate('ips');
        var templateData = {};
        this.$el.html(ipsListTemplate(templateData));
        this.loadIpsData();
    },
    listPageForIpsForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        Ips.router.navigate('ips');
        var templateData = {};
        this.$el.html(ipsListTemplate(templateData));
        this.newIpsForm(false, {});
    },
    loadIpsData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FIFTYONE, data);
        };
        var actionRenderer = function (data, type, full, meta) {
            return ipsActionTemplate(full);
        };
        Ips.router.navigate('ips');
        $('#ips_form_and_datatable_container').html(ipsTableTemplate);
        ipsDataTable = $('#ips_datatable').DataTable({
            ajax: {url: 'ips/get_ips_data', dataSrc: "ips_data", type: "post", data: getTokenData()},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'ips_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'owner_name'},
                {data: 'udyam_registration', 'class': 'text-center'},
                {data: 'manu_name'},
                {data: 'main_plant_address'},
                {data: 'office_address'},
                {data: '', 'class': 'text-center', 'render': actionRenderer},
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
    },
    newIpsForm: function (isEdit, ipsData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        ipsData.VALUE_ONE = VALUE_ONE;
        ipsData.VALUE_TWO = VALUE_TWO;
        ipsData.VALUE_THREE = VALUE_THREE;
        ipsData.VALUE_FOUR = VALUE_FOUR;
        ipsData.VALUE_FIVE = VALUE_FIVE;
        ipsData.VALUE_SIX = VALUE_SIX;
        ipsData.VALUE_SEVEN = VALUE_SEVEN;
        ipsData.VALUE_EIGHT = VALUE_EIGHT;
        ipsData.VALUE_NINE = VALUE_NINE;
        ipsData.VALUE_TEN = VALUE_TEN;
        ipsData.VALUE_ELEVEN = VALUE_ELEVEN;
        ipsData.VALUE_TWELVE = VALUE_TWELVE;
        ipsData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        ipsData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        ipsData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        ipsData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        ipsData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        ipsData.VALUE_EIGHTEEN = VALUE_EIGHTEEN;
        ipsData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        if (isEdit) {
            ipsData.birth_date_text = ipsData.birth_date != '0000-00-00' ? dateTo_DD_MM_YYYY(ipsData.birth_date) : '';
            ipsData.commencement_date_text = ipsData.commencement_date != '0000-00-00' ? dateTo_DD_MM_YYYY(ipsData.commencement_date) : '';
        }
        $('#ips_form_and_datatable_container').html(ipsFormTemplate(ipsData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_ips');
        renderOptionsForTwoDimensionalArray(ownerCategoryArray, 'owner_category_for_ips');
        renderOptionsForTwoDimensionalArray(casteCategoryArray, 'caste_category_for_ips');
        renderOptionsForTwoDimensionalArray(msmeTypeArray, 'msme_category_for_ips');
        generateBoxes('radio', constitutionArray, 'constitution', 'ips', ipsData.constitution, true);
        showSubContainer('constitution', 'ips', '.other_constitution', VALUE_FIVE, 'radio');
        generateBoxes('radio', unitCategoryArray, 'unit_category', 'ips', ipsData.unit_category);
        showSubContainer('unit_category', 'ips', '.msme_category', VALUE_ONE, 'radio');
        generateBoxes('checkbox', entrepreneurCategoryArray, 'entrepreneur_category', 'ips', ipsData.entrepreneur_category, true);
        showSubContainer('entrepreneur_category', 'ips', '.young_entrepreneur', VALUE_THREE, 'checkbox');
        generateBoxes('checkbox', unitTypeArray, 'unit_type', 'ips', ipsData.unit_type, true);
        showSubContainer('unit_type', 'ips', '.ex_manufacturing_unit', VALUE_FIVE, 'checkbox');
        showSubContainer('unit_type', 'ips', '.ex_service_unit', VALUE_SIX, 'checkbox');
        generateBoxes('radio', sectorCategoryArray, 'sector_category', 'ips', ipsData.sector_category, true);
        generateBoxes('checkbox', thrustSectorsArray, 'thrust_sectors', 'ips', ipsData.thrust_sectors, false, true);
        if (isEdit) {
            $('#district_for_ips').val(ipsData.district);
            $('#owner_category_for_ips').val(ipsData.owner_category);
            $('#caste_category_for_ips').val(ipsData.caste_category);
            $('#unit_type_for_ips').val(ipsData.unit_type);
            $('#msme_category_for_ips').val(ipsData.msme_category);
            var docData = {};
            docData.ips_id = ipsData.ips_id;
//            if (ipsData.unit_doc != '') {
//                docData.file_name = ipsData.unit_doc;
//                that.loadIpsDocument(VALUE_ONE, docData);
//            }
//            if (ipsData.non_msme_doc != '') {
//                docData.file_name = ipsData.non_msme_doc;
//                that.loadIpsDocument(VALUE_TWO, docData);
//            }
            if (ipsData.birth_doc != '') {
                docData.file_name = ipsData.birth_doc;
                that.loadIpsDocument(VALUE_THREE, docData);
            }
            if (ipsData.udyam_regi_doc != '') {
                docData.file_name = ipsData.udyam_regi_doc;
                that.loadIpsDocument(VALUE_FOUR, docData);
            }
            if (ipsData.partnership_deed_doc != '') {
                docData.file_name = ipsData.partnership_deed_doc;
                that.loadIpsDocument(VALUE_FIVE, docData);
            }
            if (ipsData.enterprise_doc != '') {
                docData.file_name = ipsData.enterprise_doc;
                that.loadIpsDocument(VALUE_SIX, docData);
            }
            if (ipsData.ent_leased_doc != '') {
                docData.file_name = ipsData.ent_leased_doc;
                that.loadIpsDocument(VALUE_SEVEN, docData);
            }
            if (ipsData.electricity_doc != '') {
                docData.file_name = ipsData.electricity_doc;
                that.loadIpsDocument(VALUE_EIGHT, docData);
            }
            if (ipsData.authorization_doc != '') {
                docData.file_name = ipsData.authorization_doc;
                that.loadIpsDocument(VALUE_NINE, docData);
            }
            if (ipsData.pcc_doc != '') {
                docData.file_name = ipsData.pcc_doc;
                that.loadIpsDocument(VALUE_TEN, docData);
            }
            if (ipsData.factory_license_doc != '') {
                docData.file_name = ipsData.factory_license_doc;
                that.loadIpsDocument(VALUE_ELEVEN, docData);
            }
//            if (ipsData.clearnces_doc != '') {
//                docData.file_name = ipsData.clearnces_doc;
//                that.loadIpsDocument(VALUE_TWELVE, docData);
//            }
            if (ipsData.ur_cin_doc != '') {
                docData.file_name = ipsData.ur_cin_doc;
                that.loadIpsDocument(VALUE_THIRTEEN, docData);
            }
            if (ipsData.ur_tin_doc != '') {
                docData.file_name = ipsData.ur_tin_doc;
                that.loadIpsDocument(VALUE_FOURTEEN, docData);
            }
            if (ipsData.ur_pan_doc != '') {
                docData.file_name = ipsData.ur_pan_doc;
                that.loadIpsDocument(VALUE_FIFTEEN, docData);
            }
            if (ipsData.ur_gst_doc != '') {
                docData.file_name = ipsData.ur_gst_doc;
                that.loadIpsDocument(VALUE_SIXTEEN, docData);
            }
            if (ipsData.ur_other_doc != '') {
                docData.file_name = ipsData.ur_other_doc;
                that.loadIpsDocument(VALUE_SEVENTEEN, docData);
            }
            if (ipsData.undertaking_doc != '') {
                docData.file_name = ipsData.undertaking_doc;
                that.loadIpsDocument(VALUE_EIGHTEEN, docData);
            }
        }
        allowOnlyIntegerValue('mobile_no_for_ips');
        allowOnlyIntegerValue('aadhar_no_for_ips');
        allowOnlyIntegerValue('ap_mobile_for_ips');
        allowOnlyIntegerValue('gfc_investment_for_ips');
        resetCounter('doc-sr-no');
        generateSelect2();
        datePicker();
        $('#ips_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitIps($('#submit_btn_for_ips'));
            }
        });
    },
    openMapForCAF: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var mapData = {};
        mapData.lat = $('#latitude_for_ips').val();
        mapData.lng = $('#longitude_for_ips').val();
        mapData.lat_display = mapData.lat;
        mapData.lng_display = mapData.lng;
        if (mapData.lat == '' || mapData.lat == VALUE_ZERO) {
            mapData.lat = DAMAN_LAT;
        }
        if (mapData.lng == '' || mapData.lng == VALUE_ZERO) {
            mapData.lng = DAMAN_LNG;
        }
        showPopup();
        $('.swal2-popup').css('width', '70em');
        $('#popup_container').html(ipsMapTemplate(mapData));

        loadMap('map_container_for_ips', 'latitude_for_ips', 'longitude_for_ips', mapData, true);
    },
    resetAndClose: function () {
        $('.latitude_for_ips').val(VALUE_ZERO);
        $('.longitude_for_ips').val(VALUE_ZERO);
        Swal.close();
    },
    editOrViewIps: function (btnObj, ipsId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ipsId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ips/get_ips_data_by_id',
            type: 'post',
            data: $.extend({}, {'ips_id': ipsId}, getTokenData()),
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
                    return false;
                }
                var ipsData = parseData.ips_data;
                if (isEdit) {
                    that.newIpsForm(isEdit, ipsData);
                } else {
                    that.viewIpsForm(ipsData);
                }
            }
        });
    },
    viewIpsForm: function (ipsData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        ipsData.VALUE_ONE = VALUE_ONE;
        ipsData.VALUE_TWO = VALUE_TWO;
        ipsData.VALUE_THREE = VALUE_THREE;
        ipsData.VALUE_FOUR = VALUE_FOUR;
        ipsData.VALUE_FIVE = VALUE_FIVE;
        ipsData.VALUE_SIX = VALUE_SIX;
        ipsData.VALUE_SEVEN = VALUE_SEVEN;
        ipsData.VALUE_EIGHT = VALUE_EIGHT;
        ipsData.VALUE_NINE = VALUE_NINE;
        ipsData.VALUE_TEN = VALUE_TEN;
        ipsData.VALUE_ELEVEN = VALUE_ELEVEN;
        ipsData.VALUE_TWELVE = VALUE_TWELVE;
        ipsData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        ipsData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        ipsData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        ipsData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        ipsData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        ipsData.VALUE_EIGHTEEN = VALUE_EIGHTEEN;
        ipsData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        ipsData.application_number = regNoRenderer(VALUE_FIFTYONE, ipsData.ips_id);
        ipsData.district_text = talukaArray[ipsData.district] ? talukaArray[ipsData.district] : '';
        ipsData.owner_category_text = ownerCategoryArray[ipsData.owner_category] ? ownerCategoryArray[ipsData.owner_category] : '';
        ipsData.caste_category_text = casteCategoryArray[ipsData.caste_category] ? casteCategoryArray[ipsData.caste_category] : '';
        ipsData.constitution_text = ipsData.constitution == VALUE_FIVE ? ipsData.other_constitution : (constitutionArray[ipsData.constitution] ? constitutionArray[ipsData.constitution] : '');
        ipsData.unit_category_text = unitCategoryArray[ipsData.unit_category] ? unitCategoryArray[ipsData.unit_category] : '';
        if (ipsData.unit_category == VALUE_ONE) {
            ipsData.msme_category_text = msmeTypeArray[ipsData.msme_category] ? msmeTypeArray[ipsData.msme_category] : '';
            ipsData.show_unit_category_one = true;
        }
//        if (ipsData.unit_category == VALUE_TWO) {
//            ipsData.show_unit_category_two = true;
//        }
        ipsData.entrepreneur_category_text = getCheckboxValue(ipsData.entrepreneur_category, entrepreneurCategoryArray);

        if (ipsData.entrepreneur_category == VALUE_THREE || $.inArray('3', ipsData.entrepreneur_category) != -1) {
            ipsData.show_entrepreneur_category_dob_details = true;
            ipsData.birth_date_text = ipsData.birth_date != '0000-00-00' ? dateTo_DD_MM_YYYY(ipsData.birth_date) : '';
        }
        ipsData.unit_type_text = getCheckboxValue(ipsData.unit_type, unitTypeArray);
        if (ipsData.unit_type == VALUE_FIVE || $.inArray('5', ipsData.unit_type) != -1) {
            ipsData.show_unit_type_three = true;
        }
        if (ipsData.unit_type == VALUE_SIX || $.inArray('6', ipsData.unit_type) != -1) {
            ipsData.show_unit_type_four = true;
        }
        ipsData.sector_category_text = sectorCategoryArray[ipsData.sector_category] ? sectorCategoryArray[ipsData.sector_category] : '';
        ipsData.thrust_sectors_text = getCheckboxValue(ipsData.thrust_sectors, thrustSectorsArray);
        ipsData.commencement_date_text = ipsData.commencement_date != '0000-00-00' ? dateTo_DD_MM_YYYY(ipsData.commencement_date) : '';

        ipsData.latitude = parseFloat(ipsData.latitude);
        ipsData.longitude = parseFloat(ipsData.longitude);
        if (ipsData.latitude != VALUE_ZERO || ipsData.longitude != VALUE_ZERO) {
            ipsData.show_map = true;
        }

        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(ipsViewTemplate(ipsData));

        if (ipsData.show_map) {
            var mapData = {};
            mapData.lat = ipsData.latitude;
            mapData.lng = ipsData.longitude;
            loadMap('map_container_for_ips_view', '', '', mapData, false);
        }

        var docData = {};
        docData.ips_id = ipsData.ips_id;
//        if (ipsData.unit_category == VALUE_ONE) {
//            if (ipsData.unit_doc != '') {
//                docData.file_name = ipsData.unit_doc;
//                that.loadIpsDocumentForView(VALUE_ONE, docData);
//            }
//        }
//        if (ipsData.unit_category == VALUE_TWO) {
//            if (ipsData.non_msme_doc != '') {
//                docData.file_name = ipsData.non_msme_doc;
//                that.loadIpsDocumentForView(VALUE_TWO, docData);
//            }
//        }
        if (ipsData.entrepreneur_category == VALUE_THREE || $.inArray('3', ipsData.entrepreneur_category) != -1) {
            if (ipsData.birth_doc != '') {
                docData.file_name = ipsData.birth_doc;
                that.loadIpsDocumentForView(VALUE_THREE, docData);
            }
        }
        if (ipsData.udyam_regi_doc != '') {
            docData.file_name = ipsData.udyam_regi_doc;
            that.loadIpsDocumentForView(VALUE_FOUR, docData);
        }
        if (ipsData.partnership_deed_doc != '') {
            docData.file_name = ipsData.partnership_deed_doc;
            that.loadIpsDocumentForView(VALUE_FIVE, docData);
        }
        if (ipsData.enterprise_doc != '') {
            docData.file_name = ipsData.enterprise_doc;
            that.loadIpsDocumentForView(VALUE_SIX, docData);
        }
        if (ipsData.ent_leased_doc != '') {
            docData.file_name = ipsData.ent_leased_doc;
            that.loadIpsDocumentForView(VALUE_SEVEN, docData);
        }
        if (ipsData.electricity_doc != '') {
            docData.file_name = ipsData.electricity_doc;
            that.loadIpsDocumentForView(VALUE_EIGHT, docData);
        }
        if (ipsData.authorization_doc != '') {
            docData.file_name = ipsData.authorization_doc;
            that.loadIpsDocumentForView(VALUE_NINE, docData);
        }
        if (ipsData.pcc_doc != '') {
            docData.file_name = ipsData.pcc_doc;
            that.loadIpsDocumentForView(VALUE_TEN, docData);
        }
        if (ipsData.factory_license_doc != '') {
            docData.file_name = ipsData.factory_license_doc;
            that.loadIpsDocumentForView(VALUE_ELEVEN, docData);
        }
//        if (ipsData.clearnces_doc != '') {
//            docData.file_name = ipsData.clearnces_doc;
//            that.loadIpsDocumentForView(VALUE_TWELVE, docData);
//        }
        if (ipsData.ur_cin_doc != '') {
            docData.file_name = ipsData.ur_cin_doc;
            that.loadIpsDocumentForView(VALUE_THIRTEEN, docData);
        }
        if (ipsData.ur_tin_doc != '') {
            docData.file_name = ipsData.ur_tin_doc;
            that.loadIpsDocumentForView(VALUE_FOURTEEN, docData);
        }
        if (ipsData.ur_pan_doc != '') {
            docData.file_name = ipsData.ur_pan_doc;
            that.loadIpsDocumentForView(VALUE_FIFTEEN, docData);
        }
        if (ipsData.ur_gst_doc != '') {
            docData.file_name = ipsData.ur_gst_doc;
            that.loadIpsDocumentForView(VALUE_SIXTEEN, docData);
        }
        if (ipsData.ur_other_doc != '') {
            docData.file_name = ipsData.ur_other_doc;
            that.loadIpsDocumentForView(VALUE_SEVENTEEN, docData);
        }
        if (ipsData.undertaking_doc != '') {
            docData.file_name = ipsData.undertaking_doc;
            that.loadIpsDocumentForView(VALUE_EIGHTEEN, docData);
        }
        resetCounter('view-doc-sr-no');
    },
    checkValidationForIps: function (ipsData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ipsData.district_for_ips) {
            return getBasicMessageAndFieldJSONArray('district_for_ips', selectDistrictValidationMessage);
        }
        if (!ipsData.owner_name_for_ips) {
            return getBasicMessageAndFieldJSONArray('owner_name_for_ips', ownerNameValidationMessage);
        }
        if (!ipsData.owner_category_for_ips) {
            return getBasicMessageAndFieldJSONArray('owner_category_for_ips', selectOneOptionValidationMessage);
        }
        if (!ipsData.email_for_ips) {
            return getBasicMessageAndFieldJSONArray('email_for_ips', emailValidationMessage);
        }
        var emailMessage = emailIdValidation(ipsData.email_for_ips);
        if (emailMessage != '') {
            return getBasicMessageAndFieldJSONArray('email_for_ips', emailMessage);
        }
        if (!ipsData.mobile_no_for_ips) {
            return getBasicMessageAndFieldJSONArray('mobile_no_for_ips', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(ipsData.mobile_no_for_ips);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_no_for_ips', mobileMessage);
        }
        if (ipsData.aadhar_no_for_ips != '') {
            var aadharMess = checkUID(ipsData.aadhar_no_for_ips);
            if (aadharMess != '') {
                return getBasicMessageAndFieldJSONArray('aadhar_no_for_ips', aadharMess);
            }
        }
        if (!ipsData.pan_no_for_ips) {
            return getBasicMessageAndFieldJSONArray('pan_no_for_ips', panCardValidationMessage);
        }
        var panMessage = PANValidation(ipsData.pan_no_for_ips);
        if (panMessage != '') {
            return getBasicMessageAndFieldJSONArray('pan_no_for_ips', panMessage);
        }
        if (!ipsData.caste_category_for_ips) {
            return getBasicMessageAndFieldJSONArray('caste_category_for_ips', selectOneOptionValidationMessage);
        }
        if (!ipsData.ap_name_for_ips) {
            return getBasicMessageAndFieldJSONArray('ap_name_for_ips', apNameValidationMessage);
        }
        if (!ipsData.ap_name_for_ips) {
            return getBasicMessageAndFieldJSONArray('ap_name_for_ips', apNameValidationMessage);
        }
        if (!ipsData.ap_designation_for_ips) {
            return getBasicMessageAndFieldJSONArray('ap_designation_for_ips', apDesignationValidationMessage);
        }
        if (!ipsData.ap_email_for_ips) {
            return getBasicMessageAndFieldJSONArray('ap_email_for_ips', emailValidationMessage);
        }
        var apEmailMessage = emailIdValidation(ipsData.ap_email_for_ips);
        if (apEmailMessage != '') {
            return getBasicMessageAndFieldJSONArray('ap_email_for_ips', apEmailMessage);
        }
        if (!ipsData.ap_mobile_for_ips) {
            return getBasicMessageAndFieldJSONArray('ap_mobile_for_ips', mobileValidationMessage);
        }
        var apMobileMessage = mobileNumberValidation(ipsData.ap_mobile_for_ips);
        if (apMobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('ap_mobile_for_ips', apMobileMessage);
        }
        if (!ipsData.udyam_registration_for_ips) {
            return getBasicMessageAndFieldJSONArray('udyam_registration_for_ips', registrationNumberValidationMessage);
        }
        if (!ipsData.ur_pan_no_for_ips) {
            return getBasicMessageAndFieldJSONArray('ur_pan_no_for_ips', panCardValidationMessage);
        }
        var panMessage = PANValidation(ipsData.ur_pan_no_for_ips);
        if (panMessage != '') {
            return getBasicMessageAndFieldJSONArray('ur_pan_no_for_ips', panMessage);
        }
        if ($('#upload_container_for_ips_' + VALUE_FIFTEEN).is(':visible')) {
            var uploadOne = $('#upload_for_ips_' + VALUE_FIFTEEN).val();
            if (uploadOne == '') {
                $('#upload_for_ips_' + VALUE_FIFTEEN).focus();
                return getBasicMessageAndFieldJSONArray('upload_for_ips_' + VALUE_FIFTEEN, uploadDocumentValidationMessage);
            }
        }
        if (!ipsData.manu_name_for_ips) {
            return getBasicMessageAndFieldJSONArray('manu_name_for_ips', manufactureNameValidationMessage);
        }
        if (!ipsData.main_plant_address_for_ips) {
            return getBasicMessageAndFieldJSONArray('main_plant_address_for_ips', addressValidationMessage);
        }
        if (!ipsData.office_address_for_ips) {
            return getBasicMessageAndFieldJSONArray('office_address_for_ips', officeAddressValidationMessage);
        }
        if (!ipsData.constitution_for_ips) {
            $('#constitution_for_ips_1').focus();
            return getBasicMessageAndFieldJSONArray('constitution_for_ips', selectOneOptionValidationMessage);
        }
        if (ipsData.constitution_for_ips == VALUE_FIVE) {
            if (!ipsData.other_constitution_for_ips) {
                $('#other_constitution_for_ips_1').focus();
                return getBasicMessageAndFieldJSONArray('other_constitution_for_ips', detailsValidationMessage);
            }
        }
        if (!ipsData.unit_category_for_ips) {
            $('#unit_category_for_ips_1').focus();
            return getBasicMessageAndFieldJSONArray('unit_category_for_ips', selectOneOptionValidationMessage);
        }
        if (ipsData.unit_category_for_ips == VALUE_ONE) {
            if (!ipsData.msme_category_for_ips) {
                $('#msme_category_for_ips_1').focus();
                return getBasicMessageAndFieldJSONArray('msme_category_for_ips', selectOneOptionValidationMessage);
            }
//            if ($('#upload_container_for_ips_' + VALUE_ONE).is(':visible')) {
//                var uploadOne = $('#upload_for_ips_' + VALUE_ONE).val();
//                if (uploadOne == '') {
//                    $('#upload_for_ips_' + VALUE_ONE).focus();
//                    return getBasicMessageAndFieldJSONArray('upload_for_ips_' + VALUE_ONE, uploadDocumentValidationMessage);
//                }
//            }
        }
//        if (ipsData.unit_category_for_ips == VALUE_TWO) {
//            if ($('#upload_container_for_ips_' + VALUE_TWO).is(':visible')) {
//                var uploadTwo = $('#upload_for_ips_' + VALUE_TWO).val();
//                if (uploadTwo == '') {
//                    $('#upload_for_ips_' + VALUE_TWO).focus();
//                    return getBasicMessageAndFieldJSONArray('upload_for_ips_' + VALUE_TWO, uploadDocumentValidationMessage);
//                }
//            }
//        }
        if (ipsData.entrepreneur_category_for_ips == VALUE_THREE || $.inArray('3', ipsData.entrepreneur_category_for_ips) != -1) {
            if (!ipsData.birth_date_for_ips) {
                $('#birth_date_for_ips').focus();
                return getBasicMessageAndFieldJSONArray('birth_date_for_ips', dateValidationMessage);
            }
            if ($('#upload_container_for_ips_' + VALUE_THREE).is(':visible')) {
                var uploadThree = $('#upload_for_ips_' + VALUE_THREE).val();
                if (uploadThree == '') {
                    $('#upload_for_ips_' + VALUE_THREE).focus();
                    return getBasicMessageAndFieldJSONArray('upload_for_ips_' + VALUE_THREE, uploadDocumentValidationMessage);
                }
            }
        }
        if (!ipsData.unit_type_for_ips) {
            $('#unit_type_for_ips_1').focus();
            return getBasicMessageAndFieldJSONArray('unit_type_for_ips', selectOneOptionValidationMessage);
        }
        if (ipsData.unit_type_for_ips == VALUE_FIVE || $.inArray('5', ipsData.unit_type_for_ips) != -1) {
            if (!ipsData.manufacuring_unit_for_ips) {
                $('#manufacuring_unit_for_ips').focus();
                return getBasicMessageAndFieldJSONArray('manufacuring_unit_for_ips', detailValidationMessage);
            }
            if (!ipsData.diversification_unit_for_ips) {
                $('#diversification_unit_for_ips').focus();
                return getBasicMessageAndFieldJSONArray('diversification_unit_for_ips', detailValidationMessage);
            }
        }
        if (ipsData.unit_type_for_ips == VALUE_SIX || $.inArray('6', ipsData.unit_type_for_ips) != -1) {
            if (!ipsData.service_unit_for_ips) {
                $('#service_unit_for_ips').focus();
                return getBasicMessageAndFieldJSONArray('service_unit_for_ips', detailValidationMessage);
            }
            if (!ipsData.diversification_service_for_ips) {
                $('#manufacuring_unit_for_ips').focus();
                return getBasicMessageAndFieldJSONArray('diversification_service_for_ips', detailValidationMessage);
            }

        }
        if (!ipsData.sector_category_for_ips) {
            $('#sector_category_for_ips_1').focus();
            return getBasicMessageAndFieldJSONArray('sector_category_for_ips', selectOneOptionValidationMessage);
        }
        if (!ipsData.commencement_date_for_ips) {
            return getBasicMessageAndFieldJSONArray('commencement_date_for_ips', dateValidationMessage);
        }
        if (!ipsData.gfc_investment_for_ips) {
            return getBasicMessageAndFieldJSONArray('gfc_investment_for_ips', investmentValidationMessage);
        }
        return '';
    },
    submitIps: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var ipsData = $('#ips_form').serializeFormJSON();
        var validationData = that.checkValidationForIps(ipsData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('ips-' + validationData.field, validationData.message);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ips/submit_ips',
            data: $.extend({}, ipsData, getTokenData()),
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
                validationMessageShow('ips', textStatus.statusText);
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
                    validationMessageShow('ips', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Ips.listview.showIncentives(parseData.ips_id);
                showSuccess(parseData.message);
            }
        });
    },
    uploadDocumentForIps: function (fileNo) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (!fileNo) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var ipsId = $('#ips_id_for_ips').val();
        if ($('#upload_for_ips_' + fileNo).val() != '') {
            var uploadIPSDoc = checkValidationForDocument('upload_for_ips_' + fileNo, VALUE_ONE, 'ips', 10240);
            if (uploadIPSDoc == false) {
                $('#upload_for_ips_' + fileNo).val('');
                return false;
            }
        }
        openFullPageOverlay();
        $('#upload_container_for_ips_' + fileNo).hide();
        $('#upload_name_container_for_ips_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var formData = new FormData();
        formData.append('file_number_for_ips', fileNo);
        formData.append('ips_id_for_ips', ipsId);
        formData.append('document_file', $('#upload_for_ips_' + fileNo)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'ips/upload_ips_document',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function (textStatus, errorThrown) {
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                closeFullPageOverlay();
                $('#upload_name_container_for_ips_' + fileNo).hide();
                $('#spinner_template_' + fileNo).hide();
                $('#upload_container_for_ips_' + fileNo).show();
                showError(textStatus.statusText);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                closeFullPageOverlay();
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    $('#upload_name_container_for_ips_' + fileNo).hide();
                    $('#spinner_template_' + fileNo).hide();
                    $('#upload_container_for_ips_' + fileNo).show();
                    showError(parseData.message);
                    return false;
                }
                var ipsData = parseData.ips_data;
                $('#ips_id_for_ips').val(ipsData.ips_id);
                that.loadIpsDocument(fileNo, ipsData);
            }
        });
    },
    loadIpsDocument: function (fileNo, ipsData) {
        $('#upload_for_ips_' + fileNo).val('');
        $('#upload_name_href_for_ips_' + fileNo).attr('href', 'documents/ips/' + ipsData.file_name);
        $('#remove_document_btn_for_ips_' + fileNo).attr('onclick', 'Ips.listview.askForRemove("' + ipsData.ips_id + '", "' + fileNo + '")');
        $('#upload_container_for_ips_' + fileNo).hide();
        $('#upload_name_container_for_ips_' + fileNo).show();
        $('#spinner_template_' + fileNo).hide();
    },
    loadIpsDocumentForView: function (fileNo, ipsData) {
        $('#upload_name_href_for_ips_' + fileNo).attr('href', 'documents/ips/' + ipsData.file_name);
        $('#upload_container_for_ips_' + fileNo).hide();
        $('#upload_name_container_for_ips_' + fileNo).show();
    },
    askForRemove: function (ipsId, fileNo) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!ipsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Ips.listview.removeDocument(\'' + ipsId + '\',\'' + fileNo + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (ipsId, fileNo) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!ipsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#upload_container_for_ips_' + fileNo).hide();
        $('#upload_name_container_for_ips_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        $.ajax({
            type: 'POST',
            url: 'ips/remove_document',
            data: $.extend({}, {'ips_id_for_ips': ipsId, 'file_number_for_ips': fileNo}, getTokenData()),
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
                $('#upload_container_for_ips_' + fileNo).hide();
                $('#upload_name_container_for_ips_' + fileNo).show();
                $('#spinner_template_' + fileNo).hide();
                validationMessageShow('ips', textStatus.statusText);
            },
            success: function (response) {
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    $('#upload_container_for_ips_' + fileNo).hide();
                    $('#upload_name_container_for_ips_' + fileNo).show();
                    $('#spinner_template_' + fileNo).hide();
                    validationMessageShow('ips', parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                $('#upload_for_ips_' + fileNo).val('');
                $('#upload_name_href_for_ips_' + fileNo).attr('href', '');
                $('#remove_document_btn_for_ips_' + fileNo).attr('onclick', '');
                $('#upload_name_container_for_ips_' + fileNo).hide();
                $('#upload_container_for_ips_' + fileNo).show();
                $('#spinner_template_' + fileNo).hide();
            }
        });
    },
    showIncentives: function (ipsId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ipsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        activeLink('menu_dept_services');
        Ips.router.navigate('ips_incentives/' + ipsId);
        this.$el.html(ipsIncListTemplate);
        $('#incentives_form_and_datatable_container').html(pageSpinnerTemplate);
        var that = this;
        $.ajax({
            url: 'ips/get_ips_data_by_id',
            type: 'post',
            data: $.extend({}, {'ips_id': ipsId}, getTokenData()),
            async: false,
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
                Ips.listview.listPage();
                showError(textStatus.statusText);
            },
            success: function (response) {
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    Ips.listview.listPage();
                    return false;
                }
                var ipsData = parseData.ips_data;
                ipsData.application_number = regNoRenderer(VALUE_FIFTYONE, ipsData.ips_id);
                ipsData.district_text = talukaArray[ipsData.district] ? talukaArray[ipsData.district] : '';
                $('#incentives_ips_details_container').html(ipsDetailsTemplate(ipsData));
                that.loadIncentivesData(ipsData.ips_id);
            }
        });
    },
    ipsActionRenderer: function (rowData) {
        if (rowData.status == VALUE_ZERO || rowData.status == VALUE_ONE ||
                (rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX && rowData.query_status == VALUE_ONE)) {
            rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE && rowData.status != VALUE_TWO && rowData.status != VALUE_SIX && rowData.status != VALUE_NINE) {
            if (rowData.payment_type != VALUE_THREE) {
                rowData.ADMIN_IPS_INC_DOC_PATH = ADMIN_IPS_INC_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        rowData.module_type = VALUE_NINE;
        return ipsIncActionTemplate(rowData);
    },
    loadIncentivesData: function (ipsId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_FIFTYTWO, data);
        };
        var schemeTypeRenderer = function (data, type, full, meta) {
            return schemeTypeArray[data] ? schemeTypeArray[data] : '';
        };
        var schemeRenderer = function (data, type, full, meta) {
            return schemeArray[data] ? (schemeArray[data][full.scheme] ? schemeArray[data][full.scheme] : '') : '';
        };
        var that = this;
        Ips.router.navigate('ips_incentives/' + ipsId);
        $('#incentives_form_and_datatable_container').html(ipsIncTableTemplate);
        incentivesDataTable = $('#incentives_datatable').DataTable({
            ajax: {url: 'ips/get_incentives_data', dataSrc: "incentives_data", type: "post", data: $.extend({}, {'ips_id': ipsId}, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [{data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'ips_incentive_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'scheme_type', 'render': schemeTypeRenderer},
                {data: 'scheme_type', 'render': schemeRenderer},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'ips_incentive_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'ips_incentive_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#incentives_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = incentivesDataTable.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(that.ipsActionRenderer(row.data())).show();
                tr.addClass('shown');
            }
        });
    },
    cancelIncentivesForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var ipsId = $('#ips_id_for_inc_list').val();
        if (!ipsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        this.loadIncentivesData(ipsId);
    },
    newIncentivesForm: function (isEdit, incData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (isEdit) {
            if (incData.status != VALUE_FIVE && incData.status != VALUE_SIX && incData.query_status == VALUE_ONE) {
                incData.show_submit_qr_details = true;
            }
        }
        var that = this;
        incData.no_record_fount_for_doc = noRecordFoundTemplate({'colspan': 3, 'message': 'Document Not Available !'});
        $('#incentives_form_and_datatable_container').html(ipsIncFormTemplate(incData));
        renderOptionsForTwoDimensionalArray(schemeTypeArray, 'scheme_type_for_incentives');
        var tscArray = isEdit ? (schemeArray[incData.scheme_type] ? schemeArray[incData.scheme_type] : []) : [];
        renderOptionsForTwoDimensionalArray(tscArray, 'scheme_for_incentives');
        if (isEdit) {
            $('#scheme_type_for_incentives').val(incData.scheme_type);
            $('#scheme_for_incentives').val(incData.scheme);
            that.loadIncReferenceDocument(incData.scheme);
            that.loadIncDocument(incData.scheme, incData.doc_details);
        }
        generateSelect2();
        $('#incentive_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitIncentives(incData.show_submit_qr_details ? VALUE_FOUR : VALUE_THREE);
            }
        });
    },
    ICChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'scheme_for_incentives');
        $('#scheme_for_incentives').val('');
        $('.doc_item_incentives').html(noRecordFoundTemplate({'colspan': 3, 'message': 'Document Not Available !'}));
        var schemeType = obj.val();
        if (!schemeType) {
            return false;
        }
        var tscArray = schemeArray[schemeType] ? schemeArray[schemeType] : [];
        renderOptionsForTwoDimensionalArray(tscArray, 'scheme_for_incentives');

    },
    schemeChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('.doc_item_incentives').html(noRecordFoundTemplate({'colspan': 3, 'message': 'Document Not Available !'}));
        var scheme = obj.val();
        if (!scheme) {
            return false;
        }
        this.loadIncReferenceDocument(scheme);
        this.loadIncDocument(scheme);
    },
    loadIncReferenceDocument: function (scheme) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var refDoc = schemeRefDocArray[scheme] ? schemeRefDocArray[scheme] : [];
        $.each(refDoc, function (index, rdData) {
            if (index == 0) {
                $('#doc_format_item_container_for_incentives').html('');
            }
            rdData.doc_cnt = (index + 1);
            $('#doc_format_item_container_for_incentives').append(ipsIncRefDocItemTemplate(rdData));
        });
    },
    loadIncDocument: function (scheme, docDetails) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (typeof docDetails == "undefined") {
            docDetails = '';
        } else {
            $('#scheme_type_for_incentives').attr("disabled", 'disabled');
            $('#scheme_for_incentives').attr("disabled", 'disabled');
        }
        var that = this;
        var sDoc = schemeDocArray[scheme] ? schemeDocArray[scheme] : [];
        var dCnt = 1;
        $.each(sDoc, function (docId, docName) {
            if (dCnt == 1) {
                $('#doc_item_container_for_incentives').html('');
            }
            var sdData = {};
            sdData.doc_cnt = dCnt;
            sdData.doc_id = docId;
            sdData.doc_name = docName;
            sdData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
            $('#doc_item_container_for_incentives').append(ipsIncDocItemTemplate(sdData));
            if (docDetails != '') {
                var exDoc = docDetails[docId] ? docDetails[docId] : '';
                if (exDoc != '') {
                    that.loadIncentivesDocument(docId, exDoc);
                }
            }
            dCnt++;
        });
    },
    askForSubmitIncentives: function (moduleType) {
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
        var yesEvent = 'Ips.listview.submitIncentives(' + newMType + ')';
        showConfirmation(yesEvent, 'Submit');
    },
    checkValidationForIncentives: function (formData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formData.scheme_type_for_incentives) {
            return getBasicMessageAndFieldJSONArray('scheme_type_for_incentives', oneOptionValidationMessage);
        }
        if (!formData.scheme_for_incentives) {
            return getBasicMessageAndFieldJSONArray('scheme_for_incentives', oneOptionValidationMessage);
        }
        if ($('#upload_container_for_incentives_' + VALUE_ONE).is(':visible')) {
            var uploadOne = $('#upload_for_incentives_' + VALUE_ONE).val();
            if (uploadOne == '') {
                $('#upload_for_incentives_' + VALUE_ONE).focus();
                return getBasicMessageAndFieldJSONArray('upload_for_incentives_' + VALUE_ONE, uploadDocumentValidationMessage);
            }
        }
        return '';
    },
    submitIncentives: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FOUR && moduleType != VALUE_FIVE) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var ipsId = $('#ips_id_for_inc_list').val();
        if (!ipsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        validationMessageHide();
        var formData = {};
        formData.scheme_type_for_incentives = $('#scheme_type_for_incentives').val();
        formData.scheme_for_incentives = $('#scheme_for_incentives').val();
        formData.ips_incentive_id_for_incentives = $('#ips_incentive_id_for_incentives').val();
        var validationDataOne = that.checkValidationForIncentives(formData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('incentives-' + validationDataOne.field, validationDataOne.message);
            return false;
        }
        if (!formData.ips_incentive_id_for_incentives) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType == VALUE_THREE) {
            that.askForSubmitIncentives(moduleType);
            return false;
        }
        if (moduleType == VALUE_FOUR || moduleType == VALUE_FIVE) {
            var status = $('#status_for_incentives').val();
            var queryStatus = $('#query_status_for_incentives').val();
            if (status != VALUE_FIVE && status != VALUE_SIX && queryStatus == VALUE_ONE) {
                var qrRemarks = $('#remarks_for_incentives').val();
                if (!qrRemarks) {
                    $('#remarks_for_incentives').focus();
                    validationMessageShow('qrinc-remarks_for_incentives', remarksValidationMessage);
                    return false;
                }
                formData.qr_remarks = qrRemarks;
            } else {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (moduleType == VALUE_FOUR) {
                that.askForSubmitIncentives(moduleType);
                return false;
            }
        }
        formData.ips_id = ipsId;
        formData.module_type = moduleType;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_incentives') : $('#submit_btn_for_incentives');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ips/submit_incentives',
            data: $.extend({}, formData, getTokenData()),
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
                validationMessageShow('incentives', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    validationMessageShow('incentives', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                that.loadIncentivesData(ipsId);
            }
        });
    },
    editOrViewIncentives: function (btnObj, ipsIncentiveId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ipsIncentiveId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ips/get_incentive_data_by_id',
            type: 'post',
            data: $.extend({}, {'ips_incentive_id': ipsIncentiveId, 'is_edit': (isEdit ? VALUE_ZERO : VALUE_ONE)}, getTokenData()),
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
                    return false;
                }
                var incentiveData = parseData.incentive_data;
                if (isEdit) {
                    that.newIncentivesForm(isEdit, incentiveData);
                } else {
                    that.viewIncentiveForm(incentiveData);
                }
            }
        });
    },
    viewIncentiveForm: function (incentiveData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        incentiveData.application_number = regNoRenderer(VALUE_FIFTYTWO, incentiveData.ips_incentive_id);
        incentiveData.scheme_type_text = schemeTypeArray[incentiveData.scheme_type] ? schemeTypeArray[incentiveData.scheme_type] : '';
        incentiveData.scheme_text = schemeArray[incentiveData.scheme_type] ? (schemeArray[incentiveData.scheme_type][incentiveData.scheme] ? schemeArray[incentiveData.scheme_type][incentiveData.scheme] : '') : '';
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(ipsIncViewTemplate(incentiveData));
        var docDetails = incentiveData.doc_details;
        var schemeDocuments = schemeDocArray[incentiveData.scheme] ? schemeDocArray[incentiveData.scheme] : '';
        var tCnt = 1;
        $.each(schemeDocuments, function (docId, docNameText) {
            var docData = docDetails[docId] ? docDetails[docId] : {};
            docData.doc_cnt = tCnt;
            docData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
            docData.doc_id = docId;
            docData.doc_name_text = docNameText;
            $('#doc_item_container_for_view_incentives').append(ipsIncDocItemViewTemplate(docData));
            if (docData.doc_name) {
                that.loadIncentivesDocumentForView(docData.doc_id, docData);
            }
            tCnt++;
        });
        if (tCnt == 1) {
            $('#doc_item_container_for_view_incentives').html(noRecordFoundTemplate({'colspan': 3, 'message': 'Document Not Available !'}));
        }
    },
    uploadIncDocument: function (docId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (!docId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var ipsId = $('#ips_id_for_inc_list').val();
        if (!ipsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var schemeType = $('#scheme_type_for_incentives').val();
        if (!schemeType) {
            $('#scheme_type_for_incentives').focus();
            validationMessageShow('incentives-scheme_type_for_incentives', oneOptionValidationMessage);
            return false;
        }
        var scheme = $('#scheme_for_incentives').val();
        if (!scheme) {
            $('#scheme_for_incentives').focus();
            validationMessageShow('incentives-scheme_for_incentives', oneOptionValidationMessage);
            return false;
        }
        var ipsIncentiveId = $('#ips_incentive_id_for_incentives').val();
        if ($('#upload_for_incentives_' + docId).val() != '') {
            var uploadIPSDoc = checkValidationForDocument('upload_for_incentives_' + docId, VALUE_ONE, 'incentives', 10240);
            if (uploadIPSDoc == false) {
                $('#upload_for_incentives_' + docId).val('');
                return false;
            }
        }
        openFullPageOverlay();
        $('#upload_container_for_incentives_' + docId).hide();
        $('#upload_name_container_for_incentives_' + docId).hide();
        $('#spinner_template_' + docId).show();
        var formData = new FormData();
        formData.append('doc_id_for_incentives', docId);
        formData.append('ips_id_for_incentives', ipsId);
        formData.append('ips_incentive_id_for_incentives', ipsIncentiveId);
        formData.append('scheme_type_for_incentives', schemeType);
        formData.append('scheme_for_incentives', scheme);
        formData.append('document_file', $('#upload_for_incentives_' + docId)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'ips/upload_incentives_document',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function (textStatus, errorThrown) {
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                closeFullPageOverlay();
                $('#upload_name_container_for_incentives_' + docId).hide();
                $('#spinner_template_' + docId).hide();
                $('#upload_container_for_incentives_' + docId).show();
                showError(textStatus.statusText);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                closeFullPageOverlay();
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    $('#upload_name_container_for_incentives_' + docId).hide();
                    $('#spinner_template_' + docId).hide();
                    $('#upload_container_for_incentives_' + docId).show();
                    showError(parseData.message);
                    return false;
                }
                var incentiveData = parseData.ips_data;
                $('#ips_incentive_id_for_incentives').val(incentiveData.ips_incentive_id);
                $('#scheme_type_for_incentives').attr("disabled", 'disabled');
                $('#scheme_for_incentives').attr("disabled", 'disabled');
                that.loadIncentivesDocument(docId, incentiveData);
            }
        });
    },
    loadIncentivesDocument: function (docId, docData) {
        $('#upload_for_incentives_' + docId).val('');
        $('#upload_name_href_for_incentives_' + docId).attr('href', 'documents/ips_inc/' + docData.doc_name);
        $('#remove_document_btn_for_incentives_' + docId).attr('onclick', 'Ips.listview.askForRemoveIncDocument("' + docData.ips_incentive_id + '", "' + docId + '")');
        $('#upload_container_for_incentives_' + docId).hide();
        $('#upload_name_container_for_incentives_' + docId).show();
        $('#spinner_template_' + docId).hide();
    },
    loadIncentivesDocumentForView: function (fileNo, docData) {
        $('#upload_name_href_for_incentives_' + fileNo).attr('href', 'documents/ips_inc/' + docData.doc_name);
        $('#upload_container_for_incentives_' + fileNo).hide();
        $('#upload_name_container_for_incentives_' + fileNo).show();
    },
    askForRemoveIncDocument: function (ipsIncentiveId, docId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!ipsIncentiveId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Ips.listview.removeIncDocument(\'' + ipsIncentiveId + '\',\'' + docId + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeIncDocument: function (ipsIncentiveId, docId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var ipsId = $('#ips_id_for_inc_list').val();
        if (!ipsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!ipsIncentiveId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#upload_container_for_incentives_' + docId).hide();
        $('#upload_name_container_for_incentives_' + docId).hide();
        $('#spinner_template_' + docId).show();
        $.ajax({
            type: 'POST',
            url: 'ips/remove_incentives_document',
            data: $.extend({}, {
                'ips_id_for_incentives': ipsId,
                'ips_incentive_id_for_incentives': ipsIncentiveId,
                'doc_id_for_incentives': docId
            }, getTokenData()),
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
                $('#upload_container_for_incentives_' + docId).hide();
                $('#upload_name_container_for_incentives_' + docId).show();
                $('#spinner_template_' + docId).hide();
                validationMessageShow('incentives', textStatus.statusText);
            },
            success: function (response) {
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    $('#upload_container_for_incentives_' + docId).hide();
                    $('#upload_name_container_for_incentives_' + docId).show();
                    $('#spinner_template_' + docId).hide();
                    validationMessageShow('incentives', parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                $('#upload_for_incentives_' + docId).val('');
                $('#upload_name_href_for_incentives_' + docId).attr('href', '');
                $('#remove_document_btn_for_incentives_' + docId).attr('onclick', '');
                $('#upload_name_container_for_incentives_' + docId).hide();
                $('#upload_container_for_incentives_' + docId).show();
                $('#spinner_template_' + docId).hide();
            }
        });
    },
    getQueryData: function (ipsIncentiveId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ipsIncentiveId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_FIFTYTWO;
        templateData.module_id = ipsIncentiveId;
        var btnObj = $('#query_btn_for_incentives_' + ipsIncentiveId);
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
                tmpData.application_number = regNoRenderer(VALUE_FIFTYTWO, moduleData.ips_incentive_id);
                tmpData.applicant_name = moduleData.manu_name;
                tmpData.title = 'Manufacturing Unit / Service Unit Details';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    downloadUploadChallan: function (ipsIncentiveId) {
        if (!ipsIncentiveId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + ipsIncentiveId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ips/get_incentive_with_ips_data_by_id',
            type: 'post',
            data: $.extend({}, {'ips_incentive_id': ipsIncentiveId}, getTokenData()),
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
                var incentiveData = parseData.incentive_data;
                incentiveData.inc_application_number = regNoRenderer(VALUE_FIFTYTWO, incentiveData.ips_incentive_id);
                that.showChallan(incentiveData);
            }
        });
    },
    showChallan: function (incentiveData) {
        showPopup();
        if (incentiveData.status != VALUE_FIVE && incentiveData.status != VALUE_SIX && incentiveData.status != VALUE_SEVEN) {
            if (!incentiveData.hide_submit_btn) {
                incentiveData.show_fees_paid = true;
            }
        }
        if (incentiveData.payment_type == VALUE_ONE) {
            incentiveData.utitle = 'Fees Paid Challan Copy';
        } else {
            incentiveData.style = 'display: none;';
        }
        if (incentiveData.payment_type == VALUE_TWO) {
            incentiveData.show_dd_po_option = true;
            incentiveData.utitle = 'Demand Draft (DD)';
        }
        incentiveData.module_type = VALUE_FIFTYTWO;
        $('#popup_container').html(ipsIncUploadChallanTemplate(incentiveData));
        loadFB(VALUE_FIFTYTWO, incentiveData.fb_data);
        loadPH(VALUE_FIFTYTWO, incentiveData.ips_incentive_id, incentiveData.ph_data);

        if (incentiveData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'incentives_upload_challan', incentiveData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'incentives_upload_challan', 'uc', 'radio');
            if (incentiveData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_incentives_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (incentiveData.challan != '') {
            $('#challan_container_for_incentives_upload_challan').hide();
            $('#challan_name_container_for_incentives_upload_challan').show();
            $('#challan_name_href_for_incentives_upload_challan').attr('href', 'documents/ips_inc/' + incentiveData.challan);
            $('#challan_name_for_incentives_upload_challan').html(incentiveData.challan);
        }
        if (incentiveData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_incentives_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_incentives_upload_challan').show();
            $('#fees_paid_challan_name_href_for_incentives_upload_challan').attr('href', 'documents/ips_inc/' + incentiveData.fees_paid_challan);
            $('#fees_paid_challan_name_for_incentives_upload_challan').html(incentiveData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_incentives_upload_challan').attr('onclick', 'Ips.listview.removeFeesPaidChallan("' + incentiveData.ips_incentive_id + '")');
        }
    },
    removeFeesPaidChallan: function (ipsIncentiveId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!ipsIncentiveId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'ips/remove_fees_paid_challan',
            data: $.extend({}, {'ips_incentive_id': ipsIncentiveId}, getTokenData()),
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
                validationMessageShow('incentives-uc', textStatus.statusText);
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
                    validationMessageShow('incentives-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-incentives-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'incentives_upload_challan');
                $('#status_' + ipsIncentiveId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-incentives-uc').html('');
        validationMessageHide();
        var ipsIncentiveId = $('#ips_incentive_id_for_incentives_upload_challan').val();
        if (!ipsIncentiveId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_incentives_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_incentives_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_incentives_upload_challan').focus();
                validationMessageShow('incentives-uc-fees_paid_challan_for_incentives_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_incentives_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_incentives_upload_challan').focus();
                validationMessageShow('incentives-uc-fees_paid_challan_for_incentives_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_incentives_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#incentives_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'ips/upload_fees_paid_challan',
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
                validationMessageShow('incentives-uc', textStatus.statusText);
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
                    validationMessageShow('incentives-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + ipsIncentiveId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
});
