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

            $this->db->trans_begin();
           
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
                $id = $this->db->insert_id();
                
                if($_FILES["parameter_file"]["name"] != ""){ 
                    $path="./assets/admin/parameter/";
                    $konten="parameter_file";
                    $filename = explode(".", $_FILES["parameter_file"]['name']);
                    $new_name = '';
                    if(count($filename) != 1 && count($filename) > 2){
                        for($i = 0; $i < count($filename) - 1; $i++){
                            $new_name = $new_name.$filename[$i];
                        }
                    } else {
                        $new_name = $filename;
                    }

                    $new_name = str_replace(array( '-',' ',']','.'), ' ', $new_name);                    
                    $new_name = $string = str_replace(' ', '', $new_name);
                    $new_name = $new_name.'.'.$filename[count($filename)-1];

                    $config_ppid['file_name'] = $new_name;
                    $config_ppid['upload_path'] = $path;  
                    $config_ppid['allowed_types'] = 'jpg|jpeg|png|pdf'; 
                    
                    $full_path = base_url('/assets/admin/parameter/'.$new_name);

                    $this->load->library('upload', $config_ppid);
                    $this->upload->overwrite = true;
                    
                    if(!$this->upload->do_upload($konten)){  
                         echo $this->upload->display_errors();  
                    } else {
                        $data["parameter_value"] = $new_name;
        
                        $this->db->where('id', $id)
                                ->update('m_parameter', $data);  
                    }
                }

                if($this->db->trans_status() == FALSE){
                    $this->db->trans_rollback();
                    $rs['code'] = 1;
                    $rs['message'] = $this->upload->display_errors();
                } else {
                    $this->db->trans_commit();
                }
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


        public function submitMasterKategoriPpid(){

           
            $datapost = $this->input->post();
            $data["nama_kategori"] = $datapost["nama_kategori_ppid"];
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('m_kategori_ppid', $data);
            $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
            return $res;
            }

            function loadListMasterKategoriPpid(){
                $query = $this->db->select('*')
                                ->from('m_kategori_ppid a')
                                ->where('a.flag_active', 1)
                                ->get()->result_array();
            return $query; 
            }


            public function submitMasterJenisPpid(){

           
                $datapost = $this->input->post();
                $data["nama_jenis"] = $datapost["nama_jenis_ppid"];
                $data["id_kategori_ppid"] = $datapost["id_kategori_ppid"];
                
                $data['created_by'] = $this->general_library->getId();
                $this->db->insert('m_jenis_ppid', $data);
                $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
                return $res;
                }
    
                function loadListMasterJenisPpid(){
                    $query = $this->db->select('*')
                                    ->from('m_jenis_ppid a')
                                    ->join('m_kategori_ppid b', 'a.id_kategori_ppid = b.id')
                                    ->where('a.flag_active', 1)
                                    ->get()->result_array();
                return $query; 
                }

                    
            public function getMasterKategoriPpid(){

                return $this->db->select('*')
                                ->from('m_kategori_ppid as a')
                                ->where('a.flag_active', 1)
                                ->get()->result_array();
            }


            public function submitMasterDownload(){

           
                $datapost = $this->input->post();
                $data["jenis_download"] = $datapost["jenis_download"];                
                $data['created_by'] = $this->general_library->getId();
                $this->db->insert('m_jenis_download', $data);
                $res = array('msg' => 'Data berhasil disimpan', 'success' => true);
                return $res;
                }

            public function loadListMasterDownload(){
                    $query = $this->db->select('*')
                                    ->from('m_jenis_download a')
                                    ->where('a.flag_active', 1)
                                    ->get()->result_array();
                return $query; 
            }
        

        public function loadMasterJenisPelayanan(){
            return $this->db->select('a.*,b.nama_lab')
                            ->from('m_jenis_pelayanan a')
                            ->join('m_lab b', 'a.id_m_lab = b.id', 'left')
                            ->where('a.flag_active', 1)
                            ->order_by('a.created_date', 'desc')
                            ->get()->result_array();
        }

        public function deleteMasterJenisPelayanan($id){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $this->db->where('id', $id)
                    ->update('m_jenis_pelayanan',
                    ['flag_active' => 0,
                    'updated_by' => $this->general_library->getId()]);

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        public function deleteMasterParameterJenisPelayanan($id){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $this->db->where('id', $id)
                    ->update('m_parameter_jenis_pelayanan',
                    ['flag_active' => 0,
                    'updated_by' => $this->general_library->getId()]);

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        public function getJenisParameterByKategori($id){
            return $this->db->select('*')
                            ->from('m_jenis_parameter')
                            ->where('id_m_kategori_parameter', $id)
                            ->where('flag_active', 1)
                            ->get()->result_array();
        }

        public function loadMasterParameterJenisPelayanan(){
            return $this->db->select('a.*')
                            ->from('m_parameter_jenis_pelayanan a')
                            ->where('a.flag_active', 1)
                            ->order_by('a.created_date', 'desc')
                            ->get()->result_array();
        }

        public function insertMasterParameterJenisPelayanan($data){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $exists = $this->db->select('*')
                                ->from('m_parameter_jenis_pelayanan')
                                ->where('nama_parameter_jenis_pelayanan', $data['nama_parameter_jenis_pelayanan'])
                                ->where('flag_active', 1)
                                ->get()->row_array();
            if($exists){
                $rs['code'] = 1;
                $rs['message'] = 'Parameter sudah ada sebelumnya';
            } else {
                $this->db->insert('m_parameter_jenis_pelayanan', $data);
            }

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        public function loadParameterJenisPelayanan($id){
            return $this->db->select('*')
                    ->from('m_jenis_pelayanan')
                    ->where('id', $id)
                    ->get()->row_array();

            // $parameter = $this->db->select('')
            //                             ->from('t_parameter_jenis_pelayanan a')
            //                             ->join('m_kategori_parameter b', 'a.id_m_kategori_parameter = b.id')
            //                             ->join('m_jenis_parameter c', 'a.id_m_jenis_parameter = c.id')
            //                             ->where('a.flag_active', 1)
            //                             ->order_by('a.urutan', 'asc')
            //                             ->get()->result_array();
        }

        public function getListParameterJenisPelayanan($id){
            return $this->db->select('a.*, b.nama_kategori_parameter, c.nama_jenis_parameter, d.nama_parameter_jenis_pelayanan, a.harga')
                            ->from('t_parameter_jenis_pelayanan a')
                            ->join('m_kategori_parameter b', 'a.id_m_kategori_parameter = b.id', 'left')
                            ->join('m_jenis_parameter c', 'a.id_m_jenis_parameter = c.id', 'left')
                            ->join('m_parameter_jenis_pelayanan d', 'a.id_m_parameter_jenis_pelayanan = d.id', 'left')
                            ->where('a.flag_active', 1)
                            ->where('id_m_jenis_pelayanan', $id)
                            ->order_by('a.created_date', 'desc')
                            ->get()->result_array();
        }

        public function addParameterJenisPelayanan($id){
            $data = $this->input->post();
            $data['id_m_jenis_pelayanan'] = $id;
            $data['created_by'] = $this->general_library->getId();
            $data['harga'] = clearString($data['harga']);
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $exists = $this->db->select('*')
                                ->from('t_parameter_jenis_pelayanan')
                                ->where('id_m_jenis_pelayanan', $data['id_m_jenis_pelayanan'])
                                ->where('id_m_kategori_parameter', $data['id_m_kategori_parameter'])
                                ->where('id_m_jenis_parameter', $data['id_m_jenis_parameter'])
                                ->where('id_m_parameter_jenis_pelayanan', $data['id_m_parameter_jenis_pelayanan'])
                                ->where('flag_active', 1)
                                ->get()->row_array();
            if($exists){
                $rs['code'] = 1;
                $rs['message'] = 'Parameter sudah ada sebelumnya';
            } else {
                $this->db->insert('t_parameter_jenis_pelayanan', $data);
            }

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        public function deleteParameterJenisPelayanan($id){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $this->db->where('id', $id)
                    ->update('t_parameter_jenis_pelayanan',
                        ['flag_active' => 0,
                        'updated_by' => $this->general_library->getId()]);

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }


 
        
        public function getListRoleJenisPelayanan($id){
            return $this->db->select('a.*,b.nama')
                            ->from('t_role_jenis_pelayanan a')
                            ->join('m_role b', 'a.id_role = b.id', 'left')
                            ->where('a.flag_active', 1)
                            ->where('id_m_jenis_pelayanan', $id)
                            ->order_by('a.created_date', 'desc')
                            ->get()->result_array();
        }

        public function addRoleJenisPelayanan($id){
            $data = $this->input->post();
            $data['id_m_jenis_pelayanan'] = $id;
            $data['created_by'] = $this->general_library->getId();
           
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $exists = $this->db->select('*')
                                ->from('t_role_jenis_pelayanan')
                                ->where('id_m_jenis_pelayanan', $data['id_m_jenis_pelayanan'])
                                ->where('id_role', $data['id_role'])
                                // ->where('no_urut', $data['no_urut'])
                                ->where('flag_active', 1)
                                ->get()->row_array();
            if($exists){
                $rs['code'] = 1;
                $rs['message'] = 'Role sudah ada sebelumnya';
            } else {
                $this->db->insert('t_role_jenis_pelayanan', $data);
            }

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        
        public function deleteRoleJenisPelayanan($id){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $this->db->where('id', $id)
                    ->update('t_role_jenis_pelayanan',
                        ['flag_active' => 0,
                        'updated_by' => $this->general_library->getId()]);

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }


        public function loadMasterPelanggan(){
            return $this->db->select('*')
                            ->from('m_pelanggan')
                            ->where('flag_active', 1)
                            ->order_by('created_date', 'desc')
                            ->get()->result_array();
        }

        
        public function deleteMasterPelanggan($id){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $this->db->where('id', $id)
                    ->update('m_pelanggan',
                    ['flag_active' => 0,
                    'updated_by' => $this->general_library->getId()]);

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }


            public function loadDetailPelanggan($id){
            return $this->db->select('*')
                            ->from('m_pelanggan')
                            ->where('id', $id)
                            ->where('flag_active', 1)
                            ->get()->row_array();
        }


        public function editMasterPelanggan($data){
            $rs['code'] = 0;
            $rs['message'] = 0;

            $exists = $this->db->select('*')
                                ->from('m_pelanggan')   
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
                        ->update('m_pelanggan', $data);
            }

            return $rs;
        }


        public function updateFlagAvailable(){
            $data = $this->input->post();
            // dd($data['status']);
            $rs['code'] = 0;
            $rs['message'] = '';
            $id = $data['id'];
            $flag_available = $data['status'];
            // dd($flag_available);
            // if($data['status'] == "1"){
            //     $flag_available = 1;
            // } else {
            //     $flag_available = 0;
            // }
            $this->db->trans_begin();
            
            $this->db->where('id', $id)
                    ->update('t_parameter_jenis_pelayanan',
                    ['flag_available' => $flag_available,
                    'updated_by' => $this->general_library->getId()]);

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        public function updateJenisLab(){
            $data = $this->input->post();
            // dd($data['status']);
            $rs['code'] = 0;
            $rs['message'] = '';
            $id = $data['id'];
            $jenis_lab = $data['jenis_lab'];

            $this->db->trans_begin();
            
            $this->db->where('id', $id)
                    ->update('m_jenis_pelayanan',
                    ['id_m_lab' => $jenis_lab,
                    'updated_by' => $this->general_library->getId()]);

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }


        public function deleteMasterLaboratorium($id){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $this->db->where('id', $id)
                    ->update('m_lab',
                    ['flag_active' => 0,
                    'updated_by' => $this->general_library->getId()]);

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        public function loadMasterLaboratorium(){
            return $this->db->select('*')
                            ->from('m_lab')
                            ->where('flag_active', 1)
                            ->order_by('created_date', 'desc')
                            ->get()->result_array();
        }


  
    
    }
?>