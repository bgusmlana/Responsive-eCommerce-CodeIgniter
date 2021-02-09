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
              <table id="table1" class="table table-sm table-striped display nowrap" style="width:100%">
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
                        <button class='btn btn-danger btn-xs' title='Hapus' data-id='<?= $row['id_slide'] ?>' onclick="confirmation(event)"><i class='fas fa-times fa-fw'></i></button>
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

<script>
  function confirmation(ev) {
    ev.preventDefault();
    var data_id = ev.currentTarget.getAttribute('data-id');
    var currentLocation = window.location;
    Swal.fire({
      title: 'Konfirmasi Hapus Data',
      text: "Apakah Anda ingin menghapus data ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: site_url + 'admin/delete_slider/' + data_id,
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            Swal.fire({
              title: 'Dihapus!',
              text: 'Data berhasil dihapus',
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              location.reload();
            })
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.debug(jqXHR);
            console.debug(textStatus);
            console.debug(errorThrown);
          },
        });
      }
    })
  }
</script>