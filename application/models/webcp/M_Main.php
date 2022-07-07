<?php
	class M_Main extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getListMenu(){
            $this->db->select('a.*')
                    ->from('m_menu a')
                    ->where('a.id_m_menu_parent', 0)
                    ->where('a.flag_active', 1)
                    ->where('a.flag_menu_admin', 0)
                    // ->or_where('a.flag_general_menu = 1 AND a.id_m_menu_parent = 0')
                    ->order_by('a.urutan', 'asc')
                    ->group_by('a.id');
            $list_menu = $this->db->get()->result_array();
            if($list_menu){
                $i = 0;
                foreach($list_menu as $l){
                    $list_menu[$i]['child'] = null;
                    $child = null;
                    $this->db->select('*, a.id as id_m_menu')
                        ->from('m_menu a')
                        ->where('a.id_m_menu_parent', $l['id'])
                        ->where('a.flag_active', 1)
                        ->where('a.flag_menu_admin', 0)
                        // ->or_where('a.flag_general_menu = 1 AND a.id_m_menu_parent = "'.$l["id"].'"')
                        ->group_by('a.id')
                        ->order_by('a.urutan', 'asc');
                    $child = $this->db->get()->result_array();
                    $list_menu[$i]['child'] = $child;
                    $i++;
                }
                // dd($list_menu);
            }
            return $list_menu;
        }
	}
?>