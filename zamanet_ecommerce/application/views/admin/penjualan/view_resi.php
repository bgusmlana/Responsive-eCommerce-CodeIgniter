<div class="content-wrapper mt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Input</h3>
                        </div>

                        <form action="<?= base_url('admin/resi'); ?>" method="post">

                            <div class="card-body">

                                <input type='hidden' name='id' value='<?= $rows['id_penjualan'] ?>'>

                                <input type='hidden' name='uri2' value='<?= $this->uri->segment(2); ?>'>
                                <input type='hidden' name='kode' value='<?= $this->uri->segment(5); ?>'>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Resi</label>
                                    <div class="col-sm-10">
                                        <input type='text' class='form-control' name='resi' value='<?= $rows['resi']; ?>' required>
                                    </div>
                                </div>

                                <button type='submit' name='submit' class='btn btn-primary btn-sm'>Simpan</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>