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
        if($this->general_library->isPetugasYantek()){
            $data['layanan'] = $this->reservasi->getAllLayanan();
            $data['pelanggan'] = $this->reservasi->getAllPelanggan();
            $this->load->view('reservasi/V_DetailAdministrasiReservasi', $data);
        } else if($this->general_library->isKepalaInstalasi()){
            $this->load->view('reservasi/V_DetailVerifikasiKi', $data);
        } else if($this->general_library->isPetugasLab() || $this->general_library->isAnalisLab()){
            $this->load->view('reservasi/V_DetailPetugasLab', $data);
        } else if($this->general_library->isKoordinatorLab()){
            $this->load->view('reservasi/V_DetailKoordinatorLab', $data);
        } else if($this->general_library->isKepalaBalai()){
            $this->load->view('reservasi/V_DetailKepalaBalai', $data);
        }
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
        // dd($data);
        $this->load->view('reservasi/V_DetailLayananReservasi', $data);
    }

    public function loadDetailLayananVerifKi($id){
        $data['result'] = $this->reservasi->loadDetailLayanan($id);
        $this->load->view('reservasi/V_DetailLayananReservasiVerifKi', $data);
    }

    public function loadDetailLayananPetugasLab($id){
        $data['result'] = $this->reservasi->loadDetailLayanan($id);
        $this->load->view('reservasi/V_DetailLayananReservasiPetugasLab', $data);
    }

    public function loadDetailLayananKoordinatorLab($id){
        $data['result'] = $this->reservasi->loadDetailLayanan($id);
        $this->load->view('reservasi/V_DetailLayananKoordinatorLab', $data);
    }

    public function loadDetailLayananKepalaBalai($id){
        $data['result'] = $this->reservasi->loadDetailLayanan($id);
        $this->load->view('reservasi/V_DetailLayananKepalaBalai', $data);
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

    public function acceptPayment($id){
        echo json_encode($this->reservasi->acceptPayment($id));
    }

    public function deletePayment($id){
        echo json_encode($this->reservasi->deletePayment($id));
    }

    public function verifKi($id){
        echo json_encode($this->reservasi->verifKi($id));
    }

    public function deleteVerifKi($id){
        echo json_encode($this->reservasi->deleteVerifKi($id));
    }

    public function simpanHasilInputData($id){
        echo json_encode($this->reservasi->simpanHasilInputData($id));
    }

    public function lockResult($id){
        echo json_encode($this->reservasi->lockResult($id));
    }

    public function openLockResult($id){
        echo json_encode($this->reservasi->openLockResult($id));
    }

    public function verifKoordinatorLab($id){
        echo json_encode($this->reservasi->verifKoordinatorLab($id));
    }

    public function deleteVerifKoordinatorLab($id){
        echo json_encode($this->reservasi->deleteVerifKoordinatorLab($id));
    }

    public function verifKepalaBalai($id){
        echo json_encode($this->reservasi->verifKepalaBalai($id));
    }

    public function deleteVerifKepalaBalai($id){
        echo json_encode($this->reservasi->deleteVerifKepalaBalai($id));
    }

    public function publishHasil($id){
        echo json_encode($this->reservasi->publishHasil($id));
    }

    public function deletePublishHasil($id){
        echo json_encode($this->reservasi->deletePublishHasil($id));
    }
    
    public function searchReservasiByStatus($status, $flag_greater = 0){
        $data['result'] = $this->reservasi->searchReservasiByStatus($status, $flag_greater);
        $this->load->view('reservasi/V_ResultSearchReservasi', $data);
    }

    public function inputHasil(){
        $data['list_parameter'] = $this->reservasi->getAllParameter();
        render('reservasi/V_ReservasiInputHasil', '', '', $data);
    }

    public function loadParameterForInputHasil($id){
        $data['result'] = $this->reservasi->loadParameterForInputHasil($id);
        $this->load->view('reservasi/V_ReservasiListParameterInputHasil', $data);
    }

    public function simpanInputHasil(){
        echo json_encode($this->reservasi->simpanInputHasil());
    }

    public function getPelanggan()
    {
        $data = $this->reservasi->getPelanggan();
        echo json_encode($data);
    }

    public function openFormTambahReservasi(){
            $data['layanan'] = $this->reservasi->getAllLayanan();
            $data['pelanggan'] = $this->reservasi->getAllPelanggan();
            $this->load->view('reservasi/V_FormTambahReservasi', $data);
 
    }

    public function formAddParameterLangsung(){
        echo json_encode($this->reservasi->formAddParameterLangsung($this->input->post()));
    }

}
