<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_sitemap extends CI_Model
{

    function produk()
    {
        return $this->db->order_by('waktu_input', 'desc')->get('tb_toko_produk')->result_array();
    }

    function artikel()
    {
        return $this->db->order_by('waktu_input', 'desc')->get('tb_blog_artikel')->result_array();
    }
}
