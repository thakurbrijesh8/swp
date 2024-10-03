<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'home';
$route['404_override'] = 'home/page_not_found';
$route['translate_uri_dashes'] = FALSE;

$route['reset_pin'] = 'confirmation/reset_pin';

$route['about_dd'] = 'home/about_dd';
$route['about_us'] = 'home/about_us';
$route['invest_dd'] = 'home/invest_dd';

$route['dashboard'] = 'home/dashboard';
$route['dnh-pda-dashboard'] = 'home/dnh_pda_dashboard';
$route['swp_other_useful_links'] = 'home/swp_other_useful_links';

$route['pollution-control-committee-dnhdd'] = 'home/dept_pcc';
$route['labour-and-employment-dnhdd'] = 'home/dept_labour';
$route['factories-and-boilers-dnhdd'] = 'home/dept_fb';
$route['collectorate-dnhdd'] = 'home/dept_collector';
$route['fire-and-emergency-services-dnhdd'] = 'home/dept_fire';
$route['legal-metrology-weights-and-measures-dnhdd'] = 'home/dept_wm';
$route['electricity-department-dnhdd'] = 'home/dept_electricity';
$route['public-works-department-dd'] = 'home/dept_pwd';
$route['district-industries-center-dnhdd'] = 'home/dept_dic';
$route['tourism-department-dnhdd'] = 'home/dept_tourism';
$route['civil-registrar-cum-sub-registrar-dnhdd'] = 'home/dept_crsr';
$route['planning-and-development-authority-dnhdd'] = 'home/dept_pda';
$route['other-services-dnhdd'] = 'home/other_services';


$route['swp_ls'] = 'home/swp_ls';
$route['basic-required-clearances-backup'] = 'home/swp_swcs';
$route['departments-and-services'] = 'home/swp_dept_services';

$route['recent-updates'] = 'home/latest_post';

$route['samay-sudhini-seva'] = 'home/sss';
$route['business_regulation'] = 'home/business_regulation';
$route['investor-facilitation-centre-dnhdd'] = 'home/ifc_dnhdd';
$route['grievance'] = 'home/grievance';
$route['profession-tax-dnhdd'] = 'home/profession_tax';
$route['excise-department-dnhdd'] = 'home/excise_dnhdd';
$route['trade-license-dnhdd'] = 'home/trade_license';
$route['water_dnhdd_bkp'] = 'home/water_dnhdd';
$route['incentives-dnhdd'] = 'home/incentives_dnhdd';
$route['land-allotment-dnhdd'] = 'home/land_banks';
// $route['other_services'] = 'home/other_services';
$route['drug_dept'] = 'home/drug_dept';
$route['properties-dnhdd'] = 'home/property_registration';
$route['gst_dnhdd'] = 'home/gst_dnhdd';
$route['uniform-building-code-dnhdd'] = 'home/uniform_building_code';
$route['construction_permits'] = 'home/construction_permits';
$route['inspections-dnhdd'] = 'home/inspections';
$route['contract-enforcement-dnhdd'] = 'home/contract_enforcement';
$route['healthcare_dnhdd'] = 'home/healthcare_dnhdd';
$route['hospitality_dnhdd'] = 'home/hospitality_dnhdd';
$route['telecom'] = 'home/telecom';
$route['movie_shooting'] = 'home/movie_shooting';
$route['know-your-approvals'] = 'home/know_your_approvals';
$route['information-wizard'] = 'home/know_your_approvals';
$route['other_taxes'] = 'home/other_taxes';
$route['municipal-councils-dnhdd'] = 'home/municipal_council_dnhdd';
$route['vat-and-gst-dnhdd'] = 'home/value_added_tax_dnhdd';
$route['drugs-control-department-dnhdd'] = 'home/director_of_health';
$route['district-panchayat-dnhdd'] = 'home/district_panchayat_dnhdd';
$route['survey-settlment-dnhdd'] = 'home/survey_settlment_dnhdd';
$route['revenue-dnhdd'] = 'home/revenue_dnhdd';
$route['know-your-clearances'] = 'home/know_your_clearances';
$route['other-taxes-and-levies-dnhdd'] = 'home/other_taxes_and_levies';
$route['societies-registration-dnhdd'] = 'home/societies_registration';
$route['query-grievance-redressal-dnhdd'] = 'query_grievance/index';
$route['comments-feedback-on-regulation'] = 'feedback/index';

$route['dmc-daman-diu-property-tax-calculator'] = 'home/dmc_property_tax_calculator';
$route['payment-fail'] = 'payment_status/payment_failed';
$route['payment-success'] = 'payment_status/payment_success';

$route['transport-wizard'] = 'home/transport_wizard';
