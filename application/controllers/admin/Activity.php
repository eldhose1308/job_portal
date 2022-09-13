<?php
defined('BASEPATH') or exit('No direct script access allowed');

class activity extends MY_Controller
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
    $data['usersList'] = $this->M_users->get_users_list(); 
    $data['user_type'] = ($this->session->userdata('user_type_display'));
    $data['user_id'] = en_func($this->session->userdata('user_id'),'d');
  

    $this->template->views('admin/activity/index', $data);
  }

  public function activity_json()
  {

    $user_id =  en_func($this->input->get('user_id'),'d');

    $records['data'] = $this->M_activities->get_activity_list($user_id);
    $data = array(); 
    $i = 0;
    foreach ($records['data']   as $row) {
      $data[] = array(
        ++$i,
        $row->full_name,
        $row->activity,
        date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),       

      );
    }
    $this->response(200, $data);
  }




}
