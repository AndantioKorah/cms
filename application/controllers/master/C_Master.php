<?php

class C_Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general/M_General', 'general');
        $this->load->model('master/M_Master', 'master');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function masterParameter(){
        render('master/V_MasterParameter', '', '', null);
    }

    public function loadMasterParameter(){
        $data['result'] = $this->master->getAllParameter();
        $this->load->view('master/V_MasterParameterData', $data);
    }

    public function deleteMasterParameter($id){
        $this->master->deleteMasterParameter($id);
    }

    public function insertMasterParameter(){
        echo json_encode($this->master->insertMasterParameter($this->input->post()));
    }

    public function loadDetailParameter($id){
        $data['result'] = $this->master->loadDetailParameter($id);
        $this->load->view('master/V_MasterParameterEdit', $data);
    }

    public function editMasterParameter(){
        echo json_encode($this->master->editMasterParameter($this->input->post()));
    }


    public function masterKategoriPpid(){
     
        render('master/V_MasterKatergoriPpid', '', '', $data);
    }

    function submitMasterKategoriPpid(){
        $data = $this->master->submitMasterKategoriPpid();
       
        echo json_encode($data);
    }

    function loadListMasterKategoriPpid(){
        $data['list_master_kategori_ppid'] = $this->master->loadListMasterKategoriPpid();
        $this->load->view('master/V_ListMasterKategoriPpid', $data);
    }

    public function deleteMasterKategoriPpid($id){
        $this->general->delete('id', $id, 'm_kategori_ppid');
    }


    public function masterJenisPpid(){
        $data['list_master_kategori_ppid'] = $this->master->getMasterKategoriPpid();
        render('master/V_MasterJenisPpid', '', '', $data);
    }

    function submitMasterJenisPpid(){
        $data = $this->master->submitMasterJenisPpid();
       
        echo json_encode($data);
    }

    function loadListMasterJenisPpid(){
        $data['list_master_jenis_ppid'] = $this->master->loadListMasterJenisPpid();
        $this->load->view('master/V_ListMasterJenisPpid', $data);
    }

    public function deleteMasterJenisPpid($id){
        $this->general->delete('id', $id, 'm_jenis_ppid');
    }

    

}
