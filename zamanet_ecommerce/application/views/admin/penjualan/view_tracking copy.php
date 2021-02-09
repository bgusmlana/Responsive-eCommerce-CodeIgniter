<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class='col-md-12'>
          <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'><?php echo $title; ?></h3>
              <a class='pull-right btn btn-warning btn-sm' href='<?php echo base_url(); ?>administrator/orders'>Kembali</a>
            </div>
            <div class='box-body'>
              <div class='col-md-12'>
                <?php
                if ($total['proses'] == '0') {
                  $proses = '<i class="text-danger">Pending</i>';
                } elseif ($total['proses'] == '1') {
                  $proses = '<i class="text-warning">Proses</i>';
                } elseif ($total['proses'] == '2') {
                  $proses = '<i class="text-info">Konfirmasi</i>';
                } else {
                  $proses = '<i class="text-success">Dikirim </i>';
                }
                echo "<div class='col-md-8'>
        <dl class='dl-horizontal'>
            <dt>Nama</dt>       <dd>$rows[nama_lengkap]</dd>
            <dt>No Telpon/Hp</dt>       <dd>$rows[no_hp]</dd>
            <dt>Email</dt>       <dd>$rows[email]</dd>
            <dt>Kota</dt>               <dd>$rows[nama_kota]</dd>
            <dt>Alamat Lengkap</dt>     <dd>$rows[alamat_lengkap]</dd>
        </dl>
    </div>

    <div class='col-md-4'>
        <center>
        Total Bayar
        <h4 style='margin:0px;'>Rp " . rupiah($total['total'] + $total['ongkir'] + substr($this->uri->segment(3), -3)) . "<br> <br> 
          <span style='text-transform:uppercase'>$total[kurir]</span> ($total[service])
        </h4>
        Status : <i>$proses</i>   
        </center>
    </div>

      <table class='table table-striped table-condensed '>
          <thead>
            <tr bgcolor='#e3e3e3'>
              <th width='30px'>$no</th>
              <th width='47%'>Nama Produk</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Berat</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>";

                $no = 1;
                $diskon_total = 0;
                foreach ($record->result_array() as $row) {
                  $sub_total = (($row['harga_jual'] - $row['diskon']) * $row['jumlah']);
                  if ($row['diskon'] != '0') {
                    $diskon = "<del style='color:red'>" . rupiah($row['harga_jual']) . "</del>";
                  } else {
                    $diskon = "";
                  }
                  if (trim($row['gambar']) == '') {
                    $foto_produk = 'no-image.png';
                  } else {
                    $foto_produk = $row['gambar'];
                  }
                  $diskon_total = $diskon_total + $row['diskon'] * $row['jumlah'];
                  echo "<tr><td>$no</td>
                    <td class='valign'><a href='" . base_url() . "produk/detail/$row[produk_seo]'>$row[nama_produk]</a></td>
                    <td class='valign'>" . rupiah($row['harga_jual'] - $row['diskon']) . " $diskon</td>
                    <td class='valign'>$row[jumlah]</td>
                    <td class='valign'>" . ($row['berat'] * $row['jumlah']) . " Gram</td>
                    <td class='valign'>Rp " . rupiah($sub_total) . "</td>
                </tr>";
                  $no++;
                }

                echo "<tr class='success'>
                  <td colspan='5'><b>Subtotal </b> <i class='pull-right'>(" . terbilang($total['total']) . " Rupiah)</i></td>
                  <td><b>Rp " . rupiah($total['total']) . "</b></td>
                </tr>

                <tr class='success'>
                  <td colspan='5'><b>Ongkir </b> <i class='pull-right'>(" . terbilang($total['ongkir']) . " Rupiah)</i></td>
                  <td><b>Rp " . rupiah($total['ongkir']) . "</b></td>
                </tr>

                <tr class='success'>
                  <td colspan='5'><b>Berat</b> <i class='pull-right'>(" . terbilang($total['total_berat']) . " Gram)</i></td>
                  <td><b>$total[total_berat] Gram</b></td>
                </tr>

        </tbody>
      </table><br>";

                $cek_konfirmasi = $this->model_app->view_where('tb_toko_konfirmasi', array('id_penjualan' => $total['id_penjualan']));
                if ($cek_konfirmasi->num_rows() >= 1) {
                  echo "<div class='alert alert-success' style='border-radius:0px; padding:5px'>Konfirmasi Pembayaran dari Pembeli : </div>";
                  $konfirmasi = $this->model_app->view_join_where('tb_toko_konfirmasi', 'tb_toko_rekening', 'id_rekening', array('id_penjualan' => $total['id_penjualan']), 'id_konfirmasi_pembayaran', 'DESC');
                  foreach ($konfirmasi as $r) {
                    echo "<div class='col-md-8'>
                  <dl class='dl-horizontal'>
                      <dt>Nama Pengirim</dt>       <dd>$r[nama_pengirim]</dd>
                      <dt>Total Transfer</dt>      <dd>$r[total_transfer]</dd>
                      <dt>Tanggal Transfer</dt>    <dd>" . tgl_indo($r['tanggal_transfer']) . "</dd>
                      <dt>Bukti Transfer</dt>      <dd><a href='" . base_url() . "administrator/download_file/$r[bukti_transfer]'>Download File</a></dd>
                      <dt>Rekening Tujuan</dt>     <dd>$r[nama_bank] - $r[no_rekening] - $r[pemilik_rekening]</dd>
                      <dt>Waktu Konfirmasi</dt>      <dd>$r[waktu_konfirmasi]</dd>
                  </dl>
              </div>";
                  }
                }

                echo "</div>
      </div>
    </div>
  </div>";
                ?>
              </div>
            </div>
  </section>
</div>