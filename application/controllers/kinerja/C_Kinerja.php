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
        $data['list_laporan_kinerja'] = "";
        render('kinerja/V_LaporanKinerja', '', '', $data);
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

            $result = 1;

            echo json_decode($result);
        }
    }

    
    public function loadKegiatan(){
       
        $data['list_kegiatan'] = $this->kinerja->loadKegiatan();
        // dd($data['list_kegiatan']);
        $this->load->view('kinerja/V_LaporanKinerjaItem', $data);
    }

    public function deleteKegiatan($id){
        $this->general->delete('id', $id, 't_kegiatan');
    }


   
    
}
