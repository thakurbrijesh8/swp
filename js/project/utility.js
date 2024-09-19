(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push($.trim(this.value) || '');
            } else {
                o[this.name] = $.trim(this.value) || '';
            }
        });
        return o;
    };

})(jQuery);

function loginPage() {
    window.location = baseUrl + 'login';
}

function checkValidation(moduleName, fieldName, messageName) {
    var val = $('#' + fieldName).val();
    var newFieldName = moduleName + '-' + fieldName;
    validationMessageHide(newFieldName);
    if (!val || !val.trim()) {
        validationMessageShow(newFieldName, messageName);
    }
}

function validationMessageHide(moduleName) {
    if (typeof moduleName === "undefined") {
        $('.error-message').hide();
        $('.error-message').html('');
    } else {
        $('.error-message-' + moduleName).hide();
        $('.error-message-' + moduleName).html('');
    }
}

function validationMessageShow(moduleName, messageName) {
    $('.error-message-' + moduleName).html(messageName);
    $('.error-message-' + moduleName).show();
}

function getBasicMessageAndFieldJSONArray(field, message) {
    var returnData = {};
    returnData['message'] = message;
    returnData['field'] = field;
    return returnData;
}

function resetForm(formId) {
    validationMessageHide();
    $('#' + formId).trigger("reset");
}

function checkValidationForPin(moduleName, fieldName, messageName) {
    var val = $('#' + fieldName).val();
    var newFieldName = moduleName + '-' + fieldName;
    validationMessageHide(newFieldName);
    if (!val || !val.trim()) {
        validationMessageShow(newFieldName, messageName);
        return false;
    }
    if (val.length != 6) {
        validationMessageShow(newFieldName, sixDigitPinValidationMessage);
        return false;
    }
}

function generateSelect2() {
    $('.select2').select2({"allowClear": true});
}

function generateSelect2WithId(id) {
    $('#' + id).select2({"allowClear": true});
}

function renderOptionsForTwoDimensionalArray(dataArray, comboId, addBlankOption) {
    if (!dataArray) {
        return false;
    }
    if (typeof addBlankOption === "undefined") {
        addBlankOption = true;
    }
    if (addBlankOption) {
        $('#' + comboId).html('<option value="">&nbsp;</option>');
    }
    var data = {};
    $.each(dataArray, function (index, dataObject) {
        data = {"value_field": index, 'text_field': dataObject};
        $("#" + comboId).append('<option value="' + index + '">' + dataObject + '</option>');
    });
}

function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(dataArray, comboId, keyId, valueId, message) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="">Select ' + message + '</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            data = {"value_field": dataObject[keyId], 'text_field': dataObject[valueId]};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}
function renderOptionsForStateAndDistrict(dataArray, comboId, keyId, valueId, message) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="0">' + message + '</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            data = {"value_field": dataObject[keyId], 'text_field': dataObject[valueId]};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}

function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(dataArray, comboId, keyId, valueId, valueId2, addBlankOption) {
    if (!dataArray) {
        return false;
    }
    if (typeof addBlankOption === "undefined") {
        addBlankOption = true;
    }
    if (addBlankOption) {
        $('#' + comboId).html('<option value="">&nbsp;</option>');
    }
    var data = {};
    var optionResult = "";
    var textField = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            if (dataObject[valueId2]) {
                textField = dataObject[valueId] + (dataObject[valueId2] != null ? '( ' + dataObject[valueId2] + ' )' : '');
            } else {
                textField = dataObject[valueId];
            }
            data = {"value_field": dataObject[keyId], 'text_field': textField};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}

function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForDistrict(dataArray, comboId, keyId, valueId, message) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="">Select ' + message + '</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            data = {"value_field": dataObject[keyId], 'text_field': dataObject[valueId]};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}

function dateTo_DD_MM_YYYY(date, delimeter) {
    var delim = delimeter ? delimeter : '-';
    var d = new Date(date || Date.now()),
            month = d.getMonth() + 1,
            day = '' + d.getDate(),
            year = d.getFullYear();
    if (month < 10)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;
    return [day, month, year].join(delim);
}

function dateTo_DD_MM_YYYY_HH_II_SS(date, delimeter) {
    var delim = delimeter ? delimeter : '-';
    var d = new Date(date || Date.now()),
            month = d.getMonth() + 1,
            day = '' + d.getDate(),
            year = d.getFullYear();
    if (month < 10)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    var hours = d.getHours();
    var minutes = d.getMinutes();
    var seconds = d.getSeconds();
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    return [day, month, year].join(delim) + ' ' + hours + ':' + minutes + ':' + seconds;
}

function getPerviousDateTo_DD_MM_YYYY(days, date) {
    var d = new Date(date || Date.now());
    d.setDate(d.getDate() - days);
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var year = d.getFullYear();
    if (month < 10)
        month = '0' + month;
    if (day < 10)
        day = '0' + day;
    return [day, month, year].join('-');
}

function getNextDateTo_DD_MM_YYYY(days, date) {
    var ndate = date.split("-").reverse().join("-");
    var d = new Date(ndate || Date.now());
    d.setDate(d.getDate() + days);
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var year = d.getFullYear();
    if (month < 10)
        month = '0' + month;
    if (day < 10)
        day = '0' + day;
    return [day, month, year].join('-');
}

function dateTo_YYYY_MM_DD(date, delimeter) {
    return date.split('-').reverse().join('-');
}

function getCurrentTime() {
    var date = new Date();
    var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
    var am_pm = date.getHours() >= 12 ? "PM" : "AM";
    hours = hours < 10 ? "0" + hours : hours;
    var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
    return hours + ":" + minutes + ":" + " " + am_pm;
}

function checkPincode(obj) {
    var pincode = obj.val();
    var pincodeValidationMessage = pincodeValidation(pincode);
    if (pincodeValidationMessage != '') {
        showError(pincodeValidationMessage);
        return false;
    }
}


function pincodeValidation(pincode) {
    if (!pincode) {
        return '';
    }
    var regex = /^[1-9][0-9]{5}$/;
    if (!regex.test(pincode)) {
        return 'Invalid Pincode';
    }
    return '';
}

function checkNumeric(obj) {
    if (!$.isNumeric(obj.val())) {
        obj.val("");
    }
}

function allowOnlyIntegerValue(id) {
    $('#' + id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
}

function roundOff(obj) {
    var amount = obj.val();
    if ($.isNumeric(amount)) {
        obj.val(parseFloat(Math.abs(amount)).toFixed(2));
    }
}
var districtRenderer = function (data, type, full, meta) {
    return talukaArray[data] ? talukaArray[data] : '';
};
var entityEstablishmentRenderer = function (data, type, full, meta) {
    return entityEstablishmentTypeArray[data] ? entityEstablishmentTypeArray[data] : '';
};
var serialNumberRenderer = function (data, type, full, meta) {
    return meta.row + meta.settings._iDisplayStart + 1;
};

var appStatusRenderer = function (data, type, full, meta) {
    return appStatusArray[data] ? appStatusArray[data] : appStatusArray[VALUE_ZERO];
};

var premisesStatusRenderer = function (data, type, full, meta) {
    return premisesStatusArray[data] ? premisesStatusArray[data] : '';
};

var newAppStatusRenderer = function (data, type, full, meta) {
    return '<div id="status_' + data + '">' + (appStatusArray[full.status] ? appStatusArray[full.status] : appStatusArray[VALUE_ZERO]) + '</div>' +
            '<div id="total_fees_' + data + '">' + returnFees(full) + '</div>';
};
var AppStatusforSRRenderer = function (data, type, full, meta) {
    return '<div id="status_' + data + '">' + (appStatusArray[full.status] ? appStatusArray[full.status] : appStatusArray[VALUE_ZERO]) + '</div>' +
            '<div id="total_fees_' + data + '">' + returnFees(full) + '</div>' +
            '<hr><div id="letter_status_' + data + '">' + (socRegUlStatusArray[full.letter_status] ? socRegUlStatusArray[full.letter_status] : socRegUlStatusArray[VALUE_ZERO]) + '</div>';
};

function returnFees(full) {
    return (full.total_fees ? (full.total_fees != VALUE_ZERO ? '<hr><span class="badge bg-success app-status">Fees : ' + full.total_fees + '/-</span>' : '') : '')
}

function fdRenderer(full) {
    var returnString = '<table class="table table-bordered mb-0 bg-beige f-s-app-details table-lh1">';
    if ((full.fee_descriptions != '' && full.fee_descriptions != null) && (full.fees != '' && full.fees != null)) {
        var feesArray = full.fees.split(',');
        var feeDescriptionsArray = full.fee_descriptions.split(',');
        var sn = 1;
        returnString += '<tr><th class="text-center">No.</th><th class="text-center">Fee Description</th><th class="text-center">Fee</th></tr>';
        for (var i = 0; i < feesArray.length; i++) {
            var fee = feesArray[i];
            var fd = feeDescriptionsArray[i];
            returnString += '<tr>';
            returnString += '<td class="text-center">' + sn + '</td>';
            returnString += '<td class="text-left">' + fd + '</td>';
            returnString += '<td class="text-right">' + fee + '/-' + '</td>';
            returnString += '</tr>';
            sn++;
        }
    } else {
        returnString = 'Fees Not Applicable';
    }
    returnString += '</table>';
    return returnString;
}

var queryStatusRenderer = function (data, type, full, meta) {
    return '<div id="query_status_' + data + '">' + (queryStatusArray[full.query_status] ? queryStatusArray[full.query_status] : queryStatusArray[VALUE_ZERO]) + '</div>';
};
var renewalStatusRenderer = function (data, type, full, meta) {
    return '<div id="renewal_status_' + data + '">' + (renewalStatusArray[full.renewal_status] ? renewalStatusArray[full.renewal_status] : renewalStatusArray[VALUE_ZERO]) + '</div>';
};

var dateRenderer = function (data, type, full, meta) {
    return dateTo_DD_MM_YYYY(data);
};

var dateTimeRenderer = function (data, type, full, meta) {
    return data != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(data) : '-';
};

function checkAlphabets(obj) {
    obj.val(obj.val().replace(/[^a-z A-Z.]/g, ""));
    if ((event.which >= 48 && event.which <= 57)) {
        event.preventDefault();
    }
}

function checkAlphabetsBlur(obj) {
    obj.val(obj.val().replace(/[^a-z A-Z.]/g, ''));
}

function datePicker() {
    $('.date_picker').datetimepicker({
        icons:
                {
                    up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down',
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
    });
    dateChangeEvent();
}
function datetimePicker() {
    $('.datetimepicker').datetimepicker({
        format: 'DD-MM-YYYY HH:mm'
    });
    // $('.datetimepicker').datetimepicker();
}
function timePicker() {
    $('.timepicker').datetimepicker({
        format: 'LT'
    })
}

function startDateEndDateFunctionality(startDateId, endDateId) {
    $('#' + startDateId).datetimepicker();
    $('#' + endDateId).datetimepicker({
        useCurrent: false //Important! See issue #1075
    });
    $('#' + startDateId).on("dp.change", function (e) {
        $('#' + endDateId).data("DateTimePicker").minDate(e.date);
    });
    $('#' + endDateId).on("dp.change", function (e) {
        $('#' + startDateId).data("DateTimePicker").maxDate(e.date);
    });
    dateChangeEvent();
}

function dateChangeEvent() {
    $('.date_picker').keyup(function (e) {
        e = e || window.event; //for pre-IE9 browsers, where the event isn't passed to the handler function
        if (e.keyCode == '37' || e.which == '37' || e.keyCode == '39' || e.which == '39') {
            var message = ' ' + $('.ui-state-hover').html() + ' ' + $('.ui-datepicker-month').html() + ' ' + $('.ui-datepicker-year').html();
            if ($(this).attr('id') == 'startDate') {
                $(".date_picker").val(message);
            }
        }
    });
}

function checkValidationForMobileNumber(moduleName, id) {
    var mobileNumber = $('#' + id).val();
    if (!mobileNumber) {
        validationMessageShow(moduleName + '-' + id, mobileValidationMessage);
        return;
    }
    var validate = mobileNumberValidation(mobileNumber);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
    validationMessageHide(moduleName + '-' + id);
}

function mobileNumberValidation(mobileNumber) {
    var filter = /^[0-9-+]+$/;
    if (mobileNumber.length != 10 || !filter.test(mobileNumber)) {
        return invalidMobileValidationMessage;
    }
    return '';
}

function checkValidationForEmail(moduleName, id) {
    var emailId = $('#' + id).val();
    if (!emailId) {
        validationMessageShow(moduleName + '-' + id, emailValidationMessage);
        return false;
    }
    var validate = emailIdValidation(emailId);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
    validationMessageHide(moduleName + '-' + id);
}

function checkValidationForEmailBlank(moduleName, id) {
    validationMessageHide(moduleName + '-' + id);
    var emailId = $('#' + id).val();
    if (!emailId) {
        return false;
    }
    var validate = emailIdValidation(emailId);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
}

function emailIdValidation(emailId) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(emailId)) {
        return invalidEmailValidationMessage;
    }
    return '';
}

function toastFire(type, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 10000
    });

    Toast.fire({
        type: type,
        title: '<span style="padding-left: 10px; padding-right: 10px;">' + message + '</span>',
        showCloseButton: true,
    });
}

function showConfirmation(yesEvent, message) {
    $('.swal2-popup').removeClass('p-5px');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'Are you sure You want to ' + message + ' ?',
        type: 'warning',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes, ' + message + ' it !',
        cancelButtonText: 'No, Cancel !',
    }).then((result) => {
        if (result.value) {
            $('#temp_btn').attr('onclick', yesEvent);
            $('#temp_btn').click();
            $('#temp_btn').attr('onclick', '');
        }
    });
}

function showPopup() {
    const swalWithBootstrapButtons = Swal.mixin({});
    swalWithBootstrapButtons.fire({
        showCancelButton: false,
        showConfirmButton: false,
        html: '<div id="popup_container"></div>',
    });
    $('.swal2-popup').addClass('p-5px');
}

function showSuccess(message) {
    toastFire('success', message);
}


var _validFileExtensions = [".jpg", ".jpeg", ".png"];
//var _validFileExtensions = [".jpg", ".jpeg", ".png", ".pdf"];
var _imageFileExtensions = [".jpg", ".jpeg", ".png"];
function imagePdfValidation(oInput, message, imagePdfUploadAttrId) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                showError(message + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
            if (jQuery.inArray(sCurExtension, _imageFileExtensions) != -1) {
//                console.log("is in array");
                if (($('#' + imagePdfUploadAttrId)[0].files[0].size / 1204) > maxFileSizeInKb) {
                    $('#' + imagePdfUploadAttrId).val('');
                    $('#' + imagePdfUploadAttrId).focus();
                    showError('Maximum upload size ' + maxFileSizeInKb + ' mb only in ' + message);
                    return false;
                }
            } else {
//                console.log("is NOT in array");
                if ((($('#' + imagePdfUploadAttrId)[0].files[0].size / 1024) / 1024) > maxFileSizeInMb) {
                    $('#' + imagePdfUploadAttrId).val('');
                    $('#' + imagePdfUploadAttrId).focus();
                    showError('Maximum upload size ' + maxFileSizeInMb + ' mb only in ' + message);
                    return true;
                }
            }
        }
    }
    return true;
}

function imagePdfUploadValidation(imageUploadAttrId, message, isValidateFileSize) {
    var allowedFiles = ['.jpg', '.png', '.jpeg'];
//    var allowedFiles = ['.jpg', '.png', '.jpeg', '.pdf'];
    var allowedFilesImage = ['.jpg', '.png', '.jpeg'];
    var imageName = $('#' + imageUploadAttrId).val();
    var fileExtension = imageName.replace(/^.*\./, '');
//    if (imageName.length > 0) {
    var regex = new RegExp('([a-zA-Z0-9\s_\\.\-:])+(' + allowedFiles.join('|') + ')$');

    if (!regex.test(imageName.toLowerCase())) {
        showError(message + ' <b>' + allowedFiles.join(', ') + '</b> only.');
        return true;
    }

    if (jQuery.inArray('.' + fileExtension, allowedFilesImage) != -1) {
        if (isValidateFileSize) {
            if (($('#' + imageUploadAttrId)[0].files[0].size / 1204) > maxFileSizeInKb) {
                $('#' + imageUploadAttrId).val('');
                $('#' + imageUploadAttrId).focus();
                showError('Maximum upload size ' + maxFileSizeInKb + 'kb only.');
                return true;
            }
        }
    } else {
        if (isValidateFileSize) {
            if ((($('#' + imageUploadAttrId)[0].files[0].size / 1024) / 1024) > maxFileSizeInMb) {
                $('#' + imageUploadAttrId).val('');
                $('#' + imageUploadAttrId).focus();
                showError('Maximum upload size ' + maxFileSizeInMb + ' mb only.');
                return true;
            }
        }
    }
//    }
    return false;
}

function showError(message) {
    toastFire('error', message);
}

function activeLink(id) {
    $('.nav-link').removeClass('active');
    addClass(id, 'active');
}

function addClass(id, className) {
    $('#' + id).addClass(className);
}

function addTagSpinner(id) {
    $('#' + id).parent().find('.error-message').before(tagSpinnerTemplate);
}

function removeTagSpinner() {
    $('#tag_spinner').remove();
}

function resetModel() {
    $('#popup_modal').modal('hide');
    $('#model_title').html('');
    $('#model_body').html('');
}

function activeSelectedBtn(obj) {
    $('.small-btn').removeClass('btn-success');
    $('.small-btn').addClass('btn-primary');
    if (obj) {
        obj.removeClass('btn-primary');
        obj.addClass('btn-success');
    }
}

function selectOrDeselectRow(obj, id) {
    if (obj.hasClass('bg-white')) {
        obj.removeClass('bg-white');
        obj.addClass('bg-active');
        $('#' + id).prop('checked', true);
    } else {
        obj.removeClass('bg-active');
        obj.addClass('bg-white');
        $('#' + id).prop('checked', false);
    }
}

function getTotalSelectedRows(id) {
    $('#' + id).html($('.bg-active').length);
}

var trimColumnValueRenderer = function (data, type, full, meta) {
    return (data).trim();
};

function generateRandomString(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function getDistrictData(stateId, districtId) {
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor([], districtId, 'district_code', 'district_name', 'District');
    $('#' + districtId).val('');
    var stateCode = $('#' + stateId).val();
    if (!stateCode) {
        return;
    }
    var districtData = tempDistrictData[stateCode] ? tempDistrictData[stateCode] : [];
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(districtData, districtId, 'district_code', 'district_name', 'District');
    $('#' + districtId).val('');
}

function fileUploadValidation(imageUploadAttrId, size = 1024) {
    var allowedFiles = ['jpg', 'png', 'jpeg', 'jfif', 'pdf', 'zip'];
    var fileName = $('#' + imageUploadAttrId).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if ($.inArray(ext, allowedFiles) == -1) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Please upload File having extensions: <b>' + allowedFiles.join(', ') + '</b> only.';
    }
    if (($('#' + imageUploadAttrId)[0].files[0].size / 1024) > size) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Maximum upload size ' + (size / 1024) + ' MB only.';
    }
    return false;
}

function imagefileUploadValidation(imageUploadAttrId, size = 1024) {
    var allowedFiles = ['jpg', 'png', 'jpeg', 'jfif'];
    var fileName = $('#' + imageUploadAttrId).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if ($.inArray(ext, allowedFiles) == -1) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Please upload File having extensions: <b>' + allowedFiles.join(', ') + '</b> only.';
    }
    if (($('#' + imageUploadAttrId)[0].files[0].size / 1024) > size) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Maximum upload size ' + (size / 1024) + ' MB only.';
    }
    return false;
}

function pdffileUploadValidation(imageUploadAttrId, size = 1024) {
    var allowedFiles = ['pdf', 'zip'];
    var fileName = $('#' + imageUploadAttrId).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if ($.inArray(ext, allowedFiles) == -1) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Please upload File having extensions: <b>' + allowedFiles.join(', ') + '</b> only.';
    }
    if (($('#' + imageUploadAttrId)[0].files[0].size / 1024) > size) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Maximum upload size ' + (size / 1024) + ' MB only.';
    }
    return false;
}
function videoUploadValidation(imageUploadAttrId, size) {
    var allowedFiles = ['wmv', 'mp4', 'avi', 'mov'];
    var fileName = $('#' + imageUploadAttrId).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if ($.inArray(ext, allowedFiles) == -1) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Please upload File having extensions: <b>' + allowedFiles.join(', ') + '</b> only.';
    }
    if (($('#' + imageUploadAttrId)[0].files[0].size / 1024) > size) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Maximum upload size 1 MB only.';
    }
    return false;
}

var dataTableProcessingAndNoDataMsg = {
    'loadingRecords': '<span class="color-nic-blue"><i class="fas fa-spinner fa-spin fa-2x"></i></span>',
    'processing': '<span class="color-nic-blue"><i class="fas fa-spinner fa-spin fa-3x"></i></span>',
    'emptyTable': 'No Data Available !'
};

var searchableDatatable = function (settings, json) {
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

var fontRenderer = function (data, type, full, meta) {
    return '<span class="table-bold-data">' + data + '</span>';
};

function getSubCategoryData(categoryIdText, subCategoryIdText) {
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor([], subCategoryIdText, 'sub_category_id', 'sub_category_name', 'Sub Category');
    var categoryId = $('#' + categoryIdText).val();
    if (!categoryId) {
        return;
    }
    $.ajax({
        url: 'pmanage/get_sub_category_data_for_product',
        type: 'post',
        data: $.extend({}, {'category_id': categoryId}, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
            showError(textStatus.statusText);
            $('html, body').animate({scrollTop: '0px'}, 0);
        },
        success: function (response) {
            var parseData = JSON.parse(response);
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                showError(parseData.message);
                $('html, body').animate({scrollTop: '0px'}, 0);
                return false;
            }
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(parseData.sub_category_data, subCategoryIdText, 'sub_category_id', 'sub_category_name', 'Sub Category');
            $('#' + subCategoryIdText).val('');
        }
    });
}

function generateBoxes(type, data, id, moduleName, existingArray, isBr, isDiv = false) {
    $.each(data, function (index, value) {
        var template = (isDiv ? '<div class="col-sm-4">' : '') + '<label class="' + type +
                '-inline form-title f-w-n m-b-0px ' + (isDiv ? '' : 'm-r-10px') + ' cursor-pointer"><input type="' + type + '" class="mb-0 cursor-pointer" id="' + id +
                '_for_' + moduleName + '_' + index + '" name="' + id + '_for_' + moduleName + '" value="' +
                index + '">&nbsp;&nbsp;' + value + '</label>' + (isDiv ? '</div>' : '');
        if (isBr) {
            template += '<br>';
        }
        $('#' + id + '_container_for_' + moduleName).append(template);
    });
    if (existingArray) {
        if (type == 'checkbox') {
            var existingData = (existingArray).split(',');
            $.each(existingData, function (index, value) {
                $('input[name=' + id + '_for_' + moduleName + '][value="' + value + '"]').click();
            });
        } else {
            $('input[name=' + id + '_for_' + moduleName + '][value="' + existingArray + '"]').click();
        }
    } else {
        $('input[name=' + id + '_for_' + moduleName + '][value="' + existingArray + '"]').click();
}
}

function showSubContainerForPaymentDetails(id, moduleName, showId, type) {
    var otherId = '';
    if (type == 'radio') {
        otherId = $('input[name=' + id + '_for_' + moduleName + ']:checked').val();
    } else {
        otherId = $('#' + id + '_for_' + moduleName).val();
    }
    if (otherId == VALUE_ONE) {
        $('#' + showId + '_container_for_' + moduleName + '').show();
    }
    $('input[name=' + id + '_for_' + moduleName + ']').change(function () {
        var other = $(this).val();
        $('#' + showId + '_container_for_' + moduleName + '').hide();
        if (other == VALUE_ONE) {
            $('#' + showId + '_container_for_' + moduleName + '').show();
            return false;
        }
    });
}

function getLocation() {
    tempLocationData = {};
    tempLocationData.latitude = '';
    tempLocationData.longitude = '';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getCurrentLatLong);
    }
}

function getCurrentLatLong(position) {
    $('#latitude_for_road_details').val(position.coords.latitude);
    $('#longitude_for_road_details').val(position.coords.longitude);
}

function showSubContainer(id, moduleName, showId, showValue, type) {
    var otherId = '';
    if (type == 'radio') {
        otherId = $('input[name=' + id + '_for_' + moduleName + ']:checked').val();
    }
    if (type == 'checkbox') {
        if ($('input[name=' + id + '_for_' + moduleName + '][value="' + showValue + '"]').is(':checked')) {
            otherId = showValue;
        }
    }
    if (otherId == showValue) {
        $(showId + '_container_for_' + moduleName).show();
    }
    $('input[name=' + id + '_for_' + moduleName + ']').change(function () {
        var other = $(this).val();
        $(showId + '_container_for_' + moduleName).hide();
        if (type == 'radio') {
            if (other == showValue) {
                $(showId + '_container_for_' + moduleName).show();
                return false;
            }
        }
        if (type == 'checkbox') {
            if ($('input[name=' + id + '_for_' + moduleName + '][value="' + showValue + '"]').is(':checked')) {
                $(showId + '_container_for_' + moduleName).show();
                return false;
            }
        }
    });
}

function getEncryptedId(id) {
    return generateRandomString(3) + window.btoa(id) + generateRandomString(3);
}

function getDescryptedId(encryptedId) {
    var tempString = encryptedId.substr(3);
    var tempString2 = tempString.substr(0, -3);
    return window.atob(tempString2);
}

function resetCounter(className) {
    var cnt = 1;
    $('.' + className).each(function () {
        $(this).html(cnt);
        cnt++;
    });
}
function returnCounter(className) {
    var cnt = 0;
    $('.' + className).each(function () {
        cnt++;
    });
    return cnt;
}

function getTextOfId(dataArray, value, compareValue, otherValue) {
    var data = dataArray[value] ? dataArray[value] : '';
    if (compareValue != '' && otherValue != '') {
        if (value == compareValue) {
            data = data + '(' + otherValue + ')';
        }
    }
    return data;
}

var emailRenderer = function (data, type, full, meta) {
    return data.replace('@', '<br>@');
};

function removeDocument(id, moduleName) {
    $('#' + id + '_name_container_for_' + moduleName).hide();
    $('#' + id + '_container_for_' + moduleName).show();
    $('#' + id + '_name_href_for_' + moduleName).attr('href', '');
    $('#' + id + '_name_for_' + moduleName).html('');
    $('#' + id + '_remove_btn_for_' + moduleName).attr('onclick', '');
}

function removeRowDetails(moduleName, cnt) {
    $('#' + moduleName + '_row_' + cnt).remove();
    resetCounter(moduleName + '-cnt');
}

var _validFileExtensions = [".jpg", ".jpeg", ".png"];
//var _validFileExtensions = [".jpg", ".jpeg", ".png", ".pdf"];
var _imageFileExtensions = [".jpg", ".jpeg", ".png"];
function imagePdfValidation(oInput, message, imagePdfUploadAttrId) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                showError(message + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
            if (jQuery.inArray(sCurExtension, _imageFileExtensions) != -1) {
                if (($('#' + imagePdfUploadAttrId)[0].files[0].size / 1204) > maxFileSizeInKb) {
                    $('#' + imagePdfUploadAttrId).val('');
                    $('#' + imagePdfUploadAttrId).focus();
                    showError('Maximum upload size ' + maxFileSizeInKb + ' mb only in ' + message);
                    return false;
                }
            } else {
                if ((($('#' + imagePdfUploadAttrId)[0].files[0].size / 1024) / 1024) > maxFileSizeInMb) {
                    $('#' + imagePdfUploadAttrId).val('');
                    $('#' + imagePdfUploadAttrId).focus();
                    showError('Maximum upload size ' + maxFileSizeInMb + ' mb only in ' + message);
                    return true;
                }
            }
        }
    }
    return true;
}

function imagePdfUploadValidation(imageUploadAttrId, message, isValidateFileSize) {
    var allowedFiles = ['.jpg', '.png', '.jpeg'];
//    var allowedFiles = ['.jpg', '.png', '.jpeg', '.pdf'];
    var allowedFilesImage = ['.jpg', '.png', '.jpeg'];
    var imageName = $('#' + imageUploadAttrId).val();
    var fileExtension = imageName.replace(/^.*\./, '');
//    if (imageName.length > 0) {
    var regex = new RegExp('([a-zA-Z0-9\s_\\.\-:])+(' + allowedFiles.join('|') + ')$');

    if (!regex.test(imageName.toLowerCase())) {
        showError(message + ' <b>' + allowedFiles.join(', ') + '</b> only.');
        return true;
    }

    if (jQuery.inArray('.' + fileExtension, allowedFilesImage) != -1) {
        if (isValidateFileSize) {
            if (($('#' + imageUploadAttrId)[0].files[0].size / 1204) > maxFileSizeInKb) {
                $('#' + imageUploadAttrId).val('');
                $('#' + imageUploadAttrId).focus();
                showError('Maximum upload size ' + maxFileSizeInKb + 'kb only.');
                return true;
            }
        }
    } else {
        if (isValidateFileSize) {
            if ((($('#' + imageUploadAttrId)[0].files[0].size / 1024) / 1024) > maxFileSizeInMb) {
                $('#' + imageUploadAttrId).val('');
                $('#' + imageUploadAttrId).focus();
                showError('Maximum upload size ' + maxFileSizeInMb + ' mb only.');
                return true;
            }
        }
    }
//    }
    return false;
}

function setCaptchaCode(moduleName) {
    var randomNum1 = getRandom(),
            randomNum2 = getRandom();
    var total = randomNum1 + randomNum2;
    $("#captcha_container_for_" + moduleName).html(randomNum1 + " + " + randomNum2 + " = ?");
    $('#captcha_code_for_' + moduleName).val(total);
    $('#captcha_code_varification_for_' + moduleName).val('');
}

function getRandom() {
    return Math.ceil(Math.random() * 10);
}

function countDownForOTP(btnObj) {
    var minutes = 0;
    var seconds = 59;
    function tick() {
        seconds--;
        btnObj.html("0" + minutes + ":" + (seconds < 10 ? "0" : "") + String(seconds));
        if (seconds > 0) {
            setTimeout(tick, 1000);
        } else {
            if (minutes <= 0) {
                btnObj.html('Resend OTP');
                btnObj.attr('onclick', 'countDownForOTP($(this));');
            } else {
                minutes--;
                seconds = 59;
                btnObj.html("0" + minutes + ":" + (seconds < 10 ? "0" : "") + String(seconds));
                setTimeout(tick, 1000);
            }
        }
    }
    tick();
}

function basicConfigurationForLogin() {
    allowOnlyIntegerValue('mobile_number_for_login');
    allowOnlyIntegerValue('pin_for_login');

    $('#login_form').find('input').keypress(function (e) {
        if (e.which == 13) {
            checkLogin($('#submit_btn_for_login'));
        }
    });
}

function checkValidationForLogin(loginFormData) {
    if (!loginFormData.mobile_number_for_login) {
        return getBasicMessageAndFieldJSONArray('mobile_number_for_login', mobileValidationMessage);
    }
    var mobileNumberMessage = mobileNumberValidation(loginFormData.mobile_number_for_login);
    if (mobileNumberMessage != '') {
        return getBasicMessageAndFieldJSONArray('mobile_number_for_login', mobileNumberMessage);
    }
    if (!loginFormData.pin_for_login) {
        return getBasicMessageAndFieldJSONArray('pin_for_login', pinValidationMessage);
    }
    if ((loginFormData.pin_for_login).length != 6) {
        return getBasicMessageAndFieldJSONArray('pin_for_login', invalidPinValidationMessage);
    }
    return '';
}

function checkLogin(btnObj) {
    validationMessageHide();
    var loginFormData = $('#login_form').serializeFormJSON();
    var validationData = checkValidationForLogin(loginFormData);
    if (validationData != '') {
        $('#' + validationData.field).focus();
        validationMessageShow('login-' + validationData.field, validationData.message);
        return false;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html('Processing..');
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'login/check_login',
        data: $.extend({}, loginFormData, getTokenData()),
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
            validationMessageShow('login', textStatus.statusText);
        },
        success: function (data) {
            var parseData = JSON.parse(data);
            if (!isJSON(data)) {
                loginPage();
                return false;
            }
            setNewToken(parseData.temp_token);
            if (parseData.success == false) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('login', parseData.message);
                return false;
            }
            window.location = baseUrl + 'main';
        }
    });
}

function regNoRenderer(moduleType, moduleId) {
    var pre = prefixModuleArray[moduleType] ? prefixModuleArray[moduleType] : '';
    return pre + ('00000' + moduleId).slice(-5);
}

function appNoRenderer(full) {
    var pre = prefixModuleArray[full.mt] ? prefixModuleArray[full.mt] : '';
    return pre + ('00000' + full.m_id).slice(-5);
}

function loadQueryManagementModule(parseData, templateData, tmpData) {
    var moduleData = parseData.module_data;
    $('#model_title').html('Query Management');
    $('#model_body').html(queryFormTemplate(tmpData));
    var cnt = 1;
    var lastRecord = 0;
    $.each(parseData.query_data, function (index, qd) {
        qd.cnt = cnt;
        qd.show_extra_div = true;
        qd.datetime_text = qd.display_datetime;
        if (qd.query_type == VALUE_ONE) {
            if (qd.status == VALUE_ONE) {
                if (!jQuery.isEmptyObject(qd.query_documents)) {
                    qd.show_document_container = true;
                }
                $('#query_item_container').prepend(queryQuestionViewTemplate(qd));
                loadQueryDocItemForViewQuestion(qd.query_documents, cnt);
            }
        }
        if (qd.query_type == VALUE_TWO) {
            if (qd.status == VALUE_ONE) {
                if (!jQuery.isEmptyObject(qd.query_documents)) {
                    qd.show_document_container = true;
                }
                $('#query_item_container').prepend(queryAnswerViewTemplate(qd));
                loadQueryDocItemForView(qd.query_documents, cnt);
            } else {
                qd.datetime_text = '00-00-0000 00:00:00';
                $('#query_item_container').prepend(queryAnswerTemplate(qd));
                $.each(qd.query_documents, function (index, docData) {
                    addDocumentRow(docData);
                });
            }
        }
        lastRecord = index;
        cnt++;
    });
    if (moduleData.query_status == VALUE_ONE) {
        var queryData = parseData.query_data;
        if (lastRecord != 0) {
            var tempQStatus = queryData[lastRecord] ? queryData[lastRecord]['query_type'] : [];
            if (tempQStatus == VALUE_ONE) {
                templateData.datetime_text = '00-00-0000 00:00:00';
                templateData.query_type = VALUE_TWO;
                $('#query_item_container').prepend(queryAnswerTemplate(templateData));
            }
        }
//        if (cnt % 2 == 0) {
//            templateData.datetime_text = '00-00-0000 00:00:00';
//            templateData.query_type = VALUE_TWO;
//            $('#query_item_container').prepend(queryAnswerTemplate(templateData));
//        }
    }
    $('#popup_modal').modal('show');
}

function checkValidationForSubmitQueryAnswerDetails() {
    validationMessageHide();
    var moduleType = $('#module_type_for_query_answer').val();
    if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE && moduleType != VALUE_FOUR &&
            moduleType != VALUE_FIVE && moduleType != VALUE_SIX && moduleType != VALUE_SEVEN && moduleType != VALUE_EIGHT && moduleType != VALUE_NINE && moduleType != VALUE_TEN && moduleType != VALUE_ELEVEN && moduleType != VALUE_TWELVE && moduleType != VALUE_THIRTEEN && moduleType != VALUE_FOURTEEN && moduleType != VALUE_FIFTEEN && moduleType != VALUE_SIXTEEN && moduleType != VALUE_SEVENTEEN && moduleType != VALUE_EIGHTEEN &&
            moduleType != VALUE_NINETEEN && moduleType != VALUE_TWENTY && moduleType != VALUE_TWENTYONE && moduleType != VALUE_TWENTYTWO && moduleType != VALUE_TWENTYTHREE &&
            moduleType != VALUE_TWENTYFOUR && moduleType != VALUE_TWENTYFIVE && moduleType != VALUE_TWENTYSIX && moduleType != VALUE_TWENTYSEVEN && moduleType != VALUE_TWENTYEIGHT && moduleType != VALUE_TWENTYNINE && moduleType != VALUE_THIRTY && moduleType != VALUE_THIRTYONE && moduleType != VALUE_THIRTYTWO && moduleType != VALUE_THIRTYTHREE && moduleType != VALUE_THIRTYFOUR && moduleType != VALUE_THIRTYFIVE &&
            moduleType != VALUE_THIRTYSIX && moduleType != VALUE_THIRTYSEVEN && moduleType != VALUE_THIRTYEIGHT && moduleType != VALUE_THIRTYNINE && moduleType != VALUE_FOURTY && moduleType != VALUE_FOURTYONE && moduleType != VALUE_FOURTYTWO && moduleType != VALUE_FOURTYTHREE && moduleType != VALUE_FOURTYFOUR && moduleType != VALUE_FOURTYFIVE && moduleType != VALUE_FOURTYSIX &&
            moduleType != VALUE_FOURTYEIGHT && moduleType != VALUE_FOURTYNINE && moduleType != VALUE_FIFTY && moduleType != VALUE_FIFTYTWO && moduleType != VALUE_FIFTYNINE && moduleType != VALUE_SIXTY && moduleType != VALUE_SIXTYONE) {
        return invalidAccessValidationMessage;
    }
    var moduleId = $('#module_id_for_query_answer').val();
    if (!moduleId) {
        return invalidAccessValidationMessage;
    }
    var queryType = $('#query_type_for_query_answer').val();
    if (queryType != VALUE_ONE && queryType != VALUE_TWO) {
        return invalidAccessValidationMessage;
    }
    var remarks = $('#remarks_for_query_answer').val();
    if (!remarks) {
        return remarksValidationMessage;
    }
    return '';
}

function askForSubmitQueryAnswerDetails() {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    var validationMessage = checkValidationForSubmitQueryAnswerDetails();
    if (validationMessage != '') {
        $('#remarks_for_query_answer').focus();
        validationMessageShow('query-answer-remarks_for_query_answer', validationMessage);
        return false;
    }
    var qdItems = getQDItems();
    if (!qdItems) {
        return false;
    }
    var yesEvent = 'submitQueryAnswerDetails()';
    showConfirmation(yesEvent, 'Submit');
}

function getQDItems() {
    var newQDItems = [];
    var exiQDItems = [];
    var isQDItemValidation;
    $('.query_answer_document_row').each(function () {
        var that = $(this);
        var tempCnt = that.find('.og_query_answer_document_cnt').val();
        if (tempCnt == '' || tempCnt == null) {
            showError(invalidAccessMsg);
            isQDItemValidation = true;
            return false;
        }
        var qdItem = {};
        var docName = $('#doc_name_for_query_answer_' + tempCnt).val();
        if (docName == '' || docName == null) {
            $('#doc_name_for_query_answer_' + tempCnt).focus();
            validationMessageShow('query-answer-doc_name_for_query_answer_' + tempCnt, documentNameValidationMessage);
            isQDItemValidation = true;
            return false;
        }
        qdItem.doc_name = docName;
        if ($('#document_container_for_query_answer_' + tempCnt).is(':visible')) {
            var uploadDoc = $('#document_for_query_answer_' + tempCnt).val();
            if (!uploadDoc) {
                validationMessageShow('query-answer-document_for_query_answer_' + tempCnt, uploadDocValidationMessage);
                isQDItemValidation = true;
                return false;
            }
            var uploadDocMessage = fileUploadValidation('document_for_query_answer_' + tempCnt, 2048);
            if (uploadDocMessage != '') {
                validationMessageShow('query-answer-document_for_query_answer_' + tempCnt, uploadDocMessage);
                isQDItemValidation = true;
                return false;
            }
        }

        var queryDocumentId = $('#query_document_id_for_query_answer_' + tempCnt).val();
        if (!queryDocumentId || queryDocumentId == null) {
            newQDItems.push(qdItem);
        } else {
            qdItem.query_document_id = queryDocumentId;
            exiQDItems.push(qdItem);
        }
    });
    if (isQDItemValidation) {
        return false;
    }
    return {'new_qd_items': newQDItems, 'exi_qd_items': exiQDItems};
}

function submitQueryAnswerDetails() {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    var validationMessage = checkValidationForSubmitQueryAnswerDetails();
    if (validationMessage != '') {
        $('#remarks_for_query_answer').focus();
        validationMessageShow('query-answer-remarks_for_query_answer', validationMessage);
        return false;
    }
    var formData = {};
    formData.query_id_for_query_answer = $('#query_id_for_query_answer').val();
    formData.module_type_for_query_answer = $('#module_type_for_query_answer').val();
    formData.module_id_for_query_answer = $('#module_id_for_query_answer').val();
    formData.query_type_for_query_answer = $('#query_type_for_query_answer').val();
    formData.remarks_for_query_answer = $('#remarks_for_query_answer').val();
    formData.new_qd_items = [];
    formData.exi_qd_items = [];
    var qdItems = getQDItems();
    if (!qdItems) {
        return false;
    }
    formData.new_qd_items = qdItems.new_qd_items;
    formData.exi_qd_items = qdItems.exi_qd_items;
    var btnObj = $('#submit_btn_for_query_answer');
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/answer_a_query',
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
            showError(textStatus.statusText);
            $('html, body').animate({scrollTop: '0px'}, 0);
        },
        success: function (response) {
            var parseData = JSON.parse(response);
            setNewToken(parseData.temp_token);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            if (parseData.success === false) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(parseData.message);
                $('html, body').animate({scrollTop: '0px'}, 0);
                return false;
            }
            showSuccess(parseData.message);
            var tempData = {};
            tempData.remarks = formData.remarks_for_query_answer;
            tempData.datetime_text = parseData.query_datetime;
            if (!jQuery.isEmptyObject(parseData.query_document_data)) {
                tempData.show_document_container = true;
            }
            tempData.cnt = 1;
            $('#query_answer_container').html(queryAnswerViewTemplate(tempData));
            $('#query_status_' + formData.module_id_for_query_answer).html(queryStatusArray[parseData.query_status]);
            loadQueryDocItemForView(parseData.query_document_data, tempData.cnt);
        }
    });
}

function loadQueryDocItemForViewQuestion(queryDocumentData, mainCnt) {
    var tempCnt = 1;
    $.each(queryDocumentData, function (index, docData) {
        docData.cnt = tempCnt;
        $('#document_item_container_for_query_view_' + mainCnt).append(documentItemViewTemplate(docData));
        if (docData.document) {
            $('#document_name_href_for_query_answer_view_' + tempCnt).attr('href', QUERY_PATH + docData['document']);
            $('#document_name_for_query_answer_view_' + tempCnt).html(docData['document']);
        }
        tempCnt++;
    });
}

function loadQueryDocItemForView(queryDocumentData, mainCnt) {
    var tempCnt = 1;
    $.each(queryDocumentData, function (index, docData) {
        docData.cnt = tempCnt;
        $('#document_item_container_for_query_answer_view_' + mainCnt).append(documentItemViewTemplate(docData));
        if (docData.document) {
            $('#document_name_href_for_query_answer_view_' + tempCnt).attr('href', 'documents/query/' + docData['document']);
            $('#document_name_for_query_answer_view_' + tempCnt).html(docData['document']);
        }
        tempCnt++;
    });
}

function addDocumentRow(templateData) {
    templateData.cnt = documentRowCnt;
    $('#document_item_container_for_query_answer').append(documentItemTemplate(templateData));
    if (templateData.document) {
        loadQueryDocument('document', documentRowCnt, templateData);
    }
    resetCounter('query-answer-document-cnt');
    documentRowCnt++;
}

function checkValidationForDocUpload() {
    validationMessageHide();
    var moduleType = $('#module_type_for_query_answer').val();
    if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE && moduleType != VALUE_FOUR &&
            moduleType != VALUE_FIVE && moduleType != VALUE_SIX && moduleType != VALUE_SEVEN && moduleType != VALUE_EIGHT && moduleType != VALUE_NINE && moduleType != VALUE_TEN && moduleType != VALUE_ELEVEN && moduleType != VALUE_TWELVE && moduleType != VALUE_THIRTEEN && moduleType != VALUE_FOURTEEN && moduleType != VALUE_FIFTEEN && moduleType != VALUE_SIXTEEN && moduleType != VALUE_SEVENTEEN && moduleType != VALUE_EIGHTEEN &&
            moduleType != VALUE_NINETEEN && moduleType != VALUE_TWENTY && moduleType != VALUE_TWENTYONE && moduleType != VALUE_TWENTYTWO && moduleType != VALUE_TWENTYTHREE &&
            moduleType != VALUE_TWENTYFOUR && moduleType != VALUE_TWENTYFIVE && moduleType != VALUE_TWENTYSIX && moduleType != VALUE_TWENTYSEVEN && moduleType != VALUE_TWENTYEIGHT && moduleType != VALUE_TWENTYNINE && moduleType != VALUE_THIRTY && moduleType != VALUE_THIRTYONE && moduleType != VALUE_THIRTYTWO && moduleType != VALUE_THIRTYTHREE && moduleType != VALUE_THIRTYFOUR && moduleType != VALUE_THIRTYFIVE && moduleType != VALUE_THIRTYSIX && moduleType != VALUE_THIRTYSEVEN && moduleType != VALUE_THIRTYEIGHT && moduleType != VALUE_THIRTYNINE && moduleType != VALUE_FOURTY && moduleType != VALUE_FOURTYONE && moduleType != VALUE_FOURTYTWO && moduleType != VALUE_FOURTYTHREE && moduleType != VALUE_FOURTYFOUR && moduleType != VALUE_FOURTYFIVE && moduleType != VALUE_FOURTYSIX &&
            moduleType != VALUE_FOURTYEIGHT && moduleType != VALUE_FOURTYNINE && moduleType != VALUE_FIFTY && moduleType != VALUE_FIFTYTWO && moduleType != VALUE_FIFTYNINE && moduleType != VALUE_SIXTY && moduleType != VALUE_SIXTYONE) {
        return invalidAccessValidationMessage;
    }
    var moduleId = $('#module_id_for_query_answer').val();
    if (!moduleId) {
        return invalidAccessValidationMessage;
    }
    var queryType = $('#query_type_for_query_answer').val();
    if (queryType != VALUE_ONE && queryType != VALUE_TWO) {
        return invalidAccessValidationMessage;
    }
    return '';
}

function uploadDocumentForQueryAnswer(tempCnt) {
    var validationMessage = checkValidationForDocUpload();
    if (validationMessage != '') {
        showError(validationMessage);
        return false;
    }
    var id = 'document_for_query_answer_' + tempCnt;
    var doc = $('#' + id).val();
    if (doc == '') {
        return false;
    }
    var materialslipMessage = fileUploadValidation(id, 20480);
    if (materialslipMessage != '') {
        showError(materialslipMessage);
        return false;
    }
    $('#document_container_for_query_answer_' + tempCnt).hide();
    $('#document_name_container_for_query_answer_' + tempCnt).hide();
    $('#spinner_template_for_query_answer_' + tempCnt).show();
    var formData = new FormData();
    formData.append('query_id_for_query_answer', $('#query_id_for_query_answer').val());
    formData.append('module_type_for_query_answer', $('#module_type_for_query_answer').val());
    formData.append('module_id_for_query_answer', $('#module_id_for_query_answer').val());
    formData.append('query_type_for_query_answer', $('#query_type_for_query_answer').val());
    formData.append('query_document_id_for_query_answer', $('#query_document_id_for_query_answer_' + tempCnt).val());
    formData.append('document_for_query_answer', $('#' + id)[0].files[0]);
    $.ajax({
        type: 'POST',
        url: 'utility/upload_query_document',
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
            $('#spinner_template_for_query_answer_' + tempCnt).hide();
            $('#document_container_for_query_answer_' + tempCnt).show();
            $('#document_name_container_for_query_answer_' + tempCnt).hide();
            $('#' + id).val('');
            showError(textStatus.statusText);
        },
        success: function (data) {
            var parseData = JSON.parse(data);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            if (parseData.success == false) {
                $('#spinner_template_for_query_answer_' + tempCnt).hide();
                $('#document_container_for_query_answer_' + tempCnt).show();
                $('#document_name_container_for_query_answer_' + tempCnt).hide();
                $('#' + id).val('');
                showError(parseData.message);
                return false;
            }
            $('#spinner_template_for_query_answer_' + tempCnt).hide();
            $('#document_name_container_for_query_answer_' + tempCnt).hide();
            $('#' + id).val('');
            $('#query_id_for_query_answer').val(parseData.query_id);
            $('#query_document_id_for_query_answer_' + tempCnt).val(parseData.query_document_id);
            var docItemData = {};
            docItemData.query_document_id = parseData.query_document_id;
            docItemData.query_id = parseData.query_id;
            docItemData.document = parseData.document_name;
            loadQueryDocument('document', tempCnt, docItemData);
        }
    });
}

function loadQueryDocument(documentFieldName, cnt, docItemData) {
    $('#' + documentFieldName + '_container_for_query_answer_' + cnt).hide();
    $('#' + documentFieldName + '_name_container_for_query_answer_' + cnt).show();
    $('#' + documentFieldName + '_name_href_for_query_answer_' + cnt).attr('href', 'documents/query/' + docItemData[documentFieldName]);
    $('#' + documentFieldName + '_name_for_query_answer_' + cnt).html(docItemData[documentFieldName]);
    $('#' + documentFieldName + '_remove_btn_for_query_answer_' + cnt).attr('onclick', 'askForRemoveQueryAnswerDoc("' + docItemData.query_document_id + '","' + cnt + '")');
}

function askForRemoveQueryAnswerDoc(queryDocumentId, cnt) {
    if (!queryDocumentId || !cnt) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var yesEvent = 'removeQueryAnswerDoc(' + queryDocumentId + ', ' + cnt + ')';
    showConfirmation(yesEvent, 'Remove');
}

function removeQueryAnswerDoc(queryDocumentId, cnt) {
    if (!queryDocumentId || !cnt) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    $.ajax({
        type: 'POST',
        url: 'utility/remove_query_document',
        data: $.extend({}, {'query_document_id': queryDocumentId}, getTokenData()),
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
            showError(textStatus.statusText);
        },
        success: function (response) {
            var parseData = JSON.parse(response);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                showError(parseData.message);
                return false;
            }
            $('.stack-bar-bottom').hide();
            showSuccess(parseData.message);
            removeDocument('document', 'query_answer_' + cnt);
        }
    });
}

function askForRemoveDocumentRow(cnt) {
    var queryDocumentId = $('#query_document_id_for_query_answer_' + cnt).val();
    if (!queryDocumentId || queryDocumentId == 0 || queryDocumentId == null) {
        removeDocumentItemRow(cnt);
        return false;
    }
    var yesEvent = 'removeDocumentRow(' + cnt + ')';
    showConfirmation(yesEvent, 'Remove');
}

function removeDocumentItemRow(cnt) {
    $('#query_answer_document_row_' + cnt).remove();
    resetCounter('query-answer-document-cnt');
}

function removeDocumentRow(cnt) {
    var queryDocumentId = $('#query_document_id_for_query_answer_' + cnt).val();
    if (!queryDocumentId || queryDocumentId == 0 || queryDocumentId == null) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    $.ajax({
        type: 'POST',
        url: 'utility/remove_query_document_item',
        data: $.extend({}, {'query_document_id': queryDocumentId}, getTokenData()),
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
            showError(textStatus.statusText);
        },
        success: function (response) {
            var parseData = JSON.parse(response);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                showError(parseData.message);
                return false;
            }
            showSuccess(parseData.message);
            removeDocumentItemRow(cnt);
        }
    });
}

function getTotal(btnObj) {

    var a = $('#contribution').val() == "" ? 0 : $('#contribution').val();
    var b = $('#term_loan').val() == "" ? 0 : $('#term_loan').val();
    var c = $('#unsecured_loan').val() == "" ? 0 : $('#unsecured_loan').val();
    var d = $('#accruals').val() == "" ? 0 : $('#accruals').val();

    var res = parseFloat(a) + parseFloat(b) + parseFloat(c) + parseFloat(d);
    $('#finance_total').val(res);
}

function getTotalInvestment(btnObj) {

    var a = $('#capital_subsidy').val() == "" ? 0 : $('#capital_subsidy').val();
    var b = $('#anum').val() == "" ? 0 : $('#anum').val();

    var res = parseFloat(a) + parseFloat(b);
    $('#cliam_amount_total').val(res);
}

function getTotalCliam(btnObj) {

    var a = $('#capital_cost').val() == "" ? 0 : $('#capital_cost').val();
    var b = $('#consutancy_fees').val() == "" ? 0 : $('#consutancy_fees').val();
    var c = $('#certification_charges').val() == "" ? 0 : $('#certification_charges').val();
    var d = $('#testing_equipments').val() == "" ? 0 : $('#testing_equipments').val();

    var res = parseFloat(a) + parseFloat(b) + parseFloat(c) + parseFloat(d);
    $('#cliam_amount_total').val(res);
}

function getTotalCliamAmount(btnObj) {

    var a = $('#audit_fees').val() == "" ? 0 : $('#audit_fees').val();
    var b = $('#equipment_cost').val() == "" ? 0 : $('#equipment_cost').val();

    var res = parseFloat(a) + parseFloat(b);
    $('#cliam_amount_total').val(res);
}

function getTotalAcquisition(btnObj) {

    var a = $('#purchase').val() == "" ? 0 : $('#purchase').val();
    var b = $('#technology_fees').val() == "" ? 0 : $('#technology_fees').val();
    var c = $('#other_detail').val() == "" ? 0 : $('#other_detail').val();

    var res = parseFloat(a) + parseFloat(b) + parseFloat(c);
    $('#upgradation_total').val(res);
}

function customizedTableSearch(obj, tableId, className = 'accordion-item') {
    var value = obj.val().toLowerCase();
    $("#" + tableId + " ." + className).filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
}

function getCommonData() {
    $.ajax({
        url: 'utility/get_common_data',
        type: 'post',
        error: function (textStatus, errorThrown) {
            tempVillagesData = [];
            tempPlotData = [];
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
            var parseData = JSON.parse(response);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            if (parseData.success === false) {
                showError(parseData.message);
                return false;
            }
            tempVillagesData = parseData.village_data;
            tempPlotData = parseData.plot_data;
        }
    });
}

function getPlotData(obj, id, moduleName) {
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_for_' + moduleName, 'plot_id', 'plot_no', 'Plot No');
    $('#' + id + '_for_' + moduleName).val('');
    var villageCode = obj.val();
    if (!villageCode) {
        return;
    }
    var plotData = tempPlotData[villageCode] ? tempPlotData[villageCode] : [];
    // console.log(plotData);
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(plotData, id + '_for_' + moduleName, 'plot_id', 'plot_no', 'Plot No');
    $('#' + id + '_for_' + moduleName).val('');
    this.getAreaData('plot_id', 'area');
}

function getAreaData(obj) {
    var villageCode = $('#villages_for_noc_data').val();
    $('#govt_industrial_estate_area').val('');
    if (!villageCode) {
        return false;
    }
    var plotId = obj.val();
    if (!plotId) {
        return false;
    }
    var plotsData = tempPlotData[villageCode] ? tempPlotData[villageCode] : [];
    var plotData = plotsData[plotId] ? plotsData[plotId] : [];
    $('#govt_industrial_estate_area').val(plotData.area ? plotData.area : '');
}

function getTotalEmployee(btnObj) {

    var a = $('#direct_unskilled').val() == "" ? 0 : $('#direct_unskilled').val();
    var b = $('#direct_semiskilled').val() == "" ? 0 : $('#direct_semiskilled').val();
    var c = $('#direct_skilled').val() == "" ? 0 : $('#direct_skilled').val();

    var res = parseFloat(a) + parseFloat(b) + parseFloat(c);
    $('#direct_total').val(res);


    var d = $('#contractor_unskilled').val() == "" ? 0 : $('#contractor_unskilled').val();
    var e = $('#contractor_semiskilled').val() == "" ? 0 : $('#contractor_semiskilled').val();
    var f = $('#contractor_skilled').val() == "" ? 0 : $('#contractor_skilled').val();

    var res1 = parseFloat(d) + parseFloat(e) + parseFloat(f);
    $('#contractor_total').val(res1);

    var res2 = parseFloat(a) + parseFloat(d);
    $('#total_unskilled').val(res2);

    var res3 = parseFloat(b) + parseFloat(e);
    $('#total_semiskilled').val(res3);

    var res4 = parseFloat(c) + parseFloat(f);
    $('#total_skilled').val(res4);

    var res5 = parseFloat(res) + parseFloat(res1);
    $('#total_total').val(res5);


    var g = $('#direct_male').val() == "" ? 0 : $('#direct_male').val();
    var h = $('#contractor_male').val() == "" ? 0 : $('#contractor_male').val();

    var res6 = parseFloat(g) + parseFloat(h);
    $('#total_male').val(res6);

    var i = $('#direct_female').val() == "" ? 0 : $('#direct_female').val();
    var j = $('#contractor_female').val() == "" ? 0 : $('#contractor_female').val();

    var res7 = parseFloat(i) + parseFloat(j);
    $('#total_female').val(res7);

}

function getTotalWorker(id1, id2, id3) {
    var value1 = $('#' + id1).val();
    var value2 = $('#' + id2).val();
    var value3 = $('#' + id3);

    var a = value1 == "" ? 0 : value1;
    var b = value2 == "" ? 0 : value2;

    var res = parseFloat(a) + parseFloat(b);
    $(value3).val(res);
}

function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForPlot(dataArray, comboId, keyId, valueId, message) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="">Select ' + message + '</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            if (dataObject['is_vacant'] == VALUE_ONE) {
                data = {"value_field": dataObject[keyId], 'text_field': dataObject[valueId]};
                optionResult = optionTemplate(data);
                $("#" + comboId).append(optionResult);
            }
        }
    });
}

function checkValidationForDocument(documentId, documentCategory, errorMsgName, pdfSize = 1024, imageSize = 1024) {
    // VALUE_ONE for PDF | ZIP
    if (documentCategory == VALUE_ONE) {
        var documentName = $('#' + documentId).val();
        if (documentName == '') {
            $('#' + documentId).focus();
            validationMessageShow(errorMsgName + '-' + documentId, uploadDocumentValidationMessage);
            return false;
        }
        var documentNameMessage = pdffileUploadValidation(documentId, pdfSize);
        if (documentNameMessage != '') {
            $('#' + documentId).focus();
            validationMessageShow(errorMsgName + '-' + documentId, documentNameMessage);
            return false;
        }
    }
    // VALUE_TWO for IMAGE
    if (documentCategory == VALUE_TWO) {
        var documentName = $('#' + documentId).val();
        if (documentName == '') {
            $('#' + documentId).focus();
            validationMessageShow(errorMsgName + '-' + documentId, uploadDocumentValidationMessage);
            return false;
        }
        var documentNameMessage = imagefileUploadValidation(documentId, imageSize);
        if (documentNameMessage != '') {
            $('#' + documentId).focus();
            validationMessageShow(errorMsgName + '-' + documentId, documentNameMessage);
            return false;
        }
}
}

function removeDocumentValue(containerHideId, documentSrcPathId, containerShowId, documentId) {
    $('#' + containerHideId).hide();
    $('#' + documentSrcPathId).attr('src', '');
    $('#' + containerShowId).show();
    $('#' + documentId).val('');
}

function getTotalRowColunt(className) {
    var cnt = 1;
    $('.' + className).each(function () {
        cnt++;
    });
    return cnt;
}

function industryTypeChangeEvent(obj, module) {
    var type = obj.val();
    $('#remarks_for_' + module).val('');
    if (!type) {
        return false;
    }
    var remarks = INDUSTRY_TYPE_REMARK_ARRAY[type] ? INDUSTRY_TYPE_REMARK_ARRAY[type] : '';
    $('#remarks_for_' + module).val(remarks);
}

function printDiv()
{

    var divToPrint = document.getElementById('DivIdToPrint');

    var newWin = window.open('', 'Print-Window');

    newWin.document.open();

    newWin.document.write('<html><head> <link rel="stylesheet" type="text/css" href="assets/css/style.css" /></head><body  onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

    newWin.document.close();

    setTimeout(function () {
        newWin.close();
    }, 10);
}

function dashboardNaviationToModule(sDistrict, sStatus) {
    var sDisplayText = '';
    if (typeof sDistrict === "undefined") {
        sDistrict = '';
    } else {
        sDisplayText += (talukaArray[sDistrict] ? '<span class="badge bg-info app-status">' + talukaArray[sDistrict] + '</span>' : '');
    }
    if (typeof sStatus === "undefined") {
        sStatus = '';
    } else {
        var tempText = (sStatus == VALUE_TEN ? '<span class="badge bg-warning app-status">Queried</span>' : (appStatusArray[sStatus] ? appStatusArray[sStatus] : ''));
        sDisplayText += tempText != '' ? ' <b>></b> ' + tempText : '';
    }

    var returnData = {};
    returnData.s_display_text = sDisplayText;
    returnData.search_district = sDistrict;
    returnData.search_status = sStatus;
    return returnData;
}

function loadFB(moduleType, fbDetails) {
    var templateData = {};
    templateData.module_type = moduleType;
    $('#fb_container_for_' + moduleType).html(fbListTemplate(templateData));
    var tempCnt = 1;
    var totalFee = 0;
    $.each(fbDetails, function (index, fbd) {
        fbd.module_type = moduleType;
        fbd.fb_cnt = tempCnt;
        $('#fb_item_container_for_' + moduleType).append(fbItemTemplate(fbd));
        var fees = parseInt(fbd.fee);
        totalFee += fees ? fees : 0;
        tempCnt++;
    });
    $('#total_fees_for_fb_' + moduleType).html(totalFee + ' /-');
    if (tempCnt != 1) {
        $('#fb_container_for_' + moduleType).show();
    }
}

function submitPG(pgData) {
    $('#temp_op_enct').val(pgData.op_enct);
    $('#temp_op_mt').val(pgData.op_mt);
    $('#temp_op_mmptd').val(pgData.op_mmptd);
    $('#qwertyuioplkjhfgazcxzc').submit();
    $('.null-pdjshdjs').val('');
}

function openFullPageOverlay() {
    document.getElementById("full_page_overlay_div").style.width = "100%";
}

function closeFullPageOverlay() {
    document.getElementById("full_page_overlay_div").style.width = "0%";
}

function loadPH(moduleType, moduleId, phDetails) {
    var templateData = {};
    templateData.module_type = moduleType;
    templateData.application_number = regNoRenderer(moduleType, moduleId);
    $('#ph_container_for_' + moduleType).html(phListTemplate(templateData));
    var tempCnt = 1;
    $.each(phDetails, function (index, phd) {
        phd.module_type = moduleType;
        phd.ph_cnt = tempCnt;
        phd.transaction_datetime = phd.op_transaction_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(phd.op_transaction_datetime) : (phd.op_start_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(phd.op_start_datetime) : '');
        phd.status_text = getPGStatus(phd.op_status, phd.fees_payment_id);
        if (phd.op_status == VALUE_FOUR || phd.op_status == VALUE_FIVE || phd.op_status == VALUE_SIX) {
            phd.show_update_payment_status_btn = true;
        }
        $('#ph_item_container_for_' + moduleType).append(phItemTemplate(phd));
        tempCnt++;
    });
    if (tempCnt == 1) {
        $('#ph_container_for_' + moduleType).html('');
        return false;
    }
    $('.swal2-popup').css('width', '55em');
    $('#ph_container_for_' + moduleType).show();
}

var pgStatusRenderer = function (data, type, full, meta) {
    return getPGStatus(data, full.fees_payment_id);
};

function getPGStatus(data, feePaymentId) {
    return '<div class="pg_status_' + feePaymentId + '">' + (pgStatusTextArray[data] ? pgStatusTextArray[data] : pgStatusTextArray[VALUE_ZERO]) + '</div>';
}

function checkValidationForPAN(moduleName, id, isBlankValidation) {
    if (typeof isBlankValidation == "undefined") {
        isBlankValidation = false;
    }
    validationMessageHide(moduleName + '-' + id);
    var panNumber = $('#' + id).val();
    if (!panNumber) {
        if (isBlankValidation) {
            validationMessageShow(moduleName + '-' + id, panCardValidationMessage);
        }
        return false;
    }
    var validate = PANValidation(panNumber);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
}

function PANValidation(panNumber) {
    var filter = /[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$/;
    if (!filter.test(panNumber)) {
        return invalidPANValidationMessage;
    }
    return '';
}

function aadharNumberValidation(moduleName, id, isBlankValidation) {
    if (typeof isBlankValidation == "undefined") {
        isBlankValidation = false;
    }
    validationMessageHide(moduleName + '-' + id);
    var aadharNumber = $('#' + id).val();
    if (!aadharNumber) {
        if (isBlankValidation) {
            validationMessageShow(moduleName + '-' + id, aadharnoValidationMessage);
        }
        return;
    }
    var validate = checkUID(aadharNumber);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
}

function checkUID(uid) {
    if (uid.length != 12) {
        return invalidAadharNumberValidationMessage;
    }
    var Verhoeff = {
        "d": [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]],
        "p": [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]],
        "j": [0, 4, 3, 2, 1, 5, 6, 7, 8, 9],
        "check": function (str) {
            var c = 0;
            str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {
                c = Verhoeff.d[c][Verhoeff.p[i % 8][parseInt(u, 10)]];
            });
            return c;

        },
        "get": function (str) {

            var c = 0;
            str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {
                c = Verhoeff.d[c][Verhoeff.p[(i + 1) % 8][parseInt(u, 10)]];
            });
            return Verhoeff.j[c];
        }
    };

    String.prototype.verhoeffCheck = (function () {
        var d = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]];
        var p = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]];

        return function () {
            var c = 0;
            this.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {
                c = d[c][p[i % 8][parseInt(u, 10)]];
            });
            return (c === 0);
        };
    })();

    if (Verhoeff['check'](uid) === 0) {
        return '';
    } else {
        return invalidAadharNumberValidationMessage;
    }
}

function checkPaymentDV(btnObj, feesPaymentId, mType) {
    if (!feesPaymentId || !btnObj || (mType != VALUE_ONE)) {
        showError(invalidAccessValidationMessage);
        return;
    }
    if (mType == VALUE_ONE) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
    }

    $('.success-message-ph').html('');
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        url: 'payment_status/check_payment_dv',
        type: 'post',
        data: $.extend({}, {'fees_payment_id': feesPaymentId, 'm_type': mType}, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
            if (!textStatus.statusText) {
                loginPage();
                return false;
            }
            btnObj.html(ogBtnHTML);
            btnObj.attr('onclick', ogBtnOnclick);
            showError(textStatus.statusText);
        },
        success: function (response) {
            btnObj.remove();
            var parseData = JSON.parse(response);
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                showError(parseData.message);
                return false;
            }
            $('.success-message-ph').html(parseData.message);
            if (parseData.is_updated_fp) {
                $('.pg_status_' + feesPaymentId).html(pgStatusTextArray[parseData.updated_op_status] ? pgStatusTextArray[parseData.updated_op_status] : '');
                if (parseData.updated_status == VALUE_FOUR) {
                    $('#status_' + parseData.module_id).html(appStatusArray[parseData.updated_status] ? appStatusArray[parseData.updated_status] : appStatusArray[VALUE_ZERO]);
                }
            }
        }
    });
}

function getCheckboxValue(columValue, arrayValue) {
    var tempstring = [];
    var str = columValue;
    if (columValue) {
        var splitComma = str.split(',');
        $.each(splitComma, function (index, value) {
            if (index != VALUE_ZERO) {
                tempstring += ', ';
            }
            tempstring += arrayValue[value] ? arrayValue[value] : '';
        });
        return tempstring;
    }
}

function loadMRefDoc(moduleType) {
    var templateData = {};
    templateData.no_record_fount_for_doc = noRecordFoundTemplate({'colspan': 3, 'message': 'Document Not Available !'});
    templateData.module_type = moduleType;
    $('#m_ref_doc_container_for_' + moduleType).html(mRefDocListTemplate(templateData));

    var refDoc = moduleRefDocArray[moduleType] ? moduleRefDocArray[moduleType] : [];
    $.each(refDoc, function (index, rdData) {
        if (index == 0) {
            $('#doc_format_item_container_for_' + moduleType).html('');
        }
        rdData.doc_cnt = (index + 1);
        $('#doc_format_item_container_for_' + moduleType).append(mRefDocItemTemplate(rdData));
    });
}

function loadMDoc(moduleType, docDetails, isView) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (typeof docDetails == "undefined") {
        docDetails = '';
    }
    if (typeof isView == "undefined") {
        isView = '';
    }
    var templateData = {};
    templateData.no_record_fount_for_doc = noRecordFoundTemplate({'colspan': 3, 'message': 'Document Not Available !'});
    templateData.module_type = moduleType;
    if (isView) {
        templateData.is_view = isView;
    }
    $('#m_doc_container_for_' + moduleType + isView).html(mDocListTemplate(templateData));

    var sDoc = moduleDocArray[moduleType] ? moduleDocArray[moduleType] : [];
    var dCnt = 1;
    $.each(sDoc, function (docId, dd) {
        if (dCnt == 1) {
            $('#doc_item_container_for_' + moduleType + isView).html('');
        }
        var sdData = {};
        sdData.doc_cnt = dCnt;
        sdData.module_type = moduleType;
        sdData.doc_id = docId;
        sdData.doc_name = dd.name;
        if (dd.is_require == VALUE_ONE) {
            sdData.is_require = dd.is_require;
        }
        sdData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        if (isView) {
            $('#doc_item_container_for_' + moduleType + isView).append(mDocItemViewTemplate(sdData));
        } else {
            $('#doc_item_container_for_' + moduleType).append(mDocItemTemplate(sdData));
        }
        if (docDetails != '') {
            var exDoc = docDetails[docId] ? docDetails[docId] : '';
            if (exDoc != '') {
                if (isView) {
                    loadExMDocForView(moduleType, docId, exDoc);
                } else {
                    loadExMDoc(moduleType, docId, exDoc);
                }
            }
        }
        dCnt++;
    });
}

function uploadMDocument(moduleType, docId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleType || !docId) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var moduleId = $('#module_id_for_' + moduleType).val();
    if ($('#upload_for_' + moduleType + '_' + docId).val() != '') {
        var uploadIPSDoc = checkValidationForDocument('upload_for_' + moduleType + '_' + docId, VALUE_ONE, moduleType, 2048);
        if (uploadIPSDoc == false) {
            $('#upload_for_' + moduleType + '_' + docId).val('');
            return false;
        }
    }
    openFullPageOverlay();
    $('#upload_container_for_' + moduleType + '_' + docId).hide();
    $('#upload_name_container_for_' + moduleType + '_' + docId).hide();
    $('#spinner_template_' + docId).show();
    var formData = new FormData();
    formData.append('doc_id', docId);
    formData.append('module_id', moduleId);
    formData.append('module_type', moduleType);
    formData.append('document_file', $('#upload_for_' + moduleType + '_' + docId)[0].files[0]);
    $.ajax({
        type: 'POST',
        url: 'utility/upload_module_document',
        data: formData,
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        error: function (textStatus, errorThrown) {
            closeFullPageOverlay();
            if (textStatus.status === 403) {
                loginPage();
                return false;
            }
            if (!textStatus.statusText) {
                loginPage();
                return false;
            }
            $('#upload_name_container_for_' + moduleType + '_' + docId).hide();
            $('#spinner_template_' + docId).hide();
            $('#upload_container_for_' + moduleType + '_' + docId).show();
            showError(textStatus.statusText);
        },
        success: function (data) {
            closeFullPageOverlay();
            var parseData = JSON.parse(data);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            if (parseData.success == false) {
                $('#upload_name_container_for_' + moduleType + '_' + docId).hide();
                $('#spinner_template_' + docId).hide();
                $('#upload_container_for_' + moduleType + '_' + docId).show();
                showError(parseData.message);
                return false;
            }
            var docData = parseData.doc_data;
            $('.module_id_for_' + moduleType).val(docData.module_id);
            loadExMDoc(moduleType, docId, docData);
        }
    });
}

function loadExMDoc(moduleType, docId, docData) {
    $('#upload_for_' + moduleType + '_' + docId).val('');
    $('#upload_name_href_for_' + moduleType + '_' + docId).attr('href', docData.doc_path + '/' + docData.doc_name);
    $('#remove_document_btn_for_' + moduleType + '_' + docId).attr('onclick', 'askForRemoveMDocument(' + moduleType + ',' + docData.module_id + ',' + docId + ')');
    $('#upload_container_for_' + moduleType + '_' + docId).hide();
    $('#upload_name_container_for_' + moduleType + '_' + docId).show();
    $('#spinner_template_' + docId).hide();
}

function loadExMDocForView(moduleType, docId, docData) {
    $('#upload_name_href_for_' + moduleType + '_' + docId).attr('href', docData.doc_path + '/' + docData.doc_name);
    $('#upload_container_for_' + moduleType + '_' + docId).hide();
    $('#upload_name_container_for_' + moduleType + '_' + docId).show();
}

function removeMDoc(moduleType, docId) {
    $('#upload_for_' + moduleType + '_' + docId).val('');
    $('#upload_name_href_for_' + moduleType + '_' + docId).attr('href', '');
    $('#remove_document_btn_for_' + moduleType + '_' + docId).attr('onclick', '');
    $('#upload_name_container_for_' + moduleType + '_' + docId).hide();
    $('#upload_container_for_' + moduleType + '_' + docId).show();
    $('#spinner_template_' + docId).hide();
}

function askForRemoveMDocument(moduleType, moduleId, docId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    validationMessageHide();
    if (!moduleType || !moduleId) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var yesEvent = 'removeMDocument(\'' + moduleType + '\',\'' + moduleId + '\',\'' + docId + '\')';
    showConfirmation(yesEvent, 'Remove');
}

function removeMDocument(moduleType, moduleId, docId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    validationMessageHide();
    if (!moduleType || !moduleId) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    openFullPageOverlay();
    $('#upload_container_for_' + moduleType + '_' + docId).hide();
    $('#upload_name_container_for_' + moduleType + '_' + docId).hide();
    $('#spinner_template_' + docId).show();
    $.ajax({
        type: 'POST',
        url: 'utility/remove_module_document',
        data: $.extend({}, {'module_type': moduleType, 'module_id': moduleId, 'doc_id': docId}, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
            closeFullPageOverlay();
            if (textStatus.status === 403) {
                loginPage();
                return false;
            }
            if (!textStatus.statusText) {
                loginPage();
                return false;
            }
            $('#upload_container_for_' + moduleType + '_' + docId).hide();
            $('#upload_name_container_for_' + moduleType + '_' + docId).show();
            $('#spinner_template_' + docId).hide();
            showError(textStatus.statusText);
        },
        success: function (response) {
            closeFullPageOverlay();
            var parseData = JSON.parse(response);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                $('#upload_container_for_' + moduleType + '_' + docId).hide();
                $('#upload_name_container_for_' + moduleType + '_' + docId).show();
                $('#spinner_template_' + docId).hide();
                showError(parseData.message);
                return false;
            }
            showSuccess(parseData.message);
            removeMDoc(moduleType, docId)
        }
    });
}

function checkValidationForMDoc(mType) {
    var sDoc = moduleDocArray[mType] ? moduleDocArray[mType] : [];
    var isDocValidation = false;
    $.each(sDoc, function (docId, dd) {
        if ($('#upload_container_for_' + mType + '_' + docId).is(':visible') && dd.is_require == VALUE_ONE) {
            var uploadOne = $('#upload_for_' + mType + '_' + docId).val();
            if (uploadOne == '' || !uploadOne) {
                $('#upload_for_' + mType + '_' + docId).focus();
                validationMessageShow(mType + '-upload_for_' + mType + '_' + docId, uploadDocumentValidationMessage);
                isDocValidation = true;
                return false;

            }
        }
    });
    return isDocValidation;
}

function loadMOtherDoc(moduleType, docDetails, isView) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (typeof docDetails == "undefined") {
        docDetails = '';
    }
    if (typeof isView == "undefined") {
        isView = '';
    }
    mOtherDocRowCnt = 1;
    var templateData = {};
    templateData.module_type = moduleType;
    if (isView) {
        templateData.is_view = isView;
    } else {
        templateData.is_edit = true;
    }
    $('#m_other_doc_container_for_' + moduleType + isView).html(mOtherDocListTemplate(templateData));
    if (docDetails != '') {
        $.each(docDetails, function (index, docData) {
            addMOtherDocumentRow(moduleType, docData, isView);
        });
    }
}

function addMOtherDocumentRow(moduleType, docData, isView) {
    if (typeof isView == "undefined") {
        isView = '';
    }
    docData.cnt = mOtherDocRowCnt;
    docData.module_type = moduleType;
    docData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
    if (isView) {
        $('#other_doc_item_container_for_' + moduleType + isView).append(mOtherDocItemViewTemplate(docData));
        if (docData.other_doc) {
            loadMOtherDocumentForView(moduleType, mOtherDocRowCnt, docData);
        }
    } else {
        $('#other_doc_item_container_for_' + moduleType).append(mOtherDocItemTemplate(docData));
        if (docData.other_doc) {
            loadMOtherDocument(moduleType, mOtherDocRowCnt, docData);
        }
    }
    resetCounter('other-doc-display-cnt-for-' + moduleType);
    mOtherDocRowCnt++;
}

function uploadMOtherDocument(moduleType, cnt) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleType || !cnt) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var moduleId = $('#module_id_for_' + moduleType).val();
    var modId = $('#module_other_documents_id_for_' + moduleType + '_' + cnt).val();
    if ($('#other_upload_for_' + moduleType + '_' + cnt).val() != '') {
        var uploadIPSDoc = checkValidationForDocument('other_upload_for_' + moduleType + '_' + cnt, VALUE_ONE, moduleType, 2048);
        if (uploadIPSDoc == false) {
            $('#other_upload_for_' + moduleType + '_' + cnt).val('');
            return false;
        }
    }
    openFullPageOverlay();
    $('#other_upload_container_for_' + moduleType + '_' + cnt).hide();
    $('#other_upload_name_container_for_' + moduleType + '_' + cnt).hide();
    $('#other_spinner_template_' + cnt).show();
    var formData = new FormData();
    formData.append('mod_id', modId);
    formData.append('module_id', moduleId);
    formData.append('module_type', moduleType);
    formData.append('document_file', $('#other_upload_for_' + moduleType + '_' + cnt)[0].files[0]);
    $.ajax({
        type: 'POST',
        url: 'utility/upload_module_other_document',
        data: formData,
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        error: function (textStatus, errorThrown) {
            closeFullPageOverlay();
            if (textStatus.status === 403) {
                loginPage();
                return false;
            }
            if (!textStatus.statusText) {
                loginPage();
                return false;
            }
            $('#other_upload_name_container_for_' + moduleType + '_' + cnt).hide();
            $('#other_spinner_template_' + cnt).hide();
            $('#other_upload_container_for_' + moduleType + '_' + cnt).show();
            showError(textStatus.statusText);
        },
        success: function (data) {
            closeFullPageOverlay();
            var parseData = JSON.parse(data);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            if (parseData.success == false) {
                $('#other_upload_name_container_for_' + moduleType + '_' + cnt).hide();
                $('#other_spinner_template_' + cnt).hide();
                $('#other_upload_container_for_' + moduleType + '_' + cnt).show();
                showError(parseData.message);
                return false;
            }
            var docData = parseData.doc_data;
            $('.module_id_for_' + moduleType).val(docData.module_id);
            $('#module_other_documents_id_for_' + moduleType + '_' + cnt).val(docData.module_other_documents_id);
            loadMOtherDocument(moduleType, cnt, docData);
        }
    });
}

function loadMOtherDocument(moduleType, cnt, docData) {
    $('#other_upload_for_' + moduleType + '_' + cnt).val('');
    $('#other_upload_name_href_for_' + moduleType + '_' + cnt).attr('href', docData.other_doc_path + '/' + docData.other_doc);
    $('#other_remove_document_btn_for_' + moduleType + '_' + cnt).attr('onclick', 'askForRemoveMOtherDocument(' + moduleType + ',' + docData.module_id + ',' + cnt + ')');
    $('#other_upload_container_for_' + moduleType + '_' + cnt).hide();
    $('#other_upload_name_container_for_' + moduleType + '_' + cnt).show();
    $('#other_spinner_template_' + cnt).hide();
}

function loadMOtherDocumentForView(moduleType, cnt, docData) {
    $('#other_upload_name_href_for_' + moduleType + '_' + cnt).attr('href', docData.other_doc_path + '/' + docData.other_doc);
    $('#other_upload_container_for_' + moduleType + '_' + cnt).hide();
    $('#other_upload_name_container_for_' + moduleType + '_' + cnt).show();
}

function askForRemoveMOtherDocument(moduleType, moduleId, cnt) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    var modId = $('#module_other_documents_id_for_' + moduleType + '_' + cnt).val();
    if (!moduleType || moduleType == null || !moduleId || moduleId == null || !cnt || cnt == 0 || !modId || modId == null) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var yesEvent = 'removeMOtherDoc(' + moduleType + ',' + moduleId + ',' + cnt + ',' + modId + ')';
    showConfirmation(yesEvent, 'Remove');
}

function removeMOtherDoc(moduleType, moduleId, cnt, modId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleType || moduleType == null || !moduleId || moduleId == null || !cnt || cnt == 0 || !modId || modId == null) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    validationMessageHide();
    openFullPageOverlay();
    $('#other_upload_container_for_' + moduleType + '_' + cnt).hide();
    $('#other_upload_name_container_for_' + moduleType + '_' + cnt).hide();
    $('#other_spinner_template_' + cnt).show();
    $.ajax({
        type: 'POST',
        url: 'utility/remove_module_other_document',
        data: $.extend({}, {'module_type': moduleType, 'module_id': moduleId, 'mod_id': modId}, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
            closeFullPageOverlay();
            if (textStatus.status === 403) {
                loginPage();
                return false;
            }
            if (!textStatus.statusText) {
                loginPage();
                return false;
            }
            $('#other_upload_container_for_' + moduleType + '_' + cnt).hide();
            $('#other_upload_name_container_for_' + moduleType + '_' + cnt).show();
            $('#other_spinner_template_' + cnt).hide();
            showError(textStatus.statusText);
        },
        success: function (response) {
            closeFullPageOverlay();
            var parseData = JSON.parse(response);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                $('#other_upload_container_for_' + moduleType + '_' + cnt).hide();
                $('#other_upload_name_container_for_' + moduleType + '_' + cnt).show();
                $('#other_spinner_template_' + cnt).hide();
                showError(parseData.message);
                return false;
            }
            showSuccess(parseData.message);
            removeMOtherDocument(moduleType, cnt);
        }
    });
}

function removeMOtherDocument(moduleType, cnt) {
    $('#other_upload_for_' + moduleType + '_' + cnt).val('');
    $('#other_upload_name_href_for_' + moduleType + '_' + cnt).attr('href', '');
    $('#other_remove_document_btn_for_' + moduleType + '_' + cnt).attr('onclick', '');
    $('#other_upload_name_container_for_' + moduleType + '_' + cnt).hide();
    $('#other_upload_container_for_' + moduleType + '_' + cnt).show();
    $('#other_spinner_template_' + cnt).hide();
}

function askForRemoveMOtherDocumentRow(moduleType, cnt) {
    var that = this;
    var modId = $('#module_other_documents_id_for_' + moduleType + '_' + cnt).val();
    if (!modId || modId == 0 || modId == null) {
        that.removeMOtherDocumentRow(moduleType, cnt);
        return false;
    }
    var moduleId = $('#module_id_for_' + moduleType).val();
    if (!moduleId || moduleId == null) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var yesEvent = 'removeMOtherDocumentItemRow(' + moduleType + ',' + moduleId + ',' + cnt + ',' + modId + ')';
    showConfirmation(yesEvent, 'Remove');
}

function removeMOtherDocumentRow(moduleType, cnt) {
    $('#m_other_doc_item_' + moduleType + '_' + cnt).remove();
    resetCounter('other-doc-display-cnt-for-' + moduleType);
}

function removeMOtherDocumentItemRow(moduleType, moduleId, cnt, modId) {
    if (!moduleType || moduleType == null || !moduleId || moduleId == null || !cnt || cnt == 0 || !modId || modId == null) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    openFullPageOverlay();
    var btnObj = $('#remove_other_doc_btn_for_' + moduleType + '_' + cnt);
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    var that = this;
    $.ajax({
        type: 'POST',
        url: 'utility/remove_module_other_document_item',
        data: $.extend({}, {'module_type': moduleType, 'module_id': moduleId, 'mod_id': modId}, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
            closeFullPageOverlay();
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
            closeFullPageOverlay();
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
                return false;
            }
            that.removeMOtherDocumentRow(moduleType, cnt);
            showSuccess(parseData.message);
        }
    });
}

function checkValidationForMOtherDoc(moduleType, mType) {
    var mODCnt = 1;
    var newMODItems = [];
    var exiMODItems = [];
    var isMODItemValidation;
    $('.other-doc-for-' + mType).each(function () {
        var that = $(this);
        var tCnt = that.find('.og_other_doc_cnt_for_' + mType).val();
        if (tCnt == '' || tCnt == null) {
            showError(invalidAccessValidationMessage);
            isMODItemValidation = true;
            return false;
        }
        var qdItem = {};
        var otherDocName = $('#other_doc_name_for_' + mType + '_' + tCnt).val();
        if (moduleType != VALUE_ONE) {
            if (otherDocName == '' || otherDocName == null) {
                $('#other_doc_name_for_' + mType + '_' + tCnt).focus();
                validationMessageShow(mType + '-other_doc_name_for_' + mType + '_' + tCnt, documentNameValidationMessage);
                isMODItemValidation = true;
                return false;
            }
        }
        qdItem.other_doc_name = otherDocName;
        if (moduleType != VALUE_ONE) {
            if ($('#other_upload_container_for_' + mType + '_' + tCnt).is(':visible')) {
                var uploadDoc = $('#other_upload_for_' + mType + '_' + tCnt).val();
                if (!uploadDoc) {
                    validationMessageShow(mType + '-other_upload_for_' + mType + '_' + tCnt, uploadDocValidationMessage);
                    isMODItemValidation = true;
                    return false;
                }
                var uploadDocMessage = pdffileUploadValidation('other_upload_for_' + mType + '_' + tCnt, 2048);
                if (uploadDocMessage != '') {
                    validationMessageShow(mType + '-other_upload_for_' + mType + '_' + tCnt, uploadDocMessage);
                    isMODItemValidation = true;
                    return false;
                }
            }
        }
        var modId = $('#module_other_documents_id_for_' + mType + '_' + tCnt).val();
        if (!modId || modId == null) {
            newMODItems.push(qdItem);
        } else {
            qdItem.module_other_documents_id = modId;
            exiMODItems.push(qdItem);
        }
        mODCnt++;
    });
    if (isMODItemValidation) {
        return false;
    }
    var returnData = {};
    returnData.new_mod_items = newMODItems;
    returnData.exi_mod_items = exiMODItems;
    return returnData;
}

function loadMap(mapId, latClass, lngClass, mapData, allowOnClick) {
    if (typeof allowOnClick === "undefined") {
        allowOnClick = false;
    }
    var map = L.map(mapId).setView([mapData.lat, mapData.lng], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; NIC Daman'
    }).addTo(map);
    var popup = L.popup();
    if (allowOnClick) {
        popup.setLatLng(mapData)
                .setContent('Selected LatLng(' + mapData.lat + ',' + mapData.lng + ')')
                .openOn(map);
        map.on('click', onMapClick);
        function onMapClick(e) {
            popup
                    .setLatLng(e.latlng)
                    .setContent("Selected " + e.latlng.toString())
                    .openOn(map);

            $('.' + latClass).val((e['latlng'].lat).toFixed(6));
            $('.' + lngClass).val((e['latlng'].lng).toFixed(6));
        }
    } else {
        var marker = L.marker([mapData.lat, mapData.lng]).addTo(map);
        marker.bindPopup('Selected LatLng(' + mapData.lat + ',' + mapData.lng + ')').openPopup();
    }
}
function isJSON(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function askForFeedbackRating(btnObj, moduleType, moduleId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleType || moduleType == null || moduleType == VALUE_ZERO || !moduleId || moduleId == null || moduleId == VALUE_ZERO) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/get_basic_details_for_feedback_rating',
        data: $.extend({}, {'module_type': moduleType, 'module_id': moduleId}, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
            closeFullPageOverlay();
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
            closeFullPageOverlay();
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
                return false;
            }
            var frData = parseData.fr_data;
            frData.module_type = moduleType;
            frData.application_number = regNoRenderer(moduleType, frData.module_id);
            if (frData.rating == VALUE_ZERO) {
                frData.show_submit_btn = true;
            }
            showPopup();
            $('.swal2-popup').css('width', '30em');
            $('#popup_container').html(feedbackRatingTemplate(frData));
            generateBoxes('radio', ratingArray, 'rating', 'fr', frData.rating);
        }
    });
}

function  checkValidationForFeedbackRating(frData) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!frData.rating_for_fr) {
        $('#rating_for_fr_1').focus();
        return getBasicMessageAndFieldJSONArray('rating_for_fr', oneOptionValidationMessage);
    }
    if (!frData.feedback_for_fr) {
        return getBasicMessageAndFieldJSONArray('feedback_for_fr', feedbackValidationMessage);
    }
    return '';
}

function submitFeedbackRating(btnObj) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    validationMessageHide();
    var frData = $('#fr_form').serializeFormJSON();
    if (!frData.module_type_for_fr || frData.module_type_for_fr == null || frData.module_type_for_fr == VALUE_ZERO ||
            !frData.module_id_for_fr || frData.module_id_for_fr == null || frData.module_id_for_fr == VALUE_ZERO) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var validationData = checkValidationForFeedbackRating(frData);
    if (validationData != '') {
        $('#' + validationData.field).focus();
        validationMessageShow('fr-' + validationData.field, validationData.message);
        return false;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/update_details_for_feedback_rating',
        data: $.extend({}, frData, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
            closeFullPageOverlay();
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
            closeFullPageOverlay();
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
                return false;
            }
            showSuccess(parseData.message);
            var returnFRData = parseData.fr_data;
            $('#fr_container_for_' + frData.module_type_for_fr + '_' + frData.module_id_for_fr).html(getFTDetails(returnFRData.rating, returnFRData.fr_datetime));
        }
    });
}

function getRating(rating) {
    if (rating == VALUE_ZERO) {
        return '';
    }
    var returnData = '';
    $.each(ratingArray, function (index, value) {
        returnData += '<span class="fa fa-star' + (rating >= value ? ' text-warning' : '') + '"></span>';
    });
    return returnData;
}

function getFRContainer(moduleType, moduleId, rating, frDateTime) {
    return '<div id="fr_container_for_' + moduleType + '_' + moduleId + '">' + getFTDetails(rating, frDateTime) + '</div>';
}

function getFTDetails(rating, frDateTime) {
    return '<div>' + getRating(rating) + '</div>';
//            + '<div>' + (frDateTime != "0000-00-00 00:00:00" ? dateTo_DD_MM_YYYY_HH_II_SS(frDateTime) : '') + '</div>'
}

function askForWithdrawApplication(btnObj, moduleType, moduleId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleType || moduleType == null || moduleType == VALUE_ZERO || !moduleId || moduleId == null || moduleId == VALUE_ZERO) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/get_basic_details_for_withdraw_application',
        data: $.extend({}, {'module_type': moduleType, 'module_id': moduleId}, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
            closeFullPageOverlay();
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
            closeFullPageOverlay();
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
                return false;
            }
            var waData = parseData.wa_data;
            waData.module_type = moduleType;
            waData.application_number = regNoRenderer(moduleType, waData.module_id);
            if (moduleType == VALUE_THIRTYTHREE) {
                waData.title = 'Name of the Establishment';
                waData.establishment_name = waData.s_name;
            } else if (moduleType == VALUE_FOURTYTWO) {
                waData.title = 'Name of the Establishment';
                waData.establishment_name = waData.name_of_shop;
            } else if (moduleType == VALUE_THIRTYONE) {
                waData.title = 'Name of the Establishment';
                waData.establishment_name = waData.establishment_name;
            } else if (moduleType == VALUE_THIRTYTWO) {
                waData.title = 'Name of the Establishment';
                waData.establishment_name = waData.name_location_of_est;
            } else if (moduleType == VALUE_THIRTYFOUR) {
                waData.title = 'Name of the Establishment';
                waData.establishment_name = waData.mw_name_of_establishment;
            } else if (moduleType == VALUE_FOURTYFIVE) {
                waData.title = 'Name of the Establishment';
                waData.establishment_name = waData.name_of_establishment;
            } else if (moduleType == VALUE_THIRTYNINE) {
                waData.title = 'Name of the Establishment';
                waData.establishment_name = waData.esta_name;
            } else if (moduleType == VALUE_FOURTYTHREE || moduleType == VALUE_FOURTYSIX) {
                waData.title = 'Name of the Establishment';
                waData.establishment_name = waData.establi_name;
            } else if (moduleType == VALUE_THIRTYFIVE || moduleType == VALUE_FOURTYONE) {
                waData.title = 'Name of the Factory';
                waData.establishment_name = waData.name_of_factory;
            } else if (moduleType == VALUE_THIRTYSIX) {
                waData.title = 'Name of the Factory';
                waData.establishment_name = waData.factory_name;
            } else if (moduleType == VALUE_THIRTYSEVEN || moduleType == VALUE_FOURTYFOUR) {
                waData.title = 'Owner Name';
                waData.establishment_name = waData.owner_name;
            } else if (moduleType == VALUE_THIRTYEIGHT) {
                waData.title = 'Name of the Firm';
                waData.establishment_name = waData.name_of_firm;
            } else if (moduleType == VALUE_FIVE || moduleType == VALUE_ONE || moduleType == VALUE_FOURTYEIGHT ||
                    moduleType == VALUE_FIFTY || moduleType == VALUE_EIGHT || moduleType == VALUE_FOURTY ||
                    moduleType == VALUE_TWENTYSEVEN || moduleType == VALUE_SIXTYONE || moduleType == VALUE_TWENTYFIVE) {
                waData.title = 'Name of the Applicant';
                waData.establishment_name = waData.name_of_applicant;
            } else if (moduleType == VALUE_TWO || moduleType == VALUE_FOURTEEN) {
                waData.title = 'Name of the Repairer';
                waData.establishment_name = waData.name_of_repairer;
            } else if (moduleType == VALUE_THREE || moduleType == VALUE_FIFTEEN) {
                waData.title = 'Name of the Dealer';
                waData.establishment_name = waData.name_of_dealer;
            } else if (moduleType == VALUE_FOUR || moduleType == VALUE_SIXTEEN) {
                waData.title = 'Name of the Manufacturer';
                waData.establishment_name = waData.name_of_manufacturer;
            } else if (moduleType == VALUE_FOURTYNINE) {
                waData.title = 'Name of the User';
                waData.establishment_name = waData.user_name;
            } else if (moduleType == VALUE_SIX || moduleType == VALUE_TWENTY) {
                waData.title = 'Name of the Hotel';
                waData.establishment_name = waData.name_of_hotel;
            } else if (moduleType == VALUE_NINETEEN || moduleType == VALUE_TWENTYTHREE) {
                waData.title = 'Name of the Travel Agency';
                waData.establishment_name = waData.name_of_travel_agency;
            } else if (moduleType == VALUE_TWENTYFOUR) {
                waData.title = 'Name of the Event';
                waData.establishment_name = waData.name_of_event;
            } else if (moduleType == VALUE_SEVEN) {
                waData.title = 'Name of the Firm';
                waData.establishment_name = waData.firm_name;
            } else if (moduleType == VALUE_TWENTYTWO) {
                waData.title = 'Name of the Production House';
                waData.establishment_name = waData.production_house;
            } else if (moduleType == VALUE_SIXTY || moduleType == VALUE_FIFTYNINE) {
                waData.title = 'Name of the Applicant';
                waData.establishment_name = waData.applicant_name;
            } else if (moduleType == VALUE_TEN || moduleType == VALUE_NINE) {
                waData.title = 'Name of the Enterprise';
                waData.establishment_name = waData.enterprise_name;
            } else if (moduleType == VALUE_TWENTYSIX) {
                waData.title = 'Name of the Owner';
                waData.establishment_name = waData.name_of_owner;
            } else if (moduleType == VALUE_TWENTYEIGHT) {
                waData.title = 'Survey Number';
                waData.establishment_name = waData.survey_no;
            } else if (moduleType == VALUE_FIFTYTWO) {
                waData.title = 'Manufacturing Unit / Service Unit Details';
                waData.establishment_name = waData.manu_name;
            } else if (moduleType == VALUE_TWENTYONE) {
                waData.title = 'Party Name';
                waData.establishment_name = waData.party_name;
            }
            showPopup();
            $('.swal2-popup').css('width', '30em');
            $('#popup_container').html(withdrawApplicationTemplate(waData));
        }
    });
}

function submitWithdrawApplication(btnObj) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    validationMessageHide();
    var waData = $('#withdraw_application_form').serializeFormJSON();
    if (!waData.module_type_for_withdraw_application || waData.module_type_for_withdraw_application == null || waData.module_type_for_withdraw_application == VALUE_ZERO ||
            !waData.module_id_for_withdraw_application || waData.module_id_for_withdraw_application == null || waData.module_id_for_withdraw_application == VALUE_ZERO) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    if (!waData.remarks_for_withdraw_application) {
        $('#remarks_for_withdraw_application').focus();
        validationMessageShow('withdraw-application-remarks_for_withdraw_application', remarksValidationMessage);
        return false;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/update_details_for_withdraw_application',
        data: $.extend({}, waData, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
            closeFullPageOverlay();
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
            closeFullPageOverlay();
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
                return false;
            }
            showSuccess(parseData.message);
            var wData = parseData.wa_data;
            $('#status_' + waData.module_id_for_withdraw_application).html(appStatusArray[VALUE_ELEVEN]);
            $('#edit_btn_' + waData.module_id_for_withdraw_application).remove();
            $('#withdraw_application_btn_' + waData.module_id_for_withdraw_application).remove();
            $('#query_status_' + waData.module_id_for_withdraw_application).html(queryStatusArray[wData['query_status']]);
        }
    });
}
