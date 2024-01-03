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
                        <li class="breadcrumb-item">Pollution Control Committee</li>
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
                    <h2 class="text-grad">Pollution Control Committee</h2>
                    <h6 class="lh-15">On the basis of recommendation made by the DIPP, Government of India and Information provided by the concern departments regarding Time lines and Competent Authority for necessary Clearances/NOCs/Permissions/Renewals, Single Window Agency hereby notifies the following Services, the time frames within which these are to be provided to the citizens, Competent Authority and deemed approval authority as per schedule given below:</h6>
                </div>
            </div>
        </div>
        <?php $this->load->view('departments_services/pcc'); ?>
        <!--<div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:35%;">Name of Service</th>
                                <th style="width:15%;">Timeline (Working Days)</th>
                                <th style="width:20%;">Competent Authority </th>
                                <th style="width:20%;">Deemed Approval Authority</th>
                                <th style="width:10%;">Apply</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Consent to establish (under Water / Air Act)</td>
                                <td class="text-center">90 Days</td>
                                <td class="text-center">Member Secretary (PCC)</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center"><a href="http://ddnocmms.nic.in/" target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td>Consent to operate & Common consent authorization (under Water / Air Act)</td>
                                <td class="text-center">90 Days</td>
                                <td class="text-center">Member Secretary (PCC)</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center"><a href="http://ddnocmms.nic.in/" target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td>Renewal of "Consent to Operate" (under Water / Air Act) </td>
                                <td class="text-center">90 Days</td>
                                <td class="text-center">Member Secretary (PCC)</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center"><a href="http://ddnocmms.nic.in/" target="_blank">Click Here</a></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:35%;">Name of Service</th>
                                <th style="width:15%;">District</th>
                                <th style="width:20%;">URL</th>
                                <th style="width:10%;">Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Allow validity period of Consent to Operate for period of 5 years and above.</td>
                                <td class="text-center">Daman</td>
                                <td><a href="https://ddnocmms.nic.in/SPCB_DOCUMENTS/Orange%20red%20validity%205%20year.pdf" target="_blank">https://ddnocmms.nic.in/SPCB_DOCUMENTS/Orange%20red%20validity%205%20year.pdf</a><br>
                                <td class="text-center">
                                    <a target="_blank" href="<?= base_url(); ?>assets/department/pcc/reform_84.pdf">Click Here</a>
                                </td>
                            </tr>

                            <tr>
                                <td>Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                <td class="text-center">Daman</td>
                                <td>1.<a href="https://ddnocmms.nic.in/SPCB DOCUMENTS/UserMannual.pdf" target="_blank">https://ddnocmms.nic.in/SPCB DOCUMENTS/UserMannual.pdf</a><br>
                                    2.<a href="https://daman.nic.in/websites/Pollution-Control-Committee/2018/177-24-04-2018.pdf" target="_blank">https://daman.nic.in/websites/Pollution-Control-Committee/2018/177-24-04-2018.pdf</a><br>
                                    3.<a href="http://pccdnhdd.in/pdf/Ease of_Doing_Busines_Reforms_20170001-3-3.pdf" target="_blank">http://pccdnhdd.in/pdf/Ease of_Doing_Busines_Reforms_20170001-3-3.pdf</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= base_url(); ?>assets/department/pcc/reform_88.pdf">Click Here</a>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>-->
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>