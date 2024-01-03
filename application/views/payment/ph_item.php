<tr>
    <td style="width: 30px;" class="text-center v-a-m f-w-b">{{ph_cnt}}</td>
    <td class="text-center">{{transaction_datetime}}</td>
    <td class="text-right f-w-b">{{total_fees}} /-</td>
    <td class="text-center">{{reference_id}}</td>
    <td class="text-center pg_status_{{fees_payment_id}}">{{{status_text}}}</td>
    <td class="text-center">
        {{#if show_update_payment_status_btn}}
        <button type="button" class="btn btn-sm btn-info" 
                onclick="checkPaymentDV($(this), '{{fees_payment_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-sync" style="margin-right: 2px;"></i> Update Status
        </button>
        {{/if}}
    </td>
</tr>