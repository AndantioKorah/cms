<?php

class C_VerifKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general/M_General', 'general');
        $this->load->model('master/M_Master', 'master');
        $this->load->model('user/M_User', 'user');
        $this->load->model('kinerja/M_VerifKinerja', 'verifkinerja');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function verifKinerja(){
        $data = null;
        if($this->general_library->isKaban()){
            $data['list_bidang'] = $this->master->loadMasterBidangByUnitKerja($this->general_library->getUnitKerjaPegawai());
        } 
        if($this->general_library->isWalikota() || $this->general_library->isSetda()){
            $data['list_skpd'] = $this->user->getAllSkpd();
        }
        render('kinerja/V_VerifKinerja', '', '', $data);
    }

    public function searchVerifKinerja(){
        $data['result'] = $this->verifkinerja->searchVerifKinerja($this->input->post());
        $this->load->view('kinerja/V_VerifKinerjaSearchItem', $data);
    }
    
    public function checkVerif($status, $id_t_kegiatan){
        echo json_encode($this->verifkinerja->checkVerif($status, $id_t_kegiatan));
    }

    public function loadDetailKegiatan($id){
        $data['result'] = $this->verifkinerja->loadDetailKegiatan($id);
        $this->load->view('kinerja/V_VerifKinerjaDetail', $data);
    }

    public function rekapRealisasi(){
        $data = null;
        if($this->general_library->isKaban()){
            $data['list_bidang'] = $this->master->loadMasterBidangByUnitKerja($this->general_library->getUnitKerjaPegawai());
        } 
        if($this->general_library->isWalikota() || $this->general_library->isSetda()){
            $data['list_skpd'] = $this->user->getAllSkpd();
        }
        render('kinerja/V_RekapRealisasi', '', '', $data);
    }

    public function searchRekapRealisasi(){
        $data['result'] = $this->verifkinerja->searchRekapRealisasi($this->input->post());
        $this->session->set_userdata(['periode_search_rekap' => $this->input->post()]);
        $this->load->view('kinerja/V_RekapRealisasiSearchItem', $data);
    }

    public function loadDetailRekap($id){
        $data['result'] = $this->verifkinerja->loadDetailRekap($id);
        $data['periode'] = $this->session->userdata('periode_search_rekap');
        $this->load->view('kinerja/V_DetailRekapRealisasiItem', $data);
    }

    public function loadListKegiatanRencanaKinerja($id){
        $data['result'] = $this->verifkinerja->loadListKegiatanRencanaKinerja($id);
        $this->load->view('kinerja/V_ListKegiatanDetailRekapRealisasi', $data);
    }
}
