<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="edit_btn_{{nil_certificate_id}}" onclick="NilCertificate.listview.editOrViewNilCertificate($(this),'{{nil_certificate_id}}', true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt"></i> &nbsp;Edit</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="NilCertificate.listview.editOrViewNilCertificate($(this),'{{nil_certificate_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye"></i> &nbsp;View</button>
    {{#if show_query_btn}}
    <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_nil_certificate_{{nil_certificate_id}}" onclick="NilCertificate.listview.getQueryData('{{nil_certificate_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-reply" style="margin-right: 5px;"></i> Respond / View Query</button>
    {{/if}}
    {{#if show_download_upload_challan_btn}}
    <a class="btn btn-sm btn-warning" target="_blank"
       href="{{ADMIN_NIL_CERTIFICATE_DOC_PATH}}{{challan}}" id="download_challan_btn_{{nil_certificate_id}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-download-alt"></i> Payment Requested
    </a>
    <button type="button" class="btn btn-sm btn-info" id="download_upload_btn_{{nil_certificate_id}}"
            onclick="NilCertificate.listview.downloadUploadChallan('{{nil_certificate_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-upload-alt"></i> Pay Your Fees</button>
    {{/if}}
    {{#if show_withdraw_application_btn}}
    <button type="button" class="btn btn-sm btn-secondary" id="withdraw_application_btn_{{nil_certificate_id}}"
            onclick="askForWithdrawApplication($(this), VALUE_SIXTYONE,'{{nil_certificate_id}}')"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-undo" style="margin-right: 2px;"></i> Withdraw</button>
    {{/if}}
    {{#if show_download_certificate_btn}}
    <a class="btn btn-sm btn-nic-blue"
       target="_blank" href="<?php echo ADMIN_CRSR_CERTIFICATE_PATH; ?>{{final_certificate}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-certificate"></i> Download Certificate</a>
    {{/if}}
    {{#if show_fr_btn}}
    <button type="button" class="btn btn-sm btn-success" onclick="askForFeedbackRating($(this), VALUE_SIXTYONE,'{{nil_certificate_id}}')"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-star" style="margin-right: 2px;"></i> Feedback / Rating</button>
    {{/if}}
</div>