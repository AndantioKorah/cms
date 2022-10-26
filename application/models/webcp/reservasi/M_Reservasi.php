<?php
	class M_Reservasi extends CI_Model
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

        public function getAllLayanan(){
            return $this->db->select('*')
                            ->from('m_jenis_pelayanan')
                            ->where('flag_active', 1)
                            ->order_by('nama_jenis_pelayanan')
                            ->get()->result_array();
        }

        public function formAddParameter($data){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            if(isset($data['parameter']) && $data['parameter']){
                $last_id_parent = 0;
                $exist = $this->db->select('*')
                                    ->from('t_reservasi_online')
                                    ->where('flag_active', 1)
                                    ->where('session_id', $data['session_id'])
                                    ->get()->row_array();
                if($exist){
                    $last_id_parent = $exist['id'];
                } else {
                    $reservasi['session_id'] = $data['session_id'];
                    // $reservasi['id_m_jenis_pelayanan'] = $data['id_m_jenis_pelayanan'];
                    // $last_data = $this->db->select('*')
                    //                 ->from('t_reservasi_online a')
                    //                 ->where('a.id_m_jenis_pelayanan', $data['id_m_jenis_pelayanan'])
                    //                 ->where('a.flag_active', 1)
                    //                 ->where('DATE(a.created_date)', date('y-m-d'))
                    //                 ->order_by('nomor_tiket', 'desc')
                    //                 ->limit(1)
                    //                 ->get()->row_array();
                    // $counter = str_pad("1", 4, "0", STR_PAD_LEFT);
                    // if($last_data){
                    //     $last_counter = substr($last_data['nomor_tiket'], -4);
                    //     $counter = floatval($last_counter) + 1;
                    //     $counter = str_pad($counter, 4, "0", STR_PAD_LEFT);
                    // }
                    // $reservasi['nomor_tiket'] = str_pad($data['id_m_jenis_pelayanan'], 2, '0', STR_PAD_LEFT).date('Ymd').$counter;
                    $this->db->insert('t_reservasi_online', $reservasi);
                    $last_id_parent = $this->db->insert_id();
                }

                $exist_pelayanan = $this->db->select('*')
                                            ->from('t_reservasi_online_detail')
                                            ->where('id_m_jenis_pelayanan', $data['id_m_jenis_pelayanan'])
                                            ->where('id_t_reservasi_online', $last_id_parent)
                                            ->where('flag_active', 1)
                                            ->get()->row_array();
                if($exist_pelayanan){
                    $rs['code'] = 1;
                    $rs['message'] = 'Jenis Layanan Sudah Ada'; 
                } else {
                    $detail['id_t_reservasi_online'] = $last_id_parent;
                    $detail['id_m_jenis_pelayanan'] = $data['id_m_jenis_pelayanan'];
                    $detail['id_m_provinsi'] = $data['id_m_provinsi'];
                    $detail['id_m_kabupaten_kota'] = $data['id_m_kabupaten_kota'];
                    $detail['id_m_kecamatan'] = $data['id_m_kecamatan'];
                    $detail['id_m_kelurahan'] = $data['id_m_kelurahan'];
                    $detail['waktu_pengambilan_sampel'] = $data['waktu_pengambilan_sampel'];
                    $this->db->insert('t_reservasi_online_detail', $detail);
                    $last_id_detail = $this->db->insert_id();
    
                    $i = 0;
                    foreach($data['parameter'] as $p){
                        $parameter[$i]['id_t_reservasi_online_detail'] = $last_id_detail;
                        $explode = explode(';', $p);
                        $parameter[$i]['id_t_parameter_jenis_pelayanan'] = $explode[0];
                        $parameter[$i]['harga'] = $explode[1];
                        $i++;
                    }
                    $this->db->insert_batch('t_reservasi_online_parameter', $parameter);
                }
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Parameter Belum Dipilih'; 
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

        public function refreshReceipt($session_id){
            // $detail = null;
            $final_result = null;
            $result = $this->db->select('a.session_id, c.nama_jenis_pelayanan, b.id_m_jenis_pelayanan, a.id, b.id as id_t_reservasi_online_detail, a.created_date, 
            d.nama_provinsi, e.nama_kabupaten_kota, f.nama_kecamatan, g.nama_kelurahan, b.waktu_pengambilan_sampel')
                            ->from('t_reservasi_online a')
                            ->join('t_reservasi_online_detail b', 'b.id_t_reservasi_online = a.id')
                            ->join('m_jenis_pelayanan c', 'b.id_m_jenis_pelayanan = c.id')
                            ->join('m_provinsi d', 'b.id_m_provinsi = d.id')
                            ->join('m_kabupaten_kota e', 'b.id_m_kabupaten_kota = e.id')
                            ->join('m_kecamatan f', 'b.id_m_kecamatan = f.id')
                            ->join('m_kelurahan g', 'b.id_m_kelurahan = g.id')
                            ->where('a.session_id', $session_id)
                            ->where('b.flag_active', 1)
                            ->get()->result_array();
            if($result){
                $detail = $this->db->select('c.nama_parameter_jenis_pelayanan, b.harga, b.id_m_jenis_pelayanan, a.id_t_reservasi_online_detail, a.id')
                                ->from('t_reservasi_online_parameter a')
                                ->join('t_parameter_jenis_pelayanan b', 'a.id_t_parameter_jenis_pelayanan = b.id')
                                ->join('m_parameter_jenis_pelayanan c', 'b.id_m_parameter_jenis_pelayanan = c.id')
                                ->join('t_reservasi_online_detail d', 'a.id_t_reservasi_online_detail = d.id')
                                ->join('t_reservasi_online e', 'd.id_t_reservasi_online = e.id')
                                ->where('a.flag_active', 1)
                                ->where('e.id', $result[0]['id'])
                                ->group_by('a.id')
                                ->get()->result_array();

                if($detail){
                    $i = 0;
                    foreach($result as $rs){
                        $final_result[$rs['id_m_jenis_pelayanan']]['id_t_reservasi_online'] = $rs['id'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['created_date'] = $rs['created_date'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['id_t_reservasi_online_detail'] = $rs['id_t_reservasi_online_detail'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['nama_jenis_pelayanan'] = $rs['nama_jenis_pelayanan'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['parameter'] = null;
                        $final_result[$rs['id_m_jenis_pelayanan']]['nama_provinsi'] = $rs['nama_provinsi'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['nama_kabupaten_kota'] = $rs['nama_kabupaten_kota'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['nama_kecamatan'] = $rs['nama_kecamatan'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['nama_kelurahan'] = $rs['nama_kelurahan'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['waktu_pengambilan_sampel'] = $rs['waktu_pengambilan_sampel'];
                    }

                    $j = 0;
                    foreach($detail as $d){
                        $final_result[$d['id_m_jenis_pelayanan']]['parameter'][$j]['nama_parameter_jenis_pelayanan'] = $d['nama_parameter_jenis_pelayanan'];
                        $final_result[$d['id_m_jenis_pelayanan']]['parameter'][$j]['harga'] = $d['harga'];
                        $final_result[$d['id_m_jenis_pelayanan']]['parameter'][$j]['id_t_reservasi_online_parameter'] = $d['id'];
                        $j++;
                    }
                }
            }

            return $final_result;
        }

        public function deleteJenisLayananReceipt($id){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $this->db->where('id', $id)
                    ->update('t_reservasi_online_detail', ['flag_active' => 0]);

            $this->db->where('id_t_reservasi_online_detail', $id)
                    ->update('t_reservasi_online_parameter', ['flag_active' => 0]);

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        public function checkoutReservasi($session_id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['nomor_tiket'] = '';

            $this->db->trans_begin();

            $last_data = $this->db->select('*')
                            ->from('t_reservasi_online a')
                            ->where('a.flag_active', 1)
                            ->where('DATE(a.created_date)', date('y-m-d'))
                            ->where('nomor_tiket IS NOT NULL')
                            ->where('flag_active', 1)
                            ->order_by('nomor_tiket', 'desc')
                            ->limit(1)
                            ->get()->row_array();
            $counter = str_pad("1", 4, "0", STR_PAD_LEFT);
            if($last_data){
                $last_counter = substr($last_data['nomor_tiket'], -4);
                $counter = floatval($last_counter) + 1;
                $counter = str_pad($counter, 4, "0", STR_PAD_LEFT);
            }
            $nomor_tiket = strtoupper(generateRandomLetter(4)).date('Ymd').$counter;

            $detail = $this->db->select('sum(b.harga) as total_biaya')
                                ->from('t_reservasi_online_detail a')
                                ->join('t_reservasi_online_parameter b', 'a.id = b.id_t_reservasi_online_detail')
                                ->join('t_reservasi_online c', 'a.id_t_reservasi_online = c.id')
                                ->where('a.flag_active', 1)
                                ->where('b.flag_active', 1)
                                ->where('c.session_id', $session_id)
                                ->get()->row_array();
            $total_biaya = 0;
            if($detail){
                $total_biaya = $detail['total_biaya'];
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan. Total Biaya tidak ditemukan.';
            }

            $this->db->where('session_id', $session_id)
                    ->update('t_reservasi_online', 
                    ['nomor_tiket' => $nomor_tiket,
                    'total_biaya' => $total_biaya,
                    'status' => 2]);
            $rs['nomor_tiket'] = $nomor_tiket;

            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        public function searchNomorTiket(){
            $search_value = $this->input->post('search_nomor_tiket');
            $final_result = null;
            $result = $this->db->select('a.session_id, c.nama_jenis_pelayanan, b.id_m_jenis_pelayanan, a.id, b.id as id_t_reservasi_online_detail,
                            a.created_date, d.nama_status, a.total_biaya, a.nomor_tiket, a.status, b.catatan_kepala_instalasi')
                            ->from('t_reservasi_online a')
                            ->join('t_reservasi_online_detail b', 'b.id_t_reservasi_online = a.id')
                            ->join('m_jenis_pelayanan c', 'b.id_m_jenis_pelayanan = c.id')
                            ->join('m_status_reservasi d', 'a.status = d.id')
                            ->where('a.nomor_tiket', $search_value)
                            ->where('b.flag_active', 1)
                            ->where('a.status !=', 1)
                            ->group_by('b.id')
                            ->get()->result_array();
            if($result){
                $detail = $this->db->select('c.nama_parameter_jenis_pelayanan, b.harga, d.id_m_jenis_pelayanan, a.id_t_reservasi_online_detail, a.id,
                        c.id as id_m_parameter_jenis_pelayanan, a.id_t_parameter_jenis_pelayanan, a.catatan_lab, a.hasil_lab')
                                ->from('t_reservasi_online_parameter a')
                                ->join('t_parameter_jenis_pelayanan b', 'a.id_t_parameter_jenis_pelayanan = b.id')
                                ->join('m_parameter_jenis_pelayanan c', 'b.id_m_parameter_jenis_pelayanan = c.id')
                                ->join('t_reservasi_online_detail d', 'a.id_t_reservasi_online_detail = d.id')
                                ->join('t_reservasi_online e', 'd.id_t_reservasi_online = e.id')
                                ->where('a.flag_active', 1)
                                ->where('e.id', $result[0]['id'])
                                ->get()->result_array();
                if($detail){
                    $dt_param = null;
                    $i = 0;
                    foreach($detail as $dt){
                        $dt_param[$dt['id_m_jenis_pelayanan']][$i] = $dt;
                        $i++;
                    }
                    // dd(json_encode($dt_param));

                    $i = 0;
                    foreach($result as $rs){
                        $final_result['status'] = $rs['status'];
                        $final_result['nama_status'] = $rs['nama_status'];
                        $final_result['created_date'] = $rs['created_date'];
                        $final_result['nomor_tiket'] = $rs['nomor_tiket'];
                        $final_result['total_biaya'] = $rs['total_biaya'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['id_t_reservasi_online'] = $rs['id'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['created_date'] = $rs['created_date'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['id_t_reservasi_online_detail'] = $rs['id_t_reservasi_online_detail'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['nama_jenis_pelayanan'] = $rs['nama_jenis_pelayanan'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['catatan_kepala_instalasi'] = $rs['catatan_kepala_instalasi'];
                        
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter']  = $dt_param[$rs['id_m_jenis_pelayanan']];


                        // $default_param = $this->db->select('a.id_m_jenis_pelayanan, a.id as id_t_parameter_jenis_pelayanan, b.nama_parameter_jenis_pelayanan, a.harga, b.id as id_m_parameter_jenis_pelayanan')
                        //                         ->from('t_parameter_jenis_pelayanan a')
                        //                         ->join('m_parameter_jenis_pelayanan b', 'a.id_m_parameter_jenis_pelayanan = b.id')
                        //                         ->where('a.id_m_jenis_pelayanan', $rs['id_m_jenis_pelayanan'])
                        //                         ->where('a.flag_active', 1)
                        //                         ->get()->result_array();

                        // $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'] = null;
                        // if($default_param){
                        //     foreach($default_param as $df){
                        //         $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_t_reservasi_online_parameter'] = null;
                        //         $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_m_parameter_jenis_pelayanan'] = $df['id_m_parameter_jenis_pelayanan'];
                        //         $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['harga'] = $df['harga'];
                        //         $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['nama_parameter_jenis_pelayanan'] = $df['nama_parameter_jenis_pelayanan'];
                        //         $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_t_parameter_jenis_pelayanan'] = $df['id_t_parameter_jenis_pelayanan'];
                        //         $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['checked'] = 0;

                        //         if(isset($dt_param[$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']])){
                        //             $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['checked'] = 1;
                        //             $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_t_reservasi_online_parameter'] = $dt_param[$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id'];
                        //             $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['catatan_lab'] = $dt_param[$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['catatan_lab'];
                        //             $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['hasil_lab'] = $dt_param[$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['hasil_lab'];
                        //         }
                        //     }
                        // }
                        $i++;
                    }
                }
            }

            return $final_result;
        }

        public function searchNomorTikets(){
            $search_value = $this->input->post('search_nomor_tiket');
            $final_result = null;
            $result = $this->db->select('a.session_id, c.nama_jenis_pelayanan, b.id_m_jenis_pelayanan, a.id, b.id as id_t_reservasi_online_detail,
                            a.created_date, d.nama_status, a.total_biaya, a.nomor_tiket')
                            ->from('t_reservasi_online a')
                            ->join('t_reservasi_online_detail b', 'b.id_t_reservasi_online = a.id')
                            ->join('m_jenis_pelayanan c', 'b.id_m_jenis_pelayanan = c.id')
                            ->join('m_status_reservasi d', 'a.status = d.id')
                            ->where('a.nomor_tiket', $search_value)
                            ->where('b.flag_active', 1)
                            ->where('a.status !=', 1)
                            ->get()->result_array();
            if($result){
                $detail = $this->db->select('c.nama_parameter_jenis_pelayanan, b.harga, b.id_m_jenis_pelayanan, a.id_t_reservasi_online_detail, a.id')
                                ->from('t_reservasi_online_parameter a')
                                ->join('t_parameter_jenis_pelayanan b', 'a.id_t_parameter_jenis_pelayanan = b.id')
                                ->join('m_parameter_jenis_pelayanan c', 'b.id_m_parameter_jenis_pelayanan = c.id')
                                ->join('t_reservasi_online_detail d', 'a.id_t_reservasi_online_detail = d.id')
                                ->join('t_reservasi_online e', 'd.id_t_reservasi_online = e.id')
                                ->where('a.flag_active', 1)
                                ->where('e.id', $result[0]['id'])
                                ->group_by('a.id')
                                ->get()->result_array();

                if($detail){
                    $i = 0;
                    foreach($result as $rs){
                        $final_result[$rs['id_m_jenis_pelayanan']]['id_t_reservasi_online'] = $rs['id'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['created_date'] = $rs['created_date'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['id_t_reservasi_online_detail'] = $rs['id_t_reservasi_online_detail'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['nama_jenis_pelayanan'] = $rs['nama_jenis_pelayanan'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['total_biaya'] = $rs['total_biaya'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['nomor_tiket'] = $rs['nomor_tiket'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['nama_status'] = $rs['nama_status'];
                        $final_result[$rs['id_m_jenis_pelayanan']]['parameter'] = null;
                    }

                    $j = 0;
                    foreach($detail as $d){
                        $final_result[$d['id_m_jenis_pelayanan']]['parameter'][$j]['nama_parameter_jenis_pelayanan'] = $d['nama_parameter_jenis_pelayanan'];
                        $final_result[$d['id_m_jenis_pelayanan']]['parameter'][$j]['harga'] = $d['harga'];
                        $final_result[$d['id_m_jenis_pelayanan']]['parameter'][$j]['id_t_reservasi_online_parameter'] = $d['id'];
                        $j++;
                    }
                }
            }

            return $final_result;
        }


        public function getListProvinsi(){

            return $this->db->select('*')
                            ->from('m_provinsi as a')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }


        public function getListKabKota(){

            return $this->db->select('*')
                            ->from('m_kabupaten_kota as a')
                            ->where('a.id_m_provinsi', 71)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }

        public function getListKec(){

            return $this->db->select('*')
                            ->from('m_kecamatan as a')
                            ->where('a.id_m_kabupaten_kota', 7171)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }



        public function getListKabupatenKota($id){
            return $this->db->select('*')
                            ->from('m_kabupaten_kota as a')
                            ->where('a.id_m_provinsi', $id)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }

        public function getListKecamatan($id){
            return $this->db->select('*')
                            ->from('m_kecamatan as a')
                            ->where('a.id_m_kabupaten_kota', $id)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }

        public function getListKelurahan($id){
            return $this->db->select('*')
                            ->from('m_kelurahan as a')
                            ->where('a.id_m_kecamatan', $id)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }


        public function uploadPayment(){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();
            
            $new_name = str_replace(array( '-',' ',']'), ' ', $_FILES["berkas"]['name']);
            $random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
            $data = $_FILES["berkas"]['type'];;    
            $tipeFile = substr($data, strpos($data, "/") + 1);   
            $new_name = "bukti_bayar".$random_number.time().".".$tipeFile;

            if($_FILES["berkas"]["name"] != ""){ 
                $path="./assets/webcp/bukti_bayar/";
                $konten="berkas";
            }
          
            $config_ppid['file_name'] = $new_name;
            $config_ppid['upload_path'] = $path;  
            $config_ppid['allowed_types'] = 'jpg|jpeg|png|pdf'; 

           
            
            $this->load->library('upload', $config_ppid);  
            $this->upload->overwrite = true;

            $nmr_tiket = $this->input->post('nmr_tiket');
            $full_path = base_url().'assets/webcp/bukti_bayar/'.$new_name;

            $this->db->where('nomor_tiket', $nmr_tiket)
            ->update('t_reservasi_online', ['bukti_bayar' => $full_path,
                                            'nomor_billing' => $this->input->post('nomor_billing') ]);
            
            if(!$this->upload->do_upload($konten))  
            {  
                 echo $this->upload->display_errors();  
            } 

            dd($rs);
            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }
        }
    }
?>