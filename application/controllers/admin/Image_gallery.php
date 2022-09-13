<?php
defined('BASEPATH') or exit('No direct script access allowed');

class image_gallery extends MY_Controller
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
        $data["categories"] = $this->Common_model->select_all('ci_gallery_categories');

        $this->template->views('admin/image_gallery/index', $data);
    }

    public function add_image_gallery()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data['categories'] = $this->Common_model->select_all('ci_gallery_categories');

        $this->template->views('admin/image_gallery/add_image_gallery', $data);
    }

    public function edit_image_gallery($gallery_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["gallery_id"] = $gallery_id;

        $gallery_id = en_func($gallery_id, 'd');

        $data["image_galleryDetails"] = $this->Common_model->select_by_id('ci_image_gallery', $gallery_id, 'gallery_id');
        $data["status"] = $this->Common_model->select_status();
        $data['categories'] = $this->Common_model->select_all('ci_gallery_categories');


        $this->check_exists($data["image_galleryDetails"]);

        $this->template->views('admin/image_gallery/add_image_gallery', $data);
    }

    public function view_image_gallery($gallery_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';

        $gallery_id = en_func($gallery_id, 'd');

        $data["image_galleryDetails"] = $this->Common_model->select_by_id('ci_image_gallery', $gallery_id, 'gallery_id');
        $data["status"] = $this->Common_model->select_status();
        $data['categories'] = $this->Common_model->select_all('ci_gallery_categories');
        $this->check_exists($data["image_galleryDetails"]);

        $this->template->views('admin/image_gallery/add_image_gallery', $data);
    }

    public function update_image_gallery()
    {
        $this->check_encrypted($this->input->post('gallery_id'), 'Page');

        $gallery_id = $this->input->post('gallery_id');
        $this->save_image_gallery('update', $gallery_id);
    }


    public function save_image_gallery($func = 'add', $gallery_id = 0)
    {
        $this->form_validation->set_rules('image_title', 'Image title', 'trim|required');
        $this->form_validation->set_rules('gallery_category', 'Category', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('gallery_id', 'gallery ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }

        $this->check_encrypted($this->input->post('gallery_category'), 'Category');

        $user_id = $this->user_id;


        if ($func == 'add') :
            $data = $_POST['photo'];
            $image_path = $this->upload_base64Images($data, 'uploads/image_gallery/');
        endif;

        if ($func == 'update') :
            $image_path = $this->input->post('image_path');
            if (strlen($this->input->post('image_path')) < 1) :
                $data = $_POST['photo'];
                $image_path = $this->upload_base64Images($data, 'uploads/image_gallery/');
            endif;
        endif;

        $data_insert = array(
            'image_path' => $image_path,
            'image_title' => $this->input->post('image_title'),
            'gallery_category' => en_func($this->input->post('gallery_category'), 'd'),
            'sort_order' => $this->input->post('sort_order'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );

        $gallery_id =  en_func($gallery_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $gallery_id, 'ci_image_gallery', 'gallery_id');
            $this->add_activity_log("Updated image gallery");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_image_gallery');
            $this->add_activity_log("Added image gallery");

        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Image gallery successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Image gallery could not be added !');
        echo json_encode($data);
        exit();
    }

    public function image_gallery_json()
    {

        $this->load->model('Admin_model');

        $status = (int) en_func($this->input->get('status'), 'd');
        $gallery_category = (int) en_func($this->input->get('gallery_category'), 'd');

        $records['data'] = $this->Admin_model->select_all_gallery($status, $gallery_category);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $gallery_id  = en_func($row->gallery_id, 'e');
            $data[] = array(
                ++$i,
                '<img src="' . GALLERY_IMAGES . $row->image_path . '" alt="' . $row->image_title . '" class="datacard_img">',
                'Gallery title: '.$row->image_title,
                // 'Category: '. $row->category_name,
                '<span class="badge rounded-pill alert-warning">' . $row->category_name  . '</span>',
                'Sort Order: '.$row->sort_order,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->updated_at)),
                '<div class="action-buttons">
                    <a href="' . base_url() . 'admin/image_gallery/edit_image_gallery/' . $gallery_id  . '" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                    <a href="' . base_url() . 'admin/image_gallery/view_image_gallery/' . $gallery_id  . '" class="btn btn-sm font-sm rounded btn-info"> <i class="material-icons md-visibility"></i> View </a>
                    <a href="' . base_url() . 'admin/image_gallery/delete_image_gallery/' . $gallery_id  . '"  onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm font-sm btn-danger rounded"> <i class="material-icons md-delete_forever"></i> Delete </a>
                </div>'
            );
        }
        $this->response(200, $data);
    }

    
    public function delete_image_gallery($gallery_id)
    {
        $gallery_id = en_func($gallery_id, 'd');
        $response = $this->Common_model->delete_table($gallery_id,'ci_image_gallery','gallery_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Image gallery has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Image gallery could not be deleted!');
        redirect(base_url('admin/image_gallery'));
    }




    /*
    *
    *  Gallery categories
    *
    */





    public function gallery_categories()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/gallery_categories/index', $data);
    }

    public function add_gallery_categories()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/gallery_categories/add_gallery_categories', $data);
    }

    public function edit_gallery_categories($category_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["category_id"] = $category_id;

        $category_id = en_func($category_id, 'd');

        $data["gallery_categoriesDetails"] = $this->Common_model->select_by_id('ci_gallery_categories', $category_id, 'category_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["gallery_categoriesDetails"]);


        $this->template->views('admin/gallery_categories/add_gallery_categories', $data);
    }

    public function view_gallery_categories($category_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';

        $category_id = en_func($category_id, 'd');

        $data["gallery_categoriesDetails"] = $this->Common_model->select_by_id('ci_gallery_categories', $category_id, 'category_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["gallery_categoriesDetails"]);

        $this->template->views('admin/gallery_categories/add_gallery_categories', $data);
    }

    public function update_gallery_categories()
    {
        $this->check_encrypted($this->input->post('category_id'), 'Page');

        $category_id = $this->input->post('category_id');
        $this->save_gallery_categories('update', $category_id);
    }


    public function save_gallery_categories($func = 'add', $category_id = 0)
    {
        $this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('category_id', 'Category ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $user_id = $this->user_id;


        $data_insert = array(
            'category_name' => $this->input->post('category_name'),
            'sort_order' => $this->input->post('sort_order'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );

        $category_id =  en_func($category_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $category_id, 'ci_gallery_categories', 'category_id');
            $this->add_activity_log("Updated gallery category");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_gallery_categories');
            $this->add_activity_log("Added gallery category");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Category successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Category could not be added !');
        echo json_encode($data);
        exit();
    }


    public function gallery_categories_json()
    {
        $status = (int) en_func($this->input->get('status'), 'd');


        $records['data'] = $this->Common_model->select_all('ci_gallery_categories', $status);
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $category_id = en_func($row->category_id, 'e');
            $data[] = array(
                ++$i,
                $row->category_name,
                $row->sort_order,
                $row->updated_at,
                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/image_gallery/edit_gallery_categories/' . $category_id  . '" title="Edit Category" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/image_gallery/view_gallery_categories/' . $category_id  . '" title="View Category" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
        <a href="' . base_url() . 'admin/image_gallery/delete_gallery_categories/' . $category_id  . '" title="Delete Category" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>'

            );
        }
        $this->response(200, $data);
    }

    
    public function delete_gallery_categories($category_id)
    {
        $category_id = en_func($category_id, 'd');
        $response = $this->Common_model->delete_table($category_id, 'ci_gallery_categories', 'category_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Gallery Category has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Gallery Category could not be deleted!');
        redirect(base_url('admin/image_gallery/gallery_categories'));
    }
}
