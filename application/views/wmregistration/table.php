<div class="card">
    <div class="card-header">
        {{{s_display_text}}}
        <h3 class="card-title float-right">
            <button type="button" class="btn btn-sm btn-primary" onclick="Wmregistration.listview.newWmregistrationForm(false, {});">
                <i class="fas fa-plus"></i>&nbsp; Apply for  Registration under "Weights & Measure"
            </button>
        </h3>
    </div>
    <div class="card-body" id="wmregistration_datatable_container">
        <div class="table-responsive">
            <table id="wmregistration_datatable" class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center" style="width: 30px;">No.</th>
                        <th class="text-center" style="min-width: 100px;">Application Number</th>
                        <th class="text-center" style="width: 80px;">District</th>
                        <th class="text-center" style="min-width: 50px;">Entity / Est. Type</th>
                        <th class="text-center" style="min-width: 165px;">Applicant Name</th>
                        <th class="text-center" style="min-width: 165px;">Category</th>
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