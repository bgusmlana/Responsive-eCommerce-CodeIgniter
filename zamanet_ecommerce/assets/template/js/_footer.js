function confirmation(ev) {
    ev.preventDefault();
    var data_id = ev.currentTarget.getAttribute('data-id');
    var currentLocation = window.location;
    Swal.fire({
        title: 'Konfirmasi Hapus Data',
        text: "Apakah Anda ingin menghapus data ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: currentLocation + '/delete/' + data_id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    Swal.fire({
                        title: 'Dihapus!',
                        text: 'Data berhasil dihapus',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        reload_table();
                    })
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.debug(jqXHR);
                    console.debug(textStatus);
                    console.debug(errorThrown);
                },
            });
        }
    })
}