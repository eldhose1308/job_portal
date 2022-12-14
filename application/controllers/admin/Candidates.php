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
        $this->load->model('M_candidates');
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

        $this->response(200, $records);
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

        $this->response(200, $records);
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

        $this->response(200, $records);
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

        $page = ((int) $this->input->get('page') == 0) ? 1 : (int) $this->input->get('page');
        $per_page = ((int) $this->input->get('per_page') == 0) ? 10 : (int) $this->input->get('per_page');
        $sortby = ($this->input->get('sortby') == 'asc') ? 'asc' : 'desc';
        $added_before = (int) $this->input->get('added_before');

        $query = $this->input->get('query');

        $start_index = ($page - 1) * $per_page;
        $total_rows = $this->M_candidates->select_all_candidates_count($query, $per_page, $start_index, $page, $sortby, $added_before);


        $records['data'] = $this->M_candidates->select_all_candidates($query, $per_page, $start_index, $page, $sortby, $added_before);

// lq();
        $data = array();
        $responses = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $user_id  = en_func($row->user_id, 'e');


            $responses[] = array(
                ++$i,
                '_id' => $user_id,
                'full_name' => $row->full_name,
                'user_name' => $row->user_name,
                'user_email' => $row->user_email,
                'user_mobile' => $row->user_mobile,
                'user_resume' => $row->user_resume,
                'email_verified' => $row->email_verified,
                'email_verified_at' => date('d M, Y', strtotime($row->email_verified_at)) . ' | ' . date('h:i a', strtotime($row->email_verified_at)),
                'created_at' => $row->created_at,
                'action_btns' =>
                '<a class="btn btn-tags-sm mb-10 text-white bg-custom open-right-offcanvas" data-url="' . base_url() . 'admin/candidates/edit_candidates/' . $user_id . '">Edit</a>                           
                <a class="btn btn-tags-sm mb-10 text-white bg-info open-right-offcanvas" data-url="' . base_url() . 'admin/candidates/view_candidates/' . $user_id . '">View</a>                           
                <a class="btn btn-tags-sm mb-10 text-white bg-danger">Delete</a> '
            );
        }

        $data["content_null"] = ($i == 0) ?  true : false;

        $data['candidates'] = $responses;
        $data["show_pagination"] = true;

        $data['start_index'] = $start_index;
        $data['per_page'] = $per_page;
        $data['total_rows'] = $total_rows;

        $data['ending_index'] = (($start_index + $per_page) > $total_rows) ? $total_rows : $start_index + $per_page;


        $data['page_limit'] = ceil($total_rows / $per_page);
        $data['current_page'] = $page;
        $data['nums_limit'] = 5;

        $data['user_type'] = 'admin';

        $this->response(200, $data);
    }


    
    public function recent_candidates_json()
    {

        $page = ((int) $this->input->get('page') == 0) ? 1 : (int) $this->input->get('page');
        $per_page = ((int) $this->input->get('per_page') == 0) ? 10 : (int) $this->input->get('per_page');
        $sortby = ($this->input->get('sortby') == 'asc') ? 'asc' : 'desc';
        $added_before = (int) $this->input->get('added_before');

        $query = $this->input->get('query');

        $start_index = ($page - 1) * $per_page;
        $total_rows = $this->M_candidates->select_all_candidates_count($query, $per_page, $start_index, $page, $sortby, $added_before);


        $records['data'] = $this->M_candidates->select_all_candidates($query, $per_page, $start_index, $page, $sortby, $added_before);

// lq();
        $data = array();
        $responses = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $user_id  = en_func($row->user_id, 'e');


            $responses[] = array(
                ++$i,
                '_id' => $user_id,
                'full_name' => $row->full_name,
                'user_name' => $row->user_name,
                'user_email' => $row->user_email,
                'user_mobile' => $row->user_mobile,
                'user_resume' => $row->user_resume,
                'email_verified' => $row->email_verified,
                'email_verified_at' => date('d M, Y', strtotime($row->email_verified_at)) . ' | ' . date('h:i a', strtotime($row->email_verified_at)),
                'created_at' => $row->created_at,
                'action_btns' =>
                '<a class="btn btn-tags-sm mb-10 text-white bg-custom open-right-offcanvas" data-url="' . base_url() . 'admin/candidates/edit_candidates/' . $user_id . '">Edit</a>                           
                <a class="btn btn-tags-sm mb-10 text-white bg-info open-right-offcanvas" data-url="' . base_url() . 'admin/candidates/view_candidates/' . $user_id . '">View</a>                           
                <a class="btn btn-tags-sm mb-10 text-white bg-danger">Delete</a> '
            );
        }

        $data["content_null"] = ($i == 0) ?  true : false;

        $data['candidates'] = $responses;
        $data["show_pagination"] = false;

        $data['start_index'] = $start_index;
        $data['per_page'] = $per_page;
        $data['total_rows'] = $total_rows;

        $data['ending_index'] = (($start_index + $per_page) > $total_rows) ? $total_rows : $start_index + $per_page;


        $data['page_limit'] = ceil($total_rows / $per_page);
        $data['current_page'] = $page;
        $data['nums_limit'] = 5;

        $data['user_type'] = 'admin';

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
