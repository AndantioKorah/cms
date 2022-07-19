<?php

class C_Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/profile/M_Profile', 'profile');
    }

    public function index(){
        $data = $this->profile->getProfileParam();
        renderwebcp('webcp/profile/V_Profile', '', '', $data);
    }
}
