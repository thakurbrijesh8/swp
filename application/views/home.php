<?php
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url, 'home' => 'active'));
$this->load->view('common/validation_message');
$this->load->view('security');
?>

<section class="p-0">
    <div class="swiper-container swiper-arrow-hover swiper-slider-fade" style="height: 430px;">
        <div class="swiper-wrapper">
            <!-- slide 1-->
            <div class="swiper-slide bg-overlay-dark-2" style="background-image:url(<?php echo $base_url; ?>assets/images/banner/01.jpg); background-position: center; background-size: cover;"></div>
            <div class="swiper-slide bg-overlay-dark-2" style="background-image:url(<?php echo $base_url; ?>assets/images/banner/02.jpg); background-position: center; background-size: cover;"></div>
            <div class="swiper-slide bg-overlay-dark-2" style="background-image:url(<?php echo $base_url; ?>assets/images/banner/03.jpg); background-position: center; background-size: cover;"></div>
            <div class="swiper-slide bg-overlay-dark-2" style="background-image:url(<?php echo $base_url; ?>assets/images/banner/04.jpg); background-position: center; background-size: cover;"></div>
            <div class="swiper-slide bg-overlay-dark-2" style="background-image:url(<?php echo $base_url; ?>assets/images/banner/05.jpg); background-position: center; background-size: cover;"></div>
            <div class="swiper-slide bg-overlay-dark-2" style="background-image:url(<?php echo $base_url; ?>assets/images/banner/06.jpg); background-position: center; background-size: cover;"></div>
            <div class="swiper-slide bg-overlay-dark-2" style="background-image:url(<?php echo $base_url; ?>assets/images/banner/07.jpg); background-position: center; background-size: cover;"></div>
            <div class="swiper-slide bg-overlay-dark-2" style="background-image:url(<?php echo $base_url; ?>assets/images/banner/08.jpg); background-position: center; background-size: cover;"></div>
        </div>
        <!-- Slider buttons -->
        <div class="swiper-button-next"><i class="ti-angle-right"></i></div>
        <div class="swiper-button-prev"><i class="ti-angle-left"></i></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="service pt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 mt-30">
                <div class="feature-box f-style-2 icon-grad h-100">
                    <p class="feature-box-desc">
                        <img src="<?php echo $base_url; ?>assets/images/INVESTMENT-PROMOTION-SCHEME-2022.png" />
                        <a class="mt-3 font-weight-bold" href="<?php echo $base_url; ?>assets/pdf/Notification_IPS_2022_DNH_DD.pdf" target="_blank">Notification IPS 2022 DNH & DD <i class="ti-new-window"></i></a>
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-30">
                <div class="feature-box f-style-2 icon-grad h-100">
                    <p class="feature-box-desc">
                        <img src="<?php echo $base_url; ?>assets/images/IndustrialPolicy.png" />
                    </p>
                    <a class="mt-3 font-weight-bold" href="<?php echo $base_url; ?>assets/FF-POLICY.pdf" target="_blank">Industrial Policy 2018 <i class="ti-new-window"></i></a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-30">
                <div class="feature-box f-style-2 icon-grad h-100">
                    <form method="post" id="login_form" autocomplete="off">
                        <h2 class="">Login</h2>
                        <div class="form mt-3 mb-3">
                            <div>
                                <div class="text-center mb-2">
                                    <span class="error-message error-message-login font-weight-bold" style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p class="text-left mb-1">Mobile Number</p>
                                <span class="form-group">
                                    <input type="text" id="mobile_number_for_login" name="mobile_number_for_login" class="form-control mb-0" placeholder="Mobile Number !"
                                           maxlength="10" onkeyup="checkNumeric($(this));"
                                           onblur="checkNumeric($(this)); checkValidationForMobileNumber('login', 'mobile_number_for_login');">
                                </span>
                                <span class="error-message error-message-login-mobile_number_for_login"></span>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-left mb-1">Pin</p>
                                    <a class="text-muted small mb-1" href="<?php echo $base_url; ?>forgot_pin">Forgot Pin ? Click Here.</a>
                                </div>
                                <span class="form-group">
                                    <input type="password" id="pin_for_login" name="pin_for_login" class="form-control mb-0" placeholder="******"
                                           onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                           maxlength ="6">
                                    <span class="error-message error-message-login-pin_for_login"></span>
                                </span>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <button type="button" class="btn btn-grad mb-0" id="submit_btn_for_login"
                                            onclick="checkLogin($(this));">Login</button>
                                </div>
                            </div>
                            <div class="row no-gutters mt-2">
                                <div class="col-12 p-0"><span class="text-muted">Don't have an account? <a href="<?php echo $base_url; ?>registration" style="display: inline;">Registration</a></span></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-30">
                <div class="feature-box f-style-2 icon-grad h-100">
                    <div class="feature-box-icon feature-box-icon-new"><i class="ti-window"></i></div>
                    <h3 class="feature-box-title">Single Window Clearances</h3>
                    <p class="feature-box-desc">System which issues various clearances online. Through one stop clearance system one can obtain all the required clearances for setting up of a business.</p>
                    <a class="mt-3 font-weight-bold" href="<?php echo $base_url; ?>samay-sudhini-seva">Time Bound Delivery of Services <i class="ti-new-window"></i></a>
                    <a class="btn btn-purple btn-block mb-0 mt-2" href="<?php echo $base_url; ?>know-your-clearances">Know Your Clearances</a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-30">
                <div class="feature-box f-style-2 icon-grad h-100">
                    <div class="feature-box-icon feature-box-icon-new"><i class="ti-files"></i></div>
                    <h3 class="feature-box-title">Departments & Services </h3>
                    <p>List of Participating Departments which provide necessary clearances through Single Window system for Industrial Clearance System.</p>
                    <a class="mt-3 font-weight-bold" href="<?php echo $base_url; ?>departments-and-services">Departments & Services <i class="ti-new-window"></i></a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-30">
                <div class="feature-box f-style-2 icon-grad h-100">
                    <div class="feature-box-icon feature-box-icon-new"><i class="ti-list"></i></div>
                    <h3 class="feature-box-title">List of Services</h3>
                    <p>List of Services which are necessary for setting up of business. This list contains a list of various Clearances required for Industrial Clearance System.</p>
                    <a class="mt-3 font-weight-bold" href="<?php echo $base_url; ?>swp_ls">List of Services <i class="ti-new-window"></i></a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-30">
                <div class="feature-box f-style-2 icon-grad h-100 pb-2">
                    <h3 class="feature-box-title text-primary mt-0">Recent Updates</h3>
                    <hr class="mt-1 mb-2">
                    <div class="list-groupmbe-nur list-unstyled list-group-borderless">
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/Safety_Guidelines_For_Iron_Steel_Sector.pdf" target="_blank"><i class="fa fa-circle"></i> Safety Guidelines for Iron and Steel Sector</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/Notification_IPS_2022_DNH_DD.pdf" target="_blank"><i class="fa fa-circle"></i> Notification IPS 2022 DNH & DD</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/FAQs_IPS_2022_12072024_160000.pdf" target="_blank"><i class="fa fa-circle"></i> FAQs_IPS 2022</a>
                        <a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/assistance-for-industrial-infrastructure-scheme.pdf" target="_blank"><i class="fa fa-circle"></i> Assistance for Industrial Infrastructure Scheme.</a>
                        <!--<a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/single-window-agency.pdf" target="_blank"><i class="fa fa-circle"></i> Order regarding Constitution of Single Window Agency.</a>-->
                        <!--<a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/pdf/notification-regarding-competent-authorities.pdf" target="_blank"><i class="fa fa-circle"></i> Notification Regarding Competent Authorities, their Services, Timelines and Punitive Measures against defaulter departments.</a>-->
                        <!--<a class="list-group-item list-group-item-action" href="<?php echo $base_url; ?>assets/zip/INVESTDD-DOCUMENTS-CHECKLIST.zip" target="_blank"><i class="fa fa-circle"></i> Required Documents/Checklist for NOC/Clearances of various Department under OSWA Procedure.</a>-->
                    </div>
                    <a class="mt-1 font-weight-bold" href="<?php echo $base_url; ?>recent-updates">View All <i class="ti-new-window"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>
<script type="text/javascript">
    basicConfigurationForLogin();
</script>