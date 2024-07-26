<tr id="iod_document_row_{{cnt}}" class="iod_document_row">
    <td style="width: 30px;" class="text-center iod-document-cnt v-a-m f-w-b">{{cnt}}</td>
    <td>
        <input type="hidden" class="og_iod_document_cnt" value="{{cnt}}" />
        <input type="hidden" id="ips_incentive_od_id_for_iod_{{cnt}}" value="{{ips_incentive_od_id}}" />
        <input type="text" class="form-control" id="doc_name_for_iod_{{cnt}}"
               onblur="checkValidation('iod','doc_name_for_iod_{{cnt}}', documentNameValidationMessage)"
               placeholder="Document Name !" maxlength="50" value="{{doc_name}}">
        <span class="error-message error-message-iod-doc_name_for_iod_{{cnt}}"></span>
    </td>
    <td class="text-center v-a-m">
        <div id="document_container_for_iod_{{cnt}}">
            <input type="file" id="document_for_iod_{{cnt}}"
                   onchange="Ips.listview.uploadOtherDoc('{{cnt}}');"
                   accept="application/pdf">
        </div>
        <div class="text-center color-nic-blue" id="spinner_template_for_iod_{{cnt}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
        <div id="document_name_container_for_iod_{{cnt}}" style="display: none;">
            <a id="document_name_href_for_iod_{{cnt}}" target="_blank" class="cursor-pointer">
                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-0"><i class="fas fa-eye"></i> &nbsp; {{VIEW_UPLODED_DOCUMENT}}</label>
            </a>
            <button type="button" id="document_remove_btn_for_iod_{{cnt}}" class="btn btn-sm btn-danger" style="vertical-align: top;">
                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
        </div>
        <span class="error-message error-message-iod-document_for_iod_{{cnt}}"></span>
    </td>
    <td class="text-center v-a-m">
        <button type="button" class="btn btn-sm btn-danger" id="document_item_remove_btn_for_iod_{{cnt}}"
                onclick="Ips.listview.askForRemoveOtherDocItem({{cnt}})" style="cursor: pointer;">
            <i class="fa fa-trash"></i>
        </button> 
    </td>
</tr>