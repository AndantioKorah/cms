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

    public function getNewsByPage($page, $limit = LIMIT_NEWS, $flag_refresh_paging = 0){
        $data['flag_refresh_paging'] = $flag_refresh_paging;
        $data['limit'] = $limit;
        $data['news'] = $this->news->getNewsByPage($page, $limit);
        $this->load->view('webcp/news/V_NewsData', $data);
    }

    public function detailNews($id){
        $data['result'] = $this->news->getDetailNews($id);
        $data['other_news'] = $this->news->getOtherNews($id);
        renderwebcp('webcp/news/V_NewsDetail', '', '', $data);
    }

    public function searchNews(){
        $data['news'] = $this->news->searchNews($this->input->post());
        $data['total_data'] = count($data['news']);
        $data['flag_refresh_paging'] = 0;
        $data['limit'] = '';
        $this->load->view('webcp/news/V_NewsData', $data);
    }

    public function refreshPaging($limit){
        list($data['news'], $data['total_page'], $data['active_page']) = $this->news->getAllNews(1, $limit);
        $data['page_content'] = 'news';
        $this->load->view('webcp/news/V_NewsPaging', $data);
    }
}
