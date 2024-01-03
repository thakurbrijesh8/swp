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
                        <li class="breadcrumb-item">GST</li>
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
                    <h2 class="fs-30px text-grad">GST</h2>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:30%;">Name of Service</th>
                                <th style="width:10%;">District</th>
                                <th style="width:10%;">Evidence URL</th>
                                <th style="width:10%;">Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Set up service centers to assist taxpayers for e-filing of returns under the State/Union Territory GST Act</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">
                                    <a href="https://selfservice.gstsystem.in/ReportIssue.aspx" target="_blank">https://selfservice.gstsystem.in/ReportIssue.aspx</a><br/>
                                    <a href="www.ddvat.gov.in" target="_blank">www.ddvat.gov.in</a><br/>
                                    GST Helpdesk Email ID- gst-helpdesk-dd@gov.in</td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/gst/reforms_153_dd.jpeg">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Set up service centers to assist taxpayers for e-filing of returns under the State/Union Territory GST Act</td>
                                <td class="text-center">DNH</td>
                                <td class="text-center"><a href="https://dnhctd.gov.in/docs/order/Order%20regarding%20set%20up%20the%20service%20center%20for%20VAT%20and%20GST%20dept%20DNH.pdf" target="_blank">https://dnhctd.gov.in/docs/order/Order%20regarding%20set%20up<br/>%20the%20service%20center%20for%20VAT%20and%20GST%20dept%20DNH.pdf</a></td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/gst/reforms_153_dnh.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Establish a helpline providing basic services such as assisting users in preparing and filing returns under the State/Union Territory GST Act</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center">
                                    <a href="https://selfservice.gstsystem.in/ReportIssue.aspx" target="_blank">https://selfservice.gstsystem.in/ReportIssue.aspx</a><br/>
                                    <a href="www.ddvat.gov.in" target="_blank">www.ddvat.gov.in</a><br/>
                                    GST Helpdesk Email ID- gst-helpdesk-dd@gov.in<br/>
                                    Landline No.- 0260-2260349 / 1800-233-0349<br/></td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/gst/reforms_154_dd.jpeg">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Establish a helpline providing basic services such as assisting users in preparing and filing returns under the State/Union Territory GST Act</td>
                                <td class="text-center">DNH</td>
                                <td class="text-center"><a href="https://dnhctd.gov.in/docs/order/Order%20regarding%20set%20up%20the%20service%20center%20for%20VAT%20and%20GST%20dept%20DNH.pdf" target="_blank">https://dnhctd.gov.in/docs/order/Order%20regarding%20set%20up<br/>%20the%20service%20center%20for%20VAT%20and%20GST%20dept%20DNH.pdf</a></td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/gst/reforms_154_dnh.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Constitute an authority for advance ruling under the State Goods Service Tax and publish details of application procedure and checklist</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center"><a href="https://www.gst.gov.in/help/advanceruling" target="_blank">https://www.gst.gov.in/help/advanceruling</a></td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/gst/reforms_155_dd.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Constitute an authority for advance ruling under the State Goods Service Tax and publish details of application procedure and checklist</td>
                                <td class="text-center">DNH</td>
                                <td class="text-center"><a href="https://services.gst.gov.in/litserv/case/hrng/get" target="_blank">https://services.gst.gov.in/litserv/case/hrng/get</a></td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/gst/reforms_155_dnh.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Constitute an appellate authority for advance ruling under the State Goods Service Tax and publish details of application procedure and checklist</td>
                                <td class="text-center">Daman</td>
                                <td class="text-center"><a href="https://www.gst.gov.in/help/advanceruling" target="_blank">https://www.gst.gov.in/help/advanceruling</a></td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/gst/reforms_156_dd.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Constitute an appellate authority for advance ruling under the State Goods Service Tax and publish details of application procedure and checklist</td>
                                <td class="text-center">DNH</td>
                                <td class="text-center"><a href="https://services.gst.gov.in/litserv/case/hrng/get" target="_blank">https://services.gst.gov.in/litserv/case/hrng/get</a></td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>assets/department/gst/reforms_156_dnh.pdf">Click Here</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
    </div>
</section>

<section class="pt-0 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>