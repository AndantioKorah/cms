<?php
	class M_Admin extends CI_Model
	{
        var $column_order = array(null,'nama', 'isi_galeri', 'tanggal');

        var $column_search = array('nama', 'isi_galeri', 'tanggal');

        
        // default order 
        var $order = array('id' => 'asc');

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

        public function submitKontenBerita($new_name){

            $datapost = $this->input->post();
            $tags = explode(',',$this->input->post('tag_berita'));
            // dd($tag);
            foreach ($tags as $tg){
                $tag[] = $tg;

            }
            // dd($datapost);
            $data["judul_ina"] = $datapost["berita_judul_ina"];
            $data["tag_berita"] = json_encode($tag);
            $data["tanggal_berita"] = $datapost["tanggal_berita"];
            $data["isi_berita"] = $datapost["isi_berita"];
            $data["gambar"] = $new_name;
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_berita', $data);
            return $this->db->insert_id();
        }

        function loadListBerita(){
            $query = $this->db->select('*')
                            ->from('t_berita a')
                            ->where('a.flag_active', 1)
                            ->order_by('a.id', 'desc')
                            ->get()->result_array();
            return $query; 
        }


        public function updateKontenBerita(){
            $datapost = $this->input->post(); 

            $tags = explode(',',$datapost["detail_tag_berita"]);
            // dd($tag);
            foreach ($tags as $tg){
                $tag[] = $tg;

            }
                   
            $data["judul_ina"] = $datapost["detail_judul_ina"];
            $data["tag_berita"] = json_encode($tag);
            $data["tanggal_berita"] = $datapost["detail_tanggal_berita"];
            $data["isi_berita"] = $datapost["detail_isi_berita"];
            // $data["gambar"] = $_FILES["berita_gambar"]["name"];

            $id =  $datapost["id"];

            $this->db->where('id', $id)
                ->update('t_berita', $data);
        }


        function loadProfil(){
            $query = $this->db->select('*')
                            ->from('t_profil a')
                            ->where('a.flag_active', 1)
                            ->order_by('a.id', 'desc')
                            ->get()->result_array();
            return $query; 
        }

        public function submitKontenProfil($new_name){

            $exist = $this->db->select('*')
                                ->from('t_profil')
                                ->where('flag_active', 1)
                                ->get()->row_array();
            if($exist) {
                $datapost = $this->input->post();
                $data["visi"] = $datapost["profil_visi"];
                $data["misi"] = $datapost["profil_misi"];
                $data["motto"] = $datapost["profil_motto"];
                $data["tupoksi"] = $datapost["profil_tupoksi"];
                $data["struktur_organisasi"] = $new_name;
                $this->db->where('id', 3)
                ->update('t_profil', $data);
                return 0;
            } else {
                $datapost = $this->input->post();
                $data["visi"] = $datapost["profil_visi"];
                $data["misi"] = $datapost["profil_misi"];
                $data["motto"] = $datapost["profil_motto"];
                $data["tupoksi"] = $datapost["profil_tupoksi"];
                $data["struktur_organisasi"] = $new_name;
                $this->db->insert('t_profil', $data);
                return $this->db->insert_id();
            }

           
        }


        public function getBeritaDetail($id){
            return $this->db->select('*')
                            ->from('t_berita a')
                            ->where('a.id', $id)
                            ->where('a.flag_active', 1)
                            ->limit(1)
                            ->get()->row_array();
        }



        public function submitKontenGaleri($new_name){

           
                $datapost = $this->input->post();
                $data["nama"] = $datapost["judul_gambar"];
                $data["isi_galeri"] = $new_name;
                $data["tanggal"] =  $datapost["tanggal_gambar"];
                $data["jenis"] = 1;
                $data['created_by'] = $this->general_library->getId();
                $this->general_library->getId();
                $this->db->insert('t_galeri', $data);
                return $this->db->insert_id(); 
        }

        public function submitKontenGaleriVideo(){

           
            $datapost = $this->input->post();
            $data["nama"] = $datapost["judul_video"];
            $data["isi_galeri"] =  $datapost["link_video"];
            $data["tanggal"] =  $datapost["tanggal_video"];
            $data["jenis"] = 2;
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_galeri', $data);
            return $this->db->insert_id(); 
    }


        function loadListGaleri(){
            $query = $this->db->select('*')
                            ->from('t_galeri a')
                            ->where('a.jenis', 1)
                            ->where('a.flag_active', 1)
                            ->order_by('a.id', 'desc')
                            ->get()->result_array();
            return $query; 
        }

        function get_datatables()
        {
            $this->_get_datatables_query();
            if ($this->input->post('length') != -1)
                $this->db->limit($this->input->post('length'), $this->input->post('start'));
            $query = $this->db->get();
            return $query->result();
        }

        private function _get_datatables_query()
        {
           

            $this->db->from('t_galeri');
            $this->db->where('t_galeri.flag_active', 1);
            $this->db->order_by('t_galeri.id', 'desc');
            $i = 0;
            foreach ($this->column_search as $item) // loop kolom 
            {
                if (isset($this->input->post('search')['value'])) // jika datatable mengirim POST untuk search
                {
                    if ($i === 0) // looping pertama
                    {
                        $this->db->group_start();
                        $this->db->like($item, $this->input->post('search')['value']);
                    } else {
                        $this->db->or_like($item, $this->input->post('search')['value']);
                    }
                    if (count($this->column_search) - 1 == $i) //looping terakhir
                        $this->db->group_end();
                }
                $i++;
            }
    
            // jika datatable mengirim POST untuk order
            if ($this->input->post('order')) {
                $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
            } else if (isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
    
        public function count_all()
        {
            $this->db->from('t_galeri');
            $this->db->where('t_galeri.flag_active', 1);
            return $this->db->count_all_results();
        }

        function loadListGaleriVideo(){
            $query = $this->db->select('*')
                            ->from('t_galeri a')
                            ->where('a.jenis', 2)
                            ->where('a.flag_active', 1)
                            ->order_by('a.id', 'desc')
                            ->get()->result_array();
            return $query; 
        }


        public function submitKontenPpid($new_name){

           
            $datapost = $this->input->post();
            $data["judul"] = $datapost["judul_ppid"];
            $data["keterangan"] = $datapost["ketarangan_ppid"];
            $data["file"] = $new_name;
            $data["tanggal"] =  $datapost["tanggal_ppid"];
            $data["kategori"] =  $datapost["kategori_ppid"];
            $data["jenis"] =  $datapost["jenis_ppid"];
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_ppid', $data);
            return $this->db->insert_id(); 
    }

    function loadListPpid(){
        $query = $this->db->select('*')
                        ->from('t_ppid a')
                        ->join('m_kategori_ppid b', 'a.kategori = b.id')
                        ->join('m_jenis_ppid c', 'a.jenis = c.id')
                        ->where('a.flag_active', 1)
                        ->order_by('a.id', 'desc')
                        ->get()->result_array();
        return $query; 
    }


    public function submitKontenPelayanan($new_name){

           
        $datapost = $this->input->post();
        $data["judul"] = $datapost["judul_pelayanan"];
        $data["keterangan"] = $datapost["ketarangan_pelayanan"];
        $data["tanggal"] =  $datapost["tanggal_pelayanan"];
        $data["file"] = $new_name;
        $data['created_by'] = $this->general_library->getId();
        $this->db->insert('t_pelayanan', $data);
        return $this->db->insert_id(); 
        }

        function loadListPelayanan(){
            $query = $this->db->select('*')
                            ->from('t_pelayanan a')
                            ->where('a.flag_active', 1)
                            ->order_by('a.id', 'desc')
                            ->get()->result_array();
            return $query; 
        }


        public function submitKontenPengumuman($new_name){

           
            $datapost = $this->input->post();
            $data["judul"] = $datapost["judul_pengumuman"];
            $data["keterangan"] = $datapost["ketarangan_pengumuman"];
            $data["tanggal"] =  $datapost["tanggal_pengumuman"];
            $data["file"] = $new_name;
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_pengumuman', $data);
            return $this->db->insert_id(); 
            }

            function loadListPengumuman(){
                $query = $this->db->select('*')
                                ->from('t_pengumuman a')
                                ->where('a.flag_active', 1)
                                ->order_by('a.id', 'desc')
                                ->get()->result_array();
                return $query; 
            }

            public function getMasterKategoriPpid(){

                return $this->db->select('*')
                                ->from('m_kategori_ppid as a')
                                ->where('a.flag_active', 1)
                                ->get()->result_array();
            }

            public function getMasterJenisPpid($id){

                return $this->db->select('*')
                                ->from('m_jenis_ppid as a')
                                ->where('a.id_kategori_ppid', $id)
                                ->where('a.flag_active', 1)
                                ->get()->result_array();
            }

            public function submitKontenCovid19Regulasi($new_name){
                $datapost = $this->input->post();
                $data["judul"] = $datapost["judul_covid19"];
                $data["tanggal"] =  $datapost["tanggal_covid19"];
                $data["file"] = $new_name;
                $data['created_by'] = $this->general_library->getId();
                $this->db->insert('t_covid_regulasi', $data);
                return $this->db->insert_id(); 
        }

        public function submitKontenCovid19Infografis($new_name){
            $datapost = $this->input->post();
            $data["judul"] = $datapost["judul_infografis"];
            $data["tanggal"] =  $datapost["tanggal_infografis"];
            $data["file"] = $new_name;
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_covid_infografis', $data);
            return $this->db->insert_id(); 
    }

    public function submitKontenCovid19Video(){

           
        $datapost = $this->input->post();
        $data["judul"] = $datapost["judul_video"];
        $data["link"] =  $datapost["link_video"];
        $data["tanggal"] =  $datapost["tanggal_video"];
        $data['created_by'] = $this->general_library->getId();
        $this->db->insert('t_covid_video', $data);
        return $this->db->insert_id(); 
}

        function loadListCovid19Regulasi(){
            $query = $this->db->select('*')
                            ->from('t_covid_regulasi a')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
            return $query; 
        }

        function loadListCovid19Infografis(){
            $query = $this->db->select('*')
                            ->from('t_covid_infografis a')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
            return $query; 
        }

        function loadListCovid19Video(){
            $query = $this->db->select('*')
                            ->from('t_covid_video a')
                            ->where('a.flag_active', 1)
                            ->order_by('a.id', 'desc')
                            ->get()->result_array();
            return $query; 
        }




        
        public function getGaleriById($id){
            return $this->db->select('*')
                            ->from('t_galeri a')
                            ->where('a.id', $id)
                            ->where('a.flag_active', 1)
                            ->limit(1)
                            ->get()->row_array();
        }


        function loadListPojokTtg(){
            $query = $this->db->select('*')
                            ->from('t_pojokttg a')
                            ->where('a.flag_active', 1)
                            ->order_by('a.id', 'desc')
                            ->get()->result_array();
            return $query; 
        }

        public function updateKontenPojokTtg(){
            $datapost = $this->input->post(); 

        
            $data["judul"] = $datapost["detail_judul"];
            $data["tanggal"] = $datapost["detail_tanggal"];
            $data["isi_informasi"] = $datapost["detail_isi_informasi"];
            // $data["gambar"] = $_FILES["berita_gambar"]["name"];

            $id =  $datapost["id"];

            $this->db->where('id', $id)
                ->update('t_pojokttg', $data);
        }


        public function submitKontenPojokTtg($new_name){

            $datapost = $this->input->post();
     
            // dd($datapost);
            $data["judul"] = $datapost["pojokttg_judul"];
            $data["tanggal"] = $datapost["tanggal_pojokttg"];
            $data["isi_pojok_ttg"] = $datapost["isi_pojokttg"];
            $data["gambar"] = $new_name;
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_pojokttg', $data);
            return $this->db->insert_id();
        }

        public function getPojokTtgDetail($id){
            return $this->db->select('*')
                            ->from('t_pojokttg a')
                            ->where('a.id', $id)
                            ->where('a.flag_active', 1)
                            ->limit(1)
                            ->get()->row_array();
        }
        

        function loadListLogo(){
            $query = $this->db->select('*')
                            ->from('t_aplikasi_publik a')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
            return $query; 
        }



        public function updateLogo(){
            $datapost = $this->input->post(); 

        
            $data["nama_aplikasi"] = $datapost["detail_logo_nama"];
            $data["logo"] = $datapost["detail_logo"];
            $data['updated_by'] = $this->general_library->getId();
          
            $id =  $datapost["id"];
            $this->db->where('id', $id)
                ->update('t_aplikasi_publik', $data);
        }


        public function submitLogo($full_path){

            $datapost = $this->input->post();
            $data["nama_aplikasi"] = $datapost["nama_aplikasi"];
            $data["logo"] = $full_path;
            $data["url"] = $datapost["url_aplikasi"];
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_aplikasi_publik', $data);
            return $this->db->insert_id();
        }


        
        public function getLogoDetail($id){
            return $this->db->select('*')
                            ->from('t_aplikasi_publik a')
                            ->where('a.id', $id)
                            ->where('a.flag_active', 1)
                            ->limit(1)
                            ->get()->row_array();
        }


        
        public function submitKontenDownload($new_name){

            $datapost = $this->input->post();
     
            // dd($datapost);
            $data["judul"] = $datapost["download_judul"];
            $data["tanggal"] = $datapost["download_tanggal"];
            $data["keterangan"] = $datapost["download_keterangan"];
            $data["jenis"] = $datapost["download_jenis"];
            $data["file"] = $new_name;
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_download', $data);
            return $this->db->insert_id();
        }

        function loadListDownload(){
            $query = $this->db->select('a.*,b.jenis_download')
                            ->from('t_download a')
                            ->join('m_jenis_download b', 'a.jenis = b.id')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
            return $query; 
        }

        public function getMasterJenisDownload(){

            return $this->db->select('*')
                            ->from('m_jenis_download as a')
                            ->where('a.flag_active', 1)
                            ->get()->result_array();
        }
    



        function loadListAgenda(){
            $query = $this->db->select('*')
                            ->from('t_agenda a')
                            ->where('a.flag_active', 1)
                            ->order_by('a.id', 'desc')
                            ->get()->result_array();
            return $query; 
        }


        public function submitKontenAgenda($new_name){

            $datapost = $this->input->post();
     
            // dd($datapost);
            $data["judul"] = $datapost["agenda_judul"];
            $data["tanggal"] = $datapost["agenda_tanggal"];
            $data["isi_agenda"] = $datapost["isi_agenda"];
            $data["gambar"] = $new_name;
            $data['created_by'] = $this->general_library->getId();
            $this->db->insert('t_agenda', $data);
            return $this->db->insert_id();
        }


        public function getAgendaDetail($id){
            return $this->db->select('*')
                            ->from('t_agenda a')
                            ->where('a.id', $id)
                            ->where('a.flag_active', 1)
                            ->limit(1)
                            ->get()->row_array();
        }

        public function updateKontenAgenda(){
            $datapost = $this->input->post(); 

        
            $data["judul"] = $datapost["detail_judul_agenda"];
            $data["tanggal"] = $datapost["detail_tanggal_agenda"];
            $data["isi_agenda"] = $datapost["detail_isi_agenda"];
            // $data["gambar"] = $_FILES["berita_gambar"]["name"];

            $id =  $datapost["id"];

            $this->db->where('id', $id)
                ->update('t_agenda', $data);
        }



    

    


	}
?>