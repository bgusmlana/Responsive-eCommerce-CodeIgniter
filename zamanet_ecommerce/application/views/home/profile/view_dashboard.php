<?php
if (trim($record['foto']) == '') {
  $foto_user = 'default.jpg';
} else {
  $foto_user = $record['foto'];
}
?>


<div class="block">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3 d-flex">
        <div class="account-nav flex-grow-1">
          <ul>
            <li class="account-nav__item  account-nav__item--active"><a href="<?= base_url('members/dashboard') ?>">Dashboard</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/edit_profile') ?>">Ubah Profil</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/edit_alamat') ?>">Ubah Alamat</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/riwayat_belanja') ?>">Riwayat Transaksi</a></li>
            <li class="account-nav__item"><a href="<?= base_url('members/password') ?>">Ganti Password</a></li>
            <li class="account-nav__item"><a href="javascript:void(0)" onclick="logout()">Keluar</a></li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-lg-9 mt-4 mt-lg-0">
        <div class="dashboard">
          <div class="dashboard__profile card profile-card">
            <div class="card-body profile-card__body">


              <div class="profile-card__avatar">
                <div class="foto-container">
                  <img src="<?= base_url('assets/images/user/') . $foto_user ?>" class="foto-image">
                  <div class="foto-middle">
                    <a href="#" data-toggle="modal" data-target="#uploadfoto" title="Ganti foto">
                      <img src="<?= base_url('assets/images/icon/camera.png') ?>" style="width: 50px">
                    </a>
                  </div>
                </div>
              </div>

              <div class="profile-card__name"><?= $record['nama_lengkap'] ?></div>
              <div class="profile-card__email"><?= $record['email'] ?></div>
              <div class="profile-card__edit">
                <a href="<?= base_url('members/edit_profile') ?>" class="btn btn-secondary btn-sm">Ubah Profile</a>
              </div>
            </div>
          </div>
          <div class="dashboard__address card address-card address-card--featured">

            <div class="address-card__body">
              <div class="address-card__name"><?= $record['nama_lengkap'] ?></div>
              <?php if ($rows['alamat'] == '') { ?>
                <p class="text-justify">Anda belum mengubah alamat.<br> Silahkan ubah alamat Anda.</p>
              <?php } else { ?>
                <div class="address-card__row">
                  <?= $rows['alamat'] ?><br>
                  Kec. <?= $rows['kecamatan'] ?><br>
                  <?= $rows['nama_kota'] ?>, <?= $rows['kode_pos'] ?>
                </div>
              <?php } ?>

              <div class="address-card__row">
                <div class="address-card__row-title">Nomor Telepon</div>
                <div class="address-card__row-content"><?= $record['no_telp'] ?></div>
              </div>
              <div class="address-card__row">
                <div class="address-card__row-title">Email</div>
                <div class="address-card__row-content"><?= $record['email'] ?></div>
              </div>
              <div class="address-card__row">
                <div class="address-card__row-title">Username</div>
                <div class="address-card__row-content"><?= $record['username'] ?></div>
              </div>
              <div class="address-card__footer"><a href="<?= base_url('members/edit_alamat') ?>">Ubah Alamat</a></div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>