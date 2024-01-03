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
                        <li class="breadcrumb-item">District Panchayats</li>
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
                    <h2 class="fs-30px text-grad">District Panchayats</h2>
                    <h6 class="lh-15">On the basis of recommendation made by the DIPP, Government of India and Information provided by the concern departments regarding Time lines and Competent Authority for necessary Clearances/NOCs/Permissions/Renewals, Single Window Agency hereby notifies the following Services, the time frames within which these are to be provided to the citizens, Competent Authority and deemed approval authority as per schedule given below:</h6>
                </div>
            </div>
        </div>
          <?php $this->load->view('departments_services/dist_panchayat'); ?>

        <!--   <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th style="width:35%;">Name of Service</th>
                                <th style="width:15%;">Department</th>
                                <th style="width:20%;">District</th>
                                <th style="width:20%;">URL</th>
                                <th style="width:10%;">Document</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr>
                                <td>Publish a list of all state, municipal and panchayat levies and include the relevant information pertaining to the rates and tariff levied by the State and local bodies on the online portal</td>
                                <td class="text-center">Dist Panchayat </td>
                                <td class="text-center">Daman</td>
                                <td class="text-center"><a target="_blank" href="https://daman.nic.in/websites/district_panchayat_Daman/documents/2020/55-03-06-2020.pdf">https://daman.nic.in/websites/district_panchayat_Daman/documents/2020/55-03-06-2020.pdf </td>
                                <td class="text-center"><a target="_blank" class="nav-link" href="<?php $base_url; ?>assets/department/othertaxes/reform_157_DD.pdf">Click Here</a></td>
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
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>