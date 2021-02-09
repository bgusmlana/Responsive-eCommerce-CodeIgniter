<?php
if (trim($row['gambar']) == '') {
    $foto_produk = 'no-image.png';
} else {
    $foto_produk = $row['gambar'];
}
$produk = $row['nama_produk'];

?>

<div class="product product--layout--standard" data-layout="standard">
    <div class="product__content">

        <div class="product__gallery">
            <div class="product-gallery">
                <div class="product-gallery__featured"><button class="product-gallery__zoom"><svg width="24px" height="24px">
                            <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#zoom-in-24"></use>
                        </svg></button>
                    <div class="owl-carousel" id="product-image"><a href="<?= base_url() . "assets/images/produk/" . $foto_produk ?>" target="_blank"><img src="<?= base_url() . "assets/images/produk/" . $foto_produk ?>" alt="" class="w-75 mx-auto"> </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="product__info">

            <h1 class="product__name"><?= $row['nama_produk'] ?></h1>
            <div class="product__rating">
                <div class="product__rating-stars">
                    <div class="rating">
                        <div class="rating__body">


                            <?php
                            $idpro = $row['id_produk'];
                            $query = $this->db->query("SELECT * FROM tb_ulasan WHERE id_produk='$idpro'");
                            $bin  = $this->db->query("SELECT SUM(bintang) AS totalbintang FROM tb_ulasan WHERE id_produk='$idpro'")->row_array();
                            $jml_rev = $query->num_rows();

                            $jml_bintang = $bin['totalbintang'] / $jml_rev;

                            if ($jml_rev == 0) {
                                for ($y = 0; $y <  5; $y++) { ?>

                                    <svg class="rating__star" width="13px" height="12px">
                                        <g class="rating__fill">
                                            <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#star-normal"></use>
                                        </g>
                                    </svg>

                                <?php }
                            } else {
                                for ($y = 0; $y <  $jml_bintang; $y++) { ?>
                                    <svg class="rating__star rating__star--active" width="13px" height="12px">
                                        <g class="rating__fill">
                                            <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#star-normal"></use>
                                        </g>
                                    </svg>
                                <?php }
                                for ($y = 0; $y <  5 - $jml_bintang; $y++) { ?>
                                    <svg class="rating__star rating__star" width="13px" height="12px">
                                        <g class="rating__fill">
                                            <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#star-normal"></use>
                                        </g>
                                    </svg>
                            <?php }
                            } ?>


                        </div>
                    </div>
                </div>
                <?php if ($jml_rev > 0) { ?>
                    <div class="product__rating-legend"><a href="#"><?= $jml_rev ?> Ulasan</a><span></div>
                <?php } else { ?>
                    <div class="product__rating-legend"><a href="#">Belum ada ulasan</a><span></div>
                <?php } ?>
            </div>

            <div class="product__description text-justify"><?= $row['keterangan'] ?></div>

            <ul class="product__meta">
                <li class="product__meta-availability">Stok: <span class="text-success" id="product-stock"><?= $row['stok'] ?></span></li>

            </ul>
        </div>

        <div class=" product__sidebar">

            <div class="product__prices">

                <?php if ($row['diskon'] == '0') { ?>
                    Rp <?= rupiah($row['harga_konsumen']) ?>
                <?php } else { ?>
                    <small><del>Rp <?= rupiah($row['harga_konsumen']) ?></del></small>
                    Rp <?= rupiah($row['harga_konsumen'] - $row['diskon']) ?>
                <?php } ?>

            </div>
            <form id="product-form" class="product__options">

                <div class="form-group product__option">
                    <input type="hidden" name="id_produk" value="<?= encrypt_url($row['id_produk']) ?>">
                    <label class="product__option-label" for="product-quantity">Jumlah</label>
                    <div class="product__actions">
                        <div class="product__actions-item">
                            <div class="input-number product__quantity"><input id="product-quantity" class="input-number__input form-control form-control-lg" type="number" min="1" value="1" name="jumlah">
                                <div class="input-number__add"></div>
                                <div class="input-number__sub"></div>
                            </div>
                        </div>
                        <div class="product__actions-item product__actions-item--addtocart">
                            <a href="javascript:void(0)" class="btn btn-primary btn-lg" onclick="add2cart()">Tambah ke keranjang</a>
                        </div>
                    </div>
                </div>
            </form><!-- .product__options / end -->
        </div><!-- .product__end -->
        <div class="product__footer text-center">



        </div>

        <?php
        $this->db->where('id_identitas', '1');
        $ident = $this->db->get('tb_web_identitas');

        foreach ($ident->result() as $ids) {
            $nomer = $ids->no_telp;
        }
        ?>

        <div class="text-center border-top border-dark">
            <a href="https://api.whatsapp.com/send?phone=<?= $nomer ?>&text=Apakaha%20<?= $row['nama_produk'] ?>%20masih tersedia?" target="_blank" title="Tanyakan Stok">
                <img src="<?= base_url('assets/images/icon/wa1.png') ?>" alt="">
            </a>
        </div>

    </div>



    <div class="reviews-view mt-5">
        <div class="reviews-view__list">
            <h3 class="reviews-view__header">Ulasan Pelanggan</h3>
            <div class="reviews-list">
                <ol class="reviews-list__content">

                    <?php
                    $idpro = $row['id_produk'];
                    $this->db->join('tb_pengguna', 'tb_pengguna.id_pengguna = tb_ulasan.id_pembeli');
                    $this->db->join('tb_toko_produk', 'tb_toko_produk.id_produk = tb_ulasan.id_produk');
                    $query = $this->db->get_where('tb_ulasan', "tb_ulasan.id_produk='$idpro'");
                    if ($query->num_rows() >= 1) {
                        foreach ($query->result_array() as $rev) {
                            if (empty($rev['foto'])) {
                                $foto = 'default.jpg';
                            } else {
                                $foto = $rev['foto'];
                            } ?>

                            <li class="reviews-list__item">
                                <div class="review">
                                    <div class="review__avatar">
                                        <img src="<?= base_url('assets/images/user/' . $foto) ?>" alt=""></div>
                                    <div class="review__content">
                                        <div class="review__author"><?= $rev['username'] ?></div>
                                        <div class="review__rating">
                                            <div class="rating">
                                                <div class="rating__body">

                                                    <?php
                                                    for ($x = 0; $x < $rev['bintang']; $x++) { ?>

                                                        <svg class="rating__star rating__star--active" width="13px" height="12px">
                                                            <g class="rating__fill">
                                                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#star-normal"></use>
                                                            </g>
                                                        </svg>

                                                    <?php }
                                                    for ($x = 0; $x < 5 - $rev['bintang']; $x++) { ?>

                                                        <svg class="rating__star rating__star" width="13px" height="12px">
                                                            <g class="rating__fill">
                                                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#star-normal"></use>
                                                            </g>
                                                        </svg>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="review__text">
                                            <?= $rev['ulasan'] ?>
                                        </div>
                                        <div class="review__date"><?= tgl_grafik($rev['tanggal_ulasan']) ?></div>
                                    </div>
                                </div>
                            </li>

                        <?php }
                    } else { ?>

                        <p>Belum ada ulasan, beli produk ini untuk memberi ulasan</p>

                    <?php } ?>
                </ol>

            </div>
        </div>

        <?php
        if (!empty($this->session->id_pengguna)) { ?>



            <?php
            $idpeng = $this->session->id_pengguna;
            $queryx = $this->db->query("SELECT * FROM tb_toko_penjualan a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan WHERE b.id_produk='$idpro' AND a.id_pembeli='$idpeng' AND a.proses='3'");
            if ($queryx->num_rows() >= 1) {

                $id = $this->session->id_pengguna;
                $this->db->where("id_pengguna='$id'");
                $peng = $this->db->get('tb_pengguna')->row_array();
                if (empty($peng['nama_lengkap'])) {
                    $nama = $peng['username'];
                } else {
                    $nama = $peng['nama_lengkap'];
                }

                if (empty($peng['foto'])) {
                    $foto = 'default.jpg';
                } else {
                    $foto = $peng['foto'];
                }
            ?>

                <form class="reviews-view__form" action="<?= base_url('produk/review/') ?>" method="POST">
                    <h3 class="reviews-view__header">Tulis Ulasan</h3>
                    <div class="row">
                        <div class="col-12 col-lg-9 col-xl-8">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="review-stars">Bintang</label>
                                    <select name='bintang' id="review-stars" class="form-control">
                                        <option value="5">5 Bintang</option>
                                        <option value="4">4 Bintang</option>
                                        <option value="3">3 Bintang</option>
                                        <option value="2">2 Bintang</option>
                                        <option value="1">1 Bintang</option>
                                    </select></div>
                                <div class="form-group col-md-4">
                                    <label for="review-author">Username</label>
                                    <input type="hidden" name="pembeli" value="<?= encrypt_url($id) ?>">
                                    <input type="hidden" name="produk" value="<?= encrypt_url($row['id_produk']) ?>">
                                    <input type="hidden" name="seo" value="<?= $row['produk_seo'] ?>">
                                    <input type="text" class="form-control" id="review-author" value="<?= $peng['username'] ?>" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="review-email">Email</label>
                                    <input type="text" class="form-control" id="review-email" value="<?= $peng['email'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="review-text">Ulasan Anda</label>
                                <textarea name="ulasan" class="form-control" id="review-text" rows="6"></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">Tulis Ulasan</button>
                            </div>
                        </div>
                    </div>
                </form>
        <?php }
        } ?>

    </div>

</div>

<?php $temp_sales = $this->db->get_where('tb_toko_penjualantemp', array('session' => $this->session->idp, 'id_produk' => $idpro))->row_array();
if (!empty($temp_sales)) {
    $number_cart = $temp_sales['jumlah'];
} else {
    $number_cart = 0;
} ?>

<input type="hidden" id="number-cart" value="<?= $number_cart; ?>">
<script src="<?= base_url('assets/template/js/product.js') ?>"></script>