<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_candidates extends CI_Model
{



	public function get_users_list($status = 1)
	{
		$multiplewhere = array(
			'users.user_status' => $status,
			'users.user_type !=' => 1,
			'user_types.status' => 1
		);

		$this->db->select('users.full_name,users.user_name,users.user_email,users.user_id,user_types.user_type');
		$this->db->where($multiplewhere);
		$this->db->join('user_types', 'user_types.ut_id = users.user_type', 'left');
		return $this->db->get('users')->result();
	}



	public function select_candidate_by_id($candidate_id)
	{
		$multiplewhere = array(
			'ci_candidates.status' => 1,
			'ci_candidates.user_id' => $candidate_id
		);

	

		$this->db->select('ci_candidates.*');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_candidates')->row();
	}



	public function get_userstypes_list()
	{
		$multiplewhere = array(
			'user_types.status' => 1,
			'user_types.ut_id !=' => 1
		);


		$this->db->select('user_types.*');
		$this->db->where($multiplewhere);
		return $this->db->get('user_types')->result();
	}

	public function select_usertypes_by_id($ut_id)
	{
		$multiplewhere = array(
			'user_types.status' => 1,
			'user_types.ut_id' => $ut_id,
			'user_types.ut_id !=' => 1
		);


		$this->db->select('user_types.*');
		$this->db->where($multiplewhere);
		return $this->db->get('user_types')->row();
	}



	public function insert_usertype($data)
	{
		$this->db->insert('user_types', $data);
		return $this->db->affected_rows();
	}

	public function update_usertype($data, $ut_id)
	{
		$multiplewhere = array('user_types.ut_id' => $ut_id);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('user_types');
		return $this->db->affected_rows();
	}

	public function save_registration($data)
	{
		$this->db->insert('users', $data);
		return $this->db->affected_rows();
	}

	public function update_registration($data, $user_id)
	{
		$multiplewhere = array('users.user_id' => $user_id);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('users');
		return $this->db->affected_rows();
	}

	public function add_user_log($data)
	{
		$this->db->insert('user_logs', $data);
		return $this->db->affected_rows();
	}

	public function add_patients_log($data)
	{
		$this->db->insert('patients_logs', $data);
		return $this->db->affected_rows();
	}

	public function add_failed_user_log($data)
	{
		$this->db->insert('user_logs_failed', $data);
		return $this->db->affected_rows();
	}

	public function add_failed_patients_log($data)
	{
		$this->db->insert('patients_logs_failed', $data);
		return $this->db->affected_rows();
	}

	public function login($user, $pass)
	{
		$this->db->select('users.*');
		$this->db->from('users');
		$this->db->where('users.user_email', $user);
		$this->db->where('users.user_password', md5($pass));
		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}

	public function candidate_login($user, $pass)
	{
		$this->db->select('ci_candidates.*');
		$this->db->from('ci_candidates');
		$this->db->where('ci_candidates.user_email', $user);
		$this->db->where('ci_candidates.user_password', md5($pass));
		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}


	public function candidate_google_login($user, $pass)
	{
		$this->db->select('ci_candidates.*');
		$this->db->from('ci_candidates');
		$this->db->where('ci_candidates.user_email', $user);
		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}


	public function check_candidate_exists($user)
	{
		$this->db->select('ci_candidates.*');
		$this->db->from('ci_candidates');
		$this->db->where('ci_candidates.user_email', $user);
		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}

	public function updatetoken($token, $adminid)
	{
		$data = array('user_token' => $token);
		$this->db->where('user_id', $adminid);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}

	public function checktoken($token)
	{
		$data = array('user_token' => $token);
		$this->db->select('users.*');
		$this->db->from('users');
		$this->db->where($data);
		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}

	public function get_login_history($user_id, $login_date = 0)
	{
		$multiplewhere = array(
			'user_logs.user_id' => $user_id
		);
		if (strtotime($login_date) !== false)
			$multiplewhere['DATE(user_logs.login_time)'] = $login_date;

		$this->db->select('user_logs.*');
		$this->db->where($multiplewhere);
		$this->db->order_by("user_logs.login_time", "desc");
		return $this->db->get('user_logs')->result_array();
	}

	public function get_failed_login_history($login_date = 0)
	{
		$multiplewhere = array();

		if (strtotime($login_date) !== false)
			$multiplewhere['DATE(user_logs_failed.login_time)'] = $login_date;

		$this->db->select('user_logs_failed.*');
		$this->db->where($multiplewhere);
		$this->db->order_by("user_logs_failed.login_time", "desc");
		return $this->db->get('user_logs_failed')->result_array();
	}
	/* ***********************************
	 * 
	 * Start of Password Section
	 * 
	 * ***********************************/
	public function check_password($password, $user_id)
	{
		$result = $this->db->get_where('users', array('user_id' => $user_id, 'user_password' => $password));
		return $this->db->affected_rows();
	}
	public function check_patient_password($password, $patient_id)
	{
		$result = $this->db->get_where('ci_patients', array('patient_id' => $patient_id, 'user_password' => $password));
		return $this->db->affected_rows();
	}

	public function update_patient_password($password, $id)
	{
		$this->db->set('user_password', $password);
		$this->db->where('patient_id', $id);
		$result = $this->db->update('ci_patients');
		return $this->db->affected_rows();
	}

	public function update_password($password, $id)
	{
		$this->db->set('user_password', $password);
		$this->db->where('user_id', $id);
		$result = $this->db->update('users');
		return $this->db->affected_rows();
	}

	public function update_profile($data, $id)
	{
		$this->db->where('user_id', $id);
		$result = $this->db->update('ci_candidates', $data);
		return $this->db->affected_rows();
	}

	public function update_patient_profile($data, $id)
	{
		$this->db->where('user_id', $id);
		$result = $this->db->update('ci_candidates', $data);
		return $this->db->affected_rows();
	}

	public function update_photo($image, $id)
	{
		$this->db->set('user_photo', $image);
		$this->db->where('user_id', $id);
		$this->db->update('users');
		return $this->db->affected_rows();
	}


	/* ***********************************
	 * 
	 * End of Password Section
	 * 
	 * ***********************************/


	public function modules_allocated($user_id = 0)
	{
		$multiplewhere = array(
			'modules.status' => 1
		);

		if ($user_id > 0)
			$multiplewhere = array(
				'module_access.user_id' => $user_id,
				'module_access.status' => 1
			);

		$this->db->select('modules.module_id,modules.module_name,modules.module_url,modules.parent_module');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		$this->db->join('modules', 'modules.module_id = module_access.module_id', 'left');
		return $this->db->get('module_access')->result();
	}


	public function unallocated_sub_modules($user_id = 0)
	{
		$ut_id = $this->session->userdata('user_type_display');
		$multiplewhere = array(
			'modules.status' => 1,
			'modules.parent_module' => 0,
			'module_access.status' => 1,
			'module_user_types.status' => 1,
			'module_user_types.user_type_id' => $ut_id

		);

		if ($user_id > 0)
			$multiplewhere['module_access.user_id'] = $user_id;

		$this->db->select('modules.module_id,modules.module_name,modules.module_url,modules.module_label');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		$this->db->join('modules', 'modules.module_id = module_access.module_id', 'left');
		$this->db->join('module_user_types', 'module_user_types.module_id = modules.module_id', 'left');
		return $this->db->get('module_access')->result();
	}

	public function all_parent_modules()
	{
		$multiplewhere = array(
			'modules_group.status' => 1
		);


		$this->db->select('modules_group.mg_id, modules_group.main_module_name, modules_group.module_group_label');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		return $this->db->get('modules_group')->result();
	}

	public function all_sub_modules_of_parent($mg_id)
	{
		$ut_id = $this->session->userdata('user_type_display');

		$multiplewhere = array(
			'modules.status' => 1,
			'modules.parent_module' => $mg_id
		);

		if (en_func($this->session->userdata('user_id'), 'd') > 1) {
			$multiplewhere['module_access.user_id'] = en_func($this->session->userdata('user_id'), 'd');
			$multiplewhere['module_access.status'] = 1;
			$multiplewhere['module_user_types.user_type_id'] = $ut_id;
			$multiplewhere['module_user_types.status'] = 1;
		}


		$this->db->select('modules.module_id,modules.module_name,modules.module_url');
		$this->db->distinct();
		if (en_func($this->session->userdata('user_id'), 'd') > 1)
			$this->db->join('module_access', 'module_access.module_id = modules.module_id');

		$this->db->join('module_user_types', 'module_user_types.module_id = modules.module_id', 'left');

		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}

	public function all_unallocated_sub_modules()
	{
		$multiplewhere = array(
			'modules.status' => 1,
			'modules.parent_module' => 0
		);


		$this->db->select('modules.module_id,modules.module_name,modules.module_url,modules.module_label');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}

	public function all_modules()
	{
		$multiplewhere = array(
			'modules.status' => 1
		);


		$this->db->select('modules.module_id,modules.module_name,modules.module_url,modules.parent_module');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}






	


    /***************
     * 
     * 
     * 
     * Admin Models
     * 
     * 
     */


    function select_all_candidates_count($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0)
    {
        $where = array(
            'ci_candidates.status' => '1'
        );

        if ($posted_date > 0) {
            $where['ci_candidates.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $where['ci_candidates.created_at <='] = date('Y-m-d');
        }



        if ($query != '') {
			$this->db->or_like('full_name', $query);
            $this->db->or_like('user_email', $query);
            $this->db->or_like('user_mobile', $query);
        }

        $this->db->where($where);

        $query = $this->db->get("ci_candidates");
        return $query->num_rows();
    }



    public function select_all_candidates($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0)
    {
        $multiplewhere = array(
            'ci_candidates.status' => 1
        );

        if ($posted_date > 0) {
            $multiplewhere['ci_candidates.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $multiplewhere['ci_candidates.created_at <='] = date('Y-m-d');
        }

     

        if ($query != '') {
            $this->db->or_like('full_name', $query);
            $this->db->or_like('user_email', $query);
            $this->db->or_like('user_mobile', $query);
        }

        $this->db->select('ci_candidates.*');
        $this->db->where($multiplewhere);
      
        $this->db->limit($limit, $start);

        if ($sortby == "desc")
            $this->db->order_by("ci_candidates.user_id", "desc");
        else
            $this->db->order_by("ci_candidates.user_id", "asc");


        return $this->db->get('ci_candidates')->result();
    }
}
