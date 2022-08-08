<?php

class C_Ppid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/ppid/M_Ppid', 'ppid');
    }

    public function index(){
        renderwebcp('webcp/ppid/V_Ppid', '', '', null);
    }

    public function ppidBerkala(){
        $data['result'] = $this->ppid->getJenisPpid(1);
        renderwebcp('webcp/ppid/V_PpidBerkala', '', '', $data);
    }

    public function getDataPpid($kategori, $jenis){
        $data['result'] = $this->ppid->getDataPpid($kategori, $jenis);
        $this->load->view('webcp/ppid/V_ResultPpid', $data);
    }

    public function ppidSetiapSaat(){
        $data['result'] = $this->ppid->getJenisPpid(2);
        renderwebcp('webcp/ppid/V_PpidSetiapSaat', '', '', $data);
    }

    public function ppidSertaMerta(){
        $data['result'] = $this->ppid->getJenisPpid(3);
        renderwebcp('webcp/ppid/V_PpidSertaMerta', '', '', $data);
    }
}