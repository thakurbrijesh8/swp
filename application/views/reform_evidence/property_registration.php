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
                        <li class="breadcrumb-item">Property Registration</li>
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
                    <h2 class="fs-30px text-grad">Property Registration</h2>
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
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:40%;">Name of Service</th>
                                <th class="v-a-m" style="width:10%;">Department</th>
                                <th class="v-a-m" style="width:10%;">District</th>
                                <th class="v-a-m" style="width:10%;">URL</th>
                                <th class="v-a-m" style="width:20%;">Document</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                              <tr>
                                <td>The searchable metadata may include: -Survey no., Registration number, Registration date, Conveyance deed/property registry</td>
                                <td class="text-center">Mamlatdar</td>
                                <td class="text-center">DNH</td>
                                <td>  <a href="http://dnh.nlrmp.in/avanika/HomeNew.aspx" target="_blank">http://dnh.nlrmp.in/avanika/HomeNew.aspx</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/mamlatdar/reforms_66_1.jpg">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> The website should clearly state that the information provided online is updated, and no physical visit is required</td>
                                <td class="text-center">Mamlatdar</td>
                                <td class="text-center">DNH</td>
                                <td>  <a href="http://dnh.nlrmp.in/avanika/HomeNew.aspx" target="_blank">http://dnh.nlrmp.in/avanika/HomeNew.aspx</a></td>
                                <td class="text-center">
                                     <a target="_blank" href="<?php echo $base_url; ?>assets/department/mamlatdar/reforms_66_2.jpg">Click Here</a>
                                </td>
                            </tr>
                               <tr>
                                <td> The searchable metadata may include: -Survey no., Registration number, Registration date, Conveyance deed/property registry</td>
                                <td class="text-center">Survey and Settlement</td>
                                <td class="text-center">DNH</td>
                               <td>  <a href="http://dnh.nlrmp.in/avanika/HomeNew.aspx" target="_blank">http://dnh.nlrmp.in/avanika/HomeNew.aspx</a></td>
                                <td class="text-center">
                                     <a target="_blank" href="<?php echo $base_url; ?>assets/department/survey_and_settlement/reforms_66_3.jpg">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> The website should clearly state that the information provided online is updated, and no physical visit is required</td>
                                <td class="text-center">Survey and Settlement</td>
                                <td class="text-center">DNH</td>
                               <td>  <a href="http://dnh.nlrmp.in/avanika/HomeNew.aspx" target="_blank">http://dnh.nlrmp.in/avanika/HomeNew.aspx</a></td>
                                <td class="text-center">
                                     <a target="_blank" href="<?php echo $base_url; ?>assets/department/survey_and_settlement/reforms_66_4.jpg">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td>i. Name of the Property Tax payer <br/>ii Survey no. of land / Unique Identification no. of property The website should clearly state that the information provided online is updated, and no physical visit is required</td>
                                <td class="text-center">Municipal Council</td>
                                <td class="text-center">DNH</td>
                                <td>  <a href="https://smcdnh.in" target="_blank">https://smcdnh.in</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/municipal_council/reforms_67.png">Click Here</a>
                                </td>
                            </tr>
                              <tr>
                                <td>i Design an online system which will have the facility to auto-calculate the levy area-wise and enable online payment of property tax</td>
                                <td class="text-center">Municipal Council </td>
                                <td class="text-center">DNH</td>
                                 <td> <a href="https://projects.mapmyindia.com/SilvassaPay/taxCalculator" target="_blank">https://projects.mapmyindia.com/SilvassaPay/taxCalculator</a><br/>
                                    <a href="https://projects.mapmyindia.com/SilvassaPay/downLoadTAXNotice2020" target="_blank">https://projects.mapmyindia.com/SilvassaPay/downLoadTAXNotice2020</a><br/>
                                    <a href="https://projects.mapmyindia.com/SilvassaPay/viewPrivateNotice" target="_blank">https://projects.mapmyindia.com/SilvassaPay/viewPrivateNotice</a><br/>
                                 </td>
                                <td class="text-center">
                                <a target="_blank" href="<?php echo $base_url; ?>assets/department/municipal_council/reforms_69.png">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td>Data of Property Tax payment dues at all urban areas of the State/UT (Name of the Property Tax payer, Property Tax dues)</td>
                                <td class="text-center">Municipal Council </td>
                                <td class="text-center">DNH</td>
                                <td>  <a href="https://projects.mapmyindia.com/SilvassaPay" target="_blank">https://projects.mapmyindia.com/SilvassaPay</a></td>
                                <td class="text-center">
                                <a target="_blank" href="<?php echo $base_url; ?>assets/department/municipal_council/reforms_71.pdf">Click Here</a>
                                </td>
                            </tr>
<!--                               <tr>
                                <td> Data of Property Tax payment dues at all urban areas of the State/UT (Name of the Property Tax payer, Property Tax dues)</td>
                                <td class="text-center">Municipal Council </td>
                                <td class="text-center">DNH</td>
                                <td>  <a href="https://projects.mapmyindia.com/SilvassaPay" target="_blank">https://projects.mapmyindia.com/SilvassaPay</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/municipal_council/reforms_72_1.png">Click Here</a>
                                </td>
                            </tr> -->
                             <tr>
                                <td> Online submission of information for property registration.</td>
                                <td class="text-center">Sub Registrar </td>
                                <td class="text-center">Daman</td>
                                <td>  <a href="http://103.82.145.62/appointment" target="_blank">http://103.82.145.62/appointment</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/subregistrar/reforms_72_1.png">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td> Online Stamp duty calculator.</td>
                                <td class="text-center">Sub Registrar </td>
                                <td class="text-center">Daman</td>
                                 <td>  <a href="http://103.82.145.62/appointment" target="_blank">http://103.82.145.62/appointment</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/subregistrar/reforms_72_2.png">Click Here</a>
                                </td>
                                </td>
                            </tr>
                              <tr>
                                <td> Mandate that the registered deed should be issued on the same day as the day of registration.</td>
                                <td class="text-center">Sub Registrar </td>
                                <td class="text-center">Daman</td>
                                <td>  <a href="https://daman.nic.in/websites/Civil-Registrar/2018/47-20-04-2018.pdf" target="_blank">https://daman.nic.in/websites/Civil-Registrar/2018/47-20-04-2018.pdf</a></td>
                                 <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/subregistrar/reforms_75.pdf">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td>Registration of deed</td>
                                <td class="text-center">Sub Registrar </td>
                                <td class="text-center">Daman</td>
                                 <td>  <a href="https://daman.nic.in/websites/Civil-Registrar/2020/4306-14-01-2020.pdf" target="_blank">https://daman.nic.in/websites/Civil-Registrar/2020/4306-14-01-2020.pdf</a></td>
                                <td class="text-center">
                                     <a target="_blank" href="<?php echo $base_url; ?>assets/department/subregistrar/reforms_76_1.pdf">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td>Registration of deed</td>
                                <td class="text-center">Sub Registrar </td>
                                <td class="text-center">DNH</td>
                                <td>  <a href="https://www.ngdrs.dnh.gov.in/Notification/table%20of%20registration%20fee.pdf" target="_blank">https://www.ngdrs.dnh.gov.in/Notification/table%20of%20registration%20fee.pdf</a></td>
                                <td class="text-center">
                                     <a target="_blank" href="<?php echo $base_url; ?>assets/department/subregistrar/reforms_76_2.pdf">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td>Mutation/name change at electricity and water department</td>
                                <td class="text-center">Sub Registrar </td>
                                <td class="text-center">DNH</td>
                                 <td>  <a href="https://www.dnhpdcl.in/content/calulation-fppca" target="_blank">https://www.dnhpdcl.in/content/calulation-fppca</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/subregistrar/reforms_76_3.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Access to cadastral maps</td>
                                <td class="text-center">Sub Registrar </td>
                                <td class="text-center">DNH</td>
                                 <td>  <a href="http://dnh.nic.in/Docs/SurSett/FeeStructure.pdf" target="_blank">http://dnh.nic.in/Docs/SurSett/FeeStructure.pdf</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>assets/department/subregistrar/reforms_76_4.pdf">Click Here</a>
                                </td>
                            </tr>
                       <!--  <tr>
                                <td>i. Name of the Property Tax payer <br/>ii Survey no. of land / Unique Identification no. of property The website should clearly state that the information provided online is updated, and no physical visit is required</td>
                                <td class="text-center">Municipal Council Silvassa</td>
                                <td class="text-center">DNH</td>
                                <td class="text-center">https://dmcdaman.in/services/#/onlineServices/property-tax <br/>https://dmcdaman.in/docs/pdf/DMC_property_tax_assessment_list_20-21.pdf</td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>documents/reforms_evidence/66/ev8521602761506.jpg">Click Here</a>
                                </td>
                            </tr> -->
<!--                             <tr>
                                <td class="text-center">1</td>
                                <td>Transaction history for the last 20 years should be available.</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">http://103.82.145.62/crsrsearch</td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>documents/reforms_evidence/65/ev1631607931833.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Soft copy of all registered deed should be available online.</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">http://103.82.145.62/crsrsearch</td>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $base_url; ?>documents/reforms_evidence/65/ev1821608814559.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>The searchable metadata available should be: Property ID, Survey no., Registration number, Registration date etc.</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">http://103.82.145.62/crsrsearch</td>
                                <td class="text-center">
                                   <a target="_blank" href="<?php echo $base_url; ?>documents/reforms_evidence/65/ev8971608802010.pdf">Click Here</a>
                                </td>
                            </tr>
                             <tr>
                                <td class="text-center">4</td>
                                <td>The website should clearly state that the information provided online is updated, and no physical visit is requiredtd</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">http://103.82.145.62/crsrsearch</td>
                                <td class="text-center">
                                   <a target="_blank" href="<?php echo $base_url; ?>documents/reforms_evidence/65/ev5181608751324.png">Click Here</a>
                                </td>
                            </tr>
                              <tr>
                                <td class="text-center">5</td>
                                <td>Transaction history for the last 20 years should be available.</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">http://103.82.145.62/crsrsearch</td>
                                <td class="text-center">
                                   <a target="_blank" href="<?php echo $base_url; ?>documents/reforms_evidence/65/ev5181608751324.png">Click Here</a>
                                </td>
                            </tr>
                              <tr>
                                <td class="text-center">6</td>
                                <td>Soft copy of all registered deed should be available online.</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">http://103.82.145.62/crsrsearch</td>
                                <td class="text-center">
                                   <a target="_blank" href="<?php echo $base_url; ?>documents/reforms_evidence/65/ev6771606888705.pdf">Click Here</a>
                                </td>
                            </tr>
                              <tr>
                                <td class="text-center">7</td>
                                <td>The searchable metadata available should be: Property ID, Survey no., Registration number, Registration date etc.</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">http://103.82.145.62/crsrsearch</td>
                                <td class="text-center">
                                   <a target="_blank" href="<?php echo $base_url; ?>documents/reforms_evidence/65/ev8391606893261.pdf">Click Here</a>
                                </td>
                            </tr>
                                <tr>
                                <td class="text-center">8</td>
                                <td>The website should clearly state that the information provided online is updated, and no physical visit is required</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">http://103.82.145.62/crsrsearch</td>
                                <td class="text-center">
                                   <a target="_blank" href="<?php echo $base_url; ?>documents/reforms_evidence/65/ev9281606888837.pdf">Click Here</a>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>


<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>