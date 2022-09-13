<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_model extends CI_Model
{




    public function insert_table($data, $table)
    {
        $this->db->insert($table, $data);
		return $this->db->insert_id();
        //return $this->db->affected_rows();
    }

    public function update_table($data, $id, $table, $primary_key = 'id')
    {
        $multiplewhere = array($primary_key => $id);
        $this->db->set($data);
        $this->db->where($multiplewhere);
        $this->db->update($table);
        return $this->db->affected_rows();
    }
    

    public function delete_table($id, $table, $primary_key = 'id')
    {
        $data = array('status' => 3);
        $multiplewhere = array($primary_key => $id);
        $this->db->set($data);
        $this->db->where($multiplewhere);
        $this->db->update($table);
        return $this->db->affected_rows();
    }


	public function select_all($table, $status = 1){
		$multiplewhere = array(
		'status' => $status,
		);
		
		if($status == 0)
			unset($multiplewhere['status']);
	 
		$this->db->select('*');
		$this->db->where($multiplewhere);
		$this->db->order_by($table.'.updated_at', 'desc');

		return $this->db->get($table)->result();
	}

	public function select_single($table){
		$multiplewhere = array(
		'status' => 1,
		);
		
	 
		$this->db->select('*');
		$this->db->where($multiplewhere);
		return $this->db->get($table)->row();
	}

	
	public function select_by_id($table, $id, $primary_key ){
		$multiplewhere = array(
		$primary_key => $id,
		);
		
	 
		$this->db->select('*');
		$this->db->where($multiplewhere);
		return $this->db->get($table)->row();
	}


	public function get_counts($table,$status = 0){
		$multiplewhere = array(
		'status' => $status,
		);
		
	 
		$this->db->select('*');
		if($status > 0)
			$this->db->where($multiplewhere);
			
		return $this->db->get($table)->num_rows();
	}






	/*
	 * 
	 * 
	 * 
	 * 
	 */
	



	public function select_all_with_status($table,$status = 1){
		$multiplewhere = array(
		$table.'.status' => $status,
		);
		
	 
		$this->db->select($table.'.*, status.status as status_badge');
		$this->db->where($multiplewhere);
        $this->db->join('status', 'status.status_id = '.$table.'.status', 'left');
		$this->db->order_by($table.'.created_at', 'desc');

		return $this->db->get($table)->result();
	}





	
	/*
	 * 
	 * 
	 * 
	 * 
	 */
	
	public function select_status(){
		$multiplewhere = array(
		);
		
	 
		$this->db->select('*');
		$this->db->where($multiplewhere);
		return $this->db->get('status')->result();
	}
}
