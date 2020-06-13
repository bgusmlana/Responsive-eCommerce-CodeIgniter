<div class="block">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3 d-flex">
        <div class="account-nav flex-grow-1">
          <ul>
            <li class="account-nav__item"><a href="<?= base_url('members/dashboard') ?>">Dashboard</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/edit_profile') ?>">Ubah Profil</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/edit_alamat') ?>">Ubah Alamat</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/riwayat_belanja') ?>">Riwayat Transaksi</a></li>
            <li class="account-nav__item account-nav__item--active"><a href="<?= base_url('members/password') ?>">Ganti Password</a></li>
            <li class="account-nav__item"><a href="javascript:void(0)" onclick="logout()">Keluar</a></li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-lg-9 mt-4 mt-lg-0">
        <div class="card">
          <div class="card-header">
            <h5>Ganti Password</h5>
          </div>
          <div class="card-divider"></div>
          <div class="card-body">
            <div class="row no-gutters">
              <div class="col-12 col-lg-7 col-xl-6">

                <?= $this->session->flashdata('message') ?>

                <form action="<?= base_url('members/password') ?>" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label>Password Baru</label>
                    <input class='form-control' type='password' name='pass1'>
                    <?= form_error('pass1', '<small class="text-danger ml-1">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input class='form-control' type='password' name='pass2'>
                    <?= form_error('pass2', '<small class="text-danger ml-1">', '</small>'); ?>
                  </div>

                  <hr>

                  <?= $this->session->flashdata('message1') ?>

                  <div class="form-group">
                    <label><b>Password Saat Ini</b></label>
                    <input class='form-control' type='password' name='pass'>
                    <?= form_error('pass', '<small class="text-danger ml-1">', '</small>'); ?>
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