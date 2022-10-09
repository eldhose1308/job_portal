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




    public function apply_job()
    {
        $this->form_validation->set_rules('job_id', 'Job', 'trim|required');
        if ($this->input->post('default_mobile'))
            $this->form_validation->set_rules('user_mobile', 'Mobile number', 'numeric|min_length[9]|max_length[12]');


        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'success', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }




        $data = $this->data;
        $job_id = $this->input->post('job_id');
        $job_id = en_func($job_id, 'd');

        if (!$this->session->has_userdata('user_login_status')) {

            $data = array('status' => 'success', 'msg' => "Unauthorised");
            echo json_encode($data);
            exit();
        }


        $data["jobDetails"] = $this->Common_model->select_by_id('ci_jobs', $job_id, 'job_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["jobDetails"]);

        $candidate_id = $this->user_id;

        $jobApplied = $this->M_jobs->select_applied_job($job_id, $candidate_id);
        if ($jobApplied) {

            $data = array('status' => 'success', 'msg' => "Already Applied");
            echo json_encode($data);
            exit();
        }




        $file_upload["filename"] = $this->input->post('current_resume');
        if (!empty($_FILES['resume']['name'])) :

            $file_upload = $this->addFiles('resume');

            if ($file_upload['status'] == '500') :
                $data = array('status' => 'error', 'msg' => json_encode($file_upload['msg']['error']));
                echo json_encode($data);
                exit();
            endif;
        endif;


        if ($this->input->post('default_resume')) {
            $data_insert = array(
                'user_resume' => $file_upload["filename"]
            );

            $changeProfile = $this->M_candidates->update_profile($data_insert, $candidate_id);
            $this->session->set_userdata('user_resume', $file_upload["filename"]);
        }



        if ($this->input->post('default_mobile')) {

            $data_insert = array(
                'user_mobile' => $this->input->post('user_mobile')
            );

            $changeProfile = $this->M_candidates->update_profile($data_insert, $candidate_id);
            $this->session->set_userdata('user_mobile', $this->input->post('user_mobile'));
        }


        $data_insert = array(
            'job_id' => $job_id,
            'candidate_id' => $candidate_id,
            'candidate_resume' => $file_upload['filename'],
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'job_status' => 1,
            'status' => 1
        );

        $addToWishlist = $this->Common_model->insert_table($data_insert, 'ci_jobs_apply');

        //lq();
        if ($addToWishlist == 0) :
            $data = array('status' => 'error', 'msg' => 'Job could not be applied , Please try again !');
            echo json_encode($data);
            exit();
        endif;

        $message =  "Applied this Job";

        $data = array('status' => 'success', 'msg' => $message);
        echo json_encode($data);
        exit();
    }



    public function withdraw_job()
    {
        $this->form_validation->set_rules('job_id', 'Job', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'success', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $data = $this->data;
        $job_id = $this->input->post('job_id');
        $job_id = en_func($job_id, 'd');
        $candidate_id = $this->user_id;

        $applyJob = $this->M_jobs->remove_job_application($job_id, $candidate_id);


        //lq();
        if ($applyJob == 0) :
            $data = array('status' => 'error', 'msg' => 'Job could not be withdrawed , Please try again !');
            echo json_encode($data);
            exit();
        endif;

        $message =  "Withdrawed from this Job";

        $data = array('status' => 'success', 'msg' => $message);
        echo json_encode($data);
        exit();
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
        $salary = (int) $this->input->get('salary');
        $experience = (int) $this->input->get('experience');

        // Search Sorting
        $query = $this->input->get('query');

        $start_index = ($page - 1) * $per_page;

        $candidate_id = $this->user_id;

        $applied_jobs = $this->M_jobs->select_jobs_in_applied($candidate_id);

        $total_rows = $this->M_jobs->select_saved_jobs_count($query, $per_page, $start_index, $page, $sortby, $posted_date, $job_location, $salary, $experience);

        $records['data'] = $this->M_jobs->select_all_saved_jobs_users($query, $per_page, $start_index, $page, $sortby, $posted_date, $job_location, $salary, $experience);

        $applied_job_ids = array_column($applied_jobs, 'job_id');

        $data = array();
        $responses = array();
        $i = 0;
        foreach ($records['data']  as $row) {
            $job_id  = en_func($row->job_id, 'e');

            $created_at = $row->created_at;

            $timeFirst  = strtotime($created_at);
            $timeSecond = strtotime(date("Y-m-d h:i:s"));

            $differenceInSeconds = $timeSecond - $timeFirst;
            $applied = in_array($row->job_id,$applied_job_ids) ? true : false;


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
                'wishlist' => true,
                'applied' => $applied,
                'show_wishlist' => true,
                'show_applied' => true


            );
        }

        $data["content_null"] = ($i == 0) ?  true : false;
        $data["show_pagination"] = true;

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
        $salary = (int) $this->input->get('salary');
        $experience = (int) $this->input->get('experience');


        // Search Sorting
        $query = $this->input->get('query');



        $start_index = ($page - 1) * $per_page;
        $total_rows = $this->M_jobs->select_applied_jobs_count($query, $per_page, $start_index, $page, $sortby,$job_status, $posted_date, $job_location, $salary, $experience);

        $records['data'] = $this->M_jobs->select_all_applied_jobs_users($query, $per_page, $start_index, $page, $sortby, $job_status, $posted_date, $job_location, $salary, $experience);


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
                'show_applied' => true

            );
        }


        $data["content_null"] = ($i == 0) ?  true : false;
        $data["show_pagination"] = true;

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


    public function recently_applied_jobs_json()
    {

        // Top Sorting
        $page = ((int) $this->input->get('page') == 0) ? 1 : (int) $this->input->get('page');
        $per_page = ((int) $this->input->get('per_page') == 0) ? 10 : (int) $this->input->get('per_page');
        $sortby = ($this->input->get('sortby') == 'asc') ? 'asc' : 'desc';


        // Search Sorting
        $query = $this->input->get('query');



        $start_index = ($page - 1) * $per_page;
        $total_rows = $this->M_jobs->select_applied_jobs_count($query, $per_page, $start_index, $page, $sortby);


        $records['data'] = $this->M_jobs->select_all_applied_jobs_users($query, $per_page, $start_index, $page, $sortby);


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
                'show_applied' => false

            );
        }


        $data["content_null"] = ($i == 0) ?  true : false;
        $data["show_pagination"] = false;

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
