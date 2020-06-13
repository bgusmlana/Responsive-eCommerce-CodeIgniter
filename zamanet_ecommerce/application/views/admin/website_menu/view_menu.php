<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Menu Website</h3>
              <a class='float-right btn btn-primary btn-sm' href='<?= base_url('admin/tambah_menuwebsite'); ?>'>Tambah Menu</a>
            </div>

            <div class="card-body">
              <table id="table1" class="table table-borderless table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>Menu</th>
                    <th>Posisi</th>
                    <th>Parent</th>
                    <th>Link</th>
                    <th>Aktif</th>
                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record->result_array() as $row) {
                    $cmenu = $this->model_menu->menu_cek($row['id_parent'])->row_array();
                    if ($cmenu['id_parent'] == '') {
                      $menu = '';
                    } else {
                      $menu = $cmenu['nama_menu'];
                    }
                    echo "<tr>
                              <td>$no</td>
                              <td>$row[nama_menu]</td>
                              <td>$row[position] #$row[urutan]</td>
                              <td>$menu</td>
                              <td><a target='_BLANK' href='" . base_url() . "$row[link]'>$row[link]</a></td>
                              <td>$row[aktif]</td>
                              <td>
                                <a class='btn btn-success btn-xs' title='Ubah' href='" . base_url() . "admin/edit_menuwebsite/$row[id_menu]'><i class='fas fa-edit fa-fw'></i></a>
                                <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/delete_menuwebsite/$row[id_menu]' onclick=\"return confirm('Konfirmasi menghapus data?')\"><i class='fas fa-times fa-fw'></i></a>
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