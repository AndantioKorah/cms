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
        $data['profil'] = $this->admin->loadProfil();
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
        
        function submitKontenBerita(){
            $countfiles = count($_FILES['berita_gambar']['name']);
            // dd($countfiles);
            for($i=0;$i<$countfiles;$i++){
            if(!empty($_FILES['berita_gambar']['name'][$i])){
      
                // Define new $_FILES array - $_FILES['file']
                $_FILES['file']['name'] = $_FILES['berita_gambar']['name'][$i];
                $_FILES['file']['type'] = $_FILES['berita_gambar']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['berita_gambar']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['berita_gambar']['error'][$i];
                $_FILES['file']['size'] = $_FILES['berita_gambar']['size'][$i];
              
              //   if($_FILES['file']['size'] > 1048576){
              //     $ress = 0;
              //     $res = array('msg' => 'File tidak boleh lebih dari 1 MB', 'success' => false);
              //     break;
              //   }
             
                // Set preference
                $config['upload_path'] = './assets/berita'; 
                $config['allowed_types'] = 'jpg|jpeg|png';
                // $config['max_size'] = '5000'; 
              //   $config['file_name'] = $this->getUserName().'_'.$_FILES['file']['name'];
               
                //Load upload library
                $this->load->library('upload',$config); 
                if($this->upload->do_upload('file')){
                    $data = $this->upload->data(); 
                   }
              }
           
            $nama_file[] = $data['file_name'];
             }
           
            $new_name = json_encode($nama_file); 
            $data = $this->admin->submitKontenBerita($new_name);
          

            // if(isset($_FILES["berita_gambar"]["name"])){ 
            //     $path="./assets/berita";
            //     $konten="berita_gambar";
            //     $this->ajax_upload($path,$konten,$new_name);
            // }

            // if(isset($_FILES["thumbnail_berita"]["name"])){  
            //     $path="./assets/thumbnail";
            //     $konten = "thumbnail_berita";
            //     $this->ajax_upload2($path,$konten);  
            // }
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }

        function submitKontenProfil(){

      
            $new_name = time().$_FILES["profil_struktur_organisasi"]['name'];
            $data = $this->admin->submitKontenProfil($new_name);
            // dd($new_name);

            if(isset($_FILES["profil_struktur_organisasi"]["name"])){ 
                $path="./assets/profil";
                $konten="profil_struktur_organisasi";
                $this->ajax_upload($path,$konten,$new_name);
            }

            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }

        function ajax_upload($path,$konten,$new_name)  
        {  
                  $config['file_name'] = $new_name;
                  $config['upload_path'] = $path;  
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                  $this->load->library('upload', $config);  
                  $this->upload->overwrite = true;
                  if(!$this->upload->do_upload($konten))  
                  {  
                       echo $this->upload->display_errors();  
                  }  
                  
        }

        function ajax_upload2($path,$konten)  
        {  
            
                  $config['upload_path'] = $path;  
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                  $this->upload->initialize($config);
                  if(!$this->upload->do_upload($konten))  
                  {  
                       echo $this->upload->display_errors();  
                  }  
                
        }

        public function loadListBerita(){
            $data['list_berita'] = $this->admin->loadListBerita();
            $this->load->view('admin/V_ListBerita', $data);
        }

        function updateKontenBerita(){

           
            $new_name = $this->input->post('nama_gambar_lama');
            if(isset($_FILES["image_file"]["name"])){ 
                $path="./assets/berita";
                $konten="image_file";
                $this->ajax_upload($path,$konten,$new_name);
            }

            $data = $this->admin->updateKontenBerita();
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }

        public function deleteBerita($id){
            $this->general->delete('id', $id, 't_berita');
        }
        
}
