<tr id="property_tax_items_{{row_cnt}}" class="property_tax_items">
    <td class="text-center f-w-b row-cnt-display v-a-t">{{row_cnt}}</td>
    <td class="v-a-t">
        <input type="hidden" class="temp_cnt" value="{{row_cnt}}" />
        <div class="input-group">
            <select class="form-control ptc-attr" id="property_use_for_ptc_{{row_cnt}}" name="property_use_for_ptc" 
                    onchange="checkValidation('ptc', 'property_use_for_ptc_{{row_cnt}}', selectOneOptionValidationMessage);
                        resetCalculateButton();">
                <option value="">Select Property Use</option>
            </select>
        </div>
        <span class="error-message error-message-ptc-property_use_for_ptc_{{row_cnt}}"></span>
    </td>
    <td class="v-a-t">
        <div class="input-group">
            <select class="form-control ptc-attr" id="roofing_type_for_ptc_{{row_cnt}}" name="roofing_type_for_ptc" 
                    onchange="checkValidation('ptc', 'roofing_type_for_ptc_{{row_cnt}}', selectOneOptionValidationMessage);
                        resetCalculateButton();">
                <option value="">Select Roofing Type</option>
            </select>
        </div>
        <span class="error-message error-message-ptc-roofing_type_for_ptc_{{row_cnt}}"></span>
    </td>
    <td class="v-a-t">
        <div class="input-group">
            <input type="text" id="area_for_ptc_{{row_cnt}}" name="area_for_ptc" class="form-control ptc-attr"
                   placeholder="Enter Covered / Built-Up Area !" maxlength="10" 
                   onblur="checkValidation('grievance', 'area_for_ptc_{{row_cnt}}', areaValidationMessage);
                       checkNumeric($(this)); resetCalculateButton();" onkeyup="checkNumeric($(this)); resetCalculateButton();">
        </div>
        <span class="error-message error-message-ptc-area_for_ptc_{{row_cnt}}"></span>
    </td>
    <td class="text-center v-a-m v-a-t">
        <button type="button" class="btn btn-danger btn-sm m-b-0px ptc-attr-remove-button"
                onclick="removePropertyItem({{row_cnt}});">
            <i class="fa fa-trash-o"></i>Remove
        </button>
    </td>
</tr>