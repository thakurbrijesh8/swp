<div class="row">
   <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Questionnaires for recognition as manufacturer of Boiler & Boiler components</div>
                
            </div>
            <form role="form" id="boiler_manufacture_form" name="boiler_manufacture_form" onsubmit="return false;">
                <input type="hidden" name="temp_copy_of_noc" id="temp_copy_of_noc" class="form-control" value="{{boilerManufacture_data.copy_of_noc}}">
                <input type="hidden" name="temp_plan_of_workshop" id="temp_plan_of_workshop" class="form-control" value="{{boilerManufacture_data.plan_of_workshop}}">
                <input type="hidden" name="temp_signature_and_seal" id="temp_signature_and_seal" class="form-control" value="{{boilerManufacture_data.signature_and_seal}}">
                <input type="hidden" id="boilermanufacture_id" name="boilermanufacture_id" value="{{boilerManufacture_data.boilermanufacture_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-boiler-manufacture f-w-b" style="border-bottom: 2px solid red;"></span>
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
                            <span class="error-message error-message-boiler-manufacture-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('boiler-manufacture', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Name Of the firm<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_firm" name="name_of_firm" class="form-control" placeholder="Enter Name Of the firm !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'name_of_firm', firmNameValidationMessage);" value="{{boilerManufacture_data.name_of_firm}}">
                            </div>
                            <span class="error-message error-message-boiler-manufacture-name_of_firm"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>3. Address of the Workshop<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="address_of_workshop" name="address_of_workshop" class="form-control" placeholder="Enter Address of the Workshop !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'address_of_workshop', workshopAddressValidationMessage);">{{boilerManufacture_data.address_of_workshop}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-address_of_workshop"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4. Address for Communication<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="address_of_communication" name="address_of_communication" class="form-control" placeholder="Enter Address for Communication !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'address_of_communication', commAddressValidationMessage);">{{boilerManufacture_data.address_of_communication}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-address_of_communication"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Type of jobs executed by the firm earlier,With special Reference to their maximum
                            Working pressure, temperature And the Materials involved<span class="color-nic-red">*</span></label>
                            <div class="input-group" style="margin-top: 22px;">
                                <textarea id="type_of_jobs" name="type_of_jobs" class="form-control" placeholder="Enter Type of jobs executed by the firm !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'type_of_jobs', jobTypeValidationMessage);">{{boilerManufacture_data.type_of_jobs}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-type_of_jobs"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>6. Whether having rectifier / generator, grinder,General tools And tackles, dye penetrant kit,Expander and measuring instruments or any Other tools and tackles NDT facilities, Heat Treatment etc<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="tools_and_tackles" name="tools_and_tackles" class="form-control" placeholder="Enter tools and tackles !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'tools_and_tackles', toolsValidationMessage);">{{boilerManufacture_data.tools_and_tackles}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-tools_and_tackles"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div style="background-color: #d2d6de; padding: 5px;">
                            <span class="f-w-b" style="font-size: 15px; color: #000;">7. Detailed list of technical personnel & supervisory staff with qualification and experience</span>
                            <hr>
                            <table class="table table-bordered m-b-0px" id="technicalpersonnelList" style="margin-top: 10px;">
                                <thead>
                                    <tr style='color: #000;'>
                                        <th style="width: 10px">Sr.No.</th>
                                        <th> Supervisor Name</th>
                                        <th> Qualification</th>
                                        <th> Experience</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="technical_personnel_info_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer" align="right" >
                            <button type="button" class="btn btn-sm btn-nic-blue float-right" id="submit_btn_for_technicalpersonnel" onclick="BoilerManufacture.listview.addMultipleTechnicalPersone({});" style="margin-right: 5px;margin-top: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add supervisory staff
                            </button>
                        </div>
                    </div><br/><br/>
                    <div class="col-xs-12">
                        <div style="background-color: #d2d6de; padding: 5px;">
                            <span class="f-w-b" style="font-size: 15px; color: #000;">8. List of permanent welders with their experience :(enclose Xerox copy of welders certificate issued Under IBR)</span>
                            <hr>
                            <table class="table table-bordered m-b-0px" id="welderslList" style="margin-top: 10px;">
                                <thead>
                                    <tr style='color: #000;'>
                                        <th style="width: 10px">Sr.No.</th>
                                        <th> welder Name</th>
                                        <th> Experience</th>
                                        <!-- <th> welder Name</th> -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="welders_info_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer" align="right" >
                            <button type="button" class="btn btn-sm btn-nic-blue float-right" id="submit_btn_for_welder" onclick="BoilerManufacture.listview.addMultipleweldersdetail({});" style="margin-right: 5px;margin-top: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add welders
                            </button>
                        </div>
                    </div><br/><br/>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9. Whether the firm is prepared to execute the job Strictly in conformity with the IBR and maintain A high standard of work<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="standard_of_work" name="standard_of_work" class="form-control" placeholder="Enter A high standard of work !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'standard_of_work', standardWorkValidationMessage);">{{boilerManufacture_data.standard_of_work}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-standard_of_work"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>10. Whether the firm is prepared to accept full Responsibility for the work done and is prepared To clarify any controversial issue, If required ?<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="controversial_issue" name="controversial_issue" class="form-control" placeholder="Enter full Responsibility for the work done !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'controversial_issue', controversialIssueValidationMessage);">{{boilerManufacture_data.controversial_issue}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-controversial_issue"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>11. Whether the firm has an internal quality control System of their own ?</label>&nbsp;
                            <input type="checkbox" id="is_internal_quality_control" name="is_internal_quality_control" class="checkbox" value="{{is_checked}}">
                            <span class="error-message error-message-shop-is_internal_quality_control"></span>
                        </div>
                        <div class="form-group col-sm-6 quality_control_detail_div" style="display: none">
                            <label>11.1 If so, give details<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="quality_control_detail" name="quality_control_detail" class="form-control" placeholder="Enter internal quality control Details !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'quality_control_detail', qualityControlValidationMessage);">{{boilerManufacture_data.quality_control_detail}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-quality_control_detail"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>12. Details of power sanction<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="power_sanction" name="power_sanction" class="form-control" placeholder="Enter Details of power sanction!"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'power_sanction', powerSanctionValidationMessage);">{{boilerManufacture_data.power_sanction}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-power_sanction"></span>
                        </div>
                        <!-- <div class="form-group col-sm-6">
                            <label class="mb-none">12. Copy of NOC from Local authorities to undertake Manufacturing facility are to be enclosed</label>
                            <label><span style="color: red;">(Maximum File Size: 5MB)</span></label><br/>
                            <input type="file" id="copy_of_noc" name="copy_of_noc"
                                   accept="image/jpg,image/png,image/jpeg,image/gif" onchange="imagePdfValidation(this, nocCopyValidationMessage, 'copy_of_noc');">
                            <h5 id="copy_of_noc_container" style="display: none; margin-top: 0px;"></h5>
                            <span class="error-message error-message-boiler-manufacture-copy_of_noc"></span>
                        </div> -->
                        
                        <div class="col-6 m-b-5px" id="copy_of_noc_container_for_boilermanufacture">
                            <label>13. Copy of NOC from Local authorities to undertake Manufacturing facility are to be enclosed <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="copy_of_noc_for_boilermanufacture" name="copy_of_noc_for_boilermanufacture" class="spinner_container_for_boilermanufacture_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="BoilerManufacture.listview.uploadDocumentForBoilerManufacture(VALUE_ONE);">
                            <div class="error-message error-message-boiler-manufacture-copy_of_noc_for_boilermanufacture"></div>
                        </div>
                        <div class="form-group col-sm-6" id="copy_of_noc_name_container_for_boilermanufacture" style="display: none;">
                            <label>13. Copy of NOC from Local authorities to undertake Manufacturing facility are to be enclosed <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <a target="_blank" id="copy_of_noc_download"><label id="copy_of_noc_name_image_for_boilermanufacture" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boilermanufacture_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="copy_of_noc" class="btn btn-sm btn-danger spinner_name_container_for_boilermanufacture_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="BoilerManufacture.listview.askForRemove('{{boilerManufacture_data.boilermanufacture_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>14. Whether the firm is conversant with the Boilers Act,1923 and Indian Boiler Regulation, 1950<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="conversant_with_boiler" name="conversant_with_boiler" class="form-control" placeholder="Enter the firm is conversant with the Boilers Act,1923 and Indian Boiler Regulation, 1950 !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'conversant_with_boiler', conversantValidationMessage);">{{boilerManufacture_data.conversant_with_boiler}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-conversant_with_boiler"></span>
                        </div>
                        
                         <div class="col-6 m-b-5px" id="plan_of_workshop_container_for_boilermanufacture">
                            <label>15. plan of workshop showing the location of machines,Fabrication equipments, NDT equipments covering All the space area <span style="color: red;">* &nbsp; <br>(Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="plan_of_workshop_for_boilermanufacture" name="plan_of_workshop_for_boilermanufacture" class="spinner_container_for_boilermanufacture_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="BoilerManufacture.listview.uploadDocumentForBoilerManufacture(VALUE_TWO);">
                            <div class="error-message error-message-boiler-manufacture-plan_of_workshop_for_boilermanufacture"></div>
                        </div>
                        <div class="form-group col-sm-6" id="plan_of_workshop_name_container_for_boilermanufacture" style="display: none;">
                            <label>15. plan of workshop showing the location of machines,Fabrication equipments, NDT equipments covering All the space area <span style="color: red;">* &nbsp;<br>(Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="plan_of_workshop_download"><label id="plan_of_workshop_name_image_for_boilermanufacture" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boilermanufacture_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="plan_of_workshop" class="btn btn-sm btn-danger spinner_name_container_for_boilermanufacture_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="BoilerManufacture.listview.askForRemove('{{boilerManufacture_data.boilermanufacture_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        
                    </div>
                    <br/>
                   <div class="row">
                        <div class="form-group col-sm-6">
                            <label>16. Whether the aforesaid instruments are calibrated periodically</label>&nbsp;
                            <input type="checkbox" id="is_instruments_calibrated" name="is_instruments_calibrated" class="checkbox" value="{{is_checked}}">
                            <span class="error-message error-message-shop-is_instruments_calibrated"></span>
                        </div>
                        <div class="form-group col-sm-6 instruments_calibrate_detail_div" style="display: none">
                            <label>16.1 If so, give details<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="instruments_calibrate_detail" name="instruments_calibrate_detail" class="form-control" placeholder="Enter aforesaid instruments are calibrated Details !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'instruments_calibrate_detail', instrumentCalibrateValidationMessage);">{{boilerManufacture_data.instruments_calibrate_detail}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-instruments_calibrate_detail"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>17. Details of Testing facilities available<span class="color-nic-red">*</span></label>
                            <div class="input-group" style="margin-top: 22px;">
                                <textarea id="testing_facility" name="testing_facility" class="form-control" placeholder="Enter Details of Testing facilities available !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'testing_facility', testingFacilityValidationMessage);">{{boilerManufacture_data.testing_facility}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-testing_facility"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>18. Whether the recording system of documents, data storing,Processing etc has been computerized with Internet<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="recording_system" name="recording_system" class="form-control" placeholder="Enter the recording system of documents, data storing,Processing etc has been computerized with Internet !"
                                       maxlength="100" onblur="checkValidation('boiler-manufacture', 'recording_system', recordSystemValidationMessage);">{{boilerManufacture_data.recording_system}}</textarea>
                            </div>
                            <span class="error-message error-message-boiler-manufacture-recording_system"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="occupancy_certificate_copy_container_for_boilermanufacture">
                            <label>19.  A Copy of Occupancy Certificate.<span style="color: red;">*<br> (Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="occupancy_certificate_copy_for_boilermanufacture" name="occupancy_certificate_copy_for_boilermanufacture" class="spinner_container_for_boilermanufacture_{{VALUE_THREE}}"
                                   accept="application/pdf" onchange="BoilerManufacture.listview.uploadDocumentForBoilerManufacture(VALUE_THREE);">
                            <div class="error-message error-message-boiler-manufacture-occupancy_certificate_copy_for_boilermanufacture"></div>
                        </div>
                        <div class="form-group col-sm-12" id="occupancy_certificate_copy_name_container_for_boilermanufacture" style="display: none;">
                            <label>19.  A Copy of Occupancy Certificate.<span style="color: red;">*<br> (Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="occupancy_certificate_copy_download"><label id="occupancy_certificate_copy_name_image_for_boilermanufacture" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boilermanufacture_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="occupancy_certificate_copy" class="btn btn-sm btn-danger spinner_name_container_for_boilermanufacture_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="BoilerManufacture.listview.askForRemove('{{boilerManufacture_data.boilermanufacture_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="factory_license_copy_container_for_boilermanufacture">
                            <label>20.  A Copy of Factory License.<span style="color: red;">*<br> (Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="factory_license_copy_for_boilermanufacture" name="factory_license_copy_for_boilermanufacture" class="spinner_container_for_boilermanufacture_{{VALUE_FOUR}}"
                                   accept="application/pdf" onchange="BoilerManufacture.listview.uploadDocumentForBoilerManufacture(VALUE_FOUR);">
                            <div class="error-message error-message-boiler-manufacture-factory_license_copy_for_boilermanufacture"></div>
                        </div>
                        <div class="form-group col-sm-12" id="factory_license_copy_name_container_for_boilermanufacture" style="display: none;">
                            <label>20.  A Copy of Factory License.<span style="color: red;">*<br> (Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="factory_license_copy_download"><label id="factory_license_copy_name_image_for_boilermanufacture" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boilermanufacture_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="factory_license_copy" class="btn btn-sm btn-danger spinner_name_container_for_boilermanufacture_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="BoilerManufacture.listview.askForRemove('{{boilerManufacture_data.boilermanufacture_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                          <div class="col-12 m-b-5px" id="machinery_layout_copy_container_for_boilermanufacture">
                            <label>21.  Copy of Plan of Machinery layout along with the list of equipment & machinery, tools & tackles and NDT facilities.<span style="color: red;">*<br> (Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="machinery_layout_copy_for_boilermanufacture" name="machinery_layout_copy_for_boilermanufacture" class="spinner_container_for_boilermanufacture_{{VALUE_FIVE}}"
                                   accept="application/pdf" onchange="BoilerManufacture.listview.uploadDocumentForBoilerManufacture(VALUE_FIVE);">
                            <div class="error-message error-message-boiler-manufacture-machinery_layout_copy_for_boilermanufacture"></div>
                        </div>
                        <div class="form-group col-sm-12" id="machinery_layout_copy_name_container_for_boilermanufacture" style="display: none;">
                            <label>21.  Copy of Plan of Machinery layout along with the list of equipment & machinery, tools & tackles and NDT facilities.<span style="color: red;">*<br> (Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="machinery_layout_copy_download"><label id="machinery_layout_copy_name_image_for_boilermanufacture" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boilermanufacture_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="machinery_layout_copy" class="btn btn-sm btn-danger spinner_name_container_for_boilermanufacture_{{VALUE_FIVE}}" style="vertical-align: top;"
                                    onclick="BoilerManufacture.listview.askForRemove('{{boilerManufacture_data.boilermanufacture_id}}', VALUE_FIVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                   
                     <div class="row">
                          <div class="col-12 m-b-5px" id="qualification_detail_container_for_boilermanufacture">
                            <label>22.  Details of a qualification & experience of personnel employed (Certificates of welders are to be enclosed).<span style="color: red;">*<br> (Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="qualification_detail_for_boilermanufacture" name="qualification_detail_for_boilermanufacture" class="spinner_container_for_boilermanufacture_{{VALUE_SIX}}"
                                   accept="application/pdf" onchange="BoilerManufacture.listview.uploadDocumentForBoilerManufacture(VALUE_SIX);">
                            <div class="error-message error-message-boiler-manufacture-qualification_detail_for_boilermanufacture"></div>
                        </div>
                        <div class="form-group col-sm-12" id="qualification_detail_name_container_for_boilermanufacture" style="display: none;">
                            <label>22.  Details of a qualification & experience of personnel employed (Certificates of welders are to be enclosed).<span style="color: red;">*<br> (Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="qualification_detail_download"><label id="qualification_detail_name_image_for_boilermanufacture" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boilermanufacture_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="qualification_detail" class="btn btn-sm btn-danger spinner_name_container_for_boilermanufacture_{{VALUE_SIX}}" style="vertical-align: top;"
                                    onclick="BoilerManufacture.listview.askForRemove('{{boilerManufacture_data.boilermanufacture_id}}', VALUE_SIX);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div> 
                    <div class="row">
                        <div class="col-12 m-b-5px" id="shop_photograph_copy_container_for_boilermanufacture">
                            <label>23.  Few photographs of shop floor showing equipment, machinery and NDT facilities.<span style="color: red;">&nbsp;  <br>(Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <input type="file" id="shop_photograph_copy_for_boilermanufacture" name="shop_photograph_copy_for_boilermanufacture" class="spinner_container_for_boilermanufacture_{{VALUE_SEVEN}}"
                                   accept="application/pdf" onchange="BoilerManufacture.listview.uploadDocumentForBoilerManufacture(VALUE_SEVEN);">
                            <div class="error-message error-message-boiler-manufacture-shop_photograph_copy_for_boilermanufacture"></div>
                        </div>
                        <div class="form-group col-sm-12" id="shop_photograph_copy_name_container_for_boilermanufacture" style="display: none;">
                            <label>23.  Few photographs of shop floor showing equipment, machinery and NDT facilities.<span style="color: red;">&nbsp;  <br>(Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                            <a target="_blank" id="shop_photograph_copy_download"><label id="shop_photograph_copy_name_image_for_boilermanufacture" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_boilermanufacture_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="shop_photograph_copy" class="btn btn-sm btn-danger spinner_name_container_for_boilermanufacture_{{VALUE_SEVEN}}" style="vertical-align: top;"
                                    onclick="BoilerManufacture.listview.askForRemove('{{boilerManufacture_data.boilermanufacture_id}}', VALUE_SEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                    
                    <div class="row">
                        <div class="col-12 m-b-5px" id="signature_and_seal_container_for_boilermanufacture">
                            <label>24. Signature & Seal <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="signature_and_seal_for_boilermanufacture" name="signature_and_seal_for_boilermanufacture" class="spinner_container_for_boilermanufacture_{{VALUE_EIGHT}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="BoilerManufacture.listview.uploadDocumentForBoilerManufacture(VALUE_EIGHT);">
                            <div class="error-message error-message-boiler-manufacture-signature_and_seal_for_boilermanufacture"></div>
                        </div>
                        <div class="form-group col-sm-12" id="signature_and_seal_name_container_for_boilermanufacture" style="display: none;">
                            <label>24. Signature & Seal <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="signature_and_seal_download"><img id="signature_and_seal_name_image_for_boilermanufacture" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_boilermanufacture_{{VALUE_EIGHT}}"></a>
                            <button type="button" id="signature_and_seal" class="btn btn-sm btn-danger spinner_name_container_for_boilermanufacture_{{VALUE_EIGHT}}" style="vertical-align: top;" 
                                    onclick="BoilerManufacture.listview.askForRemove('{{boilerManufacture_data.boilermanufacture_id}}', VALUE_EIGHT);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="form-group">
                        <button type="button" id="draft_btn_for_manufacturer" class="btn btn-sm btn-nic-blue" onclick="BoilerManufacture.listview.submitBoilerManufacture({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button>
                        <button type="button" id="submit_btn_for_manufacturer" class="btn btn-sm btn-success" onclick="BoilerManufacture.listview.askForBoilerManufacture({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="BoilerManufacture.listview.loadBoilerManufactureData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>