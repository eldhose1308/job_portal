<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_permissions extends CI_Model
{



	public function insert_module($data)
	{
		$this->db->insert('modules', $data);
		return $this->db->affected_rows();
	}

	public function update_module($data, $module_id)
	{
		$multiplewhere = array('modules.module_id' => $module_id);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('modules');
		return $this->db->affected_rows();
	}


	public function select_modules_by_id($module_id)
	{
		$multiplewhere = array(
			'modules.module_id' => $module_id
		);


		$this->db->select('modules.*,modules_group.main_module_name');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		$this->db->join('modules_group', 'modules_group.mg_id = modules.parent_module', 'left');

		return $this->db->get('modules')->row();
	}

	public function module_lists($status)
	{
		$multiplewhere = array(
			'modules.status' => $status
		);


		$this->db->select('modules.*,modules_group.main_module_name');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		$this->db->join('modules_group', 'modules_group.mg_id = modules.parent_module', 'left');

		return $this->db->get('modules')->result();
	}

	public function get_users_list($client_id = 0)
	{
		$multiplewhere = array(
			'users.user_status' => 1,
			'users.user_type !=' => 1,
			'user_types.status' => 1
		);

		if ($client_id > 0)
			$multiplewhere = array('module_access.user_id' => $client_id, 'module_access.status' => 1);

		$this->db->select('users.full_name,users.user_name,users.user_email,users.user_id,user_types.user_type');
		$this->db->where($multiplewhere);
		$this->db->join('user_types', 'user_types.ut_id = users.user_type', 'left');
		return $this->db->get('users')->result();
	}

	public function get_usertype_of_user($user_id)
	{
		$multiplewhere = array(
			'users.user_status' => 1,
			'users.user_type !=' => 1,
			'user_types.status' => 1,
			'users.user_id' => $user_id
		);

		$this->db->select('user_types.user_type,user_types.ut_id');
		$this->db->where($multiplewhere);
		$this->db->join('user_types', 'user_types.ut_id = users.user_type', 'left');
		$result = $this->db->get('users')->row();

		if(!empty($result))
			return $result->ut_id;
		return 0;
		
	}

	public function all_modules()
	{
		$multiplewhere = array(
			'modules.status' => 1
		);


		$this->db->select('modules.module_id,modules.module_name,modules.module_url');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}

	public function all_modules_for_usertypes($ut_id)
	{
		$multiplewhere = array(
			'modules.status' => 1,
			'module_user_types.status' => 1,
			'module_user_types.user_type_id' => $ut_id
		);


		$this->db->select('modules.module_id,modules.module_name,modules.module_url');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		$this->db->join('module_user_types', 'module_user_types.module_id = modules.module_id', 'left');
		return $this->db->get('modules')->result();
	}


	public function all_modules_allocated($mg_id)
	{
		$multiplewhere = array(
			'modules.status' => 1,
			'modules.parent_module' => $mg_id
		);

		$this->db->select('modules.*');
		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}

	public function all_modules_unallocated()
	{
		$multiplewhere = array(
			'modules.status' => 1,
			'modules.parent_module ' => 0
		);

		$this->db->select('modules.*');
		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}


	public function grouped_modules_by_id($mg_id)
	{
		$multiplewhere = array(
			'modules_group.status' => 1,
			'modules_group.mg_id' => $mg_id
		);

		$this->db->select('modules_group.*');
		$this->db->where($multiplewhere);
		return $this->db->get('modules_group')->row();
	}

	public function all_grouped_modules()
	{
		$multiplewhere = array(
			'modules_group.status' => 1
		);

		$this->db->select('modules_group.*');
		$this->db->where($multiplewhere);
		return $this->db->get('modules_group')->result();
	}

	public function modules_allocated($user_id)
	{
		$multiplewhere = array(
			'modules.status' => 1,
			'module_access.status' => 1,
			'module_access.user_id' => $user_id
		);


		$this->db->select('modules.module_id,modules.module_name,modules.module_url');
		$this->db->distinct();
		$this->db->join('module_access', 'module_access.module_id = modules.module_id', 'left');
		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}

	public function main_modules_list()
	{
		$multiplewhere = array(
			'modules_group.status' => 1
		);


		$this->db->select('modules_group.mg_id,modules_group.main_module_name,
		modules_group.module_group_label,modules_group.updated_at');
		$this->db->where($multiplewhere);
		return $this->db->get('modules_group')->result();
	}

	public function get_sub_modules_by_group($module_ids)
	{
		$multiplewhere = array(
			'modules.status' => 1
		);


		$this->db->select('modules.*');
		$this->db->where($multiplewhere);
		$this->db->where_in('modules.module_id', $module_ids);
		return $this->db->get('modules')->result();
	}

	public function list_modules_access_usertype($module_id, $ut_id)
	{
		$module_id = (int) en_func($module_id, 'd');
		$ut_id = (int) en_func($ut_id, 'd');

		$multiplewhere = array(
			'module_user_types.module_id' => $module_id,
			'module_user_types.user_type_id' => $ut_id
		);


		$this->db->select('module_user_types.status');
		$this->db->where($multiplewhere);
		return $this->db->get('module_user_types')->row();
	}

	public function list_modules_access($module_id, $user_id)
	{
		$module_id = (int) en_func($module_id, 'd');
		$user_id = (int) en_func($user_id, 'd');

		$multiplewhere = array(
			'module_access.module_id' => $module_id,
			'module_access.user_id' => $user_id
		);


		$this->db->select('module_access.status');
		$this->db->where($multiplewhere);
		return $this->db->get('module_access')->row();
	}

	public function check_module_access_exists($user_id, $module_id)
	{
		$multiplewhere = array('module_access.module_id' => $module_id, 'module_access.user_id' => $user_id);
		$this->db->select('status');
		$this->db->where($multiplewhere);
		return $this->db->get('module_access')->num_rows();
	}

	public function check_module_access_exists_usertype($ut_id, $module_id)
	{
		$multiplewhere = array('module_user_types.module_id' => $module_id, 'module_user_types.user_type_id' => $ut_id);
		$this->db->select('status');
		$this->db->where($multiplewhere);
		return $this->db->get('module_user_types')->num_rows();
	}

	public function add_modules_to_groups($module_id, $main_module_id)
	{

		$data = array('parent_module' => $main_module_id);
		$multiplewhere = array('modules.module_id' => $module_id);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('modules');
		return $this->db->affected_rows();
	}

	public function change_permission_status($data_insert, $status)
	{

		$data = array('status' => $status);
		$multiplewhere = array('module_access.module_id' => $data_insert['module_id'], 'module_access.user_id' => $data_insert['user_id']);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('module_access');
		return $this->db->affected_rows();
	}

	public function change_permission_status_usertype($data_insert, $status)
	{

		$data = array('status' => $status);
		$multiplewhere = array('module_user_types.module_id' => $data_insert['module_id'], 'module_user_types.user_type_id' => $data_insert['user_type_id']);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('module_user_types');
		return $this->db->affected_rows();
	}


	public function remove_modules_from_group($id)
	{
		$data['parent_module'] = 0;
		$this->db->where('module_id', $id);
		$result = $this->db->update('modules', $data);
		return $this->db->affected_rows();
	}

	public function update_module_group($data, $id)
	{
		$this->db->where('mg_id', $id);
		$result = $this->db->update('modules_group', $data);
		return $this->db->affected_rows();
	}

	public function insert_module_permission($data)
	{
		$this->db->insert('module_access', $data);
		return $this->db->affected_rows();
	}
	public function insert_module_permission_usertype($data)
	{
		$this->db->insert('module_user_types', $data);
		return $this->db->affected_rows();
	}
	public function add_module_group($data)
	{
		$this->db->insert('modules_group', $data);
		return $this->db->affected_rows();
	}
}
