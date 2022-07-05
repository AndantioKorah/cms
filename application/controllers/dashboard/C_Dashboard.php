<?php

class C_Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard/M_Dashboard', 'dashboard');
        $this->load->model('master/M_Master', 'master');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function dashboard(){
        render('dashboard/V_Dashboard', '', '', null);
    }

}
