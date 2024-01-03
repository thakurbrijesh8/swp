<tr class="doc-for-{{module_type}}">
    <td class="text-center" style="width: 50px;">{{doc_cnt}}</td>
    <td class="f-w-b" style="min-width: 200px;">{{{doc_name}}} <span style="color: red;">{{#if is_require}}*{{/if}} <br>(Maximum File Size: 2MB)(Upload PDF Only)</span></td>
    <td style="width: 320px;">
        <div id="upload_container_for_{{module_type}}_{{doc_id}}">
            <input type="file" id="upload_for_{{module_type}}_{{doc_id}}" name="upload_for_{{module_type}}_{{doc_id}}"
                   accept="application/pdf" onchange="uploadMDocument({{module_type}},{{doc_id}});">
            <div class="error-message error-message-{{module_type}}-upload_for_{{module_type}}_{{doc_id}}"></div>
        </div>
        <div id="upload_name_container_for_{{module_type}}_{{doc_id}}" style="display: none;">
            <a target="_blank" id="upload_name_href_for_{{module_type}}_{{doc_id}}" class="cursor-pointer">
                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer"><i class="fas fa-eye"></i> &nbsp; {{VIEW_UPLODED_DOCUMENT}}</label>
            </a>
            <button type="button" id="remove_document_btn_for_{{module_type}}_{{doc_id}}" class="btn btn-sm btn-danger" style="vertical-align: top;"
                    onclick="askForRemoveMDocument({{module_type}},{{module_id}},{{doc_id}});">
                <i class="fas fa-trash"></i> &nbsp; Remove</button>
        </div>
        <div class="text-center color-nic-blue col-12 m-b-5px" id="spinner_template_{{doc_id}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
    </td>
</tr>