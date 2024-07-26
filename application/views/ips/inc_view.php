<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        View Incentive Scheme Details
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 30%;">Incentive Application Number</td>
                <td>{{application_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Scheme Type</td>
                <td>{{scheme_type_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Scheme Name</td>
                <td>{{scheme_text}}</td>
            </tr>
        </table>
    </div>
    <div class="card">
        <div class="card-header bg-nic-blue p-2">
            <h3 class="card-title f-w-b f-s-14px">CHECK LIST OF ENCLOSURES (AS APPLICABLE) TO BE SUBMITTED FOR SUBSIDY UNDER SCHEME</h3>
        </div>
        <div class="card-body pb-0 border-nic-blue">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="text-center" style="width: 50px;">No.</th>
                            <th class="text-center" style="min-width: 250px;">Document Name</th>
                            <th class="text-center" style="width: 220px;">Document</th>
                        </tr>
                    </thead>
                    <tbody id="doc_item_container_for_view_incentives">{{{no_record_fount_for_doc}}}</tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-nic-blue p-2">
            <h3 class="card-title f-w-b f-s-14px">OTHER DOCUMENTS (IF REQUIRE)</h3>
        </div>
        <div class="card-body pb-0 border-nic-blue">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="text-center" style="width: 50px;">No.</th>
                            <th class="text-center" style="min-width: 250px;">Document Name</th>
                            <th class="text-center" style="width: 220px;">Document</th>
                        </tr>
                    </thead>
                    <tbody id="od_item_container_for_view_incentives"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>