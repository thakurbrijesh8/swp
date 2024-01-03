<?php $base_url = base_url(); ?>
<?php $this->load->view('new_common/header', array('base_url' => $base_url, 'dashboard' => 'active')); ?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">DNH PDA Dashboard</li>
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
                    <h2 class="text-grad">DNH PDA Dashboard</h2>
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
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($construction_timelimit) ? $construction_timelimit : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($construction_received_app) ? $construction_received_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($construction_processed_app) ? $construction_processed_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-success"><?php echo isset($construction_approved_app) ? $construction_approved_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-danger"><?php echo isset($construction_rejected_app) ? $construction_rejected_app : 0; ?></td>
                                                <td class="text-center v-a-m font-weight-bold text-primary"><?php echo isset($construction_average_time_to_ga) ? $construction_average_time_to_ga : '-'; ?></td>
                                                <td class="text-center v-a-m font-weight-bold"><?php echo isset($construction_median_time_to_ga) ? $construction_median_time_to_ga : '-'; ?></td>
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