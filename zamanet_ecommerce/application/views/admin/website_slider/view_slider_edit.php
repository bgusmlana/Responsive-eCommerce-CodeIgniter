<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Slider</h3>
            </div>

            <form action="<?= base_url('admin/edit_slider') ?>" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <input type='hidden' name='id' value='<?= $rows['id_slide'] ?>'>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Judul</label>
                  <div class="col-sm-6">
                    <input type="text" name="judul" id="" class="form-control" value="<?= $rows['judul'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Link</label>
                  <div class="col-sm-6">
                    <input type="text" name="link" id="" class="form-control" value="<?= $rows['link'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Keterangan</label>
                  <div class="col-sm-6">
                    <textarea class='form-control' name='ket' style='height:120px'><?= $rows['ket'] ?></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Gambar Dekstop</label>
                  <div class="col-sm-6">
                    <div class="custom-file">
                      <input type='file' class='custom-file-input' name="file1">
                      <label class="custom-file-label" for="customFileLangHTML" data-browse="Cari">Pilih gambar...</label>
                      <small><span class="text-danger">*</span>Rekomendasi ukuran 840 px &#10005; 395 px</small><br>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-6">
                    <img class='img-thumbnail' style='height:100px' src='<?= base_url('assets/images/slider/') . $rows['gambar_besar'] ?>'>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Gambar Mobile</label>
                  <div class="col-sm-6">
                    <div class="custom-file">
                      <input type='file' class='custom-file-input' name="file2">
                      <label class="custom-file-label" for="customFileLangHTML" data-browse="Cari">Pilih gambar...</label>
                      <small><span class="text-danger">*</span>Rekomendasi ukuran 510 px &#10005; 395 px</small><br>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-6">
                    <img class='img-thumbnail' style='height:100px' src='<?= base_url('assets/images/slider/') . $rows['gambar_kecil'] ?>'>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type='submit' name='submit' class='btn btn-primary btn-sm'>Perbarui</button>
                    <a href='<?= base_url('admin/slider') ?>'><button type='button' class='btn btn-secondary btn-sm ml-1'>Batal</button></a>
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