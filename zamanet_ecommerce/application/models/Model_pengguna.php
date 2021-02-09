<?php
class Model_pengguna extends CI_model
{
    function pengguna()
    {
        return $this->db->query("SELECT * FROM tb_pengguna");
    }

    function pengguna_tambah()
    {
        $config['upload_path'] = 'assets/images/user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '1000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('f');
        $hasil = $this->upload->data();
        if ($hasil['file_name'] == '') {
            $datadb = array(
                'username' => $this->db->escape_str($this->input->post('a')),
                'password' => hash("sha512", md5($this->input->post('b'))),
                'nama_lengkap' => $this->db->escape_str($this->input->post('c')),
                'email' => $this->db->escape_str($this->input->post('d')),
                'no_telp' => $this->db->escape_str($this->input->post('e')),
                'foto' => $hasil['file_name'],
                'level' => $this->db->escape_str($this->input->post('g')),
            );
        } else {
            $datadb = array(
                'username' => $this->db->escape_str($this->input->post('a')),
                'password' => hash("sha512", md5($this->input->post('b'))),
                'nama_lengkap' => $this->db->escape_str($this->input->post('c')),
                'email' => $this->db->escape_str($this->input->post('d')),
                'no_telp' => $this->db->escape_str($this->input->post('e')),
                'foto' => $hasil['file_name'],
                'level' => $this->db->escape_str($this->input->post('g')),
            );
        }
        $this->db->insert('pengguna', $datadb);
    }

    function pengguna_edit($id)
    {
        return $this->db->query("SELECT * FROM tb_pengguna where username='$id'");
    }

    function pengguna_update()
    {
        $config['upload_path'] = 'assets/images/user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '1000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('f');
        $hasil = $this->upload->data();
        if ($hasil['file_name'] == '' and $this->input->post('b') == '') {
            $datadb = array(
                'username' => $this->db->escape_str($this->input->post('a')),
                'nama_lengkap' => $this->db->escape_str($this->input->post('c')),
                'email' => $this->db->escape_str($this->input->post('d')),
                'no_telp' => $this->db->escape_str($this->input->post('e')),
                'level' => $this->db->escape_str($this->input->post('g')),
            );
        } elseif ($hasil['file_name'] != '' and $this->input->post('b') == '') {
            $datadb = array(
                'username' => $this->db->escape_str($this->input->post('a')),
                'nama_lengkap' => $this->db->escape_str($this->input->post('c')),
                'email' => $this->db->escape_str($this->input->post('d')),
                'no_telp' => $this->db->escape_str($this->input->post('e')),
                'foto' => $hasil['file_name'],
                'level' => $this->db->escape_str($this->input->post('g')),
            );
        } elseif ($hasil['file_name'] == '' and $this->input->post('b') != '') {
            $datadb = array(
                'username' => $this->db->escape_str($this->input->post('a')),
                'password' => hash("sha512", md5($this->input->post('b'))),
                'nama_lengkap' => $this->db->escape_str($this->input->post('c')),
                'email' => $this->db->escape_str($this->input->post('d')),
                'no_telp' => $this->db->escape_str($this->input->post('e')),
                'level' => $this->db->escape_str($this->input->post('g')),
            );
        } elseif ($hasil['file_name'] != '' and $this->input->post('b') != '') {
            $datadb = array(
                'username' => $this->db->escape_str($this->input->post('a')),
                'password' => hash("sha512", md5($this->input->post('b'))),
                'nama_lengkap' => $this->db->escape_str($this->input->post('c')),
                'email' => $this->db->escape_str($this->input->post('d')),
                'no_telp' => $this->db->escape_str($this->input->post('e')),
                'foto' => $hasil['file_name'],
                'level' => $this->db->escape_str($this->input->post('g')),
            );
        }

        $this->db->where('username', $this->input->post('id'));
        $this->db->update('tb_pengguna', $datadb);
    }

    function pengguna_delete($id)
    {
        return $this->db->query("DELETE FROM tb_pengguna where username='$id'");
    }
}
