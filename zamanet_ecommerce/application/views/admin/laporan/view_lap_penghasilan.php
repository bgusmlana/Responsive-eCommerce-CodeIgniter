<div class="content-wrapper mt-3">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Laporan Penjualan</h3>
                        </div>

                        <div class="card-body">



                            <table id="laptabel" class="table table-sm table-borderless" style="width:100%">

                                <thead>
                                    <tr>
                                        <td colspan="2">
                                            <button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <span class='caret'></span> Pilih Waktu </button>
                                            <div class='dropdown-menu' style='border:1px solid #cecece;'>
                                                <a class='dropdown-item' href='<?= base_url('admin/laporan/') ?>'>Semua</a>
                                                <a class=' dropdown-item' href='<?= base_url('admin/laporan_1') ?>'>Hari Ini</a>
                                                <a class=' dropdown-item' href='<?= base_url('admin/laporan_7') ?>'>7 hari terahir</a>
                                                <a class=' dropdown-item' href='<?= base_url('admin/laporan_30') ?>'>30 hari terakhir</a>
                                                <a class=' dropdown-item' href='<?= base_url('admin/laporan_tahun') ?>'>1 tahun terakhir</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Waktu Transaksi</th>
                                        <th>Kode Transaksi</th>
                                        <th>Total Belanja</th>
                                        <th>Pengiriman</th>
                                        <th>Kota Tujuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($record->result_array() as $row) {

                                        $total = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.resi, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `tb_toko_penjualan` a JOIN tb_toko_penjualandetail b ON a.id_penjualan=b.id_penjualan JOIN tb_toko_produk c ON b.id_produk=c.id_produk JOIN tb_pengguna d ON a.id_pembeli=d.id_pengguna where a.kode_transaksi='$row[kode_transaksi]'")->row_array();
                                        $kota = $this->db->query("SELECT a.nama_kota FROM `tb_kota` a JOIN tb_alamat b ON a.kota_id=b.id_kota where b.id_pengguna='$row[id_pembeli]'")->row_array();

                                    ?>
                                        <tr>
                                            <td><?= $no ?> </td>
                                            <td><?= $row['waktu_transaksi'] ?></td>
                                            <td><?= $row['kode_transaksi']; ?></td>
                                            <td style='color:red;'>Rp <?= rupiah($total['total'] + $total['ongkir']) ?></td>
                                            <td><span style='text-transform:uppercase'> <?= $total['kurir'] ?></span> <?= ($total['service']) ?></td>
                                            <td><?= $kota['nama_kota'] ?></td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('#laptabel').DataTable({
            "searching": false,
            "ordering": false,
            "bInfo": false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>