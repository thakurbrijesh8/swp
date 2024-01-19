<div class="card">
    <div class="card-header">
        {{{s_display_text}}}
        <h3 class="card-title float-right">
            <button type="button" class="btn btn-sm btn-primary" onclick="Tourismevent.listview.newTourismeventForm(false, {});">
                <i class="fas fa-plus"></i>&nbsp; Apply for New Tourism Event for Performance License
            </button>
        </h3>
    </div>
    <div class="card-body" id="tourismevent_datatable_container">
        <div class="table-responsive">
            <table id="tourismevent_datatable" class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center" style="width: 30px;">No.</th>
                        <th class="text-center" style="min-width: 100px;">Application Number</th>
                        <th class="text-center" style="width: 80px;">District</th>
                        <th class="text-center" style="min-width: 30px;">Entity / Establishment Type</th>
                        <th class="text-center" style="min-width: 165px;">Name of the person/Agency </th>
                        <th class="text-center" style="min-width: 165px;">Date of Event</th>
                        <th class="text-center" style="min-width: 165px;">Time Of Event</th>
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