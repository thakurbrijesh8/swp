<div class="card">
    <div class="card-header">
        <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">APPLICATION FORM FOR "TREE CUTTING PERMISSION"</div>
    </div>
    <form role="form" id="tree_cutting_form" name="tree_cutting_form" onsubmit="return false;">
        <input type="hidden" id="tree_cutting_id_for_tree_cutting" name="tree_cutting_id_for_tree_cutting" class="module_id_for_{{module_type}}" value="{{tree_cutting_id}}">
        <input type="hidden" id="module_id_for_{{module_type}}" name="module_id_for_{{module_type}}" class="module_id_for_{{module_type}}" value="{{tree_cutting_id}}">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span class="error-message error-message-tree-cutting f-w-b" style="border-bottom: 2px solid red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">                   
                    <label>1.1 District <span class="color-nic-red">*</span></label>
                    <select id="district_for_tree_cutting" name="district_for_tree_cutting" class="form-control select2"
                            onchange="checkValidation('tree-cutting', 'district_for_tree_cutting', districtValidationMessage);
                                    TreeCutting.listview.districtChangeEvent($(this));"
                            data-placeholder="Select District" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-tree-cutting-district_for_tree_cutting"></span>
                </div>
                <div class="form-group col-sm-4">                   
                    <label>1.2 Village / DMC Ward / SMC Ward <span class="color-nic-red">*</span></label>
                    <select id="village_dmc_ward_for_tree_cutting" name="village_dmc_ward_for_tree_cutting" class="form-control select2"
                            onchange="checkValidation('tree-cutting', 'village_dmc_ward_for_tree_cutting', oneOptionValidationMessage)"
                            data-placeholder="Select Village / DMC Ward / SMC Ward" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-tree-cutting-village_dmc_ward_for_tree_cutting"></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>1.3 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                    <select id="entity_establishment_type_for_tree_cutting" name="entity_establishment_type_for_tree_cutting" class="form-control select2"
                            data-placeholder="Select Entity / Establishment Type" style="width: 100%;" 
                            onblur="checkValidation('tree-cutting', 'entity_establishment_type_for_tree_cutting', entityEstablishmentTypeValidationMessage);">
                    </select>
                    <span class="error-message error-message-tree-cutting-entity_establishment_type_for_tree_cutting"></span>
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
                            <input type="text" id="applicant_name_for_tree_cutting" name="applicant_name_for_tree_cutting" class="form-control"
                                   onblur="checkValidation('tree-cutting', 'applicant_name_for_tree_cutting', applicantNameValidationMessage);"
                                   placeholder="Enter Applicant Name !" maxlength="100" value="{{applicant_name}}">
                            <span class="error-message error-message-tree-cutting-applicant_name_for_tree_cutting"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.2 Applicant Address with Pincode <span class="color-nic-red">*</span></label>
                            <textarea id="applicant_address_for_tree_cutting" name="applicant_address_for_tree_cutting" class="form-control" placeholder="Enter Applicant Address with Pincode !"
                                      maxlength="200" onblur="checkValidation('tree-cutting', 'applicant_address_for_tree_cutting', addressValidationMessage);">{{applicant_address}}</textarea>
                            <span class="error-message error-message-tree-cutting-applicant_address_for_tree_cutting"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.3 Applicant Mobile No. <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_mobile_number_for_tree_cutting" name="applicant_mobile_number_for_tree_cutting" class="form-control"
                                   onblur="checkValidationForMobileNumber('tree-cutting', 'applicant_mobile_number_for_tree_cutting');"
                                   placeholder="Enter Mobile No. !" maxlength="10" value="{{applicant_mobile_number}}">
                            <span class="error-message error-message-tree-cutting-applicant_mobile_number_for_tree_cutting"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.4 Owner Name <span class="color-nic-red">*</span></label>
                            <input type="text" id="owner_name_for_tree_cutting" name="owner_name_for_tree_cutting" class="form-control"
                                   onblur="checkValidation('tree-cutting', 'owner_name_for_tree_cutting', ownerNameValidationMessage);"
                                   placeholder="Enter Owner Name !" maxlength="100" value="{{owner_name}}">
                            <span class="error-message error-message-tree-cutting-owner_name_for_tree_cutting"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>2.5 Owner Address with Pincode <span class="color-nic-red">*</span></label>
                            <textarea id="owner_address_for_tree_cutting" name="owner_address_for_tree_cutting" class="form-control" placeholder="Enter Owner Address with Pincode !"
                                      maxlength="200" onblur="checkValidation('tree-cutting', 'owner_address_for_tree_cutting', ownerAddressValidationMessage);">{{owner_address}}</textarea>
                            <span class="error-message error-message-tree-cutting-owner_address_for_tree_cutting"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="m_ref_doc_container_for_{{module_type}}"></div>
            <div id="m_doc_container_for_{{module_type}}"></div>
            <div id="m_other_doc_container_for_{{module_type}}"></div>

            {{#if show_submit_qr_details}}
            <input type="hidden" id="query_status_for_tree_cutting" value="{{query_status}}" />
            <input type="hidden" id="status_for_tree_cutting" value="{{status}}" />
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Query Response Remarks <span style="color: red;">*</span></label>
                    <textarea id="remarks_for_tree_cutting" class="form-control" placeholder="Query Response Remarks !"
                              onblur="checkValidation('qrtc', 'remarks_for_tree_cutting', remarksValidationMessage);"></textarea>
                    <span class="error-message error-message-qrtc-remarks_for_tree_cutting"></span>
                </div>
            </div>
            {{/if}}

            <hr class="mb-2">
            <div>
                {{#if show_submit_qr_details}}
                <button type="button" id="submit_btn_for_tree_cutting" class="btn btn-sm btn-success" 
                        onclick="TreeCutting.listview.submitTreeCutting(VALUE_FOUR);" 
                        style="margin-right: 5px;"><i class="fas fa-save"></i> &nbsp; Submit & Response Query</button>
                {{else}}
                <button type="button" id="draft_btn_for_tree_cutting" class="btn btn-sm btn-nic-blue" 
                        onclick="TreeCutting.listview.submitTreeCutting(VALUE_ONE);" 
                        style="margin-right: 5px;"><i class="fas fa-download"></i> &nbsp; Save as Draft</button>
                <button type="button" id="submit_btn_for_tree_cutting" class="btn btn-sm btn-success" 
                        onclick="TreeCutting.listview.submitTreeCutting(VALUE_THREE);" 
                        style="margin-right: 5px;"><i class="fas fa-save"></i> &nbsp; Submit Application</button>
                {{/if}}
                <button type="button" class="btn btn-sm btn-danger" onclick="TreeCutting.listview.loadTreeCuttingData();">
                    <i class="fas fa-times"></i> &nbsp; Cancel</button>
            </div>
        </div>
    </form>
</div>