<div class="content-wrapper">

  <section class="content mb-5 mt-5">
    <div class="container-fluid">
      <div class="row">

        <?php
        $produk = $this->db->query('SELECT * FROM tb_toko_produk');
        $pengguna = $this->db->query("SELECT * FROM tb_pengguna WHERE level='2'");
        $penjualan = $this->db->query('SELECT * FROM tb_toko_penjualan WHERE proses="3"');
        $artikel = $this->db->query('SELECT * FROM tb_blog_artikel');
        ?>


        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $produk->num_rows(); ?></h3>
              <p>Produk</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!-- 
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               -->
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $penjualan->num_rows(); ?></h3>
              <p>Penjualan</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $pengguna->num_rows(); ?></h3>
              <p>Konsumen</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>

          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $artikel->num_rows(); ?></h3>
              <p>Artikel</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>

          </div>
        </div>


      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <?php include 'grafik_pengunjung.php'; ?>
        </div>

        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Produk Paling Banyak Terjual</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

              <?php

              $data = $this->db->select('tb_toko_penjualandetail.id_produk,tb_toko_penjualan.proses, tb_toko_produk.nama_produk, SUM(tb_toko_penjualandetail.jumlah) as total')
                ->from('tb_toko_penjualandetail')
                ->join('tb_toko_penjualan', 'tb_toko_penjualan.id_penjualan=tb_toko_penjualandetail.id_penjualan')
                ->join('tb_toko_produk', 'tb_toko_produk.id_produk=tb_toko_penjualandetail.id_produk')
                ->where(array('tb_toko_penjualan.proses' => '3'))
                ->order_by('total', 'desc')
                ->limit(5)
                ->group_by('tb_toko_penjualandetail.id_produk')
                ->get();

              ?>

              <canvas id="pieChart" style="height:250px; min-height:250px"></canvas>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

</div>


<?php

foreach ($data->result() as $pie) {
  $nama[] = $pie->nama_produk;
  $total[] = (float) $pie->total;
}


?>

<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/chart.js/Chart.min.js"></script>
<script>
  $(function() {
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
      labels: <?php echo json_encode($nama); ?>,
      datasets: [{
        data: <?php echo json_encode($total); ?>,
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
      }]
    }
    var pieOptions = {
      maintainAspectRatio: !0,
      responsive: !0,
      legend: {
        display: !0,
        position: 'right'
      }
    }
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
  })
</script>