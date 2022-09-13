<?php
defined('BASEPATH') or exit('No direct script access allowed');

class banner extends MY_Controller
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
        $data["menu_id"] = 3;

        $this->template->views('admin/banner/index', $data);
    }

    public function add_banner()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/banner/add_banner', $data);
    }



    public function edit_banner($banner_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["banner_id"] = $banner_id;

        $banner_id = en_func($banner_id, 'd');

        $data["bannerDetails"] = $this->Common_model->select_by_id('ci_banner', $banner_id, 'banner_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["bannerDetails"]);

        $this->template->views('admin/banner/add_banner', $data);
    }

    public function view_banner($banner_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["banner_id"] = $banner_id;

        $banner_id = en_func($banner_id, 'd');

        $data["bannerDetails"] = $this->Common_model->select_by_id('ci_banner', $banner_id, 'banner_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["bannerDetails"]);

        $this->template->views('admin/banner/add_banner', $data);
    }


    public function update_banner()
    {
        $banner_id = $this->input->post('banner_id');
        $this->save_banner('update', $banner_id);
    }


    public function save_banner($func = 'add', $banner_id = 0)
    {
        $this->form_validation->set_rules('banner_name', 'Banner name', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');
        $this->form_validation->set_rules('banner_caption', 'Banner caption', 'trim|required');
        $this->form_validation->set_rules('banner_description', 'Banner description', 'trim|required');

        if ($func == 'update')
            $this->form_validation->set_rules('banner_id', 'banner ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;

        if ($func == 'add') :
            $data = $_POST['photo'];
            $image_path = $this->upload_base64Images($data, 'uploads/banner/');
        endif;

        if ($func == 'update') :
            $image_path = $this->input->post('image_path');
            if (strlen($this->input->post('image_path')) < 1) :
                $data = $_POST['photo'];
                $image_path = $this->upload_base64Images($data, 'uploads/banner/');
            endif;
        endif;

        $data_insert = array(
            'banner_name' => $this->input->post('banner_name'),
            'banner_caption' => $this->input->post('banner_caption'),
            'banner_description' => $this->input->post('banner_description'),
            'sort_order' => $this->input->post('sort_order'),
            'banner_photo' => $image_path,
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => 1

        );


        $banner_id =  en_func($banner_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $banner_id, 'ci_banner', 'banner_id');
            $this->add_activity_log("Updated banner");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_banner');
            $this->add_activity_log("Added banner");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Banner successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Banner could not be added !');
        echo json_encode($data);
        exit();
    }

    public function banner_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_banner', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $banner_id  = en_func($row->banner_id, 'e');
            $data[] = array(
                ++$i,
                '<img src="' . BANNER_IMAGES . $row->banner_photo . '" alt="' . $row->banner_name . '" class="datacard_img">',
                $row->banner_name,
                $row->banner_caption,
                $row->banner_description,
                $row->sort_order,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                '<div class="action-buttons">
                <a href="' . base_url() . 'admin/banner/edit_banner/' . $banner_id  . '" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                <a href="' . base_url() . 'admin/banner/view_banner/' . $banner_id  . '" class="btn btn-sm font-sm rounded btn-info"> <i class="fa fa-eye"></i> View </a>
                <a href="' . base_url() . 'admin/banner/delete_banner/' . $banner_id  . '"  onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm font-sm btn-danger rounded"> <i class="material-icons md-delete_forever"></i> Delete </a>
            </div>'

            );
        }
        $this->response(200, $data);
    }

    
    public function delete_banner($banner_id)
    {
        $banner_id = en_func($banner_id, 'd');
        $response = $this->Common_model->delete_table($banner_id,'ci_banner','banner_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Banner has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Banner could not be deleted!');
        redirect(base_url('admin/banner'));
    }


}
