<?php

class C_Gallery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/gallery/M_Gallery', 'gallery');
    }

    public function index(){
        $data['gambar'] = $this->gallery->getGallery(1);
        $data['video'] = $this->gallery->getGallery(2);
        renderwebcp('webcp/gallery/V_Gallery', '', '', $data);
    }
}
