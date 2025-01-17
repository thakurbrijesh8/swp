<div class="row">
   <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Boiler Renewal Application</div>
                
            </div>
            <form role="form" id="boiler_act_renewal_form" name="boiler_act_renewal_form" onsubmit="return false;">
                <input type="hidden" id="boiler_renewal_id" name="boiler_renewal_id" value="{{boilerActRenewal_data.boiler_renewal_id}}">
                <input type="hidden" id="boiler_id" name="boiler_id" value="{{boilerActRenewal_data.boiler_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-boiler-act-renewal f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                            <label>1. District <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="district" name="district" class="form-control select2"
                                    data-placeholder="Select District" style="width: 100%;" >
                            </select>
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('boiler-act-renewal', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Boiler License Number<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="registration_number" name="registration_number" class="form-control" placeholder="Enter Boiler License Number !"
                                       maxlength="100" value="{{boilerActRenewal_data.license_number}}" onblur="BoilerActRenewal.listview.getBoilerActData($(this));checkValidation('boiler-act-renewal', 'registration_number', licenseNumberValidationMessage);">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-registration_number"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>3. Name Of Owner<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="owner_name" name="owner_name" class="form-control" placeholder="Enter Name Of Owner !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'owner_name', ownerNameValidationMessage);" value="{{boilerActRenewal_data.owner_name}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-owner_name"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4. Situation of Boiler<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="situation_of_boiler" name="situation_of_boiler" class="form-control" placeholder="Enter Situation of Boiler !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'situation_of_boiler', boilerSituationValidationMessage);" value="{{boilerActRenewal_data.situation_of_boiler}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-situation_of_boiler"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Boiler Type<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="boiler_type" name="boiler_type" class="form-control" placeholder="Enter Boiler Type !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'boiler_type', boilerTypeValidationMessage);" value="{{boilerActRenewal_data.boiler_type}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-boiler_type"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>6. U. T.<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="ut" name="ut" class="form-control" placeholder="Enter U. T. !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'ut', utValidationMessage);" value="{{boilerActRenewal_data.ut}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-ut"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7. Working Pressure Of Boiler (kg/cm2)<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="working_pressure" name="working_pressure" class="form-control" placeholder="Enter Working Pressure Of Boiler !" onkeyup="checkNumeric($(this));"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'working_pressure', workingPressureValidationMessage);" value="{{boilerActRenewal_data.working_pressure}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-working_pressure"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8. Max Pressure Approved (Kg/cm2)<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="max_pressure" name="max_pressure" class="form-control" placeholder="Enter Factory Building !" onkeyup="checkNumeric($(this));"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'max_pressure', maxPressureValidationMessage);" value="{{boilerActRenewal_data.max_pressure}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-max_pressure"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9. Heating Surface Area / Boiler Rating (m2)<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="heating_surface_area" name="heating_surface_area" class="form-control" placeholder="Enter Heating Surface Area / Boiler Rating !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'heating_surface_area', heatingSurfaceValidationMessage);" onkeyup="checkNumeric($(this));" value="{{boilerActRenewal_data.heating_surface_area}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-heating_surface_area"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>10. Total Length of steam Pipes (in meters)<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="length_of_pipes" name="length_of_pipes" class="form-control" placeholder="Enter Total Length of steam Pipes !" onkeyup="checkNumeric($(this));"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'length_of_pipes', lengthPipesValidationMessage);" value="{{boilerActRenewal_data.length_of_pipes}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-length_of_pipes"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>11. Maximum Continuous Evaporation<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="max_evaporation" name="max_evaporation" class="form-control" placeholder="Enter Maximum Continuous Evaporatio !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'max_evaporation', maxEvaporationValidationMessage);" value="{{boilerActRenewal_data.max_evaporation}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-max_evaporation"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>12. Place Of Manufacture<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="place_of_manufacture" name="place_of_manufacture" class="form-control" placeholder="Enter Place Of Manufacture !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'place_of_manufacture', manufacturePlaceValidationMessage);" value="{{boilerActRenewal_data.place_of_manufacture}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-place_of_manufacture"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>13. Year Of Manufacture<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="year_of_manufacture" name="year_of_manufacture" class="form-control" placeholder="Enter Year Of Manufacture !" onkeyup="checkNumeric($(this));"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'year_of_manufacture', manufactureYearValidationMessage);" value="{{boilerActRenewal_data.year_of_manufacture}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-year_of_manufacture"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>14. Name Of Manufacture<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_manufacture" name="name_of_manufacture" class="form-control" placeholder="Enter Name Of Manufacture !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'name_of_manufacture', manufactureNameValidationMessage);" value="{{boilerActRenewal_data.name_of_manufacture}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-name_of_manufacture"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>15. Manufacture Address</label>
                            <div class="input-group">
                                <textarea id="manufacture_address" name="manufacture_address" class="form-control" placeholder="Enter Manufacture Address !" maxlength="100" onblur="checkValidation('boiler-act-renewal', 'manufacture_address', manufactureAddressValidationMessage);">{{boilerActRenewal_data.manufacture_address}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-manufacture_address"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>16. Hydraulically Tested On<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="hydraulically_tested_on" id="hydraulically_tested_on" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{boilerActRenewal_data.hydraulically_tested_on_text}}" onblur="checkValidation('bocw', 'hydraulically_tested_on', hydrulicallyTestedOnValidationMessage);">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-hydraulically_tested_on"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>17. Hydraulically Tested To<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="hydraulically_tested_to" name="hydraulically_tested_to" class="form-control" placeholder="Enter Hydraulically Tested To !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'hydraulically_tested_to', hydrulicallyTestedValidationMessage);" value="{{boilerActRenewal_data.hydraulically_tested_to}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-hydraulically_tested_to"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>18. Repairs<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="repairs" name="repairs" class="form-control" placeholder="Enter Repairs !"
                                       maxlength="100" onblur="checkValidation('boiler-act-renewal', 'repairs', repairsValidationMessage);" value="{{boilerActRenewal_data.repairs}}">
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-repairs"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>19. Remarks</label>
                            <div class="input-group">
                                <textarea id="remarks" name="remarks" class="form-control" placeholder="Enter Remarks !" maxlength="100" onblur="checkValidation('boiler-act-renewal', 'remarks', remarksValidationMessage);">{{boilerActRenewal_data.remarks}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-act-renewal-remarks"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="company_letter_head_container_for_boileract_renewal">
                            <label>20.  Application on Company Letter head.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="company_letter_head_for_boileract_renewal" name="company_letter_head_for_boileract_renewal" class="spinner_container_for_boileract_renewal_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="BoilerActRenewal.listview.uploadDocumentForBoilerActRenewal(VALUE_ONE);">
                            <div class="error-message error-message-boiler-act-renewal-company_letter_head_for_boileract_renewal"></div>
                        </div>
                        <div class="form-group col-sm-12" id="company_letter_head_name_container_for_boileract_renewal" style="display: none;">
                            <label>20.  Application on Company Letter head<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="company_letter_head_download"><label id="company_letter_head_name_image_for_boileract_renewal" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boileract_renewal_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="company_letter_head" class="btn btn-sm btn-danger spinner_name_container_for_boileract_renewal_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="BoilerActRenewal.listview.askForRemove('{{boilerActRenewal_data.boiler_renewal_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="copy_of_challan_container_for_boileract_renewal">
                            <label>21.  Fees as per the schedule.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="copy_of_challan_for_boileract_renewal" name="copy_of_challan_for_boileract_renewal" class="spinner_container_for_boileract_renewal_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="BoilerActRenewal.listview.uploadDocumentForBoilerActRenewal(VALUE_TWO);">
                            <div class="error-message error-message-boiler-act-renewal-copy_of_challan_for_boileract_renewal"></div>
                        </div>
                        <div class="form-group col-sm-12" id="copy_of_challan_name_container_for_boileract_renewal" style="display: none;">
                            <label>21.  Fees as per the schedule.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="copy_of_challan_download"><label id="copy_of_challan_name_image_for_boileract_renewal" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boileract_renewal_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="copy_of_challan" class="btn btn-sm btn-danger spinner_name_container_for_boileract_renewal_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="BoilerActRenewal.listview.askForRemove('{{boilerActRenewal_data.boiler_renewal_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="last_boiler_license_container_for_boileract_renewal">
                            <label>22.  A copy of last Boiler License.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="last_boiler_license_for_boileract_renewal" name="last_boiler_license_for_boileract_renewal" class="spinner_container_for_boileract_renewal_{{VALUE_THREE}}"
                                   accept="application/pdf" onchange="BoilerActRenewal.listview.uploadDocumentForBoilerActRenewal(VALUE_THREE);">
                            <div class="error-message error-message-boiler-act-renewal-last_boiler_license_for_boileract_renewal"></div>
                        </div>
                        <div class="form-group col-sm-12" id="last_boiler_license_name_container_for_boileract_renewal" style="display: none;">
                            <label>22.  A copy of last Boiler License.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="last_boiler_license_download"><label id="last_boiler_license_name_image_for_boileract_renewal" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boileract_renewal_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="last_boiler_license" class="btn btn-sm btn-danger spinner_name_container_for_boileract_renewal_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="BoilerActRenewal.listview.askForRemove('{{boilerActRenewal_data.boiler_renewal_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

<!--                     <div class="row">
                        <div class="col-12 m-b-5px" id="sign_of_applicant_container_for_boileract_renewal">
                            <label>23. Signature of Applicant.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="sign_of_applicant_for_boileract_renewal" name="sign_of_applicant_for_boileract_renewal" class="spinner_container_for_boileract_renewal_{{VALUE_FOUR}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="BoilerActRenewal.listview.uploadDocumentForBoilerActRenewal(VALUE_FOUR);">
                            <div class="error-message error-message-boiler-act-renewal-sign_of_applicant_for_boileract_renewal"></div>
                        </div>
                        <div class="form-group col-sm-12" id="sign_of_applicant_name_container_for_boileract_renewal" style="display: none;">
                            <label>23. Signature of Applicant.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="sign_of_applicant_download"><img id="sign_of_applicant_name_image_for_boileract_renewal" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_boileract_renewal_{{VALUE_FOUR}}"></a>
                            <button type="button" id="sign_of_applicant" class="btn btn-sm btn-danger spinner_name_container_for_boileract_renewal_{{VALUE_FOUR}}" style="vertical-align: top;" 
                                    onclick="BoilerActRenewal.listview.askForRemove('{{boilerActRenewal_data.boiler_renewal_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div> -->
                    <div class="row">
                        <div class="col-12 m-b-5px" id="sign_of_applicant_container_for_boileract_renewal">
                            <label>23. Signature of Applicant.<span style="color: red;">* <br>(Maximum File Size: 1MB)&nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="sign_of_applicant_for_boileract_renewal" name="sign_of_applicant_for_boileract_renewal"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" class="spinner_container_for_boileract_renewal_{{VALUE_FOUR}}" onchange="BoilerActRenewal.listview.uploadDocumentForBoilerActRenewal(VALUE_FOUR);">
                            <div class="error-message error-message-boiler-act-renewal-sign_of_applicant_for_boileract_renewal"></div>
                        </div>
                        <div class="form-group col-sm-12" id="sign_of_applicant_name_container_for_boileract_renewal" style="display: none;">
                            <label>23. Signature of Applicant.<span style="color: red;">* <br>(Maximum File Size: 1MB)&nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <a target="_blank" id="sign_of_applicant_download"><img id="sign_of_applicant_name_image_for_boileract_renewal" class="spinner_name_container_for_boileract_renewal_{{VALUE_FOUR}}" style="width: 250px; height: 250px; border: 2px solid blue;"></a>
                            <button type="button" id="sign_of_applicant" class="btn btn-sm btn-danger spinner_name_container_for_boileract_renewal_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="BoilerActRenewal.listview.askForRemove('{{boilerActRenewal_data.boiler_renewal_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="form-group">
                        <button type="button" id="draft_btn_for_bolier" class="btn btn-sm btn-nic-blue" onclick="BoilerActRenewal.listview.submitBoilerActRenewal({{VALUE_ONE}});" style="margin-right: 5px;"><i class="fas fa-download"></i>&nbsp; Save as Draft</button>
                        <button type="button" id="submit_btn_for_boiler" class="btn btn-sm btn-success" onclick="BoilerActRenewal.listview.askForBoilerActRenewal({{VALUE_TWO}});" style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="BoilerActRenewal.listview.loadBoilerActRenewalData();"><i class="fas fa-times"></i>&nbsp; Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>