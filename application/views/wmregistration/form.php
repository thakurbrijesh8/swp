<div class="row">
    <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <!-- <h3 class="card-title" style="float: none; text-align: center;">Weight and Measure Form </h3> -->
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application format for Manufacturer/Packer/Importer, <br>Registration as per Rule Standard of Weight and Measures (P.C) <br> Rule,2011 U/s. 27</div>
            </div>
            <form role="form" id="wmregistration_form" name="wmregistration_form" onsubmit="return false;">
                
                <input type="hidden" id="wmregistration_id" name="wmregistration_id" value="{{wmregistration_data.wmregistration_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-wmregistration f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            To<br>
                            The Assistant Controller,<br>
                            Department of Legal Metrology,<br>
                            (Weights & Measures)<br>
                            Daman & Diu,
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
                            <span class="error-message error-message-wmregistration-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('wmregistration', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-wmregistration-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Name of Applicant<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_applicant" name="name_of_applicant" class="form-control" placeholder="Enter Name of Applicant !"
                                       maxlength="100" onblur="checkValidation('wmregistration', 'name_of_applicant', applicantNameValidationMessage);" value="{{wmregistration_data.name_of_applicant}}">
                            </div>
                            <span class="error-message error-message-wmregistration-name_of_applicant"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>3. Complete Address of Registered Office <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="location_of_factory" name="location_of_factory" class="form-control" placeholder="Enter Complete Address of Registered Office !" maxlength="100" onblur="checkValidation('wmregistration', 'location_of_factory', completeAddressValidationMessage);">{{wmregistration_data.location_of_factory}}</textarea>
                            </div>
                            <span class="error-message error-message-wmregistration-location_of_factory"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4. Complete Address of Manufacturing/Packing/Importing Premises <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="branches" name="branches" class="form-control" placeholder="Enter Complete Address of Manufacturing/Packing/Importing Premises !" maxlength="100" onblur="checkValidation('wmregistration', 'branches', branchValidationMessage);">{{wmregistration_data.branches}}</textarea>
                            </div>
                            <span class="error-message error-message-wmregistration-branches"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Item to be Manufactured/Packed/Imported</label>
                            <div class="input-group">
                                <select class="form-control" id="application_category" name="application_category"
                                    data-placeholder="Status !" onblur="checkValidation('wmregistration', 'application_category', applicantCategoryValidationMessage);">
                                    <option>Select the item (s) proposed to be manufactured will be sold</option>
                                    <option value="Manufactured">Manufactured</option>
                                    <option value="Packed">Packed</option>
                                    <option value="Imported">Imported</option>
                                </select>
                            </div>
                            <span class="error-message error-message-wmregistration-application_category"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>6. Item Detail<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="item_detail" name="item_detail" class="form-control" placeholder="Enter Item Detail !"
                                       maxlength="100" onblur="checkValidation('wmregistration', 'item_detail', itemDetailValidationMessage);" >{{wmregistration_data.item_detail}}</textarea>
                            </div>
                            <span class="error-message error-message-wmregistration-item_detail"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div style="background-color: #d2d6de; padding: 5px;">
                            <span class="f-w-b" style="font-size: 15px; color: #000;">7. Name and Address Along with their father's / husband's name of proprietor and/or Patners and Managing Director's in the case of limited company</span>
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
                            <button type="button" class="btn btn-sm btn-nic-blue float-right" id="submit_btn_for_principle_product" onclick="Wmregistration.listview.addMultipleProprietor({});" style="margin-right: 5px;margin-top: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add Proprietor
                            </button>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <h6 class="box-title f-w-b page-header f-s-20px m-b-0" >Document Required to be Uploaded with the Application</h6>
                    <br/>

                <div class="row">
                        <div class="col-12 m-b-5px" id="trade_licence_container_for_wmregistration">
                            <label>8.  Trade Licence.  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="trade_licence_for_wmregistration" name="trade_licence_for_wmregistration" class="spinner_container_for_wmregistration_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="Wmregistration.listview.uploadDocumentForWmregistration(VALUE_ONE);">
                            <div class="error-message error-message-wmregistration-trade_licence_for_wmregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="trade_licence_name_container_for_wmregistration" style="display: none;">
                            <label>8.1  Trade Licence.   <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="trade_licence_download"><label id="trade_licence_name_image_for_wmregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wmregistration_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="trade_licence" class="btn btn-sm btn-danger spinner_name_container_for_wmregistration_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="Wmregistration.listview.askForRemove('{{wmregistration_data.wmregistration_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>


                   <div class="row">
                        <div class="col-12 m-b-5px" id="proof_of_ownership_container_for_wmregistration">
                            <label>9. Proof of ownership of business premises/ Rent agreement. <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="proof_of_ownership_for_wmregistration" name="proof_of_ownership_for_wmregistration" class="spinner_container_for_wmregistration_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="Wmregistration.listview.uploadDocumentForWmregistration(VALUE_TWO);">
                            <div class="error-message error-message-wmregistration-proof_of_ownership_for_wmregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="proof_of_ownership_name_container_for_wmregistration" style="display: none;">
                            <label>9.1 Proof of ownership of business premises/ Rent agreement.    <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="proof_of_ownership_download"><label id="proof_of_ownership_name_image_for_wmregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wmregistration_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="proof_of_ownership" class="btn btn-sm btn-danger spinner_name_container_for_wmregistration_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="Wmregistration.listview.askForRemove('{{wmregistration_data.wmregistration_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                       <div class="row">
                        <div class="col-12 m-b-5px" id="gst_certificate_container_for_wmregistration">
                            <label>10. GST Certificate.  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="gst_certificate_for_wmregistration" name="gst_certificate_for_wmregistration" class="spinner_container_for_wmregistration_{{VALUE_THREE}}"
                                   accept="application/pdf" onchange="Wmregistration.listview.uploadDocumentForWmregistration(VALUE_THREE);">
                            <div class="error-message error-message-wmregistration-gst_certificate_for_wmregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="gst_certificate_name_container_for_wmregistration" style="display: none;">
                            <label>10.1 GST Certificate.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="gst_certificate_download"><label id="gst_certificate_name_image_for_wmregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wmregistration_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="gst_certificate" class="btn btn-sm btn-danger spinner_name_container_for_wmregistration_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="Wmregistration.listview.askForRemove('{{wmregistration_data.wmregistration_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>


                <div class="row">
                        <div class="col-12 m-b-5px" id="partnership_deed_container_for_wmregistration">
                            <label>11. Partnership deed  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="partnership_deed_for_wmregistration" name="partnership_deed_for_wmregistration" class="spinner_container_for_wmregistration_{{VALUE_FOUR}}"
                                   accept="application/pdf" onchange="Wmregistration.listview.uploadDocumentForWmregistration(VALUE_FOUR);">
                            <div class="error-message error-message-wmregistration-partnership_deed_for_wmregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="partnership_deed_name_container_for_wmregistration" style="display: none;">
                            <label>11.1 Partnership deed<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="partnership_deed_download"><label id="partnership_deed_name_image_for_wmregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wmregistration_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="partnership_deed" class="btn btn-sm btn-danger spinner_name_container_for_wmregistration_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="Wmregistration.listview.askForRemove('{{wmregistration_data.wmregistration_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                  
                <div class="row">
                        <div class="col-12 m-b-5px" id="memorandum_articles_container_for_wmregistration">
                            <label>12. Memorandum & Articles of Association  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="memorandum_articles_for_wmregistration" name="memorandum_articles_for_wmregistration" class="spinner_container_for_wmregistration_{{VALUE_FIVE}}"
                                   accept="application/pdf" onchange="Wmregistration.listview.uploadDocumentForWmregistration(VALUE_FIVE);">
                            <div class="error-message error-message-wmregistration-memorandum_articles_for_wmregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="memorandum_articles_name_container_for_wmregistration" style="display: none;">
                            <label>12.1 Memorandum & Articles of Association<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="memorandum_articles_download"><label id="memorandum_articles_name_image_for_wmregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wmregistration_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="memorandum_articles" class="btn btn-sm btn-danger spinner_name_container_for_wmregistration_{{VALUE_FIVE}}" style="vertical-align: top;"
                                    onclick="Wmregistration.listview.askForRemove('{{wmregistration_data.wmregistration_id}}', VALUE_FIVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                 

                    <div class="row">
                        <div class="col-12 m-b-5px" id="item_to_be_packed_container_for_wmregistration">
                            <label>13. List of items to be packed in different packing size.<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="item_to_be_packed_for_wmregistration" name="item_to_be_packed_for_wmregistration" class="spinner_container_for_wmregistration_{{VALUE_SIX}}"
                                   accept="application/pdf" onchange="Wmregistration.listview.uploadDocumentForWmregistration(VALUE_SIX);">
                            <div class="error-message error-message-wmregistration-item_to_be_packed_for_wmregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="item_to_be_packed_name_container_for_wmregistration" style="display: none;">
                            <label>13.1 List of items to be packed in different packing size.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="item_to_be_packed_download"><label id="item_to_be_packed_name_image_for_wmregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wmregistration_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="item_to_be_packed" class="btn btn-sm btn-danger spinner_name_container_for_wmregistration_{{VALUE_SIX}}" style="vertical-align: top;"
                                    onclick="Wmregistration.listview.askForRemove('{{wmregistration_data.wmregistration_id}}', VALUE_SIX);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
   
                 <div class="row">
                        <div class="col-12 m-b-5px" id="list_of_directors_container_for_wmregistration">
                            <label>14. List of Directors/ Partners of the company as amended time to time.  <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="list_of_directors_for_wmregistration" name="list_of_directors_for_wmregistration" class="spinner_container_for_wmregistration_{{VALUE_SEVEN}}"
                                   accept="application/pdf" onchange="Wmregistration.listview.uploadDocumentForWmregistration(VALUE_SEVEN);">
                            <div class="error-message error-message-wmregistration-list_of_directors_for_wmregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="list_of_directors_name_container_for_wmregistration" style="display: none;">
                            <label>14.1 List of Directors/ Partners of the company as amended time to time.<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="list_of_directors_download"><label id="list_of_directors_name_image_for_wmregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wmregistration_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="list_of_directors" class="btn btn-sm btn-danger spinner_name_container_for_wmregistration_{{VALUE_SEVEN}}" style="vertical-align: top;"
                                    onclick="Wmregistration.listview.askForRemove('{{wmregistration_data.wmregistration_id}}', VALUE_SEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
 

                <div class="row">
                        <div class="col-12 m-b-5px" id="code_certificate_container_for_wmregistration">
                            <label>15. Export/Import Code Certificate ( In case of Importer) . <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="code_certificate_for_wmregistration" name="code_certificate_for_wmregistration" class="spinner_container_for_wmregistration_{{VALUE_EIGHT}}"
                                   accept="application/pdf" onchange="Wmregistration.listview.uploadDocumentForWmregistration(VALUE_EIGHT);">
                            <div class="error-message error-message-wmregistration-code_certificate_for_wmregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="code_certificate_name_container_for_wmregistration" style="display: none;">
                            <label>15.1 Export/Import Code Certificate ( In case of Importer) .<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="code_certificate_download"><label id="code_certificate_name_image_for_wmregistration" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_wmregistration_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="code_certificate" class="btn btn-sm btn-danger spinner_name_container_for_wmregistration_{{VALUE_EIGHT}}" style="vertical-align: top;"
                                    onclick="Wmregistration.listview.askForRemove('{{wmregistration_data.wmregistration_id}}', VALUE_EIGHT);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12"> 
                            <strong>Declaration</strong><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">16. &nbsp;
                                    <input type="checkbox" class="" name="declarationone" id="declarationone" autocomplete="true" value="{{is_checked}}" onblur="checkValidation('wmregistration', 'declarationone', declarationOneValidationMessage);">&nbsp;I/We of the Applicant/Authorized Person have read The Legal Metrology Act, 2009 and The Legal Metrology(Packaged Commodities) Rules,2011 and agree to abide by the same and also declare that the packages package manufactured /prepack/imported will complied the various provisions of the Legal Metrology ( Package Commodity ) Rules 2011.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-wmregistration-declarationone"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">17. &nbsp;
                                    <input type="checkbox" class="" name="declarationtwo" id="declarationtwo" autocomplete="true" value="{{is_checked}}" onblur="checkValidation('wmregistration', 'declarationtwo', declarationTwoValidationMessage);">&nbsp;I/we also state that the contents given in the application are true and correct to the best of my/our knowledge.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-wmregistration-declarationtwo"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">18. &nbsp;
                                    <input type="checkbox" class="" name="declarationthree" id="declarationthree" autocomplete="true" value="{{is_checked}}" onblur="checkValidation('wmregistration', 'declarationthree', declarationThreeValidationMessage);">&nbsp;Fees of Rs. 500/- for registration of manufacturer/packer/importer of prepackaged commodities is enclosed.
                                    <span style="color: red;">*</span>
                                </span>
                            </div>
                            <span class="error-message error-message-wmregistration-declarationthree"></span>
                        </div>
                    </div>


                <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_wmregistration">
                            <label>19. Signature <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_wmregistration" name="seal_and_stamp_for_wmregistration" class="spinner_container_for_wmregistration_{{VALUE_NINE}}"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" onchange="Wmregistration.listview.uploadDocumentForWmregistration(VALUE_NINE);">
                            <div class="error-message error-message-wmregistration-seal_and_stamp_for_wmregistration"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_wmregistration" style="display: none;">
                            <label>18. Signature <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_wmregistration" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_wmregistration_{{VALUE_NINE}}"></a>
                            <button type="button" id="seal_and_stamp" class="btn btn-sm btn-danger spinner_name_container_for_wmregistration_{{VALUE_NINE}}" style="vertical-align: top;" 
                                    onclick="Wmregistration.listview.askForRemove('{{wmregistration_data.wmregistration_id}}', VALUE_NINE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>

                     <hr class="m-b-1rem"> 

                    <div class="form-group">
                        <button type="button" id="draft_btn_for_wmregistration" class="btn btn-sm btn-nic-blue" onclick="Wmregistration.listview.submitWmregistration({{VALUE_ONE}});" style="margin-right: 5px;"><i class="fas fa-download"></i>&nbsp; Save as Draft</button>
                        <button type="button" id="submit_btn_for_wmregistration" class="btn btn-sm btn-success" onclick="Wmregistration.listview.askForSubmitWmregistration({{VALUE_TWO}});" style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Wmregistration.listview.loadWmregistrationData();"><i class="fas fa-times"></i>&nbsp; Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>