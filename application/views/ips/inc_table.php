<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-sm btn-danger" onclick="Ips.listview.listPage();">
                    <i class="fas fa-arrow-left"></i> &nbsp; Back</button>
            </div>
            <div class="col-6 text-right">
                <button type="button" class="btn btn-sm btn-primary"  onclick="Ips.listview.newIncentivesForm(false, {});">
                    <i class="fas fa-plus-square"></i> &nbsp; Apply For New Incentive</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="incentives_datatable" class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center v-a-m" style="width: 30px;">No.</th>
                        <th class="text-center v-a-m" style="width: 135px;">Incentive Application Number</th>
                        <th class="text-center v-a-m" style="min-width: 150px;">Scheme Type</th>
                        <th class="text-center v-a-m" style="min-width: 250px;">Scheme Name</th>
                        <th class="text-center" style="min-width: 80px;">Submitted On</th>
                        <th class="text-center" style="width: 90px;">Status</th>
                        <th class="text-center" style="width: 90px;">Query Status</th>
                        <th class="text-center" style="width: 50px;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>