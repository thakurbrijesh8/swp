<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Upload Fees Paid Challan Copy</h3>
</div>
<form role="form" id="seller_upload_challan_form" name="seller_upload_challan_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="seller_id_for_seller_upload_challan" name="seller_id_for_seller_upload_challan" value="{{seller_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="success-message-seller-uc f-w-b" style="border-bottom: 2px solid green; color: green;"></span>
                <span class="error-message error-message-seller-uc f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Leased Transferer Name <span style="color: red;">*</span></label>
                <input type="text" class="form-control" placeholder="Transferer Name !"
                       value="{{transferer_name}}" readonly="">
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-b-5px" id="fees_paid_challan_container_for_seller_upload_challan">
                <label>Upload Fees Paid Challan Copy <span style="color: red;">* (Maximum File Size: 2MB)</span></label><br>
                <input type="file" id="fees_paid_challan_for_seller_upload_challan" name="fees_paid_challan_for_seller_upload_challan"
                       accept="image/jpg,image/png,image/jpeg,image/jfif,application/pdf">
                <div class="error-message error-message-seller-uc-fees_paid_challan_for_seller_upload_challan"></div>
            </div>
            <div class="form-group col-sm-12" id="fees_paid_challan_name_container_for_seller_upload_challan" style="display: none;">
                <label>Fees Paid Challan Copy <span style="color: red;">*</label><br>
                <a id="fees_paid_challan_name_href_for_seller_upload_challan" target="_blank">
                    <i class="fas fa-cloud-download-alt" style="margin-right: 3px;"></i><span id="fees_paid_challan_name_for_seller_upload_challan"></span>
                </a>
                {{#if show_fees_paid}}
                <span class="fas fa-times" style="color: red; cursor: pointer; margin-left: 3px;" id="fees_paid_challan_remove_btn_for_seller_upload_challan"></span><br>
                {{/if}}
                <span class="error-message error-message-seller-uc-fees_paid_challan_name_for_seller_upload_challan"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            {{#if show_fees_paid}}
            <button type="button" id="submit_btn_for_seller_upload_challan" class="btn btn-sm btn-success" onclick="Seller.listview.uploadFeesPaidChallan();"
                    style="margin-right: 5px;">Upload Fees Paid Challan Copy</button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>