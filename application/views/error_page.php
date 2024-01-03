<?php $base_url = base_url(); ?>
<?php $this->load->view('new_common/header', array('base_url' => $base_url)); ?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Error</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="error-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <h3 class="mb-4 error-message"><?php echo isset($error_message) ? $error_message : ''; ?></h3>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>