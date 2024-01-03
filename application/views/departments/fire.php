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
                        <li class="breadcrumb-item">Fire & Emergency Services</li>
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
                    <h2 class="text-grad">Department of Fire & Emergency Services</h2>
                    <h6 class="lh-15">On the basis of recommendation made by the DIPP, Government of India and Information provided by the concern departments regarding Time lines and Competent Authority for necessary Clearances/NOCs/Permissions/Renewals, Single Window Agency hereby notifies the following Services, the time frames within which these are to be provided to the citizens, Competent Authority and deemed approval authority as per schedule given below:</h6>
                </div>
            </div>
        </div>
        <?php $this->load->view('departments_services/fire'); ?>
        <!--<div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:30%;">Name of Service</th>
                                <th style="width:15%;">Timeline (Working Days)</th>
                                <th style="width:25%;">Competent Authority </th>
                                <th style="width:20%;">Deemed Approval Authority</th>
                                <th style="width:10%;">Apply</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Provisional Fire NOC</td>
                                <td class="text-center">30 Days</td>
                                <td>DIGP/Director, Fire & Emergency Services</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center">
                                    <a class="nav-link" href="http://eservices.ddfes.in/ApplicantVerification/?TYPE=Provisional" target="_blank">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Final Fire NOC</td>
                                <td class="text-center">28 Days</td>
                                <td>DIGP/Director, Fire & Emergency Services</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center">
                                    <a class="nav-link" href="http://eservices.ddfes.in/ApplicantVerification/?TYPE=Final" target="_blank">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Renewal Fire NOC</td>
                                <td class="text-center"></td>
                                <td>DIGP/Director, Fire & Emergency Services</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center">
                                     <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a> -->
                                    <!--<a target="_blank" href="http://eservices.ddfes.in/ApplicantVerification/?TYPE=Renewal">Click Here</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>-->
        <!-- <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:40%;">Name of Service</th>
                                <th class="v-a-m" style="width:10%;">District</th>
                                <th class="v-a-m" style="width:40%;">URL</th>
                                <th class="v-a-m" style="width:10%;">DOCUMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                                <td >
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site
                                </td>
                                 <td class="text-center">Daman</td>
                                <td class="text-left">
                                    <a target="_blank" href="http://ddfes.in/"> http://ddfes.in/</a>
                                </td>
                                <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>assets/department/fire/reform238.jpg">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application
                                </td>
                                 <td class="text-center">Daman</td>
                                <td class="text-left">
                                    <a target="_blank" href="http://ddfes.in/eodb-b-timeline.aspx">http://ddfes.in/eodb-b-timeline.aspx</a>
                                </td>
                                <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>assets/department/fire/reform239.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Design and implement an online single window system and mandate the following features without the requirement of physical visit to the department :<br/>

i.   Submission of application
                                </td>
                                 <td class="text-center">Daman</td>
                                <td class="text-left">
                                   <a target="_blank" href="http://eservices.ddfes.in/ApplicantVerification/?TYPE=Renewal"> http://eservices.ddfes.in/ApplicantVerification/?TYPE=Renewal</a>
                                </td>
                                <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>assets/department/fire/reform240_1.pdf">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td >
                                   Design and implement an online single window system and mandate the following features without the requirement of physical visit to the department :
<br/>
iv. Download the final signed certificate
                                </td>
                                 <td class="text-center">Daman</td>
                                <td class="text-left">
                                  <a target="_blank" href="http://ddfes.in/firedept.aspx?extra=1"> http://ddfes.in/firedept.aspx?extra=1</a>
                                </td>
                                <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>assets/department/fire/reform240_4.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Design and implement an online single window system and mandate the following features without the requirement of physical visit to the department :
<br/>
v. Third party verification
                                </td>
                                 <td class="text-center">Daman</td>
                                <td class="text-left">
                                   <a target="_blank" href="http://ddfes.in/firedept.aspx?extra=1">http://ddfes.in/firedept.aspx?extra=1</a>
                                </td>
                                <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>assets/department/fire/reform240_5.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                   Publish an online dashboard available in public domain updated regularly (weekly/fortnightly/monthly) for registrations and renewals granted. 
<br/>
The dashboard should clearly highlight the registrations done and the time taken (Mean/ Median)
                                </td>
                                 <td class="text-center">Daman</td>
                                <td class="text-left">
                                  <a target="_blank" href="http://eservices.ddfes.in/DashboardAppList#">http://eservices.ddfes.in/DashboardAppList#</a>
                                </td>
                                <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>assets/department/fire/reform241.jpg">Click Here</a>
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