<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');
        $this->load->library('user_agent');

        $this->load->model('M_users');

        date_default_timezone_set("Asia/Kolkata");
    }

    public function index()
    {
        if ($this->session->has_userdata('login_status')) {
            redirect('usershome', 'refresh');
        }
        $data= array();
       

        $this->load->view('auth/users/login', $data);
        remove_flashdata();
    }


    public function forgot_password()
    {
        $captcha_word = rand(1000, 9999);
        $data['captchaimage'] = createCaptchaImage($captcha_word);

        $data['word'] = $captcha_word;

        $this->session->set_flashdata('captcha_content', $data['word']);


        $this->load->view('auth/users/forgot_password', $data);
        remove_flashdata();
    }


    public function change_password_post()
    {
        $this->form_validation->set_rules('user_otp', 'Otp', 'required|numeric|min_length[4]|max_length[4]');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

        if ($this->form_validation->run() == FALSE) :
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        endif;

        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        $user_otp = $this->input->post('user_otp');

        if ($new_password != $confirm_password) :
            $data = array('status' => 'error', 'msg' => 'Passwords are not the same');
            echo json_encode($data);
            exit();
        endif;


        $user_otp_en = magic_function($user_otp, 'e');
        $data = $this->M_users->checktoken($user_otp_en);

        if ($data == false) {
            $data = array('status' => 'error', 'msg' => 'Entered otp is incorrect');
            echo json_encode($data);
            exit();
        }

        $user_id = $data->user_id;
        $changePassword = $this->M_users->update_password(md5($new_password), $user_id);

        if ($changePassword < 1) :
            $data = array('status' => 'error', 'msg' => 'Password could not be changed,Please try again !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'success', 'msg' => 'Password resetted,Login again !');
        echo json_encode($data);
        exit();
    }


    public function forgot_password_post()
    {
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('user_captcha', 'Captcha', 'required|numeric|min_length[4]|max_length[4]');

        if ($this->form_validation->run() == FALSE) :
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        endif;



        if (!$this->check_captcha_matches($this->input->post('user_captcha', TRUE))) :
            $data = array('status' => 'error', 'msg' => 'Captchas doesnt match');
            echo json_encode($data);
            exit();
        endif;



        $agent = ($this->agent->is_browser()) ?
            $this->agent->browser() . ' ' . $this->agent->version() : (($this->agent->is_mobile()) ? $this->agent->mobile() : 'Nulls');



        $platform =  $this->agent->platform();

        $user_email = trim($this->input->post('user_email', TRUE));

        $data = $this->M_users->check_user_exists($user_email);

        if ($data == false) {
            $data = array('status' => 'error', 'msg' => 'Account with this email doesnt exist');
            echo json_encode($data);
            exit();
        }

        $otp = rand(1000, 9999);

        $message = "Your OTP request from " . $platform . " , " . $agent . " for password reset is " . $otp;

        $otp_en = magic_function($otp, 'e');
        $user_id = $data->user_id;

        $qry = $this->M_users->updatetoken($otp_en, $user_id);

       
    }



    public function login()
    {
        $this->form_validation->set_rules('user_email', 'Email', 'required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');

        if ($this->form_validation->run() == FALSE) :
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        endif;

        $captcha_response = trim($this->input->post('g-recaptcha-response'));
        if ($captcha_response != '') {
            $keySecret = $this->config->item('google_secret');
            $userIp = $this->input->ip_address();

            $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $keySecret . "&response=" . $captcha_response;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $status = json_decode($output, true);

            // $status['success'] = true;

            if (!$status['success']) {
                $data = array('status' => 'error', 'msg' => 'Something wrong with captcha,Try again later !!');
                echo json_encode($data);
                exit();
            }
        }


        $agent = ($this->agent->is_browser()) ?
            $this->agent->browser() . ' ' . $this->agent->version() : (($this->agent->is_mobile()) ? $this->agent->mobile() : 'Nulls');



        $platform =  $this->agent->platform();




        $user_email = trim($this->input->post('user_email', TRUE));
        $password = trim($this->input->post('user_password', TRUE));
        // $device_type = trim($this->input->post('device_type', TRUE));
        $device_type = 'Desktop';
        $data = $this->M_users->login($user_email, $password);


        if ($data == false) {


            $log_data = array(
                'user_email'  => $this->input->post('user_email'),
                'entered_password'  => $this->input->post('user_password'),
                'login_ip'    => $this->input->ip_address(),
                'login_time'  => date("Y-m-d h:i:s"),
                'login_os'  => $platform,
                'login_device'  => $device_type,
                'login_browser'  => $agent
            );

            $log_info = $this->M_users->add_failed_user_log($log_data);


            $data = array('status' => 'error', 'msg' => 'Email or password is wrong');
            echo json_encode($data);
            exit();
        }

        $log_data = array(
            'user_id'  => $data->user_id,
            'login_ip'    => $this->input->ip_address(),
            'login_time'  => date("Y-m-d h:i:s"),
            'login_os'  => $platform,
            'login_device'  => $device_type,
            'login_browser'  => $agent
        );

        $log_info = $this->M_users->add_user_log($log_data);

        $token = rand(100000, 9999999);
        $tokenEnc = md5($token);
        $session = [
            'user_id' => en_func($data->user_id, 'e'),
            'user_type_display' => $data->user_type,
            'full_name' => $data->full_name,
            'user_name' => $data->user_name,
            'user_photo' => $data->user_photo,
            'user_email' => $data->user_email,
            'user_mobile' => $data->user_mobile,
            'enc_token' => $tokenEnc,
            'userdata' => $data,
            'login_status' => "1"
        ];
        $this->session->set_userdata($session);

        //$setToken = $this->M_users->updatetoken($tokenEnc, $data->user_id);
        //lq();
        $message = "You have logged in from " . $platform . " , " . $agent . " at " . date("Y-m-d h:i:s");

        //$mail_response = $this->send_email($data->user_email, $message, 'Sanjeevini Login Attempt');


        $this->dashboard_menus();

        $data = array('status' => 'success', 'msg' => 'Successfully logged in');
        echo json_encode($data);
        exit();
        //redirect('adminhome?sec_token=' . $tokenEnc);
    }

    function check_captcha_matches($user_captcha)
    {
        $captcha = $this->session->flashdata('captcha_content');
        $captcha_verification = ($captcha == $user_captcha) ? true : false;
        return $captcha_verification;
    }

    public function refresh_captcha()
    {
        $captcha_word = rand(1000, 9999);
        $captchaimage = createCaptchaImage($captcha_word);



        $data['word'] = $captcha_word;


        $this->session->set_flashdata('captcha_content', $captcha_word);
        echo $captchaimage;
    }


    public function logout()
    {
        $token_destroy = $this->M_users->updatetoken('', en_func($this->session->userdata('user_id'), 'd'));

        $this->session->sess_destroy();
        redirect('admin/login');
    }


    
    public function dashboard_menus()
    {

        $menus = array();

        $user_id = en_func(ss('user_id'), 'd');
        $parent_modules = $this->M_users->all_parent_modules();

        $unallocated_modules = (ss('user_type_display') == 1) ?
            $this->M_users->all_unallocated_sub_modules() :
            $this->M_users->unallocated_sub_modules($user_id);

        $modules_allocated = (ss('user_type_display') == 1) ?
            $this->M_users->all_modules() :
            $this->M_users->modules_allocated($user_id);


        $menus['unallocated'] = $unallocated_modules;
        $menus['allocated'] = array();

        $menus['unallocated_length'] = sizeof($menus['unallocated']);


        $i = 0;
        $j = 0;
        foreach ($parent_modules  as $parents) :
            $modules_allocated = $this->M_users->all_sub_modules_of_parent($parents->mg_id);
            $has_submenu = (count($modules_allocated) > 0) ? true : false;

            if ($has_submenu) :
                foreach ($modules_allocated  as $modules) :
                    //  $menus['allocated'][$i] = $parents->main_module_name;
                    $menus['allocated'][$parents->main_module_name]['submodules'][$j++] = $modules;
                    $menus['allocated'][$parents->main_module_name]['parent'] = $parents->main_module_name;
                    $menus['allocated'][$parents->main_module_name]['module_group_label'] = $parents->module_group_label;
                endforeach;
            endif;
            $i++;
        endforeach;

        $menus['parent_length'] = sizeof($menus['allocated']);
        $menus['base_path'] = base_url();

        $session_data["menus"] = $menus;
        $this->session->set_userdata($session_data);

    }
}
