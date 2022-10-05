<?php
defined('BASEPATH') or exit('No direct script access allowed');

class applications extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');
        $this->load->model('M_jobs');
    }

    public function index()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();
        $data["countries"] = $this->Common_model->select_all("ci_countries");
        $data["job_statuses"] = $this->Common_model->select_job_status();


        $this->template->views('admin/applications/index', $data);
    }

    public function add_applications()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data["countries"] = $this->Common_model->select_all("ci_countries");

        $records["content"] = $this->load->view('admin/applications/add_applications', $data, true);
        $records["heading"] = "View jobs applications";
        $records["sub_heading"] = "View jobs applications which are registered in the portal";

        $this->response(200, $records);
    }

    public function edit_applications($job_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["job_id"] = $job_id;

        $job_id = en_func($job_id, 'd');

        $data["jobsDetails"] = $this->Common_model->select_by_id('ci_jobs', $job_id, 'job_id');
        $data["status"] = $this->Common_model->select_status();
        $data["countries"] = $this->Common_model->select_all("ci_countries");

        $this->check_exists($data["jobsDetails"]);


        $records["content"] = $this->load->view('admin/applications/add_applications', $data, true);
        $records["heading"] = "View jobs applications";
        $records["sub_heading"] = "View jobs applications which are registered in the portal";
        $this->response(200, $records);
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


        $records["content"] = $this->load->view('admin/applications/add_applications', $data, true);
        $records["heading"] = "View jobs applications";
        $records["sub_heading"] = "View jobs applications which are registered in the portal";
        $this->response(200, $records);
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
        $this->form_validation->set_rules('job_openings', 'Job openings', 'trim|required|numeric');
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
            'job_location' => en_func($this->input->post('job_location'), 'd'),
            'job_openings' => $this->input->post('job_openings'),
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


    public function applied_jobs_json()
    {

        // Top Sorting
        $page = ((int) $this->input->get('page') == 0) ? 1 : (int) $this->input->get('page');
        $per_page = ((int) $this->input->get('per_page') == 0) ? 10 : (int) $this->input->get('per_page');
        $sortby = ($this->input->get('sortby') == 'asc') ? 'asc' : 'desc';
        $job_status = ((int) en_func($this->input->get('job_status'), 'd') == 0) ? 0 : (int) en_func($this->input->get('job_status'), 'd');

        // Side Sorting
        $job_location = (int) en_func($this->input->get('job_location'), 'd');
        $posted_date = (int) $this->input->get('posted_date');

        // Search Sorting
        $query = $this->input->get('query');



        $start_index = ($page - 1) * $per_page;
        $total_rows = $this->M_jobs->select_all_applied_jobs_count($query, $per_page, $start_index, $page, $sortby, $posted_date, $job_location);


        $records['data'] = $this->M_jobs->select_all_applied_jobs($query, $per_page, $start_index, $page, $sortby, $job_status, $posted_date, $job_location);


        $data = array();
        $responses = array();
        $i = 0;
        foreach ($records['data']  as $row) {
            $job_id  = en_func($row->job_id, 'e');

            $created_at = $row->created_at;

            $timeFirst  = strtotime($created_at);
            $timeSecond = strtotime(date("Y-m-d h:i:s"));

            $differenceInSeconds = $timeSecond - $timeFirst;

            // $quiz_time_left = $quiz_time - $differenceInSeconds;

            $responses[] = array(
                ++$i,
                '_id' => $job_id,
                'job_title' => $row->job_title,
                'job_location' => $row->country_name,
                'min_experience' => $row->min_experience,
                'max_experience' => $row->max_experience,
                'min_salary' => $row->min_salary,
                'max_salary' => $row->max_salary,
                'job_openings' => $row->job_openings,
                'posted_before' => seconds2format($differenceInSeconds) . " ago",
                'brief_description' => $row->brief_description,
                'applied' => $row->applied ? true : false,
                'job_status' => $row->status_name,
                'job_status_badge' => ($row->job_status == 1) ? 'custom' : ($row->job_status == 2 ? 'success' : 'danger'),
                'show_wishlist' => false,
                'action_btns' =>
                '<a class="btn btn-tags-sm mb-10 text-white bg-custom open-right-offcanvas" data-url="' . base_url() . 'admin/applications/edit_applications/' . $job_id . '">Edit</a>                           
                <a class="btn btn-tags-sm mb-10 text-white bg-info open-right-offcanvas" data-url="' . base_url() . 'admin/applications/view_applications/' . $job_id . '">View</a>                           
                <a class="btn btn-tags-sm mb-10 text-white bg-danger">Delete</a> '

            );
        }

        $data["show_application_status"] = true;
        $data["content_null"] = ($i == 0) ?  true : false;

        $data['jobs'] = $responses;

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
}
