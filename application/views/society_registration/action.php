<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" onclick="SocietyRegistration.listview.editOrViewSocietyRegistration($(this),'{{society_registration_id}}', true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt"></i> &nbsp;Edit</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="SocietyRegistration.listview.editOrViewSocietyRegistration($(this),'{{society_registration_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye"></i> &nbsp;View</button>
    {{#if show_query_btn}}
    <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_society_registration_{{society_registration_id}}" onclick="SocietyRegistration.listview.getQueryData('{{society_registration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-reply" style="margin-right: 5px;"></i> Respond / View Query</button>
    {{/if}}
    {{#if show_download_letter_btn}}
    <a class="btn btn-sm btn-warning"
       target="_blank" href="<?php echo ADMIN_SOCIETY_REGISTRATION_DOC_PATH; ?>{{letter}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-download-alt"></i> Download Letter</a>    
    {{/if}}
    <button type="button" class="btn btn-sm btn-info" id="upload_passbook_btn_{{society_registration_id}}"
            onclick="SocietyRegistration.listview.uploadPassbook('{{society_registration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-upload-alt"></i> Upload Passbook</button>
    {{#if show_download_upload_challan_btn}}
    <a class="btn btn-sm btn-warning" target="_blank"
       href="{{ADMIN_SOCIETY_REGISTRATION_DOC_PATH}}{{challan}}" id="download_challan_btn_{{society_registration_id}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-download-alt"></i> Payment Requested
    </a>
    <button type="button" class="btn btn-sm btn-info" id="download_upload_btn_{{society_registration_id}}"
            onclick="SocietyRegistration.listview.downloadUploadChallan('{{society_registration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-upload-alt"></i> Pay Your Fees</button>
    {{/if}}
    {{#if show_download_certificate_btn}}
    <a class="btn btn-sm btn-nic-blue"
       target="_blank" href="<?php echo ADMIN_REV_COLL_CERTIFICATE_PATH; ?>{{final_certificate}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-certificate"></i> Download Certificate</a>
    {{/if}}
    {{#if show_fr_btn}}
    <button type="button" class="btn btn-sm btn-success" onclick="askForFeedbackRating($(this), VALUE_SIXTY,'{{society_registration_id}}')"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-star" style="margin-right: 2px;"></i> Feedback / Rating</button>
    {{/if}}
</div>