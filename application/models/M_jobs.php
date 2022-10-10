<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jobs extends CI_Model
{




    function check_job_in_wishlist($job_id, $candidate_id)
    {
        $this->db->select('ci_jobs_wishlist.*');
        $this->db->from('ci_jobs_wishlist');
        $this->db->where('ci_jobs_wishlist.job_id', $job_id);
        $this->db->where('ci_jobs_wishlist.candidate_id', $candidate_id);
        $data = $this->db->get();

        if ($data->num_rows() == 1) {
            return $data->row();
        } else {
            return false;
        }
    }



    function select_jobs_in_wishlist( $candidate_id)
    {
        $this->db->select('ci_jobs_wishlist.job_id');
        $this->db->where('ci_jobs_wishlist.candidate_id', $candidate_id);
        return $this->db->get('ci_jobs_wishlist')->result_array();

    }


    function select_jobs_in_applied( $candidate_id)
    {
        $this->db->select('ci_jobs_apply.job_id');
        $this->db->where('ci_jobs_apply.candidate_id', $candidate_id);
        return $this->db->get('ci_jobs_apply')->result_array();

    }


    function selelct_jobdetails_by_id($job_id)
    {
        $this->db->select('ci_jobs.*,ci_countries.country_name');
        $this->db->where('ci_jobs.job_id', $job_id);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        return $this->db->get('ci_jobs')->row();

    }


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

        $this->db->select('ci_jobs.*,ci_countries.country_name');
        $this->db->where($where);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');

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

        $this->db->select('ci_jobs.*,ci_countries.country_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
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
        $candidate_id = $this->user_id;

        $where = array(
            'ci_jobs.status' => '1',
            'ci_jobs_wishlist.candidate_id' => $candidate_id

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
        $this->db->distinct();
        $this->db->select('ci_jobs_wishlist.job_id as wishlist_id,ci_jobs.*,ci_countries.country_name');
        $this->db->where($where);
        $this->db->join('ci_jobs', 'ci_jobs.job_id  = ci_jobs_wishlist.job_id', 'left');
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');


        $query = $this->db->get("ci_jobs_wishlist");
        return $query->num_rows();
    }

    public function select_all_saved_jobs_users($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0, $salary = 0, $experience = 0)
    {
        $candidate_id = $this->user_id;

        $multiplewhere = array(
            'ci_jobs.status' => 1,
            'ci_jobs_wishlist.candidate_id' => $candidate_id
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

        $this->db->distinct();
        $this->db->select('ci_jobs_wishlist.job_id as wishlist_id,ci_jobs.*,ci_countries.country_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_jobs', 'ci_jobs.job_id  = ci_jobs_wishlist.job_id', 'left');
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
        $this->db->limit($limit, $start);

        if ($sortby == "desc")
            $this->db->order_by("ci_jobs.job_id", "desc");
        else
            $this->db->order_by("ci_jobs.job_id", "asc");


        return $this->db->get('ci_jobs_wishlist')->result();
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
        $candidate_id = $this->user_id;

        $where = array(
            'ci_jobs.status' => '1',
            'ci_jobs_apply.candidate_id' => $candidate_id
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



    public function select_all_jobs_oldone($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc")
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


    function select_all_jobs_admin_count($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0, $salary = 0, $experience = 0)
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

        $this->db->select('ci_jobs.*,ci_countries.country_name');
        $this->db->where($where);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');

        if ($sortby == "desc")
            $this->db->order_by("ci_jobs.job_id", "desc");
        else
            $this->db->order_by("ci_jobs.job_id", "asc");

        $query = $this->db->get("ci_jobs");
        return $query->num_rows();
    }



    public function select_all_jobs_admin($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0, $salary = 0, $experience = 0)
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

        $this->db->select('ci_jobs.*,ci_countries.country_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location', 'left');
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


    public function select_applications_of_job($job_id = 0, $query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $job_status = 0, $posted_date = 0, $job_location = 0)
    {
        $multiplewhere = array(
            'ci_jobs_apply.status' => 1
        );


        if ($job_id > 0)
            $multiplewhere['ci_jobs_apply.job_id'] = $job_id;


        $this->db->select('ci_jobs_apply.apply_id,ci_jobs_apply.job_status,ci_job_status.status_name,ci_jobs_apply.created_at,ci_candidates.*');
        $this->db->where($multiplewhere);
        $this->db->join('ci_candidates', 'ci_candidates.user_id  = ci_jobs_apply.candidate_id', 'left');
        $this->db->join('ci_job_status', 'ci_job_status.status_id  = ci_jobs_apply.job_status', 'left');
        // $this->db->limit($limit, $start);

        $this->db->order_by("ci_jobs_apply.job_status", "asc");


        return $this->db->get('ci_jobs_apply')->result();
    }

    /***
     * 
     * Dashboiard
     * 
     */


    function select_all_applied_jobs_count_dashboard($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc", $posted_date = 0, $job_location = 0)
    {
        $where = array(
            'ci_jobs_apply.status' => '1'
        );


        $this->db->where($where);


        $query = $this->db->get("ci_jobs_apply");
        return $query->num_rows();
    }
}
