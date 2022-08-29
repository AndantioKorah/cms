<?php

class C_Announcement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/announcement/M_Announcement', 'ann');
    }

    public function index(){
        list($data['result'], $data['total_page']) = $this->ann->getDataAnnouncement();
        renderwebcp('webcp/announcement/V_Announcement', '', '', $data);
    }

    public function getAnnouncementByPage($page, $limit = LIMIT_ANNOUNCEMENT){
        $data['limit'] = $limit;
        list($data['result'], $temp) = $this->ann->getDataAnnouncement($page, $limit);
        $this->load->view('webcp/announcement/V_AnnouncementData', $data);
    }

    public function detailAnnouncement($id){
        $data['result'] = $this->ann->getDetailAnnouncement($id);
        $data['others'] = $this->ann->getOtherAnnouncement($id, 10);
        renderwebcp('webcp/announcement/V_AnnouncementDetail', '', '', $data);
    }
}
