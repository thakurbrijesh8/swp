<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Upload Passbook</h3>
</div>
<form role="form" id="society_registration_upload_passbook_form" name="society_registration_upload_passbook_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="society_registration_id_for_society_registration_upload_passbook" name="society_registration_id_for_society_registration_upload_passbook" value="{{society_registration_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="success-message-society-registration-up f-w-b" style="border-bottom: 2px solid green; color: green;"></span>
                <span class="error-message error-message-society-registration-up f-w-b" style="border-bottom: 2px solid red;"></span>
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
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Name of the Proposed Society </label>
                <textarea class="form-control" placeholder="Address of Applicant !"
                          readonly="">{{society_name}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Address to be Registered  </label>
                <textarea class="form-control" placeholder="Address of Applicant !"
                          readonly="">{{society_address}}</textarea>
            </div>
        </div>
        
        <div class="row" id="up_container_for_society_registration_upload_passbook" style="{{style}}">
            <div class="col-12 m-b-5px" id="passbook_container_for_society_registration_upload_passbook">
                <label>Upload {{utitle}} <span style="color: red;">* (Maximum File Size: 2MB)</span></label><br>
                <input type="file" id="passbook_for_society_registration_upload_passbook" name="passbook_for_society_registration_upload_passbook"
                       accept="image/jpg,image/png,image/jpeg,image/jfif,application/pdf">
                <div class="error-message error-message-society-registration-up-passbook_for_society_registration_upload_passbook"></div>
            </div>
            <div class="form-group col-sm-12" id="passbook_name_container_for_society_registration_upload_passbook" style="display: none;">
                <label>{{utitle}} <span style="color: red;">*</span></label><br>
                <a id="passbook_name_href_for_society_registration_upload_passbook" target="_blank">
                    <i class="fas fa-cloud-download-alt" style="margin-right: 3px;"></i><span id="passbook_name_for_society_registration_upload_passbook"></span>
                </a>
                {{#if show_fees_paid}}
                <span class="fas fa-times" style="color: red; cursor: pointer; margin-left: 3px;" id="passbook_remove_btn_for_society_registration_upload_passbook"></span><br>
                {{/if}}
                <span class="error-message error-message-society-registration-up-passbook_name_for_society_registration_upload_passbook"></span>
            </div>
        </div>
        <div id="ph_container_for_{{module_type}}" style="display: none;"></div> 
        <hr class="m-b-1rem">
        <div class="form-group">
            {{#if show_fees_paid}}
            <button type="button" id="submit_btn_for_society_registration_upload_passbook" class="btn btn-sm btn-success" onclick="SocietyRegistration.listview.submituploadPassbook();"
                    style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit</button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fas fa-times"></i>&nbsp; Close</button>
        </div>
    </div>
</form>