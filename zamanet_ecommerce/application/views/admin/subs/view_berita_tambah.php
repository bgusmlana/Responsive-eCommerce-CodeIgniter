<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Kirim Berita</h3>
            </div>

            <form action="<?= base_url('admin/tambah_berita') ?>" method="post" enctype="multipart">
              <div class="card-body">

                <input type='hidden' name='id' value=''>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Judul</label>
                  <div class="col-sm-10">
                    <input type='text' class='form-control' name='judul'>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Isi</label>
                  <div class="col-sm-10">
                    <textarea id="summernote" class='form-control' name='berita'></textarea>
                  </div>
                </div>

                <button type='submit' name='submit' class='btn btn-primary btn-sm'>Kirim</button>
                <a href='<?= base_url('admin/berita') ?>'><button type='button' class='btn btn-secondary btn-sm float-right'>Batal</button></a>

              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>