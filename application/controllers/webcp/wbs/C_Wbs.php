<?php

class C_Wbs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/wbs/M_Wbs', 'wbs');
    }

    public function index(){
        renderwebcp('webcp/wbs/V_Wbs', '', '', null);
    }
}
