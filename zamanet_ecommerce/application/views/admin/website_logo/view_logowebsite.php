<div class="content-wrapper mt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Logo Website</h3>
                        </div>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">

                                <?php
                                foreach ($record->result_array() as $row) { ?>
                                    <input type='hidden' name='id' value='<?= $row['id_logo'] ?>'>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Logo Terpasang</label>
                                        <div class="col-sm-6 bg-secondary">
                                            <a href="<?= base_url('assets/images/logo/') . $row['gambar'] ?>" target='_blank'>
                                                <img src="<?= base_url('assets/images/logo/') . $row['gambar'] ?>" height='100px'>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Ganti Logo</label>
                                        <div class="col-sm-6">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFileLangHTML" name="logo">
                                                <label class="custom-file-label" for="customFileLangHTML" data-browse="Cari">Pilih gambar...</label>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type='submit' name='submit' class='btn btn-primary btn-sm'>Simpan</button>
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