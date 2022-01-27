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
            $id =  $this->general_library->getId();
            return $this->db->select('*')
                            ->from('t_kegiatan a')
                            ->join('t_rencana_kerja b', 'a.id_t_rencana_kerja = b.id')
                            ->where('a.id_m_user', $id)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }

      

	}
?>