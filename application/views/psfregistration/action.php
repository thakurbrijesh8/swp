<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" onclick="Psfregistration.listview.editOrViewPsfregistration($(this),'{{psfregistration_id}}', true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt" style="margin-right: 2px;"></i>Edit</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="Psfregistration.listview.editOrViewPsfregistration($(this),'{{psfregistration_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i>View</button>
    {{#if show_form_one_btn}}
    <button type="button" class="btn btn-sm btn-danger" 
            onclick="Psfregistration.listview.generateForm1('{{psfregistration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;"><i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Form-1</button>
    {{/if}}
    {{#if show_query_btn}}
    <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_psf_{{psfregistration_id}}" onclick="Psfregistration.listview.getQueryData('{{psfregistration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-reply" style="margin-right: 5px;"></i>Respond / View Query</button>
    {{/if}}
    {{#if show_download_upload_challan_btn}}
    <a class="btn btn-sm btn-warning" target="_blank"
       href="{{ADMIN_PSFREG_DOC_PATH}}{{challan}}" id="download_challan_btn_{{psfregistration_id}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-download-alt" style="margin-right: 2px;"></i> Payment Requested
    </a>
    <button type="button" class="btn btn-sm btn-info" id="download_upload_btn_{{psfregistration_id}}"
            onclick="Psfregistration.listview.downloadUploadChallan('{{psfregistration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-upload-alt" style="margin-right: 2px;"></i> Pay Your Fees</button>
    {{/if}}
    {{#if show_download_certificate_btn}}
    <a class="btn btn-sm btn-nic-blue"
       target="_blank" href="<?php echo ADMIN_CRSR_CERTIFICATE_PATH; ?>{{final_certificate}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-certificate" style="margin-right: 2px;"></i> Download Certificate</a>
    {{/if}}
</div>