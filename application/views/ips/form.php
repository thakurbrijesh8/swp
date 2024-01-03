<div class="card">
    <div class="card-header">
        <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">COMMON APPLICATION FORM FOR INCENTIVES UNDER</div>
        <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Investment Promotion Scheme : 2022 to 2027 ( Period : 20-05-2022 to 19-05-2027 ) </div>
    </div>
    <form role="form" id="ips_form" name="ips_form" onsubmit="return false;">
        <input type="hidden" id="ips_id_for_ips" name="ips_id_for_ips" value="{{ips_id}}">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span class="error-message error-message-ips f-w-b" style="border-bottom: 2px solid red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">                   
                    <label>1.District <span class="color-nic-red">*</span></label>
                    <select id="district_for_ips" name="district_for_ips" class="form-control select2"
                            onchange="checkValidation('ips', 'district_for_ips', districtValidationMessage)"
                            data-placeholder="Select District" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-ips-district_for_ips"></span>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-nic-blue p-2">
                    <h3 class="card-title f-w-b f-s-16px">
                        2. Ownership Details
                    </h3>
                </div>
                <div class="card-body pb-0 border-nic-blue">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2.1 Name of Owner<span class="color-nic-red">*</span></label>
                            <input type="text" id="owner_name_for_ips" name="owner_name_for_ips" class="form-control" placeholder="Enter Name of Owner !"
                                   maxlength="100" onblur="checkValidation('ips', 'owner_name_for_ips', ownerNameValidationMessage);" value="{{owner_name}}">
                            <span class="error-message error-message-ips-owner_name_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>2.2 Category <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select id="owner_category_for_ips" name="owner_category_for_ips" class="form-control select2"
                                        data-placeholder="Select Category" style="width: 100%;" onblur="checkValidation('ips', 'owner_category_for_ips', selectOneOptionValidationMessage);">
                                </select>
                            </div>
                            <span class="error-message error-message-ips-owner_category_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>2.3 Email <span class="color-nic-red">*</span></label>
                            <input type="text" id="email_for_ips" name="email_for_ips" class="form-control"
                                   placeholder="Enter Email !" maxlength="100" 
                                   onblur="checkValidationForEmail('ips', 'email_for_ips', emailValidationMessage);" 
                                   value="{{email}}">
                            <span class="error-message error-message-ips-email_for_ips"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>2.4 Mobile No. <span class="color-nic-red">*</span></label>
                            <input type="text" id="mobile_no_for_ips" name="mobile_no_for_ips" class="form-control"
                                   placeholder="Enter Mobile No. !" maxlength="10" 
                                   onblur="checkValidationForMobileNumber('ips', 'mobile_no_for_ips', mobileValidationMessage);" value="{{mobile_no}}">
                            <span class="error-message error-message-ips-mobile_no_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>2.5 Aadhar No.</label>
                            <input type="text" id="aadhar_no_for_ips" name="aadhar_no_for_ips" class="form-control"
                                   placeholder="Enter Aadhar No. !" maxlength="12" onkeyup="checkNumeric($(this));"
                                   onblur="aadharNumberValidation('ips', 'aadhar_no_for_ips');" value="{{aadhar_no}}">
                            <span class="error-message error-message-ips-aadhar_no_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>2.6 PAN <span class="color-nic-red">*</span></label>
                            <input type="text" id="pan_no_for_ips" name="pan_no_for_ips" class="form-control"
                                   placeholder="Enter PAN !" maxlength="10" style="text-transform: uppercase;"
                                   onblur="checkValidationForPAN('ips', 'pan_no_for_ips', true);" value="{{pan_no}}">
                            <span class="error-message error-message-ips-pan_no_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>2.7 Caste Category <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select id="caste_category_for_ips" name="caste_category_for_ips" class="form-control select2"
                                        data-placeholder="Select Caste Category" style="width: 100%;" onblur="checkValidation('ips', 'caste_category_for_ips', selectOneOptionValidationMessage);">
                                </select>
                            </div>
                            <span class="error-message error-message-ips-caste_category_for_ips"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-nic-blue p-2">
                    <h3 class="card-title f-w-b f-s-16px">
                        3. Authorized Person Details
                    </h3>
                </div>
                <div class="card-body pb-0 border-nic-blue">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>3.1 Name of Authorized Person <span class="color-nic-red">*</span></label>
                            <input type="text" id="ap_name_for_ips" name="ap_name_for_ips" class="form-control" placeholder="Enter Name of Authorized Person !"
                                   maxlength="100" onblur="checkValidation('ips', 'ap_name_for_ips', apNameValidationMessage);" value="{{ap_name}}">
                            <span class="error-message error-message-ips-ap_name_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>3.2 Designation of Authorized Person <span class="color-nic-red">*</span></label>
                            <textarea id="ap_designation_for_ips" name="ap_designation_for_ips" class="form-control" placeholder="Enter Designation of Authorized Person !"
                                      maxlength="100" onblur="checkValidation('ips', 'ap_designation_for_ips', apDesignationValidationMessage);">{{ap_designation}}</textarea>
                            <span class="error-message error-message-ips-ap_designation_for_ips"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-3">
                            <label>3.3 Email of Authorized Person <span class="color-nic-red">*</span></label>
                            <input type="text" id="ap_email_for_ips" name="ap_email_for_ips" class="form-control"
                                   placeholder="Enter Email !" maxlength="100" 
                                   onblur="checkValidationForEmail('ips', 'ap_email_for_ips', emailValidationMessage);" value="{{ap_email}}">
                            <span class="error-message error-message-ips-ap_email_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label>3.4 Mobile No. of Authorized Person <span class="color-nic-red">*</span></label>
                            <input type="text" id="ap_mobile_for_ips" name="ap_mobile_for_ips" class="form-control"
                                   placeholder="Enter Mobile No. !" maxlength="10" 
                                   onblur="checkValidationForMobileNumber('ips', 'ap_mobile_for_ips', mobileValidationMessage);" value="{{ap_mobile}}">
                            <span class="error-message error-message-ips-ap_mobile_for_ips"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-nic-blue p-2">
                    <h3 class="card-title f-w-b f-s-16px">
                        4. Enterprise Details
                    </h3>
                </div>
                <div class="card-body pb-0 border-nic-blue">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4.1 Udyam Registration / IEM No. Part-II : E.M. No and Date : <span class="color-nic-red">*</span></label>
                            <input type="text" id="udyam_registration_for_ips" name="udyam_registration_for_ips" class="form-control"
                                   placeholder="Enter Udyam Registration / IEM No. Part-II : E.M. No and Date : !" maxlength="100" 
                                   onblur="checkValidation('ips', 'udyam_registration_for_ips', registrationNumberValidationMessage);" value="{{udyam_registration}}">
                            <span class="error-message error-message-ips-udyam_registration_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4.2 Details of Registrations as applicable </label>
                            <textarea id="regi_details_for_ips" name="regi_details_for_ips" class="form-control" placeholder="Enter Details of Registrations as applicable !"
                                      maxlength="100">{{regi_details}}</textarea>
                            <span class="error-message error-message-ips-regi_details_for_ips"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>4.3 ROC / Firm Registration Certificate / CIN No. / TIN No./ PAN No. GST No. Other registrations</label>
                        </div>
                    </div>
                    <div class="card bg-aliceblue">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>4.3.1.1 CIN No.</label>
                                    <input type="text" id="ur_cin_no_for_ips" name="ur_cin_no_for_ips" class="form-control"
                                           placeholder="Enter CIN No. !" maxlength="50" value="{{ur_cin_no}}">
                                    <span class="error-message error-message-ips-ur_cin_no_for_ips"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>4.3.1.2 CIN Document <span style="color: red;">(Maximum File Size: 10MB)(Upload pdf Only)</span></label>
                                    <div id="upload_container_for_ips_{{VALUE_THIRTEEN}}">
                                        <input type="file" id="upload_for_ips_{{VALUE_THIRTEEN}}" name="upload_for_ips_{{VALUE_THIRTEEN}}"
                                               accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_THIRTEEN}}');">
                                        <div class="error-message error-message-ips-upload_for_ips_{{VALUE_THIRTEEN}}"></div>
                                    </div>
                                    <div id="upload_name_container_for_ips_{{VALUE_THIRTEEN}}" style="display: none;">
                                        <a target="_blank" id="upload_name_href_for_ips_{{VALUE_THIRTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        <button type="button" id="remove_document_btn_for_ips_{{VALUE_THIRTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_THIRTEEN}}');">
                                            <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                    </div>
                                    <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-aliceblue">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>4.3.2.1 TIN No.</label>
                                    <input type="text" id="ur_tin_no_for_ips" name="ur_tin_no_for_ips" class="form-control"
                                           placeholder="Enter TIN No. !" maxlength="50" value="{{ur_tin_no}}">
                                    <span class="error-message error-message-ips-ur_tin_no_for_ips"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>4.3.2.2 TIN Document <span style="color: red;">(Maximum File Size: 10MB)(Upload pdf Only)</span></label>
                                    <div id="upload_container_for_ips_{{VALUE_FOURTEEN}}">
                                        <input type="file" id="upload_for_ips_{{VALUE_FOURTEEN}}" name="upload_for_ips_{{VALUE_FOURTEEN}}"
                                               accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_FOURTEEN}}');">
                                        <div class="error-message error-message-ips-upload_for_ips_{{VALUE_FOURTEEN}}"></div>
                                    </div>
                                    <div id="upload_name_container_for_ips_{{VALUE_FOURTEEN}}" style="display: none;">
                                        <a target="_blank" id="upload_name_href_for_ips_{{VALUE_FOURTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        <button type="button" id="remove_document_btn_for_ips_{{VALUE_FOURTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_FOURTEEN}}');">
                                            <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                    </div>
                                    <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-aliceblue">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>4.3.3.1 PAN No. <span class="color-nic-red">*</span></label>
                                    <input type="text" id="ur_pan_no_for_ips" name="ur_pan_no_for_ips" class="form-control"
                                           placeholder="Enter PAN No. !" maxlength="10" style="text-transform: uppercase;"
                                           onblur="checkValidationForPAN('ips', 'ur_pan_no_for_ips', true);"
                                           value="{{ur_pan_no}}">
                                    <span class="error-message error-message-ips-ur_pan_no_for_ips"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>4.3.3.2 PAN Document <span class="color-nic-red">* (Maximum File Size: 10MB)(Upload pdf Only)</span></label>
                                    <div id="upload_container_for_ips_{{VALUE_FIFTEEN}}">
                                        <input type="file" id="upload_for_ips_{{VALUE_FIFTEEN}}" name="upload_for_ips_{{VALUE_FIFTEEN}}"
                                               accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_FIFTEEN}}');">
                                        <div class="error-message error-message-ips-upload_for_ips_{{VALUE_FIFTEEN}}"></div>
                                    </div>
                                    <div id="upload_name_container_for_ips_{{VALUE_FIFTEEN}}" style="display: none;">
                                        <a target="_blank" id="upload_name_href_for_ips_{{VALUE_FIFTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        <button type="button" id="remove_document_btn_for_ips_{{VALUE_FIFTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_FIFTEEN}}');">
                                            <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                    </div>
                                    <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_FIFTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-aliceblue">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>4.3.4.1 GST No.</label>
                                    <input type="text" id="ur_gst_no_for_ips" name="ur_gst_no_for_ips" class="form-control"
                                           placeholder="Enter GST No. !" maxlength="50" value="{{ur_gst_no}}">
                                    <span class="error-message error-message-ips-ur_gst_no_for_ips"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>4.3.4.2 GST Document <span style="color: red;">(Maximum File Size: 10MB)(Upload pdf Only)</span></label>
                                    <div id="upload_container_for_ips_{{VALUE_SIXTEEN}}">
                                        <input type="file" id="upload_for_ips_{{VALUE_SIXTEEN}}" name="upload_for_ips_{{VALUE_SIXTEEN}}"
                                               accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_SIXTEEN}}');">
                                        <div class="error-message error-message-ips-upload_for_ips_{{VALUE_SIXTEEN}}"></div>
                                    </div>
                                    <div id="upload_name_container_for_ips_{{VALUE_SIXTEEN}}" style="display: none;">
                                        <a target="_blank" id="upload_name_href_for_ips_{{VALUE_SIXTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        <button type="button" id="remove_document_btn_for_ips_{{VALUE_SIXTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_SIXTEEN}}');">
                                            <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                    </div>
                                    <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-aliceblue">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>4.3.4.1 Other registrations No.</label>
                                    <input type="text" id="ur_other_reg_no_for_ips" name="ur_other_reg_no_for_ips" class="form-control"
                                           placeholder="Enter Other Document No. !" maxlength="50" value="{{ur_other_reg_no}}">
                                    <span class="error-message error-message-ips-ur_other_reg_no_for_ips"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>4.3.4.2 Other registrations Document <span style="color: red;">(Maximum File Size: 10MB)(Upload pdf Only)</span></label>
                                    <div id="upload_container_for_ips_{{VALUE_SEVENTEEN}}">
                                        <input type="file" id="upload_for_ips_{{VALUE_SEVENTEEN}}" name="upload_for_ips_{{VALUE_SEVENTEEN}}"
                                               accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_SEVENTEEN}}');">
                                        <div class="error-message error-message-ips-upload_for_ips_{{VALUE_SEVENTEEN}}"></div>
                                    </div>
                                    <div id="upload_name_container_for_ips_{{VALUE_SEVENTEEN}}" style="display: none;">
                                        <a target="_blank" id="upload_name_href_for_ips_{{VALUE_SEVENTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        <button type="button" id="remove_document_btn_for_ips_{{VALUE_SEVENTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_SEVENTEEN}}');">
                                            <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                    </div>
                                    <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_SEVENTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-nic-blue p-2">
                    <h3 class="card-title f-w-b f-s-16px">
                        5. Manufacturing Unit / Service Unit Details
                    </h3>
                </div>
                <div class="card-body pb-0 border-nic-blue">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>5.1 Name of Manufacturing Unit / Service Unit <span class="color-nic-red">*</span></label>
                            <input type="text" id="manu_name_for_ips" name="manu_name_for_ips" class="form-control" placeholder="Enter Name of Manufacturing Unit / Service Unit !"
                                   maxlength="100" onblur="checkValidation('ips', 'manu_name_for_ips', manufactureNameValidationMessage);" value="{{manu_name}}">
                            <span class="error-message error-message-ips-manu_name_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>5.2 Main Unit/Plant Address <span class="color-nic-red">*</span></label>
                            <textarea id="main_plant_address_for_ips" name="main_plant_address_for_ips" class="form-control" placeholder="Enter Main Unit/Plant Address !"
                                      maxlength="100" onblur="checkValidation('ips', 'main_plant_address_for_ips', addressValidationMessage);">{{main_plant_address}}</textarea>
                            <span class="error-message error-message-ips-main_plant_address_for_ips"></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>5.3 Office Address <span class="color-nic-red">*</span></label>
                            <textarea id="office_address_for_ips" name="office_address_for_ips" class="form-control" placeholder="Enter Office Address !"
                                      maxlength="100" onblur="checkValidation('ips', 'office_address_for_ips', officeAddressValidationMessage);">{{office_address}}</textarea>
                            <span class="error-message error-message-ips-office_address_for_ips"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4 text-center">
                            <label>&nbsp;</label>
                            <div>
                                <button type="button" class="btn btn-sm btn-primary" 
                                        onclick="Ips.listview.openMapForCAF();">
                                    <i class="fas fa-map-marker-alt"></i>&nbsp; Locate on Map
                                </button>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>5.4 Latitude</label>
                            <input type="text" id="latitude_for_ips" name="latitude_for_ips"
                                   class="form-control latitude_for_ips"
                                   placeholder="Enter Latitude !" maxlength="30" value="{{latitude}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>5.5 Longitude</label>
                            <input type="text" id="longitude_for_ips" name="longitude_for_ips"
                                   class="form-control longitude_for_ips"
                                   placeholder="Enter Longitude !" maxlength="30" value="{{longitude}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card bg-aliceblue">
                        <div class="card-body pb-0">
                            <label>6. Constitution of Firm <span class="color-nic-red">*</span></label>
                            <div id="constitution_container_for_ips">
                            </div>
                            <span class="error-message error-message-ips-constitution_for_ips"></span>
                            <div class="row other_constitution_container_for_ips" style="display: none;">
                                <div class="col-sm-12"><hr class="mb-1"></div>
                                <div class="form-group col-sm-12">
                                    <label>6.1 Other Constitution <span class="color-nic-red">*</span></label>
                                    <input type="text" name="other_constitution_for_ips" id="other_constitution_for_ips" class="form-control" placeholder="Enter Other Constitution"
                                           value="{{other_constitution}}" onblur="checkValidation('ips', 'other_constitution_for_ips', detailsValidationMessage);">
                                    <span class="error-message error-message-ips-other_constitution_for_ips"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card bg-aliceblue">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>7. Category of Unit <span class="color-nic-red">*</span></label>
                                    <div id="unit_category_container_for_ips"></div>
                                    <span class="error-message error-message-ips-unit_category_for_ips"></span>
                                </div>
                            </div>
                            <div class="row msme_category_container_for_ips" style="display: none;">
                                <div class="col-sm-12"><hr class="mb-1"></div>
                                <div class="form-group col-sm-6">
                                    <label>7.1 Select Category <span class="color-nic-red">*</span></label>
                                    <select id="msme_category_for_ips" name="msme_category_for_ips" class="form-control select2"
                                            onchange="checkValidation('ips', 'msme_category_for_ips', selectOneOptionValidationMessage)"
                                            data-placeholder="Select Ips Category" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-ips-msme_category_for_ips"></span>
                                </div>
                                <!--                                <div class="form-group col-sm-6">
                                                                    <label>7.2 Upload Document for Ips <span class="color-nic-red">*</span></label>
                                                                    <div id="upload_container_for_ips_{{VALUE_ONE}}">
                                                                        <input type="file" id="upload_for_ips_{{VALUE_ONE}}" name="upload_for_ips_{{VALUE_ONE}}"
                                                                               accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_ONE}}');">
                                                                        <div class="error-message error-message-ips-upload_for_ips_{{VALUE_ONE}}"></div>
                                                                    </div>
                                                                    <div id="upload_name_container_for_ips_{{VALUE_ONE}}" style="display: none;">
                                                                        <a target="_blank" id="upload_name_href_for_ips_{{VALUE_ONE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                                                        <button type="button" id="remove_document_btn_for_ips_{{VALUE_ONE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                                                onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_ONE}}');">
                                                                            <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                                                    </div>
                                                                    <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                                                </div>-->
                            </div>
                            <!--                            <div class="row non_msme_category_container_for_ips" style="display: none;">
                                                            <div class="col-sm-12"><hr class="mb-1"></div>
                                                            <div class="form-group col-12">
                                                                <label>7.1 Upload Document for NON Ips <span class="color-nic-red">*</span></label>
                                                                <div id="upload_container_for_ips_{{VALUE_TWO}}">
                                                                    <input type="file" id="upload_for_ips_{{VALUE_TWO}}" name="upload_for_ips_{{VALUE_TWO}}"
                                                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_TWO}}');">
                                                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_TWO}}"></div>
                                                                </div>
                                                                <div id="upload_name_container_for_ips_{{VALUE_TWO}}" style="display: none;">
                                                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_TWO}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_TWO}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_TWO}}');">
                                                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                                                </div>
                                                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                                            </div>
                                                        </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-aliceblue">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>8. Entrepreneur Category (Eligibility for Additional Incentive)</label>
                            <div id="entrepreneur_category_container_for_ips">
                            </div>
                            <span class="error-message error-message-ips-entrepreneur_category_for_ips"></span>
                        </div>
                        <div class="col-sm-4 young_entrepreneur_container_for_ips" style="display: none;">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>8.3 Birth Date <span class="color-nic-red">*</span></label>
                                    <div class="input-group date ">
                                        <input type="text" name="birth_date_for_ips" id="birth_date_for_ips" class="form-control date_picker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"
                                               value="{{birth_date_text}}" onblur="checkValidation('ips', 'birth_date_for_ips', dateValidationMessage);">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-ips-birth_date_for_ips"></span>
                                </div>
                                <div class="form-group col-12">
                                    <label>8.4 Upload DOB Proof <span class="color-nic-red">*</span></label>
                                    <div id="upload_container_for_ips_{{VALUE_THREE}}">
                                        <input type="file" id="upload_for_ips_{{VALUE_THREE}}" name="upload_for_ips_{{VALUE_THREE}}"
                                               accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_THREE}}');">
                                        <div class="error-message error-message-ips-upload_for_ips_{{VALUE_THREE}}"></div>
                                    </div>
                                    <div id="upload_name_container_for_ips_{{VALUE_THREE}}" style="display: none;">
                                        <a target="_blank" id="upload_name_href_for_ips_{{VALUE_THREE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        <button type="button" id="remove_document_btn_for_ips_{{VALUE_THREE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                                onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_THREE}}');">
                                            <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                    </div>
                                    <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-aliceblue">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>9. Type of Unit <span class="color-nic-red">*</span></label>
                            <div id="unit_type_container_for_ips">
                            </div>
                            <span class="error-message error-message-ips-unit_type_for_ips"></span>
                        </div>
                        <div class="col-sm-4 ex_manufacturing_unit_container_for_ips" style="display: none;">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>9.3.1 Manufacturing units which undertakes Expansion <span class="color-nic-red">*</span></label>
                                    <input type="text" name="manufacuring_unit_for_ips" id="manufacuring_unit_for_ips" class="form-control" placeholder="Enter Manufacturing units which undertakes Expansion"
                                           value="{{manufacuring_unit}}" onblur="checkValidation('ips', 'manufacuring_unit_for_ips', detailsValidationMessage);">
                                    <span class="error-message error-message-ips-manufacuring_unit_for_ips"></span>
                                </div>
                                <div class="form-group col-12">
                                    <label>9.3.2 Diversification (Manufacturing) <span class="color-nic-red">*</span></label>
                                    <input type="text" name="diversification_unit_for_ips" id="diversification_unit_for_ips" class="form-control" placeholder="Enter Diversification"
                                           value="{{diversification_unit}}" onblur="checkValidation('ips', 'diversification_unit_for_ips', detailsValidationMessage);">
                                    <span class="error-message error-message-ips-diversification_unit_for_ips"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 ex_service_unit_container_for_ips" style="display: none;">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>9.4.1 Service units which undertakes Expansion <span class="color-nic-red">*</span></label>
                                    <input type="text" name="service_unit_for_ips" id="service_unit_for_ips" class="form-control" placeholder="Enter Service units which undertakes Expansion"
                                           value="{{service_unit}}" onblur="checkValidation('ips', 'service_unit_for_ips', detailsValidationMessage);">
                                    <span class="error-message error-message-ips-service_unit_for_ips"></span>
                                </div>
                                <div class="form-group col-12">
                                    <label>9.4.2 Diversification (Service) <span class="color-nic-red">*</span></label>
                                    <input type="text" name="diversification_service_for_ips" id="diversification_service_for_ips" class="form-control" placeholder="Enter Diversification"
                                           value="{{diversification_service}}" onblur="checkValidation('ips', 'diversification_service_for_ips', detailsValidationMessage);">
                                    <span class="error-message error-message-ips-diversification_service_for_ips"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label>10. Sector Category <span class="color-nic-red">*</span></label>
                    <div id="sector_category_container_for_ips">
                    </div>
                    <span class="error-message error-message-ips-sector_category_for_ips"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label>11. Select Thrust Sectors (if Applicable) </label>
                    <div id="thrust_sectors_container_for_ips" class="row">
                    </div>
                    <span class="error-message error-message-ips-thrust_sectors_for_ips"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>12. Date of Commencement of the Commercial Production / Service <span class="color-nic-red">*</span></label>
                    <div class="input-group date ">
                        <input type="text" name="commencement_date_for_ips" id="commencement_date_for_ips" class="form-control date_picker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"
                               value="{{commencement_date_text}}" onblur="checkValidation('ips', 'commencement_date_for_ips', dateValidationMessage);">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                    </div>
                    <span class="error-message error-message-ips-commencement_date_for_ips"></span>
                </div>
                <div class="form-group col-sm-6">
                    <label>13. Gross Fixed Capital Investment ((GFCI)) <span class="color-nic-red">*</span></label>
                    <input type="text" id="gfc_investment_for_ips" name="gfc_investment_for_ips" class="form-control" 
                           onkeyup="checkNumeric($(this));" maxlength="20"
                           onblur="checkValidation('ips', 'gfc_investment_for_ips', investmentValidationMessage);"
                           placeholder="Enter Gross Fixed Capital Investment ((GFCI)) !" value="{{gfc_investment}}">
                    <span class="error-message error-message-ips-gfc_investment_for_ips"></span>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-nic-blue p-2">
                    <h3 class="card-title f-w-b f-s-16px">CHECK LIST OF ENCLOSURES (AS APPLICABLE) TO BE SUBMITTED FOR COMMON APPLICATION FORM</h3>
                </div>
                <div class="card-body pb-0 border-nic-blue">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td class="text-center f-w-b" style="width: 50px;">1</td>
                                    <td style="min-width: 200px;">Format of Undertaking</td>
                                    <td class="text-center" style="width: 295px;">
                                        <a href="assets/department/dic/inc/UNDERTAKING.pdf" target="_blank" class="btn btn-sm btn-nic-blue">
                                            <i class="fas fa-download"></i> &nbsp; Download
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 f-w-b mb-1 mt-2">
                    List of Documents to be Submitted Along with Application<br>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-1">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="text-center" style="width: 50px;">No.</th>
                            <th class="text-center" style="min-width: 200px;">Document Name</th>
                            <th class="text-center" style="width: 295px;">Upload Document</th>
                        </tr>
                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">Copy of Udyam Registration / Industrial Entrepreneur Memorandum, as applicable. 
                                <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_FOUR}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_FOUR}}" name="upload_for_ips_{{VALUE_FOUR}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_FOUR}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_FOUR}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_FOUR}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_FOUR}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_FOUR}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_FOUR}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>
                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">Copy of Partnership Deed and Firm Registration Certificate in case ofs
                                partnership concern or Memorandum & Articles of Association and Date
                                of Incorporation Certificate in case of Public/Private Limited companies. 
                                <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_FIVE}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_FIVE}}" name="upload_for_ips_{{VALUE_FIVE}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_FIVE}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_FIVE}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_FIVE}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_FIVE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_FIVE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_FIVE}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>
                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">A) If the Enterprise is functioning in its own land, copy of land purchase
                                deed duly signed by the applicant.<br>
                                B)If the Enterprise is functioning in a leased land/ building, copy of
                                registered lease agreement for a minimum period of 5 years from the date
                                of commencement of commercial production. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_SIX}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_SIX}}" name="upload_for_ips_{{VALUE_SIX}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_SIX}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_SIX}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_SIX}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_SIX}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_SIX}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_SIX}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>
<!--                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">If the Enterprise is functioning in a leased land/ building, copy of
                                registered lease agreement for a minimum period of 5 years from the date
                                of commencement of commercial production. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_SEVEN}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_SEVEN}}" name="upload_for_ips_{{VALUE_SEVEN}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_SEVEN}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_SEVEN}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_SEVEN}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_SEVEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_SEVEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_SEVEN}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>-->
                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">Copy of sanction order from Electricity Department for power supply
                                with copy of the latest bill. <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_EIGHT}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_EIGHT}}" name="upload_for_ips_{{VALUE_EIGHT}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_EIGHT}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_EIGHT}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_EIGHT}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_EIGHT}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_EIGHT}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_EIGHT}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>
                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">Authorization letter. 
                                <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_NINE}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_NINE}}" name="upload_for_ips_{{VALUE_NINE}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_NINE}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_NINE}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_NINE}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_NINE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_NINE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_NINE}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>
                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">Copy of Consent to Operate / Renewal from PCC, DNH & DD (as applicable for
                                Notification No. PCC/DMN/13(PART VI)/2020-21/448 DATED
                                25/01/2021).  
                                <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_TEN}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_TEN}}" name="upload_for_ips_{{VALUE_TEN}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_TEN}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_TEN}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_TEN}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_TEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_TEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_TEN}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>
                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">Copy of Factory licensee. 
                                <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_ELEVEN}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_ELEVEN}}" name="upload_for_ips_{{VALUE_ELEVEN}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_ELEVEN}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_ELEVEN}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_ELEVEN}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_ELEVEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_ELEVEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_ELEVEN}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>
<!--                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">Other Statutory clearances/Licenses, as applicable.
                                <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_TWELVE}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_TWELVE}}" name="upload_for_ips_{{VALUE_TWELVE}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_TWELVE}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_TWELVE}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_TWELVE}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_TWELVE}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_TWELVE}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_TWELVE}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>-->
                        <tr class="doc-for-is">
                            <td class="text-center doc-sr-no is-doc-sr-no"></td>
                            <td class="f-w-b">Undertaking.
                                <span style="color: red;"><br>(Maximum File Size: 10MB)(Upload pdf Only)</span>
                            </td>
                            <td>
                                <div id="upload_container_for_ips_{{VALUE_EIGHTEEN}}">
                                    <input type="file" id="upload_for_ips_{{VALUE_EIGHTEEN}}" name="upload_for_ips_{{VALUE_EIGHTEEN}}"
                                           accept="application/pdf" onchange="Ips.listview.uploadDocumentForIps('{{VALUE_EIGHTEEN}}');">
                                    <div class="error-message error-message-ips-upload_for_ips_{{VALUE_EIGHTEEN}}"></div>
                                </div>
                                <div id="upload_name_container_for_ips_{{VALUE_EIGHTEEN}}" style="display: none;">
                                    <a target="_blank" id="upload_name_href_for_ips_{{VALUE_EIGHTEEN}}" class="cursor-pointer"><label class="btn btn-sm btn-nic-blue f-w-n">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    <button type="button" id="remove_document_btn_for_ips_{{VALUE_EIGHTEEN}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                                            onclick="Ips.listview.askForRemove('{{ips_id}}', '{{VALUE_EIGHTEEN}}');">
                                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                                </div>
                                <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{VALUE_EIGHTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <!--            <div class="card bg-beige">
                            <div class="card-body color-nic-red">
                                <b>Note : </b> The Enterprise submitting the subsidy has to prepare the hard copy file of documents submitted and submit it to the concerned DIC office within 7 working days from the date of application of the subsidy.
                            </div>
                        </div>-->
            <hr class="mb-2">
            <div>
                <button type="button" id="submit_btn_for_ips" class="btn btn-sm btn-success" onclick="Ips.listview.submitIps($(this));"
                        style="margin-right: 5px;"><i class="fas fa-save"></i> &nbsp; Submit</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="Ips.listview.loadIpsData();">
                    <i class="fas fa-times"></i> &nbsp; Cancel</button>
            </div>
        </div>
    </form>
</div>