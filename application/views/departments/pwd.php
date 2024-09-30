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
                        <li class="breadcrumb-item">PWD - Daman & Diu</li>
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
                    <h2 class="text-grad">PWD - Daman & Diu</h2>
                    <h6 class="lh-15">On the basis of recommendation made by the DIPP, Government of India and Information provided by the concern departments regarding Time lines and Competent Authority for necessary Clearances/NOCs/Permissions/Renewals, Single Window Agency hereby notifies the following Services, the time frames within which these are to be provided to the citizens, Competent Authority and deemed approval authority as per schedule given below:</h6>
                </div>
            </div>
        </div>
        <?php $this->load->view('departments_services/pwd'); ?>
       <!-- <div class="row">
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
                                <td>Water Connection or Certificate of Non-Availability of Water</td>
                                <td class="text-center">07 Days</td>
                                <td>Assistant Engineer, Sub-Div-I, PWD</td>
                                <td class="text-center">Single Window Agency</td>
                                <td class="text-center">
                                    <a class="nav-link" href="<?php echo $base_url; ?>login">Click Here</a>
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