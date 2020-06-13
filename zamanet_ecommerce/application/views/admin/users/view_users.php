<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manajemen Pengguna</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_manajemenuser'); ?>'>Tambah Pengguna</a>
            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless table-striped display nowrap" style="width:100%">

                <thead>
                  <tr>
                    <th style='width:20px'>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record as $row) {
                    if ($row['foto'] == '') {
                      $foto = 'default.jpg';
                    } else {
                      $foto = $row['foto'];
                    } ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $row['username'] ?></td>
                      <td><?= $row['nama_lengkap'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><img style='border:1px solid #cecece' width='40px' class='img-circle' src='<?= base_url('assets/images/user/') . $foto ?>'></td>
                      <td><?= $row['level']; ?></td>
                      <td>
                        <?php if ($row['level'] == 2 || $row['level'] == 3) { ?>
                          <a class='btn btn-success btn-xs' title='Ubah' href="<?= base_url('admin/edit_manajemenuser/') . $row['username']; ?>"><i class='fas fa-edit fa-fw'></i></a>
                          <a class='btn btn-danger btn-xs' title='Hapus' href="<?= base_url('admin/delete_manajemenuser/') . $row['username']; ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fas fa-times fa-fw'></i></a>
                        <?php } ?>
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