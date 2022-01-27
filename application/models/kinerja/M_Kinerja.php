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
                      'target_kuantitas' => $dataPost['target_kuantitas'],
                      'satuan' => $dataPost['satuan'],
                      'target_kualitas' => $dataPost['target_kualitas'],
                      'id_t_rencana_kinerja' => $dataPost['tugas_jabatan'],
                      'bukti_kegiatan' => $image,
                      'id_m_user' => $this->general_library->getId()
        );
        $result = $this->db->insert('t_kegiatan', $data);
        }

        public function loadKegiatan(){
            $id =  $this->general_library->getId();
            return $this->db->select('*')
                            ->from('t_kegiatan a')
                            ->join('t_rencana_kinerja b', 'a.id_t_rencana_kinerja = b.id')
                            ->where('a.id_m_user', $id)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }


        public function loadRencanaKinerja(){
            $id =  $this->general_library->getId();
            return $this->db->select('*')
                            ->from('t_rencana_kinerja a')
                            ->where('a.id_m_user', $id)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }


        public function getRencanaKinerja(){
            $id =  $this->general_library->getId();
            return $this->db->select('*')
                            ->from('t_rencana_kinerja as a')
                            ->where('a.id_m_user', $id)
                            ->get()->result_array();
        }

        public function getSatuan()
    {      
        $id = $this->input->post('id_t_rencana_kinerja');
        $this->db->select('*')
            ->from('t_rencana_kinerja as a')
            ->where('a.id', $id)
            ->where('a.flag_active', 1)
            ->limit(1);
            return $this->db->get()->result_array();
    }

      

	}
?>