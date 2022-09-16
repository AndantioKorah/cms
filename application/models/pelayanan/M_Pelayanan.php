<?php
	class M_Pelayanan extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
            $this->load->library('Webservicelib', 'webservicelib');
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }


    }
?>