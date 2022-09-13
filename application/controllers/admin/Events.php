<?php
defined('BASEPATH') or exit('No direct script access allowed');

class events extends MY_Controller
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

        $this->template->views('admin/events/index', $data);
    }

    public function add_events()
    {
        $data = $this->data;
        $data["operation"] = 'add';
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/events/add_events', $data);
    }



    public function edit_events($event_id)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["event_id"] = $event_id;

        $event_id  = en_func($event_id, 'd');

        $data["eventsDetails"] = $this->Common_model->select_by_id('ci_events', $event_id, 'event_id ');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["eventsDetails"]);

        $this->template->views('admin/events/add_events', $data);
    }

    public function view_events($event_id)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["event_id"] = $event_id;

        $event_id  = en_func($event_id, 'd');

        $data["eventsDetails"] = $this->Common_model->select_by_id('ci_events', $event_id, 'event_id ');
        $data["status"] = $this->Common_model->select_status();

        $this->check_exists($data["eventsDetails"]);

        $this->template->views('admin/events/add_events', $data);
    }


    public function update_events()
    {
        $event_id  = $this->input->post('event_id');
        $this->save_events('update', $event_id);
    }


    public function save_events($func = 'add', $event_id  = 0)
    {
        $this->form_validation->set_rules('event_title', 'events name', 'trim|required');
        $this->form_validation->set_rules('event_date', 'Date', 'trim|required');
        $this->form_validation->set_rules('event_content', 'Content', 'trim|required');
        $this->form_validation->set_rules('event_document', 'Document', 'trim');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim|required|numeric');

        if ($func == 'update')
            $this->form_validation->set_rules('event_id', 'events ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }




        $user_id = $this->user_id;


        $event_document = (strlen($this->input->post('event_document')) < 1) ? NULL : $this->input->post('event_document');
        if (!empty($_FILES['document-upload']['name'])) :
            $document_result = $this->addImage('document-upload');

            if ($document_result['status'] == '500') :
                $data = array('status' => 'error', 'msg' => json_encode($document_result['msg']['error']));
                echo json_encode($data);
                exit();
            else :
                $event_document = $document_result['filename'];
            endif;

        endif;


        $image_path = '';
        if ($func == 'add') :
            $data = $_POST['photo'];
            $image_path = $this->upload_base64Images($data, 'uploads/events/');
        endif;

        if ($func == 'update') :
            $image_path = $this->input->post('image_path');
            if (strlen($this->input->post('image_path')) < 1) :
                $data = $_POST['photo'];
                $image_path = $this->upload_base64Images($data, 'uploads/events/');
            endif;
        endif;


        $data_insert = array(
            'event_title' => $this->input->post('event_title'),
            'event_date' => $this->input->post('event_date'),
            'event_content' => $this->input->post('event_content'),
            'image_path' => $image_path,
            'event_document' => $event_document,
            'sort_order' => $this->input->post('sort_order'),
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'added_by' => $user_id,
            'status' => en_func($this->input->post('status'), 'd')

        );


        $event_id  =  en_func($event_id, 'd');

        if ($func == 'update') :
            unset($data_insert['created_at']);
            $qry_response = $this->Common_model->update_table($data_insert, $event_id, 'ci_events', 'event_id ');
            $this->add_activity_log("Updated events");
        else :
            $qry_response = $this->Common_model->insert_table($data_insert, 'ci_events');
            $this->add_activity_log("Added events");
        endif;

        //lq();

        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'events successfully added !');
            echo json_encode($data);
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'events could not be added !');
        echo json_encode($data);
        exit();
    }

    public function events_json()
    {
        $this->load->model('Admin_model');

        $status = (int) en_func($this->input->get('status'), 'd');

        $records['data'] = $this->Common_model->select_all('ci_events', $status);
        $data = array();
        $i = 0;
        foreach ($records['data']   as $row) {
            $event_id   = en_func($row->event_id, 'e');
            $data[] = array(
                ++$i,
                '<img src="' . EVENTS_IMAGES . $row->image_path . '" alt="' . $row->event_title . '" class="datacard_img">',
                $row->event_title,
                date('d M,Y', strtotime($row->event_date)),
                'Sort Order: ' . $row->sort_order,
                date('d-m-Y', strtotime($row->updated_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                '<div class="action-buttons">
                    <a href="' . base_url() . 'admin/events/edit_events/' . $event_id  . '" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                    <a href="' . base_url() . 'admin/events/view_events/' . $event_id  . '" class="btn btn-sm font-sm rounded btn-info"> <i class="fa fa-eye"></i> View </a>
                    <a href="' . base_url() . 'admin/events/delete_events/' . $event_id  . '"  onclick="return confirm(\'Do you want to delete ?\')" class="btn btn-sm font-sm btn-danger rounded"> <i class="material-icons md-delete_forever"></i> Delete </a>
                </div>'

            );
        }
        $this->response(200, $data);
    }

    

    public function delete_events($event_id)
    {
        $event_id = en_func($event_id, 'd');
        $response = $this->Common_model->delete_table($event_id,'ci_events','event_id');
        if ($response > 0)
            $this->session->set_flashdata('success', 'Event has been deleted successfully!');
        else
            $this->session->set_flashdata('errors', 'Event could not be deleted!');
        redirect(base_url('admin/events'));
    }



}
