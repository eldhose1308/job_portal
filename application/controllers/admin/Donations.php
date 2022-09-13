<?php
defined('BASEPATH') or exit('No direct script access allowed');

class donations extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');
        $this->load->model('M_donations');
    }

    public function index()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/donations/index', $data);
    }





    /***
     * 
     * Main types
     * 
     * **/


    public function main_types()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/donations/index_main_types', $data);
    }

    public function add_main_types()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/donations/add_main_types', $data);
    }

    public function edit_main_types($type_id  = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["type_id"] = $type_id;

        $type_id  = en_func($type_id, 'd');

        $data["main_typesDetails"] = $this->Common_model->select_by_id('ci_donation_types', $type_id, 'type_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["main_typesDetails"]);


        $this->template->views('admin/donations/add_main_types', $data);
    }

    public function view_main_types($type_id  = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["type_id"] = $type_id;

        $type_id  = en_func($type_id, 'd');

        $data["main_typesDetails"] = $this->Common_model->select_by_id('ci_donation_types', $type_id, 'type_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["main_typesDetails"]);

        $this->template->views('admin/donations/add_main_types', $data);
    }

    public function update_main_types()
    {
        $this->check_encrypted($this->input->post('type_id'), 'Page');

        $type_id  = $this->input->post('type_id');
        $this->save_main_types('update', $type_id);
    }


    public function save_main_types($func = 'add', $type_id  = 0)
    {
        $this->form_validation->set_rules('type_name', 'Main type name', 'trim|required');
        $this->form_validation->set_rules('visible', 'Visible', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('type_id', 'Designation ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;


        $data_insert = array(
            'type_name' => $this->input->post('type_name'),
            'visible' => $this->input->post('visible'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 1

        );

        $type_id  =  en_func($type_id, 'd');

        if ($func == 'update') :
            unset($data_insert['type_name']);
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $type_id, 'ci_donation_types', 'type_id');
            $this->add_activity_log("Updated donation maintype");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_donation_types');
            $this->add_activity_log("Added donation maintype");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Maintype successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Maintype could not be added !');
        echo json_encode($data);
        exit();
    }


    public function main_types_json()
    {
        $status = (int) en_func($this->input->get('status'), 'd');


        $records['data'] = $this->Common_model->select_all('ci_donation_types', $status);
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $type_id  = en_func($row->type_id, 'e');

            $status_bg_visible = ($row->visible == 1) ? 'success' : 'danger';
            $status_badge_visible = ($row->visible == 1) ? 'Visible' : 'Hidden';


            $status_bg_sub = ($row->has_subtype == 1) ? 'success' : 'danger';
            $status_badge_sub = ($row->has_subtype == 1) ? 'Subtype can be added' : 'Subtype cannot be added';


            $data[] = array(
                ++$i,
                $row->type_name,
                '<span class="badge alert-' . $status_bg_visible . '">' . $status_badge_visible . '</span>',
                '<span class="badge alert-' . $status_bg_sub . '">' . $status_badge_sub . '</span>',
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
                <a href="' . base_url() . 'admin/donations/edit_main_types/' . $type_id   . '" title="Edit Maintypes" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                <a href="' . base_url() . 'admin/donations/view_main_types/' . $type_id   . '" title="View Maintypes" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>'

            );
        }
        $this->response(200, $data);
    }



    /***
     * 
     * Sub types
     * 
     * **/


    public function sub_types()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();
        $data["mainTypes"] = $this->M_donations->select_has_subtype_maintypes();

        $this->template->views('admin/donations/index_sub_types', $data);
    }

    public function add_sub_types()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data["mainTypes"] = $this->M_donations->select_has_subtype_maintypes();

        $this->template->views('admin/donations/add_sub_types', $data);
    }

    public function edit_sub_types($subtype_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["subtype_id"] = $subtype_id;

        $subtype_id = en_func($subtype_id, 'd');

        $data["sub_typesDetails"] = $this->Common_model->select_by_id('ci_donation_subtypes', $subtype_id, 'subtype_id');
        $data["status"] = $this->Common_model->select_status();
        $data["mainTypes"] = $this->M_donations->select_has_subtype_maintypes();

        $this->check_exists($data["sub_typesDetails"]);


        $this->template->views('admin/donations/add_sub_types', $data);
    }

    public function view_sub_types($subtype_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';

        $subtype_id = en_func($subtype_id, 'd');

        $data["sub_typesDetails"] = $this->Common_model->select_by_id('ci_donation_subtypes', $subtype_id, 'subtype_id');
        $data["status"] = $this->Common_model->select_status();
        $data["mainTypes"] = $this->M_donations->select_has_subtype_maintypes();

        $this->check_exists($data["sub_typesDetails"]);

        $this->template->views('admin/donations/add_sub_types', $data);
    }

    public function update_sub_types()
    {
        $this->check_encrypted($this->input->post('subtype_id'), 'Page');

        $subtype_id = $this->input->post('subtype_id');
        $this->save_sub_types('update', $subtype_id);
    }


    public function save_sub_types($func = 'add', $subtype_id = 0)
    {
        $this->form_validation->set_rules('subtype_name', 'Subtype name', 'trim|required');
        $this->form_validation->set_rules('subtype_rate', 'Subtype name', 'trim|required|numeric');
        $this->form_validation->set_rules('visible', 'Visible', 'trim|required');
        $this->form_validation->set_rules('type_id', 'Main type', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('subtype_id', 'Subtype ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }

        $this->check_encrypted($this->input->post('type_id'), 'Main type');


        $user_id = $this->user_id;


        $data_insert = array(
            'subtype_name' => $this->input->post('subtype_name'),
            'subtype_rate' => $this->input->post('subtype_rate'),
            'type_id' => en_func($this->input->post('type_id'), 'd'),
            'visible' => $this->input->post('visible'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 1

        );

        $subtype_id =  en_func($subtype_id, 'd');

        if ($func == 'update') :
            unset($data_insert['subtype_name']);
            unset($data_insert['subtype_rate']);
            unset($data_insert['type_id']);
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $subtype_id, 'ci_donation_subtypes', 'subtype_id');
            $this->add_activity_log("Updated donation subtype");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_donation_subtypes');
            $this->add_activity_log("Added donation subtype");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Sub type successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Sub type could not be added !');
        echo json_encode($data);
        exit();
    }


    public function sub_types_json()
    {
        $status = (int) en_func($this->input->get('status'), 'd');
        $type_id = (int) en_func($this->input->get('type_id'), 'd');


        $records['data'] = $this->M_donations->select_all_subtypes($type_id, $status);
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $subtype_id   = en_func($row->subtype_id, 'e');

            $status_bg = ($row->visible == 1) ? 'success' : 'danger';
            $status_badge = ($row->visible == 1) ? 'Visible' : 'Hidden';


            $data[] = array(
                ++$i,
                $row->type_name,
                $row->subtype_name,
                $row->subtype_rate,
                '<span class="badge alert-' . $status_bg . '">' . $status_badge . '</span>',
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),                '<div class="btn-group btn-group-sm">
                <a href="' . base_url() . 'admin/donations/edit_sub_types/' . $subtype_id    . '" title="Edit Maintypes" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                <a href="' . base_url() . 'admin/donations/view_sub_types/' . $subtype_id    . '" title="View Maintypes" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>'

            );
        }
        $this->response(200, $data);
    }
}
