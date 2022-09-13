<?php
defined('BASEPATH') or exit('No direct script access allowed');

class administration extends MY_Controller
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
        $data["status"] = $this->Common_model->select_status();
        $data["designations"] = $this->Common_model->select_all('ci_designations');
        $data["years"] = $this->Common_model->select_all('ci_years');

        $this->template->views('admin/administrations/index', $data);
    }

    public function add_administration()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data["designations"] = $this->Common_model->select_all('ci_designations');
        $data["years"] = $this->Common_model->select_all('ci_years');

        $this->template->views('admin/administrations/add_administration', $data);
    }



    public function edit_administration($administration_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["administration_id"] = $administration_id;

        $administration_id  = en_func($administration_id, 'd');

        $data["administrationDetails"] = $this->Common_model->select_by_id('ci_administration', $administration_id, 'administration_id ');
        $data["status"] = $this->Common_model->select_status();
        $data["designations"] = $this->Common_model->select_all('ci_designations');
        $data["years"] = $this->Common_model->select_all('ci_years');

        $this->check_exists($data["administrationDetails"]);

        $this->template->views('admin/administrations/add_administration', $data);
    }

    public function view_administration($administration_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["administration_id"] = $administration_id;

        $administration_id  = en_func($administration_id, 'd');

        $data["administrationDetails"] = $this->Common_model->select_by_id('ci_administration', $administration_id, 'administration_id ');
        $data["status"] = $this->Common_model->select_status();
        $data["designations"] = $this->Common_model->select_all('ci_designations');
        $data["years"] = $this->Common_model->select_all('ci_years');

        $this->check_exists($data["administrationDetails"]);

        $this->template->views('admin/administrations/add_administration', $data);
    }


    public function update_administration()
    {
        $administration_id  = $this->input->post('administration_id');
        $this->save_administration('update', $administration_id);
    }


    public function save_administration($func = 'add', $administration_id  = 0)
    {
        $this->form_validation->set_rules('administration_name', 'Administration name', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('year', 'Year', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('administration_id', 'administration ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }

        $this->check_encrypted($this->input->post('designation'), 'Designation');
        $this->check_encrypted($this->input->post('year'), 'Year');


        $user_id = $this->user_id;


        if ($func == 'add') :
            $data = $_POST['photo'];
            $image_path = $this->upload_base64Images($data, 'uploads/administration/');
        endif;

        if ($func == 'update') :
            $image_path = $this->input->post('image_path');
            if (strlen($this->input->post('image_path')) < 1) :
                $data = $_POST['photo'];
                $image_path = $this->upload_base64Images($data, 'uploads/administration/');
            endif;
        endif;

        $data_insert = array(
            'administration_name' => $this->input->post('administration_name'),
            'image_path' => $image_path,
            'designation' => en_func($this->input->post('designation'), 'd'),
            'year' => en_func($this->input->post('year'), 'd'),
            'sort_order' => $this->input->post('sort_order'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $administration_id  =  en_func($administration_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $administration_id, 'ci_administration', 'administration_id ');
            $this->add_activity_log("Updated administration");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_administration');
            $this->add_activity_log("Added administration");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Administration successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Administration could not be added !');
        echo json_encode($data);
        exit();
    }

    public function administration_json()
    {
        $this->load->model('Admin_model');

        $status = (int) en_func($this->input->get('status'), 'd');
        $designation = (int) en_func($this->input->get('designation'), 'd');
        $year = (int) en_func($this->input->get('year'), 'd');

        $records['data'] = $this->Admin_model->select_all_administrations($status, $designation, $year);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $administration_id   = en_func($row->administration_id, 'e');
            $data[] = array(
                ++$i,
                '<img src="' . ADMINISTRATION_IMAGES . $row->image_path . '" alt="' . $row->administration_name . '" class="datacard_img">',
                $row->administration_name,
                '<span class="badge rounded-pill alert-warning">' . $row->designation_name . '</span>',
                '<span class="badge rounded-pill alert-primary">' . $row->year_title . '</span>',
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="action-buttons">
                <a href="' . base_url() . 'admin/administration/edit_administration/' . $administration_id  . '" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                <a href="' . base_url() . 'admin/administration/view_administration/' . $administration_id  . '" class="btn btn-sm font-sm rounded btn-info"> <i class="fa fa-eye"></i> View </a>
                <a href="' . base_url() . 'admin/administration/delete_administration/' . $administration_id  . '"  onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm font-sm btn-danger rounded"> <i class="material-icons md-delete_forever"></i> Delete </a>
            </div>'

            );
        }
        $this->response(200, $data);
    }



    public function delete_administration($administration_id)
    {
        $administration_id = en_func($administration_id, 'd');
        $response = $this->Common_model->delete_table($administration_id, 'ci_administration', 'administration_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Administration has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Administration could not be deleted!');
        redirect(base_url('admin/administration'));
    }




    /***
     * 
     * Designations
     * 
     * **/


    public function designations()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/administrations/index_designations', $data);
    }

    public function add_designations()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/administrations/add_designations', $data);
    }

    public function edit_designations($designation_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["designation_id"] = $designation_id;

        $designation_id = en_func($designation_id, 'd');

        $data["designationsDetails"] = $this->Common_model->select_by_id('ci_designations', $designation_id, 'designation_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["designationsDetails"]);


        $this->template->views('admin/administrations/add_designations', $data);
    }

    public function view_designations($designation_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';

        $designation_id = en_func($designation_id, 'd');

        $data["designationsDetails"] = $this->Common_model->select_by_id('ci_designations', $designation_id, 'designation_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["designationsDetails"]);

        $this->template->views('admin/administrations/add_designations', $data);
    }

    public function update_designations()
    {
        $this->check_encrypted($this->input->post('designation_id'), 'Page');

        $designation_id = $this->input->post('designation_id');
        $this->save_designations('update', $designation_id);
    }


    public function save_designations($func = 'add', $designation_id = 0)
    {
        $this->form_validation->set_rules('designation_name', 'Designation name', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('designation_id', 'Designation ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;


        $data_insert = array(
            'designation_name' => $this->input->post('designation_name'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );

        $designation_id =  en_func($designation_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $designation_id, 'ci_designations', 'designation_id');
            $this->add_activity_log("Updated administration designation");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_designations');
            $this->add_activity_log("Added administration designation");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Designation successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Designation could not be added !');
        echo json_encode($data);
        exit();
    }


    public function designations_json()
    {
        $status = (int) en_func($this->input->get('status'), 'd');


        $records['data'] = $this->Common_model->select_all('ci_designations', $status);
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $designation_id = en_func($row->designation_id, 'e');
            $data[] = array(
                ++$i,
                $row->designation_name,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/administration/edit_designations/' . $designation_id  . '" title="Edit Designation" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/administration/view_designations/' . $designation_id  . '" title="View Designation" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
        <a href="' . base_url() . 'admin/administration/delete_designations/' . $designation_id  . '" title="Delete Designation" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>'


            );
        }
        $this->response(200, $data);
    }


    
    public function delete_designations($designation_id)
    {
        $designation_id = en_func($designation_id, 'd');
        $response = $this->Common_model->delete_table($designation_id, 'ci_designations', 'designation_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Administration designation has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Administration designation could not be deleted!');
        redirect(base_url('admin/administration/designations'));
    }

    /***
     * 
     * Years
     * 
     * **/


    public function years()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/administrations/index_years', $data);
    }

    public function add_years()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/administrations/add_years', $data);
    }

    public function edit_years($year_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["year_id"] = $year_id;

        $year_id = en_func($year_id, 'd');

        $data["yearsDetails"] = $this->Common_model->select_by_id('ci_years', $year_id, 'year_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["yearsDetails"]);


        $this->template->views('admin/administrations/add_years', $data);
    }

    public function view_years($year_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';

        $year_id = en_func($year_id, 'd');

        $data["yearsDetails"] = $this->Common_model->select_by_id('ci_years', $year_id, 'year_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["yearsDetails"]);

        $this->template->views('admin/administrations/add_years', $data);
    }

    public function update_years()
    {
        $this->check_encrypted($this->input->post('year_id'), 'Page');

        $year_id = $this->input->post('year_id');
        $this->save_years('update', $year_id);
    }


    public function save_years($func = 'add', $year_id = 0)
    {
        $this->form_validation->set_rules('year_title', 'Year title', 'trim|required');
        $this->form_validation->set_rules('from_year', 'From year', 'trim|required|numeric');
        $this->form_validation->set_rules('to_year', 'To year', 'trim|required|numeric');
        $this->form_validation->set_rules('active', 'Active or not', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('year_id', 'Year ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;


        $data_insert = array(
            'year_title' => $this->input->post('year_title'),
            'from_year' => $this->input->post('from_year'),
            'to_year' => $this->input->post('to_year'),
            'active' => $this->input->post('active'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );

        $year_id =  en_func($year_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $year_id, 'ci_years', 'year_id');
            $this->add_activity_log("Updated administration year");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_years');
            $this->add_activity_log("Added administration year");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Administration Year successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Administration Year could not be added !');
        echo json_encode($data);
        exit();
    }


    public function years_json()
    {
        $status = (int) en_func($this->input->get('status'), 'd');


        $records['data'] = $this->Common_model->select_all('ci_years', $status);
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $year_id = en_func($row->year_id, 'e');
            $active_badge = '<span class="badge alert-warning" >Inactive</span>';
            if ($row->active == 1)
                $active_badge = '<span class="badge alert-success" >Active</span>';


            $data[] = array(
                ++$i,
                $row->year_title,
                $row->from_year . ' - ' . $row->to_year,
                $active_badge,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/administration/edit_years/' . $year_id  . '" title="Edit year" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/administration/view_years/' . $year_id  . '" title="View year" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
        <a href="' . base_url() . 'admin/administration/delete_years/' . $year_id  . '" title="Delete year" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>'


            );
        }
        $this->response(200, $data);
    }

    
    
    public function delete_years($year_id)
    {
        $year_id = en_func($year_id, 'd');
        $response = $this->Common_model->delete_table($year_id, 'ci_years', 'year_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Administration year has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Administration year could not be deleted!');
        redirect(base_url('admin/administration/years'));
    }
}
