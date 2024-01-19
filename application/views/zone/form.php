<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">Zone Information</h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application of Zone Information</div>
            </div>
            <form role="form" id="zone_form" name="zone_form" onsubmit="return false;">
                
                <input type="hidden" id="zone_id" name="zone_id" value="{{zone_data.zone_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            To,<br>
                            The Chief Town Planner,<br>
                            Town & Country Planning Dept.,<br>
                            Daman.
                        </div>
                    </div>

                     <div class="row">
                      <div class="form-group col-sm-6">
                            <label>1. District <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="district" name="district" class="form-control select2"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            </div>
                            <span class="error-message error-message-zone-district"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Name of Applicant<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_applicant" name="name_of_applicant" class="form-control" placeholder="Enter Name of Applicant !" onblur="checkValidation('zone', 'name_of_applicant', applicantNameValidationMessage);"
                                       maxlength="100"  value="{{zone_data.name_of_applicant}}">
                            </div>
                            <span class="error-message error-message-zone-name_of_applicant"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>3. Date of Application<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="application_date" id="application_date" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{application_date}}" onblur="checkValidation('zone', 'application_date', appDateValidationMessage);" readonly="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-zone-application_date"></span>
                        </div>
                    </div>
               
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4. Address <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="address" name="address" class="form-control" placeholder="Enter Address !"  maxlength="100" onblur="checkValidation('zone', 'address', owneraddressMessage);" value="{{zone_data.address}}">
                            </div>
                            <span class="error-message error-message-zone-address"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>5. Mobile No<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="mobile_no" name="mobile_no" class="form-control" placeholder="Enter  Mobile No !"  maxlength="100" onblur="checkValidation('zone', 'mobile_no', mobileValidationMessage);" value="{{zone_data.mobile_no}}">
                            </div>
                            <span class="error-message error-message-zone-mobile_no"></span>
                        </div>
                    
                    </div>

                      <div class="row">
                       <div class="form-group col-sm-3">
                            <label>6. PTS No</label>
                            <div class="input-group">
                                <input type="text" id="pts_no" name="pts_no" class="form-control" placeholder="Enter PTS No !"  maxlength="100"  value="{{zone_data.pts_no}}">
                            </div>
                            <span class="error-message error-message-zone-pts_no"></span>
                        </div>
                         <div class="form-group col-sm-3">
                            <label>7. Survey No</label>
                            <div class="input-group">
                                <input type="text" id="survey_no" name="survey_no" class="form-control" placeholder="Enter Survey No !"  maxlength="100"  value="{{zone_data.survey_no}}">
                            </div>
                            <span class="error-message error-message-zone-survey_no"></span>
                        </div>
                        <div class="form-group col-sm-6">
                                <label>8. Village<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="village" name="village" class="form-control" placeholder="Enter Village !"  maxlength="100" onblur="checkValidation('zone', 'village', villageValidationMessage);" value="{{zone_data.village}}">
                            </div>
                            <span class="error-message error-message-zone-village"></span>
                        </div>
                    
                    </div>

                <div class="row">
                        <div class="col-12 m-b-5px" id="site_plan_container_for_zone">
                            <label>9. Copy of Zone Plan issued by City Survey office (latest Original).  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="site_plan_for_zone" name="site_plan_for_zone" class="spinner_container_for_zone_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="Zone.listview.uploadDocumentForZone(VALUE_ONE);">
                            <div class="error-message error-message-zone-site_plan_for_zone"></div>
                        </div>
                        <div class="form-group col-sm-12" id="site_plan_name_container_for_zone" style="display: none;">
                            <label>9.1 Copy of Zone Plan.  <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="site_plan_download"><label id="site_plan_name_image_for_zone" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_zone_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="site_plan" class="btn btn-sm btn-danger spinner_name_container_for_zone_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="Zone.listview.askForRemove('{{zone_data.zone_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                       <div class="row">
                        <div class="col-12 m-b-5px" id="I_XIV_nakal_container_for_zone">
                            <label>10. Copy of I & XIV Nakal (latest Original).<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="I_XIV_nakal_for_zone" name="I_XIV_nakal_for_zone" class="spinner_container_for_zone_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="Zone.listview.uploadDocumentForZone(VALUE_TWO);">
                            <div class="error-message error-message-zone-I_XIV_nakal_for_zone"></div>
                        </div>
                        <div class="form-group col-sm-12" id="I_XIV_nakal_name_container_for_zone" style="display: none;">
                            <label>10.1 Copy of I & XIV Nakal. <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="I_XIV_nakal_download"><label id="I_XIV_nakal_name_image_for_zone" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_zone_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="I_XIV_nakal" class="btn btn-sm btn-danger spinner_name_container_for_zone_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="Zone.listview.askForRemove('{{zone_data.zone_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                    <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_zone">
                            <label>11. Signature <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_zone" name="seal_and_stamp_for_zone" class="spinner_container_for_zone_{{VALUE_THREE}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="Zone.listview.uploadDocumentForZone(VALUE_THREE);">
                            <div class="error-message error-message-zone-seal_and_stamp_for_zone"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_zone" style="display: none;">
                            <label>11. Principal Employer Seal & Stamp <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_zone" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_zone_{{VALUE_THREE}}"></a>
                            <button type="button" id="seal_and_stamp" class="btn btn-sm btn-danger spinner_name_container_for_zone_{{VALUE_THREE}}" style="vertical-align: top;" 
                                    onclick="Zone.listview.askForRemove('{{zone_data.zone_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                     <hr class="m-b-1rem"> 
                     
                    <div class="form-group">
                        <button type="button" id="draft_btn_for_zone" class="btn btn-sm btn-nic-blue" onclick="Zone.listview.submitZone({{VALUE_ONE}});" style="margin-right: 5px;"><i class="fas fa-download"></i>&nbsp; Save as Draft</button>
                        <button type="button" id="submit_btn_for_zone" class="btn btn-sm btn-success" onclick="Zone.listview.askForSubmitZone({{VALUE_TWO}});" style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Zone.listview.loadZoneData();"><i class="fas fa-times"></i>&nbsp; Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>