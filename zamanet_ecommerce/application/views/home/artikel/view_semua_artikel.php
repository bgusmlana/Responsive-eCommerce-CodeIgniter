<div class="row">
    <div class="col-md-8">
        <div class="block">
            <div class="posts-view">
                <div class="posts-view__list posts-list posts-list--layout--grid2">

                    <div class="posts-list__body">


                        <?php

                        $no = 1;
                        foreach ($artikel->result_array() as $row) {
                            $isi_artikel = strip_tags($row['isi_artikel']);
                            $isi = substr($isi_artikel, 0, 100);
                            $isi = substr($isi_artikel, 0, strrpos($isi, " "));
                            $tanggal = tgl_indo($row['tanggal']);
                            if ($row['gambar'] == '') {
                                $foto = 'small_no-image.jpg';
                            } else {
                                $foto = $row['gambar'];
                            }

                        ?>
                            <div class="posts-list__item shadow-lg p-3 bg-white rounded">
                                <div class="post-card post-card--layout--grid post-card--size--nl">
                                    <a href="<?= base_url('artikel/detail/') . $row['judul_seo'] ?>">
                                        <div class="post-card__image"><img src="<?= base_url('assets/images/artikel/') . $foto  ?>" alt=""></div>
                                    </a>
                                    <div class="post-card__info">
                                        <div class="post-card__category"><?= $title ?></div>
                                        <div class="post-card__name"><a href="<?= base_url('artikel/detail/') . $row['judul_seo'] ?>"> <?= $row['judul'] ?> </a></div>
                                        <div class="post-card__date"><?= $row['hari'] . ", " . $tanggal ?></div>
                                        <div class="post-card__content"><?= $isi ?>..</div>

                                    </div>
                                </div>
                            </div>

                        <?php
                            $no++;
                        } ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
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
                        $kategori = $this->db->get('tb_blog_artikel');
                        foreach ($kategori->result_array() as $row) {
                            $isi_artikel = strip_tags($row['isi_artikel']);
                            $isi = substr($isi_artikel, 0, 100);
                            $isi = substr($isi_artikel, 0, strrpos($isi, " "));
                            $tanggal = tgl_indo($row['tanggal']);
                            if ($row['gambar'] == '') {
                                $foto = 'small_no-image.jpg';
                            } else {
                                $foto = $row['gambar'];
                            }

                        ?>

                            <div class="widget-posts__item">
                                <div class="widget-posts__image"><a href="<?= base_url('artikel/detail/') . $row['judul_seo'] ?>"><img src="<?= base_url('assets/images/artikel/') . $foto  ?>" alt=""></a></div>
                                <div class="widget-posts__info">
                                    <div class="widget-posts__name"><a href="#"><?= $title ?></a></div>
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