<?php
if ($record->num_rows() == '0') { ?>
  <div class='text-center mt-3 mb-5'>
    <h3>Maaf, Keranjang belanja anda saat ini masih kosong</h3><br>
    <a class='btn btn-primary' href='<?= base_url('produk') ?>'>Klik disini Untuk mulai belanja.</a>
  </div>
<?php } else {
?>


  <div class="row">

    <div class="col-md-12 mb-2">
      <h5> Keranjang Belanja</h5>
    </div>

    <div class="col-md-8">
      <div class="card w-100">
        <div class="card-body">
          <table class="table table-borderless">

            <?php
            $i = 1;
            $qty_product = $record->num_rows();
            foreach ($record->result_array() as $row) {
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

              <tr>
                <td>
                  <img src="<?= base_url('assets/images/produk/') . $foto_produk; ?>" alt="" style="height:60px;">
                </td>

                <td>
                  <a href="<?= base_url('produk/detail/') . $row['produk_seo']; ?>"><?= $row['nama_produk'] ?></a> <br>
                  <form action="<?= base_url('keranjang/update2/') . encrypt_url($row['id_penjualan_detail']); ?> ?>." method="POST">
                    <input name="id_penjualan_detail" type="hidden" value="<?= $row['id_penjualan_detail']; ?>">
                    <input type="hidden" id="stock_<?= $i ?>" value="<?= $row['stok'] ?>">
                    <div class="input-number mt-1" style="width: 150px">
                      <input name="jumlah" style="height:30px;" class="form-control input-number__input" type="number" min="1" value="<?= $row['jumlah'] ?>" id="quantity_<?= $i ?>">
                      <a href="javascript:void(0)" class="input-number__add" id="plus_<?= $i ?>"></a>

                      <?php
                      if ($row['jumlah'] == 1) {
                        $display = 'none';
                      } else {
                        $display = 'block';
                      }
                      echo "<span style='display: " . $display . "'>";
                      ?>
                      <a href="javascript:void(0)" class="input-number__sub" id="minus_<?= $i ?>"></a>
                      <?php echo "</span>"; ?>


                    </div>
                    <span id="save_<?= $i ?>" style="display: none"></span>
                  </form>

                </td>

                <td style="width: 160px">

                  Rp <span class="float-right">
                    <?= rupiah($sub_total) ?>
                    <a href="<?= base_url() . "keranjang/delete/" . encrypt_url($row['id_penjualan_detail']);  ?>">
                      <button type="button" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon">
                        <svg width="10px" height="10px">
                          <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#cross-10"></use>
                        </svg>
                      </button>
                    </a>
                  </span>
                </td>


              </tr>

            <?php $i++;
            } ?>


          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card w-100">
        <div class="card-body">

          <table class="cart__totals">
            <tfoot class="cart__totals-footer">
              <tr>
                <?php
                $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-(b.diskon*a.jumlah)) as total, sum(b.berat*a.jumlah) as total_berat FROM `tb_toko_penjualantemp` a JOIN tb_toko_produk b ON a.id_produk=b.id_produk where a.session='" . $this->session->idp . "'")->row_array();
                ?>
                <th>Total</th>
                <td>Rp <?= rupiah($total['total']); ?></td>
              </tr>
            </tfoot>
          </table><a class="btn btn-success btn-sm btn-block cart__checkout-button" href="<?= base_url('keranjang/checkouts') ?>">Proses checkout</a>
        </div>
      </div>
    </div>

  </div>


<?php } ?>

<input type="hidden" id="qty_product" value="<?= $qty_product ?>">
<script src="<?= base_url('assets/template/js/cart.js') ?>"></script>