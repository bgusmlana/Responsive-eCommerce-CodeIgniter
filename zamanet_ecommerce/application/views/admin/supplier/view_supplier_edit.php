<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Kategori</h3>
            </div>

            <form action="<?= base_url('admin/edit_supplier'); ?>" method="post">
              <div class="card-body">

                <input type='hidden' name='id' value='<?= $rows['id_supplier']; ?>'>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama Supplier</label>
                  <div class="col-sm-10">
                    <input type='text' class='form-control' name='a' value='<?= $rows['nama_supplier']; ?>' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kontak Person</label>
                  <div class="col-sm-10">
                    <input type='text' class='form-control' name='b' value='<?= $rows['kontak_person']; ?>' required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Alamat Lengkap</label>
                  <div class="col-sm-10"> <textarea class='form-control' name='c' required><?= $rows['alamat_lengkap']; ?></textarea>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type='email' class='form-control' name='e' value='<?= $rows['alamat_email']; ?>'>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kode Pos</label>
                  <div class="col-sm-10">
                    <input type='number' class='form-control' name='f' value='<?= $rows['kode_pos']; ?>'>
                  </div>
                </div>



                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No. Telp</label>
                  <div class="col-sm-10">
                    <input type='number' class='form-control' name='g' value='<?= $rows['no_telpon']; ?>'>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Fax</label>
                  <div class="col-sm-10">
                    <input type='number' class='form-control' name='h' value='<?= $rows['fax']; ?>'>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Keterangan</label>
                  <div class="col-sm-10">
                    <textarea class='form-control' name='i'><?= $rows['katerangan']; ?></textarea>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type='submit' name='submit' class='btn btn-primary btn-sm'>Perbarui</button>
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