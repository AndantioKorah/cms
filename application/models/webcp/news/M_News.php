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

        public function getAllNews($page = 1, $limit = LIMIT_NEWS){
            $result = null;
            $total = $this->db->select('count(*) as total')
                                ->from('t_berita')
                                ->where('flag_active', 1)
                                ->get()->row_array();

            $total_page = countTotalPage($total['total'], $limit);
            $active_page = $page;
            $data = $this->getNewsByPage($page, $limit);


            return [$data, $total_page, $active_page];
        }

        public function getNewsByPage($page = 1, $limit = LIMIT_NEWS){
            // $dum = $this->db->select('a.nm_unitkerja')
            //                 ->from('db_pegawai.unitkerja a')
            //                 ->join('db_pegawai.unitkerjamaster b', 'a.id_unitkerjamaster = b.id_unitkerjamaster')
            //                 // ->where('a.id_unitkerjamaster', 5011001)
            //                 ->like('a.nm_unitkerja', 'Kecamatan')
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
            SELECT a.*, b.nama
            FROM t_berita a
            JOIN m_user b ON a.created_by = b.id
            WHERE a.flag_active = 1
            ORDER BY a.tanggal_berita DESC
            LIMIT ".$page.",".$limit)->result_array();
        }

        public function getDetailNews($id){
            

            $data = $this->db->select('a.*, b.nama')
                            ->from('t_berita a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->where('a.id', $id)
                            ->get()->row_array();
            if($data){
                $data['seen_count'] += 1;
                $this->db->where('id', $id)
                        ->update('t_berita', ['seen_count' => $data['seen_count']]);
            }

            return $data;
        }

        public function getOtherNews($exclude_id = 0, $limit = 5){
            $this->db->select('a.*, b.nama')
                            ->from('t_berita a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->order_by('a.tanggal_berita', 'desc')
                            ->limit($limit);
                            
            if($exclude_id != 0){
                $this->db->where('a.id !=', $exclude_id);
            }

            return $this->db->get()->result_array();
        }

        public function searchNews($data){
            return $this->db->select('a.*, b.nama')
                            ->from('t_berita a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->like('a.judul_ina', $data['input_search'])
                            ->order_by('a.tanggal_berita', 'desc')
                            ->limit(LIMIT_NEWS)
                            ->get()->result_array();
        }
	}
?>