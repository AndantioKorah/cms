<?php

class C_Agenda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/agenda/M_Agenda', 'agenda');
    }

    public function index(){
        list($data['agenda'], $data['total_page_agenda']) = $this->agenda->getDataAgenda();
        renderwebcp('webcp/agenda/V_Agenda', '', '', $data);
    }

    public function getDataAgendaByPage($page, $limit = LIMIT_AGENDA){
        $data['limit'] = $limit;
        list($data['agenda'], $temp) = $this->agenda->getDataAgenda($page, $limit);
        $this->load->view('webcp/agenda/V_AgendaData', $data);
    }

    public function detailAgenda($id){
        $data['result'] = $this->agenda->getDetailAgenda($id);
        $data['other_agenda'] = $this->agenda->getOtherAgenda($id, 5);
        renderwebcp('webcp/agenda/V_AgendaDetail', '', '', $data);
    }
}
