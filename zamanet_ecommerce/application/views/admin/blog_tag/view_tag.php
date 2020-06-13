<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tag Artikel</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_tagartikel'); ?>'>Tambah Tag</a>
            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless w-100">
                <thead>
                  <tr>
                    <th style='width:20px'>No</th>
                    <th>Nama Tag</th>
                    <th>Link</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record->result_array() as $row) {
                    echo "<tr><td>$no</td>
                              <td>$row[nama_tag]</td>
                              <td><a target='_BLANK' href='" . base_url() . "artikel/tag/$row[tag_seo]'>artikel/tag/$row[tag_seo]</a></td>
                              <td>
                                <a class='btn btn-success btn-xs' title='Ubah' href='" . base_url() . "admin/edit_tagartikel/$row[id_tag]'><i class='fas fa-edit fa-fw'></i></a>
                                <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/delete_tagartikel/$row[id_tag]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><i class='fas fa-times fa-fw'></i></a>
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