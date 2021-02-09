<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Cetak Invoice</title>
</head>

<body>
  <?php
  $total = $this->db->query("SELECT a.waktu_transaksi, a.p_nama, a.p_telp, a.p_kota, a.p_kec, a.p_alamat, a.p_pos, a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $this->uri->segment(3) . "'")->row_array();
  $iden = $this->model_app->view_where('tb_web_identitas', array('id_identitas' => '1'))->row_array();
  if ($total['proses'] == '0') {
    $proses = 'Pending';
  } elseif ($total['proses'] == '1') {
    $proses = 'konfirmasi';
  } elseif ($total['proses'] == '2') {
    $proses = 'proses';
  } elseif ($total['proses'] == '3') {
    $proses = 'Dikirim';
  }
  ?>

  <hr>
  <div style="text-align: center;">
    <h2>
      <?= $iden['nama_website']; ?>
    </h2>
    <?= $iden['alamat']; ?>

  </div>
  <hr>
  <div style="text-align: center; margin-top:50px; margin-bottom:50px">
    <h2>Invoice #<?= $total['kode_transaksi'] ?></h2>
    <?php

    $date = new DateTime($total['waktu_transaksi']);
    $date->format('d-m-Y H:i');

    ?>

    <h3>Tanggal: <?= $date->format('d-m-Y H:i'); ?> </h3>
  </div>

  <!-- Row -->
  <table style="width: 100%">
    <tr>
      <td>

        <table>
          <tr>
            <td width="100px;"><small>Nama</small>
            <td>
              <?= $rows['p_nama']; ?>
            </td>
      </td>
    </tr>
    <tr>
      <td><small>No. Telpon</small></td>
      <td>
        <?= $rows['p_telp']; ?>
      </td>
    </tr>

    <tr>
      <td><small>Alamat</small></td>
      <td>
        <?= $rows['p_alamat'] ?><br>
        Kecamatan <?= $rows['p_kec'] ?><br>
        <?= $rows['nama_kota']; ?>, <?= $rows['p_pos']; ?>
      </td>
    </tr>

  </table>
  </td>

  <td>
    <div class="text-center align-middle mt-3">
      Total Bayar
      <h3>Rp <?= rupiah($total['total'] + $total['ongkir']); ?><br>
        <span style='text-transform:uppercase'>
          <?php if ($total['kurir'] == 'COD') { ?>
            <?= $total['service']; ?>
          <?php } else { ?>
            <?= $total['kurir'] ?> <?= $total['service']; ?>
          <?php } ?>
        </span>
      </h3>
      Status : <i><?= $proses ?></i>
    </div>

  </td>
  </tr>
  </table>

  <table style="width: 100%; margin-top:20px">
    <thead>
      <tr style="background-color:#ddd">
        <th width='40%' style="text-align: left">Nama Produk</th>
        <th style="text-align: left">Harga</th>
        <th style="text-align: left">Jumlah</th>
        <th style="text-align: left">Berat</th>
        <th style="text-align: left">Total</th>
      </tr>
    </thead>
    <tbody>

      <?php

      $no = 1;
      $diskon_total = 0;
      foreach ($record->result_array() as $row) {
        $sub_total = (($row['harga_jual'] - $row['diskon']) * $row['jumlah']);
        if ($row['diskon'] != '0') {
          $diskon = "<del style='color:red'>Rp" . rupiah($row['harga_jual']) . "</del> &nbsp; ";
        } else {
          $diskon = "";
        }
        if (trim($row['gambar']) == '') {
          $foto_produk = 'no-image.png';
        } else {
          $foto_produk = $row['gambar'];
        }
        $diskon_total = $diskon_total + $row['diskon'] * $row['jumlah'];
      ?>
        <tr>
          <td><?= $row['nama_produk'] ?></td>
          <td> <?= $diskon ?> Rp <?= rupiah($row['harga_jual'] - $row['diskon']) ?>

          </td>
          <td><?= $row['jumlah'] ?></td>
          <td><?= ($row['berat'] * $row['jumlah']) ?> gram</td>
          <td>Rp
            <span class="float-right">
              <?= rupiah($sub_total) ?>
            </span>
          </td>
        </tr>
      <?php
        $no++;
      }
      ?>

      <tr>
        <td colspan='4'><b>Subtotal </b></td>
        <td><b>Rp
            <span class="float-right">
              <?= rupiah($total['total']) ?>
            </span>
          </b></td>
      </tr>

      <tr>
        <td colspan='4'><b>Total Diskon</b></td>
        <td class="border border-dark"><b>Rp
            <span class="float-right">
              <?= rupiah($diskon_total); ?>
            </span>
          </b>
        <td>
      </tr>

      <tr>
        <td colspan='4'><b>Biaya Kirim </b></td>
        <td><b>Rp
            <span class="float-right">
              <?= rupiah($total['ongkir']) ?>
            </span>
          </b></td>
      </tr>



      <tr>
        <td colspan='4'><b>Total Bayar</b></td>
        <td class="border border-dark"><b>Rp
            <span class="float-right">
              <?= rupiah($total['total'] + $total['ongkir']); ?>
            </span>
          </b>
        <td>
      </tr>



      <!-- Total berat 
        <tr>
          <td colspan='4'><b>Berat</b></td>
          <td><b> <?= //$total['total_berat']
                    '' ?> Gram</b></td>
        </tr>
        -->

    </tbody>
  </table><br>

  <p> Silahkan Transfer ke salah satu pilihan bank di bawah ini:</p>
  <table style="width: 70%; margin-bottom:50px">
    <thead>
      <tr>
        <th style="text-align: left">No</th>
        <th style="text-align: left">Nama Bank</th>
        <th style="text-align: left">No Rekening</th>
        <th style="text-align: left">Atas Nama</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $rekening = $this->model_app->view('tb_toko_rekening');
      foreach ($rekening->result_array() as $row) {
      ?>
        <tr>
          <td><?= $no ?></td>
          <td><?= $row['nama_bank']; ?></td>
          <td><?= $row['no_rekening']; ?></td>
          <td><?= $row['pemilik_rekening']; ?></td>
        </tr>
      <?php
        $no++;
      }
      ?>
    </tbody>
  </table>


  </div>

  </div>

</body>

</html>