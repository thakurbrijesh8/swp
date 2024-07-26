<div class="card">
    <div class="card-header">
        <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">NATURE OF ASSISTANCE /BENEFIT</div>
    </div>
    <form role="form" id="incentive_form" name="incentive_form" onsubmit="return false;">
        <input type="hidden" id="ips_incentive_id_for_incentives" name="ips_incentive_id_for_incentives" value="{{ips_incentive_id}}">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span class="error-message error-message-incentives f-w-b" style="border-bottom: 2px solid red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">                   
                    <label>1. Select Type of Incentive Scheme <span class="color-nic-red">*</span></label>
                    <select id="scheme_type_for_incentives" name="scheme_type_for_incentives" class="form-control select2"
                            onchange="checkValidation('incentives', 'scheme_type_for_incentives', oneOptionValidationMessage);
                                    Ips.listview.ICChangeEvent($(this));"
                            data-placeholder="Select Type of Incentive Scheme" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-incentives-scheme_type_for_incentives"></span>
                </div>
                <div class="form-group col-sm-6">                   
                    <label>2. Select Incentive Scheme <span class="color-nic-red">*</span></label>
                    <select id="scheme_for_incentives" name="scheme_for_incentives" class="form-control select2"
                            onchange="checkValidation('incentives', 'scheme_for_incentives', oneOptionValidationMessage);
                                    Ips.listview.schemeChangeEvent($(this));"
                            data-placeholder="Select Type of Incentive Scheme" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-incentives-scheme_for_incentives"></span>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-nic-blue p-2">
                    <h3 class="card-title f-w-b f-s-16px">Document Format For Your Reference</h3>
                </div>
                <div class="card-body pb-0 border-nic-blue">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody id="doc_format_item_container_for_incentives" class="doc_item_incentives">{{{no_record_fount_for_doc}}}</tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-nic-blue p-2">
                    <h3 class="card-title f-w-b f-s-16px">CHECK LIST OF ENCLOSURES (AS APPLICABLE) TO BE SUBMITTED FOR SUBSIDY UNDER SCHEME</h3>
                </div>
                <div class="card-body pb-0 border-nic-blue">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody id="doc_item_container_for_incentives" class="doc_item_incentives">{{{no_record_fount_for_doc}}}</tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-nic-blue p-2">
                    <h3 class="card-title f-w-b f-s-16px">OTHER DOCUMENTS (IF REQUIRE)</h3>
                </div>
                <div class="card-body border-nic-blue">
                    <div class="color-nic-red f-w-b text-right mb-2">(Maximum File Size: 10MB)(Upload PDF Only)</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-light-gray">
                                    <th class="text-center" style="width: 30px;">No.</th>
                                    <th class="text-center" style="min-width: 350px;">Document Name</th>
                                    <th class="text-center" style="width: 320px;">Document</th>
                                    <th class="text-center" style="width: 50px;"></th>
                                </tr>
                            </thead>
                            <tbody id="od_item_container_for_incentives"></tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-nic-blue btn-sm pull-right"
                            onclick="Ips.listview.addOtherDocItem({});">Add More Documents</button>
                </div>
            </div>
            {{#if show_submit_qr_details}}
            <input type="hidden" id="query_status_for_incentives" value="{{query_status}}" />
            <input type="hidden" id="status_for_incentives" value="{{status}}" />
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Query Response Remarks <span style="color: red;">*</span></label>
                    <textarea id="remarks_for_incentives" class="form-control" placeholder="Query Response Remarks !"
                              onblur="checkValidation('qrinc', 'remarks_for_incentives', remarksValidationMessage);"></textarea>
                    <span class="error-message error-message-qrinc-remarks_for_incentives"></span>
                </div>
            </div>
            {{/if}}

            <hr class="mb-2">
            <div>
                {{#if show_submit_qr_details}}
                <button type="button" id="submit_btn_for_incentives" class="btn btn-sm btn-success" 
                        onclick="Ips.listview.submitIncentives(VALUE_FOUR);" 
                        style="margin-right: 5px;"><i class="fas fa-save"></i> &nbsp; Submit & Response Query</button>
                {{else}}
                <button type="button" id="draft_btn_for_incentives" class="btn btn-sm btn-nic-blue" 
                        onclick="Ips.listview.submitIncentives(VALUE_ONE);" 
                        style="margin-right: 5px;"><i class="fas fa-download"></i> &nbsp; Save as Draft</button>
                <button type="button" id="submit_btn_for_incentives" class="btn btn-sm btn-success" 
                        onclick="Ips.listview.submitIncentives(VALUE_THREE);" 
                        style="margin-right: 5px;"><i class="fas fa-save"></i> &nbsp; Submit Application</button>
                {{/if}}
                <button type="button" class="btn btn-sm btn-danger" onclick="Ips.listview.cancelIncentivesForm();">
                    <i class="fas fa-times"></i> &nbsp; Cancel</button>
            </div>
        </div>
    </form>
</div>