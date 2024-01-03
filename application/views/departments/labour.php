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
                        <li class="breadcrumb-item">Labour & Employment</li>
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
                    <h2 class="text-grad">Department of Labour & Employment</h2>
                    <h6 class="lh-15">On the basis of recommendation made by the DIPP, Government of India and Information provided by the concern departments regarding Time lines and Competent Authority for necessary Clearances/NOCs/Permissions/Renewals, Single Window Agency hereby notifies the following Services, the time frames within which these are to be provided to the citizens, Competent Authority and deemed approval authority as per schedule given below:</h6>
                </div>
            </div>
        </div>
        <?php $this->load->view('departments_services/labour'); ?>
        <!--        <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="table-responsive">
                            <table class="table p-04 table-hover">
                                <thead class="all-text-white bg-grad">
                                    <tr class="text-center">
                                        <th class="v-a-m" style="width:40%;">Name of Service</th>
                                        <th class="v-a-m" style="width:10%;">Timeline (Working Days)</th>
                                        <th class="v-a-m" style="width:20%;">Competent Authority </th>
                                        <th class="v-a-m" style="width:20%;">Deemed Approval Authority</th>
                                        <th class="v-a-m" style="width:20%;">Apply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Name of the clearance / Approval</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_1.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Business Reforms Action Plan</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_2.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Business Reforms Action Plan</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_2.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Factories Act,1948</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_101.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Checklist Under the Factories Act,1948</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_102_checklist.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Checklist for Approval of Factory Plans under the Factories Act,1948</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_106_checklist.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Boilers from certain provisions of the Boilers Act,1923.</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_109.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Checklist under the Boilers Act,1923.</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_110.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Procedure for Boiler Manufacturer Certificate</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_113_checklist.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Under "Shops and Establishment Act"</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_118.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Under "Welfare act through an Online System"</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_119.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contractor under Contract Labour (THE CONTRACT LABOUR ACT,1970)</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_120_checklist.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Check list of Shop & Establishment</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_124_checklist.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inspection prior Under the Goa, Daman & Diu Shops and Establishment Act, 1973 (A) </td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_127(a).pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inspection prior Under the Goa, Daman & Diu Shops and Establishment Act, 1973 (B)</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_127(b).pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Employer Under Contract Labour (THE CONTRACT LABOUR ACT,1970)</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_128_checklist.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration of Establishment employing building workers Under the Building and Other Construction Workers (RE&CS) Act,1996</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_132_checklist.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inter-State Migrant </td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_135_checklist.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Compliance inspection Under the laws applicable to the Departments of Labour, Factories and Boilers </td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_199.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Central Inspection System  </td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_201-206.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inspection under Act</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_204.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Central Inspection Framework under the following Acts</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_205.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Checklist Central Inspection Framework under the following Acts</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_206.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Labour Laws & the Factories Act,1948</td>
                                        <td class="text-center">20 Days</td>
                                        <td>Labour Inspector</td>
                                        <td class="text-center">Single Window Agency</td>
                                        <td class="text-center">
                                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_207.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>-->
        <!--        <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="table-responsive">
                            <table class="table p-04 table-hover">
                                <thead class="all-text-white bg-grad">
                                    <tr class="text-center">
                                        <th class="v-a-m" style="width:40%;">Name of Service</th>
                                        <th class="v-a-m" style="width:40%;">URL</th>
                                        <th class="v-a-m" style="width:20%;">Document</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>License and renewal of license for contractors under provision of The Contracts Labour (Regulation and Abolition) Act, 1970</td>
                                        <td><a href="https://labourddd.in/main#aplicence_form" target="_blank">https://labourddd.in/main#aplicence_form</a><br>
                                        <a href="https://labourddd.in/main#aplicence_renewal_form" target="_blank">https://labourddd.in/main#aplicence_renewal_form</a><br>
                                        </td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_17.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration and renewal (if applicable) under The Shops and Establishment Act</td>
                                        <td><a href="https://labourddd.in/main#shop_form" target="_blank">https://labourddd.in/main#shop_form</a><br>
                                        <a href="https://labourddd.in/main#shop_renewal_form" target="_blank">https://labourddd.in/main#shop_renewal_form</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_18.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration / Renewal of principal employer's establishment under provision of The Contracts Labour (Regulation and Abolition) Act, 1970</td>
                                        <td><a href="https://labourddd.in/main#clact_form" target="_blank">https://labourddd.in/main#clact_form</a>
                                        </td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_19.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration under The Building and Other Construction Workers (Regulation of Employment and Conditions of Service) Act, 1996</td>
                                        <td><a href="https://labourddd.in/main#bocw_form" target="_blank">https://labourddd.in/main#bocw_form</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_20.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration of establishment under the Inter State Migrant Workmen (RE&CS) Act, 1979</td>
                                        <td><a href="https://labourddd.in/main#migrantworkers" target="_blank">https://labourddd.in/main#migrantworkers</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_21.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Introduce a provision for allowing the validity of license under the Factories Act, 1948 to be 10 years or more.</td>
                                        <td><a href="https://labourddd.in" target="_blank">https://labourddd.in</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_101.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                        <td><a href="https://labourddd.in" target="_blank">https://labourddd.in</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_103.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ensure provision for maintaining online / digital registers and records under all labour acts (applicable to all industries)</td>
                                        <td></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_117.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration under Shops & Establishment AND/OR Trade License to be given through a single form.</td>
                                        <td><a href="https://labourddd.in" target="_blank">https://labourddd.in</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_118.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mandate that the contributions under Labour welfare act should be made through an online system</td>
                                        <td><a href="https://labourddd.in" target="_blank">https://labourddd.in</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_119.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                        <td></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_120.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                        <td><a href="https://swp.dddgov.in/assets/department/labour/reforms_2.pdf" target="_blank">https://swp.dddgov.in/assets/department/labour/reforms_2.pdf	</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_121.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>License for contractors under provision of The Contracts Labour (Regulation and Abolition) Act, 1970<br>
                                            i.   Submission of application<br>
                                            ii.  Payment of application fee<br>
                                            iii. Track status of application<br>
                                            iv. Download the final signed certificate<br>
                                            v. Third party verification</td>
                                        <td><a href="https://labourddd.in/main#aplicence_form" target="_blank">https://labourddd.in/main#aplicence_form</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_122.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                        <td><a href="https://labourddd.in/login" target="_blank">https://labourddd.in/login</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_124.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                        <td><a href="https://swp.dddgov.in/assets/department/labour/reforms_2.pdf" target="_blank">https://swp.dddgov.in/assets/department/labour/reforms_2.pdf</a></td>
                                        <td class="text-center">	
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_125.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration under The Shops and Establishment Act (including 365 days license)<br>
                                            i.   Submission of application<br>  
                                            ii.  Payment of application fee<br>
                                            iii. Track status of application<br>
                                            iv. Download the final signed certificate<br>
                                            v. Third party verification
                                        </td>
                                        <td><a href="https://labourddd.in/main#shop_form" target="_blank">https://labourddd.in/main#shop_form</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_126.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration under The Shops and Establishment Act (including 365 days license)<br>
                                            i. Eliminate the requirement of Inspection prior to registration<br>  
                                        </td>
                                        <td><a href="https://labourddd.in" target="_blank">https://labourddd.in</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_127_a.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration under The Shops and Establishment Act (including 365 days license)<br>
                                            ii. Ensure that the final registration is granted within one day from the date of application<br>  
                                        </td>
                                        <td><a href="https://labourddd.in" target="_blank">https://labourddd.in</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_127_b.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration under The Shops and Establishment Act (including 365 days license)<br>
                                            Eliminate the requirement of Renewal of registration
                                        </td>
                                        <td><a href="https://labourddd.in/login" target="_blank">https://labourddd.in/login</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_128.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration/Renewal of principal employer's establishment under provision of The Contracts Labour (Regulation and Abolition) Act, 1970<br>
                                            Ensure information on fees, procedure and a comprehensive list of all documents</td>
                                        <td><a href="https://labourddd.in/login" target="_blank">https://labourddd.in/login</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_129.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration/Renewal of principal employer's establishment under provision of The Contracts Labour (Regulation and Abolition) Act, 1970<br>
                                            Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                        <td><a href="https://swp.dddgov.in/assets/department/labour/reforms_2.pdf" target="_blank">https://swp.dddgov.in/assets/department/labour/reforms_2.pdf</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_130.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration/Renewal of principal employer's establishment under provision of The Contracts Labour (Regulation and Abolition) Act, 1970<br>
                                            i.   Submission of application<br>
                                            ii.  Payment of application fee<br> 
                                            iii. Track status of application<br>    
                                            iv. Download the final signed certificate<br>
                                            v. Third party verification</td>
                                        <td><a href="https://labourddd.in/main#clact_form" target="_blank">https://labourddd.in/main#clact_form</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_131.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration/Renewal under The Building and Other Construction Workers (Regulation of Employment and Conditions of Service) Act, 1996<br>
                                            Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site
                                        </td>
                                        <td><a href="https://labourddd.in/login" target="_blank">https://labourddd.in/login</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_132.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration/Renewal under The Building and Other Construction Workers (Regulation of Employment and Conditions of Service) Act, 1996<br>
                                            Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application
                                        </td>
                                        <td><a href="https://swp.dddgov.in/assets/department/labour/reforms_2.pdf" target="_blank">https://swp.dddgov.in/assets/department/labour/reforms_2.pdf</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_133.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration/Renewal under The Building and Other Construction Workers (Regulation of Employment and Conditions of Service) Act, 1996<br>
                                            i.   Submission of application<br>
                                            ii.  Payment of application fee<br>
                                            iii. Track status of application<br>
                                            iv. Download the final signed certificate<br>
                                            v. Third party verification
                                        </td>
                                        <td><a href="https://labourddd.in/main#bocw_form" target="_blank">https://labourddd.in/main#bocw_form</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_134.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration of establishment under the Inter State Migrant Workmen (RE&CS) Act,1979<br>
                                            Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site	
                                        </td>        
                                        <td><a href="https://swp.dddgov.in/assets/department/labour/reforms_135_checklist.pdf" target="_blank">https://swp.dddgov.in/assets/department/labour/reforms_135_checklist.pdf</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_135.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration of establishment under the Inter State Migrant Workmen (RE&CS) Act,1979<br>
                                            Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application
                                        </td>           
                                        <td><a href="https://swp.dddgov.in/assets/department/labour/reforms_2.pdf" target="_blank">https://swp.dddgov.in/assets/department/labour/reforms_2.pdf</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_136.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Registration of establishment under the Inter State Migrant Workmen (RE&CS) Act,1979<br>
                                            i.   Submission of application<br>
                                            ii.  Payment of application fee<br>
                                            iii. Track status of application<br>
                                            iv. Download the final signed certificate<br>
                                            v. Third party verification
                                        </td>                   
                                        <td><a href="https://labourddd.in/main#migrantworkers" target="_blank">https://labourddd.in/main#migrantworkers</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_137.pdf">Click Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Renewal of establishment under the Inter State Migrant Workmen (RE&CS) Act, 1979<br>
                                        </td>   
                                        <td><a href="https://labourddd.in/login" target="_blank">https://labourddd.in/login</a></td>
                                        <td class="text-center">
                                            <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/labour/reform_138.pdf">Click Here</a>
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