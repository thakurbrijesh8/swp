<?php $base_url = base_url(); ?>
<?php $this->load->view('new_common/header', array('base_url' => $base_url)); ?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Recent Updates</li>
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
                    <h2 class="text-grad">Recent Updates</h2>
                    <div class="list-group-number list-unstyled list-group-borderless">
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/Safety_Guidelines_For_Iron_Steel_Sector.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Safety Guidelines for Iron and Steel Sector</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/Notification_IPS_2022_DNH_DD.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Notification IPS 2022 DNH & DD</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/FAQs_IPS_2022.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> FAQs_IPS 2022</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/assistance-for-industrial-infrastructure-scheme.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Assistance for Industrial Infrastructure Scheme.</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/single-window-agency.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Order regarding Constitution of Single Window Agency.</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/notification-regarding-competent-authorities.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Notification Regarding Competent Authorities, their Services, Timelines and Punitive Measures against defaulter departments.</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/process-flow-for-investor.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Process Flow for Investor.</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/zip/INVESTDD-DOCUMENTS-CHECKLIST.zip" target="_blank"><i class="fa fa-circle text-grad"></i> Required Documents/Checklist for NOC/Clearances of various Department under OSWA Procedure.</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/access-to-information-and-transparency-enablers.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Access to information and Transparency Enablers.</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/circular-regarding-shifting-of-district-industries.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Circular regarding shifting of District Industries Centre to Udhyog Bhavan.</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/investment-scheme.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> COMMON APPLICATION FORM FOR INVESTMENT PROMOTION SCHEME-2015</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/investment-brochure-dd-dnh-2015.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Investment Brochure 2015 - DD & DNH</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/order-regarding-the-steel-and-steel-products-quality-control-second-order-2012-issued-by-ministry-of-steel-GOI-new-delhi.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Order Regarding the Steel and Steel Products (Quality Control) Second Order-2012 , issued by Ministry of Steel,GOI,New Delhi.</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/guideline-application-form.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Guideline ,Application Form , Checklist of required documents in English and Gujarati of Prime Minister's Employment Generation Programme(PMEGP).</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/guideline-on-PMEGP-scheme-prime-minister-s-employment-generation-programme.pdf" target="_blank"><i class="fa fa-circle text-grad"></i> Guideline on PMEGP Scheme (Prime Minister's Employment Generation Programme).</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>