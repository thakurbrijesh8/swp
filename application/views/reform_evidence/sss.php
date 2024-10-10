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
                        <li class="breadcrumb-item">SSS - Samay Sudhini Seva</li>
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
                    <h2 class="fs-30px text-grad">SSS - Samay Sudhini Seva <span style="font-size: 16px;">(Right to Services Act/Public Service guarantee Act)</span></h2>
                    <h6 class="lh-15"> Enact a legislation (e.g. Right to Services Act/Public Service guarantee Act) to mandate time-bound delivery of services to Industries/ Businesses. 
                        <br />
                        Ensure that the time-bound service delivery legislation defines punitive provisions for those violating the timelines guaranteed for services delivery to industry and businesses.</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-0 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-1">
            </div>
            <div class="col-md-10 mt-2 mb-2">
                <a href="<?php echo base_url(); ?>assets/department/sss/Public_Service_Guarantee_Act_Rules_2022.pdf" target="_blank" class="btn btn-grad btn-block f-s-16px">
                    Click here to download Notification regarding Right of Citizen to Public Service : Time-Bound Delivery of Services
                </a>
                <!--                <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th class="v-a-m" rowspan="2" style="width:1%;">Sr. No.</th>
                                                <th class="v-a-m" rowspan="2" style="width:12%;">Department</th>
                                                <th class="v-a-m" style="width:10%;">Applicable in</th>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px !important; border: none;">
                                                    <table class="table table-hover mb-0">
                                                        <tr>
                                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">DAMAN</td>
                                                            <td style="border: none; border-right: 1px solid #dee2e6; width: 33.33%;
                                                                border-bottom: 1px solid #dee2e6;" class="text-center">DIU</td>
                                                            <td style="border: none; border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">DNH</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>Silvassa Municipal Council</td>
                                                <td class="text-center" style="padding: 0px;">
                                                    <table class="table mb-0">
                                                        <tr>
                                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center"></td>
                                                            <td style="border: none; border-right: 1px solid #dee2e6; width: 33.33%;
                                                                border-bottom: 1px solid #dee2e6;" class="text-center"></td>
                                                            <td style="border: none; border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                                <a target="_blank" href="http://dnh.nic.in/Docs/24Aug2020/ExtraOrdinaryNo40.pdf">View</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>Labour and Employment</td>
                                                <td class="text-center" style="padding: 0px;">
                                                    <table class="table mb-0">
                                                        <tr>
                                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                                <a target="_blank" href="<?php base_url(); ?>assets/department/sss/reforms_2_Labour.pdf">View</a>
                                                            </td>
                                                            <td style="border: none; border-right: 1px solid #dee2e6; width: 33.33%;
                                                                border-bottom: 1px solid #dee2e6;" class="text-center"></td>
                                                            <td style="border: none; border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>Sub Registrar</td>
                                                <td class="text-center" style="padding: 0px;">
                                                    <table class="table mb-0">
                                                        <tr>
                                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                                <a target="_blank" href="<?php base_url(); ?>assets/department/sss/reforms_2_sub_reg.pdf">View</a>
                                                            </td>
                                                            <td style="border: none; border-right: 1px solid #dee2e6; width: 33.33%;
                                                                border-bottom: 1px solid #dee2e6;" class="text-center"></td>
                                                            <td style="border: none; border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                                <a target="_blank" href="<?php base_url(); ?>assets/department/sss/reforms_2_sub_reg_DNH.pdf">View</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td>DIC</td>
                                                <td class="text-center" style="padding: 0px;">
                                                    <table class="table mb-0">
                                                        <tr>
                                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                                <a target="_blank" href="<?php base_url(); ?>assets/department/sss/reforms_2_dic.pdf">View</a>
                                                            </td>
                                                            <td style="border: none; border-right: 1px solid #dee2e6; width: 33.33%;
                                                                border-bottom: 1px solid #dee2e6;" class="text-center"></td>
                                                            <td style="border: none; border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">6</td>
                                                <td>Weights and Measures</td>
                                                <td class="text-center" style="padding: 0px;">
                                                    <table class="table mb-0">
                                                        <tr>
                                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                                <a target="_blank" href="<?php base_url(); ?>assets/department/sss/reforms_2_wamd.pdf">View</a>
                                                            </td>
                                                            <td style="border: none; border-right: 1px solid #dee2e6; width: 33.33%;
                                                                border-bottom: 1px solid #dee2e6;" class="text-center"></td>
                                                            <td style="border: none; border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td class="text-center">7</td>
                                                <td>GST</td>
                                                <td class="text-center" style="padding: 0px;">
                                                    <table class="table mb-0">
                                                        <tr>
                                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                                <a target="_blank" href="<?php base_url(); ?>assets/department/sss/gst_daman.jpg">View</a>
                                                            </td>
                                                            <td style="border: none; border-right: 1px solid #dee2e6; width: 33.33%;
                                                                border-bottom: 1px solid #dee2e6;" class="text-center"></td>
                                                            <td style="border: none; border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>       
                                            <tr>
                                                <td class="text-center">8</td>
                                                <td>Health</td>
                                                <td class="text-center" style="padding: 0px;">
                                                    <table class="table mb-0">
                                                        <tr>
                                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                                <a target="_blank" href="<?php base_url(); ?>assets/department/sss/reforms_2_health_daman.pdf">View</a>
                                                            </td>
                                                            <td style="border: none; border-right: 1px solid #dee2e6; width: 33.33%;
                                                                border-bottom: 1px solid #dee2e6;" class="text-center"></td>
                                                            <td style="border: none; border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>                                                    
                                        </tbody>
                                    </table>
                                </div>-->
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>