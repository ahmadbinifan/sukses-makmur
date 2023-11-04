<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Faktur Penjualan</title>
	<style>
		body {
			font-size: 20px;
			line-height: 30px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
			transform: scale(1);
			transform-origin: 0 0;
		}

		/* table,
		th,
		td {
			border: 1px solid black;
			border-collapse: collapse;
		} */

		.head-timbangan {
			border-top: 2px solid black;
			border-bottom: 2px solid black;
		}

		@media print {
			body {
				font-size: 20px;
				font-weight: bold;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
				transform: scale(1);
				transform-origin: 0 0;
			}

			.row {
				margin-top: 15px;
			}


		}
	</style>
</head>

<body>
	<center><span style="font-weight: bold">KP. SELAMAT MAKMUR</span>
		<br>
		<span style="font-size : 17px; margin-left: 4px">Jl. AMD / Bajenis Tebing Tinggi</span>
		<br>
		<span style="font-size : 17px; margin-left: 4px">NO HP. 0822 7957 2457 - 0852 6240 8736</span>
	</center>
	<hr>
	<table width="100%">
		<tbody>
			<tr>
				<td style="max-width: 20px;">Kode Slip</td>
				<td>: <?= $jual->kode_slip ?></td>
				<td></td>
				<td style="max-width: 30px;">Tanggal : <?= $jual->tanggal ?></td>
			</tr>
			<tr>
				<td style="max-width: 20px;">No. Polisi</td>
				<td>: <?= $jual->no_polisi ?></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style="max-width: 20px;">Nama Barang</td>
				<td>: <?= $jual->nama_barang ?></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style="max-width: 20px;">Nama Relasi</td>
				<td>: <?= $jual->nama_relasi ?></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table width="100%" style="border-collapse:collapse;">
		<tbody>
			<tr>
				<td colspan="4" class="head-timbangan">Jam Print</td>
				<td colspan="3" class="head-timbangan">Timbangan</td>
			</tr>
			<tr>
				<td><?= date('H:i') ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td>Berat Bruto</td>
				<td>:</td>
				<td align="right"> <?= number_format($jual->bruto) ?> KG</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>Berat Tara</td>
				<td>:</td>
				<td align="right"> <?= number_format($jual->tara) ?> KG</td>
			</tr>
			<tr>
				<td>Harga / Kg</td>
				<td style="width: 5%;">: Rp. </td>
				<td align="right" style="font-weight: bold; font-size: 22px;"><?= number_format($jual->harga) ?></td>
				<td style="width: 100px;"></td>
				<td>Berat Netto1</td>
				<td>:</td>
				<td align="right"> <?= number_format($jual->netto1) ?> KG</td>
			</tr>
			<tr>
				<td>Total Harga</td>
				<td>: Rp. </td>
				<td align="right" style="font-weight: bold; font-size: 22px;"><?= number_format($jual->total) ?></td>
				<td></td>
				<td style="border-bottom: 2px solid black;">Potongan</td>
				<td style="border-bottom: 2px solid black;">:</td>
				<td style="border-bottom: 2px solid black;" align="right"> <?= number_format($jual->potongan) ?> KG</td>
			</tr>
			<tr>
				<td style="border-bottom: 2px solid black;"></td>
				<td style="border-bottom: 2px solid black;"></td>
				<td style="border-bottom: 2px solid black;"></td>
				<td style="border-bottom: 2px solid black;"></td>
				<td style="border-bottom: 2px solid black;">Berat Netto2</td>
				<td style="border-bottom: 2px solid black;">:</td>
				<td style="border-bottom: 2px solid black;" align="right"> <?= number_format($jual->netto2) ?> KG</td>
			</tr>
		</tbody>
	</table>
	<span>Keterangan : <?= $jual->keterangan ?></span>
	<center>
		<div class="row">
			<span style="width:50px;height:70px;margin-right:200px;">
				Hormat Kami
			</span>
			<span style="width:50px;height:70px;margin-right:210px;">
				Diketahui Oleh
			</span>
			<span style="width:50px;height:70px;margin-right:100;">
				Diterima Oleh
			</span>
			<br><br><br>
			<span style="width:80px;height:70px;margin-right:205px;">___________</span>
			<span style="width:80px;height:70px;margin-right:215px;">___________</span>
			<span>___________</span>
			<br>
			<span style="width:50px;height:70px;margin-right:270px;">
				Admin
			</span>
			<span style="width:50px;height:70px;margin-right:350px;">
				Supir
			</span>

		</div>
	</center>
	<!-- <div class="row">
		<span style="font-weight: bold; font-size: 17px">NB: Maaf, Barang yang sudah dibeli tidak bisa ditukar / dikembelikan</span>
	</div> -->
	<script>
		document.onkeyup = KeyCheck;

		function KeyCheck(e) {
			var KeyID = (window.event) ? event.keyCode : e.keyCode;
			if (KeyID == 13) {
				window.print()
			}
		}
	</script>
</body>

</html>