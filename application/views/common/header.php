<?php $base_url = base_url(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>EODB Single Window Portal : Dadra and Nagar Haveli and Daman and Diu</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->load->view('common/css_links', array('base_url' => $base_url)); ?>
        <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/datetimepicker/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/osm/leaflet.css">
        <?php
        $this->load->view('common/utility_template');
        $this->load->view('common/js_links', array('base_url' => $base_url));
        ?>
        <script src="<?php echo $base_url; ?>js/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>adminLTE/js/demo.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>plugins/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>plugins/osm/leaflet.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>plugins/select2/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>js/mordanizr.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>js/underscore.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>js/backbone.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>js/handlebars.js" type="text/javascript"></script>
        <?php $this->load->view('common/validation_message'); ?>
        <script type = "text/javascript">
            var tempIdInSession = '<?php echo get_from_session('temp_id_for_eodbsws'); ?>';
            var optionTemplate = Handlebars.compile($('#option_template').html());
            var tagSpinnerTemplate = Handlebars.compile($('#tag_spinner_template').html());
            var spinnerTemplate = Handlebars.compile($('#spinner_template').html());
            var noRecordFoundTemplate = Handlebars.compile($('#no_record_found_template').html());
            var pageSpinnerTemplate = Handlebars.compile($('#page_spinner_template').html());
            var mRefDocListTemplate = Handlebars.compile($('#m_ref_doc_list_template').html());
            var mRefDocItemTemplate = Handlebars.compile($('#m_ref_doc_item_template').html());
            var mDocListTemplate = Handlebars.compile($('#m_doc_list_template').html());
            var mDocItemTemplate = Handlebars.compile($('#m_doc_item_template').html());
            var mDocItemViewTemplate = Handlebars.compile($('#m_doc_item_view_template').html());
            var mOtherDocListTemplate = Handlebars.compile($('#m_other_doc_list_template').html());
            var mOtherDocItemTemplate = Handlebars.compile($('#m_other_doc_item_template').html());
            var mOtherDocItemViewTemplate = Handlebars.compile($('#m_other_doc_item_view_template').html());
            var feedbackRatingTemplate = Handlebars.compile($('#feedback_rating_template').html());
            var iconSpinnerTemplate = spinnerTemplate({'type': 'light', 'extra_class': 'spinner-border-small'});
            var IS_DELETE = <?php echo IS_DELETE ?>;

            var talukaArray = <?php echo json_encode($this->config->item('taluka_array')); ?>;
            var TALUKA_DAMAN = <?php echo TALUKA_DAMAN; ?>;
            var TALUKA_DIU = <?php echo TALUKA_DIU; ?>;
            var TALUKA_DNH = <?php echo TALUKA_DNH; ?>;

            var isChecked = <?php echo IS_CHECKED_YES ?>;

            var DAMAN_LAT = <?php echo DAMAN_LAT ?>;
            var DAMAN_LNG = <?php echo DAMAN_LNG ?>;

            var fbCnt = 1;
            var fbListTemplate = Handlebars.compile($('#fb_list_template').html());
            var fbItemTemplate = Handlebars.compile($('#fb_item_template').html());
            var phListTemplate = Handlebars.compile($('#ph_list_template').html());
            var phItemTemplate = Handlebars.compile($('#ph_item_template').html());
            var pgStatusTextArray = <?php echo json_encode($this->config->item('pg_status_text_array')); ?>;

            var appStatusArray = <?php echo json_encode($this->config->item('app_status_array')); ?>;
            var renewalStatusArray = <?php echo json_encode($this->config->item('renewal_status_array')); ?>;

            var VALUE_ZERO = <?php echo VALUE_ZERO; ?>;
            var VALUE_ONE = <?php echo VALUE_ONE; ?>;
            var VALUE_TWO = <?php echo VALUE_TWO; ?>;
            var VALUE_THREE = <?php echo VALUE_THREE; ?>;
            var VALUE_FOUR = <?php echo VALUE_FOUR; ?>;
            var VALUE_FIVE = <?php echo VALUE_FIVE; ?>;
            var VALUE_SIX = <?php echo VALUE_SIX; ?>;
            var VALUE_SEVEN = <?php echo VALUE_SEVEN; ?>;
            var VALUE_EIGHT = <?php echo VALUE_EIGHT; ?>;
            var VALUE_NINE = <?php echo VALUE_NINE; ?>;
            var VALUE_TEN = <?php echo VALUE_TEN; ?>;
            var VALUE_ELEVEN = <?php echo VALUE_ELEVEN; ?>;
            var VALUE_TWELVE = <?php echo VALUE_TWELVE; ?>;
            var VALUE_THIRTEEN = <?php echo VALUE_THIRTEEN; ?>;
            var VALUE_FOURTEEN = <?php echo VALUE_FOURTEEN; ?>;
            var VALUE_FIFTEEN = <?php echo VALUE_FIFTEEN; ?>;
            var VALUE_SIXTEEN = <?php echo VALUE_SIXTEEN; ?>;
            var VALUE_SEVENTEEN = <?php echo VALUE_SEVENTEEN; ?>;
            var VALUE_EIGHTEEN = <?php echo VALUE_EIGHTEEN; ?>;
            var VALUE_NINETEEN = <?php echo VALUE_NINETEEN; ?>;
            var VALUE_TWENTY = <?php echo VALUE_TWENTY; ?>;
            var VALUE_TWENTYONE = <?php echo VALUE_TWENTYONE; ?>;
            var VALUE_TWENTYTWO = <?php echo VALUE_TWENTYTWO; ?>;
            var VALUE_TWENTYTHREE = <?php echo VALUE_TWENTYTHREE; ?>;
            var VALUE_TWENTYFOUR = <?php echo VALUE_TWENTYFOUR; ?>;
            var VALUE_TWENTYFIVE = <?php echo VALUE_TWENTYFIVE; ?>;
            var VALUE_TWENTYSIX = <?php echo VALUE_TWENTYSIX; ?>;
            var VALUE_TWENTYSEVEN = <?php echo VALUE_TWENTYSEVEN; ?>;
            var VALUE_TWENTYEIGHT = <?php echo VALUE_TWENTYEIGHT; ?>;
            var VALUE_TWENTYNINE = <?php echo VALUE_TWENTYNINE; ?>;
            var VALUE_THIRTY = <?php echo VALUE_THIRTY; ?>;
            var VALUE_THIRTYONE = <?php echo VALUE_THIRTYONE; ?>;
            var VALUE_THIRTYTWO = <?php echo VALUE_THIRTYTWO; ?>;
            var VALUE_THIRTYTHREE = <?php echo VALUE_THIRTYTHREE; ?>;
            var VALUE_THIRTYFOUR = <?php echo VALUE_THIRTYFOUR; ?>;
            var VALUE_THIRTYFIVE = <?php echo VALUE_THIRTYFIVE; ?>;
            var VALUE_THIRTYSIX = <?php echo VALUE_THIRTYSIX; ?>;
            var VALUE_THIRTYSEVEN = <?php echo VALUE_THIRTYSEVEN; ?>;
            var VALUE_THIRTYEIGHT = <?php echo VALUE_THIRTYEIGHT; ?>;
            var VALUE_THIRTYNINE = <?php echo VALUE_THIRTYNINE; ?>;
            var VALUE_FOURTY = <?php echo VALUE_FOURTY; ?>;
            var VALUE_FOURTYONE = <?php echo VALUE_FOURTYONE; ?>;
            var VALUE_FOURTYTWO = <?php echo VALUE_FOURTYTWO; ?>;
            var VALUE_FOURTYTHREE = <?php echo VALUE_FOURTYTHREE; ?>;
            var VALUE_FOURTYFOUR = <?php echo VALUE_FOURTYFOUR; ?>;
            var VALUE_FOURTYFIVE = <?php echo VALUE_FOURTYFIVE; ?>;
            var VALUE_FOURTYSIX = <?php echo VALUE_FOURTYSIX; ?>;
            var VALUE_FOURTYSEVEN = <?php echo VALUE_FOURTYSEVEN; ?>;
            var VALUE_FOURTYEIGHT = <?php echo VALUE_FOURTYEIGHT; ?>;
            var VALUE_FOURTYNINE = <?php echo VALUE_FOURTYNINE; ?>;
            var VALUE_FIFTY = <?php echo VALUE_FIFTY; ?>;
            var VALUE_FIFTYONE = <?php echo VALUE_FIFTYONE; ?>;
            var VALUE_FIFTYTWO = <?php echo VALUE_FIFTYTWO; ?>;
            var VALUE_FIFTYNINE = <?php echo VALUE_FIFTYNINE; ?>;
            var VALUE_SIXTY = <?php echo VALUE_SIXTY; ?>;
            var VALUE_SIXTYONE = <?php echo VALUE_SIXTYONE; ?>;

            var IS_CHECKED_YES = <?php echo IS_CHECKED_YES; ?>;
            var IS_CHECKED_NO = <?php echo IS_CHECKED_NO; ?>;
            var MALE = <?php echo MALE; ?>;
            var FEMALE = <?php echo FEMALE; ?>;

            var maxFileSizeInKb = <?php echo MAX_FILE_SIZE_IN_KB; ?>;
            var maxFileSizeInMb = <?php echo MAX_FILE_SIZE_IN_MB; ?>;

            var ADMIN_REPAIRER_DOC_PATH = '<?php echo ADMIN_REPAIRER_DOC_PATH; ?>';
            var ADMIN_DEALER_DOC_PATH = '<?php echo ADMIN_DEALER_DOC_PATH; ?>';
            var ADMIN_MANUFACT_DOC_PATH = '<?php echo ADMIN_MANUFACT_DOC_PATH; ?>';
            var ADMIN_WMREG_DOC_PATH = '<?php echo ADMIN_WMREG_DOC_PATH; ?>';
            var ADMIN_WC_DOC_PATH = '<?php echo ADMIN_WC_DOC_PATH; ?>';
            var ADMIN_CINEMA_DOC_PATH = '<?php echo ADMIN_CINEMA_DOC_PATH; ?>';
            var ADMIN_HOTELREGI_DOC_PATH = '<?php echo ADMIN_HOTELREGI_DOC_PATH; ?>';
            var ADMIN_PSFREG_DOC_PATH = '<?php echo ADMIN_PSFREG_DOC_PATH; ?>';
            var ADMIN_MSME_DOC_PATH = '<?php echo ADMIN_MSME_DOC_PATH; ?>';
            var ADMIN_TEXTILE_DOC_PATH = '<?php echo ADMIN_TEXTILE_DOC_PATH; ?>';
            var ADMIN_NOC_DOC_PATH = '<?php echo ADMIN_NOC_DOC_PATH; ?>';
            var ADMIN_TRANSFER_DOC_PATH = '<?php echo ADMIN_TRANSFER_DOC_PATH; ?>';
            var ADMIN_SUBLETTING_DOC_PATH = '<?php echo ADMIN_SUBLETTING_DOC_PATH; ?>';
            var ADMIN_SUBLESSEE_DOC_PATH = '<?php echo ADMIN_SUBLESSEE_DOC_PATH; ?>';
            var ADMIN_SELLER_DOC_PATH = '<?php echo ADMIN_SELLER_DOC_PATH; ?>';
            var ADMIN_TRAVELAGENT_DOC_PATH = '<?php echo ADMIN_TRAVELAGENT_DOC_PATH; ?>';
            var ADMIN_FILMSHOOTING_DOC_PATH = '<?php echo ADMIN_FILMSHOOTING_DOC_PATH; ?>';
            var ADMIN_PROPERTY_DOC_PATH = '<?php echo ADMIN_PROPERTY_DOC_PATH; ?>';
            var ADMIN_TOURISMEVENT_DOC_PATH = '<?php echo ADMIN_TOURISMEVENT_DOC_PATH; ?>';
            var ADMIN_OCCUPANCY_DOC_PATH = '<?php echo ADMIN_OCCUPANCY_DOC_PATH; ?>';
            var ADMIN_INSPECTION_DOC_PATH = '<?php echo ADMIN_INSPECTION_DOC_PATH; ?>';
            var ADMIN_CONSTRUCTION_DOC_PATH = '<?php echo ADMIN_CONSTRUCTION_DOC_PATH; ?>';
            var ADMIN_SITE_DOC_PATH = '<?php echo ADMIN_SITE_DOC_PATH; ?>';
            var ADMIN_ZONE_DOC_PATH = '<?php echo ADMIN_ZONE_DOC_PATH; ?>';
            var ADMIN_LANDALLOTMENT_DOC_PATH = '<?php echo ADMIN_LANDALLOTMENT_DOC_PATH; ?>';
            var ADMIN_SHOP_DOC_PATH = '<?php echo ADMIN_SHOP_DOC_PATH; ?>';
            var ADMIN_BOCW_DOC_PATH = '<?php echo ADMIN_BOCW_DOC_PATH; ?>';
            var ADMIN_FACTORY_DOC_PATH = '<?php echo ADMIN_FACTORY_DOC_PATH; ?>';
            var ADMIN_BUILD_DOC_PATH = '<?php echo ADMIN_BUILD_DOC_PATH; ?>';
            var ADMIN_BOILER_DOC_PATH = '<?php echo ADMIN_BOILER_DOC_PATH; ?>';
            var ADMIN_MIGRANTWORKERS_DOC_PATH = '<?php echo ADMIN_MIGRANTWORKERS_DOC_PATH; ?>';
            var ADMIN_BOILER_MANUFACT_DOC_PATH = '<?php echo ADMIN_BOILER_MANUFACT_DOC_PATH; ?>';
            var ADMIN_SINGLERETURN_DOC_PATH = '<?php echo ADMIN_SINGLERETURN_DOC_PATH; ?>';
            var ADMIN_CLACT_DOC_PATH = '<?php echo ADMIN_CLACT_DOC_PATH; ?>';
            var ADMIN_NA_DOC_PATH = '<?php echo ADMIN_NA_DOC_PATH; ?>';
            var ADMIN_APLICENCE_DOC_PATH = '<?php echo ADMIN_APLICENCE_DOC_PATH; ?>';
            var ADMIN_RII_DOC_PATH = '<?php echo ADMIN_RII_DOC_PATH; ?>';
            var ADMIN_VC_DOC_PATH = '<?php echo ADMIN_VC_DOC_PATH; ?>';
            var ADMIN_PR_DOC_PATH = '<?php echo ADMIN_PR_DOC_PATH; ?>';
            var ADMIN_IPS_INC_DOC_PATH = '<?php echo ADMIN_IPS_INC_DOC_PATH; ?>';
            var ADMIN_TREE_CUTTING_DOC_PATH = '<?php echo ADMIN_TREE_CUTTING_DOC_PATH; ?>';
            var ADMIN_SOCIETY_REGISTRATION_DOC_PATH = '<?php echo ADMIN_SOCIETY_REGISTRATION_DOC_PATH; ?>';
            var ADMIN_NIL_CERTIFICATE_DOC_PATH = '<?php echo ADMIN_NIL_CERTIFICATE_DOC_PATH; ?>';

            var QUERY_PATH = '<?php echo QUERY_PATH; ?>';

            var premisesStatusArray = <?php echo json_encode($this->config->item('premises_status_array')); ?>;
            var identityChoiceArray = <?php echo json_encode($this->config->item('identity_choice_array')); ?>;
            var userPaymentTypeArray = <?php echo json_encode($this->config->item('user_payment_type_array')); ?>;
            var tradeArray = <?php echo json_encode($this->config->item('trade_array')); ?>;
            var capacityTypeArray = <?php echo json_encode($this->config->item('capacity_type_array')); ?>;
            var classArray = <?php echo json_encode($this->config->item('class_array')); ?>;
            var verificationPlaceArray = <?php echo json_encode($this->config->item('verification_place_array')); ?>;
            var quantityUnitsArray = <?php echo json_encode($this->config->item('quantity_units_array')); ?>;

            var queryFormTemplate = Handlebars.compile($('#query_form_template').html());
            var queryQuestionViewTemplate = Handlebars.compile($('#query_question_view_template').html());
            var queryAnswerTemplate = Handlebars.compile($('#query_answer_template').html());
            var queryAnswerViewTemplate = Handlebars.compile($('#query_answer_view_template').html());
            var documentItemTemplate = Handlebars.compile($('#document_item_template').html());
            var documentItemViewTemplate = Handlebars.compile($('#document_item_view_template').html());
            var queryStatusArray = <?php echo json_encode($this->config->item('query_status_array')); ?>;
            var prefixModuleArray = <?php echo json_encode($this->config->item('prefix_module_array')); ?>;
            var partyTypeArray = <?php echo json_encode($this->config->item('party_type_array')); ?>;

            var INDUSTRY_TYPE_ARRAY = <?php echo json_encode($this->config->item('industry_type_array')); ?>;
            var INDUSTRY_TYPE_REMARK_ARRAY = <?php echo json_encode($this->config->item('industry_type_remark_array')); ?>;

            var treadeArray = <?php echo json_encode($this->config->item('trade_type_array')); ?>;
            var reportArray = <?php echo json_encode($this->config->item('report_type_array')); ?>;


            var constitutionArray = <?php echo json_encode($this->config->item('constitution_array')); ?>;
            var unitCategoryArray = <?php echo json_encode($this->config->item('unit_category_array')); ?>;
            var entrepreneurCategoryArray = <?php echo json_encode($this->config->item('entrepreneur_category_array')); ?>;
            var unitTypeArray = <?php echo json_encode($this->config->item('unit_type_array')); ?>;
            var sectorCategoryArray = <?php echo json_encode($this->config->item('sector_category_array')); ?>;
            var thrustSectorsArray = <?php echo json_encode($this->config->item('thrust_sectors_array')); ?>;
            var ownerCategoryArray = <?php echo json_encode($this->config->item('owner_category_array')); ?>;
            var casteCategoryArray = <?php echo json_encode($this->config->item('caste_category_array')); ?>;
            var socialStatusArray = <?php echo json_encode($this->config->item('social_status_array')); ?>;
            var cbTypeArray = <?php echo json_encode($this->config->item('cb_type_array')); ?>;
            var msmeTypeArray = <?php echo json_encode($this->config->item('msme_type_array')); ?>;
            var msmeDocumentArray = <?php echo json_encode($this->config->item('msme_document_array')); ?>;
            var ipsDocumentArray = <?php echo json_encode($this->config->item('ips_document_array')); ?>;
            var entityEstablishmentTypeArray = <?php echo json_encode($this->config->item('entity_establishment_type_array')); ?>;

            var schemeTypeArray = <?php echo json_encode($this->config->item('scheme_type_array')); ?>;
            var schemeArray = <?php echo json_encode($this->config->item('scheme_array')); ?>;
            var schemeRefDocArray = <?php echo json_encode($this->config->item('scheme_ref_doc_array')); ?>;
            var schemeDocArray = <?php echo json_encode($this->config->item('scheme_doc_array')); ?>;

            var moduleRefDocArray = <?php echo json_encode($this->config->item('module_ref_doc_array')); ?>;
            var moduleDocArray = <?php echo json_encode($this->config->item('module_doc_array')); ?>;

            var damanVillagesArray = <?php echo json_encode($this->config->item('daman_village_array')); ?>;
            var diuVillagesArray = <?php echo json_encode($this->config->item('diu_village_array')); ?>;
            var dnhVillagesArray = <?php echo json_encode($this->config->item('dnh_village_array')); ?>;
            
            var ratingArray = <?php echo json_encode($this->config->item('rating_array')); ?>;

            var socRegUlStatusArray = <?php echo json_encode($this->config->item('soc_reg_ul_status_array')); ?>;
            var documentRowCnt = 1;
            var mOtherDocRowCnt = 1;
            var VIEW_UPLODED_DOCUMENT = '<?php echo VIEW_UPLODED_DOCUMENT; ?>';
            var AT_WILL = '<?php echo AT_WILL; ?>';
            var tempStateData = [];
            var tempDistrictData = [];
            var tempPlotData = [];
            var tempVillagesData = [];

            var TRAVEL_AGENCY_FEES = '<?php echo TRAVEL_AGENCY_FEES; ?>';


            var ESTATE_GOVERNMENT = <?php echo ESTATE_GOVERNMENT; ?>;
            var ESTATE_PRIVATE = <?php echo ESTATE_PRIVATE; ?>;
            var ESTATE_OTHER = <?php echo ESTATE_OTHER; ?>;
            var CATEGORY_SC = <?php echo CATEGORY_SC; ?>;
            var CATEGORY_ST = <?php echo CATEGORY_ST; ?>;
            var CATEGORY_OBC = <?php echo CATEGORY_OBC; ?>;
            var CATEGORY_GENERAL = <?php echo CATEGORY_GENERAL; ?>;
            var O_PROPRIETARY = <?php echo O_PROPRIETARY; ?>;
            var O_PARTNERSHIP = <?php echo O_PARTNERSHIP; ?>;
            var O_PRIVATE_LIMITED = <?php echo O_PRIVATE_LIMITED; ?>;
            var O_PUBLIC_LIMITED = <?php echo O_PUBLIC_LIMITED; ?>;
            var O_CO_OPERATIVE = <?php echo O_CO_OPERATIVE; ?>;
            var O_SELF_HALP_GROUP = <?php echo O_SELF_HALP_GROUP; ?>;
            var O_HUF = <?php echo O_HUF; ?>;
            var O_OTHERS = <?php echo O_OTHERS; ?>;
            var PCC_RED = <?php echo PCC_RED; ?>;
            var PCC_ORANGE = <?php echo PCC_ORANGE; ?>;
            var PCC_GREEN = <?php echo PCC_GREEN; ?>;
            var SOLID_WASTE = <?php echo SOLID_WASTE; ?>;
            var HAZARDOUS_WASTE = <?php echo HAZARDOUS_WASTE; ?>;
            var E_WASTE = <?php echo E_WASTE; ?>;
            var NA_WASTE = <?php echo NA_WASTE; ?>;
            var GENDER_MALE = <?php echo GENDER_MALE; ?>;
            var GENDER_FEMALE = <?php echo GENDER_FEMALE; ?>;
            var GENDER_OTHER = <?php echo GENDER_OTHER; ?>;

            $(document).ready(function () {
                getCommonData();
            });

            var tDistrict = '<?php echo isset($t_district) ? $t_district : ""; ?>';
            var tMT = '<?php echo isset($t_mt) ? $t_mt : ""; ?>';
            var tMS = '<?php echo isset($t_ms) ? $t_ms : ""; ?>';
            var tMI = '<?php echo isset($t_mi) ? $t_mi : ""; ?>';
        </script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div id="full_page_overlay_div" class="overlay-full-page text-center">
            <div style="margin-top: 20%;">
                <i class="fa fa-spinner fa-5x fa-spin text-white"></i>
            </div>
        </div>
        <?php $this->load->view('security'); ?>
        <script type="text/javascript">
            handleDataTableError();
        </script>
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" id="sidebar_button" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" style="padding-right: 10px;">
                    <li class="nav-item dropdown f-w-b color-black">
                        Logged User: <?php echo get_from_session('name'); ?>
                    </li>
                </ul>
            </nav>
            <form id="qwertyuioplkjhfgazcxzc" method="post" action="<?php echo PG_URL ?>">
                <input type="hidden" name="EncryptTrans" id="temp_op_enct" class="null-pdjshdjs">
                <input type="hidden" name="MultiAccountInstructionDtls" id="temp_op_mt" class="null-pdjshdjs">
                <input type="hidden" name="merchIdVal" id="temp_op_mmptd" class="null-pdjshdjs">
            </form>
            <button type="button" style="display: none;" id="temp_btn"></button>
            <?php $this->load->view('common/sidebar'); ?>
            <div class="modal fade" id="popup_modal" style="padding-right: 0px !important;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="model_title" class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    onclick="resetModel();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="model_body" class="modal-body">
                        </div>
                    </div>
                </div>
            </div>