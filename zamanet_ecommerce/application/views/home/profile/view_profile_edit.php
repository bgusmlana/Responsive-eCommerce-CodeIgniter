<div class="block">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3 d-flex">
        <div class="account-nav flex-grow-1">
          <ul>
            <li class="account-nav__item"><a href="<?= base_url('members/dashboard') ?>">Dashboard</a></li>
            <li class="account-nav__item account-nav__item--active"><a href="<?= base_url('members/edit_profile') ?>">Ubah Profil</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/edit_alamat') ?>">Ubah Alamat</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/riwayat_belanja') ?>">Riwayat Transaksi</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/password') ?>">Ganti Password</a></li>
            <li class="account-nav__item"><a href="javascript:void(0)" onclick="logout()">Keluar</a></li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-lg-9 mt-4 mt-lg-0">
        <div class="card">
          <div class="card-header">
            <h5>Ubah Profil</h5>
          </div>
          <div class="card-divider"></div>
          <div class="card-body">
            <div class="row no-gutters">
              <div class="col-12 col-lg-7 col-xl-6">

                <form action="<?= base_url('members/edit_profile') ?>" method="post" enctype="multipart/form-data">

                  <input type="hidden" name="id" value="<?= encrypt_url($row['id_pengguna']) ?>">

                  <div class="form-group">
                    <label>Email</label>
                    <input class='email form-control' type='email' name='c' value='<?= $row['email']; ?>' required readonly>
                  </div>

                  <div class=" form-group">
                    <label>Username</label>
                    <input class='form-control' name='aa' type='text' value='<?= $row['username'] ?>' required readonly>
                  </div>

                  <hr>

                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class='form-control' type='text' name='b' value='<?= $row['nama_lengkap']; ?>' required>
                  </div>

                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input class='datepicker form-control' type='text' name='e' value='<?= $row['tgl_lahir']; ?>' required>
                  </div>

                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <br>
                    <?php
                    if ($row['jenis_kelamin'] == 'Laki-laki') { ?>

                      <div class="form-check-inline single-ship">
                        <input class="mr-2" type='radio' value='Laki-laki' name='d' checked> Laki-laki
                        <input class="mr-2 ml-5" type='radio' value='Perempuan' name='d'> Perempuan
                      </div>

                    <?php } else { ?>

                      <div class="form-check-inline single-ship">
                        <input type='radio' value='Laki-laki' name='d'> &nbsp; Laki-laki
                        <input class="ml-3" type='radio' value='Perempuan' name='d' checked> &nbsp; Perempuan
                      </div>

                    <?php }
                    ?>

                  </div>

                  <div class="form-group">
                    <label>No. Telp</label>
                    <input class='number form-control' type='number' name='l' min="0" minlength="10" value='<?= $row['no_telp']; ?>' required>
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