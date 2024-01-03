<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">Partnership Firms </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application format for Partnership Firms Form Registration</div>
                <br>
              
                
            </div>
            <form role="form" id="psfregistration_form" name="psfregistration_form" onsubmit="return false;">
                
                <input type="hidden" id="psfregistration_id" name="psfregistration_id" value="{{psfregistration_data.psfregistration_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            To,<br>
                            The Registrar of Firm, <br>
                            Department of Civil Registrar - Cum - Sub - Registrar,<br>
                            Daman.
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. District<span class="color-nic-red">*</span></label>
                            <select id="district" name="district" class="form-control select2"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-psfregistration-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('psfregistration', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-psfregistration-entity_establishment_type"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Firm Name<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="firm_name" name="firm_name" class="form-control" placeholder="Enter Name Of the Firm !" maxlength="50" onblur="checkValidation('psfregistration', 'firm_name', firmNameValidationMessage);" value="{{psfregistration_data.firm_name}}">
                            </div>
                            <span class="error-message error-message-psfregistration-firm_name"></span>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label>3. Email<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email !"
                                       maxlength="50" onkeypress="emailIdValidation($(this));" onblur="checkValidationForEmail('psfregistration', 'email', emailValidationMessage);"  value="{{psfregistration_data.email}}">
                            </div>
                            <span class="error-message error-message-psfregistration-email"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4. Complete Address of Principal place of Business <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="principal_address" name="principal_address" class="form-control" placeholder="Enter Complete Address of Registered Business Place !" maxlength="100" onblur="checkValidation('psfregistration', 'principal_address', principaladdressValidationMessage);">{{psfregistration_data.principal_address}}</textarea>
                            </div>
                            <span class="error-message error-message-psfregistration-principal_address"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>5. Duration of The Firm<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="firm_duration" name="firm_duration" class="form-control" value="{{AT_WILL}}" readonly="">
                            </div>
                            <span class="error-message error-message-psfregistration-firm_duration"></span>
                        </div>
                        
                    </div>



                     <div class="row">
                         <div class="form-group col-sm-12">
                                <label>6. Do you want to add any other places Where the firm carries on Business ?</label>&nbsp;
                                <input type="checkbox" id="import_from_outside" name="import_from_outside" class="checkbox" value="{{is_checked}}">
                                <span class="error-message error-message-shop-import_from_outside"></span>
                        </div><br>
                    

                        <div class="form-group col-sm-12 import_from_outside_div" style="display: none;">
                            <label>6.1 Complete Address of The names of any other places Where the firm carries on Business.<span class="color-nic-red"></span></label>
                                <textarea id="other_address" name="other_address" class="form-control" placeholder="Enter Complete Address of Other Business Place !" maxlength="100" onblur="checkValidation('psfregistration', 'other_address', otheraddressValidationMessage);">{{psfregistration_data.other_address}}</textarea>
                            
                            <span class="error-message error-message-psfregistration-other_address"></span>
                        </div>
                      
                    </div> <br>

                   
                 <div class="row">
                        <div class="col-12 m-b-5px" id="application_of_firm_document_container_for_psfregistration">
                            <label>7. Upload Application Firm Registration Form. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="application_of_firm_document_for_psfregistration" name="application_of_firm_document_for_psfregistration" class="spinner_container_for_psfregistration_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="Psfregistration.listview.uploadDocumentForPsfregistration(VALUE_ONE);">
                            <div class="error-message error-message-psfregistration-application_of_firm_document_for_psfregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="application_of_firm_document_name_container_for_psfregistration" style="display: none;">
                            <label>7. Upload Application Firm Registration Form. <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="application_of_firm_document_download"><label id="application_of_firm_document_name_image_for_psfregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_psfregistration_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="application_of_firm_document" class="btn btn-sm btn-danger spinner_name_container_for_psfregistration_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="Psfregistration.listview.askForRemove('{{psfregistration_data.psfregistration_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                  <!------------------------Form No.II------------------------------------------------------------> 
                   <div class="row">
                        <div class="col-12 m-b-5px" id="formII_document_container_for_psfregistration">
                            <label>8. Attach FORM NO.II <span style="color: red;">* &nbsp; <a href="<?=base_url();?>documents/psfregistration/firm-new-registrationFormII.doc">(Download Format of Form No.II )</a>  <br>(Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="formII_document_for_psfregistration" name="formII_document_for_psfregistration" class="spinner_container_for_psfregistration_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="Psfregistration.listview.uploadDocumentForPsfregistration(VALUE_TWO);">
                            <div class="error-message error-message-psfregistration-formII_document_for_psfregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="formII_document_name_container_for_psfregistration" style="display: none;">
                            <label>8. Attach FORM NO.II <span style="color: red;">* &nbsp; <a href="<?=base_url();?>documents/psfregistration/firm-new-registrationFormII.doc">(Download Format of Form No.II )</a>  <br>(Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="formII_document_download"><label id="formII_document_name_image_for_psfregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_psfregistration_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="formII_document" class="btn btn-sm btn-danger spinner_name_container_for_psfregistration_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="Psfregistration.listview.askForRemove('{{psfregistration_data.psfregistration_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                      <!-------------------------Partnership Deed--------------------------------------------> 
                      <div class="row">
                        <div class="col-12 m-b-5px" id="partnership_deed_container_for_psfregistration">
                            <label>9. Attached Partnership Deed which shall be registed by Sub Register Office.<span style="color: red;">*<br> (Maximum File Size: 10MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="partnership_deed_for_psfregistration" name="partnership_deed_for_psfregistration" class="spinner_container_for_psfregistration_{{VALUE_THREE}}"
                                   accept="application/pdf" onchange="Psfregistration.listview.uploadDocumentForPsfregistration(VALUE_THREE);">
                            <div class="error-message error-message-psfregistration-partnership_deed_for_psfregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="partnership_deed_name_container_for_psfregistration" style="display: none;">
                            <label>9. Attached Partnership Deed which shall be registed by Sub Register Office.<span style="color: red;">*<br> (Maximum File Size: 10MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="partnership_deed_download"><label id="partnership_deed_name_image_for_psfregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_psfregistration_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="partnership_deed" class="btn btn-sm btn-danger spinner_name_container_for_psfregistration_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="Psfregistration.listview.askForRemove('{{psfregistration_data.psfregistration_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                     
                      <!-------------------------Aadharcard---------------------->
                      <div class="row">
                        <div class="form-group col-sm-12">
                            
                                <label>10. Do you want to upload Aadhar Card of all Parties ?</label>&nbsp;
                                <input type="checkbox" id="aadharcard_all_parties" name="aadharcard_all_parties" class="checkbox" value="{{is_checked}}">
                                <span class="error-message error-message-shop-aadharcard_all_parties"></span>
                           
                        
                    <div class=" aadharcard_all_parties_div" style="display: none;">
                      <div class="row">
                        <div class="col-12 m-b-5px" id="aadharcard_container_for_psfregistration">
                            <label>10.1 Aadhar Card of all Parties.<span style="color: red;">*<br> (Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="aadharcard_for_psfregistration" name="aadharcard_for_psfregistration" class="spinner_container_for_psfregistration_{{VALUE_FOUR}}"
                                   accept="application/pdf" onchange="Psfregistration.listview.uploadDocumentForPsfregistration(VALUE_FOUR);">
                            <div class="error-message error-message-psfregistration-aadharcard_for_psfregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="aadharcard_name_container_for_psfregistration" style="display: none;">
                            <label>10.1 Aadhar Card of all Parties.<span style="color: red;">*<br> (Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="aadharcard_download"><label id="aadharcard_name_image_for_psfregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_psfregistration_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="aadharcard" class="btn btn-sm btn-danger spinner_name_container_for_psfregistration_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="Psfregistration.listview.askForRemove('{{psfregistration_data.psfregistration_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                    </div>
                     </div>
                    </div>
                

                     <!-------------------------Pancard----------------------------------------------------------->  
                     <div class="row">
                            <div class="form-group col-sm-12">
                                <label>11. Do you want to upload Pancard of all Parties ?</label>&nbsp;
                                <input type="checkbox" id="pancard_all_parties" name="pancard_all_parties" class="checkbox" value="{{is_checked}}">
                                <span class="error-message error-message-shop-pancard_all_parties"></span>
                           
                        
                    <div class=" pancard_all_parties_div" style="display: none;">

                       <div class="col-12 m-b-5px" id="pancard_container_for_psfregistration">
                            <label>11.1 Pancard of all Parties.<span style="color: red;">*<br> (Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="pancard_for_psfregistration" name="pancard_for_psfregistration" class="spinner_container_for_psfregistration_{{VALUE_FIVE}}"
                                   accept="application/pdf" onchange="Psfregistration.listview.uploadDocumentForPsfregistration(VALUE_FIVE);">
                            <div class="error-message error-message-psfregistration-pancard_for_psfregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="pancard_name_container_for_psfregistration" style="display: none;">
                            <label>11.1 Pancard of all Parties.<span style="color: red;">*<br> (Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="pancard_download"><label id="pancard_name_image_for_psfregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_psfregistration_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="pancard" class="btn btn-sm btn-danger spinner_name_container_for_psfregistration_{{VALUE_FIVE}}" style="vertical-align: top;"
                                    onclick="Psfregistration.listview.askForRemove('{{psfregistration_data.psfregistration_id}}', VALUE_FIVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                        </div>
                      </div>
                    

                    <div class="row">
                        <div class="form-group col-sm-12">
                            
                                <label>12. Do you want to upload alteration in the name of the firm or in the principal place of business there of the firm ?</label>&nbsp;
                                <input type="checkbox" id="alteration_name_firm" name="alteration_name_firm" class="checkbox" value="{{is_checked}}">
                                <span class="error-message error-message-shop-alteration_name_firm"></span>
                           
                        
                    <div class=" alteration_name_firm_div" style="display: none;">

                        <div class="col-12 m-b-5px" id="alteration_name_firm_doc_container_for_psfregistration">
                            <label>12.1 Upload Alteration Form.<span style="color: red;">&nbsp; <a href="<?=base_url();?>documents/psfregistration/Firm_No.III.docx">(Download Format of Form No.III )</a> <br> (Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="alteration_name_firm_doc_for_psfregistration" name="alteration_name_firm_doc_for_psfregistration" class="spinner_container_for_psfregistration_{{VALUE_SIX}}"
                                   accept="application/pdf" onchange="Psfregistration.listview.uploadDocumentForPsfregistration(VALUE_SIX);">
                            <div class="error-message error-message-psfregistration-alteration_name_firm_doc_for_psfregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="alteration_name_firm_doc_name_container_for_psfregistration" style="display: none;">
                            <label>12.1 Upload Alteration Form.<span style="color: red;">&nbsp; <a href="<?=base_url();?>documents/psfregistration/Firm_No.III.docx">(Download Format of Form No.III )</a><br> (Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="alteration_name_firm_doc_download"><label id="alteration_name_firm_doc_name_image_for_psfregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_psfregistration_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="alteration_name_firm_doc" class="btn btn-sm btn-danger spinner_name_container_for_psfregistration_{{VALUE_SIX}}" style="vertical-align: top;"
                                    onclick="Psfregistration.listview.askForRemove('{{psfregistration_data.psfregistration_id}}', VALUE_SIX);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                       </div>
                     </div>
               
               
                      <!-------------------------Retirement From---------------------->
                    <div class="row">
                        <div class="form-group col-sm-12">
                            
                                <label>13. Do you want to upload Admission / Retirement Forms ?</label>&nbsp;
                                <input type="checkbox" id="import_from_outside_ret" name="import_from_outside_ret" class="checkbox" value="{{is_checked}}">
                                <span class="error-message error-message-shop-import_from_outside_ret"></span>
                           
                        
                    <div class=" import_from_outside_ret_div" style="display: none;">

                        <div class="col-12 m-b-5px" id="retirement_form_container_for_psfregistration">
                            <label>13.1 Admission / Retirement Form.<span style="color: red;">&nbsp; <a href="<?=base_url();?>documents/psfregistration/firm_partner_change_form_FormVI.doc">(Download Format of Form No.VI )</a>  <br>(Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="retirement_form_for_psfregistration" name="retirement_form_for_psfregistration" class="spinner_container_for_psfregistration_{{VALUE_SEVEN}}"
                                   accept="application/pdf" onchange="Psfregistration.listview.uploadDocumentForPsfregistration(VALUE_SEVEN);">
                            <div class="error-message error-message-psfregistration-retirement_form_for_psfregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="retirement_form_name_container_for_psfregistration" style="display: none;">
                            <label>13.1 Admission / Retirement Form.<span style="color: red;">&nbsp; <a href="<?=base_url();?>documents/psfregistration/firm_partner_change_form_FormVI.doc">(Download Format of Form No.VI )</a>  <br>(Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="retirement_form_download"><label id="retirement_form_name_image_for_psfregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_psfregistration_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="retirement_form" class="btn btn-sm btn-danger spinner_name_container_for_psfregistration_{{VALUE_SEVEN}}" style="vertical-align: top;"
                                    onclick="Psfregistration.listview.askForRemove('{{psfregistration_data.psfregistration_id}}', VALUE_SEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                       </div>
                     </div>
                </div>

                     <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_psfregistration">
                            <label>14. Signature <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_psfregistration" name="seal_and_stamp_for_psfregistration" class="spinner_container_for_psfregistration_{{VALUE_EIGHT}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="Psfregistration.listview.uploadDocumentForPsfregistration(VALUE_EIGHT);">
                            <div class="error-message error-message-psfregistration-seal_and_stamp_for_psfregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_psfregistration" style="display: none;">
                            <label>14. Principal Employer Seal & Stamp <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_psfregistration" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_psfregistration_{{VALUE_EIGHT}}"></a>
                            <button type="button" id="seal_and_stamp" class="btn btn-sm btn-danger spinner_name_container_for_psfregistration_{{VALUE_EIGHT}}" style="vertical-align: top;" 
                                    onclick="Psfregistration.listview.askForRemove('{{psfregistration_data.psfregistration_id}}', VALUE_EIGHT);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    
                    <div class="form-group">
                        <button type="button" id="draft_btn_for_psfregistration" class="btn btn-sm btn-nic-blue" onclick="Psfregistration.listview.submitPsfregistration({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button>
                        <button type="button" id="submit_btn_for_psfregistration" class="btn btn-sm btn-success" onclick="Psfregistration.listview.askForSubmitPsfregistration({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Psfregistration.listview.loadPsfregistrationData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>