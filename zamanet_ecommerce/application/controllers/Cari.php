<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Cari extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_app');
        $this->load->model('model_artikel');
    }

    function index()
    {
        $jumlah = $this->model_app->view('tb_toko_produk')->num_rows();
        $config['base_url'] = base_url() . 'cari';
        $config['total_rows'] = $jumlah;
        $config['per_page'] = 3;
        if ($this->uri->segment('3') == '') {
            $dari = 0;
        } else {
            $dari = $this->uri->segment('3');
        }

        if (is_numeric($dari)) {

            if ($this->input->post('cari') != '') {
                $data['breadcrumb'] = 'Hasil Pencarian "' . filter($this->input->post('cari')) . '"';
                $data['title'] = title();
                $data['judul'] = "Hasil Pencarian keyword - " . filter($this->input->post('cari'));
                $data['record'] = $this->model_app->cari_produk(filter($this->input->post('cari')));
                $data['artikel'] = $this->model_artikel->semua_artikel(0, 15);
                $this->template->load('home/template', 'home/cari/view_cari', $data);
            } else {
                $data['title'] = title();
                $data['breadcrumb'] = 'Cari';
                $this->template->load('home/template', 'home/cari/view_cari', $data);
            }
        } else {
            redirect('main');
        }
    }
}
