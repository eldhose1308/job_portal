<?php
defined('BASEPATH') or exit('No direct script access allowed');

class candidates extends MY_Controller
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
        $data["status"] = $this->Common_model->select_status();
        $data["genders"] = $this->Common_model->select_all("ci_gender");


        $this->template->views('admin/candidates/index', $data);
    }

    public function add_candidates()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $records["content"] = $this->load->view('admin/candidates/add_candidates', $data, true);
        $records["heading"] = "Add Candidates details";
        $records["sub_heading"] = "Add Candidates details which are registered in the portal";

        $this->response(200,$records);
    }

    public function edit_candidates($user_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["user_id"] = $user_id;

        $user_id = en_func($user_id, 'd');

        $data["candidatesDetails"] = $this->Common_model->select_by_id('ci_candidates', $user_id, 'user_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["candidatesDetails"]);

        
        $records["content"] = $this->load->view('admin/candidates/add_candidates', $data, true);
        $records["heading"] = "Edit Candidates details";
        $records["sub_heading"] = "Edit Candidates details which are registered in the portal";

        $this->response(200,$records);
    }

    public function view_candidates($user_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["user_id"] = $user_id;

        $user_id = en_func($user_id, 'd');

        $data["candidatesDetails"] = $this->Common_model->select_by_id('ci_candidates', $user_id, 'user_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["candidatesDetails"]);

        
        $records["content"] = $this->load->view('admin/candidates/add_candidates', $data, true);
        $records["heading"] = "View Candidates details";
        $records["sub_heading"] = "View Candidates details which are registered in the portal";

        $this->response(200,$records);
    }

    public function update_candidates()
    {
        $user_id = $this->input->post('user_id');
        $this->save_candidates('update', $user_id);
    }


    public function save_candidates($func = 'add', $user_id = 0)
    {
        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email address', 'trim|required');
        $this->form_validation->set_rules('user_mobile', 'Mobile number', 'trim|required|numeric');
        $this->form_validation->set_rules('email_verified', 'Email verfied', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('user_id', 'candidates ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        // $user_id = $this->user_id;



        $data_insert = array(
            'full_name' => $this->input->post('full_name'),
            'user_email' => $this->input->post('user_email'),
            'user_mobile' => $this->input->post('user_mobile'),
            'email_verified' => $this->input->post('email_verified'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => en_func($this->input->post('status'), 'd')

        );

        $user_id =  en_func($user_id, 'd');


        if ($func == 'update') :
            $msg = "Candidate details successfully updated !";
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $user_id, 'ci_candidates', 'user_id');
            $this->add_activity_log("Updated candidate details");
        else :
            $msg = "New Candidate successfully added !";
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_candidates');
            $this->add_activity_log("Added candidate details");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => $msg);
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Candidate details could not be added !');
        echo json_encode($data);
        exit();
    }

    public function candidates_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_candidates', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $user_id  = en_func($row->user_id, 'e');
            $email_verified = ( $row->email_verified == 1 ) ? '<i class="fa fa-check fa-success" aria-hidden="true"></i>' : '<i class="fa fa-times fa-danger" aria-hidden="true"></i>';
            $data[] = array(
                ++$i,
                ++$i,
                '<a>
                    <h5>' . $row->full_name . '</h5>
                </a>',
                '<span class="font-sm text-primary">' . $row->user_email . $email_verified .'</span>',
                '<span class="font-sm color-text-mutted">' . $row->user_mobile . '</span>',
                '<p class="font-xs color-text-paragraph-2">Short note</p>',

                '
                <div class="col-3 datacard_btns">
                    <a class="btn btn-tags-sm mb-10 text-white bg-custom open-offcanvas" data-url="' . base_url() . 'admin/candidates/edit_candidates/' . $user_id . '">Edit</a>
                </div>
                <div class="col-3">
                    <a class="btn btn-tags-sm mb-10 text-white bg-info open-offcanvas" data-url="' . base_url() . 'admin/candidates/view_candidates/' . $user_id . '">View</a>
                </div>
                <div class="col-3">
                    <a class="btn btn-tags-sm mb-10 text-white bg-danger">Delete</a>
                </div>
                <div class="col-3">
                    <a class="btn btn-tags-sm mb-10 open-offcanvas" data-url="' . base_url() . 'admin/candidates/show_resume">Resume</a>
                </div>
                '

            );
        }
        $this->response(200, $data);
    }


    public function delete_candidates($user_id)
    {
        $user_id = en_func($user_id, 'd');
        $response = $this->Common_model->delete_table($user_id, 'ci_candidates', 'user_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Quick link has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Quick link could not be deleted!');
        redirect(base_url('admin/candidates'));
    }





    public function show_resume()
    {
        $records = array();

        $records['heading'] = 'Resume';
        $records['content'] = 'Resume here';

        $this->response(200, $records);
    }
}
