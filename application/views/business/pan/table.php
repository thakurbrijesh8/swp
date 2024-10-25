<div class="card">
    <div class="card-header bg-nic-blue p-2">
        <h3 class="card-title f-w-b f-s-16px">Fetch Details From PAN Portal</h3>
    </div>
    <div class="card-body border-nic-blue">
        <form role="form" id="pan_form" name="pan_form" onsubmit="return false;">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span class="error-message error-message-pan f-w-b" style="border-bottom: 2px solid red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label>PAN Number <span class="color-nic-red">*</span></label>
                    <input type="text" id="pan_number_for_pan" name="pan_number_for_pan" class="form-control text-uppercase"
                           onblur="checkValidationForPAN('pan', 'pan_number_for_pan', true);"
                           placeholder="Enter PAN Number !" maxlength="10">
                    <span class="error-message error-message-pan-pan_number_for_pan"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label>Name <span class="color-nic-red">*</span></label>
                    <input type="text" id="name_for_pan" name="name_for_pan" class="form-control"
                           onblur="checkValidation('pan', 'name_for_pan', panNameValidationMessage);"
                           placeholder="Enter Name !" maxlength="100">
                    <span class="error-message error-message-pan-name_for_pan"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label>Father Name</label>
                    <input type="text" id="father_name_for_pan" name="father_name_for_pan" class="form-control"
                           placeholder="Enter Father Name !" maxlength="100">
                    <span class="error-message error-message-pan-father_name_for_pan"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label>Date of Birth <span class="color-nic-red">*</span></label>
                    <div class="input-group date">
                        <input type="text" name="dob_for_pan" id="dob_for_pan" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                               onblur="checkValidation('pan', 'dob_for_pan', dateValidationMessage);">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                    </div>
                    <span class="error-message error-message-pan-dob_for_pan"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <input type="hidden" id="captcha_code_for_pan" name="captcha_code_for_pan"/>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-9 col-sm-8 col-md-9 text-center">
                                    <span class="btn-block btn-flat captcha-code" id="captcha_container_for_pan"></span>
                                </div>
                                <div class="col-3 col-sm-4 col-md-3">
                                    <button type="button" class="btn btn-info btn-sm" onclick="setCaptchaCode('pan');">
                                        <i class="fas fa-sync"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <input type="text" id="captcha_code_varification_for_pan" name="captcha_code_varification_for_pan" class="form-control mb-0" placeholder="Enter Answer of Calculation !" onkeypress='checkNumeric($(this));'
                                   maxlength="3" onblur="checkNumeric($(this));">
                            <span class="error-message error-message-pan-captcha_code_varification_for_pan"></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr class="mt-2 mb-2">
        <div>
            <button type="button" id="fetch_btn_for_pan" class="btn btn-sm btn-success" 
                    onclick="Business.listview.fetchDetailsFromPAN($(this));" 
                    style="margin-right: 5px;"><i class="fas fa-download"></i> &nbsp; Fetch Details From PAN</button>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="pan_datatable" class="table table-bordered table-hover vat-top">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center" style="width: 30px;">No.</th>
                        <th class="text-center" style="min-width: 80px;">PAN Number</th>
                        <th class="text-center" style="min-width: 150px;">Name</th>
                        <th class="text-center" style="min-width: 150px;">Father Name</th>
                        <th class="text-center" style="min-width: 80px;">DOB</th>
                        <th class="text-center" style="width: 90px;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>