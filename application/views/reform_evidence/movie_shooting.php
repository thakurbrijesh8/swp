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
                        <li class="breadcrumb-item">Movie Shooting</li>
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
                    <h2 class="fs-30px text-grad">Movie Shooting</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<section class="pt-0 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 md-6">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:30%;">Name of Service</th>
                                <th style="width:20%;">District</th>
                                <th style="width:30%;">URL</th>
                                <th style="width:10%;">Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> Movie Shooting<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_258_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                <td>DNH</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/collector/reform_258_DNH.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site</td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_258_DIU.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_259_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                <td>DNH</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/collector/reform_259_DNH.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application</td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_259_DIU.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting<br>
                                    i. Online submission of application<br>
                                    ii. Online payment of application fee<br>
                                    iii. Allow applicant to track status of application online<br>
                                    iv.  Applicant can download the final signed certificate online<br>
                                    v. Allow third party verification
                                </td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_260_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting<br>
                                    i. Online submission of application<br>
                                    ii. Online payment of application fee<br>
                                    iii. Allow applicant to track status of application online<br>
                                    iv.  Applicant can download the final signed certificate online<br>
                                    v. Allow third party verification
                                </td>
                                <td>DNH</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_260_DNH.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting<br>
                                    i. Online submission of application<br>
                                    ii. Online payment of application fee<br>
                                    iii. Allow applicant to track status of application online<br>
                                    iv.  Applicant can download the final signed certificate online<br>
                                    v. Allow third party verification
                                </td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_260_DIU.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - State Protected Monument<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site
                                </td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_266_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - State Protected Monument<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site
                                </td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_266_DIU.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - State Protected Monument<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application
                                </td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_267_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - State Protected Monument<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application
                                </td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_267_DIU.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - State Protected Monument<br>
                                    i.   Submission of application<br>
                                    ii.  Payment of application fee<br>
                                    iii. Track status of application<br>
                                    iv. Download the final signed certificate<br>
                                    v. Third party verification
                                </td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_268_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - State Protected Monument<br>
                                    i.   Submission of application<br>
                                    ii.  Payment of application fee<br>
                                    iii. Track status of application<br>
                                    iv. Download the final signed certificate<br>
                                    v. Third party verification
                                </td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_268_DIU.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - State Protected Monument<br>
                                    Publish an online dashboard available in public domain updated regularly (weekly/fortnightly/monthly) 
                                    for registrations and renewals. The dashboard should clearly highlight the registrations done and the time taken (Mean/ Median)
                                </td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_269_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - State Protected Monument<br>
                                    Publish an online dashboard available in public domain updated regularly (weekly/fortnightly/monthly) 
                                    for registrations and renewals. The dashboard should clearly highlight the registrations done and the time taken (Mean/ Median)
                                </td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_269_DIU.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - Permission from District Collector<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site
                                </td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_270_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - Permission from District Collector<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site
                                </td>
                                <td>DNH</td>
                                <td><a href="https://swp.dddgov.in" target="_blank">https://swp.dddgov.in</a></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_270_DNH.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - Permission from District Collector<br>
                                    Ensure information on fees, procedure and a comprehensive list of all documents that need to be provided are available on the web site
                                </td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_270_DIU.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - Permission from District Collector<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application
                                </td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_270_DIU.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - Permission from District Collector<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application
                                </td>
                                <td>DNH</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_271_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td> Movie Shooting - Permission from District Collector<br>
                                    Define clear timelines mandated through the Public Service Delivery Guarantee Act (or equivalent) legislation for approval of complete application
                                </td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_271_DNH.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>    
                                <td> Movie Shooting - Permission from District Collector<br>
                                    i.   Submission of application<br>
                                    ii.  Payment of application fee<br>
                                    iii. Track status of application<br>
                                    iv. Download the final signed certificate<br>
                                    v. Third party verification
                                </td>
                                <td>Daman</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_272_DMN.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>    
                                <td> Movie Shooting - Permission from District Collector<br>
                                    i.   Submission of application<br>
                                    ii.  Payment of application fee<br>
                                    iii. Track status of application<br>
                                    iv. Download the final signed certificate<br>
                                    v. Third party verification
                                </td>
                                <td>DNH</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_272_DNH.png">Click Here</a>
                                </td>
                            </tr>
                            <tr>    
                                <td> Movie Shooting - Permission from District Collector<br>
                                    i.   Submission of application<br>
                                    ii.  Payment of application fee<br>
                                    iii. Track status of application<br>
                                    iv. Download the final signed certificate<br>
                                    v. Third party verification
                                </td>
                                <td>Diu</td>
                                <td></td>
                                <td class="text-center">	
                                    <a class="nav-link" target="_blank" href="<?php echo $base_url; ?>assets/department/tourism/reform_272_DIU.png">Click Here</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>-->
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>