<?php
defined('BASEPATH') or exit('No direct script access allowed');

class permissions extends MY_Controller
{

  function __construct()

  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('captcha');
    $this->load->library('session');
    $this->load->model('M_permissions');
  }



  public function user_type_list()
  {
    $data = $this->data;
    $this->template->views('admin/permissions/user_type_list', $data);
  }



  public function usertypes_json()
  {


    $records['data'] = $this->M_users->get_userstypes_list();
    $data = array();
    $i = 0;
    $j = 1;
    foreach ($records['data']   as $row) {
      $ut_id = en_func($row->ut_id, 'e');
      $data[] = array(
        ++$i,
        $row->user_type,
        $row->updated_at,
        '<a href="' . base_url() . 'admin/permissions/usertype_permissions/' . $ut_id . '" title="Add Permissions" class="btn btn-secondary"><i class="fa fa-list"></i></a>'

      );
    }
    $this->response(200, $data);
  }


  public function usertype_permissions($ut_id)
  {
    $ut_id = (int) en_func($ut_id, 'd');

    if ($ut_id > 1) :
      $data = $this->data;
      $data["menusList"] = $this->M_permissions->all_modules();
      $data["ut_id"] = en_func($ut_id, 'e');

      $this->template->views('admin/permissions/usertype_permission_list', $data);
    endif;
  }


  public function change_module_permission_usertype()
  {
    $module_id = (int) en_func($this->input->post('module_id', TRUE), 'd');
    $ut_id = (int) en_func($this->input->post('ut_id', TRUE), 'd');
    $status = (int) $this->input->post('status', TRUE);
    $module_name =  $this->input->post('module_name', TRUE);

    if ($module_id > 0 && $ut_id > 0 && $status < 2) :
      $check = $this->M_permissions->check_module_access_exists_usertype($ut_id, $module_id);
      $data_insert = array(
        'module_id' => $module_id,
        'user_type_id' => $ut_id,
        'status' => 1
      );


      if ($check < 1) {
        $result = $this->M_permissions->insert_module_permission_usertype($data_insert);
      } else {
        $result = $this->M_permissions->change_permission_status_usertype($data_insert, $status);
        //Change permission for all users on this usertype too !!!
      }

      if ($result > 0) :
        $response['msg'] = 'Permission updated for ' . $module_name;
        $response['status'] = 'success';
        echo json_encode($response);
        exit();
      else :
        $response['msg'] = 'Something went wrong';
        $response['status'] = 'error';
        echo json_encode($response);
        exit();
      endif;

    endif;
  }




  /*
 * 
 * 
 * 
 * 
 */



  public function index()
  {
    $data = $this->data;
    $this->template->views('admin/permissions/users_list', $data);
  }

  public function permission_json()
  {
    //$user_id = $this->user_id;


    $records['data'] = $this->M_permissions->get_users_list();
    $data = array();
    $i = 0;
    $j = 1;
    foreach ($records['data']   as $row) {
      $user_id = en_func($row->user_id, 'e');
      $data[] = array(
        ++$i,
        $row->user_name,
        $row->user_email,
        $row->user_type,
        '<a href="' . base_url() . 'list_permissions/' . $user_id . '" title="Add Permissions" class="btn btn-secondary"><i class="fa fa-list"></i></a>'

      );
    }
    $this->response(200, $data);
  }



  public function list_permissions($user_id)
  {
    $user_id = (int) en_func($user_id, 'd');
    $ut_id = $this->M_permissions->get_usertype_of_user($user_id);
    if ($user_id > 1 && $ut_id > 1) :
      $data = $this->data;
      $data["menusList"] = $this->M_permissions->all_modules_for_usertypes($ut_id); //lq();
      $data["user_id"] = en_func($user_id, 'e');

      $this->template->views('admin/permissions/permission_list', $data);
    endif;
  }



  public function change_module_permission()
  {
    $module_id = (int) en_func($this->input->post('module_id', TRUE), 'd');
    $user_id = (int) en_func($this->input->post('user_id', TRUE), 'd');
    $status = (int) $this->input->post('status', TRUE);
    $module_name =  $this->input->post('module_name', TRUE);

    if ($module_id > 0 && $user_id > 0 && $status < 2) :
      $check = $this->M_permissions->check_module_access_exists($user_id, $module_id);
      $data_insert = array(
        'module_id' => $module_id,
        'user_id' => $user_id,
        'status' => 1
      );

      if ($check < 1) {
        $result = $this->M_permissions->insert_module_permission($data_insert);
      } else {
        $result = $this->M_permissions->change_permission_status($data_insert, $status);
      }

      if ($result > 0) :
        $response['msg'] = 'Permission updated for ' . $module_name;
        $response['status'] = 'success';
        echo json_encode($response);
        exit();
      else :
        $response['msg'] = 'Something went wrong';
        $response['status'] = 'error';
        echo json_encode($response);
        exit();
      endif;

    endif;
  }
}
