<?php

class C_Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/contact/M_Contact', 'contact');
    }

    public function index(){
        renderwebcp('webcp/contact/V_Contact', '', '', null);
    }
}
