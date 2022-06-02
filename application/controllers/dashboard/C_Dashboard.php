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
        $data['list_skpd'] = $this->master->getAllUnitKerja();
        render('dashboard/V_Dashboard', '', '', $data);
    }

    public function loadDataSkpdDashboard($id_skpd = '4018000'){
        if(!$this->general_library->isWalikota() && !$this->general_library->isSetda()){
            $id_skpd = $this->general_library->getUnitKerjaPegawai();
        }
        $this->session->set_userdata('dashboard_id_skpd', $id_skpd);
        $data['list_bidang'] = $this->dashboard->getBidangBySkpd($id_skpd);
        $data['data_skpd'] = $this->dashboard->getDataSkpd($id_skpd);
        if($this->general_library->isKabid()){
            $data['bidang'] = $this->master->getBidangBySubBidang($this->general_library->getSubBidangUser());
            $data['list_sub_bidang'] = $this->master->getSubBidangByBidang($data['bidang']['id_m_bidang']);
        }
        $this->load->view('dashboard/V_DataSkpdDashboard', $data);
    }

    public function searchDataDashboard(){
        $params = $this->input->post();
        $params['skpd'] = $this->session->userdata('dashboard_id_skpd');
        if(!$this->general_library->isWalikota() && !$this->general_library->isSetda()){
            $params['skpd'] = $this->general_library->getUnitKerjaPegawai();
        }
        $data['data_dashboard'] = $this->dashboard->getDataDashboard($params);
        $this->load->view('dashboard/V_DataDashboard', $data);
    }

    public function loadSubBidangByBidang($id){
        echo json_encode($this->dashboard->loadSubBidangByBidang($id));
    }

    public function loadBidangByUnitKerja($id){
        echo json_encode($this->dashboard->loadBidangByUnitKerja($id));
    }

}
