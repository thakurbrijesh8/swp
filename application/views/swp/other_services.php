<?php $base_url = base_url(); ?>
<?php $this->load->view('new_common/header', array('base_url' => $base_url, 'swp' => 'active')); ?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Single Window</li>
                        <li class="breadcrumb-item">Departments & Services</li>
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
                    <h2 class="text-grad">Departments & Services</h2>
                    <h6 class="mb-0 mt-2 text-grad"><a href="assets/department/MANDATE-FOR-ONLINE-SUBMISSION-OF-APPLICATIONS.pdf" target="_blank"><i class="fa fa-download"></i> Click here to Download Circular regarding Online Submission of application for various clearances / approvals.</a></h6>
                    <h6 class="mb-0 mt-2 text-grad"><a href="assets/pdf/GoLive_Departments_Circular_29072024.pdf" target="_blank"><i class="fa fa-download"></i> * Services Online on NSWS Portal</a></h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-8">
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <input class="form-control" type="text" name="search" autofocus placeholder="Search" 
                           onkeyup="customizedTableSearch($(this), 'accordion_for_other_services');">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="accordion toggle-icon-round" id="accordion_for_other_services">
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-labour_emp">Labour & Employment</a>
                        </div>
                        <div class="collapse" id="collapse-labour_emp" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/labour'); ?>
                                <!-- <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:50%;">Name of Services</th>
                                <th class="v-a-m" style="width:10%;">District</th>
                                <th class="v-a-m" style="width:30%;">URL</th>
                                <th class="v-a-m" style="width:10%;">DOCUMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                                <br/>
                                i. Legal Basis - Does it have a basis in law/act/policy.
                                <br/>
                                ii. Necessity - Does the license help government achieve its objectives.
                                <br/>
                                iii. Business-friendly - Does it impose minimum burden on businesses to achieve the government’s objectives.</td>
                                 <td class="text-center">Daman</td>
                                <td class="text-left"></td>
                                <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>assets/department/swp_dept_services/reforms_3_lae.pdf">Click Here</a>
                                </td>
                            </tr>                                                        
                        </tbody>
                    </table>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-dic">* District Industries Center</a>
                        </div>
                        <div class="collapse" id="collapse-dic" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/dic'); ?>
                                <!-- <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:50%;">Name of Services</th>
                                <th class="v-a-m" style="width:10%;">District</th>
                                <th class="v-a-m" style="width:30%;">URL</th>
                                <th class="v-a-m" style="width:10%;">DOCUMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                                <br/>
                                i. Legal Basis - Does it have a basis in law/act/policy.
                                <br/>
                                ii. Necessity - Does the license help government achieve its objectives.
                                <br/>
                                iii. Business-friendly - Does it impose minimum burden on businesses to achieve the government’s objectives.</td>
                                 <td class="text-center">Daman</td>
                                <td class="text-left"></td>
                                <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>assets/department/swp_dept_services/reforms_3_dicd.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                                <br/>
                                i. Legal Basis - Does it have a basis in law/act/policy.
                                <br/>
                                ii. Necessity - Does the license help government achieve its objectives.
                                <br/>
                                iii. Business-friendly - Does it impose minimum burden on businesses to achieve the government’s objectives.</td>
                                 <td class="text-center">DNH</td>
                                <td class="text-left">
                                    <a target="_blank" href="www.//dicddd.in">www.//dicddd.in</a>
                                </td>
                                <td class="text-center">
                                <a target="_blank" href="<?= base_url(); ?>assets/department/swp_dept_services/reforms_3_dicd.pdf">Click Here</a>
                                </td>
                            </tr>                                                        
                        </tbody>
                    </table>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-pcc">Pollution Control Committee</a>
                        </div>
                        <div class="collapse" id="collapse-pcc" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/pcc'); ?>
                                <!--<div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th style="width:35%;">Name of Service</th>
                                                <th style="width:15%;">Timeline (Working Days)</th>
                                                <th style="width:20%;">Competent Authority </th>
                                                <th style="width:10%;">Apply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Consent to establish (under Water / Air Act)</td>
                                                <td class="text-center">90 Days</td>
                                                <td class="text-center">Member Secretary (PCC)</td>
                                                <td class="text-center"><a href="http://ddnocmms.nic.in/" target="_blank">Click Here</a></td>
                                            </tr>
                                            <tr>
                                                <td>Consent to operate & Common consent authorization   (under Water / Air Act)</td>
                                                <td class="text-center">90 Days</td>
                                                <td class="text-center">Member Secretary (PCC)</td>
                                                <td class="text-center"><a href="http://ddnocmms.nic.in/" target="_blank">Click Here</a></td>
                                            </tr>
                                            <tr>
                                                <td>Renewal of "Consent to Operate" (under Water / Air Act) </td>
                                                <td class="text-center">90 Days</td>
                                                <td class="text-center">Member Secretary (PCC)</td>
                                                <td class="text-center"><a href="http://ddnocmms.nic.in/" target="_blank">Click Here</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>-->
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-fb">Factories & Boilers</a>
                        </div>
                        <div class="collapse" id="collapse-fb" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <div class="accordion-content">
                                    <?php $this->load->view('departments_services/fb'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-revenue">Collectorates</a>
                        </div>
                        <div class="collapse" id="collapse-revenue" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <div class="table-responsive">
                                    <?php $this->load->view('departments_services/collector'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-fire">Fire & Emergency Services</a>
                        </div>
                        <div class="collapse" id="collapse-fire" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/fire'); ?>
                                <!--<div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th style="width:30%;">Name of Service</th>
                                                <th style="width:15%;">Timeline (Working Days)</th>
                                                <th style="width:25%;">Competent Authority </th>
                                                <th style="width:10%;">Apply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Provisional Fire NOC</td>
                                                <td class="text-center">30 Days</td>
                                                <td>DIGP/Director, Fire & Emergency Services</td>
                                                <td class="text-center">
                                                    <a target="_blank" href="http://eservices.ddfes.in/ApplicantVerification/?TYPE=Provisional"> Click Here</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Final Fire NOC</td>
                                                <td class="text-center">28 Days</td>
                                                <td>DIGP/Director, Fire & Emergency Services</td>
                                                <td class="text-center">
                                                    <a target="_blank" href="http://eservices.ddfes.in/ApplicantVerification/?TYPE=Final"> Click Here</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Renewal Fire NOC</td>
                                                <td class="text-center">28 Days</td>
                                                <td>DIGP/Director, Fire & Emergency Services</td>
                                                <td class="text-center">
                                                    <a target="_blank" href="http://eservices.ddfes.in/ApplicantVerification/?TYPE=Renewal"> Click Here</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>-->
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-wm">Legal Metrology (Weights & Measures)</a>
                        </div>
                        <div class="collapse" id="collapse-wm" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/wm'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-electricity">Electricity Department</a>
                        </div>
                        <div class="collapse" id="collapse-electricity" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/electricity'); ?>
                                <!--<div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th style="width:30%;">Name of Service</th>
                                                <th style="width:15%;">Timeline (Working Days)</th>
                                                <th style="width:25%;">Competent Authority </th>
                                                <th style="width:10%;">Apply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Issue of New Electricity Connection
                                                    <br> a) Temporary connection
                                                    <br> b) LT connection
                                                    <br> c) HT connection
                                                    <br>
                                                </td>
                                                <td class="text-center">
                                                    15 Days
                                                    <br> 45 Days
                                                    <br> 45 Days
                                                    <br>
                                                </td>
                                                <td>Assistant Engineer/ Executive Engineer</td>
                                                <td class="text-center">
                                                    <a href="https://oims.dded.gov.in/OnlineServices.v2" target="_blank">Click Here</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>-->
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-pwd">PWD - Daman & Diu</a>
                        </div>
                        <div class="collapse" id="collapse-pwd" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/pwd'); ?>
                                <!--<div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th style="width:30%;">Name of Service</th>
                                                <th style="width:15%;">Timeline (Working Days)</th>
                                                <th style="width:25%;">Competent Authority </th>
                                                <th style="width:10%;">Apply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Water Connection</td>
                                                <td class="text-center">07 Days</td>
                                                <td>Assistant Engineer, Sub-Div-I, PWD</td>
                                                <td class="text-center">
                                                    <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>-->
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-tourism">* Tourism Department</a>
                        </div>
                        <div class="collapse" id="collapse-tourism" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/tourism'); ?>
                                <!-- <div class="table-responsive">
                                     <table class="table p-04 table-hover">
                                         <thead class="all-text-white bg-grad">
                                             <tr class="text-center">
                                                 <th style="width:30%;">Name of Service</th>
                                                 <th style="width:15%;">Timeline (Working Days)</th>
                                                 <th style="width:25%;">Competent Authority </th>
                                                 <th style="width:10%;">Apply</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td>Hotel Registration Form</td>
                                                 <td class="text-center"></td>
                                                 <td></td>
                                                 <td class="text-center">
                                                     <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>Hotel Registration Form - Renewal</td>
                                                 <td class="text-center"></td>
                                                 <td></td>
                                                 <td class="text-center">
                                                     <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>Travel Agent Registration Form</td>
                                                 <td class="text-center"></td>
                                                 <td></td>
                                                 <td class="text-center">
                                                     <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>Travel Agency Form - Renewal</td>
                                                 <td class="text-center"></td>
                                                 <td></td>
                                                 <td class="text-center">
                                                     <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>Tourism Event - Performance</td>
                                                 <td class="text-center"></td>
                                                 <td></td>
                                                 <td class="text-center">
                                                     <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-crsr">Revenue Department</a>
                        </div>
                        <div class="collapse" id="collapse-crsr" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/civil_cum'); ?>
                                <!-- <div class="table-responsive">
                                    <table class="table p-04 table-hover">
                                        <thead class="all-text-white bg-grad">
                                            <tr class="text-center">
                                                <th style="width:30%;">Name of Service</th>
                                                <th style="width:15%;">Timeline (Working Days)</th>
                                                <th style="width:25%;">Competent Authority </th>
                                                <th style="width:10%;">Apply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Partnership Firms Registration</td>
                                                <td class="text-center"></td>
                                                <td></td>
                                                <td class="text-center">
                                                    <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Property Registration</td>
                                                <td class="text-center"></td>
                                                <td></td>
                                                <td class="text-center">
                                                    <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> -->
                                <!-- <div class="table-responsive">
                                   <table class="table p-04 table-hover">
                       <thead class="all-text-white bg-grad">
                           <tr class="text-center">
                               <th class="v-a-m" style="width:50%;">Name of Services</th>
                               <th class="v-a-m" style="width:10%;">District</th>
                               <th class="v-a-m" style="width:30%;">URL</th>
                               <th class="v-a-m" style="width:10%;">DOCUMENT</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                               <br/>
                               i. Legal Basis - Does it have a basis in law/act/policy.
                               <br/>
                               ii. Necessity - Does the license help government achieve its objectives.
                               <br/>
                               iii. Business-friendly - Does it impose minimum burden on businesses to achieve the government’s objectives.</td>
                                <td class="text-center">Daman</td>
                               <td class="text-left">
                                   <a target="_blank" href="https://daman.nic.in/civil-registrar-cum-sub-registrar.aspx">
                                   https://daman.nic.in/civil-registrar-cum-sub-registrar.aspx</a>
                                                   <br/><a target="_blank" href="https://daman.nic.in/websites/Civil-Registrar/2020/Reform_No.3.pdf">
                                                   https://daman.nic.in/websites/Civil-Registrar/2020/Reform_No.3.pdf</a>
                               </td>
                               <td class="text-center">
                               <a target="_blank" href="<?= base_url(); ?>assets/department/swp_dept_services/reforms_3_srdaman.pdf">Click Here</a>
                               </td>
                           </tr>                                                        
                       </tbody>
                   </table>
                               </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-pda">Planning & Development Authority</a>
                        </div>
                        <div class="collapse" id="collapse-pda" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/pda'); ?>
                            </div>
                        </div>
                    </div> 

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-excise_dnhdd">* Excise Department</a>
                        </div>
                        <div class="collapse" id="collapse-excise_dnhdd" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/excise_dnhdd'); ?>

                                <!--<div class="table-responsive">
                                   <table class="table p-04 table-hover">
                       <thead class="all-text-white bg-grad">
                           <tr class="text-center">
                               <th class="v-a-m" style="width:50%;">Name of Services</th>
                               <th class="v-a-m" style="width:10%;">District</th>
                               <th class="v-a-m" style="width:30%;">URL</th>
                               <th class="v-a-m" style="width:10%;">DOCUMENT</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                               <br/>
                               i. Legal Basis - Does it have a basis in law/act/policy.
                               <br/>
                               ii. Necessity - Does the license help government achieve its objectives.
                               <br/>
                               iii. Business-friendly - Does it impose minimum burden on businesses to achieve the government’s objectives.</td>
                                <td class="text-center">Daman</td>
                               <td class="text-left">
                                   <a target="_blank" href="https://ddnexcise.gov.in/Downloads/Act.pdf  ">
                                   https://ddnexcise.gov.in/Downloads/Act.pdf  </a>
                               </td>
                               <td class="text-center">
                               <a target="_blank" href="<?= base_url(); ?>assets/department/swp_dept_services/reforms_3_excise.pdf">Click Here</a>
                               </td>
                           </tr>                                                        
                       </tbody>
                   </table>
                               </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-municipal_council_dnhdd">Municipal Councils</a>
                        </div>
                        <div class="collapse" id="collapse-municipal_council_dnhdd" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/municipal_council_dnhdd'); ?>

                                <!--<div class="table-responsive">
                                   <table class="table p-04 table-hover">
                       <thead class="all-text-white bg-grad">
                           <tr class="text-center">
                               <th class="v-a-m" style="width:50%;">Name of Services</th>
                               <th class="v-a-m" style="width:10%;">District</th>
                               <th class="v-a-m" style="width:30%;">URL</th>
                               <th class="v-a-m" style="width:10%;">DOCUMENT</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                               <br/>
                               i. Legal Basis - Does it have a basis in law/act/policy.
                               <br/>
                               ii. Necessity - Does the license help government achieve its objectives.
                               <br/>
                               iii. Business-friendly - Does it impose minimum burden on businesses to achieve the government’s objectives.</td>
                                <td class="text-center">Daman</td>
                               <td class="text-left">
                                   <a target="_blank" href="https://ddnexcise.gov.in/Downloads/Act.pdf  ">
                                   https://ddnexcise.gov.in/Downloads/Act.pdf  </a>
                               </td>
                               <td class="text-center">
                               <a target="_blank" href="<?= base_url(); ?>assets/department/swp_dept_services/reforms_3_excise.pdf">Click Here</a>
                               </td>
                           </tr>                                                        
                       </tbody>
                   </table>
                               </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-vat_dept">VAT & GST</a>
                        </div>
                        <div class="collapse" id="collapse-vat_dept" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">  
                                <?php $this->load->view('departments_services/vat_dept'); ?>                             
                                <!--  <div class="table-responsive">
                                     <table class="table p-04 table-hover">
                         <thead class="all-text-white bg-grad">
                             <tr class="text-center">
                                 <th class="v-a-m" style="width:50%;">Name of Services</th>
                                 <th class="v-a-m" style="width:10%;">District</th>
                                 <th class="v-a-m" style="width:30%;">URL</th>
                                 <th class="v-a-m" style="width:10%;">DOCUMENT</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                                 <br/>
                                 i. Legal Basis - Does it have a basis in law/act/policy.
                                </td>
                                  <td class="text-center">Daman</td>
                                 <td class="text-left">
                                     <a target="_blank" href="https://www.cbic.gov.in/htdocs-cbec/gst/index">
                                     https://www.cbic.gov.in/htdocs-cbec/gst/index</a>
                                 </td>
                                 <td class="text-center">
                                 <a target="_blank" href="<?= base_url(); ?>assets/department/gst/reforms_3_gst1.pdf">Click Here</a>
                                 </td>
                             </tr> 
                             <tr>
                                 <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                                 <br/>
                                 ii. Necessity - Does the license help government achieve its objectives.
                                 </td>
                                  <td class="text-center">Daman</td>
                                 <td class="text-left">
                                     <a target="_blank" href="https://www.cbic.gov.in/htdocs-cbec/gst/index">
                                     https://www.cbic.gov.in/htdocs-cbec/gst/index</a>
                                     <br />
                                     <a target="_blank" href="https://www.gst.gov.in/help/helpmodules/">
                                     https://www.gst.gov.in/help/helpmodules/</a>
                                 </td>
                                 <td class="text-center">
                                 <a target="_blank" href="<?= base_url(); ?>assets/department/gst/reforms_3_gst2.jpg">Click Here</a>
                                 </td>
                             </tr> 
                             <tr>
                                 <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                                <br/>
                                 iii. Business-friendly - Does it impose minimum burden on businesses to achieve the government’s objectives.</td>
                                  <td class="text-center">Daman</td>
                                 <td class="text-left">
                                     <a target="_blank" href="https://www.cbic.gov.in/htdocs-cbec/gst/index">
                                     https://www.cbic.gov.in/htdocs-cbec/gst/index</a>
                                     <br />
                                     <a target="_blank" href="https://www.gst.gov.in/help/helpmodules/">
                                     https://www.gst.gov.in/help/helpmodules/</a>
                                 </td>
                                 <td class="text-center">
                                 <a target="_blank" href="<?= base_url(); ?>assets/department/gst/reforms_3_gst3.jpg">Click Here</a>
                                 </td>
                             </tr>                                                        
                         </tbody>
                     </table>
                                 </div>-->
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-drugs-control">Drugs Control Department</a>
                        </div>
                        <div class="collapse" id="collapse-drugs-control" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">  
                                <?php $this->load->view('departments_services/drugs_control'); ?>                             
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-society-registration">* Societies Registration</a>
                        </div>
                        <div class="collapse" id="collapse-society-registration" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/societies_registration'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-panchayat">District Panchayats</a>
                        </div>
                        <div class="collapse" id="collapse-panchayat" data-parent="#accordion_for_other_services">
                            <div class="accordion-content">
                                <?php $this->load->view('departments_services/dist_panchayat'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <div class="accordion-title">
                            <a class="h6 mb-0 collapsed" data-toggle="collapse" href="#collapse-panchayat">District Panchayats</a>
                        </div>
                        <div class="collapse" id="collapse-panchayat" data-parent="#accordion_for_other_services">
                            <div class="accordion-content"> 
                                <?php $this->load->view('departments_services/dist_panchayat'); ?>                              
                                <!--<div class="table-responsive">
                                   <table class="table p-04 table-hover">
                       <thead class="all-text-white bg-grad">
                           <tr class="text-center">
                               <th class="v-a-m" style="width:50%;">Name of Services</th>
                               <th class="v-a-m" style="width:10%;">District</th>
                               <th class="v-a-m" style="width:30%;">URL</th>
                               <th class="v-a-m" style="width:10%;">DOCUMENT</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                               <br/>
                               i. Legal Basis - Does it have a basis in law/act/policy.
                              </td>
                                <td class="text-center">Daman</td>
                               <td class="text-left">
                                   <a target="_blank" href="https://daman.nic.in/websites/district_panchayat_Daman/documents/2020/1156-24-12-2020.pdf">
                                   https://daman.nic.in/websites/district_panchayat_Daman/documents/2020/1156-24-12-2020.pdf</a>
                               </td>
                               <td class="text-center">
                               <a target="_blank" href="<?= base_url(); ?>assets/department/panchayat/reforms_3_panchayat1.pdf">Click Here</a>
                               </td>
                           </tr> 
                           <tr>
                               <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                               <br/>
                               ii. Necessity - Does the license help government achieve its objectives.
                               </td>
                                <td class="text-center">Daman</td>
                               <td class="text-left">
                                   <a target="_blank" href="https://daman.nic.in/websites/district_panchayat_Daman/documents/2020/1156-24-12-2020.pdf">
                                   https://daman.nic.in/websites/district_panchayat_Daman/documents/2020/1156-24-12-2020.pdf</a>
                               </td>
                               <td class="text-center">
                               <a target="_blank" href="<?= base_url(); ?>assets/department/panchayat/reforms_3_panchayat1.pdf">Click Here</a>
                                       </td>
                                   </tr> 
                                   <tr>
                                       <td class="text-left">    Mandate that each proposed regulation or license (before it is enacted) ensure coverage of following criteria displayed on the website : 
                                      <br/>
                                       iii. Business-friendly - Does it impose minimum burden on businesses to achieve the government’s objectives.</td>
                                        <td class="text-center">Daman</td>
                                       <td class="text-left">
                                          <a target="_blank" href="https://daman.nic.in/websites/district_panchayat_Daman/documents/2020/1156-24-12-2020.pdf">
                                           https://daman.nic.in/websites/district_panchayat_Daman/documents/2020/1156-24-12-2020.pdf</a>
                                       </td>
                                       <td class="text-center">
                                       <a target="_blank" href="<?= base_url(); ?>assets/department/panchayat/reforms_3_panchayat1.pdf">Click Here</a>
                                       </td>
                                   </tr>                                                        
                               </tbody>
                           </table>
                                       </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>