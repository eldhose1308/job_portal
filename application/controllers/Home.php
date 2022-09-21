<?php
defined('BASEPATH') or exit('No direct script access allowed');

class home extends CI_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
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
        $data = array();

        $this->template->home_views('home/jobs', $data);
    }




}
