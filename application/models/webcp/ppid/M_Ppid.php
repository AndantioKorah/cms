<?php
	class M_Ppid extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getJenisPpid($kategori){
            return $this->db->select('*')
                            ->from('m_jenis_ppid')
                            ->where('id_kategori_ppid', $kategori)
                            ->where('flag_active', 1)
                            ->order_by('nama_jenis')
                            ->get()->result_array();
        }
	}
?>