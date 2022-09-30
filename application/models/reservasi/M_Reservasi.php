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
            return $this->db->select('a.session_id, a.id, a.created_date as tanggal_reservasi, d.nama_status, a.total_biaya, a.nomor_tiket, a.status')
                            ->from('t_reservasi_online a')
                            ->join('m_status_reservasi d', 'a.status = d.id')
                            ->where('a.id', $id)
                            ->where('a.status !=', 1)
                            ->get()->row_array();
        }

        public function loadDetailLayanan($id){
            $final_result = null;
            $result = $this->db->select('a.session_id, c.nama_jenis_pelayanan, b.id_m_jenis_pelayanan, a.id, b.id as id_t_reservasi_online_detail,
                            a.created_date, d.nama_status, a.total_biaya, a.nomor_tiket, a.status')
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
                        c.id as id_m_parameter_jenis_pelayanan, a.id_t_parameter_jenis_pelayanan')
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

                        $default_param = $this->db->select('a.id_m_jenis_pelayanan, a.id as id_t_parameter_jenis_pelayanan, b.nama_parameter_jenis_pelayanan, a.harga, b.id as id_m_parameter_jenis_pelayanan')
                                                ->from('t_parameter_jenis_pelayanan a')
                                                ->join('m_parameter_jenis_pelayanan b', 'a.id_m_parameter_jenis_pelayanan = b.id')
                                                ->where('a.id_m_jenis_pelayanan', $rs['id_m_jenis_pelayanan'])
                                                ->where('a.flag_active', 1)
                                                ->get()->result_array();

                        $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'] = null;
                        if($default_param){
                            foreach($default_param as $df){
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_m_parameter_jenis_pelayanan'] = $df['id_m_parameter_jenis_pelayanan'];
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['harga'] = $df['harga'];
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['nama_parameter_jenis_pelayanan'] = $df['nama_parameter_jenis_pelayanan'];
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['id_t_parameter_jenis_pelayanan'] = $df['id_t_parameter_jenis_pelayanan'];
                                $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['checked'] = 0;

                                if(isset($dt_param[$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']])){
                                    $final_result['pelayanan'][$rs['id_m_jenis_pelayanan']]['parameter'][$df['id_m_parameter_jenis_pelayanan']]['checked'] = 1;
                                }
                            }
                        }
                    }
                    // dd(json_encode($final_result));
                    $j = 0;
                    foreach($detail as $d){
                        // if(isset($final_result['pelayanan'][$d['id_m_jenis_pelayanan']]['parameter'][$d['id_m_parameter_jenis_pelayanan']])){
                            // dd(json_encode($final_result['pelayanan'][$d['id_m_jenis_pelayanan']]));

                            // $final_result['pelayanan'][$d['id_m_jenis_pelayanan']]['parameter'][$d['id_m_parameter_jenis_pelayanan']]['checked'] = 1;
                        // }
                        // $final_result[$d['id_m_jenis_pelayanan']]['parameter'][$j]['harga'] = $d['harga'];
                        // $final_result[$d['id_m_jenis_pelayanan']]['parameter'][$j]['id_t_reservasi_online_parameter'] = $d['id'];
                        // $j++;
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
                        'status' => 3
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

    }
?>