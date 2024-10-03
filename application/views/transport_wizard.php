<?php
$base_url = base_url();
$this->load->view('new_common/header', array('base_url' => $base_url, 'swp' => 'active'));
?>
<script src="<?php echo $base_url; ?>js/mordanizr.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>js/underscore.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>js/backbone.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>js/handlebars.js" type="text/javascript"></script>
<?php
$this->load->view('common/validation_message');
$this->load->view('common/utility_template');
$this->load->view('security');
?>

<div class="innerpage-banner center bg-overlay-dark-7 py-5" style="background:url(<?php echo $base_url; ?>assets/images/bg/04.jpg) no-repeat; background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-left">
                        <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>home"><i class="ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Decriminalization Wizard</li>
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
                <div class="title text-left">
                    <h2 class="fs-30px text-grad">Decriminalization Wizard</h2>
                    <hr>
                    <div id="transport_form_template">
                        <div class="row">
                            <div class="col-sm-4 col-md-3 form-group">
                                <label class="mb-0">Select Motor Vehicle Act</label>
                                <select id="motor_vehical_act_for_transport" data-placeholder="Select Motor Vehicle Act !"
                                        onchange="checkValidation('transport', 'motor_vehical_act_for_transport', selectOneOptionValidationMessage);"
                                        class="custom-select select-big mb-0">
                                    <option value="">Select Motor Vehicle Act</option>
                                    <?php if (!empty($temp_transport_data)): ?>
                                        <?php foreach ($temp_transport_data as $act => $actd): ?>
                                            <option value="<?php echo $act; ?>"><?php echo $act; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="error-message error-message-transport-motor_vehical_act_for_transport"></span>
                            </div>
                            <div class="col-8">
                                <button type="button" class="btn btn-sm btn-success" id="show_act_btn_for_transport"
                                        style="margin-right: 5px;margin-top: 29px;" onclick="getMotorVehicalActData();">
                                    <i class="fa fa-eye mr-0"></i>&nbsp; Show
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="tw_item_main_container" style="display: none;">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table p-04 table-hover">
                        <thead class="all-text-white bg-grad">
                            <tr class="text-center">
                                <th class="v-a-m" style="width:1%;">Sr. No.</th>                                
                                <th class="v-a-m" style="width:5%;">Section  of Motor Vehicle Act, 1988 as amended in</th>
                                <th class="v-a-m" style="width:15%;">Description of the Section</th>
                                <th class="v-a-m" style="width:5%;">Two Wheeler </th>
                                <th class="v-a-m" style="width:5%;">Three Wheeler, LMV, LGV, LPV.; LMV(T) (Mini  Bus) </th>
                                <th class="v-a-m" style="width:5%;">MGV,MPV, HGV,HPV Tractors  and Trailers, Stage & Contract Carriages and all other types  of Vehicle</th>
                            </tr>                    
                        </thead>
                        <tbody id="transport_smv_act">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
<?php $this->load->view('new_common/footer', array('base_url' => $base_url)); ?>
<script type="text/javascript">
    var optionTemplate = Handlebars.compile($('#option_template').html());
    var spinnerTemplate = Handlebars.compile($('#spinner_template').html());
    var iconSpinnerTemplate = spinnerTemplate({'type': 'light', 'extra_class': 'spinner-border-small'});

    var transportData = JSON.parse('<?php echo json_encode($temp_transport_data); ?>');

    function getMotorVehicalActData() {
        $('#tw_item_main_container').hide();
        var smvAct = $('#motor_vehical_act_for_transport').val();
        if (!smvAct) {
            $('#motor_vehical_act_for_transport').focus();
            validationMessageShow('transport-motor_vehical_act_for_transport', selectOneOptionValidationMessage);
            return false;
        }
        var smvActData = transportData[smvAct] ? transportData[smvAct] : [];
        var smvActDetailsHtml = '';
        $.each(smvActData, function (index, act) {
            act.temp_cnt = (index + 1);
            smvActDetailsHtml += '<tr>' +
                    '<td class="text-center">' + act.temp_cnt + '</td>' +
                    '<td class="text-center">' + act.smv_act + '</td>' +
                    '<td class="text-center">' + act.smv_description + '</td>' +
                    '<td class="text-center">' + act.smv_tw + '</td>' +
                    '<td class="text-center">' + act.smv_lmgpv + '</td>' +
                    '<td class="text-center">' + act.smv_ov + '</td>' +
                    '</tr>';
        });
        $('#transport_smv_act').html(smvActDetailsHtml);
        $('#tw_item_main_container').show();
    }
</script>