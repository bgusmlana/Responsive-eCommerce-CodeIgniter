<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_app');
		$this->load->model('model_halaman');
		$this->load->model('model_artikel');
	}

	public function detail()
	{
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM tb_web_halaman where judul_seo='$ids' OR id_halaman='$ids'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			redirect('main');
		}
		$data['title'] = $row->judul;
		$data['breadcrumb'] = $row->judul;
		$data['record'] = $this->model_halaman->page_detail($ids)->row_array();
		$data['infoterbaru'] = $this->model_artikel->info_terbaru(6);
		$this->model_halaman->page_dibaca_update($ids);
		$this->template->load('home/template', 'home/halaman/view_page', $data);
	}

	function tracking_resi()
	{
		$data['title'] = 'Cek Resi';
		$data['breadcrumb'] = 'Cek Resi';
		$this->template->load('home/template', 'home/produk/view_resi', $data);
	}

	function tracking_status()
	{
		if (isset($_POST['submit1']) or $this->uri->segment(3) != '') {
			if ($this->uri->segment(3) != '') {
				$kode_transaksi = filter($this->uri->segment(3));
			} else {
				$kode_transaksi = filter($this->input->post('kode'));
			}

			$cek = $this->model_app->view_where('tb_toko_penjualan', array('kode_transaksi' => $kode_transaksi));
			if ($cek->num_rows() >= 1) {
				$data['title'] = 'Rincian Pesanan';
				$data['breadcrumb'] = 'Rincian Pesanan ' . '"' . $kode_transaksi . '"';
				$data['kode_transaksi'] = $kode_transaksi;
				$data['rows'] = $this->db->query("SELECT * FROM tb_toko_penjualan a JOIN tb_pengguna b ON a.id_pembeli=b.id_pengguna JOIN tb_alamat c ON b.id_alamat=c.id_alamat JOIN tb_kota d ON c.id_kota=d.kota_id where a.kode_transaksi='$kode_transaksi'")->row_array();
				$data['record'] = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.satuan, c.berat, c.diskon, c.produk_seo FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $kode_transaksi . "'");
				$data['total'] = $this->db->query("SELECT a.kode_transaksi, a.resi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $kode_transaksi . "'")->row_array();
				$this->template->load('home/template', 'home/produk/view_tracking_view', $data);
			} else {

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <center>
                    No. Invoice tidak ditemukan.
                    </center>
                    </div>');
				redirect('konfirmasi/tracking');
			}
		} else {
			$data['title'] = 'Cek Status';
			$data['breadcrumb'] = 'Cek Status';
			$this->template->load('home/template', 'home/produk/view_tracking', $data);
		}
	}

	function download()
	{

		$kode_transaksi = $this->uri->segment(3);

		$cek = $this->model_app->view_where('tb_toko_penjualan', array('kode_transaksi' => $kode_transaksi));
		if ($cek->num_rows() >= 1) {
			$data['title'] = 'Rincian Pesanan';
			$data['breadcrumb'] = 'Rincian Pesanan ' . '"' . $kode_transaksi . '"';
			$data['kode_transaksi'] = $kode_transaksi;
			$data['rows'] = $this->db->query("SELECT * FROM tb_toko_penjualan a JOIN tb_pengguna b ON a.id_pembeli=b.id_pengguna JOIN tb_alamat c ON b.id_alamat=c.id_alamat JOIN tb_kota d ON c.id_kota=d.kota_id where a.kode_transaksi='$kode_transaksi'")->row_array();
			$data['record'] = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.satuan, c.berat, c.diskon, c.produk_seo FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $kode_transaksi . "'");
			$data['total'] = $this->db->query("SELECT a.kode_transaksi, a.resi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $kode_transaksi . "'")->row_array();
			//$this->template->load('home/template', 'home/produk/view_tracking_view', $data);

			$this->load->library('pdf');

			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "Detail-'$kode_transaksi'.pdf";
			$this->pdf->load_view('home/produk/print_invoice', $data);
		} else {
			redirect('error404');
		}
	}
}
