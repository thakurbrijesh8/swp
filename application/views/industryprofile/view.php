<div class="row">
   <!--  <div class="col-sm-12"></div> -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Industry Survey Form</div>
                
            </div>
            <form role="form" id="industry_profile_form" name="industry_profile_form" onsubmit="return false;">
                <input type="hidden" id="company_survey_id" name="company_survey_id" value="{{company_survey_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-survey f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Name of Enterprise / Unit <span style="color: red;">*</span></label>
                            <input type="text" id="company_name_for_survey" name="company_name_for_survey" class="form-control" placeholder="Name of Enterprise / Unit" value="{{company_name}}" readonly onblur="checkValidation('survey', 'company_name_for_survey', companyNameValidationMessage);"/>
                            <span class="error-message error-message-survey-company_name_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Name of Entrepreneur <span style="color: red;">*</span></label>
                            <input type="text" id="entrepreneur_name_for_survey" name="entrepreneur_name_for_survey"
                                   class="form-control" placeholder="Name of Entrepreneur"
                                   readonly onblur="checkValidation('survey', 'entrepreneur_name_for_survey', entrepreneurNameValidationMessage);"
                                   value="{{entrepreneur_name}}" maxlength="100"/>
                            <span class="error-message error-message-survey-entrepreneur_name_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Address / Location  of Unit <span style="color: red;">*</span></label>
                            <textarea id="company_address_for_survey" name="company_address_for_survey"
                                      class="form-control" placeholder="Enter Address / Location  of Unit !"
                                      readonly onblur="checkValidation('survey', 'company_address_for_survey', companyAddressValidationMessage);"
                                      maxlength="200">{{company_address}}</textarea>
                            <span class="error-message error-message-survey-company_address_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Name of Industrial Estate <span style="color: red;">*</span></label>
                            <input type="text" id="estate_name_for_survey" name="estate_name_for_survey"
                                   class="form-control" placeholder="Name of Industrial Estate"
                                   readonly onblur="checkValidation('survey', 'estate_name_for_survey', eStateNameValidationMessage);"
                                   value="{{estate_name}}" maxlength="100"/>
                            <span class="error-message error-message-survey-estate_name_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Details of Industrial Estate <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="estate_details_for_survey" name="estate_details_for_survey" value="{{ESTATE_GOVERNMENT}}">
                                    Government
                                </label>
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled name="estate_details_for_survey" value="{{ESTATE_PRIVATE}}">
                                    Private
                                </label>
                                <label>
                                    <input type="radio" disabled name="estate_details_for_survey" value="{{ESTATE_OTHER}}">
                                    Other
                                </label>
                            </div>
                            <span class="error-message error-message-survey-estate_details_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Udyog Aadhar Number / Industrial Memorandum <span style="color: red;">*</span></label>
                            <input type="text" id="udyog_aadhar_memorandum_for_survey" name="udyog_aadhar_memorandum_for_survey"
                                   class="form-control" placeholder="Enter Udyog Aadhar Number / Industrial Memorandum"
                                   readonly onblur="checkValidation('survey', 'udyog_aadhar_memorandum_for_survey', udyogAadharMemorandumValidationMessage);"
                                   value="{{udyog_aadhar_memorandum}}" maxlength="50"/>
                            <span class="error-message error-message-survey-udyog_aadhar_memorandum_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>PAN Number </label>
                            <input type="text" id="pan_number_for_survey" name="pan_number_for_survey"
                                   class="form-control" placeholder="Enter PAN Number"
                                   readonly onblur="checkValidationForPAN('survey', 'pan_number_for_survey');"
                                   value="{{pan_number}}" maxlength="10" style="text-transform: uppercase;"/>
                            <span class="error-message error-message-survey-pan_number_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Official / Communication Address <span style="color: red;">*</span></label>
                            <textarea id="official_address_for_survey" name="official_address_for_survey" class="form-control"
                                      readonly onblur="checkValidation('survey', 'official_address_for_survey', officialAddressValidationMessage);"
                                      placeholder="Enter Official / Communication Address !" maxlength="200">{{official_address}}</textarea>
                            <span class="error-message error-message-survey-official_address_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Name of Authorized Person <span style="color: red;">*</span></label>
                            <input type="text" id="authorized_person_name_for_survey" name="authorized_person_name_for_survey" class="form-control" placeholder="Name of Authorized Person" value="{{authorized_person_name}}" readonly onblur="checkValidation('survey', 'authorized_person_name_for_survey', personNameValidationMessage);"/>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Contact Number of Authorized Person <span style="color: red;">*</span></label>
                            <input type="text" id="authorized_person_contactno_for_survey" name="authorized_person_contactno_for_survey" class="form-control" placeholder="Contact Number of Authorized Person" value="{{authorized_person_contactno}}" readonly onblur="checkValidationForMobileNumber('survey', 'authorized_person_contactno_for_survey', mobileValidationMessage);"/>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>E-Mail Id <span style="color: red;">*</span></label>
                            <input type="text" id="authorized_person_email_for_survey" name="authorized_person_email_for_survey" class="form-control" placeholder="E-Mail Id" value="{{authorized_person_email}}" readonly onblur="checkValidationForEmail('survey', 'authorized_person_email_for_survey', emailValidationMessage);"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Type of Industry <span style="color: red;">*</span></label>
                            <select id="industry_type_for_survey" name="industry_type_for_survey" class="form-control" disabled="" 
                                    data-placeholder="Select Type of Industry !"
                                    onchange="checkValidation('survey', 'industry_type_for_survey', selectIndustryTypeValidationMessage);
                                        industryTypeChangeEvent($(this), 'survey');">
                                <option value="">Select Type of Industry</option>
                            </select>
                            <span class="error-message error-message-survey-industry_type_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Industry Category</label>
                            <textarea id="remarks_for_survey" name="remarks_for_survey" class="form-control"
                                      placeholder="" maxlength="200" readonly="" style="height: 75px;">{{remarks}}</textarea>
                            <span class="error-message error-message-survey-remarks_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Turnover of The Establishment <span style="color: red;">* (IN CRORE)</span></label>
                            <input type="text" id="turnover_for_survey" name="turnover_for_survey"
                                   class="form-control" placeholder="Enter Turnover of The Establishment"
                                   readonly onblur="checkValidation('survey', 'turnover_for_survey', turnoverValidationMessage);"
                                   value="{{turnover}}" maxlength="100"/>
                            <span class="error-message error-message-survey-turnover_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-3    form-group">
                            <label>Major Activity <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="major_activity_for_survey" name="major_activity_for_survey" value="{{VALUE_ONE}}">
                                    Manufacturing
                                </label>
                                <label>
                                    <input type="radio" disabled name="major_activity_for_survey" value="{{VALUE_TWO}}">
                                    Service
                                </label>
                            </div>
                            <span class="error-message error-message-survey-major_activity_for_survey"></span>
                        </div>
                        <div class="col-sm-4 col-md-3 form-group">
                            <label>Nature of Activity <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="nature_activity_for_survey" name="nature_activity_for_survey" value="{{VALUE_ONE}}">
                                    Perennial
                                </label>
                                <label>
                                    <input type="radio" disabled name="nature_activity_for_survey" value="{{VALUE_TWO}}">
                                    Seasonal
                                </label>
                            </div>
                            <span class="error-message error-message-survey-nature_activity_for_survey"></span>
                        </div>
                        <div class="col-sm-4 col-md-3 form-group">
                            <label>Social Category of Entrepreneur <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="social_category_for_survey" name="social_category_for_survey" value="{{CATEGORY_SC}}">
                                    SC
                                </label>
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled name="social_category_for_survey" value="{{CATEGORY_ST}}">
                                    ST
                                </label>
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled name="social_category_for_survey" value="{{CATEGORY_OBC}}">
                                    OBC
                                </label>
                                <label>
                                    <input type="radio" disabled name="social_category_for_survey" value="{{CATEGORY_GENERAL}}">
                                    General
                                </label>
                            </div>
                            <span class="error-message error-message-survey-social_category_for_survey"></span>
                        </div>
                        <div class="col-sm-4 col-md-3 form-group">
                            <label>Gender of Entrepreneur <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="gender_for_survey" name="gender_for_survey" value="{{GENDER_MALE}}">
                                    Male
                                </label>
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled name="gender_for_survey" value="{{GENDER_FEMALE}}">
                                    Female
                                </label>
                                <label>
                                    <input type="radio" disabled name="gender_for_survey" value="{{GENDER_OTHER}}">
                                    Other
                                </label>
                            </div>
                            <span class="error-message error-message-survey-gender_for_survey"></span>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-4 col-md-3 form-group">
                            <label>Owner Differently Abled <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="differently_abled_for_survey" name="differently_abled_for_survey" value="{{VALUE_ONE}}">
                                    Yes
                                </label>
                                <label>
                                    <input type="radio" disabled name="differently_abled_for_survey" value="{{VALUE_TWO}}">
                                    No
                                </label>
                            </div>
                            <span class="error-message error-message-survey-differently_abled_for_survey"></span>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 form-group">
                            <label>Type of Organization <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label class="col-xs-6 col-sm-3 col-md-4">
                                    <input type="radio" disabled id="organization_type_for_survey" name="organization_type_for_survey"
                                           onclick="IndustryProfile.listview.orgTypeChangeEvent('{{O_PROPRIETARY}}');"
                                           value="{{O_PROPRIETARY}}">
                                    Proprietary
                                </label>
                                <label class="col-xs-6 col-sm-3 col-md-4">
                                    <input type="radio" disabled name="organization_type_for_survey"
                                           onclick="IndustryProfile.listview.orgTypeChangeEvent('{{O_PARTNERSHIP}}');"
                                           value="{{O_PARTNERSHIP}}">
                                    Partnership
                                </label>
                                <label class="col-xs-6 col-sm-3 col-md-4">
                                    <input type="radio" disabled name="organization_type_for_survey"
                                           onclick="IndustryProfile.listview.orgTypeChangeEvent('{{O_PRIVATE_LIMITED}}');"
                                           value="{{O_PRIVATE_LIMITED}}">
                                    Private Limited
                                </label>
                                <label class="col-xs-6 col-sm-3 col-md-4">
                                    <input type="radio" disabled name="organization_type_for_survey"
                                           onclick="IndustryProfile.listview.orgTypeChangeEvent('{{O_PUBLIC_LIMITED}}');"
                                           value="{{O_PUBLIC_LIMITED}}">
                                    Public Limited
                                </label>
                                <label class="col-xs-6 col-sm-3 col-md-4">
                                    <input type="radio" disabled name="organization_type_for_survey"
                                           onclick="IndustryProfile.listview.orgTypeChangeEvent('{{O_CO_OPERATIVE}}');"
                                           value="{{O_CO_OPERATIVE}}">
                                    Co-Operative
                                </label>
                                <label class="col-xs-6 col-sm-3 col-md-4">
                                    <input type="radio" disabled name="organization_type_for_survey"
                                           onclick="IndustryProfile.listview.orgTypeChangeEvent('{{O_SELF_HALP_GROUP}}');"
                                           value="{{O_SELF_HALP_GROUP}}">
                                    Self Help Group (Typo)
                                </label>
                                <label class="col-xs-6 col-sm-3 col-md-4">
                                    <input type="radio" disabled name="organization_type_for_survey"
                                           onclick="IndustryProfile.listview.orgTypeChangeEvent('{{O_HUF}}');"
                                           value="{{O_HUF}}">
                                    HUF
                                </label>
                                <label class="col-xs-6 col-sm-3 col-md-4">
                                    <input type="radio" disabled name="organization_type_for_survey"
                                           onclick="IndustryProfile.listview.orgTypeChangeEvent('{{O_OTHERS}}');"
                                           value="{{O_OTHERS}}">
                                    Others
                                </label>
                            </div><div class="clearfix"></div>
                            <span class="error-message error-message-survey-organization_type_for_survey"></span>
                        </div>
                        <div class="col-sm-4 col-md-3 form-group" id="other_org_container" style="display: none;">
                            <label>Other Type of Organization <span style="color: red;">*</span></label>
                            <input type="text" id="other_organization_for_survey" name="other_organization_for_survey"
                                   class="form-control" placeholder="Enter Other Type of Organization"
                                   readonly onblur="checkValidation('survey', 'other_organization_for_survey', otherOrgValidationMessage);"
                                   value="{{other_organization}}" maxlength="200"/>
                            <span class="error-message error-message-survey-other_organization_for_survey"></span>
                        </div>
                        <div class="col-sm-4 col-md-3 form-group">
                            <label>Category Under PCC <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="pcc_category_for_survey" name="pcc_category_for_survey" value="{{PCC_RED}}">
                                    Red
                                </label>
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled name="pcc_category_for_survey" value="{{PCC_ORANGE}}">
                                    Green
                                </label>
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled name="pcc_category_for_survey" value="{{PCC_GREEN}}">
                                    Orange
                                </label>
                            </div>
                            <span class="error-message error-message-survey-pcc_category_for_survey"></span>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Employment in Nos. <span style="color: red;">*</span></label>
                            <input type="text" id="total_employment_for_survey" name="total_employment_for_survey"
                                   class="form-control" placeholder="Enter Employment in Nos."
                                   onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));
                                       checkValidation('survey', 'total_employment_for_survey', employmentValidationMessage);"
                                   value="{{total_employment}}" maxlength="5" readonly="" />
                            <span class="error-message error-message-survey-total_employment_for_survey"></span>
                        </div>
                        <div class="col-sm-8">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th class="v-a-m">Skilled</th>
                                            <th class="v-a-m">Semi-Skilled</th>
                                            <th class="v-a-m">Unskilled</th>
                                            <th class="v-a-m">Managerial</th>
                                            <th class="v-a-m">Licenced Contractors / Contractors</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="p-0px">
                                                <input type="text" id="skilled_employment_for_survey" name="skilled_employment_for_survey" class="form-control" placeholder="Skilled"
                                                       readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{skilled_employment}}" maxlength="5"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="semi_skilled_employment_for_survey" name="semi_skilled_employment_for_survey" class="form-control" placeholder="Semi-Skilled"
                                                       readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{semi_skilled_employment}}" maxlength="5"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="unskilled_employment_for_survey" name="unskilled_employment_for_survey" class="form-control" placeholder="Unskilled"
                                                       readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{unskilled_employment}}" maxlength="5"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="managerial_employment_for_survey" name="managerial_employment_for_survey" class="form-control" placeholder="Managerial"
                                                       readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{managerial_employment}}" maxlength="5"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="lcc_employment_for_survey" name="lcc_employment_for_survey" class="form-control" placeholder="Licenced Contractors / Contractors"
                                                       readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{lcc_employment}}" maxlength="5"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Person Employed Through Labour Contractor <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="emp_tlc_for_survey" name="emp_tlc_for_survey" value="{{VALUE_ONE}}">
                                    Yes
                                </label>
                                <label>
                                    <input type="radio" disabled name="emp_tlc_for_survey" value="{{VALUE_TWO}}">
                                    No
                                </label>
                            </div>
                            <span class="error-message error-message-survey-emp_tlc_for_survey"></span>
                        </div>
                        <div class="col-sm-8">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Persons Employed - Locals</th>
                                        </tr>
                                        <tr>
                                            <th class="v-a-m f-w-n">Skilled</th>
                                            <th class="v-a-m f-w-n">Semi-Skilled</th>
                                            <th class="v-a-m f-w-n">Unskilled</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="p-0px">
                                                <input type="text" id="skilled_local_pe_for_survey" name="skilled_local_pe_for_survey" class="form-control" placeholder="Skilled"
                                                       readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{skilled_local_pe}}" maxlength="5"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="semi_skilled_local_pe_for_survey" name="semi_skilled_local_pe_for_survey" class="form-control" placeholder="Semi-Skilled"
                                                       readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{semi_skilled_local_pe}}" maxlength="5"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="unskilled_local_pe_for_survey" name="unskilled_local_pe_for_survey" class="form-control" placeholder="Unskilled"
                                                       readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{unskilled_local_pe}}" maxlength="5"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="page-header f-w-b color-nic-blue m-b-0px">Persons Employed - Others (Specify With State) <span style="color: red;">*</span></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-10">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" style="margin-bottom: 5px;">
                                    <thead>
                                        <tr>
                                            <th class="v-a-m" style="width: 30px;">No.</th>
                                            <th class="v-a-m">Select State/UT</th>
                                            <th class="v-a-m">Skilled</th>
                                            <th class="v-a-m">Semi-Skilled</th>
                                            <th class="v-a-m">Unskilled</th>
                                            <th class="v-a-m" style="width: 20px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="state_wise_pe_container">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-xs btn-success" id="add_btn_for_state_wise_pe"
                                    onclick="IndustryProfile.listview.addPE({});" style="margin-bottom: 10px;"disabled>
                                <label class="fa fa-plus label-btn-icon"></label>
                                &nbsp;<label class="label-btn-fonts">Add More</label>
                            </button>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Number of Employees Subscription to Employees Provident Fund </label>
                            <input type="text" id="emp_pf_for_survey" name="emp_pf_for_survey"
                                   class="form-control" placeholder="Enter Employees Subscription to PF"
                                   readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                   value="{{emp_pf}}" maxlength="5" />
                            <span class="error-message error-message-survey-emp_pf_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Number of Employees Covered Under Other Social Security / Other Insurance Schemes </label>
                            <input type="text" id="emp_is_for_survey" name="emp_is_for_survey"
                                   class="form-control" placeholder="Enter Employees Covered Under Other Social Security / Other Insurance Schemes"
                                   readonly onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                   value="{{emp_is}}" maxlength="5"/>
                            <span class="error-message error-message-survey-emp_is_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Number of Employees Covered Under Other Medical Insurance Schemes </label>
                            <input type="text" id="emp_ois_for_survey" name="emp_ois_for_survey"
                                   class="form-control" placeholder="Enter Number of Employees Covered Under Other Medical Insurance Schemes"
                                   onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                   value="{{emp_ois}}" maxlength="5" readonly/>
                            <span class="error-message error-message-survey-emp_ois_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Investment in Plant & Machinery / Equipment <span style="color: red;">* (IN CRORE)</span></label>
                            <input type="text" id="investment_for_survey" name="investment_for_survey"
                                   class="form-control" placeholder="Investment in Plant & Machinery/Equipment"
                                   readonly onblur="checkValidation('survey', 'investment_for_survey', amountValidationMessage);"
                                   value="{{investment}}" maxlength="100"/>
                            <span class="error-message error-message-survey-investment_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Raw material <span style="color: red;">*</span></label>
                            <input type="text" id="raw_material_for_survey" name="raw_material_for_survey"
                                   class="form-control" placeholder="Raw material"
                                   readonly onblur="checkValidation('survey', 'raw_material_for_survey', rawMaterialValidationMessage);"
                                   value="{{raw_material}}" maxlength="150"/>
                            <span class="error-message error-message-survey-raw_material_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="page-header f-w-b color-nic-blue m-b-0px">Installed Production Capacity (Product Wise Per Annum) <span style="color: red;">*</span></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" style="margin-bottom: 5px;">
                                    <tbody id="ipc_container">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-xs btn-success" id="add_btn_for_ipc"
                                    onclick="IndustryProfile.listview.addIPC({});" style="margin-bottom: 10px;" disabled="">
                                <label class="fa fa-plus label-btn-icon"></label>
                                &nbsp;<label class="label-btn-fonts">Add More</label>
                            </button>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Major Product / Finished Goods <span style="color: red;">*</span></label>
                            <input type="text" id="major_product_for_survey" name="major_product_for_survey"
                                   class="form-control" placeholder="Major Product / Finished Goods"
                                   readonly onblur="checkValidation('survey', 'major_product_for_survey', majorProductValidationMessage);"
                                   value="{{major_product}}" maxlength="150"/>
                            <span class="error-message error-message-survey-major_product_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Details of the Industrial Process <span style="color: red;">* (In Brief)</span></label>
                            <textarea id="industrial_process_for_survey" name="industrial_process_for_survey" class="form-control"
                                      readonly onblur="checkValidation('survey', 'industrial_process_for_survey', industrialProductValidationMessage);"
                                      placeholder="Enter Official / Communication Address !">{{industrial_process}}</textarea>
                            <span class="error-message error-message-survey-industrial_process_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Annual Turn Over of Past Year in Rs. <span style="color: red;">* (IN CRORE)</span></label>
                            <input type="text" id="past_year_turnover_for_survey" name="past_year_turnover_for_survey"
                                   class="form-control" placeholder="Major Product / Finished Goods"
                                   readonly onblur="checkValidation('survey', 'past_year_turnover_for_survey', pastYearTurnOverValidationMessage);"
                                   value="{{past_year_turnover}}" maxlength="50"/>
                            <span class="error-message error-message-survey-past_year_turnover_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Year of Initial Production <span style="color: red;">*</span></label>
                            <input type="text" id="intial_production_year_for_survey" name="intial_production_year_for_survey"
                                   class="form-control" placeholder="Year of Initial Production"
                                   onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));
                                       checkValidation('survey', 'intial_production_year_for_survey', yearValidationMessage);"
                                   value="{{intial_production_year}}" maxlength="4" readonly/>
                            <span class="error-message error-message-survey-intial_production_year_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Year of Expansion / Modernization Etc. If Any. </label>
                            <input type="text" id="expansion_year_for_survey" name="expansion_year_for_survey"
                                   class="form-control" placeholder="Year of Expansion / Modernization Etc. If Any."
                                   onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                   value="{{expansion_year}}" maxlength="4" readonly/>
                            <span class="error-message error-message-survey-expansion_year_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Proposed Expansion, If Any. </label>
                            <input type="text" id="proposed_expansion_year_for_survey" name="proposed_expansion_year_for_survey"
                                   class="form-control" placeholder="Proposed Expansion, If Any."
                                   onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                   value="{{proposed_expansion_year}}" maxlength="4" readonly/>
                            <span class="error-message error-message-survey-proposed_expansion_year_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Skill Requirement and Required Number of Personnel. </label>
                            <input type="text" id="skill_requirement_for_survey" name="skill_requirement_for_survey"
                                   class="form-control" placeholder="Skill Requirement and Required Number of Personnel."
                                   value="{{skill_requirement}}" maxlength="100" readonly/>
                            <span class="error-message error-message-survey-skill_requirement_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="page-header f-w-b color-nic-blue m-b-0px">Details of Loan</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Loan Outstanding (Principal)</th>
                                            <th>Interest on Outstanding Loans</th>
                                            <th>Subsidy From Centre or UT.</th>
                                            <th>Grants From Centre or UT.</th>
                                            <th>Foreign Direct Investment / Equity.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="p-0px">
                                                <input type="text" id="loan_outstanding_for_survey" name="loan_outstanding_for_survey"
                                                       readonly class="form-control" placeholder="Loan Outstanding (Principal)"
                                                       value="{{loan_outstanding}}" maxlength="50"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="interest_outstanding_loan_for_survey" name="interest_outstanding_loan_for_survey"
                                                       readonly class="form-control" placeholder="Interest on Outstanding Loans"
                                                       value="{{interest_outstanding_loan}}" maxlength="50"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="subsidy_for_survey" name="subsidy_for_survey"
                                                       readonly class="form-control" placeholder="Subsidy From Centre or UT."
                                                       value="{{subsidy}}" maxlength="50"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="grants_for_survey" name="grants_for_survey"
                                                       readonly class="form-control" placeholder="Grants From Centre or UT."
                                                       value="{{grants}}" maxlength="50"/>
                                            </td>
                                            <td class="p-0px">
                                                <input type="text" id="foreign_direct_investment_for_survey" name="foreign_direct_investment_for_survey"
                                                       readonly class="form-control" placeholder="Foreign Direct Investment / Equity."
                                                       value="{{foreign_direct_investment}}" maxlength="50"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-5 form-group">
                            <label>Whether Registered Under Factories Act, 1948, If So, Number.</label>
                            <input type="text" id="registered_number_for_survey" name="registered_number_for_survey"
                                   class="form-control" placeholder="Enter Registered Number"
                                   value="{{registered_number}}" maxlength="50" readonly/>
                            <span class="error-message error-message-survey-registered_number_for_survey"></span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Whether Registered Under GSTN. <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="is_gstin_for_survey" name="is_gstin_for_survey"
                                           onclick="IndustryProfile.listview.isGSTINChangeEvent('{{VALUE_ONE}}')"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="is_gstin_for_survey"
                                           onclick="IndustryProfile.listview.isGSTINChangeEvent('{{VALUE_TWO}}')"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-is_gstin_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group" id="gstin_number_container" style="display: none;">
                            <label>GSTIN Number <span style="color: red;">*</span></label>
                            <input type="text" id="gstin_number_for_survey" name="gstin_number_for_survey"
                                   class="form-control" placeholder="Enter GSTIN Number"
                                   readonly onblur="checkValidation('survey', 'gstin_number_for_survey', gstinNumberValidationMessage);"
                                   value="{{gstin_number}}" maxlength="30"/>
                            <span class="error-message error-message-survey-gstin_number_for_survey"></span>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="page-header f-w-b m-b-10 color-nic-blue">Public Health Measures</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-2 form-group">
                            <label>Social Distancing <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="social_distancing_for_survey" name="social_distancing_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="social_distancing_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-social_distancing_for_survey"></span>
                        </div>
                        <div class="col-xs-6 col-sm-2 form-group">
                            <label>Thermal Screening <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="thermal_screening_for_survey" name="thermal_screening_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="thermal_screening_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-thermal_screening_for_survey"></span>
                        </div>
                        <div class="col-xs-6 col-sm-2 form-group">
                            <label>Mask Availability <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="mask_availability_for_survey" name="mask_availability_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="mask_availability_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-mask_availability_for_survey"></span>
                        </div>
                        <div class="col-xs-6 col-sm-2 form-group">
                            <label>Face Sheild <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="face_shield_for_survey" name="face_shield_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="face_shield_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-face_shield_for_survey"></span>
                        </div>
                        <div class="col-xs-12 col-sm-4 form-group">
                            <label>Sanitizers / Washing Hands <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="washing_hands_for_survey" name="washing_hands_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="washing_hands_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-washing_hands_for_survey"></span>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Provision For Avoiding Water Logging <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="avoiding_water_for_survey" name="avoiding_water_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="avoiding_water_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-avoiding_water_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="page-header f-w-b m-b-10 color-nic-blue">
                                Labour Welfare Measures as Per Factories Act/Labour Laws / Factories Act.
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Provision For Health, Safety and Welfare of all Workers. <span style="color: red;">*</span></label>
                            <input type="text" id="phsw_for_survey" name="phsw_for_survey"
                                   class="form-control" placeholder="Enter Provision For Health, Safety and Welfare of all Workers."
                                   readonly onblur="checkValidation('survey', 'phsw_for_survey', detailsValidationMessage);"
                                   value="{{phsw}}" maxlength="200"/>
                            <span class="error-message error-message-survey-phsw_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Cleanliness - Whether Provisions Available to Keep Factory Premise Clean and Free From 
                                Effluvia Arising From any Drain, Privy or Other Nuisance Etc. <span style="color: red;">*</span></label>
                            <input type="text" id="cleanliness_for_survey" name="cleanliness_for_survey"
                                   class="form-control" placeholder="Enter Cleanliness - Whether Provisions Available to Keep Factory Premise Clean and Free From 
                                   Effluvia Arising From any Drain, Privy or Other Nuisance Etc."
                                   readonly onblur="checkValidation('survey', 'cleanliness_for_survey', detailsValidationMessage);"
                                   value="{{cleanliness}}" maxlength="200"/>
                            <span class="error-message error-message-survey-cleanliness_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Overcrowding - No Room in Any Factory Shall be Overcrowded to an Extent Injurious
                                to The Health of The Workers Employed Therein. <span style="color: red;">*</span></label>
                            <input type="text" id="overcrowding_for_survey" name="overcrowding_for_survey"
                                   class="form-control" placeholder="Overcrowding - No Room in Any Factory Shall be Overcrowded to an Extent Injurious
                                   to The Health of The Workers Employed Therein."
                                   readonly onblur="checkValidation('survey', 'overcrowding_for_survey', detailsValidationMessage);"
                                   value="{{overcrowding}}" maxlength="200"/>
                            <span class="error-message error-message-survey-overcrowding_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Arrangements for Drinking Water at Suitable Points Conveniently Situated For All Workers Employed. <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="arrangements_for_survey" name="arrangements_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="arrangements_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-arrangements_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Fire Safety Measures <span style="color: red;">*</span></label>
                            <input type="text" id="fire_saftey_measures_for_survey" name="fire_saftey_measures_for_survey"
                                   class="form-control" placeholder="Enter Fire Safety Measures"
                                   readonly onblur="checkValidation('survey', 'fire_saftey_measures_for_survey', fireSafteyMeasuresValidationMessage);"
                                   value="{{fire_saftey_measures}}" maxlength="100"/>
                            <span class="error-message error-message-survey-fire_saftey_measures_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Washroom <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="washing_facilities_for_survey" name="washing_facilities_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="washing_facilities_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-washing_facilities_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>First-Aid Appliances <span style="color: red;">*</span></label>
                            <input type="text" id="first_aid_appliances_for_survey" name="first_aid_appliances_for_survey"
                                   class="form-control" placeholder="First-Aid Appliances"
                                   readonly onblur="checkValidation('survey', 'first_aid_appliances_for_survey', firstAidAppliancesValidationMessage);"
                                   value="{{first_aid_appliances}}" maxlength="100"/>
                            <span class="error-message error-message-survey-first_aid_appliances_for_survey"></span>
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>Worker's Quarters <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="workers_quarters_for_survey" name="workers_quarters_for_survey"
                                           onclick="IndustryProfile.listview.quartersNumberChangeEvent('{{VALUE_ONE}}');"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="workers_quarters_for_survey"
                                           onclick="IndustryProfile.listview.quartersNumberChangeEvent('{{VALUE_TWO}}');"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-workers_quarters_for_survey"></span>
                        </div>
                        <div class="col-sm-3 form-group" id="quarters_number_container" style="display: none;">
                            <label> Number of Quarters <span style="color: red;">*</span></label>
                            <input type="text" id="quarters_number_for_survey" name="quarters_number_for_survey"
                                   class="form-control" placeholder="Number of Quarters"
                                   onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));
                                       checkValidation('survey', 'quarters_number_for_survey', quartersNumberValidationMessage);"
                                   value="{{quarters_number}}" maxlength="4" readonly/>
                            <span class="error-message error-message-survey-quarters_number_for_survey"></span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Canteen <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="canteen_for_survey" name="canteen_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="canteen_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-canteen_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Communication / Fiber <span style="color: red;">*</span></label>
                            <textarea id="commu_fiber_for_survey" name="commu_fiber_for_survey" class="form-control"
                                      readonly onblur="checkValidation('survey', 'commu_fiber_for_survey', detailsValidationMessage);"
                                      placeholder="Enter Communication / Fiber !">{{commu_fiber}}</textarea>
                            <span class="error-message error-message-survey-commu_fiber_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Shelters, Rest Rooms and Lunch Rooms <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="srl_for_survey" name="srl_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="srl_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-srl_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Connectivity Within The Factory Premises <span style="color: red;">*</span></label>
                            <div class="checkbox mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="checkbox" disabled id="connectivity_for_survey" name="connectivity_for_survey"
                                           value="{{VALUE_ONE}}">Mobile Connectivity</label>
                                <label>
                                    <input type="checkbox" disabled name="connectivity_for_survey"
                                           value="{{VALUE_TWO}}">Fiber Connectivity</label>
                            </div>
                            <span class="error-message error-message-survey-connectivity_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label> Creches Availability and Number Available</label>
                            <input type="text" id="creches_for_survey" name="creches_for_survey"
                                   class="form-control" placeholder="Creches Availability and Number Available"
                                   onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                   value="{{creches}}" maxlength="100" readonly/>
                            <span class="error-message error-message-survey-creches_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label> Number of Persons Doing Apprenticeship</label>
                            <input type="text" id="apprenticeship_for_survey" name="apprenticeship_for_survey"
                                   class="form-control" placeholder="Number of Persons Doing Apprenticeship"
                                   onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                   value="{{apprenticeship}}" maxlength="100" readonly/>
                            <span class="error-message error-message-survey-apprenticeship_for_survey"></span>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Industrial Safety Measures <span style="color: red;">*</span></label>
                            <textarea id="saftey_measures_for_survey" name="saftey_measures_for_survey" class="form-control"
                                      readonly onblur="checkValidation('survey', 'saftey_measures_for_survey', safteyMeasuresValidationMessage);"
                                      placeholder="Industrial Safety Measures !">{{saftey_measures}}</textarea>
                            <span class="error-message error-message-survey-saftey_measures_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Pollution Control Measures <span style="color: red;">*</span></label>
                            <textarea id="pollution_control_measures_for_survey" name="pollution_control_measures_for_survey" class="form-control"
                                      readonly onblur="checkValidation('survey', 'pollution_control_measures_for_survey', pollutionControlValidationMessage);"
                                      placeholder="Pollution Control Measures !">{{pollution_control_measures}}</textarea>
                            <span class="error-message error-message-survey-pollution_control_measures_for_survey"></span>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Air Pollution and Control Mechanism <span style="color: red;">*</span></label>
                            <textarea id="air_pcm_for_survey" name="air_pcm_for_survey" class="form-control"
                                      readonly onblur="checkValidation('survey', 'air_pcm_for_survey', detailsValidationMessage);"
                                      placeholder="Enter Air Pollution and Control Mechanism !">{{air_pcm}}</textarea>
                            <span class="error-message error-message-survey-air_pcm_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Effluent Treatment Measures and Capacity</label>
                            <input type="text" id="etmc_for_survey" name="etmc_for_survey"
                                   class="form-control" placeholder="Effluent Treatment Measures and Capacity"
                                   onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                   value="{{etmc}}" maxlength="10" readonly />
                            <span class="error-message error-message-survey-etmc_for_survey"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="page-header f-w-b m-b-10 color-nic-blue">
                                Nature of Waste and Volume
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Liquid Waste </label>
                            <textarea id="liquid_waste_for_survey" name="liquid_waste_for_survey" class="form-control"
                                      readonly placeholder="Enter Liquid Waste !" maxlength="200">{{liquid_waste}}</textarea>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Solid Waste </label>
                            <textarea id="solid_waste_for_survey" name="solid_waste_for_survey" class="form-control"
                                      readonly placeholder="Enter Solid Waste !" maxlength="200">{{solid_waste}}</textarea>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Hazardous Waste </label>
                            <textarea id="hazardous_waste_for_survey" name="hazardous_waste_for_survey" class="form-control"
                                      readonly placeholder="Enter Hazardous Waste !" maxlength="200">{{hazardous_waste}}</textarea>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>E-Waste </label>
                            <textarea id="e_waste_for_survey" name="e_waste_for_survey" class="form-control"
                                      readonly placeholder="Enter E-Waste !" maxlength="200">{{e_waste}}</textarea>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Liquor Waste </label>
                            <textarea id="liquor_waste_for_survey" name="liquor_waste_for_survey" class="form-control"
                                      readonly placeholder="Enter Liquor Waste !" maxlength="200">{{liquor_waste}}</textarea>
                        </div>
                    </div>
                    <div class="row"><div class="col-xs-12"><hr class="m-b-10"></div></div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Willing to Promote Industrial Tourism <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="wpit_for_survey" name="wpit_for_survey"
                                           value="{{VALUE_ONE}}">Yes</label>
                                <label>
                                    <input type="radio" disabled name="wpit_for_survey"
                                           value="{{VALUE_TWO}}">No</label>
                            </div>
                            <span class="error-message error-message-survey-wpit_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Status of Unit <span style="color: red;">*</span></label>
                            <div class="radio mb-none" style="margin-top: 0px !important;">
                                <label style="margin-right: 8px;">
                                    <input type="radio" disabled id="unit_status_for_survey" name="unit_status_for_survey"
                                           value="{{VALUE_ONE}}">Functioning</label>
                                <label>
                                    <input type="radio" disabled name="unit_status_for_survey"
                                           value="{{VALUE_TWO}}">Non Functioning</label>
                            </div>
                            <span class="error-message error-message-survey-unit_status_for_survey"></span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Tax Dues Paid Per Year <span style="color: red;">* (IN CRORE)</span></label>
                            <input type="text" id="tax_due_ppy_for_survey" name="tax_due_ppy_for_survey"
                                   class="form-control" placeholder="Tax Dues Paid Per Year"
                                   readonly onblur="checkValidation('survey', 'tax_due_ppy_for_survey', taxDuePPYValidationMessage);"
                                   value="{{tax_due_ppy}}" maxlength="50"/>
                            <span class="error-message error-message-survey-tax_due_ppy_for_survey"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-danger" onclick="IndustryProfile.listview.loadIndustryProfileData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>