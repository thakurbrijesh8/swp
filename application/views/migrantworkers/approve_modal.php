<form role="form" method="post" id="approve_form_for_migrantworkers">
    <input type="hidden" name="mw_id" id="mw_id" class="form-control" value="{{mw_id}}">
    <div class="box-body">
        <div class="text-center m-t-10" style="margin-bottom: 20px;">
            <span id="error-message-migrantworkers" class="error-message error-message-migrantworkers f-w-b" style="border-bottom: 2px solid red;"></span>
            <span id="successful-message-migrantworkers" class="successful-message successful-message-migrantworkers f-w-b" style="border-bottom: 2px solid green;"></span>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label>Establishment Name</label>
                <input type="text" name="establishment_name" id="establishment_name" class="form-control" value="{{mw_name_of_establishment}}" readonly="">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Establishment Challan No. <span style="color: red;">*</span></label>
                <input type="text" name="challan_no_for_migrantworkers_registration" id="challan_no_for_migrantworkers_registration" class="form-control" value="{{mw_challan_no}}"
                       onblur="checkValidation('migrantworkers', 'challan_no_for_migrantworkers_registration', establishmentChallanNoValidationMessage);" placeholder="Enter Establishment Challan No.">
                <span class="error-message error-message-migrantworkers-challan_no_for_migrantworkers_registration"></span>
            </div>
            <div class="form-group col-sm-6">
                <label for="contract_start_date">Establishment Challan Date <span style="color: red;">*</span></label>
                <div class="input-group date date_picker">
                    <input type="text" name="challan_date_for_migrantworkers_registration" id="challan_date_for_migrantworkers_registration" class="form-control" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                           onblur="checkValidation('migrantworkers', 'challan_date_for_migrantworkers_registration', establishmentChallanDateValidationMessage);" value="{{mw_challan_date}}">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <span class="error-message error-message-migrantworkers-challan_date_for_migrantworkers_registration"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Establishment Registration No. <span style="color: red;">*</span></label>
                <input type="text" name="registration_no_for_migrantworkers_registration" id="registration_no_for_migrantworkers_registration" class="form-control" value="{{mw_registration_no}}"
                       onblur="checkValidation('migrantworkers', 'registration_no_for_migrantworkers_registration', establishmentRegistrationNoValidationMessage);" placeholder="Enter Establishment Registration No.">
                <span class="error-message error-message-migrantworkers-registration_no_for_migrantworkers_registration"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label for="contract_start_date">Establishment Valid up to <span style="color: red;">*</span></label>
                <div class="input-group date date_picker">
                    <input type="text" name="certificate_expiry_date_for_migrantworkers_registration" id="certificate_expiry_date_for_migrantworkers_registration" class="form-control" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                           onblur="checkValidation('migrantworkers', 'certificate_expiry_date_for_migrantworkers_registration', establishmentCerticateExpiryDateValidationMessage);" value="{{mw_certificate_expiry_date}}">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <span class="error-message error-message-migrantworkers-certificate_expiry_date_for_migrantworkers_registration"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label>Remark <span style="color: red;">*</span></label>
                <textarea class="form-control" name="remark_for_migrantworkers_registration" id="remark_for_migrantworkers_registration" placeholder="Enter Establishment Remark" rows="3" 
                          onblur="checkValidation('migrantworkers', 'remark_for_migrantworkers_registration', establishmentRemarkValidationMessage);">{{mw_remark}}</textarea>
                <span class="error-message error-message-migrantworkers-remark_for_migrantworkers_registration"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer"style="padding: 0px 15px 15px 0px;">
        <button type="button" class="btn btn-success"  style="border: 1px solid #3c8dbc;" onclick="MigrantWorkers.listview.labourDeptApproveForMigrantWorkers($(this), '{{mw_id}}')">Approve</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" ><i class="fas fa-times"></i>&nbsp; Close</button>
    </div>
</form>