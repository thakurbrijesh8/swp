<?php
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url));
$this->load->view('common/validation_message');
$this->load->view('common/utility_template');
$this->load->view('security');
?>
<link rel="stylesheet" href="<?php echo $base_url; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Queries and Grievance Handling</li>
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
                    <h2 class="fs-30px text-grad">Queries and Grievance Handling</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-0 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <a href="<?php echo base_url(); ?>query-grievance-redressal-dnhdd" class="btn btn-grad btn-block f-s-16px">
                    <i class="fa fa-question-circle-o mr-0"></i>&nbsp; Submit your Query and Grievance
                </a>
            </div>
            <div class="col-sm-4 col-md-4">
                <a href="<?php echo base_url(); ?>track_query_grievance" class="btn btn-grad btn-block f-s-16px">
                    <i class="fa fa-history mr-0"></i>&nbsp; Track Status of Query and Grievance
                </a>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="table-responsive">
                            <table class="table p-04 table-hover">
                                <thead class="all-text-white bg-grad">
                                    <tr class="text-center">
                                        <th style="width:2%;">Sr. No.</th>
                                        <th style="width:30%;">SRAP 2020 Reforms</th>
                                        <th style="width:5%;">SRAP 2020 Reforms No.</th>
                                        <th style="width:15%;">Document / URL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Working procedures (including service timelines, assignment of relationship managers,reverting to investors, in-built sectoral expertise etc.) for Investors’Facilitation Center/ Investment Promotion Agency for Queries handling and Grievance handling.</td>
                                        <td class="text-center">7</td>
                                        <td class="text-center">
                                            1. <a target="_blank" href="assets/pdf/notification-regarding-competent-authorities.pdf">Notification Dated 30-10-2017</a><br/>
                                            2. <a target="_blank" href="assets/department/sss/samay-sudhini-seva-v8.pdf">Notification Dated 23-01-2021</a><br />
                                            3. <a target="_blank" href="assets/department/sss/Public_Service_Guarantee_Act_Rules_2022_DNHDD_21072023.pdf">Notification Dated 17-10-2022</a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Mandate regarding all queries regarding the application from the investor to be recorded and addressed within a timeline of 15 days from the date of queries raised under the PSDG Act / any equivalent Act.</td>
                                        <td class="text-center">8</td>
                                        <td class="text-center">
                                            1. <a target="_blank" href="assets/pdf/notification-regarding-competent-authorities.pdf">Notification Dated 30-10-2017</a><br/>
                                            2. <a target="_blank" href="assets/department/sss/samay-sudhini-seva-v8.pdf">Notification Dated 23-01-2021</a><br />
                                            3. <a target="_blank" href="assets/department/sss/Public_Service_Guarantee_Act_Rules_2022_DNHDD_21072023.pdf">Notification Dated 17-10-2022</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Mandate regarding all queries/clarifications related to industrial applicants are sought once and within 7 days of receiving the application from the investor</td>
                                        <td class="text-center">9</td>
                                        <td class="text-center">
                                            1. <a target="_blank" href="assets/pdf/notification-regarding-competent-authorities.pdf">Notification Dated 30-10-2017</a><br/>
                                            2. <a target="_blank" href="assets/department/sss/samay-sudhini-seva-v8.pdf">Notification Dated 23-01-2021</a><br />
                                            3. <a target="_blank" href="assets/department/sss/Public_Service_Guarantee_Act_Rules_2022_DNHDD_21072023.pdf">Notification Dated 17-10-2022</a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left pb-0">
                    <h2 class="text-grad">Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-8">
                <h5 class="mb-0 mt-2">- Data Starting From 1st January 2022</h5>
                <h6 class="mb-0 mt-2 color-nic-red">- The Dashboard is being updated regularly as and when the Queries Received and Queries Responded.</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:30%;">Particulars</th>
                                <th style="width:10%;">Micro</th>
                                <th style="width:10%;">Small</th>
                                <th style="width:10%;">Medium</th>
                                <th style="width:10%;">Large</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Time Limit prescribed as per the Public Service Guarantee Act</td>
                                <td class="text-center">7 Day(s)</td>
                                <td class="text-center">7 Day(s)</td>
                                <td class="text-center">7 Day(s)</td>
                                <td class="text-center">7 Day(s)</td>
                            </tr>
                            <tr>
                                <td>Total Number of Queries Received</td>
                                <td class="text-center"><?php echo isset($query_grievance_received_app_for_micro) ? $query_grievance_received_app_for_micro : 0; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_received_app_for_small) ? $query_grievance_received_app_for_small : 0; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_received_app_for_medium) ? $query_grievance_received_app_for_medium : 0; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_received_app_for_large) ? $query_grievance_received_app_for_large : 0; ?></td>
                            </tr>
                            <tr>
                                <td>Total Number of Queries responded</td>
                                <td class="text-center"><?php echo isset($query_grievance_processed_app_for_micro) ? $query_grievance_processed_app_for_micro : 0; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_processed_app_for_small) ? $query_grievance_processed_app_for_small : 0; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_processed_app_for_medium) ? $query_grievance_processed_app_for_medium : 0; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_processed_app_for_large) ? $query_grievance_processed_app_for_large : 0; ?></td>
                            </tr>
                            <tr>
                                <td>Average time taken to respond to queries</td>
                                <td class="text-center"><?php echo isset($query_grievance_average_time_to_ga_for_micro) ? $query_grievance_average_time_to_ga_for_micro : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_average_time_to_ga_for_small) ? $query_grievance_average_time_to_ga_for_small : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_average_time_to_ga_for_medium) ? $query_grievance_average_time_to_ga_for_medium : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_average_time_to_ga_for_large) ? $query_grievance_average_time_to_ga_for_large : '-'; ?></td>
                            </tr>
                            <tr>
                                <td>Median time taken to respond to queries</td>
                                <td class="text-center"><?php echo isset($query_grievance_median_time_to_ga_for_micro) ? $query_grievance_median_time_to_ga_for_micro : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_median_time_to_ga_for_small) ? $query_grievance_median_time_to_ga_for_small : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_median_time_to_ga_for_medium) ? $query_grievance_median_time_to_ga_for_medium : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_median_time_to_ga_for_large) ? $query_grievance_median_time_to_ga_for_large : '-'; ?></td>
                            </tr>
                            <tr>
                                <td>Minimum time taken to respond to Query</td>
                                <td class="text-center"><?php echo isset($query_grievance_min_time_for_micro) ? $query_grievance_min_time_for_micro : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_min_time_for_small) ? $query_grievance_min_time_for_small : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_min_time_for_medium) ? $query_grievance_min_time_for_medium : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_min_time_for_large) ? $query_grievance_min_time_for_large : '-'; ?></td>
                            </tr>
                            <tr>
                                <td>Maximum time taken to respond to Query</td>
                                <td class="text-center"><?php echo isset($query_grievance_max_time_for_micro) ? $query_grievance_max_time_for_micro : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_max_time_for_small) ? $query_grievance_max_time_for_small : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_max_time_for_medium) ? $query_grievance_max_time_for_medium : '-'; ?></td>
                                <td class="text-center"><?php echo isset($query_grievance_max_time_for_large) ? $query_grievance_max_time_for_large : '-'; ?></td>
                            </tr>
                            <tr>
                                <td>Average Fees</td>
                                <td class="text-center v-a-m">
                                    <button type="button" class="btn btn-grad btn-sm mb-0" onclick="viewAverageFeesDetails($(this), <?php echo VALUE_ONE; ?>);">View</button>
                                </td>
                                <td class="text-center v-a-m">
                                    <button type="button" class="btn btn-grad btn-sm mb-0" onclick="viewAverageFeesDetails($(this), <?php echo VALUE_TWO; ?>);">View</button>
                                </td>
                                <td class="text-center v-a-m">
                                    <button type="button" class="btn btn-grad btn-sm mb-0" onclick="viewAverageFeesDetails($(this), <?php echo VALUE_THREE; ?>);">View</button>
                                </td>
                                <td class="text-center v-a-m">
                                    <button type="button" class="btn btn-grad btn-sm mb-0" onclick="viewAverageFeesDetails($(this), <?php echo VALUE_FOUR; ?>);">View</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div> 

    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url, 'is_handlebars' => true)); ?>
<script type="text/x-handlebars-template" id="af_list_template">
<?php $this->load->view('new_common/af_list'); ?>
</script>
<script type="text/javascript" src="<?php echo $base_url; ?>plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
                                        var spinnerTemplate = Handlebars.compile($('#spinner_template').html());
                                        var iconSpinnerTemplate = spinnerTemplate({'type': 'light', 'extra_class': 'spinner-border-sm'});
                                        var afListTemplate = Handlebars.compile($('#af_list_template').html());

                                        var VALUE_ZERO = <?php echo VALUE_ZERO; ?>;
                                        var invalidAccessValidationMessage = '<?php echo INVALID_ACCESS_MESSAGE ?>';
                                        var prefixModuleArray = <?php echo json_encode($this->config->item('prefix_module_array')); ?>;

                                        function viewAverageFeesDetails(btnObj, industryType) {
                                            if (!btnObj || !industryType || industryType == VALUE_ZERO || industryType == null) {
                                                showError(invalidAccessValidationMessage);
                                                return false;
                                            }
                                            $('.preloader').show();
                                            var ogBtnHTML = btnObj.html();
                                            var ogBtnOnclick = btnObj.attr('onclick');
                                            btnObj.html(iconSpinnerTemplate);
                                            btnObj.attr('onclick', '');
                                            $.ajax({
                                                type: 'POST',
                                                url: 'query_grievance/get_query_grievance_average_fees_details',
                                                data: $.extend({}, {'industry_type': industryType}, getTokenData()),
                                                error: function (textStatus, errorThrown) {
                                                    $('.preloader').hide();
                                                    generateNewCSRFToken();
                                                    btnObj.html(ogBtnHTML);
                                                    btnObj.attr('onclick', ogBtnOnclick);
                                                    if (textStatus.status === 403) {
                                                        loginPage();
                                                        return false;
                                                    }
                                                    if (!textStatus.statusText) {
                                                        loginPage();
                                                        return false;
                                                    }
                                                    showError(textStatus.statusText);
                                                },
                                                success: function (data) {
                                                    var parseData = JSON.parse(data);
                                                    if (!isJSON(data)) {
                                                        loginPage();
                                                        return false;
                                                    }
                                                    $('.preloader').hide();
                                                    setNewToken(parseData.temp_token);
                                                    btnObj.html(ogBtnHTML);
                                                    btnObj.attr('onclick', ogBtnOnclick);
                                                    if (parseData.success == false) {
                                                        showError(parseData.message);
                                                        return false;
                                                    }
                                                    loadAFD(parseData);
                                                }
                                            });
                                        }

                                        function loadAFD(parseData) {
                                            showPopup();
                                            $('.swal2-popup').css('width', '45em');
                                            $('#popup_container').html(afListTemplate({'service_name': parseData.service_name}));

                                            var feesRenderer = function (data, type, full, meta) {
                                                return 'No Fees Charged';
                                            };
                                            $('#afd_datatable').DataTable({
                                                data: parseData.average_fees,
                                                pageLength: 10,
                                                ordering: false,
                                                columns: [
                                                    {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                                                    {data: 'query_reference_number', 'class': 'text-center'},
                                                    {data: 'submitted_datetime', 'render': dateRenderer, 'class': 'text-center'},
                                                    {data: 'total_fees', 'render': feesRenderer, 'class': 'text-right'}
                                                ],
                                            });
                                        }
</script>