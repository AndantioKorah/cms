<?php

require 'vendor/autoload.php';
// use PhpOffice\PhpSpreadSheet\Spreadsheet;
// use PhpOffice\PhpSpreadSheet\IOFactory;

class C_Rekap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general/M_General', 'general');
        $this->load->model('kinerja/M_Kinerja', 'kinerja');
        $this->load->model('user/M_User', 'user');
        $this->load->model('rekap/M_Rekap', 'rekap');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function rekapAbsensi(){
        render('rekap/V_RekapAbsensi', '', '', null);
    }

    public function readAbsensiExcel(){
        $rs['code'] = 0;
        $rs['message'] = 0;
        $file_excel = array();
        $temp_data = null;
        $data = array();

        if($_FILES["file_excel"]["name"] != ''){
            $allowed_extension = ['xls', 'csv', 'xlsx'];
            $file_array = explode(".", $_FILES["file_excel"]["name"]);
            $file_extension = end($file_array);

            if(in_array($file_extension, $allowed_extension)){
                $config['upload_path'] = 'assets/upload_rekap_absen'; 
                $config['allowed_types'] = '*';
                $config['max_size'] = '5000'; // max_size in kb
                $config['file_name'] = $_FILES['file_excel']['name'];

                $this->load->library('upload', $config); 

                $uploadfile = $this->upload->do_upload('file_excel');

                if($uploadfile){
                    $upload_data = $this->upload->data(); 
                    $file_excel['name'] = $upload_data['file_name'];

                    $filename = $_FILES["file_excel"]["name"];
                    libxml_use_internal_errors(true);
                    // $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($_FILES["file_excel"]["name"]);
                    $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($config['upload_path'].'/'.$file_excel['name']);
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

                    $spreadsheet = $reader->load($_FILES["file_excel"]["tmp_name"]);
                    // $data = $spreadsheet->getActiveSheet()->toArray();

                    $data['skpd'] = $spreadsheet->getActiveSheet()->getCell(SKPD_CELL)->getValue();
                    $data['periode'] = $spreadsheet->getActiveSheet()->getCell(PERIODE_CELL)->getValue();
                    $data['nama_file'] = "Rekap Absensi ".$data['skpd']." ".$data['periode'].".xls";
                    $data['header'] = $spreadsheet->getActiveSheet()->rangeToArray(HEADER_CELL);
                    $start_cell = $spreadsheet->getActiveSheet()->getCell(START_CELL)->getValue();
                    $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
                    $highestColumn = $spreadsheet->getActiveSheet()->getHighestColumn();
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                    
                    for($row = START_ROW_NUM; $row <= $highestRow; $row++){
                        for($col = 2; $col <= $highestColumnIndex; $col++){
                            $value = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($col, $row)->getValue();
                            if($value){
                                if($col == 2){
                                    $temp_data[$row]['nama_pegawai'] = $value;    
                                } else{
                                    $temp_data[$row]['absen']['hari'][] = $data['header'][0][$col-1];
                                    $temp_data[$row]['absen']['jam'][] = $value;
                                }
                            } else {
                                break;
                            }
                        }    
                    }
                    $data['result'] = $temp_data;
                }

                // foreach($data as $d){
                //     $insert_data = [
                //         ':first_name' => $d[0],
                //         ':last_name' => $d[1],
                //     ];
                // }

            } else {
                $rs['code'] = 1;
                $rs['message'] = "File yang dipilih bukan file Excel atau CSV !";    
            }
        } else {
            $rs['code'] = 1;
            $rs['message'] = "Tidak ada file yang dipilih";
        }

        $this->load->view('rekap/V_RekapAbsensiResult', $data);
    }

    public function rekapPenilaian(){
        $data['list_skpd'] = $this->user->getAllSkpd();
        render('rekap/V_RekapPenilaian', '', '', $data);
    }

    public function rekapPenilaianSearch($flag_print = 0){
        $data['parameter'] = $this->input->post();
        $data['flag_print'] = $flag_print;
        if($flag_print == 1){
            $data['result'] = $this->session->userdata('data_penilaian_produktivitas_kerja');
            $data['parameter'] = $this->session->userdata('parameter_data_penilaian_produktivitas_kerja');
        } else {
            $data['result'] = $this->rekap->rekapPenilaianSearch($this->input->post());
            $this->session->set_userdata('data_penilaian_produktivitas_kerja', $data['result']);
            $this->session->set_userdata('parameter_data_penilaian_produktivitas_kerja', $data['parameter']);
        }
        $this->load->view('rekap/V_RekapPenilaianResult', $data);
    }

    public function rekapDisiplin(){
        $data['list_skpd'] = $this->user->getAllSkpd();
        render('rekap/V_RekapDisiplin', '', '', $data);
    }

    public function rekapDisiplinSearch($flag_print = 0){
        $data['parameter'] = $this->input->post();
        $data['flag_print'] = $flag_print;
        if($flag_print == 1){
            $data['result'] = $this->session->userdata('data_penilaian_disiplin_kerja');
            $data['parameter'] = $this->session->userdata('parameter_data_disiplin_kerja');
        } else {
            $data['result'] = $this->rekap->rekapDisiplinSearch($this->input->post());
            $this->session->set_userdata('data_penilaian_disiplin_kerja', $data['result']);
            $this->session->set_userdata('parameter_data_disiplin_kerja', $data['parameter']);
        }
        $this->load->view('rekap/V_RekapDisiplinResult', $data);
    }

    public function saveExcelDisiplin(){
        $data['result'] = $this->session->userdata('data_penilaian_disiplin_kerja');
        $data['parameter'] = $this->session->userdata('parameter_data_disiplin_kerja');
        $this->load->view('rekap/V_RekapDisiplinExcel', $data);
    }

}
