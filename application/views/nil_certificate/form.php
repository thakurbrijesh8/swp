<div class="card">
    <div class="card-header">
        <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">APPLICATION FORM FOR "NIL CERTIFICATE FOR ENCUMBRANCE"</div>
    </div>
    <form role="form" id="nil_certificate_form" name="nil_certificate_form" onsubmit="return false;">
        <input type="hidden" id="nil_certificate_id_for_nil_certificate" name="nil_certificate_id_for_nil_certificate" class="module_id_for_{{module_type}}" value="{{nil_certificate_id}}">
        <input type="hidden" id="module_id_for_{{module_type}}" name="module_id_for_{{module_type}}" class="module_id_for_{{module_type}}" value="{{nil_certificate_id}}">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span class="error-message error-message-nil-certificate f-w-b" style="border-bottom: 2px solid red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">                   
                    <label>1.1 District <span class="color-nic-red">*</span></label>
                    <select id="district_for_nil_certificate" name="district_for_nil_certificate" class="form-control select2"
                            onchange="checkValidation('nil-certificate', 'district_for_nil_certificate', districtValidationMessage);
                                    NilCertificate.listview.districtChangeEvent($(this));"
                            data-placeholder="Select District" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-nil-certificate-district_for_nil_certificate"></span>
                </div>
                <div class="form-group col-sm-4">                   
                    <label>1.2 Village / DMC Ward / SMC Ward <span class="color-nic-red">*</span></label>
                    <select id="village_dmc_ward_for_nil_certificate" name="village_dmc_ward_for_nil_certificate" class="form-control select2"
                            onchange="checkValidation('nil-certificate', 'village_dmc_ward_for_nil_certificate', oneOptionValidationMessage)"
                            data-placeholder="Select Village / DMC Ward / SMC Ward" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-nil-certificate-village_dmc_ward_for_nil_certificate"></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>1.3 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                    <select id="entity_establishment_type_for_nil_certificate" name="entity_establishment_type_for_nil_certificate" class="form-control select2"
                            data-placeholder="Select Entity / Establishment Type" style="width: 100%;" 
                            onblur="checkValidation('nil-certificate', 'entity_establishment_type_for_nil_certificate', entityEstablishmentTypeValidationMessage);">
                    </select>
                    <span class="error-message error-message-nil-certificate-entity_establishment_type_for_nil_certificate"></span>
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
                            <input type="text" id="applicant_name_for_nil_certificate" name="applicant_name_for_nil_certificate" class="form-control"
                                   onblur="checkValidation('nil-certificate', 'applicant_name_for_nil_certificate', applicantNameValidationMessage);"
                                   placeholder="Enter Applicant Name !" maxlength="100" value="{{applicant_name}}">
                            <span class="error-message error-message-nil-certificate-applicant_name_for_nil_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.2 Applicant Address with Pincode <span class="color-nic-red">*</span></label>
                            <textarea id="applicant_address_for_nil_certificate" name="applicant_address_for_nil_certificate" class="form-control" placeholder="Enter Applicant Address with Pincode !"
                                      maxlength="200" onblur="checkValidation('nil-certificate', 'applicant_address_for_nil_certificate', addressValidationMessage);">{{applicant_address}}</textarea>
                            <span class="error-message error-message-nil-certificate-applicant_address_for_nil_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.3 Applicant Mobile No. <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_mobile_number_for_nil_certificate" name="applicant_mobile_number_for_nil_certificate" class="form-control"
                                   onblur="checkValidationForMobileNumber('nil-certificate', 'applicant_mobile_number_for_nil_certificate');"
                                   placeholder="Enter Mobile No. !" maxlength="10" value="{{applicant_mobile_number}}">
                            <span class="error-message error-message-nil-certificate-applicant_mobile_number_for_nil_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.4 Purpose <span class="color-nic-red">*</span></label>
                            <input type="text" id="purpose_for_nil_certificate" name="purpose_for_nil_certificate" class="form-control"
                                   onblur="checkValidation('nil-certificate', 'purpose_for_nil_certificate', purposeValidationMessage);"
                                   placeholder="Enter Purpose !" maxlength="100" value="{{purpose}}">
                            <span class="error-message error-message-nil-certificate-purpose_for_nil_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.5 Detail of Property <span class="color-nic-red">*</span></label>
                            <textarea id="property_detail_for_nil_certificate" name="property_detail_for_nil_certificate" class="form-control" placeholder="Enter Detail of Property !"
                                      maxlength="200" onblur="checkValidation('nil-certificate', 'property_detail_for_nil_certificate', propertyDetailValidationMessage);">{{property_detail}}</textarea>
                            <span class="error-message error-message-nil-certificate-property_detail_for_nil_certificate"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="m_ref_doc_container_for_{{module_type}}"></div>
            <div id="m_doc_container_for_{{module_type}}"></div>
            <div id="m_other_doc_container_for_{{module_type}}"></div>

            {{#if show_submit_qr_details}}
            <input type="hidden" id="query_status_for_nil_certificate" value="{{query_status}}" />
            <input type="hidden" id="status_for_nil_certificate" value="{{status}}" />
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Query Response Remarks <span style="color: red;">*</span></label>
                    <textarea id="remarks_for_nil_certificate" class="form-control" placeholder="Query Response Remarks !"
                              onblur="checkValidation('qrnc', 'remarks_for_nil_certificate', remarksValidationMessage);"></textarea>
                    <span class="error-message error-message-qrnc-remarks_for_nil_certificate"></span>
                </div>
            </div>
            {{/if}}

            <hr class="mb-2">
            <div>
                {{#if show_submit_qr_details}}
                <button type="button" id="submit_btn_for_nil_certificate" class="btn btn-sm btn-success" 
                        onclick="NilCertificate.listview.submitNilCertificate(VALUE_FOUR);" 
                        style="margin-right: 5px;"><i class="fas fa-save"></i> &nbsp; Submit & Response Query</button>
                {{else}}
                <button type="button" id="draft_btn_for_nil_certificate" class="btn btn-sm btn-nic-blue" 
                        onclick="NilCertificate.listview.submitNilCertificate(VALUE_ONE);" 
                        style="margin-right: 5px;"><i class="fas fa-download"></i> &nbsp; Save as Draft</button>
                <button type="button" id="submit_btn_for_nil_certificate" class="btn btn-sm btn-success" 
                        onclick="NilCertificate.listview.submitNilCertificate(VALUE_THREE);" 
                        style="margin-right: 5px;"><i class="fas fa-save"></i> &nbsp; Submit Application</button>
                {{/if}}
                <button type="button" class="btn btn-sm btn-danger" onclick="NilCertificate.listview.loadNilCertificateData();">
                    <i class="fas fa-times"></i> &nbsp; Cancel</button>
            </div>
        </div>
    </form>
</div>