<?php
class Model_menu extends CI_model
{
    function menu_topbar()
    {
        return $this->db->query("SELECT * FROM tb_web_menu where id_parent='0' AND position = 'menu topbar' AND aktif='ya' ORDER BY urutan ASC");
    }

    function menu_bawah()
    {
        return $this->db->query("SELECT * FROM tb_web_menu where id_parent='0' AND position = 'menu bawah' AND aktif='ya' ORDER BY urutan ASC");
    }

    function menu_main()
    {
        return $this->db->query("SELECT * FROM tb_web_menu where id_parent='0' AND position = 'menu utama' AND aktif='ya' ORDER BY urutan ASC");
    }

    function dropdown_menu($id)
    {
        return $this->db->query("SELECT * FROM tb_web_menu WHERE id_parent='$id' AND aktif='ya' ORDER BY urutan ASC");
    }

    function menu_website()
    {
        return $this->db->query("SELECT * FROM tb_web_menu order BY position asc, urutan asc");
    }

    function menu_utama()
    {
        return $this->db->query("SELECT * FROM tb_web_menu where id_parent='0' ORDER BY urutan");
    }

    function menu_cek($id)
    {
        return $this->db->query("SELECT * FROM tb_web_menu where id_menu='$id'");
    }

    function menu_website_tambah()
    {
        $datadb = array(
            'id_parent' => $this->db->escape_str($this->input->post('parent')),
            'nama_menu' => $this->db->escape_str($this->input->post('nama')),
            'link' => $this->db->escape_str($this->input->post('url')),
            'aktif' => $this->db->escape_str('ya'),
            'position' => $this->db->escape_str($this->input->post('posisi')),
            'urutan' => $this->db->escape_str($this->input->post('urutan'))
        );
        $this->db->insert('tb_web_menu', $datadb);
    }

    function menu_website_update()
    {
        $datadb = array(
            'id_parent' => $this->db->escape_str($this->input->post('parent')),
            'nama_menu' => $this->db->escape_str($this->input->post('nama')),
            'link' => $this->db->escape_str($this->input->post('url')),
            'aktif' => $this->db->escape_str($this->input->post('aktif')),
            'position' => $this->db->escape_str($this->input->post('posisi')),
            'urutan' => $this->db->escape_str($this->input->post('urutan'))
        );
        $this->db->where('id_menu', $this->input->post('id'));
        $this->db->update('tb_web_menu', $datadb);
    }

    function menu_edit($id)
    {
        return $this->db->query("SELECT * FROM tb_web_menu where id_menu='$id'");
    }

    function menu_delete($id)
    {
        return $this->db->query("DELETE FROM tb_web_menu where id_menu='$id'");
    }
}
