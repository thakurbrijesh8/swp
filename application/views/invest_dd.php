<?php $base_url = base_url(); ?>
<?php $this->load->view('new_common/header', array('base_url' => $base_url, 'invest_dd' => 'active')); ?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Why Invest in DNH & DD</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="pt-4 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left pb-0">
                    <h2 class="text-grad">Why Invest in DNH & DD</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h5>There are innumerable advantages for setting up and running business in U.T. of DNH & DD in comparison to other states:</h5>
                <ul class="list-group list-group-borderless list-group-icon-primary-bg">
                    <li class="list-group-item"><i class="fa fa-check"></i> Lean, efficient and industry friendly administration.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Excellent infrastructure and public facilities.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Allotment of industry clearances and licenses through open house.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Centrally located in between the vast industrial region of Gujarat and Maharashtra.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Lowest Power Tariffs among neighbouring states.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Availability of skilled and semi‐skilled manpower through Polytechnics, ITIs and Colleges in both districts.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Sturdy Infrastructure in terms of roads, public facilities and amenities.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Nearby Coastline, Ports facilities and Inland Container Depot.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> No Entry gate for Industrial permission for MSME or Large Scale Unit‐Direct simultaneous application can be done.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Investment Promotion Council‐Cell for Investors for before & after care.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> All permission granting Authority within 3 km of radius.</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Deemed Approval in case of delayed approval from the Authority.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>