<form role="form" method="post" id="approve_form_for_shop">
    <input type="hidden" name="s_id" id="s_id" class="form-control" value="{{s_id}}">
    <div class="box-body">
        <div class="text-center m-t-10" style="margin-bottom: 20px;">
            <span id="error-message-shop" class="error-message error-message-shop f-w-b" style="border-bottom: 2px solid red;"></span>
            <span id="successful-message-shop" class="successful-message successful-message-shop f-w-b" style="border-bottom: 2px solid green;"></span>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label>Shop/Establishment Name</label>
                <input type="text" name="shop_name" id="shop_name" class="form-control" value="{{s_name}}" readonly="">
            </div>
        </div>
        <div class="row">
             <div class="form-group col-md-6">
                <label>Name of Treasury <span style="color: red;">*</span></label>
                <input type="text" name="name_of_treasury_for_shop" id="name_of_treasury_for_shop" class="form-control" value="{{s_name_of_treasury}}"
                       onblur="checkValidation('shop', 'name_of_treasury_for_shop', shopTreasuryNameValidationMessage);" placeholder=" Shop Name of Treasury">
                <span class="error-message error-message-shop-name_of_treasury_for_shop"></span>
            </div>
            <div class="form-group col-md-6">
                <label>Shop/Establishment Challan No. <span style="color: red;">*</span></label>
                <input type="text" name="challan_no_for_shop" id="challan_no_for_shop" class="form-control" value="{{s_challan_no}}"
                       onblur="checkValidation('shop', 'challan_no_for_shop', shopChallanNoValidationMessage);" placeholder=" Shop Challan No.">
                <span class="error-message error-message-shop-challan_no_for_shop"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="contract_start_date">Shop/Establishment Challan Date <span style="color: red;">*</span></label>
                <div class="input-group date date_picker">
                    <input type="text" name="challan_date_for_shop" id="challan_date_for_shop" class="form-control" placeholdcertificate_expiry_date_for_shoper="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                           onblur="checkValidation('shop', 'challan_date_for_shop', shopChallanDateValidationMessage);" value="{{s_challan_date}}">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <span class="error-message error-message-shop-challan_date_for_shop"></span>
            </div>
            <div class="form-group col-md-6">
                <label>Amount of Fees Paid <span style="color: red;">*</span></label>
                <input type="text" name="amount_of_fees_paid_for_shop" id="amount_of_fees_paid_for_shop" class="form-control" value="{{s_amount_of_fees_paid}}"
                       onkeyup="checkNumeric($(this));"
                       onblur="checkNumeric($(this)); checkValidation('shop', 'amount_of_fees_paid_for_shop', shopAmountOfFeesPaidValidationMessage);" placeholder=" Shop Amount of Paid">
                <span class="error-message error-message-shop-amount_of_fees_paid_for_shop"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Shop/Establishment Registration No. <span style="color: red;">*</span></label>
                <input type="text" name="registration_no_for_shop" id="registration_no_for_shop" class="form-control" value="{{s_registration_no}}"
                       onblur="checkValidation('shop', 'registration_no_for_shop', shopRegistrationNoValidationMessage);" placeholder=" Shop Registration No.">
                <span class="error-message error-message-shop-registration_no_for_shop"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label for="">Shop/Establishment Valid up to <span style="color: red;">*</span></label>
                <div class="input-group date date_picker">
                    <input type="text" name="certificate_expiry_date_for_shop" id="certificate_expiry_date_for_shop" class="form-control" placeholdcertificate_expiry_date_for_shoper="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                           onblur="checkValidation('shop', 'certificate_expiry_date_for_shop', shopCerticateExpiryDateValidationMessage);" value="{{s_certificate_expiry_date}}">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <span class="error-message error-message-shop-certificate_expiry_date_for_shop"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label>Remark <span style="color: red;">*</span></label>
                <textarea class="form-control" name="remark_for_shop" id="remark_for_shop" placeholder=" Shop Remark" rows="3" 
                          onblur="checkValidation('shop', 'remark_for_shop', shopRemarkValidationMessage);">{{s_remark}}</textarea>
                <span class="error-message error-message-shop-remark_for_shop"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer"style="padding: 0px 15px 15px 0px;">
        <button type="button" class="btn btn-success"  style="border: 1px solid #3c8dbc;" onclick="Shop.listview.labourDeptApproveForShop($(this), '{{s_id}}')">Approve</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" ><i class="fas fa-times"></i>&nbsp; Close</button>
    </div>
</form>