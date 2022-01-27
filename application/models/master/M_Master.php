<?php
	class M_Master extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getAllUnitKerja(){
            return $this->db->select('*')
                            ->from('unitkerja')
                            ->order_by('nm_unitkerja', 'asc')
                            ->get()->result_array();
        }

        public function loadMasterBidang(){
            return $this->db->select('*')
                            ->from('m_bidang a')
                            ->join('unitkerja b', 'a.id_unitkerja = b.id_unitkerja')
                            ->where('a.flag_active', 1)
                            ->order_by('a.nama_bidang', 'asc')
                            ->get()->result_array();
        }

        public function loadMasterSubBidang(){
            return $this->db->select('*, a.id as id_m_sub_bidang')
                            ->from('m_sub_bidang a')
                            ->join('m_bidang b', 'a.id_m_bidang = b.id')
                            ->join('unitkerja c', 'b.id_unitkerja = c.id_unitkerja')
                            ->where('a.flag_active', 1)
                            ->order_by('a.nama_sub_bidang', 'asc')
                            ->get()->result_array();
        }

	}
?>