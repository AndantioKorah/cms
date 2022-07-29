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
                    ->where('flag_active', 1);

            if($tipe != 0){
                $this->db->where('jenis', $tipe);
            }

            return $this->db->get()->result_array();
        }
	}
?>