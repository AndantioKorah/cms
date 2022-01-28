<?php

class C_Kinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general/M_General', 'general');
        $this->load->model('kinerja/M_Kinerja', 'kinerja');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function Kinerja(){
        $data['list_rencana_kinerja'] = $this->kinerja->getRencanaKinerja();
        render('kinerja/V_RealisasiKinerja', '', '', $data);
    }

    public function rencanaKinerja(){
        $data['list_rencana_kerja'] = "";
        render('kinerja/V_RencanaKinerja', '', '', $data);
    }

    public function rekapKinerja(){
        $data['list_rekap_kinerja'] = $this->kinerja->loadRekapKinerja();
        render('kinerja/V_RekapKinerja', '', '', $data);
    }

    public function createRencanaKinerja(){
        $data = $this->input->post();
        $data['id_m_user'] = $this->general_library->getId();
        $this->kinerja->insert('t_rencana_kinerja', $data);
    }
    

    public function createLaporanKegiatan(){
      
        $fileName = $this->general_library->getUserName().'_bukti_kegiatan_'.date('ymdhis').'_'.$_FILES['file']['name'];
        $config['upload_path'] = "./assets/bukti_kegiatan";
        $config['allowed_types'] = '*';
        $config['file_name'] = $fileName;
        // $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
       
        if($this->upload->do_upload('file'))
        {
            $data = array('upload_data' => $this->upload->data());

            $dataPost = $this->input->post();

            $image = $fileName;

            $result = $this->kinerja->createLaporanKegiatan($dataPost,$image);


            echo json_decode($result);
        } else {
            $dataPost = $this->input->post();

            $image = "";

            $result = $this->kinerja->createLaporanKegiatan($dataPost,$image);
        }
    }

    
    public function loadKegiatan(){
       
        $data['list_kegiatan'] = $this->kinerja->loadKegiatan();
        // dd($data['list_kegiatan']);
        $this->load->view('kinerja/V_RealisasiKinerjaItem', $data);
    }

    public function deleteKegiatan($id){
        $this->general->delete('id', $id, 't_kegiatan');
    }

      
    public function loadRencanaKinerja(){
       
        $data['list_rencana_kinerja'] = $this->kinerja->loadRencanaKinerja();
        $this->load->view('kinerja/V_RencanaKinerjaItem', $data);
    }

    public function loadRekapKinerja(){
       
        $data['list_rekap_kinerja'] = $this->kinerja->loadRekapKinerja();
        $this->load->view('kinerja/V_RekapKinerja', $data);
    }



    public function getSatuan()
    {
        $data = $this->kinerja->getSatuan();
        echo json_encode($data);
    }

   
    
}
