<?php
defined('BASEPATH') or exit('No direct script access allowed');

class home extends CI_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');

        $this->load->model('Common_model');
        $this->load->model('M_candidates');
        $this->load->model('M_jobs');

        $this->data["sortBys"][0] = array(
            "sort_id" => "desc",
            "sorting_by" => "Latest"
        );
        $this->data["sortBys"][1] = array(
            "sort_id" => "asc",
            "sorting_by" => "Oldest"
        );


        $this->user_id = (int) en_func($this->session->userdata('user_id'), 'd');


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

        $query = $this->input->get('query');

        $start_index = ($page - 1) * $per_page;
        $total_rows = $this->M_jobs->select_all_jobs_count();


        $records['data'] = $this->M_jobs->select_all_jobs_users($query, $per_page, $start_index, $page, $sortby);


        $data = array();
        $responses = array();
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
                'wishlist' => $row->wishlist ? true : false,
     

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


    public function apply_job($job_id = 0)
    {
        $data = $this->data;
        $job_id = en_func($job_id, 'd');

        $data["jobDetails"] = $this->Common_model->select_by_id('ci_jobs', $job_id, 'job_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["jobDetails"]);

        if (!$this->session->has_userdata('user_login_status')) {
            require_once 'vendor/autoload.php';

            $clientID = $this->config->item('client_id');
            $clientSecret = $this->config->item('client_secret');
            $redirectUri = base_url() . 'users/google_login';


            $client = new Google_Client();
            $client->setClientId($clientID);
            $client->setClientSecret($clientSecret);
            $client->setRedirectUri($redirectUri);

            $client->addScope("email");
            $client->addScope("profile");


            $data["googleAuth"] = $client->createAuthUrl();

            $records["content"] = $this->load->view('users/auth/login_offcanvas', $data, true);
            $records["heading"] = "Login to continue";
            $records["sub_heading"] = "To apply to a job,you must log in first";
        } else {

            $candidate_id = $this->user_id;

            $data["candidateDetails"] = $this->M_candidates->select_candidate_by_id($candidate_id);


            $records["content"] = $this->load->view('users/jobs/jobs_apply', $data, true);
            $records["heading"] = "Apply for jobs";
            $records["sub_heading"] = "Please review your details before applying for the job";
        }

        $this->response(200, $records);
    }



    public function add_to_wishlist($job_id = 0)
    {
        $data = $this->data;
        $job_id = en_func($job_id, 'd');
        
        $data["jobDetails"] = $this->Common_model->select_by_id('ci_jobs', $job_id, 'job_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["jobDetails"]);

        $wishlist_status = (int) $this->input->post('wishlist_status', TRUE);


        $candidate_id = $this->user_id;
        $data_insert = array(
            'job_id' => $job_id,
            'candidate_id' => $candidate_id,
            'added_by' => $candidate_id,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1
        );

        $addToWishlist = ($wishlist_status) ? $this->M_jobs->add_job_to_wishlist($data_insert) : $this->M_jobs->remove_job_from_wishlist($job_id, $candidate_id);

        //lq();
        if ($addToWishlist == 0) :
            $data = array('status' => 'error', 'msg' => 'Job could not be added to wishlist , Please try again !');
            echo json_encode($data);
            exit();
        endif;

        $message = ($wishlist_status) ? "Added to Wishlist" : "Removed from Wishlist";

        $data = array('status' => 'success', 'msg' => $message);
        echo json_encode($data);
        exit();
    }



    function check_exists($data_arr)
    {
        if (empty($data_arr))
            redirect_to_404();
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
