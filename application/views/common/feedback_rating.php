<div class="card-header pt-1">
    <h3 class="card-title" style="float: none; text-align: center;">Feedback / Rating</h3>
</div>
<form role="form" id="fr_form" name="fr_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="module_type_for_fr" name="module_type_for_fr" value="{{module_type}}">
    <input type="hidden" id="module_id_for_fr" name="module_id_for_fr" value="{{module_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center mb-2">
                {{#if show_submit_btn}}
                <span class="error-message error-message-fr f-w-b" style="border-bottom: 2px solid red;"></span>
                {{else}}
                <span class="f-w-b" style="border-bottom: 2px solid green; color: green;">You Have Already Submitted Your Feedback / Rating</span>
                {{/if}}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Application Number <span style="color: red;">*</span></label>
                <input type="text" class="form-control" placeholder="Application Number !"
                       value="{{application_number}}" readonly="">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Rating <span class="color-nic-red">*</span></label>
                <div id="rating_container_for_fr"></div>
                <span class="error-message error-message-fr-rating_for_fr"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Feedback <span class="color-nic-red">*</span></label>
                <textarea type="text" id="feedback_for_fr" name="feedback_for_fr" class="form-control" 
                          placeholder="Enter Feedback !" maxlength="200" 
                          onblur="checkValidation('fr', 'feedback_for_fr', feedbackValidationMessage);">{{feedback}}</textarea>
                <span class="error-message error-message-fr-feedback_for_fr"></span>
            </div>
        </div>
    </div>
</form>
<div class="card-footer text-right pr-2 pb-2">
    {{#if show_submit_btn}}
    <button type="button" id="submit_btn_for_fr" class="btn btn-sm btn-success" 
            onclick="submitFeedbackRating($(this));"
            style="padding: 2px 7px; margin-top: 1px;"><i class="fas fa-save"></i>&nbsp; Submit</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" style="padding: 2px 7px; margin-top: 1px;"
            onclick="Swal.close();"><i class="fas fa-times"></i>&nbsp; Close</button>
</div>