<?php

class C_Kinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general/M_General', 'general');
        $this->load->model('kinerja/M_Kinerja', 'kinerja');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function Kinerja(){
        $data['list_rencana_kinerja'] = $this->kinerja->getRencanaKinerja(date('m'), date('Y'));
        render('kinerja/V_RealisasiKinerja', '', '', $data);
    }

    public function tesUpload(){
        $data['list_rencana_kinerja'] = $this->kinerja->getRencanaKinerja();
        render('kinerja/V_TesUpload', '', '', $data);
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

    public function multipleImageStore()
  {
       $this->load->library('image_lib');
      $countfiles = count($_FILES['files']['name']);
    
      $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
      $ress = 1;
      if(implode($_FILES['files']['name']) == ""){
          
        $nama_file = '[""]';
        $image = $nama_file;
        $dataPost = $this->input->post();
        $this->kinerja->createLaporanKegiatan($dataPost,$image);
      } else {
        for($i=0;$i<$countfiles;$i++){
         
            if(!empty($_FILES['files']['name'][$i])){
      
              // Define new $_FILES array - $_FILES['file']
              $_FILES['file']['name'] = $this->getUserName().'_'.$_FILES['files']['name'][$i];
              $_FILES['file']['type'] = $_FILES['files']['type'][$i];
              $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
              $_FILES['file']['error'] = $_FILES['files']['error'][$i];
              $_FILES['file']['size'] = $_FILES['files']['size'][$i];
            
            //   if($_FILES['file']['size'] > 1048576){
            //     $ress = 0;
            //     $res = array('msg' => 'File tidak boleh lebih dari 1 MB', 'success' => false);
            //     break;
            //   }
           
              // Set preference
              $random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
              $config['upload_path'] = './assets/bukti_kegiatan'; 
            //   $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
              $config['allowed_types'] = '*';
              $config['max_size'] = '5000'; // max_size in kb
            //   $config['file_name'] = $this->getUserName().'_'.$_FILES['file']['name'];
             
              //Load upload library
              $this->load->library('upload',$config); 
            //   $res = array('msg' => 'something went wrong', 'success' => false);
              // File upload
              if($this->upload->do_upload('file')){
               
               $data = $this->upload->data(); 
            //    dd($data['image_width']);
               $insert['name'] = $data['file_name'];
               $config['image_library'] = 'gd2';
               $config['source_image'] = './assets/bukti_kegiatan/'.$data["file_name"];
               $config['create_thumb'] = FALSE;
               $config['maintain_ratio'] = FALSE;
               
               if($data['image_height'] > 1000) {
                // $imgdata=exif_read_data($this->upload->upload_path.$this->upload->file_name, 'IFD0');
                $config['width'] = $data['image_width'] * 50 / 100;
                $config['height'] = $data['image_height'] * 50 / 100;
               } else {
                $config['width'] = 600;
                $config['height'] =600;  
               }
               $config['master_dim'] = 'auto';
               $config['quality'] = "50%";
              
               $this->image_lib->initialize($config);
              
            // if($data['image_height'] > 1000) {
            //     if (!$this->image_lib->resize()){  
            //         echo "error";
            //     }else{
    
            //         $this->image_lib->clear();
            //         $config=array();
    
            //         $config['image_library'] = 'gd2';
            //         $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
    
    
            //         switch($imgdata['Orientation']) {
            //             case 3:
            //                 $config['rotation_angle']='180';
            //                 break;
            //             case 6:
            //                 $config['rotation_angle']='270';
            //                 break;
            //             case 8:
            //                 $config['rotation_angle']='90';
            //                 break;
            //         }
    
            //         $this->image_lib->initialize($config); 
            //         $this->image_lib->rotate();
    
            //     }
            //     } else {
            //     $this->image_lib->resize();
            //     } 
            $this->image_lib->resize();  
              }
            }
            $nama_file[] = $data['file_name'];
           }
           if($ress == 1){
            $image = json_encode($nama_file); 
            $dataPost = $this->input->post();
            $this->kinerja->createLaporanKegiatan($dataPost,$image);
           }
            
           
      }
        echo json_encode($res);
  
  }
    

    public function createLaporanKegiatan(){

        $fileName = $this->general_library->getUserName().'_bukti_kegiatan_'.date('ymdhis').'_'.$_FILES['image_file']['name'];
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

    
    public function loadKegiatan($tahun,$bulan){
       
        $data['list_kegiatan'] = $this->kinerja->loadKegiatan($tahun,$bulan);
        $this->load->view('kinerja/V_RealisasiKinerjaItem', $data);
    }

    public function deleteKegiatan($id){
        $this->general->delete('id', $id, 't_kegiatan');
    }

      
    public function loadRencanaKinerja($bulan = null, $tahun = null){
        if(!$tahun){
            $tahun = date('Y');
        }
        if(!$bulan){
            $bulan = date('m');
        }
        $data['list_rencana_kinerja'] = $this->kinerja->loadRencanaKinerja($bulan, $tahun);
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

    public function searchRekapKinerja(){
       
        $data['list_rekap_kinerja'] = $this->kinerja->searchRekapKinerja();
        $this->load->view('kinerja/V_RekapKinerja', $data);
    }

    function getRencanaKerja(){
      
        $data = $this->kinerja->getRencanaKerja()->result();
        echo json_encode($data);
    }
  
    public function getUserName(){
        $this->userLoggedIn = $this->session->userdata('user_logged_in');
        return $this->userLoggedIn[0]['username'];
    }

   
    
}
