<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modules extends MY_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');
        $this->load->model('M_permissions');
    }

    public function index()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/modules/index', $data);
    }


    public function add_modules()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/modules/add_modules', $data);
    }

    public function edit_modules($module_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["module_id"] = $module_id;
        $data["status"] = $this->Common_model->select_status();

        $module_id = en_func($module_id, 'd');

        $data["modulesDetails"] = $this->M_permissions->select_modules_by_id($module_id);
        $this->check_exists($data["modulesDetails"]);


        $this->template->views('admin/modules/add_modules', $data);
    }

    public function view_modules($module_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["status"] = $this->Common_model->select_status();

        $module_id = en_func($module_id, 'd');

        $data["modulesDetails"] = $this->M_permissions->select_modules_by_id($module_id);
        $this->check_exists($data["modulesDetails"]);

        $this->template->views('admin/modules/add_modules', $data);
    }

    public function update_modules()
    {
        $module_id = $this->input->post('module_id');
        $this->save_modules('update', $module_id);
    }


    public function save_modules($func = 'add', $module_id = 0)
    {
        $this->form_validation->set_rules('module_name', 'Module name', 'trim|required');
        $this->form_validation->set_rules('module_url', 'Module url', 'trim|required');
        $this->form_validation->set_rules('module_label', 'Module label', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('module_id', 'Module ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;

       
        $data_insert = array(
            'module_name' => $this->input->post('module_name'),
            'module_url' => $this->input->post('module_url'),
            'module_label' => $this->input->post('module_label'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'created_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );

        $module_id =  en_func($module_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->M_permissions->update_module($data_insert, $module_id);
        else :
            $qry_response = $this->M_permissions->insert_module($data_insert);
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Module successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Module could not be added !');
        echo json_encode($data);
        exit();
    }
    

    public function modules_json()
    {
        $user_id = $this->user_id;
        $status = (int) en_func($this->input->get('status'), 'd');


        $records['data'] = $this->M_permissions->module_lists($status);
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $module_id = en_func($row->module_id, 'e');
            $data[] = array(
                ++$i,
                $row->module_name,
                $row->main_module_name,
                $row->updated_at,
                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/modules/edit_modules/' . $module_id  . '" title="Edit Usertype" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/modules/view_modules/' . $module_id  . '" title="View Usertype" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>'

            );
        }
        $this->response(200, $data);
    }

    public function module_grouping()
    {
        $data = $this->data;
        $this->template->views('admin/modules/module_groups_list', $data);
    }


    public function add_module_group()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["all_modules"] = $this->M_permissions->all_modules();
        $grouped_modules = (array) $this->M_permissions->all_grouped_modules();


        $modules_list = array_column($grouped_modules, 'modules_list');
        $modules_list_str = implode(",", $modules_list);
        $module_list_arr = explode(",", $modules_list_str);
        $data["modules_grouped_list"] = array_unique($module_list_arr);



        $this->template->views('admin/modules/add_module_group', $data);
    }

    public function edit_module_group($mg_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["mg_id"] = $mg_id;

        $mg_id = (int) en_func($mg_id, 'd');
        $data["moduleDetails"] = $this->M_permissions->grouped_modules_by_id($mg_id);
        $data["allocated_modules"] = $this->M_permissions->all_modules_allocated($mg_id);
        //lq();
        $data["modules_unallocated"] = $this->M_permissions->all_modules_unallocated();
        //lq();


        $this->check_exists($data["moduleDetails"]);


        $this->template->views('admin/modules/add_module_group', $data);
    }


    public function remove_submodule_allocated($module_id = 0, $mg_id = 0)
    {
        $mg_id_encr = $mg_id;
        $module_id = en_func($module_id, 'd');
        $mg_id = (int) en_func($mg_id, 'd');
        if ($module_id > 0 && $mg_id > 0) :

            $moduleremove_response = $this->M_permissions->remove_modules_from_group($module_id);
            if ($moduleremove_response > 0)
                $this->session->set_flashdata('success_msg', 'Successfully Removed');
            else
                $this->session->set_flashdata('error_msg', 'Could not Remove');

            redirect('admin/modules/edit_module_group/' . $mg_id_encr);

        endif;
    }


    public function add_modules_to_group()
    {
        $this->form_validation->set_rules('main_module_name', 'Main module name', 'trim|required');
        $this->form_validation->set_rules('module_group_label', 'Main module label', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');
        $this->form_validation->set_rules('mg_id', 'Main Module', 'trim|required');
        // $this->form_validation->set_rules('modules_list[]', 'Modules List', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }



        $main_module_id = en_func($this->input->post('mg_id'), 'd');

        $data_update = array(
            'main_module_name' => $this->input->post('main_module_name'),
            'module_group_label' => $this->input->post('module_group_label'),
            'sort_order' => $this->input->post('sort_order'),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1
        );

        $modulegroup_response = $this->M_permissions->update_module_group($data_update, $main_module_id);
        if ($modulegroup_response == 0) :
            $response['msg'] = 'Module group could not be updated';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;

        if (!$this->input->post('modules_list')) :
            if ($modulegroup_response > 0) :
                $response['msg'] = 'Module group updated';
                $response['status'] = 'success';
                echo json_encode($response);
                exit();
            endif;
        endif;

        if (sizeof($this->input->post('modules_list')) < 1) {
            $data = array('status' => 'error', 'msg' => 'Please add any submodules !');
            echo json_encode($data);
            exit();
        }

        for ($i = 0; $i < sizeof($this->input->post('modules_list')); $i++) {
            $module_id = en_func($this->input->post('modules_list')[$i], 'd');
            $moduleadd_response = $this->M_permissions->add_modules_to_groups($module_id, $main_module_id);
        }

        if ($moduleadd_response > 0) :
            $response['msg'] = 'Sub Modules group added';
            $response['status'] = 'success';
            echo json_encode($response);
            exit();
        else :
            $response['msg'] = 'Sub Modules group could not be added';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;
    }

    public function save_module_group()
    {
        $user_id = $this->user_id;

        $this->form_validation->set_rules('main_module_name', 'Main module name', 'trim|required');
        $this->form_validation->set_rules('module_group_label', 'Main module label', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }





        $data_insert = array(
            'main_module_name' => $this->input->post('main_module_name'),
            'module_group_label' => $this->input->post('module_group_label'),
            'sort_order' => $this->input->post('sort_order'),
            'created_by' => $user_id,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'status' => 1
        );

        $modulegroup_response = $this->M_permissions->add_module_group($data_insert);
        if ($modulegroup_response > 0) :
            $response['msg'] = 'Module group added';
            $response['status'] = 'success';
            echo json_encode($response);
            exit();
        else :
            $response['msg'] = 'Module group could not be added';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;
    }


    public function module_group_json()
    {
       
        $user_id = $this->user_id;

        if ($user_id > 0) :
            $module_group = $this->M_permissions->main_modules_list(); 
            $i = 0;
            foreach ($module_group as $row) :
                $mg_id  = en_func($row->mg_id, 'e');




                $data[] = array(

                    ++$i,
                    $row->main_module_name,
                    $row->module_group_label,
                    $row->updated_at,
                    '<div class="btn-group btn-group-sm">
                <a href="' . base_url() . 'admin/modules/edit_module_group/' . $mg_id . '" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                <a href="' . base_url() . 'admin/modules/delete_module_group"class="btn btn-danger"><i class="fas fa-trash"></i></a>
              </div>'
                );
            endforeach;
            //$records['length'] = sizeof($login_history);
            $this->response(200, $data);

        endif;
    }
}
