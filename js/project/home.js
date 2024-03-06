var homeListTemplate = Handlebars.compile($('#home_list_template').html());
var homeItemTemplate = Handlebars.compile($('#home_item_template').html());
var changePinTemplate = Handlebars.compile($('#change_pin_template').html());
var deptServicesTemplate = Handlebars.compile($('#dept_services_template').html());
var ophListTemplate = Handlebars.compile($('#oph_list_template').html());
var Home = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Home.Router = Backbone.Router.extend({
    routes: {
        'home': 'renderList',
        'online_payment_history': 'renderListForOPH',
        'change_pin': 'renderListforPinChange',
        'dept_services': 'renderListForDeptServices',
        '': 'renderListForURLChange'
    },
    renderList: function () {
        Home.listview.listPage();
    },
    renderListforPinChange: function () {
        Home.listview.listPageForPinChange();
    },
    renderListForDeptServices: function () {
        Home.listview.listPageForDeptServices();
    },
    renderListForOPH: function () {
        Home.listview.listPageForOPH();
    },
    renderListForURLChange: function () {
        history.pushState({}, null, 'main#home');
        if (tDistrict != '' && tMT != '' && tMS != '' && tMI != '') {
            Home.listview.changeRouter(parseInt(tMT), parseInt(tDistrict), parseInt(tMS));
            tDistrict = '';
            tMT = '';
            tMS = '';
            tMI = '';
            return false;
        }
        Home.listview.listPage();
    }
});
Home.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_home');
        Home.router.navigate('home');
        var templateData = {};
        this.$el.html(homeListTemplate(templateData));
        this.loadDashboardData();
    },
    loadDashboardData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('#app_count_main_container').html(noRecordFoundTemplate({'colspan': 25, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
        $.ajax({
            url: 'main/get_dashboard_data',
            type: 'post',
            error: function (textStatus, errorThrown) {
                $('#app_count_main_container').html(noRecordFoundTemplate({'colspan': 25, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                showError(textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                var parseData = JSON.parse(response);
                var deptWiseApp = parseData.dept_wise_app_details;
                var serCnt = 1;
                var damanData = {};
                var diuData = {};
                var dnhData = {};
                $.each(deptWiseApp, function (index, serviceData) {
                    if (serCnt == 1) {
                        $('#app_count_main_container').html('');
                    }
                    serviceData.item_cnt = serCnt;
                    damanData = serviceData[TALUKA_DAMAN] ? serviceData[TALUKA_DAMAN] : [];
                    if (that.getDistWiseCalculation(damanData) != VALUE_ZERO) {
                        damanData = that.getBasicItemData(serCnt, serviceData, damanData, TALUKA_DAMAN);
                        $('#app_count_main_container').append(homeItemTemplate(damanData));
                        serCnt++;
                    }
                    diuData = serviceData[TALUKA_DIU] ? serviceData[TALUKA_DIU] : [];
                    if (that.getDistWiseCalculation(diuData) != VALUE_ZERO) {
                        diuData = that.getBasicItemData(serCnt, serviceData, diuData, TALUKA_DIU);
                        $('#app_count_main_container').append(homeItemTemplate(diuData));
                        serCnt++;
                    }
                    dnhData = serviceData[TALUKA_DNH] ? serviceData[TALUKA_DNH] : [];
                    if (that.getDistWiseCalculation(dnhData) != VALUE_ZERO) {
                        dnhData = that.getBasicItemData(serCnt, serviceData, dnhData, TALUKA_DNH);
                        $('#app_count_main_container').append(homeItemTemplate(dnhData));
                        serCnt++;
                    }
                });
                $('#app_count_datatable').DataTable({
                    bAutoWidth: false,
                    pageLength: 250,
                    "columnDefs": [
                        {"orderable": false, "targets": [1, 2, 3]},
                    ],
                    "lengthChange": false,
                    "initComplete": searchableDatatable
                });
                $('#app_count_datatable_filter').remove();
                $('#app_count_datatable_paginate').remove();
            }
        });
    },
    getBasicItemData: function (serCnt, serviceData, appData, taluka) {
        appData.item_cnt = serCnt;
        appData.module_type = serviceData.module_type;
        appData.department_name = serviceData.department_name;
        appData.service_name = serviceData.service_name;
        appData.timeline = serviceData.timeline;
        appData.district = taluka;
        appData.district_text = talukaArray[taluka] ? talukaArray[taluka] : '';
        appData.VALUE_ONE = VALUE_ONE;
        appData.VALUE_TWO = VALUE_TWO;
        appData.VALUE_THREE = VALUE_THREE;
        appData.VALUE_FOUR = VALUE_FOUR;
        appData.VALUE_FIVE = VALUE_FIVE;
        appData.VALUE_SIX = VALUE_SIX;
        appData.VALUE_SEVEN = VALUE_SEVEN;
        appData.VALUE_EIGHT = VALUE_EIGHT;
        appData.VALUE_NINE = VALUE_NINE;
        appData.VALUE_TEN = VALUE_TEN;
        return appData;
    },
    getDistWiseCalculation: function (dWiseData) {
        var totalCnt = dWiseData['delay_approved_app'] + dWiseData['delay_draft_app'] + dWiseData['delay_fees_paid_app'] +
                dWiseData['delay_fees_pending_app'] + dWiseData['delay_fess_na_app'] + dWiseData['delay_pay_at_office_app'] +
                dWiseData['delay_payment_confirmed_app'] + dWiseData['delay_rejected_app'] + dWiseData['delay_submitted_app'] +
                dWiseData['delay_queried_app'] + dWiseData['ot_queried_app'] +
                dWiseData['ot_approved_app'] + dWiseData['ot_draft_app'] + dWiseData['ot_fees_paid_app'] +
                dWiseData['ot_fees_pending_app'] + dWiseData['ot_fess_na_app'] + dWiseData['ot_pay_at_office_app'] +
                dWiseData['ot_payment_confirmed_app'] + dWiseData['ot_rejected_app'] + dWiseData['ot_submitted_app'];
        return parseInt(totalCnt) ? parseInt(totalCnt) : 0;
    },
    hideShowPassword: function (obj, id) {
        var InputType = document.getElementById(id);
        if (InputType.type === "password") {
            InputType.type = "text";
            obj.html('<span class="input-group-text"><i class="fa fa-eye-slash"></i></span>');
        } else {
            InputType.type = "password";
            obj.html('<span class="input-group-text"><i class="fa fa-eye"></i></span>');
        }
    },
    listPageForPinChange: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_change_pin');
        Home.router.navigate('change_pin');
        var that = this;
        this.$el.html(changePinTemplate);
        allowOnlyIntegerValue('current_pin_for_change_pin');
        allowOnlyIntegerValue('new_pin_for_change_pin');
        allowOnlyIntegerValue('retype_new_pin_for_change_pin');
        $('#change_pin_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.changePin($('#submit_btn_for_change_pin'));
            }
        });
    },
    checkValidationForChangePin: function (pinChangeData) {
        if (pinChangeData.current_pin_for_change_pin == '') {
            return getBasicMessageAndFieldJSONArray('current_pin_for_change_pin', currentPinValidationMessage);
        }
        if (pinChangeData['current_pin_for_change_pin'].length != 6) {
            return getBasicMessageAndFieldJSONArray('current_pin_for_change_pin', sixDigitPinValidationMessage);
        }
        if (pinChangeData.new_pin_for_change_pin == '') {
            return getBasicMessageAndFieldJSONArray('new_pin_for_change_pin', newPinValidationMessage);
        }
        if (pinChangeData['new_pin_for_change_pin'].length != 6) {
            return getBasicMessageAndFieldJSONArray('new_pin_for_change_pin', sixDigitPinValidationMessage);
        }
        if (pinChangeData.retype_new_pin_for_change_pin == '') {
            return getBasicMessageAndFieldJSONArray('retype_new_pin_for_change_pin', retypeNewPinValidationMessage);
        }
        if (pinChangeData.new_pin_for_change_pin != pinChangeData.retype_new_pin_for_change_pin) {
            return getBasicMessageAndFieldJSONArray('retype_new_pin_for_change_pin', notMatchPinValidationMessage);
        }
        return '';
    },
    changePin: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var pinChangeData = $('#change_pin_form').serializeFormJSON();
        var validationData = that.checkValidationForChangePin(pinChangeData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('pin-change-' + validationData.field, validationData.message);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'registration/change_pin',
            type: 'post',
            data: $.extend({}, pinChangeData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (!textStatus.statusText || textStatus.status == ERROR_CODE_FOUR_ZERO_THREE) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                that.resetChangePinForm();
            }
        });
    },
    resetChangePinForm: function () {
        validationMessageHide();
        resetForm('change_pin_form');
        document.getElementById('current_pin_for_change_pin').type = 'password';
        document.getElementById('new_pin_for_change_pin').type = 'password';
        document.getElementById('retype_new_pin_for_change_pin').type = 'password';
        $('.eye-class').html('<span class="input-group-text"><i class="fa fa-eye"></i></span>');
    },
    listPageForDeptServices: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_dept_services');
        Home.router.navigate('dept_services');
        var templateData = {};
        this.$el.html(deptServicesTemplate(templateData));
    },
    maintenancePage: function () {
        $('#model_title').html('This Service is Under Maintenance');
        $('#model_body').html('This service is Under Maintenance. In case of assistance Please Contact : 9824567222');
        $('#popup_modal').modal('show');
    },
    changeRouter: function (moduleType, district, status) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (district != TALUKA_DAMAN && district != TALUKA_DIU && district != TALUKA_DNH) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        switch (moduleType) {
            case VALUE_ONE:
                Wmregistration.listview.listPage(district, status);
                break;
            case VALUE_TWO:
                Repairer.listview.listPage(district, status);
                break;
            case VALUE_THREE:
                Dealer.listview.listPage(district, status);
                break;
            case VALUE_FOUR:
                Manufacturer.listview.listPage(district, status);
                break;
            case VALUE_FIVE:
                WC.listview.listPage(district, status);
                break;
            case VALUE_SIX:
                Hotelregi.listview.listPage(district, status);
                break;
            case VALUE_SEVEN:
                Psfregistration.listview.listPage(district, status);
                break;
            case VALUE_EIGHT:
                Cinema.listview.listPage(district, status);
                break;
            case VALUE_NINE:
                MSME.listview.listPage(district, status);
                break;
            case VALUE_TEN:
                Textile.listview.listPage(district, status);
                break;
            case VALUE_FOURTEEN:
                RepairerRenewal.listview.listPage(district, status);
                break;
            case VALUE_FIFTEEN:
                DealerRenewal.listview.listPage(district, status);
                break;
            case VALUE_SIXTEEN:
                ManufacturerRenewal.listview.listPage(district, status);
                break;
            case VALUE_NINETEEN:
                TravelAgent.listview.listPage(district, status);
                break;
            case VALUE_TWENTY:
                HotelRenewal.listview.listPage(district, status);
                break;
            case VALUE_TWENTYONE:
                Property.listview.listPage(district, status);
                break;
            case VALUE_TWENTYTWO:
                FilmShooting.listview.listPage(district, status);
                break;
            case VALUE_TWENTYTHREE:
                TravelagentRenewal.listview.listPage(district, status);
                break;
            case VALUE_TWENTYFOUR:
                Tourismevent.listview.listPage(district, status);
                break;
            case VALUE_TWENTYFIVE:
                Landallotment.listview.listPage(district, status);
                break;
            case VALUE_TWENTYSIX:
                Construction.listview.listPage(district, status);
                break;
            case VALUE_TWENTYSEVEN:
                Inspection.listview.listPage(district, status);
                break;
            case VALUE_TWENTYEIGHT:
                OccupancyCertificate.listview.listPage(district, status);
                break;
            case VALUE_TWENTYNINE:
                Site.listview.listPage(district, status);
                break;
            case VALUE_THIRTY:
                Zone.listview.listPage(district, status);
                break;
            case VALUE_THIRTYONE:
                CLACT.listview.listPage(district, status);
                break;
            case VALUE_THIRTYTWO:
                BOCW.listview.listPage(district, status);
                break;
            case VALUE_THIRTYTHREE:
                Shop.listview.listPage(district, status);
                break;
            case VALUE_THIRTYFOUR:
                MigrantWorkers.listview.listPage(district, status);
                break;
            case VALUE_THIRTYFIVE:
                FactoryLicense.listview.listPage(district, status);
                break;
            case VALUE_THIRTYSIX:
                BuildingPlan.listview.listPage(district, status);
                break;
            case VALUE_THIRTYSEVEN:
                BoilerAct.listview.listPage(district, status);
                break;
            case VALUE_THIRTYEIGHT:
                BoilerManufacture.listview.listPage(district, status);
                break;
            case VALUE_THIRTYNINE:
                SingleReturn.listview.listPageForSingleReturn(district, status);
                break;
            case VALUE_FOURTY:
                Na.listview.listPage(district, status);
                break;
            case VALUE_FOURTYONE:
                FactoryLicenseRenewal.listview.listPage(district, status);
                break;
            case VALUE_FOURTYTWO:
                ShopRenewal.listview.listPage(district, status);
                break;
            case VALUE_FOURTYTHREE:
                Aplicence.listview.listPage(district, status);
                break;
            case VALUE_FOURTYFOUR:
                BoilerActRenewal.listview.listPage(district, status);
                break;
            case VALUE_FOURTYFIVE:
                MigrantworkersRenewal.listview.listPage(district, status);
                break;
            case VALUE_FOURTYSIX:
                AplicenceRenewal.listview.listPage(district, status);
                break;
            case VALUE_FOURTYEIGHT:
                VC.listview.listPage(district, status);
                break;
            case VALUE_FOURTYNINE:
                RII.listview.listPage(district, status);
                break;
            case VALUE_FIFTY:
                Periodicalreturn.listview.listPage(district, status);
                break;
            case VALUE_FIFTYTWO:
                Ips.listview.listPage();
                break;
            case VALUE_FIFTYNINE:
                TreeCutting.listview.listPage(district, status);
                break;
            case VALUE_SIXTY:
                SocietyRegistration.listview.listPage(district, status);
                break;
            case VALUE_SIXTYONE:
                NilCertificate.listview.listPage(district, status);
                break;
        }

    },
    listPageForOPH: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_oph');
        Home.router.navigate('online_payment_history');
        var templateData = {};
        this.$el.html(ophListTemplate(templateData));
        this.loadOPHData();
    },
    loadOPHData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var tempRegNoRenderer = function (data, type, full, meta) {
            return regNoRenderer(full.module_type, data);
        };
        var tdtRenderer = function (data, type, full, meta) {
            return full.op_transaction_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(full.op_transaction_datetime) : (full.op_start_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(full.op_start_datetime) : '-');
        };
        var feeRenderer = function (data, type, full, meta) {
            return data + ' /-';
        };
        ophDataTable = $('#oph_datatable').DataTable({
            ajax: {
                url: 'utility/get_all_payment_history', dataSrc: "payment_history", type: "post"
            },
            bAutoWidth: false,
            pageLength: 25,
            ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'department_name'},
                {data: 'service_name'},
                {data: 'module_id', 'class': 'text-center f-w-b', 'render': tempRegNoRenderer},
                {data: '', 'class': 'text-center', 'render': tdtRenderer},
                {data: 'total_fees', 'class': 'text-right', 'render': feeRenderer},
                {data: 'reference_id', 'class': 'text-center'},
                {data: 'op_status', 'class': 'text-center', 'render': pgStatusRenderer},
            ],
            "initComplete": function (settings, json) {
                this.api().columns().every(function () {
                    var that = this;
                    $('input', this.header()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                    $('select', this.header()).on('change', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            }
        });
        $('#oph_datatable_filter').remove();
    },
});