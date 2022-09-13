<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_site extends CI_Model {

   

	public function get_site_details(){
		$multiplewhere = array(
		'site_settings.status' => 1,
		);
		
	 
		$this->db->select('site_settings.*');
		$this->db->where($multiplewhere);
		return $this->db->get('site_settings')->row();
	}

	

	public function get_socialmedialinks_details(){
		$multiplewhere = array(
		'ci_social_media.status' => 1,
		);
		
	 
		$this->db->select('ci_social_media.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_social_media.sort_order','asc');
		return $this->db->get('ci_social_media')->result();
	}


	public function get_quicklinks_details(){
		$multiplewhere = array(
		'ci_quick_links.status' => 1,
		);
		
	 
		$this->db->select('ci_quick_links.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_quick_links.sort_order','asc');
		return $this->db->get('ci_quick_links')->result();
	}



	public function get_top_menu(){
		$multiplewhere = array(
		'ci_top_menu.status' => 1,
		);
		
	 
		$this->db->select('ci_top_menu.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_top_menu.sort_order','asc');
		return $this->db->get('ci_top_menu')->result();
	}



	public function select_sub_menu($tm_id){
		$multiplewhere = array(
		'ci_main_menu.status' => 1,
		'ci_main_menu.top_menu' => $tm_id,
		);
		
	 
		$this->db->select('ci_main_menu.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_main_menu.sort_order','asc');
		return $this->db->get('ci_main_menu')->result();
	}

	public function select_subsub_menu($mm_id){
		$multiplewhere = array(
		'ci_sub_menu.status' => 1,
		'ci_sub_menu.main_menu' => $mm_id,
		);
		
	 
		$this->db->select('ci_sub_menu.*');
		$this->db->where($multiplewhere);
		$this->db->order_by('ci_sub_menu.sort_order','asc');
		return $this->db->get('ci_sub_menu')->result();
	}


    public function insert_about_us($data){
        $this->db->insert('site_settings',$data);		
        return $this->db->affected_rows();
    }

    public function update_about_us($data,$id){
        $multiplewhere = array('site_settings.site_id' => $id);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('site_settings');
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