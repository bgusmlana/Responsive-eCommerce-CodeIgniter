<div class="row">
  <div class="col-sm-12 col-md-8 mx-auto">
    <?= $this->session->flashdata('message') ?>
    <form action="<?= base_url('konfirmasi/form') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">

      <input type='hidden' name='id' value='<?= $rows['id_penjualan'] ?>'>

      <div class="mb-3 mt-2">
        <h4>Konfirmasi Pembayaran</h4>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label">No. Invoice</label>
        <div class="col-md-9">
          <input type='text' name='a' class='form-control' value='<?= $rows['kode_transaksi'] ?>' placeholder='INV-0000000000' required>
        </div>
      </div>

      <?php
      if ($rows['kode_transaksi'] != '') { ?>

        <div class="form-group row">
          <label class="col-md-3 col-form-label">Total Bayar</label>
          <div class="col-md-9">
            <input type='text' name='b' class='form-control' value="Rp <?= rupiah($total['total'] + $total['ongkir'] + $total['kode_unik']); ?>" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label">Transfer Ke</label>
          <div class="col-md-9">
            <select name='c' class='form-control' required>
              <option value='' selected>-- Pilih</option>
              <?php
              foreach ($record->result_array() as $row) { ?>
                <option value='<?= $row['id_rekening'] ?>'><?= $row['nama_bank'] . '&nbsp; - &nbsp;' . $row['no_rekening'] ?> (<?= $row['pemilik_rekening'] ?>)</option>

              <?php }
              ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label">Nama Pengirim</label>
          <div class="col-md-9">
            <input type='text' class='form-control' name='d' value='<?= $ksm['nama_lengkap'] ?>' required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label">Tanggal Transfer</label>
          <div class="col-md-9">
            <td><input type='text' class='datepicker form-control' name='e' data-date-format='yyyy-mm-dd' value='<?= date(' Y-m-d') ?>' autocomplete="off" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label">Bukti Transfer</label>
          <div class="col-md-9">

            <div class="custom-file">
              <input style='text-transform:lowercase;' type="file" class="custom-file-input" name="userfile" required>
              <label class="custom-file-label" for="customFileLangHTML" data-browse="Pilih">Pilih file..</label>
            </div>
            <small>Silahkan pilih file dengan format <b class="text-danger">jpg/png</b>, ukuran maksimal <b class="text-danger">2mb</b></small>

          </div>
        </div>


      <?php } ?>

      <div class="form-group row">
        <label class="col-md-3 col-form-label"></label>
        <div class="col-md-9">
          <button type='submit' name='submit' class='btn btn-primary btn-sm float-right'>Kirimkan</button>
        </div>
      </div>


    </form>
  </div>
</div>