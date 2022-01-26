<?php
	class M_Kinerja extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function createLaporanKegiatan($dataPost,$image){
    
        $data = array('tanggal_kegiatan' => $dataPost['tanggal_kegiatan'], 
                      'deskripsi_kegiatan' => $dataPost['deskripsi_kegiatan'],
                      'bukti_kegiatan' => $image,
                      'id_user_inputer' => $this->general_library->getId()
        );
        $result = $this->db->insert('t_kegiatan', $data);
        }

        public function loadKegiatan(){
            return $this->db->select('*')
                            ->from('t_kegiatan a')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }

      

	}
?>