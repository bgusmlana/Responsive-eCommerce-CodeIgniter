var i;
var j = $('#qty_product').val();
$(document).ready(function () {


    for (i = 1; i <= j; i++) {

        $("#save_" + i).append('');

        $('#plus_' + i).click((function (a) {
            return function () {

                var stock = $("#stock_" + a).val();
                var qty = $("#quantity_" + a).val();

                if (parseInt(stock) <= parseInt(qty)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Stok Tidak Mencukupi',
                        text: 'Stok produk ini adalah ' + $("#stock_" + a).val(),
                        showConfirmButton: false,
                        timer: 2000,
                    })
                } else {
                    // $('#quantity_' + a).val(+$('#quantity_' + a).val() + 1);
                    $("#save_" + a).append('<button type="submit" id="save2_' + a + '"/>');
                    $('#save2_' + a).click();
                }

            }
        })(i))

        $('#minus_' + i).click((function (a) {
            return function () {
                if ($('#quantity_' + a).val() > 1) {
                    // $('#quantity_' + a).val(+$('#quantity_' + a).val() - 1);
                    $("#save_" + a).append('<button type="submit" id="save2_' + a + '"/>');
                    $('#save2_' + a).click();
                }
            }
        })(i))


        $('#quantity_' + i).change((function (a) {
            return function () {

                var stock = $("#stock_" + a).val();
                var qty = $("#quantity_" + a).val();

                if (parseInt(qty) == "" || parseInt(qty) <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Jumlah Tidak Valid',
                        showConfirmButton: false,
                        timer: 2000,
                    })
                    $('#quantity_' + a).val(1);
                } else if (parseInt(qty) > parseInt(stock)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Stok Tidak Mencukupi',
                        text: 'Stok produk ini adalah ' + parseInt(stock),
                        showConfirmButton: false,
                        timer: 2000,
                    })
                    $('#quantity_' + a).val(parseInt(stock));
                } else {
                    $("#save_" + a).append('<button type="submit" id="save2_' + a + '"/>');
                    $('#save2_' + a).click();
                }

            }
        })(i))

    }

})