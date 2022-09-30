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
    function select_all_jobs_count($category = 0)
    {
        $where = array(
            'ci_jobs.status' => '1'
        );

        $this->db->where($where);

        $query = $this->db->get("ci_jobs");
        return $query->num_rows();
    }



    public function select_all_jobs_users($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc")
    {
        $multiplewhere = array(
            'ci_jobs.status' => 1
        );



        if ($query != '') {
            $this->db->or_like('job_title', $query);
            $this->db->or_like('brief_description', $query);
            $this->db->or_like('job_description', $query);
        }

        $this->db->select('ci_jobs.*,ci_countries.country_name,ci_jobs_wishlist.candidate_id,ci_jobs_wishlist.job_id as wishlist');
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



    public function select_all_saved_jobs_users($query = '', $limit = 10, $start = 1, $page = 1, $sortby = "desc")
    {
        $multiplewhere = array(
            'ci_jobs.status' => 1
        );

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
}
