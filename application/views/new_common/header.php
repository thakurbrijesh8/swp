<!doctype html>
<html lang="en">
    <head>
        <title>EODB Single Window Portal : Dadra and Nagar Haveli and Daman and Diu</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="EODB Single Window Portal : Dadra and Nagar Haveli and Daman and Diu">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <?php $this->load->view('new_common/css_links', array('base_url' => $base_url, 'all_css_and_js' => TRUE)); ?>
    </head>
    <body>
        <?php $this->load->view('new_common/loader', array('base_url' => $base_url)); ?>
        <header class="header-static navbar-sticky navbar-light">
            <?php $this->load->view('new_common/top_line', array('base_url' => $base_url)); ?>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <?php $this->load->view('new_common/logo', array('base_url' => $base_url)); ?>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg bg-grad">
                <div class="container">
                    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"> </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav">
                            <li class="nav-item <?php echo isset($home) ? $home : ''; ?>">
                                <a class="nav-link" href="<?php echo $base_url; ?>home">Home</a>
                            </li>
                            <li class="nav-item <?php echo isset($about_us) ? $about_us : ''; ?>">
                                <a class="nav-link" href="<?php echo $base_url; ?>about_us" style="text-transform: none;">About Us</a>
                            </li>
                            <li class="nav-item <?php echo isset($about_dd) ? $about_dd : ''; ?>">
                                <a class="nav-link" href="<?php echo $base_url; ?>about_dd" style="text-transform: none;">About DNH & DD</a>
                            </li>
                            <li class="nav-item <?php echo isset($invest_dd) ? $invest_dd : ''; ?>">
                                <a class="nav-link" href="<?php echo $base_url; ?>invest_dd" style="text-transform: none;">Why Invest in DNH & DD</a>
                            </li>
                            <li class="nav-item dropdown megamenu <?php echo isset($departments) ? $departments : ''; ?>">
                                <a class="nav-link dropdown-toggle" href="#" id="departments" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Departments</a>
                                <div class="dropdown-menu" aria-labelledby="departments" style="">
                                    <div class="container">
                                        <div class="row w-100">
                                            <div class="col-sm-6 col-lg-3">
                                                <ul class="list-unstyled">
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>departments-and-services">All Departments</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row w-100">
                                            <div class="col-sm-6 col-lg-3">
                                                <ul class="list-unstyled">
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>collectorate-dnhdd">Collectorates</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>district-industries-center-dnhdd">District Industries Center</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>district-panchayat-dnhdd">District Panchayats</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>drugs-control-department-dnhdd">Drugs Control Department</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>electricity-department-dnhdd">Electricity Department</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>excise-department-dnhdd">Excise Department</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 col-lg-3">
                                                <ul class="list-unstyled">
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>factories-and-boilers-dnhdd">Factories & Boilers</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>fire-and-emergency-services-dnhdd">Fire & Emergency Services</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>labour-and-employment-dnhdd">Labour & Employment</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>legal-metrology-weights-and-measures-dnhdd">Legal Metrology (Weights & Measures)</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>municipal-councils-dnhdd">Municipal Councils</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>pollution-control-committee-dnhdd">Pollution Control Committee</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 col-lg-3">
                                                <ul class="list-unstyled">
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>planning-and-development-authority-dnhdd">Planning & Development Authority</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>public-works-department-dd">PWD - Daman & Diu</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>revenue-dnhdd">Revenue Department</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>societies-registration-dnhdd">Societies Registration</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>tourism-department-dnhdd">Tourism Department</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>vat-and-gst-dnhdd">VAT & GST</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 col-lg-3">
                                                <ul class="list-unstyled">
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>other-services-dnhdd">Other Services</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>other-taxes-and-levies-dnhdd">Other Taxes & Levies</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>uniform-building-code-dnhdd">Uniform Building Code</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>inspections-dnhdd">Inspections</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>trade-license-dnhdd">Trade License</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>contract-enforcement-dnhdd">Contract Enforcement</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown <?php echo isset($swp) ? $swp : ''; ?>">
                                <a class="nav-link dropdown-toggle" href="Javascript:void(0);" id="swp" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Single Window</a>
                                <ul class="dropdown-menu" aria-labelledby="swp">
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>investor-facilitation-centre-dnhdd">Investor Facilitation Center</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>know-your-clearances">Know Your Clearances</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>information-wizard">Information Wizard</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>transport-wizard">Transport Wizard</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>integrate-land-property-portal">Integrate Land / Property Portal</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>departments-and-services">Departments & Services</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>land-allotment-dnhdd">Land Allotment</a></li>
                                    <!--<li><a class="dropdown-item" href="<?php echo $base_url; ?>swp_ls">List of Services</a></li>-->
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>samay-sudhini-seva">Time Bound Delivery of Services</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>incentives-dnhdd">Incentives</a></li>
                                    <!--<li><a class="dropdown-item" href="<?php echo $base_url; ?>basic-required-clearances-backup">Required Clearances</a></li>-->
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>everify">Third Party Verification</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>swp_other_useful_links">Other Useful Links</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown <?php echo isset($help) ? $help : ''; ?>">
                                <a class="nav-link dropdown-toggle" href="Javascript:void(0);" id="helpmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Help</a>
                                <ul class="dropdown-menu" aria-labelledby="helpmenu">
                                    <!--<li><a class="dropdown-item" href="<?php echo $base_url; ?>assets/GuidelineofInvestDDInvestor.pdf" target="_blank">Investor's Guide</a></li>-->
                                    <!--<li><a class="dropdown-item" href="<?php echo $base_url; ?>assets/ProcurementGuidelines.pdf" target="_blank">Guidelines for Procurement and Marketing Support <br>Scheme (Revised on 20.11.2019)</a></li>-->
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>assets/InvestorFacilittionCentreProcedure.pdf" target="_blank">Working Procedure of Investor Facilitation Centre</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>grievance">Query / Grievance Redressal</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>track_query_grievance">Track Query/Grievance Redressal</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>comments-feedback-on-regulation">Comments / Feedback on Regulation</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>assets/CONTACTUS.pdf" target="_blank">Contact Us</a></li>
                                </ul>
                            </li>
                            <li class="nav-item <?php echo isset($dashboard) ? $dashboard : ''; ?>">
                                <a class="nav-link" href="<?php echo $base_url; ?>dashboard" style="text-transform: none;">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $base_url; ?>login">Login / Registration</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>