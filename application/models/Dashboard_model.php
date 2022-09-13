<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{




	public function get_contact_messages()
	{

		$this->db->select('ci_contact_messages.*,status.status as status_badge');
		$this->db->order_by('ci_contact_messages.message_id', 'desc');
		$this->db->limit(20);
		$this->db->where('ci_contact_messages.status !=',3);
		$this->db->join('status', 'status.status_id = ci_contact_messages.status', 'left');

		return $this->db->get('ci_contact_messages')->result();
	}



	public function get_contact_message_counts()
	{
		$this->db->select('ci_contact_messages.*,status.status as status_badge');
		$this->db->order_by('ci_contact_messages.message_id', 'desc');
		$this->db->join('status', 'status.status_id = ci_contact_messages.status', 'left');

		return $this->db->get('ci_contact_messages')->result();
	}



	public function get_recent_activity($user_id, $user_type = 0,$limit = 0)
	{

		$this->db->select('activity_logs.activity,activity_logs.created_date,activity_logs.created_at,users.user_name,users.full_name');
		$this->db->order_by('activity_logs.id', 'desc');
		$this->db->join('users', 'users.user_id = activity_logs.user_id', 'left');

		if ($user_type != 1)
			$this->db->where('users.user_id',$user_id);


		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('activity_logs')->result();
	}



	public function get_visitors_count()
	{
		$this->db->select('visitors.*');
		//$this->db->where('visitors.visited_date',date("Y-m-d"));
		$this->db->order_by('visitors.visited_date', 'desc');
		return $this->db->get('visitors')->num_rows();
	}



	public function get_visitors_traffic($limit = 0)
	{
		$this->db->select('visitors.*,COUNT(id) as visit_count');
		$this->db->group_by('visitors.visited_date');
		$this->db->order_by('visitors.visited_date', 'desc');

		
		if ($limit > 0)
			$this->db->limit($limit);

		return $this->db->get('visitors')->result();
	}



	public function get_visitors_list($visited_date = 0)
	{
		$this->db->select('visitors.*');

		if (strtotime($visited_date) !== false)
			$this->db->where('visitors.visited_date', $visited_date);


		$this->db->order_by('visitors.visited_date', 'desc');
		return $this->db->get('visitors')->result();
	}
}
