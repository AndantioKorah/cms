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
     
        render('master/V_MasterKatergoriPpid', '', '', null);
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


    //
    public function masterDownload(){
     
        render('master/V_MasterDownload', '', '', null);
    }

    function submitMasterDownload(){
        $data = $this->master->submitMasterDownload();
       
        echo json_encode($data);
    }

    function loadListMasterDownload(){
        $data['list_master_download'] = $this->master->loadListMasterDownload();
        $this->load->view('master/V_ListMasterDownload', $data);
    }

    public function deleteMasterDownload($id){
        $this->general->delete('id', $id, 'm_jenis_download');
    }
    
    public function masterJenisPelayanan(){
        render('master/V_MasterJenisPelayanan', '', '', null);
    }

    public function loadMasterJenisPelayanan(){
        $data['result'] = $this->master->loadMasterJenisPelayanan();
        $this->load->view('master/V_ListMasterJenisPelayanan', $data);
    }

    public function insertMasterJenisPelayanan(){
        $data = $this->input->post();
        $data['created_by'] = $this->general_library->getId();
        $this->master->insert('m_jenis_pelayanan', $data);
        echo json_encode(['code' => 0, 'message' => '']);
    }

    public function deleteMasterJenisPelayanan($id){
        echo json_encode($this->master->deleteMasterJenisPelayanan($id));
    }

    public function masterParameterJenisPelayanan(){
        render('master/V_MasterParameterJenisPelayanan', '', '', null);
    }

    public function getJenisParameterByKategori($id){
        echo json_encode($this->master->getJenisParameterByKategori($id));
    }

    public function loadMasterParameterJenisPelayanan(){
        $data['result'] = $this->master->loadMasterParameterJenisPelayanan();
        $this->load->view('master/V_ListMasterParameterJenisPelayanan', $data);
    }

    public function insertMasterParameterJenisPelayanan(){
        $data = $this->input->post();
        $data['created_by'] = $this->general_library->getId();
        // $this->master->insert('m_parameter_jenis_pelayanan', $data);
        echo json_encode($this->master->insertMasterParameterJenisPelayanan($data));
    }

    public function deleteMasterParameterJenisPelayanan($id){
        echo json_encode($this->master->deleteMasterParameterJenisPelayanan($id));
    }

    public function loadParameterJenisPelayanan($id){
        $data['jenis_pelayanan'] = $this->master->loadParameterJenisPelayanan($id);
        $data['kategori_parameter'] = $this->general->getAll('m_kategori_parameter');
        $data['parameter_jenis_pelayanan'] = $this->general->getAll('m_parameter_jenis_pelayanan');
        $this->load->view('master/V_OpenParameterJenisPelayanan', $data);
    }

    public function getListParameterJenisPelayanan($id){
        $data['result'] = $this->master->getListParameterJenisPelayanan($id);
        $this->load->view('master/V_ListParameterJenisPelayanan', $data);
    }

    public function addParameterJenisPelayanan($id){
        echo json_encode($this->master->addParameterJenisPelayanan($id));
    }

    public function deleteParameterJenisPelayanan($id){
        echo json_encode($this->master->deleteParameterJenisPelayanan($id));
    }

}
