<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-12">
        <div class="card">
            <form method="post" id="shop_form" autocomplete="off" class="m-t-15">
                <input type="hidden" name="s_id" id="s_id" class="form-control" value="{{s_id}}">
                <input type="hidden" name="temp_s_sign_of_employer" id="temp_s_sign_of_employer" class="form-control" value="{{s_sign_of_employer}}">
                <div style="font-size: 16px; text-align: center; margin-top: 5px;font-weight: bold;">FORM-I</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">(See Rule 3)</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">STATEMENT UNDER SECTION 3(1)</div>
                <hr class="m-b-1rem">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-shop f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            To,<br>
                            Labour Inspector<br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>District <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <select id="district" name="district" class="form-control select2"
                                        data-placeholder="Select District" style="width: 100%;">  
                                </select>
                            </div>
                            <span class="error-message error-message-shop-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label> Entity / Establishment Type <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <select id="entity_establishment_type" name="entity_establishment_type" class="form-control select2"
                                    data-placeholder="Select Entity / Establishment Type" style="width: 100%;" onblur="checkValidation('shop', 'entity_establishment_type', entityEstablishmentTypeValidationMessage);">
                            </select>
                            </div>
                            <span class="error-message error-message-shop-entity_establishment_type"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. Registration Category <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <select id="regi_category" name="regi_category" class="form-control select2" data-placeholder="Select Registration Category" style="width: 100%;"> 
                                    <option value="Shops">Shops</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                </select>
                            </div>
                            <span class="error-message error-message-shop-regi_category"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>2. Name of the Shop/Establishment <span style="color: red;">*</span></label>
                            <input type="text" id="name_for_shop" name="name_for_shop" class="form-control" placeholder=" Shop/Establishment Name !"
                                   maxlength="100" onblur="checkValidation('shop', 'name_for_shop', shopNameValidationMessage);" value="{{s_name}}">
                            <span class="error-message error-message-shop-name_for_shop"></span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>3. Door No. <span style="color: red;">*</span></label>
                            <input type="text" id="door_no_for_shop" name="door_no_for_shop" class="form-control" placeholder=" Door No. of the Shop/Establishment !"
                                   maxlength="25" onblur="checkValidation('shop', 'door_no_for_shop', shopDoorNoValidationMessage);" value="{{s_door_no}}">
                            <span class="error-message error-message-shop-door_no_for_shop"></span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>4. Street Name <span style="color: red;">*</span></label>
                            <input type="text" id="street_name_for_shop" name="street_name_for_shop" class="form-control" placeholder=" Street Name of the Shop/Establishment !"
                                   maxlength="100" onblur="checkValidation('shop', 'street_name_for_shop', shopStreetNameValidationMessage);" value="{{s_street_name}}">
                            <span class="error-message error-message-shop-street_name_for_shop"></span>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Location of the Shop/Establishment   <span style="color: red;">*</span></label>
                            <textarea id="loaction_for_shop" name="loaction_for_shop" class="form-control"
                                      onblur="checkValidation('shop', 'loaction_for_shop', shopLocationValidationMessage);"
                                      placeholder=" Location of the Shop/Establishment !" maxlength="200">{{s_location}}</textarea>
                            <span class="error-message error-message-shop-loaction_for_shop"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>6. Postal Address of the Shop/Establishment  <span style="color: red;">*</span></label>
                            <textarea id="postal_address_for_shop" name="postal_address_for_shop" class="form-control"
                                      onblur="checkValidation('shop', 'postal_address_for_shop', shopPostalAddressValidationMessage);"
                                      placeholder=" Postal Address of the Shop/Establishment !" maxlength="200">{{s_postal_address}}</textarea>
                            <span class="error-message error-message-shop-postal_address_for_shop"></span>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>7. Exact location of office, Store-room,godown, Warehouse or work place if any attached to shop<br> but situated in premises different from Those of Shop/Establishment .</label>
                            <input type="checkbox" id="different_location_for_shop" name="different_location_for_shop" class="checkbox" value="{{is_checked}}" style="margin-top: -21px;margin-left: -148px;">
                            <span class="error-message error-message-shop-different_location_for_shop"></span>
                        </div>
                    </div>
                    <div class="row shop_defferent_location" style="display:none;">
                        <div class="form-group col-sm-6">
                            <label>7.1. Office Location of the Shop/Establishment  </label>
                            <textarea type="text" id="office_location_for_shop" name="office_location_for_shop" class="form-control"
                                      onblur="checkValidation('shop', 'office_location_for_shop', shopOfficeLocationValidationMessage);"
                                      placeholder=" Office Location of the Shop/Establishment !" maxlength="100">{{s_different_location_office}}</textarea>
                            <span class="error-message error-message-shop-office_location_for_shop"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7.2. Store-room Location the Shop/Establishment  </label>
                            <textarea id="store_room_location_for_shop" name="store_room_location_for_shop" class="form-control"
                                      onblur="checkValidation('shop', 'store_room_location_for_shop', shopStoreRoomLocationValidationMessage);"
                                      placeholder=" Store-room Location of the Shop/Establishment !" maxlength="100">{{s_different_location_store_room}}</textarea>
                            <span class="error-message error-message-shop-store_room_location_for_shop"></span>
                        </div>
                    </div>
                    <div class="row shop_defferent_location" style="display:none;">
                        <div class="form-group col-sm-6">
                            <label>7.3. Godown Location of the Shop/Establishment  </label>
                            <textarea type="text" id="godown_location_for_shop" name="godown_location_for_shop" class="form-control"
                                      onblur="checkValidation('shop', 'godown_location_for_shop', shopGodownLocationValidationMessage);"
                                      placeholder=" Godown Location of the Shop/Establishment !" maxlength="100">{{s_different_location_godown}}</textarea>
                            <span class="error-message error-message-shop-godown_location_for_shop"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>7.4. Warehouse Location the Shop/Establishment  </label>
                            <textarea id="warehouse_location_for_shop" name="warehouse_location_for_shop" class="form-control"
                                      onblur="checkValidation('shop', 'warehouse_location_for_shop', shopWarehouseLocationValidationMessage);"
                                      placeholder=" Warehouse Location of the Shop/Establishment !" maxlength="100">{{s_different_location_warehouse}}</textarea>
                            <span class="error-message error-message-shop-warehouse_location_for_shop"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Employer Information</h3>
                    <hr class="m-b-5px">
                    <div class="row">
                        <div class="col-sm-5 form-group">
                            <label>8. Full Name of the Employer(including his Father's Name)<span style="color: red;">*</span></label>
                            <input type="text" id="name_of_employer_for_shop" name="name_of_employer_for_shop" class="form-control" placeholder=" Full Name of the Employer !"
                                   maxlength="100" onblur="checkValidation('shop', 'name_of_employer_for_shop', shopEmployerNameValidationMessage);" value="{{s_employer_name}}">
                            <span class="error-message error-message-shop-name_of_employer_for_shop"></span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>9. Mobile No. of the Employer <span style="color: red;">*</span></label>
                            <input type="text" id="mobile_no_employer_for_shop" name="mobile_no_employer_for_shop" class="form-control" placeholder=" Mobile No. of the Employer !"
                                   maxlength="10" onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this)); checkValidationForMobileNumber('shop', 'mobile_no_employer_for_shop', mobileValidationMessage);" value="{{s_employer_mobile_no}}">
                            <span class="error-message error-message-shop-mobile_no_employer_for_shop"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>10. Residential address of the Employer <span style="color: red;">*</span></label>
                            <textarea id="residential_address_employer_for_shop" name="residential_address_employer_for_shop" class="form-control" placeholder=" Residential Address of the Employer !"
                                      maxlength="200" onblur="checkValidation('shop', 'residential_address_employer_for_shop', shopEmployerResidentialAddressValidationMessage);">{{s_employer_residential_address}}</textarea>
                            <span class="error-message error-message-shop-residential_address_employer_for_shop"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">11. Manager Information</h3>
                    <hr class="m-b-5px">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>11.1 Full Name of the Manager (including his Father's Name) </label>
                            <input type="text" id="manager_name_for_shop" name="manager_name_for_shop" class="form-control" placeholder=" Full Name of Manager !"
                                   maxlength="100" value="{{s_manager_name}}">
                            <span class="error-message error-message-shop-manager_name_for_shop"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>11.2 Residential Address of the Manager </label>
                            <textarea id="residential_address_manager_for_shop" name="residential_address_manager_for_shop" class="form-control"
                                      placeholder=" Residential Address of the Manager !" maxlength="200">{{s_manager_residential_address}}</textarea>
                            <span class="error-message error-message-shop-residential_address_manager_for_shop"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">12. Partner Information (if a partner-Ship Concerned)</h3>
                    <hr class="m-b-5px">
                    <div class="col-xs-12">
                        <div style="background-color: #d2d6de; padding: 3px;">
                            <table class="table table-bordered m-b-0px" id="partnerInfoDetails" style="margin-top: 0px;">
                                <thead>
                                    <tr style='color: #000;'>
                                        <th style="width: 20px;">Sr.No.</th>
                                        <th style="width: 520px;">Full Name of the Partner (including his Father's Name)</th>
                                        <th style="width: 520px;"> Residential Address of the Partner</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="partner_info_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer" align="right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-sm btn-nic-blue" onclick="Shop.listview.addMultiplePartnerInfo({});"
                                    style="margin-right: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add Partner Details</button>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="form-group col-sm-12">
                            <label>13. Category of establishment i.e, whether a Shop, Commercial Establishment, residential Hotel, restaurant, eating house, theatre, Cinema, or other place or public amusement of entertainment etc. <span style="color: red;">*</span></label>
                            <input type="text" id="category_for_shop" name="category_for_shop" class="form-control" placeholder=" Category of establishment i.e, whether a Shop, Commercial Establishment, residential Hotel, restaurant, eating house, theatre, Cinema, or other place or public amusement of entertainment etc. !"
                                   maxlength="100"   onblur="checkValidation('shop', 'category_for_shop', shopCategoryValidationMessage);" value="{{s_category}}">
                            <span class="error-message error-message-shop-category_for_shop"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>14. Nature of Business <span style="color: red;">*</span></label>
                            <input type="text" id="nature_of_business_for_shop" name="nature_of_business_for_shop" class="form-control" placeholder=" Nature of Business of Shop/Establishment !"
                                   maxlength="100"   onblur="checkValidation('shop', 'nature_of_business_for_shop', shopNatureOfBusinessValidationMessage);" value="{{s_nature_of_business}}">
                            <span class="error-message error-message-shop-nature_of_business_for_shop"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>15. Date of commencement of business  <span style="color: red;">*</span></label>
                            <div class="input-group date date_picker">
                                <input type="text" class="form-control date_picker" name="date_commencement_of_business_for_shop" id="date_commencement_of_business_for_shop" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY"
                                       value="{{s_commencement_of_business_date}}" onblur="checkValidation('shop', 'date_commencement_of_business_for_shop', shopDateCommencementOfBusinessValidationMessage);">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-shop-date_commencement_of_business_for_shop"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">16. Names of members of employer's family engaged in the Shop/Establishment</h3>
                    <hr class="m-b-5px">
                    <div class="col-xs-12">
                        <div style="background-color: #d2d6de; padding: 3px;">
                            <table class="table table-bordered m-b-0px" style="margin-top: 0px;">
                                <thead>
                                    <tr style='color: #000;'>
                                        <th style="width: 10px">Sr.No.</th>
                                        <th>Name</th>
                                        <th>Relationship</th>
                                        <th>Gender</th>
                                        <th>Adult</th>
                                        <th>Young Person</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="employer_family_info_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer" align="right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-sm btn-nic-blue" onclick="Shop.listview.addMultipleFamilyMembers({});"
                                    style="margin-right: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add Family Members</button>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">17. Names of other Employees <span style="color: red;">*</span></h3>
                    <hr class="m-b-5px">
                    <div class="col-xs-12">
                        <div style="background-color: #d2d6de; padding: 3px;">
                            <table class="table table-bordered m-b-0px" id="employeeInfoDetails" style="margin-top: 0px;">
                                <thead>
                                    <tr style='color: #000;'>
                                        <th style="width: 5px;">Sr. No.</th>
                                        <th style="width: 255px;">Name</th>
                                        <th style="width: 150px;">in a Managerial capacity</th>
                                        <th style="width: 180px;">as Sweeper, Caretaker & travelling Staff</th>
                                        <th style="width: 230px;">as Person employed for loading & unloading of goods at godown</th>
                                        <th style="width: 85px;">Gender</th>
                                        <th style="width: 30px;">Adult</th>
                                        <th style="width: 50px;">Young Person</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="employees_info_container">
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer" align="right" style="margin-top: 5px;">
                            <button type="button" class="btn btn-sm btn-nic-blue" onclick="Shop.listview.addMultipleEmployeesInfo({});"
                                    style="margin-right: 5px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Add Employees Details</button>
                        </div>
                    </div>
                    <hr class="m-b-5px">
                    <div class="row">
                        <div class="col-12 m-b-5px" id="lease_agreement_document_container">
                            <label>18. Lease Agreement / Ownership Documents / NOC from Owner of Premises / MOA (if Applicable) <span style="color: red;"><br>(Maximum File Size: 10MB) &nbsp; (Upload Pdf | ZIP Only)</span></label><br>
                            <input type="file" id="lease_agreement_document" name="lease_agreement_document"
                                   accept="application/pdf,application/zip" class="spinner_container_for_shop_{{VALUE_ONE}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_ONE);">
                            <div class="error-message error-message-shop-lease_agreement_document"></div>
                        </div>
                        <div class="form-group col-sm-12" id="lease_agreement_document_name_container" style="display: none;">
                            <label>18. Lease Agreement / Ownership Documents / NOC from Owner of Premises / MOA (if Applicable) </label><br>
                            <a id="lease_agreement_document_download" target="_blank"><lable id="lease_agreement_document_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_ONE}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="lease_agreement_document_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_ONE}}" style="vertical-align: top;" 
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_ONE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="house_tax_copy_container">
                            <label>19. Copy of House Tax or License Issued by Panchayat or DMC. <span style="color: red;">* <br>(Maximum File Size: 10MB) &nbsp; (Upload Pdf | ZIP Only)</span></label><br>
                            <input type="file" id="house_tax_copy" name="house_tax_copy"
                                   accept="application/pdf,application/zip"  class="spinner_container_for_shop_{{VALUE_TWO}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_TWO);">
                            <div class="error-message error-message-shop-house_tax_copy"></div>
                        </div>
                        <div class="form-group col-sm-12" id="house_tax_copy_name_container" style="display: none;">
                            <label>19. Copy of House Tax or License Issued by Panchayat or DMC. <span style="color: red;">*</span></label><br>
                            <a id="house_tax_copy_download" target="_blank"><lable id="house_tax_copy_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_TWO}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="house_tax_copy_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_TWO);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="photo_of_shop_container">
                            <label>20. Photo of Shop / Establishment / Hoarding <span style="color: red;">* <br>(Maximum File Size: 10MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="photo_of_shop" name="photo_of_shop"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" class="spinner_container_for_shop_{{VALUE_THREE}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_THREE);">
                            <div class="error-message error-message-shop-photo_of_shop"></div>
                        </div>
                        <div class="form-group col-sm-12" id="photo_of_shop_name_container" style="display: none;">
                            <label>20. Photo of Shop / Establishment / Hoarding <span style="color: red;">*</span></label><br>
                            <a id="photo_of_shop_download" target="_blank"><lable id="photo_of_shop_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_THREE}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="photo_of_shop_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_THREE}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_THREE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="aadhar_card_container">
                            <label>21. Aadhar Card <span style="color: red;"><br>(Maximum File Size: 10MB) &nbsp; (Upload Pdf | ZIP Only)</span></label><br>
                            <input type="file" id="aadhar_card" name="aadhar_card"
                                   accept="application/pdf,application/zip" class="spinner_container_for_shop_{{VALUE_FOUR}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_FOUR);">
                            <div class="error-message error-message-shop-aadhar_card"></div>
                        </div>
                        <div class="form-group col-sm-12" id="aadhar_card_name_container" style="display: none;">
                            <label>21. Aadhar Card </label><br>
                            <a id="aadhar_card_download" target="_blank"><lable id="aadhar_card_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_FOUR}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="aadhar_card_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_FOUR}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_FOUR);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="pan_card_container">
                            <label>22. Pan Card <span style="color: red;">* <br>(Maximum File Size: 10MB) &nbsp; (Upload Pdf | ZIP Only)</span></label><br>
                            <input type="file" id="pan_card" name="pan_card"
                                   accept="application/pdf,application/zip" class="spinner_container_for_shop_{{VALUE_FIVE}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_FIVE);">
                            <div class="error-message error-message-shop-pan_card"></div>
                        </div>
                        <div class="form-group col-sm-12" id="pan_card_name_container" style="display: none;">
                            <label>22. Pan Card <span style="color: red;">*</span></label><br>
                            <a id="pan_card_download" target="_blank"><lable id="pan_card_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_FIVE}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="pan_card_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_FIVE}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_FIVE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="gst_container">
                            <label>23. GST <span style="color: red;"><br>(Maximum File Size: 10MB) &nbsp; (Upload Pdf | ZIP Only)</span></label><br>
                            <input type="file" id="gst" name="gst"
                                   accept="application/pdf,application/zip" class="spinner_container_for_shop_{{VALUE_SIX}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_SIX);">
                            <div class="error-message error-message-shop-gst"></div>
                        </div>
                        <div class="form-group col-sm-12" id="gst_name_container" style="display: none;">
                            <label>23. GST </label><br>
                            <a id="gst_download" target="_blank"><lable id="gst_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_SIX}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="gst_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_SIX}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_SIX);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="seal_and_stamp_container_for_shop">
                            <label>24. Signature <span style="color: red;">* <br>(Maximum File Size: 1 MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <input type="file" id="seal_and_stamp_for_shop" name="seal_and_stamp_for_shop"
                                   accept="image/jpg,image/png,image/jpeg,image/jfif" class="spinner_container_for_shop_{{VALUE_SEVEN}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_SEVEN);">
                            <div class="error-message error-message-shop-seal_and_stamp_for_shop"></div>
                        </div>
                        <div class="form-group col-sm-12" id="seal_and_stamp_name_container_for_shop" style="display: none;">
                            <label>24. Signature <span style="color: red;">*</span></label><br>
                            <a target="_blank" id="seal_and_stamp_download"><img id="seal_and_stamp_name_image_for_shop" class="spinner_name_container_for_shop_{{VALUE_SEVEN}}" style="width: 250px; height: 250px; border: 2px solid blue;"></a>
                            <button type="button" id="seal_and_stamp_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_SEVEN}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}',VALUE_SEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="certificate_tourism_container">
                            <label>25. Certificate of Registration issued by Tourism Department (in case if a Hotel) <span style="color: red;"><br>(Maximum File Size: 10MB) &nbsp; (Upload Pdf | ZIP Only)</span></label><br>
                            <input type="file" id="certificate_tourism" name="certificate_tourism"
                                   accept="application/pdf,application/zip" class="spinner_container_for_shop_{{VALUE_EIGHT}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_EIGHT);">
                            <div class="error-message error-message-shop-certificate_tourism"></div>
                        </div>
                        <div class="form-group col-sm-12" id="certificate_tourism_name_container" style="display: none;">
                            <label>25. Certificate of Registration issued by Tourism Department (in case if a Hotel) </label><br>
                            <a id="certificate_tourism_download" target="_blank"><lable id="certificate_tourism_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_EIGHT}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="certificate_tourism_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_EIGHT}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_EIGHT);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="license_health_container">
                            <label>26. License Issued under FSSAI by Health Department (in case of a Hotel/Bar/Restaurant) <span style="color: red;"><br>(Maximum File Size: 10MB) &nbsp; (Upload Pdf | ZIP Only)</span></label><br>
                            <input type="file" id="license_health" name="license_health"
                                   accept="application/pdf,application/zip" class="spinner_container_for_shop_{{VALUE_NINE}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_NINE);">
                            <div class="error-message error-message-shop-license_health"></div>
                        </div>
                        <div class="form-group col-sm-12" id="license_health_name_container" style="display: none;">
                            <label>26. License Issued under FSSAI by Health Department (in case of a Hotel/Bar/Restaurant) </label><br>
                            <a id="license_health_download" target="_blank"><lable id="license_health_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_NINE}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="license_health_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_NINE}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_NINE);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="noc_health_container">
                            <label>27. NOC on Sanitory Point of View issued by Health Department (in case of Hotel/Bar/Restaurant) <span style="color: red;"><br>(Maximum File Size: 10MB) &nbsp; (Upload Pdf | ZIP Only)</span></label><br>
                            <input type="file" id="noc_health" name="noc_health"
                                   accept="application/pdf,application/zip" class="spinner_container_for_shop_{{VALUE_TEN}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_TEN);">
                            <div class="error-message error-message-shop-noc_health"></div>
                        </div>
                        <div class="form-group col-sm-12" id="noc_health_name_container" style="display: none;">
                            <label>27. NOC on Sanitory Point of View issued by Health Department (in case of Hotel/Bar/Restaurant) </label><br>
                            <a id="noc_health_download" target="_blank"><lable id="noc_health_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_TEN}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="noc_health_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_TEN}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_TEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-5px" id="security_license_container">
                            <label>28. License to Engage in the Business of Private Security Agency <span style="color: red;"><br>(Maximum File Size: 10MB) &nbsp; (Upload Pdf | ZIP Only)</span></label><br>
                            <input type="file" id="security_license" name="security_license"
                                   accept="application/pdf,application/zip" class="spinner_container_for_shop_{{VALUE_ELEVEN}}" onchange="Shop.listview.uploadDocumentForShop(VALUE_ELEVEN);">
                            <div class="error-message error-message-shop-security_license"></div>
                        </div>
                        <div class="form-group col-sm-12" id="security_license_name_container" style="display: none;">
                            <label>28. License to Engage in the Business of Private Security Agency </label><br>
                            <a id="security_license_download" target="_blank"><lable id="security_license_name_image" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_shop_{{VALUE_ELEVEN}}" style="border: 2px solid black;">{{VIEW_UPLODED_DOCUMENT}}</lable></a>
                            <button type="button" id="security_license_remove_btn" class="btn btn-sm btn-danger spinner_name_container_for_shop_{{VALUE_ELEVEN}}" style="vertical-align: top;"
                                    onclick="Shop.listview.askForRemove('{{s_id}}', VALUE_ELEVEN);">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <hr class="m-b-5px">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="declaration_for_shop" name="declaration_for_shop" value="{{is_checked}}">
                                <label class="form-check-label" for="declaration_for_shop">
                                    I Hereby Declare that the Particulars Given Above are True to the Best of My Knowledge and Belief. <span style="color: red;">*</span>
                                </label>
                            </div>
                            <span class="error-message error-message-shop-declaration_for_shop"></span>
                        </div>
                    </div>
                    <hr class="m-b-1rem"> 
                    <div class="form-group">
                        <button type="button" id="submit_btn_for_shop" class="btn btn-sm btn-nic-blue" onclick="Shop.listview.askForSubmitShop('{{VALUE_ONE}}');" style="margin-right: 5px;">Save As Draft</button>
                        <button type="button" id="draft_btn_for_shop" class="btn btn-sm btn-success" onclick="Shop.listview.askForSubmitShop('{{VALUE_TWO}}');"  style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Shop.listview.loadShopData();"  style="margin-right: 5px;">Cancel</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
