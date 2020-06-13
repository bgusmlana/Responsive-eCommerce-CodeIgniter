<div class="block">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3 d-flex">
        <div class="account-nav flex-grow-1">
          <ul>
            <li class="account-nav__item"><a href="<?= base_url('members/dashboard') ?>">Dashboard</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/edit_profile') ?>">Ubah Profil</a></li>
            <li class="account-nav__item account-nav__item--active"><a href="<?= base_url('members/edit_alamat') ?>">Ubah Alamat</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/riwayat_belanja') ?>">Riwayat Transaksi</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/password') ?>">Ganti Password</a></li>
            <li class="account-nav__item"><a href="javascript:void(0)" onclick="logout()">Keluar</a></li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-lg-9 mt-4 mt-lg-0">
        <div class="card">
          <div class="card-header">
            <h5>Ubah Alamat</h5>
          </div>
          <div class="card-divider"></div>
          <div class="card-body">
            <div class="row no-gutters">
              <div class="col-12 col-lg-7 col-xl-6">

                <form action="<?= base_url('members/edit_alamat') ?>" method="post" enctype="multipart/form-data">

                  <input type="hidden" name="id" value="<?= encrypt_url($row['id_alamat']) ?>">

                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="5" required><?= $row['alamat']; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label>Kecamatan</label>
                    <input class='form-control' type='text' name='kec' value="<?= $row['kecamatan']; ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Kota / Kabupaten</label>
                    <select class='form-control select2' name='kab' required>
                      <option value=''>- Pilih -</option>
                      <?php
                      foreach ($kota->result_array() as $rows) {
                        if ($row['id_kota'] == $rows['kota_id']) {
                          echo "<option value='$rows[kota_id]' selected>$rows[nama_kota]</option>";
                        } else {
                          echo "<option value='$rows[kota_id]'>$rows[nama_kota]</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Kode Pos</label>
                    <input class='form-control' min="0" minlength="5" maxlength="7" type='number' name='kode_pos' value='<?= $row['kode_pos']; ?>' required>
                  </div>


                  <div class="form-group mt-5 mb-0">
                    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>