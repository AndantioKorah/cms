<?php
	class M_Master extends CI_Model
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

        public function getAllParameter(){
            return $this->db->select('*')
                            ->from('m_parameter')
                            ->where('flag_active', 1)
                            ->order_by('created_date', 'desc')
                            ->get()->result_array();
        }

        public function deleteMasterParameter($id){
            $this->db->where('id', $id)
                    ->update('m_parameter', ['flag_active' => 0, 'updated_by' => $this->general_library->getId()]);
        }

        public function insertMasterParameter($data){
            $rs['code'] = 0;
            $rs['message'] = 0;

            $exists = $this->db->select('*')
                                ->from('m_parameter')   
                                ->where('parameter_name', $data['parameter_name'])
                                ->where('flag_active', 1)
                                ->get()->row_array();
            if($exists){
                $rs['code'] = 1;
                $rs['message'] = 'Parameter dengan nama '.$data['parameter_name'].' sudah ada';
            } else {
                $data['created_by'] = $this->general_library->getId();
                $this->db->insert('m_parameter', $data);
            }

            return $rs;
        }

        public function loadDetailParameter($id){
            return $this->db->select('*')
                            ->from('m_parameter')
                            ->where('id', $id)
                            ->where('flag_active', 1)
                            ->get()->row_array();
        }

        public function editMasterParameter($data){
            $rs['code'] = 0;
            $rs['message'] = 0;

            $exists = $this->db->select('*')
                                ->from('m_parameter')   
                                ->where('id', $data['id'])
                                ->where('flag_active', 1)
                                ->get()->row_array();
            if(!$exists){
                $rs['code'] = 1;
                $rs['message'] = 'Data tidak ditemukan';
            } else {
                $data['updated_by'] = $this->general_library->getId();
                $id = $data['id'];
                $this->db->where('id', $id)
                        ->update('m_parameter', $data);
            }

            return $rs;
        }

        public function saveImportBidang($data, $id_skpd){
            $res['code'] = 0;
            $res['message'] = 'SELESAI';

            $this->db->trans_begin();

            $exists = $this->db->select('*')
                                ->from('m_bidang a')
                                ->join('db_pegawai.unitkerja b', 'a.id_unitkerja = b.id_unitkerja')
                                ->where('a.id_unitkerja', $id_skpd)
                                ->where('a.flag_active', 1)
                                ->get()->row_array();
            if($exists){
                $res['code'] = 2;
                $res['message'] = $exists['nm_unitkerja'].' sudah memiliki Bidang/Sub Bidang';
                echo $exists['nm_unitkerja']." sudah memiliki Bidang/Sub Bidang <br> \n";
            } else {
                foreach($data as $d){
                    $input['id_unitkerja'] = $id_skpd;
                    $input['nama_bidang'] = $d['nama_bidang'];
                    $input['created_by'] = $this->general_library->getId();
                    
                    $this->db->insert('m_bidang', $input);
                    
                    $last_id = $this->db->insert_id();
                    $sub_bidang = [];
                    $i = 0;
                    if(isset($d['sub_bidang'])){
                        foreach($d['sub_bidang'] as $sb){
                            $sub_bidang[$i]['id_m_bidang'] = $last_id;
                            $sub_bidang[$i]['created_by'] = $this->general_library->getId();
                            $sub_bidang[$i]['nama_sub_bidang'] = $sb;
                            $i++;
                        }
                        $this->db->insert_batch('m_sub_bidang', $sub_bidang);   
                    }
                }
            }
            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
            } else {
                $this->db->trans_commit();
            }

            return $res;
        }
    }
?>