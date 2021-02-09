<div class="block block-posts block-posts--layout--list-sm" data-layout="list-sm">
    <div class="container">
        <div class="block-header">
            <h3 class="block-header__title">Artikel Terbaru</h3>
            <div class="block-header__divider"></div>
            <div class="block-header__arrows-list">
                <button class="block-header__arrow block-header__arrow--left" type="button">
                    <svg width="7px" height="11px">
                        <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#arrow-rounded-left-7x11"></use>
                    </svg></button> <button class="block-header__arrow block-header__arrow--right" type="button"><svg width="7px" height="11px">
                        <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#arrow-rounded-right-7x11"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="block-posts__slider">
            <div class="owl-carousel">

                <?php
                $no = 1;
                foreach ($artikel->result_array() as $row) {
                    $isi_artikel = strip_tags($row['isi_artikel']);
                    $isi = substr($isi_artikel, 0, 70);
                    $isi = substr($isi_artikel, 0, strrpos($isi, " "));
                    $tanggal = tgl_indo($row['tanggal']);
                    if ($row['gambar'] == '') {
                        $foto = 'small_no-image.jpg';
                    } else {
                        $foto = $row['gambar'];
                    }

                ?>

                    <div class="post-card">
                        <div class="post-card__image"><a href="<?= base_url('artikel/detail/') . $row['judul_seo'] ?>"><img src="<?= base_url('assets/images/artikel/') . $foto  ?>" alt=""></a>
                        </div>
                        <div class="post-card__info">
                            <div class="post-card__category"><a href="#"></a></div>
                            <div class="post-card__name"><a href="<?= base_url('artikel/detail/') . $row['judul_seo'] ?>"><?= $row['judul'] ?></a></div>
                            <div class="post-card__date"><?= $row['hari'] . ", " . $tanggal ?></div>
                            <div class="post-card__content"><?= $isi ?>..</div>

                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>