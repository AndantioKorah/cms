<?php

class C_Ttg extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/ttg/M_Ttg', 'ttg');
    }

    public function index(){
        renderwebcp('webcp/ttg/V_Ttg', '', '', null);
    }
}
