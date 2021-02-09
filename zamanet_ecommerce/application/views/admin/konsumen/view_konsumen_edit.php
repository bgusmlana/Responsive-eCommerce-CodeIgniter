<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ubah Kategori Produk</h3>
            </div>

            <form action="<?= base_url('admin/edit_konsumen') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body">

                <input type='hidden' value='<?= $this->uri->segment(3) ?>' name='id'>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-6">
                    <input class='form-control' name='aa' type='text' value='<?= $row['username'] ?>' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-6">
                    <input class='form-control' type='password' name='a'>
                    <small style='color:red'><i>Kosongkan saja jIka tidak ubah.</i></small>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-6">
                    <input class='required form-control' type='text' name='b' value='<?= $row['nama_lengkap'] ?>' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-6">
                    <input class='required email form-control' type='email' name='c' value='<?= $row['email'] ?>' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-6">
                    <?php if ($row['jenis_kelamin'] == 'Laki-laki') {
                      echo "<input type='radio' value='Laki-laki' name='d' checked> Laki-laki <input type='radio' value='Perempuan' name='d'> Perempuan ";
                    } else {
                      echo "<input type='radio' value='Laki-laki' name='d'> Laki-laki <input type='radio' value='Perempuan' name='d' checked> Perempuan ";
                    } ?>
                  </div>
                </div>



                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                  <div class="col-sm-6">
                    <input class='datepicker form-control' type='text' name='e' value='<?= $row['tanggal_lahir'] ?>' data-date-format='yyyy-mm-dd' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                  <div class="col-sm-6">
                    <input class='form-control' type='text' name='f' value='<?= $row['tempat_lahir'] ?>' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-6">
                    <textarea class='form-control' name='g' required><?= $row['alamat_lengkap'] ?></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kota Sekarang</label>
                  <div class="col-sm-6">
                    <select class='form-control select2 w-100' name='j' id='city' required>
                      <option value=''>- Pilih -</option>
                      <?php
                      foreach ($kota->result_array() as $rows) {
                        if ($row['kota_id'] == $rows['kota_id']) {
                          echo "<option value='$rows[kota_id]' selected>$rows[nama_kota]</option>";
                        } else {
                          echo "<option value='$rows[kota_id]'>$rows[nama_kota]</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No. Telp</label>
                  <div class="col-sm-6">
                    <input class='form-control' type='number' name='l' value='<?= $row['no_hp'] ?>' maxlength="13" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type='submit' name='submit' class='btn btn-primary btn-sm'>Perbarui</button>
                    <a href='<?= base_url('admin/konsumen') ?>'><button type='button' class='btn btn-secondary btn-sm ml-1'>Batal</button></a>
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