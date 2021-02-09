<div class="col-md-6 d-flex flex-column mx-auto">
    <div class="card flex-grow-1 mb-md-0">
        <div class="card-body">
            <h3 class="card-title">Ganti Password</h3>
            <?= $this->session->flashdata('message') ?>

            <form action="<?= base_url("auth/ganti_password?q=$code") ?>" method="post">
                <div class=" form-group"><label>Password Baru</label>
                    <input type="password" name="password1" class="form-control">
                    <?= form_error('password1', '<small class="text-danger ml-1">', '</small>'); ?>
                </div>

                <div class=" form-group"><label>Konfirmasi Password Baru</label>
                    <input type="password" name="password2" class="form-control">
                    <?= form_error('password2', '<small class="text-danger ml-1">', '</small>'); ?>
                </div>

                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">Ganti Password</button>


            </form>

        </div>
    </div>
</div>