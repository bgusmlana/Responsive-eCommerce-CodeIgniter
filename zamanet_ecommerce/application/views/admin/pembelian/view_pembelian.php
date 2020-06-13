<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Transaksi Pembelian (stok)</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_pembelian'); ?>'>Tambah Pembelian</a>

            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>Kode Pembelian</th>
                    <th>Nama Supplier</th>
                    <th>Waktu Pembelian</th>
                    <th>Total</th>
                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record as $row) {
                    $total = $this->db->query("SELECT sum(a.harga_pesan*a.jumlah_pesan) as total FROM `tb_toko_pembeliandetail` a where a.id_pembelian='$row[id_pembelian]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td>$row[kode_pembelian]</td>
                              <td>$row[nama_supplier]</td>
                              <td>$row[waktu_beli]</td>
                              <td style='color:red;'>Rp " . rupiah($total['total']) . "</td>
                              <td>
                                <a class='btn btn-info btn-xs' title='Detail' href='" . base_url() . "admin/detail_pembelian/$row[id_pembelian]'><i class='fas fa-search fa-fw'></i> Detail</a>
                                <a class='btn btn-success btn-xs' title='Ubah' href='" . base_url() . "admin/editb_toko_pembelian/$row[id_pembelian]'><i class='fas fa-edit fa-fw'></i></a>
                                <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/delete_pembelian/$row[id_pembelian]' onclick=\"return confirm('Konfirmasi menghapus data?')\"><i class='fas fa-times fa-fw'></i>
                                </a>
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