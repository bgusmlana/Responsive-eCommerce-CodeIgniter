<div class="col-md-6 d-flex flex-column mx-auto">
    <div class="card flex-grow-1 mb-md-0">
        <div class="card-body">
            <h5 class="card-title">Lupa Password ?</h5>
            <?= $this->session->flashdata('message') ?>
            <form action="<?= base_url('auth/lupa_password') ?>" method="post">

                <div class="form-group">
                    <input type="text" name="email" class="form-control" value="<?= set_value('email'); ?>" placeholder="Masukan email Anda">
                    <?= form_error('user_email', '<small class="text-danger ml-1">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4">Kirim</button>
            </form>
        </div>
    </div>
</div>