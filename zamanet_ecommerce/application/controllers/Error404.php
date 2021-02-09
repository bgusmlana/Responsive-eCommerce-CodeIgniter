<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Error404 extends CI_Controller
{
    public function index()
    {

        $data['title'] = 'Error 404 - Halaman tidak ditemukan';
        $data['breadcrumb'] = 'Error 404 - Halaman tidak ditemukan';

        $session = $this->session->userdata('level');

        if ($session == 1) {
            $this->template->load('admin/template', 'admin/error', $data);
        } else {
            $this->template->load('home/template', 'home/error', $data);
        }
    }
}
