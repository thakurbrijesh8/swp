<div class="row">
   <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Boiler Registration Application - New</div>
                
            </div>
            <form role="form" id="boiler_act_form" name="boiler_act_form" onsubmit="return false;">
                <input type="hidden" name="temp_pipe_line_deawing" id="temp_pipe_line_deawing" class="form-control" value="{{boilerAct_data.pipe_line_deawing}}">
                <input type="hidden" name="temp_copy_of_challan" id="temp_copy_of_challan" class="form-control" value="{{boilerAct_data.copy_of_challan}}">
                <input type="hidden" name="temp_ibr_document" id="temp_ibr_document" class="form-control" value="{{boilerAct_data.ibr_document}}">
                <input type="hidden" name="temp_sign_of_applicant" id="temp_sign_of_applicant" class="form-control" value="{{boilerAct_data.sign_of_applicant}}">
                <input type="hidden" id="boiler_id" name="boiler_id" value="{{boilerAct_data.boiler_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-boiler-act f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. District<span class="color-nic-red">*</span></label>
                            <select id="district" name="district" class="form-control select2"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-boiler-act-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('boiler-act', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-boiler-act-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Name Of Owner<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="owner_name" name="owner_name" class="form-control" placeholder="Enter Name Of Owner !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'owner_name', ownerNameValidationMessage);" value="{{boilerAct_data.owner_name}}">
                            </div>
                            <span class="error-message error-message-boiler-act-owner_name"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>3. Situation of Boiler<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="situation_of_boiler" name="situation_of_boiler" class="form-control" placeholder="Enter Situation of Boiler !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'situation_of_boiler', boilerSituationValidationMessage);" value="{{boilerAct_data.situation_of_boiler}}">
                            </div>
                            <span class="error-message error-message-boiler-act-situation_of_boiler"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4. Boiler Type<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="boiler_type" name="boiler_type" class="form-control" placeholder="Enter Boiler Type !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'boiler_type', boilerTypeValidationMessage);" value="{{boilerAct_data.boiler_type}}">
                            </div>
                            <span class="error-message error-message-boiler-act-boiler_type"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>5. U. T.<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="ut" name="ut" class="form-control" placeholder="Enter U. T. !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'ut', utValidationMessage);" value="{{boilerAct_data.ut}}">
                            </div>
                            <span class="error-message error-message-boiler-act-ut"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Working Pressure Of Boiler (kg/cm2)<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="working_pressure" name="working_pressure" class="form-control" placeholder="Enter Working Pressure Of Boiler !" onkeyup="checkNumeric($(this));"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'working_pressure', workingPressureValidationMessage);" value="{{boilerAct_data.working_pressure}}">
                            </div>
                            <span class="error-message error-message-boiler-act-working_pressure"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7. Max Pressure Approved (Kg/cm2)<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="max_pressure" name="max_pressure" class="form-control" placeholder="Enter Factory Building !" onkeyup="checkNumeric($(this));"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'max_pressure', maxPressureValidationMessage);" value="{{boilerAct_data.max_pressure}}">
                            </div>
                            <span class="error-message error-message-boiler-act-max_pressure"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>8. Heating Surface Area / Boiler Rating (m2)<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="heating_surface_area" name="heating_surface_area" class="form-control" placeholder="Enter Heating Surface Area / Boiler Rating !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'heating_surface_area', heatingSurfaceValidationMessage);" onkeyup="checkNumeric($(this));" value="{{boilerAct_data.heating_surface_area}}">
                            </div>
                            <span class="error-message error-message-boiler-act-heating_surface_area"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>9. Total Length of steam Pipes (in meters)<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="length_of_pipes" name="length_of_pipes" class="form-control" placeholder="Enter Total Length of steam Pipes !" onkeyup="checkNumeric($(this));"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'length_of_pipes', lengthPipesValidationMessage);" value="{{boilerAct_data.length_of_pipes}}">
                            </div>
                            <span class="error-message error-message-boiler-act-length_of_pipes"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>10. Maximum Continuous Evaporation<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="max_evaporation" name="max_evaporation" class="form-control" placeholder="Enter Maximum Continuous Evaporatio !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'max_evaporation', maxEvaporationValidationMessage);" value="{{boilerAct_data.max_evaporation}}">
                            </div>
                            <span class="error-message error-message-boiler-act-max_evaporation"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>11. Place Of Manufacture<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="place_of_manufacture" name="place_of_manufacture" class="form-control" placeholder="Enter Place Of Manufacture !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'place_of_manufacture', manufacturePlaceValidationMessage);" value="{{boilerAct_data.place_of_manufacture}}">
                            </div>
                            <span class="error-message error-message-boiler-act-place_of_manufacture"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>12. Year Of Manufacture<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="year_of_manufacture" name="year_of_manufacture" class="form-control" placeholder="Enter Year Of Manufacture !" onkeyup="checkNumeric($(this));"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'year_of_manufacture', manufactureYearValidationMessage);" value="{{boilerAct_data.year_of_manufacture}}">
                            </div>
                            <span class="error-message error-message-boiler-act-year_of_manufacture"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>13. Name Of Manufacture<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_manufacture" name="name_of_manufacture" class="form-control" placeholder="Enter Name Of Manufacture !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'name_of_manufacture', manufactureNameValidationMessage);" value="{{boilerAct_data.name_of_manufacture}}">
                            </div>
                            <span class="error-message error-message-boiler-act-name_of_manufacture"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>14. Manufacture Address</label>
                            <div class="input-group">
                                <textarea id="manufacture_address" name="manufacture_address" class="form-control" placeholder="Enter Manufacture Address !" maxlength="100" onblur="checkValidation('boiler-act', 'manufacture_address', manufactureAddressValidationMessage);">{{boilerAct_data.manufacture_address}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-act-manufacture_address"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>15. Hydraulically Tested On<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="hydraulically_tested_on" id="hydraulically_tested_on" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{boilerAct_data.hydraulically_tested_on}}" onblur="checkValidation('bocw', 'hydraulically_tested_on', hydrulicallyTestedOnValidationMessage);">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <span class="error-message error-message-boiler-act-hydraulically_tested_on"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>16. Hydraulically Tested To<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="hydraulically_tested_to" name="hydraulically_tested_to" class="form-control" placeholder="Enter Hydraulically Tested To !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'hydraulically_tested_to', hydrulicallyTestedValidationMessage);" value="{{boilerAct_data.hydraulically_tested_to}}">
                            </div>
                            <span class="error-message error-message-boiler-act-hydraulically_tested_to"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>17. Repairs<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="repairs" name="repairs" class="form-control" placeholder="Enter Repairs !"
                                       maxlength="100" onblur="checkValidation('boiler-act', 'repairs', repairsValidationMessage);" value="{{boilerAct_data.repairs}}">
                            </div>
                            <span class="error-message error-message-boiler-act-repairs"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>18. Remarks</label>
                            <div class="input-group">
                                <textarea id="remarks" name="remarks" class="form-control" placeholder="Enter Remarks !" maxlength="100" onblur="checkValidation('boiler-act', 'remarks', remarksValidationMessage);">{{boilerAct_data.remarks}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-act-remarks"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="company_letter_head_container_for_boileract">
                            <label>19.  Application on Company Letter head.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="company_letter_head_for_boileract" name="company_letter_head_for_boileract" class="spinner_container_for_boileract_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="BoilerAct.listview.uploadDocumentForBoilerAct(VALUE_ONE);">
                            <div class="error-message error-message-boiler-act-company_letter_head_for_boileract"></div>
                        </div>
                        <div class="form-group col-sm-12" id="company_letter_head_name_container_for_boileract" style="display: none;">
                            <label>19.  Application on Company Letter head.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="company_letter_head_download"><label id="company_letter_head_name_image_for_boileract" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boileract_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="company_letter_head" class="btn btn-sm btn-danger spinner_name_container_for_boileract_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="BoilerAct.listview.askForRemove('{{boilerAct_data.boiler_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="copy_of_challan_container_for_boileract">
                            <label>20.  Fees as per the schedule.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="copy_of_challan_for_boileract" name="copy_of_challan_for_boileract" class="spinner_container_for_boileract_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="BoilerAct.listview.uploadDocumentForBoilerAct(VALUE_TWO);">
                            <div class="error-message error-message-boiler-act-copy_of_challan_for_boileract"></div>
                        </div>
                        <div class="form-group col-sm-12" id="copy_of_challan_name_container_for_boileract" style="display: none;">
                            <label>20.  Fees as per the schedule.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="copy_of_challan_download"><label id="copy_of_challan_name_image_for_boileract" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boileract_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="copy_of_challan" class="btn btn-sm btn-danger spinner_name_container_for_boileract_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="BoilerAct.listview.askForRemove('{{boilerAct_data.boiler_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="pipe_line_deawing_container_for_boileract">
                            <label>21. Plans of Pipeline.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="pipe_line_deawing_for_boileract" name="pipe_line_deawing_for_boileract" class="spinner_container_for_boileract_{{VALUE_THREE}}"
                                   accept="application/pdf" onchange="BoilerAct.listview.uploadDocumentForBoilerAct(VALUE_THREE);">
                            <div class="error-message error-message-boiler-act-pipe_line_deawing_for_boileract"></div>
                        </div>
                        <div class="form-group col-sm-12" id="pipe_line_deawing_name_container_for_boileract" style="display: none;">
                            <label>21. Plans of Pipeline.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="pipe_line_deawing_download"><label id="pipe_line_deawing_name_image_for_boileract" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boileract_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="pipe_line_deawing" class="btn btn-sm btn-danger spinner_name_container_for_boileract_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="BoilerAct.listview.askForRemove('{{boilerAct_data.boiler_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="ibr_document_container_for_boileract">
                            <label>22. Original Document of Boiler.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="ibr_document_for_boileract" name="ibr_document_for_boileract" class="spinner_container_for_boileract_{{VALUE_FOUR}}"
                                   accept="application/pdf" onchange="BoilerAct.listview.uploadDocumentForBoilerAct(VALUE_FOUR);">
                            <div class="error-message error-message-boiler-act-ibr_document_for_boileract"></div>
                        </div>
                        <div class="form-group col-sm-12" id="ibr_document_name_container_for_boileract" style="display: none;">
                            <label>22. Original Document of Boiler.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="ibr_document_download"><label id="ibr_document_name_image_for_boileract" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boileract_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="ibr_document" class="btn btn-sm btn-danger spinner_name_container_for_boileract_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="BoilerAct.listview.askForRemove('{{boilerAct_data.boiler_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="sign_of_applicant_container_for_boileract">
                            <label>23. Signature of Applicant.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="sign_of_applicant_for_boileract" name="sign_of_applicant_for_boileract" class="spinner_container_for_boileract_{{VALUE_FIVE}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="BoilerAct.listview.uploadDocumentForBoilerAct(VALUE_FIVE);">
                            <div class="error-message error-message-boiler-act-sign_of_applicant_for_boileract"></div>
                        </div>
                        <div class="form-group col-sm-12" id="sign_of_applicant_name_container_for_boileract" style="display: none;">
                            <label>23. Signature of Applicant.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="sign_of_applicant_download"><img id="sign_of_applicant_name_image_for_boileract" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_boileract_{{VALUE_FIVE}}"></a>
                            <button type="button" id="sign_of_applicant" class="btn btn-sm btn-danger spinner_name_container_for_boileract_{{VALUE_FIVE}}" style="vertical-align: top;" 
                                    onclick="BoilerAct.listview.askForRemove('{{boilerAct_data.boiler_id}}', VALUE_FIVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    
                    <div class="form-group">
                        <button type="button" id="draft_btn_for_bolier" class="btn btn-sm btn-nic-blue" onclick="BoilerAct.listview.submitBoilerAct({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button>
                        <button type="button" id="submit_btn_for_boiler" class="btn btn-sm btn-success" onclick="BoilerAct.listview.askForBoilerAct({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="BoilerAct.listview.loadBoilerActData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>