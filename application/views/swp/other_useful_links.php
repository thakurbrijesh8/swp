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
                        <li class="breadcrumb-item">Other Useful Links</li>
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
                    <h2 class="text-grad">Other Useful Links</h2>
                    <h6 class="lh-15">On the basis of recommendation made by the DIPP, Government of India and Information provided by the concern departments regarding Time lines and Competent Authority for necessary Clearances/NOCs/Permissions/Renewals, Single Window Agency hereby notifies the following Services, the time frames within which these are to be provided to the citizens, Competent Authority and deemed approval authority as per schedule given below:</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:10%;">NO</th>
                                <th>ESSENTIAL & IMPORTANT SITES</th>
                                <th style="width:15%;">WEB / LINK FOR LOG ON</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"> 1 </td>
                                <td>PMEGP-ON LINE FILING FOR LOAN APPLICATION UNDER PMEGP(COMMON NATIONAL PORTAL) </td>
                                <td class="text-center"><a href="http://www.kviconline.gov.in" target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td class="text-center"> 2 </td>
                                <td>UDYOG AADHAAR MEMORANDUM-ON LINE FILING OF UDYOG AADHAAR FOR MSME-UA PORTAL(COMMON NATIONAL PORTAL) </td>
                                <td class="text-center"><a href="http://udyogaadhaar.gov.in" target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td class="text-center"> 3 </td>
                                <td>INDUSTRIAL ENTERPRENURES MEMIRANDUM-FOR NON MSME-LSI UNIT-e-BIZ PORTAL(COMMON NATIONAL PORTAL) </td>
                                <td class="text-center"><a href="https://services.dipp.gov.in" target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td class="text-center"> 4 </td>
                                <td>NATIONAL PORTAL FOR MSME(COMMON NATIONAL PORTAL)</td>
                                <td class="text-center"><a href="http://dcmsme.gov.in " target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td class="text-center"> 5 </td>
                                <td>DEPARTMENT OF INDUSTRIAL POLICY & PROMOTION(COMMON NATIONAL PORTAL) </td>
                                <td class="text-center"><a href="http://www.dipp.gov.in" target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td class="text-center"> 6 </td>
                                <td>ON LINE CONSENT MANAGEMENT & MONITORING SYSTEM(COMMON NATIONAL PORTAL) </td>
                                <td class="text-center"><a href="http://ddnocmms.nic.in " target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td class="text-center"> 7 </td>
                                <td>ON LINE GST REGISTRATION & PAYMENT OF TAXES(COMMON NATIONAL PORTAL) </td>
                                <td class="text-center"><a href="http://www.gst.gov.in" target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td class="text-center"> 8 </td>
                                <td>MSEFC FACILITATING COUNCIL FOR DELAYED PAYMENT OF MICRO AND SMALL INDUSTRIES </td>
                                <td class="text-center"><a href="https://samadhaan.msme.gov.in/MyMsme/MSEFC/MSEFC_welcome.aspx" target="_blank">Click Here</a></td>
                            </tr>
                            <tr>
                                <td class="text-center"> 9 </td>
                                <td>STARTUP LINK </td>
                                <td class="text-center"><a href="https://www.startupindia.gov.in" target="_blank">Click Here</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>