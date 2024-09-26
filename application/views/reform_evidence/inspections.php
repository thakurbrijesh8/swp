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
                        <li class="breadcrumb-item">Inspections</li>
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
                    <h2 class="fs-30px text-grad">Inspections</h2>
                </div> <br>

                <!-- child table services daman-->
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" rowspan="2" style="width:1%;">Sr. No.</th>                                
                                <th class="v-a-m" rowspan="2" style="width:16%;">Reforms Related to Ease of Doing Business ( EODB )</th>
                                <!--<th class="v-a-m" rowspan="2" style="width:5%;">SRAP-2020 Reform No.</th>-->
                                <th class="v-a-m" style="width:5%;">Document / URL</th>
                            </tr>                    
                        </thead>
                        <tbody>  
                            <tr>
                                <td class="text-center">1</td>                                
                                <td>  Mandate surprise inspection or inspections based on complaints are conducted with specific permissions from the respective Head of Department</td>
                                <!--<td class="text-center">199</td>-->
                                <td class="text-center" style="padding: 0px;">
                                    <table class="table mb-0">
                                        <tr>
                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                <a class="nav-link" target="blank" href="https://labourddd.in/"><button type="button" class="btn btn-grad btn-sm">View</button></a>
                                                <a class="nav-link" target="blank" href="<?php echo $base_url; ?>assets/department/inspection/reforms_199.pdf"><button type="button" class="btn btn-grad btn-sm">Document</button></a>
                                            </td>

                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>                                
                                <td>Central Inspection System (CIS)</td>
                                <!--<td class="text-center">201 to 206</td>-->
                                <td class="text-center" style="padding: 0px;">
                                    <table class="table mb-0">
                                        <tr>
                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">
                                                <a class="nav-link" target="blank" href="assets/department/201-TO-206.pdf"><button type="button" class="btn btn-grad btn-sm">Document</button></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>                                
                                <td>Third party certification instead of Departmental inspections under all the labour laws and The Factories Act, 1948. </td>
                                <!--<td class="text-center">207</td>-->
                                <td class="text-center" style="padding: 0px;">
                                    <table class="table mb-0">
                                        <tr>
                                            <td style="border: none; border-right: 1px solid #dee2e6;
                                                border-bottom: 1px solid #dee2e6; width: 33.33%;" class="text-center">

                                                <a target="_blank" href="<?php echo $base_url; ?>assets/department/inspection/reforms_207.pdf"><button type="button" class="btn btn-grad btn-sm">Document</button></a>
                                            </td>

                                        </tr>
                                    </table>
                                </td>
                            </tr>    
                        </tbody>
                    </table>
                </div>
                <!-- end -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <div class="title text-left pb-0">
                    <h2 class="fs-30px text-grad">Central Inspection System (CIS)</h2>
                </div>

                <!-- child table services daman-->
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:2%;">Sr. No.</th>                                
                                <th class="v-a-m" style="width:18%;">Particulars</th>
                                <th class="v-a-m" style="width:5%;">View / Download</th>
                            </tr>                    
                        </thead>
                        <tbody>  
                            <tr>
                                <td class="text-center">1</td>                                
                                <td>
                                    Notification Regarding Formation of Central Inspection System to integrate the independent inspection system of Labour Commissionerate, Department of Factories & Boilers, Pollution Control Committee and Legal Metrology.
                                </td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="assets/department/central-inspection-system.pdf"><button type="button" class="btn btn-grad btn-sm">View</button></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>                                
                                <td>
                                    Office order regarding mandating that the inspection shall be limited to the checklist.
                                </td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="assets/department/INSPECTION-LIMITED-TO-CHECKLIST-NEW.pdf"><button type="button" class="btn btn-grad btn-sm">View</button></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="title text-left pb-0">
                    <h4 class="text-grad">Inspection Procedure & Checklist Under Various Acts</h4>
                </div>
                <!-- child table services daman-->
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:2%;">Sr. No.</th>                                
                                <th class="v-a-m" style="width:18%;">Inspections</th>
                                <th class="v-a-m" style="width:12%;">Department</th>
                                <th class="v-a-m" style="width:5%;">Inspection Procedure & Checklist</th>
                            </tr>                    
                        </thead>
                        <tbody>  
                            <tr>
                                <td class="text-center">1</td>                                
                                <td>
                                    i. Inspection under The Equal Remuneration Act, 1976<br>
                                    ii. Inspection under The Minimum Wages Act, 1948<br>
                                    iii. Inspection under The Shops and Establishments Act, 1988<br>
                                    iv. Inspection under The Payment of Bonus Act, 1965<br>
                                    v. Inspection under The Payment of Wages Act, 1936<br>
                                    vi. Inspection under The Payment of Gratuity Act, 1972<br>
                                    vii. Inspection under The Contract Labour (Regulation and Abolition) Act, 1970<br>
                                    viii. Inspection under The The Factories Act, 1948<br>
                                    ix. Inspection under The Indian Boilers Act 1923
                                </td>
                                <td class="text-center">Labour & Employment <br>&<br> Factories & Boilers</td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="assets/department/INSPECTION-LIMITED-TO-CHECKLIST-NEW.pdf"><button type="button" class="btn btn-grad btn-sm">View</button></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>                                
                                <td>
                                    Inspection under The Legal Metrology Act, 2009
                                </td>
                                <td class="text-center">Legal Metrology (Weights & Measures)</td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="assets/department/w&m/wm-inspection-procedure-and-checklist.pdf"><button type="button" class="btn btn-grad btn-sm">View</button></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>                                
                                <td>
                                    i. Inspection under The Water (Prevention and Control of Pollution) Act, 1974<br>
                                    ii. Inspection under The Air (Prevention and Control of Pollution) Act, 1981
                                </td>
                                <td class="text-center">Environment / PCC</td>
                                <td class="text-center">
                                    <a class="nav-link" target="_blank" href="assets/department/pcc/pcc-inspection-procedure-and-checklist.pdf"><button type="button" class="btn btn-grad btn-sm">View</button></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left pb-0">
                    <h2 class="text-grad">Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="mb-0 mt-2">- Data Starting From 1st January 2022</h5>
                <h6 class="mb-0 mt-2 color-nic-red">- The Dashboard is being updated regularly as and when Inspections are Conducted, Self-Certifications or Third party Certifications Produced by Companies.</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:50%;">Particulars</th>
                                <th class="v-a-m" style="width:10%;">Micro</th>
                                <th class="v-a-m" style="width:10%;">Small</th>
                                <th class="v-a-m" style="width:10%;">Medium</th>
                                <th class="v-a-m" style="width:10%;">Large</th>
                                <th class="v-a-m" style="width:10%;">Average / Median Time Taken</th>
                                <th class="v-a-m" style="width:10%;">Average Fees</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Total Number of inspections conducted</td>
                                <td class="text-center">11</td>
                                <td class="text-center">8</td>
                                <td class="text-center">6</td>
                                <td class="text-center">3</td>
                                <td class="text-center">6</td>
                                <td class="text-center v-a-m">
                                    <button type="button" class="btn btn-grad btn-sm mb-0" onclick="viewAverageFeesDetails();">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Number of Companies that provide self-certifications and were exempted from inspections</td>
                                <td class="text-center">9</td>
                                <td class="text-center">7</td>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">3</td>
                                <td class="text-center v-a-m">
                                    <button type="button" class="btn btn-grad btn-sm mb-0" onclick="viewAverageFeesDetails();">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Number of Companies that provide third party certifications and were exempted from inspections</td>
                                <td class="text-center">10</td>
                                <td class="text-center">6</td>
                                <td class="text-center">6</td>
                                <td class="text-center">2</td>
                                <td class="text-center">2</td>
                                <td class="text-center v-a-m">
                                    <button type="button" class="btn btn-grad btn-sm mb-0" onclick="viewAverageFeesDetails();">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left pb-0 mt-2">
                    <h2 class="text-grad">Central Inspection System (CIS) Report</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width: 5%; vertical-align: middle;">Sr. No.</th>
                                <th style="width: 10%; vertical-align: middle;">Inspection Date</th>
                                <th style="width: 15%; vertical-align: middle;">Company Name</th>
                                <th style="width: 15%; vertical-align: middle;">Company Address</th>
                                <th style="width:43%; vertical-align: middle;">Inspection Under Act</th>
                                <th style="width:12%; vertical-align: middle;">Download Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($temp_ci_data)) { ?>
                                <tr>
                                    <td colspan="6" class="text-center">No Data Available !</td>
                                </tr>
                                <?php
                            } else {
                                $temp_cnt = 1;
                                $c_inspection_act_array = $this->config->item('c_inspection_act_array');
                                foreach ($temp_ci_data as $ci_data) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $temp_cnt; ?></td>
                                        <td class="text-center"><?php echo convert_to_new_date_format($ci_data['inspection_date']); ?></td>
                                        <td><?php echo $ci_data['cb_name']; ?></td>
                                        <td><?php echo $ci_data['cb_address']; ?></td>
                                        <td>
                                            <?php
                                            $temp_array = explode(",", $ci_data['inspection_under_act']);
                                            foreach ($temp_array as $index => $t_array) {
                                                $ci_act_name = isset($c_inspection_act_array[$t_array]) ? $c_inspection_act_array[$t_array]['act_name'] : '';
                                                echo ($index != 0 ? '<hr style="margin-top: 5px; margin-bottom: 5px;">' : '') . $ci_act_name;
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-grad btn-sm" target="_blank" href="<?php echo ADMIN_CI_DOC_PATH . $ci_data['inspection_report']; ?>">Download</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $temp_cnt++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</section>


<!-- <section class="pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left pb-0">
                    <h2 class="fs-30px text-grad">Inspections</h2>
                </div>
            </div>
        </div> -->
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
                        <td>Mandate surprise inspection or inspections based on complaints are conducted with specific permissions from the respective Head of Department</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_199.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Equal Remuneration Act, 1976</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_1.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Factories Act, 1948</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_2.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Maternity Benefit Act, 1961</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_3.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Minimum Wages Act, 1948</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_4.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Shops and Establishments Act</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_5.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Labour Welfare Fund Act</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_6.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Payment of Bonus Act, 1965</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_7.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Payment of Wages Act, 1936</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_8.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Payment of Gratuity Act, 1972</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_9.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Inspection under The Contract Labour (Regulation and Abolition) Act, 1970</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://labourddd.in/" target="_blank">https://labourddd.in/</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_200_10.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>The Equal Remuneration Act, 1976</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_202_01.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>The Minimum Wages Act, 1948</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_202_2.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>The Shops and Establishments Act</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_202_3.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>The Payment of Bonus Act, 1965</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_202_4.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>The Payment of Wages Act, 1936</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_202_5.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>The Payment of Gratuity Act, 1972</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_202_6.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>The Contract Labour (Regulation and Abolition) Act, 1970</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_202_7.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>The Factories Act, 1948</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_202_8.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Indian Boilers Act 1923</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_202_9.pdf">Click Here</a>
                        </td>
                    </tr>
                    <tr>
                        <td>self-certification/ third party certification instead of Departmental inspections under all the labour laws and The Factories Act, 1948</td>
                        <td class="text-center">Daman</td>
                        <td class="text-center"><a href="https://swp.dddgov.in/assets/department/labour/reforms_207.pdf" target="_blank">https://swp.dddgov.in/assets/department/labour/reforms_207.pdf</a></td>
                        <td class="text-center">
                            <a class="nav-link" href="<?php echo $base_url; ?>assets/department/labour/reforms_207.pdf">Click Here</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> -->
<!--  </div>
</section> -->


<?php $this->load->view('new_common/footer', array('base_url' => $base_url, 'is_handlebars' => true)); ?>
<script type="text/x-handlebars-template" id="iaf_list_template">
<?php $this->load->view('new_common/iaf_list'); ?>
</script>
<script type="text/javascript" src="<?php echo $base_url; ?>plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
                                        var iafListTemplate = Handlebars.compile($('#iaf_list_template').html());

                                        function viewAverageFeesDetails() {
                                            showPopup();
                                            $('.swal2-popup').css('width', '45em');
                                            $('#popup_container').html(iafListTemplate());
                                            $('#iafd_datatable').append('<tr><td colspan="4" class="text-center">No Data Available !</td></tr>');
                                        }
</script>