<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jobs extends US_Controller
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
    }

    public function saved()
    {
        $data = $this->data;
        $data["countries"] = $this->Common_model->select_all("ci_countries");

        $this->template->users_views('users/jobs/saved_jobs', $data);
    }


    public function job_applications()
    {
        $data = $this->data;

        $data["countries"] = $this->Common_model->select_all("ci_countries");
        $data["job_statuses"] = $this->Common_model->select_job_status();

        $this->template->users_views('users/job_applications', $data);
    }



    public function saved_jobs_json()
    {

        // Top Sorting
        $page = ((int) $this->input->get('page') == 0) ? 1 : (int) $this->input->get('page');
        $per_page = ((int) $this->input->get('per_page') == 0) ? 10 : (int) $this->input->get('per_page');
        $sortby = ($this->input->get('sortby') == 'asc') ? 'asc' : 'desc';

        // Side Sorting
        $job_location = (int) en_func($this->input->get('job_location'), 'd');
        $posted_date = (int) $this->input->get('posted_date');

        // Search Sorting
        $query = $this->input->get('query');

        $start_index = ($page - 1) * $per_page;
        $total_rows = $this->M_jobs->select_saved_jobs_count($query, $per_page, $start_index, $page, $sortby, $posted_date, $job_location);


        $records['data'] = $this->M_jobs->select_all_saved_jobs_users($query, $per_page, $start_index, $page, $sortby, $posted_date, $job_location);


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
                'wishlist' => $row->wishlist ? true : false,
                'show_wishlist' => true


            );
        }

        $data["content_null"] = ($i == 0) ?  true : false;

        $data['jobs'] = $responses;

        $data['start_index'] = $start_index;
        $data['per_page'] = $per_page;
        $data['total_rows'] = $total_rows;

        $data['ending_index'] = (($start_index + $per_page) > $total_rows) ? $total_rows : $start_index + $per_page;


        $data['page_limit'] = ceil($total_rows / $per_page);
        $data['current_page'] = $page;
        $data['nums_limit'] = 5;

        $this->response(200, $data);
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
        $total_rows = $this->M_jobs->select_applied_jobs_count($query, $per_page, $start_index, $page, $sortby, $posted_date, $job_location);


        $records['data'] = $this->M_jobs->select_all_applied_jobs_users($query, $per_page, $start_index, $page, $sortby, $job_status, $posted_date, $job_location);


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
                'show_wishlist' => false

            );
        }


        $data["content_null"] = ($i == 0) ?  true : false;

        $data['jobs'] = $responses;

        $data['start_index'] = $start_index;
        $data['per_page'] = $per_page;
        $data['total_rows'] = $total_rows;

        $data['ending_index'] = (($start_index + $per_page) > $total_rows) ? $total_rows : $start_index + $per_page;


        $data['page_limit'] = ceil($total_rows / $per_page);
        $data['current_page'] = $page;
        $data['nums_limit'] = 5;

        $this->response(200, $data);
    }
}
