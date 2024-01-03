<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">Construction Permission</h3>
                <h3 class="card-title" style="float: none; text-align: center;"> (Annexure - 2) </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application for Development work, to erect, re-erect or to make alteration in any place in a building and for organized development/layouts or subdivison of land. </div>
            </div>
            <form role="form" id="construction_form" name="construction_form" onsubmit="return false;">

                <input type="hidden" id="construction_id" name="construction_id" value="{{construction_data.construction_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            To,<br>
                            The Competent Authority,<br>
                            UT Administration of Dadra and Nagar Haveli & Daman and Diu,<br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. District <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select id="district" name="district" class="form-control select2"
                                        data-placeholder="Select District" onchange="Construction.listview.getDepartmentdata(this);" style="width: 100%;">
                                </select>
                            </div>
                            <span class="error-message error-message-construction-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('construction', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-construction-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Name of the Owner/Authorized Person <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_owner" name="name_of_owner" class="form-control" placeholder="Enter Name of Owner/Authorized Person !" maxlength="100" onblur="checkValidation('construction', 'name_of_owner', ownerNameValidationMessage);" value="{{construction_data.name_of_owner}}">
                            </div>
                            <span class="error-message error-message-construction-name_of_owner"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>3. Address of the Owner/Authorized Person <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="address_of_owner" name="address_of_owner" class="form-control" placeholder="Enter Address of Owner/Authorized Person !" maxlength="100" value="{{construction_data.address_of_owner}}" onblur="checkValidation('construction', 'address_of_owner', owneraddressMessage);">
                            </div>
                            <span class="error-message error-message-construction-address_of_owner"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>4. Survey No <span class="color-nic-red"></span></label>
                            <div class="input-group">
                                <input type="text" id="building_no" name="building_no" class="form-control" placeholder="Enter Survey No !"maxlength="100" value="{{construction_data.building_no}}">
                            </div>
                            <span class="error-message error-message-construction-building_no"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>5. Plot No <span class="color-nic-red"></span></label>
                            <div class="input-group">
                                <input type="text" id="plot_no" name="plot_no" class="form-control" placeholder="Enter Plot No !" maxlength="100" value="{{construction_data.plot_no}}" >
                            </div>
                            <span class="error-message error-message-construction-plot_no"></span>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>6. Village <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="village" name="village" class="form-control" placeholder="Enter Village !" maxlength="100" value="{{construction_data.village}}" onblur="checkValidation('construction', 'village', villageValidationMessage);">
                            </div>
                            <span class="error-message error-message-construction-village"></span>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7. Name of Architect/Engineer <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name of Architect / Engineer !"
                                       maxlength="100" onblur="checkValidation('construction', 'name', architectNameValidationMessage);" value="{{construction_data.name}}">
                            </div>
                            <span class="error-message error-message-construction-name"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8. Architect/Engineer/Structural License No.</label>
                            <div class="input-group">
                                <input type="text" id="license_no" name="license_no" class="form-control" placeholder=" Enter Architect/ Engineer /Structural License No !" maxlength="100" value="{{construction_data.license_no}}">
                            </div>
                            <span class="error-message error-message-construction-license_no"></span>
                        </div>
                    </div>

                    <div class="row">

                         <div class="form-group col-sm-6">
                            <label>9. Architect/Engineer/Structural License valid upto </label>
                            <div class="input-group date date_picker">
                                <input type="text" class="form-control date_picker" name="valid_upto_date" id="valid_upto_date" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY"
                                       value="{{valid_upto_date}}">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-construction-valid_upto_date"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>10. Date of Application<span style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="text" class= "form-control" placeholder="dd-mm-yyyy"
                                       value="{{application_date}}" readonly="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-construction-application_date"></span>
                        </div>
                       
                    </div>

                    <br/>
                    <h2 class="box-title f-w-b page-header f-s-20px m-b-0" >Document Required to be Uploaded with the Application</h2>
                    <br/>

                <div class="row">
                    <div  class="annexure_III_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="annexure_III_container_for_construction">
                            <label class="dnh_for_cp_div" style="display: none">11. Annexure (2 to 6 to be furnished by the Applicant/Architect/Structural Engineer) (Annexure 6 on Rs. 20/- Stamp Paper only).<span style="color: red;">* <br>(Maximum File Size: 25MB) &nbsp; (Upload PDF Only)</span></label>
                            <label class="dd_for_cp_div" style="display: none">11. Annexure III.  <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="annexure_III_for_construction" name="annexure_III_for_construction" class="spinner_container_for_construction_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_ONE);">
                            <div class="error-message error-message-construction-annexure_III_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="annexure_III_name_container_for_construction" style="display: none;">
                            <label class="dnh_for_cp_div">11.1 Annexure.<span style="color: red;">* </span></label>
                            <label class="dd_for_cp_div" style="display: none">11.1 Annexure III.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="annexure_III_download"><label id="annexure_III_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="annexure_III" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>



                <div class="row">
                    <div  class="annexure_IV_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="annexure_IV_container_for_construction">
                            <label>12. Annexure IV.  <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="annexure_IV_for_construction" name="annexure_IV_for_construction" class="spinner_container_for_construction_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_TWO);">
                            <div class="error-message error-message-construction-annexure_IV_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="annexure_IV_name_container_for_construction" style="display: none;">
                            <label>12.1 Annexure IV .<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="annexure_IV_download"><label id="annexure_IV_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="annexure_IV" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>


                <div class="row">
                    <div  class="copy_of_na_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="copy_of_na_container_for_construction">
                            <label class="dnh_for_cp_div" style="display: none">12. N.A Order (Xerox copy)/ [ if Gaonthan Plot (only 7 x 12)]<span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label>

                            <label class="dd_for_cp_div">13. Copy of N.A. Sanad /Order/ Property card for existing Gaothan area. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label><br>
                            <input type="file" id="copy_of_na_for_construction" name="copy_of_na_for_construction" class="spinner_container_for_construction_{{VALUE_THREE}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_THREE);">
                            <div class="error-message error-message-construction-copy_of_na_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="copy_of_na_name_container_for_construction" style="display: none;">
                            <label class="dnh_for_cp_div" style="display: none">12.1  N.A Order <span style="color: red;">* </span></label>
                            <label class="dd_for_cp_div" style="display: none">13.1  Copy of N.A. <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="copy_of_na_download"><label id="copy_of_na_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="copy_of_na" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>



                <div class="row">
                    <div  class="original_certified_map_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="original_certified_map_container_for_construction">
                             <label class="dnh_for_cp_div" style="display: none">13. Certified Map (Original)<span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label>
                            <label class="dd_for_cp_div">14. Original certified Map of Survey/Plot no. issued by City Survey office, Daman. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label><br>
                            <input type="file" id="original_certified_map_for_construction" name="original_certified_map_for_construction" class="spinner_container_for_construction_{{VALUE_FOUR}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_FOUR);">
                            <div class="error-message error-message-construction-original_certified_map_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="original_certified_map_name_container_for_construction" style="display: none;">
                            <label class="dnh_for_cp_div" style="display: none">13.1 Certified Map. <span style="color: red;">* </span></label>
                            <label class="dd_for_cp_div">14.1 Original certified Map of Survey/Plot no. <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="original_certified_map_download"><label id="original_certified_map_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="original_certified_map" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>



                <div class="row">
                    <div  class="I_and_XIV_nakal_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="I_and_XIV_nakal_container_for_construction">
                            
                             <label class="dnh_for_cp_div" style="display: none">14. 7x12 Nakal of land (original) <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label>
                            <label class="dd_for_cp_div">15. Copy of RoR (I and XIV nakal Copy or 7/12 extract Copy). <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label><br>
                            <input type="file" id="I_and_XIV_nakal_for_construction" name="I_and_XIV_nakal_for_construction" class="spinner_container_for_construction_{{VALUE_FIVE}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_FIVE);">
                            <div class="error-message error-message-construction-I_and_XIV_nakal_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="I_and_XIV_nakal_name_container_for_construction" style="display: none;">
                            <label class="dnh_for_cp_div" style="display: none">14.1 7x12 Nakal of land. <span style="color: red;">* </span></label>
                            <label class="dd_for_cp_div">15.1 Copy of RoR (I and XIV nakal Copy or 7/12 extract Copy). <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="I_and_XIV_nakal_download"><label id="I_and_XIV_nakal_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="I_and_XIV_nakal" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_FIVE}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_FIVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>


                <div class="row">
                        <div  class="building_plan_dcr_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="building_plan_dcr_container_for_construction">
                            <label class="dnh_for_cp_div" style="display: none">15. Building Plan (Proposed) <span style="color: red;">* <br>(Maximum File Size: 25MB) &nbsp;(Upload pdf Only)</span></label>

                            <label class="dd_for_cp_div">16. Building Plan with complete details as per Rule 6.7 to 6.12 of DCR 2005 (Building plan shall also include Key Plan/Location plan, Site plan and Service plan.)  <span style="color: red;">* <br>(Maximum File Size: 25MB) &nbsp;(Upload pdf Only)</span></label><br>
                            <input type="file" id="building_plan_dcr_for_construction" name="building_plan_dcr_for_construction" class="spinner_container_for_construction_{{VALUE_SIX}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_SIX);">
                            <div class="error-message error-message-construction-building_plan_dcr_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="building_plan_dcr_name_container_for_construction" style="display: none;">
                            <label class="dnh_for_cp_div" style="display: none">15.1 Building Plan <span style="color: red;">* </span></label>
                            <label class="dd_for_cp_div">16.1 Building Plan <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="building_plan_dcr_download"><label id="building_plan_dcr_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="building_plan_dcr" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_SIX}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_SIX);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>


                <div class="row">
                    <div  class="cost_estimate_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="cost_estimate_container_for_construction">
                            <label>17. Cost Estimate for the proposed building from the Registered Architect/engineer. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label><br>
                            <input type="file" id="cost_estimate_for_construction" name="cost_estimate_for_construction" class="spinner_container_for_construction_{{VALUE_SEVEN}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_SEVEN);">
                            <div class="error-message error-message-construction-cost_estimate_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="cost_estimate_name_container_for_construction" style="display: none;">
                            <label>17.1 Cost Estimate.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="cost_estimate_download"><label id="cost_estimate_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="cost_estimate" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_SEVEN}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_SEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>



                <div class="row">
                     <div  class="noc_coast_guard_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="noc_coast_guard_container_for_construction">
                            <label>18. NOC of the coast Guard Authority for Height Restriction/ Receive copy of application made for issuance of NOC to Coast Guard Authority. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label><br>
                            <input type="file" id="noc_coast_guard_for_construction" name="noc_coast_guard_for_construction" class="spinner_container_for_construction_{{VALUE_EIGHT}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_EIGHT);">
                            <div class="error-message error-message-construction-noc_coast_guard_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="noc_coast_guard_name_container_for_construction" style="display: none;">
                            <label>18.1 NOC of the coast Guard Authority.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="noc_coast_guard_download"><label id="noc_coast_guard_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="noc_coast_guard" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_EIGHT}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_EIGHT);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>



                <div class="row">
                    <div  class="annexure_V_item_container_for_construction" style="display: none;"> 
                        <div class="form-group col-sm-12">
                            <label>19. Annexure V (Whether the building is high rise). <a href="<?= base_url(); ?>documents/construction/annexure-5.doc">(Download Format of  Annexure V )</a> </label>
                            <input type="radio" id="annexureV_yes" name="annexureV" value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="annexureV_no" name="annexureV" value="{{IS_CHECKED_NO}}"  checked=""> No
                            <br><span class="error-message error-message-construction-annexureV"></span>
                        </div>
                        <div class="annexureV_div" style="display: none;">
                            <div class="col-12 m-b-5px" id="annexure_V_container_for_construction">
                                <label>19 Annexure V. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label><br>
                                <input type="file" id="annexure_V_for_construction" name="annexure_V_for_construction" class="spinner_container_for_construction_{{VALUE_NINE}}"
                                       accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_NINE);">
                                <div class="error-message error-message-construction-annexure_V_for_construction"></div>
                            </div>
                            <div class="form-group col-sm-12" id="annexure_V_name_container_for_construction" style="display: none;">
                                <label>19.1 Annexure V.</label><br>
                                <a target="_blank" id="annexure_V_download"><label id="annexure_V_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="annexure_V" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_NINE}}" style="vertical-align: top;"
                                        onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_NINE);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div  class="annexureVI_item_container_for_construction" style="display: none;">
                        <div class="form-group col-sm-12">
                            <label>20. Annexure VI   </label>
                            <input type="radio" id="annexureVI_yes" name="annexureVI" value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="annexureVI_no" name="annexureVI" value="{{IS_CHECKED_NO}}"  checked=""> No
                            <br><span class="error-message error-message-construction-annexureVI"></span>
                        </div>
                        <div class="annexureVI_div" style="display: none;">
                            <div class="col-12 m-b-5px" id="annexure_VI_container_for_construction">
                                <label>20.1 Annexure VI. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label><br>
                                <input type="file" id="annexure_VI_for_construction" name="annexure_VI_for_construction" class="spinner_container_for_construction_{{VALUE_SEVENTEEN}}"
                                       accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_SEVENTEEN);">
                                <div class="error-message error-message-construction-annexure_VI_for_construction"></div>
                            </div>
                            <div class="form-group col-sm-12" id="annexure_VI_name_container_for_construction" style="display: none;">
                                <label>20.1 Annexure VI.</label><br>
                                <a target="_blank" id="annexure_VI_download"><label id="annexure_VI_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_SEVENTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="annexure_VI" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_SEVENTEEN}}" style="vertical-align: top;"
                                        onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_SEVENTEEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVENTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div  class="layout_plan_item_container_for_construction" style="display: none;">
                        <div class="form-group col-sm-12">

                             <label class="dnh_for_cp_div" style="display: none">16. Completion Certificate of the layout (Xerox copy).<span class="color-nic-red">*</span></label>

                            <label class="dd_for_cp_div">21. If part of a Private Industrial Estate,  a certificate of completion of Development work as per approval layout plan or singed statement on company’s letterhead that it is not applicable.    </label>
                            <input type="radio" id="layoutplan_yes" name="layoutplan" value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="layoutplan_no" name="layoutplan" value="{{IS_CHECKED_NO}}"  checked=""> No
                            <br><span class="error-message error-message-construction-layoutplan"></span>
                        </div>
                        <div class="layoutplan_div" style="display: none;">
                            <div class="col-12 m-b-5px" id="layout_plan_container_for_construction">
                                 <label class="dnh_for_cp_div" style="display: none">16.1 Completion Certificate of the layout.<span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label>

                                <label class="dd_for_cp_div">21.1 Certificate of completion of Development work as per approval layout plan or singed statement on company’s letterhead that it is not applicable. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp;(Upload pdf Only)</span></label><br>
                                <input type="file" id="layout_plan_for_construction" name="layout_plan_for_construction" class="spinner_container_for_construction_{{VALUE_EIGHTEEN}}"
                                       accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_EIGHTEEN);">
                                <div class="error-message error-message-construction-layout_plan_for_construction"></div>
                            </div>
                            <div class="form-group col-sm-12" id="layout_plan_name_container_for_construction" style="display: none;">
                                 <label class="dnh_for_cp_div" style="display: none">16.1 Completion Certificate of the layout (Xerox copy).<span class="color-nic-red">*</span></label>

                                <label class="dd_for_cp_div">21.1 Certificate of completion of Development work as per approval layout plan or singed statement on company’s letterhead that it is not applicable.</label><br>
                                <a target="_blank" id="layout_plan_download"><label id="layout_plan_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_EIGHTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="layout_plan" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_EIGHTEEN}}" style="vertical-align: top;"
                                        onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_EIGHTEEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div  class="provisional_noc_fire_item_container_for_construction" style="display: none;">
                        <div class="form-group col-sm-12">
                           <!--  <label class="dnh_for_cp_div" style="display: none">17.Provisional NOC from Fire Department (Applicable to all building except Residential building having height less than 15m). <span class="color-nic-red">*</span></label> -->

                            <label>22. Provisional NOC from Fire Department (Applicable to all building except Residential building having height less than 15m). &emsp;</label>
                            <input type="radio" id="provisional_noc_yes" name="provisional_noc"  
                                   value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="provisional_noc_no" name="provisional_noc" 
                                   value="{{IS_CHECKED_NO}}"  checked=""> No
                            <br><span class="error-message error-message-construction-provisional_noc"></span>
                        </div>
                        <div class="provisional_noc_div" style="display: none;">
                            <div class="col-12 m-b-5px" id="provisional_noc_fire_container_for_construction">
                                <label>22.1 Provisional NOC from Fire Department. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="provisional_noc_fire_for_construction" name="provisional_noc_fire_for_construction" class="spinner_container_for_construction_{{VALUE_TEN}}"
                                       accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_TEN);">
                                <div class="error-message error-message-construction-provisional_noc_fire_for_construction"></div>
                            </div>
                            <div class="form-group col-sm-12" id="provisional_noc_fire_name_container_for_construction" style="display: none;">
                                <label>22.1 Provisional NOC from Fire Department. </label><br>
                                <a target="_blank" id="provisional_noc_fire_download"><label id="provisional_noc_fire_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="provisional_noc_fire" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_TEN}}" style="vertical-align: top;"
                                        onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_TEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div  class="crz_clearance_certificate_item_container_for_construction" style="display: none;">
                        <div class="form-group col-sm-12">
                            <label>23. CRZ clearance certificate of the concerned authority (This is required in case of land falling under CRZ). &emsp;</label>
                            <input type="radio" id="crz_clearance_yes" name="crz_clearance"  
                                   value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="crz_clearance_no" name="crz_clearance" 
                                   value="{{IS_CHECKED_NO}}"  checked=""> No
                            <br><span class="error-message error-message-construction-crz_clearance"></span>
                        </div>
                        <div class="crz_clearance_div" style="display: none;">
                            <div class="col-12 m-b-5px" id="crz_clearance_certificate_container_for_construction">
                                <label>23.1 CRZ clearance certificate of the concerned authority.  <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="crz_clearance_certificate_for_construction" name="crz_clearance_certificate_for_construction" class="spinner_container_for_construction_{{VALUE_ELEVEN}}"
                                       accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_ELEVEN);">
                                <div class="error-message error-message-construction-crz_clearance_certificate_for_construction"></div>
                            </div>
                            <div class="form-group col-sm-12" id="crz_clearance_certificate_name_container_for_construction" style="display: none;">
                                <label>23.1 CRZ clearance certificate of the concerned authority.  </label><br>
                                <a target="_blank" id="crz_clearance_certificate_download"><label id="crz_clearance_certificate_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="crz_clearance_certificate" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_ELEVEN}}" style="vertical-align: top;"
                                        onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_ELEVEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div  class="sub_division_order_item_container_for_construction" style="display: none;">
                        <div class="form-group col-sm-12">
                             <label class="dnh_for_cp_div" style="display: none">17. Copy of Approved Layout (in case of plotted lands, (Industrial Lay- out and Residential cum Commercial Lay-out) (Xerox copy). <span class="color-nic-red">*</span></label>

                            <label class="dd_for_cp_div">24. True copy of approved layout plan and Sub division order (This is applicable if land is part of private Industrial Estate/ Private sub division). &emsp;</label>
                            <input type="radio" id="sub_division_yes" name="sub_division"  
                                   value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="sub_division_no" name="sub_division" 
                                   value="{{IS_CHECKED_NO}}"  checked=""> No
                            <br><span class="error-message error-message-construction-sub_division"></span>
                        </div>
                        <div class="sub_division_div" style="display: none;">
                            <div class="col-12 m-b-5px" id="sub_division_order_container_for_construction">
                                 <label class="dnh_for_cp_div" style="display: none">17.1 Copy of Approved Layout.  <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label>

                                <label class="dd_for_cp_div">24.1 True copy of approved layout plan. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="sub_division_order_for_construction" name="sub_division_order_for_construction" class="spinner_container_for_construction_{{VALUE_TWELVE}}"
                                       accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_TWELVE);">
                                <div class="error-message error-message-construction-sub_division_order_for_construction"></div>
                            </div>
                            <div class="form-group col-sm-12" id="sub_division_order_name_container_for_construction" style="display: none;">
                                <label class="dnh_for_cp_div" style="display: none">17.1 Copy of Approved Layout <span class="color-nic-red">*</span></label>

                                <label class="dd_for_cp_div">24.1 True copy of approved layout plan. </label><br>
                                <a target="_blank" id="sub_division_order_download"><label id="sub_division_order_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="sub_division_order" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_TWELVE}}" style="vertical-align: top;"
                                        onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_TWELVE);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div  class="amalgamation_order_item_container_for_construction" style="display: none;">
                        <div class="form-group col-sm-12">
                            <label>25. Copy of the amalgamation order, if relevant. &emsp;</label>
                            <input type="radio" id="amalgamation_yes" name="amalgamation"  
                                   value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="amalgamation_no" name="amalgamation" 
                                   value="{{IS_CHECKED_NO}}"  checked=""> No
                            <br><span class="error-message error-message-construction-amalgamation"></span>
                        </div>
                        <div class="amalgamation_div" style="display: none;">
                            <div class="col-12 m-b-5px" id="amalgamation_order_container_for_construction">
                                <label>25.1 Copy of the amalgamation order. <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="amalgamation_order_for_construction" name="amalgamation_order_for_construction" class="spinner_container_for_construction_{{VALUE_THIRTEEN}}"
                                       accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_THIRTEEN);">
                                <div class="error-message error-message-construction-amalgamation_order_for_construction"></div>
                            </div>
                            <div class="form-group col-sm-12" id="amalgamation_order_name_container_for_construction" style="display: none;">
                                <label>25.1 Copy of the amalgamation order. </label><br>
                                <a target="_blank" id="amalgamation_order_download"><label id="amalgamation_order_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_THIRTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="amalgamation_order" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_THIRTEEN}}" style="vertical-align: top;"
                                        onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_THIRTEEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div  class="occupancy_certificate_item_container_for_construction" style="display: none;">
                        <div class="form-group col-sm-12">
                            <label class="dnh_for_cp_div" style="display: none">18. Copy of approved plan, Construction Permission Oder and Occupancy Certificate (in case of Revised Proposal) (Xerox copy). <span class="color-nic-red">*</span></label>
                            <label class="dd_for_cp_div">26. If application is for revised plan/additional and alteration to the existing building, then true copy of the construction permission along with approved plan and Occupancy Certificate is required. &emsp;</label>
                            <input type="radio" id="occupancy_yes" name="occupancy" value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="occupancy_no" name="occupancy" value="{{IS_CHECKED_NO}}"  checked=""> No
                            <br><span class="error-message error-message-construction-occupancy"  checked=""></span>
                        </div>
                        <div class="occupancy_div" style="display: none;">
                            <div class="col-12 m-b-5px" id="occupancy_certificate_container_for_construction">
                                <label class="dnh_for_cp_div" style="display: none">18.1 Copy of approved plan, Construction Permission Oder and Occupancy Certificate <span style="color: red;">* <br>(Maximum File Size: 25MB) &nbsp; (Upload PDF Only)</span></label>

                                <label class="dd_for_cp_div">26.1 Occupancy Certificate. <span style="color: red;">* <br>(Maximum File Size: 25MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="occupancy_certificate_for_construction" name="occupancy_certificate_for_construction" class="spinner_container_for_construction_{{VALUE_FOURTEEN}}"
                                       accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_FOURTEEN);">
                                <div class="error-message error-message-construction-occupancy_certificate_for_construction"></div>
                            </div>
                            <div class="form-group col-sm-12" id="occupancy_certificate_name_container_for_construction" style="display: none;">
                                 <label class="dnh_for_cp_div" style="display: none">18.1 Copy of approved plan, Construction Permission Oder and Occupancy Certificate <span style="color: red;">* </span></label>
                                <label class="dd_for_cp_div">26.1 Occupancy Certificate. </label><br>
                                <a target="_blank" id="occupancy_certificate_download"><label id="occupancy_certificate_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_FOURTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="occupancy_certificate" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_FOURTEEN}}" style="vertical-align: top;"
                                        onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_FOURTEEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div  class="certificate_land_acquisition_item_container_for_construction" style="display: none;">
                        <div class="form-group col-sm-12">
                            <label>27. Certificate or order of the Land Acquisition Officer if claiming benefit of additional FSI in lieu of compensation (If applicable). &emsp;</label>
                            <input type="radio" id="certificate_land_yes" name="certificate_land" value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="certificate_land_no" name="certificate_land" value="{{IS_CHECKED_NO}}"  checked=""> No
                            <br><span class="error-message error-message-construction-certificate_land"></span>
                        </div>
                        <div class="certificate_land_div" style="display: none;">
                            <div class="col-12 m-b-5px" id="certificate_land_acquisition_container_for_construction">
                                <label>27.1 Certificate or order of the Land Acquisition.  <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="certificate_land_acquisition_for_construction" name="certificate_land_acquisition_for_construction" class="spinner_container_for_construction_{{VALUE_FIFTEEN}}"
                                       accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_FIFTEEN);">
                                <div class="error-message error-message-construction-certificate_land_acquisition_for_construction"></div>
                            </div>
                            <div class="form-group col-sm-12" id="certificate_land_acquisition_name_container_for_construction" style="display: none;">
                                <label>27.1 Certificate or order of the Land Acquisition.  </label><br>
                                <a target="_blank" id="certificate_land_acquisition_download"><label id="certificate_land_acquisition_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_FIFTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="certificate_land_acquisition" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_FIFTEEN}}" style="vertical-align: top;"
                                        onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_FIFTEEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIFTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>  
                </div>   


            <div class="row">
                    <div  class="seal_and_stamp_item_container_for_construction" style="display: none;">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_construction">
                            <label>28. Signature of Owner <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_construction" name="seal_and_stamp_for_construction" class="spinner_container_for_construction_{{VALUE_SIXTEEN}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_SIXTEEN);">
                            <div class="error-message error-message-construction-seal_and_stamp_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_construction" style="display: none;">
                            <label>28. Signature of Owner <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_construction" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_construction_{{VALUE_SIXTEEN}}"></a>
                            <button type="button" id="seal_and_stamp" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_SIXTEEN}}" style="vertical-align: top;" 
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_SIXTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div> 
                </div> 

            <div class="row">
                <div  class="licensed_engineer_signature_item_container_for_construction" style="display: none;">
                        <div class="col-12 m-b-5px" id="licensed_engineer_signature_container_for_construction">
                            <label>29.  Signature of the Licensed Architect / Engineer / Surveyor / Structural Engineer  <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="licensed_engineer_signature_for_construction" name="licensed_engineer_signature_for_construction" class="spinner_container_for_construction_{{VALUE_NINETEEN}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_NINETEEN);">
                            <div class="error-message error-message-construction-licensed_engineer_signature_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="licensed_engineer_signature_name_container_for_construction" style="display: none;">
                            <label>29. Signature of the Licensed Architect / Engineer / Surveyor / Structural Engineer  <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="licensed_engineer_signature_download"><img id="licensed_engineer_signature_name_image_for_construction" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_construction_{{VALUE_NINETEEN}}"></a>
                            <button type="button" id="licensed_engineer_signature" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_NINETEEN}}" style="vertical-align: top;" 
                                    onclick="Construction.listview.askForRemove('{{construction_data.occupancy_certificate_id}}', VALUE_NINETEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINETEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
            </div>

            <div class="row">
                <div  class="labour_cess_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="labour_cess_container_for_construction">
                            <label>19. Labour Cess Certificate issued by RDC(S) (Xerox copy).  <span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="labour_cess_for_construction" name="labour_cess_for_construction" class="spinner_container_for_construction_{{VALUE_TWENTY}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_TWENTY);">
                            <div class="error-message error-message-construction-labour_cess_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="labour_cess_name_container_for_construction" style="display: none;">
                            <label>19.1 Labour Cess Certificate.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="labour_cess_download"><label id="labour_cess_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_TWENTY}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="labour_cess" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_TWENTY}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_TWENTY);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTY}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                </div>
            </div>

            <div class="row">
                <div  class="undertaking_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="undertaking_container_for_construction">
                            <label>20. Undertaking on Rs. 100/- Stamp Paper for Labour Cess<span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="undertaking_for_construction" name="undertaking_for_construction" class="spinner_container_for_construction_{{VALUE_TWENTYONE}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_TWENTYONE);">
                            <div class="error-message error-message-construction-undertaking_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="undertaking_name_container_for_construction" style="display: none;">
                            <label>20.1 Undertaking on Rs. 100/- Stamp Paper for Labour Cess.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="undertaking_download"><label id="undertaking_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_TWENTYONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="undertaking" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_TWENTYONE}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_TWENTYONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                </div>
            </div>

            <div class="row">
                <div  class="fire_noc_item_container_for_construction" style="display: none;"> 
                        <div class="col-12 m-b-5px" id="fire_noc_container_for_construction">
                            <label>21. Provisional NOC from Fire Department (Applicable to all building except Residential building having height less than 15m).<span style="color: red;">* <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="fire_noc_for_construction" name="fire_noc_for_construction" class="spinner_container_for_construction_{{VALUE_TWENTYTWO}}"
                                   accept="application/pdf" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_TWENTYTWO);">
                            <div class="error-message error-message-construction-fire_noc_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="fire_noc_name_container_for_construction" style="display: none;">
                            <label>21.1 Provisional NOC from Fire Department.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="fire_noc_download"><label id="fire_noc_name_image_for_construction" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_construction_{{VALUE_TWENTYTWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="fire_noc" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_TWENTYTWO}}" style="vertical-align: top;"
                                    onclick="Construction.listview.askForRemove('{{construction_data.construction_id}}', VALUE_TWENTYTWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYTWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                </div>
            </div>

               <div class="row">
                <div  class="owner_signature_item_container_for_construction" style="display: none;">
                        <div class="col-12 m-b-5px" id="owner_signature_container_for_construction">
                            <label>22.  Signature of Owner  <span style="color: red;"> <br>(Maximum File Size: 5MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="owner_signature_for_construction" name="owner_signature_for_construction" class="spinner_container_for_construction_{{VALUE_TWENTYTHREE}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="Construction.listview.uploadDocumentForConstruction(VALUE_TWENTYTHREE);">
                            <div class="error-message error-message-construction-owner_signature_for_construction"></div>
                        </div>
                        <div class="form-group col-sm-12" id="owner_signature_name_container_for_construction" style="display: none;">
                            <label>22.1 Signature of Owner </label><br>
                            <a target="_blank" id="owner_signature_download"><img id="owner_signature_name_image_for_construction" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_construction_{{VALUE_TWENTYTHREE}}"></a>
                            <button type="button" id="owner_signature" class="btn btn-sm btn-danger spinner_name_container_for_construction_{{VALUE_TWENTYTHREE}}" style="vertical-align: top;" 
                                    onclick="Construction.listview.askForRemove('{{construction_data.occupancy_certificate_id}}', VALUE_TWENTYTHREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYTHREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
            </div>
                    <hr class="m-b-1rem"> 


                    <div class="form-group">
                        <button type="button" id="draft_btn_for_construction" class="btn btn-sm btn-nic-blue" onclick="Construction.listview.submitConstruction({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button>
                        <button type="button" id="submit_btn_for_construction" class="btn btn-sm btn-success" onclick="Construction.listview.askForSubmitConstruction({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Construction.listview.loadConstructionData();">Close</button>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>