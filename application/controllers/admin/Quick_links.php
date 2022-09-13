<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quick_links extends MY_Controller
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

        $this->template->views('admin/quick_links/index', $data);
    }

    public function add_quick_links()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/quick_links/add_quick_links', $data);
    }

    public function edit_quick_links($link_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["link_id"] = $link_id;

        $link_id = en_func($link_id, 'd');

        $data["quick_linksDetails"] = $this->Common_model->select_by_id('ci_quick_links', $link_id, 'link_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["quick_linksDetails"]);

        $this->template->views('admin/quick_links/add_quick_links', $data);
    }

    public function view_quick_links($link_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';

        $link_id = en_func($link_id, 'd');

        $data["quick_linksDetails"] = $this->Common_model->select_by_id('ci_quick_links', $link_id, 'link_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["quick_linksDetails"]);

        $this->template->views('admin/quick_links/add_quick_links', $data);
    }

    public function update_quick_links()
    {
        $link_id = $this->input->post('link_id');
        $this->save_quick_links('update', $link_id);
    }


    public function save_quick_links($func = 'add', $link_id = 0)
    {
        $this->form_validation->set_rules('link_title', 'Link title', 'trim|required');
        $this->form_validation->set_rules('link_url', 'Link url', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('link_id', 'quick_links ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;



        $data_insert = array(
            'link_title' => $this->input->post('link_title'),
            'link_url' => $this->input->post('link_url'),
            'sort_order' => $this->input->post('sort_order'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );

        $link_id =  en_func($link_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $link_id, 'ci_quick_links', 'link_id');
            $this->add_activity_log("Updated quicklink");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_quick_links');
            $this->add_activity_log("Added quicklink");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Quick link link successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Quick link link could not be added !');
        echo json_encode($data);
        exit();
    }

    public function quick_links_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_quick_links', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $link_id  = en_func($row->link_id, 'e');
            $data[] = array(
                ++$i,
                $row->link_title,
                $row->link_url,
                $row->sort_order,
                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/quick_links/edit_quick_links/' . $link_id  . '" title="Edit quick_links" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/quick_links/view_quick_links/' . $link_id  . '" title="View quick_links" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
        <a href="' . base_url() . 'admin/quick_links/delete_quick_links/' . $link_id  . '" title="Delete quick_links"  onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>'

            );
        }
        $this->response(200, $data);
    }


    public function delete_quick_links($link_id)
    {
        $link_id = en_func($link_id, 'd');
        $response = $this->Common_model->delete_table($link_id,'ci_quick_links','link_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Quick link has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Quick link could not be deleted!');
        redirect(base_url('admin/quick_links'));
    }
}
