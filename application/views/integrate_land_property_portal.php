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
                        <li class="breadcrumb-item">Integrate Land / Property Portal</li>
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
                    <h2 class="fs-30px text-grad mb-4">Integrate Land / Property Portal</h2>
                    <div class="row">
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="https://dd.nlrmp.in/crsrsearch/" class="btn btn-grad btn-block f-s-16px">
                                land transaction deeds for last 20 years
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="https://dd.nlrmp.in/lrc/form114.aspx" class="btn btn-grad btn-block f-s-16px">
                                Updated Record of Rights
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="https://sugam.dddgov.in/rural-land-tax?d=VkZaRk9WQlJQVDA9&t=VkZaRk9WQlJQVDA9" class="btn btn-grad btn-block f-s-16px">
                                Data of Property Tax payment
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="https://sugam.dddgov.in/login?m=twEue9W1ORCmfKO6Y4eugA==" class="btn btn-grad btn-block f-s-16px">
                                Revenue Court case data
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="https://daman.dcourts.gov.in/" class="btn btn-grad btn-block f-s-16px">
                                Civil Court case data
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="https://connect.torrentpower.com/tplcp" class="btn btn-grad btn-block f-s-16px">
                                Electricity
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="" class="btn btn-grad btn-block f-s-16px">
                                Water
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="#" class="btn btn-grad btn-block f-s-16px">
                                Integrated with cadastral maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>