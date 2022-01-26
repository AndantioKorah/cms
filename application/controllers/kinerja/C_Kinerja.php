<?php

class C_Kinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kinerja/M_Kinerja', 'kinerja');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function Kinerja(){
        $data['list_laporan_kinerja'] = "";
        render('kinerja/V_LaporanKinerja', '', '', $data);
    }
    

    public function createLaporanKegiatan(){
        $data = $this->input->post();
        $data['id_user_inputer'] = $this->general_library->getId();
        $this->kinerja->insert('t_kegiatan', $data);
    }

    public function updateProfilePict(){
        $photo = $_FILES['profilePict']['name'];
        $upload = $this->general_library->uploadImage('profile_picture','profilePict');
        if($upload['code'] != 0){
            $this->session->set_flashdata('message', $upload['message']);
        } else {
            $message = $this->user->updateProfilePicture($upload);
            $this->session->set_flashdata('message', $message['message']);
        }
        redirect('user/setting');
    }

   
    
}
