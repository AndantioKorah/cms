<?php

class C_Ttg extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/ttg/M_Ttg', 'ttg');
    }


    public function index(){
        list($data['ttg'], $data['total_page_ttg']) = $this->ttg->getDataTtg();
        renderwebcp('webcp/ttg/V_Ttg', '', '', $data);
    }

    public function getDataTtgByPage($page, $limit = LIMIT_TTG){
        $data['limit'] = $limit;
        list($data['ttg'], $temp) = $this->ttg->getDataTtg($page, $limit);
        $this->load->view('webcp/ttg/V_TtgData', $data);
    }

    public function detailttg($id){
        $data['result'] = $this->ttg->getDetailTtg($id);
        $data['other_ttg'] = $this->ttg->getOtherTtg($id, 5);
        renderwebcp('webcp/ttg/V_TtgDetail', '', '', $data);
    }
}
