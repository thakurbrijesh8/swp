<div class="card">
    <div class="card-header">
        {{{s_display_text}}}
        <h3 class="card-title float-right">
            <button type="button" class="btn btn-sm btn-primary" onclick="FactoryLicenseRenewal.listview.askForNewFactoryLicenseRenewalForm($(this));">
                <i class="fas fa-plus"></i>&nbsp; Apply for Factories License - Renewal
            </button>
        </h3>
    </div>
    <div class="card-body" id="factory_license_renewal_datatable_container">
        <div class="table-responsive">
            <table id="factory_license_renewal_datatable" class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center" style="width: 10px;">No.</th>
                        <th class="text-center" style="min-width: 100px;">Application Number</th>
                        <th class="text-center" style="width: 80px;">District</th>
                        <th class="text-center" style="min-width: 30px;">Entity / Establishment Type</th>
                        <th class="text-center" style="min-width: 150px;">Factory Name</th>
                        <th class="text-center" style="min-width: 150px;">Install H.P.</th>
                        <th class="text-center" style="min-width: 150px;">Factory Address</th>
                        <th class="text-center" style="min-width: 100px;">Submitted On</th>
                        <th class="text-center" style="width: 90px;">Status</th>
                        <th class="text-center" style="width: 90px;">Query Status</th>
                        <th class="text-center" style="width: 50px;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>