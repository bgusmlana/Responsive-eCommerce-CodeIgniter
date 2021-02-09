<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Konfirmasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_app');
	}

	function index()
	{
		if (isset($_GET['q'])) {

			$kode_transaksi = $_GET['q'];
			$cek = $this->model_app->view_where('tb_toko_penjualan', array('kode_transaksi' => $kode_transaksi));
			$row = $this->db->query("SELECT id_penjualan FROM `tb_toko_penjualan` where kode_transaksi='$kode_transaksi'")->row_array();
			$data['record'] = $this->model_app->view('tb_toko_rekening');

			$data['total'] = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $kode_transaksi . "'")->row_array();
			$data['rows'] = $this->model_app->view_where('tb_toko_penjualan', array('id_penjualan' => $row['id_penjualan']))->row_array();
			$data['ksm'] = $this->model_app->view_where('tb_pengguna', array('id_pengguna' => $this->session->id_pengguna))->row_array();

			$data['title'] = 'Konfirmasi Pembayaran';
			$data['breadcrumb'] = 'Konfirmasi Pembayaran';
			$this->template->load('home/template', 'home/produk/view_konfirmasi_pembayaran', $data);
		} else {
			if (isset($_POST['submit1'])) {
				$kode_transaksi = filter($this->input->post('a'));
				$cek = $this->model_app->view_where('tb_toko_penjualan', array('kode_transaksi' => $kode_transaksi));
				if ($cek->num_rows() >= 1) {

					$row = $this->db->query("SELECT id_penjualan FROM `tb_toko_penjualan` where kode_transaksi='$kode_transaksi'")->row_array();
					$data['record'] = $this->model_app->view('tb_toko_rekening');

					$data['total'] = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $kode_transaksi . "'")->row_array();
					$data['rows'] = $this->model_app->view_where('tb_toko_penjualan', array('id_penjualan' => $row['id_penjualan']))->row_array();
					$data['ksm'] = $this->model_app->view_where('tb_pengguna', array('id_pengguna' => $this->session->id_pengguna))->row_array();

					$data['title'] = 'Konfirmasi Pembayaran';
					$data['breadcrumb'] = 'Konfirmasi Pembayaran';
					$this->template->load('home/template', 'home/produk/view_konfirmasi_pembayaran', $data);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						<center>
						No. Invoice tidak ditemukan.
						</center>
						</div>');
					redirect('konfirmasi');
				}
			} else {
				$data['title'] = 'Konfirmasi Pembayaran';
				$data['breadcrumb'] = 'Konfirmasi Pembayaran';
				$this->template->load('home/template', 'home/produk/view_konfirmasi', $data);
			}
		}
	}

	function form()
	{

		$kode = $this->input->post('a');
		$config['upload_path'] = 'assets/images/bukti/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size'] = '2000'; // kb
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$this->session->set_flashdata('message', $this->upload->display_errors());
			redirect('konfirmasi?q=' . $kode);
		} else {
			$hasil = $this->upload->data();
			$data = array(
				'id_penjualan' => $this->input->post('id'),
				'total_transfer' => $this->input->post('b'),
				'id_rekening' => $this->input->post('c'),
				'nama_pengirim' => $this->input->post('d'),
				'tanggal_transfer' => $this->input->post('e'),
				'bukti_transfer' => $hasil['file_name'],
				'waktu_konfirmasi' => date('Y-m-d H:i:s')
			);

			$this->db->insert('tb_toko_konfirmasi', $data);
			$data1 = array('proses' => '1');
			$where = array('id_penjualan' => $this->input->post('id'));
			$this->model_app->update('tb_toko_penjualan', $data1, $where);

			$iden = $this->model_app->view_ordering_limit('tb_web_identitas', 'id_identitas', 'DESC', 0, 1)->row_array();
			$email_tujuan = $iden['email'];
			$subject = 'Konfirmasi';
			$message = 'Hai Admin, ada konfirmasi pembayaran.. buruan cek sekarang';
			kirim_email($email_tujuan, $subject, $message);

			echo $this->session->set_flashdata('message', '<div class="alert alert-info text-center">Terikasih telah melakukan konfirmasi pembayaran.<br>
			Segera kami cek dan kami proses.</Terikasih></div>');
			redirect('konfirmasi');
		}
	}

	function tracking()
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
			$data['title'] = 'Lacak Pesanan';
			$data['breadcrumb'] = 'Lacak Pesanan';
			$this->template->load('home/template', 'home/produk/view_tracking', $data);
		}
	}
}
