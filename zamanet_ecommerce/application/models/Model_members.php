<?php
class Model_members extends CI_model
{
    function rekening()
    {
        return $this->db->query("SELECT * FROM tb_toko_rekening ORDER BY id_rekening ASC");
    }

    function konsumen()
    {
        return $this->db->query("SELECT * FROM tb_pengguna WHERE `level`='3' ORDER BY id_pengguna DESC");
    }

    function profile_view($id)
    {
        return $this->db->query("SELECT * FROM `tb_pengguna` a where a.id_pengguna='$id' and `level`='3'");
    }

    function modupdatefoto()
    {

        $id = $this->session->id_pengguna;
        $row = $this->db->get_where('tb_pengguna', "id_pengguna='$id'")->row_array();
        $foto = $row['foto'];
        $path = "assets/images/user/";

        $config['upload_path'] = 'assets/images/user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|gif|JPEG|jpeg';
        $config['max_size']     = '1000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $hasil = $this->upload->data();

        $datadb = array('foto' => $hasil['file_name']);
        unlink("assets/images/user/$foto");
        $this->db->where('id_pengguna', $this->session->id_pengguna);
        $this->db->update('tb_pengguna', $datadb);
    }

    function profile_update($id)
    {
        if (trim($this->input->post('a')) != '') {
            $datadbd = array(
                'username' => $this->db->escape_str(strip_tags($this->input->post('aa'))),
                'password' => hash("sha512", md5($this->input->post('a'))),
                'nama_lengkap' => $this->db->escape_str(strip_tags($this->input->post('b'))),
                'email' => $this->db->escape_str(strip_tags($this->input->post('c'))),
                'jenis_kelamin' => $this->db->escape_str($this->input->post('d')),
                'tgl_lahir' => $this->db->escape_str($this->input->post('e')),
                'no_telp' => $this->db->escape_str(strip_tags($this->input->post('l')))
            );
        } else {
            $datadbd = array(
                'username' => $this->db->escape_str(strip_tags($this->input->post('aa'))),
                'nama_lengkap' => $this->db->escape_str(strip_tags($this->input->post('b'))),
                'email' => $this->db->escape_str(strip_tags($this->input->post('c'))),
                'jenis_kelamin' => $this->db->escape_str($this->input->post('d')),
                'tgl_lahir' => $this->db->escape_str($this->input->post('e')),
                'no_telp' => $this->db->escape_str(strip_tags($this->input->post('l')))
            );
        }
        $this->db->where('id_pengguna', $id);
        $this->db->update('tb_pengguna', $datadbd);
    }

    function alamat_update($id)
    {

        $data = array(
            'alamat' => $this->input->post('alamat'),
            'id_kota' => $this->input->post('kab'),
            'kecamatan' => $this->input->post('kec'),
            'kode_pos' => $this->input->post('kode_pos'),
        );

        $this->db->where('id_alamat', $id);
        $this->db->update('tb_alamat', $data);
    }
}
