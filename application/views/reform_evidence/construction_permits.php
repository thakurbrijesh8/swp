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
                        <li class="breadcrumb-item">Construction Permits</li>
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
                    <h2 class="text-grad">Services</h2>
                    <h6 class="lh-15">Develop legally valid master plans/zonal plans/land use plans for all urban areas and make it available online in public domain:</h6>
                </div>
            </div>
        </div></br></br>
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left pb-0">
                    <h2 class="fs-30px text-grad">Construction Permits</h2>
                </div>
                <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:10%;">Department</th>
                                <th class="v-a-m" style="width:10%;">District</th>
                                <th class="v-a-m" style="width:10%;">URL</th>
                                <th class="v-a-m" style="width:20%;">Documents</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">PDA Daman</td>
                                <td class="text-center">Daman</td>
                                <td><a href="https://daman.nic.in/websites/town_country_planning_department_daman/documents/2017/LAND-USE-PLAN-OF-DAMAN.pdf" target="_blank">https://daman.nic.in/websites/town_country_planning_department_daman/documents/2017/LAND-USE-PLAN-OF-DAMAN.pdf</a></br><a href="https://daman.nic.in/websites/town_country_planning_department_daman/documents/2016/DD-Development-Control-Rules-2007.pdf" target="_blank">https://daman.nic.in/websites/town_country_planning_department_daman/documents/2016/DD-Development-Control-Rules-2007.pdf</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?=base_url();?>assets/department/pda/reform_182_1.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">PDA Diu</td>
                                <td class="text-center">Diu</td>
                                <td><a href="http://www.diu.gov.in/Others/JTP/Regional-Urban.pdf" target="_blank">http://www.diu.gov.in/Others/JTP/Regional-Urban.pdf</a></br><a href="http://www.diu.gov.in/Others/JTP/Regional-Rural.pdf" target="_blank">http://www.diu.gov.in/Others/JTP/Regional-Rural.pdf</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?=base_url();?>assets/department/pda/reform_182_2.pdf">Click Here</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">PDA DNH</td>
                                <td class="text-center">DNH</td>
                                <td><a href="http://pdadnh.nic.in/Doc/PlanofDNH.pdf" target="_blank">http://pdadnh.nic.in/Doc/PlanofDNH.pdf</a></br><a href="http://pdadnh.nic.in/Doc/ODP_P1.pdf" target="_blank">http://pdadnh.nic.in/Doc/ODP_P1.pdf</a></br><a href="http://pdadnh.nic.in/Doc/ODP_P2.pdf" target="_blank">http://pdadnh.nic.in/Doc/ODP_P2.pdf</a></td>
                                <td class="text-center">
                                    <a target="_blank" href="<?=base_url();?>assets/department/pda/reform_182_3.pdf">Click Here</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
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