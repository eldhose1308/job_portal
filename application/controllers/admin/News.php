<?php
defined('BASEPATH') or exit('No direct script access allowed');

class news extends MY_Controller
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
        $data["categories"] = $this->Common_model->select_all('ci_news_category');

        $this->template->views('admin/news/index', $data);
    }

    public function add_news()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();
        $data["categories"] = $this->Common_model->select_all('ci_news_category');

        $this->template->views('admin/news/add_news', $data);
    }



    public function edit_news($news_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["news_id"] = $news_id;

        $news_id  = en_func($news_id, 'd');

        $data["newsDetails"] = $this->Common_model->select_by_id('ci_news', $news_id, 'news_id ');
        $data["status"] = $this->Common_model->select_status();
        $data["categories"] = $this->Common_model->select_all('ci_news_category');

        $this->check_exists($data["newsDetails"]);

        $this->template->views('admin/news/add_news', $data);
    }

    public function view_news($news_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["news_id"] = $news_id;

        $news_id  = en_func($news_id, 'd');

        $data["newsDetails"] = $this->Common_model->select_by_id('ci_news', $news_id, 'news_id ');
        $data["status"] = $this->Common_model->select_status();
        $data["categories"] = $this->Common_model->select_all('ci_news_category');

        $this->check_exists($data["newsDetails"]);

        $this->template->views('admin/news/add_news', $data);
    }


    public function update_news()
    {
        $news_id  = $this->input->post('news_id');
        $this->save_news('update', $news_id);
    }


    public function save_news($func = 'add', $news_id  = 0)
    {
        $this->form_validation->set_rules('news_title', 'news name', 'trim|required');
        $this->form_validation->set_rules('news_date', 'Date', 'trim|required');
        $this->form_validation->set_rules('news_content', 'Content', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('news_document', 'Document', 'trim');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('news_id', 'news ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
             echo json_encode($data);
             exit();
        }

        $this->check_encrypted($this->input->post('category'), 'Category');


        $news_document = (strlen($this->input->post('news_document')) < 1) ? NULL : $this->input->post('news_document');
        if (!empty($_FILES['document-upload']['name'])) :
            $document_result = $this->addImage('document-upload');

            if ($document_result['status'] == '500') :
                $data = array('status' => 'error', 'msg' => json_encode($document_result['msg']['error']));
                echo json_encode($data);
                exit();
            else :
                $news_document = $document_result['filename'];
            endif;

        endif;


        $user_id = $this->user_id;

        $image_path = '';

        if ($func == 'add') :
            $data = $_POST['photo'];
            $image_path = $this->upload_base64Images($data, 'uploads/news/');
        endif;

        if ($func == 'update') :
            $image_path = $this->input->post('image_path');
            if (strlen($this->input->post('image_path')) < 1) :
                $data = $_POST['photo'];
                $image_path = $this->upload_base64Images($data, 'uploads/news/');
            endif;
        endif;

        $data_insert = array(
            'news_title' => $this->input->post('news_title'),
            'news_date' => $this->input->post('news_date'),
            'news_content' => $this->input->post('news_content'),
            'image_path' => $image_path,
            'news_document' => $news_document,
            'category' => en_func($this->input->post('category'), 'd'),
            'sort_order' => $this->input->post('sort_order'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $news_id  =  en_func($news_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $news_id, 'ci_news', 'news_id '); 
            $this->add_activity_log("Updated news");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_news');
            $this->add_activity_log("Added news");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'News successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'News could not be added !');
        echo json_encode($data);
        exit();
    }

    public function news_json()
    {
        $this->load->model('Admin_model');

        $status = (int) en_func($this->input->get('status'), 'd');
        $category = (int) en_func($this->input->get('category'), 'd');

        $records['data'] = $this->Admin_model->select_all_news($status, $category);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $news_id   = en_func($row->news_id, 'e');
            $data[] = array(
                ++$i,
                '<img src="' . NEWS_IMAGES . $row->image_path . '" alt="' . $row->news_title . '" class="datacard_img">',
                $row->news_title,
                '<span class="badge rounded-pill alert-warning">'.$row->category_name . '</span>',
                date('d M,Y', strtotime($row->news_date)),
                $row->sort_order,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                '<div class="action-buttons">
                    <a href="' . base_url() . 'admin/news/edit_news/' . $news_id  . '" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                    <a href="' . base_url() . 'admin/news/view_news/' . $news_id  . '" class="btn btn-sm font-sm rounded btn-info"> <i class="fa fa-eye"></i> View </a>
                    <a href="' . base_url() . 'admin/news/delete_news/' . $news_id  . '"  onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm font-sm btn-danger rounded"> <i class="material-icons md-delete_forever"></i> Delete </a>
                </div>'

            );
        }
        $this->response(200, $data);
    }


    public function delete_news($news_id)
    {
        $news_id = en_func($news_id, 'd');
        $response = $this->Common_model->delete_table($news_id,'ci_news','news_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'News has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'News could not be deleted!');
        redirect(base_url('admin/news'));
    }



    /***
     * 
     * Categories
     * 
     * **/


    public function categories()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/news/index_categories', $data);
    }

    public function add_categories()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/news/add_categories', $data);
    }

    public function edit_categories($category_id  = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["category_id"] = $category_id;

        $category_id  = en_func($category_id, 'd');

        $data["categoriesDetails"] = $this->Common_model->select_by_id('ci_news_category', $category_id, 'category_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["categoriesDetails"]);


        $this->template->views('admin/news/add_categories', $data);
    }

    public function view_categories($category_id  = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["category_id"] = $category_id;

        $category_id  = en_func($category_id, 'd');

        $data["categoriesDetails"] = $this->Common_model->select_by_id('ci_news_category', $category_id, 'category_id');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["categoriesDetails"]);

        $this->template->views('admin/news/add_categories', $data);
    }

    public function update_categories()
    {
        $this->check_encrypted($this->input->post('category_id'), 'Page');

        $category_id  = $this->input->post('category_id');
        $this->save_categories('update', $category_id);
    }


    public function save_categories($func = 'add', $category_id  = 0)
    {
        $this->form_validation->set_rules('category_name', 'Category name', 'trim|required');

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
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );

        $category_id  =  en_func($category_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $category_id, 'ci_news_category', 'category_id');
            $this->add_activity_log("Updated news category");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_news_category');
            $this->add_activity_log("Added news category");
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


    public function categories_json()
    {
        $status = (int) en_func($this->input->get('status'), 'd');


        $records['data'] = $this->Common_model->select_all('ci_news_category', $status);
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $category_id  = en_func($row->category_id, 'e');
            $data[] = array(
                ++$i,
                $row->category_name,
                date('d-m-Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),                '<div class="btn-group btn-group-sm">
        <a href="' . base_url() . 'admin/news/edit_categories/' . $category_id   . '" title="Edit Category" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
        <a href="' . base_url() . 'admin/news/view_categories/' . $category_id   . '" title="View Category" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
        <a href="' . base_url() . 'admin/news/delete_categories/' . $category_id  . '" title="Delete Category" onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>'


            );
        }
        $this->response(200, $data);
    }

    
    public function delete_categories($category_id)
    {
        $category_id = en_func($category_id, 'd');
        $response = $this->Common_model->delete_table($category_id, 'ci_news_category', 'category_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'News Category has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'News Category could not be deleted!');
        redirect(base_url('admin/news/categories'));
    }
}
