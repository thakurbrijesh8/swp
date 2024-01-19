<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">DEPARTMENT OF TOURISM </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">UT OF DADRA & NAGAR AND DAMAN & DIU </div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application Form for Registration of a Hotel Keeper</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">FORM-II</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">(See Rule 3)</div>
            </div>
            <form role="form" id="hotelregi_form" name="hotelregi_form" onsubmit="return false;">

                <input type="hidden" id="hotelregi_id" name="hotelregi_id" value="{{hotelregi_data.hotelregi_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-hotelregi f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            To,<br>
                            The Director,<br>
                            Department of Tourism,<br>
                            Dadra & Nagar Haveli and  Daman & Diu.<br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. Name of Hotel <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_hotel" name="name_of_hotel" class="form-control" placeholder="Name of Hotel !"
                                       maxlength="100" onblur="checkValidation('hotelregi', 'name_of_hotel', hotelNameValidationMessage);" value="{{hotelregi_data.name_of_hotel}}">
                            </div>
                            <span class="error-message error-message-hotelregi-name_of_hotel"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>2. Name of the Applicant <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_person" name="name_of_person" class="form-control" placeholder="Name of Applicant !" maxlength="100" value="{{hotelregi_data.name_of_person}}" 
                                       onblur="checkValidation('hotelregi', 'name_of_person', applicantNameValidationMessage);">
                            </div>
                            <span class="error-message error-message-hotelregi-name_of_person"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>3. Full address of the site where the applicant intends to run the hotel or is being run <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea type="text" id="full_address" name="full_address" class="form-control" placeholder="Full address of the site where the applicant intends to run the hotel or is being run !"
                                          maxlength="100" onblur="checkValidation('hotelregi', 'full_address', fullAddressValidationMessage);">{{hotelregi_data.full_address}}</textarea>
                            </div>
                            <span class="error-message error-message-hotelregi-full_address"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4. Name of the tourist area where the hotel is to be run or is being run <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control select2" id="name_of_tourist_area" name="name_of_tourist_area" 
                                        data-placeholder="Select Name of the tourist area !" style="width: 100%;" >
                                </select>
                            </div>
                            <span class="error-message error-message-hotelregi-name_of_tourist_area"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                        data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('hotelregi', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                                </select>
                            </div>
                            <span class="error-message error-message-hotelregi-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Name of the Proprietor (s) <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_proprietor" name="name_of_proprietor" class="form-control" placeholder="Name of the Proprietor (s) !" maxlength="100" value="{{hotelregi_data.name_of_proprietor}}" onblur="checkValidation('hotelregi', 'name_of_proprietor', nameOfProprietorValidationMessage);">
                            </div>
                            <span class="error-message error-message-hotelregi-name_of_proprietor"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>6. Category of Hotel <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control" id="category_of_hotel" name="category_of_hotel" onchange="Hotelregi.listview.getFees(this);"
                                        data-placeholder="Status !" onblur="checkValidation('hotelregi', 'category_of_hotel', categoryOfHotelValidationMessage);">
                                    <option value="">Select Category of Hotel</option>
                                    <option value="A">A Category</option>
                                    <option value="B">B Category</option>
                                    <option value="C">C Category</option>
                                    <option value="D">D Category</option>
                                    <option value="E">E Category (Homestay)</option>
                                </select>
                            </div>
                            <span class="error-message error-message-hotelregi-category_of_hotel"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7. Fees <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="text" id="fees" name="fees" class="form-control" placeholder="Fees !" maxlength="10">
                            </div>
                            <span class="error-message error-message-hotelregi-fees"></span>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>8. Mobile No. <span style="color: red;">*</span></label>
                            <input type="text" id="mob_no" name="mob_no" class="form-control" placeholder=" Mobile No. !"
                                   maxlength="10" onblur="checkNumeric($(this)); checkValidationForMobileNumber('hotelregi', 'mob_no', mobileValidationMessage);" value="{{hotelregi_data.mob_no}}">
                            <span class="error-message error-message-hotelregi-mob_no"></span>
                        </div>
                    </div>
                    <hr class="m-b-1rem">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9. Name of the Manager <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_manager" name="name_of_manager" class="form-control" placeholder="Name of the Manager !" maxlength="100" value="{{hotelregi_data.name_of_manager}}" onblur="checkValidation('hotelregi', 'name_of_manager', nameOfManagerValidationMessage);">
                            </div>
                            <span class="error-message error-message-hotelregi-name_of_manager"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>10. Manager Full Permanent Address <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea type="text" id="manager_permanent_address" name="manager_permanent_address" class="form-control" placeholder="Manager Full Permanent Address !" maxlength="100" onblur="checkValidation('hotelregi', 'manager_permanent_address', managerPermanentAddressValidationMessage);">{{hotelregi_data.manager_permanent_address}}</textarea>
                            </div>
                            <span class="error-message error-message-hotelregi-manager_permanent_address"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div style="background-color: #d2d6de; padding: 5px;">
                            <span class="f-w-b" style="font-size: 15px; color: #000;">11. Details of Agent/Agents/employee/employees </span>
                            <hr>
                            <table class="table table-bordered m-b-0px" id="agentList" style="margin-top: 10px;">
                                <thead>
                                    <tr style='color: #000;'>
                                        <th style="width: 10px">Sr.No.</th>
                                        <th>Name of the Agent/Agents/employee/employees</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="agent_info_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer" align="right" style="margin-bottom: 50px;" >
                            <button type="button" class="btn btn-sm btn-nic-blue float-right" id="submit_btn_for_agent" onclick="Hotelregi.listview.addMultipleAgent({});" style="margin-right: 5px;margin-top: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add Agent/Agents/employee/employees
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>12. Whether the applicant is a permanent resident of the Union Territory of Goa, Daman and Diu <span style="color: red;">* </span>  &emsp; </label>
                            <input type="radio" id="permanent_resident_of_ut_yes" name="permanent_resident_of_ut"  
                                   onblur="checkValidation('hotelregi', 'permanent_resident_of_ut', permanentResidentUTValidationMessage);" value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="permanent_resident_of_ut_no" name="permanent_resident_of_ut" 
                                   maxlength="100" onblur="checkValidation('hotelregi', 'permanent_resident_of_ut', permanentResidentUTValidationMessage);" value="{{IS_CHECKED_NO}}"> No
                            <br><span class="error-message error-message-hotelregi-permanent_resident_of_ut"></span>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>13. Any other business which the applicant is carrying on in any tourist area in the Union Territory. <span style="color: red;">* </span> &emsp;</label>
                            <input type="radio" id="other_business_of_applicant_yes" name="other_business_of_applicant"  
                                   maxlength="100" onblur="checkValidation('hotelregi', 'other_business_of_applicant', otherBusinessOfApplicantValidationMessage);" value="{{IS_CHECKED_YES}}"> Yes &emsp; 
                            <input type="radio" id="other_business_of_applicant_no" name="other_business_of_applicant" 
                                   maxlength="100" onblur="checkValidation('hotelregi', 'other_business_of_applicant', otherBusinessOfApplicantValidationMessage);" value="{{IS_CHECKED_NO}}"> No
                            <br><span class="error-message error-message-hotelregi-other_business_of_applicant"></span>
                        </div>
                    </div>
                    <div class="hotel" style="display: none;">
                        <div class="row">
                            <div class="col-12 m-b-5px" id="site_plan_container_for_hotelregi">
                                <label>14. Upload Site plan. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="site_plan_for_hotelregi" name="site_plan_for_hotelregi"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_ONE}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_ONE);">
                                <div class="error-message error-message-hotelregi-site_plan_for_hotelregi"></div>
                            </div>
                            <div class="form-group col-sm-12" id="site_plan_name_container_for_hotelregi" style="display: none;">
                                <label>14. Upload Site plan. <span style="color: red;">* </label><br>
                                <a target="_blank" id="site_plan_download"><label id="site_plan_name_image_for_hotelregi" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="site_plan_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_ONE}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_ONE);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="construction_plan_container_for_hotelregi">
                                <label>15. Upload  approved construction plan. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="construction_plan_for_hotelregi" name="construction_plan_for_hotelregi"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_TWO}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_TWO);">
                                <div class="error-message error-message-hotelregi-construction_plan_for_hotelregi"></div>
                            </div>
                            <div class="form-group col-sm-12" id="construction_plan_name_container_for_hotelregi" style="display: none;">
                                <label>15. Upload  approved construction plan. <span style="color: red;">* </label><br>
                                <a target="_blank" id="construction_plan_download"><label id="construction_plan_name_image_for_hotelregi" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="construction_plan_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_TWO}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_TWO);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="occupancy_certificate_container_for_hotelregi">
                                <label>16. Upload Occupancy Certificate. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="occupancy_certificate_for_hotelregi" name="occupancy_certificate_for_hotelregi"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_THREE}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_THREE);">
                                <div class="error-message error-message-hotelregi-occupancy_certificate_for_hotelregi"></div>
                            </div>
                            <div class="form-group col-sm-12" id="occupancy_certificate_name_container_for_hotelregi" style="display: none;">
                                <label>16. Upload Occupancy Certificate. <span style="color: red;">* </label><br>
                                <a target="_blank" id="occupancy_certificate_download"><label id="occupancy_certificate_name_image_for_hotelregi" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="occupancy_certificate_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_THREE}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_THREE);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="noc_medical_container_for_hotelregi">
                                <!--<label>19. N.O.C. issued by Dy. Director, Medical & Health Services, Daman. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>-->
                                <label>17. Upload Health NOC. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="noc_medical_for_hotelregi" name="noc_medical_for_hotelregi"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_FOUR}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_FOUR);">
                                <div class="error-message error-message-hotelregi-noc_medical_for_hotelregi"></div>
                            </div>
                            <div class="form-group col-sm-12" id="noc_medical_name_container_for_hotelregi" style="display: none;">
                                <label>17. Upload Health NOC. <span style="color: red;">* </label><br>
                                <a target="_blank" id="noc_medical_download"><label id="noc_medical_name_image_for_hotelregi" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="noc_medical_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_FOUR}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_FOUR);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="noc_concerned_container_for_hotelregi">
                                <label>18. Upload NOC of DMC/concerned panchayat. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="noc_concerned_for_hotelregi" name="noc_concerned_for_hotelregi"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_FIVE}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_FIVE);">
                                <div class="error-message error-message-hotelregi-noc_concerned_for_hotelregi"></div>
                            </div>
                            <div class="form-group col-sm-12" id="noc_concerned_name_container_for_hotelregi" style="display: none;">
                                <label>18. Upload NOC of DMC/concerned panchayat. <span style="color: red;">* </label><br>
                                <a target="_blank" id="noc_concerned_download"><label id="noc_concerned_name_image_for_hotelregi" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="noc_concerned_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_FIVE}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_FIVE);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="noc_electricity_container_for_hotelregi">
                                <label>19. Upload NOC of electricity department. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="noc_electricity_for_hotelregi" name="noc_electricity_for_hotelregi"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_SIX}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_SIX);">
                                <div class="error-message error-message-hotelregi-noc_electricity_for_hotelregi"></div>
                            </div>
                            <div class="form-group col-sm-12" id="noc_electricity_name_container_for_hotelregi" style="display: none;">
                                <label>19. Upload NOC of electricity department. <span style="color: red;">* </label><br>
                                <a target="_blank" id="noc_electricity_download"><label id="noc_electricity_name_image_for_hotelregi" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="noc_electricity_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_SIX}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_SIX);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="homestay" style="display: none;">
                        <div class="row">
                            <div class="col-12 m-b-5px" id="aadhar_card_container_for_homestay">
                                <label>14. Upload aadhar card of the person under whom the Bed & breakfast/Homestay is to be registered. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="aadhar_card_for_homestay" name="aadhar_card_for_homestay"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_SEVEN}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_SEVEN);">
                                <div class="error-message error-message-hotelregi-aadhar_card_for_hotelregi"></div>
                            </div>
                            <div class="form-group col-sm-12" id="aadhar_card_name_container_for_homestay" style="display: none;">
                                <label>14. Upload aadhar card of the person under whom the Bed & breakfast/Homestay is to be registered. <span style="color: red;">* </label><br>
                                <a target="_blank" id="aadhar_card_download"><label id="aadhar_card_name_image_for_homestay" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="aadhar_card_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_SEVEN}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_SEVEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="form_xiv_container_for_homestay">
                                <label>15. Upload form XIV of survey no. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="form_xiv_for_homestay" name="form_xiv_for_homestay"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_EIGHT}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_EIGHT);">
                                <div class="error-message error-message-hotelregi-form_xiv_for_homestay"></div>
                            </div>
                            <div class="form-group col-sm-12" id="form_xiv_name_container_for_homestay" style="display: none;">
                                <label>15. Upload form XIV of survey no. <span style="color: red;">* </label><br>
                                <a target="_blank" id="form_xiv_download"><label id="form_xiv_name_image_for_homestay" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="form_xiv_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_EIGHT}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_EIGHT);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="site_plan_container_for_homestay">
                                <label>16. Upload site plan of survey no. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="site_plan_for_homestay" name="site_plan_for_homestay"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_NINE}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_NINE);">
                                <div class="error-message error-message-hotelregi-site_plan_for_homestay"></div>
                            </div>
                            <div class="form-group col-sm-12" id="site_plan_name_container_for_homestay" style="display: none;">
                                <label>16. Upload site plan of survey no. <span style="color: red;">* </label><br>
                                <a target="_blank" id="site_plan_homestay_download"><label id="site_plan_name_image_for_homestay" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="site_plan_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_NINE}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_NINE);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="na_order_container_for_homestay">
                                <label>17. Upload NA order of the survey no. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="na_order_for_homestay" name="na_order_for_homestay"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_TEN}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_TEN);">
                                <div class="error-message error-message-hotelregi-na_order_for_homestay"></div>
                            </div>
                            <div class="form-group col-sm-12" id="na_order_name_container_for_homestay" style="display: none;">
                                <label>17. Upload NA order of the survey no. <span style="color: red;">* </label><br>
                                <a target="_blank" id="na_order_download"><label id="na_order_name_image_for_homestay" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="na_order_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_TEN}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_TEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="completion_certificate_container_for_homestay">
                                <label>18. Upload completion/occupancy certificate. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="completion_certificate_for_homestay" name="completion_certificate_for_homestay"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_ELEVEN}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_ELEVEN);">
                                <div class="error-message error-message-hotelregi-completion_certificate_for_homestay"></div>
                            </div>
                            <div class="form-group col-sm-12" id="completion_certificate_name_container_for_homestay" style="display: none;">
                                <label>18. Upload completion/occupancy certificate. <span style="color: red;">* </label><br>
                                <a target="_blank" id="completion_certificate_download"><label id="completion_certificate_name_image_for_homestay" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="completion_certificate_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_ELEVEN}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_ELEVEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="house_tax_receipt_container_for_homestay">
                                <label>19. Upload house tax receipt. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="house_tax_receipt_for_homestay" name="house_tax_receipt_for_homestay"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_TWELVE}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_TWELVE);">
                                <div class="error-message error-message-hotelregi-house_tax_receipt_for_homestay"></div>
                            </div>
                            <div class="form-group col-sm-12" id="house_tax_receipt_name_container_for_homestay" style="display: none;">
                                <label>19. Upload house tax receipt. <span style="color: red;">* </label><br>
                                <a target="_blank" id="house_tax_receipt_download"><label id="house_tax_receipt_name_image_for_homestay" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="house_tax_receipt_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_TWELVE}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_TWELVE);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-b-5px" id="electricity_bill_container_for_homestay">
                                <label>20. Upload copy of electricity bill. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <input type="file" id="electricity_bill_for_homestay" name="electricity_bill_for_homestay"
                                       accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_THIRTEEN}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_THIRTEEN);">
                                <div class="error-message error-message-hotelregi-electricity_bill_for_homestay"></div>
                            </div>
                            <div class="form-group col-sm-12" id="electricity_bill_name_container_for_homestay" style="display: none;">
                                <label>20.Upload copy of electricity bill. <span style="color: red;">* </label><br>
                                <a target="_blank" id="electricity_bill_download"><label id="electricity_bill_name_image_for_homestay" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_THIRTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                <button type="button" id="electricity_bill_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_THIRTEEN}}" style="vertical-align: top;"
                                        onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_THIRTEEN);">
                                    <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="noc_fire_container_for_hotelregi">
                            <label>21. Upload Fire NOC. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="noc_fire_for_hotelregi" name="noc_fire_for_hotelregi"
                                   accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_FOURTEEN}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_FOURTEEN);">
                            <div class="error-message error-message-hotelregi-noc_fire_for_hotelregi"></div>
                        </div>
                        <div class="form-group col-sm-12" id="noc_fire_name_container_for_hotelregi" style="display: none;">
                            <label>21. Upload Fire NOC. <span style="color: red;">* </label><br>
                            <a target="_blank" id="noc_fire_download"><label id="noc_fire_name_image_for_hotelregi" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_FOURTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="noc_fire_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_FOURTEEN}}" style="vertical-align: top;"
                                    onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_FOURTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="police_clearance_certificate_container_for_hotelregi">
                            <label>22. Upload police clearance certificate. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="police_clearance_certificate_for_hotelregi" name="police_clearance_certificate_for_hotelregi"
                                   accept="application/pdf" class="spinner_container_for_hotelregi_{{VALUE_FIFTEEN}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_FIFTEEN);">
                            <div class="error-message error-message-hotelregi-police_clearance_certificate_for_hotelregi"></div>
                        </div>
                        <div class="form-group col-sm-12" id="police_clearance_certificate_name_container_for_hotelregi" style="display: none;">
                            <label>22. Upload police clearance certificate. <span style="color: red;">* </label><br>
                            <a target="_blank" id="police_clearance_certificate_download"><label id="police_clearance_certificate_name_image_for_hotelregi" style="border: 2px solid black;" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_hotelregi_{{VALUE_FIFTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="police_clearance_certificate_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_FIFTEEN}}" style="vertical-align: top;" 
                                    onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_FIFTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIFTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_hotelregi">
                            <label>23. Signature <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_hotelregi" name="seal_and_stamp_for_hotelregi"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" class="spinner_container_for_hotelregi_{{VALUE_SIXTEEN}}" onchange="Hotelregi.listview.uploadDocumentForHotelregi(VALUE_SIXTEEN);">
                            <div class="error-message error-message-hotelregi-seal_and_stamp_for_hotelregi"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_hotelregi" style="display: none;">
                            <label>23. Principal Employer Seal & Stamp <span style="color: red;">* </label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_hotelregi" style="width: 250px; height: 250px; border: 2px solid blue;"></a>
                            <button type="button" id="seal_and_stamp_remove_btn" id="proposal_details_document_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_hotelregi_{{VALUE_SIXTEEN}}" style="vertical-align: top;"
                                    onclick="Hotelregi.listview.askForRemove('{{hotelregi_data.hotelregi_id}}', VALUE_SIXTEEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <hr class="m-b-1rem"> 
                    <div class="form-group">
                        <button type="button" id="draft_btn_for_hotelregi" class="btn btn-sm btn-nic-blue" onclick="Hotelregi.listview.submitHotelregi({{VALUE_ONE}});" style="margin-right: 5px;"><i class="fas fa-download"></i>&nbsp; Save as a Draft</button>
                        <button type="button" id="submit_btn_for_hotelregi" class="btn btn-sm btn-success" onclick="Hotelregi.listview.askForSubmitHotelregi({{VALUE_TWO}});" style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Hotelregi.listview.loadHotelregiData();"><i class="fas fa-times"></i>&nbsp; Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>