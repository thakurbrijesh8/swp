<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">ADMINISTRATION OF DADRA & NAGAR HAVELI AND DAMAN & DIU</h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">DEPARTMENT OF LABOUR</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Establishments Employing Migrant Workmans Renewal Form</div>
            </div>
            <form role="form" id="migrantworkers_renewal_form" name="migrantworkers_renewal_form" onsubmit="return false;">

                <input type="hidden" id="migrantworkers_renewal_id" name="migrantworkers_renewal_id" value="{{migrantworkersrenewal_data.migrantworkers_renewal_id}}">
                <input type="hidden" id="migrantworkers_id" name="migrantworkers_id" value="{{migrantworkersrenewal_data.mw_id}}">
                <input type="hidden" id="last_valid_upto" name="last_valid_upto" value="{{migrantworkersrenewal_data.valid_upto}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-migrantworkersrenewal f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            To,<br>
                            The Director,<br>
                            Department of Labour,<br>
                            Dadra & Nagar Haveli and  Daman & Diu.<br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. Establishment License Number <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="registration_number" name="registration_number" class="form-control" placeholder="Enter License Number !"
                                       maxlength="100" value="{{migrantworkersrenewal_data.registration_number}}" onblur="MigrantworkersRenewal.listview.getMigrantworkersData($(this))">
                            </div>
                            <span class="error-message error-message-migrantworkersrenewal-registration_number"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. District <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <select id="district" name="district" class="form-control select2"
                                        data-placeholder="Select District" style="width: 100%;">  
                                </select>
                            </div>
                            <span class="error-message error-message-migrantworkersrenewal-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>2.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('migrantworkersrenewal', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-migrantworkersrenewal-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>3. Name of the Establishment <span style="color: red;">*</span></label>
                            <input type="text" id="name_of_migrantworkersrenewal_registration" name="name_of_migrantworkersrenewal_registration" class="form-control" placeholder="Establishment Name !"
                                   maxlength="100" onblur="checkValidation('migrantworkersrenewal', 'name_of_migrantworkersrenewal_registration', establishmentNameValidationMessage);" value="{{migrantworkersrenewal_data.name_of_establishment}}">
                            <span class="error-message error-message-migrantworkersrenewal-name_of_migrantworkersrenewal_registration"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4. Location of the Establishment  <span style="color: red;">*</span></label>
                            <textarea id="loaction_for_migrantworkersrenewal_registration" name="loaction_for_migrantworkersrenewal_registration" class="form-control"
                                      onblur="checkValidation('migrantworkersrenewal', 'loaction_for_migrantworkersrenewal_registration', establishmentLocationValidationMessage);"
                                      placeholder="Location of the Establishment !" maxlength="200">{{migrantworkersrenewal_data.location_of_establishment}}</textarea>
                            <span class="error-message error-message-migrantworkersrenewal-loaction_for_migrantworkersrenewal_registration"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Postal Address of the Establishment <span style="color: red;">*</span></label>
                            <textarea id="postal_address_for_migrantworkersrenewal_registration" name="postal_address_for_migrantworkersrenewal_registration" class="form-control"
                                      onblur="checkValidation('migrantworkersrenewal', 'postal_address_for_migrantworkersrenewal_registration', establishmentPostalAddressValidationMessage);"
                                      placeholder="Postal Address of the Establishment !" maxlength="200">{{migrantworkersrenewal_data.postal_address_of_establishment}}</textarea>
                            <span class="error-message error-message-migrantworkersrenewal-postal_address_for_migrantworkersrenewal_registration"></span>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>6. Nature of work carried on in the establishment / Type of bussiness / Trade / Industry / Manufacture / Occupation <span style="color: red;">*</span></label>
                            <input type="text" id="nature_of_work_for_migrantworkersrenewal_registration" name="nature_of_work_for_migrantworkersrenewal_registration" class="form-control" placeholder="Nature of work carried on in the establishment / Type of bussiness / Trade / Industry / Manufacture / Occupation !"
                                   maxlength="150" onblur="checkValidation('migrantworkersrenewal', 'nature_of_work_for_migrantworkersrenewal_registration', establishmentTypeValidationMessage);" value="{{migrantworkersrenewal_data.nature_of_work_of_establishment}}">
                            <span class="error-message error-message-migrantworkersrenewal-nature_of_work_for_migrantworkersrenewal_registration"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Principal Employer Information</h3>
                    <hr class="m-b-5px">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7. Full Name of the Principal Employer  <span style="color: red;">*</span> (furnish father's name in the case of individuals)</label>
                            <input type="text" id="principle_employer_full_name_for_migrantworkersrenewal_registration" name="principle_employer_full_name_for_migrantworkersrenewal_registration" class="form-control" placeholder="Principal Employer Full Name !"
                                   maxlength="150"  onblur="checkValidation('migrantworkersrenewal', 'principle_employer_full_name_for_migrantworkersrenewal_registration', establishmentPrincipalNameValidationMessage);" value="{{migrantworkersrenewal_data.principal_employer_name}}">
                            <span class="error-message error-message-migrantworkersrenewal-principle_employer_full_name_for_migrantworkersrenewal_registration"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8. Address of the Principal Employer <span style="color: red;">*</span></label>
                            <textarea id="principle_employer_address_for_migrantworkersrenewal_registration" name="principle_employer_address_for_migrantworkersrenewal_registration" class="form-control"
                                      onblur="checkValidation('migrantworkersrenewal', 'principle_employer_address_for_migrantworkersrenewal_registration', establishmentPrincipalAddressValidationMessage);" 
                                      placeholder="Address of the Principal Employer !" maxlength="200">{{migrantworkersrenewal_data.principal_employer_address}}</textarea>
                            <span class="error-message error-message-migrantworkersrenewal-principle_employer_address_for_migrantworkersrenewal_registration"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Directors/Particular Partners Information (in case of companies and firms)</h3>
                    <hr class="m-b-5px">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9. Full Name of the Directors/Particular Partners of the establishment</label>
                            <input type="text" id="directors_or_partners_name_migrantworkersrenewal_registration" name="directors_or_partners_name_migrantworkersrenewal_registration" class="form-control" placeholder="Full Name of the Directors/Particular Partners !"
                                   maxlength="100"   value="{{migrantworkersrenewal_data.directors_or_partners_name}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>10. Address of the Directors/Particular Partners of the establishment</label>
                            <textarea id="directors_or_partners_address_for_migrantworkersrenewal_registration" name="directors_or_partners_address_for_migrantworkersrenewal_registration" class="form-control"
                                      placeholder="Address of the Directors/Particular Partners !" maxlength="200">{{migrantworkersrenewal_data.directors_or_partners_address}}</textarea>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Manager Information</h3>
                    <hr class="m-b-5px">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>11. Full Name of the Manager or Person responsible for the supervision and control of the establishment <span style="color: red;">*</span></label>
                            <input type="text" id="manager_or_person_full_name_migrantworkersrenewal_registration" name="manager_or_person_full_name_migrantworkersrenewal_registration" class="form-control" placeholder="Full Name of the Manager or Person !"
                                   maxlength="150"   onblur="checkValidation('migrantworkersrenewal', 'manager_or_person_full_name_migrantworkersrenewal_registration', establishmentManagerNameValidationMessage);" value="{{migrantworkersrenewal_data.manager_or_persons_name}}">
                            <span class="error-message error-message-migrantworkersrenewal-manager_or_person_full_name_migrantworkersrenewal_registration"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>12. Address of the Manager or Person responsible for the supervision and control of the establishment <span style="color: red;">*</span></label>
                            <textarea id="manager_or_person_address_for_migrantworkersrenewal_registration" name="manager_or_person_address_for_migrantworkersrenewal_registration" class="form-control"
                                      onblur="checkValidation('migrantworkersrenewal', 'manager_or_person_address_for_migrantworkersrenewal_registration', establishmentManagerAddressValidationMessage);"
                                      placeholder="Address of the Manager or Person !" maxlength="200">{{migrantworkersrenewal_data.manager_or_persons_address}}</textarea>
                            <span class="error-message error-message-migrantworkersrenewal-manager_or_person_address_for_migrantworkersrenewal_registration"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">13. Particular of contractors and migrant workman</h3>
                    <hr class="m-b-5px">
                    <div class="col-xs-12">
                        <div style="background-color: #d2d6de; padding: 3px;">
                            <table class="table table-bordered m-b-0px" id="contractors_and_migrant_workman_list" style="margin-top: 10px;">
                                <thead>
                                    <tr style='color: #000;'>
                                    </tr>
                                </thead>
                                <tbody id="contractors_and_migrant_workman_details_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer" align="right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-sm btn-nic-blue" onclick="MigrantWorkers.listview.addMultipleContractor({});"
                                    style="margin-right: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add Contractor</button>
                        </div>
                    </div>
                    <hr class="m-b-5px">
                    <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_migrantworkersrenewal">
                            <label>14. Signature<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_migrantworkersrenewal" name="seal_and_stamp_for_migrantworkersrenewal"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" class="spinner_container_for_migrantworkersrenewal_{{VALUE_ONE}}" onchange="MigrantworkersRenewal.listview.uploadDocumentForMigrantworkersRenewal(VALUE_ONE);">
                            <div class="error-message error-message-migrantworkersrenewal-seal_and_stamp_for_migrantworkersrenewal"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_migrantworkersrenewal" style="display: none;">
                            <label>14. Principal Employer Seal & Stamp <span style="color: red;">* </label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_migrantworkersrenewal" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_migrantworkersrenewal_{{VALUE_ONE}}"></a>
                            <button type="button" id="seal_and_stamp_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_migrantworkersrenewal_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="MigrantworkersRenewal.listview.askForRemove('{{migrantworkersrenewal_data.migrantworkers_renewal_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <hr class="m-b-1rem"> 

                    <div class="form-group">
                        <button type="button" id="draft_btn_for_migrantworkersrenewal" class="btn btn-sm btn-nic-blue" onclick="MigrantworkersRenewal.listview.submitMigrantworkersRenewal({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button>
                        <button type="button" id="submit_btn_for_migrantworkersrenewal" class="btn btn-sm btn-success" onclick="MigrantworkersRenewal.listview.askForSubmitMigrantworkersRenewal({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="MigrantworkersRenewal.listview.loadMigrantworkersRenewalData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>