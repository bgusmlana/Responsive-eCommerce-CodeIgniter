<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
		$config['base_url'] = base_url() . 'produk/index';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"> <a class="page-link">';
		$config['cur_tag_close'] = '</a><span class="sr-only">(current)</span></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');


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
			} else {
				$data['title'] = 'Produk' . ' - ' . title();
				$data['breadcrumb'] = 'Produk';
				$data['judul'] = 'Semua Produk';
				$data['record'] = $this->model_app->view_ordering_limit('tb_toko_produk', 'id_produk', 'DESC', $dari, $config['per_page']);
				$this->pagination->initialize($config);
			}
			$data['artikel'] = $this->model_artikel->semua_artikel(0, 15);
			$this->template->load('home/template', 'home/produk/view_produk', $data);
			//$this->load->view('home/template');
		} else {
			redirect('main');
		}
	}

	function kategori()
	{
		$cek = $this->model_app->edit('tb_toko_kategoriproduk', array('kategori_seo' => $this->uri->segment(3)))->row_array();
		$jumlah = $this->model_app->view_where('tb_toko_produk', array('id_kategori_produk' => $cek['id_kategori_produk']))->num_rows();
		$config['base_url'] = base_url() . 'main/kategori/' . $this->uri->segment(3);
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12;
		if ($this->uri->segment('4') == '') {
			$dari = 0;
		} else {
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = "Produk Kategori $cek[nama_kategori]";
			$data['breadcrumb'] = "Produk Kategori $cek[nama_kategori]";
			$data['record'] = $this->model_app->view_where_ordering_limit('tb_toko_produk', array('id_kategori_produk' => $cek['id_kategori_produk']), 'id_produk', 'DESC', $dari, $config['per_page']);
			$this->pagination->initialize($config);
			$this->template->load('home/template', 'home/produk/view_produk', $data);
		} else {
			redirect('main');
		}
	}

	function detail()
	{
		$query = $this->model_app->edit('tb_toko_produk', array('produk_seo' => $this->uri->segment(3)));
		if ($query->num_rows() >= 1) {
			$cek = $query->row_array();
			$data['title'] = "$cek[nama_produk]";
			$data['breadcrumb'] = "$cek[nama_produk]";
			$data['judul'] = "$cek[nama_produk]";
			$data['row'] = $this->model_app->view_where('tb_toko_produk', array('id_produk' => $cek['id_produk']))->row_array();

			$this->template->load('home/template', 'home/produk/view_detail_produk', $data);
		} else {
			redirect('main');
		}
	}

	function keranjang()
	{
		$id_produk   = filter($this->input->post('id_produk'));
		$jumlah   = filter($this->input->post('jumlah'));
		$query = $this->db->get_where('tb_toko_produk', array('id_produk' => $id_produk));
		foreach ($query->result() as $row) {
			$stok = $row->stok;
		}

		if ($id_produk != '') {
			if ($stok < $this->input->post('jumlah') or $stok <= '0') {
				$produk = $this->model_app->edit('tb_toko_produk', array('id_produk' => $id_produk))->row_array();
				$produk_cek = filter($produk['nama_produk']);
				echo "<script>window.alert('Maaf, Stok untuk pemesanan Produk - $produk_cek Tidak Mencukupi!');
                                  window.location=('" . base_url() . "produk/detail/$produk[produk_seo]')</script>";
			} else {
				$this->session->unset_userdata('produk');
				if ($this->session->idp == '') {
					$idp = 'INV-' . date('YmdHis');
					$this->session->set_userdata(array('idp' => $idp));
				}

				$cek = $this->model_app->view_where('tb_toko_penjualantemp', array('session' => $this->session->idp, 'id_produk' => $id_produk))->num_rows();
				if ($cek >= 1) {
					$this->db->query("UPDATE tb_toko_penjualantemp SET jumlah=jumlah+$jumlah where session='" . $this->session->idp . "' AND id_produk='$id_produk'");
				} else {
					$harga = $this->model_app->view_where('tb_toko_produk', array('id_produk' => $id_produk))->row_array();
					$data = array(
						'session' => $this->session->idp,
						'id_produk' => $id_produk,
						'jumlah' => $jumlah,
						'harga_jual' => $harga['harga_konsumen'],
						'satuan' => $harga['satuan'],
						'waktu_order' => date('Y-m-d H:i:s')
					);
					$this->model_app->insert('tb_toko_penjualantemp', $data);
				}
				redirect('produk/keranjang');
			}
		} else {
			$data['record'] = $this->model_app->view_join_rows('tb_toko_penjualantemp', 'tb_toko_produk', 'id_produk', array('session' => $this->session->idp), 'id_penjualan_detail', 'ASC');
			$data['title'] = 'Keranjang Belanja';
			$data['breadcrumb'] = 'Keranjang Belanja';
			$this->template->load('home/template', 'home/produk/view_keranjang', $data);
		}
	}

	function keranjang_update()
	{

		$id_pen = $this->input->post('id_penjualan_detail');
		$jumlah = $this->input->post('jumlah');
		if (!empty($id_produk)) {
			foreach ($id_pen as $index => $val) {
				$data = array(
					'id_penjualan_detail' => $val,
					'jumlah'    => $jumlah[$index]
				);
				$this->db->update('tb_toko_penjualantemp', $data);
			}
		}
		redirect('produk/keranjang');
	}

	function keranjang_update2()
	{

		$id_pen = $this->uri->segment(3);
		$jumlah = $this->input->post('jumlah');

		$data = array(
			'jumlah'    => $jumlah
		);
		$this->db->update('tb_toko_penjualantemp', $data, "id_penjualan_detail='$id_pen'");

		redirect('produk/keranjang');
	}

	function keranjang_delete()
	{
		$id = array('id_penjualan_detail' => $this->uri->segment(3));
		$this->model_app->delete('tb_toko_penjualantemp', $id);
		$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM tb_toko_penjualantemp where session='" . $this->session->idp . "'")->row_array();
		if ($isi_keranjang['jumlah'] == '') {
			$this->session->unset_userdata('idp');
			$this->session->unset_userdata('reseller');
		}
		redirect('produk/keranjang');
	}

	function keranjang2_delete()
	{
		$id = array('id_penjualan_detail' => $this->uri->segment(3));
		$this->model_app->delete('tb_toko_penjualantemp', $id);
		$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM tb_toko_penjualantemp where session='" . $this->session->idp . "'")->row_array();
		if ($isi_keranjang['jumlah'] == '') {
			$this->session->unset_userdata('idp');
			$this->session->unset_userdata('reseller');
		}
		redirect('produk/checkouts');
	}

	function kurirdata()
	{
		$iden = $this->model_app->view_ordering_limit('tb_web_identitas', 'id_identitas', 'DESC', 0, 1)->row_array();
		$this->load->library('rajaongkir');
		$tujuan = $this->input->get('kota');
		$dari = $iden['kota_id'];
		$berat = $this->input->get('berat');
		$kurir = $this->input->get('kurir');
		$dc = $this->rajaongkir->cost($dari, $tujuan, $berat, $kurir);
		$d = json_decode($dc, TRUE);
		$o = '';
		if (!empty($d['rajaongkir']['results'])) {
			$data['data'] = $d['rajaongkir']['results'][0]['costs'];
			$this->load->view('home/produk/kurirdata', $data);
		} else {
			$data['ongkir'] = 0;
			$this->load->view('home/produk/kurirdata', $data);
		}
	}

	function checkouts()
	{
		if (isset($_POST['submit'])) {
			if ($this->session->idp != '') {
				$this->load->library('email');
				$data = array(
					'kode_transaksi' => $this->session->idp,
					'id_pembeli' => $this->session->id_pengguna,
					'diskon' => $this->input->post('diskonnilai'),
					'kurir' => $this->input->post('kurir'),
					'service' => $this->input->post('service'),
					'ongkir' => $this->input->post('ongkir'),
					'waktu_transaksi' => date('Y-m-d H:i:s'),
					'proses' => '0',
					'p_nama' => $this->input->post('nama_pem'),
					'p_telp' => $this->input->post('telp_pem'),
					'p_kota' => $this->input->post('kota_pem'),
					'p_kec' => $this->input->post('kec_pem'),
					'p_alamat' => $this->input->post('alamat_pem'),
					'p_pos' => $this->input->post('pos_pem'),
				);
				$this->model_app->insert('tb_toko_penjualan', $data);
				$idp = $this->db->insert_id();

				$keranjang = $this->model_app->view_where('tb_toko_penjualantemp', array('session' => $this->session->idp));
				foreach ($keranjang->result_array() as $row) {
					$dataa = array(
						'id_penjualan' => $idp,
						'id_produk' => $row['id_produk'],
						'jumlah' => $row['jumlah'],
						'harga_jual' => $row['harga_jual'],
						'satuan' => $row['satuan']
					);
					$this->model_app->insert('tb_toko_penjualandetail', $dataa);

					$q = $this->db->get_where('tb_toko_produk', array('id_produk' => $row['id_produk']));
					foreach ($q->result() as $r) {
						$stoq =  $r->stok;
					}
					$datastok = array(
						'stok'    => $stoq - $row['jumlah']
					);

					$this->db->where('id_produk', "$row[id_produk]");
					$this->db->update('tb_toko_produk', $datastok);
				}
				$this->model_app->delete('tb_toko_penjualantemp', array('session' => $this->session->idp));
				//$kons = $this->model_app->view_join_where_one('tb_toko_konsumen', 'tb_kota', 'kota_id', array('id_pengguna' => $this->session->id_pengguna))->row_array();
				//$kons = $this->model_app->view_join_where_two('tb_pengguna', 'tb_alamat', 'tb_kota', 'id_pengguna', 'id_pengguna', 'id_kota', 'kota_id', array('tb_pengguna.id_pengguna' => $this->session->id_pengguna))->row_array();
				$kons = $this->db->query("SELECT * FROM tb_toko_penjualan a JOIN tb_kota b ON a.p_kota=b.kota_id where a.id_penjualan='$idp'")->row_array();

				$data['title'] = 'Transaksi Berhasil';
				$data['email'] = $kons['email'];
				$data['orders'] = $this->session->idp;
				$data['total_bayar'] = rupiah(+$this->input->post('total') + $this->input->post('ongkir'));

				$iden = $this->model_app->view_where('tb_web_identitas', array('id_identitas' => '1'))->row_array();
				$data['rekening'] = $this->model_app->view('tb_toko_rekening');

				$email_tujuan = $kons['email'];
				$tgl = date("d-m-Y H:i:s");

				$subject      = "Detail Pemesanan anda";
				$message      = "
				<html>
				<body>
				Halooo! <b>$kons[p_nama]</b> ... <br> Hari ini pada tanggal $tgl , Anda telah order produk di $iden[nama_website].<br><br>
					<table border='0' style='width:100%;'>
						<tr>
						   <td style='background:#e3e3e3; pading:20px' cellpadding=6><b>Berikut Data Anda : </b></td>
						</tr>
	
						<tr>
						<td width='140px'>
							<b>Nama Lengkap</b></td>
							<td> : $kons[p_nama]</td></tr>
						<tr>
							<td><b>No. Telepon</b></td>
							<td> : $kons[p_telp]</td>
						</tr>
						<tr>
							<td><b>Alamat</b></td>
							<td> : $kons[p_alamat]</td>
						</tr>
						<tr>
							<td></td>
							<td> &nbsp; $kons[p_kec]</td>
						</tr>
						<tr>
							<td></td>
							<td> &nbsp; $kons[nama_kota], $kons[kode_pos]</td>
						</tr>
					</table><br>

					No. Invoice : <b>" . $this->session->idp . "</b><br>
					Berikut Detail Data Orderan Anda :
					
					<table style='width:100%;' border='0'>
				          <thead>
				            <tr bgcolor='#e3e3e3'>
				              <th style='width:40px'>No</th>
				              <th width='47%'>Nama Produk</th>
				              <th>Harga</th>
				              <th>Jumlah</th>
				              <th>Total</th>
				            </tr>
				          </thead>
				          <tbody>";

				$no = 1;
				$belanjaan = $this->model_app->view_join_where('tb_toko_penjualandetail', 'tb_toko_produk', 'id_produk', array('id_penjualan' => $idp), 'id_penjualan_detail', 'ASC');
				foreach ($belanjaan as $row) {
					$sub_total = (($row['harga_jual'] - $row['diskon']) * $row['jumlah']);
					if ($row['diskon'] != '0') {
						$diskon = "<del style='color:red'>" . rupiah($row['harga_jual']) . "</del>";
					} else {
						$diskon = "";
					}
					if (trim($row['gambar']) == '') {
						$foto_produk = 'no-image.png';
					} else {
						$foto_produk = $row['gambar'];
					}
					$diskon_total = $row['diskon'] * $row['jumlah'];

					$message .= "<tr>
									<td>$no</td>
				                    <td>$row[nama_produk]</td>
				                    <td>" . rupiah($row['harga_jual'] - $row['diskon']) . " $diskon</td>
				                    <td>$row[jumlah]</td>
				                    <td>Rp " . rupiah($sub_total) . "</td>
				                </tr>";
					$no++;
				}

				$message .= "<tr bgcolor='#e3e3e3'>
				                  <td colspan='4'><b>Total Berat</b></td>
				                  <td><b>" . $this->input->post('berat') . " gram</b></td>
				                </tr>

				                <tr bgcolor='#e3e3e3'>
				                  <td colspan='4'><b>Biaya Kirim</b></td>
				                  <td><b>Rp " . $this->input->post('ongkir') . "</b></td>
				                </tr>

				                <tr bgcolor='#e3e3e3'>
				                  <td colspan='4'><b>Total Harga</b></td>
				                  <td><b>Rp " . rupiah($this->input->post('total') + $this->input->post('ongkir')) . "</b></td>
				                </tr>

				        </tbody>
				      </table><br>

				      Silahkan melakukan pembayaran ke rekening :
				      <table style='width:100%;' border='0'>
						<thead>
						  <tr bgcolor='#e3e3e3'>
						    <th width='20px'>No</th>
						    <th>Nama Bank</th>
						    <th>No Rekening</th>
						    <th>Atas Nama</th>
						  </tr>
						</thead>
						<tbody>";
				$noo = 1;
				$rekening = $this->model_app->view('tb_toko_rekening');
				foreach ($rekening->result_array() as $row) {
					$message .= "<tr><td>$noo</td>
						              <td>$row[nama_bank]</td>
						              <td>$row[no_rekening]</td>
						              <td>$row[pemilik_rekening]</td>
						          </tr>";
					$noo++;
				}
				$message .= "</tbody>
					  </table><br><br>

				      Jika sudah melakukan transfer, jangan lupa konfirmasi transferan anda <a href='" . base_url() . "konfirmasi'>disini</a><br>
				      Salam. Admin Zamanet Store</body></html> \n";

				$namawebsite = $iden['nama_website'];
				kirim_email($email_tujuan, $subject, $message);
				$data['breadcrumb'] = 'Transaksi Berhasil';

				$iden = $this->model_app->view_ordering_limit('tb_web_identitas', 'id_identitas', 'DESC', 0, 1)->row_array();
				$emailadmin = $iden['email'];
				$subadmin = 'Pesanan Baru';
				$pesanadmin = 'Hai Admin, ada pesanan baru.. buruan cek sekarang';
				kirim_email($emailadmin, $subadmin, $pesanadmin);

				$this->session->unset_userdata('idp');



				$this->template->load('home/template', 'home/produk/view_transaksi_berhasil', $data);
			} else {
				redirect('produk/keranjang');
			}
		} else {
			$this->session->set_userdata('bypass', true);
			if ($this->session->id_pengguna) {
				$cek = $this->model_app->view_where('tb_toko_penjualantemp', array('session' => $this->session->idp));
				if ($cek->num_rows() >= 1) {
					$data['title'] = 'Checkout';
					$data['breadcrumb'] = 'Checkout';
					$data['rows'] = $this->model_app->view_join_where_two('tb_pengguna', 'tb_alamat', 'tb_kota', 'id_pengguna', 'id_pengguna', 'id_kota', 'kota_id', array('tb_pengguna.id_pengguna' => $this->session->id_pengguna))->row_array();

					$ses = $this->session->idp;
					$this->db->join('tb_toko_produk', 'tb_toko_penjualantemp.id_produk=tb_toko_produk.id_produk');
					$this->db->where("tb_toko_penjualantemp.session='$ses'");
					$this->db->order_by('tb_toko_penjualantemp.id_penjualan_detail', 'ASC');
					$query = $this->db->get('tb_toko_penjualantemp');

					$data['record'] = $query;

					//$data['record'] = $this->model_app->view_join_rows('tb_toko_penjualantemp', 'tb_toko_produk', 'id_produk', array('session' => $this->session->idp), 'id_penjualan_detail', 'ASC');
					$this->template->load('home/template', 'home/produk/view_checkouts', $data);
				} else {
					redirect('produk/keranjang' . $cek);
				}
			} else {
				redirect('login');
			}
		}
	}

	function print_invoice()
	{
		$idp = $this->uri->segment('3');
		$data['rows'] = $this->db->query("SELECT * FROM tb_toko_penjualan a JOIN tb_kota b ON a.p_kota=b.kota_id where a.kode_transaksi='$idp'")->row_array();
		$data['record'] = $this->db->query("SELECT a.kode_transaksi, a.waktu_transaksi, b.*, c.nama_produk, c.satuan, c.berat, c.diskon FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $this->uri->segment(3) . "'");
		//$this->load->view('home/produk/print_invoice', $data);
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "Invoince-" . $idp . ".pdf";
		$this->pdf->load_view('home/produk/print_invoice', $data);
	}

	function review()
	{
		if (isset($_POST['submit'])) {

			$produk = decrypt_url($this->input->post('produk'));
			$pembeli = decrypt_url($this->input->post('pembeli'));
			$ulasan = $this->input->post('ulasan');
			$bintang = $this->input->post('bintang');
			$tgl = date('Y-m-d');
			$seo = $this->input->post('seo');

			$cek = $this->db->query("SELECT * FROM `tb_ulasan` where id_pembeli='$pembeli' AND id_produk='$produk'");
			if ($cek->num_rows() >= 1) {

				$this->db->query("UPDATE tb_ulasan SET bintang='$bintang',ulasan='$ulasan' where id_pembeli='$pembeli' AND id_produk='$produk'");
				redirect("produk/detail/$seo");
			} else {
				$data = array(
					'id_produk' => $produk,
					'id_pembeli' => $pembeli,
					'bintang' => $bintang,
					'tanggal_ulasan' => $tgl,
					'ulasan' => $ulasan,
				);

				$this->db->insert('tb_ulasan', $data);
				redirect("produk/detail/$seo");
			}
		} else {
			redirect('error404');
		}
	}
}
