<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Pay Your Fees</h3>
</div>
<form role="form" id="tree_cutting_upload_challan_form" name="tree_cutting_upload_challan_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="tree_cutting_id_for_tree_cutting_upload_challan" name="tree_cutting_id_for_tree_cutting_upload_challan" value="{{tree_cutting_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="success-message-tree-cutting-uc f-w-b" style="border-bottom: 2px solid green; color: green;"></span>
                <span class="error-message error-message-tree-cutting-uc f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Applicant Name<span style="color: red;">*</span></label>
                <input type="text" class="form-control" placeholder="Applicant Name!"
                       value="{{applicant_name}}" readonly="">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Applicant Address <span style="color: red;">*</span></label>
                <textarea class="form-control" placeholder="Address of Applicant !"
                          readonly="">{{applicant_address}}</textarea>
            </div>
        </div>
        <div id="fb_container_for_{{module_type}}" style="display: none;"></div> 
        {{#if show_dd_po_option}}
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Payment Type <span class="color-nic-red">*</span></label>
                <div id="user_payment_type_container_for_tree_cutting_upload_challan"></div>
                <span class="error-message error-message-tree-cutting-uc-user_payment_type_for_tree_cutting_upload_challan"></span>
            </div>
        </div>
        {{/if}}
        <div class="row" id="uc_container_for_tree_cutting_upload_challan" style="{{style}}">
            <div class="col-12 m-b-5px" id="fees_paid_challan_container_for_tree_cutting_upload_challan">
                <label>Upload {{utitle}} <span style="color: red;">* (Maximum File Size: 2MB)</span></label><br>
                <input type="file" id="fees_paid_challan_for_tree_cutting_upload_challan" name="fees_paid_challan_for_tree_cutting_upload_challan"
                       accept="image/jpg,image/png,image/jpeg,image/jfif,application/pdf">
                <div class="error-message error-message-tree-cutting-uc-fees_paid_challan_for_tree_cutting_upload_challan"></div>
            </div>
            <div class="form-group col-sm-12" id="fees_paid_challan_name_container_for_tree_cutting_upload_challan" style="display: none;">
                <label>{{utitle}} <span style="color: red;">*</span></label><br>
                <a id="fees_paid_challan_name_href_for_tree_cutting_upload_challan" target="_blank">
                    <i class="fas fa-cloud-download-alt" style="margin-right: 3px;"></i><span id="fees_paid_challan_name_for_tree_cutting_upload_challan"></span>
                </a>
                {{#if show_fees_paid}}
                <span class="fas fa-times" style="color: red; cursor: pointer; margin-left: 3px;" id="fees_paid_challan_remove_btn_for_tree_cutting_upload_challan"></span><br>
                {{/if}}
                <span class="error-message error-message-tree-cutting-uc-fees_paid_challan_name_for_tree_cutting_upload_challan"></span>
            </div>
        </div>
        <div id="ph_container_for_{{module_type}}" style="display: none;"></div> 
        <hr class="m-b-1rem">
        <div class="form-group">
            {{#if show_fees_paid}}
            <button type="button" id="submit_btn_for_tree_cutting_upload_challan" class="btn btn-sm btn-success" onclick="TreeCutting.listview.uploadFeesPaidChallan();"
                    style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit</button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fas fa-times"></i>&nbsp; Close</button>
        </div>
    </div>
</form>