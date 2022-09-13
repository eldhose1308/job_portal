<?php
defined('BASEPATH') or exit('No direct script access allowed');

class video_gallery extends MY_Controller
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

        $this->template->views('admin/video_gallery/index', $data);
    }

    public function add_video_gallery()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/video_gallery/add_video_gallery', $data);
    }



    public function edit_video_gallery($gallery_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["gallery_id"] = $gallery_id;

        $gallery_id = en_func($gallery_id, 'd');

        $data["video_galleryDetails"] = $this->Common_model->select_by_id('ci_video_gallery', $gallery_id, 'gallery_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["video_galleryDetails"]);

        $this->template->views('admin/video_gallery/add_video_gallery', $data);
    }

    public function view_video_gallery($gallery_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["gallery_id"] = $gallery_id;

        $gallery_id = en_func($gallery_id, 'd');

        $data["video_galleryDetails"] = $this->Common_model->select_by_id('ci_video_gallery', $gallery_id, 'gallery_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["video_galleryDetails"]);

        $this->template->views('admin/video_gallery/add_video_gallery', $data);
    }


    public function update_video_gallery()
    {
        $gallery_id = $this->input->post('gallery_id');
        $this->save_video_gallery('update', $gallery_id);
    }


    public function save_video_gallery($func = 'add', $gallery_id = 0)
    {
        $this->form_validation->set_rules('video_title', 'Video title', 'trim|required');
        $this->form_validation->set_rules('video_link', 'Video link', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('gallery_id', 'video_gallery ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;


        $data_insert = array(
            'video_title' => $this->input->post('video_title'),
            'video_link' => $this->input->post('video_link'),
            'sort_order' => $this->input->post('sort_order'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $gallery_id =  en_func($gallery_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $gallery_id, 'ci_video_gallery', 'gallery_id');
            $this->add_activity_log("Updated video gallery");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_video_gallery');
            $this->add_activity_log("Added video gallery");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Video link successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Video link could not be added !');
        echo json_encode($data);
        exit();
    }

    public function video_gallery_json()
    {

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_video_gallery', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $gallery_id  = en_func($row->gallery_id, 'e');
            $data[] = array(
                ++$i,
                $row->video_title,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                '<div class="btn-group btn-group-sm">
                    <a href="' . base_url() . 'admin/video_gallery/edit_video_gallery/' . $gallery_id . '" title="Edit video_gallery" class="edit-department btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="' . base_url() . 'admin/video_gallery/edit_video_gallery/' . $gallery_id . '" title="View video_gallery" class="show-department btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                    <a href="' . base_url() . 'admin/video_gallery/delete_video_gallery/' . $gallery_id  . '" title="Delete video_gallery" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>

                </div>'

            );
        }
        $this->response(200, $data);
    }



    public function delete_video_gallery($gallery_id)
    {
        $gallery_id = en_func($gallery_id, 'd');
        $response = $this->Common_model->delete_table($gallery_id, 'ci_video_gallery', 'gallery_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Video gallery has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Video gallery could not be deleted!');
        redirect(base_url('admin/video_gallery'));
    }
}
