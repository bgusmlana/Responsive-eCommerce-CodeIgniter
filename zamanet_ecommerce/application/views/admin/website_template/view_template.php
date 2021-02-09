<div class="content-wrapper mt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Atur Template</h3>
                        </div>

                        <form action="<?= base_url('admin/template') ?>" method="post">
                            <div class="card-body">

                                <input type='hidden' name='id' value='<?= $rows['id_template'] ?>'>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Warna</label>
                                    <div class="col-sm-6">


                                        <?php

                                        if ($rows['warna'] == 'biru') {
                                            $biru = 'checked';
                                            $hijau = '';
                                            $merah = '';
                                            $kuning = '';
                                            $hitam = '';
                                        } else if ($rows['warna'] == 'hijau') {
                                            $hijau = 'checked';
                                            $biru = '';
                                            $merah = '';
                                            $kuning = '';
                                            $hitam = '';
                                        } else if ($rows['warna'] == 'merah') {
                                            $merah = 'checked';
                                            $hijau = '';
                                            $biru = '';
                                            $kuning = '';
                                            $hitam = '';
                                        } else if ($rows['warna'] == 'kuning') {
                                            $kuning = 'checked';
                                            $hijau = '';
                                            $merah = '';
                                            $biru = '';
                                            $hitam = '';
                                        } else if ($rows['warna'] == 'hitam') {
                                            $hitam = 'checked';
                                            $hijau = '';
                                            $merah = '';
                                            $kuning = '';
                                            $biru = '';
                                        }

                                        ?>

                                        <div class="icheck-primary">
                                            <input type="radio" name="warna" value="biru" id="radio1" <?= $biru ?>>
                                            <label for="radio1" class="text-primary">Biru</label>
                                        </div>

                                        <div class="icheck-success">
                                            <input type="radio" name="warna" value="hijau" id="radio2" <?= $hijau ?>>
                                            <label for="radio2" class="text-success">Hijau</label>
                                        </div>

                                        <div class="icheck-danger">
                                            <input type="radio" name="warna" value="merah" id="radio3" <?= $merah ?>>
                                            <label for="radio3" class="text-danger">Merah</label>
                                        </div>

                                        <div class="icheck-warning">
                                            <input type="radio" name="warna" value="kuning" id="radio4" <?= $kuning ?>>
                                            <label for="radio4" class="text-warning">Kuning</label>
                                        </div>

                                        <div class="icheck-dark">
                                            <input type="radio" name="warna" value="hitam" id="radio5" <?= $hitam ?>>
                                            <label for="radio5" class="text-dark">Hitam</label>
                                        </div>


                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type='submit' name='submit' class='btn btn-primary btn-sm'>Perbarui</button>
                                        <a href='<?= base_url('admin') ?>'><button type='button' class='btn btn-secondary btn-sm ml-1'>Kembali</button></a>
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