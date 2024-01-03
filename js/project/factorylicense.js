var factoryLicenseListTemplate = Handlebars.compile($('#factory_license_list_template').html());
var factoryLicenseTableTemplate = Handlebars.compile($('#factory_license_table_template').html());
var factoryLicenseActionTemplate = Handlebars.compile($('#factory_license_action_template').html());
var factoryLicenseFormTemplate = Handlebars.compile($('#factory_license_form_template').html());
var factoryLicenseViewTemplate = Handlebars.compile($('#factory_license_view_template').html());
var principleProductTemplate = Handlebars.compile($('#principle_product_template').html());
var directorInfoTemplate = Handlebars.compile($('#director_info_template').html());
var employeeInfoTemplate = Handlebars.compile($('#employee_info_template').html());
var factoryLicenseChallanTemplate = Handlebars.compile($('#factory_license_upload_challan_template').html());

var tempProductCnt = 1;
var tempDirectorCnt = 1;
var tempEmployeeCnt = 1;

var FactoryLicense = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
FactoryLicense.Router = Backbone.Router.extend({
    routes: {
        'factorylicense': 'renderList',
        'factorylicense_form': 'renderListForForm',
        'edit_factorylicense_form': 'renderList',
        'view_factorylicense_form': 'renderList',
    },
    renderList: function () {
        FactoryLicense.listview.listPage();
    },
    renderListForForm: function () {
        FactoryLicense.listview.listPageFactoryLicenseForm();
    }
});
FactoryLicense.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="is_factory_exists"]': 'hasFactoryExistsEvent',
        'click input[name="factory_extend"]': 'hasFactoryExtendEvent',
    },
    hasFactoryExistsEvent: function (event) {
        var val = $('input[name=is_factory_exists]:checked').val();
        if (val === '1') {
            this.$('.factory_exists_div').show();
        } else {
            this.$('.factory_exists_div').hide();

        }
    },
    hasFactoryExtendEvent: function (event) {
        var val = $('input[name=factory_extend]:checked').val();
        if (val === '1') {
            this.$('.factory_extend_div').show();
        } else {
            this.$('.factory_extend_div').hide();

        }
    },
    listPage: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_factory');
        addClass('menu_factory_license', 'active');
        FactoryLicense.router.navigate('factorylicense');
        var templateData = {};
        this.$el.html(factoryLicenseListTemplate(templateData));
        this.loadFactoryLicenseData(sDistrict, sStatus);

    },
    listPageFactoryLicenseForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_factory');
        this.$el.html(factoryLicenseListTemplate);
        this.newFactoryLicenseForm(false, {});
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
                rowData.ADMIN_FACTORY_DOC_PATH = ADMIN_FACTORY_DOC_PATH;
                rowData.show_download_upload_challan_btn = true;
            }
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_download_certificate_btn = true;
        }
        if (rowData.query_status != VALUE_ZERO) {
            rowData.show_query_btn = true;
        }
        return factoryLicenseActionTemplate(rowData);
    },
    loadFactoryLicenseData: function (sDistrict, sStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var searchData = dashboardNaviationToModule(sDistrict, sStatus);
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(VALUE_THIRTYFIVE, data);
        };
        var that = this;
        FactoryLicense.router.navigate('factorylicense');
        $('#factory_license_form_and_datatable_container').html(factoryLicenseTableTemplate(searchData));
        factoryLicenseDataTable = $('#factory_license_datatable').DataTable({
            ajax: {url: 'factorylicense/get_factory_license_data', dataSrc: "factory_license_data", type: "post", data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center v-a-m'},
                {data: 'factorylicence_id', 'class': 'v-a-m text-center f-w-b', 'render': tempRegNoRenderer},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'entity_establishment_type', 'class': 'text-center', 'render': entityEstablishmentRenderer},
                {data: 'name_of_factory', 'class': 'text-center'},
                {data: 'factory_license_no', 'class': 'text-center'},
                {data: 'factory_address', 'class': 'text-center'},
                {data: 'submitted_datetime', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'factorylicence_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                {data: 'factorylicence_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#factory_license_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = factoryLicenseDataTable.row(tr);

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
    askForNewFactoryLicenseForm: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        that.newFactoryLicenseForm(false, {});
    },
    newFactoryLicenseForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.factory_license_data;
            FactoryLicense.router.navigate('edit_factorylicense_form');
        } else {
            var formData = {};
            FactoryLicense.router.navigate('factorylicense_form');
        }

        tempProductCnt = 1;
        tempDirectorCnt = 1;
        tempEmployeeCnt = 1;
        var that = this;
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.factoryLicense_data = parseData.factory_license_data;
        if (isEdit) {
            templateData['factoryLicense_data']['date_of_approval'] = dateTo_DD_MM_YYYY(templateData['factoryLicense_data']['date_of_approval']);
        }
        $('#factory_license_form_and_datatable_container').html(factoryLicenseFormTemplate((templateData)));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        if (isEdit) {
            $('#district').val(formData.district);
            $('#entity_establishment_type').val(formData.entity_establishment_type);
            $('#declarationone').attr('checked', 'checked');
            $('#declarationtwo').attr('checked', 'checked');

            var directorInfo = JSON.parse(formData.director_info);
            $.each(directorInfo, function (key, value) {
                that.addMultipleDirector(value);
            })

            var managingdirectorInfo = JSON.parse(formData.managing_director_info);
            $.each(managingdirectorInfo, function (key, value) {
                that.addMultipleEmployee(value);
            })

            var productInfo = JSON.parse(formData.product_data);
            $.each(productInfo, function (key, value) {
                that.addMultiplePrincipleProduct(value);
            })

            if (formData.is_factory_exists == IS_CHECKED_YES) {
                $('#is_factory_exists').attr('checked', 'checked');
                this.$('.factory_exists_div').show();
            }
            if (formData.factory_extend == IS_CHECKED_YES) {
                $('#factory_extend').attr('checked', 'checked');
                this.$('.factory_extend_div').show();
            }

            if (formData.form_two_copy != '') {
                that.showDocument('form_two_copy_container_for_factorylicense', 'form_two_copy_name_image_for_factorylicense', 'form_two_copy_name_container_for_factorylicense',
                        'form_two_copy_download', 'form_two_copy', formData.form_two_copy, formData.factorylicence_id, VALUE_ONE);
            }
            if (formData.occupancy_certificate != '') {
                that.showDocument('occupancy_certificate_container_for_factorylicense', 'occupancy_certificate_name_image_for_factorylicense', 'occupancy_certificate_name_container_for_factorylicense',
                        'occupancy_certificate_download', 'occupancy_certificate', formData.occupancy_certificate, formData.factorylicence_id, VALUE_TWO);
            }
            if (formData.stability_certificate != '') {
                that.showDocument('stability_certificate_container_for_factorylicense', 'stability_certificate_name_image_for_factorylicense', 'stability_certificate_name_container_for_factorylicense',
                        'stability_certificate_download', 'stability_certificate', formData.stability_certificate, formData.factorylicence_id, VALUE_THREE);
            }
            if (formData.safety_equipments_list != '') {
                that.showDocument('safety_equipments_list_container_for_factorylicense', 'safety_equipments_list_name_image_for_factorylicense', 'safety_equipments_list_name_container_for_factorylicense',
                        'safety_equipments_list_download', 'safety_equipments_list', formData.safety_equipments_list, formData.factorylicence_id, VALUE_FOUR);
            }
            if (formData.machinery_layout != '') {
                that.showDocument('machinery_layout_container_for_factorylicense', 'machinery_layout_name_image_for_factorylicense', 'machinery_layout_name_container_for_factorylicense',
                        'machinery_layout_download', 'machinery_layout', formData.machinery_layout, formData.factorylicence_id, VALUE_FIVE);
            }
            if (formData.approved_plan_copy != '') {
                that.showDocument('approved_plan_copy_container_for_factorylicense', 'approved_plan_copy_name_image_for_factorylicense', 'approved_plan_copy_name_container_for_factorylicense',
                        'approved_plan_copy_download', 'approved_plan_copy', formData.approved_plan_copy, formData.factorylicence_id, VALUE_SIX);
            }
            if (formData.safety_provision != '') {
                that.showDocument('safety_provision_container_for_factorylicense', 'safety_provision_name_image_for_factorylicense', 'safety_provision_name_container_for_factorylicense',
                        'safety_provision_download', 'safety_provision', formData.safety_provision, formData.factorylicence_id, VALUE_SEVEN);
            }
            if (formData.copy_of_site_plans != '') {
                that.showDocument('copy_of_site_plans_container_for_factorylicense', 'copy_of_site_plans_name_image_for_factorylicense', 'copy_of_site_plans_name_container_for_factorylicense',
                        'copy_of_site_plans_download', 'copy_of_site_plans', formData.copy_of_site_plans, formData.factorylicence_id, VALUE_EIGHT);
            }
            if (formData.plan_approval != '') {
                that.showDocument('plan_approval_container_for_factorylicense', 'plan_approval_name_image_for_factorylicense', 'plan_approval_name_container_for_factorylicense',
                        'plan_approval_download', 'plan_approval', formData.plan_approval, formData.factorylicence_id, VALUE_NINE);
            }
            if (formData.self_certificate != '') {
                that.showDocument('self_certificate_container_for_factorylicense', 'self_certificate_name_image_for_factorylicense', 'self_certificate_name_container_for_factorylicense',
                        'self_certificate_download', 'self_certificate', formData.self_certificate, formData.factorylicence_id, VALUE_TEN);
            }
            if (formData.project_report != '') {
                that.showDocument('project_report_container_for_factorylicense', 'project_report_name_image_for_factorylicense', 'project_report_name_container_for_factorylicense',
                        'project_report_download', 'project_report', formData.project_report, formData.factorylicence_id, VALUE_ELEVEN);
            }
            if (formData.land_document_copy != '') {
                that.showDocument('land_document_copy_container_for_factorylicense', 'land_document_copy_name_image_for_factorylicense', 'land_document_copy_name_container_for_factorylicense',
                        'land_document_copy_download', 'land_document_copy', formData.land_document_copy, formData.factorylicence_id, VALUE_TWELVE);
            }
            if (formData.ssi_registration_copy != '') {
                that.showDocument('ssi_registration_copy_container_for_factorylicense', 'ssi_registration_copy_name_image_for_factorylicense', 'ssi_registration_copy_name_container_for_factorylicense',
                        'ssi_registration_copy_download', 'ssi_registration_copy', formData.ssi_registration_copy, formData.factorylicence_id, VALUE_THIRTEEN);
            }
            if (formData.detail_of_etp != '') {
                that.showDocument('detail_of_etp_container_for_factorylicense', 'detail_of_etp_name_image_for_factorylicense', 'detail_of_etp_name_container_for_factorylicense',
                        'detail_of_etp_download', 'detail_of_etp', formData.detail_of_etp, formData.factorylicence_id, VALUE_FOURTEEN);
            }
            if (formData.questionnaire_copy != '') {
                that.showDocument('questionnaire_copy_container_for_factorylicense', 'questionnaire_copy_name_image_for_factorylicense', 'questionnaire_copy_name_container_for_factorylicense',
                        'questionnaire_copy_download', 'questionnaire_copy', formData.questionnaire_copy, formData.factorylicence_id, VALUE_FIFTEEN);
            }
            if (formData.sign_of_occupier != '') {
                that.showDocument('seal_and_stamp_container_for_factorylicense', 'seal_and_stamp_name_image_for_factorylicense', 'seal_and_stamp_name_container_for_factorylicense',
                        'seal_and_stamp_download', 'seal_and_stamp', formData.sign_of_occupier, formData.factorylicence_id, VALUE_SIXTEEN);
            }

        } else {
            that.addMultipleDirector({});
            that.addMultipleEmployee({});
            that.addMultiplePrincipleProduct({});
        }

        generateSelect2();
        datePicker();
        $('#factory_license_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitFactoryLicense($('#submit_btn_for_factory_license'));
            }
        });
    },
    editOrViewFactoryLicense: function (btnObj, factoryLicenseId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!factoryLicenseId) {
            showError(invalidIdValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnClick = btnObj.attr("onclick");
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'factorylicense/get_factory_license_data_by_id',
            type: 'post',
            data: $.extend({}, {'factorylicense_id': factoryLicenseId}, getTokenData()),
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
                    that.newFactoryLicenseForm(isEdit, parseData);
                } else {
                    that.viewFactoryLicenseForm(parseData);
                }
            }
        });
    },
    viewFactoryLicenseForm: function (parseData) {
        var that = this;
        var templateData = {};
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var formData = parseData.factory_license_data;
        FactoryLicense.router.navigate('view_factorylicense_form');
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.date_of_approval = dateTo_DD_MM_YYYY(formData.date_of_approval);
        $('#factory_license_form_and_datatable_container').html(factoryLicenseViewTemplate(formData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(entityEstablishmentTypeArray, 'entity_establishment_type');
        $('#district').val(formData.district);
        $('#entity_establishment_type').val(formData.entity_establishment_type);

        if (formData.form_two_copy != '') {
            that.showDocument('form_two_copy_container_for_factorylicense', 'form_two_copy_name_image_for_factorylicense', 'form_two_copy_name_container_for_factorylicense',
                    'form_two_copy_download', 'form_two_copy', formData.form_two_copy);
        }
        if (formData.occupancy_certificate != '') {
            that.showDocument('occupancy_certificate_container_for_factorylicense', 'occupancy_certificate_name_image_for_factorylicense', 'occupancy_certificate_name_container_for_factorylicense',
                    'occupancy_certificate_download', 'occupancy_certificate', formData.occupancy_certificate);
        }
        if (formData.stability_certificate != '') {
            that.showDocument('stability_certificate_container_for_factorylicense', 'stability_certificate_name_image_for_factorylicense', 'stability_certificate_name_container_for_factorylicense',
                    'stability_certificate_download', 'stability_certificate', formData.stability_certificate);
        }
        if (formData.safety_equipments_list != '') {
            that.showDocument('safety_equipments_list_container_for_factorylicense', 'safety_equipments_list_name_image_for_factorylicense', 'safety_equipments_list_name_container_for_factorylicense',
                    'safety_equipments_list_download', 'safety_equipments_list', formData.safety_equipments_list);
        }
        if (formData.machinery_layout != '') {
            that.showDocument('machinery_layout_container_for_factorylicense', 'machinery_layout_name_image_for_factorylicense', 'machinery_layout_name_container_for_factorylicense',
                    'machinery_layout_download', 'machinery_layout', formData.machinery_layout);
        }
        if (formData.approved_plan_copy != '') {
            that.showDocument('approved_plan_copy_container_for_factorylicense', 'approved_plan_copy_name_image_for_factorylicense', 'approved_plan_copy_name_container_for_factorylicense',
                    'approved_plan_copy_download', 'approved_plan_copy', formData.approved_plan_copy);
        }
        if (formData.safety_provision != '') {
            that.showDocument('safety_provision_container_for_factorylicense', 'safety_provision_name_image_for_factorylicense', 'safety_provision_name_container_for_factorylicense',
                    'safety_provision_download', 'safety_provision', formData.safety_provision);
        }
        if (formData.copy_of_site_plans != '') {
            that.showDocument('copy_of_site_plans_container_for_factorylicense', 'copy_of_site_plans_name_image_for_factorylicense', 'copy_of_site_plans_name_container_for_factorylicense',
                    'copy_of_site_plans_download', 'copy_of_site_plans', formData.copy_of_site_plans);
        }
        if (formData.plan_approval != '') {
            that.showDocument('plan_approval_container_for_factorylicense', 'plan_approval_name_image_for_factorylicense', 'plan_approval_name_container_for_factorylicense',
                    'plan_approval_download', 'plan_approval', formData.plan_approval);
        }
        if (formData.self_certificate != '') {
            that.showDocument('self_certificate_container_for_factorylicense', 'self_certificate_name_image_for_factorylicense', 'self_certificate_name_container_for_factorylicense',
                    'self_certificate_download', 'self_certificate', formData.self_certificate);
        }
        if (formData.project_report != '') {
            that.showDocument('project_report_container_for_factorylicense', 'project_report_name_image_for_factorylicense', 'project_report_name_container_for_factorylicense',
                    'project_report_download', 'project_report', formData.project_report);
        }
        if (formData.land_document_copy != '') {
            that.showDocument('land_document_copy_container_for_factorylicense', 'land_document_copy_name_image_for_factorylicense', 'land_document_copy_name_container_for_factorylicense',
                    'land_document_copy_download', 'land_document_copy', formData.land_document_copy);
        }
        if (formData.ssi_registration_copy != '') {
            that.showDocument('ssi_registration_copy_container_for_factorylicense', 'ssi_registration_copy_name_image_for_factorylicense', 'ssi_registration_copy_name_container_for_factorylicense',
                    'ssi_registration_copy_download', 'ssi_registration_copy', formData.ssi_registration_copy);
        }
        if (formData.detail_of_etp != '') {
            that.showDocument('detail_of_etp_container_for_factorylicense', 'detail_of_etp_name_image_for_factorylicense', 'detail_of_etp_name_container_for_factorylicense',
                    'detail_of_etp_download', 'detail_of_etp', formData.detail_of_etp);
        }
        if (formData.questionnaire_copy != '') {
            that.showDocument('questionnaire_copy_container_for_factorylicense', 'questionnaire_copy_name_image_for_factorylicense', 'questionnaire_copy_name_container_for_factorylicense',
                    'questionnaire_copy_download', 'questionnaire_copy', formData.questionnaire_copy);
        }
        if (formData.sign_of_occupier != '') {
            that.showDocument('seal_and_stamp_container_for_factorylicense', 'seal_and_stamp_name_image_for_factorylicense', 'seal_and_stamp_name_container_for_factorylicense',
                    'seal_and_stamp_download', 'seal_and_stamp', formData.sign_of_occupier);
        }

        var directorInfo = JSON.parse(formData.director_info);
        $.each(directorInfo, function (key, value) {
            that.addMultipleDirector(value);
        })

        var managingdirectorInfo = JSON.parse(formData.managing_director_info);
        $.each(managingdirectorInfo, function (key, value) {
            that.addMultipleEmployee(value);
        })

        var productInfo = JSON.parse(formData.product_data);
        $.each(productInfo, function (key, value) {
            that.addMultiplePrincipleProduct(value);
        })

        if (formData.is_factory_exists == IS_CHECKED_YES) {
            $('#is_factory_exists').attr('checked', 'checked');
            this.$('.factory_exists_div').show();
        }
        if (formData.factory_extend == IS_CHECKED_YES) {
            $('#factory_extend').attr('checked', 'checked');
            this.$('.factory_extend_div').show();
        }
    },
    checkValidationForFactoryLicense: function (factoryLicenseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!factoryLicenseData.district) {
            return getBasicMessageAndFieldJSONArray('district', selectDistrictValidationMessage);
        }
        if (!factoryLicenseData.name_of_factory) {
            return getBasicMessageAndFieldJSONArray('name_of_factory', factoryNameValidationMessage);
        }
        if (!factoryLicenseData.factory_address) {
            return getBasicMessageAndFieldJSONArray('factory_address', factoryAddressValidationMessage);
        }
        if (!factoryLicenseData.factory_postal_address) {
            return getBasicMessageAndFieldJSONArray('factory_postal_address', factoryPostalAddressValidationMessage);
        }
        if (!factoryLicenseData.work_carried) {
            return getBasicMessageAndFieldJSONArray('work_carried', manufacturingNatureValidationMessage);
        }
        if (!factoryLicenseData.max_no_of_worker_year) {
            return getBasicMessageAndFieldJSONArray('max_no_of_worker_year', maxWorkerValidationMessage);
        }
        // if (!factoryLicenseData.no_of_ordinarily_emp) {
        //     return getBasicMessageAndFieldJSONArray('no_of_ordinarily_emp', maxWorkerValidationMessage);
        // }
        if (!factoryLicenseData.total_power_install) {
            return getBasicMessageAndFieldJSONArray('total_power_install', powerValidationMessage);
        }
        if (!factoryLicenseData.total_power_used) {
            return getBasicMessageAndFieldJSONArray('total_power_used', powerValidationMessage);
        }
        if (!factoryLicenseData.max_power_to_be_used) {
            return getBasicMessageAndFieldJSONArray('max_power_to_be_used', maxPowerValidationMessage);
        }
        if (!factoryLicenseData.manager_detail) {
            return getBasicMessageAndFieldJSONArray('manager_detail', managerValidationMessage);
        }
        if (!factoryLicenseData.occupier_detail) {
            return getBasicMessageAndFieldJSONArray('occupier_detail', occupierValidationMessage);
        }
        if (!factoryLicenseData.proprietor_of_factory) {
            return getBasicMessageAndFieldJSONArray('proprietor_of_factory', factoryProprietorValidationMessage);
        }
        if (!factoryLicenseData.share_holders) {
            return getBasicMessageAndFieldJSONArray('share_holders', shareHolderValidationMessage);
        }
        if (!factoryLicenseData.chief_head) {
            return getBasicMessageAndFieldJSONArray('chief_head', chiefHeadValidationMessage);
        }
        if (!factoryLicenseData.owner_detail) {
            return getBasicMessageAndFieldJSONArray('owner_detail', ownerValidationMessage);
        }

        if (factoryLicenseData.is_factory_exists == isChecked) {
            if (!factoryLicenseData.factory_license_no) {
                return getBasicMessageAndFieldJSONArray('factory_license_no', factoryLicenseNoValidationMessage);
            }
            if (!factoryLicenseData.nature_of_work) {
                return getBasicMessageAndFieldJSONArray('nature_of_work', manufacturingNatureValidationMessage);
            }
            if (!factoryLicenseData.max_no_of_worker_month) {
                return getBasicMessageAndFieldJSONArray('max_no_of_worker_month', maxWorkerValidationMessage);
            }
        }
        if (factoryLicenseData.factory_extend == isChecked) {
            if (!factoryLicenseData.reference_no) {
                return getBasicMessageAndFieldJSONArray('reference_no', referenceNoValidationMessage);
            }
            if (!factoryLicenseData.date_of_approval) {
                return getBasicMessageAndFieldJSONArray('date_of_approval', approvalDateValidationMessage);
            }
            if (!factoryLicenseData.disposal_waste) {
                return getBasicMessageAndFieldJSONArray('disposal_waste', disposal_waste);
            }
            if (!factoryLicenseData.name_of_authority) {
                return getBasicMessageAndFieldJSONArray('name_of_authority', authorityNameValidationMessage);
            }
        }
        return '';
    },
    askForSubmitFactoryLicense: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'FactoryLicense.listview.submitFactoryLicense(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitFactoryLicense: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var factoryLicenseData = $('#factory_license_form').serializeFormJSON();
        var validationData = that.checkValidationForFactoryLicense(factoryLicenseData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('factory-license-' + validationData.field, validationData.message);
            return false;
        }

        if ($('#form_two_copy_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('form_two_copy_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#occupancy_certificate_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('occupancy_certificate_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#stability_certificate_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('stability_certificate_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#safety_equipments_list_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('safety_equipments_list_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#machinery_layout_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('machinery_layout_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#approved_plan_copy_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('approved_plan_copy_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#safety_provision_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('safety_provision_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_of_site_plans_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('copy_of_site_plans_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#plan_approval_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('plan_approval_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#self_certificate_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('self_certificate_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#project_report_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('project_report_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#land_document_copy_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('land_document_copy_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#ssi_registration_copy_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('ssi_registration_copy_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#detail_of_etp_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('detail_of_etp_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#questionnaire_copy_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('questionnaire_copy_for_factorylicense', VALUE_ONE, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_container_for_factorylicense').is(':visible')) {
            var copyOfRegistration = checkValidationForDocument('seal_and_stamp_for_factorylicense', VALUE_TWO, 'factory-license');
            if (copyOfRegistration == false) {
                return false;
            }
        }

        var directorsInfoItem = [];
        var managingDirectorsInfoItem = [];
        var principleProductInfoItem = [];
        var isdirectorInfoValidation = false;
        var isManagingDirectorValidation = false;
        var isProductInfoValidation = false;
        $('.director_info').each(function () {
            var tempcnt = $(this).find('.temp_cnt').val();
            var directorsItem = {};
            var directorInfo = $('#director_name_' + tempcnt).val();
            // if (directorInfo == '' || directorInfo == null) {
            //     $('#director_name_' + tempcnt).focus();
            //     validationMessageShow('factory-license-' + tempcnt, directorNameValidationMessage);
            //     isdirectorInfoValidation = true;
            //     return false;
            // }
            directorsItem.director_name = directorInfo;
            directorsInfoItem.push(directorsItem);
        });

        $('.employee_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var managingDirectorsItem = {};
            var managerName = $('#manager_name_' + cnt).val();
            // if (managerName == '' || managerName == null) {
            //     $('#manager_name_' + cnt).focus();
            //     validationMessageShow('factory-license-' + cnt, managerNameValidationMessage);
            //     isManagingDirectorValidation = true;
            //     return false;
            // }
            managingDirectorsItem.manager_name = managerName;

            var managingDirName = $('#managing_director_name_' + cnt).val();
            // if (managingDirName == '' || managingDirName == null) {
            //     $('#managing_director_name_' + cnt).focus();
            //     validationMessageShow('factory-license-' + cnt, managingDirNameValidationMessage);
            //     isManagingDirectorValidation = true;
            //     return false;
            // }
            managingDirectorsItem.managing_director_name = managingDirName;
            managingDirectorsInfoItem.push(managingDirectorsItem);
        });


        if (factoryLicenseData.is_factory_exists == isChecked) {
            $('.principle_product_info').each(function () {
                var cnt = $(this).find('.temp_cnt').val();
                var productInfoItem = {};
                var productName = $('#product_name_' + cnt).val();
                if (productName == '' || productName == null) {
                    $('#product_name_' + cnt).focus();
                    validationMessageShow('factory-license-' + cnt, productNameValidationMessage);
                    isProductInfoValidation = true;
                    return false;
                }
                productInfoItem.product_name = productName;

                var productValue = $('#product_value_' + cnt).val();
                if (productValue == '' || productValue == null) {
                    $('#product_value_' + cnt).focus();
                    validationMessageShow('factory-license-' + cnt, productValueValidationMessage);
                    isProductInfoValidation = true;
                    return false;
                }
                productInfoItem.product_value = productValue;
                principleProductInfoItem.push(productInfoItem);
            });
        }

        // if (isdirectorInfoValidation) {
        //     return false;
        // }
        // if (isManagingDirectorValidation) {
        //     return false;
        // }
        if (isProductInfoValidation) {
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_factory') : $('#submit_btn_for_factory');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var factoryLicenseData = new FormData($('#factory_license_form')[0]);
        factoryLicenseData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        factoryLicenseData.append("directors_data", JSON.stringify(directorsInfoItem));
        factoryLicenseData.append("managing_directors_data", JSON.stringify(managingDirectorsInfoItem));
        factoryLicenseData.append("product_data", JSON.stringify(principleProductInfoItem));
        factoryLicenseData.append("module_type", moduleType);

        $.ajax({
            type: 'POST',
            url: 'factorylicense/submit_factory_license',
            data: factoryLicenseData,
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
                validationMessageShow('factorylicense', textStatus.statusText);
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
                    validationMessageShow('factorylicense', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FactoryLicense.router.navigate('factorylicense', {'trigger': true});
            }
        });
    },
    addMultiplePrincipleProduct: function (templateData) {
        templateData.prod_cnt = tempProductCnt;
        $('#principle_product_info_container').append(principleProductTemplate(templateData));
        tempProductCnt++;
        resetCounter('display-cnt');
    },
    removeProductInfo: function (prodCnt) {
        $('#principle_product_info_' + prodCnt).remove();
        resetCounter('display-cnt');
    },

    addMultipleDirector: function (templateData) {
        templateData.director_cnt = tempDirectorCnt;
        $('#director_info_container').append(directorInfoTemplate(templateData));
        tempDirectorCnt++;
        resetCounter('display-cnt-dir');
    },
    removeDirectorInfo: function (dirCnt) {
        $('#director_info_' + dirCnt).remove();
        resetCounter('display-cnt-dir');
    },

    addMultipleEmployee: function (templateData) {
        templateData.emp_cnt = tempEmployeeCnt;
        $('#employee_info_container').append(employeeInfoTemplate(templateData));
        tempEmployeeCnt++;
        resetCounter('display-cnt-emp');
    },
    removeEmployeeInfo: function (empCnt) {
        $('#employee_info_' + empCnt).remove();
        resetCounter('display-cnt-emp');
    },
    askForRemove: function (factoryLicenseId, docType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!factoryLicenseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'FactoryLicense.listview.removeDocument(\'' + factoryLicenseId + '\',\'' + docType + '\')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeDocument: function (factoryLicenseId, docType) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!factoryLicenseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('.spinner_container_for_factorylicense_' + docType).hide();
        $('.spinner_name_container_for_factorylicense_' + docType).hide();
        $('#spinner_template_' + docType).show();
        $.ajax({
            type: 'POST',
            url: 'factorylicense/remove_document',
            data: $.extend({}, {'factorylicence_id': factoryLicenseId, 'document_type': docType}, getTokenData()),
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
                $('.spinner_container_for_factorylicense_' + docType).hide();
                $('.spinner_name_container_for_factorylicense_' + docType).show();
                validationMessageShow('factorylicense', textStatus.statusText);
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
                    validationMessageShow('factorylicense', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#spinner_template_' + docType).hide();
                $('.spinner_container_for_factorylicense_' + docType).show();
                $('.spinner_name_container_for_factorylicense_' + docType).hide();
                showSuccess(parseData.message);
                if (docType == VALUE_ONE) {
                    removeDocumentValue('form_two_copy_name_container_for_factorylicense', 'form_two_copy_name_image_for_factorylicense', 'form_two_copy_container_for_factorylicense', 'form_two_copy_for_factorylicense');
                }
                if (docType == VALUE_TWO) {
                    removeDocumentValue('occupancy_certificate_name_container_for_factorylicense', 'occupancy_certificate_name_image_for_factorylicense', 'occupancy_certificate_container_for_factorylicense', 'occupancy_certificate_for_factorylicense');
                }
                if (docType == VALUE_THREE) {
                    removeDocumentValue('stability_certificate_name_container_for_factorylicense', 'stability_certificate_name_image_for_factorylicense', 'stability_certificate_container_for_factorylicense', 'stability_certificate_for_factorylicense');
                }
                if (docType == VALUE_FOUR) {
                    removeDocumentValue('safety_equipments_list_name_container_for_factorylicense', 'safety_equipments_list_name_image_for_factorylicense', 'safety_equipments_list_container_for_factorylicense', 'safety_equipments_list_for_factorylicense');
                }
                if (docType == VALUE_FIVE) {
                    removeDocumentValue('machinery_layout_name_container_for_factorylicense', 'machinery_layout_name_image_for_factorylicense', 'machinery_layout_container_for_factorylicense', 'machinery_layout_for_factorylicense');
                }
                if (docType == VALUE_SIX) {
                    removeDocumentValue('approved_plan_copy_name_container_for_factorylicense', 'approved_plan_copy_name_image_for_factorylicense', 'approved_plan_copy_container_for_factorylicense', 'approved_plan_copy_for_factorylicense');
                }
                if (docType == VALUE_SEVEN) {
                    removeDocumentValue('safety_provision_name_container_for_factorylicense', 'safety_provision_name_image_for_factorylicense', 'safety_provision_container_for_factorylicense', 'safety_provision_for_factorylicense');
                }
                if (docType == VALUE_EIGHT) {
                    removeDocumentValue('copy_of_site_plans_name_container_for_factorylicense', 'copy_of_site_plans_name_image_for_factorylicense', 'copy_of_site_plans_container_for_factorylicense', 'copy_of_site_plans_for_factorylicense');
                }
                if (docType == VALUE_NINE) {
                    removeDocumentValue('plan_approval_name_container_for_factorylicense', 'plan_approval_name_image_for_factorylicense', 'plan_approval_container_for_factorylicense', 'plan_approval_for_factorylicense');
                }
                if (docType == VALUE_TEN) {
                    removeDocumentValue('self_certificate_name_container_for_factorylicense', 'self_certificate_name_image_for_factorylicense', 'self_certificate_container_for_factorylicense', 'self_certificate_for_factorylicense');
                }
                if (docType == VALUE_ELEVEN) {
                    removeDocumentValue('project_report_name_container_for_factorylicense', 'project_report_name_image_for_factorylicense', 'project_report_container_for_factorylicense', 'project_report_for_factorylicense');
                }
                if (docType == VALUE_TWELVE) {
                    removeDocumentValue('land_document_copy_name_container_for_factorylicense', 'land_document_copy_name_image_for_factorylicense', 'land_document_copy_container_for_factorylicense', 'land_document_copy_for_factorylicense');
                }
                if (docType == VALUE_THIRTEEN) {
                    removeDocumentValue('ssi_registration_copy_name_container_for_factorylicense', 'ssi_registration_copy_name_image_for_factorylicense', 'ssi_registration_copy_container_for_factorylicense', 'ssi_registration_copy_for_factorylicense');
                }
                if (docType == VALUE_FOURTEEN) {
                    removeDocumentValue('detail_of_etp_name_container_for_factorylicense', 'detail_of_etp_name_image_for_factorylicense', 'detail_of_etp_container_for_factorylicense', 'detail_of_etp_for_factorylicense');
                }
                if (docType == VALUE_FIFTEEN) {
                    removeDocumentValue('questionnaire_copy_name_container_for_factorylicense', 'questionnaire_copy_name_image_for_factorylicense', 'questionnaire_copy_container_for_factorylicense', 'questionnaire_copy_for_factorylicense');
                }
                if (docType == VALUE_SIXTEEN) {
                    removeDocumentValue('seal_and_stamp_name_container_for_factorylicense', 'seal_and_stamp_name_image_for_factorylicense', 'seal_and_stamp_container_for_factorylicense', 'seal_and_stamp_for_factorylicense');
                }
            }
        });
    },

    generateForm1: function (factoryLicenseId) {
        if (!factoryLicenseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#factorylicense_id_for_factorylicense_form1').val(factoryLicenseId);
        $('#factorylicense_form1_pdf_form').submit();
        $('#factorylicense_id_for_factorylicense_form1').val('');
    },
    downloadUploadChallan: function (factoryLicenseId) {
        if (!factoryLicenseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#download_upload_btn_' + factoryLicenseId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'factorylicense/get_factorylicense_data_by_factorylicense_id',
            type: 'post',
            data: $.extend({}, {'factorylicence_id': factoryLicenseId}, getTokenData()),
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
                var factoryLicenseData = parseData.factory_license_data;
                that.showChallan(factoryLicenseData);
            }
        });
    },
    showChallan: function (factoryLicenseData) {
        showPopup();
        if (factoryLicenseData.status != VALUE_FIVE && factoryLicenseData.status != VALUE_SIX && factoryLicenseData.status != VALUE_SEVEN) {
            if (!factoryLicenseData.hide_submit_btn) {
                factoryLicenseData.show_fees_paid = true;
            }
        }
        if (factoryLicenseData.payment_type == VALUE_ONE) {
            factoryLicenseData.utitle = 'Fees Paid Challan Copy';
        } else {
            factoryLicenseData.style = 'display: none;';
        }
        if (factoryLicenseData.payment_type == VALUE_TWO) {
            factoryLicenseData.show_dd_po_option = true;
            factoryLicenseData.utitle = 'Demand Draft (DD)';
        }
        factoryLicenseData.module_type = VALUE_THIRTYFIVE;
        $('#popup_container').html(factoryLicenseChallanTemplate(factoryLicenseData));
        loadFB(VALUE_THIRTYFIVE, factoryLicenseData.fb_data);
        loadPH(VALUE_THIRTYFIVE, factoryLicenseData.factorylicence_id, factoryLicenseData.ph_data);

        if (factoryLicenseData.payment_type == VALUE_TWO) {
            generateBoxes('radio', userPaymentTypeArray, 'user_payment_type', 'factory_license_upload_challan', factoryLicenseData.user_payment_type, true);
            showSubContainerForPaymentDetails('user_payment_type', 'factory_license_upload_challan', 'uc', 'radio');
            if (factoryLicenseData.user_payment_type == VALUE_ZERO) {
                $('input[name=user_payment_type_for_factory_license_upload_challan][value="' + VALUE_ONE + '"]').click();
            }
        }
        if (factoryLicenseData.challan != '') {
            $('#challan_container_for_factory_license_upload_challan').hide();
            $('#challan_name_container_for_factory_license_upload_challan').show();
            $('#challan_name_href_for_factory_license_upload_challan').attr('href', ADMIN_FACTORY_DOC_PATH + factoryLicenseData.challan);
            $('#challan_name_for_factory_license_upload_challan').html(factoryLicenseData.challan);
        }
        if (factoryLicenseData.fees_paid_challan != '') {
            $('#fees_paid_challan_container_for_factory_license_upload_challan').hide();
            $('#fees_paid_challan_name_container_for_factory_license_upload_challan').show();
            $('#fees_paid_challan_name_href_for_factory_license_upload_challan').attr('href', 'documents/factorylicense/' + factoryLicenseData.fees_paid_challan);
            $('#fees_paid_challan_name_for_factory_license_upload_challan').html(factoryLicenseData.fees_paid_challan);
            $('#fees_paid_challan_remove_btn_for_factory_license_upload_challan').attr('onclick', 'FactoryLicense.listview.removeFeesPaidChallan("' + factoryLicenseData.factorylicence_id + '")');
        }
    },
    removeFeesPaidChallan: function (factoryLicenseId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!factoryLicenseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'factorylicense/remove_fees_paid_challan',
            data: $.extend({}, {'factorylicence_id': factoryLicenseId}, getTokenData()),
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
                validationMessageShow('factory-license-uc', textStatus.statusText);
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
                    validationMessageShow('factory-license-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('.success-message-factory-license-uc').html(parseData.message);
                removeDocument('fees_paid_challan', 'factory_license_upload_challan');
                $('#status_' + factoryLicenseId).html(appStatusArray[VALUE_THREE]);
            }
        });
    },
    uploadFeesPaidChallan: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('.success-message-factory-license-uc').html('');
        validationMessageHide();
        var factoryLicenseId = $('#factory_license_id_for_factory_license_upload_challan').val();
        if (!factoryLicenseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#fees_paid_challan_container_for_factory_license_upload_challan').is(':visible')) {
            var sealAndStamp = $('#fees_paid_challan_for_factory_license_upload_challan').val();
            if (sealAndStamp == '') {
                $('#fees_paid_challan_for_factory_license_upload_challan').focus();
                validationMessageShow('factory-license-uc-fees_paid_challan_for_factory_license_upload_challan', uploadDocumentValidationMessage);
                return false;
            }
            var challanMessage = fileUploadValidation('fees_paid_challan_for_factory_license_upload_challan', 2048);
            if (challanMessage != '') {
                $('#fees_paid_challan_for_factory_license_upload_challan').focus();
                validationMessageShow('factory-license-uc-fees_paid_challan_for_factory_license_upload_challan', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_factory_license_upload_challan');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var formData = new FormData($('#factory_license_upload_challan_form')[0]);
        formData.append("csrf_token_eodbsws", getTokenData()['csrf_token_eodbsws']);
        $.ajax({
            type: 'POST',
            url: 'factorylicense/upload_fees_paid_challan',
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
                validationMessageShow('factory-license-uc', textStatus.statusText);
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
                    validationMessageShow('factory-license-uc', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Swal.close();
                $('#status_' + factoryLicenseId).html(appStatusArray[parseData.status]);
                if (parseData.payment_type == VALUE_TWO && parseData.user_payment_type == VALUE_THREE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    generateCertificate: function (factoryLicenseId) {
        if (!factoryLicenseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#factorylicense_id_for_certificate').val(factoryLicenseId);
        $('#factorylicense_certificate_pdf_form').submit();
        $('#factorylicense_id_for_certificate').val('');
    },
    getQueryData: function (factorylicenceId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!factorylicenceId) {
            showError(invalidUserValidationMessage);
            return false;
        }
        documentRowCnt = 1;
        var templateData = {};
        templateData.module_type = VALUE_THIRTYFIVE;
        templateData.module_id = factorylicenceId;
        var btnObj = $('#query_btn_for_app_' + factorylicenceId);
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
                tmpData.application_number = regNoRenderer(VALUE_THIRTYFIVE, moduleData.factorylicence_id);
                tmpData.applicant_name = moduleData.name_of_factory;
                tmpData.title = 'Factory Name';
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },

    uploadDocumentForFactoryLicense: function (fileNo) {
        var that = this;
        if ($('#form_two_copy_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('form_two_copy_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#occupancy_certificate_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('occupancy_certificate_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#stability_certificate_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('stability_certificate_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#safety_equipments_list_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('safety_equipments_list_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#machinery_layout_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('machinery_layout_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#approved_plan_copy_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('approved_plan_copy_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#safety_provision_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('safety_provision_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#copy_of_site_plans_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('copy_of_site_plans_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#plan_approval_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('plan_approval_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#self_certificate_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('self_certificate_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#project_report_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('project_report_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#land_document_copy_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('land_document_copy_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#ssi_registration_copy_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('ssi_registration_copy_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#detail_of_etp_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('detail_of_etp_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#questionnaire_copy_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('questionnaire_copy_for_factorylicense', VALUE_ONE, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }
        if ($('#seal_and_stamp_for_factorylicense').val() != '') {
            var copyOfRegistration = checkValidationForDocument('seal_and_stamp_for_factorylicense', VALUE_TWO, 'factorylicense');
            if (copyOfRegistration == false) {
                return false;
            }
        }

        $('.spinner_container_for_factorylicense_' + fileNo).hide();
        $('.spinner_name_container_for_factorylicense_' + fileNo).hide();
        $('#spinner_template_' + fileNo).show();
        var factoryLicenseId = $('#factorylicence_id').val();
        var formData = new FormData($('#factory_license_form')[0]);
        formData.append("file_no", fileNo);
        formData.append("factorylicence_id", factoryLicenseId);
        $.ajax({
            type: 'POST',
            url: 'factorylicense/upload_factorylicense_document',
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
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_factorylicense_' + fileNo).show();
                $('.spinner_name_container_for_factorylicense_' + fileNo).hide();
                showError(textStatus.statusText);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    $('#spinner_template_' + fileNo).hide();
                    $('.spinner_container_for_factorylicense_' + fileNo).show();
                    $('.spinner_name_container_for_factorylicense_' + fileNo).hide();
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_' + fileNo).hide();
                $('.spinner_container_for_factorylicense_' + fileNo).hide();
                $('.spinner_name_container_for_factorylicense_' + fileNo).show();
                $('#factorylicence_id').val(parseData.factorylicence_id);
                var factorylicenseData = parseData.factory_license_data;
                if (parseData.file_no == VALUE_ONE) {
                    that.showDocument('form_two_copy_container_for_factorylicense', 'form_two_copy_name_image_for_factorylicense', 'form_two_copy_name_container_for_factorylicense',
                            'form_two_copy_download', 'form_two_copy', factorylicenseData.form_two_copy, parseData.factorylicence_id, VALUE_ONE);
                }

                if (parseData.file_no == VALUE_TWO) {
                    that.showDocument('occupancy_certificate_container_for_factorylicense', 'occupancy_certificate_name_image_for_factorylicense', 'occupancy_certificate_name_container_for_factorylicense',
                            'occupancy_certificate_download', 'occupancy_certificate', factorylicenseData.occupancy_certificate, parseData.factorylicence_id, VALUE_TWO);
                }
                if (parseData.file_no == VALUE_THREE) {
                    that.showDocument('stability_certificate_container_for_factorylicense', 'stability_certificate_name_image_for_factorylicense', 'stability_certificate_name_container_for_factorylicense',
                            'stability_certificate_download', 'stability_certificate', factorylicenseData.stability_certificate, parseData.factorylicence_id, VALUE_THREE);
                }
                if (parseData.file_no == VALUE_FOUR) {
                    that.showDocument('safety_equipments_list_container_for_factorylicense', 'safety_equipments_list_name_image_for_factorylicense', 'safety_equipments_list_name_container_for_factorylicense',
                            'safety_equipments_list_download', 'safety_equipments_list', factorylicenseData.safety_equipments_list, parseData.factorylicence_id, VALUE_FOUR);
                }
                if (parseData.file_no == VALUE_FIVE) {
                    that.showDocument('machinery_layout_container_for_factorylicense', 'machinery_layout_name_image_for_factorylicense', 'machinery_layout_name_container_for_factorylicense',
                            'machinery_layout_download', 'machinery_layout', factorylicenseData.machinery_layout, parseData.factorylicence_id, VALUE_FIVE);
                }
                if (parseData.file_no == VALUE_SIX) {
                    that.showDocument('approved_plan_copy_container_for_factorylicense', 'approved_plan_copy_name_image_for_factorylicense', 'approved_plan_copy_name_container_for_factorylicense',
                            'approved_plan_copy_download', 'approved_plan_copy', factorylicenseData.approved_plan_copy, parseData.factorylicence_id, VALUE_SIX);
                }
                if (parseData.file_no == VALUE_SEVEN) {
                    that.showDocument('safety_provision_container_for_factorylicense', 'safety_provision_name_image_for_factorylicense', 'safety_provision_name_container_for_factorylicense',
                            'safety_provision_download', 'safety_provision', factorylicenseData.safety_provision, parseData.factorylicence_id, VALUE_SEVEN);
                }
                if (parseData.file_no == VALUE_EIGHT) {
                    that.showDocument('copy_of_site_plans_container_for_factorylicense', 'copy_of_site_plans_name_image_for_factorylicense', 'copy_of_site_plans_name_container_for_factorylicense',
                            'copy_of_site_plans_download', 'copy_of_site_plans', factorylicenseData.copy_of_site_plans, parseData.factorylicence_id, VALUE_EIGHT);
                }

                if (parseData.file_no == VALUE_NINE) {
                    that.showDocument('plan_approval_container_for_factorylicense', 'plan_approval_name_image_for_factorylicense', 'plan_approval_name_container_for_factorylicense',
                            'plan_approval_download', 'plan_approval', factorylicenseData.plan_approval, parseData.factorylicence_id, VALUE_NINE);
                }

                if (parseData.file_no == VALUE_TEN) {
                    that.showDocument('self_certificate_container_for_factorylicense', 'self_certificate_name_image_for_factorylicense', 'self_certificate_name_container_for_factorylicense',
                            'self_certificate_download', 'self_certificate', factorylicenseData.self_certificate, parseData.factorylicence_id, VALUE_TEN);
                }
                if (parseData.file_no == VALUE_ELEVEN) {
                    that.showDocument('project_report_container_for_factorylicense', 'project_report_name_image_for_factorylicense', 'project_report_name_container_for_factorylicense',
                            'project_report_download', 'project_report', factorylicenseData.project_report, parseData.factorylicence_id, VALUE_ELEVEN);
                }
                if (parseData.file_no == VALUE_TWELVE) {
                    that.showDocument('land_document_copy_container_for_factorylicense', 'land_document_copy_name_image_for_factorylicense', 'land_document_copy_name_container_for_factorylicense',
                            'land_document_copy_download', 'land_document_copy', factorylicenseData.land_document_copy, parseData.factorylicence_id, VALUE_TWELVE);
                }
                if (parseData.file_no == VALUE_THIRTEEN) {
                    that.showDocument('ssi_registration_copy_container_for_factorylicense', 'ssi_registration_copy_name_image_for_factorylicense', 'ssi_registration_copy_name_container_for_factorylicense',
                            'ssi_registration_copy_download', 'ssi_registration_copy', factorylicenseData.ssi_registration_copy, parseData.factorylicence_id, VALUE_THIRTEEN);
                }
                if (parseData.file_no == VALUE_FOURTEEN) {
                    that.showDocument('detail_of_etp_container_for_factorylicense', 'detail_of_etp_name_image_for_factorylicense', 'detail_of_etp_name_container_for_factorylicense',
                            'detail_of_etp_download', 'detail_of_etp', factorylicenseData.detail_of_etp, parseData.factorylicence_id, VALUE_FOURTEEN);
                }
                if (parseData.file_no == VALUE_FIFTEEN) {
                    that.showDocument('questionnaire_copy_container_for_factorylicense', 'questionnaire_copy_name_image_for_factorylicense', 'questionnaire_copy_name_container_for_factorylicense',
                            'questionnaire_copy_download', 'questionnaire_copy', factorylicenseData.questionnaire_copy, parseData.factorylicence_id, VALUE_FIFTEEN);
                }
                if (parseData.file_no == VALUE_SIXTEEN) {
                    that.showDocument('seal_and_stamp_container_for_factorylicense', 'seal_and_stamp_name_image_for_factorylicense', 'seal_and_stamp_name_container_for_factorylicense',
                            'seal_and_stamp_download', 'seal_and_stamp', factorylicenseData.sign_of_occupier, parseData.factorylicence_id, VALUE_SIXTEEN);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, VALUE) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', baseUrl + 'documents/factorylicense/' + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", baseUrl + 'documents/factorylicense/' + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'FactoryLicense.listview.askForRemove("' + dbDocumentFieldId + '","' + VALUE + '")');
    },
});
