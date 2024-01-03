<?php $base_url = base_url(); ?>
<?php $this->load->view('new_common/header', array('base_url' => $base_url, 'swp' => 'active')); ?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Single Window</li>
                        <li class="breadcrumb-item">Certificate Verification</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="feature-box f-style-2 icon-grad h-100">
                            <h4 class="text-center text-primary">Certificate Verification</h4>
                            <hr class="mb-1">
                            <div class="form mt-3">
                                <div>
                                    <div class="text-center mb-2">
                                        <span class="error-message error-message-everify font-weight-bold" style="border-bottom: 2px solid red;"></span>
                                    </div>
                                </div>
                                <form method="post" id="verify_number_form" autocomplete="off" onsubmit="return false;">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="mb-0" style="color: black;">Barcode / Certificate Number (9 Digit) 
                                                &nbsp;&nbsp; <span class="fa fa-question-circle-o color-nic-red"
                                                                   data-toggle="modal" data-target="#example_for_barcode_certificate_number"
                                                                   style="cursor: pointer;"></span></label>
                                            <input type="text" id="barcode_number_for_everify" name="barcode_number_for_everify"
                                                   class="form-control mb-0" placeholder="Enter Barcode / Certificate Number" maxlength="9" 
                                                   onblur="checkValidation('everify', 'barcode_number_for_everify', enterBarcodeNumberValidationMessage);">
                                            <span class="error-message error-message-everify-barcode_number_for_everify"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-grad mb-0 btn-block" id="verify_number_btn"
                                                    onclick="verifyNumber($(this));">Verify</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <aside class="col-md-4 sidebar order-3 order-md-2 mb-5">
                <div class="feature-box f-style-2 icon-grad h-100">
                    <h5 class="mb-0 text-grad">Sanction Order of Incentives</h5>
                    <hr>
                    <a class="mb-2 cursor-pointer text-dark" href="assets/Order_Dated_30032022.pdf" target="_blank">1. Order Dated 30-03-2022</a>
                    <a class="mb-2 cursor-pointer text-dark" href="assets/Order_Dated_28032023.pdf" target="_blank">2. Order Dated 28-03-2023</a>
                </div>
            </aside>
        </div>
    </div>
</section>
<div class="modal fade text-left" id="example_for_barcode_certificate_number" tabindex="-1" role="dialog" aria-labelledby="example_for_barcode_certificate_number" aria-hidden="true">
    <div class="modal-dialog" role="document"
         style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Get Barcode / Certificate Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?php echo base_url() ?>images/barcode_certificate_number.png" style="border: 1px solid #b5b0b0;" />
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>
<script type="text/javascript">
    var baseURL = '<?php echo base_url(); ?>';
    var enterBarcodeNumberValidationMessage = '<?php echo ENTER_BARCODE_NUMBER_MESSAGE; ?>';
    var enterProperNumberValidationMessage = '<?php echo ENTER_PROPER_NUMBER_MESSAGE; ?>';
    var invalidBarcodeNumberValidationMessage = '<?php echo INVALID_BARCODE_NUMBER_MESSAGE; ?>';
    allowOnlyIntegerValue('barcode_number_for_everify');

    $('#verify_number_form').find('input').keypress(function (e) {
        if (e.which == 13) {
            verifyNumber($('#verify_number_btn'));
        }
    });

    function checkValidationForNumber(barcodeCertificateNumber) {
        if (!barcodeCertificateNumber) {
            return getBasicMessageAndFieldJSONArray('barcode_number_for_everify', enterBarcodeNumberValidationMessage);
        }
        if (barcodeCertificateNumber.length != 9) {
            return getBasicMessageAndFieldJSONArray('barcode_number_for_everify', enterProperNumberValidationMessage);
        }
        return '';
    }

    function verifyNumber(btnObj) {
        validationMessageHide();
        var bcNumber = $('#barcode_number_for_everify').val();
        var validationData = checkValidationForNumber(bcNumber);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('everify-' + validationData.field, validationData.message);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html('Processing..');
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: "everify/check_number_for_everify",
            data: {'verification_number': bcNumber},
            error: function (textStatus, errorThrown) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('everify-barcode_number_for_everify', textStatus.statusText);
            },
            success: function (data) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    validationMessageShow('everify-barcode_number_for_everify', parseData.message);
                    return false;
                }
                $('#barcode_number_for_everify').val('');
                window.open(baseURL + 'everify?ev=' + bcNumber, '_blank');
            }
        });
    }
</script>