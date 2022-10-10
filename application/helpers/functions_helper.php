<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



//page loade speed
if (!function_exists('page_speed')) {
    function page_speed()
    {
        $time_end = microtime(true);

        $execution_time = ($time_end - TIME_START);
        return round($execution_time, 3);
    }
}




//sending mail
if (!function_exists('send_email_func')) {
    function send_email_func($emailid, $message, $subject)
    {
        $ci = &get_instance();

        $ci->load->library('email');


        $config = array(
            "protocol" => "smtp",
            "smtp_host" => "smtp-relay.sendinblue.com",
            "smtp_port" => 587,
            "smtp_user" => "eldhossaji13.8@gmail.com",
            "smtp_pass" => "xsmtpsib-15cf3dc9052a523ee5db9510ca30d23a18aa8102c21878d55e03718700ed0e26-MKgPf1taVyzqwrSm",
            "mailtype"   => "html",
            "charset"   => "utf-8",
            "newline"   => "\r\n"
        );


        $ci->email->initialize($config);


        $ci->email->from('nexcode@nexcode.com', 'Nexcode');


        $ci->email->to($emailid);



        $ci->email->subject($subject);

        $ci->email->message($message);

        $mail_response =  $ci->email->send();

        if ($mail_response) {
            return true;
            //echo "Success! - An email has been sent to " . $emailid;
        } else {
            //show_error($this->email->print_debugger());
            return false;
        }

        return $mail_response;
    }
}


//encryption decryption
if (!function_exists('en_func')) {
    function en_func($string, $action)
    {

        $randomStringLimit = rand(1, 7);
        $secret_key = generateRandom($randomStringLimit);

        $randomStringLimit = (int) $randomStringLimit + 1;


        $secret_iv = 'eldhose_encrypt_and_decrypt_20210217';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'e') {
            $key = hash('sha256', $secret_key);
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
            $output = $output . $secret_key . $randomStringLimit;
        } else if ($action == 'd') {
            $limit = (int) substr($string, -1) - 1;
            $string = substr($string, 0, -1);
            $secret_key = substr($string, -$limit);
            $key = hash('sha256', $secret_key);
            $string = substr($string, 0, -$limit);
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}

if (!function_exists('generateRandom')) {
    function generateRandom($limit = 0)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $limit; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}


//encryption decryption
if (!function_exists('magic_function')) {
    function magic_function($string, $action)
    {

        $secret_key = '@@e-l-d-h-o-20210217@#';
        $secret_iv = 'smcim_encrypt_and_decrypt_20210217';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}

if (!function_exists('seconds2format')) {
    function seconds2format($seconds)
    {
        $sec = $seconds % 60;
        $min = floor(($seconds % 3600) / 60);
        $hour = floor(($seconds % 86400) / 3600);
        $day = floor(($seconds % 2592000) / 86400);
        $month = floor($seconds / 2592000);


        $time_reponse = "";
        if ($sec > 0)
            $time_reponse = $min . " seconds ";
        if ($min > 0)
            $time_reponse = $min . " mins ";
        if ($hour > 0)
            $time_reponse = $hour . " hours ";
        if ($day > 0)
            $time_reponse = $day . " days ";
        if ($month > 0)
            $time_reponse = $month . " months";





        return $time_reponse;
    }
}


if (!function_exists('lq')) {
    function lq($db_instance = 'db')
    {
        $ci = &get_instance();
        echo $ci->$db_instance->last_query();
        exit();
    }
}

if (!function_exists('dd')) {
    function dd($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        exit();
    }
}

if (!function_exists('ss')) {
    function ss($param)
    {
        $ci = &get_instance();
        return $ci->session->userdata($param);
    }
}

if (!function_exists('auth_check')) {
    function auth_check()
    {
        // dd($_SESSION);
        // Get a reference to the controller object
        $ci = &get_instance();
        if (!$ci->session->has_userdata('login_status')) {
            redirect('admin/login?redirect=' . current_url(), 'refresh');
        }

        // if (!check_for_token()) {
        //     $ci->session->set_flashdata('errors', 'Your session is over!');
        //     redirect(base_url('login'));
        // }
    }
}
if (!function_exists('user_auth_check')) {
    function user_auth_check()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        if (!$ci->session->has_userdata('user_login_status')) {
            redirect('users/login?redirect=' . current_url(), 'refresh');
        }

        // if (!check_for_token()) {
        //     $ci->session->set_flashdata('errors', 'Your session is over!');
        //     redirect(base_url('login'));
        // }
    }
}

if (!function_exists('check_access')) {
    function check_access()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        $menu_url = $ci->router->fetch_class();
        $menu_method = $ci->router->fetch_class() . '/' . $ci->router->fetch_method();
        $user_id = en_func($ci->session->userdata('user_id'), 'd');
        if ($user_id == 1)
            return;
        if ($menu_url == 'home')
            return;
        $multiplewhere = array(
            'module_access.status' => 1, 'modules.status !=' => 3, 'module_user_types.status' => 1,
            'modules.module_url' => 'admin/' . $menu_url, 'module_access.user_id' => $user_id
        );
        $ci->db->select('module_access.status');
        $ci->db->where($multiplewhere);
        $ci->db->or_where('modules.module_url', $menu_url);
        $ci->db->or_where('modules.module_url', 'admin/' . $menu_method);
        $ci->db->join('modules', 'modules.module_id = module_access.module_id');
        $ci->db->join('module_user_types', 'module_user_types.module_id = module_access.module_id');
        $access = $ci->db->get('module_access')->row_array();
        //echo $access['access']; exit();
        //print_r($access);
        //echo $ci->db->last_query(); exit();
        if (empty($access))
            redirect_to_404();

        else if ($access['status'] == 0)
            redirect_to_404();
    }
}

if (!function_exists('check_for_token')) {
    function check_for_token()
    {
        $ci = &get_instance();

        $id = en_func($ci->session->userdata('user_id'), 'd');
        $token_in_sess = $ci->session->userdata('enc_token');

        $ci->db->where('user_id', $id);
        $token = $ci->db->get('users')->row_array()['user_token'];
        $access_right = ($token == $token_in_sess) ? true : false;
        //$access_right = true;         

        return $access_right;
    }
}


function encrypt_data($result, $indexes)
{
    $i = 0;
    while ($i < count($result)) :
        foreach ($indexes as $index) :
            $result[$i]->$index = en_func($result[$i]->$index, 'e');
        endforeach;
        $i++;
    endwhile;


    return $result;
}

function check_post()
{
    $CI = &get_instance();
    if ($CI->input->post())
        return;
    else
        exit();
}


function response($status, $data)
{
    header("HTTP/1.1 " . $status);

    $response['status'] = $status;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
    exit();
}

function redirect_to_error()
{
    $template = 'not_found';
    $ci = &get_instance();
    if (empty($templates_path)) {
        $templates_path = VIEWPATH;
    }
    $templates_path .= $template . '.php';
    //echo $templates_path; exit();
    include($templates_path);
    exit();

    //exit();
}


function redirect_to_404()
{
    $template = '404_page';
    $ci = &get_instance();
    if (empty($templates_path)) {
        $templates_path = VIEWPATH;
    }
    $templates_path .= $template . '.php';
    //echo $templates_path; exit();
    include($templates_path);
    exit();

    //exit();
}


function redirect_to_404_ajax()
{
    echo json_encode(array('status' => 'forbidden', 'msg' => 'Page not found'));
    exit();

    //exit();
}

// limit the no of characters
if (!function_exists('text_limit')) {
    function text_limit($string, $length)
    {
        if (strlen($string) <= $length) {
            echo $string;
        } else {
            $y = substr($string, 0, $length) . '...';
            echo $y;
        }
    }
}


//Remove flashdata
if (!function_exists('remove_flashdata')) {
    function remove_flashdata()
    {
        $ci = &get_instance();
        ($ci->session->flashdata('success')) ?
            $ci->session->unset_userdata('success') : '';

        ($ci->session->flashdata('error')) ?
            $ci->session->unset_userdata('error') : '';

        ($ci->session->flashdata('errors')) ?
            $ci->session->unset_userdata('errors') : '';

        ($ci->session->flashdata('error_msg')) ?
            $ci->session->unset_userdata('error_msg') : '';
    }
}
