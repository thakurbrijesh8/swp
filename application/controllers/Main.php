<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('dashboard_model');
    }

    public function index() {
        $t_district = isset($_GET['d']) ? get_decrypt_id($_GET['d']) : '';
        $t_mt = isset($_GET['mt']) ? get_decrypt_id($_GET['mt']) : '';
        $t_ms = isset($_GET['ms']) ? get_decrypt_id($_GET['ms']) : '';
        $t_mi = isset($_GET['mi']) ? get_decrypt_id($_GET['mi']) : '';
        $query_module_array = $this->config->item('query_module_array');
        $temp_array = array();
        if (($t_district == TALUKA_DAMAN || $t_district == TALUKA_DIU || $t_district == TALUKA_DNH) &&
                isset($query_module_array[$t_mt]) && ($t_ms == VALUE_THREE || $t_ms == VALUE_FOUR) && ($t_mi != '' && $t_mi != 0)) {
            $temp_array['t_district'] = $t_district;
            $temp_array['t_mt'] = $t_mt;
            $temp_array['t_ms'] = $t_ms;
            $temp_array['t_mi'] = $t_mi;
        }
        $this->load->view('common/header', $temp_array);
        $this->load->view('main/main');
        $this->load->view('common/footer');
        $this->load->view('common/backbone_footer');
    }

    function _total_type_basic_array($type, &$success_array) {
        $success_array['total_' . $type . '_draft_app'] = 0;
        $success_array['total_' . $type . '_submitted_app'] = 0;
        $success_array['total_' . $type . '_fees_pending_app'] = 0;
        $success_array['total_' . $type . '_pay_at_office_app'] = 0;
        $success_array['total_' . $type . '_fees_paid_app'] = 0;
        $success_array['total_' . $type . '_fess_na_app'] = 0;
        $success_array['total_' . $type . '_payment_confirmed_app'] = 0;
        $success_array['total_' . $type . '_approved_app'] = 0;
        $success_array['total_' . $type . '_rejected_app'] = 0;
        $success_array['total_' . $type . '_queried_app'] = 0;
        $success_array['total_' . $type . '_withdraw_app'] = 0;
    }

    function get_dashboard_data() {
        $session_user_id = get_from_session('temp_id_for_eodbsws');
        $success_array = array();
        $success_array['success'] = true;
        $success_array['dept_wise_app_details'] = array();
        $success_array['total_app'] = 0;
        $this->_total_type_basic_array('all', $success_array);
        $this->_total_type_basic_array('ot', $success_array);
        $this->_total_type_basic_array('delay', $success_array);
        $module_type_array = $this->config->item('query_module_array');
        $this->db->trans_start();
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_ONE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWO);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THREE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOUR);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTEEN);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FIFTEEN);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_SIXTEEN);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTYEIGHT);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTYNINE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FIFTY);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FIVE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_SIX);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTY);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_NINETEEN);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTYTHREE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTYFOUR);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_SEVEN);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTYONE);

        // Revenue & Collectorates
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_EIGHT);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTYTWO);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTY);

        // ARCS in Collectorates
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_SIXTY);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_SIXTYONE);

        // DIC Department
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_NINE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TEN);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTYFIVE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FIFTYTWO);
//        Hide Modules for DNH
//        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_ELEVEN);
//        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWELVE);
//        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTEEN);
//        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_SEVENTEEN);
//        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_EIGHTEEN);

        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTYSIX);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTYSEVEN);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTYEIGHT);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_TWENTYNINE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTY);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTYONE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTYTWO);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTYTHREE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTYTWO);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTYFOUR);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTYFIVE);
//        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTYNINE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTYTHREE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTYSIX);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTYFIVE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTYONE);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTYSIX);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTYSEVEN);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FOURTYFOUR);
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_THIRTYEIGHT);

        // Forest Department
        $this->_generate_ds_wise_array($session_user_id, $success_array, $module_type_array, VALUE_FIFTYNINE);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode($success_array);
            return;
        }
        echo json_encode($success_array);
    }

    function _get_type_wise_ba($type, &$dashboard_array) {
        $dashboard_array[$type . '_draft_app'] = 0;
        $dashboard_array[$type . '_submitted_app'] = 0;
        $dashboard_array[$type . '_fees_pending_app'] = 0;
        $dashboard_array[$type . '_fees_paid_app'] = 0;
        $dashboard_array[$type . '_approved_app'] = 0;
        $dashboard_array[$type . '_rejected_app'] = 0;
        $dashboard_array[$type . '_payment_confirmed_app'] = 0;
        $dashboard_array[$type . '_pay_at_office_app'] = 0;
        $dashboard_array[$type . '_fess_na_app'] = 0;
        $dashboard_array[$type . '_queried_app'] = 0;
        $dashboard_array[$type . '_withdraw_app'] = 0;
    }

    function _get_status_wise_basic_array() {
        $dashboard_array = array();
        $this->_get_type_wise_ba('all', $dashboard_array);
        $this->_get_type_wise_ba('ot', $dashboard_array);
        $this->_get_type_wise_ba('delay', $dashboard_array);
        $dashboard_array['total_app'] = 0;
        return $dashboard_array;
    }

    function _calculate_type_wise($type, $t_array, &$success_array, &$dashboard_array) {
        if (($t_array['status'] != VALUE_SIX && $t_array['status'] != VALUE_ELEVEN) &&
                ($t_array['query_status'] == VALUE_ONE || $t_array['query_status'] == VALUE_TWO)) {
            $dashboard_array[$t_array['district']][$type . '_queried_app'] += $t_array['total_records'];
            $success_array['total_' . $type . '_queried_app'] += $t_array['total_records'];
        } else {
            if ($t_array['status'] == VALUE_ZERO || $t_array['status'] == VALUE_ONE) {
                $dashboard_array[$t_array['district']][$type . '_draft_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_draft_app'] += $t_array['total_records'];
            }
            if ($t_array['status'] == VALUE_TWO) {
                $dashboard_array[$t_array['district']][$type . '_submitted_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_submitted_app'] += $t_array['total_records'];
            }
            if ($t_array['status'] == VALUE_THREE) {
                $dashboard_array[$t_array['district']][$type . '_fees_pending_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_fees_pending_app'] += $t_array['total_records'];
            }
            if ($t_array['status'] == VALUE_FOUR) {
                $dashboard_array[$t_array['district']][$type . '_fees_paid_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_fees_paid_app'] += $t_array['total_records'];
            }
            if ($t_array['status'] == VALUE_FIVE) {
                $dashboard_array[$t_array['district']][$type . '_approved_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_approved_app'] += $t_array['total_records'];
            }
            if ($t_array['status'] == VALUE_SIX) {
                $dashboard_array[$t_array['district']][$type . '_rejected_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_rejected_app'] += $t_array['total_records'];
            }
            if ($t_array['status'] == VALUE_SEVEN) {
                $dashboard_array[$t_array['district']][$type . '_payment_confirmed_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_payment_confirmed_app'] += $t_array['total_records'];
            }
            if ($t_array['status'] == VALUE_EIGHT) {
                $dashboard_array[$t_array['district']][$type . '_pay_at_office_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_pay_at_office_app'] += $t_array['total_records'];
            }
            if ($t_array['status'] == VALUE_NINE) {
                $dashboard_array[$t_array['district']][$type . '_fess_na_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_fess_na_app'] += $t_array['total_records'];
            }
            if ($t_array['status'] == VALUE_ELEVEN) {
                $dashboard_array[$t_array['district']][$type . '_withdraw_app'] += $t_array['total_records'];
                $success_array['total_' . $type . '_withdraw_app'] += $t_array['total_records'];
            }
        }
    }

    function _generate_ds_wise_array($session_user_id, &$success_array, $module_type_array, $module_type) {
        $dashboard_array = array();
        $dashboard_array[VALUE_ZERO] = $this->_get_status_wise_basic_array();
        $dashboard_array[TALUKA_DAMAN] = $this->_get_status_wise_basic_array();
        $dashboard_array[TALUKA_DIU] = $this->_get_status_wise_basic_array();
        $dashboard_array[TALUKA_DNH] = $this->_get_status_wise_basic_array();
        $dashboard_array['department_name'] = '';
        $dashboard_array['timeline'] = '';
        $dashboard_array['service_name'] = '';
        $dashboard_array['module_type'] = $module_type;
        if (!isset($module_type_array[$module_type])) {
            if (!isset($success_array['dept_wise_app_details'][$module_type])) {
                $success_array['dept_wise_app_details'][$module_type] = $dashboard_array;
            }
            return false;
        } $temp_access_data = $module_type_array[$module_type];
        if (empty($temp_access_data)) {
            if (!isset($success_array['dept_wise_app_details'][$module_type])) {
                $success_array['dept_wise_app_details'][$module_type] = $dashboard_array;
            }
            return false;
        }
        $dashboard_array['department_name'] = $temp_access_data['department_name'];
        $dashboard_array['timeline'] = $temp_access_data['timeline'];
        $dashboard_array['service_name'] = $temp_access_data['title'];
        $temp_array = $this->dashboard_model->get_ds_wise_count($session_user_id, $temp_access_data['tbl_text']);
        if (!empty($temp_array)) {
            foreach ($temp_array as $t_array) {
                if ($t_array['district'] != VALUE_ZERO) {
                    if ($t_array['processing_days'] <= $temp_access_data['day']) {
                        $this->_calculate_type_wise('ot', $t_array, $success_array, $dashboard_array);
                    } else {
                        $this->_calculate_type_wise('delay', $t_array, $success_array, $dashboard_array);
                    }
                    $this->_calculate_type_wise('all', $t_array, $success_array, $dashboard_array);
                    $success_array['total_app'] += $t_array['total_records'];
                    $dashboard_array[$t_array['district']]['total_app'] += $t_array['total_records'];
                }
            }
        }
        array_push($success_array['dept_wise_app_details'], $dashboard_array);
    }
}

/*
 * EOF: ./application/controller/Main.php
 */