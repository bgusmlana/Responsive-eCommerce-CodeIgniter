<?php
class Model_laporan extends CI_model
{

    function laporan()
    {
        return $this->db->query("SELECT * FROM `tb_toko_penjualan` a WHERE proses='3' ORDER BY waktu_transaksi ASC");
    }

    function laporan1()
    {
        $hari = date('Y-m-d');
        $this->db->where("proses='3'");
        $this->db->where("waktu_transaksi='$hari'");
        $this->db->order_by('waktu_transaksi', 'asc');
        return $this->db->get('tb_toko_penjualan');
    }


    function laporan7()
    {
        $hari = date('Y-m-d');
        $this->db->where("proses='3'");
        $this->db->where("waktu_transaksi > DATE_SUB( '$hari' , INTERVAL 7 DAY )");
        $this->db->order_by('waktu_transaksi', 'asc');
        return $this->db->get('tb_toko_penjualan');
    }

    function laporan30()
    {
        $hari = date('Y-m-d');
        $this->db->where("proses='3'");
        $this->db->where("waktu_transaksi > DATE_SUB( '$hari' , INTERVAL 30 DAY )");
        $this->db->order_by('waktu_transaksi', 'asc');
        return $this->db->get('tb_toko_penjualan');
    }

    function laporan360()
    {
        $hari = date('Y-m-d');
        $this->db->where("proses='3'");
        $this->db->where("waktu_transaksi > DATE_SUB( '$hari' , INTERVAL 1 YEAR )");
        $this->db->order_by('waktu_transaksi', 'asc');
        return $this->db->get('tb_toko_penjualan');
    }
}
