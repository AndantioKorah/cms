<?php
	class M_Covid extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getAllCovidRegulasi(){
            return $this->db->select('*')
                            ->from('t_covid_regulasi a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->where('a.flag_active', 1)
                            ->order_by('a.tanggal', 'desc')
                            ->get()->result_array();
        }

        public function getDataCovidRegulasi($page = 1, $limit = LIMIT_COVID_REGULASI){
            if($page == 1){
                $page = 0;
            } else {
                $page = (floatval($page) - 1) * $limit;
            }

            $rs =  $this->db->query("
            SELECT a.*, b.nama as created_by
            FROM t_covid_regulasi a
            JOIN m_user b ON a.created_by = b.id
            WHERE a.flag_active = 1
            ORDER BY a.created_date DESC
            LIMIT ".$page.",".$limit)->result_array();

            $all = $this->getAllCovidRegulasi();

            $total_page = countTotalPage(count($all), LIMIT_COVID_REGULASI);

            return [$rs, $total_page];
        }

        public function getAllCovidInfografis(){
            return $this->db->select('*')
                            ->from('t_covid_infografis a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->where('a.flag_active', 1)
                            ->order_by('a.tanggal', 'desc')
                            ->get()->result_array();
        }

        public function getDataCovidInfografis($page = 1, $limit = LIMIT_COVID_INFOGRAFIS){
            if($page == 1){
                $page = 0;
            } else {
                $page = (floatval($page) - 1) * $limit;
            }

            $rs =  $this->db->query("
            SELECT a.*, b.nama as created_by
            FROM t_covid_infografis a
            JOIN m_user b ON a.created_by = b.id
            WHERE a.flag_active = 1
            ORDER BY a.created_date DESC
            LIMIT ".$page.",".$limit)->result_array();

            $all = $this->getAllCovidInfografis();

            $total_page = countTotalPage(count($all), LIMIT_COVID_INFOGRAFIS);

            return [$rs, $total_page];
        }

        public function getAllCovidVideo(){
            return $this->db->select('*')
                            ->from('t_covid_video a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->where('a.flag_active', 1)
                            ->order_by('a.tanggal', 'desc')
                            ->get()->result_array();
        }

        public function getDataCovidVideo($page = 1, $limit = LIMIT_COVID_VIDEO){
            if($page == 1){
                $page = 0;
            } else {
                $page = (floatval($page) - 1) * $limit;
            }

            $rs =  $this->db->query("
            SELECT a.*, b.nama as created_by
            FROM t_covid_video a
            JOIN m_user b ON a.created_by = b.id
            WHERE a.flag_active = 1
            ORDER BY a.created_date DESC
            LIMIT ".$page.",".$limit)->result_array();

            $all = $this->getAllCovidVideo();

            $total_page = countTotalPage(count($all), LIMIT_COVID_VIDEO);

            return [$rs, $total_page];
        }
	}
?>