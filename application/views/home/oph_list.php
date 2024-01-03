<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-rupee-sign"></i> Online Payment History</h1>
            </div>     
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="oph_datatable" class="table table-bordered m-b-0px table-hover f-s-14px"
                                   style="margin-top: 0px !important;">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-center" style="width: 50px;">No.</th>
                                        <th class="text-center" style="min-width: 80px;">District</th>
                                        <th class="text-center" style="min-width: 120px;">Department Name</th>
                                        <th class="text-center" style="min-width: 200px;">Service Name</th>
                                        <th class="text-center" style="min-width: 80px;">Application Number</th>
                                        <th class="text-center" style="min-width: 120px;">Transaction<br>Date & Time</th>
                                        <th class="text-center" style="min-width: 80px;">Total Fees</th>
                                        <th class="text-center" style="min-width: 140px;">Payment<br>Reference Number</th>
                                        <th class="text-center" style="min-width: 130px;">Payment Status</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>
                                            <input type="text" class="form-control" placeholder="District" maxlength="10" />
                                        </th>
                                        <th>
                                            <input type="text" class="form-control" placeholder="Department Name" maxlength="20" />
                                        </th>
                                        <th>
                                            <input type="text" class="form-control" placeholder="Service Name" maxlength="50" />
                                        </th>
                                        <th>
                                            <input type="text" class="form-control" placeholder="Application Number" maxlength="10" />
                                        </th>
                                        <th>
                                            <input type="text" class="form-control" placeholder="Date & Time" maxlength="10" />
                                        </th>
                                        <th>
                                            <input type="text" class="form-control" placeholder="Fees" maxlength="10" />
                                        </th>
                                        <th>
                                            <input type="text" class="form-control" placeholder="Reference Number" maxlength="20" />
                                        </th>
                                        <th>
                                            <input type="text" class="form-control" placeholder="Payment Status" maxlength="20" />
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="oph_item_container">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>