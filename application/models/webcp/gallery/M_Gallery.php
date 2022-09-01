<?php
	class M_Gallery extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getGallery($tipe = 0){
            $this->db->select('*')
                    ->from('t_galeri')
                    ->where('flag_active', 1)
                    ->order_by('tanggal', 'desc');

            if($tipe != 0){
                $this->db->where('jenis', $tipe);
            }

            return $this->db->get()->result_array();
        }

        public function getImageGallery($page = 1, $limit = LIMIT_GALLERY){
            if($page == 1){
                $page = 0;
            } else {
                $page = (floatval($page) - 1) * $limit;
            }

            $rs =  $this->db->query("
            SELECT a.*, b.nama as created_by
            FROM t_galeri a
            JOIN m_user b ON a.created_by = b.id
            WHERE a.flag_active = 1
            AND a.jenis = 1
            ORDER BY a.tanggal DESC
            LIMIT ".$page.",".$limit)->result_array();

            $all = $this->getGallery(1);

            return [$rs, countTotalPage(count($all), LIMIT_GALLERY)];
        }

        public function getVideoGallery($page = 1, $limit = LIMIT_GALLERY){
            if($page == 1){
                $page = 0;
            } else {
                $page = (floatval($page) - 1) * $limit;
            }

            $rs =  $this->db->query("
            SELECT a.*, b.nama as created_by
            FROM t_galeri a
            JOIN m_user b ON a.created_by = b.id
            WHERE a.flag_active = 1
            AND a.jenis = 2
            ORDER BY a.tanggal DESC
            LIMIT ".$page.",".$limit)->result_array();

            $all = $this->getGallery(2);

            return [$rs, countTotalPage(count($all), LIMIT_GALLERY)];
        }
	}
?>