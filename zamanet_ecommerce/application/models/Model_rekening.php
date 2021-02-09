<?php
class Model_rekening extends CI_model
{
    function rekening()
    {
        return $this->db->query("SELECT * FROM tb_toko_rekening ORDER BY id_rekening ASC");
    }

    function rekening_tambah()
    {
        $datadb = array(
            'nama_bank' => $this->db->escape_str($this->input->post('a')),
            'no_rekening' => $this->db->escape_str($this->input->post('b')),
            'pemilik_rekening' => $this->db->escape_str($this->input->post('c')),
            'id_pengguna' => $this->session->id_pengguna,
        );
        $this->db->insert('tb_toko_rekening', $datadb);
    }

    function rekening_edit($id)
    {
        return $this->db->query("SELECT * FROM tb_toko_rekening where id_rekening='$id'");
    }

    function rekening_update()
    {
        $datadb = array(
            'nama_bank' => $this->db->escape_str($this->input->post('a')),
            'no_rekening' => $this->db->escape_str($this->input->post('b')),
            'pemilik_rekening' => $this->db->escape_str($this->input->post('c'))
        );
        $this->db->where('id_rekening', $this->input->post('id'));
        $this->db->update('tb_toko_rekening', $datadb);
    }

    function rekening_delete($id)
    {
        return $this->db->query("DELETE FROM tb_toko_rekening where id_rekening='$id'");
    }
}
