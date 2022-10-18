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

        $this->template->users_views('home/home', $data);
    }



    public function about_us()
    {
        $data = array();

        $this->template->users_views('users/about_us', $data);
    }



    public function contact_us()
    {
        $data = array();

        $this->template->users_views('users/contact_us', $data);
    }




    public function jobs()
    {
        $data = $this->data;

        $data["countries"] = $this->Common_model->select_all("ci_countries");

        $this->template->users_views('users/jobs', $data);
    }


    public function job_details($job_id)
    {
        $data = $this->data;

        $urlElements = explode('-', $job_id);
        $job_id = $urlElements[count($urlElements) - 1];


        $data["job_id"] = $job_id;

        $job_id = en_func($job_id, 'd');
        $data["jobsDetails"] = $this->M_jobs->selelct_jobdetails_by_id($job_id);
        $this->check_exists($data["jobsDetails"]);

        $candidate_id = $this->user_id;

        $applied_jobs = $this->M_jobs->select_jobs_in_applied($candidate_id);
        $wishlists_jobs = $this->M_jobs->select_jobs_in_wishlist($candidate_id);

        $applied_job_ids = array_column($applied_jobs, 'job_id');
        $wishlisted_job_ids = array_column($wishlists_jobs, 'job_id');

        $data["wishlist"] = in_array($data["jobsDetails"]->job_id, $wishlisted_job_ids) ? true : false;
        $data["applied"] = in_array($data["jobsDetails"]->job_id, $applied_job_ids) ? true : false;

        $this->template->users_views('users/job_details', $data);
    }


    public function jobs_json()
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

        $wishlists_jobs = $this->M_jobs->select_jobs_in_wishlist($candidate_id);
        $applied_jobs = $this->M_jobs->select_jobs_in_applied($candidate_id);

        $total_rows = $this->M_jobs->select_all_jobs_count($query, $per_page, $start_index, $page, $sortby, $posted_date, $job_location, $salary, $experience);

        $records['data'] = $this->M_jobs->select_all_jobs_users($query, $per_page, $start_index, $page, $sortby, $posted_date, $job_location, $salary, $experience);


        $wishlisted_job_ids = array_column($wishlists_jobs, 'job_id');
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

            $wishlist = in_array($row->job_id, $wishlisted_job_ids) ? true : false;
            $applied = in_array($row->job_id, $applied_job_ids) ? true : false;
            /*
                'wishlist' => ($row->wishlist_candidate == $candidate_id) ? ($row->wishlist ? true : false) : false,
                'applied' => ($row->applied_candidate == $candidate_id) ? ($row->applied ? true : false) : false,
            */


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
                'wishlist' => $wishlist,
                'applied' => $applied,
                'show_wishlist' => true,
                'show_applied' => true


            );
        }

        // dd($responses);
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


    public function home_jobs_json()
    {
        // Top Sorting
        $page = 1;
        $per_page = 6;
        $sortby = "desc";

        // Side Sorting
        $job_location = 0;
        $posted_date = 0;
        $salary = 0;
        $experience = 0;

        // Search Sorting
        $query = "";

        $start_index = ($page - 1) * $per_page;

        $total_rows = 6;

        $records['data'] = $this->M_jobs->select_all_jobs_users($query, $per_page, $start_index, $page, $sortby, $posted_date, $job_location, $salary, $experience);

        // lq();
        $candidate_id = $this->user_id;

        $data = array();
        $responses = array();
        $i = 0;
        foreach ($records['data']  as $row) {
            $job_id  = en_func($row->job_id, 'e');



            $created_at = $row->created_at;

            $timeFirst  = strtotime($created_at);
            $timeSecond = strtotime(date("Y-m-d h:i:s"));

            $differenceInSeconds = $timeSecond - $timeFirst;


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
                'show_wishlist' => false,
                'show_applied' => false


            );
        }

        // dd($responses);
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


    public function apply_job_page($job_id = 0)
    {
        $data = $this->data;
        $data["job_id"] = $job_id;
        $job_id = en_func($job_id, 'd');

        $data["jobInfo"] = $this->Common_model->select_by_id('ci_jobs', $job_id, 'job_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["jobInfo"]);

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
            $jobApplied = $this->M_jobs->select_applied_job($job_id, $candidate_id);


            $data["jobApplied"] = $jobApplied ? true : false;

            $data["jobDetails"] = $jobApplied;
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

        if (!$this->session->has_userdata('user_login_status')) {

            $data = array('status' => 'success', 'msg' => "Unauthorised");
            echo json_encode($data);
            exit();
        }

        $data["jobDetails"] = $this->Common_model->select_by_id('ci_jobs', $job_id, 'job_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["jobDetails"]);
        $candidate_id = $this->user_id;



        $wishlist_status = (int) $this->input->post('wishlist_status', TRUE);

        if ($wishlist_status)
            if ($this->M_jobs->check_job_in_wishlist($job_id, $candidate_id)) {

                $data = array('status' => 'success', 'msg' => "Job already wishlisted");
                echo json_encode($data);
                exit();
            }



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



    /***** Save contact message ******/

    public function save_contact_us()
    {
        $this->load->library('user_agent');


        $this->form_validation->set_rules('full_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone_number', 'Phone', 'trim|numeric');
        $this->form_validation->set_rules('feedback', 'Feedback', 'trim|required');
        $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }

        $captcha_response = trim($this->input->post('g-recaptcha-response'));

        if ($captcha_response != '') {
            $keySecret = $this->config->item('google_secret');
            $userIp = $this->input->ip_address();

            $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $keySecret . "&response=" . $captcha_response;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $status = json_decode($output, true);

            //$status['success'] = true;

            if (!$status['success']) {
                $data = array('status' => 'error', 'msg' => 'Something wrong with captcha,Try again later !!');
                echo json_encode($data);
                exit();
            }
        }

        $agent = ($this->agent->is_browser()) ?
            $this->agent->browser() . ' ' . $this->agent->version() : (($this->agent->is_mobile()) ? $this->agent->mobile() : 'Nulls');



        $data_insert = array(
            'full_name' => $this->input->post('full_name'),
            'email_address' => $this->input->post('email_address'),
            'phone_number' => $this->input->post('phone_number'),
            'feedback' => $this->input->post('feedback'),
            'visitor_ip' => $this->input->ip_address(),
            'visited_platform' => $this->agent->platform(),
            'visited_agent' => $agent,
            'created_at' => date("Y-m-d h:i:s"),
            'status' => 1

        );

        $qry_response = $this->Common_model->insert_table($data_insert, 'ci_contact_messages');

        //Send email about the details to admin

        $toEmail = $this->config->item('email_address');
        $fromEmail = $this->input->post('email_address');

        $message = $this->input->post('message');




        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Message submitted successfully !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Message could not be submitted !');
        echo json_encode($data);
        exit();
    }
    /***** Save contact message ******/





    /***** Save Subscription ******/

    public function subscribe_newsletter()
    {
        $this->load->library('user_agent');
        $this->load->model('M_home');


        $this->form_validation->set_rules('subscription_mail', 'Email', 'trim|required|valid_email');


        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $subscriptionExists = $this->M_home->check_subscription_exists($this->input->post('subscription_mail'));
        if ($subscriptionExists) :
            $data = array('status' => 'error', 'msg' => "You have already subscribed to the newsletter");
            echo json_encode($data);
            exit();
        endif;


        $agent = ($this->agent->is_browser()) ?
            $this->agent->browser() . ' ' . $this->agent->version() : (($this->agent->is_mobile()) ? $this->agent->mobile() : 'Nulls');



        $data_insert = array(
            'subscription_mail' => $this->input->post('subscription_mail'),
            'visitor_ip' => $this->input->ip_address(),
            'visited_platform' => $this->agent->platform(),
            'visited_agent' => $agent,
            'created_at' => date("Y-m-d h:i:s"),
            'status' => 1

        );

        $qry_response = $this->Common_model->insert_table($data_insert, 'ci_subscriptions');

        //Send email about the details to admin

        $toEmail = $this->config->item('email_address');
        $fromEmail = $this->input->post('email_address');

        $message = $this->input->post('subscription_mail');




        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Subscribed to newsletter successfully !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Could not subscribe to the newsletter !');
        echo json_encode($data);
        exit();
    }
    /***** Save Subscription ******/





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
