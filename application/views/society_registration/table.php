<div class="card">
    <div class="card-header">
        {{{s_display_text}}}
        <h3 class="card-title float-right">
            <button type="button" class="btn btn-sm btn-primary" onclick="SocietyRegistration.listview.newSocietyRegistrationForm(false, {});">
                <i class="fas fa-plus-square"></i> &nbsp; Apply For Society Registration</button>
        </h3>
    </div>
    <div class="card-body" id="society_registration_datatable_container">
        <div class="table-responsive">
            <table id="society_registration_datatable" class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center" style="width: 30px;">No.</th>
                        <th class="text-center" style="width: 30px;">Application Number</th>
                        <th class="text-center" style="min-width: 30px;">Entity / Establishment Type</th>
                        <th class="text-center" style="min-width: 80px;">District</th>
                        <th class="text-center" style="min-width: 220px;">Applicant Details</th>
                        <th class="text-center" style="min-width: 220px;">Society Details</th>
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