<?php
class Model_testimoni extends CI_model
{
    function testimoni()
    {
        return $this->db->query("SELECT a.*, b.nama_lengkap, b.id_konsumen FROM testimoni a JOIN tb_toko_konsumen b ON a.id_konsumen=b.id_konsumen ORDER BY a.id_testimoni DESC");
    }

    function testimoni_update()
    {
        $datadb = array(
            'isi_testimoni' => $this->input->post('b'),
            'aktif' => $this->input->post('f')
        );
        $this->db->where('id_testimoni', $this->input->post('id'));
        $this->db->update('testimoni', $datadb);
    }

    function testimoni_edit($id)
    {
        return $this->db->query("SELECT a.*, b.nama_lengkap, b.id_konsumen FROM testimoni a JOIN tb_toko_konsumen b ON a.id_konsumen=b.id_konsumen where a.id_testimoni='$id'");
    }

    function testimoni_delete($id)
    {
        return $this->db->query("DELETE FROM testimoni where id_testimoni='$id'");
    }

    function public_testimoni($sampai, $dari)
    {
        return $this->db->query("SELECT a.*, b.nama_lengkap, b.foto, b.id_konsumen, b.jenis_kelamin FROM testimoni a JOIN tb_toko_konsumen b ON a.id_konsumen=b.id_konsumen  where a.aktif='Y' ORDER BY a.id_testimoni DESC LIMIT $dari, $sampai");
    }

    function hitung_testimoni()
    {
        return $this->db->query("SELECT * FROM testimoni where aktif='Y'");
    }

    function insertb_toko_testimoni()
    {
        $datadb = array(
            'id_konsumen' => $this->session->id_konsumen,
            'isi_testimoni' => $this->input->post('testimoni'),
            'aktif' => 'N',
            'waktu_testimoni' => date('Y-m-d H:i:s')
        );
        $this->db->insert('testimoni', $datadb);
    }
}
