<?php

class C_Covid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/covid/M_Covid', 'covid');
    }

    public function index(){
        renderwebcp('webcp/covid/V_Covid', '', '', null);
    }
}
