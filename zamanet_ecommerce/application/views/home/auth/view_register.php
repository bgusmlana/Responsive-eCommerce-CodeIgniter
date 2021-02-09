<div class="col-md-6 d-flex flex-column mt-md-0 mx-auto">
    <div class="card flex-grow-1 mb-0">
        <div class="card-body">
            <h4 class="card-title">Daftar Akun Baru</h4>
            <?= $this->session->flashdata('message') ?>
            <form action="<?= base_url('register'); ?>" method="post">

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="font-italic text-danger ml-1">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<small class="font-italic text-danger ml-1">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="<?= set_value('nama'); ?>">
                    <?= form_error('nama', '<small class="font-italic text-danger ml-1">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>No. Telp</label>
                    <input type="number" class="form-control" name="telp" value="<?= set_value('telp'); ?>">
                    <?= form_error('telp', '<small class="font-italic text-danger ml-1">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Kota Sekarang</label>
                    <select name="kota" class='form-control select2'>
                        <option value=""></option>
                        <?php $qkota = $this->db->get('tb_kota');
                        foreach ($qkota->result_array() as $kota) { ?>
                            <option value="<?= $kota['kota_id'] ?>"><?= $kota['nama_kota'] ?></option>
                        <?php } ?>
                    </select>
                    <?= form_error('kota', '<small class="font-italic text-danger ml-1">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name='password1'>
                    <?= form_error('password1', '<small class="font-italic text-danger ml-1">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Ulangi Password</label>
                    <input type="password" class="form-control" name='password2'>
                    <?= form_error('password2', '<small class="font-italic text-danger ml-1">', '</small>'); ?>
                </div>
                <hr>
                <button type="submit" name="submit" class="btn btn-primary mt-4">Daftar</button>
                <a class="btn btn-default mt-4 float-right" href='<?= base_url('login') ?>'>Sudah Punya Akun?</a>
            </form>
        </div>
    </div>
</div>