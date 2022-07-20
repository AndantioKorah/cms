<?php
	class M_News extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getAllNews($page = 1, $limit = 10){
            $result = null;
            $total = $this->db->select('count(*) as total')
                                ->from('t_berita')
                                ->where('flag_active', 1)
                                ->get()->row_array();
            $total_page = 0;
            if($total['total'] > 0){
                $total_page = intval($total['total'] / $limit);
                if(fmod($total['total'], $limit) != 0){
                    $total_page++;
                }
            }
            $active_page = $page;
            $data = $this->getNewsByPage($page, $limit);


            return [$data, $total_page, $active_page];
        }

        public function getNewsByPage($page = 1, $limit = 10){
            // $dum = $this->db->select('a.nm_unitkerja')
            //                 ->from('db_pegawai.unitkerja a')
            //                 ->join('db_pegawai.unitkerjamaster b', 'a.id_unitkerjamaster = b.id_unitkerjamaster')
            //                 ->where('a.id_unitkerjamaster', 4000000)
            //                 ->order_by('a.nm_unitkerja')
            //                 ->get()->result_array();
            // $i = 1;
            // while($i <= 2){
            //     foreach($dum as $d){
            //         echo $d['nm_unitkerja'].'<br>';
            //     }
            //     $i++;
            // }
            // die();                            

            if($page == 1){
                $page = 0;
            } else {
                $page = (floatval($page) - 1) * $limit;
            }

            return $this->db->query("
            SELECT *
            FROM t_berita
            WHERE flag_active = 1
            ORDER BY created_date DESC
            LIMIT ".$page.",".$limit)->result_array();
        }

	}
?>