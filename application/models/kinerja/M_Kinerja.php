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
    //   dd($image);
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
        (select sum(b.realisasi_target_kuantitas) from t_kegiatan as b where a.id = b.id_t_rencana_kinerja) as realisasi_target_kuantitas
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
      

        }

        public function loadKegiatan($tahun,$bulan){
            $id =  $this->general_library->getId();
            return $this->db->select('a.*, b.tugas_jabatan,c.status_verif')
                ->from('t_kegiatan a')
                ->join('t_rencana_kinerja b', 'a.id_t_rencana_kinerja = b.id')
                ->join('m_status_verif c', 'a.id_status_verif = c.id')
                ->where('a.id_m_user', $id)
                ->where('year(a.tanggal_kegiatan)', $tahun)
                ->where('month(a.tanggal_kegiatan)', $bulan)
                ->where('a.flag_active', 1)
                ->get()->result_array();
           
        }


        public function loadRencanaKinerja(){
            $id =  $this->general_library->getId();
            return $this->db->select('*')
                            ->from('t_rencana_kinerja a')
                            ->where('a.id_m_user', $id)
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }


        public function getRencanaKinerja(){
            $id =  $this->general_library->getId();
            return $this->db->select('*')
                            ->from('t_rencana_kinerja as a')
                            ->where('a.id_m_user', $id)
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

    public function loadRekapKinerja(){

        
        $id =  $this->general_library->getId();
        if($this->input->post()) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
        } else {
            $bulan = date('n');
            $tahun = date('Y');
        }
       
       
        $query = $this->db->select('a.*,
        (select sum(b.realisasi_target_kuantitas) from t_kegiatan as b where a.id = b.id_t_rencana_kinerja and b.flag_active = 1) as realisasi_target_kuantitas
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
        $query = $this->db->get_where('t_rencana_kinerja', array('flag_active' => 1, 'bulan' => $bulan, 'tahun' => $tahun));
        return $query;
    }

      

	}
?>