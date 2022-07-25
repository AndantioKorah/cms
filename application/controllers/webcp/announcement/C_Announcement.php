<?php

class C_Announcement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/announcement/M_Announcement', 'announce');
    }

    public function index(){
        renderwebcp('webcp/announcement/V_Announcement', '', '', null);
    }
}
