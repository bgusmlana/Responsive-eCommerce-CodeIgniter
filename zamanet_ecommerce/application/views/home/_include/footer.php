<footer class="site__footer">
    <div class="site-footer">
        <div class="container">

            <div class="site-footer__widgets">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="site-footer__widget footer-contacts text-justify pl-2">
                            <h5 class="footer-contacts__title">Kontak Kami</h5>

                            <?php $iden = $this->db->get_where('tb_web_identitas', "id_identitas='1'")->row_array(); ?>
                            <?php $id = $iden['kota_id'];
                            $kota = $this->db->get_where('tb_kota', "kota_id='$id'")->row_array(); ?>

                            <ul class="footer-contacts__contacts">
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td style="width: 20px"><i class="footer-contacts__icon fas fa-globe-americas"></i></td>
                                        <td><?= $iden['alamat'] ?> <br>
                                            <?= $kota['nama_kota'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="footer-contacts__icon far fa-envelope"></td>
                                        <td> <?= $iden['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="footer-contacts__icon fas fa-mobile-alt"></i></td>
                                        <td> <?= $iden['no_telp'] ?></td>
                                    </tr>
                                </table>
                            </ul>

                        </div>
                    </div>


                    <div class="col-6 col-md-6 col-lg-4">
                        <div class="site-footer__widget footer-links text-left pl-2">
                            <h5 class="footer-links__title">Informasi</h5>
                            <ul class="footer-links__list">
                                <?php
                                $menu = $this->model_menu->menu_bawah();
                                foreach ($menu->result_array() as $mb) {
                                ?>

                                    <li class="footer-links__item">
                                        <a href="<?= base_url($mb['link']) ?>" class="footer-links__link">
                                            <?= $mb['nama_menu']; ?>
                                        </a>
                                    </li>

                                <?php } ?>

                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="site-footer__widget footer-newsletter">
                            <h5 class="footer-newsletter__title">Newsletter</h5>
                            <div class="footer-newsletter__text">Berlangganan sekarang, dan dapatkan informasi terbaru dari kami.</div>
                            <form action="<?= base_url('subscribe') ?>" method="POST" class="footer-newsletter__form">
                                <label class="sr-only" for="footer-newsletter-address">Alamat Email</label>
                                <input name="email" type="text" class="footer-newsletter__form-input form-control" id="footer-newsletter-address" placeholder="Alamat Email...">
                                <button name="submit" type="submit" class="footer-newsletter__form-button btn btn-primary">Subscribe</button>
                            </form>
                            <div class="footer-newsletter__text footer-newsletter__text--social">Ikuti kami dimedia sosial</div>
                            <ul class="footer-newsletter__social-links">
                                <li class="footer-newsletter__social-link footer-newsletter__social-link--facebook">
                                    <a href="<?= $iden['facebook'] ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="footer-newsletter__social-link footer-newsletter__social-link--twitter">
                                    <a href="<?= $iden['twitter'] ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li class="footer-newsletter__social-link footer-newsletter__social-link--youtube">
                                    <a href="<?= $iden['youtube'] ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                <li class="footer-newsletter__social-link footer-newsletter__social-link--instagram">
                                    <a href="<?= $iden['instagram'] ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="site-footer__bottom">
                <div class="site-footer__copyright">&copy; <?= date('Y') ?> <a href="https://zamanet.com/" target="_BLANK">Zamanet</a></div>
                <div class="site-footer__payments"><img src="<?= base_url('assets/template/tema/') ?>images/payments.png" alt=""></div>
            </div>
        </div>


        <div class="totop">
            <div class="totop__body">
                <div class="totop__start"></div>
                <div class="totop__container container"></div>
                <div class="totop__end"><button type="button" class="totop__button"><svg width="13px" height="8px">
                            <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#arrow-rounded-up-13x8"></use>
                        </svg></button></div>
            </div>
        </div>
    </div>
</footer>