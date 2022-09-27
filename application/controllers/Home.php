<?php
defined('BASEPATH') or exit('No direct script access allowed');

class home extends CI_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');

        $this->load->model('Common_model');
        $this->load->model('M_jobs');

        $this->data["sortBys"][0] = array(
            "sort_id" => "desc",
            "sorting_by" => "Latest"
        );
        $this->data["sortBys"][1] = array(
            "sort_id" => "asc",
            "sorting_by" => "Oldest"
        );

        date_default_timezone_set("Asia/Kolkata");

    }

    public function index()
    {
        $data = array();

        $this->template->home_views('home/home', $data);
    }



    public function about_us()
    {
        $data = array();

        $this->template->home_views('home/about_us', $data);
    }



    public function contact_us()
    {
        $data = array();

        $this->template->home_views('home/contact_us', $data);
    }





    public function jobs()
    {
        $data = $this->data;

        $data["countries"] = $this->Common_model->select_all("ci_countries");

        $this->template->home_views('home/jobs', $data);
    }

    public function jobs_json()
    {

        $page = ((int) $this->input->get('page') == 0) ? 1 : (int) $this->input->get('page');
        $per_page = ((int) $this->input->get('per_page') == 0) ? 10 : (int) $this->input->get('per_page');
        $sortby = ($this->input->get('sortby') == 'asc') ? 'asc' : 'desc';

        $start_index = ($page - 1) * $per_page;
        $total_rows = $this->M_jobs->select_all_jobs_count();


        $records['data'] = $this->M_jobs->select_all_jobs($per_page, $start_index, $page, $sortby);



        $data = array();
        $i = 0;
        foreach ($records['data']  as $row) {
            $job_id  = en_func($row->job_id, 'e');

            $updated_at = $row->updated_at;

            $timeFirst  = strtotime($updated_at);
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



    function response($status, $data)
    {
        header("HTTP/1.1 " . $status);

        $response['status'] = $status;
        $response['data'] = $data;

        $json_response = json_encode($response);
        echo $json_response;
        exit();
    }
}
