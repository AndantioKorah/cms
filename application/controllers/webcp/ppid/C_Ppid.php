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
}