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
                        <li class="breadcrumb-item">Investors Facilitation Center / Investment Promotion Agency</li>
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
                    <h2 class="fs-30px text-grad">Investors Facilitation Center / Investment Promotion Agency</h2>
                </div>
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" rowspan="2" style="width:1%;">Sr. No.</th>                                
                                <th class="v-a-m" rowspan="2" style="width:16%;">Reforms Related to Ease of Doing Business ( EODB )</th>
                                <!--<th class="v-a-m" rowspan="2" style="width:5%;">SRAP-2020 Reform No.</th>-->
                                <th class="v-a-m" style="width:5%;">Document / URL</th>
                            </tr>                    
                        </thead>
                        <tbody>  
                            <tr>
                                <td class="text-center">1</td>                                
                                <td>Mandated regarding draft business regulation</td>
                                <!--<td class="text-center">5</td>-->
                                <td class="text-center" style="padding: 0px;">
                                    <table class="table mb-0">
                                        <tr>
                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                <a target="_blank" href="<?php echo $base_url; ?>assets/department/reform_5.pdf"><button type="button" class="btn btn-grad btn-sm">Document</button></a>
                                            </td>                                                                       
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>                                
                                <td>Notification on Investors Facilitation Center / Investment Promotion Agency</td>
                                <!--<td class="text-center">5</td>-->
                                <td class="text-center" style="padding: 0px;">
                                    <table class="table mb-0">
                                        <tr>
                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                <a target="_blank" href="<?php echo $base_url; ?>assets/department/IPC_Reform_5.pdf"><button type="button" class="btn btn-grad btn-sm">Document</button></a>
                                            </td>                                                                       
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:30%;">Name of Service</th>
                                <th style="width:10%;">District</th>
                                <th style="width:10%;">Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Investors’ Facilitation Center/ Investment Promotion Agency for investment promotion, industrial facilitation, regulatory reforms and obtaining user feedback</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/dic/reforms_6_dd.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Investors’ Facilitation Center/ Investment Promotion Agency for investment promotion, industrial facilitation, regulatory reforms and obtaining user feedback</td>
                                <td class="text-center">DNH</td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/dic/reforms_6_dnh.pdf">Click Here</a>
                                </td>
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