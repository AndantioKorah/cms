<?php
	class M_Dashboard extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getAllSkpd(){
            return $this->db->select('id_unitkerja, nm_unitkerja')
                            ->from('db_pegawai.unitkerja')
                            ->order_by('nm_unitkerja', 'asc')
                            ->get()->result_array();
        }

        public function getDataSkpd(){
            return $this->db->select('*')
                            ->from('db_pegawai.pegawai a')
                            ->join('m_user b', 'a.nipbaru_ws = b.username')
                            ->join('db_pegawai.unitkerja c', 'a.skpd = c.id_unitkerja')
                            ->where('a.skpd', $this->general_library->getUnitKerjaPegawai())
                            ->where('b.flag_active', 1)
                            ->get()->result_array();
        }

        public function getDataDashboard(){
            $result['belum_verif']  = 0;
            $result['batal_verif'] = 0;
            $result['verif_diterima'] = 0;
            $result['verif_ditolak'] = 0;

            $result['rencana_kinerja'] = $this->db->select('*')
                            ->from('db_pegawai.pegawai a')
                            ->join('m_user b', 'a.nipbaru_ws = b.username')
                            ->join('db_pegawai.unitkerja c', 'a.skpd = c.id_unitkerja')
                            ->join('t_rencana_kinerja d', 'b.id = d.created_by')
                            ->where('a.skpd', $this->general_library->getUnitKerjaPegawai())
                            ->where('b.flag_active', 1)
                            ->where('d.flag_active', 1)
                            ->get()->result_array();
            
            $result['realisasi'] = $this->db->select('*')
                            ->from('db_pegawai.pegawai a')
                            ->join('m_user b', 'a.nipbaru_ws = b.username')
                            ->join('db_pegawai.unitkerja c', 'a.skpd = c.id_unitkerja')
                            ->join('t_rencana_kinerja d', 'b.id = d.created_by')
                            ->join('t_kegiatan e', 'd.id = e.id_t_rencana_kinerja')
                            ->where('a.skpd', $this->general_library->getUnitKerjaPegawai())
                            ->where('b.flag_active', 1)
                            ->where('d.flag_active', 1)
                            ->where('e.flag_active', 1)
                            ->get()->result_array();

            if($result['realisasi']){
                foreach($result['realisasi'] as $k){
                    if($k['status_verif'] == 0){
                        $result['belum_verif']++;
                    } else if($k['status_verif'] == 1){
                        $result['verif_diterima']++;
                    } else if($k['status_verif'] == 2){
                        $result['verif_ditolak']++;
                    } else if($k['status_verif'] == 3){
                        $result['batal_verif']++;
                    }
                }
            }

            return $result;
        }
	}
?>