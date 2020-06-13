<?php
if (!empty($data)) {
	$i = 0;
	foreach ($data as $row) {
		$i += 1;
		$tarif = $row['cost'][0]['value'];
		$service = $row['service'];
		$deskripsi = $row['description'];
		$waktu = $row['cost'][0]['etd'] ? $row['cost'][0]['etd'] : "-";
?>

		<input onclick="show2();" type="radio" name="service" class="service" data-id="<?php echo $i; ?>" value="<?php echo $service; ?>" /> &nbsp; <?php echo $deskripsi; ?> <br /> <span class="ml-4">(Rp <?php echo number_format($tarif, 0); ?> , <?php echo $waktu; ?> hari)</span> <br />
		<hr>

		<input type="hidden" name="tarif" id="tarif<?php echo $i; ?>" value="<?php echo $tarif; ?>" />

	<?php
	}
	?>
<?php }

if ($ongkir == '0') { ?>

	<input type="radio" name="service" class="service" data-id="1" value="Bayar di Toko" onclick="show2();" /> &nbsp; Pembayaran di Toko <br>
	<small class="text-danger pr-3">
		Pembayaran dilakukan di toko kami pada jam kerja dibawah ini.<br>
		<table class="table table-sm table-borderless">

			<tr>
				<th>Hari</th>
				<td>: Senen - Sabtu</td>
			</tr>
			<tr>
				<th>Waktu</th>
				<td>: Pukul 09.00 - 16.00 Wib</td>
			</tr>
		</table>

	</small>

	<input type="hidden" name="tarif" id="tarif1" value="0" />


<?php } ?>


<script>
	$(document).ready(function() {
		$(".service").each(function(o_index, o_val) {
			$(this).on("change", function() {
				var did = $(this).attr('data-id');
				var tarif = $("#tarif" + did).val();
				$("#ongkir").val(tarif);
				hitung();
			});
		});
	});
</script>