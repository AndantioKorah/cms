<?php

class C_Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/M_Main', 'main');
    }

    public function index(){
        if(!$this->session->userdata('site_lang')){
            $this->session->set_userdata('site_lang',  DEFAULT_LANG);
        }
        renderwebcp('webcp/main/V_Main', '', '', null);
    }

    public function switchLanguage($lang = DEFAULT_LANG){
        $this->session->set_userdata('site_lang', $lang);
        redirect('');
    }
}
