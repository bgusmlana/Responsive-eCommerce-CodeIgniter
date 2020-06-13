<?php
class Model_berita extends CI_model
{

    function list_berita()
    {
        return $this->db->query("SELECT * FROM tb_berita ORDER BY id_berita DESC");
    }

    function list_berita_tambah()
    {

        $data = array(
            'judul_berita'   => $this->input->post('judul'),
            'isi_berita'  => $this->input->post('berita'),
            'tgl'     => date('Y-m-d H:i:s')
        );
        $this->db->insert('tb_berita', $data);
    }


    function list_berita_edit($id)
    {
        return $this->db->query("SELECT * FROM tb_berita where id_berita='$id'");
    }

    function list_berita_update()
    {
        $data = array(
            'judul' => $this->input->post('judul'),
            'berita' => $this->input->post('berita')
        );
        $this->db->where('id_berita', $this->input->post('id'));
        $this->db->update('tb_berita', $data);
    }

    function list_berita_delete($id)
    {
        return $this->db->query("DELETE FROM tb_berita where id_berita='$id'");
    }
}
