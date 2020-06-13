<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Transaksi Pembelian</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/pembelian'); ?>'>Kembali</a>
            </div>

            <div class="card-body">

              <table class='table table-condensed table-borderless'>
                <tbody>
                  <tr>
                    <th width='150px' scope='row'>Kode Pembelian</th>
                    <td>: &nbsp; <?php echo "$rows[kode_pembelian]"; ?></td>
                  </tr>
                  <tr>
                    <th scope='row'>Nama Supplier</th>
                    <td>: &nbsp; <?php echo "$rows[nama_supplier]"; ?></td>
                  </tr>
                  <tr>
                    <th scope='row'>Waktu Pembelian</th>
                    <td>: &nbsp; <?php echo "$rows[waktu_beli]"; ?></td>
                  </tr>
                </tbody>
              </table>
              <hr>
              <table class="table table-condensed table-striped">
                <thead>
                  <tr>
                    <th style='width:40px'>No</th>
                    <th>Nama Produk</th>
                    <th>Harga Pesan</th>
                    <th>Jumlah Pesan</th>
                    <th>Satuan</th>
                    <th>Sub Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record as $row) {
                    $sub_total = $row['harga_pesan'] * $row['jumlah_pesan'];
                    echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                              <td>Rp " . rupiah($row['harga_pesan']) . "</td>
                              <td>$row[jumlah_pesan]</td>
                              <td>$row[satuan]</td>
                              <td>Rp " . rupiah($sub_total) . "</td>
                          </tr>";
                    $no++;
                  }

                  $total = $this->db->query("SELECT sum(a.harga_pesan*a.jumlah_pesan) as total FROM `tb_toko_pembeliandetail` a where a.id_pembelian='" . $this->uri->segment(3) . "'")->row_array();
                  echo "<tr class='success'>
                            <td colspan='5'><b>Total</b></td>
                            <td><b>Rp " . rupiah($total['total']) . "</b></td>
                          </tr>";
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