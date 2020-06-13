<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Slider Website</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_slider'); ?>'>Tambah Slider</a>
            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless" style="width:100%">
                <thead>
                  <tr>
                    <th style="width: 5%">No</th>
                    <th>Judul</th>
                    <th>Gambar Desktop</th>
                    <th>Gambar Mobile</th>
                    <th style="width: 10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record->result_array() as $row) { ?>

                    <tr>
                      <td><?= $no ?></td>
                      <td> <?= $row['judul'] ?></td>
                      <td><a target='_BLANK' href='<?= base_url('assets/images/slider/') . $row['gambar_besar'] ?>'>Lihat Gambar</a></td>
                      <td><a target='_BLANK' href='<?= base_url('assets/images/slider/') . $row['gambar_kecil'] ?>'>Lihat Gambar</a></td>
                      <td>
                        <a class='btn btn-success btn-xs' title='Ubah' href='<?= base_url('admin/edit_slider/') . $row['id_slide'] ?>'><i class='fas fa-edit fa-fw'></i></a>
                        <a class='btn btn-danger btn-xs' title='Hapus' href='<?= base_url('admin/delete_slider/') . $row['id_slide'] ?>' onclick="return confirm('Konfirmasi menghapus data?')"><i class='fas fa-times fa-fw'></i></a>
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