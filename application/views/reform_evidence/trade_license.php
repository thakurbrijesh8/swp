<?php
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url));
$this->load->view('common/validation_message');
$this->load->view('security');
?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Trade License</li>
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
                    <h2 class="fs-30px text-grad">Trade License</h2>
                </div> <br>

                <div class="row">
                <div class="col-md-12 mt-4">
                 <div class="table-responsive">
            <table class="table p-04 table-hover">
                <thead class="all-text-white bg-grad">
                    <tr class="text-center">
                        <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                        <th class="text-center v-a-m" style="min-width: 150px;">Name of Service</th>
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
                        <td class="text-center">07 Days</td>
                        <td class="text-center">
                            <a target="_blank" href="<?php echo $base_url; ?>assets/department/tradelicense/reforms_215dd.pdf"><button type="button" class="btn btn-grad btn-sm">View</button></a>
                        </td>
                        <td class="text-center">Chief Officer</td>
                        <td class="text-center">Director</td>
                        <td class="text-center">-</td>
                    </tr>
<!--                     <tr>
                        <td class="text-center">2</td>
                        <td>Registration for Trade License</td>
                        <td class="text-center">
                            <a class="btn btn-grad btn-sm" href="http://smcdnh.nic.in/TradeLicance.aspx" target="_blank">Not Applicable In DNH</a>
                        </td>
                        <td class="text-center">Municipal Council - Silvassa</td>
                        <td class="text-center">07 Days</td>
                        <td class="text-center">
                            <a target="_blank" href="<?php echo $base_url; ?>assets/department/tradelicense/reform_219_dnh.pdf"><button type="button" class="btn btn-grad btn-sm">View</button></a>
                        </td>
                        <td class="text-center">Chief Officer</td>
                        <td class="text-center">Director</td>
                        <td class="text-center">-</td>
                    </tr>-->
                   
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


             
        </div>
    </div>
</section>

<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>