<?php
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url, 'swp' => 'active'));
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
                        <li class="breadcrumb-item">Know Your Clearances</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left">
                    <h2 class="fs-30px text-grad mb-4">Know Your Clearances</h2>
                    <div class="row">
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="<?php echo base_url(); ?>information-wizard" class="btn btn-warning btn-block f-s-16px">
                                <i class="fa fa-check-circle-o mr-0"></i>&nbsp; Information Wizard
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="<?php echo base_url(); ?>departments-and-services" class="btn btn-grad btn-block f-s-16px">
                                <i class="fa fa-list-ul mr-0"></i>&nbsp; Departments & Services
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="<?php echo base_url(); ?>swp_ls" class="btn btn-info btn-block f-s-16px">
                                <i class="fa fa-list-ul mr-0"></i>&nbsp; List of Services
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="<?php echo base_url(); ?>samay-sudhini-seva" class="btn btn-grad btn-block f-s-16px">
                                Time Bound Delivery of Services
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="<?php echo base_url(); ?>everify" class="btn btn-grad btn-block f-s-16px">
                                <i class="fa fa-user-secret mr-0"></i>&nbsp; Third Party Verification
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="assets/CONTACTUS.pdf" target="_blank" class="btn btn-success btn-block f-s-16px">
                                <i class="fa fa-phone mr-0"></i>&nbsp; Department Contacts
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="https://www.nsws.gov.in/#" class="btn btn-grad btn-block f-s-16px" target="_blank">
                                National Single Window System
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>