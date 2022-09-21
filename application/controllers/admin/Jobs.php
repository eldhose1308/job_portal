<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jobs extends MY_Controller
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


        $this->template->views('admin/jobs/index', $data);
    }

    public function add_jobs()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data["countries"] = $this->Common_model->select_all("ci_countries");

        $records["content"] = $this->load->view('admin/jobs/add_jobs', $data, true);
        $records["heading"] = "Add jobs details";
        $records["sub_heading"] = "Add jobs details which are registered in the portal";

        $this->response(200,$records);
    }

    public function edit_jobs($job_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["job_id"] = $job_id;

        $job_id = en_func($job_id, 'd');

        $data["jobsDetails"] = $this->Common_model->select_by_id('ci_jobs', $job_id, 'job_id');
        $data["status"] = $this->Common_model->select_status();
        $data["countries"] = $this->Common_model->select_all("ci_countries");

        $this->check_exists($data["jobsDetails"]);

        
        $records["content"] = $this->load->view('admin/jobs/add_jobs', $data, true);
        $records["heading"] = "Edit jobs details";
        $records["sub_heading"] = "Edit jobs details which are registered in the portal";

        $this->response(200,$records);
    }

    public function view_jobs($job_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["job_id"] = $job_id;

        $job_id = en_func($job_id, 'd');

        $data["jobsDetails"] = $this->Common_model->select_by_id('ci_jobs', $job_id, 'job_id');
        $data["status"] = $this->Common_model->select_status();
        $data["countries"] = $this->Common_model->select_all("ci_countries");

        $this->check_exists($data["jobsDetails"]);

        
        $records["content"] = $this->load->view('admin/jobs/add_jobs', $data, true);
        $records["heading"] = "View jobs details";
        $records["sub_heading"] = "View jobs details which are registered in the portal";

        $this->response(200,$records);
    }

    public function update_jobs()
    {
        $job_id = $this->input->post('job_id');
        $this->save_jobs('update', $job_id);
    }


    public function save_jobs($func = 'add', $job_id = 0)
    {
        $this->form_validation->set_rules('job_title', 'Job title', 'trim|required');
        $this->form_validation->set_rules('brief_description', 'Brief description', 'trim|required');
        $this->form_validation->set_rules('job_description', 'Full description', 'trim|required');
        $this->form_validation->set_rules('job_location', 'Job location', 'trim|required');
        $this->form_validation->set_rules('min_experience', 'Minimum Experience', 'trim|required|numeric');
        $this->form_validation->set_rules('max_experience', 'Max Experience', 'trim|required|numeric');
        $this->form_validation->set_rules('min_salary', 'Minimum Salary', 'trim|required|numeric');
        $this->form_validation->set_rules('max_salary', 'Max Salary', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('job_id', 'jobs ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;



        $data_insert = array(
            'job_title' => $this->input->post('job_title'),
            'brief_description' => $this->input->post('brief_description'),
            'job_description' => $this->input->post('job_description'),
            'job_location' => en_func($this->input->post('job_location'),'d'),
            'min_experience' => $this->input->post('min_experience'),
            'max_experience' => $this->input->post('max_experience'),
            'min_salary' => $this->input->post('min_salary'),
            'max_salary' => $this->input->post('max_salary'),
            'added_by' => $user_id,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => en_func($this->input->post('status'), 'd')

        );

        $job_id =  en_func($job_id, 'd');


        if ($func == 'update') :
            $msg = "Job details successfully updated !";
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $job_id, 'ci_jobs', 'job_id');
            $this->add_activity_log("Updated job details");
        else :
            $msg = "New Job successfully added !";
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_jobs');
            $this->add_activity_log("Added job details");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => $msg);
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Job details could not be added !');
        echo json_encode($data);
        exit();
    }

    public function jobs_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_jobs', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']  as $row) {
            $job_id  = en_func($row->job_id, 'e');
            $data[] = array(
                ++$i,
                ++$i,
                '<a>
                    <h5>' . $row->job_title . '</h5>
                </a>',
                '<span class="font-sm text-info">' . $row->min_experience . ' - ' . $row->max_experience .' years experience </span>',
                '<span class="font-sm text-primary">' . $row->min_salary . ' - ' . $row->max_salary .'</span>',
                '<span class="font-sm">' . $row->brief_description . '</span>',

                '
                <div class="employers-info mt-15 row">
                
                <div class="col-3 datacard_btns">
                    <a class="btn btn-tags-sm mb-10 text-white bg-custom open-offcanvas" data-url="' . base_url() . 'admin/jobs/edit_jobs/' . $job_id . '">Edit</a>
                </div>
                <div class="col-3">
                    <a class="btn btn-tags-sm mb-10 text-white bg-info open-offcanvas" data-url="' . base_url() . 'admin/jobs/view_jobs/' . $job_id . '">View</a>
                </div>
                <div class="col-3">
                    <a class="btn btn-tags-sm mb-10 text-white bg-danger">Delete</a>
                </div>
                
                </div>
                '

            );
        }
        $this->response(200, $data);
    }


    public function delete_jobs($user_id)
    {
        $user_id = en_func($user_id, 'd');
        $response = $this->Common_model->delete_table($user_id, 'ci_jobs', 'user_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Quick link has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Quick link could not be deleted!');
        redirect(base_url('admin/jobs'));
    }



    /*

    Countries CRUD

    */



    public function countries()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();
        $data["genders"] = $this->Common_model->select_all("ci_gender");


        $this->template->views('admin/jobs/countries/index', $data);
    }

    public function add_countries()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $records["content"] = $this->load->view('admin/jobs/countries/add_countries', $data, true);
        $records["heading"] = "Add countries details";
        $records["sub_heading"] = "Add countries details which are registered in the portal";

        $this->response(200,$records);
    }

    public function edit_countries($country_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["country_id"] = $country_id;

        $country_id = en_func($country_id, 'd');

        $data["countriesDetails"] = $this->Common_model->select_by_id('ci_countries', $country_id, 'country_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["countriesDetails"]);

        
        $records["content"] = $this->load->view('admin/jobs/countries/add_countries', $data, true);
        $records["heading"] = "Edit countries details";
        $records["sub_heading"] = "Edit countries details which are registered in the portal";

        $this->response(200,$records);
    }

    public function view_countries($country_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["country_id"] = $country_id;

        $country_id = en_func($country_id, 'd');

        $data["countriesDetails"] = $this->Common_model->select_by_id('ci_countries', $country_id, 'country_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["countriesDetails"]);

        
        $records["content"] = $this->load->view('admin/jobs/countries/add_countries', $data, true);
        $records["heading"] = "View countries details";
        $records["sub_heading"] = "View countries details which are registered in the portal";

        $this->response(200,$records);
    }

    public function update_countries()
    {
        $country_id = $this->input->post('country_id');
        $this->save_countries('update', $country_id);
    }


    public function save_countries($func = 'add', $country_id = 0)
    {
        $this->form_validation->set_rules('country_name', 'Country name', 'trim|required');


        if ($func == 'update')
            $this->form_validation->set_rules('country_id', 'Country ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;



        $data_insert = array(
            'country_name' => $this->input->post('country_name'),
            'added_by' => $user_id,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => en_func($this->input->post('status'), 'd')

        );

        $country_id =  en_func($country_id, 'd');


        if ($func == 'update') :
            $msg = "Country details successfully updated !";
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $country_id , 'ci_countries', 'country_id');
            $this->add_activity_log("Updated country details");
        else :
            $msg = "New Country successfully added !";
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_countries');
            $this->add_activity_log("Added country details");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => $msg);
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Country details could not be added !');
        echo json_encode($data);
        exit();
    }

    public function countries_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_countries', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $country_id   = en_func($row->country_id , 'e');
            $data[] = array(
                ++$i,
                ++$i,
                '<a>
                    <h5>' . $row->country_name . '</h5>
                </a>',

                '
                <div class="employers-info mt-15 row">
                <div class="col-3 datacard_btns">
                    <a class="btn btn-tags-sm mb-10 text-white bg-custom open-offcanvas" data-url="' . base_url() . 'admin/jobs/edit_countries/' . $country_id  . '">Edit </a>
                </div>
               
               
                </div>
                </div>
                '

            );
        }
        $this->response(200, $data);
    }



}
