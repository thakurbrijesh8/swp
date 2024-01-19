<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">APPLICATION FORM FOR</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">INCENTIVES UNDER INVESTMENT PROMOTION SCHEME - 2015 FOR MSME </div>
            </div>
            <form role="form" id="msme_form" name="msme_form" onsubmit="return false;">
                <input type="hidden" id="msme_id_for_msme" name="msme_id_for_msme" value="{{msme_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-msme f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">                   
                            <label>1.District <span class="color-nic-red">*</span></label>
                            <select id="district_for_msme" name="district_for_msme" class="form-control select2"
                                    onchange="checkValidation('msme', 'district_for_msme', districtValidationMessage)"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-msme-district_for_msme"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('msme', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-msme-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Name of the Enterprise<span class="color-nic-red">*</span></label>
                            <input type="text" id="enterprise_name_for_msme" name="enterprise_name_for_msme" class="form-control" placeholder="Enter Name of the Enterprise !"
                                   maxlength="100" onblur="checkValidation('msme', 'enterprise_name_for_msme', enterpriseNameValidationMessage);" value="{{enterprise_name}}">
                            <span class="error-message error-message-msme-enterprise_name_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>3. Office Address with pin code No. <span class="color-nic-red">*</span></label>
                            <textarea id="office_address_for_msme" name="office_address_for_msme" class="form-control" placeholder="Enter Office Address with pin code No. !"
                                      maxlength="200" onblur="checkValidation('msme', 'office_address_for_msme', officeAddressValidationMessage);">{{office_address}}</textarea>
                            <span class="error-message error-message-msme-office_address_for_msme"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4. Factory Address with pin code No. <span class="color-nic-red">*</span></label>
                            <textarea id="factory_address_for_msme" name="factory_address_for_msme" class="form-control" placeholder="Enter Factory Address with pin code No. !"
                                      maxlength="200" onblur="checkValidation('msme', 'factory_address_for_msme', factoryAddressValidationMessage);">{{factory_address}}</textarea>
                            <span class="error-message error-message-msme-factory_address_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5.1 Office Contact No. <span class="color-nic-red">*</span></label>
                            <input type="text" id="office_contact_number_for_msme" name="office_contact_number_for_msme" class="form-control" placeholder="Enter Office Contact No. !"
                                   onkeyup="checkNumeric($(this));" maxlength="20"
                                   onblur="checkValidation('msme', 'office_contact_number_for_msme', officeContactNoValidationMessage);" value="{{office_contact_number}}">
                            <span class="error-message error-message-msme-office_contact_number_for_msme"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>5.2 Factory Contact No. <span class="color-nic-red">*</span></label>
                            <input type="text" id="factory_contact_number_for_msme" name="factory_contact_number_for_msme" class="form-control" placeholder="Enter Factory Contact No. !"
                                   maxlength="20" onkeyup="checkNumeric($(this));" onblur="checkValidation('msme', 'factory_contact_number_for_msme', factoryContactNoValidationMessage);" value="{{factory_contact_number}}">
                            <span class="error-message error-message-msme-factory_contact_number_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>5.3 Fax </label>
                            <input type="text" id="fax_for_msme" name="fax_for_msme" class="form-control" placeholder="Enter Fax !"
                                   maxlength="20" value="{{fax}}" onkeyup="checkNumeric($(this));">
                            <span class="error-message error-message-msme-fax_for_msme"></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>5.4 Cell Phone </label>
                            <input type="text" id="cellphone_for_msme" name="cellphone_for_msme" class="form-control"
                                   placeholder="Enter Cell Phone !" maxlength="20"
                                   value="{{cellphone}}" onkeyup="checkNumeric($(this));">
                            <span class="error-message error-message-msme-cellphone_for_msme"></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>5.6 Email </label>
                            <input type="text" id="email_for_msme" name="email_for_msme" class="form-control"
                                   placeholder="Enter Email !" maxlength="100" 
                                   onblur="checkValidationForEmailBlank('msme', 'email_for_msme', emailValidationMessage);" value="{{email}}">
                            <span class="error-message error-message-msme-email_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Constitution of the Enterprise<span class="color-nic-red">*</span></label>
                            <div id="constitution_container_for_msme">
                            </div>
                            <span class="error-message error-message-msme-constitution_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7.1 Name of Promoter <span class="color-nic-red">*</span></label>
                            <input type="text" id="promoter_name_for_msme" name="promoter_name_for_msme" class="form-control" placeholder="Enter Name of Promoter !"
                                   maxlength="100" onblur="checkValidation('msme', 'promoter_name_for_msme', promoterNameValidationMessage);" value="{{promoter_name}}">
                            <span class="error-message error-message-msme-promoter_name_for_msme"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7.2 Designation of Promoter <span class="color-nic-red">*</span></label>
                            <textarea id="promoter_designation_for_msme" name="promoter_designation_for_msme" class="form-control" placeholder="Enter Designation of Promoter !"
                                      maxlength="100" onblur="checkValidation('msme', 'promoter_designation_for_msme', promoterDesignationValidationMessage);">{{promoter_designation}}</textarea>
                            <span class="error-message error-message-msme-promoter_designation_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7.3 Contact Number of Promoter</label>
                            <input type="text" id="promoter_contact_number_for_msme" name="promoter_contact_number_for_msme" class="form-control"
                                   placeholder="Enter Contact Number !" maxlength="20" value="{{promoter_contact_number}}">
                            <span class="error-message error-message-msme-promoter_contact_number_for_msme"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7.4 Email of Promoter</label>
                            <input type="text" id="promoter_email_for_msme" name="promoter_email_for_msme" class="form-control"
                                   placeholder="Enter Email !" maxlength="100" 
                                   onblur="checkValidationForEmailBlank('msme', 'promoter_email_for_msme', emailValidationMessage);" value="{{promoter_email}}">
                            <span class="error-message error-message-msme-promoter_email_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>8. Social Status of the Entrepreneur <span class="color-nic-red">*</span></label>
                            <div id="social_status_container_for_msme">
                            </div>
                            <span class="error-message error-message-msme-social_status_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9.1 Name of Authorized Person <span class="color-nic-red">*</span></label>
                            <input type="text" id="ap_name_for_msme" name="ap_name_for_msme" class="form-control" placeholder="Enter Name of Authorized Person !"
                                   maxlength="100" onblur="checkValidation('msme', 'ap_name_for_msme', apNameValidationMessage);" value="{{ap_name}}">
                            <span class="error-message error-message-msme-ap_name_for_msme"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>9.2 Designation of Authorized Person <span class="color-nic-red">*</span></label>
                            <textarea id="ap_designation_for_msme" name="ap_designation_for_msme" class="form-control" placeholder="Enter Designation of Authorized Person !"
                                      maxlength="100" onblur="checkValidation('msme', 'ap_designation_for_msme', apDesignationValidationMessage);">{{ap_designation}}</textarea>
                            <span class="error-message error-message-msme-ap_designation_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9.3 Contact Number of Authorized Person</label>
                            <input type="text" id="ap_contact_number_for_msme" name="ap_contact_number_for_msme" class="form-control"
                                   placeholder="Enter Contact Number !" maxlength="20" value="{{ap_contact_number}}">
                            <span class="error-message error-message-msme-ap_contact_number_for_msme"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>9.4 Email of Authorized Person</label>
                            <input type="text" id="ap_email_for_msme" name="ap_email_for_msme" class="form-control"
                                   placeholder="Enter Email !" maxlength="100" 
                                   onblur="checkValidationForEmailBlank('msme', 'ap_email_for_msme', emailValidationMessage);" value="{{ap_email}}">
                            <span class="error-message error-message-msme-ap_email_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">                   
                            <label>10. Type of the Unit <span class="color-nic-red">*</span></label>
                            <select id="unit_type_for_msme" name="unit_type_for_msme" class="form-control select2"
                                    onclick="checkValidation('msme', 'unit_type_for_msme', oneOptionValidationMessage)"
                                    data-placeholder="Select Type of the Unit" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-msme-unit_type_for_msme"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 f-w-b mb-1 mt-2">
                            Upload duly filled signed & stamped copy of your selected Incentive Scheme.<br>
                            Download sample copy for reference.<br>
                            <a target="_blank" href="assets/department/w&m/PART-A.docx">1. &nbsp; <span class="fas fa-download"></span>&nbsp; Application Form for Incentives under Investment Promotion Scheme - 2015 for MSME</a><br>
                            <a target="_blank" href="assets/department/w&m/ANNEXURES.docx">2. &nbsp; <span class="fas fa-download"></span>&nbsp; Annexures</a><br>
                            <a target="_blank" href="assets/department/w&m/STANDARD-OPERATING-PROCEDURE-NOTIFICATION.pdf">3. &nbsp; <span class="fas fa-download"></span>&nbsp; Standard Operating Procedures</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-light-gray">
                                    <th class="text-center" style="width: 50px;">No.</th>
                                    <th class="text-center" style="min-width: 200px;">Scheme Name</th>
                                    <th class="text-center" style="width: 295px;">Upload Document</th>
                                </tr>
                                <tr>
                                    <td class="text-center scheme-sr-no"></td>
                                    <td class="f-w-b">
                                        Upload signed & stamped copy of application form for incentives under Investment Promotion Scheme - 2015 for MSME<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp; A). INTEREST SUBSIDY<br>
<!--                                        &nbsp;&nbsp;&nbsp;&nbsp; B). ASSISTANCE FOR QUALITY CERTIFICATION<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp; C). ASSISTANCE FOR PATENT REGISTRATION<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp; D). ASSISTANCE FOR SAVING IN CONSUMPTION OF ENERGY AND WATER<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp; E). INCENTIVES FOR LOCAL EMPLOYMENT<br>-->
                                        &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: red;">(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWO}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWO}}" name="upload_for_msme_{{VALUE_TWO}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWO}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWO}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWO}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWO}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWO}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWO}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
<!--                                <tr>
                                    <td class="text-center scheme-sr-no"></td>
                                    <td class="f-w-b">ASSISTANCE FOR QUALITY CERTIFICATION <span style="color: red;"><br>(Maximum File Size: 1MB)(Upload pdf Only)</span></td>
                                    <td class="text-center">
                                        <a target="_blank" class="btn btn-sm btn-nic-blue cursor-pointer"><i class="fas fa-download"></i>&nbsp; Download</a>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_THREE}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_THREE}}" name="upload_for_msme_{{VALUE_THREE}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_THREE}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_THREE}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_THREE}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_THREE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_THREE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_THREE}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center scheme-sr-no"></td>
                                    <td class="f-w-b">ASSISTANCE FOR PATENT REGISTRATION <span style="color: red;"><br>(Maximum File Size: 1MB)(Upload pdf Only)</span></td>
                                    <td class="text-center">
                                        <a target="_blank" class="btn btn-sm btn-nic-blue cursor-pointer"><i class="fas fa-download"></i>&nbsp; Download</a>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_FOUR}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_FOUR}}" name="upload_for_msme_{{VALUE_FOUR}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_FOUR}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_FOUR}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_FOUR}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_FOUR}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_FOUR}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_FOUR}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center scheme-sr-no"></td>
                                    <td class="f-w-b">ASSISTANCE FOR SAVING IN CONSUMPTION OF ENERGY AND WATER <span style="color: red;"><br>(Maximum File Size: 1MB)(Upload pdf Only)</span></td>
                                    <td class="text-center">
                                        <a target="_blank" class="btn btn-sm btn-nic-blue cursor-pointer"><i class="fas fa-download"></i>&nbsp; Download</a>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_FIVE}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_FIVE}}" name="upload_for_msme_{{VALUE_FIVE}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_FIVE}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_FIVE}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_FIVE}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_FIVE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_FIVE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_FIVE}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center scheme-sr-no"></td>
                                    <td class="f-w-b">INCENTIVES FOR LOCAL EMPLOYMENT <span style="color: red;"><br>(Maximum File Size: 1MB)(Upload pdf Only)</span></td>
                                    <td class="text-center">
                                        <a target="_blank" class="btn btn-sm btn-nic-blue cursor-pointer"><i class="fas fa-download"></i>&nbsp; Download</a>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_SIX}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_SIX}}" name="upload_for_msme_{{VALUE_SIX}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_SIX}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_SIX}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_SIX}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_SIX}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_SIX}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_SIX}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>-->
                            </thead>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12 f-w-b mb-1 mt-2">
                            List of Documents to be Submitted Along with Application<br>
                        </div>
                        <div class="col-12 f-w-b mb-1">
<!--                            <label class="checkbox-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                <input type="checkbox" class="mb-0" id="is_ci" name="form_application_checklist_for_msme"
                                       value="{{VALUE_ONE}}" onclick="MSME.listview.FACChangeEvent();">&nbsp;&nbsp; A-1) CAPITAL INVESTMENT
                            </label><br>-->
                            <label class="checkbox-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                <input type="checkbox" class="mb-0" id="is_is" name="form_application_checklist_for_msme"
                                       value="{{VALUE_TWO}}" onclick="MSME.listview.FACChangeEvent();">&nbsp;&nbsp; A) INTEREST SUBSIDY
                            </label><br>
<!--                            <label class="checkbox-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                <input type="checkbox" class="mb-0" id="is_afqc" name="form_application_checklist_for_msme"
                                       value="{{VALUE_THREE}}" onclick="MSME.listview.FACChangeEvent();">&nbsp;&nbsp; B) ASSISTANCE FOR QUALITY CERTIFICATION
                            </label><br>
                            <label class="checkbox-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                <input type="checkbox" class="mb-0" id="is_afpr" name="form_application_checklist_for_msme"
                                       value="{{VALUE_FOUR}}" onclick="MSME.listview.FACChangeEvent();">&nbsp;&nbsp; C) ASSISTANCE FOR PATENT REGISTRATION
                            </label><br>
                            <label class="checkbox-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                <input type="checkbox" class="mb-0" id="is_afsscew" name="form_application_checklist_for_msme"
                                       value="{{VALUE_FIVE}}" onclick="MSME.listview.FACChangeEvent();">&nbsp;&nbsp; D) ASSISTANCE FOR SAVING IN CONSUMPTION OF ENERGY AND WATER
                            </label><br>
                            <label class="checkbox-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                <input type="checkbox" class="mb-0" id="is_ifle" name="form_application_checklist_for_msme"
                                       value="{{VALUE_SIX}}" onclick="MSME.listview.FACChangeEvent();">&nbsp;&nbsp; E) INCENTIVES FOR LOCAL EMPLOYMENT
                            </label>-->
                            <div class="error-message error-message-msme-form_application_checklist_for_msme"></div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-light-gray">
                                    <th class="text-center" style="width: 50px;">No.</th>
                                    <th class="text-center" style="min-width: 200px;">Document Name</th>
                                    <th class="text-center" style="width: 295px;">Upload Document</th>
                                </tr>
<!--                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of Entrepreneur Memorandum (Part I) and (Part II). <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_SEVEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_SEVEN}}" name="upload_for_msme_{{VALUE_SEVEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_SEVEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_SEVEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_SEVEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_SEVEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_SEVEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_SEVEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of Partnership Deed, If Partnership Concern; in case Limited Company copy of
                                        Memorandum and Articles of Association duly signed by the Managing Director. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_EIGHT}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_EIGHT}}" name="upload_for_msme_{{VALUE_EIGHT}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_EIGHT}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_EIGHT}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_EIGHT}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_EIGHT}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_EIGHT}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_EIGHT}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">If the Enterprise is functioning in a leased land/ building, copy of Leaseagreement deed
                                        executed in stamp paper of Rs.10/- , for a minimum periodof 5 years from the date of
                                        commencement of commercial production <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_NINE}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_NINE}}" name="upload_for_msme_{{VALUE_NINE}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_NINE}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_NINE}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_NINE}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_NINE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_NINE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_NINE}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of Loan Sanction letter from the Bank / Financial Institution in respectBank /
                                        Institutional financed Enterprises. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TEN}}" name="upload_for_msme_{{VALUE_TEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of Power Release Order. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_ELEVEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_ELEVEN}}" name="upload_for_msme_{{VALUE_ELEVEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_ELEVEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_ELEVEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_ELEVEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_ELEVEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_ELEVEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_ELEVEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of the invoices, cash bills and stamped receipt duly attested. In case ofnon-availability
                                        of receipts, the bank scroll which shows the payment, with the details of the machinery
                                        supplier, should be furnished, in original, with the attestation of the Bank Manager. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWELVE}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWELVE}}" name="upload_for_msme_{{VALUE_TWELVE}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWELVE}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWELVE}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWELVE}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWELVE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWELVE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWELVE}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Certificate of Chartered Accountant for fixed assets created as on date of commencement of
                                        commercial production in the prescribed form(Annexure-IV) <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_THIRTEEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_THIRTEEN}}" name="upload_for_msme_{{VALUE_THIRTEEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_THIRTEEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_THIRTEEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_THIRTEEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_THIRTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_THIRTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_THIRTEEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Certificate of commencement of commercial production duly signed byChartered
                                        Accountant . <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_FOURTEEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_FOURTEEN}}" name="upload_for_msme_{{VALUE_FOURTEEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_FOURTEEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_FOURTEEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_FOURTEEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_FOURTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_FOURTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_FOURTEEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">For self fabricated Plant and Machinery items<br>
                                        a) Chartered Engineer’s Certificate for the value of the plant and machinery.<br>
                                        b) Chartered Accountant Certificate for the expenses incurred for the purchase of Plant and machinery to be furnished.<br>
                                        c) Copy of the invoices, cash bills , job work bills and stamped receipt dulyattested.
                                        <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_FIFTEEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_FIFTEEN}}" name="upload_for_msme_{{VALUE_FIFTEEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_FIFTEEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_FIFTEEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_FIFTEEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_FIFTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_FIFTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_FIFTEEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_FIFTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of the first sale invoice raised after commencement of Commercial Production or copy
                                        of first delivery challan,in case of enterprises manufacturing on job work basis.
                                        <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_SIXTEEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_SIXTEEN}}" name="upload_for_msme_{{VALUE_SIXTEEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_SIXTEEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_SIXTEEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_SIXTEEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_SIXTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_SIXTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_SIXTEEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Additional documents for to be submitted in respect of enterprises applyingfor Employment
                                        Intensive.
                                        <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_SEVENTEEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_SEVENTEEN}}" name="upload_for_msme_{{VALUE_SEVENTEEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_SEVENTEEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_SEVENTEEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_SEVENTEEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_SEVENTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_SEVENTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_SEVENTEEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_SEVENTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Social/clinical status Certificate from authorities concerned in respect of select category of
                                        entrepreneurs like SC/ST / Physically Handicapped / Transgender etc.
                                        <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_EIGHTEEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_EIGHTEEN}}" name="upload_for_msme_{{VALUE_EIGHTEEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_EIGHTEEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_EIGHTEEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_EIGHTEEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_EIGHTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_EIGHTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_EIGHTEEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_EIGHTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of Consent to Operate from PCC, Daman <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span></td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_NINETEEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_NINETEEN}}" name="upload_for_msme_{{VALUE_NINETEEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_NINETEEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_NINETEEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_NINETEEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_NINETEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_NINETEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_NINETEEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_NINETEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">
                                        Additional documents in respect of existing enterprises taking up expansion / diversification.
                                        Certificate from Chartered Accountant on the following :<br>
                                        a) Date of commencement of commercial production after expansion / diversification<br>
                                        b) Annual production turnover for the last 3 years before the date of commencement of
                                        commercial production under expansion/ diversification.<br>
                                        c) Value of fixed assets before Expansion/diversification , on Expansion /diversification and
                                        after Expansion / diversification % increase of fixedassets due to Expansion /
                                        diversification.<br>
                                        d) Production capacity / Turnover (both in terms of units and value in Rs.) before
                                        expansion/diversification, after expansion / diversificationand % increase of production
                                        capacity / Turnover due to expansion /diversification.
                                        <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTY}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTY}}" name="upload_for_msme_{{VALUE_TWENTY}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTY}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTY}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTY}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTY}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTY}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTY}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTY}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of Patent Registration Certificate with details of payment made receipts. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTYONE}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTYONE}}" name="upload_for_msme_{{VALUE_TWENTYONE}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTYONE}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTYONE}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTYONE}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTYONE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTYONE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTYONE}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTYONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of Certificate for saving in consumption of energy and water issued by the auditing
                                        agency. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTYTWO}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTYTWO}}" name="upload_for_msme_{{VALUE_TWENTYTWO}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTYTWO}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTYTWO}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTYTWO}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTYTWO}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTYTWO}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTYTWO}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTYTWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of Quality Certification (ie.ISO/ISI/WHO/GMP/Hallmark Certification and other
                                        National/International certification) issued by the certifying agency. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTYTHREE}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTYTHREE}}" name="upload_for_msme_{{VALUE_TWENTYTHREE}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTYTHREE}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTYTHREE}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTYTHREE}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTYTHREE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTYTHREE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTYTHREE}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTYTHREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-all">
                                    <td class="text-center doc-sr-no"></td>
                                    <td class="f-w-b">Copy of Domicile/Resident Certificate of local employees of UT’s since last 10 years issued by
                                        the competent authority, if applied for incentive for local employment. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTYFOUR}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTYFOUR}}" name="upload_for_msme_{{VALUE_TWENTYFOUR}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTYFOUR}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTYFOUR}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTYFOUR}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTYFOUR}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTYFOUR}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTYFOUR}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTYFOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>-->
                                <tr class="doc-for-is">
                                    <td class="text-center doc-sr-no is-doc-sr-no"></td>
                                    <td class="f-w-b">Bank Certificate showing total interest calculation of 6 months of the Term Loan Account of the enterprise for which interest subsidy is sought.<br>(Only Applicable for INTEREST SUBSIDY)<span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTYFIVE}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTYFIVE}}" name="upload_for_msme_{{VALUE_TWENTYFIVE}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTYFIVE}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTYFIVE}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTYFIVE}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTYFIVE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTYFIVE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTYFIVE}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTYFIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-is">
                                    <td class="text-center doc-sr-no is-doc-sr-no"></td>
                                    <td class="f-w-b">Bank statement for the particular period of 6 months duly certified by the Bank & the Applicant.<br>(Only Applicable for INTEREST SUBSIDY)<span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTYSIX}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTYSIX}}" name="upload_for_msme_{{VALUE_TWENTYSIX}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTYSIX}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTYSIX}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTYSIX}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTYSIX}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTYSIX}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTYSIX}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTYSIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-is">
                                    <td class="text-center doc-sr-no is-doc-sr-no"></td>
                                    <td class="f-w-b">Declaration as per the Given format from the Applicant. (Annexure - 3)<br>(Only Applicable for INTEREST SUBSIDY)<span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTYSEVEN}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTYSEVEN}}" name="upload_for_msme_{{VALUE_TWENTYSEVEN}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTYSEVEN}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTYSEVEN}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTYSEVEN}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTYSEVEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTYSEVEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTYSEVEN}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTYSEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-is">
                                    <td class="text-center doc-sr-no is-doc-sr-no"></td>
                                    <td class="f-w-b">Duly Certified Calculation of the Interest Subsidy Claimed by the applicant.<br>(Only Applicable for INTEREST SUBSIDY)<span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTYEIGHT}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTYEIGHT}}" name="upload_for_msme_{{VALUE_TWENTYEIGHT}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTYEIGHT}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTYEIGHT}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTYEIGHT}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTYEIGHT}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTYEIGHT}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTYEIGHT}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTYEIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-is">
                                    <td class="text-center doc-sr-no is-doc-sr-no"></td>
                                    <td class="f-w-b">CA Certificate certifying the Annual Production, Sales Turnover and Power Consumption as on 31st March of Every Financial Year. (Annexure - 4)<br>(Only Applicable for INTEREST SUBSIDY)<span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_TWENTYNINE}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_TWENTYNINE}}" name="upload_for_msme_{{VALUE_TWENTYNINE}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_TWENTYNINE}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_TWENTYNINE}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_TWENTYNINE}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_TWENTYNINE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_TWENTYNINE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_TWENTYNINE}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWENTYNINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                                <tr class="doc-for-is">
                                    <td class="text-center doc-sr-no is-doc-sr-no"></td>
                                    <td class="f-w-b">Bank Statement duly certified by the Applicant for a Particular Financial Year.<br>(Only Applicable for INTEREST SUBSIDY)<span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                                    </td>
                                    <td>
                                        <div id="upload_container_for_msme_{{VALUE_THIRTY}}">
                                            <input type="file" id="upload_for_msme_{{VALUE_THIRTY}}" name="upload_for_msme_{{VALUE_THIRTY}}"
                                                   accept="application/pdf" onchange="MSME.listview.uploadDocumentForMSME('{{VALUE_THIRTY}}');">
                                            <div class="error-message error-message-msme-upload_for_msme_{{VALUE_THIRTY}}"></div>
                                        </div>
                                        <div id="upload_name_container_for_msme_{{VALUE_THIRTY}}" style="display: none;">
                                            <a target="_blank" id="upload_name_href_for_msme_{{VALUE_THIRTY}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            <button type="button" id="remove_document_btn_for_msme_{{VALUE_THIRTY}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                    onclick="MSME.listview.askForRemove('{{msme_id}}', '{{VALUE_THIRTY}}');">
                                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                        </div>
                                        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_THIRTY}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div>
                        <button type="button" id="draft_btn_for_msme" class="btn btn-sm btn-nic-blue" onclick="MSME.listview.submitMSME('{{VALUE_ONE}}');" style="margin-right: 5px;"><i class="fas fa-download"></i>&nbsp; Save as a Draft</button>
                        <button type="button" id="submit_btn_for_msme" class="btn btn-sm btn-success" onclick="MSME.listview.askForSubmitMSME('{{VALUE_TWO}}');"  style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="MSME.listview.loadMSMEData();">Cancel</button  >
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>