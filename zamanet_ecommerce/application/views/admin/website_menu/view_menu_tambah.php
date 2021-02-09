<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Menu Website</h3>
            </div>

            <form action="<?= base_url('admin/tambah_menu') ?>" method="post" enctype="multipart">
              <div class="card-body">

                <input type='hidden' name='id' value=''>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">URL Menu</label>
                  <div class="col-sm-6">
                    <input type='text' class='form-control' name='url'>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Parent Menu</label>
                  <div class="col-sm-6">
                    <select name='parent' class='form-control'>
                      <option value='' selected>-- Parent Menu</option>
                      <?php
                      foreach ($record->result_array() as $row) {
                        echo "<option value='$row[id_menu]'>$row[nama_menu]</option>";
                      } ?>
                    </select>
                  </div>
                </div>



                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Menu</label>
                  <div class="col-sm-6">
                    <input type='text' class='form-control' name='nama'>
                  </div>
                </div>



                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Posisi</label>
                  <div class="col-sm-6">
                    <select name="posisi" class="form-control">
                      <option value="">-- Posisi Menu</option>
                      <option value="menu utama">Menu utama</option>
                      <option value="menu topbar">Menu topbar</option>
                      <option value="menu bawah">Menu bawah</option>
                    </select>
                  </div>
                </div>



                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Urutan</label>
                  <div class="col-sm-2">
                    <input min="1" type='number' class='form-control' name='urutan'>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type='submit' name='submit' class='btn btn-primary btn-sm'>Simpan</button>
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