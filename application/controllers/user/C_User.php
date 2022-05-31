<?php

class C_User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general/M_General', 'general');
        $this->load->model('user/M_User', 'user');
        $this->load->model('master/M_Master', 'master');
        if(!$this->general_library->isNotMenu()){
            redirect('logout');
        };
    }

    public function roles(){
        render('user/V_Roles', 'user_management', 'roles', null);
    }

    public function createRole(){
        $this->user->insert('m_role', $this->input->post());
    }

    public function loadRoles(){
        $data['result'] = $this->general->getAllWithOrder('m_role', 'nama', 'asc');
        $this->load->view('user/V_RolesItem', $data);
    }

    public function users(){
        // $data['roles'] = $this->general->getAllWithOrder('m_role', 'nama', 'asc');
        $data['list_skpd'] = $this->user->getAllSkpd();
        $data['pegawai'] = $this->session->userdata('pegawai');
        render('user/V_Users', 'user_management', 'users', $data);
    }

    public function loadPegawaiBySkpd($id_unitkerja){
        $data['list_pegawai'] = $this->user->getListPegawaiByUnitKerja($id_unitkerja);
        $this->load->view('user/V_ListPegawaiBySkpd', $data);
    }

    public function userChangePassword(){
        echo json_encode($this->user->userChangePassword($this->input->post()));
    }

    public function resetPassword($id){
        $this->user->resetPassword($id);
    }

    public function tambahVerifBidang(){
        echo json_encode($this->user->tambahVerifBidang($this->input->post()));
    }

    public function tambahVerifPegawai(){
        echo json_encode($this->user->tambahVerifPegawai($this->input->post()));
    }

    public function getVerifBidang($id){
        $data['result'] = $this->user->getVerifBidang($id);
        $this->load->view('user/V_VerifBidangItem', $data);
    }

    public function getVerifPegawai($id){
        $data['result'] = $this->user->getVerifPegawai($id);
        $this->load->view('user/V_VerifPegawaiItem', $data);
    }

    public function deleteVerifBidang($id){
        $this->general->update('id', $id, 't_verif_tambahan', ['flag_active' => 0]);
    }

    public function deleteVerifPegawai($id){
        $this->general->update('id', $id, 't_verif_tambahan', ['flag_active' => 0]);
    }

    // public function importPegawaiByUnitKerja(){
    //     $this->user->importPegawaiByUnitKerja(IMPORT_UNIT_KERJA);
    // }

    public function importPegawaiByUnitKerja($id_unitkerja){
        // dd($id_unitkerja);
        echo json_encode ($this->user->importPegawaiByUnitKerja($id_unitkerja));
    }

    public function tambahSubBidangUser(){
        $data = $this->input->post();
        $update_user['id_m_sub_bidang'] = $data['id_m_sub_bidang'];
        $update_user['updated_by'] = $this->general_library->getId();
        $this->general->update('id', $data['id_m_user'], 'm_user', $update_user);
        echo json_encode($this->user->getSubBidangUser($data['id_m_user']));
    }

    public function refreshSubBidang($id_m_user){
        $data['rs'] = $this->user->getSubBidangUser($id_m_user);
        $this->load->view('user/V_UserBidangItem', $data);
    }

    public function deleteUserBidang($id_m_user){
        $update_user['id_m_sub_bidang'] = 0;
        $update_user['updated_by'] = $this->general_library->getId();
        $this->general->update('id', $id_m_user, 'm_user', $update_user);
    }

    public function openAddRoleModal($id_m_user){
        $data['user'] = $this->general->getUserForSetting($id_m_user);
        $data['roles'] = $this->general->getAllWithOrder('m_role', 'nama', 'asc');
        // $data['sub_bidang'] = $this->general->getAllWithOrder('m_sub_bidang', 'nama_sub_bidang', 'asc');
        $data['sub_bidang'] = $this->master->loadMasterSubBidangByUnitKerja($data['user']['skpd']);
        $data['pegawai'] = $this->user->getListPegawaiSkpd($data['user']['skpd'], $id_m_user);
        $this->load->view('user/V_AddRoleModal', $data);
    }

    public function loadRoleForUser($id_m_user){
        $data['list_user_role'] = $this->user->getUserRole($id_m_user);
        $data['id_m_user'] = $id_m_user;
        $this->load->view('user/V_RoleItemModal', $data);
    }

    public function deleteRoleForUser($id_m_user){
        $this->general->delete('id', $id_m_user, 'm_user_role');
    }

    public function addRoleForUser(){
        echo json_encode($this->user->addRoleForUser($this->input->post()));
    }

    public function loadUsers($id_unitkerja){
        $data['result'] = $this->user->getAllUsersBySkpd($id_unitkerja);
        $this->load->view('user/V_UsersItem', $data);
    }

    public function createUser(){
        $data = $this->input->post();
        echo json_encode($this->user->createUser($data));
    }

    public function deleteUser($id_m_user){
        $this->user->deleteUser($id_m_user);
    }

    public function userSetting(){
        render('user/V_UserSetting', null, null, null);
    }

    public function changePassword(){
        $message = $this->user->changePassword($this->input->post());
        $this->session->set_flashdata('message', $message['message']);
        redirect('user/setting');
    }

    public function updateProfile(){
        $message = $this->user->updateProfile($this->input->post());
        $this->session->set_flashdata('message', $message['message']);
        redirect('user/setting');
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

    public function deleteProfilePict(){
        $message = $this->user->deleteProfilePict();
        $this->session->set_flashdata('message', $message['message']);
        redirect('user/setting');
    }

    public function menu(){
        $this->general_library->refreshMenu();
        $data['list_menu'] = $this->general->getAllWithOrder('m_menu', 'nama_menu', 'asc');
        render('user/V_Menu', 'user_management', 'menu', $data);
    }

    public function createMenu(){
        echo json_encode($this->user->createMenu($this->input->post()));
        $this->general_library->refreshMenu();
    }

    public function loadMenu(){
        $data['result'] = $this->user->loadAllMenu();
        $this->load->view('user/V_MenuItem', $data);
    }

    public function deleteMenu($id_m_menu){
        $this->general->delete('id', $id_m_menu, 'm_menu');
        $this->general_library->refreshMenu();
    }

    public function addRoleForMenu($id){
        $data['menu'] = $this->general->getOne('m_menu', 'id', $id, 1);
        $data['roles'] = $this->general->getAllWithOrder('m_role', 'nama', 'asc');
        $this->load->view('user/V_AddRoleForMenu', $data);
    }

    public function loadRoleForMenu($id){
        $data['list_menu_role'] = $this->user->getMenuRole($id);
        $data['id_menu'] = $id;
        $this->load->view('user/V_RoleForMenuItem', $data);
    }

    public function getListMenu(){
        dd($this->user->getListMenu());
    }

    public function insertRoleForMenu(){
        echo json_encode($this->user->insertRoleForMenu($this->input->post()));
    }

    public function deleteRoleForMenu($id){
        $this->general->delete('id', $id, 'm_menu_role');
    }

    public function setDefaultRoleForUser($id_role, $id_m_user){
        echo json_encode($this->user->setDefaultRoleForUser($id_role, $id_m_user));
    }

    public function setActiveRole($id_role){
        $this->general_library->setActiveRole($id_role);
        echo (base_url($this->session->userdata('landing_page')));
    }

    public function deleteRole($id){
        echo json_encode($this->user->deleteRole($id));
    }

    public function importPegawaiNewUser(){
        $data['result'] = ($this->user->importPegawaiNewUser());
        $this->load->view('user/V_ResultSearchImport', $data);
    }

    public function createUserImport($nip){
        echo json_encode($this->user->createUserImport($nip));
    }

    public function setGeneralMenu($id){
        $update = ['flag_general_menu' => 1];
        $this->general->update('id', $id, 'm_menu', $update);
    }

    public function cancelGeneralMenu($id){
        $update = ['flag_general_menu' => 0];
        $this->general->update('id', $id, 'm_menu', $update);
    }
}
