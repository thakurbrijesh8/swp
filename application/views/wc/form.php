<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">Water Connection Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application for release of New Water Supply Connection </div>
            </div>
            <form role="form" id="wc_form" name="wc_form" onsubmit="return false;">

                <input type="hidden" id="wc_id" name="wc_id" value="{{wc_data.wc_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-wc f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            To,<br>
                            The Assistant Engineer,<br>
                            P.W.D., Sub Division No. 1<br>
                            Nani Daman.
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. Name of Applicant <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_applicant" name="name_of_applicant" class="form-control" placeholder="Name of Applicant !"
                                       maxlength="100" onblur="checkValidation('wc', 'name_of_applicant', applicantNameValidationMessage);" value="{{wc_data.name_of_applicant}}">
                            </div>
                            <span class="error-message error-message-wc-name_of_applicant"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>2. House No. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="house_no" name="house_no" class="form-control" placeholder="House No. !" maxlength="100" value="{{wc_data.house_no}}" onblur="checkValidation('wc', 'house_no', houseNoValidationMessage);">
                            </div>
                            <span class="error-message error-message-wc-house_no"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>3. Ward No. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="ward_no" name="ward_no" class="form-control" placeholder="ward No. !" maxlength="100" value="{{wc_data.ward_no}}" onblur="checkValidation('wc', 'ward_no', wardNoValidationMessage);">
                            </div>
                            <span class="error-message error-message-wc-ward_no"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4. Village <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="village" name="village" class="form-control" placeholder="Name of Applicant !"
                                       maxlength="100" onblur="checkValidation('wc', 'village', villageValidationMessage);" value="{{wc_data.village}}">
                            </div>
                            <span class="error-message error-message-wc-village"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>5. Panchayat/DMC <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="panchayat_or_dmc" name="panchayat_or_dmc" class="form-control" placeholder="Panchayat/DMC !" maxlength="100" value="{{wc_data.panchayat_or_dmc}}" onblur="checkValidation('wc', 'panchayat_or_dmc', panchayatOrDmcValidationMessage);">
                            </div>
                            <span class="error-message error-message-wc-panchayat_or_dmc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Connection <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control" id="application_category" name="application_category"
                                        data-placeholder="Status !" onblur="checkValidation('wc', 'application_category', applicantCategoryWcValidationMessage);">
                                    <option value="">Select Connection Category</option>
                                    <option value="Old">Old</option>
                                    <option value="New">New</option>
                                    <option value="Reconnection">Re-connection</option>
                                </select>
                            </div>
                            <span class="error-message error-message-wc-application_category"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7. House ownership <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control" id="house_ownership" name="house_ownership"
                                        data-placeholder="Status !" onblur="checkValidation('wc', 'house_ownership', houseOwnershipValidationMessage);">
                                    <option value="">Select House ownership</option>
                                    <option value="Own">Own</option>
                                    <option value="Tenant">Tenant</option>
                                </select>
                            </div>
                            <span class="error-message error-message-wc-house_ownership"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8. Type of water connection <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control" id="wc_type" name="wc_type"
                                        data-placeholder="Status !" onblur="checkValidation('wc', 'wc_type', wcTypeValidationMessage);">
                                    <option value="">Select Type of water connection</option>
                                    <option value="Domestic">Domestic</option>
                                    <option value="Non-domestic">Non-domestic</option>
                                </select>
                            </div>
                            <span class="error-message error-message-wc-wc_type"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>9. Diameter for service connection <span style="color: red;">*</span></label>
                            <input type="text" id="diameter_service_connection" name="diameter_service_connection" class="form-control" placeholder="Diameter for service connection !"
                                   maxlength="100" onblur="checkValidation('wc', 'diameter_service_connection', diameterServiceConnectionValidationMessage);" value="{{wc_data.diameter_service_connection}}">
                            <span class="error-message error-message-wc-diameter_service_connection"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>10. Water meter <span style="color: red;">*</span></label>
                            <input type="text" id="water_meter" name="water_meter" class="form-control" placeholder="Water meter !"
                                   maxlength="100" onblur="checkValidation('wc', 'water_meter', waterMeterValidationMessage);" value="{{wc_data.water_meter}}">
                            <span class="error-message error-message-wc-water_meter"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>11. District <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <select id="district" name="district" class="form-control select2"
                                        data-placeholder="Select District" style="width: 100%;">  
                                </select>
                            </div>
                            <span class="error-message error-message-wc-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>11.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('wc', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-wc-entity_establishment_type"></span>
                        </div>
                        <div class="form-group col-sm-12" id="receipt_of_last_years_house_tax_container">
                            <label>12. Receipt of last years House Tax Payment (A Xerox copy to be enclosed) <span style="color: red;">* <br>(Maximum File Size: 10MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="receipt_of_last_years_house_tax" name="receipt_of_last_years_house_tax"
                                   accept="application/pdf" class="spinner_container_for_wc_{{VALUE_ONE}}" onchange="WC.listview.uploadDocumentForWC(VALUE_ONE);">
                            <div class="error-message error-message-wc-receipt_of_last_years_house_tax"></div>
                        </div>
                        <div class="form-group col-sm-12" id="receipt_of_last_years_house_tax_name_container" style="display: none;">
                            <label>12. Receipt of last years House Tax Payment (A Xerox copy to be enclosed) <span style="color: red;">*</span></label><br>
                            <a id="receipt_of_last_years_house_tax_download" target="_blank"><label id="receipt_of_last_years_house_tax_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wc_{{VALUE_ONE}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="receipt_of_last_years_house_tax_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_wc_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="WC.listview.askForRemove('{{wc_data.wc_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12" id="id_proof_container">
                            <label>13. ID Proof <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="id_proof" name="id_proof" accept="application/pdf" class="spinner_container_for_wc_{{VALUE_THREE}}" onchange="WC.listview.uploadDocumentForWC(VALUE_THREE);">
                            <div class="error-message error-message-wc-id_proof"></div>
                        </div>
                        <div class="form-group col-sm-12" id="id_proof_name_container" style="display: none;">
                            <label>13. ID Proof <span style="color: red;">*</span></label><br>
                            <a id="id_proof_download" target="_blank"><label id="id_proof_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wc_{{VALUE_THREE}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="id_proof_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_wc_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="WC.listview.askForRemove('{{wc_data.wc_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12" id="electricity_bill_container">
                            <label>14. Electricity Bill (Current) <span style="color: red;">* <br>(Maximum File Size: 1MB)&nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="electricity_bill" name="electricity_bill" accept="application/pdf" class="spinner_container_for_wc_{{VALUE_FOUR}}" onchange="WC.listview.uploadDocumentForWC(VALUE_FOUR);">
                            <div class="error-message error-message-wc-electricity_bill"></div>
                        </div>
                        <div class="form-group col-sm-12" id="electricity_bill_name_container" style="display: none;">
                            <label>14. Electricity Bill (Current) <span style="color: red;">*</span></label><br>
                            <a id="electricity_bill_download" target="_blank"><label id="electricity_bill_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wc_{{VALUE_FOUR}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="electricity_bill_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_wc_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="WC.listview.askForRemove('{{wc_data.wc_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_wc">
                            <label>15. Signature <span style="color: red;">* <br>(Maximum File Size: 1MB)&nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_wc" name="seal_and_stamp_for_wc"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" class="spinner_container_for_wc_{{VALUE_TWO}}" onchange="WC.listview.uploadDocumentForWC(VALUE_TWO);">
                            <div class="error-message error-message-wc-seal_and_stamp_for_wc"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_wc" style="display: none;">
                            <label>15. Principal Employer Seal & Stamp <span style="color: red;">*</label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_wc" style="width: 250px; height: 250px; border: 2px solid blue;"></a>
                            <button type="button" class="btn btn-sm btn-danger spinner_name_container_for_wc_{{VALUE_TWO}}" style="vertical-align: top;" 
                                    onclick="WC.listview.askForRemove('{{wc_data.wc_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12"> 
                            <strong>16. Declaration <span class="color-nic-red">*</span></strong><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" class="" name="declaration_for_wc" id="declaration_for_wc" autocomplete="true" value="{{is_checked}}" >&nbsp;I hereby give undertaking that the above information furnished by me are correct and true.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-wc-declaration_for_wc"></span>
                        </div>
                    </div>
                    <hr class="m-b-1rem"> 

                    <div class="form-group">
                        <button type="button" id="draft_btn_for_wc" class="btn btn-sm btn-nic-blue" onclick="WC.listview.submitWC({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button>
                        <button type="button" id="submit_btn_for_wc" class="btn btn-sm btn-success" onclick="WC.listview.askForSubmitWC({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="WC.listview.loadWCData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>