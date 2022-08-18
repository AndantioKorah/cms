<?php

class C_Covid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/covid/M_Covid', 'covid');
    }

    public function index(){
        renderwebcp('webcp/covid/V_Covid', '', '', null);
    }

    public function regulasi(){
        list($data['result'], $data['total_page']) = $this->covid->getDataCovidRegulasi();
        renderwebcp('webcp/covid/V_CovidRegulasi', '', '', $data);
    }

    public function getDataCovidRegulasi($page, $limit = LIMIT_COVID_REGULASI){
        $data['limit'] = $limit;
        list($data['result'], $temp) = $this->covid->getDataCovidRegulasi($page, $limit);
        $this->load->view('webcp/covid/V_CovidRegulasiData', $data);
    }

    public function infografis(){
        list($data['gambar'], $data['total_page']) = $this->covid->getDataCovidInfografis();
        renderwebcp('webcp/covid/V_CovidInfografis', '', '', $data);
    }

    public function getDataCovidInfografis($page, $limit = LIMIT_COVID_INFOGRAFIS){
        $data['limit'] = $limit;
        list($data['result'], $temp) = $this->covid->getDataCovidInfografis($page, $limit);
        $this->load->view('webcp/covid/V_CovidInfografisData', $data);
    }

    public function video(){
        list($data['video'], $data['total_page']) = $this->covid->getDataCovidVideo();
        renderwebcp('webcp/covid/V_CovidVideo', '', '', $data);
    }

    public function getDataCovidVideo($page, $limit = LIMIT_COVID_VIDEO){
        $data['limit'] = $limit;
        list($data['result'], $temp) = $this->covid->getDataCovidVideo($page, $limit);
        $this->load->view('webcp/covid/V_CovidVideoData', $data);
    }
}
