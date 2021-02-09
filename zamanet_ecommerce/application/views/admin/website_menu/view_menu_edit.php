<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ubah Menu Website</h3>
            </div>

            <form action="<?= base_url('admin/edit_menu') ?>" method="post" enctype="multipart">
              <div class="card-body">

                <input type='hidden' name='id' value='<?= $rows['id_menu'] ?>'>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">URL Menu</label>
                  <div class="col-sm-6">
                    <input type='text' class='form-control' name='url' value='<?= $rows['link'] ?>'>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Parent Menu</label>
                  <div class="col-sm-6">
                    <select name='parent' class='form-control'>
                      <option value='' selected>-- Parent Menu</option>
                      <?php
                      foreach ($record->result_array() as $row) {
                        if ($row['id_menu'] == $rows['id_parent']) {
                          echo "<option value='$row[id_menu]' selected>$row[nama_menu] </option>";
                        } else {
                          echo "<option value='$row[id_menu]'>$row[nama_menu]</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Menu</label>
                  <div class="col-sm-6">
                    <input type='text' class='form-control' name='nama' value='<?= $rows['nama_menu'] ?>'>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Posisi</label>
                  <div class="col-sm-6">
                    <select name="posisi" class="form-control">
                      <?php if ($row['position'] == 'menu utama') {
                        $a = 'selected';
                        $b = '';
                        $c = '';
                      } else if ($row['position'] == 'menu topbar') {
                        $a = '';
                        $b = 'selected';
                        $c = '';
                      } else {
                        $a = '';
                        $b = '';
                        $c = 'selected';
                      } ?>

                      <option value="menu utama" <?= $a; ?>>Menu utama</option>
                      <option value="menu topbar" <?= $b; ?>>Menu topbar</option>
                      <option value="menu bawah" <?= $c; ?>>Menu bawah</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Urutan</label>
                  <div class="col-sm-2">
                    <input min="1" type='number' class='form-control' name='urutan' value='<?= $rows['urutan'] ?>'>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Aktif</label>
                  <div class="col-sm-2">
                    <select name="aktif" class="form-control">
                      <?php if ($rows['aktif'] == 'ya') {
                        $y = 'selected';
                        $t = '';
                      } else {
                        $y = '';
                        $t = 'selected';
                      }
                      ?>
                      <option value="ya" <?= $y; ?>>ya</option>
                      <option value="tidak" <?= $t; ?>>tidak</option>
                    </select>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type='submit' name='submit' class='btn btn-primary btn-sm'>Perbarui</button>
                    <a href="<?= base_url('admin/menu') ?>"><button type='button' class='btn btn-secondary btn-sm ml-1'>Batal</button></a>
                  </div>
                </div>

              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>