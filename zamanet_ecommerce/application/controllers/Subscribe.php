<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Subscribe extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_app');
    }

    function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_subs.email]', [
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar',
            'required' => 'Email wajib diisi'
        ]);

        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $row = $this->db->query("SELECT * FROM `tb_subs` where email='$email'")->row_array();
            $cek = $this->db->query("SELECT * FROM `tb_subs` where email='$email'");
            if ($cek->num_rows() >= 1) {
                if ($row['aktif'] == 0) {

                    $data1 = array('aktif' => '1');
                    $where = array('email' => $email);
                    $this->model_app->update('tb_subs', $data1, $where);
                    $this->session->set_flashdata('message', "<div class='alert alert-success' role='alert'>
                    <center><b>Berhasil!</b><br>
                    Kami akan mengirimkan informasi yang terbaru seputar produk dan promo menarik dari Zamanet Store.
                    </center>
                    </div>");
                    redirect('subscribe');
                } else {
                    $this->session->set_flashdata('message', "<div class='alert alert-success' role='alert'>
                    <center><b>Berhasil!</b><br>
                    Kami akan mengirimkan informasi yang terbaru seputar produk dan promo menarik dari Zamanet Store.
                    </center>
                    </div>");
                    redirect('subscribe');
                }
            } else {
                $data = array(
                    'email' => $email,
                    'aktif' => 1,
                );
                $this->db->insert('tb_subs', $data);
                $this->session->set_flashdata('message', "<div class='alert alert-success' role='alert'>
                            <center><b>Berhasil!</b><br>
                            Kami akan mengirimkan informasi yang terbaru seputar produk dan promo menarik dari Zamanet Store.
                            </center>
                            </div>");
                redirect('subscribe');
            }
        } else {
            $data['title'] = "Berlangganan";
            $data['breadcrumb'] = "Berlangganan";
            $this->template->load('home/template', 'home/subs/view_subs', $data);
        }
    }
}
