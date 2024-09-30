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
                        <li class="breadcrumb-item">Water Connection or Certificate of Non-Availability of Water</li>
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
                    <h2 class="fs-30px text-grad">Water Connection or Certificate of Non-Availability of Water</h2>                     
                       <!--  <h6>
                            Ensure that the following services are provided through the online single window system -
                            <br />
                            Water Connection or Certificate of Non-Availability of Water
                    </h6> -->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-0 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                   <!--  <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:10%;">Department</th>
                                <th class="v-a-m" style="width:10%;">District</th>
                                <th class="v-a-m" style="width:30%;">URL</th>
                                <th class="v-a-m" style="width:10%;">DOCUMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">Municipal Council Silvassa</td>
                                 <td class="text-center">DNH</td>
                                <td class="text-left">
                                    <a target="_blank" href="https://smcdnh.in/WTNewConnectio">
                                     https://smcdnh.in/WTNewConnectio</a></td>
                                <td class="text-center">
                                <a target="_blank" href="<?=base_url();?>assets/department/water_dnhdd/reforms_36_smc.pdf">Click Here</a>
                                </td>
                            </tr>                                                        
                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>