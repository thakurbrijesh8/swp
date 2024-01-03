<div class="card">
    <div class="card-header">
        <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">APPLICATION FORM FOR "SOCIETY REGISTRATION"</div>
    </div>
    <form role="form" id="society_registration_form" name="society_registration_form" onsubmit="return false;">
        <input type="hidden" id="society_registration_id_for_society_registration" name="society_registration_id_for_society_registration" class="module_id_for_{{module_type}}" value="{{society_registration_id}}">
        <input type="hidden" id="module_id_for_{{module_type}}" name="module_id_for_{{module_type}}" class="module_id_for_{{module_type}}" value="{{society_registration_id}}">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span class="error-message error-message-society-registration f-w-b" style="border-bottom: 2px solid red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">                   
                    <label>1.1 District <span class="color-nic-red">*</span></label>
                    <select id="district_for_society_registration" name="district_for_society_registration" class="form-control select2"
                            onchange="checkValidation('society-registration', 'district_for_society_registration', districtValidationMessage);"
                            data-placeholder="Select District" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-society-registration-district_for_society_registration"></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>1.2 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                    <select id="entity_establishment_type_for_society_registration" name="entity_establishment_type_for_society_registration" class="form-control select2"
                            data-placeholder="Select Entity / Establishment Type" style="width: 100%;" 
                            onblur="checkValidation('society-registration', 'entity_establishment_type_for_society_registration', entityEstablishmentTypeValidationMessage);">
                    </select>
                    <span class="error-message error-message-society-registration-entity_establishment_type_for_society_registration"></span>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-nic-blue p-2">
                    <h3 class="card-title f-w-b f-s-16px">2. Basic Details</h3>
                </div>
                <div class="card-body pb-0 border-nic-blue">
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.1 Applicant Name <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_name_for_society_registration" name="applicant_name_for_society_registration" class="form-control"
                                   onblur="checkValidation('society-registration', 'applicant_name_for_society_registration', applicantNameValidationMessage);"
                                   placeholder="Enter Applicant Name !" maxlength="100" value="{{applicant_name}}">
                            <span class="error-message error-message-society-registration-applicant_name_for_society_registration"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.2 Applicant Address with Pincode <span class="color-nic-red">*</span></label>
                            <textarea id="applicant_address_for_society_registration" name="applicant_address_for_society_registration" class="form-control" placeholder="Enter Applicant Address with Pincode !"
                                      maxlength="200" onblur="checkValidation('society-registration', 'applicant_address_for_society_registration', addressValidationMessage);">{{applicant_address}}</textarea>
                            <span class="error-message error-message-society-registration-applicant_address_for_society_registration"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.3 Applicant Mobile No. <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_mobile_number_for_society_registration" name="applicant_mobile_number_for_society_registration" class="form-control"
                                   onblur="checkValidationForMobileNumber('society-registration', 'applicant_mobile_number_for_society_registration');"
                                   placeholder="Enter Mobile No. !" maxlength="10" value="{{applicant_mobile_number}}">
                            <span class="error-message error-message-society-registration-applicant_mobile_number_for_society_registration"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>2.4 Name of the Proposed Society <span class="color-nic-red">*</span></label>
                            <input type="text" id="society_name_for_society_registration" name="society_name_for_society_registration" class="form-control"
                                   onblur="checkValidation('society-registration', 'society_name_for_society_registration', societyNameValidationMessage);"
                                   placeholder="Enter Name of the Proposed Society !" maxlength="100" value="{{society_name}}">
                            <span class="error-message error-message-society-registration-society_name_for_society_registration"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>2.5 Address to be Registered <span class="color-nic-red">*</span></label>
                            <textarea id="society_address_for_society_registration" name="society_address_for_society_registration" class="form-control" placeholder="Enter Address to be Registered !"
                                      maxlength="200" onblur="checkValidation('society-registration', 'society_address_for_society_registration', societyAddressValidationMessage);">{{society_address}}</textarea>
                            <span class="error-message error-message-society-registration-society_address_for_society_registration"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="m_ref_doc_container_for_{{module_type}}"></div>
            <div id="m_doc_container_for_{{module_type}}"></div>
            <div id="m_other_doc_container_for_{{module_type}}"></div>

            {{#if show_submit_qr_details}}
            <input type="hidden" id="query_status_for_society_registration" value="{{query_status}}" />
            <input type="hidden" id="status_for_society_registration" value="{{status}}" />
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Query Response Remarks <span style="color: red;">*</span></label>
                    <textarea id="remarks_for_society_registration" class="form-control" placeholder="Query Response Remarks !"
                              onblur="checkValidation('qrtc', 'remarks_for_society_registration', remarksValidationMessage);"></textarea>
                    <span class="error-message error-message-qrtc-remarks_for_society_registration"></span>
                </div>
            </div>
            {{/if}}

            <hr class="mb-2">
            <div>
                {{#if show_submit_qr_details}}
                <button type="button" id="submit_btn_for_society_registration" class="btn btn-sm btn-success" 
                        onclick="SocietyRegistration.listview.submitSocietyRegistration(VALUE_FOUR);" 
                        style="margin-right: 5px;"><i class="fas fa-save"></i> &nbsp; Submit & Response Query</button>
                {{else}}
                <button type="button" id="draft_btn_for_society_registration" class="btn btn-sm btn-nic-blue" 
                        onclick="SocietyRegistration.listview.submitSocietyRegistration(VALUE_ONE);" 
                        style="margin-right: 5px;"><i class="fas fa-download"></i> &nbsp; Save as Draft</button>
                <button type="button" id="submit_btn_for_society_registration" class="btn btn-sm btn-success" 
                        onclick="SocietyRegistration.listview.submitSocietyRegistration(VALUE_THREE);" 
                        style="margin-right: 5px;"><i class="fas fa-save"></i> &nbsp; Submit Application</button>
                {{/if}}
                <button type="button" class="btn btn-sm btn-danger" onclick="SocietyRegistration.listview.loadSocietyRegistrationData();">
                    <i class="fas fa-times"></i> &nbsp; Cancel</button>
            </div>
        </div>
    </form>
</div>