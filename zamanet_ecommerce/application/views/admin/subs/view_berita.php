<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Berita</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_berita'); ?>'>Kirim Berita</a>
            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless table-striped display nowrap" style="width:100%">

                <thead>
                  <tr>
                    <th style='width:20px'>No</th>
                    <th>Judul</th>
                    <th>Tgl</th>
                    <th style='width:10%'>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record->result_array() as $row) {
                    $tgl_posting = tgl_indo($row['tgl']);
                    echo "<tr><td>$no</td>
                              <td>$row[judul_berita]</td>
                              <td>$tgl_posting</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Ubah' href='" . base_url() . "admin/lihat_berita/$row[id_berita]'>Lihat</a>
                                <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/delete_berita/$row[id_berita]' onclick=\"return confirm('Konfirmasi menghapus data?')\"><i class='fas fa-times fa-fw'></i></a>
                              </center></td>
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