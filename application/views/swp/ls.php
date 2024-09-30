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
                        <li class="breadcrumb-item">List of Services</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-8">
                <div class="title text-left pb-0">
                    <h2 class="text-grad">List of Services</h2>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <input class="form-control" type="text" name="search" autofocus placeholder="Search" 
                           onkeyup="customizedTableSearch($(this), 'ls_body_container');">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr>
                                <th style="width:25%;">Departments</th>
                                <th>Clearances</th>
                            </tr>
                        </thead>
                        <tbody id="ls_body_container">
                            <tr class="accordion-item">
                                <td>Pollution Control Committee</td>
                                <td>
                                    <ul>
                                        <li>Consent to Establish under the Water (Prevention and Control of Pollution) Act 1974, Air (Prevention and Control of Pollution) Act, 1981 and DG Set Approval.</li>
                                        <li>
                                            Consolidated Consent and Authorization – New/Renewal under the Water
                                            (Prevention and Control of Pollution) Act 1974 and Air (Prevention and Control
                                            of Pollution) Act 1981 and Hazardous and other wastes management and
                                            Trance boundary Rule, 2016 (Consent to Operate / Renewal)
                                            <br>
                                            <span class="text-danger">
                                                (Note : The above consented DG Set is permitted for standby arrangement only and not as a captive power generation unit.)
                                            </span>
                                        </li>
                                        <li>Renewal of "Consent to Operate" (under Water / Air Act)</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>Department of labour  Employment</td>
                                <td>
                                    <ul>
                                        <li>Registration under "Shops & Establishment Act"</li>
                                        <li>Renewal under "Shops and Establishment Act"</li>
                                        <li>Registration / Renewal under "The Building and Other Construction Workers (Regulation of Employment Conditions of Service
                                            Act), 1996"</li>
                                        <li>Registration Certificate of "Establishment Inter State Migrant Workmen (RE&CS) Act, 1979 (License of Contractor Establishment)"</li>
                                        <li>Renewal Certificate of "Establishment Inter State Migrant Workmen (RE&CS) Act, 1979 (License of Contractor Establishment)"</li>
                                        <li>Registration / Renewal of principal employer's establishment under provision of The Contracts Labour (Regulation and Abolition) Act, 1970</li>
                                        <li>License for Contractors under provision of The Contracts Labour (R & A) Act,1970</li>
                                        <li>Renewal License for Contractors under provision of The Contracts Labour (R & A) Act,1970</li>
                                        <li>Single Annual Return form</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>Directorate Factories  Boiler</td>
                                <td>
                                    <ul>
                                        <li>Registration of license under The Factories Act, 1948</li>
                                        <li>Renewal of license under The Factories Act, 1948</li>
                                        <li>Approval of plan and permission to construct/extend/or take into use any building as a factory under the Factories Act, 1948</li>
                                        <li>Registration of Boilers under The Boilers Act, 1923</li>
                                        <li>Renewal of Boilers under The Boilers Act, 1923</li>
                                        <li>Registration / Renewal of Boilers Manufactures under The Boilers Act, 1923</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>Collectorate</td>
                                <td>
                                    <ul>
                                        <li>NA Application Form / Change in Land Use</li>
                                        <li>
                                            Application of Licenses under rule 11 of the Dadra and Nagar Haveli & Daman and Diu Cinema (Regulation of Exibition by Video.) Rules, 1985 / Application for registration under Cinema Regulation for Cinema Halls.
                                            <br>
                                            (Registration and Renewal)
                                        </li>
                                        <li>Film Shooting Permission(s) Form</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>Department of Fire  Emergency Services</td>
                                <td>
                                    <ul>
                                        <li>Provisional Fire NOC</li>
                                        <li>Final Fire NOC</li>
                                        <li>Renewal Fire NOC</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>Department of Weights & Measure</td>
                                <td>
                                    <ul>
                                        <li>Registration Under "Weights & Measure"</li>
                                        <li>Registration under "License for Repairer"</li>
                                        <li>Renewal under "License for Repairer"</li>
                                        <li>Registration under "License for Dealer"</li>
                                        <li>Renewal under "License for Dealer"</li>
                                        <li>Registration under "License for Manufacturer"</li>
                                        <li>Renewal under "License for Manufacturer"</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>Electricity Department</td>
                                <td>
                                    <ul>
                                        <li>
                                            Issue of New Electricity Connection
                                            <ul class="ml-4" style="list-style: upper-alpha">
                                                <li>Temporary connection</li>
                                                <li>LT connection</li>
                                                <li>HT connection</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>Public Works Department (PWD)</td>
                                <td>
                                    <ul>
                                        <li>Water Connection or Certificate of Non-Availability of Water</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>District Industries Centre</td>
                                <td>
                                    <ul>
                                        <li>Incentives under Investment Promotion Scheme - 2015 for Textile Sector</li>
                                        <li>Incentives under Investment Promotion Scheme - 2015 for MSME</li>
                                        <li>Allotment of land in Industrial Area</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>Tourism</td>
                                <td>
                                    <ul>
                                        <li>Hotel Registration Form</li>
                                        <li>Hotel Registration Form - Renewal</li>
                                        <li>Travel Agency Registration Form</li>
                                        <li>Travel Agency Form - Renewal</li>
                                        <li>Tourism Event - Performance</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>Civil Registrar Cum Sub Registrar (CRSR)</td>
                                <td>
                                    <ul>
                                        <li>Partnership Firms Registration</li>
                                        <li>Property Registration</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="accordion-item">
                                <td>PDA</td>
                                <td>
                                    <ul>
                                        <li>Construction Permission / Building Plan Approval</li>
                                        <li>Occupancy Certificate / Part Occupancy Certificate</li>
                                        <li>Application for Inspection at Plinth level</li>
                                        <!--  <li>Site Elevation</li>
                                         <li>Zone Information</li> -->
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>