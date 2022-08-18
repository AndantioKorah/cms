<?php

class C_Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/service/M_Service', 'service');
    }

    public function index(){
        renderwebcp('webcp/service/V_Service', '', '', null);
    }

    public function jenisPelayanan(){
        renderwebcp('webcp/service/V_JenisPelayanan', '', '', null);
    }

    public function jamPelayanan(){
        renderwebcp('webcp/service/V_JamPelayanan', '', '', null);
    }

    public function polaTarif(){
        renderwebcp('webcp/service/V_PolaTarif', '', '', null);
    }
}
