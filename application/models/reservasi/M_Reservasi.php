<?php
	class M_Reservasi extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function delete($fieldName, $fieldValue, $tableName)
        {
            $this->db->where($fieldName, $fieldValue)
                        ->update($tableName, ['flag_active' => 0, 'updated_by' => $this->general_library->getId()]);
        }

        public function searchReservasi($param){
            $this->db->select('a.*, b.nama_status')
                    ->from('t_reservasi_online a')
                    ->join('m_status_reservasi b', 'a.status = b.id')
                    ->where('a.flag_active', 1);
            if($param['filter'] == 1){
                $tanggal = explodeRangeDate($param['range_tanggal']);
                $this->db->where('a.created_date >=', $tanggal[0])
                        ->where('a.created_date <=', $tanggal[1]);
            } else if ($param['filter'] == 2){
                $this->db->like('a.nomor_tiket', $param['nomor_tiket']);
            }

            return $this->db->get()->result_array();
        }

        public function openDetailReservasi($id){
            return $this->db->select('a.session_id, a.id, a.created_date as tanggal_reservasi, d.nama_status, a.total_biaya, a.nomor_tiket, a.status, a.id_m_pelanggan,
                                        e.nama,e.alamat,e.no_hp')
                            ->from('t_reservasi_online a')
                            ->join('m_status_reservasi d','a.status = d.id')
                            ->join('m_pelanggan e', 'a.id_m_pelanggan = e.id', 'left')
                            ->where('a.id', $id)
                            ->where('a.status !=', 1)
                            ->get()->row_array();
        }

        public function loadDetailLayanan($id){
            $final_result = null;
            $result = $this->db->select('a.session_id, c.nama_jenis_pelayanan, b.id_m_jenis_pelayanan, a.id, b.id as id_t_reservasi_online_detail,
                            a.created_date, d.nama_status, a.total_biaya, a.nomor_tiket, a.status, b.catatan_kepala_instalasi, b.no_sampel')
                            ->from('t_reservasi_online a')
                            ->join('t_reservasi_online_detail b', 'b.id_t_reservasi_online = a.id')
                            ->join('m_jenis_pelayanan c', 'b.id_m_jenis_pelayanan = c.id')
                            ->join('m_status_reservasi d', 'a.status = d.id')
                            ->where('a.id', $id)
                            ->where('b.flag_active', 1)
                            ->where('a.status !=', 1)
                            ->group_by('b.id')
                            ->get()->result_array();
            if($result){
                $detail = $this->db->select('c.nama_parameter_jenis_pelayanan, b.harga, d.id_m_jenis_pelayanan, a.id_t_reservasi_online_detail, a.id,
                        c.id as id_m_parameter_jenis_pelayanan, a.id_t_parameter_jenis_pelayanan, a.catatan_lab, a.hasil_lab, d.no_sampel')
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
                    foreach($detail as $dt){
                        $dt_param[$dt['id_m_jenis_pelayanan']]['parameter'][$dt['id_m_parameter_jenis_pelayanan']] = $dt;
                    }
                    // dd(json_encode($dt_param));

                    $i = 0;
                    foreach($result as $rs){
                        $final_result['status'] = $rs['status'];
                        $final_result['total_biaya'] = $rs['total_biaya'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['id_t_reservasi_online'] = $rs['id'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['created_date'] = $rs['created_date'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['id_t_reservasi_online_detail'] = $rs['id_t_reservasi_online_detail'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['nama_jenis_pelayanan'] = $rs['nama_jenis_pelayanan'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['catatan_kepala_instalasi'] = $rs['catatan_kepala_instalasi'];
                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['no_sampel'] = $rs['no_sampel'];
                       
                        $default_param = $this->db->select('a.id_m_jenis_pelayanan, a.id as id_t_parameter_jenis_pelayanan, b.nama_parameter_jenis_pelayanan, a.harga, b.id as id_m_parameter_jenis_pelayanan, a.flag_available')
                                                ->from('t_parameter_jenis_pelayanan a')
                                                ->join('m_parameter_jenis_pelayanan b', 'a.id_m_parameter_jenis_pelayanan = b.id')
                                                ->where('a.id_m_jenis_pelayanan', $rs['id_m_jenis_pelayanan'])
                                                ->where('a.flag_active', 1)
                                                ->get()->result_array();

                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'] = null;
                        if($default_param){
                            foreach($default_param as $df){
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_t_reservasi_online_parameter'] = null;
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_m_parameter_jenis_pelayanan'] = $df['id_m_parameter_jenis_pelayanan'];
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['harga'] = $df['harga'];
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['nama_parameter_jenis_pelayanan'] = $df['nama_parameter_jenis_pelayanan'];
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_t_parameter_jenis_pelayanan'] = $df['id_t_parameter_jenis_pelayanan'];
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['checked'] = 0;
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['flag_available'] = $df['flag_available'];


                                if(isset($dt_param[$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']])){
                                    $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['checked'] = 1;
                                    $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_t_reservasi_online_parameter'] = $dt_param[$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id'];
                                    $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['catatan_lab'] = $dt_param[$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['catatan_lab'];
                                    $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['hasil_lab'] = $dt_param[$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['hasil_lab'];
                                    $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['flag_available'] = $df['flag_available'];
                                }
                            }
                        }
                    }
                }
            }

            return $final_result;
        }

        public function getAllLayanan(){
            return $this->db->select('*')
                            ->from('m_jenis_pelayanan')
                            ->where('flag_active', 1)
                            ->order_by('nama_jenis_pelayanan')
                            ->get()->result_array();
        }

        public function deleteJenisLayanan($id){
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

        public function addJenisPelayanan($id){
            $rs['code'] = 0;
            $rs['message'] = '';

            $this->db->trans_begin();

            $data = $this->input->post();
            $exist = $this->db->select('*')
                            ->from('t_reservasi_online_detail')
                            ->where('id_t_reservasi_online', $id)
                            ->where('id_m_jenis_pelayanan', $data['id_m_jenis_pelayanan'])
                            ->where('flag_active', 1)
                            ->get()->row_array();
            if($exist){
                $rs['code'] = 1;
                $rs['message'] = 'Jenis Layanan sudah ada';
            } else {
                $ro = 
                $this->db->insert('t_reservasi_online_detail',
                    ['id_t_reservasi_online' => $id,
                    'id_m_jenis_pelayanan' => $data['id_m_jenis_pelayanan'],
                    'created_by' => $this->general_library->getId()]
                );
                $last_id = $this->db->insert_id();

                $parameter = null;
                $i = 0;
                foreach($data['parameter'] as $p){
                    $i++;
                    $explode = explode(';', $p);
                    $parameter[$i]['id_t_parameter_jenis_pelayanan'] = $explode[0];
                    $parameter[$i]['harga'] = $explode[1];
                    $parameter[$i]['id_t_reservasi_online_detail'] = $last_id;
                }
                $this->db->insert_batch('t_reservasi_online_parameter', $parameter);

                $total = $this->db->select('SUM(a.harga) as total')
                            ->from('t_reservasi_online_parameter a')
                            ->join('t_reservasi_online_detail b', 'a.id_t_reservasi_online_detail = b.id')
                            ->where('a.flag_active', 1)
                            ->where('b.flag_active', 1)
                            ->where('b.id_t_reservasi_online', $id)
                            ->get()->row_array();
                if($total){
                    $this->db->where('id', $id)
                            ->update('t_reservasi_online', ['total_biaya' => $total['total']]);
                }
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

        public function createBilling($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['total_biaya'] = null;
            $rs['data']['status'] = null;
            $data = $this->input->post();
            $this->db->trans_begin();

            $id_detail = null;
            $parameter = null;
            $total_biaya = 0;
            $pelanggan = $data['pelanggan'];
            $i = 0;
            foreach($data['detail'] as $dt){
                $id_detail[] = $dt;
                foreach($data['parameter_'.$dt] as $p){
                    $explode = explode(';', $p);
                    $total_biaya += $explode[1];
                    $parameter[$i]['id_t_reservasi_online_detail'] = $dt;
                    $parameter[$i]['id_t_parameter_jenis_pelayanan'] = $explode[0];
                    $parameter[$i]['harga'] = $explode[1];
                    $parameter[$i]['created_by'] = $this->general_library->getId();
                    $i++;                    
                }
            }

            // hapus semua parameter 
            $this->db->where_in('id_t_reservasi_online_detail', $id_detail)
                    ->update('t_reservasi_online_parameter', ['flag_active' => 0]);

            // tambah parameter yang baru
            $this->db->insert_batch('t_reservasi_online_parameter', $parameter);

            //update total biaya
            $this->db->where('id', $id)
                    ->update('t_reservasi_online', 
                    [
                        'total_biaya' => $total_biaya,
                        'status' => 3,
                        'id_m_pelanggan' => $pelanggan
                    ]);

            //status billing
            $this->insertVerifReservasi([
                'status' => 3,
                'id_t_reservasi_online' => $id
            ]);
            
            $status = $this->db->select('*')
                                ->from('m_status_reservasi')
                                ->where('id', 3)
                                ->get()->row_array();

            $rs['data']['total_biaya'] = formatCurrency($total_biaya);
            $rs['data']['status'] = $status ? $status['nama_status'] : 'Menunggu Pembayaran';
            
            if($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                $rs['code'] = 1;
                $rs['message'] = $this->upload->display_errors();
            } else {
                $this->db->trans_commit();
            }

            return $rs;
        }

        public function insertVerifReservasi($data){
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_verif_reservasi', $data);
        }
        
        public function deleteBilling($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 3){
                    $rs['code'] = 1;
                    $rs['message'] = 'Tidak dapat membatalkan Billing';
                    return $rs;
                } 
                $this->db->where('id', $id)
                    ->update('t_reservasi_online', 
                    [
                        'status' => 2
                    ]);
                    
                //status batal create billing
                $this->insertVerifReservasi([
                    'status' => 11,
                    'id_t_reservasi_online' => $id
                ]);
                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 2)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Menunggu Registrasi';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function acceptPayment($id){
            
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();
              //tambah nomor sampel
              $lastNoSampel = $this->db->select('a.no_sampel')
              ->from('t_reservasi_online_detail as a') 
              ->where('a.flag_active', 1) 
              ->order_by('a.no_sampel', 'desc')
              ->limit(1)           
              ->get()->result_array();
              if($lastNoSampel[0]['no_sampel'] == null){
                
                 $reservasi = $this->db->select('*')
                 ->from('t_reservasi_online_detail')
                 ->where('id_t_reservasi_online', $id)            
                 ->where('flag_active', 1)            
                 ->get()->result_array();
                
                 $noSampel = 1;
                  foreach($reservasi as $d){
                    $this->db->where('id', $d['id'])
                             ->update('t_reservasi_online_detail',[
                                'no_sampel' => $noSampel,
                                'updated_by' => $this->general_library->getId()
                            ]);
                            $noSampel++;
                }
              } else {
                $reservasi = $this->db->select('*')
                ->from('t_reservasi_online_detail')
                ->where('id_t_reservasi_online', $id)            
                ->where('flag_active', 1)            
                ->get()->result_array();
               
                $noSampel = $lastNoSampel[0]['no_sampel']+1;
                 foreach($reservasi as $d){
                   $this->db->where('id', $d['id'])
                            ->update('t_reservasi_online_detail',[
                               'no_sampel' => $noSampel,
                               'updated_by' => $this->general_library->getId()
                           ]);
                           $noSampel++;
               }
              }

         

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 3){
                    $rs['code'] = 1;
                    $rs['message'] = 'Transaksi Gagal';
                    return $rs;
                } 

                $this->db->where('id', $id)
                    ->update('t_reservasi_online', 
                    [
                        'status' => 5,
                        'id_m_pelanggan' => $this->input->post('id_m_pelanggan')
                    ]);

                    
                //tambah status pembayaran diterima
                $this->insertVerifReservasi([
                    'status' => 4,
                    'id_t_reservasi_online' => $id
                ]);

                //tambah status verifikasi oleh kepala instalasi
                $this->insertVerifReservasi([
                    'status' => 5,
                    'id_t_reservasi_online' => $id
                ]);
                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 5)
                                    ->get()->row_array();

              

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Verifikasi Kepala Instalasi';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function deletePayment($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 5){
                    $rs['code'] = 1;
                    $rs['message'] = 'Tidak dapat menghapus pembayaran';
                    return $rs;
                } 

                $this->db->where('id', $id)
                    ->update('t_reservasi_online', 
                    [
                        'status' => 3
                    ]);

                $this->db->where('id_t_reservasi_online', $id)
                    ->update('t_reservasi_online_detail', 
                    [
                        'no_sampel' => null
                    ]);
                    
                //tambah status menunggu pembayaran
                $this->insertVerifReservasi([
                    'status' => 12,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 3)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Menunggu Pembayaran';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function verifKi($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;
            $data = $this->input->post();

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 5){
                    $rs['code'] = 1;
                    $rs['message'] = 'Verifikasi Gagal';
                    return $rs;
                }

                foreach($data['detail'] as $d){
                    $this->db->where('id', $d)
                            ->update('t_reservasi_online_detail',[
                                'catatan_kepala_instalasi' => $data['catatan_'.$d],
                                'updated_by' => $this->general_library->getId()
                            ]);
                }

                $this->db->where('id', $id)
                    ->update('t_reservasi_online', 
                    [
                        'status' => 6
                    ]);
                    
                //tambah status verifikasi KI
                $this->insertVerifReservasi([
                    'status' => 6,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 6)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Menunggu Pembayaran';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function deleteVerifKi($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 6){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                }

                $this->db->where('id_t_reservasi_online', $id)
                        ->update('t_reservasi_online_detail', ['catatan_kepala_instalasi' => null]);

                $this->db->where('id', $id)
                    ->update('t_reservasi_online', 
                    [
                        'status' => 5
                    ]);
                    
                //tambah status verifikasi KI
                $this->insertVerifReservasi([
                    'status' => 5,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 5)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Menunggu Pembayaran';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function simpanHasilInputData($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;
            $data = $this->input->post();

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 6){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                }

                $parameter = $this->db->select('*')
                                    ->from('t_reservasi_online_parameter')
                                    ->where('flag_active', 1)
                                    ->where_in('id_t_reservasi_online_detail', $data['detail'])
                                    ->get()->result_array();

                foreach($parameter as $p){
                    $hasil = isset($data['hasil_'.$p['id']]) ? $data['hasil_'.$p['id']] : null;
                    $catatan = isset($data['catatan_'.$p['id']]) ? $data['catatan_'.$p['id']] : null;
                    if(isset($data['hasil_'.$p['id']])){
                        
                    }
                    $this->db->where('id', $p['id'])
                            ->update('t_reservasi_online_parameter',
                            [
                                'hasil_lab' => $hasil,
                                'catatan_lab' => $catatan,
                                'updated_by' => $this->general_library->getId(),
                            ]);
                }

                // update status
                // $this->db->where('id', $id)
                //         ->update('t_reservasi_online', ['status' => 8]);

                // tambah status verifikasi KI
                // $this->insertVerifReservasi([
                //     'status' => 8,
                //     'id_t_reservasi_online' => $id
                // ]);

                
                // $status = $this->db->select('*')
                //                     ->from('m_status_reservasi')
                //                     ->where('id', 8)
                //                     ->get()->row_array();

                // $rs['data']['status'] = $status ? $status['nama_status'] : 'Approval Koordinator Lab';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function lockResult($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 6){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                } else {
                     // update status
                    $this->db->where('id', $id)
                    ->update('t_reservasi_online', ['status' => 8]);

                    // tambah status verifikasi KI
                    $this->insertVerifReservasi([
                        'status' => 8,
                        'id_t_reservasi_online' => $id
                    ]);
                
                    $status = $this->db->select('*')
                                        ->from('m_status_reservasi')
                                        ->where('id', 8)
                                        ->get()->row_array();

                    $rs['data']['status'] = $status ? $status['nama_status'] : 'Approval Koordinator Lab';
                }
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function openLockResult($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 8){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                }

                // update status
                $this->db->where('id', $id)
                        ->update('t_reservasi_online', ['status' => 6]);

                // tambah status verifikasi KI
                $this->insertVerifReservasi([
                    'status' => 6,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 6)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Approval Koordinator Lab';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function verifKoordinatorLab($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 8){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                }

                // update status
                $this->db->where('id', $id)
                        ->update('t_reservasi_online', ['status' => 9]);

                // tambah status verifikasi koordinator lab
                $this->insertVerifReservasi([
                    'status' => 9,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 9)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Approval Kepala Balai';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function deleteVerifKoordinatorLab($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 9){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                }

                // update status
                $this->db->where('id', $id)
                        ->update('t_reservasi_online', ['status' => 8]);

                // tambah status verifikasi koordinator lab
                $this->insertVerifReservasi([
                    'status' => 8,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 8)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Approval Kepala Balai';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function verifKepalaBalai($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 9){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                }

                // update status
                $this->db->where('id', $id)
                        ->update('t_reservasi_online', ['status' => 13]);

                // tambah status verifikasi koordinator lab
                $this->insertVerifReservasi([
                    'status' => 13,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 13)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Approval Kepala Balai';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function deleteVerifKepalaBalai($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 13){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                }

                // update status
                $this->db->where('id', $id)
                        ->update('t_reservasi_online', ['status' => 9]);

                // tambah status verifikasi koordinator lab
                $this->insertVerifReservasi([
                    'status' => 9,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 9)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Approval Kepala Balai';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function publishHasil($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 13){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                }

                // update status
                $this->db->where('id', $id)
                        ->update('t_reservasi_online', ['status' => 10]);

                // tambah status verifikasi koordinator lab
                $this->insertVerifReservasi([
                    'status' => 10,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 10)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Approval Kepala Balai';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function deletePublishHasil($id){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $rs['data']['status'] = null;

            $this->db->trans_begin();

            $rsv = $this->db->select('*')
                            ->from('t_reservasi_online')
                            ->where('id', $id)            
                            ->where('flag_active', 1)            
                            ->get()->row_array();
            if($rsv){
                if($rsv['status'] != 10){
                    $rs['code'] = 1;
                    $rs['message'] = 'Terjadi Kesalahan';
                    return $rs;
                }

                // update status
                $this->db->where('id', $id)
                        ->update('t_reservasi_online', ['status' => 13]);

                // tambah status verifikasi koordinator lab
                $this->insertVerifReservasi([
                    'status' => 13,
                    'id_t_reservasi_online' => $id
                ]);

                
                $status = $this->db->select('*')
                                    ->from('m_status_reservasi')
                                    ->where('id', 13)
                                    ->get()->row_array();

                $rs['data']['status'] = $status ? $status['nama_status'] : 'Approval Kepala Balai';
            } else {
                $rs['code'] = 1;
                $rs['message'] = 'Terjadi Kesalahan';
                return $rs;
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

        public function searchReservasiByStatus($status, $flag_greater){
            $include = null;
            if($flag_greater == 1){
                $list_status = $this->session->userdata('list_status_reservasi');
                $greater_than = $list_status[$status]['urutan'];
                if($list_status){
                    foreach($list_status as $l){
                        if($l['urutan'] > $greater_than){
                            $include[] = $l['id'];
                        }
                    }
                }
            }
            
            $this->db->select('a.*, b.nama_status')
                    ->from('t_reservasi_online a')
                    ->join('m_status_reservasi b', 'a.status = b.id')
                    ->where('a.flag_active', 1)
                    ->order_by('a.created_date', 'asc');

            if($flag_greater == 1){
                $this->db->where_in('status', $include);
            } else {
                $this->db->where('status', $status);
            }

            return $this->db->get()->result_array();
        }

        public function getAllParameter(){
            return $this->db->select('*')
                            ->from('m_parameter_jenis_pelayanan')
                            ->where('flag_active', 1)
                            ->order_by('nama_parameter_jenis_pelayanan')
                            ->get()->result_array();
        }

        public function loadParameterForInputHasil($id){
            return $this->db->select('c.id, a.nama_parameter_jenis_pelayanan, c.hasil_lab, c.catatan_lab, e.id as id_t_reservasi_online,
                            d.id as id_t_reservasi_online_detail, e.created_date as tgl_regis, f.satuan, d.no_sampel')
                            ->from('m_parameter_jenis_pelayanan a')
                            ->join('t_parameter_jenis_pelayanan b', 'a.id = b.id_m_parameter_jenis_pelayanan')
                            ->join('t_reservasi_online_parameter c', 'b.id = c.id_t_parameter_jenis_pelayanan')
                            ->join('t_reservasi_online_detail d', 'd.id = c.id_t_reservasi_online_detail')
                            ->join('t_reservasi_online e', 'e.id = d.id_t_reservasi_online')
                            ->join('m_parameter_jenis_pelayanan f', 'b.id_m_parameter_jenis_pelayanan = f.id')
                            ->where('c.flag_active', 1)
                            ->where('d.flag_active', 1)
                            ->where('e.flag_active', 1)
                            ->where('b.flag_active', 1)
                            // ->where('e.status', 6)
                            ->where('a.id', $id)
                            ->order_by('e.created_date', 'asc')
                            ->group_by('c.id')
                            ->get()->result_array();
        }

        public function simpanInputHasil(){
            $rs['code'] = 0;
            $rs['message'] = '';
            $rs['data'] = null;
            $data = $this->input->post();

            $this->db->trans_begin();

            if($data){
                foreach(array_keys($data) as $d){
                    $explode = explode("_", $d);
                    $this->db->where('id', $explode[2])
                            ->update('t_reservasi_online_parameter', [
                                'hasil_lab' => $data['hasil_lab_'.$explode[2]],
                                'catatan_lab' => $data['catatan_lab_'.$explode[2]],
                                'updated_by' => $this->general_library->getId()
                            ]);
                }
            } else {
                $rs['code'] = 0;
                $rs['message'] = 'Terjadi Kesalahan';
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

        public function getAllPelanggan(){
            return $this->db->select('*')
                            ->from('m_pelanggan')
                            ->where('flag_active', 1)
                            ->order_by('nama')
                            ->get()->result_array();
        }

        public function getPelanggan()
        {      
            $id = $this->input->post('id_m_pelanggan');
            $this->db->select('*')
                ->from('m_pelanggan as a')
                ->where('a.id', $id)
                ->where('a.flag_active', 1)
                ->limit(1);
                return $this->db->get()->result_array();
        }

        public function formAddParameterLangsung($data){
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
                    $reservasi['total_biaya'] = $data['total_biaya'];
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
                        $reservasi['nomor_tiket'] = strtoupper(generateRandomLetter(4)).date('Ymd').$counter;
                        $reservasi['id_m_pelanggan'] = $data['id_m_pelanggan'];
                        $reservasi['status'] = 3;
                        $reservasi['flag_regis_langsung'] = 1;
                    $this->db->insert('t_reservasi_online', $reservasi);
                    $last_id_parent = $this->db->insert_id();
                    $rs['id'] = $last_id_parent;
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
       
        public function sendNotifTelegram($data){
            $req = $this->telegramlib->send_curl_exec('GET', 'sendMessage', $data['send_to'], $data);
            $this->db->insert('t_log_telegram', [
                'request' => json_encode($data),
                'response' => json_encode($req),
                'created_by' => $this->general_library->getId()
            ]);
        }
            

    }
?>