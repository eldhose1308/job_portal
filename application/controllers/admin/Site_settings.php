<?php
defined('BASEPATH') or exit('No direct script access allowed');

class site_settings extends MY_Controller
{

  function __construct()

  {
    parent::__construct();

    $this->load->helper('url');
    $this->load->library('session');

    $this->load->model('M_users');
    $this->load->model('M_site');
  }

  public function index()
  {
    $data = $this->data;

    $siteDetails = $data["siteDetails"] = $this->M_site->get_site_details();
    $data["operation"] = (empty($siteDetails)) ? "add" : "edit";

    $this->template->views('admin/settings/index', $data);
  }




  public function update_site_settings()
  {
    $site_id = $this->input->post('site_id');
    $this->save_site_settings('update', $site_id);
  }


  public function save_site_settings($func = 'add', $site_id = 0)
  {
    $this->form_validation->set_rules('site_name', 'Site name', 'trim|required');
    $this->form_validation->set_rules('contact_numbers', 'Contact', 'trim');
    $this->form_validation->set_rules('email_address', 'Email', 'trim|required');
    $this->form_validation->set_rules('address', 'Address', 'trim|required');
    $this->form_validation->set_rules('map_location', 'Map location', 'trim|required');

    if ($func == 'update')
      $this->form_validation->set_rules('site_id', 'Site ID', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $data = array('status' => 'error', 'msg' => validation_errors());
      echo json_encode($data);
      exit();
    }


    $user_id = $this->user_id;



    $data_insert = array(
      'site_name' => $this->input->post('site_name'),
      'contact_numbers' => $this->input->post('contact_numbers'),
      'email_address' => $this->input->post('email_address'),
      'address' => $this->input->post('address'),
      'map_location' => $this->input->post('map_location'),
      'font_style_links' => $this->input->post('font_style_links'),
      'font_style_family' => $this->input->post('font_style_family'),
      'created_at' => date("Y-m-d h:i:s"),
      'updated_at' => date("Y-m-d h:i:s"),
      'added_by' => $user_id,
      'status' => 1

    );

    $site_id =  en_func($site_id, 'd');

    if ($func == 'update') :
      unset($data_insert['created_at']);
      $qry_response = $this->M_site->update_about_us($data_insert, $site_id);
      $this->add_activity_log("Updated Sitesettings");
    else :
      $qry_response = $this->M_site->insert_about_us($data_insert);
      $this->add_activity_log("Added Sitesettings");
    endif;

    //lq();

    if ($qry_response > 0) :
      //$this->add_activity_log(6);


      $data = array('status' => 'success', 'msg' => 'Settings successfully added !');
      echo json_encode($data);
      exit();
    endif;

    $data = array('status' => 'error', 'msg' => 'Settings could not be added !');
    echo json_encode($data);
    exit();
  }

  public function about_us_json()
  {


    $records['data'] = $this->M_site->get_about_us_list();
    $data = array();
    $i = 0;
    foreach ($records['data']   as $row) {
      $site_id  = en_func($row->site_id, 'e');
      $data[] = array(
        ++$i,
        $row->image_name,
        $row->category_name,
        $row->updated_at,
        '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/about_us/edit_about_us/' . $site_id  . '" title="Edit about_us" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/about_us/view_about_us/' . $site_id  . '" title="View about_us" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
        <a href="' . base_url() . 'admin/about_us/delete_about_us/' . $site_id  . '" title="Delete about_us"  onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>'

      );
    }
    $this->response(200, $data);
  }


  public function delete_about_us($site_id)
  {
    $site_id = en_func($site_id, 'd');
    $response = $this->M_site->delete_about_us($site_id);
    if ($response > 0)
      $this->session->set_flashdata('success', 'about_us has been deleted successfully!');
    else
      $this->session->set_flashdata('errors', 'about_us could not be deleted!');
    redirect(base_url('admin/about_us'));
  }
}
