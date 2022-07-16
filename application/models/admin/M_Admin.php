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
            $data["judul_ina"] = $datapost["berita_judul_ina"];
            $data["judul_eng"] = $datapost["berita_judul_eng"];
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
            $data["judul_ina"] = $datapost["detail_judul_ina"];
            $data["judul_eng"] = $datapost["detail_judul_eng"];
            $data["tanggal_berita"] = $datapost["detail_tanggal_berita"];
            $data["isi_berita"] = $datapost["detail_isi_berita"];
            // $data["gambar"] = $_FILES["berita_gambar"]["name"];

            $id =  $datapost["id"];

            $this->db->where('id', $id)
                ->update('t_berita', $data);
        }


	}
?>