<p class='sidebar-title'><span class='glyphicon glyphicon-triangle-right'></span> Detail Pesanan Anda</p>
<table class='table table-condensed'>
  <tbody>
    <?php if (trim($rows['foto']) == '') {
      $foto_user = 'users.gif';
    } else {
      $foto_user = $rows['foto'];
    } ?>
    <tr bgcolor='#e3e3e3'>
      <td rowspan='12' width='110px'>
        <center><?php echo "<img style='border:1px solid #cecece; height:85px; width:85px' src='" . base_url() . "assets/images/user/$foto_user' class='img-circle img-thumbnail'>"; ?></center>
      </td>
    </tr>
    <tr>
      <th scope='row' width='120px'>Nama Reseller</th>
      <td><?php echo $rows['nama_reseller'] ?></td>
    </tr>
    <tr>
      <th scope='row'>Alamat</th>
      <td><?php echo $rows['alamat_lengkap'] ?></td>
    </tr>
    <tr>
      <th scope='row'>No Hp</th>
      <td><?php echo $rows['no_telpon'] ?></td>
    </tr>
    <tr>
      <th scope='row'>Alamat Email</th>
      <td><?php echo $rows['email'] ?></td>
    </tr>
    <tr>
      <th scope='row'>Keterangan</th>
      <td><?php echo $rows['keterangan'] ?></td>
    </tr>
  </tbody>
</table>
<hr>

<table class="table table-striped">
  <thead>
    <tr bgcolor='#e3e3e3'>
      <th style='width:40px'>No</th>
      <th width='50%'>Nama Produk</th>
      <th>Harga</th>
      <th>Qty</th>
      <th>Berat</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($record as $row) {
      $sub_total = ($row['harga_jual'] * $row['jumlah']) - $row['diskon'];
      echo "<tr><td>$no</td>
                    <td>$row[nama_produk]</td>
                    <td>" . rupiah($row['harga_jual']) . "</td>
                    <td>$row[jumlah]</td>
                    <td>" . ($row['berat'] * $row['jumlah']) . " Kg</td>
                    <td>Rp " . rupiah($sub_total) . "</td>
                </tr>";
      $no++;
    }
    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `tb_toko_penjualandetail` a JOIN tb_toko_produk b ON a.id_produk=b.id_produk where a.id_penjualan='" . $this->uri->segment(3) . "'")->row_array();
    if ($rows['proses'] == '0') {
      $proses = '<i class="text-danger">Pending</i>';
      $status = 'Proses';
    } elseif ($rows['proses'] == '1') {
      $proses = '<i class="text-success">Proses</i>';
    } else {
      $proses = '<i class="text-info">Konfirmasi</i>';
    }
    echo "<tr class='success'>
                  <td colspan='5'><b>Total Harga</b></td>
                  <td><b>Rp " . rupiah($total['total']) . "</b></td>
                  <td></td>
                </tr>

                <tr class='success'>
                  <td colspan='5'><b>Total Berat</b></td>
                  <td><b>$total[total_berat] Kg</b></td>
                  <td></td>
                </tr>
                <tr class='warning'><td align=center colspan='5'><b>$proses</b></td></tr>

        </tbody>
      </table>";
