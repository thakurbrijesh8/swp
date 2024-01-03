<tr id="state_wise_pe_{{cnt}}" class="state_wise_pe">
    <td style="width: 30px;" class="text-center state-wise-pe-cnt v-a-m f-w-b">{{cnt}}</td>
    <td style="text-align: left !important;">
        <input type="hidden" class="og_state_wise_pe_cnt" value="{{cnt}}" />
        <select id="state_for_survey_{{cnt}}" class="form-control"
                data-placeholder="Select State/UT"
                onchange="checkValidation('survey', 'state_for_survey_{{cnt}}', selectStateValidationMessage);" disabled="">
                <option value="">Select State/UT</option>
                <option value="1">Daman</option>
                <option value="2">Diu</option>
                <option value="3">DNH</option>
        </select>
        <span class="error-message error-message-survey-state_for_survey_{{cnt}}"></span>
    </td>
    <td style="text-align: left !important;">
        <input type="text" id="skilled_others_pe_for_survey_{{cnt}}" class="form-control" placeholder="Skilled"
               onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{skilled}}" maxlength="5" readonly="" />
    </td>
    <td style="text-align: left !important;">
        <input type="text" id="semi_skilled_others_pe_for_survey_{{cnt}}" class="form-control" placeholder="Semi-Skilled"
               onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{semi_skilled}}" maxlength="5" readonly/>
    </td>
    <td style="text-align: left !important;">
        <input type="text" id="unskilled_others_pe_for_survey_{{cnt}}" class="form-control" placeholder="Unskilled"
               onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));" value="{{unskilled}}" maxlength="5" readonly/>
    </td>
    <td style="width: 20px;">
        <button type="button" class="btn btn-xs btn-danger"
                onclick="IndustryProfile.listview.removePE('{{cnt}}');" style="cursor: pointer;" disabled="">
            <label class="fa fa-trash label-btn-icon"></label>
        </button>
    </td>
</tr>