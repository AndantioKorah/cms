<?php
	class M_Ttg extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function getTtg(){
            $this->db->select('*')
                    ->from('t_pojokttg')
                    ->order_by('tanggal', 'desc')
                    ->where('flag_active', 1);

            return $this->db->get()->result_array();
        }

        public function getDetailTtg($id){
            $data = $this->db->select('a.*, b.nama')
                            ->from('t_pojokttg a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->where('a.id', $id)
                            ->get()->row_array();
            if($data){
                $data['seen_count'] += 1;
                $this->db->where('id', $id)
                        ->update('t_pojokttg', ['seen_count' => $data['seen_count']]);
            }

            return $data;
        }

        public function getOtherTtg($exclude_id = 0, $limit = 5){
            $this->db->select('a.*, b.nama')
                            ->from('t_pojokttg a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->where('a.flag_active', 1)
                            ->order_by('a.tanggal', 'desc')
                            ->limit($limit);
                            
            if($exclude_id != 0){
                $this->db->where('a.id !=', $exclude_id);
            }

            return $this->db->get()->result_array();
        }

        public function getDatattg($page = 1, $limit = LIMIT_TTG){
            if($page == 1){
                $page = 0;
            } else {
                $page = (floatval($page) - 1) * $limit;
            }

            $rs =  $this->db->query("
            SELECT a.*, b.nama
            FROM t_pojokttg a
            JOIN m_user b ON a.created_by = b.id
            WHERE a.flag_active = 1
            ORDER BY a.tanggal DESC
            LIMIT ".$page.",".$limit)->result_array();

            $all = $this->geTttg();
            
            return [$rs, countTotalPage(count($all), LIMIT_TTG)];
        }
	}
?>