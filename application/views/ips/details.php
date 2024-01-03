<div class="card">
    <div class="card-body pb-0">
        <div class="row">
            <input type="hidden" id="ips_id_for_inc_list" name="ips_id_for_inc_list" value="{{ips_id}}" />
            <div class="form-group col-sm-6 col-md-3">
                <div class="card bg-aliceblue mb-0">
                    <div class="card-body">
                        <strong><i class="fas fa-hashtag mr-1"></i> Common Application Form Number</strong>
                        <p class="text-muted mb-0">{{application_number}}</p>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 col-md-3">
                <div class="card bg-aliceblue mb-0">
                    <div class="card-body">
                        <strong><i class="fas fa-map mr-1"></i> District</strong>
                        <p class="text-muted mb-0">{{district_text}}</p>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 col-md-3">
                <div class="card bg-aliceblue mb-0">
                    <div class="card-body">
                        <strong><i class="fas fa-user mr-1"></i> Owner Name</strong>
                        <p class="text-muted mb-0">{{owner_name}}</p>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 col-md-3">
                <div class="card bg-aliceblue mb-0">
                    <div class="card-body">
                        <strong><i class="fas fa-file-alt mr-1"></i> Udyam Registration / IEM No. Part-II : E.M. No and Date : </strong>
                        <p class="text-muted mb-0">{{udyam_registration}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 col-md-3">
                <div class="card bg-aliceblue mb-0">
                    <div class="card-body">
                        <strong><i class="fas fa-edit mr-1"></i> Name of Manu. Unit / Service Unit</strong>
                        <p class="text-muted mb-0">{{manu_name}}</p>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 col-md-3">
                <div class="card bg-aliceblue mb-0">
                    <div class="card-body">
                        <strong><i class="fas fa-map-marked mr-1"></i> Main Unit / Plant Address</strong>
                        <p class="text-muted mb-0">{{main_plant_address}}</p>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 col-md-3">
                <div class="card bg-aliceblue mb-0">
                    <div class="card-body">
                        <strong><i class="fas fa-map-marked mr-1"></i> Office Address</strong>
                        <p class="text-muted mb-0">{{office_address}}</p>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 col-md-3">
                <button type="button" class="btn btn-sm btn-nic-blue" onclick="Ips.listview.editOrViewIps($(this),'{{ips_id}}', false);"
                        style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
                    <i class="fas fa-eye"></i> &nbsp; View Full Details</button>
            </div>
        </div>
<!--        <div class="card bg-beige" style="margin-bottom: 10px;">
            <div class="card-body color-nic-red">
                <b>Note : </b> The Enterprise submitting the subsidy has to prepare the hard copy file of documents submitted and submit it to the concerned DIC office within 7 working days from the date of application of the subsidy.
            </div>
        </div>-->
    </div>
</div>