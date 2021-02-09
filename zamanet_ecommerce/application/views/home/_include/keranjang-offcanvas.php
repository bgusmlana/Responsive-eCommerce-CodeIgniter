<div class="dropcart dropcart--style--offcanvas">
    <div class="dropcart__backdrop"></div>
    <div class="dropcart__body">
        <div class="dropcart__header">
            <div class="dropcart__title">Keranjang Belanja</div><button class="dropcart__close" type="button"><svg width="12px" height="12px">
                    <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#cross-12"></use>
                </svg></button>
        </div>

        <?php
        $recordx = $this->model_app->view_join_rows('tb_toko_penjualantemp', 'tb_toko_produk', 'id_produk', array('session' => $this->session->idp), 'id_penjualan_detail', 'ASC');
        if ($recordx->num_rows() == '0') { ?>
            <div class="dropcart__products-list">
                <div class="dropcart__product">
                    <div class="dropcart__product-info">
                        <div class="dropcart__product-name text-center py-3">
                            <h4>keranjang Kosong</h4> <br>
                            <a href="<?= base_url('produk') ?>" class="btn btn-primary text-white"> Belanja sekarang</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php } else {
        ?>

            <div class="dropcart__products-list">

                <?php
                $no = 1;
                foreach ($recordx->result_array() as $row) {
                    $sub_total = (($row['harga_jual'] - $row['diskon']) * $row['jumlah']);
                    if ($row['diskon'] != '0') {
                        $diskon = "<del style='color:red'>" . rupiah($row['harga_jual']) . "</del>";
                    } else {
                        $diskon = "";
                    }
                    if (trim($row['gambar']) == '') {
                        $foto_produk = 'no-image.png';
                    } else {
                        $foto_produk = $row['gambar'];
                    } ?>

                    <div class="dropcart__product">
                        <div class="dropcart__product-image"><a href="<?= base_url('produk/detail/') . $row['produk_seo']; ?>"><img src="<?= base_url('assets/images/produk/') . $foto_produk; ?>" alt=""></a>
                        </div>
                        <div class="dropcart__product-info">
                            <div class="dropcart__product-name"><a href="<?= base_url('produk/detail/') . $row['produk_seo']; ?>">
                                    <?= $row['nama_produk'] ?></a></div>
                            <div class="dropcart__product-meta">
                                <span class="dropcart__product-quantity"><?= $row['jumlah'] ?></span> x <span class="dropcart__product-price"><?= rupiah($row['harga_jual'] - $row['diskon']); ?></span></div>
                        </div>
                        <a href="<?= base_url() . "keranjang/delete/" . encrypt_url($row['id_penjualan_detail']);  ?>" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon">
                            <svg width="10px" height="10px">
                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#cross-10"></use>
                            </svg>
                        </a>
                    </div>

                <?php } ?>

            </div>
            <div class="dropcart__totals">
                <table>
                    <tr>
                        <?php
                        $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-(b.diskon*a.jumlah)) as total, sum(b.berat*a.jumlah) as total_berat FROM `tb_toko_penjualantemp` a JOIN tb_toko_produk b ON a.id_produk=b.id_produk where a.session='" . $this->session->idp . "'")->row_array();
                        ?>
                        <th>Subtotal</th>
                        <td>Rp <?= rupiah($total['total']); ?></td>
                    </tr>

                </table>
            </div>
            <div class="dropcart__buttons">
                <a class="btn btn-secondary" href="<?= base_url('keranjang') ?>">Keranjang</a>
                <a class="btn btn-primary" href="<?= base_url('keranjang/checkouts') ?>">Checkout</a>
            </div>
        <?php } ?>

    </div>
</div>