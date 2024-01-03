<footer class="footer bg-light">
    <div class="footer-content pt-3">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-6 col-md-3 mb-3">
                    <a target="_blank" href="http://digitalindia.gov.in/">
                        <img src="<?php echo $base_url; ?>assets/images/img1.png" />
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <a target="_blank" href="https://swachhbharat.mygov.in/">
                        <img src="<?php echo $base_url; ?>assets/images/img2.png" />
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <a target="_blank" href="https://www.makeinindia.com/home">
                        <img src="<?php echo $base_url; ?>assets/images/img3.png" />
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <a target="_blank" href="https://swachhbharat.mygov.in/">
                        <img src="<?php echo $base_url; ?>assets/images/img4.png" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="divider"></div>
    <div class="footer-copyright">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-1 text-center text-md-left">
                <!-- copyright text -->
                <div class="copyright-text">Copyright © <?php echo date('Y') ?>. All Right Reserved.</div>
                <!-- copyright links-->
                <div class="copyright-links primary-hover mt-3 mt-md-0">
                    <ul class="list-inline">
                        <li class="list-inline-item pl-2"><a class="list-group-item-action" href="<?php echo $base_url; ?>about_us">About Us</a></li>
                        <li class="list-inline-item pl-2"><a class="list-group-item-action" href="Javascript:void(0)">Disclaimer</a></li>
                        <li class="list-inline-item pl-2"><a class="list-group-item-action" href="Javascript:void(0)">Payment Refund Policy</a></li>
                        <li class="list-inline-item pl-2"><a class="list-group-item-action" href="Javascript:void(0)">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="copyright-links mt-3 mt-md-0">
                    <img src="<?php echo $base_url; ?>images/nic-logo.png" style="height: 40px;" />
                </div>
            </div>
        </div>
    </div>
</footer>
<div>
    <a href="#" class="back-top btn btn-grad"><i class="ti-angle-up"></i></a>
</div>
<?php
$this->load->view('new_common/js_links', array('base_url' => $base_url, 'all_css_and_js' => TRUE));
if (isset($is_handlebars)) {
    ?>
    <script src="<?php echo $base_url; ?>js/mordanizr.js" type="text/javascript"></script>
    <script src="<?php echo $base_url; ?>js/underscore.js" type="text/javascript"></script>
    <script src="<?php echo $base_url; ?>js/backbone.js" type="text/javascript"></script>
    <script src="<?php echo $base_url; ?>js/handlebars.js" type="text/javascript"></script>
<?php } ?>
</body>
</html>