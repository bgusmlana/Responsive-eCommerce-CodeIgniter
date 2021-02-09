<?php
$tanggal = tgl_indo($record['tanggal']);
?>
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="block post post--layout--classic">
            <div class="post__header post-header post-header--layout--classic">
                <h1 class="post-header__title"><?= $record['judul'] ?></h1>
                <div class="post-header__meta">
                    <div class="post-header__meta-item">Oleh <a href="#"><?= $record['nama_lengkap'] ?></a></div>
                    <div class="post-header__meta-item"><a href="#"><?= $record['hari'] . ", " . $tanggal ?></a></div>
                    <div class="post-header__meta-item"><a href="#"><?= $record['jam'] ?> WIB</a></div>
                    <div class="post-header__meta-item">dibaca <a href="#"><?= $record['dibaca'] ?>x</a></div>
                </div>
            </div>
            <div class="post__featured"><a href="#"><img src="<?= base_url('assets/images/artikel/') . $record['gambar'] ?>" alt=""></a></div>
            <div class="post__content typography">
                <?= $record['isi_artikel'] ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="block block-sidebar block-sidebar--position--end">

            <div class="block-sidebar__item">
                <div class="widget-categories widget-categories--location--blog widget">
                    <h4 class="widget__title">Kategori</h4>
                    <ul class="widget-categories__list" data-collapse data-collapse-opened-class="widget-categories__item--open">

                        <?php
                        $kategori = $this->model_app->view('tb_blog_kategori');
                        foreach ($kategori->result_array() as $row) {
                        ?>

                            <li class="widget-categories__item" data-collapse-item>
                                <div class="widget-categories__row"><a href="<?= base_url('artikel/kategori/') . $row['kategori_seo']; ?>"><svg class="widget-categories__arrow" width="6px" height="9px">
                                            <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#arrow-rounded-right-6x9">
                                            </use>
                                        </svg> <?= $row['nama_kategori']; ?></a></div>
                            </li>

                        <?php } ?>

                    </ul>
                </div>
            </div>
            <div class="block-sidebar__item">
                <div class="widget-posts widget">
                    <h4 class="widget__title">Artikel Terbaru</h4>
                    <div class="widget-posts__list">


                        <?php

                        $no = 1;
                        $this->db->order_by('tanggal', 'ASC');
                        $this->db->order_by('jam', 'ASC');
                        $this->db->limit(5);
                        $query = $this->db->get('tb_blog_artikel');
                        foreach ($query->result_array() as $rowz) {
                            $isi_artikel = strip_tags($rowz['isi_artikel']);
                            $isi = substr($isi_artikel, 0, 100);
                            $isi = substr($isi_artikel, 0, strrpos($isi, " "));
                            $tanggal = tgl_indo($rowz['tanggal']);
                            if ($rowz['gambar'] == '') {
                                $foto = 'small_no-image.jpg';
                            } else {
                                $foto = $rowz['gambar'];
                            }

                        ?>

                            <div class="widget-posts__item">
                                <div class="widget-posts__image"><a href="<?= base_url('artikel/detail/') . $rowz['judul_seo'] ?>"><img src="<?= base_url('assets/images/artikel/') . $foto  ?>" alt=""></a></div>
                                <div class="widget-posts__info">
                                    <div class="widget-posts__name"><a href="<?= base_url('artikel/detail/') . $rowz['judul_seo'] ?>"><?= $rowz['judul'] ?></a></div>
                                    <div class="widget-posts__date"><?= $tanggal ?></div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>