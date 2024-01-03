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
                            <div class="col-12 text-center mx-auto d-flex align-items-center">
                                <div class="w-100">
                                    <div class="mb-2"><i class="fa fa-<?php echo $pg_icon; ?> fa-5x <?php echo $pg_class; ?>"></i></div>
                                    <h2 class="<?php echo $pg_class; ?>"><?php echo $pg_title; ?></h2>
                                    <h4><?php echo $pg_message; ?></h4>
                                    <a class="btn btn-grad text-white mt-3" href="<?php echo $base_url; ?>main?<?php echo $redirect_url; ?>">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php $this->load->view('new_common/js_links', array('base_url' => $base_url)); ?>
    </body>
</html>