<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Supplier</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_supplier'); ?>'>Tambah Supplier</a>
            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>Nama Supplier</th>
                    <th>Kontak Person</th>
                    <th>No Hp/Telpon</th>
                    <th>Alamat Email</th>
                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record as $row) {
                    echo "<tr><td>$no</td>
                              <td>$row[nama_supplier]</td>
                              <td>$row[kontak_person]</td>
                              <td>$row[no_hp] / $row[no_telpon]</td>
                              <td>$row[alamat_email]</td>
                              <td>
                                <a class='btn btn-success btn-xs' title='Ubah' href='" . base_url() . "admin/editb_toko_supplier/$row[id_supplier]'><i class='fas fa-edit fa-fw'></i></a>
                                <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/delete_supplier/$row[id_supplier]' onclick=\"return confirm('Konfirmasi menghapus data?')\"><i class='fas fa-times fa-fw'></i></a>
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