<?php

class C_Loader extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loader1(){
        $this->load->view('loader/loader1');
    }
    
    public function loader2(){
        $this->load->view('loader/loader2');
    }

    public function loader3(){
        $this->load->view('loader/loader3');
    }

    public function loader4(){
        $this->load->view('loader/loader4');
    }

    public function loaderLogoSpin(){
        $this->load->view('loader/loaderLogoSpin');
    }
}
