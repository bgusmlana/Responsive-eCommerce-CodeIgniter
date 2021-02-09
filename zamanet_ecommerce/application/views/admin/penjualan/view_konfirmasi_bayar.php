      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Konfirmasi pembayaran Masuk</h3>
                </div>
                <div class='box-body'>
                          <div class='col-md-12'>
                            <table id="example1" class='table table-hover table-condensed'>
                              <thead>
                                <tr>
                                  <th style="width: 5%">No</th>
                                  <th>Kode Transaksi</th>
                                  <th>Total Transfer</th>
                                  <th>Dari Rekening</th>
                                  <th>Ke Rekening</th>
                                  <th>Waktu Transfer</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $no = 1;
                                  foreach ($record->result_array() as $row){
                                  if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='1'){ $proses = '<i class="text-warning">Proses</i>'; }elseif($row['proses']=='2'){ $proses = '<i class="text-info">Konfirmasi</i>'; }else{ $proses = '<i class="text-success">Dikirim </i>'; }
                                  echo "<tr><td>$no</td>
                                            <td><a href='".base_url()."administrator/tracking/$row[kode_transaksi]'>$row[kode_transaksi]</a></td>
                                            <td style='color:red;'>$row[total_transfer]</td>
                                            <td>$row[nama_pengirim]</td>
                                            <td>$row[nama_bank]</td>
                                            <td>".tgl_indo($row['tanggal_transfer'])."</td>
                                            <td width='50px'><a class='btn btn-info btn-xs' title='Detail data pesanan' href='".base_url()."administrator/tracking/$row[kode_transaksi]'><span class='glyphicon glyphicon-search'></span></a></td>
                                         </tr>";
                                    $no++;
                                  }
                                ?>
                              </tbody>
                            </table>
                          </div>
                </div>
            </div>
        </div>