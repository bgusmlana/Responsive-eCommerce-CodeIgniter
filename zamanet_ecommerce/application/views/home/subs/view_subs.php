<div class="row">

  <div class="col-12 col-md-12 col-lg-5 mx-auto">
    <?= $this->session->flashdata('message') ?>
    <div class="site-footer__widget footer-newsletter">
      <h5 class="footer-newsletter__title">Newsletter</h5>
      <div class="footer-newsletter__text">Berlangganan sekarang, dan dapatkan informasi terbaru dari kami.</div>
      <form action="<?= base_url('subscribe') ?>" method="POST" class="footer-newsletter__form">
        <label class="sr-only" for="footer-newsletter-address">Alamat Email</label>
        <input name="email" type="text" class="footer-newsletter__form-input form-control" id="footer-newsletter-address" placeholder="Alamat Email...">
        <button name="submit" type="submit" class="footer-newsletter__form-button btn btn-primary">Subscribe</button>
        <br>
      </form>
      <?= form_error('email', '<small class="font-italic text-danger ml-1">', '</small>'); ?>

    </div>
  </div>

</div>