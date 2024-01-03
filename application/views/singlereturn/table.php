<div class="card">
    <div class="card-header">
        {{{s_display_text}}}
        <h3 class="card-title float-right">
            <button type="button" class="btn btn-sm btn-primary" onclick="SingleReturn.listview.askForNewSingleReturnForm($(this));">Apply for New Single Annual Return</button>
        </h3>
    </div>
    <div class="card-body" id="single_return_datatable_container">
        <div class="table-responsive">
            <table id="single_return_datatable" class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center" style="width: 10px;">No.</th>
                        <th class="text-center" style="width: 30px;">Application Number</th>
                        <th class="text-center" style="width: 30px;">District</th>
                        <th class="text-center" style="width: 30px;">Entity / Establishment Type</th>
                        <th class="text-center" style="min-width: 150px;">Establishment Name</th>
                        <th class="text-center" style="min-width: 150px;">Establishment Address</th>
                        <th class="text-center" style="min-width: 150px;">Email ID</th>
                        <th class="text-center" style="min-width: 150px;">Submitted On</th>
                        <th class="text-center" style="min-width: 150px;">Status</th>
                        <th class="text-center" style="width: 90px;">Query Status</th>
                        <th class="text-center" style="width: 580px;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>