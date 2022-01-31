<?php
	class M_VerifKinerja extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }


        public function searchVerifKinerja($data){
            $range = explodeRangeDate($data['range_periode']);
            $startDate = explode("-", $range[0]);
            $endDate = explode("-", $range[1]);

            $startDate = $startDate[0].'-'.$startDate[2].'-'.$startDate[1];
            $endDate = $endDate[0].'-'.$endDate[2].'-'.$endDate[1];

            $role = $this->general_library->getRole();
            $vt = $this->db->select('*')
                        ->from('t_verif_tambahan')
                        ->where('id_m_user', $this->general_library->getId())
                        ->where('flag_active', 1)
                        ->get()->result_array();

            $list_user_tambahan = null;
            $list_bidang_tambahan = null;
            if($vt){
                foreach($vt as $v){
                    if($v['id_m_sub_bidang']){
                        $list_bidang_tambahan[] = $v['id_m_sub_bidang'];
                    } else {
                        $list_user_tambahan[] = $v['id_m_user_verif'];
                    }
                }
            }
            
            $this_user = $this->db->select('*')
                                ->from('m_user a')
                                ->join('pegawai b', 'a.username = b.nipbaru_ws')
                                ->where('a.id', $this->general_library->getId())
                                ->where('a.flag_active', 1)
                                ->get()->row_array();

            $list_pegawai = null;
            if($role == 'subkoordinator'){
                //pegawai yang diverif adalah staf pelaksana di sub bidang yang sama
                $list_pegawai = $this->db->select('*, id as id_m_muser')
                                        ->from('m_user')
                                        ->where('id_m_sub_bidang', $this_user['id_m_sub_bidang'])
                                        ->where('flag_active', 1)
                                        ->get()->result_array();
            } else if($role == 'kepalabidang' || $role == 'sekretarisbadan'){
                //pegawai yang diverif adalah subkoordinator di bidang yang sama
                $subbidang = $this->db->select('*')
                                        ->from('m_sub_bidang a')
                                        ->where('a.id_m_sub_bidang', $this_user['id_m_sub_bidang'])
                                        ->where('a.flag_active', 1)
                                        ->get()->row_array();
                $list_role = ['subkoordinator'];
                $list_pegawai = $this->db->select('*, a.id as id_m_muser')
                                        ->from('m_user a')
                                        ->join('m_sub_bidang b', 'a.id_m_sub_bidang = b.id')
                                        ->join('m_role c', 'a.id = c.id_m_user')
                                        ->where('b.id_m_bidang', $subbidang['id_m_bidang'])
                                        ->where_in('c.role_name', $list_role)
                                        ->where('a.flag_active', 1)
                                        ->where('c.flag_active', 1)
                                        ->get()->result_array();
            } else if($role == 'kepalabadan'){
                //pegawai yang diverif adalah kepala bidang atau sekretaris di instansi yang sama
                $list_bidang = null;
                $bidang = $this->db->select('*')
                                ->from('m_bidang')
                                ->where('flag_active', 1)
                                ->where('id_unit_kerja', $this_user['id_unit_kerja'])
                                ->get()->result_array();
                if($bidang){
                    foreach($bidang as $b){
                        $list_bidang[] = $b['id'];
                    }
                }
                
                $list_role = ['kepalabidang', 'sekretarisbadan'];
                $list_pegawai = $this->db->select('*, a.id as id_m_muser')
                                        ->from('m_user a')
                                        ->join('m_role b', 'a.id = b.id_m_user')
                                        ->join('m_sub_bidang c', 'c.id = a.id_m_sub_bidang')
                                        ->where_in('b.role_name', $list_role)
                                        ->where_in('c.id_m_bidang', $list_bidang)
                                        ->where('a.flag_active', 1)
                                        ->where('c.flag_active', 1)
                                        ->get()->result_array();
            }
            $list_id_pegawai = array();
            if($list_pegawai){
                foreach($list_pegawai as $lp){
                    $list_id_pegawai[] = $lp['id_m_user'];
                }
            }

            if($list_user_tambahan){
                foreach($list_user_tambahan as $lut){
                    $list_id_pegawai[] = $lut;
                }
            }

            if($list_bidang_tambahan){
                $pegawai = $this->db->select('*, a.id as id_m_user')
                                    ->from('m_user a')
                                    ->where_in('a.id_m_sub_bidang', $list_bidang_tambahan)
                                    ->where('a.flag_active', 1)
                                    ->get()->result_array();

                if($pegawai){
                    foreach($pegawai as $p){
                        $list_id_pegawai[] = $p['id_m_user'];
                    }
                }
            }
            
            $list_kerja = $this->db->select('*, a.id as id_t_kegiatan, a.created_date as tanggal_kegiatan, a.target_kuantitas as realisasi_target_kuantitas')
                                ->from('t_kegiatan a')
                                ->join('t_rencana_kinerja b', 'a.id_t_rencana_kinerja = b.id')
                                ->join('m_user c', 'a.id_m_user = c.id')
                                ->where('a.flag_active', 1)
                                ->where_in('a.id_m_user', $list_id_pegawai)
                                ->where('a.created_date >=', $startDate.' 00:00:00')
                                ->where('a.created_date <=', $endDate.' 23:59:59')
                                ->order_by('a.created_date', 'desc')
                                ->group_by('a.id')
                                ->get()->result_array();

            return $list_kerja;
        }
	}
?>