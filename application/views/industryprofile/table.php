<div class="card">
    <div class="card-header">
        {{{s_display_text}}}
        <h3 class="card-title float-right">
            <button type="button" class="btn btn-sm btn-primary" onclick="IndustryProfile.listview.askForNewIndustryProfileForm($(this));">Industry Survey Form</button>
        </h3>
    </div>
    <div class="card-body" id="industry_profile_datatable_container">
        <div class="table-responsive">
            <table id="industry_profile_datatable" class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center" style="width: 10px;">No.</th>
                        <th class="text-center" style="width: 30px;">Company Name</th>
                        <th class="text-center" style="min-width: 150px;">Entrepreneur Name</th>
                        <th class="text-center" style="min-width: 150px;">Estate Name</th>
                        <th class="text-center" style="min-width: 150px;">Address</th>
                        <th class="text-center" style="min-width: 150px;">Authorized Persone Contact No.</th>
                        <th class="text-center" style="min-width: 150px;">Submitted On</th>
                        <!-- <th class="text-center" style="width: 90px;">Query Status</th> -->
                        <th class="text-center" style="width: 580px;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>