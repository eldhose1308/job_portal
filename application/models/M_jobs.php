<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jobs extends CI_Model
{


    /*
     * 
     * 
     * Count for Pagination
     * 
     * 
     */
    function select_all_jobs_count($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0, $salary = 0, $experience = 0)
    {
        $where = array(
            'ci_jobs.status' => '1'
        );

        if ($posted_date > 0) {
            $where['ci_jobs.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $where['ci_jobs.created_at <='] = date('Y-m-d');
        }

        if ($job_location > 0)
            $where['ci_jobs.job_location'] = $job_location;

        if ($salary > 0) {
            $where['ci_jobs.min_salary <='] = $salary;
            $where['ci_jobs.max_salary >='] = $salary;
        }


        if ($experience > 0) {
            $where['ci_jobs.min_experience <='] = $experience;
            $where['ci_jobs.max_experience >='] = $experience;
        }


        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->select('ci_jobs.*,ci_countries.country_name,ci_jobs_wishlist.candidate_id as wishlist_candidate,ci_jobs_apply.candidate_id as applied_candidate,ci_jobs_wishlist.job_id as wishlist,ci_jobs_apply.job_id as applied');
        $this->db->where($where);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_wishlist', 'ci_jobs_wishlist.job_id  = ci_jobs.job_id', 'left');
        $this->db->join('ci_jobs_apply', 'ci_jobs_apply.job_id  = ci_jobs.job_id', 'left');

        if ($sortby == "desc")
            $this->db->order_by("ci_jobs.job_id", "desc");
        else
            $this->db->order_by("ci_jobs.job_id", "asc");

        $query = $this->db->get("ci_jobs");
        return $query->num_rows();
    }



    public function select_all_jobs_users($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0, $salary = 0, $experience = 0)
    {
        $multiplewhere = array(
            'ci_jobs.status' => 1
        );

        if ($posted_date > 0) {
            $multiplewhere['ci_jobs.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $multiplewhere['ci_jobs.created_at <='] = date('Y-m-d');
        }

        if ($job_location > 0)
            $multiplewhere['ci_jobs.job_location'] = $job_location;

        if ($salary > 0) {
            $multiplewhere['ci_jobs.min_salary <='] = $salary;
            $multiplewhere['ci_jobs.max_salary >='] = $salary;
        }


        if ($experience > 0) {
            $multiplewhere['ci_jobs.min_experience <='] = $experience;
            $multiplewhere['ci_jobs.max_experience >='] = $experience;
        }

        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->select('ci_jobs.*,ci_countries.country_name,ci_jobs_wishlist.candidate_id as wishlist_candidate,ci_jobs_apply.candidate_id as applied_candidate,ci_jobs_wishlist.job_id as wishlist,ci_jobs_apply.job_id as applied');
        $this->db->where($multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_wishlist', 'ci_jobs_wishlist.job_id  = ci_jobs.job_id', 'left');
        $this->db->join('ci_jobs_apply', 'ci_jobs_apply.job_id  = ci_jobs.job_id', 'left');
        $this->db->limit($limit, $start);

        if ($sortby == "desc")
            $this->db->order_by("ci_jobs.job_id", "desc");
        else
            $this->db->order_by("ci_jobs.job_id", "asc");


        return $this->db->get('ci_jobs')->result();
    }



    /**
     * 
     * 
     * 
     */


    function select_saved_jobs_count($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0, $salary = 0, $experience = 0)
    {
        $where = array(
            'ci_jobs.status' => '1'
        );

        if ($posted_date > 0) {
            $where['ci_jobs.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $where['ci_jobs.created_at <='] = date('Y-m-d');
        }

        if ($job_location > 0)
            $where['ci_jobs.job_location'] = $job_location;

        if ($salary > 0) {
            $where['ci_jobs.min_salary <='] = $salary;
            $where['ci_jobs.max_salary >='] = $salary;
        }


        if ($experience > 0) {
            $where['ci_jobs.min_experience <='] = $experience;
            $where['ci_jobs.max_experience >='] = $experience;
        }


        if ($this->session->has_userdata('user_login_status')) {
            $or_multiplewhere['ci_jobs_wishlist.candidate_id'] = (int) en_func($this->session->userdata('user_id'), 'd');
        }

        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->where($where);
        $this->db->where($or_multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_wishlist', 'ci_jobs_wishlist.job_id  = ci_jobs.job_id', 'left');


        $query = $this->db->get("ci_jobs");
        return $query->num_rows();
    }

    public function select_all_saved_jobs_users($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0, $salary = 0, $experience = 0)
    {
        $multiplewhere = array(
            'ci_jobs.status' => 1
        );

        if ($posted_date > 0) {
            $multiplewhere['ci_jobs.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $multiplewhere['ci_jobs.created_at <='] = date('Y-m-d');
        }

        if ($job_location > 0)
            $multiplewhere['ci_jobs.job_location'] = $job_location;

        if ($salary > 0) {
            $multiplewhere['ci_jobs.min_salary <='] = $salary;
            $multiplewhere['ci_jobs.max_salary >='] = $salary;
        }


        if ($experience > 0) {
            $multiplewhere['ci_jobs.min_experience <='] = $experience;
            $multiplewhere['ci_jobs.max_experience >='] = $experience;
        }


        if ($this->session->has_userdata('user_login_status')) {
            $or_multiplewhere['ci_jobs_wishlist.candidate_id'] = (int) en_func($this->session->userdata('user_id'), 'd');
        }

        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->select('ci_jobs.*,ci_countries.country_name,ci_jobs_wishlist.job_id as wishlist');
        $this->db->where($multiplewhere);
        $this->db->where($or_multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_wishlist', 'ci_jobs_wishlist.job_id  = ci_jobs.job_id', 'left');
        $this->db->limit($limit, $start);

        if ($sortby == "desc")
            $this->db->order_by("ci_jobs.job_id", "desc");
        else
            $this->db->order_by("ci_jobs.job_id", "asc");


        return $this->db->get('ci_jobs')->result();
    }



    /***
     * 
     * 
     * 
     */


    function select_applied_jobs_count_dashboard($job_status = 0)
    {
        $where = array(
            'ci_jobs.status' => '1'
        );

        if ($job_status > 0)
            $where['ci_jobs_apply.job_status'] = $job_status;



        if ($this->session->has_userdata('user_login_status')) {
            $or_multiplewhere['ci_jobs_apply.candidate_id'] = (int) en_func($this->session->userdata('user_id'), 'd');
        }


        $this->db->where($where);
        $this->db->where($or_multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_apply', 'ci_jobs_apply.job_id  = ci_jobs.job_id', 'left');

        $query = $this->db->get("ci_jobs");
        return $query->num_rows();
    }




    function select_applied_jobs_count($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $job_status = 0, $posted_date = 0, $job_location = 0, $salary = 0, $experience = 0)
    {
        $where = array(
            'ci_jobs.status' => '1'
        );

        if ($posted_date > 0) {
            $where['ci_jobs.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $where['ci_jobs.created_at <='] = date('Y-m-d');
        }

        if ($job_status > 0)
            $where['ci_jobs_apply.job_status'] = $job_status;


        if ($job_location > 0)
            $where['ci_jobs.job_location'] = $job_location;

        if ($salary > 0) {
            $where['ci_jobs.min_salary <='] = $salary;
            $where['ci_jobs.max_salary >='] = $salary;
        }


        if ($experience > 0) {
            $where['ci_jobs.min_experience <='] = $experience;
            $where['ci_jobs.max_experience >='] = $experience;
        }

        if ($this->session->has_userdata('user_login_status')) {
            $or_multiplewhere['ci_jobs_apply.candidate_id'] = (int) en_func($this->session->userdata('user_id'), 'd');
        }

        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->where($where);
        $this->db->where($or_multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_apply', 'ci_jobs_apply.job_id  = ci_jobs.job_id', 'left');


        $query = $this->db->get("ci_jobs");
        return $query->num_rows();
    }

    public function select_all_applied_jobs_users($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $job_status = 0, $posted_date = 0, $job_location = 0, $salary = 0, $experience = 0)
    {
        $multiplewhere = array(
            'ci_jobs.status' => 1
        );

        if ($posted_date > 0) {
            $multiplewhere['ci_jobs.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $multiplewhere['ci_jobs.created_at <='] = date('Y-m-d');
        }

        if ($job_location > 0)
            $multiplewhere['ci_jobs.job_location'] = $job_location;


        if ($job_status > 0)
            $multiplewhere['ci_jobs_apply.job_status'] = $job_status;


        if ($salary > 0) {
            $multiplewhere['ci_jobs.min_salary <='] = $salary;
            $multiplewhere['ci_jobs.max_salary >='] = $salary;
        }


        if ($experience > 0) {
            $multiplewhere['ci_jobs.min_experience <='] = $experience;
            $multiplewhere['ci_jobs.max_experience >='] = $experience;
        }

        if ($this->session->has_userdata('user_login_status')) {
            $or_multiplewhere['ci_jobs_apply.candidate_id'] = (int) en_func($this->session->userdata('user_id'), 'd');
        }

        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->select('ci_jobs.*,ci_countries.country_name,ci_job_status.status_name,ci_jobs_apply.job_status,ci_jobs_apply.job_id as applied');
        $this->db->where($multiplewhere);
        $this->db->where($or_multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_apply', 'ci_jobs_apply.job_id  = ci_jobs.job_id', 'left');
        $this->db->join('ci_job_status', 'ci_job_status.status_id  = ci_jobs_apply.job_status', 'left');
        $this->db->limit($limit, $start);

        if ($sortby == "desc")
            $this->db->order_by("ci_jobs.job_id", "desc");
        else
            $this->db->order_by("ci_jobs.job_id", "asc");


        return $this->db->get('ci_jobs')->result();
    }



    public function select_all_jobs($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc")
    {
        $multiplewhere = array(
            'ci_jobs.status' => 1
        );


        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->select('ci_jobs.*,ci_countries.country_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_wishlist', 'ci_jobs_wishlist.job_id  = ci_jobs.job_id', 'left');
        $this->db->limit($limit, $start);

        if ($sortby == "desc")
            $this->db->order_by("ci_jobs.job_id", "desc");
        else
            $this->db->order_by("ci_jobs.job_id", "asc");


        return $this->db->get('ci_jobs')->result();
    }


    public function add_job_to_wishlist($data)
    {
        $this->db->insert('ci_jobs_wishlist', $data);
        return $this->db->affected_rows();
    }


    public function remove_job_from_wishlist($job_id, $candidate_id)
    {
        $multiplewhere = array('ci_jobs_wishlist.job_id' => $job_id, 'ci_jobs_wishlist.candidate_id' => $candidate_id);
        $this->db->where($multiplewhere);
        $this->db->delete('ci_jobs_wishlist');
        return $this->db->affected_rows();
    }



    public function remove_job_application($job_id, $candidate_id)
    {
        $multiplewhere = array('ci_jobs_apply.job_id' => $job_id, 'ci_jobs_apply.candidate_id' => $candidate_id);
        $this->db->where($multiplewhere);
        $this->db->delete('ci_jobs_apply');
        return $this->db->affected_rows();
    }






    public function select_applied_job($job_id, $candidate_id)
    {
        $this->db->select('ci_jobs_apply.*');
        $this->db->from('ci_jobs_apply');
        $this->db->where('ci_jobs_apply.job_id', $job_id);
        $this->db->where('ci_jobs_apply.candidate_id', $candidate_id);
        $data = $this->db->get();

        if ($data->num_rows() == 1) {
            return $data->row();
        } else {
            return false;
        }
    }













    /***************
     * 
     * 
     * 
     * Admin Models
     * 
     * 
     */


    function select_all_applied_jobs_count($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0)
    {
        $where = array(
            'ci_jobs.status' => '1'
        );

        if ($posted_date > 0) {
            $where['ci_jobs.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $where['ci_jobs.created_at <='] = date('Y-m-d');
        }

        if ($job_location > 0)
            $where['ci_jobs.job_location'] = $job_location;



        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->where($where);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_apply', 'ci_jobs_apply.job_id  = ci_jobs.job_id', 'left');


        $query = $this->db->get("ci_jobs");
        return $query->num_rows();
    }



    public function select_all_applied_jobs($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $job_status = 0, $posted_date = 0, $job_location = 0)
    {
        $multiplewhere = array(
            'ci_jobs.status' => 1
        );

        if ($posted_date > 0) {
            $multiplewhere['ci_jobs.created_at >='] = date('Y-m-d', strtotime('-' . $posted_date . ' days'));
            $multiplewhere['ci_jobs.created_at <='] = date('Y-m-d');
        }

        if ($job_location > 0)
            $multiplewhere['ci_jobs.job_location'] = $job_location;


        if ($job_status > 0)
            $multiplewhere['ci_jobs_apply.job_status'] = $job_status;


        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->select('ci_jobs.*,ci_countries.country_name,ci_job_status.status_name,ci_jobs_apply.job_status,ci_jobs_apply.job_id as applied');
        $this->db->where($multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->join('ci_jobs_apply', 'ci_jobs_apply.job_id  = ci_jobs.job_id', 'left');
        $this->db->join('ci_job_status', 'ci_job_status.status_id  = ci_jobs_apply.job_status', 'left');
        $this->db->limit($limit, $start);

        if ($sortby == "desc")
            $this->db->order_by("ci_jobs.job_id", "desc");
        else
            $this->db->order_by("ci_jobs.job_id", "asc");


        return $this->db->get('ci_jobs')->result();
    }
}
