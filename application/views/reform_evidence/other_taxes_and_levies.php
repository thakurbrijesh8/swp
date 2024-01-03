<?php
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url, 'departments' => 'active'));
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
                        <li class="breadcrumb-item">Other Taxes & Levies</li>
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
                    <h2 class="fs-30px text-grad">Other Taxes & Levies</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-0 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">Profession Tax</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Finance Department</td>
                                <td class="text-center">Registration Under Profession Tax</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/gst/29.pdf">Not Applicable In DNHDD</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">Goods and Services Tax (GST)</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Goods and Services Tax (GST)</td>
                                <td class="text-center">The levies, duties and fees imposed by GST</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="https://cbic-gst.gov.in/gst-goods-services-rates.html">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">Road Transport</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Road Transport</td>
                                <td class="text-center">Taxation Schedule for Transport vehicle and Non-Transport Vehicle</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="https://daman.nic.in/rtodaman/taxation_schedule.asp">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">Excise</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Excise</td>
                                <td class="text-center">List of Various Fees and Import Duties</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/othertaxes/Notification Regarding Cancellation, Extension & Vehicle Number Change Fees Dated 14-11-2019.pdf">Cancellation Fees</a>
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/othertaxes/Notification Regarding Import Fees Dated 14-11-2019.pdf">Import Duty</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">SMC, DNH</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">SMC, DNH</td>
                                <td class="text-center">List of various levies, duties, Taxes and Fees</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/othertaxes/ev2021612004097.pdf">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">Dist. Panchayat, Daman</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Dist. Panchayat, Daman</td>
                                <td class="text-center">List of Taxes imposed by Panchayats</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/othertaxes/ev5791608805373.pdf">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">Dist. Panchayat, DNH</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Dist. Panchayat, DNH</td>
                                <td class="text-center">List of Taxes imposed by Panchayats</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/othertaxes/ev9441606995175.pdf">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">Electricity</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Electricity</td>
                                <td class="text-center">List of Tariff</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/othertaxes/1590648145614TariffOrderEDDD2020-21_1287.pdf">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">PWD</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">PWD</td>
                                <td class="text-center">Water Tariff, Meter Rent and Other Charges related to water connection</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/othertaxes/Fixation-of-water-tariff.pdf">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">Drugs Control Department</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Drugs Control Department</td>
                                <td class="text-center">Retail and Wholesale Drug license fees</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/othertaxes/12785-16-12-2020.pdf">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h5 class="text-grad">Revenue</h5>
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 350px;">Department Name</th>
                                <th class="text-center v-a-m" style="min-width: 225px;">Taxes / Levies Description</th>
                                <th class="text-center v-a-m" style="width: 210px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">Revenue</td>
                                <td class="text-center">Stamp Duty and Property Registration Fees</td>
                                <td class="text-center">
                                    <a target="_blank" class="btn btn-grad btn-sm" href="assets/department/othertaxes/4306-14-01-2020.pdf">View</a>
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