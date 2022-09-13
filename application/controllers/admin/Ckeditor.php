<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ckeditor extends MY_Controller {

    public function upload_image(){
       // echo "Helloo";
        if(isset($_FILES['upload']['name']))
        {
            $file = $_FILES['upload']['tmp_name'];
            $file_name = $_FILES['upload']['name'];
            $file_name_array = explode(".", $file_name);
            $extension = end($file_name_array);
            $new_image_name = rand() . '.' . $extension;
            $allowed_extension = array("jpg","jpeg" ,"gif", "png", "webp");
         
            if(in_array($extension, $allowed_extension))
                {
                    move_uploaded_file($file, 'uploads/file_contents/' . $new_image_name);
                    $function_number = $_GET['CKEditorFuncNum'];
                    $url = base_url().'uploads/file_contents/' . $new_image_name;
                    $message = 'Uploaded ' . $file_name;
                    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
                }
                else{
                    echo "Invalid Format";
                }
        }
    }

    public function upp(){
        $config['upload_path'] = './uploads/contents/';
        $config['allowed_types'] = 'pdf|jpeg|png';
        $config['max_size'] = 5000;
        //$config['max_width'] = 1500;
        //$config['max_height'] = 1500;
        //$new_file_name = time().remove_whitespace($_FILES["filepond"]['name']);
        //$config['file_name'] = $new_file_name;

        $this->load->library('upload', $config);
		if (!$this->upload->do_upload('filepond')) {
           // $this->session->set_flashdata('errors', 'Failed to add Pdf');

            $error = array('error' => $this->upload->display_errors());
            $msg["status"] = "500";
            $msg["msg"] = "Error";
            // print_r($error);
			//return $error;
        } else {
          //  $this->session->set_flashdata('success', 'Pdf has been added successfully!');
             

            $data =  $this->upload->data();
          //  $file_name = $upload_data['file_name'];
            $msg["status"] = "200";
            $msg["msg"] = "Success";           
            $msg["filename"] = $data['file_name'];

        }

        echo json_encode($msg);
    }
}
?>
