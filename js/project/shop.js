var shopListTemplate = Handlebars.compile($('#shop_list_template').html());
var shopTableTemplate = Handlebars.compile($('#shop_table_template').html());
var shopActionTemplate = Handlebars.compile($('#shop_action_template').html());
var shopFormTemplate = Handlebars.compile($('#shop_form_template').html());
var shopViewTemplate = Handlebars.compile($('#shop_view_template').html());
var shopApproveTemplate = Handlebars.compile($('#shop_approve_template').html());
var shopEmployeesViewItemTemplate = Handlebars.compile($('#shop_employees_view_item_template').html());
var shopEmployerFamilyViewItemTemplate = Handlebars.compile($('#shop_employer_family_item_template').html());
var shopEmployerFamilyInfoItemTemplate = Handlebars.compile($('#shop_employer_family_info_item_template').html());
var shopEmployeesInfoItemTemplate = Handlebars.compile($('#shop_employees_info_item_template').html());
var shopPartnerInfoItemTemplate = Handlebars.compile($('#shop_partner_info_item_template').html());
var shopUploadChallanTemplate = Handlebars.compile($('#shop_upload_challan_template').html());
var tempContractorCnt = 1;
var tempEmployeesCnt = 1;
var tempPartnerCnt = 1;

var Shop = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

Shop.Router = Backbone.Router.extend({
    routes: {
        'shop': 'renderList',
        'shop_form': 'renderListForForm',
        'edit_shop_form': 'renderList',
        'view_shop_form': 'renderList',
    },
    renderList: function () {
        Shop.listview.listPage();
    },
    renderListForForm: function () {
        Shop.listview.listPageShopForm();
    }
});

Shop.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="different_location_for_shop"]': 'hasDifferentLocationShopEvent',
    },
    hasDifferentLocationShopEvent: function (event) {
        var val = $('input[name=different_location_for_shop]:checked').val();
        if (val == IS_CHECKED_YES) {
            this.$('.shop_defferent_location').show();
        } else {
            this.$('.shop_defferent_location').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('menu_shop_and_establishment', 'active');
        Shop.router.navigate('shop');
        var templateData = {};
        this.$el.html(shopListTemplate(templateData));
        this.loadShopData(sDistrict, sStatus);
    },
    listPageShopForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        this.$el.html(shopListTemplate);
        this.newShop(false, {});
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
        return shopActionTemplate(rowData);
    },
    loadShopData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTYTHREE, data)
                    + getFRContainer(VALUE_THIRTYTHREE, data, full.rating, full.fr_datetime);
        };
        var that = this;
        Shop.router.navigate('shop');
        $('#shop_form_and_table_container').html(shopTableTemplate(searchData));
        shopDatatable = $('#shop_datatable').DataTable({
            ajax: {url: 'shop/get_all_shop', dataSrc: "shop_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            ordering: false,
            pageLength: 10,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 's_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 's_name'},
                {data: 's_category'},
                {data: 's_employer_name'},
                {data: 's_employer_residential_address'},
                {data: 's_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 's_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });

        $('#shop_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = shopDatatable.row(tr);

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
    askForNewShop: function (btnObj) {
        var that = this;
        that.newShop(false, {});
        that.addMultipleFamilyMembers({});
        that.addMultiplePartnerInfo({});
        datePicker();
    },
    newShop: function (isEdit, parseData) {
        var that = this;
        tempContractorCnt = 1;
        tempEmployeesCnt = 1;
        tempPartnerCnt = 1;

        if (isEdit) {
            Shop.router.navigate('edit_shop_form');
        } else {
            var formData = {};
            Shop.router.navigate('shop_form');
        }
        var formData = parseData;
        formData.is_checked = IS_CHECKED_YES;
        formData.VALUE_ONE = VALUE_ONE;
        formData.VALUE_TWO = VALUE_TWO;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;

        $('#shop_form_and_table_container').html(shopFormTemplate(formData));
        allowOnlyIntegerValue('mobile_no_employer_for_shop');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#regi_category').val(formData.regi_category);
            if (formData.lease_agreement_document != '') {
                that.showDocument('lease_agreement_document_container', 'lease_agreement_document_name_image', 'lease_agreement_document_name_container',
                        'lease_agreement_document_download', 'lease_agreement_document_remove_btn', formData.lease_agreement_document, formData.s_id, VALUE_ONE);
            }
            if (formData.house_tax_copy != '') {
                that.showDocument('house_tax_copy_container', 'house_tax_copy_name_image', 'house_tax_copy_name_container',
                        'house_tax_copy_download', 'house_tax_copy_remove_btn', formData.house_tax_copy, formData.s_id, VALUE_TWO);
            }
            if (formData.photo_of_shop != '') {
                that.showDocument('photo_of_shop_container', 'photo_of_shop_name_image', 'photo_of_shop_name_container',
                        'photo_of_shop_download', 'photo_of_shop_remove_btn', formData.photo_of_shop, formData.s_id, VALUE_THREE);
            }
            if (formData.aadhar_card != '') {
                that.showDocument('aadhar_card_container', 'aadhar_card_name_image', 'aadhar_card_name_container',
                        'aadhar_card_download', 'aadhar_card_remove_btn', formData.aadhar_card, formData.s_id, VALUE_FOUR);
            }
            if (formData.pan_card != '') {
                that.showDocument('pan_card_container', 'pan_card_name_image', 'pan_card_name_container',
                        'pan_card_download', 'pan_card_remove_btn', formData.pan_card, formData.s_id, VALUE_FIVE);
            }
            if (formData.gst != '') {
                that.showDocument('gst_container', 'gst_name_image', 'gst_name_container',
                        'gst_download', 'gst_remove_btn', formData.gst, formData.s_id, VALUE_SIX);
            }
            if (formData.s_sign_of_employer != '') {
                that.showDocument('seal_and_stamp_container_for_shop', 'seal_and_stamp_name_image_for_shop', 'seal_and_stamp_name_container_for_shop',
                        'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.s_sign_of_employer, formData.s_id, VALUE_SEVEN);
            }
            if (formData.certificate_tourism != '') {
                that.showDocument('certificate_tourism_container', 'certificate_tourism_name_image', 'certificate_tourism_name_container',
                        'certificate_tourism_download', 'certificate_tourism_remove_btn', formData.certificate_tourism, formData.s_id, VALUE_EIGHT);
            }
            if (formData.license_health != '') {
                that.showDocument('license_health_container', 'license_health_name_image', 'license_health_name_container',
                        'license_health_download', 'license_health_remove_btn', formData.license_health, formData.s_id, VALUE_NINE);
            }
            if (formData.noc_health != '') {
                that.showDocument('noc_health_container', 'noc_health_name_image', 'noc_health_name_container',
                        'noc_health_download', 'noc_health_remove_btn', formData.noc_health, formData.s_id, VALUE_TEN);
            }
            if (formData.security_license != '') {
                that.showDocument('security_license_container', 'security_license_name_image', 'security_license_name_container',
                        'security_license_download', 'security_license_remove_btn', formData.security_license, formData.s_id, VALUE_ELEVEN);
            }

            $("#declaration_for_shop").prop("checked", true);
            if (formData.s_different_location == IS_CHECKED_YES) {
                $("#different_location_for_shop").prop("checked", true);
                that.$('.shop_defferent_location').show();
            }

            var cnt = 1;
            if (formData.s_employers_family_details != '') {
                var employersFamilyInfo = JSON.parse(formData.s_employers_family_details);
                $.each(employersFamilyInfo, function (index, value) {
                    that.addMultipleFamilyMembers(value);
                    if (value.familyGender == VALUE_ONE) {
                        $("#member_gender_male_" + cnt).prop("checked", true);
                    }
                    if (value.familyGender == VALUE_TWO) {
                        $("#member_gender_female_" + cnt).prop("checked", true);
                    }
                    if (value.familyAdult == IS_CHECKED_YES) {
                        $("#member_adult_" + cnt).prop("checked", true);
                    }
                    if (value.familyYoungPerson == IS_CHECKED_YES) {
                        $("#member_young_person_" + cnt).prop("checked", true);
                    }
                    cnt++;
                });
            }
            if (formData.s_employees_details != '') {
                var emp_cnt = 1;
                var employeesInfo = JSON.parse(formData.s_employees_details);
                $.each(employeesInfo, function (index, value) {
                    that.addMultipleEmployeesInfo(value);
                    if (value.employeeGender == VALUE_ONE) {
                        $("#employees_gender_male_" + emp_cnt).prop("checked", true);
                    }
                    if (value.employeeGender == VALUE_TWO) {
                        $("#employees_gender_female_" + emp_cnt).prop("checked", true);
                    }
                    if (value.employeeAdult == IS_CHECKED_YES) {
                        $("#employees_adult_" + emp_cnt).prop("checked", true);
                    }
                    if (value.employeeYoungPerson == IS_CHECKED_YES) {
                        $("#employees_young_person_" + emp_cnt).prop("checked", true);
                    }
                    emp_cnt++;
                });
            }
            if (formData.multiple_partner != '') {
                var part_cnt = 1;
                var partnerInfo = JSON.parse(formData.multiple_partner);
                $.each(partnerInfo, function (key, value) {
                    value.item_cnt = part_cnt;
                    that.addMultiplePartnerInfo(value);
                    part_cnt++;
                })
            }
        } else {
            that.addMultipleEmployeesInfo({});
        }
        generateSelect2();
        datePicker();
        $('#shop_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitShop($('#submit_btn_for_shop'));
            }
        }
        );

    },
    askForSubmitShop: function (moduleType) {
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
            var yesEvent = 'Shop.listview.submitShop(\'' + moduleType + '\')';
            showConfirmation(yesEvent, 'Submit');
        } else {
            that.submitShop(moduleType);
        }
    },
    submitShop: function (moduleType) {
        var that = this;
        validationMessageHide();
        var shopFormData = $('#shop_form').serializeFormJSON();
        var validationData = that.checkValidation(shopFormData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('shop-' + validationData.field, validationData.message);
            return false;
        }

        var newPartnerItems = [];
        var isPartnerItemValidation = false;
        $('.partner_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var partnerItem = {};
            var part_name = $('#partner_name_' + cnt).val();
            partnerItem.name = part_name;

            var part_add = $('#partner_address_' + cnt).val();
            partnerItem.address = part_add;

            newPartnerItems.push(partnerItem);
        });
        if (isPartnerItemValidation) {
            return false;
        }

        var newFamilyItems = [];
        var isFamilyItemValidation = false;
        $('.employer_family_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var familyItem = {};
            var fn = $('#member_name_' + cnt).val();
            familyItem.familyName = fn;

            var fr = $('#member_relationship_' + cnt).val();
            familyItem.familyRelationship = fr;

            var fg = $('input[name=member_gender_' + cnt + ']:checked').val();
            familyItem.familyGender = fg;

            familyItem.familyAdult = 0;
            if ($("#member_adult_" + cnt).is(":checked")) {
                familyItem.familyAdult = 1;
            }

            familyItem.familyYoungPerson = 0;
            if ($("#member_young_person_" + cnt).is(":checked")) {
                familyItem.familyYoungPerson = 1;
            }

            newFamilyItems.push(familyItem);
        });
        if (isFamilyItemValidation) {
            return false;
        }

        var newEmployeeInfoItems = [];
        var isEmployeeInfoItemValidation = false;
        $('.employees_info').each(function () {
            var cnt_emp = $(this).find('.temp_cnt').val();
            var employeeItem = {};
            var empName = $('#employees_name_' + cnt_emp).val();
            if (empName == '' || empName == null) {
                $('#employees_name_' + cnt_emp).focus();
                validationMessageShow('shop-employees_name_' + cnt_emp, shopEmployeeNameValidationMessage);
                isEmployeeInfoItemValidation = true;
                return false;
            }
            employeeItem.employeeName = empName;

            var empManageCap = $('#employees_managerial_capacity_' + cnt_emp).val();
            if (empManageCap == '' || empManageCap == null) {
                $('#employees_managerial_capacity_' + cnt_emp).focus();
                validationMessageShow('shop-employees_managerial_capacity_' + cnt_emp, shopEmployeeManagerialCapacityValidationMessage);
                isEmployeeInfoItemValidation = true;
                return false;
            }
            employeeItem.employeeManagerialCapacity = empManageCap;

            var empType = $('#employees_type_' + cnt_emp).val();
            if (empType == '' || empType == null) {
                $('#employees_type_' + cnt_emp).focus();
                validationMessageShow('shop-employees_type_' + cnt_emp, shopEmployeeTypeValidationMessage);
                isEmployeeInfoItemValidation = true;
                return false;
            }
            employeeItem.employeeType = empType;

            var empGodEmployed = $('#employees_godown_employed_' + cnt_emp).val();
            if (empGodEmployed == '' || empGodEmployed == null) {
                $('#employees_godown_employed_' + cnt_emp).focus();
                validationMessageShow('shop-employees_godown_employed_' + cnt_emp, shopEmployeeGodownEmployedValidationMessage);
                isEmployeeInfoItemValidation = true;
                return false;
            }
            employeeItem.employeeGodownEmployed = empGodEmployed;

            var empGender = $('input[name=employees_gender_' + cnt_emp + ']:checked').val();
            if (empGender == '' || empGender == null) {
                $('#employees_gender_' + cnt_emp).focus();
                validationMessageShow('shop-employees_gender_' + cnt_emp, 'Select Gender !');
                isEmployeeInfoItemValidation = true;
                return false;
            }
            employeeItem.employeeGender = empGender;

            employeeItem.employeeAdult = 0;
            if ($("#employees_adult_" + cnt_emp).is(":checked")) {
                employeeItem.employeeAdult = 1;
            }

            employeeItem.employeeYoungPerson = 0;
            if ($("#employees_young_person_" + cnt_emp).is(":checked")) {
                employeeItem.employeeYoungPerson = 1;
            }

            newEmployeeInfoItems.push(employeeItem);
        });
        if (isEmployeeInfoItemValidation) {
            return false;
        }

        if (newEmployeeInfoItems == 0) {
            validationMessageShow('shop', oneEmployeeValidationMessage);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }

        if ($('#house_tax_copy_container').is(':visible')) {
            var houseTaxCopy = $('#house_tax_copy').val();
            if (houseTaxCopy == '') {
                $('#house_tax_copy').focus();
                validationMessageShow('shop-house_tax_copy', uploadDocumentValidationMessage);
                return false;
            }
            var houseTaxCopyMessage = pdffileUploadValidation('house_tax_copy');
            if (houseTaxCopyMessage != '') {
                $('#house_tax_copy').focus();
                validationMessageShow('shop-house_tax_copy', houseTaxCopyMessage);
                return false;
            }
        }
        if ($('#photo_of_shop_container').is(':visible')) {
            var photoOfShop = $('#photo_of_shop').val();
            if (photoOfShop == '') {
                $('#photo_of_shop').focus();
                validationMessageShow('shop-photo_of_shop', uploadDocumentValidationMessage);
                return false;
            }
            var photoOfShopMessage = imagefileUploadValidation('photo_of_shop');
            if (photoOfShopMessage != '') {
                $('#photo_of_shop').focus();
                validationMessageShow('shop-photo_of_shop', photoOfShopMessage);
                return false;
            }
        }
        if ($('#pan_card_container').is(':visible')) {
            var panCard = $('#pan_card').val();
            if (panCard == '') {
                $('#pan_card').focus();
                validationMessageShow('shop-pan_card', uploadDocumentValidationMessage);
                return false;
            }
            var panCardMessage = pdffileUploadValidation('pan_card');
            if (panCardMessage != '') {
                $('#pan_card').focus();
                validationMessageShow('shop-pan_card', panCardMessage);
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_shop').is(':visible')) {
            var sealAndStamp = $('#seal_and_stamp_for_shop').val();
            if (sealAndStamp == '') {
                $('#seal_and_stamp_for_shop').focus();
                validationMessageShow('shop-seal_and_stamp_for_shop', uploadDocumentValidationMessage);
                return false;
            }
            var sealAndStampMessage = imagefileUploadValidation('seal_and_stamp_for_shop');
            if (sealAndStampMessage != '') {
                $('#seal_and_stamp_for_shop').focus();
                validationMessageShow('shop-seal_and_stamp_for_shop', sealAndStampMessage);
                return false;
            }
        }

        if (!$('#declaration_for_shop').is(':checked')) {
            $('#declaration_for_shop').focus();
            validationMessageShow('shop-declaration_for_shop', shopDeclarationValidationMessage);
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#submit_btn_for_shop') : $('#draft_btn_for_shop');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#shop_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("employer_family_info_data", JSON.stringify(newFamilyItems));
        formData.append("employees_info_data", JSON.stringify(newEmployeeInfoItems));
        formData.append("partner_info_data", JSON.stringify(newPartnerItems));
        formData.append("module_type", moduleType);

        $.ajax({
            type: 'POST',
            url: 'shop/submit_shop',
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
                validationMessageShow('shop', textStatus.statusText);
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
                    validationMessageShow('shop', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Shop.router.navigate('shop', {'trigger': true});
            }
        });
    },
    checkValidation: function (shopFormData) {
        if (!shopFormData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!shopFormData.entity_establishment_type) {
            return getBasicMessageAndFieldJSONArray('entity_establishment_type', entityEstablishmentTypeValidationMessage);
        }
        if (!shopFormData.regi_category) {
            return getBasicMessageAndFieldJSONArray('regi_category', shopRegiCategoryValidationMessage);
        }
        if (!shopFormData.name_for_shop) {
            return getBasicMessageAndFieldJSONArray('name_for_shop', shopNameValidationMessage);
        }
        if (!shopFormData.door_no_for_shop) {
            return getBasicMessageAndFieldJSONArray('door_no_for_shop', shopDoorNoValidationMessage);
        }
        if (!shopFormData.street_name_for_shop) {
            return getBasicMessageAndFieldJSONArray('street_name_for_shop', shopStreetNameValidationMessage);
        }
        if (!shopFormData.loaction_for_shop) {
            return getBasicMessageAndFieldJSONArray('loaction_for_shop', shopLocationValidationMessage);
        }
        if (!shopFormData.postal_address_for_shop) {
            return getBasicMessageAndFieldJSONArray('postal_address_for_shop', shopPostelAddressValidationMessage);
        }

        if (shopFormData.different_location_for_shop == IS_CHECKED_YES) {
            if (!shopFormData.office_location_for_shop) {
                return getBasicMessageAndFieldJSONArray('office_location_for_shop', shopOfficeLocationValidationMessage);
            }
            if (!shopFormData.store_room_location_for_shop) {
                return getBasicMessageAndFieldJSONArray('store_room_location_for_shop', shopStoreRoomLocationValidationMessage);
            }
            if (!shopFormData.godown_location_for_shop) {
                return getBasicMessageAndFieldJSONArray('godown_location_for_shop', shopGodownLocationValidationMessage);
            }
            if (!shopFormData.warehouse_location_for_shop) {
                return getBasicMessageAndFieldJSONArray('warehouse_location_for_shop', shopWarehouseLocationValidationMessage);
            }
        }
        if (!shopFormData.name_of_employer_for_shop) {
            return getBasicMessageAndFieldJSONArray('name_of_employer_for_shop', shopEmployerNameValidationMessage);
        }
        if (!shopFormData.mobile_no_employer_for_shop) {
            return getBasicMessageAndFieldJSONArray('mobile_no_employer_for_shop', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(shopFormData.mobile_no_employer_for_shop);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_no_employer_for_shop', invalidMobileValidationMessage);
        }
        if (!shopFormData.residential_address_employer_for_shop) {
            return getBasicMessageAndFieldJSONArray('residential_address_employer_for_shop', shopEmployerResidentialAddressValidationMessage);
        }
        if (!shopFormData.category_for_shop) {
            return getBasicMessageAndFieldJSONArray('category_for_shop', shopCategoryValidationMessage);
        }
        if (!shopFormData.nature_of_business_for_shop) {
            return getBasicMessageAndFieldJSONArray('nature_of_business_for_shop', shopNatureOfBusinessValidationMessage);
        }
        if (!shopFormData.date_commencement_of_business_for_shop) {
            return getBasicMessageAndFieldJSONArray('date_commencement_of_business_for_shop', shopDateCommencementOfBusinessValidationMessage);
        }

        return '';
    },
    editOrViewShop: function (btnObj, s_Id, isEdit, tempId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (!s_Id) {
            showError(invalidUserValidationMessage);
            return false;
        }
        btnObj.html(spinnerTemplate);
        btnObj.attr('onclick', '');
        var template = isEdit ? 'Edit' : 'View';
        $.ajax({
            url: 'Shop/get_shop_data_by_shop_id',
            type: 'post',
            data: $.extend({}, {'s_id': s_Id}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html(template);
                btnObj.attr('onclick', 'Shop.listview.editOrViewShop($(this),"' + s_Id + '", ' + isEdit + ',"' + tempId + '"  )');
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
                btnObj.attr('onclick', 'Shop.listview.editOrViewShop($(this),"' + s_Id + '", ' + isEdit + ',"' + tempId + '")');
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
                var shopData = parseData.shop_data;
                shopData.s_commencement_of_business_date = shopData.s_commencement_of_business_date != '0000-00-00' ? dateTo_DD_MM_YYYY(shopData.s_commencement_of_business_date) : '';
                if (isEdit) {
                    that.newShop(isEdit, shopData);
                } else {
                    that.viewShop(parseData);
                }
            }
        });
    },
    viewShop: function (shopData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;

        formData = shopData.shop_data;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.s_certificate_expiry_date = formData.s_certificate_expiry_date != '0000-00-00' ? dateTo_DD_MM_YYYY(formData.s_certificate_expiry_date) : '';
        $('#shop_form_and_table_container').html(shopViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);
        $('#regi_category').val(formData.regi_category);
        $("#declaration_for_shop").prop("checked", true);
        if (formData.s_different_location == IS_CHECKED_YES) {
            $("#different_location_for_shop").prop("checked", true);
            that.$('.shop_defferent_location').show();
        }

        if (formData.lease_agreement_document != '') {
            that.showDocument('lease_agreement_document_container', 'lease_agreement_document_name_image', 'lease_agreement_document_name_container',
                    'lease_agreement_document_download', 'lease_agreement_document_remove_btn', formData.lease_agreement_document, formData.s_id, VALUE_ONE);
        }
        if (formData.house_tax_copy != '') {
            that.showDocument('house_tax_copy_container', 'house_tax_copy_name_image', 'house_tax_copy_name_container',
                    'house_tax_copy_download', 'house_tax_copy_remove_btn', formData.house_tax_copy, formData.s_id, VALUE_TWO);
        }
        if (formData.photo_of_shop != '') {
            that.showDocument('photo_of_shop_container', 'photo_of_shop_name_image', 'photo_of_shop_name_container',
                    'photo_of_shop_download', 'photo_of_shop_remove_btn', formData.photo_of_shop, formData.s_id, VALUE_THREE);
        }
        if (formData.aadhar_card != '') {
            that.showDocument('aadhar_card_container', 'aadhar_card_name_image', 'aadhar_card_name_container',
                    'aadhar_card_download', 'aadhar_card_remove_btn', formData.aadhar_card, formData.s_id, VALUE_FOUR);
        }
        if (formData.pan_card != '') {
            that.showDocument('pan_card_container', 'pan_card_name_image', 'pan_card_name_container',
                    'pan_card_download', 'pan_card_remove_btn', formData.pan_card, formData.s_id, VALUE_FIVE);
        }
        if (formData.gst != '') {
            that.showDocument('gst_container', 'gst_name_image', 'gst_name_container',
                    'gst_download', 'gst_remove_btn', formData.gst, formData.s_id, VALUE_SIX);
        }
        if (formData.s_sign_of_employer != '') {
            that.showDocument('seal_and_stamp_container_for_shop', 'seal_and_stamp_name_image_for_shop', 'seal_and_stamp_name_container_for_shop',
                    'seal_and_stamp_download', 'seal_and_stamp_remove_btn', formData.s_sign_of_employer, formData.s_id, VALUE_SEVEN);
        }
        if (formData.certificate_tourism != '') {
            that.showDocument('certificate_tourism_container', 'certificate_tourism_name_image', 'certificate_tourism_name_container',
                    'certificate_tourism_download', 'certificate_tourism_remove_btn', formData.certificate_tourism, formData.s_id, VALUE_EIGHT);
        }
        if (formData.license_health != '') {
            that.showDocument('license_health_container', 'license_health_name_image', 'license_health_name_container',
                    'license_health_download', 'license_health_remove_btn', formData.license_health, formData.s_id, VALUE_NINE);
        }
        if (formData.noc_health != '') {
            that.showDocument('noc_health_container', 'noc_health_name_image', 'noc_health_name_container',
                    'noc_health_download', 'noc_health_remove_btn', formData.noc_health, formData.s_id, VALUE_TEN);
        }
        if (formData.security_license != '') {
            that.showDocument('security_license_container', 'security_license_name_image', 'security_license_name_container',
                    'security_license_download', 'security_license_remove_btn', formData.security_license, formData.s_id, VALUE_ELEVEN);
        }

        var cnt = 1;
        if (formData.s_employers_family_details != '') {
            var employersFamilyInfo = JSON.parse(formData.s_employers_family_details);
            $.each(employersFamilyInfo, function (index, value) {
                value.item_cnt = cnt;
                $('#employer_family_info_container_view').append(shopEmployerFamilyViewItemTemplate(value));
                if (value.familyGender == VALUE_ONE) {
                    $("#member_gender_male_" + cnt).prop("checked", true);
                }
                if (value.familyGender == VALUE_TWO) {
                    $("#member_gender_female_" + cnt).prop("checked", true);
                }
                if (value.familyAdult == IS_CHECKED_YES) {
                    $("#member_adult_" + cnt).prop("checked", true);
                }
                if (value.familyYoungPerson == IS_CHECKED_YES) {
                    $("#member_young_person_" + cnt).prop("checked", true);
                }
                cnt++;
            });
        }
        if (formData.s_employees_details != '') {
            var emp_cnt = 1;
            var employeesInfo = JSON.parse(formData.s_employees_details);
            $.each(employeesInfo, function (index, value) {
                value.item_cnt = emp_cnt;
                $('#employees_info_container_view').append(shopEmployeesViewItemTemplate(value));
                if (value.employeeGender == VALUE_ONE) {
                    $("#employees_gender_male_" + emp_cnt).prop("checked", true);
                }
                if (value.employeeGender == VALUE_TWO) {
                    $("#employees_gender_female_" + emp_cnt).prop("checked", true);
                }
                if (value.employeeAdult == IS_CHECKED_YES) {
                    $("#employees_adult_" + emp_cnt).prop("checked", true);
                }
                if (value.employeeYoungPerson == IS_CHECKED_YES) {
                    $("#employees_young_person_" + emp_cnt).prop("checked", true);
                }
                emp_cnt++;
            });
        }

        $('.remove_btn_hidden').hide();
        var partnerInfo = JSON.parse(formData.multiple_partner);
        $.each(partnerInfo, function (key, value) {
            that.addMultiplePartnerInfo(value);
            $(".partner_name").prop("readonly", true);
            $(".partner_address").prop("readonly", true);
            $('.remove_btn_hidden').hide();
        })

    },
    generateFormIPDF: function (sId) {
        if (!sId) {
            showError('Please select proper Shop Details');
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }
        $('#s_id_for_formI_pdf').val(sId);
        $('#shop_formI_pdf_form').submit();
    },
    generateFormIIPDF: function (sId) {
        if (!sId) {
            showError('Please select proper Shop Details');
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }
        $('#s_id_for_formII_pdf').val(sId);
        $('#shop_formII_pdf_form').submit();
    },
    generateFormXXIVPDF: function (sId) {
        if (!sId) {
            showError('Please select proper Shop/Establishment Details');
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }
        $('#s_id_for_formXXIV_pdf').val(sId);
        $('#shop_formXXIV_pdf_form').submit();
    },
    generateFormIVPDF: function (sId) {
        if (!sId) {
            showError('Please select proper Shop/Establishment Details');
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }
        $('#s_id_for_formIV_pdf').val(sId);
        $('#shop_formIV_pdf_form').submit();
    },
    addMultipleFamilyMembers: function (templateData) {
        templateData.item_cnt = tempContractorCnt;
        templateData.is_checked = IS_CHECKED_YES;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        $('#employer_family_info_container').append(shopEmployerFamilyInfoItemTemplate(templateData));
        tempContractorCnt++;
        datePicker();
        resetCounter('display-cnt');
    },
    removeFamilyMembers: function (itemCnt) {
        $('#employer_family_info_' + itemCnt).remove();
        resetCounter('display-cnt');
    },
    addMultipleEmployeesInfo: function (templateData) {
        templateData.item_cnt = tempEmployeesCnt;
        templateData.is_checked = IS_CHECKED_YES;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        $('#employees_info_container').append(shopEmployeesInfoItemTemplate(templateData));
        tempEmployeesCnt++;
        datePicker();
        resetCounter('display-employees-cnt');
    },
    removeEmployeesInfo: function (itemCnt) {
        $('#employees_info_' + itemCnt).remove();
        resetCounter('display-employees-cnt');
    },
    addMultiplePartnerInfo: function (templateData) {
        templateData.item_cnt = tempPartnerCnt;
        $('#partner_info_container').append(shopPartnerInfoItemTemplate(templateData));
        tempPartnerCnt++;
        resetCounter('display-partner-cnt');
    },
    removePartnerInfo: function (itemCnt) {
        $('#partner_info_' + itemCnt).remove();
        resetCounter('display-Partner-cnt');
    },
    downloadUploadChallan: function (sId) {
        if (!sId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + sId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'shop/get_shop_data_by_shop_id',
            type: 'post',
            data: $.extend({}, {'s_id': sId}, getTokenData()),
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
                var shopData = parseData.shop_data;
                that.showChallan(shopData);
            }
        });
    },
    showChallan: function (shopData) {
        showPopup();
        if (shopData.status != VALUE_FIVE && shopData.status != VALUE_SIX && shopData.status != VALUE_SEVEN) {
            if (!shopData.hide_submit_btn) {
                shopData.show_fees_paid = true;
            }
        }
        if (shopData.payment_type == VALUE_ONE) {
            shopData.utitle = 'Fees Paid Challan Copy';
        } else {
            shopData.style = 'display: none;';
        }
        if (shopData.payment_type == VALUE_TWO) {
            shopData.show_dd_po_option = true;
            shopData.utitle = 'Demand Draft (DD)';
        }
        shopData.module_type = VALUE_THIRTYTHREE;
        $('#popup_container').html(shopUploadChallanTemplate(shopData));
        loadFB(VALUE_THIRTYTHREE, shopData.fb_data);
        loadPH(VALUE_THIRTYTHREE, shopData.s_id, shopData.ph_data);

        if (shopData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'shop_upload_challan', shopData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'shop_upload_challan', 'uc', 'radio');
            if (shopData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_shop_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (shopData.challan != '') {
            $('#challan_container_for_shop_upload_challan').hide();
            $('#challan_name_container_for_shop_upload_challan').show();
            $('#challan_name_href_for_shop_upload_challan').attr('href', ADMIN_SHOP_DOC_PATH + shopData.challan);
            $('#challan_name_for_shop_upload_challan').html(shopData.challan);
        }
        if (shopData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_shop_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_shop_upload_challan').show();
            $('#fees_paid_challan_name_href_for_shop_upload_challan').attr('href', 'documents/shop/' + shopData.fees_paid_challan);
            $('#fees_paid_challan_name_for_shop_upload_challan').html(shopData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_shop_upload_challan').attr('onclick', 'Shop.listview.removeFeesPaidChallan("' + shopData.s_id + '")');
        }
    },
    removeFeesPaidChallan: function (sId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!sId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'shop/remove_fees_paid_challan',
            data: $.extend({}, {'s_id': sId}, getTokenData()),
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
                validationMessageShow('shop-uc', textStatus.statusText);
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
                    validationMessageShow('shop-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-shop-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'shop_upload_challan');
                $('#status_' + sId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-shop-uc').html('');
        validationMessageHide();
        var sId = $('#shop_id_for_shop_upload_challan').val();
        if (!sId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_shop_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_shop_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_shop_upload_challan').focus();
                validationMessageShow('shop-uc-fees_paid_challan_for_shop_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_shop_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_shop_upload_challan').focus();
                validationMessageShow('shop-uc-fees_paid_challan_for_shop_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_shop_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#shop_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'shop/upload_fees_paid_challan',
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
                validationMessageShow('shop-uc', textStatus.statusText);
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
                    validationMessageShow('shop-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + sId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    askForRemove: function (sId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!sId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Shop.listview.removeDocument(\'' + sId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (sId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!sId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_shop_' + docType).hide();
        $('.spinner_name_container_for_shop_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'shop/remove_document',
            data: $.extend({}, {'s_id': sId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_shop_' + docType).hide();
                $('.spinner_name_container_for_shop_' + docType).show();
                validationMessageShow('shop', textStatus.statusText);
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
                    validationMessageShow('shop', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_shop_' + docType).show();
                $('.spinner_name_container_for_shop_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('lease_agreement_document_name_container', 'lease_agreement_document_name_image', 'lease_agreement_document_container', 'lease_agreement_document');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('house_tax_copy_name_container', 'house_tax_copy_name_image', 'house_tax_copy_container', 'house_tax_copy');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('photo_of_shop_name_container', 'photo_of_shop_name_image', 'photo_of_shop_container', 'photo_of_shop');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('aadhar_card_name_container', 'aadhar_card_name_image', 'aadhar_card_container', 'aadhar_card');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('pan_card_name_container', 'pan_card_name_image', 'pan_card_container', 'pan_card');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('gst_name_container', 'gst_name_image', 'gst_container', 'gst');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('seal_and_stamp_name_container_for_shop', 'seal_and_stamp_name_image_for_shop', 'seal_and_stamp_container_for_shop', 'seal_and_stamp_for_shop');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('certificate_tourism_name_container', 'certificate_tourism_name_image', 'certificate_tourism_container', 'certificate_tourism');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('license_health_name_container', 'license_health_name_image', 'license_health_container', 'license_health');
                }
                if (docType == VALUE_TEN) {
                    removeDocumentValue('noc_health_name_container', 'noc_health_name_image', 'noc_health_container', 'noc_health');
                }
                if (docType == VALUE_ELEVEN) {
                    removeDocumentValue('security_license_name_container', 'security_license_name_image', 'security_license_container', 'security_license');
                }
            }
        });
    },
    getQueryData: function (sId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!sId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THIRTYTHREE;
        templateData.module_id = sId;
        var btnObj = $('#query_btn_for_app_' + sId);
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
                tmpData.application_number = regNoRenderer(VALUE_THIRTYTHREE, moduleData.s_id);
                tmpData.applicant_name = moduleData.s_name;
                tmpData.title = 'Shop & Establishment Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForShop: function (fileNo) {
        var that = this;
        if ($('#lease_agreement_document').val() != '') {
            var leaseAgreementDocument = checkValidationForDocument('lease_agreement_document', VALUE_ONE, 'shop', 10240);
            if (leaseAgreementDocument == false) {
                return false;
            }
        }
        if ($('#house_tax_copy').val() != '') {
            var houseTaxCopy = checkValidationForDocument('house_tax_copy', VALUE_ONE, 'shop', 10240);
            if (houseTaxCopy == false) {
                return false;
            }
        }
        if ($('#photo_of_shop').val() != '') {
            var photoOfShop = checkValidationForDocument('photo_of_shop', VALUE_TWO, 'shop', 10240);
            if (photoOfShop == false) {
                return false;
            }
        }
        if ($('#aadhar_card').val() != '') {
            var aadharCard = checkValidationForDocument('aadhar_card', VALUE_ONE, 'shop', 10240);
            if (aadharCard == false) {
                return false;
            }
        }
        if ($('#pan_card').val() != '') {
            var panCard = checkValidationForDocument('pan_card', VALUE_ONE, 'shop', 10240);
            if (panCard == false) {
                return false;
            }
        }
        if ($('#gst').val() != '') {
            var gst = checkValidationForDocument('gst', VALUE_ONE, 'shop', 10240);
            if (gst == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_shop').val() != '') {
            var sealAndStamp = checkValidationForDocument('seal_and_stamp_for_shop', VALUE_TWO, 'shop', 10240);
            if (sealAndStamp == false) {
                return false;
            }
        }
        if ($('#certificate_tourism').val() != '') {
            var certificateTourism = checkValidationForDocument('certificate_tourism', VALUE_ONE, 'shop', 10240);
            if (certificateTourism == false) {
                return false;
            }
        }
        if ($('#license_health').val() != '') {
            var licenseHealth = checkValidationForDocument('license_health', VALUE_ONE, 'shop', 10240);
            if (licenseHealth == false) {
                return false;
            }
        }
        if ($('#noc_health').val() != '') {
            var nocHealth = checkValidationForDocument('noc_health', VALUE_ONE, 'shop', 10240);
            if (nocHealth == false) {
                return false;
            }
        }
        if ($('#security_license').val() != '') {
            var securityLicense = checkValidationForDocument('security_license', VALUE_ONE, 'shop', 10240);
            if (securityLicense == false) {
                return false;
            }
        }

        $('.spinner_container_for_shop_' + fileNo).hide();
        $('.spinner_name_container_for_shop_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var shopId = $('#s_id').val();
        var formData = new FormData($('#shop_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("s_id", shopId);
        $.ajax({
            type: 'POST',
            url: 'shop/upload_shop_document',
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
                $('.spinner_container_for_shop_' + fileNo).show();
                $('.spinner_name_container_for_shop_' + fileNo).hide();
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
                    $('.spinner_container_for_shop_' + fileNo).show();
                    $('.spinner_name_container_for_shop_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_shop_' + fileNo).hide();
                $('.spinner_name_container_for_shop_' + fileNo).show();
                $('#s_id').val(parseData.s_id);
                var shopData = parseData.shop_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('lease_agreement_document_container', 'lease_agreement_document_name_image', 'lease_agreement_document_name_container',
                            'lease_agreement_document_download', 'lease_agreement_document_remove_btn', shopData.lease_agreement_document, parseData.s_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('house_tax_copy_container', 'house_tax_copy_name_image', 'house_tax_copy_name_container',
                            'house_tax_copy_download', 'house_tax_copy_remove_btn', shopData.house_tax_copy, parseData.s_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('photo_of_shop_container', 'photo_of_shop_name_image', 'photo_of_shop_name_container',
                            'photo_of_shop_download', 'photo_of_shop_remove_btn', shopData.photo_of_shop, parseData.s_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('aadhar_card_container', 'aadhar_card_name_image', 'aadhar_card_name_container',
                            'aadhar_card_download', 'aadhar_card_remove_btn', shopData.aadhar_card, parseData.s_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('pan_card_container', 'pan_card_name_image', 'pan_card_name_container',
                            'pan_card_download', 'pan_card_remove_btn', shopData.pan_card, parseData.s_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('gst_container', 'gst_name_image', 'gst_name_container',
                            'gst_download', 'gst_remove_btn', shopData.gst, parseData.s_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('seal_and_stamp_container_for_shop', 'seal_and_stamp_name_image_for_shop', 'seal_and_stamp_name_container_for_shop',
                            'seal_and_stamp_download', 'seal_and_stamp_remove_btn', shopData.s_sign_of_employer, parseData.s_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('certificate_tourism_container', 'certificate_tourism_name_image', 'certificate_tourism_name_container',
                            'certificate_tourism_download', 'certificate_tourism_remove_btn', shopData.certificate_tourism, parseData.s_id, VALUE_EIGHT);
                }
                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('license_health_container', 'license_health_name_image', 'license_health_name_container',
                            'license_health_download', 'license_health_remove_btn', shopData.license_health, parseData.s_id, VALUE_NINE);
                }
                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('noc_health_container', 'noc_health_name_image', 'noc_health_name_container',
                            'noc_health_download', 'noc_health_remove_btn', shopData.noc_health, parseData.s_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('security_license_container', 'security_license_name_image', 'security_license_name_container',
                            'security_license_download', 'security_license_remove_btn', shopData.security_license, parseData.s_id, VALUE_ELEVEN);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/shop/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/shop/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Shop.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});