<tr id="query_answer_document_row_{{cnt}}" class="query_answer_document_row">
    <td style="width: 30px;" class="text-center query-answer-document-cnt v-a-m f-w-b">{{cnt}}</td>
    <td>
        <input type="hidden" class="og_query_answer_document_cnt" value="{{cnt}}" />
        <input type="hidden" id="query_document_id_for_query_answer_{{cnt}}" value="{{query_document_id}}" />
        <input type="text" class="form-control" id="doc_name_for_query_answer_{{cnt}}"
               onblur="checkValidation('query-answer','doc_name_for_query_answer_{{cnt}}', documentNameValidationMessage)"
               placeholder="Document Name !">
        <span class="error-message error-message-query-answer-doc_name_for_query_answer_{{cnt}}"></span>
    </td>
    <td class="text-center">
        <div id="document_container_for_query_answer_{{cnt}}">
            <input type="file" id="document_for_query_answer_{{cnt}}"
                   onchange="uploadDocumentForQueryAnswer('{{cnt}}');"
                   accept="image/jpg,image/png,image/jpeg,image/jfif,application/pdf" style="width: 200px; display: none;">
            <button type="button" class="btn btn-sm btn-nic-blue" 
                    onclick="$('#document_for_query_answer_{{cnt}}').click();"
                    style="cursor: pointer;">
                Select File
            </button>
        </div>
        <div class="text-center color-nic-blue" id="spinner_template_for_query_answer_{{cnt}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
        <div id="document_name_container_for_query_answer_{{cnt}}" style="display: none;">
            <a id="document_name_href_for_query_answer_{{cnt}}" target="_blank"><span id="document_name_for_query_answer_{{cnt}}"></span></a>
            <span class="fas fa-times" style="color: red; cursor: pointer; margin-left: 3px;" id="document_remove_btn_for_query_answer_{{cnt}}"></span>
        </div>
        <span class="error-message error-message-query-answer-document_for_query_answer_{{cnt}}"></span>
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-sm btn-danger"
                onclick="askForRemoveDocumentRow({{cnt}})" style="cursor: pointer;">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>