<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">SCHEDULE – II “B”</h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">[See rule 11 (2)]</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Form - LM – 2 </div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">[Application for renewal License as Manufacture of Weights & Measures under the Legal Metrology Act, 2009]</div>
            </div>
            <form role="form" id="manufacturer_renewal_form" name="manufacturer_renewal_form" onsubmit="return false;">
                <input type="hidden" id="manufacturer_renewal_id" name="manufacturer_renewal_id" value="{{manufacturer_renewal_data.manufacturer_renewal_id}}">
                <input type="hidden" id="manufacturer_id" name="manufacturer_id" value="{{manufacturer_renewal_data.manufacturer_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-manufacturer f-w-b" style="border-bottom: 2px solid red;"></span>
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
                            <span class="error-message error-message-manufacturer-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('manufacturer', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-manufacturer-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Manufacturing License Number<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="admin_registration_number" name="admin_registration_number" class="form-control" placeholder="Enter Manufacturing License Number !"
                                       maxlength="100" value="{{manufacturer_renewal_data.admin_registration_number}}" onblur="ManufacturerRenewal.listview.getManufacturerData($(this));checkValidation('manufacturer', 'admin_registration_number', licenseNumberValidationMessage);">
                            </div>
                            <span class="error-message error-message-manufacturer-admin_registration_number"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>3. Name of manufacturing concern for which license is desired<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_manufacturer" name="name_of_manufacturer" class="form-control" placeholder="Enter Name of the concern seeking the license !"
                                       maxlength="100" onblur="checkValidation('manufacturer', 'name_of_manufacturer', manufacturerNameValidationMessage);" value="{{manufacturer_renewal_data.name_of_manufacturer}}">
                            </div>
                            <span class="error-message error-message-manufacturer-name_of_manufacturer"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4. Complete address of the concern <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="complete_address" name="complete_address" class="form-control" placeholder="Enter Complete address of the workshop !" maxlength="100" onblur="checkValidation('manufacturer', 'complete_address', workshopAddressValidationMessage);">{{manufacturer_renewal_data.complete_address}}</textarea>
                            </div>
                            <span class="error-message error-message-manufacturer-complete_address"></span>
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
                            <span class="error-message error-message-manufacturer-is_limited_company"></span>
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
                                        <th>Father's Name </th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="proprietor_info_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer" align="right" >
                            <button type="button" class="btn btn-sm btn-nic-blue float-right" id="submit_btn_for_principle_product" onclick="ManufacturerRenewal.listview.addMultipleProprietor({});" style="margin-right: 5px;margin-top: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add Proprietor
                            </button>
                        </div>
                    </div><br/><br/>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Type of weights and measures which are manufactured as per license granted<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="weights_type" name="weights_type" class="form-control" placeholder="Enter Type of weights and measures which are manufactured as per license granted !"
                                       maxlength="100" onblur="checkValidation('manufacturer', 'weights_type', weightTypeValidationMessage);" value="{{manufacturer_renewal_data.weights_type}}">
                            </div>
                            <span class="error-message error-message-manufacturer-weights_type"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7. Do you propose any change<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="propose_change" name="propose_change" class="form-control" placeholder="Enter any change !"
                                       maxlength="100" onblur="checkValidation('manufacturer', 'propose_change', proposeChangeValidationMessage);" value="{{manufacturer_renewal_data.propose_change}}">
                            </div>
                            <span class="error-message error-message-manufacturer-propose_change"></span>
                        </div>
                    </div>

                <div class="row">
                        <div class="col-12 m-b-5px" id="monogram_uploader_container_for_manufacturer">
                            <label>8. The monogram or trade mark intended to be Imprinted on weights and measures to be manufactured<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="monogram_uploader_for_manufacturer" name="monogram_uploader_for_manufacturer" class="spinner_container_for_manufacturer_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="ManufacturerRenewal.listview.uploadDocumentForManufacturerRenewal(VALUE_ONE);">
                            <div class="error-message error-message-manufacturer-monogram_uploader_for_manufacturer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="monogram_uploader_name_container_for_manufacturer" style="display: none;">
                            <label>8.1 The monogram or trade mark intended to be Imprinted on weights and measures to be manufactured<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="monogram_uploader_download"><label id="monogram_uploader_name_image_for_manufacturer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_manufacturer_renewal_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="monogram_uploader" class="btn btn-sm btn-danger spinner_name_container_for_manufacturer_renewal_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="ManufacturerRenewal.listview.askForRemove('{{manufacturer_renewal_data.manufacturer_renewal_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9. Details of foundry/workshop facilities arranged whether ownership, long term lease etc<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="details_of_foundry" name="details_of_foundry" class="form-control" placeholder="Enter Details of foundry/workshop facilities arranged whether ownership, long term lease etc !"
                                       maxlength="100" onblur="checkValidation('manufacturer', 'details_of_foundry', foundryValidationMessage);">{{manufacturer_renewal_data.details_of_foundry}}</textarea>
                            </div>
                            <span class="error-message error-message-manufacturer-details_of_foundry"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>10. Details of production and sales in the last 5 year<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="production_sales" name="production_sales" class="form-control" placeholder="Enter Details of foundry/workshop facilities arranged whether ownership, long term lease etc !"
                                       maxlength="100" onblur="checkValidation('manufacturer', 'production_sales', productionSalesValidationMessage);">{{manufacturer_renewal_data.production_sales}}</textarea>
                            </div>
                            <span class="error-message error-message-manufacturer-production_sales"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>11. Date of factory/shop/establishment/Municipal Trade License<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="registration_date" id="registration_date" class="form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{registration_date}}" onblur="checkValidation('manufacturer', 'registration_date', shopDateValidationMessage);">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-manufacturer-registration_date"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>12. Registration Number of factory/shop/establishment/Municipal Trade License<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="registration_number" name="registration_number" class="form-control" placeholder="Enter Registration Number of shop/establishment/Municipal Trade License !"
                                       maxlength="100" onblur="checkValidation('manufacturer', 'registration_number', shopRegNoValidationMessage);" value="{{manufacturer_renewal_data.registration_number}}">
                            </div>
                            <span class="error-message error-message-manufacturer-registration_number"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>13. Select one Identity</label>
                            <div class="input-group">
                                <select class="form-control" style="margin-top: 22px;" 
                                    data-placeholder="Status !" name="identity_choice" id="identity_choice" onblur="checkValidation('manufacturer', 'identity_choice', identityChoiceValidationMessage);">
                                    <option value="">Select one Identity</option>
                                    <option value="1">VAT Registration Number</option>
                                    <option value="2">Sales Tax Registration Number</option>
                                    <option value="3">CST Number</option>
                                    <option value="4">Professional Tax Registration Number</option>
                                    <option value="5">IT Number</option>
                                </select>
                            </div>
                            <span class="error-message error-message-manufacturer-identity_choice"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>14. Vat/Sales Tax Registration Numbers/CST Number/Professional Tax registration Number/It Number<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="identity_number" name="identity_number" class="form-control" placeholder="Enter Vat/Sales Tax Registration Numbers/CST Number/Professional Tax registration Number/It Number !"
                                       maxlength="100" onblur="checkValidation('manufacturer', 'identity_number', identityNoValidationMessage);" value="{{manufacturer_renewal_data.identity_number}}">
                            </div>
                            <span class="error-message error-message-manufacturer-identity_number"></span>
                        </div>
                    </div>
                    <h2 class="box-title f-w-b page-header f-s-20px m-b-0" >Document Required to be Uploaded with the Application</h2>
                    <br/>
               

                <div class="row">
                        <div class="col-12 m-b-5px" id="original_licence_container_for_manufacturer">
                            <label>15. Original Licence.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="original_licence_for_manufacturer" name="original_licence_for_manufacturer" class="spinner_container_for_manufacturer_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="ManufacturerRenewal.listview.uploadDocumentForManufacturerRenewal(VALUE_TWO);">
                            <div class="error-message error-message-manufacturer-original_licence_for_manufacturer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="original_licence_name_container_for_manufacturer" style="display: none;">
                            <label>15.1 Original Licence.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="original_licence_download"><label id="original_licence_name_image_for_manufacturer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_manufacturer_renewal_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="original_licence" class="btn btn-sm btn-danger spinner_name_container_for_manufacturer_renewal_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="ManufacturerRenewal.listview.askForRemove('{{manufacturer_renewal_data.manufacturer_renewal_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>


                <div class="row">
                        <div class="col-12 m-b-5px" id="renewed_licence_container_for_manufacturer">
                            <label>16. Renewed Licence.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="renewed_licence_for_manufacturer" name="renewed_licence_for_manufacturer" class="spinner_container_for_manufacturer_{{VALUE_THREE}}"
                                   accept="application/pdf" onchange="ManufacturerRenewal.listview.uploadDocumentForManufacturerRenewal(VALUE_THREE);">
                            <div class="error-message error-message-manufacturer-renewed_licence_for_manufacturer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="renewed_licence_name_container_for_manufacturer" style="display: none;">
                            <label>16.1 Renewed Licence.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="renewed_licence_download"><label id="renewed_licence_name_image_for_manufacturer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_manufacturer_renewal_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="renewed_licence" class="btn btn-sm btn-danger spinner_name_container_for_manufacturer_renewal_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="ManufacturerRenewal.listview.askForRemove('{{manufacturer_renewal_data.manufacturer_renewal_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
             

                <div class="row">
                        <div class="col-12 m-b-5px" id="periodical_return_container_for_manufacturer">
                            <label>17. Register/ Periodical Return LM-4.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="periodical_return_for_manufacturer" name="periodical_return_for_manufacturer" class="spinner_container_for_manufacturer_{{VALUE_FOUR}}"
                                   accept="application/pdf" onchange="ManufacturerRenewal.listview.uploadDocumentForManufacturerRenewal(VALUE_FOUR);">
                            <div class="error-message error-message-manufacturer-periodical_return_for_manufacturer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="periodical_return_name_container_for_manufacturer" style="display: none;">
                            <label>17.1 Register/ Periodical Return LM-4.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="periodical_return_download"><label id="periodical_return_name_image_for_manufacturer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_manufacturer_renewal_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="periodical_return" class="btn btn-sm btn-danger spinner_name_container_for_manufacturer_renewal_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="ManufacturerRenewal.listview.askForRemove('{{manufacturer_renewal_data.manufacturer_renewal_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
              
                <div class="row">
                        <div class="col-12 m-b-5px" id="verification_certificate_container_for_manufacturer">
                            <label>18. Verification Certificate of Weights & Measures and Test Equipment Tools.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="verification_certificate_for_manufacturer" name="verification_certificate_for_manufacturer" class="spinner_container_for_manufacturer_{{VALUE_FIVE}}"
                                   accept="application/pdf" onchange="ManufacturerRenewal.listview.uploadDocumentForManufacturerRenewal(VALUE_FIVE);">
                            <div class="error-message error-message-manufacturer-verification_certificate_for_manufacturer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="verification_certificate_name_container_for_manufacturer" style="display: none;">
                            <label>18.1 Verification Certificate of Weights & Measures and Test Equipment Tools.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="verification_certificate_download"><label id="verification_certificate_name_image_for_manufacturer" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_manufacturer_renewal_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="verification_certificate" class="btn btn-sm btn-danger spinner_name_container_for_manufacturer_renewal_{{VALUE_FIVE}}" style="vertical-align: top;"
                                    onclick="ManufacturerRenewal.listview.askForRemove('{{manufacturer_renewal_data.manufacturer_renewal_id}}', VALUE_FIVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12"> 
                            <strong>To Be Certified by Applicant</strong><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">19. &nbsp;
                                    <input type="checkbox" class="" name="declarationone" id="declarationone" autocomplete="true" value="{{is_checked}}" onblur="checkValidation('manufacturer', 'declarationone', declarationOneValidationMessage);">&nbsp;Certified that I/We have read the Legal Metrology Act,2009 and the Daman and Diu Legal Metrology (Enforcement) Rules, 2011 and agree to abide by the same and also the same and also the administrative orders and instructions issued or to be issued there under.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-manufacturer-declarationone"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">20. &nbsp;
                                    <input type="checkbox" class="" name="declarationtwo" id="declarationtwo" autocomplete="true" value="{{is_checked}}" onblur="checkValidation('manufacturer', 'declarationtwo', declarationTwoValidationMessage);">&nbsp;I/We agree to deposit the Scheduled license fees with Government as soon as required to do so by the Licensing Authority.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-manufacturer-declarationtwo"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">21. &nbsp;
                                    <input type="checkbox" class="" name="declarationthree" id="declarationthree" autocomplete="true" value="{{is_checked}}" onblur="checkValidation('manufacturer', 'declarationthree', declarationThreeValidationMessage);">&nbsp;All the information furnished above is true to the best of my/our knowledge.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-manufacturer-declarationthree"></span>
                        </div>
                    </div>
               

                    <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_manufacturer">
                            <label>22. Signature <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_manufacturer" name="seal_and_stamp_for_manufacturer" class="spinner_container_for_manufacturer_{{VALUE_SIX}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="ManufacturerRenewal.listview.uploadDocumentForManufacturerRenewal(VALUE_SIX);">
                            <div class="error-message error-message-manufacturer-seal_and_stamp_for_manufacturer"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_manufacturer" style="display: none;">
                            <label>22. Principal Employer Seal & Stamp <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_manufacturer" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_manufacturer_{{VALUE_SIX}}"></a>
                            <button type="button" id="seal_and_stamp" class="btn btn-sm btn-danger spinner_name_container_for_manufacturer_{{VALUE_SIX}}" style="vertical-align: top;" 
                                    onclick="ManufacturerRenewal.listview.askForRemove('{{manufacturer_renewal_data.manufacturer_renewal_id}}', VALUE_SIX);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                     <hr class="m-b-1rem"> 


                    <div class="form-group">
                        <button type="button" id="draft_btn_for_manufacturer" class="btn btn-sm btn-nic-blue" onclick="ManufacturerRenewal.listview.submitManufacturerRenewal({{VALUE_ONE}});" style="margin-right: 5px;"><i class="fas fa-download"></i>&nbsp; Save as a Draft</button>
                        <button type="button" id="submit_btn_for_manufacturer" class="btn btn-sm btn-success" onclick="ManufacturerRenewal.listview.askForSubmitManufacturerRenewal({{VALUE_TWO}});" style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="ManufacturerRenewal.listview.loadManufacturerRenewalData();"><i class="fas fa-times"></i>&nbsp; Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>