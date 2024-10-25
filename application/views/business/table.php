<div class="card">
    <div class="card-header bg-nic-blue p-2">
        <h3 class="card-title f-w-b f-s-16px">Fetch Details From ZED | Zero Defect Zero Effect - MSME Portal</h3>
    </div>
    <div class="card-body border-nic-blue">
        <form role="form" id="zed_form" name="zed_form" onsubmit="return false;">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span class="error-message error-message-zed f-w-b" style="border-bottom: 2px solid red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label>Udyam Number <span class="color-nic-red">*</span></label>
                    <input type="text" id="udyam_number_for_zed" name="udyam_number_for_zed" class="form-control"
                           onblur="checkValidation('zed', 'udyam_number_for_zed', udyamNumberValidationMessage);"
                           placeholder="Enter Udyam Number !" maxlength="30" value="{{udyam_number}}">
                    <span class="error-message error-message-zed-udyam_number_for_zed"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label>Certificate Number <span class="color-nic-red">*</span></label>
                    <input type="text" id="certificate_number_for_zed" name="certificate_number_for_zed" class="form-control"
                           onblur="checkValidation('zed', 'certificate_number_for_zed', isoCertificateNoValidationMessage);"
                           placeholder="Enter Udyam Number !" maxlength="30" value="{{certificate_number}}">
                    <span class="error-message error-message-zed-certificate_number_for_zed"></span>
                </div>
                <div class="col-sm-12 col-md-6 cc-mt">
                    <input type="hidden" id="captcha_code_for_zed" name="captcha_code_for_zed"/>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-9 col-sm-8 col-md-9 text-center">
                                    <span class="btn-block btn-flat captcha-code" id="captcha_container_for_zed"></span>
                                </div>
                                <div class="col-3 col-sm-4 col-md-3">
                                    <button type="button" class="btn btn-info btn-sm" onclick="setCaptchaCode('zed');">
                                        <i class="fas fa-sync"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <input type="text" id="captcha_code_varification_for_zed" name="captcha_code_varification_for_zed" class="form-control mb-0" placeholder="Enter Answer of Calculation !" onkeypress='checkNumeric($(this));'
                                   maxlength="3" onblur="checkNumeric($(this));">
                            <span class="error-message error-message-zed-captcha_code_varification_for_zed"></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr class="mb-2">
        <div>
            <button type="button" id="save_btn_for_zed" class="btn btn-sm btn-success" 
                    onclick="Business.listview.fetchDetailsFromZED($(this));" 
                    style="margin-right: 5px;"><i class="fas fa-download"></i> &nbsp; Fetch Details From ZED</button>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="business_datatable" class="table table-bordered table-hover vat-top">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center" style="width: 30px;">No.</th>
                        <th class="text-center" style="min-width: 150px;">Udyam Number<hr>Certificate Number</th>
                        <th class="text-center" style="min-width: 250px;">Unit Details</th>
                        <th class="text-center" style="min-width: 135px;">Certification Details</th>
                        <th class="text-center" style="min-width: 230px;">Fee / Subsidy Details</th>
                        <th class="text-center" style="width: 90px;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>