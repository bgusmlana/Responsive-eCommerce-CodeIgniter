<?php $kota = $this->db->query("SELECT nama_kota FROM tb_kota WHERE kota_id=$iden[kota_id]")->row_array(); ?>
<!DOCTYPE html>
<html>

<head>
  <title>Rekap Pesanan</title>
  <style>
    @media print {

      @page {
        size: A4 landscape;
      }

      /* use width if in portrait (use the smaller size to try 
   and prevent image from overflowing page... */
      img {
        height: 90%;
        margin: 0;
        padding: 0;
      }
    }
  </style>
</head>

<body onload="window.print()">

  <hr>
  <p style="text-align: center">
    <span style="font-weight: bold; font-size:18pt">
      <?= $iden['nama_website']; ?>
    </span> <br>
    <?= $iden['alamat'] ?> ,
    <?= $kota['nama_kota'] ?>
  </p>

  <table class="table table-responsive" style="width: 100%; text-align:left">
    <thead>
      <tr style="border-style: solid;">
        <th style="width:5%">No</th>
        <th style="width:15%">Kode Transaksi</th>
        <th style="width:10%">Total Belanja</th>
        <th style="width:20%">Pengiriman</th>
        <th style="width:15%">Tujuan</th>
        <th style="width:25%">Waktu Transaksi</th>
        <th style="width:10%">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($record->result_array() as $row) {
        if ($row['proses'] == '0') {
          $proses = '<i class="text-danger">Pending</i>';
          $color = 'danger';
          $text = 'Pending';
        } elseif ($row['proses'] == '1') {
          $proses = '<i class="text-warning">Proses</i>';
          $color = 'warning';
          $text = 'Proses';
        } elseif ($row['proses'] == '2') {
          $proses = '<i class="text-info">Konfirmasi</i>';
          $color = 'info';
          $text = 'Konfirmasi';
        } else {
          $proses = '<i class="text-success">Dikirim </i>';
          $color = 'success';
          $text = 'Dikirim';
        }
        $total = $this->db->query("SELECT a.kode_transaksi, a.p_kota, a.kurir, a.service, a.proses, a.ongkir,  sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk JOIN tb_pengguna d ON a.id_pembeli=d.id_pengguna where a.kode_transaksi='$row[kode_transaksi]'")->row_array();
        $id_kota = $total['p_kota'];
        $tujuan = $this->db->query("SELECT * FROM `tb_kota` JOIN tb_provinsi ON tb_kota.provinsi_id=tb_provinsi.provinsi_id WHERE tb_kota.kota_id=$id_kota")->row_array();

        echo "<tr><td>$no</td>
                <td>$row[kode_transaksi]</td>
                <td style='color:red;'>Rp " . rupiah($total['total'] + $total['ongkir'] + $total['kode_unik']) . "</td>
                <td><span style='text-transform:uppercase'>$total[kurir]</span> ($total[service])</td>
                <td><a target='_BLANK' title='$tujuan[nama_provinsi] -> $tujuan[nama_kota]' href='https://www.google.com/maps/place/$tujuan[nama_kota]'>$tujuan[nama_kota]</a></td>
                <td>$row[waktu_transaksi]</td>
                <td>$text</td>
             </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>

</body>

</html>