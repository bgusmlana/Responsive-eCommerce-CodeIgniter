<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">


              <?php
              if ($total['proses'] == '0') {
                $proses = '<i class="text-danger">Pending</i>';
                $color = 'danger';
                $text = 'Pending';
              } elseif ($total['proses'] == '1') {
                $proses = '<i class="text-warning">Konfirmasi</i>';
                $color = 'warning';
                $text = 'Konfirmasi';
              } elseif ($total['proses'] == '2') {
                $proses = '<i class="text-primary">Proses</i>';
                $color = 'primary';
                $text = 'Proses';
              } elseif ($total['proses'] == '3') {
                $proses = '<i class="text-success">Dikirim</i>';
                $color = 'success';
                $text = 'Dikirim';
              }
              ?>

              <h3 class="card-title">Detail Pesanan Masuk</h3><br>

              <div class="float-sm-right ">


                <div class='btn-group'>
                  <button style='width:100px' type='button' class='btn btn-<?= $color ?> btn-sm'><?= $text ?></button>

                  <button type='button' class='btn btn-<?= $color ?> btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <span class='caret'></span> <span class='sr-only'>Toggle Dropdown</span> </button>
                  <div class='dropdown-menu' style='border:1px solid #cecece;'>
                    <a class='dropdown-item' href='<?= base_url('admin/pesanan_status2/') . $total['id_penjualan'] ?>/0/<?= $this->uri->segment(3) ?>' onclick="return confirm('Apa anda yakin untuk ubah status jadi Pending ?')"> Pending</a>
                    <a class='dropdown-item' href='<?= base_url('admin/pesanan_status2/') . $total['id_penjualan'] ?>/1/<?= $this->uri->segment(3) ?>' onclick="return confirm('Apa anda yakin untuk ubah status jadi Konfirmasi ?')"> Konfirmasi</a>
                    <a class='dropdown-item' href='<?= base_url('admin/pesanan_status2/') . $total['id_penjualan'] ?>/2/<?= $this->uri->segment(3) ?>' onclick="return confirm('Apa anda yakin untuk ubah status jadi Proses ?')"> Proses</a>
                    <a class='dropdown-item' href='<?= base_url('admin/pesanan_dikirim2/') . $total['id_penjualan'] ?>/3/<?= $this->uri->segment(3) ?>' onclick="return confirm('Apa anda yakin untuk ubah status jadi Dikirim ?')"> Dikirim</a>
                  </div>
                </div>

                <a class='btn btn-primary btn-sm' href='<?php echo base_url('admin/pesanan'); ?>'>Kembali</a>
              </div>
            </div>

            <div class="card-body">
              <div class="row">


                <div class="col-md-6">
                  <table class="table table-sm table-borderless" style="width: 100%">
                    <tr>
                      <td style="width:120px;"><small>Nama</small></td>
                      <td><?= $rows['nama_lengkap']; ?></td>
                    </tr>
                    <tr>
                      <td><small>No. Telepon</small></td>
                      <td><?= $rows['no_telp']; ?></td>
                    </tr>
                    <tr>
                      <td><small>Alamat</small></td>
                      <td>
                        <?= $rows['alamat']; ?><br>
                        Kec. <?= $rows['kecamatan']; ?><br>
                        <?= $rows['nama_kota']; ?><?= $rows['kode_pos']; ?>
                      </td>
                    </tr>
                  </table>

                </div>
                <div class="col-md-6">

                  <table class="table table-sm table-borderless" style="width: 100%">
                    <tr>
                      <td style="width:120px;"><small>Total Bayar</small></td>
                      <td>Rp <?= rupiah($total['total'] + $total['ongkir']); ?></td>
                    </tr>
                    <tr>
                      <td><small>Pengiriman</small></td>
                      <td><span style='text-transform:uppercase'><?= $total['kurir']; ?> <?= $total['service'] ?></span></td>
                    </tr>
                    <tr>
                      <td><small>Status</small></td>
                      <td><?= $proses ?></td>
                    </tr>

                    <?php if ($total['proses'] == '3') { ?>
                      <tr>
                        <td><small>No. Resi</small></td>
                        <td><?= $total['resi']; ?></td>
                      </tr>
                    <?php } ?>

                  </table>
                </div>

              </div>
              <div class="row">

                <div class="col-md-12">
                  <table class='table table-small table-borderless'>
                    <thead>
                      <tr class="border border-dark">
                        <th width='10px'><?= $no ?></th>
                        <th width='40%'>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Berat</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
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
                      ?>

                        <tr>
                          <td><?= $no ?></td>
                          <td><a href='<?= base_url('produk/detail/') . $row['produk_seo'] ?>'><?= $row['nama_produk']; ?></a></td>
                          <td><?= rupiah($row['harga_jual'] - $row['diskon']) . " " . $diskon ?></td>
                          <td><?= $row['jumlah'] ?></td>
                          <td><?= ($row['berat'] * $row['jumlah']) ?> gram</td>
                          <td>Rp <?= rupiah($sub_total) ?></td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>
                      <tr class='success'>
                        <td colspan='5'><b>Subtotal </b> </td>
                        <td><b>Rp <?= rupiah($total['total']) ?></b></td>
                      </tr>

                      <tr class='success'>
                        <td colspan='5'><b>Biaya Kirim</b> </td>
                        <td><b>Rp <?= rupiah($total['ongkir']) ?></b></td>
                      </tr>

                      <tr class='success'>
                        <td colspan='5'><b>Berat</b></td>
                        <td><b><?= $total['total_berat'] ?> gram</b></td>
                      </tr>

                    </tbody>
                  </table><br>
                </div>

              </div>

              <div class="row">
                <div class="col-md-12">
                  <?php

                  $cek_konfirmasi = $this->db->get_where('tb_toko_konfirmasi', array('id_penjualan' => $total['id_penjualan']));
                  if ($cek_konfirmasi->num_rows() >= 1) {
                    echo "<div class='alert alert-primary' style='border-radius:0px; padding:5px'>Konfirmasi Pembayaran dari Pembeli : </div>";
                    $konfirmasi = $this->model_app->view_join_where('tb_toko_konfirmasi', 'tb_toko_rekening', 'id_rekening', array('id_penjualan' => $total['id_penjualan']), 'id_konfirmasi_pembayaran', 'DESC');
                    foreach ($konfirmasi as $r) {
                  ?>
                      <div class='col-md-12'>
                        <table class="table table-sm table-borderless">
                          <tr>
                            <td style="width:140px;">Nama Pengirim</td>

                            <td><?= $r['nama_pengirim'] ?></td>
                          </tr>

                          <tr>
                            <td>Total Transfer</td>

                            <td><?= $r['total_transfer'] ?></td>
                          </tr>

                          <tr>
                            <td>Tanggal Transfer</td>

                            <td><?= tgl_indo($r['tanggal_transfer']) ?></td>
                          </tr>

                          <tr>
                            <td>Bukti Transfer</td>

                            <td><a href='<?= base_url('admin/download_file/') . $r['bukti_transfer'] ?>'>Download File</a></td>
                          </tr>

                          <tr>
                            <td>Rekening Tujuan</td>

                            <td><?= $r['nama_bank'] ?> - <?= $r['no_rekening'] ?> - <?= $r['pemilik_rekening'] ?></td>
                          </tr>

                          <tr>
                            <td>Waktu Konfirmasi</td>

                            <td><?= $r['waktu_konfirmasi'] ?></td>
                          </tr>


                        </table>
                      </div>

                      <hr>
                  <?php
                    }
                  }
                  ?>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>