<?php

class Sitemap extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_sitemap');
    }

    public function index()
    {
        $this->load->model('model_sitemap');
        $data['produk'] = $this->model_sitemap->produk();
        $data['artikel'] = $this->model_sitemap->artikel();
        $this->load->view('view_sitemap', $data);
    }
}
