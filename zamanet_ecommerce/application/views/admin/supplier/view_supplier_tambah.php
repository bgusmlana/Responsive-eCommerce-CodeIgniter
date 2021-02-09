<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Supplier</h3>
            </div>

            <form action="<?= base_url('admin/tambah_supplier'); ?>" method="post">
              <div class="card-body">

                <input type='hidden' name='id' value=''>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Supplier</label>
                  <div class="col-sm-6">
                    <input type='text' class='form-control' name='a' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kontak Person</label>
                  <div class="col-sm-6">
                    <input type='text' class='form-control' name='b' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alamat Lengkap</label>
                  <div class="col-sm-6">
                    <textarea class='form-control' name='c' required></textarea>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-6">
                    <input type='email' class='form-control' name='e'>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kode Pos</label>
                  <div class="col-sm-6">
                    <input type='number' class='form-control' name='f'></div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No Telp</label>
                  <div class="col-sm-6">
                    <input type='number' class='form-control' name='g'>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Fax</label>
                  <div class="col-sm-6">
                    <input type='number' class='form-control' name='h'>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Keterangan</label>
                  <div class="col-sm-6">
                    <textarea class='form-control' name='i'></textarea>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type='submit' name='submit' class='btn btn-primary btn-sm'>Simpan</button>
                    <a href='<?= base_url('admin/supplier'); ?>'><button type='button' class='btn btn-secondary btn-sm ml-1'>Batal</button></a>
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