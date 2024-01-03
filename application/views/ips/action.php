<button type="button" class="btn btn-sm btn-success" onclick="Ips.listview.editOrViewIps($(this),'{{ips_id}}', true);"
        style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
    <i class="fas fa-pencil-alt"></i> &nbsp; Edit</button>
<button type="button" class="btn btn-sm btn-nic-blue" onclick="Ips.listview.editOrViewIps($(this),'{{ips_id}}', false);"
        style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
    <i class="fas fa-eye"></i> &nbsp; View</button>
<button type="button" class="btn btn-sm btn-primary" onclick="Ips.listview.showIncentives('{{ips_id}}');"
        style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
    <i class="fas fa-list-alt"></i> &nbsp; Show Incentives</button>