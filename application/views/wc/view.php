<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">Water Connection Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application for release of New Water Supply Connection </div>
            </div>
            <form role="form" id="wc_form" name="wc_form" onsubmit="return false;">

                <input type="hidden" id="wc_id" name="wc_id" value="{{wc_id}}">
                <div class="card-body">
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
                                       maxlength="100" value="{{name_of_applicant}}" disabled="">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>2. House No. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="house_no" name="house_no" class="form-control" placeholder="House No. !" maxlength="100" value="{{house_no}}" disabled="">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>3. Ward No. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="ward_no" name="ward_no" class="form-control" placeholder="ward No. !" maxlength="100" value="{{ward_no}}" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4. Village <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="village" name="village" class="form-control" placeholder="Name of Applicant !"
                                       maxlength="100" value="{{village}}" disabled="">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>5. Panchayat/DMC <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="panchayat_or_dmc" name="panchayat_or_dmc" class="form-control" placeholder="Panchayat/DMC !" maxlength="100" value="{{panchayat_or_dmc}}" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Connection <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control" id="application_category" name="application_category"
                                        data-placeholder="Status !" disabled="">
                                    <option value="">Select Connection Category</option>
                                    <option value="Old">Old</option>
                                    <option value="New">New</option>
                                    <option value="Reconnection">Re-connection</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7. House ownership <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control" id="house_ownership" name="house_ownership"
                                        data-placeholder="Status !" disabled="">
                                    <option value="">Select House ownership</option>
                                    <option value="Own">Own</option>
                                    <option value="Tenant">Tenant</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>8. Type of water connection <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control" id="wc_type" name="wc_type"
                                        data-placeholder="Status !" disabled="">
                                    <option value="">Select Type of water connection</option>
                                    <option value="Domestic">Domestic</option>
                                    <option value="Non-omestic">Non-domestic</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>9. Diameter for service connection <span style="color: red;">*</span></label>
                            <input type="text" id="diameter_service_connection" name="diameter_service_connection" class="form-control" placeholder="Diameter for service connection !"
                                   maxlength="100"  disabled="" value="{{diameter_service_connection}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>10. Water meter <span style="color: red;">*</span></label>
                            <input type="text" id="water_meter" name="water_meter" class="form-control" placeholder="Water meter !"
                                   maxlength="100" value="{{water_meter}}" disabled="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>11. District <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <select id="district" name="district" class="form-control select2" disabled=""
                                        data-placeholder="Select District" style="width: 100%;">  
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>11.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2" disabled=""
                                        data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('wmregistration', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                                </select>
                            </div>
                            <span class="error-message error-message-wmregistration-entity_establishment_type"></span>
                        </div>
                        <div class="col-12 m-b-5px" id="receipt_of_last_years_house_tax_container_for_wc_view">
                            <label>12. Receipt of last years House Tax Payment (A Xerox copy to be enclosed) <span style="color: red;">* <br>(Maximum File Size: 10MB)&nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                        </div>
                        <div class="form-group col-sm-12" id="receipt_of_last_years_house_tax_name_container_for_wc_view" style="display: none;">
                            <label>12. Receipt of last years House Tax Payment (A Xerox copy to be enclosed) <span style="color: red;">*</label><br>
                            <a id="receipt_of_last_years_house_tax_download" target="_blank"><label id="receipt_of_last_years_house_tax_name_image_for_wc_view" class="btn btn-sm btn-nic-blue f-w-n" style="border: 2px solid blue;">{{VIEW_UPLODED_DOCUMENT}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="id_proof_container_for_wc_view">
                            <label>13. ID Proof <span style="color: red;">* <br>(Maximum File Size: 1MB)&nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                        </div>
                        <div class="form-group col-sm-12" id="id_proof_name_container_for_wc_view" style="display: none;">
                            <label>13. ID Proof <span style="color: red;">*</label><br>
                            <a id="id_proof_download" target="_blank"><label id="id_proof_name_image_for_wc_view" class="btn btn-sm btn-nic-blue f-w-n" style="border: 2px solid blue;">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="col-12 m-b-5px" id="electricity_bill_container_for_wc_view">
                            <label>14. Electricity Bill (Current) <span style="color: red;">* <br>(Maximum File Size: 2MB)&nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                        </div>
                        <div class="form-group col-sm-12" id="electricity_bill_name_container_for_wc_view" style="display: none;">
                            <label>14. Electricity Bill (Current) <span style="color: red;">*</label><br>
                            <a id="electricity_bill_download" target="_blank"><label id="electricity_bill_name_image_for_wc_view" class="btn btn-sm btn-nic-blue f-w-n" style="border: 2px solid blue;">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_wc_view">
                            <label>15. Signature <span style="color: red;">* <br>(Maximum File Size: 1MB)&nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_wc_view" style="display: none;">
                            <label>15. Signature <span style="color: red;">*</label><br>
                            <a id="seal_and_stamp_download" target="_blank"><img id="seal_and_stamp_name_image_for_wc_view" style="width: 250px; height: 250px; border: 2px solid blue;"></a>
                        </div>
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
                                    <input type="checkbox" class="" disabled="" name="declaration_for_wc" id="declaration_for_wc" autocomplete="true" value="{{is_checked}}" >&nbsp;I hereby give undertaking that the above information furnished by me are correct and true.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr class="m-b-1rem">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Remarks  <span style="color: red;">*</span></label>
                            <textarea class="form-control" placeholder="Remarks !" readonly="">{{remarks}}</textarea>
                        </div>
                    </div>
                    <hr class="m-b-1rem"> 
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-danger" onclick="WC.listview.loadWCData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>