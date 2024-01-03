<?php $base_url = base_url(); ?>
<!doctype html>
<html lang="en">
    <head>
        <title>EODB Single Window Portal : Dadra and Nagar Haveli and Daman and Diu</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="EODB Single Window Portal : Dadra and Nagar Haveli and Daman and Diu">

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo $base_url; ?>assets/images/favicon.ico">

        <?php
        $this->load->view('new_common/css_links', array('base_url' => $base_url));
        $this->load->view('common/validation_message');
        $this->load->view('security');
        ?>
    </head>
    <body>
        <?php $this->load->view('new_common/loader', array('base_url' => $base_url)); ?>
        <!-- =======================
        Sign in -->
        <section class="p-0 d-flex align-items-center">
            <div class="container-fluid">
                <div class="row">
                    <!-- left -->
                    <div class="col-12 col-md-5 col-lg-4 d-md-flex align-items-center bg-grad h-sm-100-vh">
                        <div class="w-100 p-3 p-lg-5 all-text-white">
                            <div class="justify-content-center align-self-center mb-2">
                                <img src="<?php echo $base_url; ?>images/industries.png" />
                            </div>
                            <h3 class="font-weight-light text-center">Single Window Portal for Industrial Clearances</h3>
                            <h6 class="font-weight-light text-center">U.T. Administration of<br>Dadra Nagar Haveli & Daman and Diu</h6>
                        </div>
                    </div>
                    <!-- Right -->
                    <div class="col-12 col-md-7 col-xl-8 mx-auto my-5">
                        <div class="row h-100">
                            <div class="col-12 col-md-10 col-lg-5 text-left mx-auto d-flex align-items-center">
                                <div class="w-100">
                                    <form method="post" id="login_form" autocomplete="off">
                                        <h2 class="">Login into your account!</h2>
                                        <div class="form mt-4">
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
                                                    <button type="button" class="btn btn-dark" id="submit_btn_for_login"
                                                            onclick="checkLogin($(this));">Login</button>
                                                    <a class="btn btn-grad text-white" href="<?php echo $base_url; ?>home">Back to Home</a>
                                                </div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-12 p-0"><span class="text-muted">Don't have an account? <a href="<?php echo $base_url; ?>registration">Registration</a></span></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php $this->load->view('new_common/js_links', array('base_url' => $base_url)); ?>
        <script type="text/javascript">
            basicConfigurationForLogin();
        </script>
    </body>
</html>