<?php
	class M_Admin extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function delete($fieldName, $fieldValue, $tableName)
        {
            $this->db->where($fieldName, $fieldValue)
                        ->update($tableName, ['flag_active' => 0, 'updated_by' => $this->general_library->getId()]);
        }

        public function submitKontenBerita($new_name){

            $datapost = $this->input->post();
            $tags = explode(',',$this->input->post('tag_berita'));
            // dd($tag);
            foreach ($tags as $tg){
                $tag[] = $tg;

            }
            // dd($datapost);
            $data["judul_ina"] = $datapost["berita_judul_ina"];
            $data["tag_berita"] = json_encode($tag);
            $data["tanggal_berita"] = $datapost["tanggal_berita"];
            $data["isi_berita"] = $datapost["isi_berita"];
            $data["gambar"] = $new_name;
            $this->db->insert('t_berita', $data);
            return $this->db->insert_id();
        }

        function loadListBerita(){
            $query = $this->db->select('*')
                            ->from('t_berita a')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
            return $query; 
        }


        public function updateKontenBerita(){
            $datapost = $this->input->post(); 

            $tags = explode(',',$datapost["detail_tag_berita"]);
            // dd($tag);
            foreach ($tags as $tg){
                $tag[] = $tg;

            }
                   
            $data["judul_ina"] = $datapost["detail_judul_ina"];
            $data["tag_berita"] = json_encode($tag);
            $data["tanggal_berita"] = $datapost["detail_tanggal_berita"];
            $data["isi_berita"] = $datapost["detail_isi_berita"];
            // $data["gambar"] = $_FILES["berita_gambar"]["name"];

            $id =  $datapost["id"];

            $this->db->where('id', $id)
                ->update('t_berita', $data);
        }


        function loadProfil(){
            $query = $this->db->select('*')
                            ->from('t_profil a')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
            return $query; 
        }

        public function submitKontenProfil($new_name){

            $exist = $this->db->select('*')
                                ->from('t_profil')
                                ->where('flag_active', 1)
                                ->get()->row_array();
            if($exist) {
                $datapost = $this->input->post();
                $data["visi"] = $datapost["profil_visi"];
                $data["misi"] = $datapost["profil_misi"];
                $data["motto"] = $datapost["profil_motto"];
                $data["tupoksi"] = $datapost["profil_tupoksi"];
                $data["struktur_organisasi"] = $new_name;
                $this->db->where('id', 3)
                ->update('t_profil', $data);
                return 0;
            } else {
                $datapost = $this->input->post();
                $data["visi"] = $datapost["profil_visi"];
                $data["misi"] = $datapost["profil_misi"];
                $data["motto"] = $datapost["profil_motto"];
                $data["tupoksi"] = $datapost["profil_tupoksi"];
                $data["struktur_organisasi"] = $new_name;
                $this->db->insert('t_profil', $data);
                return $this->db->insert_id();
            }

           
        }


        public function getBeritaDetail($id){
            return $this->db->select('*')
                            ->from('t_berita a')
                            ->where('a.id', $id)
                            ->where('a.flag_active', 1)
                            ->limit(1)
                            ->get()->row_array();
        }



        public function submitKontenGaleri($new_name){

           
                $datapost = $this->input->post();
                $data["nama"] = $datapost["judul_gambar"];
                $data["gambar"] = $new_name;
                $this->db->insert('t_galeri', $data);
                return $this->db->insert_id();
            

           
        }


        function loadListGaleri(){
            $query = $this->db->select('*')
                            ->from('t_galeri a')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
            return $query; 
        }


	}
?>