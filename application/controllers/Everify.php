<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Everify extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
    }

    function index() {
        if (!$_GET) {
            $this->load->view('everify');
            return false;
        }
        $access_token = isset($_GET['ev']) ? $_GET['ev'] : '';
        if (!$access_token) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        $module_type = intval(substr($access_token, 0, 2));
        if (!$module_type) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        $query_module_array = $this->config->item('query_module_array');
        if (!isset($query_module_array[$module_type])) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        $module_data = $query_module_array[$module_type];
        $module_id = intval(substr($access_token, 2));
        $this->db->trans_start();
        if ($module_type == VALUE_FIFTYTWO) {
            $certificate_data = $this->utility_model->get_incentive_details_by_id($module_id);
        } else {
            $certificate_data = $this->utility_model->get_by_id($module_data['key_id_text'], $module_id, $module_data['tbl_text']);
        }
        if (empty($certificate_data)) {
            $this->load->view('error_page', array('error_message' => INVALID_CERTIFICATE_MESSAGE));
            return false;
        }
        if ($certificate_data['status'] != VALUE_FIVE) {
            $this->load->view('error_page', array('error_message' => INVALID_CERTIFICATE_MESSAGE));
            return false;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->load->view('error_page', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        if ($module_type == VALUE_ONE) {
            $this->utility_lib->gc_for_wm_registration($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWO) {
            $this->utility_lib->gc_for_repairer($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THREE) {
            $this->utility_lib->gc_for_dealer($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOUR) {
            $this->utility_lib->gc_for_manufacturer($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FIVE) {
            $this->utility_lib->gc_for_wc($certificate_data);
            return false;
        }
        if ($module_type == VALUE_SIX) {
            $this->utility_lib->gc_for_hotelregi($certificate_data);
            return false;
        }
        if ($module_type == VALUE_SEVEN) {
            $this->_open_certificate_pdf(ADMIN_CRSR_CERTIFICATE_PATH, $certificate_data);
//            $this->utility_lib->gc_for_psfregistration($certificate_data);
            return false;
        }
        if ($module_type == VALUE_EIGHT) {
            $this->utility_lib->gc_for_cinema($certificate_data);
            return false;
        }
        if ($module_type == VALUE_NINE) {
            $this->_open_certificate_pdf(ADMIN_DIC_CERTIFICATE_PATH, $certificate_data);
//            $this->utility_lib->gc_for_msme($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TEN) {
            $this->_open_certificate_pdf(ADMIN_DIC_CERTIFICATE_PATH, $certificate_data);
//            $this->utility_lib->gc_for_textile($certificate_data);
            return false;
        }
        if ($module_type == VALUE_ELEVEN) {
            $this->utility_lib->gc_for_noc($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWELVE) {
            $this->utility_lib->gc_for_transfer($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTEEN) {
            $this->utility_lib->gc_for_subletting($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTEEN) {
            $this->utility_lib->gc_for_repairer_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FIFTEEN) {
            $this->utility_lib->gc_for_dealer_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_SIXTEEN) {
            $this->utility_lib->gc_for_manufacturer_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_SEVENTEEN) {
            $this->utility_lib->gc_for_sublessee($certificate_data);
            return false;
        }
        if ($module_type == VALUE_EIGHTEEN) {
            $this->utility_lib->gc_for_seller($certificate_data);
            return false;
        }
        if ($module_type == VALUE_NINETEEN) {
            $this->utility_lib->gc_for_travelagent($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTY) {
            $this->utility_lib->gc_for_hotel_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTYONE) {
            $this->utility_lib->gc_for_property($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTYTWO) {
            $this->utility_lib->gc_for_filmshooting($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTYTHREE) {
            $this->utility_lib->gc_for_travelagent_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTYFOUR) {
            $this->utility_lib->gc_for_tourismevent($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTYFIVE) {
            $this->utility_lib->gc_for_landallotment($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTYSIX) {
            $this->_open_certificate_pdf(ADMIN_PDA_CERTIFICATE_PATH, $certificate_data);
            //$this->utility_lib->gc_for_construction($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTYSEVEN) {
            $this->_open_certificate_pdf(ADMIN_PDA_CERTIFICATE_PATH, $certificate_data);
            // $this->utility_lib->gc_for_inspection($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTYEIGHT) {
            $this->_open_certificate_pdf(ADMIN_PDA_CERTIFICATE_PATH, $certificate_data);
            // $this->utility_lib->gc_for_occupancycertificate($certificate_data);
            return false;
        }
        if ($module_type == VALUE_TWENTYNINE) {
            $this->utility_lib->gc_for_site($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTY) {
            $this->utility_lib->gc_for_zone($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTYONE) {
            $this->_open_certificate_pdf(ADMIN_LABOUR_CERTIFICATE_PATH, $certificate_data);
            //$this->utility_lib->gc_for_clact($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTYTWO) {
            $this->_open_certificate_pdf(ADMIN_LABOUR_CERTIFICATE_PATH, $certificate_data);
            //$this->utility_lib->gc_for_bocw($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTYTHREE) {
            $this->_open_certificate_pdf(ADMIN_LABOUR_CERTIFICATE_PATH, $certificate_data);
            //  $this->utility_lib->gc_for_shop($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTYFOUR) {
            $this->utility_lib->gc_for_migrantworkers($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTYFIVE) {
            $this->_open_certificate_pdf(ADMIN_WM_CERTIFICATE_PATH, $certificate_data);
//            $this->utility_lib->gc_for_factorylicence($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTYSIX) {
            $this->utility_lib->gc_for_buildingplan($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTYSEVEN) {
            $this->_open_certificate_pdf(ADMIN_FB_CERTIFICATE_PATH, $certificate_data);
            //$this->utility_lib->gc_for_boileract($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTYEIGHT) {
            $this->utility_lib->gc_for_boilermanufacture($certificate_data);
            return false;
        }
        if ($module_type == VALUE_THIRTYNINE) {
            $this->utility_lib->gc_for_singlereturn($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTY) {
            $this->_open_certificate_pdf(ADMIN_REV_COLL_CERTIFICATE_PATH, $certificate_data);
//            $this->utility_lib->gc_for_na($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTYONE) {
            $this->_open_certificate_pdf(ADMIN_WM_CERTIFICATE_PATH, $certificate_data);
//            $this->utility_lib->gc_for_factorylicence_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTYTWO) {
            $this->_open_certificate_pdf(ADMIN_LABOUR_CERTIFICATE_PATH, $certificate_data);
//            $this->utility_lib->gc_for_shop_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTYTHREE) {
            $this->_open_certificate_pdf(ADMIN_LABOUR_CERTIFICATE_PATH, $certificate_data);
            //$this->utility_lib->gc_for_appli_licence($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTYFOUR) {
            $this->_open_certificate_pdf(ADMIN_FB_CERTIFICATE_PATH, $certificate_data);
            //  $this->utility_lib->gc_for_boiler_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTYFIVE) {
            $this->utility_lib->gc_for_migrantworkers_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTYSIX) {
            $this->_open_certificate_pdf(ADMIN_LABOUR_CERTIFICATE_PATH, $certificate_data);
            // $this->utility_lib->gc_for_appli_licence_renewal($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTYEIGHT) {
            $this->utility_lib->gc_for_vc($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FOURTYNINE) {
            $this->utility_lib->gc_for_rii($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FIFTY) {
            $this->utility_lib->gc_for_periodicalreturn($certificate_data);
            return false;
        }
        if ($module_type == VALUE_FIFTYTWO) {
            $this->_open_certificate_pdf(ADMIN_DIC_CERTIFICATE_PATH, $certificate_data);
            return false;
        }
        if ($module_type == VALUE_FIFTYNINE) {
            $this->_open_certificate_pdf(ADMIN_FOREST_CERTIFICATE_PATH, $certificate_data);
            return false;
        }
        if ($module_type == VALUE_SIXTY) {
            $this->_open_certificate_pdf(ADMIN_REV_COLL_CERTIFICATE_PATH, $certificate_data);
            return false;
        }
        if ($module_type == VALUE_SIXTYONE) {
            $this->_open_certificate_pdf(ADMIN_CRSR_CERTIFICATE_PATH, $certificate_data);
            return false;
        }
    }

    function _open_certificate_pdf($certificate_path, $certificate_data) {
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="certificate-' . time() . '-' . generate_token(10) . '.pdf"');
        readfile($certificate_path . $certificate_data['final_certificate']);
    }

    function check_number_for_everify() {
        try {
            $verification_number = get_from_post('verification_number');
            if (!$verification_number) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = intval(substr($verification_number, 0, 2));
            if (!$module_type) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_BARCODE_NUMBER_MESSAGE));
                return false;
            }
            $query_module_array = $this->config->item('query_module_array');
            if (!isset($query_module_array[$module_type])) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_BARCODE_NUMBER_MESSAGE));
                return false;
            }
            $module_data = $query_module_array[$module_type];
            $module_id = intval(substr($verification_number, 2));
            $this->db->trans_start();
            if ($module_type == VALUE_FIFTYTWO) {
                $certificate_data = $this->utility_model->get_incentive_details_by_id($module_id);
            } else {
                $certificate_data = $this->utility_model->get_by_id($module_data['key_id_text'], $module_id, $module_data['tbl_text']);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            if (empty($certificate_data)) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_BARCODE_NUMBER_MESSAGE));
                return false;
            }
            if ($certificate_data['status'] != VALUE_FIVE) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_BARCODE_NUMBER_MESSAGE));
                return false;
            }
            echo json_encode(array('success' => TRUE));
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

}

/*
 * EOF: ./application/controller/Everify.php
 */