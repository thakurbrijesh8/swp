<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">SCHEDULE – II “A”</h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">[See rule 11 (1)]</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Form - LD – 1 </div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">[ Application Form for License as Dealers in Weights & Measures under the Legal Metrology Act, 2009 ]</div>
            </div>
            <form role="form" id="dealer_form" name="dealer_form" onsubmit="return false;">
                
                <input type="hidden" id="dealer_id" name="dealer_id" value="{{dealer_data.dealer_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-dealer f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            To,<br/>
                            The Assistant Controller,<br/>
                            Department of Legal Metrology,<br/>
                            (Weights & Measures)<br/>
                            Daman & Diu<br/>
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
                            <span class="error-message error-message-dealer-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('dealer', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-dealer-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Name of the establishment/shop/person seeking the license<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_dealer" name="name_of_dealer" class="form-control" placeholder="Enter Name of the establishment/shop/person seeking the license !"
                                       maxlength="100" onblur="checkValidation('dealer', 'name_of_dealer', dealerNameValidationMessage);" value="{{dealer_data.name_of_dealer}}">
                            </div>
                            <span class="error-message error-message-dealer-name_of_dealer"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>3. Complete address of the establishment etc <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="complete_address" name="complete_address" class="form-control" placeholder="Enter Complete address of the establishment !" maxlength="100" onblur="checkValidation('dealer', 'complete_address', workshopAddressValidationMessage);">{{dealer_data.complete_address}}</textarea>
                            </div>
                            <span class="error-message error-message-dealer-complete_address"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4. Date of Establishment of workshop/factory<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="establishment_date" id="establishment_date" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{establishment_date}}" onblur="checkValidation('dealer', 'establishment_date', establishmentDateValidationMessage);">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-dealer-establishment_date"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>5. Are you a Limited (Ltd) Company ?</label>&nbsp;
                            <!-- <input type="checkbox" id="is_limited_company" name="is_limited_company" class="checkbox" value="{{is_checked}}"> -->
                            <input type="radio" id="is_limited_company_yes" name="is_limited_company" class="" value="{{VALUE_ONE}}">&nbsp; Yes
                            &emsp;
                            <input type="radio" id="is_limited_company_no" name="is_limited_company" class="" style="margin-bottom: 0px;"
                                        value="{{VALUE_TWO}}" checked="">&nbsp;No
                            <span class="error-message error-message-dealer-is_limited_company"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 proprietor_info_div" style="display: none">
                        <div style="background-color: #d2d6de; padding: 5px;">
                            <span class="f-w-b" style="font-size: 15px; color: #000;">5.1 Name and Address Along with their father's / husband's name of proprietor and/or Patners and Managing Director's in the case of limited company</span>
                            <hr>
                            <table class="table table-bordered m-b-0px" id="proprietorList" style="margin-top: 10px;">
                                <thead>
                                    <tr style='color: #000;'>
                                        <th style="width: 10px">Sr.No.</th>
                                        <th>Name of Occupier</th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="proprietor_info_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer" align="right" >
                            <button type="button" class="btn btn-sm btn-nic-blue float-right" id="submit_btn_for_principle_product" onclick="Dealer.listview.addMultipleProprietor({});" style="margin-right: 5px;margin-top: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add Proprietor
                            </button>
                        </div>
                    </div><br/><br/>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Date Registration of Current of shop/establishment/Municipal Trade License<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="registration_date" id="registration_date" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{registration_date}}" onblur="checkValidation('dealer', 'registration_date', shopDateValidationMessage);">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-dealer-registration_date"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7. Registration Number of shop/establishment/Municipal Trade License<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="registration_number" name="registration_number" class="form-control" placeholder="Enter Registration Number of shop/establishment/Municipal Trade License !"
                                       maxlength="100" onblur="checkValidation('dealer', 'registration_number', shopRegNoValidationMessage);" value="{{dealer_data.registration_number}}">
                            </div>
                            <span class="error-message error-message-dealer-registration_number"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>8. Categories of weights and measures sold/proposed to be sold at present <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="categories_sold" name="categories_sold" class="form-control" placeholder="Enter Categories of weights and measures sold/proposed to be sold at present !" maxlength="100" onblur="checkValidation('dealer', 'categories_sold', categoriesSoldValidationMessage);">{{dealer_data.categories_sold}}</textarea>
                            </div>
                            <span class="error-message error-message-dealer-categories_sold"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9. Select one Identity</label>
                            <div class="input-group">
                                <select class="form-control" style="margin-top: 22px;" 
                                    data-placeholder="Status !" name="identity_choice" id="identity_choice" onblur="checkValidation('dealer', 'identity_choice', identityChoiceValidationMessage);">
                                    <option value="">Select one Identity</option>
                                </select>
                            </div>
                            <span class="error-message error-message-dealer-identity_choice"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>10. Vat/Sales Tax Registration Numbers/CST Number/Professional Tax registration Number/It Number<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="identity_number" name="identity_number" class="form-control" placeholder="Enter Vat/Sales Tax Registration Numbers/CST Number/Professional Tax registration Number/It Number !"
                                       maxlength="100" onblur="checkValidation('dealer', 'identity_number', identityNoValidationMessage);" value="{{dealer_data.identity_number}}">
                            </div>
                            <span class="error-message error-message-dealer-identity_number"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>11. Do you intend to import weights etc. from places outside the State/Country ?</label>&nbsp;
                            <!-- <input type="checkbox" id="import_from_outside" name="import_from_outside" class="checkbox" value="{{is_checked}}"> -->
                            <input type="radio" id="import_from_outside_yes" name="import_from_outside" class="" value="{{VALUE_ONE}}">&nbsp; Yes
                            &emsp;
                            <input type="radio" id="import_from_outside_no" name="import_from_outside" class="" style="margin-bottom: 0px;"
                                        value="{{VALUE_TWO}}" checked="">&nbsp;No
                            <span class="error-message error-message-dealer-import_from_outside"></span>
                        </div>
                    </div>
                    <div class="row import_from_outside_div" style="display: none;">
                        <div class="form-group col-sm-6">
                            <label>11.1 Registration of importer of Weights and Measures, if any</label>
                            <div class="input-group">
                                <input type="text" id="registration_of_importer" name="registration_of_importer" class="form-control" placeholder="Enter Registration of importer of Weights and Measures, if any !"
                                       maxlength="100" onblur="checkValidation('dealer', 'registration_of_importer', importerRegValidationMessage);" value="{{dealer_data.registration_of_importer}}">
                            </div>
                            <span class="error-message error-message-dealer-registration_of_importer"></span>
                        </div>
                  
                        <div class="form-group col-sm-6" id="import_model_container_for_dealer">
                            <label>11.2 Approval of model imported into India by Central Government<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="import_model_for_dealer" name="import_model_for_dealer" class="spinner_container_for_dealer_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_ONE);">
                            <div class="error-message error-message-dealer-import_model_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-6" id="import_model_name_container_for_dealer" style="display: none;">
                            <label>11.2 Approval of model imported into India by Central Government<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="import_model_download"><label id="import_model_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="import_model" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                   
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>12. Have you applied previously for a dealer’s license ?</label>&nbsp;
                            <!-- <input type="checkbox" id="any_previous_application" name="any_previous_application" class="checkbox" value="{{is_checked}}"> -->
                            <input type="radio" id="any_previous_application_yes" name="any_previous_application" class="" value="{{VALUE_ONE}}">&nbsp; Yes
                            &emsp;
                            <input type="radio" id="any_previous_application_no" name="any_previous_application" class="" style="margin-bottom: 0px;"
                                        value="{{VALUE_TWO}}" checked="">&nbsp;No
                            <span class="error-message error-message-dealer-any_previous_application"></span>
                        </div>
                    </div>
                    <div class="row any_previous_application_div" style="display: none;">
                        <div class="form-group col-sm-6">
                            <label>12.1 Date Applied On<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="license_application_date" id="license_application_date" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{license_application_date}}" onblur="checkValidation('dealer', 'license_application_date', appliedDateValidationMessage);">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-dealer-license_application_date"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>12.2 Result of the Application <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="license_application_result" name="license_application_result" class="form-control" placeholder="Enter Result of the Application !" maxlength="100" onblur="checkValidation('dealer', 'license_application_result', licenseResultValidationMessage);">{{dealer_data.license_application_result}}</textarea>
                            </div>
                            <span class="error-message error-message-dealer-license_application_result"></span>
                        </div>
                    </div>
                        
                    <h2 class="box-title f-w-b page-header f-s-20px m-b-0" >Document Required to be Uploaded with the Application</h2>
                    <br/>
               
                      <div class="row">
                        <div class="col-12 m-b-5px" id="model_approval_certificate_container_for_dealer">
                            <label>13. Model approval certificate issued by the Govt. of India.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="model_approval_certificate_for_dealer" name="model_approval_certificate_for_dealer" class="spinner_container_for_dealer_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_TWO);">
                            <div class="error-message error-message-dealer-model_approval_certificate_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="model_approval_certificate_name_container_for_dealer" style="display: none;">
                            <label>13.1 Model approval certificate issued by the Govt. of India.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="model_approval_certificate_download"><label id="model_approval_certificate_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="model_approval_certificate" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
             
                <div class="row">
                        <div class="col-12 m-b-5px" id="proof_of_ownership_container_for_dealer">
                            <label>14. Proof of ownership of business premises/ Rent agreement.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="proof_of_ownership_for_dealer" name="proof_of_ownership_for_dealer" class="spinner_container_for_dealer_{{VALUE_THREE}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_THREE);">
                            <div class="error-message error-message-dealer-proof_of_ownership_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="proof_of_ownership_name_container_for_dealer" style="display: none;">
                            <label>14.1 Proof of ownership of business premises/ Rent agreement.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="proof_of_ownership_download"><label id="proof_of_ownership_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="proof_of_ownership" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
              
            <div class="row">
                        <div class="col-12 m-b-5px" id="gst_certificate_container_for_dealer">
                            <label>15. GST Certificate.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="gst_certificate_for_dealer" name="gst_certificate_for_dealer" class="spinner_container_for_dealer_{{VALUE_FOUR}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_FOUR);">
                            <div class="error-message error-message-dealer-gst_certificate_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="gst_certificate_name_container_for_dealer" style="display: none;">
                            <label>15.1 GST Certificate.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="gst_certificate_download"><label id="gst_certificate_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="gst_certificate" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
    
                <div class="row">
                        <div class="col-12 m-b-5px" id="partnership_deed_container_for_dealer">
                            <label>16. Partnership deed<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="partnership_deed_for_dealer" name="partnership_deed_for_dealer" class="spinner_container_for_dealer_{{VALUE_FIVE}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_FIVE);">
                            <div class="error-message error-message-dealer-partnership_deed_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="partnership_deed_name_container_for_dealer" style="display: none;">
                            <label>16.1 Partnership deed<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="partnership_deed_download"><label id="partnership_deed_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="partnership_deed" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_FIVE}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_FIVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
              
                    <div class="row">
                        <div class="col-12 m-b-5px" id="memorandum_of_association_container_for_dealer">
                            <label>17. Memorandum & Articles of Association ( If operating a Private / Limited ).<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="memorandum_of_association_for_dealer" name="memorandum_of_association_for_dealer" class="spinner_container_for_dealer_{{VALUE_SIX}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_SIX);">
                            <div class="error-message error-message-dealer-memorandum_of_association_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="memorandum_of_association_name_container_for_dealer" style="display: none;">
                            <label>17.1 Memorandum & Articles of Association ( If operating a Private / Limited ).<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="memorandum_of_association_download"><label id="memorandum_of_association_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="memorandum_of_association" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_SIX}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_SIX);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                
                    <div class="row">
                        <div class="col-12 m-b-5px" id="list_of_raw_material_container_for_dealer">
                            <label>18. List of Raw Material Required.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="list_of_raw_material_for_dealer" name="list_of_raw_material_for_dealer" class="spinner_container_for_dealer_{{VALUE_SEVEN}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_SEVEN);">
                            <div class="error-message error-message-dealer-list_of_raw_material_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="list_of_raw_material_name_container_for_dealer" style="display: none;">
                            <label>18.1 List of Raw Material Required.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="list_of_raw_material_download"><label id="list_of_raw_material_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="list_of_raw_material" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_SEVEN}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_SEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
           
                <div class="row">
                        <div class="col-12 m-b-5px" id="list_of_machinery_container_for_dealer">
                            <label>19. List of Machinery & Tools.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="list_of_machinery_for_dealer" name="list_of_machinery_for_dealer" class="spinner_container_for_dealer_{{VALUE_EIGHT}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_EIGHT);">
                            <div class="error-message error-message-dealer-list_of_machinery_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="list_of_machinery_name_container_for_dealer" style="display: none;">
                            <label>19.1 List of Machinery & Tools.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="list_of_machinery_download"><label id="list_of_machinery_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="list_of_machinery" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_EIGHT}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_EIGHT);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                <div class="row">
                        <div class="col-12 m-b-5px" id="list_of_wm_container_for_dealer">
                            <label>20. List of Weights & Measures used and maintained<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="list_of_wm_for_dealer" name="list_of_wm_for_dealer" class="spinner_container_for_dealer_{{VALUE_NINE}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_NINE);">
                            <div class="error-message error-message-dealer-list_of_wm_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="list_of_wm_name_container_for_dealer" style="display: none;">
                            <label>20.1 List of Weights & Measures used and maintained<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="list_of_wm_download"><label id="list_of_wm_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="list_of_wm" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_NINE}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_NINE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

            <div class="row">
                        <div class="col-12 m-b-5px" id="list_of_directors_container_for_dealer">
                            <label>21. List of Directors/ Partners of the company as amended time to time.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="list_of_directors_for_dealer" name="list_of_directors_for_dealer" class="spinner_container_for_dealer_{{VALUE_TEN}}"
                                   accept="application/pdf" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_TEN);">
                            <div class="error-message error-message-dealer-list_of_directors_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="list_of_directors_name_container_for_dealer" style="display: none;">
                            <label>21.1 List of Directors/ Partners of the company as amended time to time.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="list_of_directors_download"><label id="list_of_directors_name_image_for_dealer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_dealer_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="list_of_directors" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_TEN}}" style="vertical-align: top;"
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_TEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12"> 
                            <strong>To Be Certified by Applicant</strong><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">22. &nbsp;
                                    <input type="checkbox" class="" name="declarationone" id="declarationone" autocomplete="true" value="{{is_checked}}" onblur="checkValidation('dealer', 'declarationone', declarationOneValidationMessage);">&nbsp;Certified that I/We have read the Legal Metrology Act,2009 and the Daman and Diu Legal Metrology (Enforcement) Rules, 2011 and agree to abide by the same and also the same and also the administrative orders and instructions issued or to be issued there under.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-dealer-declarationone"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">23. &nbsp;
                                    <input type="checkbox" class="" name="declarationtwo" id="declarationtwo" autocomplete="true" value="{{is_checked}}" onblur="checkValidation('dealer', 'declarationtwo', declarationTwoValidationMessage);">&nbsp;I/We agree to deposit the Scheduled license fees with Government as soon as required to do so by the Licensing Authority.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-dealer-declarationtwo"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">24. &nbsp;
                                    <input type="checkbox" class="" name="declarationthree" id="declarationthree" autocomplete="true" value="{{is_checked}}" onblur="checkValidation('dealer', 'declarationthree', declarationThreeValidationMessage);">&nbsp;All the information furnished above is true to the best of my/our knowledge.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-dealer-declarationthree"></span>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_dealer">
                            <label>15. Signature <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_dealer" name="seal_and_stamp_for_dealer" class="spinner_container_for_dealer_{{VALUE_ELEVEN}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="Dealer.listview.uploadDocumentForDealer(VALUE_ELEVEN);">
                            <div class="error-message error-message-dealer-seal_and_stamp_for_dealer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_dealer" style="display: none;">
                            <label>25. Principal Employer Seal & Stamp <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_dealer" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_dealer_{{VALUE_ELEVEN}}"></a>
                            <button type="button" id="seal_and_stamp" class="btn btn-sm btn-danger spinner_name_container_for_dealer_{{VALUE_ELEVEN}}" style="vertical-align: top;" 
                                    onclick="Dealer.listview.askForRemove('{{dealer_data.dealer_id}}', VALUE_ELEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <hr class="m-b-1rem"> 

                    <div class="form-group">
                        <button type="button" id="draft_btn_for_dealer" class="btn btn-sm btn-nic-blue" onclick="Dealer.listview.submitDealer({{VALUE_ONE}});" style="margin-right: 5px;"><i class="fas fa-download"></i>&nbsp; Save as Draft</button>
                        <button type="button" id="submit_btn_for_dealer" class="btn btn-sm btn-success" onclick="Dealer.listview.askForSubmitDealer({{VALUE_TWO}});" style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Dealer.listview.loadDealerData();"><i class="fas fa-times"></i>&nbsp; Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>