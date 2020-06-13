<p class='sidebar-title'> History Orderan Anda</p>
              <table id='example1' class='table table-hover table-condensed'>
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>No Invoice</th>
                    <th>Total Belanja</th>
                    <th>Status</th>
                    <th>Waktu Transaksi</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='1'){ $proses = '<i class="text-warning">Proses</i>'; }elseif($row['proses']=='2'){ $proses = '<i class="text-info">Konfirmasi</i>'; }else{ $proses = '<i class="text-success">Dikirim </i>'; }
                    $total = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='$row[kode_transaksi]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td><a href='".base_url()."konfirmasi/tracking/$row[kode_transaksi]'>$row[kode_transaksi]</a></td>
                              <td style='color:red;'>Rp ".rupiah($total['total']+$total['ongkir']+substr($row['kode_transaksi'],-3))."</td>
                              <td>$proses</td>
                              <td>".cek_terakhir($row['waktu_transaksi'])." lalu</td>
                              <td width='50px'><a class='btn btn-info btn-xs' title='Detail data pesanan' href='".base_url()."konfirmasi/tracking/$row[kode_transaksi]'><span class='glyphicon glyphicon-search'></span></a></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                </tbody>
              </table>
