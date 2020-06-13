<!DOCTYPE html>
<html>

<head>
  <title>Rekap Pesanan</title>
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>dist/css/adminlte2.css">
</head>

<body class="layout-boxed" onload="window.print()">

  <div class="wrapper w-75">
    <hr>
    <div class="text-center mt-2 mb-2">
      <h2>
        <?= $iden['nama_website']; ?>
      </h2>
      <?= $iden['alamat'] ?>

    </div>

    <table class="table table-small mt-3">
      <thead>
        <tr style="background:#ddd;">
          <th width="20px">No</th>
          <th>Kode Transaksi</th>
          <th>Total Belanja</th>
          <th>Pengiriman</th>
          <th>Tujuan</th>
          <th>Waktu Transaksi</th>
          <th></th>
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
          $total = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.kode_unik, a.ongkir, e.nama_kota, f.nama_provinsi, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk JOIN tb_toko_konsumen d ON a.id_pembeli=d.id_konsumen JOIN tb_kota e ON d.kota_id=e.kota_id JOIN tb_provinsi f ON e.provinsi_id=f.provinsi_id where a.kode_transaksi='$row[kode_transaksi]'")->row_array();

          echo "<tr><td>$no</td>
                <td>$row[kode_transaksi]</td>
                <td style='color:red;'>Rp " . rupiah($total['total'] + $total['ongkir'] + $total['kode_unik']) . "</td>
                <td><span style='text-transform:uppercase'>$total[kurir]</span> ($total[service])</td>
                <td><a target='_BLANK' title='$total[nama_provinsi] -> $total[nama_kota]' href='https://www.google.com/maps/place/$total[nama_kota]'>$total[nama_kota]</a></td>
                <td>$row[waktu_transaksi]</td>
                <td>$text</td>
             </tr>";
          $no++;
        }
        ?>
      </tbody>
    </table>

  </div>

  <script src="<?= base_url('assets/template/adminlte3/'); ?>dist/js/adminlte.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>