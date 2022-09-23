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



    public function select_all_jobs($limit, $start, $page = 1)
    {
        $multiplewhere = array(
            'ci_jobs.status' => 1,
        );

       

        $this->db->select('ci_jobs.*,ci_countries.country_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_countries', 'ci_countries.country_id  = ci_jobs.job_location ', 'left');
        $this->db->limit($limit, $start);
        $this->db->order_by("ci_jobs.job_id", "desc");

        return $this->db->get('ci_jobs')->result();
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
