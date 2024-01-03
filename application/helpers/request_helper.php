<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function check_authenticated() {
    if (!is_authenticated()) {
        header("Location:" . base_url() . "login");
    }
}

function check_authenticated_rediraction() {
    if (is_authenticated()) {
        header("Location:" . base_url() . "main#home");
    }
}

function is_authenticated() {
    $CI = & get_instance();
    $user_id = $CI->session->userdata('temp_id_for_eodbsws');
    if (is_null($user_id) || $user_id == '') {
        return false;
    }
    return true;
}

function get_logout_array() {
    $return_array = get_error_array();
    $return_array['is_logout'] = true;
    return $return_array;
}

/**
 * Fetch the value from SESSION
 * @param type $key
 * @return type
 */
function get_from_session($key) {
    $CI = & get_instance();
    $value = $CI->session->userdata($key);
    return $value;
}

/**
 * Check Method is POST Or Not.
 * @return boolean
 */
function is_post() {
    return TRUE;
    if (!(filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST')) {
        return FALSE;
    }
    return TRUE;
}

/**
 * Fetch the value from POST. Will be trim() by default.
 * @param type $key - key to fetch from POST
 * @param type $trim - Optional. Default is TRUE
 * @return type
 */
function get_from_post($key, $trim = TRUE) {
    $CI = & get_instance();
    return $trim ? trim($CI->input->post($key)) : $CI->input->post($key);
}

function get_new_token() {
    $CI = & get_instance();
    return $CI->security->get_csrf_hash();
}

function get_success_array() {
    $CI = & get_instance();
    $return_array = array();
    $return_array['success'] = TRUE;
    $return_array['temp_token'] = $CI->security->get_csrf_hash();
    return $return_array;
}

function get_error_array($message = INVALID_ACCESS_MESSAGE) {
    $CI = & get_instance();
    $return_array = array();
    $return_array['success'] = FALSE;
    $return_array['temp_token'] = $CI->security->get_csrf_hash();
    $return_array['message'] = $message;
    return $return_array;
}

function api_encryption($access_token) {
    $method = 'aes-256-cbc';
    $password = substr(hash('sha256', API_ENCRYPTION_KEY, true), 0, 32);
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    return base64_encode(openssl_encrypt($access_token, $method, $password, OPENSSL_RAW_DATA, $iv));
}

function api_decryption($access_token) {
    $method = 'aes-256-cbc';
    $password = substr(hash('sha256', API_ENCRYPTION_KEY, true), 0, 32);
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    return openssl_decrypt(base64_decode($access_token), $method, $password, OPENSSL_RAW_DATA, $iv);
}
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

/**
 * EOF: ./application/helpers/request_helper.php
 */