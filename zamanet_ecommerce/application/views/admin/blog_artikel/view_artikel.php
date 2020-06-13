<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Artikel</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_artikel'); ?>'>Tulis Artikle</a>
            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless w-100">
                <thead>
                  <tr>
                    <th style='width:20px'>No</th>
                    <th>Judul Berita</th>
                    <th>Tgl Posting</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record->result_array() as $row) {
                    $tgl_posting = tgl_indo($row['tanggal']);
                    if ($row['status'] == 'Y') {
                      $status = '<span style="color:green">Published</span>';
                    } else {
                      $status = '<span style="color:red">Unpublished</span>';
                    }
                    echo "<tr><td>$no</td>
                              <td>$row[judul]</td>
                              <td>$tgl_posting</td>
                              <td>
                                <a class='btn btn-success btn-xs' title='Ubah' href='" . base_url() . "admin/edit_artikel/$row[id_artikel]'><i class='fas fa-edit fa-fw'></i></a>
                                <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/delete_artikel/$row[id_artikel]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><i class='fas fa-times fa-fw'></i></a>
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