<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="edit_btn_for_shop_{{s_id}}" onclick="Shop.listview.editOrViewShop($(this),'{{s_id}}', true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt" style="margin-right: 2px;"></i> Edit</button>
    {{/if}}     
    <button type="button" class="btn btn-sm btn-nic-blue" id="edit_btn_for_shop_{{s_id}}" onclick="Shop.listview.editOrViewShop($(this),'{{s_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    {{#if show_form_one_btn}}        
    <button type="button" class="btn btn-sm btn-danger" onclick="Shop.listview.generateFormIPDF('{{s_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 2px;"></i>From-I</button>
    {{/if}} 
    {{#if show_query_btn}}
    <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_app_{{s_id}}" onclick="Shop.listview.getQueryData('{{s_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-reply" style="margin-right: 5px;"></i>Respond / View Query</button>
    {{/if}}
    {{#if show_download_upload_challan_btn}}
    <a class="btn btn-sm btn-warning" target="_blank"
       href="{{ADMIN_SHOP_DOC_PATH}}{{challan}}" id="download_challan_btn_{{s_id}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-download-alt" style="margin-right: 2px;"></i> Payment Requested
    </a>
    <button type="button" class="btn btn-sm btn-info" id="download_upload_btn_{{s_id}}"
            onclick="Shop.listview.downloadUploadChallan('{{s_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-cloud-upload-alt" style="margin-right: 2px;"></i> Pay Your Fees</button>
    {{/if}}
    {{#if show_download_certificate_btn}}
    <a class="btn btn-sm btn-nic-blue"
       target="_blank" href="<?php echo ADMIN_LABOUR_CERTIFICATE_PATH; ?>{{final_certificate}}"
       style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-certificate" style="margin-right: 2px;"></i> Download Certificate</a>
    <button type="button" class="btn btn-sm btn-danger" onclick="Shop.listview.generateFormXXIVPDF('{{s_id}}');"
            style="padding: 2px 7px;margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 2px;"></i>Form-XXIV</button>
    {{/if}} 
</div>