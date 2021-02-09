<div class="block">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3 d-flex">
        <div class="account-nav flex-grow-1">
          <ul>
            <li class="account-nav__item"><a href="<?= base_url('members/dashboard') ?>">Dashboard</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/edit_profile') ?>">Ubah Profil</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/edit_alamat') ?>">Ubah Alamat</a></li>
            <li class="account-nav__item account-nav__item--active"><a href="<?= base_url('members/riwayat_belanja') ?>">Riwayat Transaksi</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/password') ?>">Ganti Password</a></li>
            <li class="account-nav__item"><a href="javascript:void(0)" onclick="logout()">Keluar</a></li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-lg-9 mt-4 mt-lg-0">
        <div class="card">
          <div class="card-header">
            <h5>Riwayat Belanja</h5>
          </div>
          <div class="card-divider"></div>
          <div class="card-body">
            <table id='table1' class='table table-sm table-borderless' style="width: 100%">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>No Invoice</th>
                  <th>Total Belanja</th>
                  <th>Status</th>
                  <th>Waktu Transaksi</th>
                  <th style="width: 25%">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($record as $row) {
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
                              <td><a href='" . base_url() . "konfirmasi/tracking/$row[kode_transaksi]'>$row[kode_transaksi]</a></td>
                              <td style='color:red;'>Rp " . rupiah($total['total'] + $total['ongkir']) . "</td>
                              <td>$proses</td>
                              <td>" . cek_terakhir($row['waktu_transaksi']) . " lalu</td>
                              <td>
                                <a class='btn btn-primary btn-xs' title='Download' href='" . base_url() . "page/download/$row[kode_transaksi]' target='_BLANK'>Download</a>
                                <a class='btn btn-info btn-xs' title='Rincian data pesanan' href='" . base_url() . "page/tracking_status/$row[kode_transaksi]' target='_BLANK'>Rincian</a>
                              </td>
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