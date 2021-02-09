<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Kirim Berita</h3>
            </div>

            <form action="<?= base_url('admin/tambah_newsletter') ?>" method="post" enctype="multipart">
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

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type='submit' name='submit' class='btn btn-primary btn-sm'>Kirim</button>
                    <a href='<?= base_url('admin/newsletter') ?>'><button type='button' class='btn btn-secondary btn-sm ml-1'>Batal</button></a>
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