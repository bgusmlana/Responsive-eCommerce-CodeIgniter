<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pesanan Masuk</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/print_pesanan'); ?>' target="_blank">Print Pesanan</a>
            </div>

            <div class="card-body">



              <table id="table1" class="table table-sm table-borderless" style="width:100%">

                <thead>
                  <tr>
                    <th style="width: 5%">No</th>
                    <th>Kode Transaksi</th>
                    <th>Total Belanja</th>
                    <th>Pengiriman</th>
                    <!--  <th>Tujuan</th>  -->
                    <th>Waktu Transaksi</th>
                    <th>Resi</th>
                    <th style="width:200px">Aksi</th>
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
                      $proses = '<i class="text-warning">Konfirmasi</i>';
                      $color = 'warning';
                      $text = 'Konfirmasi';
                    } elseif ($row['proses'] == '2') {
                      $proses = '<i class="text-primary">Proses</i>';
                      $color = 'primary';
                      $text = 'Proses';
                    } elseif ($row['proses'] == '3') {
                      $proses = '<i class="text-success">Dikirim</i>';
                      $color = 'success';
                      $text = 'Dikirim';
                    }

                    $total = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.resi, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk JOIN tb_pengguna d ON a.id_pembeli=d.id_pengguna where a.kode_transaksi='$row[kode_transaksi]'")->row_array();

                  ?>
                    <tr>
                      <td><?= $no ?> </td>
                      <td><?= $row['kode_transaksi']; ?></td>
                      <td style='color:red;'>Rp <?= rupiah($total['total'] + $total['ongkir']) ?></td>
                      <td><span style='text-transform:uppercase'> <?= $total['kurir'] ?></span> <?= ($total['service']) ?></td>
                      <td><?= $row['waktu_transaksi'] ?></td>
                      <td><?= $total['resi'] ?></td>
                      <td>
                        <div class='btn-group'>
                          <button style='width:100px' type='button' class='btn btn-<?= $color ?> btn-xs'><?= $text ?></button>

                          <button type='button' class='btn btn-<?= $color ?> btn-xs dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <span class='caret'></span> <span class='sr-only'>Toggle Dropdown</span> </button>
                          <div class='dropdown-menu' style='border:1px solid #cecece;'>
                            <a class='dropdown-item' href='<?= base_url('admin/pesanan_status/') . $row['id_penjualan'] ?>/0' onclick="return confirm('Apa anda yakin untuk ubah status jadi Pending ?')"> Pending</a>
                            <a class='dropdown-item' href='<?= base_url('admin/pesanan_status/') . $row['id_penjualan'] ?>/1' onclick="return confirm('Apa anda yakin untuk ubah status jadi Konfirmasi ?')"> Konfirmasi</a>
                            <a class='dropdown-item' href='<?= base_url('admin/pesanan_status/') . $row['id_penjualan'] ?>/2' onclick="return confirm('Apa anda yakin untuk ubah status jadi Proses ?')"> Proses</a>
                            <a class='dropdown-item' href='<?= base_url('admin/pesanan_dikirim/') . $row['id_penjualan'] ?>/3' onclick="return confirm('Apa anda yakin untuk ubah status jadi Dikirim ?')"> Dikirim</a>
                          </div>
                        </div>

                        <a class='btn btn-info btn-xs' title='Detail data pesanan' href=' <?= base_url('admin/tracking/') . $row['kode_transaksi'] ?>'><i class='fas fa-search'></i></a>
                        <a class='btn btn-info btn-xs' title='Input Resi' href='<?= base_url('admin/pesanan_dikirim/') . $row['id_penjualan'] ?>'><i class='fas fa-edit'></i></a>
                      </td>
                    </tr>
                  <?php
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
  </section>
</div>