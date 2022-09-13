<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');

        $this->load->model('M_users');
    }

    public function index()
    {
        $data = $this->data;


        $captcha_word = rand(1000, 9999);
        $data['captchaimage'] = createCaptchaImage($captcha_word);

        $data['word'] = $captcha_word;


        $this->session->set_flashdata('captcha_content', $captcha_word);
        $this->template->views('auth/register', $data);

        // $this->load->view('auth/register', $data);

    }

    public function register_user()
    {
        if (!$this->validate_register_form())
            redirect('register');

        $token = rand(100000, 9999999);
        $tokenEnc = md5($token);

        $data_insert = array(
            'full_name' => $this->input->post('full_name', TRUE),
            'user_name' => $this->input->post('user_name', TRUE),
            'user_password' => md5($this->input->post('user_password', TRUE)),
            'user_email' => $this->input->post('user_email', TRUE),
            'user_mobile' => $this->input->post('user_mobile', TRUE),
            'user_token' => $tokenEnc,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'user_status' => 1,
            'user_type' => 2,
            'user_photo' => 'avatar.png',

        );

        $data_insert = $this->security->xss_clean($data_insert);
        $result = $this->M_users->save_registration($data_insert);

        if ($result) :
            $message['status'] = 'success';
            $message['msg'] = 'Registered successfully';
            echo json_encode($message);
            exit();
        else :
            $message['status'] = 'error';
            $message['msg'] = 'Could not register';
            echo json_encode($message);
            exit();
        endif;


        $this->add_activity_log(1);
    }

    function validate_register_form()
    {
        //check unique email

        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|required|numeric');
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('user_retyped_password', 'Retyped Password', 'trim|required');

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
