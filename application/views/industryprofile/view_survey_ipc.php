<tr id="ipc_row_{{cnt}}" class="ipc_row">
    <td style="width: 30px;" class="text-center ipc-cnt v-a-m f-w-b">{{cnt}}</td>
    <td style="text-align: left !important;">
        <input type="hidden" class="og_ipc_cnt" value="{{cnt}}" />
        <input type="text" id="ipc_for_survey_{{cnt}}" name="ipc_for_survey"
               class="form-control" placeholder="Installed Production Capacity (Product Wise Per Annum)"
               onblur="checkValidation('survey', 'ipc_for_survey_{{cnt}}', detailsValidationMessage);"
               value="{{ipc_value}}" maxlength="200" readonly="" />
        <span class="error-message error-message-survey-ipc_for_survey_{{cnt}}"></span>
    </td>
    <td style="width: 20px;">
        <button type="button" class="btn btn-xs btn-danger"
                onclick="IndustryProfile.listview.removeIPC('{{cnt}}');" style="cursor: pointer;" disabled="">
            <label class="fa fa-trash label-btn-icon"></label>
        </button>
    </td>
</tr>