<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
               <h3 class="card-title" style="float: none; text-align: center;">  <label class="dd_for_oc_div" style="display: none;">Annexure - 13</label></h3>
                   <h3 class="card-title" style="float: none; text-align: center;">  <label class="dnh_for_oc_div" style="display: none;">Annexure - 14</label></h3>
                <h3 class="card-title" style="float: none; text-align: center;">Form of Completion Certificate</h3>
            </div>
            <form role="form" id="occupancycertificate_form" name="occupancycertificate_form" onsubmit="return false;">
                
                <input type="hidden" id="occupancy_certificate_id" name="occupancy_certificate_id" value="{{occupancycertificate_data.occupancy_certificate_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-occupancycertificate f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            To,<br/>
                            Competent Authority,<br/>
                            Daman<br/>
                        </div>
                    </div>

                      <div class="row">
                      <div class="form-group col-sm-6">
                            <label>1. District <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select id="district" name="district" class="form-control select2"
                                    data-placeholder="Select District" onchange="OccupancyCertificate.listview.getDepartmentdata(this);" style="width: 100%;">
                            </select>
                            </div>
                            <span class="error-message error-message-occupancycertificate-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('occupancycertificate', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-occupancycertificate-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Survey No. : </label>
                            <div class="input-group">
                                <input type="text" id="survey_no" name="survey_no" class="form-control" placeholder="Enter Survey No.  !"
                                       maxlength="100" onblur="checkValidation('occupancycertificate', 'survey_no', surveyNoValidationMessage);" value="{{occupancycertificate_data.survey_no}}">
                            </div>
                            <span class="error-message error-message-occupancycertificate-survey_no"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>3. Plot No : </label>
                            <div class="input-group">
                                <input type="text" id="plot_no" name="plot_no" class="form-control" placeholder="Enter Plot No  !"
                                       maxlength="100" onblur="checkValidation('occupancycertificate', 'plot_no', plotNoValidationMessage);" value="{{occupancycertificate_data.plot_no}}">
                            </div>
                            <span class="error-message error-message-occupancycertificate-plot_no"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4. Situated at Village  : <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="situated_at" name="situated_at" class="form-control" placeholder="Enter Situated at Village !"
                                       maxlength="100" onblur="checkValidation('occupancycertificate', 'situated_at', situatedAtValidationMessage);" value="{{occupancycertificate_data.situated_at}}">
                            </div>
                            <span class="error-message error-message-occupancycertificate-situated_at"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>5. Permission / License No with Date issue by PDA Daman<span style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="text" name="license_no" id="license_no" class="form-control" placeholder="Enter Permission LIcense No"
                                       value="{{occupancycertificate_data.license_no}}" onblur="checkValidation('occupancycertificate', 'license_no', licenseNoValidationMessage);">
                               
                            </div>
                            <span class="error-message error-message-occupancycertificate-license_no"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Building Completed On</label>
                            <div class="input-group date">
                                <input type="text" name="completed_on" id="completed_on" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{completed_on}}">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-occupancycertificate-completed_on"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7. Name of the Licensed Architect / Engineer / Surveyor / Structural Engineer  : </label>
                            <div class="input-group">
                                <input type="text" id="licensed_engineer_name" name="licensed_engineer_name" class="form-control" placeholder="Enter Name of the Licensed Architect / Engineer / Surveyor / Structural Engineer  !"
                                       maxlength="100" value="{{occupancycertificate_data.licensed_engineer_name}}" >
                            </div>
                            <span class="error-message error-message-occupancycertificate-licensed_engineer_name"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>8. Registration No. of the Licensed Architect / Engineer / Surveyor / Structural Engineer : <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="occupancy_registration_no" name="occupancy_registration_no" class="form-control" placeholder="Enter Registration No. of the Licensed Architect / Engineer / Surveyor / Structural Engineer  !"
                                       maxlength="100" onblur="checkValidation('occupancycertificate', 'occupancy_registration_no', occupancyRegistrationNoValidationMessage);" value="{{occupancycertificate_data.occupancy_registration_no}}">
                            </div>
                            <span class="error-message error-message-occupancycertificate-occupancy_registration_no"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>9. Licensed Architect / Engineer / Surveyor / Structural Engineer Valid upto</label>
                            <div class="input-group date">
                                <input type="text" name="occupancy_valid_upto" id="occupancy_valid_upto" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{occupancy_valid_upto}}" >
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-occupancycertificate-occupancy_valid_upto"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>10. Licensed Architect / Engineer / Surveyor / Structural Engineer Address  <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="address" name="address" class="form-control" placeholder="Licensed Architect / Engineer / Surveyor / Structural Engineer Address  !" maxlength="100" onblur="checkValidation('occupancycertificate', 'address', occupancyAddressValidationMessage);">{{occupancycertificate_data.address}}</textarea>
                            </div>
                            <span class="error-message error-message-occupancycertificate-address"></span>
                        </div>
                    </div>
           

                    <h2 class="box-title f-w-b page-header f-s-20px m-b-0" >Document Required to be Uploaded with the Application</h2>
                    <br/>
                

            <div class="row">
                <div  class="copy_of_construction_permission_item_container_for_occupancycertificate" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="copy_of_construction_permission_container_for_occupancycertificate">
                            <label class="dnh_for_oc_div" style="display: none">11. Xerox copy Of Construction Permission Order <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label>

                            <label class="dd_for_oc_div">11. Copy Of Construction Permission Order.<span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="copy_of_construction_permission_for_occupancycertificate" name="copy_of_construction_permission_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_THREE}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_THREE);">
                            <div class="error-message error-message-occupancycertificate-copy_of_construction_permission_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="copy_of_construction_permission_name_container_for_occupancycertificate" style="display: none;">
                            <label class="dnh_for_oc_div" style="display: none">11.1 Copy Of Construction Permission Order. <span style="color: red;">* </span></label>
                            <label class="dd_for_oc_div">11.1 Copy Of Construction Permission Order. <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="copy_of_construction_permission_download"><label id="copy_of_construction_permission_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="copy_of_construction_permission" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                <div class="row">
                    <div  class="copy_of_building_plan_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="copy_of_building_plan_container_for_occupancycertificate">

                            <label class="dnh_for_oc_div" style="display: none">12.  Xerox copy Of Approved Drawing.<span style="color: red;">* <br>(Maximum File Size: 25MB) &nbsp; (Upload PDF Only)</span></label>
                            <label class="dd_for_oc_div">12.  Copy of approved building plan.<span style="color: red;">* <br>(Maximum File Size: 25MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="copy_of_building_plan_for_occupancycertificate" name="copy_of_building_plan_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_FOUR}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_FOUR);">
                            <div class="error-message error-message-occupancycertificate-copy_of_building_plan_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="copy_of_building_plan_name_container_for_occupancycertificate" style="display: none;">
                            <label class="dnh_for_oc_div" style="display: none">12.1 Copy of approved building plan.<span style="color: red;">* </span></label>
                            <label class="dd_for_oc_div">12.1 Copy of approved building plan.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="copy_of_building_plan_download"><label id="copy_of_building_plan_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="copy_of_building_plan" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>
              

            <div class="row">
                 <div  class="stability_certificate_item_container_for_occupancycertificate" style="display: none;">
                   <div class="form-group col-sm-12">
                           <label>13. Structural stability certificate from licensed Architect or Structural Engineer as per the format in Annexure -14 (Wheather the Building is high rise Construction) ?</label>&nbsp;
                         <input type="radio" id="is_stability_certificate_yes" name="is_stability_certificate" class="" value="{{VALUE_ONE}}">&nbsp; Yes
                            &emsp;
                            <input type="radio" id="is_stability_certificate_no" name="is_stability_certificate" class="" style="margin-bottom: 0px;"
                                        value="{{VALUE_TWO}}" checked="">&nbsp;No
                            <span class="error-message error-message-occupancycertificate-is_stability_certificate"></span>
                        </div>

                        <div class="stability_certificate_div" style="display: none;">
                        <div class="col-12 m-b-5px" id="stability_certificate_container_for_occupancycertificate" >
                            <label>13. Structural stability certificate from licensed Architect or Structural Engineer as per the format in Annexure -14 <a href="documents/departments/PDA/Annexure - 14.pdf" download>(Download Formate of  Annexure -14)</a>  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="stability_certificate_for_occupancycertificate" name="stability_certificate_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_FIVE}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_FIVE);">
                            <div class="error-message error-message-occupancycertificate-stability_certificate_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="stability_certificate_name_container_for_occupancycertificate" style="display: none;">
                            <label>13.1 Structural stability certificate from licensed Architect or Structural Engineer as per the format in Annexure -14 <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="stability_certificate_download"><label id="stability_certificate_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="stability_certificate" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_FIVE}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_FIVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div> 
            </div>

                     <div class="row">
                        <div  class="building_height_noc_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="building_height_noc_container_for_occupancycertificate">
                            <label>14. Final NOC from Coast Guard Authority for building height.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="building_height_noc_for_occupancycertificate" name="building_height_noc_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_SIX}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_SIX);">
                            <div class="error-message error-message-occupancycertificate-building_height_noc_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="building_height_noc_name_container_for_occupancycertificate" style="display: none;">
                            <label>14.1 Final NOC from Coast Guard Authority for building height.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="building_height_noc_download"><label id="building_height_noc_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="building_height_noc" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_SIX}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_SIX);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>



                <div class="row">
                    <div  class="fire_noc_item_container_for_occupancycertificate" style="display: none;">
                   <div class="form-group col-sm-12">
                           <label>15. Final NOC from Department of Fire & Emergency Services ?</label>&nbsp;
                            <input type="radio" id="is_fire_noc_yes" name="is_fire_noc" class="" value="{{VALUE_ONE}}">&nbsp; Yes
                            &emsp;
                            <input type="radio" id="is_fire_noc_no" name="is_fire_noc" class="" style="margin-bottom: 0px;"
                                        value="{{VALUE_TWO}}" checked="">&nbsp;No
                            <span class="error-message error-message-occupancycertificate-is_fire_noc"></span>
                        </div>

                        <div class="fire_noc_div" style="display: none;">
                        <div class="col-12 m-b-5px" id="fire_noc_container_for_occupancycertificate" >
                            <label>15. Final NOC from Department of Fire & Emergency Services <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="fire_noc_for_occupancycertificate" name="fire_noc_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_SEVEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_SEVEN);">
                            <div class="error-message error-message-occupancycertificate-fire_noc_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="fire_noc_name_container_for_occupancycertificate" style="display: none;">
                            <label>15.1 Final NOC from Department of Fire & Emergency Services<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="fire_noc_download"><label id="fire_noc_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="fire_noc" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_SEVEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_SEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div> 
                </div>    

                    
                <div class="row">
                    <div  class="copy_of_water_harvesting_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="copy_of_water_harvesting_container_for_occupancycertificate">

                            <label class="dnh_for_oc_div" style="display: none">13. Photo copy of installed Rain water harvesting system<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label>
                            <label class="dd_for_oc_div">16. Photo copy of installed Rain water harvesting system. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="copy_of_water_harvesting_for_occupancycertificate" name="copy_of_water_harvesting_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_EIGHT}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_EIGHT);">
                            <div class="error-message error-message-occupancycertificate-copy_of_water_harvesting_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="copy_of_water_harvesting_name_container_for_occupancycertificate" style="display: none;">
                            <label class="dnh_for_oc_div" style="display: none">13. Photo copy of installed Rain water harvesting system<span style="color: red;">* </span></label>
                            <label class="dd_for_oc_div">16.1 Photo copy of installed Rain water harvesting system. <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="copy_of_water_harvesting_download"><label id="copy_of_water_harvesting_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="copy_of_water_harvesting" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_EIGHT}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_EIGHT);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>


                <div class="row">
                    <div  class="existing_building_plan_item_container_for_occupancycertificate" style="display: none;">
                   <div class="form-group col-sm-12">
                            <label>17. If the building constructed as per approved building plan ?  <span style="color: red;">* </span>&emsp;</label>
                            <input type="radio" id="is_existing_building_plan_yes" name="is_existing_building_plan" class="" value="{{VALUE_ONE}}" checked="">&nbsp; Yes
                            &emsp;
                            <input type="radio" id="is_existing_building_plan_no" name="is_existing_building_plan" class="" style="margin-bottom: 0px;"
                                        value="{{VALUE_TWO}}"> No
                            <br><span class="error-message error-message-occupancycertificate-is_existing_building_plan"></span>
                        </div>
                        <div class="existing_building_plan_div" style="display: none;">
                        <div class="col-12 m-b-5px" id="existing_building_plan_container_for_occupancycertificate">
                            <label>17.1 Existing building plan as per the actual construction carried out, if there is minor deviation from the approval plan.(if applicable)<span style="color: red;">* <br>(Maximum File Size: 25MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="existing_building_plan_for_occupancycertificate" name="existing_building_plan_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_NINE}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_NINE);">
                            <div class="error-message error-message-occupancycertificate-existing_building_plan_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="existing_building_plan_name_container_for_occupancycertificate" style="display: none;">
                            <label>17.1 Existing building plan as per the actual construction carried out, if there is minor deviation from the approval plan.(if applicable)<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="existing_building_plan_download"><label id="existing_building_plan_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="existing_building_plan" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_NINE}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_NINE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div> 
                </div>  


                <div class="row">
                     <div  class="form_of_indemnity_item_container_for_occupancycertificate" style="display: none;">
                   <div class="form-group col-sm-12">
                    <label class="dnh_for_oc_div" style="display: none">14. Form of Indemnity On Stamp paper of Rs. 20/- ?.<span style="color: red;">*</span></label>
                            <label class="dd_for_oc_div">18. Form of Indemnity On Stamp paper of Rs. 20/- ? <span style="color: red;">* </span>&emsp;</label>
                           <input type="radio" id="is_form_of_indemnity_yes" name="is_form_of_indemnity" class="" value="{{VALUE_ONE}}">&nbsp; Yes
                            &emsp;
                            <input type="radio" id="is_form_of_indemnity_no" name="is_form_of_indemnity" class="" style="margin-bottom: 0px;"
                                        value="{{VALUE_TWO}}" checked=""> No
                            <br><span class="error-message error-message-occupancycertificate-is_form_of_indemnity"></span>
                        </div>
                        <div class="form_of_indemnity_div" style="display: none;">
                        <div class="col-12 m-b-5px" id="form_of_indemnity_container_for_occupancycertificate">
                            <label class="dnh_for_oc_div" style="display: none">14. Form of Indemnity On Stamp paper of Rs. 20/- ?.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label>
                            <label class="dd_for_oc_div">18.1 Form of Indemnity On Stamp paper of Rs. 20/- (if application is for Part Occupancy).<a href="documents/departments/PDA/Annexure - 16.pdf" download>(Download Formate of  Annexure -16)</a>  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="form_of_indemnity_for_occupancycertificate" name="form_of_indemnity_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_TEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_TEN);">
                            <div class="error-message error-message-occupancycertificate-form_of_indemnity_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="form_of_indemnity_name_container_for_occupancycertificate" style="display: none;">
                             <label class="dnh_for_oc_div">14. Form of Indemnity On Stamp paper of Rs. 20/- ? <span style="color: red;">* </span>&emsp;</label>
                            <label class="dd_for_oc_div">18.1 Form of Indemnity On Stamp paper of Rs. 20/- (if application is for Part Occupancy).  <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="form_of_indemnity_download"><label id="form_of_indemnity_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="form_of_indemnity" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_TEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_TEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div> 
                </div> 

                 <div class="row">
                    <div  class="annexure_14_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="annexure_14_container_for_occupancycertificate">
                            <label >15.  Architect’s Completion Certificate. Annexure -14.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="annexure_14_for_occupancycertificate" name="annexure_14_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_ONE);">
                            <div class="error-message error-message-occupancycertificate-annexure_14_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="annexure_14_name_container_for_occupancycertificate" style="display: none;">
                            <label >15.1 Architect’s Completion Certificate. Annexure -14.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="annexure_14_download"><label id="annexure_14_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="annexure_14" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                  <div class="row">
                    <div  class="oc_part_oc_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="oc_part_oc_container_for_occupancycertificate">
                            <label >16.  Application to the Authority for obtaining full OC/ Part OC.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="oc_part_oc_for_occupancycertificate" name="oc_part_oc_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_TWO);">
                            <div class="error-message error-message-occupancycertificate-oc_part_oc_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="oc_part_oc_name_container_for_occupancycertificate" style="display: none;">
                            <label >16.1 Application to the Authority for obtaining full OC/ Part OC.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="oc_part_oc_download"><label id="oc_part_oc_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="oc_part_oc" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                  <div class="row">
                    <div  class="fire_emergency_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="fire_emergency_container_for_occupancycertificate">
                            <label >17. Final NOC from Department of Fire & Emergency Services.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="fire_emergency_for_occupancycertificate" name="fire_emergency_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_ELEVEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_ELEVEN);">
                            <div class="error-message error-message-occupancycertificate-fire_emergency_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="fire_emergency_name_container_for_occupancycertificate" style="display: none;">
                            <label >17.1 Final NOC from Department of Fire & Emergency Services.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="fire_emergency_download"><label id="fire_emergency_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="fire_emergency" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_ELEVEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_ELEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                <div class="row">
                    <div  class="building_plan_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="building_plan_container_for_occupancycertificate">
                            <label >18. If the building constructed as per approved building plan?<span style="color: red;">* <br>(Maximum File Size: 25MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="building_plan_for_occupancycertificate" name="building_plan_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_TWELVE}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_TWELVE);">
                            <div class="error-message error-message-occupancycertificate-building_plan_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="building_plan_name_container_for_occupancycertificate" style="display: none;">
                            <label >18.1 If the building constructed as per approved building plan?<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="building_plan_download"><label id="building_plan_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="building_plan" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_TWELVE}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_TWELVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                <div class="row">
                    <div  class="stability_certificate_dnh_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="stability_certificate_dnh_container_for_occupancycertificate">
                            <label >19. Structural Stability Certificate Issued by Engineer (Annexture-15) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="stability_certificate_dnh_for_occupancycertificate" name="stability_certificate_dnh_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_THIRTEEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_THIRTEEN);">
                            <div class="error-message error-message-occupancycertificate-stability_certificate_dnh_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="stability_certificate_dnh_name_container_for_occupancycertificate" style="display: none;">
                            <label >19.1 Structural Stability Certificate Issued by Engineer (Annexture-15) <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="stability_certificate_dnh_download"><label id="stability_certificate_dnh_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_THIRTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="stability_certificate_dnh" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_THIRTEEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_THIRTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

            <div class="row">
                 <div  class="occupancy_certificate_dnh_item_container_for_occupancycertificate" style="display: none;">
                   <div class="form-group col-sm-12">
                        <label>20. Occupancy Certificate if any granted earlier (Xerox copy)</label>&nbsp;
                         <input type="radio" id="is_occupancy_certificate_dnh_yes" name="is_occupancy_certificate_dnh" class="" value="{{VALUE_ONE}}">&nbsp; Yes
                            &emsp;
                            <input type="radio" id="is_occupancy_certificate_dnh_no" name="is_occupancy_certificate_dnh" class="" style="margin-bottom: 0px;"
                                        value="{{VALUE_TWO}}" checked="">&nbsp;No
                            <span class="error-message error-message-occupancycertificate-is_occupancy_certificate_dnh"></span>
                        </div>

                        <div class="occupancy_certificate_dnh_div" style="display: none;">
                        <div class="col-12 m-b-5px" id="occupancy_certificate_dnh_container_for_occupancycertificate" >
                            <label>20. Occupancy Certificate  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="occupancy_certificate_dnh_for_occupancycertificate" name="occupancy_certificate_dnh_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_FOURTEEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_FOURTEEN);">
                            <div class="error-message error-message-occupancycertificate-occupancy_certificate_dnh_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="occupancy_certificate_dnh_name_container_for_occupancycertificate" style="display: none;">
                            <label>20.1 Occupancy Certificate  <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="occupancy_certificate_dnh_download"><label id="occupancy_certificate_dnh_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_FOURTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="occupancy_certificate_dnh" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_FOURTEEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_FOURTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div> 
            </div>


                       
           

            <div class="row">
                    <div  class="existing_cp_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="existing_cp_container_for_occupancycertificate">
                            <label >21. Existing CP orders granted earlier  (Xerox copy)  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="existing_cp_for_occupancycertificate" name="existing_cp_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_FIFTEEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_FIFTEEN);">
                            <div class="error-message error-message-occupancycertificate-existing_cp_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="existing_cp_name_container_for_occupancycertificate" style="display: none;">
                            <label >21.1 Existing CP orders granted earlier <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="existing_cp_download"><label id="existing_cp_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_FIFTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="existing_cp" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_FIFTEEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_FIFTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIFTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                    <div class="row">
                    <div  class="labour_cess_certificate_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="labour_cess_certificate_container_for_occupancycertificate">
                            <label >22. Copy of Labour Cess certificate  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="labour_cess_certificate_for_occupancycertificate" name="labour_cess_certificate_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_SIXTEEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_SIXTEEN);">
                            <div class="error-message error-message-occupancycertificate-labour_cess_certificate_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="labour_cess_certificate_name_container_for_occupancycertificate" style="display: none;">
                            <label >22.1 Copy of Labour Cess certificate <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="labour_cess_certificate_download"><label id="labour_cess_certificate_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_SIXTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="labour_cess_certificate" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_SIXTEEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_SIXTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>
               

                <div class="row">
                    <div  class="valuation_certificate_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="valuation_certificate_container_for_occupancycertificate">
                            <label >23. Copy of Valuation Certificate from Govt. Approved Valuer.   <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="valuation_certificate_for_occupancycertificate" name="valuation_certificate_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_SEVENTEEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_SEVENTEEN);">
                            <div class="error-message error-message-occupancycertificate-valuation_certificate_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="valuation_certificate_name_container_for_occupancycertificate" style="display: none;">
                            <label >23.1 Copy of Valuation Certificate from Govt. Approved Valuer.  <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="valuation_certificate_download"><label id="valuation_certificate_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_SEVENTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="valuation_certificate" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_SEVENTEEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_SEVENTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVENTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                  <div class="row">
                    <div  class="bank_deposit_sleep_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="bank_deposit_sleep_container_for_occupancycertificate">
                            <label >24. Bank Deposit Sleep indicates deposit of Labour Cess amount in Govt. Account, Dena Bank, Silvassa Branch with signature and stamp of approval of Assistant Engineer, PWD/Building Inspector, DNH.   <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="bank_deposit_sleep_for_occupancycertificate" name="bank_deposit_sleep_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_EIGHTEEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_EIGHTEEN);">
                            <div class="error-message error-message-occupancycertificate-bank_deposit_sleep_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="bank_deposit_sleep_name_container_for_occupancycertificate" style="display: none;">
                            <label >24.1 Bank Deposit Sleep indicates deposit of Labour Cess amount in Govt. Account, Dena Bank, Silvassa Branch with signature and stamp of approval of Assistant Engineer, PWD/Building Inspector, DNH.  <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="bank_deposit_sleep_download"><label id="bank_deposit_sleep_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_EIGHTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="bank_deposit_sleep" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_EIGHTEEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_EIGHTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                 <div class="row">
                    <div  class="deviation_photographs_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="deviation_photographs_container_for_occupancycertificate">
                            <label >25. Submit existing building Plans copy with any type of deviation with Photographs.   <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="deviation_photographs_for_occupancycertificate" name="deviation_photographs_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_NINETEEN}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_NINETEEN);">
                            <div class="error-message error-message-occupancycertificate-deviation_photographs_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="deviation_photographs_name_container_for_occupancycertificate" style="display: none;">
                            <label >25.1 Submit existing building Plans copy with any type of deviation with Photographs. <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="deviation_photographs_download"><label id="deviation_photographs_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_NINETEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="deviation_photographs" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_NINETEEN}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_NINETEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINETEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>


                 <div class="row">
                    <div  class="copy_7_12_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="copy_7_12_container_for_occupancycertificate">
                            <label >26. 7 x 12 (Original)   <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="copy_7_12_for_occupancycertificate" name="copy_7_12_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_TWENTY}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_TWENTY);">
                            <div class="error-message error-message-occupancycertificate-copy_7_12_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="copy_7_12_name_container_for_occupancycertificate" style="display: none;">
                            <label >26.1 7 x 12 (Original) <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="copy_7_12_download"><label id="copy_7_12_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_TWENTY}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="copy_7_12" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_TWENTY}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_TWENTY);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTY}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                   <div class="row">
                    <div  class="certificate_map_item_container_for_occupancycertificate" style="display: none;">
                        <div class="col-12 m-b-5px" id="certificate_map_container_for_occupancycertificate">
                            <label >27. Certified Map (Original)   <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="certificate_map_for_occupancycertificate" name="certificate_map_for_occupancycertificate" class="spinner_container_for_occupancycertificate_{{VALUE_TWENTYONE}}"
                                   accept="application/pdf" onchange="OccupancyCertificate.listview.uploadDocumentForOccupancyCertificate(VALUE_TWENTYONE);">
                            <div class="error-message error-message-occupancycertificate-certificate_map_for_occupancycertificate"></div>
                        </div>
                        <div class="form-group col-sm-12" id="certificate_map_name_container_for_occupancycertificate" style="display: none;">
                            <label >27.1 Certified Map (Original) <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="certificate_map_download"><label id="certificate_map_name_image_for_occupancycertificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_occupancycertificate_{{VALUE_TWENTYONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="certificate_map" class="btn btn-sm btn-danger spinner_name_container_for_occupancycertificate_{{VALUE_TWENTYONE}}" style="vertical-align: top;"
                                    onclick="OccupancyCertificate.listview.askForRemove('{{occupancycertificate_data.occupancy_certificate_id}}', VALUE_TWENTYONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>

                    <hr class="m-b-1rem"> 
                    <div class="form-group">
                        <button type="button" id="draft_btn_for_occupancycertificate" class="btn btn-sm btn-nic-blue" onclick="OccupancyCertificate.listview.submitOccupancyCertificate({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button>
                        <button type="button" id="submit_btn_for_occupancycertificate" class="btn btn-sm btn-success" onclick="OccupancyCertificate.listview.askForSubmitOccupancyCertificate({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="OccupancyCertificate.listview.loadOccupancyCertificateData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>