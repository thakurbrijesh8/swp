<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="edit_btn_{{wmregistration_id}}" onclick="Wmregistration.listview.editOrViewWmregistration($(this),'{{wmregistration_id}}', true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt" style="margin-right: 2px;"></i> Edit</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="Wmregistration.listview.editOrViewWmregistration($(this),'{{wmregistration_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    {{#if show_form_one_btn}}
    <button type="button" class="btn btn-sm btn-danger" 
            onclick="Wmregistration.listview.generateForm1('{{wmregistration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;"><i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Form-1</button>
    {{/if}}
    {{#if show_query_btn}}
    <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_wm_{{wmregistration_id}}" onclick="Wmregistration.listview.getQueryData('{{wmregistration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-reply" style="margin-right: 5px;"></i> Respond / View Query</button>
    {{/if}}
    {{#if show_download_upload_challan_btn}}
    <a class="btn btn-sm btn-warning" target="_blank"
       href="{{ADMIN_WMREG_DOC_PATH}}{{challan}}" id="download_challan_btn_{{wmregistration_id}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-download-alt" style="margin-right: 2px;"></i> Payment Requested
    </a>
    <button type="button" class="btn btn-sm btn-info" id="download_upload_btn_{{wmregistration_id}}"
            onclick="Wmregistration.listview.downloadUploadChallan('{{wmregistration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-upload-alt" style="margin-right: 2px;"></i> Pay Your Fees</button>
    {{/if}}
    {{#if show_withdraw_application_btn}}
    <button type="button" class="btn btn-sm btn-secondary" id="withdraw_application_btn_{{wmregistration_id}}"
            onclick="askForWithdrawApplication($(this), VALUE_ONE,'{{wmregistration_id}}')"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-undo" style="margin-right: 2px;"></i> Withdraw</button>
    {{/if}}
    {{#if show_download_certificate_btn}}
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="Wmregistration.listview.generateCertificate('{{wmregistration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-certificate" style="margin-right: 2px;"></i> Download Certificate</button>
    {{/if}}
    {{#if show_fr_btn}}
    <button type="button" class="btn btn-sm btn-success" onclick="askForFeedbackRating($(this), VALUE_ONE,'{{wmregistration_id}}')"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-star" style="margin-right: 2px;"></i> Feedback / Rating</button>
    {{/if}}
</div>