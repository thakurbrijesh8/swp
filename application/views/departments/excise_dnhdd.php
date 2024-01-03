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
                        <li class="breadcrumb-item">Excise Department</li>
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
                    <h2 class="fs-30px text-grad">Excise Department</h2>
                    <h6 class="lh-15">On the basis of recommendation made by the DIPP, Government of India and Information provided by the concern departments regarding Time lines and Competent Authority for necessary Clearances/NOCs/Permissions/Renewals, Single Window Agency hereby notifies the following Services, the time frames within which these are to be provided to the citizens, Competent Authority and deemed approval authority as per schedule given below:</h6>
                </div>
                <?php $this->load->view('departments_services/excise_dnhdd'); ?>
               <!--  <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:40%;">Name of Service</th>
                                <th class="v-a-m" style="width:10%;">District</th>
                                <th class="v-a-m" style="width:10%;">URL</th>
                                <th class="v-a-m" style="width:20%;">Documents</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Registration under State Excise for Label Registration</td>
                                <td class="text-center">Daman</td>
                                <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?= base_url(); ?>assets/department/excise/reform_30.pdf">Click Here</a>
                                </td>
                            </tr>

                                     <tr>
                                <td>State Excise <br/><br/> Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=30
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=30
                                     </a><br/>
                                    <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=8
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=8
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=12
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=12
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=48
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=48
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=50
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=50
                                     </a>
                                </td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_164.pdf">Click Here</a>
                                </td>
                            </tr> 
                             <tr>
                                <td>State Excise <br/> Submission of application</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_166_1.pdf">Click Here</a>
                                </td>
                            </tr> 
                              <tr>
                                <td>State Excise <br/> Payment of application fess</td>
                                <td class="text-center">Daman</td>
                                <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                               <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_166_2.pdf">Click Here</a>
                                </td>
                            </tr> 
                            <tr>
                                <td>State Excise <br/> Track status of application</td>
                                <td class="text-center">Daman</td>
                                <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_166_3.pdf">Click Here</a>
                                </td>
                            </tr> 
                             <tr>
                                <td> State Excise <br/>Download the final signed certificate</td>
                                <td class="text-center">Daman</td>
                                <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>                               
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_166_4.pdf">Click Here</a>
                                </td>
                            </tr> 
                             <tr>
                                <td> State Excise <br/>Third party verification</td>
                                <td class="text-center">Daman</td>
                              <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_166_5.pdf">Click Here</a>
                                </td>
                            </tr> 
                              <tr>
                                <td>State Excise - Label Registration </br><br/>
                                    Ensure information on fees, procedure, guidelines and a comprehensive list of all documents that need to be provided are available on the Department’s web site for label registration of products under state excise</td>
                                    <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=30
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=30
                                     </a><br/>
                                    <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=8
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=8
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=12
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=12
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=48
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=48
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=50
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=50
                                     </a>
                                </td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_168.pdf">Click Here</a>
                                </td>
                            </tr> 
                            <tr>
                                <td>State Excise - Label Registration </br> Submission of application</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_170_1.pdf">Click Here</a>
                                </td>
                            </tr> 
                              <tr>
                                <td>State Excise - Label Registration </br> Payment of application fee</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_170_2.pdf">Click Here</a>
                                </td>
                            </tr> 
                            <tr>
                                <td>State Excise - Label Registration </br> Track status of application</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_170_3.pdf">Click Here</a>
                                </td>
                            </tr> 
                             <tr>
                                <td> State Excise - Label Registration </br> Download the final signed certificate</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_170_4.pdf">Click Here</a>
                                </td>
                            </tr> 
                             <tr>
                                <td>State Excise - Label Registration </br> Third party verification</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_170_5.pdf">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                State Excise - Brand Registration </br></br>
                                Ensure information on fees, procedure, guidelines and a comprehensive list of all documents that need to be provided are available on the Department’s web site for brand registration of products under state excise</td>
                                <td class="text-center">Daman</td>
                                <td><a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=30
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=30
                                     </a><br/>
                                    <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=8
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=8
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=12
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=12
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=48
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=48
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=50
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=50
                                     </a>
                                </td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_172.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>State Excise - Brand Registration </br> Submission of application</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_173_1.pdf">Click Here</a>
                                </td>
                            </tr> 
                              <tr>
                                <td>State Excise - Brand Registration </br> Payment of application fee</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_173_2.pdf">Click Here</a>
                                </td>
                            </tr> 
                            <tr>
                                <td> State Excise - Brand Registration </br> Track status of application</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_173_3.pdf">Click Here</a>
                                </td>
                            </tr> 
                             <tr>
                                <td>State Excise - Brand Registration </br> Download the final signed certificate</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_173_4.pdf">Click Here</a>
                                </td>
                            </tr> 
                             <tr>
                                <td>State Excise - Brand Registration </br> Third party verification</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_173_5.pdf">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td>License for local sale, Import and export permit of Spirit and Indian-made foreign liquor (IMFL) </br></br>
                                Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                <td class="text-center">Daman</td>
                              <td><a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=30
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=30
                                     </a><br/>
                                    <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=8
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=8
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=12
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=12
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=48
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=48
                                     </a><br/>
                                     <a href="https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=50
                                    " target="_blank">https://ddnexcise.gov.in/Web_Site/DownLoadDocument?refno=50
                                     </a>
                                </td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_174.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>License for local sale, Import and export permit of Spirit and Indian-made foreign liquor (IMFL) </br> Submission of application</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_176_1.pdf">Click Here</a>
                                </td>
                            </tr> 
                              <tr>
                                <td>License for local sale, Import and export permit of Spirit and Indian-made foreign liquor (IMFL) </br> Payment of application fee</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_176_2.pdf">Click Here</a>
                                </td>
                            </tr> 
                            <tr>
                                <td>License for local sale, Import and export permit of Spirit and Indian-made foreign liquor (IMFL) </br> Track status of application</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_176_3.pdf">Click Here</a>
                                </td>
                            </tr> 
                             <tr>
                                <td> License for local sale, Import and export permit of Spirit and Indian-made foreign liquor (IMFL) </br> Download the final signed certificate</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_176_4.pdf">Click Here</a>
                                </td>
                            </tr> 
                             <tr>
                                <td>License for local sale, Import and export permit of Spirit and Indian-made foreign liquor (IMFL) </br> Third party verification</td>
                                <td class="text-center">Daman</td>
                               <td><a href="https://ddnexcise.gov.in/Home" target="_blank">https://ddnexcise.gov.in/Home</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/excise/reforms_176_5.pdf">Click Here</a>
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