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
                // dd($_FILES);
              
                // if($_FILES['file']['size'] > 38576){
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
                        $config4['width']         = 1280;
                        $config4['height']       = 720;
                        $config4['new_image']= './assets/admin/berita/'.$data['file_name'];
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config4);
                        if (!$this->image_lib->resize()) {
                            echo $this->image_lib->display_errors();
                        }
                        $this->image_lib->clear();
                      } else {
                        // dd($data);
                        // $w_i = $data["image_width"];
                        // $h_i = $data["image_height"];

                          //calculating 16:9 ratio
                        // $w_o = $w_i;
                        // $h_o = 9 * $w_o / 16;

                        //if output height is longer then width
                        // if ($h_i < $h_o) {
                        //     $h_o = $h_i;
                        //     $w_o = 16 * $h_o / 9;
                        // }

                        // $x_o = $w_i - $w_o;
                        // $y_o = $h_i - $h_o;
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
            // $this->admin->deleteBerita($id);
            $table = 't_berita';
            $path = './assets/admin/berita/';
            $kolom = 'gambar';
            $type = 2;
            $this->admin->generalDelete($id,$table,$path,$kolom,$type);
            // $this->general->delete('id', $id, 't_berita');
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

        public function ajax_list()
        {
            header('Content-Type: application/json');
            $list = $this->admin->get_datatables();
            // dd($list);
            $data = array();
            $no = $this->input->post('start');
            //looping data mahasiswa
            foreach ($list as $data_galeri) {
                $src = base_url('assets/admin/galeri/').$data_galeri->isi_galeri;
                $no++;
                $row = array();
                //row pertama akan kita gunakan untuk btn edit dan delete
                $row[] = $no;
                $row[] = $data_galeri->nama;
                $row[] = formatDateNamaBulan($data_galeri->tanggal);
                $row[] = '<div class="col-lg-4 p-3 col-md-6 div_image" data-toggle="modal" href="#modal_image_preview"  onclick="openPreviewModal('.$data_galeri->id.')">  
                          <img style="width:600;height:.100px;" id="'.$data_galeri->id.'" class="target" src="'.$src.'" alt="'.$data_galeri->nama.'" />
                    </div>';
                $row[] =  '<button onclick="deleteGaleri('.$data_galeri->id.')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash" ></i></button>';
                $data[] = $row;
            }
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->admin->count_all(),
                "recordsFiltered" => $this->admin->count_filtered(),
                "data" => $data,
            );
            //output to json format
            // dd($output);
            $this->output->set_output(json_encode($output));
        }


        function submitKontenGaleri(){

      
            // $new_name = time().$_FILES["gambar"]['name'];
            $new_name = str_replace(array( '-',' ',']'), ' ', $_FILES["gambar"]['name']);
            // $nm_gambar = $string = str_replace(' ', '', $_FILES["gambar"]['name']);
            
            $random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
            $data = $_FILES["gambar"]['type'];;    
            $tipeFile = substr($data, strpos($data, "/") + 1);   
        
            $nm_gambar = "gambar".$random_number.time().".".$tipeFile;
           
            $status = 0;

           
            // $config['upload_path']   = './assets/admin/galeri/'; 
            // $config['allowed_types'] = 'gif|jpg|png'; 
            // $config['max_size']      = 1024;
            // $this->load->library('upload', $config);


      
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
                // if($data["file_size"] > 500){
                $config4['image_library'] = 'gd2';
                $config4['source_image'] = './assets/admin/galeri/'.$data["file_name"];
                $config4['create_thumb'] = FALSE;
                $config4['maintain_ratio'] = FALSE;
                $config4['width']         = 1280;
                $config4['height']       = 720;
                $config4['file_name'] = $nm_gambar;
                $config4['new_image'] = './assets/admin/galeri/'.$data['file_name'];
                $this->load->library('image_lib');
                $this->image_lib->initialize($config4);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $this->image_lib->clear();
            // }
            $status = 1;
            $data = $this->admin->submitKontenGaleri($nm_gambar);
            
            }
        
            if($status == 1){
                $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
                echo json_encode($res);
            } else {
                $res = array('msg' => 'Data gagal disimpan', 'success' => false);
                echo json_encode($res);
            }
          
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

        function getGaleriById($id){
            $data = $this->admin->getGaleriById($id);
            echo json_encode($data);
        }



        //PPID
        public function ppid(){
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            $data['list_master_kategori_ppid'] = $this->admin->getMasterKategoriPpid();
            render('admin/ppid/V_Ppid', 'admin', 'konten', $data);
            
        }

        function submitKontenPpid(){

            // $new_name = time().$_FILES["gambar"]['name'];
            $new_name = str_replace(array( '-',' ',']'), ' ', $_FILES["ppid_file"]['name']);
            $new_name = $string = str_replace(' ', '', $_FILES["ppid_file"]['name']);
        //   dd($new_name);



      
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


        //PELAYANAN

        public function pelayanan(){
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/pelayanan/V_Pelayanan', 'admin', 'konten', $data);
            
        }

        function submitKontenPelayanan(){


             $new_name = str_replace(array( '-',' ',']'), ' ', $_FILES["pelayanan_file"]['name']);
             $new_name = $string = str_replace(' ', '', $_FILES["pelayanan_file"]['name']);
            
            if($_FILES["pelayanan_file"]["name"] != ""){ 
                $path="./assets/admin/pelayanan/";
                $konten="pelayanan_file";
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

            
            $data = $this->admin->submitKontenPelayanan($new_name);


            // redirect('admin/galeri');
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }


        
        public function loadListPelayanan(){
            $data['list_pelayanan'] = $this->admin->loadListPelayanan();
            $this->load->view('admin/pelayanan/V_ListPelayanan', $data);
        }

        public function deletePelayanan($id){
            $this->general->delete('id', $id, 't_pelayanan');
        }

        //PENGUMUMAN
        public function pengumuman(){
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/pengumuman/V_Pengumuman', 'admin', 'konten', $data);
            
        }

        function submitKontenPengumuman(){

            $new_name = $_FILES["pengumuman_file"]['name'];
            
            if($_FILES["pengumuman_file"]["name"] != ""){ 
                $path="./assets/admin/pengumuman/";
                $konten="pengumuman_file";
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

            
            $data = $this->admin->submitKontenPengumuman($new_name);


            // redirect('admin/galeri');
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }


        
        public function loadListPengumuman(){
            $data['list_pengumuman'] = $this->admin->loadListPengumuman();
            $this->load->view('admin/pengumuman/V_ListPengumuman', $data);
        }

        public function deletePengumuman($id){
            $this->general->delete('id', $id, 't_pengumuman');
        }

        function getMasterJenisPpid(){
            $id=$this->input->post('id');
            $data=$this->admin->getMasterJenisPpid($id);
            echo json_encode($data);
        }


        // COVID19

        public function covid19Regulasi(){
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/covid19/V_Covid19', 'admin', 'konten', $data);
        }

        
        public function covid19Infografis(){
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/covid19/V_Covid19Infografis', 'admin', 'konten', $data);
        }

        public function covid19Video(){
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/covid19/V_Covid19Video', 'admin', 'konten', $data);
        }

        public function loadListCovid19Regulasi(){
            $data['list_covid19'] = $this->admin->loadListCovid19Regulasi();
            $this->load->view('admin/covid19/V_ListCovid19Regulasi', $data);
        }

        public function loadListCovid19Infografis(){
            $data['list_covid19'] = $this->admin->loadListCovid19Infografis();
            $this->load->view('admin/covid19/V_ListCovid19Infografis', $data);
        }

        public function loadListCovid19Video(){
            $data['list_covid19'] = $this->admin->loadListCovid19Video();
            $this->load->view('admin/covid19/V_ListCovid19Video', $data);
        }

        function submitKontenCovid19Regulasi(){

            $new_name = $_FILES["covid19_file"]['name'];
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
                     
            if($_FILES["covid19_file"]["name"] != ""){ 
                $path="./assets/admin/covid19/";
                $konten="covid19_file";
            }

           if($_FILES["covid19_file"]["type"] != "application/pdf"){
            $res = array('msg' => 'File harus dalam format pdf', 'success' => false);
            echo json_encode($res);
           } else {
            $config_ppid['file_name'] = $new_name;
            $config_ppid['upload_path'] = $path;  
            $config_ppid['allowed_types'] = 'pdf'; 

           
            
            $this->load->library('upload', $config_ppid);  
            $this->upload->overwrite = true;
            
            if(!$this->upload->do_upload($konten))  
            {  
                 echo $this->upload->display_errors();  
            } 
            $data = $this->admin->submitKontenCovid19Regulasi($new_name);
            echo json_encode($res);
           }
        }

        function submitKontenCovid19Infografis(){

            $new_name = $_FILES["infografis_file"]['name'];
            
            if($_FILES["infografis_file"]["name"] != ""){ 
                $path="./assets/admin/covid19/";
                $konten="infografis_file";
            }

            if($_FILES["infografis_file"]["type"] == "image/png" || $_FILES["infografis_file"]["type"] == "image/jpeg"){
                $config_ppid['file_name'] = $new_name;
                $config_ppid['upload_path'] = $path;  
                $config_ppid['allowed_types'] = 'jpg|jpeg|png|pdf'; 
    
               
                
                $this->load->library('upload', $config_ppid);  
                $this->upload->overwrite = true;
                
                if(!$this->upload->do_upload($konten))  
                {  
                     echo $this->upload->display_errors();  
                } 
    
                
                $data = $this->admin->submitKontenCovid19Infografis($new_name);
    
    
                $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
                echo json_encode($res);
            } else {
                $res = array('msg' => 'File bukan format gambar', 'success' => false);
                echo json_encode($res);
               
            }
          
            
        }

        function submitKontenCovid19Video(){
            $data = $this->admin->submitKontenCovid19Video();
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }

        public function deleteCovid19Regulasi($id){
            $this->general->delete('id', $id, 't_covid_regulasi');
        }

        public function deleteCovid19Infografis($id){
            $this->general->delete('id', $id, 't_covid_infografis');
        }

        public function deleteCovid19Video($id){
            $this->general->delete('id', $id, 't_covid_video');
        }




        // POJOK TTG
        public function pojokttg(){
       
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/pojokttg/V_PojokTtg', 'admin', 'konten', $data);
            
        }

        function submitKontenPojokTtg(){

            
            $countfiles = count($_FILES['pojokttg_gambar']['name']);
            // dd($countfiles);
            for($i=0;$i<$countfiles;$i++){
            if(!empty($_FILES['pojokttg_gambar']['name'][$i])){
      
                // Define new $_FILES array - $_FILES['file']
                $_FILES['file']['name'] = $_FILES['pojokttg_gambar']['name'][$i];
                $_FILES['file']['type'] = $_FILES['pojokttg_gambar']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['pojokttg_gambar']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['pojokttg_gambar']['error'][$i];
                $_FILES['file']['size'] = $_FILES['pojokttg_gambar']['size'][$i];
              
                // if($_FILES['file']['size'] > 1048576){
                //   $ress = 0;
                //   $res = array('msg' => 'File tidak boleh lebih dari 1 MB', 'success' => false);
                  
                //   break;
                // }
             
                // Set preference
                $config['upload_path'] = './assets/admin/pojokttg'; 
                $config['allowed_types'] = 'jpg|jpeg|png';
                // $config['max_size'] = '5000'; 
              //   $config['file_name'] = $this->getUserName().'_'.$_FILES['file']['name'];
               
                //Load upload library
                $this->load->library('upload',$config); 
                if($this->upload->do_upload('file')){
                    $data = $this->upload->data(); 
                
                    if($data["file_size"] > 500){
                        $config4['image_library'] = 'gd2';
                        $config4['source_image'] = './assets/admin/pojokttg/'.$data["file_name"];
                        $config4['create_thumb'] = FALSE;
                        $config4['maintain_ratio'] = FALSE;
                        $config4['width']         = 1280;
                        $config4['height']       = 720;
                        $config4['new_image']= './assets/admin/pojokttg/'.$data['file_name'];
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config4);
                        if (!$this->image_lib->resize()) {
                            echo $this->image_lib->display_errors();
                        }
                        $this->image_lib->clear();
                      } else {
                      

                        $config4['image_library'] = 'gd2';
                        $config4['source_image'] = './assets/admin/pojokttg/'.$data["file_name"];
                        $config4['create_thumb'] = FALSE;
                        $config4['maintain_ratio'] = FALSE;
                        $config4['width']         = 1024;
                        $config4['height']       = 570;
                        //   $config4['width']         = $x_o;
                        // $config4['height']       = $y_o;
                        $config4['new_image']= './assets/admin/pojokttg/'.$data['file_name'];
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
            $data = $this->admin->submitKontenPojokTtg($new_name);
               
            redirect('admin/pojok-ttg');
           
        }

        public function loadListPojokTtg(){
            $data['list_pojokttg'] = $this->admin->loadListPojokTtg();
            $this->load->view('admin/pojokttg/V_ListPojokTtg', $data);
        }

        function updateKontenPojokTtg(){

         
            // $new_name = $this->input->post('nama_gambar_lama');
            // if(isset($_FILES["image_file"]["name"])){ 
            //     $path="./assets/pojokttg";
            //     $konten="image_file";
            //     $this->ajax_upload($path,$konten,$new_name);
            // }

            $data = $this->admin->updateKontenPojokTtg();
            // $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            // echo json_encode($res);
            redirect('admin/pojok-ttg');
        }

        public function deletePojokTtg($id){
            $this->general->delete('id', $id, 't_pojokttg');
        }

        

        public function loadDetailPojokTtg($id){
            $data['pojokttg'] = $this->admin->getPojokTtgDetail($id);
            // dd($data['pojokttg']);
            $this->load->view('admin/pojokttg/V_DetailPojokTtg', $data);
        }


        //  AGENDA

        public function AGENDA(){
       
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/agenda/V_Agenda', 'admin', 'konten', $data);
            
        }


        function submitKontenAgenda(){

            
            $countfiles = count($_FILES['agenda_gambar']['name']);
            // dd($countfiles);
            for($i=0;$i<$countfiles;$i++){
            if(!empty($_FILES['agenda_gambar']['name'][$i])){
      
                // Define new $_FILES array - $_FILES['file']
                $_FILES['file']['name'] = $_FILES['agenda_gambar']['name'][$i];
                $_FILES['file']['type'] = $_FILES['agenda_gambar']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['agenda_gambar']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['agenda_gambar']['error'][$i];
                $_FILES['file']['size'] = $_FILES['agenda_gambar']['size'][$i];
              
     
                $config['upload_path'] = './assets/admin/agenda'; 
                $config['allowed_types'] = 'jpg|jpeg|png';
              
                $this->load->library('upload',$config); 
                if($this->upload->do_upload('file')){
                    $data = $this->upload->data(); 
                
                    if($data["file_size"] > 500){
                        $config4['image_library'] = 'gd2';
                        $config4['source_image'] = './assets/admin/agenda/'.$data["file_name"];
                        $config4['create_thumb'] = FALSE;
                        $config4['maintain_ratio'] = FALSE;
                        $config4['width']         = 1280;
                        $config4['height']       = 720;
                        $config4['new_image']= './assets/admin/agenda/'.$data['file_name'];
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config4);
                        if (!$this->image_lib->resize()) {
                            echo $this->image_lib->display_errors();
                        }
                        $this->image_lib->clear();
                      } else {
                      

                        $config4['image_library'] = 'gd2';
                        $config4['source_image'] = './assets/admin/agenda/'.$data["file_name"];
                        $config4['create_thumb'] = FALSE;
                        $config4['maintain_ratio'] = FALSE;
                        $config4['width']         = 1024;
                        $config4['height']       = 570;
                       
                        $config4['new_image']= './assets/admin/agenda/'.$data['file_name'];
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
            $data = $this->admin->submitKontenAgenda($new_name);
               
            redirect('admin/agenda');
           
        }

          public function loadListAgenda(){
            $data['list_agenda'] = $this->admin->loadListAgenda();
            $this->load->view('admin/agenda/V_ListAgenda', $data);
        }

        function updateKontenAgenda(){
            $data = $this->admin->updateKontenAgenda();
            redirect('admin/agenda');
        }

        public function deleteAgenda($id){
            $this->general->delete('id', $id, 't_agenda');
        }



        // LOGO

        public function aplikasiPublik(){
       
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/logo/V_Logo', 'admin', 'konten', $data);
            
        }

        public function loadListLogo(){
            $data['list_logo'] = $this->admin->loadListLogo();
            $this->load->view('admin/logo/V_ListLogo', $data);
        }

        function submitLogo(){

            $new_name = $_FILES["logo_file"]['name'];
            
            if($_FILES["logo_file"]["name"] != ""){ 
                $path="./assets/admin/logo/";
                $konten="logo_file";
            }
          
            $config_ppid['file_name'] = $new_name;
            $config_ppid['upload_path'] = $path;  
            $config_ppid['allowed_types'] = 'jpg|jpeg|png|pdf'; 
            $full_path = base_url().'assets/admin/logo/'.$new_name;
           
            
            $this->load->library('upload', $config_ppid);  
            $this->upload->overwrite = true;
            
            if(!$this->upload->do_upload($konten))  
            {  
                 echo $this->upload->display_errors();  
            } 

            $dataLogo = $this->upload->data();
        
            $data = $this->admin->submitLogo($new_name);

            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }

        function updateLogo(){

            $data = $this->admin->updateLogo();
            redirect('admin/logo');
        }

        public function deleteLogo($id){
            $this->general->delete('id', $id, 't_logo');
        }



        // DOWNLOAD
        public function download(){
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            $data['list_master_download'] = $this->admin->getMasterJenisDownload();
            render('admin/download/V_Download', 'admin', 'konten', $data);
            
        }


        function submitKontenDownload(){

            // $new_name = time().$_FILES["gambar"]['name'];
            $new_name = str_replace(array( '-',' ',']'), ' ', $_FILES["download_file"]['name']);
            $new_name = $string = str_replace(' ', '', $_FILES["download_file"]['name']);
        //   dd($new_name);

            if($_FILES["download_file"]["name"] != ""){ 
                $path="./assets/admin/download/";
                $konten="download_file";
                // $this->ajax_upload($path,$konten,$new_name);
            }
          
            $config_ppid['file_name'] = $new_name;
            $config_ppid['upload_path'] = $path;  
            $config_ppid['allowed_types'] = 'pdf'; 

           
            
            $this->load->library('upload', $config_ppid);  
            $this->upload->overwrite = true;
            
            if(!$this->upload->do_upload($konten))  
            {  
                 echo $this->upload->display_errors();  
            } 

            
            $data = $this->admin->submitKontenDownload($new_name);
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }

        public function loadListDownload(){
            $data['list_downlaod'] = $this->admin->loadListDownload();
            $this->load->view('admin/download/V_ListDownload', $data);
        }

        public function deleteDownload($id){
            $this->general->delete('id', $id, 't_download');
        }

        function updateKontenDownload(){
            $data = $this->admin->updateKontenDownload();
            redirect('admin/download');
        }


        public function loadDetailAgenda($id){
            $data['agenda'] = $this->admin->getAgendaDetail($id);
            // dd($data['pojokttg']);
            $this->load->view('admin/agenda/V_DetailAgenda', $data);
        }


        public function mainImage(){
       
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/mainimages/V_MainImages', 'admin', 'konten', $data);
            
        }


    

        function submitKontenMainImages(){

            $new_name = $_FILES["mainimage_file"]['name'];
            
            if($_FILES["mainimage_file"]["name"] != ""){ 
                $path="./assets/admin/mainimages/";
                $konten="mainimage_file";
            }

            if($_FILES["mainimage_file"]["type"] == "image/png" || $_FILES["mainimage_file"]["type"] == "image/jpeg"){
                $config['file_name'] = $new_name;
                $config['upload_path'] = $path;  
                $config['allowed_types'] = 'jpg|jpeg|png|pdf'; 
                // $config['create_thumb'] = FALSE;
                // $config['maintain_ratio'] = FALSE;
                // $config['width']         = 1920;
                // $config['height']       = 1080;
               
                
                $this->load->library('upload', $config);  
                $this->upload->overwrite = true;
                
                if(!$this->upload->do_upload($konten))  
                {  
                     echo $this->upload->display_errors();  
                } else {
                    $data = $this->upload->data();
                    // if($data["file_size"] > 500){
                    // $config4['image_library'] = 'gd2';
                    // $config4['source_image'] = './assets/admin/mainimages/'.$data["file_name"];
                    // $config4['create_thumb'] = FALSE;
                    // $config4['maintain_ratio'] = FALSE;
                    // $config4['width']         = 1920;
                    // $config4['height']       = 1080;
                    // $config4['file_name'] = $new_name;
                    // $config4['new_image'] = './assets/admin/mainimages/'.$data['file_name'];
                    // $this->load->library('image_lib');
                    // $this->image_lib->initialize($config4);
                    // if (!$this->image_lib->resize()) {
                    //     echo $this->image_lib->display_errors();
                    // }
                    // $this->image_lib->clear();
                } 
    
                $data = $this->admin->submitKontenMainImages($new_name);
                $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
                echo json_encode($res);
            } else {
                $res = array('msg' => 'File bukan format gambar', 'success' => false);
                echo json_encode($res);
               
            }
          
            
        }

        public function loadListMainImages(){
            $data['list_gambar'] = $this->admin->loadListMainImages();
            $this->load->view('admin/mainimages/V_ListMainImages', $data);
        }


        public function deleteMainImages($id){
            // $this->general->delete('id', $id, 't_main_images');
            // $this->admin->deleteMainImages($id);
            $table = 't_main_images';
            $path = './assets/admin/mainimages/';
            $kolom = 'gambar';
            $type = 1;
            $this->admin->generalDelete($id,$table,$path,$kolom,$type);
           
        }



        public function dokumen(){
       
            $this->general_library->refreshMenu();
            $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
            render('admin/dokumen/V_Dokumen', 'admin', 'konten', $data);
            
        }


        public function loadListDokumen(){
            $data['list_dokumen'] = $this->admin->loadListDokumen();
            $this->load->view('admin/dokumen/V_ListDokumen', $data);
        }

        public function openDokumenDetail($id){
            $data['result'] = $this->admin->openDokumenDetail($id);
            $this->load->view('admin/dokumen/V_DokumenDetail', $data);
        }

        function loadKomentarDokumen($id){
            $data['result'] = $this->admin->loadKomentarDokumen($id);
            $this->load->view('admin/dokumen/V_KomentarDokumenItem', $data);
        }

        function sendCommend($id){
            echo json_encode($this->admin->sendCommend($id));
        }

        function submitDokumen(){

            $new_name = str_replace(array( '-',' ',']'), ' ', $_FILES["dokumen_file"]['name']);
            $new_name = $string = str_replace(' ', '', $_FILES["dokumen_file"]['name']);

            if($_FILES["dokumen_file"]["name"] != ""){ 
                $path="./assets/admin/dokumen/";
                $konten="dokumen_file";
                // $this->ajax_upload($path,$konten,$new_name);
            }
            
          
            $config['file_name'] = $new_name;
            $config['upload_path'] = $path;  
            $config['allowed_types'] = 'jpg|jpeg|png|pdf'; 

        
            $this->load->library('upload', $config);  
            $this->upload->overwrite = true;
            
            if(!$this->upload->do_upload($konten))  
            {  
                 echo $this->upload->display_errors();  
            } 

            
            $data = $this->admin->submitDokumen($new_name);
            // redirect('admin/galeri');
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            echo json_encode($res);
        }

        public function deleteDokumen($id){
            // $this->general->delete('id', $id, 't_dokumen');
            $table = 't_dokumen';
            $path = './assets/admin/dokumen/';
            $kolom = 'file';
            $type = 1;
            $this->admin->generalDelete($id,$table,$path,$kolom,$type);
        
        }

        
}
