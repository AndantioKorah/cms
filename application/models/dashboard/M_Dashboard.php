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

        public function getDataSkpdOld($id_skpd){
            return $this->db->select('*')
                            ->from('db_pegawai.pegawai a')
                            ->join('m_user b', 'a.nipbaru_ws = b.username')
                            ->join('db_pegawai.unitkerja c', 'a.skpd = c.id_unitkerja')
                            ->where('a.skpd', $id_skpd)
                            ->where('b.flag_active', 1)
                            ->get()->row_array();
        }

        public function getDataSkpd($id_skpd){
            return $this->db->select('*')
                            ->from('db_pegawai.unitkerja')
                            ->where('id_unitkerja', $id_skpd)
                            ->get()->row_array();
        }

        public function getDataDashboard($data){
            $result['belum_verif']  = 0;
            $result['batal_verif'] = 0;
            $result['verif_diterima'] = 0;
            $result['verif_ditolak'] = 0;
            $result['nilai_capaian'] = 0;
            $result['total_progress'] = 0;
            $result['total_target'] = 0;
            $result['total_realisasi_target'] = 0;
            $id_skpd = $this->general_library->getUnitKerjaPegawai();
            if(isset($data['skpd'])){
                $id_skpd = $data['skpd'];
            }

            if($this->general_library->isKabid()){
                $bidang = $this->db->select('a.id')
                                ->from('m_bidang a')
                                ->join('m_sub_bidang b', 'a.id = b.id_m_bidang')
                                ->where('b.id', $this->general_library->getSubBidangUser())
                                ->get()->row_array();
                if($bidang){
                    $data['bidang'] = $bidang['id'];
                }
            }

            $this->db->select('*')
                    ->from('t_rencana_kinerja a')
                    ->join('m_user b', 'a.id_m_user = b.id')
                    ->join('db_pegawai.pegawai c', 'b.username = c.nipbaru_ws')
                    ->where('c.skpd', $id_skpd)
                    ->where('a.bulan', $data['bulan'])
                    ->where('a.tahun', $data['tahun'])
                    ->where('a.flag_active', 1);
            if($data['bidang'] != 0){
                $this->db->join('m_sub_bidang d', 'b.id_m_sub_bidang = d.id')
                        ->where('d.id_m_bidang', $data['bidang']);
            }
            if($data['sub_bidang'] != 0){
                $this->db->where('b.id_m_sub_bidang', $data['sub_bidang']);
            }
            $result['rencana_kinerja'] = $this->db->get()->result_array();


            $this->db->select('*')
                    ->from('t_kegiatan a')
                    ->join('t_rencana_kinerja b', 'b.id = a.id_t_rencana_kinerja', 'left')
                    ->join('m_user c', 'b.id_m_user = c.id')
                    ->join('db_pegawai.pegawai d', 'c.username = d.nipbaru_ws')
                    ->where('d.skpd', $id_skpd)
                    ->where('a.flag_active', 1)
                    ->where('b.flag_active', 1)
                    ->where('b.bulan', $data['bulan'])
                    ->where('b.tahun', $data['tahun']);
            if($data['bidang'] != 0){
                $this->db->join('m_sub_bidang e', 'c.id_m_sub_bidang = e.id')
                        ->where('e.id_m_bidang', $data['bidang']);
            }
            if($data['sub_bidang'] != 0){
                $this->db->where('c.id_m_sub_bidang', $data['sub_bidang']);
            }
            $result['realisasi'] = $this->db->get()->result_array();
            
            if($result['rencana_kinerja']){
                $total_realisasi = 0;
                $total_target = 0;
                foreach($result['rencana_kinerja'] as $rk){
                    $total_realisasi += $rk['total_realisasi'];
                    $total_target += $rk['target_kuantitas'];
                }
                $result['total_progress'] = ($total_realisasi / $total_target) * 100;
            }

            if($result['realisasi']){
                foreach($result['realisasi'] as $k){
                    $result['total_target'] += $k['target_kuantitas'];
                    if($k['status_verif'] == 0){
                        $result['belum_verif']++;
                    } else if($k['status_verif'] == 1){
                        $result['total_realisasi_target'] += $k['realisasi_target_kuantitas'];
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

        public function getBidangBySkpd($id){
            return $this->db->select('*')
                            ->from('m_bidang a')
                            ->where('a.id_unitkerja', $id)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }

        public function loadSubBidangByBidang($id){
            return $this->db->select('*')
                            ->from('m_bidang a')
                            ->join('m_sub_bidang b', 'a.id = b.id_m_bidang')
                            ->where('a.id', $id)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }

        // public function loadBidangByUnitKerja($id){
        //     return $this->db->select('*')
        //                     ->from('m_bidang a')
        //                     ->where('a.id_unitkerja', $id)
        //                     ->where('a.flag_active', 1)
        //                     ->get()->result_array();
        // }
	}
?>