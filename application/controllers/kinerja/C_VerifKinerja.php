<?php

class C_VerifKinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general/M_General', 'general');
        $this->load->model('kinerja/M_VerifKinerja', 'verifkinerja');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function verifKinerja(){
        render('kinerja/V_VerifKinerja', '', '', null);
    }

    public function searchVerifKinerja(){
        $data['result'] = $this->verifkinerja->searchVerifKinerja($this->input->post());
        $this->load->view('kinerja/V_VerifKinerjaSearchItem', $data);
    }
    
}
