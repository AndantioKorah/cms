<?php

class C_Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/M_Main', 'main');
        $this->load->model('webcp/news/M_News', 'news');
    }

    public function index(){
        if(!$this->session->userdata('site_lang')){
            $this->session->set_userdata('site_lang',  DEFAULT_LANG);
        }
        $data['news'] = $this->news->getOtherNews(0, 3);
        $data['popular_news'] = $this->news->getPopularNews();
        $data['aplikasi_publik'] = $this->main->getDataAplikasiPublik();
        $data['main_images'] = $this->main->getDataMainImages();
        $data['side_banner'] = $this->main->loadSideBanner();
        renderwebcp('webcp/main/V_Main', '', '', $data);
    }

    public function loadSideBanner(){
        $data['result'] = $this->main->loadSideBanner();
        $this->load->view('webcp/main/V_SideBannerItem', $data);
    }

    public function getDataStatistic(){
        echo json_encode($this->main->getDataStatistic());
    }

    public function switchLanguage($lang = DEFAULT_LANG){
        $this->session->set_userdata('site_lang', $lang);
        redirect('');
    }
}
