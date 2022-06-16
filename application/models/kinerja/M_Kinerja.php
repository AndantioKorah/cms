<?php
	class M_Kinerja extends CI_Model
	{
		public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database('main', true);
        }

        public function insert($tablename, $data){
            $this->db->insert($tablename, $data);
        }

        public function createLaporanKegiatan($dataPost,$image){
  
        $this->db->trans_begin();
        $data = array('tanggal_kegiatan' => $dataPost['tanggal_kegiatan'], 
                      'deskripsi_kegiatan' => $dataPost['deskripsi_kegiatan'],
                      'realisasi_target_kuantitas' => $dataPost['target_kuantitas'],
                      'satuan' => $dataPost['satuan'],
                      'target_kualitas' => 100,
                      'id_t_rencana_kinerja' => $dataPost['tugas_jabatan'],
                      'bukti_kegiatan' => $image,
                      'id_m_user' => $this->general_library->getId()
        );
        $result = $this->db->insert('t_kegiatan', $data);
       
        //cek 
        $id =  $this->general_library->getId();
        $bulan = date('n');
        $tahun = date('Y');
        $cek = $this->db->select('a.*,
        (select sum(b.realisasi_target_kuantitas) from t_kegiatan as b where a.id = b.id_t_rencana_kinerja and b.flag_active = 1) as realisasi_target_kuantitas
        ')
                        ->from('t_rencana_kinerja a')
                        ->where('a.id_m_user', $id)
                        ->where('a.tahun', $tahun)
                        ->where('a.bulan', $bulan)
                        ->where('a.id', $dataPost['tugas_jabatan'])
                        ->where('a.flag_active', 1)
                        ->get()->result_array();

        // dd($cek['0']['target_kuantitas']);            
         if($cek['0']['realisasi_target_kuantitas'] > $cek['0']['target_kuantitas']){
            $this->db->where('id',  $dataPost['tugas_jabatan'])
                     ->update('t_rencana_kinerja', [
                     'updated_by' => $this->general_library->getId(),
                     'target_kuantitas' => $cek['0']['realisasi_target_kuantitas']
            ]);
         }
         if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            }
      

        }

        public function loadKegiatan($tahun,$bulan){
            $id =  $this->general_library->getId();
            return $this->db->select('a.*, b.tugas_jabatan,c.status_verif, a.status_verif as id_status_verif')
                ->from('t_kegiatan a')
                ->join('t_rencana_kinerja b', 'a.id_t_rencana_kinerja = b.id')
                ->join('m_status_verif c', 'a.status_verif = c.id')
                ->where('a.id_m_user', $id)
                ->where('year(a.tanggal_kegiatan)', $tahun)
                ->where('month(a.tanggal_kegiatan)', $bulan)
                ->where('a.flag_active', 1)
                ->order_by('a.id', 'desc')
                ->get()->result_array();
           
        }


        public function loadRencanaKinerja($bulan, $tahun){
            $id =  $this->general_library->getId();
            return $this->db->select('a.*,
            (select count(b.id) from t_kegiatan as b where a.id = b.id_t_rencana_kinerja and b.flag_active = 1) as count')
                            ->from('t_rencana_kinerja a')
                            ->where('a.id_m_user', $id)
                            ->where('a.flag_active', 1)
                            ->where('a.bulan', $bulan)
                            ->where('a.tahun', $tahun)
                            ->get()->result_array();
        }


        public function getRencanaKinerja($bulan, $tahun){
            $id =  $this->general_library->getId();
            return $this->db->select('*')
                            ->from('t_rencana_kinerja as a')
                            ->where('a.id_m_user', $id)
                            ->where('a.tahun', $tahun)
                            ->where('a.bulan', $bulan)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }

        public function getSatuan()
    {      
        $id = $this->input->post('id_t_rencana_kinerja');
        $this->db->select('*')
            ->from('t_rencana_kinerja as a')
            ->where('a.id', $id)
            ->where('a.flag_active', 1)
            ->limit(1);
            return $this->db->get()->result_array();
    }

    public function loadRekapKinerjaBU(){

        
        $id =  $this->general_library->getId();
        if($this->input->post()) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
        } else {
            $bulan = date('n');
            $tahun = date('Y');
        }
       
       
        $query = $this->db->select('a.*,
        (select sum(b.realisasi_target_kuantitas) from t_kegiatan as b where a.id = b.id_t_rencana_kinerja and b.flag_active = 1 and b.status_verif = 1) as realisasi_target_kuantitas
        ')
                        ->from('t_rencana_kinerja a')
                        ->where('a.id_m_user', $id)
                        ->where('a.tahun', $tahun)
                        ->where('a.bulan', $bulan)
                        ->where('a.flag_active', 1)
                        ->get()->result_array();
        // dd($query);
        return $query;  
    }

    public function loadRekapKinerja($tahun,$bulan){

        
        $id =  $this->general_library->getId();
        if($tahun) {
            $bulan = $bulan;
            $tahun = $tahun;
        } else {
            $bulan = date('n');
            $tahun = date('Y');
        }
       
       
        $query = $this->db->select('a.*,
        (select sum(b.realisasi_target_kuantitas) from t_kegiatan as b where a.id = b.id_t_rencana_kinerja and b.flag_active = 1 and b.status_verif = 1) as realisasi_target_kuantitas
        ')
                        ->from('t_rencana_kinerja a')
                        ->where('a.id_m_user', $id)
                        ->where('a.tahun', $tahun)
                        ->where('a.bulan', $bulan)
                        ->where('a.flag_active', 1)
                        ->get()->result_array();
        // dd($query);
        return $query;  
    }


    function getRencanaKerja(){
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $query = $this->db->get_where('t_rencana_kinerja', array('flag_active' => 1, 'bulan' => $bulan, 'tahun' => $tahun, 'id_m_user' => $this->general_library->getId()));
        return $query;
    }

    
    public function getReaslisasiKinerjaEdit($id){
        return $this->db->select('a.*, b.tugas_jabatan')
                        ->from('t_kegiatan a')
                        ->join('t_rencana_kinerja b', 'a.id_t_rencana_kinerja = b.id')
                        ->where('a.id', $id)
                        ->where('a.flag_active', 1)
                        ->limit(1)
                        ->get()->row_array();
    }


    public function editRealisasiKinerja(){
        $res['code'] = 0;
        $res['message'] = 'ok';
        $res['data'] = null;

        $datapost = $this->input->post();
        
        $this->db->trans_begin();
        $id_kegiatan = $datapost['id_kegiatan'];

        $data["realisasi_target_kuantitas"] = $datapost["edit_realisasi_target_kuantitas"];
        $data["deskripsi_kegiatan"] = $datapost["edit_deskripsi_kegiatan"];


        $this->db->where('id', $id_kegiatan)
                ->update('t_kegiatan', $data);

        if($this->db->trans_status() == FALSE){
            $this->db->trans_rollback();
            $res['code'] = 1;
            $res['message'] = 'Terjadi Kesalahan';
            $res['data'] = null;
        } else {
            $this->db->trans_commit();
        }

        return $res;
    }


    public function editRencanaKinerja(){
        $res['code'] = 0;
        $res['message'] = 'ok';
        $res['data'] = null;

        $datapost = $this->input->post();
        
        $this->db->trans_begin();
        $id_rencana_kinerja = $datapost['id_rencana_kinerja'];

    
        $data["target_kuantitas"] = $datapost["edit_target_kuantitas"];
        $data["satuan"] = $datapost["edit_satuan"];


        $this->db->where('id', $id_rencana_kinerja)
                ->update('t_rencana_kinerja', $data);

        if($this->db->trans_status() == FALSE){
            $this->db->trans_rollback();
            $res['code'] = 1;
            $res['message'] = 'Terjadi Kesalahan';
            $res['data'] = null;
        } else {
            $this->db->trans_commit();
        }

        return $res;
    }


    public function getRencanaKinerjaEdit($id){
        return $this->db->select('a.*')
                        ->from('t_rencana_kinerja a')
                        ->where('a.id', $id)
                        ->where('a.flag_active', 1)
                        ->limit(1)
                        ->get()->row_array();
    }

    public function createSkpBulanan($data){
        $pegawai = $this->db->select('a.id, b.gelar1, b.nipbaru_ws, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat, 
        f.id_m_bidang, a.id_m_sub_bidang, c.id_unitkerja, c.id_unitkerjamaster')
                            ->from('m_user a')
                            ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                            ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                            ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                            ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                            ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id', 'left')
                            ->where('a.flag_active', 1)
                            ->where('a.id', $this->general_library->getId())
                            ->get()->row_array();
        // dd($pegawai);
        $atasan = "";
        $flag_sekolah = false;
        $flag_kelurahan = false;
        $flag_kecamatan = false;
        $explodeuk = explode(" ", $pegawai['nm_unitkerja']);
        $kepala_pd = "kepalabadan";

        if($this->general_library->isPelaksana() || $this->general_library->isKasub()){
            $atasan = 'kepalabidang';
            if($explodeuk[0] == 'Kelurahan'){
                $flag_kelurahan = true;
                $atasan = 'sekretarisbadan';
                $kepala_pd = "lurah";
            } else if($explodeuk[0] == 'Kecamatan'){
                $flag_kecamatan = true;
                $atasan = 'sekretarisbadan';
                $kepala_pd = "camat";
            }
        } else if($this->general_library->isKabid() || $this->general_library->isSekban()){
            $atasan = 'kepalabadan';
            if($explodeuk[0] == 'Kelurahan'){
                $flag_kelurahan = true;
                $atasan = 'lurah';
                $kepala_pd = "camat";
            } else if($explodeuk[0] == 'Kecamatan'){
                $flag_kecamatan = true;
                $atasan = 'camat';
                $kepala_pd = "setda";
            }
        } else if($this->general_library->isKaban()){
            $atasan = 'setda';
        } else if($this->general_library->isSetda()){
            $atasan = 'walikota';
        } else if($this->general_library->isGuruStaffSekolah()){
            $atasan = 'kepalasekolah';
            $flag_sekolah = true;
        } else if($this->general_library->isKepalaSekolah()){
            $atasan = 'kepalabidang';
            $flag_sekolah = true;
        } else if($this->general_library->isLurah()){
            $atasan = 'camat';
            $kepala_pd = "setda";
            $flag_kelurahan = true;
        } else if($this->general_library->isCamat()){
            $atasan = 'setda';
            $kepala_pd = "setda";
            $flag_kecamatan = true;
        }

        // $flag_sekolah = false;
        // if($this->general_library->isPelaksana()){
        //     $kepala_pd = 'kepalabadan';
        // } else if($this->general_library->isKabid() || $this->general_library->isSekban()){
        //     $kepala_pd = 'kepalabadan';
        // } else if($this->general_library->isKaban()){
        //     $kepala_pd = 'setda';
        // } else if($this->general_library->isSetda()){
        //     $kepala_pd = 'walikota';
        // } else if($this->general_library->isGuruStaffSekolah()){
        //     $kepala_pd = 'kepalasekolah';
        //     $flag_sekolah = true;
        // } else if($this->general_library->isKepalaSekolah()){
        //     $kepala_pd = 'kepalabidang';
        //     $flag_sekolah = true;
        // }

    
        // dd($kepala_pd);
        $atasan_pegawai = null;
        if($flag_sekolah){
            //kepala pd guru dan kepsek adalah kadis pendidikan
            $kepala_pd = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat')
                            ->from('m_user a')
                            ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                            ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                            ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                            ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                            ->join('m_user_role g', 'a.id = g.id_m_user')
                            ->join('m_role h', 'g.id_m_role = h.id')
                            ->where('b.skpd', '3010000')
                            ->where('a.id !=', $this->general_library->getId())
                            ->where('h.role_name', $kepala_pd)
                            ->where('a.flag_active', 1)
                            ->group_by('a.id')
                            ->limit(1)
                            ->get()->row_array();
            if($this->general_library->isGuruStaffSekolah()){
                $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat, f.id_m_bidang')
                            ->from('m_user a')
                            ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                            ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                            ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                            ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                            ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id', 'left')
                            ->join('m_user_role g', 'a.id = g.id_m_user')
                            ->join('m_role h', 'g.id_m_role = h.id')
                            ->where('f.id_m_bidang', $pegawai['id_m_bidang'])
                            ->where('a.id !=', $this->general_library->getId())
                            ->where('h.role_name', $atasan)
                            ->where('a.flag_active', 1)
                            ->group_by('a.id')
                            ->limit(1)
                            ->get()->row_array();
            } else if ($this->general_library->isKepalaSekolah()){
                $id_role_kabid = '138'; //kepsek SMP
                if($pegawai['id_unitkerjamaster'] == '8010000'){ //kepsek SD
                    $id_role_kabid = '134'; //kepsek SMP
                }
                $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat, f.id_m_bidang')
                            ->from('m_user a')
                            ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                            ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                            ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                            ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                            ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id')
                            ->join('m_user_role g', 'a.id = g.id_m_user')
                            ->join('m_role h', 'g.id_m_role = h.id')
                            ->where('f.id', $id_role_kabid)
                            ->where('a.id !=', $this->general_library->getId())
                            ->where('h.role_name', $atasan)
                            ->where('a.flag_active', 1)
                            ->group_by('a.id')
                            ->limit(1)
                            ->get()->row_array();
            }
        } else if($flag_kecamatan || $flag_kelurahan){
            //jika pegawai kecamatan atau kelurahan
            // $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat, f.id_m_bidang')
            //                             ->from('m_user a')
            //                             ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
            //                             ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
            //                             ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
            //                             ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
            //                             ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id')
            //                             ->join('m_user_role g', 'a.id = g.id_m_user')
            //                             ->join('m_role h', 'g.id_m_role = h.id')
            //                             ->where('c.id_unitkerja', $pegawai['id_unitkerja'])
            //                             ->where('a.id !=', $this->general_library->getId())
            //                             ->where('h.role_name', $atasan)
            //                             ->where('a.flag_active', 1)
            //                             ->where('g.flag_active', 1)
            //                             ->group_by('a.id')
            //                             ->limit(1)
            //                             ->get()->row_array();

            if($atasan == 'lurah' || $atasan == 'sekretarisbadan'){
                //jika atasan lurah, maka kepala_pd camat
                $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat')
                                        ->from('m_user a')
                                        ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                                        ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                                        ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                                        ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                                        // ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id')
                                        ->join('m_user_role g', 'a.id = g.id_m_user')
                                        ->join('m_role h', 'g.id_m_role = h.id')
                                        ->where('c.id_unitkerja', $pegawai['id_unitkerja'])
                                        ->where('a.id !=', $this->general_library->getId())
                                        ->where('h.role_name', $atasan)
                                        ->where('a.flag_active', 1)
                                        ->where('g.flag_active', 1)
                                        ->group_by('a.id')
                                        ->limit(1)
                                        ->get()->row_array();

                $kepala_pd = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat')
                                        ->from('m_user a')
                                        ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                                        ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                                        ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                                        ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                                        ->join('m_user_role g', 'a.id = g.id_m_user')
                                        ->join('m_role h', 'g.id_m_role = h.id')
                                        ->where('c.id_unitkerjamaster', $pegawai['id_unitkerjamaster'])
                                        ->where('a.id !=', $this->general_library->getId())
                                        ->where('h.role_name', $kepala_pd)
                                        ->where('g.flag_active', 1)
                                        ->where('a.flag_active', 1)
                                        ->group_by('a.id')
                                        ->limit(1)
                                        ->get()->row_array();
            } else if($atasan == 'camat') {
                //jika atasan camat, maka kepala_pd setda
                if($flag_kelurahan){
                    $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat')
                                        ->from('m_user a')
                                        ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                                        ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                                        ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                                        ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                                        ->join('m_user_role g', 'a.id = g.id_m_user')
                                        ->join('m_role h', 'g.id_m_role = h.id')
                                        ->where('c.id_unitkerjamaster', $pegawai['id_unitkerjamaster'])
                                        ->where('a.id !=', $this->general_library->getId())
                                        ->where('h.role_name', $atasan)
                                        ->where('g.flag_active', 1)
                                        ->where('a.flag_active', 1)
                                        ->group_by('a.id')
                                        ->limit(1)
                                        ->get()->row_array();
                } else {
                    $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat')
                                        ->from('m_user a')
                                        ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                                        ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                                        ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                                        ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                                        // ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id')
                                        ->join('m_user_role g', 'a.id = g.id_m_user')
                                        ->join('m_role h', 'g.id_m_role = h.id')
                                        ->where('c.id_unitkerja', $pegawai['id_unitkerja'])
                                        ->where('a.id !=', $this->general_library->getId())
                                        ->where('h.role_name', $atasan)
                                        ->where('a.flag_active', 1)
                                        ->where('g.flag_active', 1)
                                        ->group_by('a.id')
                                        ->limit(1)
                                        ->get()->row_array();
                }

                $kepala_pd = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat')
                                        ->from('m_user a')
                                        ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                                        ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                                        ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                                        ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                                        ->join('m_user_role g', 'a.id = g.id_m_user')
                                        ->join('m_role h', 'g.id_m_role = h.id')
                                        // ->where('b.skpd', $pegawai['id_unitkerja'])
                                        ->where('a.id !=', $this->general_library->getId())
                                        ->where('h.role_name', $kepala_pd)
                                        ->where('g.flag_active', 1)
                                        ->where('a.flag_active', 1)
                                        ->group_by('a.id')
                                        ->limit(1)
                                        ->get()->row_array();
            } else if ($atasan == 'setda'){
                $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat')
                                        ->from('m_user a')
                                        ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                                        ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                                        ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                                        ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                                        ->join('m_user_role g', 'a.id = g.id_m_user')
                                        ->join('m_role h', 'g.id_m_role = h.id')
                                        // ->where('b.skpd', $pegawai['id_unitkerja'])
                                        ->where('a.id !=', $this->general_library->getId())
                                        ->where('h.role_name', $kepala_pd)
                                        ->where('g.flag_active', 1)
                                        ->where('a.flag_active', 1)
                                        ->group_by('a.id')
                                        ->limit(1)
                                        ->get()->row_array();
                $kepala_pd = $atasan_pegawai;
            }
        } else {
            $kepala_pd = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat')
                            ->from('m_user a')
                            ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                            ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                            ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                            ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                            ->join('m_user_role g', 'a.id = g.id_m_user')
                            ->join('m_role h', 'g.id_m_role = h.id')
                            ->where('b.skpd', $pegawai['id_unitkerja'])
                            ->where('a.id !=', $this->general_library->getId())
                            ->where('h.role_name', $kepala_pd)
                            ->where('g.flag_active', 1)
                            ->where('a.flag_active', 1)
                            ->group_by('a.id')
                            ->limit(1)
                            ->get()->row_array();
            if($atasan == 'kepalabadan'){
                $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat, f.id_m_bidang')
                                        ->from('m_user a')
                                        ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                                        ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                                        ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                                        ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                                        ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id', 'left')
                                        ->join('m_user_role g', 'a.id = g.id_m_user')
                                        ->join('m_role h', 'g.id_m_role = h.id')
                                        // ->where('f.id_m_bidang', $pegawai['id_m_bidang'])
                                        ->where('a.id !=', $this->general_library->getId())
                                        ->where('h.role_name', $atasan)
                                        ->where('a.flag_active', 1)
                                        ->where('g.flag_active', 1)
                                        ->group_by('a.id')
                                        ->limit(1)->get()->row_array();
            } else {
                $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat, f.id_m_bidang')
                                        ->from('m_user a')
                                        ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                                        ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                                        ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                                        ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                                        ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id')
                                        ->join('m_user_role g', 'a.id = g.id_m_user')
                                        ->join('m_role h', 'g.id_m_role = h.id')
                                        ->where('f.id_m_bidang', $pegawai['id_m_bidang'])
                                        ->where('a.id !=', $this->general_library->getId())
                                        ->where('h.role_name', $atasan)
                                        ->where('a.flag_active', 1)
                                        ->where('g.flag_active', 1)
                                        ->group_by('a.id')
                                        ->limit(1)
                                        ->get()->row_array();
            }
            if(!$atasan_pegawai){
                $atasan = 'sekretarisbadan';
                $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat, f.id_m_bidang')
                            ->from('m_user a')
                            ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                            ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                            ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                            ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                            ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id')
                            ->join('m_user_role g', 'a.id = g.id_m_user')
                            ->join('m_role h', 'g.id_m_role = h.id')
                            // ->where('f.id_m_bidang', $pegawai['id_m_bidang'])
                            ->where('a.id !=', $this->general_library->getId())
                            ->where('h.role_name', $atasan)
                            ->where('a.flag_active', 1)
                            ->group_by('a.id')
                            ->limit(1)
                            ->get()->row_array();
                if(!$atasan_pegawai){
                    $atasan = 'kepalabadan';
                    $atasan_pegawai = $this->db->select('a.id, b.nipbaru_ws, b.gelar1, b.nama, b.gelar2, c.nm_unitkerja, d.nama_jabatan, e.nm_pangkat, f.id_m_bidang')
                            ->from('m_user a')
                            ->join('db_pegawai.pegawai b', 'a.username = b.nipbaru_ws')
                            ->join('db_pegawai.unitkerja c', 'b.skpd = c.id_unitkerja')
                            ->join('db_pegawai.jabatan d', 'b.jabatan = d.id_jabatanpeg')
                            ->join('db_pegawai.pangkat e', 'b.pangkat = e.id_pangkat')
                            ->join('m_sub_bidang f', 'a.id_m_sub_bidang = f.id', 'left')
                            ->join('m_user_role g', 'a.id = g.id_m_user')
                            ->join('m_role h', 'g.id_m_role = h.id')
                            // ->where('f.id_m_bidang', $pegawai['id_m_bidang'])
                            ->where('a.id !=', $this->general_library->getId())
                            ->where('h.role_name', $atasan)
                            ->where('g.flag_active', 1)
                            ->where('a.flag_active', 1)
                            ->group_by('a.id')
                            ->limit(1)
                            ->get()->row_array();
                }
            }
        }

        $rencana_kinerja = $this->db->select('a.*,
                                (SELECT SUM(b.realisasi_target_kuantitas)
                                FROM t_kegiatan b
                                WHERE b.id_t_rencana_kinerja = a.id
                                AND b.flag_active = 1) as realisasi')
                                ->from('t_rencana_kinerja a')
                                ->where('a.id_m_user', $pegawai['id'])
                                ->where('a.bulan', floatval($data['bulan']))
                                ->where('a.tahun', floatval($data['tahun']))
                                ->where('a.flag_active', 1)
                                ->order_by('a.created_date')
                                ->get()->result_array();
        
        return [$pegawai, $atasan_pegawai, $rencana_kinerja, $kepala_pd];
    }


    public function getListRencanaKinerjaTugas(){
        return $this->db->select('a.tugas_jabatan')
                        ->from('t_rencana_kinerja as a ')
                        ->where('a.id_m_user',$this->general_library->getId())
                        ->where('a.flag_active', 1)
                        ->group_by('a.tugas_jabatan')
                        ->get()->result_array();
    }

    public function getListRencanaKinerjaSasaran(){
        return $this->db->select('a.sasaran_kerja')
                        ->from('t_rencana_kinerja as a ')
                        ->where('a.id_m_user',$this->general_library->getId())
                        ->where('a.flag_active', 1)
                        ->group_by('a.sasaran_kerja')
                        ->get()->result_array();
    }




    
}
?>