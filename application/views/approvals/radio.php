<div class="row p-1">
    <div class="col-sm-10 text-dark">
        {{cnt}}) {{question}}
    </div>
    <div class="col-sm-2">
        <div class="form-check mr-2" style="display: inline;">
            <input class="form-check-input" type="radio" name="answer_for_approval_{{questionary_id}}" value="{{VALUE_ONE}}"
                   id="yes_answer_for_approval_{{questionary_id}}" onchange="validationMessageHide('approval-answer_for_approval_{{questionary_id}}');">
            <label class="form-check-label text-dark" for="yes_answer_for_approval_{{questionary_id}}">
                Yes
            </label>
        </div>
        <div class="form-check" style="display: inline;">
            <input class="form-check-input" type="radio" name="answer_for_approval_{{questionary_id}}" value="{{VALUE_TWO}}"
                   id="no_answer_for_approval_{{questionary_id}}" onchange="validationMessageHide('approval-answer_for_approval_{{questionary_id}}');">
            <label class="form-check-label text-dark" for="no_answer_for_approval_{{questionary_id}}">
                No
            </label>
        </div>
        <span class="error-message error-message-approval-answer_for_approval_{{questionary_id}}"></span>
    </div>
    <div class="col-12"><hr class="mt-1 mb-0"></div>
</div>