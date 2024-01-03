<tr class="other-doc-for-{{module_type}}" id="m_other_doc_item_{{module_type}}_{{cnt}}">
    <td class="text-center other-doc-display-cnt-for-{{module_type}} v-a-m"></td>
    <td>
        <input type="hidden" class="og_other_doc_cnt_for_{{module_type}}" value="{{cnt}}" />
        <input type="hidden" id="module_other_documents_id_for_{{module_type}}_{{cnt}}" value="{{module_other_documents_id}}" />
        <input type="text" class="form-control" id="other_doc_name_for_{{module_type}}_{{cnt}}"
               onblur="checkValidation('{{module_type}}','other_doc_name_for_{{module_type}}_{{cnt}}', documentNameValidationMessage)"
               placeholder="Document Name !" value="{{other_doc_name}}">
        <span class="error-message error-message-{{module_type}}-other_doc_name_for_{{module_type}}_{{cnt}}"></span>
    </td>
    <td>
        <div id="other_upload_container_for_{{module_type}}_{{cnt}}">
            <input type="file" id="other_upload_for_{{module_type}}_{{cnt}}" name="other_upload_for_{{module_type}}_{{cnt}}"
                   accept="application/pdf" onchange="uploadMOtherDocument({{module_type}},{{cnt}});">
            <div class="error-message error-message-{{module_type}}-other_upload_for_{{module_type}}_{{cnt}}"></div>
        </div>
        <div id="other_upload_name_container_for_{{module_type}}_{{cnt}}" style="display: none;">
            <a target="_blank" id="other_upload_name_href_for_{{module_type}}_{{cnt}}" class="cursor-pointer">
                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer"><i class="fas fa-eye"></i> &nbsp; {{VIEW_UPLODED_DOCUMENT}}</label>
            </a>
            <button type="button" id="other_remove_document_btn_for_{{module_type}}_{{cnt}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                    onclick="askForRemoveMOtherDocument({{module_type}},{{module_id}},{{cnt}});">
                <i class="fas fa-trash"></i> &nbsp; Remove</button>
        </div>
        <div class="text-center color-nic-blue col-12 m-b-5px" id="other_spinner_template_{{cnt}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-sm btn-danger" id="remove_other_doc_btn_for_{{module_type}}_{{cnt}}"
                onclick="askForRemoveMOtherDocumentRow({{module_type}},{{cnt}})" style="cursor: pointer;">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>