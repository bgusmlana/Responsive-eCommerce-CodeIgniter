<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Konsumen</h3>
            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Telp</th>
                    <th>Jenis Kelamin</th>
                    <th>Waktu Daftar</th>
                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record as $row) {
                    echo "<tr><td>$no</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[email]</td>
                              <td>$row[no_telp]</td>
                              <td>$row[jenis_kelamin]</td>
                              <td>" . tgl_indo($row['tgl_daftar']) . "</td>
                              <td>
                                <a class='btn btn-info btn-xs' title='Detail' href='" . base_url() . "admin/detail_konsumen/$row[id_pengguna]'><i class='fas fa-search fa-fw'></i> Detail</a>
                                <a class='btn btn-success btn-xs' title='Ubah' href='" . base_url() . "admin/editb_toko_konsumen/$row[id_pengguna]'><i class='fas fa-edit fa-fw'></i></a>
                                <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/delete_konsumen/$row[id_pengguna]' onclick=\"return confirm('Konfirmasi menghapus data?')\"><i class='fas fa-times fa-fw'></i></a>
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