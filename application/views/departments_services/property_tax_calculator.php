<?php
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url, 'departments' => 'active'));
$this->load->view('common/validation_message');
?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Departments</li>
                        <li class="breadcrumb-item">Municipal Councils</li>
                        <li class="breadcrumb-item">Property Tax Calculator</li>
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
                    <h2 class="fs-30px text-grad">Property Tax Calculator</h2>
                    <h6 class="lh-15">Facility to auto-calculate the levy area wise with online payment of property tax.</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center mb-2">
                <span class="error-message error-message-ptc f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
            <div class="col-sm-12 text-center mb-2">
                <button type="button" class="btn btn-grad btn-sm m-b-0px pull-right"
                        onclick="refreshTaxCalculation();">
                    <i class="fa fa-refresh"></i>Refresh
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table p-04 table-hover mb-2">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="text-center v-a-m" style="width: 60px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="min-width: 180px;">Property Use <span class="color-nic-red">*</span></th>
                                <th class="text-center v-a-m" style="min-width: 180px;">Roofing Type <span class="color-nic-red">*</span></th>
                                <th class="text-center v-a-m" style="min-width: 180px;">Covered / Built-Up Area in Square Meter <span class="color-nic-red">*</span></th>
                                <th class="text-center v-a-m" style="min-width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="property_tax_items_container"></tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success btn-sm m-b-0px pull-right"
                        id="add_more_property_button_for_ptc" onclick="addMorePropertyItem();">
                    <i class="fa fa-plus"></i>Add More
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-grad btn-sm m-b-0px" id="calculate_tax_button_for_ptc"
                        onclick="calculateTax();">
                    <i class="fa fa-percent"></i>Calculate Tax
                </button>
                <a target="_blank" href="https://sampark.dmcdaman.in/#/propertytax/paymentlist"
                   class="btn btn-success btn-sm m-b-0px">
                    <i class="fa fa-rupee"></i>Pay Tax
                </a>
            </div>
        </div>
    </div>
</section>
<section class="pt-0 pb-4">
    <div class="container">
    </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url, 'is_handlebars' => true)); ?>
<script id="property_tax_calculator_row_template" type="text/x-handlebars-template">
    <?php $this->load->view('departments_services/property_tax_calculator_row'); ?>
</script>
<script type="text/javascript">
    var dmcPropertyTypeArray = <?php echo json_encode($this->config->item('dmc_property_type_array')); ?>;
    var dmcPropertyTaxPerArray = <?php echo json_encode($this->config->item('dmc_property_tax_per_array')); ?>;
    var roofingTypeArray = <?php echo json_encode($this->config->item('roofing_type_array')); ?>;
    var dmcPropertyTaxArray = <?php echo json_encode($this->config->item('dmc_property_tax_array')); ?>;

    var tempCnt = 1;
    var propertyTaxCalRowTemplate = Handlebars.compile($('#property_tax_calculator_row_template').html());
    $('#property_tax_items_container').html('');
    addMorePropertyItem();

    function addMorePropertyItem() {
        validationMessageShow('ptc', '');
        var templateData = {};
        templateData.row_cnt = tempCnt;
        $('#property_tax_items_container').append(propertyTaxCalRowTemplate(templateData));
        renderOptionsForTwoDimensionalArray(dmcPropertyTypeArray, 'property_use_for_ptc_' + tempCnt, false);
        renderOptionsForTwoDimensionalArray(roofingTypeArray, 'roofing_type_for_ptc_' + tempCnt, false);
        resetCounter('row-cnt-display');
        tempCnt++;
    }

    function removePropertyItem(rowCnt) {
        validationMessageShow('ptc', '');
        var totalCnt = getTotalRowColunt('property_tax_items');
        if (totalCnt == 2) {
            validationMessageShow('ptc', taxOneRowValidationMessage);
            return false;
        }
        $('#property_tax_items_' + rowCnt).remove();
        resetCounter('row-cnt-display');
    }

    function refreshTaxCalculation() {
        validationMessageHide();
        $('#add_more_property_button_for_ptc').show();
        resetCalculateButton();
        $('#property_tax_items_container').html('');
        addMorePropertyItem();
    }

    function resetCalculateButton() {
        $('#calculate_tax_button_for_ptc').html('<i class="fa fa-percent"></i>Calculate Tax');
    }

    function calculateTax() {
        validationMessageHide();

        var taxItems = [];
        var isTaxValidation = false;
        var totalTax = 0;
        $('.property_tax_items').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var taxInfo = {};
            var propertyUse = $('#property_use_for_ptc_' + cnt).val();
            if (propertyUse == '' || propertyUse == null) {
                $('#property_use_for_ptc_' + cnt).focus();
                validationMessageShow('ptc-property_use_for_ptc_' + cnt, selectOneOptionValidationMessage);
                isTaxValidation = true;
                return false;
            }
            taxInfo.property_use = propertyUse;
            var roofingType = $('#roofing_type_for_ptc_' + cnt).val();
            if (roofingType == '' || roofingType == null) {
                $('#roofing_type_for_ptc_' + cnt).focus();
                validationMessageShow('ptc-roofing_type_for_ptc_' + cnt, selectOneOptionValidationMessage);
                isTaxValidation = true;
                return false;
            }
            taxInfo.roofing_type = roofingType;
            var area = parseFloat($('#area_for_ptc_' + cnt).val());
            if (area == '' || area == null || area == 0 || !area) {
                $('#area_for_ptc_' + cnt).focus();
                validationMessageShow('ptc-area_for_ptc_' + cnt, areaValidationMessage);
                isTaxValidation = true;
                return false;
            }
            var taxPercentage = dmcPropertyTaxPerArray[propertyUse] ? dmcPropertyTaxPerArray[propertyUse] : '';
            var tax = dmcPropertyTaxArray[roofingType] ? dmcPropertyTaxArray[roofingType] : '';
            if (!taxPercentage || !tax) {
                $('html, body, table').animate({scrollTop: '0px'}, 0);
                validationMessageShow('ptc', invalidAccessValidationMessage);
                return false;
            }
            taxInfo.area = area;
            taxItems.push(taxInfo);
            var capitalCost = area * tax;
            var rentPerAnnum = Math.round((capitalCost * 4) / 100);
            var rateableValue = Math.round((rentPerAnnum * 90) / 100);
            totalTax += Math.round((rateableValue * taxPercentage) / 100);
        });
        if (isTaxValidation) {
            return false;
        }
        if (taxItems.length == 0) {
            $('html, body, table').animate({scrollTop: '0px'}, 0);
            validationMessageShow('ptc', taxOneRowValidationMessage);
            return false;
        }
        $('.ptc-attr').attr("disabled", 'disabled');
        $('.ptc-attr-remove-button').remove();
        $('#add_more_property_button_for_ptc').hide();
        $('#calculate_tax_button_for_ptc').html('Total Tax : Rs. ' + totalTax + '/-');
    }
</script>