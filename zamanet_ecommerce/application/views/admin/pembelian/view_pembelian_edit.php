<div class="content-wrapper mt-3">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ubah Transaksi Pembelian</h3>
            </div>

            <form action="<?= base_url('admin/editb_toko_pembelian') ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
              <div class="card-body">

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Kode Pembelian</label>
                  <div class="col-sm-6">
                    <input type='text' class='form-control' value='<?php echo "$rows[kode_pembelian]"; ?>' name='a' readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Supplier</label>
                  <div class="col-sm-6">
                    <select class='form-control select2 w-100' name='b' required>
                      <?php
                      foreach ($supplier as $r) {
                        if ($r['id_supplier'] == $rows['id_supplier']) {
                          echo "<option value='$r[id_supplier]' selected>$r[nama_supplier]</option>";
                        } else {
                          echo "<option value='$r[id_supplier]'>$r[nama_supplier]</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Waktu Pembelian</label>
                  <div class="col-sm-6">
                    <input type='text' class='form-control' value='<?php echo "$rows[waktu_beli]"; ?>' name='c' readonly>
                  </div>
                </div>

                <input class='btn btn-primary btn-sm' type="submit" name='submit1' value='Perbarui'>
                <a class='btn btn-secondary btn-sm float-right' href='<?php echo base_url(); ?>admin/pembelian'>Kembali</a>
                <hr>
                <table class="table table-borderless table-condensed">
                  <thead>
                    <tr>
                      <th width="20px">No</th>
                      <th width="40%">Nama Produk</th>
                      <th>Harga Pesan</th>
                      <th>Jumlah Pesan</th>
                      <th>Satuan</th>
                      <th>Sub Total</th>
                      <th width="10%">Aksi</th>
                    </tr>
                  </thead>
                  <?php
                  echo "<tr>
                                <td></td>
                                <input type='hidden' value='" . $this->uri->segment(3) . "' name='idp'>
                                <input type='hidden' value='" . $this->uri->segment(4) . "' name='idpd'>
                                <td><select name='aa' class='form-control select2' onchange=\"changeValue(this.value)\" autofocus>
                                                                      <option value='' selected> Pilih Produk </option>";
                  $jsArray = "var prdName = new Array();\n";
                  foreach ($barang as $r) {
                    if ($r['id_produk'] == $row['id_produk']) {
                      echo "<option value='$r[id_produk]' selected>$r[nama_produk]</option>";
                      $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_beli']) . "',desc:'" . addslashes($r['satuan']) . "'};\n";
                    } else {
                      echo "<option value='$r[id_produk]'>$r[nama_produk]</option>";
                      $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_beli']) . "',desc:'" . addslashes($r['satuan']) . "'};\n";
                    }
                  }
                  echo "</select></td>
                                <td><input class='form-control' type='number' name='bb' value='$row[harga_pesan]' id='harga'> </td>
                                <td><input class='form-control' type='number' name='cc' value='$row[jumlah_pesan]'></td>
                                <td><input class='form-control' type='text' name='dd' id='satuan' value='$row[satuan]' readonly='on'> </td>
                                <td></td>
                                <td><button type='submit' name='submit' class='btn btn-success  btn-xs'><i class='fas fa-check fa-fw'></i></button>
                                    <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/editb_toko_pembelian/" . $this->uri->segment(3) . "'><i class='fas fa-times fa-fw'></i></a>
                                </td>
                              </tr>";
                  ?>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($record as $row) {
                      echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                              <td>Rp " . rupiah($row['harga_pesan']) . "</td>
                              <td>$row[jumlah_pesan]</td>
                              <td>$row[satuan]</td>
                              <td>Rp " . rupiah($row['harga_pesan'] * $row['jumlah_pesan']) . "</td>
                              <td>
                                <a class='btn btn-primary btn-xs' title='Ubah' href='" . base_url() . "admin/editb_toko_pembelian/" . $this->uri->segment(3) . "/$row[id_pembelian_detail]'><i class='fas fa-edit fa-fw'></i></a>
                                <a class='btn btn-danger btn-xs' title='Hapus' href='" . base_url() . "admin/delete_pembelian_detail/" . $this->uri->segment(3) . "/$row[id_pembelian_detail]' onclick=\"return confirm('Konfirmasi menghapus data?')\"><i class='fas fa-times fa-fw'></i></a>
                              </td>
                          </tr>";
                      $no++;
                    }

                    $total = $this->db->query("SELECT sum(a.harga_pesan*a.jumlah_pesan) as total FROM `tb_toko_pembeliandetail` a where a.id_pembelian='" . $this->uri->segment(3) . "'")->row_array();
                    echo "<tr class='success'>
                            <td colspan='5'><b>Total</b></td>
                            <td><b>Rp " . rupiah($total['total']) . "</b></td>
                          </tr>";
                    ?>
                  </tbody>
                </table>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  <?php echo $jsArray; ?>

  function changeValue(id) {
    document.getElementById('harga').value = prdName[id].name;
    document.getElementById('satuan').value = prdName[id].desc;
  };
</script>