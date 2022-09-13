<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_activities extends CI_Model {

   

	public function get_activity_list($user_id = 0){
		$user_type = ($this->session->userdata('user_type_display'));

		$multiplewhere = array(
		);
	
        if($user_id > 0)
            $multiplewhere['activity_logs.user_id'] = $user_id;
	 
		$this->db->select('activity_logs.*,users.full_name');
		$this->db->where($multiplewhere);
        $this->db->join('users','users.user_id  = activity_logs.user_id ','left');
		$this->db->order_by('activity_logs.id', 'desc');

		return $this->db->get('activity_logs')->result();
	}

	
    public function get_users_list($user_type_display = 0){
        $user_id = (int)en_func($this->session->userdata('user_id'),'d');

		$multiplewhere = array(
		'users.user_status' => 1,
		'user_types.status' => 1
		);
		
	 	if($user_type_display != 1)
			$multiplewhere = array('users.user_id' => $user_id);

		$this->db->select('users.full_name,users.user_name,users.user_email,users.user_id,user_types.user_type');
		$this->db->where($multiplewhere);
		$this->db->join('user_types','user_types.ut_id = users.user_type','left');
		return $this->db->get('users')->result();
	}

    public function insert_about_us($data){
        $this->db->insert('ci_about_us',$data);		
        return $this->db->affected_rows();
    }

    public function update_about_us($data,$id){
        $multiplewhere = array('ci_about_us.about_id' => $id);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('ci_about_us');
		return $this->db->affected_rows();

    }    
    
    public function delete_gallery($id){
        $data = array('status' => 3);
        $multiplewhere = array('ci_gallery.gallery_id' => $id);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('ci_gallery');
		return $this->db->affected_rows();

    }
}