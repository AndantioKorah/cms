<?php
	class M_Download extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getJenisDownload(){
            return $this->db->select('*')
                        ->from('m_jenis_download')
                        ->where('flag_active', 1)
                        ->order_by('jenis_download')
                        ->get()->result_array();
        }

        public function loadDownloadData($id){
            return $this->db->select('a.*, b.nama')
                            ->from('t_download a')
                            ->join('m_user b', 'a.created_by = b.id')
                            ->where('a.jenis', $id)
                            ->where('a.flag_active', 1)
                            ->order_by('a.created_date', 'desc')
                            ->get()->result_array();
        }
	}
?>