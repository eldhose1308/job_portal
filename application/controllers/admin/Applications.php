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

    public function change_application_status()
    {
        $this->form_validation->set_rules('apply_id', 'Application', 'trim|required');
        $this->form_validation->set_rules('application_status', 'Application status', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }

        $application_status = en_func($this->input->post('application_status'), 'd');
        $data_insert = array(
            'job_status' => $application_status,
            'updated_at' => date("Y-m-d h:i:s")
        );

        $apply_id = en_func($this->input->post('apply_id'), 'd');

        $msg = "Application details successfully updated !";
        unset($data_insert['created_at']);
        $qry_response = $this->Common_model->update_table($data_insert, $apply_id, 'ci_jobs_apply', 'apply_id');
        //lq();
        $this->add_activity_log("Updated application details");


        //lq();
        $status_bg = ($application_status == 1) ? 'custom' : ($application_status == 2 ? 'success' : 'danger');

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => $msg, 'status_name' => $msg, 'status_bg' => $status_bg);
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Application details could not be changed !');
        echo json_encode($data);
        exit();
    }


    public function show_applications($job_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["job_id"] = $job_id;

        $job_id = en_func($job_id, 'd');

        $data["jobsDetails"] = $this->Common_model->select_by_id('ci_jobs', $job_id, 'job_id');
        $data["jobApplications"] = $this->M_jobs->select_applications_of_job($job_id);

        $this->check_exists($data["jobsDetails"]);

        $data["job_statuses"] = $this->Common_model->select_job_status();

        $records["content"] = $this->load->view('admin/applications/show_applications', $data, true);
        $this->response(200, $records);
    }


    public function jobs_json()
    {

        $page = ((int) $this->input->get('page') == 0) ? 1 : (int) $this->input->get('page');
        $per_page = ((int) $this->input->get('per_page') == 0) ? 10 : (int) $this->input->get('per_page');
        $sortby = ($this->input->get('sortby') == 'asc') ? 'asc' : 'desc';

        $query = $this->input->get('query');

        $start_index = ($page - 1) * $per_page;
        $total_rows = $this->M_jobs->select_all_jobs_admin_count();


        $records['data'] = $this->M_jobs->select_all_jobs_admin($query, $per_page, $start_index, $page, $sortby);


        $data = array();
        $responses = array();
        $i = 0;
        foreach ($records['data']  as $row) {
            $job_id  = en_func($row->job_id, 'e');



            $updated_at = $row->updated_at;

            $timeFirst  = strtotime($updated_at);
            $timeSecond = strtotime(date("Y-m-d h:i:s"));

            $differenceInSeconds = $timeSecond - $timeFirst;

            $first_one = $i == 1 ? "open-now" : "";
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
                'action_btns' =>
                '<a class=" ' . $first_one . ' btn btn-tags-sm mb-10 text-white bg-custom show-applications-of-job" data-url="' . base_url() . 'admin/applications/show_applications/' . $job_id . '">Show Applications</a>                           
                 '


            );
        }

        // dd($responses);

        $data['jobs'] = $responses;
        $data['show_pagination'] = true;

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
