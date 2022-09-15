<?php
defined('BASEPATH') or exit('No direct script access allowed');

class home extends US_Controller
{

    function __construct()

    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');
    }

    public function index()
    {
        $data = $this->data;

        $this->template->users_views('users/home', $data);
    }



    public function dashboard_menus()
    {

        $menus = array();

        $user_id = en_func(ss('user_id'), 'd');

        $parent_modules = $this->M_users->all_parent_modules();

        $unallocated_modules = (ss('user_type_display') == 1) ?
            $this->M_users->all_unallocated_sub_modules() :
            $this->M_users->unallocated_sub_modules($user_id);

        $modules_allocated = (ss('user_type_display') == 1) ?
            $this->M_users->all_modules() :
            $this->M_users->modules_allocated($user_id);


        $menus['unallocated'] = $unallocated_modules;
        $menus['allocated'] = array();
        
        $menus['unallocated_length'] = sizeof($menus['unallocated']);

        //dd($menus);

        $i = 0;
        $j = 0;
        foreach ($parent_modules  as $parents) :
            $modules_allocated = $this->M_users->all_sub_modules_of_parent($parents->mg_id);
            $has_submenu = (count($modules_allocated) > 0) ? true : false;

            if ($has_submenu) :
                foreach ($modules_allocated  as $modules) :
                    //  $menus['allocated'][$i] = $parents->main_module_name;
                    $menus['allocated'][$parents->main_module_name]['submodules'][$j++] = $modules;
                    $menus['allocated'][$parents->main_module_name]['parent'] = $parents->main_module_name;
                    $menus['allocated'][$parents->main_module_name]['module_group_label'] = $parents->module_group_label;
                endforeach;
            endif;
            $i++;
        endforeach;

        $menus['parent_length'] = sizeof($menus['allocated']);
        $menus['base_path'] = base_url();

       //dd($menus);

        $session_data["menus"] = $menus;
        $this->session->set_userdata($session_data);

        redirect(base_url() . 'adminhome');
        // $this->response(200, $menus);
    }





    public function dashboard_counts()
    {
        $this->load->model('Dashboard_model');

        $records['enquiries'] = $this->Common_model->get_counts('ci_contact_messages');
        $records['news'] = $this->Common_model->get_counts('ci_news', 1);
      //  $records['blogs'] = $this->Common_model->get_counts('ci_blogs', 1);
        $records['traffic'] = $this->Dashboard_model->get_visitors_count();
        $records['donations'] = 120;
        $this->response(200, $records);
    }


    public function recent_activity()
    {
        $this->load->model('Dashboard_model');
        $user_id = $this->user_id;
        $user_type = ($this->session->userdata('user_type_display'));
        $limit = 6;

        $records['activity'] = $this->Dashboard_model->get_recent_activity($user_id, 2, $limit);

        $i = 0;
        foreach ($records['activity']   as $row) {
            $records['activity'][$i++]->created_time = date('F d,Y', strtotime($row->created_at)) . ' <br> ' . date('h:i a', strtotime($row->created_at));
        }
        $this->response(200, $records);
    }


}
