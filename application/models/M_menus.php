<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menus extends CI_Model
{



	public function get_submenus_list($status, $tm_id = 0)
	{
		$multiplewhere = array(
			'ci_main_menu.status' => $status,
			'ci_main_menu.top_menu' => $tm_id
		);

		if ($tm_id == 0)
			unset($multiplewhere['ci_main_menu.top_menu']);

		$this->db->select('ci_main_menu.*,ci_top_menu.top_menu_name');
		$this->db->where($multiplewhere);
		$this->db->join('ci_top_menu', 'ci_top_menu.tm_id   = ci_main_menu.top_menu ', 'left');

		return $this->db->get('ci_main_menu')->result();
	}


	public function select_submenus_by_id($mm_id)
	{
		$multiplewhere = array(
			'ci_main_menu.mm_id' => $mm_id
		);


		$this->db->select('ci_main_menu.*,ci_top_menu.top_menu_name');
		$this->db->where($multiplewhere);
		$this->db->join('ci_top_menu', 'ci_top_menu.tm_id   = ci_main_menu.top_menu ', 'left');

		return $this->db->get('ci_main_menu')->row();
	}



	public function get_topmenus_list($status = 1)
	{
		$multiplewhere = array(
			'ci_top_menu.status' => $status
		);


		$this->db->select('ci_top_menu.*');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_top_menu')->result();
	}



	public function select_topmenu_by_id($tm_id)
	{
		$multiplewhere = array(
			'ci_top_menu.tm_id' => $tm_id
		);


		$this->db->select('ci_top_menu.*');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_top_menu')->row();
	}
}
