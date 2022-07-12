<?php

class C_Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_Admin', 'admin');
    }

    public function index(){
        render('admin/V_Admin', '', '', null);
        
    }

    public function admin(){
       
            $data['result'] = "";
            $this->load->view('admin/V_Admin', $data);
        
    }

    public function switchLanguage($lang = DEFAULT_LANG){
        $this->session->set_userdata('site_lang', $lang);
        redirect('');
    }
}
