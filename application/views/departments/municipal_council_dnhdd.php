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
                        <li class="breadcrumb-item">Municipal Councils</li>
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
                    <h2 class="fs-30px text-grad">Municipal Councils</h2>
                    <h6 class="lh-15">On the basis of recommendation made by the DIPP, Government of India and Information provided by the concern departments regarding Time lines and Competent Authority for necessary Clearances/NOCs/Permissions/Renewals, Single Window Agency hereby notifies the following Services, the time frames within which these are to be provided to the citizens, Competent Authority and deemed approval authority as per schedule given below:</h6>
                </div>
                <?php $this->load->view('departments_services/municipal_council_dnhdd'); ?>
                <!-- <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:40%;">Name of Service</th>
                                <th class="v-a-m" style="width:10%;">Department</th>
                                <th class="v-a-m" style="width:10%;">District</th>
                                <th class="v-a-m" style="width:10%;">URL</th>
                                <th class="v-a-m" style="width:20%;">Documents</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Submission of application</td>
                                <td class="text-center">Municipal Council Silvassa</td>
                                <td class="text-center">DNH</td>
                                <td><a href="https://smcdnh.in/advertisement/application" target="_blank">https://smcdnh.in/advertisement/application</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= base_url(); ?>assets/department/municipal_council_silvassa/reform_248_1.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Payment of application fee</td>
                                <td class="text-center">Municipal Council Silvassa</td>
                                <td class="text-center">DNH</td>
                                <td><a href="https://smcdnh.in/advertisement/application" target="_blank">https://smcdnh.in/advertisement/application</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= base_url(); ?>assets/department/municipal_council_silvassa/reform_248_2.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Track status of application</td>
                                <td class="text-center">Municipal Council Silvassa</td>
                                <td class="text-center">DNH</td>
                                <td><a href="https://smcdnh.in/advertisement/applicationstatus" target="_blank">https://smcdnh.in/advertisement/applicationstatus</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= base_url(); ?>assets/department/municipal_council_silvassa/reform_248_3.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Download the final signed certificate</td>
                                <td class="text-center">Municipal Council Silvassa</td>
                                <td class="text-center">DNH</td>
                                <td><a href="https://smcdnh.in/advertisement/applicationstatus" target="_blank">https://smcdnh.in/advertisement/applicationstatus</a></br><a href="https://smcdnh.in/advertisement/agencystatus" target="_blank">https://smcdnh.in/advertisement/agencystatus</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= base_url(); ?>assets/department/municipal_council_silvassa/reform_248_4.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Third party verification</td>
                                <td class="text-center">Municipal Council Silvassa</td>
                                <td class="text-center">DNH</td>
                                <td><a href="https://smcdnh.in/advertisement/agencystatus" target="_blank">https://smcdnh.in/advertisement/agencystatus</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= base_url(); ?>assets/department/municipal_council_silvassa/reform_248_5.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Publish an online dashboard available in public domain updated regularly (weekly/fortnightly/monthly) for registrations and renewals. The dashboard should clearly highlight the registrations done and the time taken (Mean/ Median)</td>
                                <td class="text-center">Municipal Council Silvassa</td>
                                <td class="text-center">DNH</td>
                                <td><a href="https://smcdnh.in/" target="_blank">https://smcdnh.in/</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= base_url(); ?>assets/department/municipal_council_silvassa/reform_249.pdf">Click Here</a>
                                </td>
                            </tr>
                        </tbody>
                    </table> -->
            </div>
        </div>
    </div>
</section>

<section class="pt-0 pb-4">
    <div class="container">
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>