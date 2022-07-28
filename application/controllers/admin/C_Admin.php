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

    public function berita(){
       
        $this->general_library->refreshMenu();
        $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
        render('admin/berita/V_FormBerita', 'admin', 'konten', $data);
        
    }



    public function loadFormProfil(){
        $data['profil'] = $this->admin->loadProfil();
        $this->load->view('admin/berita/V_FormProfil', $data);
    }

    public function loadFormBerita(){
        $data['berita'] = "";
        $this->load->view('admin/berita/V_FormBerita', $data);
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
              
                // if($_FILES['file']['size'] > 1048576){
                //   $ress = 0;
                //   $res = array('msg' => 'File tidak boleh lebih dari 1 MB', 'success' => false);
                  
                //   break;
                // }
             
                // Set preference
                $config['upload_path'] = './assets/admin/berita'; 
                $config['allowed_types'] = 'jpg|jpeg|png';
                // $config['max_size'] = '5000'; 
              //   $config['file_name'] = $this->getUserName().'_'.$_FILES['file']['name'];
               
                //Load upload library
                $this->load->library('upload',$config); 
                if($this->upload->do_upload('file')){
                    $data = $this->upload->data(); 
                
                    if($data["file_size"] > 500){
                        $config4['image_library'] = 'gd2';
                        $config4['source_image'] = './assets/admin/berita/'.$data["file_name"];
                        $config4['create_thumb'] = FALSE;
                        $config4['maintain_ratio'] = FALSE;
                        $config4['width']         = 1024;
                        $config4['height']       = 576;
                        $config4['new_image']= './assets/admin/berita/'.$data['file_name'];
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config4);
                        if (!$this->image_lib->resize()) {
                            echo $this->image_lib->display_errors();
                        }
                        $this->image_lib->clear();
                      } else {
                        // dd($data);
                        $w_i = $data["image_width"];
                        $h_i = $data["image_height"];

                          //calculating 16:9 ratio
                        $w_o = $w_i;
                        $h_o = 9 * $w_o / 16;

                        //if output height is longer then width
                        if ($h_i < $h_o) {
                            $h_o = $h_i;
                            $w_o = 16 * $h_o / 9;
                        }

                        $x_o = $w_i - $w_o;
                        $y_o = $h_i - $h_o;
                        // dd($x_o);

                        $config4['image_library'] = 'gd2';
                        $config4['source_image'] = './assets/admin/berita/'.$data["file_name"];
                        $config4['create_thumb'] = FALSE;
                        $config4['maintain_ratio'] = FALSE;
                        $config4['width']         = 1024;
                        $config4['height']       = 570;
                        //   $config4['width']         = $x_o;
                        // $config4['height']       = $y_o;
                        $config4['new_image']= './assets/admin/berita/'.$data['file_name'];
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config4);
                        if (!$this->image_lib->resize()) {
                            echo $this->image_lib->display_errors();
                        }
                        $this->image_lib->clear();
                      }
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
            // echo json_encode($res);
           
            redirect('admin/berita');
           
        }

        function submitKontenProfil(){

      
            $new_name = time().$_FILES["profil_struktur_organisasi"]['name'];
            $data = $this->admin->submitKontenProfil($new_name);
            
            if($_FILES["profil_struktur_organisasi"]["name"] != ""){ 
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
            $this->load->view('admin/berita/V_ListBerita', $data);
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
            // echo json_encode($res);
            redirect('admin/berita');
        }

        public function deleteBerita($id){
            $this->general->delete('id', $id, 't_berita');
        }

        

        public function loadDetailBerita($id){
            $data['berita'] = $this->admin->getBeritaDetail($id);
            // dd($data['berita']);
            $this->load->view('admin/berita/V_DetailBerita', $data);
        }


    // GALERI
        public function galeri(){
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/galeri/V_Galeri', 'admin', 'konten', $data);
            
        }


        function submitKontenGaleri(){

      
            // $new_name = time().$_FILES["gambar"]['name'];
            $new_name = str_replace(array( '-',' ',']'), ' ', $_FILES["gambar"]['name']);
            $nm_gambar = $string = str_replace(' ', '', $_FILES["gambar"]['name']);
        //   dd($nm_gambar);

           
            // $config['upload_path']   = './assets/admin/galeri/'; 
            // $config['allowed_types'] = 'gif|jpg|png'; 
            // $config['max_size']      = 1024;
            // $this->load->library('upload', $config);

            $data = $this->admin->submitKontenGaleri($nm_gambar);

      
            if($_FILES["gambar"]["name"] != ""){ 
                $path="./assets/admin/galeri/";
                $konten="gambar";
                // $this->ajax_upload($path,$konten,$new_name);
            }
          
            $config['file_name'] = $nm_gambar;
            $config['upload_path'] = $path;  
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 

           
            
            $this->load->library('upload', $config);  
            $this->upload->overwrite = true;
            
            if(!$this->upload->do_upload($konten))  
            {  
                 echo $this->upload->display_errors();  
            } else {
                $data = $this->upload->data();
                
                $config4['image_library'] = 'gd2';
                $config4['source_image'] = './assets/admin/galeri/'.$data["file_name"];
                $config4['create_thumb'] = FALSE;
                $config4['maintain_ratio'] = FALSE;
                $config4['width']         = 1024;
                $config4['height']       = 576;
                $config4['file_name'] = $nm_gambar;
                $config4['new_image'] = './assets/admin/galeri/'.$data['file_name'];
                $this->load->library('image_lib');
                $this->image_lib->initialize($config4);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $this->image_lib->clear();; 
                
            }


            // redirect('admin/galeri');
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }

        function submitKontenGaleriVideo(){
            $data = $this->admin->submitKontenGaleriVideo();
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }



        public function loadListGaleri(){
            $data['list_galeri'] = $this->admin->loadListGaleri();
            $this->load->view('admin/galeri/V_ListGaleri', $data);
        }

        public function loadListGaleriVideo(){
            $data['list_galeri_video'] = $this->admin->loadListGaleriVideo();
            $this->load->view('admin/galeri/V_ListGaleriVideo', $data);
        }
    
    

        public function deleteGaleri($id){
            $this->general->delete('id', $id, 't_galeri');
        }



        //PPID
        public function ppid(){
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/ppid/V_Ppid', 'admin', 'konten', $data);
            
        }

        function submitKontenPpid(){

      
            // $new_name = time().$_FILES["gambar"]['name'];
            $new_name = $_FILES["ppid_file"]['name'];
            // $nm_gambar = $string = str_replace(' ', '', $_FILES["ppid_file"]['name']);
        //   dd($nm_gambar);



      
            if($_FILES["ppid_file"]["name"] != ""){ 
                $path="./assets/admin/ppid/";
                $konten="ppid_file";
                // $this->ajax_upload($path,$konten,$new_name);
            }
          
            $config_ppid['file_name'] = $new_name;
            $config_ppid['upload_path'] = $path;  
            $config_ppid['allowed_types'] = 'jpg|jpeg|png|pdf'; 

           
            
            $this->load->library('upload', $config_ppid);  
            $this->upload->overwrite = true;
            
            if(!$this->upload->do_upload($konten))  
            {  
                 echo $this->upload->display_errors();  
            } 

            
            $data = $this->admin->submitKontenPpid($new_name);


            // redirect('admin/galeri');
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }

        public function loadListPpid(){
            $data['list_ppid'] = $this->admin->loadListPpid();
            $this->load->view('admin/ppid/V_ListPpid', $data);
        }

        public function deletePpid($id){
            $this->general->delete('id', $id, 't_ppid');
        }

        
}
