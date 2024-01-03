<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Track_query_grievance extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
    }

    function index() {
        $this->load->view('track_query_grievance');
    }
    function get_query_grievance_data() {
        // $session_user_id = get_from_session('temp_id_for_eodbsws');
        // if (!is_post() || $session_user_id == NULL || !$session_user_id) {
        //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
        //     return false;
        // }
        $reference_number = get_from_post('reference_number');
        if (!$reference_number) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_start();
        $query_grievance_data = $this->utility_model->get_by_id('query_reference_number', $reference_number, 'query_grievance');
        // if (empty($query_grievance_data)) {
        //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
        //     return false;
        // }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array = get_success_array();
        $success_array['query_grievance_data'] = $query_grievance_data;
        echo json_encode($success_array);
    }

}

/*
 * EOF: ./application/controller/Query_grievance.php
 */