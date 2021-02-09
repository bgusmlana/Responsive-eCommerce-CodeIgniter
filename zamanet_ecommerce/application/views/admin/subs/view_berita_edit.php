<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Berita</h3>
            </div>


            <div class="card-body">

              <table class="table table-borderless" style="width: 100%">
                <tr>
                  <th style="width: 80px">Judul</th>
                  <td>: &nbsp; <?= $rows['judul_berita'] ?></td>
                </tr>
                <tr>
                  <th>tanggal</th>
                  <td>: &nbsp; <?= $rows['tgl'] ?></td>
                </tr>
                <tr>
                  <th>Isi</th>
                  <td>: &nbsp; <?= $rows['isi_berita'] ?></td>
                </tr>
              </table>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <a href='<?= base_url('admin/newsletter') ?>'><button type='button' class='btn btn-secondary btn-sm ml-1'>Kembali</button></a>
                </div>
              </div>

            </div>


          </div>
        </div>
      </div>
    </div>
  </section>
</div>