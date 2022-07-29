<?php

class C_Gallery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/gallery/M_Gallery', 'gallery');
    }

    public function index(){
        list($data['gambar'], $data['total_page_gambar']) = $this->gallery->getImageGallery();
        list($data['video'], $data['total_page_video']) = $this->gallery->getVideoGallery();
        renderwebcp('webcp/gallery/V_Gallery', '', '', $data);
    }

    public function indexGambar(){
        list($data['gambar'], $data['total_page_gambar']) = $this->gallery->getImageGallery();
        renderwebcp('webcp/gallery/V_GalleryImage', '', '', $data);
    }

    public function getGambarByPage($page, $limit = LIMIT_GALLERY){
        $data['limit'] = $limit;
        list($data['gambar'], $temp) = $this->gallery->getImageGallery($page, $limit);
        $this->load->view('webcp/gallery/V_GalleryImageData', $data);
    }

    public function indexVideo(){
        list($data['video'], $data['total_page_video']) = $this->gallery->getVideoGallery();
        // dd($data);
        renderwebcp('webcp/gallery/V_GalleryVideo', '', '', $data);
    }

    public function getVideoByPage($page, $limit = LIMIT_GALLERY){
        $data['limit'] = $limit;
        list($data['video'], $temp) = $this->gallery->getVideoGallery($page, $limit);
        $this->load->view('webcp/gallery/V_GalleryVideoData', $data);
    }
}
