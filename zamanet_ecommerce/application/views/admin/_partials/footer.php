<footer class="main-footer">
    <strong>&copy; <?= date('Y') ?> <a href="https://zamanet.com" target="_BLANK">Zamanet.com</a></strong>
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


<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/sparklines/sparkline.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>dist/js/pages/dashboard.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>dist/js/demo.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>


<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').dataTable({
            paging: true,
            searching: true
        });
    });
</script>

</body>

</html>