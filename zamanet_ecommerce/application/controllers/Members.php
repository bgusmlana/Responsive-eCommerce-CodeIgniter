<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Members extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_app');
		$this->load->model('model_members');
	}

	function foto()
	{
		cek_session_members();
		if (isset($_POST['submit'])) {
			$this->model_members->modupdatefoto();
			redirect('members/dashboard');
		} else {
			redirect('members/dashboard');
		}
	}

	function dashboard()
	{
		cek_session_members();
		$id = $this->session->id_pengguna;
		$data['title'] = 'Dashboard';
		$data['breadcrumb'] = 'Dashboard';
		$row = $this->db->get_where('tb_pengguna', "id_pengguna='$id'")->row_array();
		$data['record'] = $row;
		$id_alamat = $row['id_alamat'];
		$data['rows'] = $this->model_app->alamat_konsumen($id_alamat)->row_array();
		$this->template->load('home/template', 'home/profile/view_dashboard', $data);
	}

	function edit_profile()
	{
		cek_session_members();
		if (isset($_POST['submit'])) {
			$this->model_members->profile_update($this->session->id_pengguna);
			redirect('members/edit_profile');
		} else {
			$data['title'] = 'Ubah Profil Saya';
			$data['breadcrumb'] = 'Ubah Profil';
			$data['row'] = $this->model_app->profile_konsumen($this->session->id_pengguna)->row_array();
			$data['kota'] = $this->model_app->view('tb_kota');
			$this->template->load('home/template', 'home/profile/view_profile_edit', $data);
		}
	}

	function edit_alamat()
	{
		cek_session_members();
		$row = $this->db->get_where('tb_pengguna', array('id_pengguna' => $this->session->id_pengguna))->row_array();
		$id_alamat = $row['id_alamat'];
		if (isset($_POST['submit'])) {
			$this->model_members->alamat_update(decrypt_url($this->input->post('id')));
			redirect('members/edit_alamat');
		} else {
			$data['title'] = 'Ubah Alamat Saya';
			$data['breadcrumb'] = 'Ubah Alamat';
			$data['row'] = $this->db->get_where('tb_alamat', array('id_alamat' => $id_alamat))->row_array();
			$data['kota'] = $this->model_app->view('tb_kota');
			$this->template->load('home/template', 'home/profile/view_alamat', $data);
		}
	}

	function password()
	{
		cek_session_members();
		$id = $this->session->id_pengguna;
		$pass = $this->input->post('pass');
		$pass_new = $this->input->post('pass1');

		$this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[6]', [
			'min_length' => 'Password terlalu pendek',
			'required' => 'Password baru wajib diisi'
		]);

		$this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass1]', [
			'matches' => 'Password tidak sama',
			'required' => 'Konfirmasi password baru wajib diisi'
		]);

		$this->form_validation->set_rules('pass', 'Password', 'required|trim', [
			'required' => 'Password saat ini wajib diisi'
		]);

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = 'Ganti Password';
			$data['breadcrumb'] = 'Ganti Password';
			$this->template->load('home/template', 'home/profile/view_password', $data);
		} else {

			$this->db->from('tb_pengguna');
			$this->db->where("(tb_pengguna.id_pengguna = '$id')");
			$user = $this->db->get()->row_array();

			if (password_verify($pass, $user['password'])) {
				$data = array('password' => password_hash($pass_new, PASSWORD_DEFAULT));
				$where = array('id_pengguna' => $id);
				$this->model_app->update('tb_pengguna', $data, $where);
				$this->session->set_flashdata('message', '
				<div class="alert alert-success" role="alert">
            	<center>Password berhasil diganti</center>
				</div>');
				redirect('members/password');
			} else {
				$this->session->set_flashdata('message1', '
				<div class="alert alert-danger" role="alert">
            	<center>Password salah</center>
				</div>');
				redirect('members/password');
			}
		}
	}

	function riwayat_belanja()
	{
		cek_session_members();
		$data['title'] = 'Riwayat Belanja';
		$data['breadcrumb'] = 'Riwayat Belanja';

		$data['record'] = $this->model_app->view_where_ordering('tb_toko_penjualan', array('id_pembeli' => $this->session->id_pengguna), 'id_penjualan', 'DESC');
		$this->template->load('home/template', 'home/profile/view_history', $data);
	}

	function history()
	{
		cek_session_members();
		$data['title'] = 'History Orderan anda';
		$data['record'] = $this->model_app->view_where_ordering('tb_toko_penjualan', array('id_pembeli' => $this->session->id_pengguna), 'id_penjualan', 'DESC');
		$this->template->load('home/template', 'home/produk/view_transaksi_laporan', $data);
	}
}
