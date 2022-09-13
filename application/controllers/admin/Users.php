<?php
defined('BASEPATH') or exit('No direct script access allowed');

class users extends MY_Controller
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
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/users/index', $data);
    }


    public function add_users()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data["user_type"] = $this->M_users->get_userstypes_list();

        $data["disabled"] = '';

        $this->template->views('admin/users/add_users', $data);
    }


    public function edit_users($user_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["user_id"] = $user_id;
        $data["disabled"] = '';

        $user_id = en_func($user_id, 'd');
        $data["userDetails"] = $this->M_users->select_user_by_id($user_id);
        $data["status"] = $this->Common_model->select_status();
        $data["user_type"] = $this->M_users->get_userstypes_list();


        $this->template->views('admin/users/add_users', $data);
    }

    public function view_users($user_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'view';
        $data["user_id"] = $user_id;
        $data["disabled"] = 'disabled';
        $data["status"] = $this->Common_model->select_status();

        $data["user_type"] = $this->M_users->get_userstypes_list();

        $user_id = en_func($user_id, 'd');
        $data["userDetails"] = $this->M_users->select_user_by_id($user_id);



        $this->template->views('admin/users/add_users', $data);
    }



    public function update_user()
    {
        $user_id = $this->input->post('user_id');
        $this->save_user('update', $user_id);
    }



    public function save_user($func = 'add', $user_id = 0)
    {
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|required|numeric');
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required|is_unique[users.user_name]');

        if ($func == 'add') :
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('user_retyped_password', 'Retyped Password', 'trim|required');
        endif;


        if ($this->form_validation->run() == FALSE) :
            $message['status'] = 'error';
            $message['msg'] = validation_errors();
            echo json_encode($message);
            exit();
        endif;

        if ($func == 'add') :
            $user_password = $this->input->post('user_password', TRUE);
            $user_retyped_password = $this->input->post('user_retyped_password', TRUE);
            if ($user_password != $user_retyped_password) :
                $message['status'] = 'error';
                $message['msg'] = 'Passwords doesnt match';
                echo json_encode($message);
                exit();
            endif;
        endif;

        // if (en_func($this->input->post('user_type'), 'd') == 1) :
        //     $message['status'] = 'error';
        //     $message['msg'] = 'Cannot add the user';
        //     echo json_encode($message);
        //     exit();
        // endif;


        // if ($func == 'update') :
        //     $password_true = $this->M_users->check_password(md5($this->input->post('user_password', TRUE)), $user_id);
        //     if ($password_true == 0) :
        //         $message['status'] = 'error';
        //         $message['msg'] = 'Password is not correct';
        //         echo json_encode($message);
        //         exit();
        //     endif;
        // endif;

        $user_id =  en_func($user_id, 'd');


        $token = rand(100000, 9999999);
        $tokenEnc = md5($token);

        $data_insert = array(
            'full_name' => $this->input->post('full_name', TRUE),
            'user_name' => $this->input->post('user_name', TRUE),
            'user_email' => $this->input->post('user_email', TRUE),
            'user_mobile' => $this->input->post('user_mobile', TRUE),
            'user_token' => $tokenEnc,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'user_status' => en_func($this->input->post('status'), 'd'),
            'user_type' => en_func($this->input->post('user_type'), 'd'),
            'user_photo' => 'avatar.png',

        );


        $data_insert = $this->security->xss_clean($data_insert);
        if ($func == 'update') :
            unset($data_insert['created_at']);
            $result = $this->M_users->update_registration($data_insert, $user_id);
            $this->add_activity_log("Updated user");

        else :
            $data_insert['user_password'] = md5($this->input->post('user_password', TRUE));
            $result = $this->M_users->save_registration($data_insert);
            $this->add_activity_log("Added new user");

        endif;


        if ($result) :
            $message['status'] = 'success';
            $message['msg'] = 'User added successfully';
            echo json_encode($message);
            exit();
        else :
            $message['status'] = 'error';
            $message['msg'] = 'Could not add user';
            echo json_encode($message);
            exit();
        endif;


    }

    function validate_register_form($func)
    {

        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|required|numeric');
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');

        if ($func == 'add') :
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('user_retyped_password', 'Retyped Password', 'trim|required');
        endif;


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

        if ($func == 'add') :
            $user_password = $this->input->post('user_password', TRUE);
            $user_retyped_password = $this->input->post('user_retyped_password', TRUE);
            if ($user_password != $user_retyped_password) :
                $message['status'] = 'error';
                $message['msg'] = 'Passwords doesnt match';
                echo json_encode($message);
                exit();
            endif;
        endif;


        return true;
    }


    function check_captcha_matches($user_captcha)
    {

        $captcha = $this->session->flashdata('captcha_content');
        $captcha_verification = ($captcha == $user_captcha) ? true : false;
        return $captcha_verification;
    }


    public function users_json()
    {
        $user_id = $this->user_id;
        $status = (int) en_func($this->input->get('status'), 'd');


        $records['data'] = $this->M_users->get_users_list($status);
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $user_id = en_func($row->user_id, 'e');
            $data[] = array(
                ++$i,
                $row->user_name,
                $row->user_email,
                $row->user_type,
                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/users/edit_users/' . $user_id  . '" title="Edit User" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/users/view_users/' . $user_id  . '" title="View User" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>'

            );
        }
        $this->response(200, $data);
    }

    public function refresh_captcha()
    {

        $captcha_word = rand(1000, 9999);
        $captchaimage = createCaptchaImage($captcha_word);



        $data['word'] = $captcha_word;


        $this->session->set_flashdata('captcha_content', $captcha_word);
        echo $captchaimage;
    }




    /*
     * 
     * 
     *  User types
     *  
     * 
     * 
    */





    public function user_types()
    {

        $data = $this->data;

        $this->template->views('admin/user_types/index', $data);
    }

    public function add_usertypes()
    {
        $data = $this->data;
        $data["operation"] = 'add';

        $this->template->views('admin/user_types/add_usertypes', $data);
    }

    public function edit_usertypes($ut_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["ut_id"] = $ut_id;

        $ut_id = en_func($ut_id, 'd');

        $data["usertypesDetails"] = $this->M_users->select_usertypes_by_id($ut_id);


        $this->template->views('admin/user_types/add_usertypes', $data);
    }

    public function view_usertypes($ut_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';

        $ut_id = en_func($ut_id, 'd');

        $data["usertypesDetails"] = $this->M_users->select_usertypes_by_id($ut_id);

        $this->template->views('admin/user_types/add_usertypes', $data);
    }

    public function update_usertypes()
    {
        $ut_id = $this->input->post('ut_id');
        $this->save_usertypes('update', $ut_id);
    }


    public function save_usertypes($func = 'add', $ut_id = 0)
    {
        $this->form_validation->set_rules('user_type', 'User type', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('ut_id', 'Usertype ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;


        $data_insert = array(
            'user_type' => $this->input->post('user_type'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 1

        );

        $ut_id =  en_func($ut_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->M_users->update_usertype($data_insert, $ut_id);
        else :
            $qry_response = $this->M_users->insert_usertype($data_insert);
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Usertype successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Usertype could not be added !');
        echo json_encode($data);
        exit();
    }


    public function usertypes_json()
    {
        $user_id = $this->user_id;


        $records['data'] = $this->M_users->get_userstypes_list();
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $ut_id = en_func($row->ut_id, 'e');
            $data[] = array(
                ++$i,
                $row->user_type,
                $row->created_at,
                $row->updated_at,
                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/users/edit_usertypes/' . $ut_id  . '" title="Edit Usertype" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/users/view_usertypes/' . $ut_id  . '" title="View Usertype" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>'

            );
        }
        $this->response(200, $data);
    }
}
