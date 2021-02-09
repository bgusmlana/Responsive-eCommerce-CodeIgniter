<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_app');
	}

	public function lupa_password()
	{

		$this->form_validation->set_rules('email', 'Email', 'required|trim', [
			'required' => 'Email wajib diisi'

		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login' . " - " . title();
			$data['breadcrumb'] = 'Login';
			$data['judul'] = 'Login' . " - " . title();
			$this->template->load('home/template', 'home/auth/view_lupass', $data);
		} else {

			$email = strip_tags($this->input->post('email'));
			$cek = $this->db->query("SELECT * FROM tb_pengguna where email='" . $this->db->escape_str($email) . "'");
			$row = $cek->row_array();
			$total = $cek->num_rows();

			if ($total > 0) {


				$kode = $row['kode_resetpassword'];

				$subject      = 'Permintaan Reset Password';

				$message = "
						<p>Akun Anda:</p>
						<p>Email: " . $email . "</p><br>
						<p>Silakan klik tautan di bawah ini untuk mereset password Anda.</p>
						<a href='" . base_url() . "auth/p?q=" . $kode . "'>Reset Password</a>
					";

				kirim_email($email, $subject, $message);
				$this->session->set_flashdata('message', '
				<div class="alert alert-success" role="alert">
            	<center>Berhasil, Silahkan cek email Anda</center>
          		</div>');
				redirect(base_url('login'));
			} else {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger" role="alert">
            	<center>Email tidak terdaftar</center>
          		</div>');
				redirect(base_url('login'));
			}
		}
	}

	public function login()
	{
		// cek session
		$ses_id = $this->session->id_pengguna;
		$ses_lv = $this->session->level;

		if (empty($ses_id)) {
			$this->form_validation->set_rules('user_email', 'Email / Username', 'required|trim', [
				'required' => 'Email / Username wajib diisi'
			]);

			$this->form_validation->set_rules('password', 'Password', 'required|trim', [
				'required' => 'Password wajib diisi'
			]);
			if ($this->form_validation->run() == false) {
				$data['title'] = 'Login' . " - " . title();
				$data['breadcrumb'] = 'Login';
				$this->template->load('home/template', 'home/auth/view_login', $data);
			} else {
				$this->_login();
			}
		} else {
			if ($ses_lv == 1) {
				redirect('admin');
			} else {
				redirect('members/dashboard');
			}
		}
	}

	private function _login()
	{
		$user_email 	= $this->input->post('user_email');
		$password   	= $this->input->post('password');

		$this->db->from('tb_pengguna');
		$this->db->where("(tb_pengguna.email = '$user_email' OR tb_pengguna.username = '$user_email')");
		$user = $this->db->get()->row_array();

		// jika usernya ada
		if ($user) {
			// juka usernya aktif
			if ($user['aktif'] == 1) {
				// cek password
				if (password_verify($password, $user['password'])) {
					$data = array(
						'id_pengguna'   => $user['id_pengguna'],
						'username'   	=> $user['username'],
						'email'     	=> $user['email'],
						'password'   	=> $user['password'],
						'level' 		=> $user['level'],
					);
					$this->session->set_userdata($data);
					if ($user['level'] == 1) {
						redirect('admin');
					} else {
						if ($this->session->bypass == true) {
							redirect('keranjang/checkouts');
						} else {
							redirect('members/dashboard');
						}
					}
				}
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <center>
                    Email / Password salah.
                    </center>
                    </div>');
				redirect('login');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <center>
                Email Anda belum diverifikasi, silahkan cek email Anda.
                </center>
                </div>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <center>
            Email / Password salah.
            </center>
            </div>');
			redirect('login');
		}
	}

	public function register()
	{
		$ses = $this->session->username;

		if (!empty($ses)) {
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_pengguna.email]', [
				'valid_email' => 'Email tidak valid',
				'is_unique' => 'Email sudah terdaftar',
				'required' => 'Email wajib diisi'

			]);
			$this->form_validation->set_rules('telp', 'Telp', 'required|trim|is_numeric|min_length[10]|max_length[13]', [
				'required' => 'No. Telp wajib diisi',
				'is_numeric' => 'No. Telp tidak valid',
				'min_length' => 'No. Telp tidak valid',
				'max_length' => 'No. Telp tidak valid',

			]);
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[5]|max_length[50]', [
				'required' => 'Nama wajib diisi',
				'min_length' => 'Nama terlalu pendek',
				'max_length' => 'Nama terlalu panjang',

			]);
			$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_pengguna.username]', [
				'is_unique' => 'Username sudah terdaftar',
				'required' => 'Username wajib diisi'
			]);
			$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]', [
				'min_length' => 'Password terlalu pendek',
				'required' => 'Password wajib diisi'
			]);
			$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
				'matches' => 'Password tidak sama',
				'required' => 'Konfirmasi password wajib diisi'
			]);
			$this->form_validation->set_rules('kota', 'Kota', 'required|trim', [
				'required' => 'Kota wajib diisi'
			]);

			if ($this->form_validation->run() == FALSE) {

				$data['title'] = 'Daftar' . " - " . title();
				$data['breadcrumb'] = 'Daftar';
				$this->template->load('home/template', 'home/auth/view_register', $data);
			} else {
				$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code = substr(str_shuffle($set), 0, 6);
				$code2 = substr(str_shuffle($set), 0, 6);

				$alamat = array(
					'id_kota' 	=> $this->input->post('kota')
				);
				$this->model_app->insert('tb_alamat', $alamat);
				$data = [
					'id_alamat'             => $this->db->insert_id(),
					'email'         		=> htmlspecialchars($this->input->post('email', true)),
					'username'         		=> htmlspecialchars($this->input->post('username', true)),
					'nama_lengkap'        	=> htmlspecialchars($this->input->post('nama', true)),
					'no_telp'         		=> htmlspecialchars($this->input->post('telp', true)),
					'password'      		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'aktif'					=> 0,
					'level'					=> 2,
					'kode_aktivasi' 		=> $code,
					'kode_resetpassword' 	=> $code2,
					'tgl_daftar' 			=> date('Y-m-d H:i:s'),
				];
				$email = $this->input->post('email');
				$subject      = "Aktivasi Akun";
				$message = "
						<h2>Terimakasih sudah mendaftar.</h2>
						<p>Akun Anda:</p>
						<p>Email: " . $email . "</p><br>
						<p>Silakan klik tautan di bawah ini untuk mengaktifkan akun Anda.</p>
						<a href='" . base_url() . "c?q=" . $code . "'>Aktivasi Akun</a>
					";

				kirim_email($email, $subject, $message);
				$this->model_app->insert('tb_pengguna', $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <center>Berhasil mendaftar!<br>
            Silahkan cek email anda untuk aktivasi pendaftaran.
            </center>
          </div>');
				redirect(base_url('login'));
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function ganti_password()
	{
		$code = $_GET['q'];

		$query = $this->model_app->view_where('tb_pengguna', "kode_resetpassword='$code'");
		$row = $query->row();

		if (!empty($row)) {

			if ($row->aktif == 1) {

				if ($row->kode_resetpassword == $code) {

					$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]', [
						'min_length' => 'Password terlalu pendek',
						'required' => 'Password wajib diisi'
					]);

					$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
						'matches' => 'Password tidak sama',
						'required' => 'Konfirmasi password wajib diisi'
					]);

					if ($this->form_validation->run() == FALSE) {

						$data['title'] = 'Ganti Password';
						$data['breadcrumb'] = 'Ganti Password';
						$data['email'] = $row->email;
						$data['code'] = $row->kode_resetpassword;
						$this->template->load('home/template', 'home/auth/view_gantipass', $data);
					} else {


						$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$kodereset = substr(str_shuffle($set), 0, 6);

						$email = $row->email;

						$datapass = [
							'password'      		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
							'kode_resetpassword' 	=> $kodereset,

						];

						$this->db->where('email', $email);
						$this->db->update('tb_pengguna', $datapass);
						$this->session->set_flashdata('message', '
						<div class="alert alert-success" role="alert">
            			<center>Ganti password berhasil.</center>
						</div>');
						redirect('login');
					}
				} else {
					redirect(base_url());
				}
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url('error404'));
		}
	}
}
