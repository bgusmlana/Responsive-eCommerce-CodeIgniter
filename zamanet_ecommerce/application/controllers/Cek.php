<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cek extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_app');
	}

	public function index()
	{
		$code = $_GET['q'];

		$query = $this->model_app->view_where('tb_pengguna', "kode_aktivasi='$code'");
		$row = $query->row();

		if (!empty($row)) {

			if ($row->aktif == 0) {

				if ($row->kode_aktivasi == $code) {
					$data = array(
						'aktif' => 1,
					);
					$this->model_app->update('tb_pengguna', $data, "kode_aktivasi='$code'");
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
														<center>Selamat, akun Anda berhasil diaktivasi.<br>
															Silahkan masuk menggunakan akun Anda.
																</center>
																	  </div>');
					redirect('login');
				} else {
					redirect(base_url());
				}
			} else {
				redirect('Error404');
			}
		} else {
			redirect('Error404');
		}
	}
}
