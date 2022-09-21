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




}
