<?php

class C_Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard/M_Dashboard', 'dashboard');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function dashboard(){
        $data['data_skpd'] = $this->dashboard->getDataSkpd();
        $data['data_dashboard'] = $this->dashboard->getDataDashboard();
        render('dashboard/V_Dashboard', '', '', $data);
    }

}
