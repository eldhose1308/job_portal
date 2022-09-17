<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller

{
    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');



        date_default_timezone_set("Asia/Kolkata");


        auth_check();
        //check_access();





        $this->load->model('M_users');
        $this->load->model('M_activities');
        $this->load->model('Common_model');




        /***
         * 
         * Common arrays
         * 
         * **/

        $this->data["sortBys"][0] = array(
            "sort_id" => 1,
            "sorting_by" => "Latest"
        );
        $this->data["sortBys"][1] = array(
            "sort_id" => 2,
            "sorting_by" => "Oldest"
        );





        if (empty($this->session->userdata()["menus"]))
            redirect(base_url() . 'admin/logout', 'refresh');

        $this->data['unallocated_menus'] = $this->session->userdata()['menus']['unallocated'];
        $this->data['allocated_menus'] = $this->session->userdata()['menus']['allocated'];

        // dd($this->data['allocated_menus']);

        $this->data['message_status'] = array(
            array('status_id' => 1, 'status' => 'Read'),
            array('status_id' => 2, 'status' => 'Unread')
        );

        $user_id = en_func(ss('user_id'), 'd');

        $this->data['menu_id'] = 1;
        $this->user_id = (int) en_func($this->session->userdata('user_id'), 'd');
    }


    public function addImage($image)
    {
        $config['upload_path'] = './uploads/news/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 4000;

        $ext = pathinfo($_FILES[$image]['name'], PATHINFO_EXTENSION);



        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($image)) {
            $msg['msg'] = $error = array('error' => $this->upload->display_errors());
            $msg["status"] = '500';
        } else {
            $msg['msg'] = $data = array('image_metadata' => $this->upload->data());
            $msg["status"] = '200';
            $msg["filename"] = $data['image_metadata']['file_name'];
        }
        //print_r($msg); exit();
        return $msg;
    }

    function add_activity_log($activity)
    {
        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');

        $data_insert = array(
            'activity' => $activity,
            'user_id' => $user_id,
            'created_at' => date("Y-m-d h:i:s"),
            'created_date' => date("Y-m-d")
        );
        $this->db->insert('activity_logs', $data_insert);
    }


    function response($status, $data)
    {
        header("HTTP/1.1 " . $status);

        $response['status'] = $status;
        $response['data'] = $data;

        $json_response = json_encode($response);
        echo $json_response;
        exit();
    }

    function check_encrypted($data_en, $data_val)
    {
        if ((int) en_func($data_en, 'd') < 1) {
            $data = array('status' => 'error', 'msg' => $data_val . ' is not defined');
            echo json_encode($data);
            exit();
        }
    }


    function check_exists($data_arr)
    {
        if (empty($data_arr))
            redirect_to_404();
    }

    function remove_p_tag($data)
    {
        $data = str_replace("<p>", "", $data);
        $data = str_replace("</p>", "", $data);
        return $data;
    }


    function upload_base64Images($imageData, $imagePath)
    {
        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');
        $im_data = $imageData;
        list($type, $im_data) = explode(';', $im_data);
        list(, $im_data)      = explode(',', $im_data);
        $im_data = base64_decode($im_data);
        $image_name = time() . '.jpeg';

        $bin = $im_data;
        $img_file = $imagePath . $image_name;
        // $im = imageCreateFromString($bin);
        // imagejpeg($im, $img_file, 80);
        $up_response = file_put_contents($imagePath . $image_name, $im_data);
        return $image_name;
    }


    function send_email($emailid, $message, $subject)
    {
        $this->load->library('email');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'localhost',
            'smtp_port' => 587,
            'smtp_user' => '',
            'smtp_pass' => '',
            'mailtype'   => 'html',
            'charset'   => 'iso-8859-1'
        );

        $this->email->initialize($config);


        $this->email->from('', '');


        $this->email->to($emailid);



        $this->email->subject($subject);

        $this->email->message($message);

        $mail_response =  $this->email->send();

        if ($mail_response) {
            return true;
            //echo "Success! - An email has been sent to " . $emailid;
        } else {
            //show_error($this->email->print_debugger());
            return false;
        }

        return $mail_response;
    }
}




/*
*
* Home page Class
*
*/


class US_Controller extends CI_Controller

{
    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');



        date_default_timezone_set("Asia/Kolkata");

        user_auth_check();

        $this->load->model('M_candidates');
        $this->load->model('Common_model');
        $this->load->model('M_site');


        $this->data = array();


        /***
         * 
         * Common arrays
         * 
         * **/

        //exit();
    }


    public function addImage($image)
    {
        $config['upload_path'] = './uploads/news/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 4000;

        $ext = pathinfo($_FILES[$image]['name'], PATHINFO_EXTENSION);



        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($image)) {
            $msg['msg'] = $error = array('error' => $this->upload->display_errors());
            $msg["status"] = '500';
        } else {
            $msg['msg'] = $data = array('image_metadata' => $this->upload->data());
            $msg["status"] = '200';
            $msg["filename"] = $data['image_metadata']['file_name'];
        }
        //print_r($msg); exit();
        return $msg;
    }

    function add_activity_log($activity)
    {
        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');

        $data_insert = array(
            'activity' => $activity,
            'user_id' => $user_id,
            'created_at' => date("Y-m-d h:i:s"),
            'created_date' => date("Y-m-d")
        );
        $this->db->insert('activity_logs', $data_insert);
    }


    function response($status, $data)
    {
        header("HTTP/1.1 " . $status);

        $response['status'] = $status;
        $response['data'] = $data;

        $json_response = json_encode($response);
        echo $json_response;
        exit();
    }

    function check_encrypted($data_en, $data_val)
    {
        if ((int) en_func($data_en, 'd') < 1) {
            $data = array('status' => 'error', 'msg' => $data_val . ' is not defined');
            echo json_encode($data);
            exit();
        }
    }


    function check_exists($data_arr)
    {
        if (empty($data_arr))
            redirect_to_404();
    }

    function check_id_real($id)
    {
        if ((int) en_func($id, 'd') < 1) {
            redirect_to_404();
        }
    }

    function remove_p_tag($data)
    {
        $data = str_replace("<p>", "", $data);
        $data = str_replace("</p>", "", $data);
        return $data;
    }


    function upload_base64Images($imageData, $imagePath)
    {
        $user_id = (int) en_func($this->session->userdata('user_id'), 'd');
        $im_data = $imageData;
        list($type, $im_data) = explode(';', $im_data);
        list(, $im_data)      = explode(',', $im_data);
        $im_data = base64_decode($im_data);
        $image_name = time() . '.jpeg';

        $bin = $im_data;
        $img_file = $imagePath . $image_name;
        $im = imageCreateFromString($bin);
        imagejpeg($im, $img_file, 80);
        // $up_response = file_put_contents($imagePath.$image_name, $im_data);
        return $image_name;
    }


    function send_email($emailid, $message, $subject)
    {
        $this->load->library('email');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'localhost',
            'smtp_port' => 587,
            'smtp_user' => '',
            'smtp_pass' => '',
            'mailtype'   => 'html',
            'charset'   => 'iso-8859-1'
        );

        $this->email->initialize($config);


        $this->email->from('', '');


        $this->email->to($emailid);



        $this->email->subject($subject);

        $this->email->message($message);

        $mail_response =  $this->email->send();

        if ($mail_response) {
            return true;
            //echo "Success! - An email has been sent to " . $emailid;
        } else {
            //show_error($this->email->print_debugger());
            return false;
        }

        return $mail_response;
    }
}
