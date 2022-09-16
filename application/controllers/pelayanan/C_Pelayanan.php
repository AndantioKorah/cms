<?php

class C_Pelayanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_Admin', 'admin');
        $this->load->model('general/M_General', 'general');
        $this->load->model('user/M_User', 'user');
        $this->load->model('master/M_Master', 'master');
        $this->load->model('master/M_Pelayanan', 'pelayanan');
    }
        
}