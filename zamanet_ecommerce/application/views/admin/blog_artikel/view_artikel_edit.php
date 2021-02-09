<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ubah Artikel</h3>
            </div>

            <form action="<?= base_url('admin/edit_artikel') ?>" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <input type='hidden' name='id' value='<?= $rows['id_artikel'] ?>'>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Judul</label>
                  <div class="col-sm-10">
                    <input type='text' class='form-control' name='judul' value="<?= $rows['judul'] ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Sub Judul</label>
                  <div class="col-sm-10">
                    <input type='text' class='form-control' name='sub' value="<?= $rows['sub_judul'] ?>">
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select name='kat' class='form-control' required>
                      <?php
                      foreach ($record->result_array() as $row) {
                        if ($rows['id_kategori'] == $row['id_kategori']) {
                          echo "<option value='$row[id_kategori]' selected>$row[nama_kategori]</option>";
                        } else {
                          echo "<option value='$row[id_kategori]'>$row[nama_kategori]</option>";
                        }
                      }
                      ?>

                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Isi Artikel</label>
                  <div class="col-sm-10">
                    <textarea id="summernote" class='form-control' name='isi' style='height:350px' required><?= $rows['isi_artikel'] ?></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Gambar</label>
                  <div class="col-sm-6">
                    <div class="custom-file">
                      <input type='file' class='custom-file-input' name='gbr'>
                      <label class="custom-file-label" for="customFileLangHTML" data-browse="Cari">Pilih gambar...</label>
                    </div>
                  </div>
                </div>

                <?php
                if ($rows['gambar'] != '') { ?>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gambar Saat Ini</label>
                    <div class="col-sm-6">
                      <img src="<?= base_url('assets/images/artikel/') . $rows['gambar'] ?>" alt="" style="height: 150px">
                    </div>
                  </div>
                <?php } ?>


                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Ket. Gambar</label>
                  <div class="col-sm-10">
                    <input type='text' class='form-control' name='ketgbr' value="<?= $rows['keterangan_gambar'] ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tag</label>
                  <div class="col-sm-10">
                    <div class='checkbox-scroll'>
                      <?php
                      $_arrNilai = explode(',', $rows['tag']);
                      foreach ($tag->result_array() as $tag) {
                        $_ck = (array_search($tag['tag_seo'], $_arrNilai) === false) ? '' : 'checked';
                        echo "<span style='display:block;'><input type=checkbox value='$tag[tag_seo]' name=tag[] $_ck>$tag[nama_tag] &nbsp; &nbsp; &nbsp; </span>";
                      }
                      ?></div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type='submit' name='submit' class='btn btn-primary btn-sm'>Perbarui</button>
                    <a href='<?= base_url('admin/artikel') ?>'><button type='button' class='btn btn-secondary btn-sm ml-1'>Batal</button></a>
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