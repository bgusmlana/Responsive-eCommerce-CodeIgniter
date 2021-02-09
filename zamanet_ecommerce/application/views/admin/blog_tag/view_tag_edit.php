<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ubah Tag artikel</h3>
            </div>

            <form action="<?= base_url('admin/edit_tag_artikel') ?>" method="post" enctype="multipart">
              <div class="card-body">
                <input type='hidden' name='id' value='<?= $rows['id_tag'] ?>'>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tag</label>
                  <div class="col-sm-6">
                    <input type='text' class='form-control' name='a' value='<?= $rows['nama_tag'] ?>' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type='submit' name='submit' class='btn btn-primary btn-sm'>Perbarui</button>
                    <a href='<?= base_url('admin/tag_artikel') ?>'><button type='button' class='btn btn-secondary btn-sm ml-1'>Batal</button></a>
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