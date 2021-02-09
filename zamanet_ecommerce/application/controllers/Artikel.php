<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Artikel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_artikel');
	}
	public function index()
	{
		$data['title'] = 'Artikel' . ' - ' . title();
		$data['breadcrumb'] = 'Artikel';
		$data['artikel'] = $this->model_artikel->semua_artikel(0, 15);
		$this->template->load('home/template', 'home/artikel/view_semua_artikel', $data);
	}

	public function detail()
	{
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM tb_blog_artikel where judul_seo='$ids' OR id_artikel='$ids'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			redirect('main');
		}
		$data['title'] = $row->judul;
		$data['breadcrumb'] = $row->judul;
		$data['record'] = $this->model_artikel->artikel_detail($ids)->row_array();
		$data['infoterbaru'] = $this->model_artikel->info_terbaru(6);
		$this->model_artikel->artikel_dibaca_update($ids);
		$this->template->load('home/template', 'home/artikel/view_artikel', $data);
	}

	public function kategori()
	{
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM tb_blog_kategori where kategori_seo='$ids' OR id_kategori='$ids'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			redirect('main');
		}
		$data['title'] = $row->nama_kategori . " - " . title();
		$data['breadcrumb'] = $row->nama_kategori;
		$data['kategori'] = $this->model_artikel->detail_kategori($row->id_kategori, 9);
		$this->template->load('home/template', 'home/artikel/view_kategori', $data);
	}
}
