<?php $iden = $this->db->query("SELECT * FROM tb_web_identitas where id_identitas='1'")->row_array(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/gijgo/css/gijgo.min.css') ?>">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  <script src="<?= base_url('assets/template/adminlte3/') ?>plugins/jquery/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="icon" type="image/png" href="<?= base_url('assets/images/favicon/') ?><?= $iden['favicon']; ?>">
  <link rel="stylesheet" href="<?= base_url('assets/template/css/'); ?>sweetalert2/sweetalert2.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/'); ?>plugins/select2/css/select2.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/'); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.css">
  <!-- Select2 -->
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/select2/js/select2.full.js"></script>
  <script>
    var site_url = "<?= base_url() ?>";
  </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>" target="_blank">
            <i class="fas fa-external-link-alt fa-fw"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <!-- Brand Logo -->
      <div class="bg-primary brand-link">
        <a href="">
          <img src="<?= base_url('assets/images/logo/logomini.png') ?>" alt="Zamanet" class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
          <span class="brand-text font-weight-light">
            <?php if ($this->session->level == 1) { ?>
              Super Admin <?php } else { ?>
              Administrator
            <?php } ?>
          </span>
        </a>
      </div>
      <!-- Sidebar -->
      <div class="sidebar">

        <?php
        $log = $this->model_pengguna->pengguna_edit($this->session->username)->row_array();
        if ($log['foto'] == '') {
          $foto = 'default.jpg';
        } else {
          $foto = $log['foto'];
        }
        echo "<div class='user-panel mt-3 pb-3 mb-3 d-flex'>
              <div class='image'>
                <img src='" . base_url() . "assets/images/user/$foto' class='img-circle elevation-2' alt='User Image'>
              </div>
              <div class='info text-center'>
                <a class='d-block'>$log[username]</a>
                <a class='d-block text-xs mt-1'><i class='fa fa-circle text-success'></i> Online</a>
              </div>
            </div>";
        ?>


        <?php include '_partials/sidebar.php' ?>

      </div>
    </aside>

    <?php echo $konten; ?>

    <footer class="main-footer">
      <strong>&copy; <?= date('Y') ?> <a href="https://zamanet.com" target="_BLANK">Zamanet</a></strong>
      <div class="float-right d-none d-sm-inline-block">

      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>dist/js/adminlte.min.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/datatables/jquery.dataTables.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/moment/moment.min.js"></script>
  <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="<?= base_url('assets/template/gijgo/js/gijgo.min.js') ?>"></script>
  <script src="<?= base_url('assets/template/js/'); ?>sweetalert2.min.js"></script>
  <script>
    function logout() {
      let timerInterval;
      Swal.fire({
        title: 'Konfirmasi Keluar',
        text: "Apakah Anda ingin keluar dari Akun ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.value) {
          Swal.fire({
              title: 'Berhasil!',
              text: 'Logout berhasil',
              icon: 'success',
              showConfirmButton: false,
              timer: 1500,
            })
            .then(() => {
              window.location.href = site_url + '/auth/logout'
            })
        }
      })
    }
  </script>

  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>



  <script>
    $('.datepicker').datepicker({
      uiLibrary: 'bootstrap4'
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#table1').dataTable({
        "bInfo": false,
        "lengthChange": false,
        "paging": true,
        "searching": true,
        "scrollX": true,
        "ordering": false,
      });
      $('#table2').dataTable({
        "bInfo": false,
        "lengthChange": false,
        "paging": true,
        "searching": false,
        "scrollX": true,
        "autoWidth": false,
        "ordering": false,
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      bsCustomFileInput.init();
    });
  </script>

  <script>
    $(document).ready(function() {

      //Initialize Select2 Elements
      $('.select2').select2({
        theme: 'bootstrap4'
      })
    });
  </script>


  <script>
    /** add active class and stay opened when selected */
    var url = window.location;
    // for sidebar menu entirely but not cover treeview 
    $('ul.nav-sidebar a').filter(function() {
      return this.href == url;
    }).addClass('active');
    // for treeview 
    $('ul.nav-treeview a').filter(function() {
      return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
  </script>

  <script>
    $('#summernote').summernote({
      tabsize: 2,
      height: 500
    });
  </script>

  <?php $this->model_main->kunjungan(); ?>
</body>

</html>