<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">Application for Inspection at Plinth level</h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application format for Annexure-11 Form for informain completion of work up to Plinth Level</div>
            </div>
            <form role="form" id="inspection_form" name="inspection_form" onsubmit="return false;">
                
                <input type="hidden" id="inspection_id" name="inspection_id" value="{{inspection_data.inspection_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            To,<br>
                            The Competant Authority,<br>
                            UT Administration of DNH&DD,<br>
                             </div>
                    </div>
                             <div class="row">
                    <div class="form-group col-sm-6">                   
                             <label>District <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="district" name="district" class="form-control select2"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            </div>
                            <span class="error-message error-message-inspection-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('inspection', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-inspection-entity_establishment_type"></span>
                        </div>
                        </div>
                       
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. Survey no<span class="color-nic-red"></span></label>
                            <div class="input-group">
                                <input type="text" id="plinth_column" name="plinth_column" class="form-control" placeholder="Enter Survey no !" maxlength="200"  value="{{inspection_data.plinth_column}}">
                            </div>
                           <span class="error-message error-message-inspection-plinth_column"></span> 
                        </div>
                    
                        <div class="form-group col-sm-6">
                            <label>2. Plot Number <span class="color-nic-red"></span></label>
                            <div class="input-group">
                                <input type="text" id="plot_no" name="plot_no" class="form-control" placeholder="Enter Plot No !"  maxlength="100"  value="{{inspection_data.plot_no}}">
                            </div>
                            <span class="error-message error-message-inspection-plot_no"></span>
                        </div> 
                    </div>
                     <div class="row">                      
                        <div class="form-group col-sm-6">
                            <label>3. Permission/License Number vide dated issued by PDA <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="communication_number" name="communication_number" class="form-control" placeholder="Enter Permission/License Number vide dated issued by PDA!" onblur="checkValidation('inspection', 'communication_number', CommunicationValidationMessage);"
                                       maxlength="100"  value="{{inspection_data.communication_number}}">
                            </div>
                            <span class="error-message error-message-inspection-communication_number"></span>
                        </div> 
                     <div class="form-group col-sm-6">
                            <label>4. Name of the Licensed(Architect/Engineer/Structural Engineer) <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_licensed" name="name_licensed" class="form-control" placeholder="Enter Name of the Licensed(Architect/Engineer/Structural Engineer)!" onblur="checkValidation('inspection', 'name_licensed', LicensedNameValidationMessage);"
                                       maxlength="200"  value="{{inspection_data.name_licensed}}">
                            </div>
                            <span class="error-message error-message-inspection-name_licensed"></span>
                        </div>    
                     </div>
                         <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Registration Number(Architect/Engineer/Structural Engineer) </label>
                            <div class="input-group">
                                <input type="text" id="registration_no" name="registration_no" class="form-control" placeholder="Enter Registration Number(Architect/Engineer/Structural Engineer)!" value="{{inspection_data.registration_no}}">
                            </div>
                            <span class="error-message error-message-inspection-registration_no"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>6. License of (Architect/Engineer/Structural Engineer) Valid upto</label>
                            <div class="input-group date">
                                <input type="text" name="valid_upto_date" id="valid_upto_date" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{valid_upto_date}}">
                                <div class="input-group-append">
                                   <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-inspection-valid_upto_date"></span>
                         </div> 
                     </div>
                      <div class="row">
                      <div class="form-group col-sm-6">
                            <label>7. Full address(Architect/Engineer/Structural Engineer)<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea type="text" id="address" name="address" class="form-control" placeholder="Enter Owner full address!"  maxlength="240" onblur="checkValidation('inspection', 'address', FullAddressValidationMessage);">{{inspection_data.address}}</textarea>
                            </div>
                             <span class="error-message error-message-inspection-address"></span> 
                        </div>  
                         <div class="form-group col-sm-6">
                            <label>8. Village <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="village" name="village" class="form-control" placeholder="Enter Village !" maxlength="100" value="{{inspection_data.village}}" onblur="checkValidation('inspection', 'village', villageValidationMessage);">
                            </div>
                            <span class="error-message error-message-inspection-village"></span>
                        </div>                      
                    </div>  
                 

                      <!-- Architecture signature -->                
                    <div class="row">
                        <div class="col-12 m-b-5px" id="signature_architecture_container_for_inspection">
                            <label>9. Upload  Signature of (Architect / Engineer / Surveyor / Structural Engineer)<span style="color: red;">* <br>(Maximum File Size: 1MB)&nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="signature_architecture_for_inspection" name="signature_architecture_for_inspection"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif"  class="spinner_container_for_inspection_{{VALUE_ONE}}" onchange="Inspection.listview.uploadDocumentForInspection(VALUE_ONE);">
                            <div class="error-message error-message-inspection-signature_architecture_for_inspection"></div>
                        </div>
                        <div class="form-group col-sm-12" id="signature_architecture_name_container_for_inspection" style="display: none;">
                        
                            <label>9.1 Authorized Signatory<span style="color: red;">* <br></span></label><br><a id="signature_architecture_download" target="_blank">
                            
                            <img id="signature_architecture_name_image_for_inspection" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_inspection_{{VALUE_ONE}}"></a>                    
                        
                                
                            <button type="button" id="signature_architecture" class="btn btn-sm btn-danger spinner_name_container_for_inspection_{{VALUE_ONE}}" style="vertical-align: top;" 
                                    onclick="Inspection.listview.askForRemove('{{inspection_data.inspection_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>  
                        </div>
                    </div>  
                <!-- Architecture signature -->
                <div class="row">
                        <div class="form-group col-sm-6">
                            <label>10. Name of Owner<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_applicant" name="name_of_applicant" class="form-control" placeholder="Enter Name of Applicant !" onblur="checkValidation('inspection', 'name_of_applicant', applicantNameValidationMessage);"
                                       maxlength="100"  value="{{inspection_data.name_of_applicant}}">
                            </div>
                          <span class="error-message error-message-inspection-name_of_applicant"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>11. Date of Application<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="application_date" id="application_date" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{application_date}}" onblur="checkValidation('inspection', 'application_date', appDateValidationMessage);" readonly="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                             <span class="error-message error-message-inspection-application_date"></span>
                        </div>
                    </div>
                   
                   
                    <!-- signature -->
                    <div class="row">
                        <div class="col-12 m-b-5px" id="sign_seal_container_for_inspection">
                            <label>12. Upload Owner Signature <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="sign_seal_for_inspection" name="sign_seal_for_inspection" 
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" class="spinner_container_for_inspection_{{VALUE_TWO}}" onchange="Inspection.listview.uploadDocumentForInspection(VALUE_TWO);">
                            <div class="error-message error-message-inspection-sign_seal_for_inspection"></div>
                        </div>
                        <div class="form-group col-sm-12" id="sign_seal_name_container_for_inspection" style="display: none;">
                            <label>12.1 Owner Signature<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="sign_seal_download"><img id="sign_seal_name_image_for_inspection" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_inspection_{{VALUE_TWO}}"></a>
                            <button type="button" id="sign_seal" class="btn btn-sm btn-danger spinner_name_container_for_inspection_{{VALUE_TWO}}" style="vertical-align: top;" 
                                    onclick="Inspection.listview.askForRemove('{{inspection_data.inspection_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                
                <!-- signature -->
                </br>
<h2 class="box-title f-w-b page-header color-nic-black f-s-20px m-b-0" style="text-align: left;">Document Required to be Uploaded with the Application</h2></br>             
                    <div class="row">
                        <div class="form-group col-sm-12" id="annexure_9_container_for_inspection">
                            <label>13. Please Upload Annexure-9 Form for Notice for Commencement of work
                            <a href="<?=base_url();?>documents/inspection/Form for Notice for Commencement of Work (Annexure_9).doc">
                            (Download Format of Form for Notice for Commencement of Work (Annexure_9) )
                            </a>  <br>
                            (Maximum File Size: 1MB)&nbsp; (Upload PDF Only)
                            </label><br>
                            <input type="file" id="annexure_9_for_inspection" name="annexure_9_for_inspection"
                                   accept="application/pdf" 
                                   class="spinner_container_for_inspection_{{VALUE_THREE}}"
                                   onchange="Inspection.listview.uploadDocumentForInspection(VALUE_THREE);">
                            <div class="error-message error-message-inspection-annexure_9_for_inspection"></div>
                        </div>
                        
                        <div class="form-group col-sm-6" id="annexure_9_name_container_for_inspection" style="display: none;">
                            <label>13.1. Please Upload Annexure-9 Form for Notice for Commencement of work<span style="color: red;">* 
                            <br></span></label><br>
                            
                            <!-- //<a  target="_blank" id="annexure_9_name_image_for_inspection_download"> -->
                            <a  target="_blank" id="annexure_9_download">
                            <label id="annexure_9_name_image_for_inspection"
                            class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_inspection_{{VALUE_THREE}}">
                            {{VIEW_UPLODED_DOCUMENT}}</label>
                            </a>
                            
                            <button type="button" id="annexure_9" class="btn btn-sm btn-danger spinner_name_container_for_inspection_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="Inspection.listview.askForRemove('{{inspection_data.inspection_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                    </div>
                   
<!-- Annexure-9 -->

                    <div class="row">
                        <div class="form-group col-sm-12" id="approved_license_container_for_inspection">
                            <label>14. Pleae Upload the Certified copy of construciton License and Approved Building Plan.
                            <span style="color: red;">* <br>(Maximum File Size: 25MB)&nbsp; (Upload PDF Only)
                            </span></label><br>
                            
                            <input type="file" id="approved_license_for_inspection" name="approved_license_for_inspection"
                                   accept="application/pdf"
                                   class="spinner_container_for_inspection_{{VALUE_FOUR}}"
                                   onchange="Inspection.listview.uploadDocumentForInspection(VALUE_FOUR);">
                            <div class="error-message error-message-inspection-approved_license_for_inspection"></div>
                        </div>
                         <div class="form-group col-sm-6" id="approved_license_name_container_for_inspection" style="display: none;">
                            <label>14.1. Pleae Upload the Certified copy of construciton License and Approved Building Plan.
                            <span style="color: red;">* <br> </span></label><br>
                            
                            <a target="_blank" id="approved_license_download" >                         
                            <label id="approved_license_name_image_for_inspection" 
                            class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_inspection_{{VALUE_FOUR}}">
                            {{VIEW_UPLODED_DOCUMENT}}</label></a>
                            
                             <button type="button" id="approved_license" class="btn btn-sm btn-danger spinner_name_container_for_inspection_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="Inspection.listview.askForRemove('{{inspection_data.inspection_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>                                
                            
                        </div>
                    </div> 

                    <hr class="m-b-1rem"> 
                    <div class="form-group">
                        <button type="button" id="draft_btn_for_inspection" class="btn btn-sm btn-nic-blue" onclick="Inspection.listview.submitInspection({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button>
                        <button type="button" id="submit_btn_for_inspection" class="btn btn-sm btn-success" onclick="Inspection.listview.askForSubmitInspection({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Inspection.listview.loadInspectionData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>