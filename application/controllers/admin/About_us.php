<?php
defined('BASEPATH') or exit('No direct script access allowed');

class about_us extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');
    }



    public function index()
    {
        $data = $this->data;

        $aboutUsDetails = $data["about_usDetails"] = $this->Common_model->select_single('ci_about_us');
        $data["operation"] = (empty($aboutUsDetails)) ? "add" : "edit";

        $this->template->views('admin/about_us/index', $data);
    }




    public function add_first_image()
    {
        $data = $this->data;

        $aboutUsDetails = $data["about_usDetails"] = $this->Common_model->select_single('ci_about_us');
        $data["operation"] = (empty($aboutUsDetails)) ? "add" : "edit";

        $this->template->views('admin/about_us/add_first_image', $data);
    }


    public function add_second_image()
    {
        $data = $this->data;

        $aboutUsDetails = $data["about_usDetails"] = $this->Common_model->select_single('ci_about_us');
        $data["operation"] = (empty($aboutUsDetails)) ? "add" : "edit";

        $this->template->views('admin/about_us/add_second_image', $data);
    }




    public function add_third_image()
    {
        $data = $this->data;

        $aboutUsDetails = $data["about_usDetails"] = $this->Common_model->select_single('ci_about_us');
        $data["operation"] = (empty($aboutUsDetails)) ? "add" : "edit";

        $this->template->views('admin/about_us/add_third_image', $data);
    }




    public function add_fourth_image()
    {
        $data = $this->data;

        $aboutUsDetails = $data["about_usDetails"] = $this->Common_model->select_single('ci_about_us');
        $data["operation"] = (empty($aboutUsDetails)) ? "add" : "edit";

        $this->template->views('admin/about_us/add_fourth_image', $data);
    }




    public function update_about_us()
    {
        $about_id = $this->input->post('about_id');
        $this->save_about_us('update', $about_id);
    }




    public function save_about_us($func = 'add', $about_id = 0)
    {
        $this->form_validation->set_rules('about_title', 'About title', 'trim|required');
        $this->form_validation->set_rules('front_description', 'Front description', 'trim|required');
        $this->form_validation->set_rules('page_description', 'Page description', 'trim|required');
        $this->form_validation->set_rules('mission', 'Mission', 'trim|required');
        $this->form_validation->set_rules('vision', 'Vision', 'trim|required');


        if ($func == 'update')
            $this->form_validation->set_rules('about_id', 'about ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;


        $data_insert = array(
            'about_title' => $this->input->post('about_title'),
            'front_description' => $this->input->post('front_description'),
            'page_description' => $this->input->post('page_description'),
            'mission' => $this->input->post('mission'),
            'vision' => $this->input->post('vision'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 1

        );

        $about_id =  en_func($about_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $about_id, 'ci_about_us', 'about_id');
            $this->add_activity_log("Updated about us");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_about_us');
            $this->add_activity_log("Added about us");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'About_us successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'About_us could not be added !');
        echo json_encode($data);
        exit();
    }






    public function update_first_image()
    {
        $about_id = $this->input->post('about_id');
        $this->save_first_image('update', $about_id);
    }



    public function save_first_image($func = 'add', $about_id = 0)
    {

        $user_id = $this->user_id;

        if ($func == 'add') :
            $data = $_POST['photo'];
            $image_path = $this->upload_base64Images($data, 'uploads/about_us/');
        endif;

        if ($func == 'update') :
            $image_path = $this->input->post('image_path');
            if (strlen($this->input->post('image_path')) < 1) :
                $data = $_POST['photo'];
                $image_path = $this->upload_base64Images($data, 'uploads/about_us/');
            endif;
        endif;

        $data_insert = array(
            'about_image_1' => $image_path,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 1

        );


        $about_id =  en_func($about_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $about_id, 'ci_about_us', 'about_id');
            $this->add_activity_log("Updated about us image");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_about_us');
            $this->add_activity_log("Added about us image");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'About us image successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'About us image could not be added !');
        echo json_encode($data);
        exit();
    }




    public function update_second_image()
    {
        $about_id = $this->input->post('about_id');
        $this->save_second_image('update', $about_id);
    }



    public function save_second_image($func = 'add', $about_id = 0)
    {

        $user_id = $this->user_id;

        if ($func == 'add') :
            $data = $_POST['photo'];
            $image_path = $this->upload_base64Images($data, 'uploads/about_us/');
        endif;

        if ($func == 'update') :
            $image_path = $this->input->post('image_path');
            if (strlen($this->input->post('image_path')) < 1) :
                $data = $_POST['photo'];
                $image_path = $this->upload_base64Images($data, 'uploads/about_us/');
            endif;
        endif;

        $data_insert = array(
            'about_image_2' => $image_path,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 1

        );


        $about_id =  en_func($about_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $about_id, 'ci_about_us', 'about_id');
            $this->add_activity_log("Updated about us image");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_about_us');
            $this->add_activity_log("Added about us image");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'About us image successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'About us image could not be added !');
        echo json_encode($data);
        exit();
    }





    public function update_third_image()
    {
        $about_id = $this->input->post('about_id');
        $this->save_third_image('update', $about_id);
    }



    public function save_third_image($func = 'add', $about_id = 0)
    {

        $user_id = $this->user_id;

        if ($func == 'add') :
            $data = $_POST['photo'];
            $image_path = $this->upload_base64Images($data, 'uploads/about_us/');
        endif;

        if ($func == 'update') :
            $image_path = $this->input->post('image_path');
            if (strlen($this->input->post('image_path')) < 1) :
                $data = $_POST['photo'];
                $image_path = $this->upload_base64Images($data, 'uploads/about_us/');
            endif;
        endif;

        $data_insert = array(
            'about_image_3' => $image_path,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 1

        );


        $about_id =  en_func($about_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $about_id, 'ci_about_us', 'about_id');
            $this->add_activity_log("Updated about us image");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_about_us');
            $this->add_activity_log("Added about us image");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'About us image successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'About us image could not be added !');
        echo json_encode($data);
        exit();
    }




    public function update_fourth_image()
    {
        $about_id = $this->input->post('about_id');
        $this->save_fourth_image('update', $about_id);
    }



    public function save_fourth_image($func = 'add', $about_id = 0)
    {

        $user_id = $this->user_id;

        if ($func == 'add') :
            $data = $_POST['photo'];
            $image_path = $this->upload_base64Images($data, 'uploads/about_us/');
        endif;

        if ($func == 'update') :
            $image_path = $this->input->post('image_path');
            if (strlen($this->input->post('image_path')) < 1) :
                $data = $_POST['photo'];
                $image_path = $this->upload_base64Images($data, 'uploads/about_us/');
            endif;
        endif;

        $data_insert = array(
            'about_image_4' => $image_path,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 1

        );


        $about_id =  en_func($about_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $about_id, 'ci_about_us', 'about_id');
            $this->add_activity_log("Updated about us image");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_about_us');
            $this->add_activity_log("Added about us image");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'About us image successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'About us image could not be added !');
        echo json_encode($data);
        exit();
    }


}
