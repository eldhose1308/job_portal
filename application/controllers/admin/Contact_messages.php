<?php
defined('BASEPATH') or exit('No direct script access allowed');

class contact_messages extends MY_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');
    }



    public function index()
    {

        $data = $this->data;
        $data["status"] = $this->Common_model->select_status();

        $this->template->views('admin/contact_messages/index', $data);
    }



    public function edit_contact_messages($user_id = 0)
    {
        $data = $this->data;
        $data["operation"] = 'edit';
        $data["user_id"] = $user_id;
        $data["disabled"] = '';

        $user_id = en_func($user_id, 'd');
        $data["userDetails"] = $this->Common_model->select_user_by_id($user_id);

        $captcha_word = rand(1000, 9999);
        $data['captchaimage'] = createCaptchaImage($captcha_word);

        $data['word'] = $captcha_word;


        $this->session->set_flashdata('captcha_content', $captcha_word);

        $this->template->views('admin/contact_messages/add_contact_messages', $data);
    }

    public function view_contact_messages($message_id = 0)
    {

        $data = $this->data;
        $data["operation"] = 'view';
        $data["message_id"] = $message_id;
        $data["disabled"] = 'disabled';


        $message_id = en_func($message_id, 'd');
        $data["msgDetails"] = $this->Common_model->select_by_id('ci_contact_messages', $message_id, 'message_id');


        $this->template->views('admin/contact_messages/add_contact_messages', $data);
    }








    public function contact_messages_json()
    {
        $user_id = $this->user_id;
        $status = (int) en_func($this->input->get('status'), 'd');



        $records['data'] = $this->Common_model->select_all_with_status('ci_contact_messages', $status);
        $status = $this->Common_model->select_status();



        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {
            $status_bg = ($row->status == 1) ? 'success' : (($row->status == 2) ? 'warning' : 'danger');



            $change_status = '<select data-id="'.en_func($row->message_id,"e").'" class="form-select change_status">';

            foreach ($status as $statuses){
                $selected = ($row->status == $statuses->status_id) ? "selected" : "";
                $change_status .= '<option '.$selected.' value="' . en_func($statuses->status_id, "e") . '">' . $statuses->status . '</option>';
            }
            $change_status .= '</select>';






            $message_id = en_func($row->message_id, 'e');
            $data[] = array(
                ++$i,
                $row->full_name . ' | <br>' .
                $row->email_address . ' | <br>' .
                $row->phone_number,
                date('F d,Y', strtotime($row->created_at)) . ' | ' . date('h:i a', strtotime($row->created_at)),
                $row->visitor_ip. ' | <br>'.$row->visited_platform. ' | <br>'.$row->visited_agent,
                '<span class="badge alert-' . $status_bg . '">' . $row->status_badge . '</span>',
                '<div class="btn-group btn-group-sm">
                   <a href="' . base_url() . 'admin/contact_messages/view_contact_messages/' . $message_id  . '" title="View Message" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                </div>',
                $change_status

            );
        }
        $this->response(200, $data);
    }


    

    public function change_status(){
        $this->form_validation->set_rules('message_id', 'Message', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => 'error', 'msg' => validation_errors());
            echo json_encode($data);
            exit();
        }


        $data_insert = array(
            'status' => en_func($this->input->post('status'), 'd')
        );

        $message_id = en_func($this->input->post('message_id'), 'd');


        $qry_response = $this->Common_model->update_table($data_insert,$message_id, 'ci_contact_messages', 'message_id');


        if ($qry_response > 0) :
            $data = array('status' => 'success', 'msg' => 'Status successfully changed !');
            echo json_encode($data);
            $this->add_activity_log("Updated contact message");
            exit();
        endif;

        $data = array('status' => 'error', 'msg' => 'Status could not be changed !');
        echo json_encode($data);
        exit();

    }
}
