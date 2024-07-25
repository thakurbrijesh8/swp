<?php $base_url = base_url(); ?>
<?php $this->load->view('new_common/header', array('base_url' => $base_url, 'departments' => 'active')); ?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Departments</li>
                        <li class="breadcrumb-item">Other Services</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-8">
                <div class="title text-left pb-0">
                    <h2 class="text-grad">Other Services</h2>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <input class="form-control" type="text" name="search" autofocus placeholder="Search" 
                           onkeyup="customizedTableSearch($(this), 'other_services_main_container', 'other_services_item');">
                </div>
            </div>
        </div>
        <div id="other_services_main_container">
            <div class="row other_services_item">
                <div class="col-md-12 mt-4">
                    <h5 class="lh-15 text-grad">Water Connection</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>
                                        Water Connection
                                        <ul>
                                            <li><a href="https://daman.nic.in/websites/pwd_daman/documents/2018/Fixation-of-water-tariff.pdf" target="_blank">View Tariff</a></li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">PWD - Daman</td>
                                    <td class="text-center">7 Days</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-grad btn-sm">View</button>
                                    </td>
                                    <td class="text-center">Executive Engineer</td>
                                    <td class="text-center">Superintending Engineer</td>
                                    <td class="text-center">Secretary</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>
                                        Water Connection
                                        <ul>
                                            <li><a href="https://daman.nic.in/websites/pwd_daman/documents/2018/Fixation-of-water-tariff.pdf" target="_blank">View Tariff</a></li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">PWD - Diu</td>
                                    <td class="text-center">7 Days</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-grad btn-sm">View</button>
                                    </td>
                                    <td class="text-center">Executive Engineer</td>
                                    <td class="text-center">Superintending Engineer</td>
                                    <td class="text-center">Secretary</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>
                                        Water Connection
                                        <ul>
                                            <li><a href="https://smcdnh.in/makepayment" target="_blank">Bill Payment</a></li>
                                            <li><a href="https://smcdnh.in/WTConnectionStatus" target="_blank">Track Application Status</a></li>
                                            <li><a href="https://smcdnh.in/viewbill" target="_blank">Third Party Verification</a></li>
                                            <li><a href="http://smcdnh.nic.in/DeptDoc/Water_Tariffs.pdf" target="_blank">View Tariff</a></li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="https://smcdnh.in/WTNewConnection" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Municipal Council Silvassa (DNH)</td>
                                    <td class="text-center">7 Days</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-grad btn-sm">View</button>
                                    </td>
                                    <td class="text-center">Executive Engineer</td>
                                    <td class="text-center">Superintending Engineer</td>
                                    <td class="text-center">Secretary</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12"><hr></div>
            </div>
            <div class="row other_services_item">
                <div class="col-md-12 mt-1">
                    <h5 class="lh-15 text-grad">Trade Licenses</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Registration for Trade License</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="https://sampark.dmcdaman.in/#/shopestablishment-license/shop-establishment" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Municipal Council - Daman</td>
                                    <td class="text-center">7 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="https://swp.dddgov.in/assets/department/tradelicense/reforms_215dd.pdf" target="_blank">View</a>
                                    </td>

                                    <td class="text-center">Chief Officer</td>
                                    <td class="text-center">Director</td>
                                    <td class="text-center">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12"><hr></div>
            </div>
            <div class="row other_services_item">
                <div class="col-md-12 mt-1">
                    <h5 class="lh-15 text-grad">Signage License for Advertisement (Registration & Renewal)</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Signage License for advertisement (Registration and Renewal)</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="https://sampark.dmcdaman.in/#/advertisement/application">Click Here</a>
                                    </td>
                                    <td class="text-center">Municipal Council - Daman</td>
                                    <td class="text-center">15 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="https://sampark.dmcdaman.in/#/advertisement/application" target="_blank">View</a>
                                    </td>
                                    <td class="text-center">Chief Officer</td>
                                    <td class="text-center">Director</td>
                                    <td class="text-center">-</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>
                                        Signage License for advertisement (Registration and Renewal)
                                        <ul>
                                            <li><a href="https://smcdnh.in/" target="_blank">Dashboard</a></li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="https://smcdnh.in/advertisement/application" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Municipal Council - Silvassa</td>
                                    <td class="text-center">15 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="http://smcdnh.nic.in/Updates/09Feb2018/Tax%20on%20Advertisement.pdf" target="_blank">View</a>
                                    </td>
                                    <td class="text-center">Chief Officer</td>
                                    <td class="text-center">Secretary</td>
                                    <td class="text-center">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12"><hr></div>
            </div>
            <div class="row other_services_item">
                <div class="col-md-12 mt-1">
                    <h5 class="lh-15 text-grad">State Cinema Regulations Rules (Registration and Renewal)</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Application for State Cinema Regulations</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Daman</td>
                                    <td class="text-center">45 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="assets/department/collector/reform_242.pdf" target="_blank">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Deputy Collector (HQ)</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Application for State Cinema Regulations</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Diu</td>
                                    <td class="text-center">45 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="assets/department/collector/reform_242.pdf" target="_blank">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Application for State Cinema Regulations</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - DNH</td>
                                    <td class="text-center">45 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="assets/department/collector/reform_242.pdf" target="_blank">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12"><hr></div>
            </div>
            <div class="row other_services_item">
                <div class="col-md-12 mt-1">
                    <h5 class="lh-15 text-grad">Police and Traffic for Movie Shooting (Registration and Renewal)</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>    Application for Police and Traffic for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Daman</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>    Application for Police and Traffic for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Diu</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>    Application for Police and Traffic for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - DNH</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12"><hr></div>
            </div>
            <div class="row other_services_item">
                <div class="col-md-12 mt-1">
                    <h5 class="lh-15 text-grad">Municipal Corporation of State for Movie Shooting (Registration and Renewal)</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td> Application for Municipal Corporation of State for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Daman</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td> Application for Municipal Corporation of State for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Diu</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td> Application for Municipal Corporation of State for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - DNH</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12"><hr></div>
            </div>
            <div class="row other_services_item">
                <div class="col-md-12 mt-1">
                    <h5 class="lh-15 text-grad">Protected Monument for Movie Shooting (Registration and Renewal)</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td> Application for State Protected Monument for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Daman</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td> Application for State Protected Monument for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Diu</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td> Application for State Protected Monument for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - DNH</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12"><hr></div>
            </div>
            <div class="row other_services_item">
                <div class="col-md-12 mt-1">
                    <h5 class="lh-15 text-grad">Permission from District Collector for Movie Shooting (Registration and Renewal)</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Application for Permission from District Collector for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Daman</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Application for Permission from District Collector for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - Diu</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Application for Permission from District Collector for Movie Shooting</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Collectorate - DNH</td>
                                    <td class="text-center">5 Days</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" target="_blank" href="assets/department/collector/266-270-fees-procedure.pdf">View</a>
                                    </td>
                                    <td class="text-center">Superintendent (Collectorate)</td>
                                    <td class="text-center">Resident Deputy Collector</td>
                                    <td class="text-center">Collector</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12"><hr></div>
            </div>
            <div class="row other_services_item">
                <div class="col-md-12 mt-1">
                    <h5 class="lh-15 text-grad">Travel Agency (Registration and Renewal)</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Travel Agency (Registration and Renewal) </td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Tourism Department</td>
                                    <td class="text-center">21 Days</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-grad btn-sm">View</button>
                                    </td>
                                    <td class="text-center">Director (Tourism)</td>
                                    <td class="text-center">Secretary (Tourism)</td>
                                    <td class="text-center">-</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Travel Agency (Registration and Renewal) </td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Municipal Council - Daman</td>
                                    <td class="text-center">21 Days</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-grad btn-sm">View</button>
                                    </td>
                                    <td class="text-center">Chief Officer</td>
                                    <td class="text-center">Director</td>
                                    <td class="text-center">-</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Travel Agency (Registration and Renewal) </td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Municipal Council - Diu</td>
                                    <td class="text-center">21 Days</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-grad btn-sm">View</button>
                                    </td>
                                    <td class="text-center">Chief Officer</td>
                                    <td class="text-center">Director</td>
                                    <td class="text-center">-</td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Travel Agency (Registration and Renewal) </td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="<?php echo $base_url; ?>login" target="_blank">Click Here</a>
                                    </td>
                                    <td class="text-center">Municipal Council - Silvassa</td>
                                    <td class="text-center">21 Days</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-grad btn-sm">View</button>
                                    </td>
                                    <td class="text-center">Chief Officer</td>
                                    <td class="text-center">Secretaryr</td>
                                    <td class="text-center">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12"><hr></div>
            </div>
            <div class="row other_services_item">
                <div class="col-md-12 mt-1">
                    <h5 class="lh-15 text-grad">Mobile Tower Approval (Registration and Renewal)</h5>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table p-04 table-hover">
                            <thead class="all-text-white bg-grad">
                                <tr class="text-center">
                                    <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                    <th class="text-center v-a-m" style="min-width: 225px;">Name of Service</th>
                                    <th class="text-center v-a-m" style="min-width: 105px;">Apply Link</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Department Name</th>
                                    <th class="text-center v-a-m" style="min-width: 110px;">Timeline<br>(Working Days)</th>
                                    <th class="text-center v-a-m" style="min-width: 95px;">Fees / Procedure / Checklist</th>
                                    <th class="text-center v-a-m" style="min-width: 150px;">Designation of the Authority Responsible to Deliver the Services</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">1st Appellate Authority for Grievance Redressal</th>
                                    <th class="text-center v-a-m" style="min-width: 130px;">2nd Appellate Authority for Grievance Redressal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Mobile Tower Approval (Registration and Renewal)</td>
                                    <td class="text-center">
                                        <a class="btn btn-grad btn-sm" href="#">Click Here</a>
                                    </td>
                                    <td class="text-center">Municipal Council - Daman</td>
                                    <td class="text-center">7 Days</td>
                                    <td class="text-center">
                                        <a target="_blank" href="<?php echo $base_url; ?>assets/department/municipal_council/Reform_254.pdf"><button type="button" class="btn btn-grad btn-sm">View</button></a>
                                    </td>
                                    <td class="text-center">Chief Officer</td>
                                    <td class="text-center">Director</td>
                                    <td class="text-center">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--   <div class="row">
              <div class="col-md-12 mt-1">
                  <div class="table-responsive">
                      <table class="table p-04 table-hover">
                          <thead class="all-text-white bg-grad">
                              <tr class="text-center">
                                  <th style="width:35%;">Name of Service</th>
                                  <th style="width:15%;">Department</th>
                                  <th style="width:20%;">District</th>
                                  <th style="width:20%;">URL</th>
                                  <th style="width:10%;">Documents</th>
                              </tr>
                          </thead>
                          <tbody>
                             
                              <tr>
                                  <td>Signage License for advertisement (Registration and Renewal)</td>
                                  <td class="text-center">Municipal Council Silvassa</td>
                                  <td class="text-center">DNH</td>
                                  <td class="text-center"><a target="_black" href="https://smcdnh.in/advertisement/application">https://smcdnh.in/advertisement/application</a></td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_51_DNH.pdf">Click Here</a></td>
                              </tr>
  
                              
  
                              <tr>
                                  <td>Obtaining Utility Permits without the requirement of physical visit to the department:<p>i.   Submission of application</p></td>
                                  <td class="text-center">Municipal Council Silvassa</td>
                                  <td class="text-center">DNH</td>
                                  <td class="text-center"><a target="_black" href="https://smcdnh.in/WTNewConnection">https://smcdnh.in/WTNewConnection</a></td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_148_1_DNH.pdf">Click Here</a></td>
                              </tr>
  
                              <tr>
                                  <td>Obtaining Utility Permits without the requirement of physical visit to the department:<p>ii.  Payment of application fee</p></td>
                                  <td class="text-center">Municipal Council Silvassa</td>
                                  <td class="text-center">DNH</td>
                                  <td class="text-center"><a target="_blank" href="https://smcdnh.in/makepayment">https://smcdnh.in/makepayment</a></td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_148_2_DNH.pdf">Click Here</a></td>
                              </tr>
  
                        
                              <tr>
                                  <td>Obtaining Utility Permits Display information on tariffs (in Rs. per kL) and notify customers of change in tariff ahead of the billing cycle (for commercial and industrial users)</td>
                                  <td class="text-center">Municipal Council Silvassa</td>
                                  <td class="text-center">DNH</td>
                                  <td class="text-center"><a target="_blank" href="http://smcdnh.nic.in/DeptDoc/Water_Tariffs.pdf">http://smcdnh.nic.in/DeptDoc/Water_Tariffs.pdf</td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_149_1_DNH.pdf">Click Here</a></td>
                              </tr>
  
                              <tr>
                                  <td>Obtaining Utility Permits Display information on tariffs (in Rs. per kL) and notify customers of change in tariff ahead of the billing cycle (for commercial and industrial users)</td>
                                  <td class="text-center">PWD</td>
                                  <td class="text-center">Daman</td>
                                  <td class="text-center"><a target="_blank" href="https://daman.nic.in/websites/pwd_daman/documents/2018/Fixation-of-water-tariff.pdf">https://daman.nic.in/websites/pwd_daman/documents/2018/Fixation-of-water-tariff.pdf</a></td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_149_2_DD.pdf">Click Here</a></td>
                              </tr>
  
                              
                              <tr>
                                  <td>Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for obtaining water connection    </td>
                                  <td class="text-center">Municipal Council Silvassa</td>
                                  <td class="text-center">DNH</td>
                                  <td class="text-center"><a target="_blank" href="http://dnh.nic.in/Docs/24Aug2020/ExtraOrdinaryNo40.pdf">http://dnh.nic.in/Docs/24Aug2020/ExtraOrdinaryNo40.pdf</a></td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_151_1_DNH.pdf">Click Here</a></td>
                              </tr>
  
                              
                              <tr>
                                  <td>Publish an online dashboard available in public domain updated regularly (weekly/fortnightly/monthly) for all the new water connections provided in the state</td>
                                  <td class="text-center">Municipal Council Silvassa</td>
                                  <td class="text-center">DNH</td>
                                  <td class="text-center"><a target="_blank" href="http://smcdnh.in/">http://smcdnh.in/</a></td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_152_1_DNH.pdf">Click Here</a></td>
                              </tr>
                               
                               
                              
                              <tr>
                                  <td>Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available.</td>
                                  <td class="text-center">Sub Registrar</td>
                                  <td class="text-center">Daman</td>
                                  <td class="text-center"><a target="_blank" href="https://daman.nic.in/websites/Civil-Registrar/2020/ChecklistandProcessFlowPartnershipFirms.pdf">https://daman.nic.in/websites/Civil-Registrar/2020/ChecklistandProcessFlowPartnershipFirms.pdf</a></td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_286_1_DD.pdf">Click Here</a></td>
                              </tr>
  
                             
                              
                              <tr>
                                  <td>Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application  .</td>
                                  <td class="text-center">Sub Registrar</td>
                                  <td class="text-center">Daman</td>
                                  <td class="text-center"><a target="_blank" href="https://daman.nic.in/websites/Civil-Registrar/2018/47-20-04-2018.pdf">https://daman.nic.in/websites/Civil-Registrar/2018/47-20-04-2018.pdf</a></td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_287_1_DD.pdf">Click Here</a></td>
                              </tr>
  
                              
                              <tr>
                                  <td>Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available.</td>
                                  <td class="text-center">ARCS</td>
                                  <td class="text-center">Daman</td>
                                  <td class="text-center">-</td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_291_1_DD.pdf">Click Here</a></td>
                              </tr>
  
                              <tr>
                                  <td>Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site.</td>
                                  <td class="text-center">ARCS</td>
                                  <td class="text-center">Diu</td>
                                  <td class="text-center"><a target="_blank" href="http://diu.gov.in/Others/ARCS/PDF/ARCS-Society-Registration-Process.pdf">http://diu.gov.in/Others/ARCS/PDF/ARCS-Society-Registration-Process.pdf</a></td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_291_2_DIU.pdf">Click Here</a></td>
                              </tr>
  
                             
                              
                              <tr>
                                  <td>Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application  .</td>
                                  <td class="text-center">ARCS</td>
                                  <td class="text-center">Daman</td>
                                  <td class="text-center">-</td>
                                  <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/otherservices/reform_292_1_DD.pdf">Click Here</a></td>
                              </tr>
  
                               
  
                              
  
                          </tbody>
                      </table>
                  </div>
              </div>
          </div> -->





    </div>
</section>

<section class="pt-0 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>