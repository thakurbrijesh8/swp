<div class="text-center">
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="Business.listview.getBusinessDetails($(this),'{{business_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye"></i> &nbsp;View</button>
    <button type="button" class="btn btn-sm btn-info" onclick="Business.listview.reFetchDetailsFomZED($(this),'{{business_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-sync"></i> &nbsp;Refresh</button>
</div>