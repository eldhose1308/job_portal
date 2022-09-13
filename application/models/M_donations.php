<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_donations extends CI_Model
{


    public function select_has_subtype_maintypes($status = 1)
    {
        $multiplewhere = array(
            'ci_donation_types.status' => $status,
            'ci_donation_types.has_subtype' => 1
        );



        $this->db->select('ci_donation_types.*');
        $this->db->where($multiplewhere);

        return $this->db->get('ci_donation_types')->result();
    }


    public function select_visible_maintypes($status = 1)
    {
        $multiplewhere = array(
            'ci_donation_types.status' => $status,
            'ci_donation_types.visible' => 1
        );



        $this->db->select('ci_donation_types.*');
        $this->db->where($multiplewhere);

        return $this->db->get('ci_donation_types')->result();
    }


    public function select_all_subtypes($type_id = 0, $status = 1)
    {
        $multiplewhere = array(
            'ci_donation_subtypes.status' => $status,
            'ci_donation_subtypes.type_id' => $type_id
        );

        if ($type_id == 0)
            unset($multiplewhere['ci_donation_subtypes.type_id']);

        $this->db->select('ci_donation_subtypes.*,ci_donation_types.type_name');
        $this->db->where($multiplewhere);
        $this->db->join('ci_donation_types', 'ci_donation_types.type_id    = ci_donation_subtypes.type_id ', 'left');

        return $this->db->get('ci_donation_subtypes')->result();
    }
}
