<?php $base_url = base_url(); ?>
<?php $this->load->view('new_common/header', array('base_url' => $base_url, 'dashboard' => 'active')); ?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left pb-0">
                    <h2 class="text-grad">Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-8">
                <h5 class="mb-0 mt-2">- Data Starting From 1st January 2022</h5>
                <h6 class="mb-0 mt-2 text-grad">- Click on Department's Name to View Respective Dashboards.</h6>
                <h6 class="mb-0 mt-2 color-nic-red">- The Dashboard is being updated regularly as and when application received, processed and approved.</h6>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <input class="form-control" type="text" name="search" autofocus placeholder="Search Department" 
                           onkeyup="customizedTableSearch($(this), 'accordion_for_dashboard');">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="accordion toggle-icon-round" id="accordion_for_dashboard">
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-labour_emp">Labour & Employment</a>
                        </div>
                        <div class="collapse" id="collapse-labour_emp" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Registration under "Shops & Establishment Act"</td>
                                                <td class="text-center v-a-m font-weight-bold">15 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($shop_received_app) ? $shop_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($shop_processed_app) ? $shop_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($shop_approved_app) ? $shop_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($shop_rejected_app) ? $shop_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($shop_average_time_to_ga) ? $shop_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($shop_median_time_to_ga) ? $shop_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>Renewal under "Shops and Establishment Act"</td>
                                                <td class="text-center v-a-m font-weight-bold">20 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($shop_renewal_received_app) ? $shop_renewal_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($shop_renewal_processed_app) ? $shop_renewal_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($shop_renewal_approved_app) ? $shop_renewal_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($shop_renewal_rejected_app) ? $shop_renewal_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($shop_renewal_average_time_to_ga) ? $shop_renewal_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($shop_renewal_median_time_to_ga) ? $shop_renewal_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Registration / Renewal under "The Building and Other Construction Workers (Regulation of Employment Conditions of Service Act), 1996"</td>
                                                <td class="text-center v-a-m font-weight-bold">20 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($bocw_received_app) ? $bocw_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($bocw_processed_app) ? $bocw_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($bocw_approved_app) ? $bocw_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($bocw_rejected_app) ? $bocw_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($bocw_average_time_to_ga) ? $bocw_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($bocw_median_time_to_ga) ? $bocw_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">4</td>
                                                <td>Registration Certificate of "Establishment Inter State Migrant Workmen (RE&CS) Act, 1979 (License of Contractor Establishment)"</td>
                                                <td class="text-center v-a-m font-weight-bold">20 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($migrantworkers_received_app) ? $migrantworkers_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($migrantworkers_processed_app) ? $migrantworkers_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($migrantworkers_approved_app) ? $migrantworkers_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($migrantworkers_rejected_app) ? $migrantworkers_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($migrantworkers_average_time_to_ga) ? $migrantworkers_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($migrantworkers_median_time_to_ga) ? $migrantworkers_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">5</td>
                                                <td>Renewal Certificate of "Establishment Inter State Migrant Workmen (RE&CS) Act, 1979 (License of Contractor Establishment)"</td>
                                                <td class="text-center v-a-m font-weight-bold">20 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($migrantworkers_renewal_received_app) ? $migrantworkers_renewal_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($migrantworkers_renewal_processed_app) ? $migrantworkers_renewal_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($migrantworkers_renewal_approved_app) ? $migrantworkers_renewal_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($migrantworkers_renewal_rejected_app) ? $migrantworkers_renewal_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($migrantworkers_renewal_average_time_to_ga) ? $migrantworkers_renewal_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($migrantworkers_renewal_median_time_to_ga) ? $migrantworkers_renewal_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">6</td>
                                                <td>Registration / Renewal of principal employer's establishment under provision of The Contracts Labour (Regulation and Abolition) Act, 1970</td>
                                                <td class="text-center v-a-m font-weight-bold">20 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($establishment_received_app) ? $establishment_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($establishment_processed_app) ? $establishment_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($establishment_approved_app) ? $establishment_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($establishment_rejected_app) ? $establishment_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($establishment_average_time_to_ga) ? $establishment_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($establishment_median_time_to_ga) ? $establishment_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">7</td>
                                                <td>License for Contractors under provision of The Contracts Labour (R & A) Act,1970</td>
                                                <td class="text-center v-a-m font-weight-bold">20 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($appli_licence_received_app) ? $appli_licence_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($appli_licence_processed_app) ? $appli_licence_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($appli_licence_approved_app) ? $appli_licence_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($appli_licence_rejected_app) ? $appli_licence_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($appli_licence_average_time_to_ga) ? $appli_licence_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($appli_licence_median_time_to_ga) ? $appli_licence_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">8</td>
                                                <td>Renewal License for Contractors under provision of The Contracts Labour (R & A) Act,1970</td>
                                                <td class="text-center v-a-m font-weight-bold">20 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($appli_licence_renewal_received_app) ? $appli_licence_renewal_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($appli_licence_renewal_processed_app) ? $appli_licence_renewal_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($appli_licence_renewal_approved_app) ? $appli_licence_renewal_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($appli_licence_renewal_rejected_app) ? $appli_licence_renewal_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($appli_licence_renewal_average_time_to_ga) ? $appli_licence_renewal_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($appli_licence_renewal_median_time_to_ga) ? $appli_licence_renewal_median_time_to_ga : '-'; ?></td>
                                            </tr>
<!--                                            <tr>
                                                <td class="text-center v-a-m">9</td>
                                                <td>Single Annual Return form</td>
                                                <td class="text-center v-a-m font-weight-bold">20 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($singlereturn_received_app) ? $singlereturn_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($singlereturn_processed_app) ? $singlereturn_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($singlereturn_approved_app) ? $singlereturn_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($singlereturn_rejected_app) ? $singlereturn_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($singlereturn_average_time_to_ga) ? $singlereturn_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($singlereturn_median_time_to_ga) ? $singlereturn_median_time_to_ga : '-'; ?></td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-dic">District Industries Center</a>
                        </div>
                        <div class="collapse" id="collapse-dic" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Incentives under Investment Promotion Scheme - 2015 for Textile Sector</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($textile_received_app) ? $textile_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($textile_processed_app) ? $textile_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($textile_approved_app) ? $textile_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($textile_rejected_app) ? $textile_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">22</td>
                                                <td class="text-center v-a-m font-weight-bold">27</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>Incentives under Investment Promotion Scheme - 2015 for MSME</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($msme_received_app) ? $msme_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($msme_processed_app) ? $msme_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($msme_approved_app) ? $msme_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($msme_rejected_app) ? $msme_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">25</td>
                                                <td class="text-center v-a-m font-weight-bold">29</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Investment Promotion Scheme : 2022 to 2027 (20 May 2022 to 19 May 2027)</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($ips_incentive_received_app) ? $ips_incentive_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($ips_incentive_processed_app) ? $ips_incentive_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($ips_incentive_approved_app) ? $ips_incentive_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($ips_incentive_rejected_app) ? $ips_incentive_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($ps_incentive_average_time_to_ga) ? $ps_incentive_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($ps_incentive_median_time_to_ga) ? $ps_incentive_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">4</td>
                                                <td>Allotment of land in Industrial Area</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($land_allotment_received_app) ? $land_allotment_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($land_allotment_processed_app) ? $land_allotment_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($land_allotment_approved_app) ? $land_allotment_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($land_allotment_rejected_app) ? $land_allotment_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">25</td>
                                                <td class="text-center v-a-m font-weight-bold">25</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-pcc">Pollution Control Committee</a>
                        </div>
                        <div class="collapse" id="collapse-pcc" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Consent to Establish under the Water (Prevention and Control of Pollution) Act 1974, Air (Prevention and Control of Pollution) Act, 1981 and DG Set Approval.</td>
                                                <td class="text-center v-a-m font-weight-bold">90 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">404</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">153</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">134</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">19</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>
                                                    Consolidated Consent and Authorization – New/Renewal under the Water
                                                    (Prevention and Control of Pollution) Act 1974 and Air (Prevention and Control
                                                    of Pollution) Act 1981 and Hazardous and other wastes management and
                                                    Trance boundary Rule, 2016 (Consent to Operate / Renewal)
                                                    <br>
                                                    <span class="text-danger">
                                                        (Note : The above consented DG Set is permitted for standby arrangement only and not as a captive power generation unit.)
                                                    </span>
                                                </td>
                                                <td class="text-center v-a-m font-weight-bold">90 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">648</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">210</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">164</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">46</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Registration / Renewal under the E-waste management rules, 2016</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">4</td>
                                                <td>Registration/ Renewal under Plastic Waste (Management and Handling) Rules, 2016</td>
                                                <td class="text-center v-a-m font-weight-bold">30 days/15 days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>   
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">5</td>
                                                <td>Authorization under Solid Waste Management (processing, recycling, treatment, and disposal of solid waste) Rules, 2016</td>
                                                <td class="text-center v-a-m font-weight-bold"></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>   
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">6</td>
                                                <td>Authorization under Construction and Demolition Waste Management (Management and Handling) Rules, 2016</td>
                                                <td class="text-center v-a-m font-weight-bold"></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>   
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">7</td>
                                                <td>Registration for dealers under The Batteries (Management & Handling) Rules, 2001</td>
                                                <td class="text-center v-a-m font-weight-bold"></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>   
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">8</td>
                                                <td>Authorization under Bio-Medical Waste Management (Management and Handling) Rules, 2016</td>
                                                <td class="text-center v-a-m font-weight-bold"></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>   
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-fb">Factories & Boilers</a>
                        </div>
                        <div class="collapse" id="collapse-fb" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="accordion-content">
                                    <div class="table-responsive">
                                        <table class="table p-04 table-hover">
                                            <thead class="all-text-white bg-grad">
                                                <tr class="text-center">
                                                    <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                    <th class="v-a-m">Name of Service</th>
                                                    <th class="v-a-m" style="width: 14%;">
                                                        Time Limit Prescribed as per the Public<br>
                                                        Service Guarantee Act or Equivalent Act
                                                    </th>
                                                    <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                    <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                    <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                    <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                    <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                    <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center v-a-m">1</td>
                                                    <td>Registration of license under The Factories Act, 1948</td>
                                                    <td class="text-center v-a-m font-weight-bold">20 Days</td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($factorylicence_received_app) ? $factorylicence_received_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($factorylicence_processed_app) ? $factorylicence_processed_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($factorylicence_approved_app) ? $factorylicence_approved_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($factorylicence_rejected_app) ? $factorylicence_rejected_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($factorylicence_average_time_to_ga) ? $factorylicence_average_time_to_ga : '-'; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold"><?php echo isset($factorylicence_median_time_to_ga) ? $factorylicence_median_time_to_ga : '-'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center v-a-m">2</td>
                                                    <td>Renewal of license under The Factories Act, 1948</td>
                                                    <td class="text-center v-a-m font-weight-bold">60 Days</td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($factorylicence_renewal_received_app) ? $factorylicence_renewal_received_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($factorylicence_renewal_processed_app) ? $factorylicence_renewal_processed_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($factorylicence_renewal_approved_app) ? $factorylicence_renewal_approved_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($factorylicence_renewal_rejected_app) ? $factorylicence_renewal_rejected_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($factorylicence_renewal_average_time_to_ga) ? $factorylicence_renewal_average_time_to_ga : '-'; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold"><?php echo isset($factorylicence_renewal_median_time_to_ga) ? $factorylicence_renewal_median_time_to_ga : '-'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center v-a-m">3</td>
                                                    <td>Approval of plan and permission to construct/extend/or take into use any building as a factory under the Factories Act, 1948</td>
                                                    <td class="text-center v-a-m font-weight-bold">15 Days</td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($buildingplan_received_app) ? $buildingplan_received_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($buildingplan_processed_app) ? $buildingplan_processed_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($buildingplan_approved_app) ? $buildingplan_approved_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($buildingplan_rejected_app) ? $buildingplan_rejected_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($buildingplan_average_time_to_ga) ? $buildingplan_average_time_to_ga : '-'; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold"><?php echo isset($buildingplan_median_time_to_ga) ? $buildingplan_median_time_to_ga : '-'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center v-a-m">4</td>
                                                    <td>Registration of Boilers under The Boilers Act, 1923</td>
                                                    <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($boileract_received_app) ? $boileract_received_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($boileract_processed_app) ? $boileract_processed_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($boileract_approved_app) ? $boileract_approved_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($boileract_rejected_app) ? $boileract_rejected_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($boileract_average_time_to_ga) ? $boileract_average_time_to_ga : '-'; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold"><?php echo isset($boileract_median_time_to_ga) ? $boileract_median_time_to_ga : '-'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center v-a-m">5</td>
                                                    <td>Renewal of Boilers under The Boilers Act, 1923</td>
                                                    <td class="text-center v-a-m font-weight-bold">15 Days</td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($boileract_renewal_received_app) ? $boileract_renewal_received_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($boileract_renewal_processed_app) ? $boileract_renewal_processed_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($boileract_renewal_approved_app) ? $boileract_renewal_approved_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($boileract_renewal_rejected_app) ? $boileract_renewal_rejected_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($boileract_renewal_average_time_to_ga) ? $boileract_renewal_average_time_to_ga : '-'; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold"><?php echo isset($boileract_renewal_median_time_to_ga) ? $boileract_renewal_median_time_to_ga : '-'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center v-a-m">6</td>
                                                    <td>Registration / Renewal of Boilers Manufactures under The Boilers Act, 1923</td>
                                                    <td class="text-center v-a-m font-weight-bold">15 Days</td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($boilermanufactures_received_app) ? $boilermanufactures_received_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($boilermanufactures_processed_app) ? $boilermanufactures_processed_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($boilermanufactures_approved_app) ? $boilermanufactures_approved_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($boilermanufactures_rejected_app) ? $boilermanufactures_rejected_app : 0; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($boilermanufactures_average_time_to_ga) ? $boilermanufactures_average_time_to_ga : '-'; ?></td>
                                                    <td class="text-center v-a-m font-weight-bold"><?php echo isset($boilermanufactures_median_time_to_ga) ? $boilermanufactures_median_time_to_ga : '-'; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-mc">Municipal Councils</a>
                        </div>
                        <div class="collapse" id="collapse-mc" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Mobile Tower Approval</td>
                                                <td class="text-center v-a-m font-weight-bold">7 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">-</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">5 Day(s)</td>
                                                <td class="text-center v-a-m font-weight-bold">6 Day(s)</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>Trade Licenses</td>
                                                <td class="text-center v-a-m font-weight-bold">7 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">584</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">584</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">180</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">404</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">6 Day(s)</td>
                                                <td class="text-center v-a-m font-weight-bold">7 Day(s)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-revenue">Collectorates</a>
                        </div>
                        <div class="collapse" id="collapse-revenue" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>NA Application Form / Change in Land Use</td>
                                                <td class="text-center v-a-m font-weight-bold">90 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($na_received_app) ? $na_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($na_processed_app) ? $na_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($na_approved_app) ? $na_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($na_rejected_app) ? $na_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($na_average_time_to_ga) ? $na_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($na_median_time_to_ga) ? $na_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>
                                                    Application of Licenses under rule 11 of the Dadra and Nagar Haveli & Daman and Diu Cinema (Regulation of Exibition by Video.) Rules, 1985 / Application for registration under Cinema Regulation for Cinema Halls.
                                                    <br>
                                                    (Registration and Renewal)
                                                </td>
                                                <td class="text-center v-a-m font-weight-bold">45 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($cinema_received_app) ? $cinema_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($cinema_processed_app) ? $cinema_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($cinema_approved_app) ? $cinema_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($cinema_rejected_app) ? $cinema_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($cinema_average_time_to_ga) ? $cinema_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($cinema_median_time_to_ga) ? $cinema_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Film Shooting Permission(s) Form</td>
                                                <td class="text-center v-a-m font-weight-bold">5 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($filmshooting_received_app) ? $filmshooting_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($filmshooting_processed_app) ? $filmshooting_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($filmshooting_approved_app) ? $filmshooting_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($filmshooting_rejected_app) ? $filmshooting_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($filmshooting_average_time_to_ga) ? $filmshooting_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($filmshooting_median_time_to_ga) ? $filmshooting_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">4</td>
                                                <td>Society Registration</td>
                                                <td class="text-center v-a-m font-weight-bold">5 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($society_registration_received_app) ? $society_registration_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($society_registration_processed_app) ? $society_registration_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($society_registration_approved_app) ? $society_registration_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($society_registration_rejected_app) ? $society_registration_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($society_registration_average_time_to_ga) ? $society_registration_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($society_registration_median_time_to_ga) ? $society_registration_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">5</td>
                                                <td>Approval for DG set installation</td>
                                                <td class="text-center v-a-m font-weight-bold">5 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">-</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-fire">Fire & Emergency Services</a>
                        </div>
                        <div class="collapse" id="collapse-fire" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content text-center">
                                <?php echo isset($fire_dashboard) ? $fire_dashboard : ''; ?>
                                <?php // echo 'Unable to fetch data. Remote server could not be connected.'; ?>

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-wm">Legal Metrology (Weights & Measures) - Registration / Licenses under the Legal Metrology Act, 2009</a>
                        </div>
                        <div class="collapse" id="collapse-wm" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Registration under "Weights & Measure"</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_registration_received_app) ? $wm_registration_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_registration_processed_app) ? $wm_registration_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($wm_registration_approved_app) ? $wm_registration_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($wm_registration_rejected_app) ? $wm_registration_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_registration_average_time_to_ga) ? $wm_registration_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($wm_registration_median_time_to_ga) ? $wm_registration_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>Registration under "License for Repairer"</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_repairer_received_app) ? $wm_repairer_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_repairer_processed_app) ? $wm_repairer_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($wm_repairer_approved_app) ? $wm_repairer_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($wm_repairer_rejected_app) ? $wm_repairer_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_repairer_average_time_to_ga) ? $wm_repairer_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($wm_repairer_median_time_to_ga) ? $wm_repairer_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Renewal under "License for Repairer"</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_repairer_renewal_received_app) ? $wm_repairer_renewal_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_repairer_renewal_processed_app) ? $wm_repairer_renewal_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($wm_repairer_renewal_approved_app) ? $wm_repairer_renewal_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($wm_repairer_renewal_rejected_app) ? $wm_repairer_renewal_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_repairer_renewal_average_time_to_ga) ? $wm_repairer_renewal_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($wm_repairer_renewal_median_time_to_ga) ? $wm_repairer_renewal_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">4</td>
                                                <td>Registration under "License for Dealer"</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_dealer_received_app) ? $wm_dealer_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_dealer_processed_app) ? $wm_dealer_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($wm_dealer_approved_app) ? $wm_dealer_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($wm_dealer_rejected_app) ? $wm_dealer_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_dealer_average_time_to_ga) ? $wm_dealer_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($wm_dealer_median_time_to_ga) ? $wm_dealer_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">5</td>
                                                <td>Renewal under "License for Dealer"</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_dealer_renewal_received_app) ? $wm_dealer_renewal_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_dealer_renewal_processed_app) ? $wm_dealer_renewal_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($wm_dealer_renewal_approved_app) ? $wm_dealer_renewal_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($wm_dealer_renewal_rejected_app) ? $wm_dealer_renewal_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_dealer_renewal_average_time_to_ga) ? $wm_dealer_renewal_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($wm_dealer_renewal_median_time_to_ga) ? $wm_dealer_renewal_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">6</td>
                                                <td>Registration under "License for Manufacturer"</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_manufacturer_received_app) ? $wm_manufacturer_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_manufacturer_processed_app) ? $wm_manufacturer_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($wm_manufacturer_approved_app) ? $wm_manufacturer_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($wm_manufacturer_rejected_app) ? $wm_manufacturer_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_manufacturer_average_time_to_ga) ? $wm_manufacturer_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($wm_manufacturer_median_time_to_ga) ? $wm_manufacturer_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">7</td>
                                                <td>Renewal under "License for Manufacturer"</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_manufacturer_renewal_received_app) ? $wm_manufacturer_renewal_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_manufacturer_renewal_processed_app) ? $wm_manufacturer_renewal_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($wm_manufacturer_renewal_approved_app) ? $wm_manufacturer_renewal_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($wm_manufacturer_renewal_rejected_app) ? $wm_manufacturer_renewal_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wm_manufacturer_renewal_average_time_to_ga) ? $wm_manufacturer_renewal_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($wm_manufacturer_renewal_median_time_to_ga) ? $wm_manufacturer_renewal_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">8</td>
                                                <td>Registration under "Verification and Stamping of Weights & Measures"</td>
                                                <td class="text-center v-a-m font-weight-bold">5 Days at Office & 7 Days at Applicant Premises</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">366</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">366</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">366</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">3</td>
                                                <td class="text-center v-a-m font-weight-bold">3</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-electricity">Electricity Department</a>
                        </div>
                        <div class="collapse" id="collapse-electricity" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>
                                                    Issue of New Electricity Connection
                                                    <br> a) Temporary connection
                                                </td>
                                                <td class="text-center v-a-m font-weight-bold">
                                                    15 Days
                                                </td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">10</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">10</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">6</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">4</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">4</td>
                                                <td class="text-center v-a-m font-weight-bold">3 Application in <br> 5 Days</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>
                                                    Issue of New Electricity Connection
                                                    <br> b) LT connection
                                                </td>
                                                <td class="text-center v-a-m font-weight-bold">
                                                    45 Days
                                                </td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">122</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">122</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">102</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">20</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">8</td>
                                                <td class="text-center v-a-m font-weight-bold">12 Application in <br> 11 Days</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>
                                                    Issue of New Electricity Connection
                                                    <br> c) HT connection
                                                </td>
                                                <td class="text-center v-a-m font-weight-bold">
                                                    45 Days
                                                </td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">13</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">13</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">13</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">4</td>
                                                <td class="text-center v-a-m font-weight-bold">2 Application in <br> 8 Days</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">4</td>
                                                <td>
                                                    Approval for DG set installation (Registration and Renewal)
                                                </td>
                                                <td class="text-center v-a-m font-weight-bold">15 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">16</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">16</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">16</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">10</td>
                                                <td class="text-center v-a-m font-weight-bold">3 Application in 15 Days</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-pwd">PWD - Daman & Diu</a>
                        </div>
                        <div class="collapse" id="collapse-pwd" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Water Connection</td>
                                                <td class="text-center v-a-m font-weight-bold">07 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wc_received_app) ? $wc_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($wc_processed_app) ? $wc_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($wc_approved_app) ? $wc_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($wc_rejected_app) ? $wc_rejected_app : 0; ?></td>
                                                <!--<td class="text-center v-a-m font-weight-bold text-primary"><?php // echo isset($wc_average_time_to_ga) ? $wc_average_time_to_ga : '-';                                   ?></td>-->
                                                <td class="text-center v-a-m font-weight-bold text-primary">5 Days</td>
                                            <!--<td class="text-center v-a-m font-weight-bold"><?php // echo isset($wc_median_time_to_ga) ? $wc_median_time_to_ga : '-';                                   ?></td>-->
                                                <td class="text-center v-a-m font-weight-bold">2 Application in <br> 7 Days</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-tourism">Tourism Department</a>
                        </div>
                        <div class="collapse" id="collapse-tourism" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Hotel Registration Form</td>
                                                <td class="text-center v-a-m font-weight-bold">21 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($hotel_received_app) ? $hotel_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($hotel_processed_app) ? $hotel_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($hotel_approved_app) ? $hotel_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($hotel_rejected_app) ? $hotel_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($hotel_average_time_to_ga) ? $hotel_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($hotel_median_time_to_ga) ? $hotel_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>Hotel Registration Form - Renewal</td>
                                                <td class="text-center v-a-m font-weight-bold">21 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($hotel_renewal_received_app) ? $hotel_renewal_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($hotel_renewal_processed_app) ? $hotel_renewal_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($hotel_renewal_approved_app) ? $hotel_renewal_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($hotel_renewal_rejected_app) ? $hotel_renewal_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($hotel_renewal_average_time_to_ga) ? $hotel_renewal_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($hotel_renewal_median_time_to_ga) ? $hotel_renewal_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Travel Agency Registration Form</td>
                                                <td class="text-center v-a-m font-weight-bold">21 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($travelagent_received_app) ? $travelagent_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($travelagent_processed_app) ? $travelagent_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($travelagent_approved_app) ? $travelagent_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($travelagent_rejected_app) ? $travelagent_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($travelagent_average_time_to_ga) ? $travelagent_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($travelagent_median_time_to_ga) ? $travelagent_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">4</td>
                                                <td>Travel Agency Form - Renewal</td>
                                                <td class="text-center v-a-m font-weight-bold">21 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($travelagent_renewal_received_app) ? $travelagent_renewal_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($travelagent_renewal_processed_app) ? $travelagent_renewal_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($travelagent_renewal_approved_app) ? $travelagent_renewal_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($travelagent_renewal_rejected_app) ? $travelagent_renewal_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($travelagent_renewal_average_time_to_ga) ? $travelagent_renewal_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($travelagent_renewal_median_time_to_ga) ? $travelagent_renewal_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">5</td>
                                                <td>Tourism Event - Performance License</td>
                                                <td class="text-center v-a-m font-weight-bold">21 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($tourismevent_received_app) ? $tourismevent_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($tourismevent_processed_app) ? $tourismevent_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($tourismevent_approved_app) ? $tourismevent_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($tourismevent_rejected_app) ? $tourismevent_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($tourismevent_average_time_to_ga) ? $tourismevent_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($tourismevent_median_time_to_ga) ? $tourismevent_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-crsr">Civil Registrar Cum Sub Registrar (CRSR)</a>
                        </div>
                        <div class="collapse" id="collapse-crsr" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Partnership Firms Registration</td>
                                                <td class="text-center v-a-m font-weight-bold">15 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($psf_registration_received_app) ? $psf_registration_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($psf_registration_processed_app) ? $psf_registration_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($psf_registration_approved_app) ? $psf_registration_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($psf_registration_rejected_app) ? $psf_registration_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($psf_registration_average_time_to_ga) ? $psf_registration_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($psf_registration_median_time_to_ga) ? $psf_registration_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>Property Registration</td>
                                                <td class="text-center v-a-m font-weight-bold">Same Day</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($property_registration_received_app) ? $property_registration_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($property_registration_processed_app) ? $property_registration_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($property_registration_approved_app) ? $property_registration_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($property_registration_rejected_app) ? $property_registration_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($property_registration_average_time_to_ga) ? $property_registration_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($property_registration_median_time_to_ga) ? $property_registration_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Nil Certificate for Encumbrance</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Day</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">416</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">416</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">416</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">25 Day(s)</td>
                                                <td class="text-center v-a-m font-weight-bold">-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-pda">Planning & Development Authority</a>
                        </div>
                        <div class="collapse" id="collapse-pda" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Construction Permission / Building Plan Approval</td>
                                                <td class="text-center v-a-m font-weight-bold">21 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($construction_received_app) ? $construction_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($construction_processed_app) ? $construction_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($construction_approved_app) ? $construction_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($construction_rejected_app) ? $construction_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($construction_average_time_to_ga) ? $construction_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($construction_median_time_to_ga) ? $construction_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>Occupancy Certificate / Part Occupancy Certificate</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($occupancy_certificate_received_app) ? $occupancy_certificate_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($occupancy_certificate_processed_app) ? $occupancy_certificate_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($occupancy_certificate_approved_app) ? $occupancy_certificate_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($occupancy_certificate_rejected_app) ? $occupancy_certificate_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($occupancy_certificate_average_time_to_ga) ? $occupancy_certificate_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($occupancy_certificate_median_time_to_ga) ? $occupancy_certificate_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Application for Inspection at Plinth level</td>
                                                <td class="text-center v-a-m font-weight-bold">15 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($inspection_received_app) ? $inspection_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($inspection_processed_app) ? $inspection_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($inspection_approved_app) ? $inspection_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($inspection_rejected_app) ? $inspection_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($inspection_average_time_to_ga) ? $inspection_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($inspection_median_time_to_ga) ? $inspection_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                           <!--  <tr>
                                                <td class="text-center v-a-m">4</td>
                                                <td>Site Elevation</td>
                                                <td class="text-center v-a-m font-weight-bold">10 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($site_elevation_received_app) ? $site_elevation_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($site_elevation_processed_app) ? $site_elevation_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($site_elevation_approved_app) ? $site_elevation_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($site_elevation_rejected_app) ? $site_elevation_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($site_elevation_average_time_to_ga) ? $site_elevation_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($site_elevation_median_time_to_ga) ? $site_elevation_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">5</td>
                                                <td>Zone Information</td>
                                                <td class="text-center v-a-m font-weight-bold">07 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($zone_information_received_app) ? $zone_information_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($zone_information_processed_app) ? $zone_information_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($zone_information_approved_app) ? $zone_information_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($zone_information_rejected_app) ? $zone_information_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($zone_information_average_time_to_ga) ? $zone_information_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($zone_information_median_time_to_ga) ? $zone_information_median_time_to_ga : '-'; ?></td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-excise">Excise Department</a>
                        </div>
                        <div class="collapse" id="collapse-excise" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Label Registration/Brand Registration</td>
                                                <td class="text-center v-a-m font-weight-bold">10 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($incentive_generalform_textile_received_app) ? $incentive_generalform_textile_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($incentive_generalform_textile_processed_app) ? $incentive_generalform_textile_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($incentive_generalform_textile_approved_app) ? $incentive_generalform_textile_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($incentive_generalform_textile_rejected_app) ? $incentive_generalform_textile_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($incentive_generalform_textile_average_time_to_ga) ? $incentive_generalform_textile_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($incentive_generalform_textile_median_time_to_ga) ? $incentive_generalform_textile_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td> Export Permit (spirit) by Distilleries/Industries</td>
                                                <td class="text-center v-a-m font-weight-bold">3 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($incentive_generalform_received_app) ? $incentive_generalform_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($incentive_generalform_processed_app) ? $incentive_generalform_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($incentive_generalform_approved_app) ? $incentive_generalform_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($incentive_generalform_rejected_app) ? $incentive_generalform_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($incentive_generalform_average_time_to_ga) ? $incentive_generalform_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($incentive_generalform_median_time_to_ga) ? $incentive_generalform_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Export Permits(IMFL/CL/Beer/FL) by Distilleries/Brewery</td>
                                                <td class="text-center v-a-m font-weight-bold">3 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_received_app) ? $allotment_land_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_processed_app) ? $allotment_land_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($allotment_land_approved_app) ? $allotment_land_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($allotment_land_rejected_app) ? $allotment_land_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_average_time_to_ga) ? $allotment_land_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($allotment_land_median_time_to_ga) ? $allotment_land_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">4</td>
                                                <td>Import Permit (spirit) by Distilleries/Industries</td>
                                                <td class="text-center v-a-m font-weight-bold">3 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_received_app) ? $allotment_land_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_processed_app) ? $allotment_land_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($allotment_land_approved_app) ? $allotment_land_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($allotment_land_rejected_app) ? $allotment_land_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_average_time_to_ga) ? $allotment_land_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($allotment_land_median_time_to_ga) ? $allotment_land_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">5</td>
                                                <td>Import Permits(IMFL/CL/Beer/FL) by Wholesalers</td>
                                                <td class="text-center v-a-m font-weight-bold">3 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_received_app) ? $allotment_land_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_processed_app) ? $allotment_land_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($allotment_land_approved_app) ? $allotment_land_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($allotment_land_rejected_app) ? $allotment_land_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_average_time_to_ga) ? $allotment_land_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($allotment_land_median_time_to_ga) ? $allotment_land_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">6</td>
                                                <td>Local Sale/Transport Permits(Spirit) by Distilleries/Industries)</td>
                                                <td class="text-center v-a-m font-weight-bold">1 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_received_app) ? $allotment_land_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_processed_app) ? $allotment_land_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($allotment_land_approved_app) ? $allotment_land_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($allotment_land_rejected_app) ? $allotment_land_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_average_time_to_ga) ? $allotment_land_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($allotment_land_median_time_to_ga) ? $allotment_land_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">7</td>
                                                <td>Local Sale Permits(IMFL/CL/Beer/FL) by Distilleries/Brewery/Wholesalers</td>
                                                <td class="text-center v-a-m font-weight-bold">1 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_received_app) ? $allotment_land_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_processed_app) ? $allotment_land_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($allotment_land_approved_app) ? $allotment_land_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($allotment_land_rejected_app) ? $allotment_land_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_average_time_to_ga) ? $allotment_land_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($allotment_land_median_time_to_ga) ? $allotment_land_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">8</td>
                                                <td>Occasional License</td>
                                                <td class="text-center v-a-m font-weight-bold">7 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_received_app) ? $allotment_land_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_processed_app) ? $allotment_land_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($allotment_land_approved_app) ? $allotment_land_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($allotment_land_rejected_app) ? $allotment_land_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_average_time_to_ga) ? $allotment_land_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($allotment_land_median_time_to_ga) ? $allotment_land_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">9</td>
                                                <td>Renewal of Licenses(Distilleries/Brewery/Wholesalers/Retailers/Hotels) </td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_received_app) ? $allotment_land_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_processed_app) ? $allotment_land_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($allotment_land_approved_app) ? $allotment_land_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($allotment_land_rejected_app) ? $allotment_land_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($allotment_land_average_time_to_ga) ? $allotment_land_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($allotment_land_median_time_to_ga) ? $allotment_land_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-forest">Forest Department</a>
                        </div>
                        <div class="collapse" id="collapse-forest" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Tree Cutting Permission</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($tree_cutting_received_app) ? $tree_cutting_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($tree_cutting_processed_app) ? $tree_cutting_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($tree_cutting_approved_app) ? $tree_cutting_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($tree_cutting_rejected_app) ? $tree_cutting_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($tree_cutting_average_time_to_ga) ? $tree_cutting_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($tree_cutting_median_time_to_ga) ? $tree_cutting_median_time_to_ga : '-'; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-drugs-control">Drugs Control Department</a>
                        </div>
                        <div class="collapse" id="collapse-drugs-control" data-parent="#accordion_for_dashboard">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" style="width: 10px;">Sr. No.</th>
                                                <th class="v-a-m">Name of Service</th>
                                                <th class="v-a-m" style="width: 14%;">
                                                    Time Limit Prescribed as per the Public<br>
                                                    Service Guarantee Act or Equivalent Act
                                                </th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Received</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Processed</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Approved</th>
                                                <th class="v-a-m" style="width: 10%;">Total Number of Applications Rejected</th>
                                                <th class="v-a-m" style="width: 10%;">Average Time Taken To Grant Approval</th>
                                                <th class="v-a-m" style="width: 10%;">Median Time Taken to Grant Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center v-a-m">1</td>
                                                <td>Retail Drug License (Pharmacy) (Registration and Renewal)</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">55</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">55</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">55</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">29</td>
                                                <td class="text-center v-a-m font-weight-bold">28</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">2</td>
                                                <td>Wholesale Drug License (Registration and Renewal)</td>
                                                <td class="text-center v-a-m font-weight-bold">30 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">24</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">24</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">20</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">4</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">27</td>
                                                <td class="text-center v-a-m font-weight-bold">29</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center v-a-m">3</td>
                                                <td>Drug Manufacturing License (registration and Renewal)</td>
                                                <td class="text-center v-a-m font-weight-bold">45 Days</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">18</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">18</td>
                                                <td class="text-center v-a-m font-weight-bold text-success">18</td>
                                                <td class="text-center v-a-m font-weight-bold text-danger">0</td>
                                                <td class="text-center v-a-m font-weight-bold text-primary">41</td>
                                                <td class="text-center v-a-m font-weight-bold">43</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>