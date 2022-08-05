<?php
	class M_Announcement extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getAllAnnouncement(){
            return $this->db->select('*')
                            ->from('t_pengumuman a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->where('a.flag_active', 1)
                            ->order_by('a.tanggal', 'desc')
                            ->get()->result_array();
        }

        public function getDataAnnouncement($page = 1, $limit = LIMIT_ANNOUNCEMENT){
            if($page == 1){
                $page = 0;
            } else {
                $page = (floatval($page) - 1) * $limit;
            }

            $rs =  $this->db->query("
            SELECT a.*, b.nama as created_by
            FROM t_pengumuman a
            JOIN m_user b ON a.created_by = b.id
            WHERE a.flag_active = 1
            ORDER BY a.created_date DESC
            LIMIT ".$page.",".$limit)->result_array();

            $all = $this->getAllAnnouncement();

            $total_page = countTotalPage(count($all), LIMIT_ANNOUNCEMENT);

            return [$rs, $total_page];
        }
	}
?>