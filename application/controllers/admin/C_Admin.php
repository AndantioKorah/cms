<?php

class C_Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_Admin', 'admin');
        $this->load->model('general/M_General', 'general');
        $this->load->model('user/M_User', 'user');
        $this->load->model('master/M_Master', 'master');
    }

 
    public function konten(){
       
        $this->general_library->refreshMenu();
        $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
        render('admin/V_AdminKonten', 'admin', 'konten', $data);
        
    }

    public function loadFormProfil(){
        $data['profil'] = "";
        $this->load->view('admin/V_FormProfil', $data);
    }

    public function loadFormBerita(){
        $data['berita'] = "";
        $this->load->view('admin/V_FormBerita', $data);
    }

    public function switchLanguage($lang = DEFAULT_LANG){
        $this->session->set_userdata('site_lang', $lang);
        redirect('');
    }

    public function do_upload(){
       
        $config = array(
            'upload_path' => "./assets/berita",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000"

            );
        $this->load->library('upload', $config);
        // $dataPost = $this->input->post();
        // $dataFile = $this->upload->data(); 
       
        // $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
        // $res2 = array('msg' => 'Data gagal disimpan', 'success' => true);
        
      
        if($this->upload->do_upload())
        {
            dd(1);
        $data = array('upload_data' => $this->upload->data());
        echo json_encode($res);
        }
        else
        {
            dd(2);
        $error = array('error' => $this->upload->display_errors());
         dd($error);
        }
        }

        function ajax_upload()  
        {  
             if(isset($_FILES["berita_dokumen"]["name"]))  
             {  
                  $config['upload_path'] = './assets/berita';  
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                  $this->load->library('upload', $config);  
                  if(!$this->upload->do_upload('berita_dokumen'))  
                  {  
                       echo $this->upload->display_errors();  
                  }  
                  else  
                  {  
                    if(isset($_FILES["thumbnail_berita"]["name"]))  
                    {  
                         $config['upload_path'] = './assets/thumbnail';  
                         $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                         $this->load->library('upload', $config);  
                         if(!$this->upload->do_upload('thumbnail_berita'))  
                         {  
                              echo $this->upload->display_errors();  
                         }  
                        
                    }
                    $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
                    echo json_encode($res);
                  }  
             }  

  
        }
        
}
