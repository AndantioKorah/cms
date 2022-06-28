<?php
	class M_Rekap extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function getKomponenKinerja($id_m_user, $bulan, $tahun){
            return $this->db->select('*')
                            ->from('t_komponen_kinerja')
                            ->where('id_m_user', $id_m_user)
                            ->where('bulan', $bulan)
                            ->where('tahun', $tahun)
                            ->where('flag_active', 1)
                            ->get()->row_array();
        }

        public function getKinerjaPegawai($id_m_user, $bulan, $tahun){
            return $this->db->select('*')
                            ->from('t_rencana_kinerja')
                            ->where('id_m_user', $id_m_user)
                            ->where('bulan', $bulan)
                            ->where('tahun', $tahun)
                            ->where('flag_active', 1)
                            ->get()->result_array();
        }

        public function rekapPenilaianSearch($data){
            $result = null;
            $skpd = explode(";",$data['skpd']);
            $list_pegawai = $this->db->select('b.username as nip, trim(b.nama) as nama_pegawai, b.id, c.nama_jabatan, c.eselon')
                                    ->from('db_pegawai.pegawai a')
                                    ->join('m_user b', 'a.nipbaru_ws = b.username')
                                    ->join('db_pegawai.jabatan c', 'a.jabatan = c.id_jabatanpeg', 'left')
                                    ->where('a.skpd', $skpd[0])
                                    ->where('b.flag_active', 1)
                                    ->order_by('c.eselon, b.username')
                                    ->get()->result_array();
            $temp_pegawai = null;
            if($list_pegawai){
                $i = 0;
                $j = 0;
                foreach($list_pegawai as $p){
                    $temp = $p;
                    $bobot_komponen_kinerja = 0;
                    $bobot_skp = 0;
                    $temp['komponen_kinerja'] = $this->getKomponenKinerja($p['id'], $data['bulan'], $data['tahun']);
                    if($temp['komponen_kinerja']){
                        list($temp['komponen_kinerja']['capaian'], $temp['komponen_kinerja']['bobot']) = countNilaiKomponen($temp['komponen_kinerja']);
                        $bobot_komponen_kinerja = $temp['komponen_kinerja']['bobot'];
                    }
                    $temp['kinerja'] = $this->getKinerjaPegawai($p['id'], $data['bulan'], $data['tahun']);
                    if($temp['kinerja']){
                        $temp['nilai_skp'] = countNilaiSkp($temp['kinerja']);
                        $bobot_skp = $temp['nilai_skp']['bobot'];
                    }
                    $temp['bobot_capaian_produktivitas_kerja'] = floatval($bobot_komponen_kinerja) + floatval($bobot_skp);
                    if($p['eselon'] != null){
                        $result[$i] = $temp;
                        $i++;
                    } else {
                        $temp_pegawai[$j] = $temp;
                        $j++;
                    }
                }
                if($temp_pegawai){
                    foreach($temp_pegawai as $t){
                        $result[$i] = $t;
                        $i++;
                    }
                }
            }
            return $result;
        }

        public function rekapDisiplinSearch($data){
            $result = null;
            $rs = null;
            $skpd = explode(";",$data['skpd']);
            $data_jam_kerja['wfo_masuk'] = "07:45:59";
            $data_jam_kerja['wfo_pulang'] = "17:00";
            $data_jam_kerja['wfoj_masuk'] = "07:30:59";
            $data_jam_kerja['wfoj_pulang'] = "15:30";

            $list_pegawai = $this->db->select('b.username as nip, trim(b.nama) as nama_pegawai, b.id, c.nama_jabatan, c.eselon, f.role_name')
                                    ->from('db_pegawai.pegawai a')
                                    ->join('m_user b', 'a.nipbaru_ws = b.username')
                                    ->join('db_pegawai.jabatan c', 'a.jabatan = c.id_jabatanpeg', 'left')
                                    ->join('db_pegawai.unitkerja d', 'a.skpd = d.id_unitkerja')
                                    ->join('m_user_role e', 'b.id = e.id_m_user', 'left')
                                    ->join('m_role f', 'f.id = e.id_m_role', 'left')
                                    ->where('a.skpd', $skpd[0])
                                    ->where('b.flag_active', 1)
                                    ->group_by('b.id')
                                    ->order_by('c.eselon, b.username')
                                    ->get()->result_array();
                                    
            if($list_pegawai){
                $temp = $list_pegawai;
                $list_pegawai = null;
                foreach($temp as $t){
                    $list_pegawai[$t['nip']] = $t;
                }
            }

            $hari_libur = $this->db->select('tanggal')
                                ->from('t_hari_libur')
                                ->where('bulan', $data['bulan'])
                                ->where('tahun', $data['tahun'])
                                ->where('flag_active', 1)
                                ->get()->result_array();
            $list_hari_libur = null;
            if($hari_libur){
                foreach($hari_libur as $h){
                    $list_hari_libur[] = $h['tanggal'];
                }
            }
            // echo(strtotime($data_jam_kerja['wfo_masuk'].'+ 1 minute')).';';
            // echo(strtotime($data_jam_kerja['wfo_masuk']));
            // die();
            // $absen = "07:46:00";
            // $diff = strtotime($absen) - strtotime($data_jam_kerja['wfo_masuk']);
            // dd($diff/60);

            if($_FILES["file_rekap"]["name"] != ''){
                $allowed_extension = ['xls', 'csv', 'xlsx'];
                $file_array = explode(".", $_FILES["file_rekap"]["name"]);
                $file_extension = end($file_array);
    
                if(in_array($file_extension, $allowed_extension)){
                    $config['upload_path'] = 'assets/upload_rekap_absen/new_format'; 
                    $config['allowed_types'] = '*';
                    $config['max_size'] = '5000'; // max_size in kb
                    $config['file_name'] = $_FILES['file_rekap']['name'];
    
                    $this->load->library('upload', $config); 
    
                    $uploadfile = $this->upload->do_upload('file_rekap');
    
                    if($uploadfile){
                        $upload_data = $this->upload->data(); 
                        $file_rekap['name'] = $upload_data['file_name'];
    
                        $filename = $_FILES["file_rekap"]["name"];
                        libxml_use_internal_errors(true);
                        // $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($_FILES["file_rekap"]["name"]);
                        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($config['upload_path'].'/'.$file_rekap['name']);
                        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
    
                        $spreadsheet = $reader->load($_FILES["file_rekap"]["tmp_name"]);
                        // $data = $spreadsheet->getActiveSheet()->toArray();
                        $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
                        $highestColumn = $spreadsheet->getActiveSheet()->getHighestColumn();
                        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

                        for($row = 6; $row <= $highestRow; $row++){
                            $nip = null;
                            $value_tanggal = null;
                            $flag_jumat = false;
                            $flag_libur = false;
                            for($col = 2; $col <= $highestColumnIndex; $col++){
                                $value = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($col, $row)->getValue();
                                if($value){
                                    if($col == 2){ //nip
                                        $nip = clearstring($value);
                                    //     $list_pegawai[$nip]['nip'] = $nip;
                                    // } else if($col == 3) {//nama pegawai
                                    //     $list_pegawai[$nip]['nama_pegawai'] = $value;
                                    }
                                    if(isset($list_pegawai[$nip])){
                                        if($col == 4){ //tanggal absen
                                            $tanggal = explode("/", $value);
                                            if($tanggal[1] == $data['bulan'] && $tanggal[2] == $data['tahun']){
                                                $value_tanggal = $value;
                                                $date_ymd = $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0];
                                                if(in_array($date_ymd, $list_hari_libur)){
                                                    $flag_libur = true;
                                                }
                                                $value_tanggal = $tanggal[0].'-'.$tanggal[1].'-'.$tanggal[2];
                                                $date = date('d-m-Y', strtotime($value_tanggal));
                                                $hari = getNamaHari($date);
                                                if($hari == 'Jumat'){
                                                    $flag_jumat = true;
                                                } else if($hari == 'Sabtu' || $hari == 'Minggu'){
                                                    $flag_libur = true;
                                                }
                                                if(!isset($list_pegawai[$nip]['rekap_absensi']['tmk1'])){
                                                    $list_pegawai[$nip]['rekap_absensi']['tmk1'] = 0;
                                                }
                                                if(!isset($list_pegawai[$nip]['rekap_absensi']['tmk2'])){
                                                    $list_pegawai[$nip]['rekap_absensi']['tmk2'] = 0;
                                                }
                                                if(!isset($list_pegawai[$nip]['rekap_absensi']['tmk3'])){
                                                    $list_pegawai[$nip]['rekap_absensi']['tmk3'] = 0;
                                                }
                                                if(!isset($list_pegawai[$nip]['rekap_absensi']['pksw1'])){
                                                    $list_pegawai[$nip]['rekap_absensi']['pksw1'] = 0;
                                                }
                                                if(!isset($list_pegawai[$nip]['rekap_absensi']['pksw2'])){
                                                    $list_pegawai[$nip]['rekap_absensi']['pksw2'] = 0;
                                                }
                                                if(!isset($list_pegawai[$nip]['rekap_absensi']['pksw3'])){
                                                    $list_pegawai[$nip]['rekap_absensi']['pksw3'] = 0;
                                                }
                                                $list_pegawai[$nip]['absensi'][$value_tanggal] = null;
                                                $list_pegawai[$nip]['absensi'][$value_tanggal]['masuk']['data'] = null;
                                                $list_pegawai[$nip]['absensi'][$value_tanggal]['pulang']['data'] = null;
                                                $list_pegawai[$nip]['absensi'][$value_tanggal]['masuk']['keterangan'] = null;
                                                $list_pegawai[$nip]['absensi'][$value_tanggal]['pulang']['keterangan'] = null;
                                            }
                                        } else if($col == 6 && $value_tanggal && !$flag_libur){ //absen masuk
                                            // if($nip == '197402061998031008' && $value_tanggal == '29-05-2022'){
                                            //     echo $value_tanggal.';'.$flag_libur.';'.json_encode($list_hari_libur);
                                            //     die();
                                            // }
                                            $list_pegawai[$nip]['absensi'][$value_tanggal]['masuk']['data'] = $value;
                                            if($value == "00:00:00"){
                                                // if($nip == '197402061998031008'){
                                                //     echo $value_tanggal.' ; ';
                                                // }
                                                $list_pegawai[$nip]['rekap_absensi']['tmk3']++;
                                                $list_pegawai[$nip]['absensi'][$value_tanggal]['masuk']['keterangan'] = 'tmk3';
                                            } else {
                                                if($flag_jumat){
                                                    $jam_masuk = $data_jam_kerja['wfoj_masuk'];
                                                } else {
                                                    $jam_masuk = $data_jam_kerja['wfo_masuk'];
                                                }
                                                $diff = strtotime($value) - strtotime($jam_masuk);
                                                if($diff > 0){
                                                    $keterangan = floatval($diff) / 1800; // setengah jam lebih 59 detik
                                                    if($keterangan <= 1){
                                                        $list_pegawai[$nip]['rekap_absensi']['tmk1']++;
                                                        $list_pegawai[$nip]['absensi'][$value_tanggal]['masuk']['keterangan'] = 'tmk1';
                                                    } else if($keterangan > 1 && $keterangan <= 2){
                                                        $list_pegawai[$nip]['rekap_absensi']['tmk2']++;
                                                        $list_pegawai[$nip]['absensi'][$value_tanggal]['masuk']['keterangan'] = 'tmk2';
                                                    } else if($keterangan > 2){
                                                        $list_pegawai[$nip]['rekap_absensi']['tmk3']++;
                                                        $list_pegawai[$nip]['absensi'][$value_tanggal]['masuk']['keterangan'] = 'tmk3';
                                                    }
                                                }
                                            }
                                        } else if($col == 9 && $value_tanggal && !$flag_libur){ //absen keluar
                                            $list_pegawai[$nip]['absensi'][$value_tanggal]['pulang']['data'] = $value;
                                            if($value == "00:00:00"){
                                                $list_pegawai[$nip]['rekap_absensi']['pksw3']++;
                                                $list_pegawai[$nip]['absensi'][$value_tanggal]['pulang']['keterangan'] = 'pksw3';
                                            } else {
                                                if($flag_jumat){
                                                    $jam_keluar = $data_jam_kerja['wfoj_pulang'];
                                                } else {
                                                    $jam_keluar = $data_jam_kerja['wfo_pulang'];
                                                }
                                                $diff = strtotime($jam_keluar) - strtotime($value);
                                                if($diff > 0){
                                                    $keterangan = floatval($diff) / 1800; // setengah jam lebih 59 detik
                                                    if($keterangan <= 1){
                                                        $list_pegawai[$nip]['rekap_absensi']['pksw1']++;
                                                        $list_pegawai[$nip]['absensi'][$value_tanggal]['pulang']['keterangan'] = 'pksw1';
                                                    } else if($keterangan > 1 && $keterangan <= 2){
                                                        $list_pegawai[$nip]['rekap_absensi']['pksw2']++;
                                                        $list_pegawai[$nip]['absensi'][$value_tanggal]['pulang']['keterangan'] = 'pksw2';
                                                    } else if($keterangan > 2){
                                                        $list_pegawai[$nip]['rekap_absensi']['pksw3']++;
                                                        $list_pegawai[$nip]['absensi'][$value_tanggal]['pulang']['keterangan'] = 'pksw3';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                    }
                } else {
                    $rs['code'] = 1;
                    $rs['message'] = "File yang dipilih bukan file Excel atau CSV !";    
                }
            } else {
                $rs['code'] = 1;
                $rs['message'] = "Tidak ada file yang dipilih";
            }
            
            $temp_pegawai = null;
            $result = null;
            if($list_pegawai){
                $i = 0;
                $j = 0;
                foreach($list_pegawai as $p){
                    $temp = $p;
                    if($p['eselon'] != null){
                        $result[$i] = $temp;
                        $i++;
                    } else {
                        $temp_pegawai[$j] = $temp;
                        $j++;
                    }
                }
                if($temp_pegawai){
                    foreach($temp_pegawai as $t){
                        $result[$i] = $t;
                        $i++;
                    }
                }
                $list_pegawai = $result;
            }
            return $list_pegawai;
        }

	}
?>