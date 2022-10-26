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
        $this->load->model('webcp/reservasi/M_Reservasi', 'reservasi');
    }

    public function index(){
        $data['layanan'] = $this->reservasi->getAllLayanan();
        $data['nomor_sesi'] = generateRandomNumber(4).date('ymdhis');
        $data['list_provinsi'] = $this->reservasi->getListProvinsi();
        renderwebcp('webcp/reservasi/V_Reservasi', '', '', $data);
    }

    public function getParameterByJenisLayanan($id){
        $data['parameter'] = $this->master->getListParameterJenisPelayanan($id);
        $data['list_provinsi'] = $this->reservasi->getListProvinsi();
        $data['list_kab_kota'] = $this->reservasi->getListKabKota();
        $data['list_kecamatan'] = $this->reservasi->getListKec();
        $this->load->view('webcp/reservasi/V_ChooseParameter', $data);
    }

    public function formAddParameter(){
        echo json_encode($this->reservasi->formAddParameter($this->input->post()));
    }

    public function refreshReceipt($session_id){
        $data['result'] = $this->reservasi->refreshReceipt($session_id);
        // dd($data['result']);
        $this->load->view('webcp/reservasi/V_ReservasiReceipt', $data);
    }

    public function deleteJenisLayananReceipt($id){
        echo json_encode($this->reservasi->deleteJenisLayananReceipt($id));
    }

    public function checkoutReservasi($session_id){
        echo json_encode($this->reservasi->checkoutReservasi($session_id));
    }

    public function finalReceiptModal($id, $nomor_tiket){
        $data['nomor_tiket'] = $nomor_tiket;
        $data['result'] = $this->session->userdata('final_receipt_'.$id);
        $this->load->view('webcp/reservasi/V_FinalReceiptModal', $data);
    }

    public function saveReceipt($id, $nomor_tiket, $flag_search_receipt = 0){
        $data['nomor_tiket'] = $nomor_tiket;
        $data['nama_file'] = $nomor_tiket.'.pdf';
        $data['result'] = $this->session->userdata('final_receipt_'.$id);
        if($flag_search_receipt == 1){
            $data['result'] = $this->session->userdata('final_receipt_search_'.$id);
        }
        $data['tanggal_tiket'] = ''; 
        $data['tanggal_tiket'] = $data['result']['created_date']; 
        $this->load->view('webcp/reservasi/V_ReceiptPdf', $data);
    }

    public function searchNomorTiket(){
        $data['result'] = $this->reservasi->searchNomorTiket();
        $this->load->view('webcp/reservasi/V_ReservasiDetail', $data);
    }

    function getListKabupatenKota(){
        $id=$this->input->post('id');
        $data=$this->reservasi->getListKabupatenKota($id);
        echo json_encode($data);
    }

    function getListKecamatan(){
        $id=$this->input->post('id');
        $data=$this->reservasi->getListKecamatan($id);
        echo json_encode($data);
    }

    function getListKelurahan(){
        $id=$this->input->post('id');
        $data=$this->reservasi->getListKelurahan($id);
        echo json_encode($data);
    }
    public function uploadPayment($id){
        echo json_encode($this->reservasi->uploadPayment($id));
    }
        
}