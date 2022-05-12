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
                            ->from('db_pegawai.unitkerja')
                            ->order_by('nm_unitkerja', 'asc')
                            ->get()->result_array();
        }

        public function loadMasterBidang(){
            return $this->db->select('*')
                            ->from('m_bidang a')
                            ->join('db_pegawai.unitkerja b', 'a.id_unitkerja = b.id_unitkerja')
                            ->where('a.flag_active', 1)
                            ->order_by('a.nama_bidang', 'asc')
                            ->get()->result_array();
        }

        public function loadMasterBidangByUnitKerja($id_unitkerja){
            return $this->db->select('*')
                            ->from('m_bidang a')
                            ->join('db_pegawai.unitkerja b', 'a.id_unitkerja = b.id_unitkerja')
                            ->where('a.id_unitkerja', $id_unitkerja)
                            ->where('a.flag_active', 1)
                            ->order_by('a.nama_bidang', 'asc')
                            ->get()->result_array();
        }

        public function loadMasterSubBidang(){
            return $this->db->select('*, a.id as id_m_sub_bidang')
                            ->from('m_sub_bidang a')
                            ->join('m_bidang b', 'a.id_m_bidang = b.id')
                            ->join('db_pegawai.unitkerja c', 'b.id_unitkerja = c.id_unitkerja')
                            ->where('a.flag_active', 1)
                            ->order_by('a.nama_sub_bidang', 'asc')
                            ->get()->result_array();
        }

        public function loadMasterSubBidangByUnitKerja($id_unitkerja){
            return $this->db->select('*, a.id as id_m_sub_bidang')
                            ->from('m_sub_bidang a')
                            ->join('m_bidang b', 'a.id_m_bidang = b.id')
                            ->join('db_pegawai.unitkerja c', 'b.id_unitkerja = c.id_unitkerja')
                            ->where('a.flag_active', 1)
                            ->where('b.id_unitkerja', $id_unitkerja)
                            ->order_by('a.nama_sub_bidang', 'asc')
                            ->get()->result_array();
        }

        public function searchPegawaiBySkpd($data){
            return $this->db->select('a.nipbaru, a.nama, a.gelar1, a.gelar2, b.nm_pangkat, a.tmtpangkat, a.tmtcpns, d.nm_unitkerja,
            (select c.nm_jabatan from db_pegawai.pegjabatan as c where c.id_pegawai = a.id_peg ORDER BY tglsk desc limit 1) as jabatan')
                            ->from('db_pegawai.pegawai a')
                            ->join('db_pegawai.pangkat b', 'a.pangkat = b.id_pangkat')
                            ->join('db_pegawai.unitkerja d', 'a.skpd = d.id_unitkerja')
                            ->where('a.skpd', $data['id_unitkerja'])
                            ->order_by('a.nama', 'asc')
                            ->get()->result_array();
        }

	}
?>