<?php $base_url = base_url(); ?>
<?php $this->load->view('new_common/header', array('base_url' => $base_url, 'about_us' => 'active')); ?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">About Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="pt-6 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-left pb-0">
                    <h2 class="text-grad">About Us</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-0 pb-6">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="pl-3">On the basis of recommendation made by the Department of Industrial Policy and Promotion (DIPP), Ministry of Commerce and Industry, Government of India, the UT Administration of DNH & DD has setup Single Window Agency.</p>
                <p class="pl-3">Single Window Agency shall accord deemed approvals / clearances / recommendation (as the case may be), in case the concerned approval would be granted by Single Window Agency to the applicant and Responsibility of the Officer/Official shall be fixed for causing delay in providing services in time bound manner & necessary departmental proceeding may be initiated against the concern.</p>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>