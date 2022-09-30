<?php

class C_Reservasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_Admin', 'admin');
        $this->load->model('general/M_General', 'general');
        $this->load->model('user/M_User', 'user');
        $this->load->model('master/M_Master', 'master');
        $this->load->model('reservasi/M_Reservasi', 'reservasi');
        $this->load->model('webcp/reservasi/M_Reservasi', 'cmsreservasi');
    }

    public function index(){
        render('reservasi/V_ReservasiOnline', '', '', null);
    }

    public function searchReservasi(){
        $params = $this->input->post();
        $data['result'] = $this->reservasi->searchReservasi($params);
        $this->load->view('reservasi/V_ResultSearchReservasi', $data);
    }

    public function openDetailAdministrasiReservasi($id){
        $data['result'] = $this->reservasi->openDetailReservasi($id);
        $data['layanan'] = $this->reservasi->getAllLayanan();
        $this->load->view('reservasi/V_DetailAdministrasiReservasi', $data);
    }

    public function getListParameterJenisPelayanan($id){
        $data['parameter'] = $this->master->getListParameterJenisPelayanan($id);
        $this->load->view('reservasi/V_ChooseParameterAddLayanan', $data);
    }

    public function addJenisPelayanan($id){
        echo json_encode($this->reservasi->addJenisPelayanan($id));
    }

    public function loadDetailLayanan($id){
        $data['result'] = $this->reservasi->loadDetailLayanan($id);
        $this->load->view('reservasi/V_DetailLayananReservasi', $data);
    }

    public function deleteJenisLayanan($id){
        echo json_encode($this->reservasi->deleteJenisLayanan($id));
    }

    public function createBilling($id){
        echo json_encode($this->reservasi->createBilling($id));
    }

    public function deleteBilling($id){
        echo json_encode($this->reservasi->deleteBilling($id));
    }
}
