<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('home');
    }

    public function page_not_found() {
        $this->load->view('404');
    }

    public function about_dd() {
        $this->load->view('about_dd');
    }

    public function about_us() {
        $this->load->view('about_us');
    }

    public function invest_dd() {
        $this->load->view('invest_dd');
    }

    public function dept_pcc() {
        $this->load->view('departments/pcc');
    }

    public function dept_labour() {
        $this->load->view('departments/labour');
    }

    public function dept_fb() {
        $this->load->view('departments/fb');
    }

    public function dept_collector() {
        $this->load->view('departments/collector');
    }

    public function dept_fire() {
        $this->load->view('departments/fire');
    }

    public function dept_wm() {
        $this->load->view('departments/wm');
    }

    public function dept_electricity() {
        $this->load->view('departments/electricity');
    }

    public function dept_pwd() {
        $this->load->view('departments/pwd');
    }

    public function dept_dic() {
        $this->load->view('departments/dic');
    }

    public function dept_tourism() {
        $this->load->view('departments/tourism');
    }

    public function dept_crsr() {
        $this->load->view('departments/crsr');
    }

    public function dept_pda() {
        $this->load->view('departments/pda');
    }

    public function swp_other_useful_links() {
        $this->load->view('swp/other_useful_links');
    }

    public function swp_swcs() {
        $this->load->view('swp/swcs');
    }

    public function swp_dept_services() {
        $this->load->view('swp/other_services');
    }

    public function swp_ls() {
        $this->load->view('swp/ls');
    }

    public function latest_post() {
        $this->load->view('latest_post');
    }

    public function excise_dnhdd() {
        $this->load->view('departments/excise_dnhdd');
    }

    public function municipal_council_dnhdd() {
        $this->load->view('departments/municipal_council_dnhdd');
    }

    public function value_added_tax_dnhdd() {
        $this->load->view('departments/vat_dept');
    }

    public function director_of_health() {
        $this->load->view('departments/health');
    }

    public function district_panchayat_dnhdd() {
        $this->load->view('departments/dist_panchayat');
    }

    public function survey_settlment_dnhdd() {
        $this->load->view('departments/survey_settlement');
    }

    public function revenue_dnhdd() {
        $this->load->view('departments/revenue');
    }

    public function other_services() {
        $this->load->view('departments/other_services');
    }

    public function dashboard() {
        $this->load->model('dashboard_model');
        $dashboard_array = array();
        $module_array = $this->config->item('query_module_array');
        $this->db->trans_start();
        foreach ($module_array as $m_array) {
            $this->_generate_status_wise_array($dashboard_array, $m_array['tbl_text']);
        }
        error_reporting(~E_WARNING);
        $dashboard_array['fire_dashboard'] = file_get_contents('http://eservices.ddfes.in/DashboardAppList/embedded');
        $this->db->trans_complete();
        $this->load->view('dashboard', $dashboard_array);
    }

    public function dnh_pda_dashboard() {
        $this->load->model('dashboard_model');
        $dashboard_array = array();
        $module_name = 'construction';
        $this->_get_status_wise_basic_array($dashboard_array, $module_name);
        $dashboard_array[$module_name . '_timelimit'] = '30 Days';
        $this->db->trans_start();
        $temp_dnh_pda_json = file_get_contents('http://103.77.196.165/BpamsClient/DataServices/ApplicationStatus.svc/GetDNHPDAStatus');
        $dnh_pda_array = json_decode($temp_dnh_pda_json, true);
        if (is_array($dnh_pda_array)) {
            if ($dnh_pda_array['Status'] == 1) {
                $dashboard_array[$module_name . '_received_app'] = isset($dnh_pda_array['services'][0]['Received']) ? $dnh_pda_array['services'][0]['Received'] : 0;
                $dashboard_array[$module_name . '_processed_app'] = isset($dnh_pda_array['services'][0]['Processed']) ? $dnh_pda_array['services'][0]['Processed'] : 0;
                $dashboard_array[$module_name . '_approved_app'] = isset($dnh_pda_array['services'][0]['Approved']) ? $dnh_pda_array['services'][0]['Approved'] : 0;
                $dashboard_array[$module_name . '_rejected_app'] = isset($dnh_pda_array['services'][0]['Rejected']) ? $dnh_pda_array['services'][0]['Rejected'] : 0;
                $dashboard_array[$module_name . '_average_time_to_ga'] = isset($dnh_pda_array['services'][0]['AverageTime']) ? $dnh_pda_array['services'][0]['AverageTime'] : 0;
                $dashboard_array[$module_name . '_timelimit'] = isset($dnh_pda_array['services'][0]['TimeLimit']) ? $dnh_pda_array['services'][0]['TimeLimit'] : '30 Days';
            }
        }
        $this->db->trans_complete();
        $this->load->view('dnh_pda_dashboard', $dashboard_array);
    }

    function _get_status_wise_basic_array(&$dashboard_array, $module_name) {
        $dashboard_array[$module_name . '_received_app'] = 0;
        $dashboard_array[$module_name . '_processed_app'] = 0;
        $dashboard_array[$module_name . '_approved_app'] = 0;
        $dashboard_array[$module_name . '_rejected_app'] = 0;
        $dashboard_array[$module_name . '_average_time_to_ga'] = '-';
        $dashboard_array[$module_name . '_median_time_to_ga'] = '-';
    }

    function _generate_status_wise_array(&$dashboard_array, $module_name) {
        $this->_get_status_wise_basic_array($dashboard_array, $module_name);
        $temp_array = $this->dashboard_model->get_status_wise_count($module_name);
        if (!empty($temp_array)) {
            $total_days = 0;
            $cnt = 1;
            foreach ($temp_array as $t_array) {
                if ($t_array['status'] != VALUE_ZERO && $t_array['status'] != VALUE_ONE) {
                    $dashboard_array[$module_name . '_received_app'] += $t_array['total_records'];
                }
                if ($t_array['status'] == VALUE_FIVE || $t_array['status'] == VALUE_SIX) {
                    $dashboard_array[$module_name . '_processed_app'] += $t_array['total_records'];
                    if ($t_array['status'] == VALUE_FIVE) {
                        $dashboard_array[$module_name . '_approved_app'] += $t_array['total_records'];
                        $total_days += $t_array['total_processing_days'];
                        if ($cnt == 1) {
                            $dashboard_array[$module_name . '_median_time_to_ga'] = $t_array['total_records'] . ' Application(s) in<br>' . $t_array['processing_days'] . ' Day(s)';
                        }
                    }
                    if ($t_array['status'] == VALUE_SIX) {
                        $dashboard_array[$module_name . '_rejected_app'] += $t_array['total_records'];
                    }
                }
                $cnt++;
            }
            if ($total_days != 0 && $dashboard_array[$module_name . '_approved_app'] != 0) {
                $days = abs($total_days / $dashboard_array[$module_name . '_approved_app']);
                if (strpos($days, '.') !== false) {
                    $td_array = explode(".", "$days");
                    $days = $td_array[0] + 1;
                }
                $dashboard_array[$module_name . '_average_time_to_ga'] = $days . ' Day(s)';
            }
        }
    }

    public function sss() {
        $this->load->view('reform_evidence/sss');
    }

    public function business_regulation() {
        $this->load->view('reform_evidence/business_regulation');
    }

    public function ifc_dnhdd() {
        $this->load->view('reform_evidence/ifc_dnhdd');
    }

    public function grievance() {
        $this->load->model('query_grievance_model');
        $query_grievance_array = array();
        $this->db->trans_start();
        $this->_generate_query_grievance_status_wise_array($query_grievance_array, 'query_grievance');
        $this->load->view('reform_evidence/grievance', $query_grievance_array);
    }

    function _get_query_grievance_status_wise_basic_array(&$query_grievance_array, $module_name) {
        $query_grievance_array[$module_name . '_received_app_for_micro'] = 0;
        $query_grievance_array[$module_name . '_received_app_for_small'] = 0;
        $query_grievance_array[$module_name . '_received_app_for_medium'] = 0;
        $query_grievance_array[$module_name . '_received_app_for_large'] = 0;
        $query_grievance_array[$module_name . '_processed_app_for_micro'] = 0;
        $query_grievance_array[$module_name . '_processed_app_for_small'] = 0;
        $query_grievance_array[$module_name . '_processed_app_for_medium'] = 0;
        $query_grievance_array[$module_name . '_processed_app_for_large'] = 0;
        // $query_grievance_array[$module_name . '_approved_app'] = 0;
        // $query_grievance_array[$module_name . '_rejected_app'] = 0;
        $query_grievance_array[$module_name . '_average_time_to_ga_for_micro'] = '-';
        $query_grievance_array[$module_name . '_average_time_to_ga_for_small'] = '-';
        $query_grievance_array[$module_name . '_average_time_to_ga_for_medium'] = '-';
        $query_grievance_array[$module_name . '_average_time_to_ga_for_large'] = '-';
        $query_grievance_array[$module_name . '_median_time_to_ga_for_micro'] = '-';
        $query_grievance_array[$module_name . '_median_time_to_ga_for_small'] = '-';
        $query_grievance_array[$module_name . '_median_time_to_ga_for_medium'] = '-';
        $query_grievance_array[$module_name . '_median_time_to_ga_for_large'] = '-';

        $query_grievance_array[$module_name . '_min_time_for_micro'] = '-';
        $query_grievance_array[$module_name . '_min_time_for_small'] = '-';
        $query_grievance_array[$module_name . '_min_time_for_medium'] = '-';
        $query_grievance_array[$module_name . '_min_time_for_large'] = '-';

        $query_grievance_array[$module_name . '_max_time_for_micro'] = '-';
        $query_grievance_array[$module_name . '_max_time_for_small'] = '-';
        $query_grievance_array[$module_name . '_max_time_for_medium'] = '-';
        $query_grievance_array[$module_name . '_max_time_for_large'] = '-';
    }

    function _generate_query_grievance_status_wise_array(&$query_grievance_array, $module_name) {
        $this->_get_query_grievance_status_wise_basic_array($query_grievance_array, $module_name);
        $temp_array = $this->query_grievance_model->get_query_grievance_status_wise_count($module_name);
        //var_dump($temp_array);
        if (!empty($temp_array)) {
            $total_days_micro = 0;
            $total_days_small = 0;
            $total_days_medium = 0;
            $total_days_large = 0;
            $min_time = 0;
            $max_time = 0;
            $cnt = 1;
            foreach ($temp_array as $t_array) {
                if ($t_array['status'] != VALUE_ZERO) {
                    if ($t_array['industry_classification'] == 1)
                        $query_grievance_array[$module_name . '_received_app_for_micro'] += $t_array['total_records'];
                    if ($t_array['industry_classification'] == 2)
                        $query_grievance_array[$module_name . '_received_app_for_small'] += $t_array['total_records'];
                    if ($t_array['industry_classification'] == 3)
                        $query_grievance_array[$module_name . '_received_app_for_medium'] += $t_array['total_records'];
                    if ($t_array['industry_classification'] == 4)
                        $query_grievance_array[$module_name . '_received_app_for_large'] += $t_array['total_records'];
                }
                if ($t_array['status'] == VALUE_TWO) {
                    if ($t_array['industry_classification'] == 1) {
                        $query_grievance_array[$module_name . '_processed_app_for_micro'] += $t_array['total_records'];
                        $total_days_micro += $t_array['total_processing_days'];
                        $min_time_micro = $this->query_grievance_model->get_query_grievance_min_time($module_name, '1');
                        $query_grievance_array[$module_name . '_min_time_for_micro'] = $min_time_micro->processing_days . ' Day(s)';

                        $max_time_micro = $this->query_grievance_model->get_query_grievance_max_time($module_name, '1');
                        $query_grievance_array[$module_name . '_max_time_for_micro'] = $max_time_micro->processing_days . ' Day(s)';
                    }
                    if ($t_array['industry_classification'] == 2) {
                        $query_grievance_array[$module_name . '_processed_app_for_small'] += $t_array['total_records'];
                        $total_days_small += $t_array['total_processing_days'];
                        $min_time_small = $this->query_grievance_model->get_query_grievance_min_time($module_name, '2');
                        $query_grievance_array[$module_name . '_min_time_for_small'] = $min_time_small->processing_days . ' Day(s)';

                        $max_time_small = $this->query_grievance_model->get_query_grievance_max_time($module_name, '2');
                        $query_grievance_array[$module_name . '_max_time_for_small'] = $max_time_small->processing_days . ' Day(s)';
                    }
                    if ($t_array['industry_classification'] == 3) {
                        $query_grievance_array[$module_name . '_processed_app_for_medium'] += $t_array['total_records'];
                        $total_days_medium += $t_array['total_processing_days'];
                        $min_time_medium = $this->query_grievance_model->get_query_grievance_min_time($module_name, '3');
                        $query_grievance_array[$module_name . '_min_time_for_medium'] = $min_time_medium->processing_days . ' Day(s)';

                        $max_time_medium = $this->query_grievance_model->get_query_grievance_max_time($module_name, '3');
                        $query_grievance_array[$module_name . '_max_time_for_medium'] = $max_time_medium->processing_days . ' Day(s)';
                    }
                    if ($t_array['industry_classification'] == 4) {
                        $query_grievance_array[$module_name . '_processed_app_for_large'] += $t_array['total_records'];
                        $total_days_large += $t_array['total_processing_days'];
                        $min_time_large = $this->query_grievance_model->get_query_grievance_min_time($module_name, '4');
                        $query_grievance_array[$module_name . '_min_time_for_large'] = $min_time_large->processing_days . ' Day(s)';

                        $max_time_large = $this->query_grievance_model->get_query_grievance_max_time($module_name, '4');
                        $query_grievance_array[$module_name . '_max_time_for_large'] = $max_time_large->processing_days . ' Day(s)';
                    }

                    if ($t_array['industry_classification'] == 1 && $t_array['total_records'] != 0)
                        $query_grievance_array[$module_name . '_median_time_to_ga_for_micro'] = $t_array['processing_days'] . ' Day(s)';
                    if ($t_array['industry_classification'] == 2 && $t_array['total_records'] != 0)
                        $query_grievance_array[$module_name . '_median_time_to_ga_for_small'] = $t_array['processing_days'] . ' Day(s)';
                    if ($t_array['industry_classification'] == 3 && $t_array['total_records'] != 0)
                        $query_grievance_array[$module_name . '_median_time_to_ga_for_medium'] = $t_array['processing_days'] . ' Day(s)';
                    if ($t_array['industry_classification'] == 4 && $t_array['total_records'] != 0)
                        $query_grievance_array[$module_name . '_median_time_to_ga_for_large'] = $t_array['processing_days'] . ' Day(s)';
                }
            }
            if ($total_days_micro != 0 && $query_grievance_array[$module_name . '_processed_app_for_micro'] != 0) {
                $days = abs($total_days_micro / $query_grievance_array[$module_name . '_processed_app_for_micro']);
                if (strpos($days, '.') !== false) {
                    $td_array = explode(".", "$days");
                    $days = $td_array[0] + 1;
                }
                $query_grievance_array[$module_name . '_average_time_to_ga_for_micro'] = $days . ' Day(s)';
            }
            if ($total_days_small != 0 && $query_grievance_array[$module_name . '_processed_app_for_small'] != 0) {
                $days = abs($total_days_small / $query_grievance_array[$module_name . '_processed_app_for_small']);
                if (strpos($days, '.') !== false) {
                    $td_array = explode(".", "$days");
                    $days = $td_array[0] + 1;
                }
                $query_grievance_array[$module_name . '_average_time_to_ga_for_small'] = $days . ' Day(s)';
            }
            if ($total_days_medium != 0 && $query_grievance_array[$module_name . '_processed_app_for_medium'] != 0) {
                $days = abs($total_days_medium / $query_grievance_array[$module_name . '_processed_app_for_medium']);
                if (strpos($days, '.') !== false) {
                    $td_array = explode(".", "$days");
                    $days = $td_array[0] + 1;
                }
                $query_grievance_array[$module_name . '_average_time_to_ga_for_medium'] = $days . ' Day(s)';
            }
            if ($total_days_large != 0 && $query_grievance_array[$module_name . '_processed_app_for_large'] != 0) {
                $days = abs($total_days_large / $query_grievance_array[$module_name . '_processed_app_for_large']);
                if (strpos($days, '.') !== false) {
                    $td_array = explode(".", "$days");
                    $days = $td_array[0] + 1;
                }
                $query_grievance_array[$module_name . '_average_time_to_ga_for_large'] = $days . ' Day(s)';
            }
        }
    }

    public function profession_tax() {
        $this->load->view('reform_evidence/profession_tax');
    }

    // public function excise_dnhdd() {
    //     $this->load->view('reform_evidence/excise_dnhdd');
    // }

    public function trade_license() {
        $this->load->view('reform_evidence/trade_license');
    }

    public function water_dnhdd() {
        $this->load->view('reform_evidence/water_dnhdd');
    }

    public function incentives_dnhdd() {
        $this->load->view('reform_evidence/incentives_dnhdd');
    }

    public function land_banks() {
        $this->load->view('reform_evidence/land_banks');
    }

    // public function other_services() {
    //     $this->load->view('reform_evidence/other_services');
    // }

    public function drug_dept() {
        $this->load->view('reform_evidence/drug_dept');
    }

    public function property_registration() {
        $this->load->view('reform_evidence/property_registration');
    }

    public function gst_dnhdd() {
        $this->load->view('reform_evidence/gst_dnhdd');
    }

    public function uniform_building_code() {
        $this->load->view('reform_evidence/uniform_building_code');
    }

    public function construction_permits() {
        $this->load->view('reform_evidence/construction_permits');
    }

    public function inspections() {
        $template_data = array();
        $this->load->model('utility_model');
        $template_data['temp_ci_data'] = $this->utility_model->get_result_data_by_id('status', VALUE_THREE, 'c_inspections');
        $this->load->view('reform_evidence/inspections', $template_data);
    }

    public function contract_enforcement() {
        $this->load->view('reform_evidence/contract_enforcement');
    }

    public function healthcare_dnhdd() {
        $this->load->view('reform_evidence/healthcare_dnhdd');
    }

    public function hospitality_dnhdd() {
        $this->load->view('reform_evidence/hospitality_dnhdd');
    }

    public function telecom() {
        $this->load->view('reform_evidence/telecom');
    }

    public function movie_shooting() {
        $this->load->view('reform_evidence/movie_shooting');
    }

    public function other_taxes() {
        $this->load->view('reform_evidence/other_taxes');
    }

    public function know_your_approvals() {
        $template_data = array();
        $this->load->model('utility_model');
        $template_data['temp_dept_data'] = generate_array_for_id_object($this->utility_model->get_result_data('department'), 'department_id');
        $this->load->view('approvals/list', $template_data);
    }

    public function know_your_clearances() {
        $this->load->view('clearance');
    }

    public function other_taxes_and_levies() {
        $this->load->view('reform_evidence/other_taxes_and_levies');
    }

    public function societies_registration() {
        $this->load->view('reform_evidence/societies_registration');
    }

    public function dmc_property_tax_calculator() {
        $this->load->view('departments_services/property_tax_calculator');
    }

}

/*
 * EOF: ./application/controller/Main.php
 */