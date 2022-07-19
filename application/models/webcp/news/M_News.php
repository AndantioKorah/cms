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
                                ->from('pegawai')
                                // ->where('flag_active', 1)
                                ->get()->row_array();
            // dd($total);
            $total_page = 0;
            if($total['total'] > 0){
                $total_page = intval($total['total'] / $limit);
                if(fmod($total_page, $limit) != 0){
                    $total_page++;
                }
            }
            $active_page = $page;
            // $limit = $page.','.$limit;
            // $data =  $this->db->select('*')
            //             ->from('m_menus')
            //             ->where('flag_active', 1)
            //             ->order_by('created_date', 'desc')
            //             ->limit($page, $limit)
            //             ->get()->result_array();
            $data = $this->getNewsByPage($page, $limit);


            return [$data, $total_page, $active_page];
        }

        public function getNewsByPage($page = 1, $limit = 10){
            if($page == 1){
                $page = 0;
            } else {
                $page = (floatval($page) - 1) * $limit;
            }

            return $this->db->query("
            SELECT *
            FROM pegawai
            ORDER BY nama DESC
            LIMIT ".$page.",".$limit)->result_array();
        }

	}
?>