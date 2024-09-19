<div class="card-header card-hbf-new">
    <h5 class="card-title f-w-b mb-0" style="float: none; text-align: center;">
        View Queries/ Grievance Redressal Average Fees Details
    </h5>
</div>
<div class="card-body card-hbf-new p-b-0px text-left" style="font-size: 13px;">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-padd">
            <thead>
                <tr class="bg-light-gray">
                    <td class="f-w-b" style="width: 100px;">Service Name</td>
                    <td style="width: 100px;">{{service_name}}</td>
                </tr>
            </thead>
        </table>
    </div>
    <div class="table-responsive">
        <table id="afd_datatable" class="table table-bordered m-b-0px table-hover table-padd w-100"
               style="margin-top: 0px !important;">
            <thead>
                <tr class="all-text-white bg-grad">
                    <th class="text-center" style="width: 35px;">No.</th>
                    <th class="text-center" style="min-width: 80px;">Application No.</th>
                    <th class="text-center" style="min-width: 80px;">Application Date</th>
                    <th class="text-center" style="min-width: 80px;">Total Fee Charged</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="card-footer card-hbf-new text-right">
    <button type="button" class="btn btn-sm btn-danger mb-0" onclick="Swal.close();">
        <i class="fa fa-times mr-0"></i>&nbsp; Close</button>
</div>