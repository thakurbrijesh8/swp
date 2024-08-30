<div class="row">
    <div class="col-sm-4 col-md-3 form-group">
        <label class="mb-0">Select District</label>
        <select id="district_for_approvals" data-placeholder="Select District !"
                onchange="checkValidation('approvals', 'district_for_approvals', districtValidationMessage);
                        getDepartmentData();"
                class="custom-select select-big mb-0">
            <option value="">Select District</option>
        </select>
        <span class="error-message error-message-approvals-district_for_approvals"></span>
    </div>
    <div class="col-sm-4 col-md-3 form-group">
        <label class="mb-0">Select Risk Category (General)</label>
        <select id="risk_category_general_for_approvals" data-placeholder="Select Risk Category !"
                onchange="checkValidation('approvals', 'risk_category_general_for_approvals', oneOptionValidationMessage);
                        getDepartmentData();"
                class="custom-select select-big mb-0">
            <option value="">Select Risk Category (General)</option>
        </select>
        <span class="error-message error-message-approvals-risk_category_general_for_approvals"></span>
    </div>
    <div class="col-sm-4 col-md-3 form-group">
        <label class="mb-0">Select Risk Category (For Pollution)</label>
        <select id="risk_category_for_approvals" data-placeholder="Select Risk Category !"
                onchange="checkValidation('approvals', 'risk_category_for_approvals', oneOptionValidationMessage);
                        getDepartmentData();"
                class="custom-select select-big mb-0">
            <option value="">Select Risk Category (For Pollution)</option>
        </select>
        <span class="error-message error-message-approvals-risk_category_for_approvals"></span>
    </div>
    <div class="col-sm-4 col-md-3 form-group">
        <label class="mb-0">Select Size of firm</label>
        <select id="size_of_firm_for_approvals" data-placeholder="Select Size of firm !"
                onchange="checkValidation('approvals', 'size_of_firm_for_approvals', oneOptionValidationMessage);
                        getDepartmentData();"
                class="custom-select select-big mb-0">
            <option value="">Select Size of firm</option>
        </select>
        <span class="error-message error-message-approvals-size_of_firm_for_approvals"></span>
    </div>
    <div class="col-sm-4 col-md-3 form-group">
        <label class="mb-0">Select Foreign Domestic Investor</label>
        <select id="foreign_domestic_investor_for_approvals" data-placeholder="Select Foreign Domestic Investor !"
                onchange="checkValidation('approvals', 'foreign_domestic_investor_for_approvals', oneOptionValidationMessage);
                        getDepartmentData();"
                class="custom-select select-big mb-0">
            <option value="">Select Foreign Domestic Investor</option>
        </select>
        <span class="error-message error-message-approvals-foreign_domestic_investor_for_approvals"></span>
    </div>
</div>
<div class="row"><div class="col-12 text-center" id="spinner_container_for_clearances"></div></div>
<div class="row" id="tab_main_container_for_approval" style="display: none;">
    <div class="col-12">
        <ul class="nav nav-tabs" id="tabs_container_for_approval">
        </ul>
        <div class="tab-content p-1" id="tabs_content_container_for_approval"
             style="border: 1px solid #066af9; background: #ededed; min-height: 250px;">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 text-center">
        <button type="button" class="btn btn-sm btn-success" id="show_clearance_btn_for_approval"
                style="margin-right: 5px;" onclick="showClearances();">
            <i class="fa fa-eye mr-0"></i>&nbsp; Show Clearances
        </button>
        <a href="<?php echo $base_url; ?>know-your-clearances" class="btn btn-sm btn-danger">
            <i class="fa fa-arrow-left mr-0"></i>&nbsp; Back
        </a>
    </div>
</div>