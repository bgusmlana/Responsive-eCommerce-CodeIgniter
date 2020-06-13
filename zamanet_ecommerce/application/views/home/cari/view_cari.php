<?php if ($this->input->post('cari') != '') { ?>

    <div class="row">
        <div class="col-12">
            <div class="block">

                <?php if ($record->num_rows() == 0) { ?>

                    <h5>Maaf produk yang anda cari tidak tersedia.</h5>

                <?php } else { ?>

                    <div class="products-view">
                        <div class="products-view__list products-list" data-layout="grid-4-full" data-with-features="false">
                            <div class="products-list__body">
                                <?php
                                $no = 1;
                                foreach ($record->result_array() as $row) {
                                    if (trim($row['gambar']) == '') {
                                        $foto_produk = 'no-image.png';
                                    } else {
                                        $foto_produk = $row['gambar'];
                                    }
                                    $stok = $row['stok'];
                                    if ($stok !== 0) {
                                ?>
                                        <div class="products-list__item shadow-lg">
                                            <div class="product-card">
                                                <input clas='post' id="id_produk" name="id_produk" type="hidden" value="<?= $row['id_produk'] ?>">
                                                <div class="product-card__image"><a href="<?= base_url('produk/detail/') . $row['produk_seo']; ?>">
                                                        <img src="<?= base_url('assets/images/produk/') . $foto_produk; ?>" alt=""></a></div>
                                                <div class="product-card__info mb-3">
                                                    <div class="product-card__name"><a href="<?= base_url('produk/detail/') . $row['produk_seo']; ?>"><?= $row['nama_produk']; ?></a></div>
                                                    <div class="product-card__prices">
                                                        <?php if ($row['diskon'] == '0') { ?>
                                                            Rp <?= rupiah($row['harga_konsumen']) ?>
                                                        <?php } else { ?>
                                                            <small><del>Rp <?= rupiah($row['harga_konsumen']) ?></del></small>
                                                            Rp <?= rupiah($row['harga_konsumen'] - $row['diskon']) ?>
                                                        <?php } ?>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
    <?= $this->pagination->create_links(); ?>

<?php } else { ?>

    <div class="row">
        <div class="col-md-6 mx-auto">


            <div class="px-5 py-5 shadow-lg" style="margin-top:25%;">
                <div class=" site-header__search">
                    <div class="search search--location--header">
                        <div class="search__body">
                            <form class="search__form" action="" method="POST">
                                <input class="search__input" name="cari" placeholder="Saya ingin mencari.." aria-label="Site search" type="text" autocomplete="off">
                                <button class="search__button search__button--type--submit" type="submit" name="submit">
                                    <svg width="20px" height="20px">
                                        <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#search-20"></use>
                                    </svg>
                                </button>
                                <div class="search__border"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

<?php } ?>