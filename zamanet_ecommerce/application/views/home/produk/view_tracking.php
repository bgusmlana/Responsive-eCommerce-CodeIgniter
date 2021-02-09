<div class="row">
  <div class="col-md-6 mx-auto">
    <?= $this->session->flashdata('message') ?>
    <h5>Cek Status Pesanan</h5>
    <p>Masukan no. invoice pada pada form dibawah ini.</p>
    <form method="POST" action="<?= base_url('konfirmasi/tracking') ?>">
      <div class="input-group mb-3">
        <input type="text" name="kode" class="form-control" placeholder="INV-0000000000" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
        <div class="input-group-append">
          <button class="btn btn-primary" name="submit1" type="submit">cek invoice</button>
        </div>
      </div>
    </form>

  </div>
</div>