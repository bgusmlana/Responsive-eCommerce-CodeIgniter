<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Konsumen</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/konsumen'); ?>'>Kembali</a>
            </div>

            <div class="card-body">

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="profil-tab" data-toggle="tab" href="#profil" role="tab" aria-controls="profil" aria-selected="true">Data Konsumen</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="transaksi-tab" data-toggle="tab" href="#transaksi" role="tab" aria-controls="transaksi" aria-selected="false">Riwayah Transaksi</a>
                </li>
              </ul>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                  <table class='table table-sm table-borderless mt-2'>
                    <tbody>
                      <?php
                      if (trim($rows['foto']) == '') {
                        $foto_user = 'default.jpg';
                      } else {
                        $foto_user = $rows['foto'];
                      } ?>
                      <tr>
                        <td rowspan='14' width='110px'>
                          <?= "<img style='border:1px solid #cecece; height:85px; width:85px' src='" . base_url() . "assets/images/user/$foto_user' class='img-circle img-thumbnail'>"; ?>
                        </td>
                      </tr>
                      <tr>
                        <td width='130px'><small>Username</small></td>
                        <td><?= $rows['username'] ?></td>
                      </tr>
                      <tr>
                        <td><small>Password</small></td>
                        <td>***************</td>
                      </tr>
                      <tr>
                        <td><small>Nama Lengkap</small></td>
                        <td><?= $rows['nama_lengkap'] ?></td>
                      </tr>
                      <tr>
                        <td><small>Email</small></td>
                        <td><?= $rows['email'] ?></td>
                      </tr>
                      <tr>
                        <td><small>No. Telepon</small></td>
                        <td><?= $rows['no_telp'] ?></td>
                      </tr>
                      <tr>
                        <td><small>jenis Kelamin</small></td>
                        <td><?= $rows['jenis_kelamin'] ?></td>
                      </tr>
                      <tr>
                        <td><small>Tanggal Lahir</small></td>
                        <td><?= tgl_indo($rows['tgl_lahir']); ?></td>
                      </tr>
                      <tr>
                        <td><small>Alamat</small></td>
                        <td class="border p-1"><i>
                            <?= $rows['alamat'] ?><br>
                            Kecamatan <?= $rows['kecamatan'] ?> <br>
                            <?= $rows['nama_kota'] ?>, <?= $rows['kode_pos'] ?>

                          </i></td>
                      </tr>
                      <tr>
                        <td><small>Tanggal Daftar</small></td>
                        <td><?= tgl_indo($rows['tgl_daftar']); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                  <table id="table2" class='table table-borderless display nowarp' style="width:100%">
                    <tdead>
                      <tr>
                        <td style="width:5%">No</td>
                        <td style="width:20%">Kode Transaksi</td>
                        <td style="width:15%">Total Belanja</td>
                        <td style="width:15%">Pengiriman</td>
                        <td style="width:15%">Status</td>
                        <td style="width:15%">Waktu Transaksi</td>
                        <td style="width:15%"></td>
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($record->result_array() as $row) {
                          if ($row['proses'] == '0') {
                            $proses = '<i class="text-danger">Pending</i>';
                          } elseif ($row['proses'] == '1') {
                            $proses = '<i class="text-warning">Konfirmasi</i>';
                          } elseif ($row['proses'] == '2') {
                            $proses = '<i class="text-primary">Proses</i>';
                          } elseif ($row['proses'] == '3') {
                            $proses = '<i class="text-success">Dikirim </i>';
                          }
                          $total = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='$row[kode_transaksi]'")->row_array();
                          echo "<tr><td>$no</td>
                                            <td>$row[kode_transaksi]</td>
                                            <td>Rp " . rupiah($total['total'] + $total['ongkir'] + $total['kode_unik']) . "</td>
                                            <td><span style='text-transform:uppercase'>$total[kurir]</span> ($total[service])</td>
                                            <td>$proses</td>
                                            <td>$row[waktu_transaksi]</td>
                                            <td width='50px'><a class='btn btn-info btn-xs' title='Detail data pesanan' href='" . base_url() . "admin/tracking/$row[kode_transaksi]' target='_blank'><i class='fas fa-search fa-fw'></i></a></td>
                                         </tr>";
                          $no++;
                        }
                        ?>
                      </tbody>
                  </table>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>
</div>
</section>
</div>