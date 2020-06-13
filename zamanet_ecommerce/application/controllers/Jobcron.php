<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jobcron extends CI_Controller 
{
  
    public function delorder()
    {            

          //$date = date("Y-m-d H:i:s");
          //$date = strtotime($date);
          //$min_date = strtotime("-1 day", $date);
          //$this->db->where("waktu_transaksi < '$min_date'", NULL, FALSE);
          //$this->db->where("proses=0");
          //$this->db->delete('tb_toko_penjualan');
          $this->db->query("DELETE FROM tb_toko_penjualan WHERE waktu_transaksi < NOW() - INTERVAL 1 DAY AND proses='0'");
       
    }
}
?>



