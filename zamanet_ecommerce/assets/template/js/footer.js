var table_name;
$(document).ready(function () {

    $('#table1').dataTable({
        "bInfo": false,
        "lengthChange": false,
        "paging": true,
        "searching": true,
        "scrollX": true,
        "ordering": false,
        "language": {
            "url": site_url + "assets/adminlte/dist/indonesia.json"
        }
    });

    $('.select2').select2({
        theme: 'classic'
    })

    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

});

$('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
});

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