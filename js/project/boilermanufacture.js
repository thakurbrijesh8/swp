var boilerManufactureListTemplate = Handlebars.compile($('#boiler_manufacture_list_template').html());
var boilerManufactureTableTemplate = Handlebars.compile($('#boiler_manufacture_table_template').html());
var boilerManufactureActionTemplate = Handlebars.compile($('#boiler_manufacture_action_template').html());
var boilerManufactureFormTemplate = Handlebars.compile($('#boiler_manufacture_form_template').html());
var boilerManufactureViewTemplate = Handlebars.compile($('#boiler_manufacture_view_template').html());
var technicalPersonnelTemplate = Handlebars.compile($('#technical_personnel_template').html());
var weldersInfoTemplate = Handlebars.compile($('#welders_info_template').html());
var boilerManufactureChallanTemplate = Handlebars.compile($('#boiler_manufacture_upload_challan_template').html());

var tempPersoneCnt = 1;
var tempWelderCnt = 1;

var BoilerManufacture = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
BoilerManufacture.Router = Backbone.Router.extend({
    routes: {
        'boilermanufacture': 'renderList',
        'boilermanufacture_form': 'renderListForForm',
        'edit_boilermanufacture_form': 'renderList',
        'view_boilermanufacture_form': 'renderList',
    },
    renderList: function () {
        BoilerManufacture.listview.listPage();
    },
    renderListForForm: function () {
        BoilerManufacture.listview.listPageBoilerManufactureForm();
    }
});
BoilerManufacture.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="is_instruments_calibrated"]': 'hasInstrumentscalibratedEvent',
        'click input[name="is_internal_quality_control"]': 'hasInternalQualityEvent',
    },
    hasInstrumentscalibratedEvent: function (event) {
        var val = $('input[name=is_instruments_calibrated]:checked').val();
        if (val === '1') {
            this.$('.instruments_calibrate_detail_div').show();
            //addMultiplePrincipleProduct({});
        } else {
            this.$('.instruments_calibrate_detail_div').hide();

        }
    },
    hasInternalQualityEvent: function (event) {
        var val = $('input[name=is_internal_quality_control]:checked').val();
        if (val === '1') {
            this.$('.quality_control_detail_div').show();
            //addMultiplePrincipleProduct({});
        } else {
            this.$('.quality_control_detail_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('menu_boiler_manufacture', 'active');
        BoilerManufacture.router.navigate('boilermanufacture');
        var templateData = {};
        this.$el.html(boilerManufactureListTemplate(templateData));
        this.loadBoilerManufactureData(sDistrict, sStatus);

    },
    listPageBoilerManufactureForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
//        addClass('menu_boiler_manufacture', 'active');
        this.$el.html(boilerManufactureListTemplate);
        this.newBoilerManufactureForm(false, {});
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
                rowData.ADMIN_BOILER_MANUFACT_DOC_PATH = ADMIN_BOILER_MANUFACT_DOC_PATH;
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
        return boilerManufactureActionTemplate(rowData);
    },
    loadBoilerManufactureData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        // BoilerManufacture.router.navigate('boilermanufacture');
        // var boilerManufactureActionRenderer = function (data, type, full, meta) {
        //     var actionTemplateData = {};
        //     actionTemplateData.boilermanufacture_id = data;

        //     if(full.status == VALUE_ONE)
        //         actionTemplateData.save_as_draf = true;

        //     return boilerManufactureActionTemplate(actionTemplateData);
        // };
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTYEIGHT, data)
                    + getFRContainer(VALUE_THIRTYEIGHT, data, full.rating, full.fr_datetime);
        };
        var that = this;
        BoilerManufacture.router.navigate('boilermanufacture');
        $('#boiler_manufacture_form_and_datatable_container').html(boilerManufactureTableTemplate(searchData));
        boilerManufactureDataTable = $('#boiler_manufacture_datatable').DataTable({
            ajax: {url: 'boilermanufacture/get_boiler_manufacture_data', dataSrc: "boiler_manufacture_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'boilermanufacture_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_firm', 'class': 'text-center'},
                {data: 'address_of_workshop', 'class': 'text-center'},
                {data: 'type_of_jobs', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                //{data: 'status', 'class': 'text-center', 'render': appStatusRenderer, 'orderable': false},
                {data: 'boilermanufacture_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'boilermanufacture_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
                // {
                //     "orderable": false,
                //     "data": 'boilermanufacture_id',
                //     "render": boilerManufactureActionRenderer,
                //     'class': 'text-center'
                // }
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#boiler_manufacture_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = boilerManufactureDataTable.row(tr);

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
    askForNewBoilerManufactureForm: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        that.newBoilerManufactureForm(false, {});
    },
    newBoilerManufactureForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        tempProductCnt = 1;
        tempDirectorCnt = 1;
        tempEmployeeCnt = 1;
        var that = this;
        if (isEdit) {
            var formData = parseData.boiler_manufacture_data;
            BoilerManufacture.router.navigate('edit_boilermanufacture_form');
        } else {
            var formData = {};
            BoilerManufacture.router.navigate('boilermanufacture_form');
        }

        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.boilerManufacture_data = parseData.boiler_manufacture_data;


        $('#boiler_manufacture_form_and_datatable_container').html(boilerManufactureFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);

            if (formData.copy_of_noc != '') {
                that.showDocument('copy_of_noc_container_for_boilermanufacture', 'copy_of_noc_name_image_for_boilermanufacture', 'copy_of_noc_name_container_for_boilermanufacture',
                        'copy_of_noc_download', 'copy_of_noc', formData.copy_of_noc, formData.boilermanufacture_id, VALUE_ONE);
            }
            if (formData.plan_of_workshop != '') {
                that.showDocument('plan_of_workshop_container_for_boilermanufacture', 'plan_of_workshop_name_image_for_boilermanufacture', 'plan_of_workshop_name_container_for_boilermanufacture',
                        'plan_of_workshop_download', 'plan_of_workshop', formData.plan_of_workshop, formData.boilermanufacture_id, VALUE_TWO);
            }
            if (formData.occupancy_certificate_copy != '') {
                that.showDocument('occupancy_certificate_copy_container_for_boilermanufacture', 'occupancy_certificate_copy_name_image_for_boilermanufacture', 'occupancy_certificate_copy_name_container_for_boilermanufacture',
                        'occupancy_certificate_copy_download', 'occupancy_certificate_copy', formData.occupancy_certificate_copy, formData.boilermanufacture_id, VALUE_THREE);
            }
            if (formData.factory_license_copy != '') {
                that.showDocument('factory_license_copy_container_for_boilermanufacture', 'factory_license_copy_name_image_for_boilermanufacture', 'factory_license_copy_name_container_for_boilermanufacture',
                        'factory_license_copy_download', 'factory_license_copy', formData.factory_license_copy, formData.boilermanufacture_id, VALUE_FOUR);
            }
            if (formData.machinery_layout_copy != '') {
                that.showDocument('machinery_layout_copy_container_for_boilermanufacture', 'machinery_layout_copy_name_image_for_boilermanufacture', 'machinery_layout_copy_name_container_for_boilermanufacture',
                        'machinery_layout_copy_download', 'machinery_layout_copy', formData.machinery_layout_copy, formData.boilermanufacture_id, VALUE_FIVE);
            }
            if (formData.qualification_detail != '') {
                that.showDocument('qualification_detail_container_for_boilermanufacture', 'qualification_detail_name_image_for_boilermanufacture', 'qualification_detail_name_container_for_boilermanufacture',
                        'qualification_detail_download', 'qualification_detail', formData.qualification_detail, formData.boilermanufacture_id, VALUE_SIX);
            }
            if (formData.shop_photograph_copy != '') {
                that.showDocument('shop_photograph_copy_container_for_boilermanufacture', 'shop_photograph_copy_name_image_for_boilermanufacture', 'shop_photograph_copy_name_container_for_boilermanufacture',
                        'shop_photograph_copy_download', 'shop_photograph_copy', formData.shop_photograph_copy, formData.boilermanufacture_id, VALUE_SEVEN);
            }
            if (formData.signature_and_seal != '') {
                that.showDocument('signature_and_seal_container_for_boilermanufacture', 'signature_and_seal_name_image_for_boilermanufacture', 'signature_and_seal_name_container_for_boilermanufacture',
                        'signature_and_seal_download', 'signature_and_seal', formData.signature_and_seal, formData.boilermanufacture_id, VALUE_EIGHT);
            }

            var technicalPersonInfo = JSON.parse(formData.technical_personnel_info);
            $.each(technicalPersonInfo, function (key, value) {
                that.addMultipleTechnicalPersone(value);
            })

            var weldersInfo = JSON.parse(formData.welders_info);
            $.each(weldersInfo, function (key, value) {
                that.addMultipleweldersdetail(value);
            })
            if (formData.is_internal_quality_control == IS_CHECKED_YES) {
                $('#is_internal_quality_control').attr('checked', 'checked');
                this.$('.quality_control_detail_div').show();
            }
            if (formData.is_instruments_calibrated == IS_CHECKED_YES) {
                $('#is_instruments_calibrated').attr('checked', 'checked');
                this.$('.instruments_calibrate_detail_div').show();
            }
        } else {
            that.addMultipleTechnicalPersone({});
            that.addMultipleweldersdetail({});
        }

        generateSelect2();
        datePicker();
        $('#boiler_manufacture_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitBoilerManufacture($('#submit_btn_for_boiler_manufacture'));
            }
        });
    },
    editOrViewBoilerManufacture: function (btnObj, boilerManufactureId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!boilerManufactureId) {
            showError(invalidIdValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnClick = btnObj.attr("onclick");
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'boilermanufacture/get_boiler_manufacture_data_by_id',
            type: 'post',
            data: $.extend({}, {'boilermanufacture_id': boilerManufactureId}, getTokenData()),
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
                if (isEdit) {
                    that.newBoilerManufactureForm(isEdit, parseData);
                } else {
                    that.viewBoilerManufactureForm(parseData);
                }
            }
        });
    },
    viewBoilerManufactureForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.boiler_manufacture_data;
        BoilerManufacture.router.navigate('view_boilermanufacture_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#boiler_manufacture_form_and_datatable_container').html(boilerManufactureViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.copy_of_noc != '') {
            that.showDocument('copy_of_noc_container_for_boilermanufacture', 'copy_of_noc_name_image_for_boilermanufacture', 'copy_of_noc_name_container_for_boilermanufacture',
                    'copy_of_noc_download', 'copy_of_noc', formData.copy_of_noc);
        }
        if (formData.plan_of_workshop != '') {
            that.showDocument('plan_of_workshop_container_for_boilermanufacture', 'plan_of_workshop_name_image_for_boilermanufacture', 'plan_of_workshop_name_container_for_boilermanufacture',
                    'plan_of_workshop_download', 'plan_of_workshop', formData.plan_of_workshop);
        }
        if (formData.occupancy_certificate_copy != '') {
            that.showDocument('occupancy_certificate_copy_container_for_boilermanufacture', 'occupancy_certificate_copy_name_image_for_boilermanufacture', 'occupancy_certificate_copy_name_container_for_boilermanufacture',
                    'occupancy_certificate_copy_download', 'occupancy_certificate_copy', formData.occupancy_certificate_copy);
        }
        if (formData.factory_license_copy != '') {
            that.showDocument('factory_license_copy_container_for_boilermanufacture', 'factory_license_copy_name_image_for_boilermanufacture', 'factory_license_copy_name_container_for_boilermanufacture',
                    'factory_license_copy_download', 'factory_license_copy', formData.factory_license_copy);
        }
        if (formData.machinery_layout_copy != '') {
            that.showDocument('machinery_layout_copy_container_for_boilermanufacture', 'machinery_layout_copy_name_image_for_boilermanufacture', 'machinery_layout_copy_name_container_for_boilermanufacture',
                    'machinery_layout_copy_download', 'machinery_layout_copy', formData.machinery_layout_copy);
        }
        if (formData.qualification_detail != '') {
            that.showDocument('qualification_detail_container_for_boilermanufacture', 'qualification_detail_name_image_for_boilermanufacture', 'qualification_detail_name_container_for_boilermanufacture',
                    'qualification_detail_download', 'qualification_detail', formData.qualification_detail);
        }
        if (formData.shop_photograph_copy != '') {
            that.showDocument('shop_photograph_copy_container_for_boilermanufacture', 'shop_photograph_copy_name_image_for_boilermanufacture', 'shop_photograph_copy_name_container_for_boilermanufacture',
                    'shop_photograph_copy_download', 'shop_photograph_copy', formData.shop_photograph_copy);
        }
        if (formData.signature_and_seal != '') {
            that.showDocument('signature_and_seal_container_for_boilermanufacture', 'signature_and_seal_name_image_for_boilermanufacture', 'signature_and_seal_name_container_for_boilermanufacture',
                    'signature_and_seal_download', 'signature_and_seal', formData.signature_and_seal);
        }

        var technicalPersonInfo = JSON.parse(formData.technical_personnel_info);
        $.each(technicalPersonInfo, function (key, value) {
            that.addMultipleTechnicalPersone(value);
        })

        var weldersInfo = JSON.parse(formData.welders_info);
        $.each(weldersInfo, function (key, value) {
            that.addMultipleweldersdetail(value);
        })
        if (formData.is_internal_quality_control == IS_CHECKED_YES) {
            $('#is_internal_quality_control').attr('checked', 'checked');
            this.$('.quality_control_detail_div').show();
        }
        if (formData.is_instruments_calibrated == IS_CHECKED_YES) {
            $('#is_instruments_calibrated').attr('checked', 'checked');
            this.$('.instruments_calibrate_detail_div').show();
        }

    },
    checkValidationForBoilerManufacture: function (boilerManufactureData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!boilerManufactureData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!boilerManufactureData.name_of_firm) {
            return getBasicMessageAndFieldJSONArray('name_of_firm', firmNameValidationMessage);
        }
        if (!boilerManufactureData.address_of_workshop) {
            return getBasicMessageAndFieldJSONArray('address_of_workshop', workshopAddressValidationMessage);
        }
        if (!boilerManufactureData.address_of_communication) {
            return getBasicMessageAndFieldJSONArray('address_of_communication', commAddressValidationMessage);
        }
        if (!boilerManufactureData.type_of_jobs) {
            return getBasicMessageAndFieldJSONArray('type_of_jobs', jobTypeValidationMessage);
        }
        if (!boilerManufactureData.tools_and_tackles) {
            return getBasicMessageAndFieldJSONArray('tools_and_tackles', toolsValidationMessage);
        }
        if (!boilerManufactureData.standard_of_work) {
            return getBasicMessageAndFieldJSONArray('standard_of_work', standardWorkValidationMessage);
        }
        if (!boilerManufactureData.controversial_issue) {
            return getBasicMessageAndFieldJSONArray('controversial_issue', controversialIssueValidationMessage);
        }
        if (boilerManufactureData.is_internal_quality_control == isChecked) {
            if (!boilerManufactureData.quality_control_detail) {
                return getBasicMessageAndFieldJSONArray('quality_control_detail', qualityControlValidationMessage);
            }
        }
        if (!boilerManufactureData.power_sanction) {
            return getBasicMessageAndFieldJSONArray('power_sanction', powerSanctionValidationMessage);
        }
        if (!boilerManufactureData.conversant_with_boiler) {
            return getBasicMessageAndFieldJSONArray('conversant_with_boiler', conversantValidationMessage);
        }
        if (boilerManufactureData.is_instruments_calibrated == isChecked) {
            if (!boilerManufactureData.instruments_calibrate_detail) {
                return getBasicMessageAndFieldJSONArray('instruments_calibrate_detail', instrumentCalibrateValidationMessage);
            }
        }
        if (!boilerManufactureData.testing_facility) {
            return getBasicMessageAndFieldJSONArray('testing_facility', testingFacilityValidationMessage);
        }
        if (!boilerManufactureData.recording_system) {
            return getBasicMessageAndFieldJSONArray('recording_system', recordSystemValidationMessage);
        }


        return '';
    },
    askForBoilerManufacture: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BoilerManufacture.listview.submitBoilerManufacture(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitBoilerManufacture: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var boilerManufactureData = $('#boiler_manufacture_form').serializeFormJSON();
        var validationData = that.checkValidationForBoilerManufacture(boilerManufactureData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('boiler-manufacture-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#copy_of_noc_container_for_boilermanufacture').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('copy_of_noc_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#plan_of_workshop_container_for_boilermanufacture').is(':visible')) {
            var formIIdoc = checkValidationForDocument('plan_of_workshop_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#occupancy_certificate_copy_container_for_boilermanufacture').is(':visible')) {
            var formIIdoc = checkValidationForDocument('occupancy_certificate_copy_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }

        if ($('#factory_license_copy_container_for_boilermanufacture').is(':visible')) {
            var formIIdoc = checkValidationForDocument('factory_license_copy_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }


        if ($('#machinery_layout_copy_container_for_boilermanufacture').is(':visible')) {
            var formIIdoc = checkValidationForDocument('machinery_layout_copy_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }


        if ($('#qualification_detail_container_for_boilermanufacture').is(':visible')) {
            var formIIdoc = checkValidationForDocument('qualification_detail_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }


        if ($('#shop_photograph_copy_container_for_boilermanufacture').is(':visible')) {
            var formIIdoc = checkValidationForDocument('shop_photograph_copy_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }

        if ($('#signature_and_seal_container_for_boilermanufacture').is(':visible')) {
            var sealAndStamp = checkValidationForDocument('signature_and_seal_for_boilermanufacture', VALUE_TWO, 'boiler-manufacture');
            if (sealAndStamp == false) {
                return false;
            }
        }


        var weldersInfoItem = [];
        var technicalPersonnel = [];
        var isweldersInfoValidation = false;
        var isTechnicalPersonnelValidation = false;


        $('.technical_personnel_detail').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var technicalPersonnelInfo = {};
            var supervisorName = $('#supervisor_name_' + cnt).val();
            if (supervisorName == '' || supervisorName == null) {
                $('#supervisor_name_' + cnt).focus();
                validationMessageShow('boiler-manufacture-' + cnt, supervisorNameValidationMessage);
                isTechnicalPersonnelValidation = true;
                return false;
            }
            technicalPersonnelInfo.supervisor_name = supervisorName;

            var qualification = $('#qualification_' + cnt).val();
            if (qualification == '' || qualification == null) {
                $('#qualification_' + cnt).focus();
                validationMessageShow('boiler-manufacture-' + cnt, qualificationValidationMessage);
                isTechnicalPersonnelValidation = true;
                return false;
            }
            technicalPersonnelInfo.qualification = qualification;
            var experience = $('#experience_' + cnt).val();
            if (experience == '' || experience == null) {
                $('#experience_' + cnt).focus();
                validationMessageShow('boiler-manufacture-' + cnt, experienceValidationMessage);
                isTechnicalPersonnelValidation = true;
                return false;
            }
            technicalPersonnelInfo.experience = experience;
            technicalPersonnel.push(technicalPersonnelInfo);
        });

        $('.welders_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var weldersInfo = {};
            var welders_name = $('#welders_name_' + cnt).val();
            if (welders_name == '' || welders_name == null) {
                $('#welders_name_' + cnt).focus();
                validationMessageShow('boiler-menufacture-' + cnt, welderNameValidationMessage);
                isweldersInfoValidation = true;
                return false;
            }
            weldersInfo.welders_name = welders_name;

            var welders_experience = $('#welders_experience_' + cnt).val();
            if (welders_experience == '' || welders_experience == null) {
                $('#welders_experience_' + cnt).focus();
                validationMessageShow('boiler-menufacture-' + cnt, experienceValidationMessage);
                isweldersInfoValidation = true;
                return false;
            }
            weldersInfo.welders_experience = welders_experience;
            weldersInfoItem.push(weldersInfo);
        });

        if (isTechnicalPersonnelValidation) {
            return false;
        }
        if (isweldersInfoValidation) {
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_manufacturer') : $('#submit_btn_for_manufacturer');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var boilerManufactureData = new FormData($('#boiler_manufacture_form')[0]);
        boilerManufactureData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        boilerManufactureData.append("welders_data", JSON.stringify(weldersInfoItem));
        boilerManufactureData.append("technical_person_data", JSON.stringify(technicalPersonnel));
        boilerManufactureData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'boilermanufacture/submit_boiler_manufacture',
            data: boilerManufactureData,
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
                validationMessageShow('boilermanufacture', textStatus.statusText);
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
                    validationMessageShow('boilermanufacture', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                BoilerManufacture.router.navigate('boilermanufacture', {'trigger': true});
            }
        });
    },
    askForRemove: function (boilermanufactureId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!boilermanufactureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BoilerManufacture.listview.removeDocument(\'' + boilermanufactureId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },

    removeDocument: function (boilermanufactureId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!boilermanufactureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_boilermanufacture_' + docType).hide();
        $('.spinner_name_container_for_boilermanufacture_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'boilermanufacture/remove_document',
            data: $.extend({}, {'boilermanufacture_id': boilermanufactureId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_boilermanufacture_' + docType).hide();
                $('.spinner_name_container_for_boilermanufacture_' + docType).show();
                validationMessageShow('boiler-manufacture', textStatus.statusText);
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
                    validationMessageShow('boiler-manufacture', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_boilermanufacture_' + docType).show();
                $('.spinner_name_container_for_boilermanufacture_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('copy_of_noc_name_container_for_boilermanufacture', 'copy_of_noc_name_image_for_boilermanufacture', 'copy_of_noc_container_for_boilermanufacture', 'copy_of_noc_for_boilermanufacture');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('plan_of_workshop_name_container_for_boilermanufacture', 'plan_of_workshop_name_image_for_boilermanufacture', 'plan_of_workshop_container_for_boilermanufacture', 'plan_of_workshop_for_boilermanufacture');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('occupancy_certificate_copy_name_container_for_boilermanufacture', 'occupancy_certificate_copy_name_image_for_boilermanufacture', 'occupancy_certificate_copy_container_for_boilermanufacture', 'occupancy_certificate_copy_for_boilermanufacture');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('factory_license_copy_name_container_for_boilermanufacture', 'factory_license_copy_name_image_for_boilermanufacture', 'factory_license_copy_container_for_boilermanufacture', 'factory_license_copy_for_boilermanufacture');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('machinery_layout_copy_name_container_for_boilermanufacture', 'machinery_layout_copy_name_image_for_boilermanufacture', 'machinery_layout_copy_container_for_boilermanufacture', 'machinery_layout_copy_for_boilermanufacture');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('qualification_detail_name_container_for_boilermanufacture', 'qualification_detail_name_image_for_boilermanufacture', 'qualification_detail_container_for_boilermanufacture', 'qualification_detail_for_boilermanufacture');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('shop_photograph_copy_name_container_for_boilermanufacture', 'shop_photograph_copy_name_image_for_boilermanufacture', 'shop_photograph_copy_container_for_boilermanufacture', 'shop_photograph_copy_for_boilermanufacture');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('signature_and_seal_name_container_for_boilermanufacture', 'signature_and_seal_name_image_for_boilermanufacture', 'signature_and_seal_container_for_boilermanufacture', 'signature_and_seal_for_boilermanufacture');
                }
            }
        });
    },
    addMultipleTechnicalPersone: function (templateData) {
        templateData.per_cnt = tempPersoneCnt;
        $('#technical_personnel_info_container').append(technicalPersonnelTemplate(templateData));
        tempPersoneCnt++;
        resetCounter('display-cnt');
    },
    removeTechnicalPersonnel: function (perCnt) {
        $('#technical_personnel_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    addMultipleweldersdetail: function (templateData) {
        templateData.welder_cnt = tempWelderCnt;
        $('#welders_info_container').append(weldersInfoTemplate(templateData));
        tempWelderCnt++;
        resetCounter('display-count');
    },
    removeWeldersInfo: function (welderCnt) {
        $('#welders_info_' + welderCnt).remove();
        resetCounter('display-count');
    },
    generateForm1: function (boilermanufactureId) {
        if (!boilermanufactureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#boilermanufacture_id_for_boilermanufacture_form1').val(boilermanufactureId);
        $('#boilermanufacture_form1_pdf_form').submit();
        $('#boilermanufacture_id_for_boilermanufacture_form1').val('');
    },
    downloadUploadChallan: function (boilermanufactureId) {
        if (!boilermanufactureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + boilermanufactureId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'boilermanufacture/get_boilermanufacture_data_by_boilermanufacture_id',
            type: 'post',
            data: $.extend({}, {'boilermenufacture_id': boilermanufactureId}, getTokenData()),
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
                var boilerManufactureData = parseData.boiler_manufacture_data;
                that.showChallan(boilerManufactureData);
            }
        });
    },
    showChallan: function (boilerManufactureData) {
        showPopup();
        if (boilerManufactureData.status != VALUE_FIVE && boilerManufactureData.status != VALUE_SIX && boilerManufactureData.status != VALUE_SEVEN) {
            if (!boilerManufactureData.hide_submit_btn) {
                boilerManufactureData.show_fees_paid = true;
            }
        }
        if (boilerManufactureData.payment_type == VALUE_ONE) {
            boilerManufactureData.utitle = 'Fees Paid Challan Copy';
        } else {
            boilerManufactureData.style = 'display: none;';
        }
        if (boilerManufactureData.payment_type == VALUE_TWO) {
            boilerManufactureData.show_dd_po_option = true;
            boilerManufactureData.utitle = 'Demand Draft (DD)';
        }
        boilerManufactureData.module_type = VALUE_THIRTYEIGHT;
        $('#popup_container').html(boilerManufactureChallanTemplate(boilerManufactureData));
        loadFB(VALUE_THIRTYEIGHT, boilerManufactureData.fb_data);
        loadPH(VALUE_THIRTYEIGHT, boilerManufactureData.boilermanufacture_id, boilerManufactureData.ph_data);

        if (boilerManufactureData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'boiler_manufacture_upload_challan', boilerManufactureData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'boiler_manufacture_upload_challan', 'uc', 'radio');
            if (boilerManufactureData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_boiler_manufacture_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (boilerManufactureData.challan != '') {
            $('#challan_container_for_boiler_manufacture_upload_challan').hide();
            $('#challan_name_container_for_boiler_manufacture_upload_challan').show();
            $('#challan_name_href_for_boiler_manufacture_upload_challan').attr('href', ADMIN_MANUFACT_DOC_PATH + boilerManufactureData.challan);
            $('#challan_name_for_boiler_manufacture_upload_challan').html(boilerManufactureData.challan);
        }
        if (boilerManufactureData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_boiler_manufacture_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_boiler_manufacture_upload_challan').show();
            $('#fees_paid_challan_name_href_for_boiler_manufacture_upload_challan').attr('href', 'documents/boilermanufactures/' + boilerManufactureData.fees_paid_challan);
            $('#fees_paid_challan_name_for_boiler_manufacture_upload_challan').html(boilerManufactureData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_boiler_manufacture_upload_challan').attr('onclick', 'BoilerManufacture.listview.removeFeesPaidChallan("' + boilerManufactureData.boilermanufacture_id + '")');
        }
    },
    removeFeesPaidChallan: function (boilermanufactureId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!boilermanufactureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'boilermanufacture/remove_fees_paid_challan',
            data: $.extend({}, {'boilermenufacture_id': boilermanufactureId}, getTokenData()),
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
                validationMessageShow('boiler-manufacture-uc', textStatus.statusText);
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
                    validationMessageShow('boiler-manufacture-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-boiler-manufacture-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'boiler_manufacture_upload_challan');
                $('#status_' + boilermanufactureId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-boiler-manufacture-uc').html('');
        validationMessageHide();
        var boilermanufactureId = $('#boiler_manufacture_id_for_boiler_manufacture_upload_challan').val();
        if (!boilermanufactureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_boiler_manufacture_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_boiler_manufacture_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_boiler_manufacture_upload_challan').focus();
                validationMessageShow('boiler-manufacture-uc-fees_paid_challan_for_boiler_manufacture_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_boiler_manufacture_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_boiler_manufacture_upload_challan').focus();
                validationMessageShow('boiler-manufacture-uc-fees_paid_challan_for_boiler_manufacture_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_boiler_manufacture_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#boiler_manufacture_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'boilermanufacture/upload_fees_paid_challan',
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
                validationMessageShow('boiler-manufacture-uc', textStatus.statusText);
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
                    validationMessageShow('boiler-manufacture-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + boilermanufactureId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (boilermanufactureId) {
        if (!boilermanufactureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#boilermanufacture_id_for_certificate').val(boilermanufactureId);
        $('#boilermanufacture_certificate_pdf_form').submit();
        $('#boilermanufacture_id_for_certificate').val('');
    },
    getQueryData: function (boilermanufactureId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!boilermanufactureId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THIRTYEIGHT;
        templateData.module_id = boilermanufactureId;
        var btnObj = $('#query_btn_for_app_' + boilermanufactureId);
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
                tmpData.application_number = regNoRenderer(VALUE_THIRTYEIGHT, moduleData.boilermanufacture_id);
                tmpData.applicant_name = moduleData.name_of_firm;
                tmpData.title = 'Firm Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    uploadDocumentForBoilerManufacture: function (fileNo) {
        var that = this;
        if ($('#copy_of_noc_for_boilermanufacture').val() != '') {
            var copyOfRegistration = checkValidationForDocument('copy_of_noc_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#plan_of_workshop_for_boilermanufacture').val() != '') {
            var formIIdoc = checkValidationForDocument('plan_of_workshop_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#occupancy_certificate_copy_for_boilermanufacture').val() != '') {
            var formIIdoc = checkValidationForDocument('occupancy_certificate_copy_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#factory_license_copy_for_boilermanufacture').val() != '') {
            var formIIdoc = checkValidationForDocument('factory_license_copy_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#machinery_layout_copy_for_boilermanufacture').val() != '') {
            var formIIdoc = checkValidationForDocument('machinery_layout_copy_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#qualification_detail_for_boilermanufacture').val() != '') {
            var formIIdoc = checkValidationForDocument('qualification_detail_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#shop_photograph_copy_for_boilermanufacture').val() != '') {
            var formIIdoc = checkValidationForDocument('shop_photograph_copy_for_boilermanufacture', VALUE_ONE, 'boiler-manufacture');
            if (formIIdoc == false) {
                return false;
            }
        }
        if ($('#signature_and_seal_for_boilermanufacture').val() != '') {
            var sealAndStamp = checkValidationForDocument('signature_and_seal_for_boilermanufacture', VALUE_TWO, 'boiler-manufacture');
            if (sealAndStamp == false) {
                return false;
            }
        }
        $('.spinner_container_for_boilermanufacture_' + fileNo).hide();
        $('.spinner_name_container_for_boilermanufacture_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var boilermanufactureId = $('#boilermanufacture_id').val();
        var formData = new FormData($('#boiler_manufacture_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        formData.append("file_no", fileNo);
        formData.append("boilermanufacture_id", boilermanufactureId);
        $.ajax({
            type: 'POST',
            url: 'boilermanufacture/upload_boiler_manufacture_document',
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
                $('.spinner_container_for_boilermanufacture_' + fileNo).show();
                $('.spinner_name_container_for_boilermanufacture_' + fileNo).hide();
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
                    $('.spinner_container_for_boilermanufacture_' + fileNo).show();
                    $('.spinner_name_container_for_boilermanufacture_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_boilermanufacture_' + fileNo).hide();
                $('.spinner_name_container_for_boilermanufacture_' + fileNo).show();
                $('#boilermanufacture_id').val(parseData.boilermanufacture_id);
                var boilerManufactureData = parseData.boiler_manufacture_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('copy_of_noc_container_for_boilermanufacture', 'copy_of_noc_name_image_for_boilermanufacture', 'copy_of_noc_name_container_for_boilermanufacture',
                            'copy_of_noc_download', 'copy_of_noc', boilerManufactureData.copy_of_noc, parseData.boilermanufacture_id, VALUE_ONE);
                }
                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('plan_of_workshop_container_for_boilermanufacture', 'plan_of_workshop_name_image_for_boilermanufacture', 'plan_of_workshop_name_container_for_boilermanufacture',
                            'plan_of_workshop_download', 'plan_of_workshop', boilerManufactureData.plan_of_workshop, parseData.boilermanufacture_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('occupancy_certificate_copy_container_for_boilermanufacture', 'occupancy_certificate_copy_name_image_for_boilermanufacture', 'occupancy_certificate_copy_name_container_for_boilermanufacture',
                            'occupancy_certificate_copy_download', 'occupancy_certificate_copy', boilerManufactureData.occupancy_certificate_copy, parseData.boilermanufacture_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('factory_license_copy_container_for_boilermanufacture', 'factory_license_copy_name_image_for_boilermanufacture', 'factory_license_copy_name_container_for_boilermanufacture',
                            'factory_license_copy_download', 'factory_license_copy', boilerManufactureData.factory_license_copy, parseData.boilermanufacture_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('machinery_layout_copy_container_for_boilermanufacture', 'machinery_layout_copy_name_image_for_boilermanufacture', 'machinery_layout_copy_name_container_for_boilermanufacture',
                            'machinery_layout_copy_download', 'machinery_layout_copy', boilerManufactureData.machinery_layout_copy, parseData.boilermanufacture_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('qualification_detail_container_for_boilermanufacture', 'qualification_detail_name_image_for_boilermanufacture', 'qualification_detail_name_container_for_boilermanufacture',
                            'qualification_detail_download', 'qualification_detail', boilerManufactureData.qualification_detail, parseData.boilermanufacture_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('shop_photograph_copy_container_for_boilermanufacture', 'shop_photograph_copy_name_image_for_boilermanufacture', 'shop_photograph_copy_name_container_for_boilermanufacture',
                            'shop_photograph_copy_download', 'shop_photograph_copy', boilerManufactureData.shop_photograph_copy, parseData.boilermanufacture_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('signature_and_seal_container_for_boilermanufacture', 'signature_and_seal_name_image_for_boilermanufacture', 'signature_and_seal_name_container_for_boilermanufacture',
                            'signature_and_seal_download', 'signature_and_seal', boilerManufactureData.signature_and_seal, parseData.boilermanufacture_id, VALUE_EIGHT);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/boilermanufactures/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/boilermanufactures/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'BoilerManufacture.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
