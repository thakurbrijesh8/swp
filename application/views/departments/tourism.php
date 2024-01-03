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
                        <li class="breadcrumb-item">Tourism Department</li>
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
                    <h2 class="text-grad">Tourism Department</h2>
                    <h6 class="lh-15">On the basis of recommendation made by the DIPP, Government of India and Information provided by the concern departments regarding Time lines and Competent Authority for necessary Clearances/NOCs/Permissions/Renewals, Single Window Agency hereby notifies the following Services, the time frames within which these are to be provided to the citizens, Competent Authority and deemed approval authority as per schedule given below:</h6>
                </div>
            </div>
        </div>
        <?php $this->load->view('departments_services/tourism'); ?>
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
                                <td>Hotel & Home stay/Bed & Breakfast registration Form</td>
                                <td>21 Days</td>
                                <td class="text-center">The Director (Tourism) - DNH & DD</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>login">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Hotel & Home stay/Bed & Breakfast registration Renewal Form</td>
                                <td>21 Days</td>
                                <td class="text-center">The Director (Tourism) - DNH & DD</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>login">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Travel Agent Registration Form</td>
                                <td>21 Days</td>
                                <td class="text-center">The Director (Tourism) - DNH & DD</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>login">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Travel Agency Form - Renewal</td>
                                <td>21 Days</td>
                                <td class="text-center">The Director (Tourism) - DNH & DD</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>login">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tourism Event - Performance</td>
                                <td>21 Days</td>
                                <td class="text-center">The Director (Tourism) - DNH & DD</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>login">Click Here</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<section class="pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:30%;">Name of Service</th>
                                <th style="width:30%;">URL</th>
                                <th style="width:10%;">Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hotels (Registration and Renewal)</td>
                                <td><a href="https://swp.dddgov.in/main#dept_services" target="_blank">https://swp.dddgov.in/main#dept_services</a></td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_57.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tourism Events- Performance License (Registration and Renewal)</td>
                                <td><a href="https://swp.dddgov.in/main#tourismevent" target="_blank">https://swp.dddgov.in/main#tourismevent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_59.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Registration of Hotels<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                <td><a href="https://swp.nicdemo.in/main#hotelregi" target="_blank">https://swp.nicdemo.in/main#hotelregi</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_274.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Registration of Hotels<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_275.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Registration of Hotels<br>
                                    i.   Submission of application</td>
                                <td><a href="https://swp.dddgov.in/login" target="_blank">https://swp.dddgov.in/login</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_276_1.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Registration of Hotels<br>
                                    ii. Payment of application fee</td>
                                <td><a href="https://swp.dddgov.in/login" target="_blank">https://swp.dddgov.in/login</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_276_2.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Registration of Hotels<br>
                                    iii. Track status of application</td>
                                <td><a href="https://swp.dddgov.in/login" target="_blank">https://swp.dddgov.in/login</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_276_3.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Registration of Hotels<br>
                                    iv. Download the final signed certificate</td>
                                <td><a href="https://swp.dddgov.in/login" target="_blank">https://swp.dddgov.in/login</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_276_4.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Registration of Hotels<br>
                                    v. Third party verification</td>
                                <td><a href="https://swp.dddgov.in/login" target="_blank">https://swp.dddgov.in/login</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_276_5.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Travel Agency<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                <td><a href="https://swp.dddgov.in/main#travelagent" target="_blank">https://swp.dddgov.in/main#travelagent</a></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td>Travel Agency<br>
                                        Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                <td></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td>Travel Agency<br>
                                    i.   Submission of application</td>
                                <td><a href="https://swp.dddgov.in/main#travelagent" target="_blank">https://swp.dddgov.in/main#travelagent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_280_1.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Travel Agency<br>
                                    ii. Payment of application fee</td>
                                <td><a href="https://swp.dddgov.in/main#travelagent" target="_blank">https://swp.dddgov.in/main#travelagent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_280_2.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Travel Agency<br>
                                    iii. Track status of application</td>
                                <td><a href="https://swp.dddgov.in/main#travelagent" target="_blank">https://swp.dddgov.in/main#travelagent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_280_3.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Travel Agency<br>
                                    iv. Download the final signed certificate</td>
                                <td><a href="https://swp.dddgov.in/main#travelagent" target="_blank">https://swp.dddgov.in/main#travelagent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_280_4.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Travel Agency<br>
                                    v. Third party verification</td>
                                <td><a href="https://swp.dddgov.in/main#travelagent" target="_blank">https://swp.dddgov.in/main#travelagent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_280_5.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tourism Events- Performance License<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                <td></td>
                                <td class="text-center">	
                                </td>
                            </tr>
                            <tr>
                                <td>Tourism Events- Performance License<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                <td></td>
                                <td class="text-center">	
                                </td>
                            </tr>
                            <tr>
                                <td>Tourism Events- Performance License<br>
                                    i.   Submission of application</td>
                                <td><a href="https://swp.dddgov.in/main#tourismevent" target="_blank">https://swp.dddgov.in/main#tourismevent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_284_1.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tourism Events- Performance License<br>
                                    ii. Payment of application fee</td>
                                <td><a href="https://swp.dddgov.in/main#tourismevent" target="_blank">https://swp.dddgov.in/main#tourismevent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_284_2.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tourism Events- Performance License<br>
                                    iii. Track status of application</td>
                                <td><a href="https://swp.dddgov.in/main#tourismevent" target="_blank">https://swp.dddgov.in/main#tourismevent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_284_3.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tourism Events- Performance License<br>
                                    iv. Download the final signed certificate</td>
                                <td><a href="https://swp.dddgov.in/main#tourismevent" target="_blank">https://swp.dddgov.in/main#tourismevent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_284_4.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tourism Events- Performance License<br>
                                    v. Third party verification</td>
                                <td><a href="https://swp.dddgov.in/main#tourismevent" target="_blank">https://swp.dddgov.in/main#tourismevent</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_284_5.png">Click Here</a>
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