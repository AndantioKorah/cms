<?php

class C_Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(!$this->session->userdata('site_lang')){
            $this->session->set_userdata('site_lang',  DEFAULT_LANG);
        }
        $this->load->view('webcp/main/V_Main', null);
    }

    public function switchLanguage($lang = DEFAULT_LANG){
        $this->session->set_userdata('site_lang', $lang);
        redirect('');
    }
}
