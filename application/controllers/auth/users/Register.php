<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');
        $this->load->library('user_agent');

        $this->load->model('M_users');
        $this->load->model('Common_model');
        $this->load->model('M_candidates');

        date_default_timezone_set("Asia/Kolkata");

    }

    public function index()
    {
        if ($this->session->has_userdata('user_login_status')) {
            redirect('usershome', 'refresh');
        }
        $data = array();


        $this->load->view('auth/users/register', $data);
        remove_flashdata();
    }

    public function save_register()
    {
        $this->form_validation->set_rules('full_name', 'Full name', 'required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('user_name', 'User name', 'required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('user_email', 'Email address', 'required|valid_email|min_length[10]|max_length[30]');
        $this->form_validation->set_rules('user_mobile', 'Mobile number', 'numeric|min_length[9]|max_length[12]');
        $this->form_validation->set_rules('user_password', 'Password', 'required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('retyped_password', 'Confirm Password', 'required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');

        if ($this->form_validation->run() == FALSE) :
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        endif;



        /***
         * 
         * Check User Passwords matching or not with the confirmed password
         * 
         */
        $user_password = $this->input->post('user_password', TRUE);
        $retyped_password = $this->input->post('retyped_password', TRUE);
        if ($user_password != $retyped_password) :
            $message['status'] = 'error';
            $message['msg'] = 'Passwords doesnt match';
            echo json_encode($message);
            exit();
        endif;


        
        /***
         * 
         * Check Captcha response
         * 
         */

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


        
        /***
         * 
         * Check User already registered with the same email address
         * 
         */
        $candidatetExists = $this->M_candidates->check_candidate_exists($this->input->post('user_email'));
        if ($candidatetExists) :
            $message['status'] = 'error';
            $message['msg'] = 'User already exists for this mail address,Try forgot password';
            echo json_encode($message);
            exit();
        endif;


        $agent = ($this->agent->is_browser()) ?
            $this->agent->browser() . ' ' . $this->agent->version() : (($this->agent->is_mobile()) ? $this->agent->mobile() : 'Nulls');



        $platform =  $this->agent->platform();


        $data_insert = array(
            'user_password' => md5($this->input->post('user_password', TRUE)),
            'user_name' => $this->input->post('user_name', TRUE),
            'full_name' => $this->input->post('full_name', TRUE),
            'user_email' => $this->input->post('user_email', TRUE),
            'user_mobile' => $this->input->post('user_mobile', TRUE),
            'email_verified' => 0,
            'email_verified_at' => NULL,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1,

        );


        $qry_response = $this->Common_model->insert_table($data_insert, 'ci_candidates');




        $message = "You have logged in from " . $platform . " , " . $agent . " at " . date("Y-m-d h:i:s");


        if ($qry_response > 0) :
            //$mail_response = $this->send_email($data->user_email, $message, 'Sanjeevini patients_login Attempt');

            $data = array('status' => 'success', 'msg' => 'Successfully registered -<a class="btn btn-sm btn-custom" href="'.base_url().'users/login?_='.$this->input->post("user_email").'">Click to login</a>');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Could not register,Please try again');
        echo json_encode($data);
        exit();




    }

    function validate_register_form()
    {
        //check unique email

        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|required|numeric');
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('user_retyped_password', 'Retyped Password', 'trim|required|min_length[5]|max_length[15]');

        if ($this->form_validation->run() == FALSE) :
            $message['status'] = 'error';
            $message['msg'] = validation_errors();
            echo json_encode($message);
            exit();
        endif;

        // $user_captcha = $this->input->post('user_captcha', TRUE);
        // if (!$this->check_captcha_matches($user_captcha)) :
        //     $message['status'] = 'error';
        //     $message['msg'] = 'Captchas doesnt match';
        //     echo json_encode($message);
        //     exit();
        // endif;

        $user_password = $this->input->post('user_password', TRUE);
        $user_retyped_password = $this->input->post('user_retyped_password', TRUE);
        if ($user_password != $user_retyped_password) :
            $message['status'] = 'error';
            $message['msg'] = 'Passwords doesnt match';
            echo json_encode($message);
            exit();
        endif;


        return true;
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
}
