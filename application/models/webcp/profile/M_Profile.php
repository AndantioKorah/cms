<?php
	class M_Profile extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getProfileParam(){
            $result = null;
            $param_arr = ['PARAM_VISI', 'PARAM_MOTTO'];
            $rs = $this->db->select('*')
                            ->from('m_parameter')
                            ->where('flag_active', 1)
                            ->where_in('parameter_name', $param_arr)
                            ->or_like('parameter_name', 'PARAM_MISI')
                            ->or_like('parameter_name', 'PARAM_TUPOKSI')
                            ->order_by('parameter_name', 'asc')
                            ->get()->result_array();

            $temp_tupoksi = null;
            if($rs){
                foreach($rs as $r){
                    if(substr($r['parameter_name'], 0, 10) == 'PARAM_MISI'){
                        $result['misi'][] = $r['parameter_value'];
                    } else if(substr($r['parameter_name'], 0, 23) == 'PARAM_TUPOKSI_PARAGRAPH'){
                        $result['tupoksi_pr'][] = $r['parameter_value'];
                    } else if(substr($r['parameter_name'], 0, 18) == 'PARAM_TUPOKSI_POIN'){
                        $temp_tupoksi[] = $r;
                    } else if($r['parameter_name'] == 'PARAM_VISI'){
                        $result['visi'] = $r['parameter_value'];
                    } else if($r['parameter_name'] == 'PARAM_MOTTO'){
                        $result['motto'] = $r['parameter_value'];
                    }
                }
            }

            if($temp_tupoksi){
                $temp = null;
                foreach($temp_tupoksi as $t){
                    $temp[$t['parameter_name']] = $t['parameter_value'];
                }

                for($i = 1; $i <= count($temp_tupoksi); $i++){
                    $result['tupoksi_poin'][$i] = $temp['PARAM_TUPOKSI_POIN_'.$i];
                }
            }
            
            return $result;
        }

	}
?>