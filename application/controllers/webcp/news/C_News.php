<?php

class C_News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/news/M_News', 'news');
    }

    public function index(){
        list($data['news'], $data['total_page'], $data['active_page']) = $this->news->getAllNews();
        renderwebcp('webcp/news/V_News', '', '', $data);
    }

    public function getNewsByPage($page){
        $data['news'] = $this->news->getNewsByPage($page);
        $this->load->view('webcp/news/V_NewsData', $data);
    }

    public function detailNews($id){
        $data['result'] = $this->news->getDetailNews($id);
        $data['other_news'] = $this->news->getOtherNews($id);
        renderwebcp('webcp/news/V_NewsDetail', '', '', $data);
    }
}
