<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;




/***************   Admin panel routes   **********************/



//Ck Editor Image Upload
$route['upload'] = "admin/CkEditor/upload";

/************
 * 
 * 
 * Authentication for users
 * 
 * *********/
$route['users'] = 'auth/users/login';
$route['users/register'] = 'auth/users/register';
$route['users/save_register'] = 'auth/users/register/save_register';

$route['users/auth'] = 'auth/users/login';
$route['users/login'] = 'auth/users/login';
$route['users/save_login'] = 'auth/users/login/login';


$route['users/google_login'] = 'auth/users/login/google_login';
$route['users/google_register'] = 'auth/users/register/google_register';

$route['users/setup_profile'] = 'auth/users/register/setup_profile';
$route['users/complete_profile'] = 'auth/users/register/complete_profile';


$route['users/logout'] = 'auth/users/login/logout';


$route['usershome'] = 'users/home';


/************
 * 
 * 
 * Authentication for admin
 * 
 * *********/
$route['admin'] = 'auth/admin/login';
$route['admin/auth'] = 'auth/admin/login';
$route['admin/login'] = 'auth/admin/login';


$route['register'] = 'auth/admin/register';
$route['auth/forgot_password'] = 'auth/admin/login/forgot_password';
$route['auth/forgot_password_post'] = 'auth/admin/login/forgot_password_post';
$route['auth/change_password_post'] = 'auth/admin/login/change_password_post';

$route['save_registration'] = 'auth/admin/register/register_user';

$route['admin/save_login'] = 'auth/admin/login/login';

$route['validate_registration'] = 'auth/register/validate_register_form';
$route['change_captcha'] = 'auth/login/refresh_captcha';
$route['change_captcha2'] = 'auth/register/refresh_captcha';


$route['keyboard_shortcuts'] = 'admin/keyboard/keyboard_shortcuts';

$route['admin/logout'] = 'auth/admin/login/logout';

$route['adminhome'] = 'admin/home';




$route['profile'] = 'admin/profile';
$route['login_history'] = 'admin/profile/login_history';
$route['list_logs'] = 'admin/profile/list_logs';
$route['list_logs_json'] = 'admin/profile/list_logs_json';

$route['patients/profile'] = 'patients/profile';
$route['patients/login_history'] = 'patients/profile/login_history';
$route['patients/list_logs'] = 'patients/profile/list_logs';
$route['patients/list_logs_json'] = 'patients/profile/list_logs_json';

$route['list_failed_logs'] = 'admin/profile/list_failed_logs';
$route['list_failed_logs_json'] = 'admin/profile/list_failed_logs_json';



$route['profile_image_store']['post'] = 'admin/profile/update_profile_image';

$route['update_profile'] = 'admin/profile/update_profile';
$route['change_password'] = 'admin/profile/change_password';

$route['patients/update_profile'] = 'patients/profile/update_profile';
$route['patients/change_password'] = 'patients/profile/change_password';

$route['permissions'] = 'admin/permissions';
$route['permission_json'] = 'admin/permissions/permission_json';
$route['list_permissions/(:any)'] = 'admin/permissions/list_permissions/$1';
$route['change_module_permission'] = 'admin/permissions/change_module_permission';
$route['change_module_permission_usertype'] = 'admin/permissions/change_module_permission_usertype';
$route['website'] = 'admin/website';


$route['feedbacks'] = 'admin/feedbacks';
$route['add_backlog'] = 'admin/feedbacks/add_backlog';
$route['list_backlogs'] = 'admin/feedbacks/list_backlogs';
$route['change_feedback_status'] = 'admin/feedbacks/change_feedback_status';

$route['export'] = 'admin/export';

//$route['user'] = 'home/home/user_home/2';









/***************   Home page routes   **********************/

$route['visits'] = 'ajax/visits';


$route['donate'] = 'donations/donate';

$route['contact_us'] = 'home/contact_us';
$route['jobs'] = 'home/jobs';

$route['about_us'] = 'home/about_us';

$route['privacy_policy'] = 'home/privacy_policy';
$route['terms_and_conditions'] = 'home/terms_and_conditions';


$route['save_contact_us'] = 'ajax/save_contact_us';

