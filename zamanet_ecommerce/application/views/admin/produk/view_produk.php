<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Semua Produk</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_produk'); ?>'>Tambah Produk</a>
            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th width="25%">Nama Produk</th>
                    <th>Harga Modal</th>
                    <th>Harga Jual</th>
                    <th>Diskon</th>
                    <th>Stok</th>

                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record as $row) {
                    $jual = $this->model_app->jual($row['id_produk'])->row_array();
                    $beli = $this->model_app->beli($row['id_produk'])->row_array();
                    echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                              <td>Rp " . rupiah($row['harga_beli']) . "</td>
                              <td>Rp " . rupiah($row['harga_konsumen']) . "</td>
                              <td>Rp " . rupiah($row['diskon']) . "</td>
                              <td>$row[stok] &nbsp; $row[satuan]</td>
                             
                              <td>
                                <a class='btn btn-success btn-xs' title='Ubah' href='" . base_url() . "admin/editb_toko_produk/$row[id_produk]'><i class='fas fa-edit fa-fw'></i></a>
                                <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/delete_produk/$row[id_produk]' onclick=\"return confirm('Konfirmasi menghapus data?')\"><i class='fas fa-times fa-fw'></i></a>
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
  </section>
</div>