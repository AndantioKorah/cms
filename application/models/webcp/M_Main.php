<?php
	class M_Main extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getListMenu(){
            $this->db->select('a.*')
                    ->from('m_menu a')
                    ->where('a.id_m_menu_parent', 0)
                    ->where('a.flag_active', 1)
                    ->where('a.flag_menu_admin', 0)
                    // ->or_where('a.flag_general_menu = 1 AND a.id_m_menu_parent = 0')
                    ->order_by('a.urutan', 'asc')
                    ->group_by('a.id');
            $list_menu = $this->db->get()->result_array();
            if($list_menu){
                $i = 0;
                foreach($list_menu as $l){
                    $list_menu[$i]['child'] = null;
                    $child = null;
                    $this->db->select('*, a.id as id_m_menu')
                        ->from('m_menu a')
                        ->where('a.id_m_menu_parent', $l['id'])
                        ->where('a.flag_active', 1)
                        ->where('a.flag_menu_admin', 0)
                        // ->or_where('a.flag_general_menu = 1 AND a.id_m_menu_parent = "'.$l["id"].'"')
                        ->group_by('a.id')
                        ->order_by('a.urutan', 'asc');
                    $child = $this->db->get()->result_array();
                    $list_menu[$i]['child'] = $child;
                    $i++;
                }
                // dd($list_menu);
            }
            return $list_menu;
        }

        public function getDataStatistic(){
            $today = date('Y-m-d');
            $minggu_ini = date('Y-m-d', strtotime("monday this week"));
            $data['total_hit'] = 0;
            $data['hari_ini'] = 0;
            $data['minggu_ini'] = 0;
            $data['bulan_ini'] = 0;
            $data['tahun_ini'] = 0;

            $all = $this->db->select('sum(count) as total')
                    ->from('t_statistik')
                    ->where('flag_active', 1)
                    ->get()->row_array();

            if($all){
                $data['total_hit'] = $all['total'];
            }

            $res = $this->db->select('*')
                            ->from('t_statistik')
                            ->where('YEAR(tanggal) =', date('Y'))
                            ->order_by('tanggal')
                            ->where('flag_active', 1)
                            ->get()->result_array();
            if($res){
                foreach($res as $r){
                    // $curdate = strtotime($r['tanggal']);
                    $data['tahun_ini'] += $r['count'];
                    $tmp_tanggal = explode("-", $r['tanggal']);
                    if($tmp_tanggal[1] == date('m')){
                        $data['bulan_ini'] += $r['count'];
                    }
                    
                    if(($r['tanggal'] >= $minggu_ini) && ($r['tanggal'] <= $today)){
                        $data['minggu_ini'] += $r['count'];
                    }

                    if($r['tanggal'] == date('Y-m-d')){
                        $data['hari_ini'] = $r['count'];
                    }
                }
            }
            
            return $data;
        }

        public function getDataAplikasiPublik(){
            return $this->db->select('*')
                            ->from('t_aplikasi_publik')
                            ->where('flag_active', 1)
                            ->get()->result_array();
        }

        public function getDataMainImages(){
            return $this->db->select('*')
                            ->from('t_main_images')
                            ->where('flag_active', 1)
                            ->get()->result_array();
        }
	}
?>