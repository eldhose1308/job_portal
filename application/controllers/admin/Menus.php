<?php
defined('BASEPATH') or exit('No direct script access allowed');

class menus extends MY_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');

        $this->load->model('M_users');
        $this->load->model('M_menus');
    }



    public function top_menus()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/top_menus/index', $data);

        remove_flashdata();
    }


    public function add_topmenus()
    {
        $data = $this->data;
        $data["operation"] = 'add';

        $data["status"] = $this->Common_model->select_status();


        $this->template->views('admin/top_menus/add_topmenus', $data);
    }


    public function edit_topmenus($tm_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["tm_id"] = $tm_id;
        $data["disabled"] = '';
        $data["status"] = $this->Common_model->select_status();

        $tm_id = en_func($tm_id, 'd');
        $data["topmenusDetails"] = $this->Common_model->select_by_id('ci_top_menu', $tm_id, 'tm_id');

        $this->check_exists($data["topmenusDetails"]);

        $this->template->views('admin/top_menus/add_topmenus', $data);
    }

    public function view_topmenus($tm_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'view';
        $data["tm_id"] = $tm_id;
        $data["disabled"] = 'disabled';
        $data["status"] = $this->Common_model->select_status();


        $tm_id = en_func($tm_id, 'd');
        $data["topmenusDetails"] = $this->Common_model->select_by_id('ci_top_menu', $tm_id, 'tm_id');
        $this->check_exists($data["topmenusDetails"]);


        $this->template->views('admin/top_menus/add_topmenus', $data);
    }



    public function update_topmenus()
    {
        $tm_id = $this->input->post('tm_id');
        $this->save_topmenus('update', $tm_id);
    }



    public function save_topmenus($func = 'add', $tm_id = 0)
    {

        $this->form_validation->set_rules('top_menu_name', 'Menu name', 'trim|required');
        $this->form_validation->set_rules('content_page', 'Content page or not', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');


        if ($this->input->post('content_page') == 1)
            $this->form_validation->set_rules('link', 'Link', 'trim|required');
        else
            $this->form_validation->set_rules('content', 'Page content', 'trim|required');




        if ($func == 'update')
            $this->form_validation->set_rules('tm_id', 'Menu ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;


        //'content_page' => $this->input->post('content_page'),
        //'page_content' => $this->input->post('page_content'),

        $data_insert = array(
            'top_menu_name' => $this->input->post('top_menu_name'),
            'content_page' => $this->input->post('content_page'),
            'content' => $this->input->post('content'),
            'description' => $this->input->post('description'),
            'link' => $this->input->post('link'),
            'sort_order' => $this->input->post('sort_order'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );

        $tm_id =  en_func($tm_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $tm_id, 'ci_top_menu', 'tm_id');
            $this->add_activity_log("Updated topmenu");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_top_menu');
            $this->add_activity_log("Added topmenu");

        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Topmenu successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Topmenu could not be added !');
        echo json_encode($data);
        exit();
    }



    public function topmenus_json()
    {
        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_top_menu', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $tm_id = en_func($row->tm_id, 'e');
            $data[] = array(
                ++$i,
                $row->top_menu_name,
                $row->sort_order,
                $row->updated_at,
                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/menus/edit_topmenus/' . $tm_id  . '" title="Edit Menu" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/menus/view_topmenus/' . $tm_id  . '" title="View Menus" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
        <a href="' . base_url() . 'admin/menus/delete_topmenus/' . $tm_id  . '" title="Delete Menus"  onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>'

            );
        }
        $this->response(200, $data);
    }



    public function delete_topmenus($mm_id)
    {
        $mm_id = en_func($mm_id, 'd');
        $response = $this->Common_model->delete_table($mm_id, 'ci_top_menu', 'tm_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Topmenu has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Topmenu could not be deleted!');
        redirect(base_url('admin/menus/top_menus'));
    }



    /*
     * 
     * 
     *  Sub menus
     *  
     * 
     * 
    */





    public function sub_menus()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();
        $data['topMenu'] = $this->M_menus->get_topmenus_list();

        $this->template->views('admin/sub_menus/index', $data);

        remove_flashdata();
    }

    public function add_submenus()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data['topMenu'] = $this->M_menus->get_topmenus_list();
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/sub_menus/add_submenus', $data);
    }

    public function edit_submenus($mm_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["mm_id"] = $mm_id;

        $mm_id = en_func($mm_id, 'd');

        $data['topMenu'] = $this->M_menus->get_topmenus_list();
        $data["submenusDetails"] = $this->M_menus->select_submenus_by_id($mm_id);
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["submenusDetails"]);

        $this->template->views('admin/sub_menus/add_submenus', $data);
    }

    public function view_submenus($mm_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';

        $mm_id = en_func($mm_id, 'd');


        $data['topMenu'] = $this->M_menus->get_topmenus_list();
        $data["submenusDetails"] = $this->M_menus->select_submenus_by_id($mm_id);
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["submenusDetails"]);

        $this->template->views('admin/sub_menus/add_submenus', $data);
    }

    public function update_submenus()
    {
        $mm_id = $this->input->post('mm_id');
        $this->save_submenus('update', $mm_id);
    }


    public function save_submenus($func = 'add', $mm_id = 0)
    {
        $this->form_validation->set_rules('top_menu', 'Parent Menu', 'trim|required');
        $this->form_validation->set_rules('main_menu_name', 'Menu name', 'trim|required');
        $this->form_validation->set_rules('content_page', 'Content page or not', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');


        if ($this->input->post('content_page') == 1)
            $this->form_validation->set_rules('link', 'Link', 'trim|required');
        else
            $this->form_validation->set_rules('content', 'Page content', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('mm_id', 'Menu ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }

        if ((int) en_func($this->input->post('top_menu'), 'd') < 1) {
            $data = array('status' => 'error', 'msg' => 'Top menu is not defined');
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;

        //'content_page' => $this->input->post('content_page'),
        // 'page_content' => $this->input->post('page_content'),
        $data_insert = array(
            'top_menu' => en_func($this->input->post('top_menu'), 'd'),
            'main_menu_name' => $this->input->post('main_menu_name'),
            'content' => $this->input->post('content'),
            'description' => $this->input->post('description'),
            'content_page' => $this->input->post('content_page'),
            'link' => $this->input->post('link'),
            'sort_order' => $this->input->post('sort_order'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $mm_id =  en_func($mm_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $mm_id, 'ci_main_menu', 'mm_id');
            $this->add_activity_log("Updated submenu");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_main_menu');
            $this->add_activity_log("Added submenu");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Submenu successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Submenu could not be added !');
        echo json_encode($data);
        exit();
    }


    public function submenus_json()
    {
        $tm_id = (int) en_func($this->input->get('tm_id'), 'd');
        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->M_menus->get_submenus_list($status, $tm_id);
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $mm_id = en_func($row->mm_id, 'e');
            $data[] = array(
                ++$i,
                $row->main_menu_name,
                $row->top_menu_name,
                $row->sort_order,
                $row->updated_at,
                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/menus/edit_submenus/' . $mm_id  . '" title="Edit Submenus" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/menus/view_submenus/' . $mm_id  . '" title="View Submenus" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
        <a href="' . base_url() . 'admin/menus/delete_submenus/' . $mm_id  . '" title="Delete Submenus" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>'

            );
        }
        $this->response(200, $data);
    }


    public function delete_submenus($mm_id)
    {
        $mm_id = en_func($mm_id, 'd');
        $response = $this->Common_model->delete_table($mm_id, 'ci_main_menu', 'mm_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Submenu has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Submenu could not be deleted!');
        redirect(base_url('admin/menus/sub_menus'));
    }
}
