<?php

class C_Download extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/download/M_Download', 'download');
    }

    public function index(){
        $data['jenis_download'] = $this->download->getJenisDownload();
        renderwebcp('webcp/download/V_Download', '', '', $data);
    }

    public function loadDownloadData($id){
        $data['result'] = $this->download->loadDownloadData($id);
        $this->load->view('webcp/download/V_DownloadData', $data);
    }
}
