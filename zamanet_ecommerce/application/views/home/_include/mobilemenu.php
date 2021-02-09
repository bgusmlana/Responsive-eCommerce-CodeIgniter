<div class="mobilemenu">
    <div class="mobilemenu__backdrop"></div>
    <div class="mobilemenu__body">
        <div class="mobilemenu__header">
            <div class="mobilemenu__title">Menu</div><button type="button" class="mobilemenu__close"><svg width="20px" height="20px">
                    <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#cross-20"></use>
                </svg></button>
        </div>
        <div class="mobilemenu__content">
            <ul class="mobile-links mobile-links--level--0" data-collapse data-collapse-opened-class="mobile-links__item--open">


                <?php
                $menu = $this->model_menu->menu_main();
                foreach ($menu->result_array() as $row) {
                    ?>

                    <li class="mobile-links__item">
                        <div class="mobile-links__item-title">
                            <a href="<?= base_url() . $row['link'] ?>" class="mobile-links__item-link">
                                <?= $row['nama_menu'] ?>
                            </a>
                        </div>
                    </li>

                <?php } ?>


            </ul>
        </div>
    </div>
</div>