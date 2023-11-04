<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">History Penjualan Dedak</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">History Penjualan Dedak</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<div class="content">
		<?= $this->session->flashdata('msg') ?>
		<div class="container-fluid">
			<div class="card">
				<div class="card-body">
					<form id="form-filter" target="_blank" class="form-horizontal" action="<?php echo base_url() . 'History_Penjualan_dedak/exportPdf/'; ?>" method="post">
						<div class="row mb-2">
							<label class="col-2 col-md-3">Period</label>
							<div class="col-3 col-md-3">
								<input type="date" class="form-control" name="start" id="start" placeholder="Choice Start Date" />
							</div>
							<label class="col-6 col-md-2">To</label>
							<div class="col-md-3 col-6">
								<input type="date" class="form-control" name="end" id="end" onchange="listRelasi()" placeholder=" Choice End Date" />
							</div>
						</div>
						<div class="form-group row mb-2">
							<label class="col-6 col-md-3">Nama relasi</label>
							<div class="col-md-4 col-6">
								<select name="nama_relasi" class="form-control select2" id="nama_relasi" />
								<option value="" selected>Pilih Relasi</option>
								</select>
							</div>
						</div>
						<div class="float-right">
							<button type="button" id="btn-filter" class="btn btn-primary ">Filter
								<i class="fas fas fa-filter"></i></button>
							<button type="submit" name="action" class="btn btn-danger">
								<i class="fas fas fa-file-pdf"></i> PDF
							</button>
							<button type="button" id="btn-reset" class="btn btn-default">Reset
								<i class="fas fas fa-undo"></i></button>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<table class="table table-bordered table-condensed" style="font-size:11px;" id="table">
										<thead>
											<tr>
												<th style="text-align:center;width:40px;">No</th>
												<th>Kode Slip</th>
												<th>Nama Relasi</th>
												<th>Tanggal</th>
												<th>Netto2</th>
												<th>Total</th>
												<th style="width:100px;text-align:center;">Aksi</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="modalDetail" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5>Detail Penjualan Dedak</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="col-12 mb-2">
					<table width="100%">
						<tbody>
							<tr>
								<td>Kode Slip</td>
								<td style="width: 10px;">:</td>
								<td style="width: 300px;"> <span id="kode_slip"></span></td>
								<td>Tanggal</td>
								<td style="width: 10px;">:</td>
								<td><span id="tanggal"></span></td>
							</tr>
							<tr>
								<td>No. Polisi</td>
								<td style="width: 10px;">:</td>
								<td style="width: 300px;"> <span id="no_polisi"></span></td>
								<td>Nama Barang</td>
								<td style="width: 10px;">:</td>
								<td><span id="nama_barang"></span></td>
							</tr>
							<tr>
								<td>Nama Relasi</td>
								<td style="width: 10px;">:</td>
								<td colspan="4"><span id="nama_relasix"></span></td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td style="width: 10px;">:</td>
								<td colspan="4"><span id="keterangan"></span></td>
							</tr>
							<tr>
								<td>Harga / KG</td>
								<td style="width: 10px;">:</td>
								<td colspan="4"> <span id="harga"></span></td>
							</tr>

						</tbody>
					</table>
				</div>
				<center style="font-weight: bold; font-style: italic; font-size: 18px">- Timbangan -</center>
				<table width="100%">
					<thead>
						<tr>
							<th style="border-bottom: 2px solid black;border-top: 2px solid black;" colspan="4">Jam Print</th>
							<th style="border-bottom: 2px solid black;border-top: 2px solid black;" colspan="3">Timbangan</th>
						</tr>
					</thead>
					<tbody id="tableDetail">
						<tr>
							<td colspan="4"><span id="tanggal_print"></span></td>
							<td>Berat Bruto</td>
							<td>:</td>
							<td align="right"><span id="bruto"></span></td>
						</tr>
						<tr>
							<td colspan="4"></td>
							<td>Berat Tara</td>
							<td>:</td>
							<td align="right"><span id="tara"></span></td>
						</tr>
						<tr>
							<td>Harga / KG</td>
							<td>: Rp.</td>
							<td align="right"><span id="harga2"></span></td>
							<td style="width: 10px;"></td>
							<td>Netto 1</td>
							<td>:</td>
							<td align="right"><span id="netto1"></span></td>
						</tr>
						<tr>
							<td>Total Harga</td>
							<td>: Rp.</td>
							<td align="right"><span class="text-right" id="total"></span></td>
							<td style="width: 10px;"></td>
							<td style="border-bottom: 2px solid black;">Potongan</td>
							<td style="border-bottom: 2px solid black;">:</td>
							<td align="right" style="border-bottom: 2px solid black;"><span id="potongan"></span></td>
						</tr>
						<tr>
							<td colspan="4"></td>
							<td>Berat Netto 2</td>
							<td>:</td>
							<td align="right"><span id="netto2"></span></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
<div id="modalDelete" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<form id="form-delete" action="<?= base_url('History_Penjualan_dedak/remove') ?>" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Hapus Transaksi</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="kode_slip">
					<p> Apakah anda yakin ingin menghapus transaksi <b><span id="kode_slip_r"></span></b> ? </p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#btn-filter').on('click', function() {
			table.page.len(-1).draw();
		});
		// var table;
		table = $('#table').DataTable({
			"scrollCollapse": true,
			"select": true,
			"processing": true,
			"serverSide": true,
			"retrieve": true,
			"bInfo": false,
			"ajax": {
				"url": "<?= base_url('History_Penjualan_dedak/list_ajax') ?>",
				"type": "POST",
				"data": function(data) {
					data.start = $('#start').val();
					data.end = $('#end').val();
					data.nama_relasi = $('#nama_relasi').val();
					// data.end = $('#end').val();

				}
			},

			"columnDefs": [{
				"targets": [0], //first column / numbering column
				"orderable": false,
			}, ],
			"ordering": true,
			lengthMenu: [
				[25, 50, 125, -1],
				['25 File', '50 File', '125 File', 'Show All']
			],

		});
	});
	$('#btn-filter').click(function() { //button filter event click
		table.ajax.reload(); //just reload table
	});
	$('#btn-reset').click(function() { //button reset event click
		let form = $('#form-filter');
		$('#form-filter')[0].reset();
		table.ajax.reload(); //just reload table
	});

	function get(id, type) {
		// console.log(id)
		$.ajax({
			url: "<?= base_url('History_Penjualan_dedak/get') ?>",
			method: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function(data) {
				const tanggal = new Date(data.header.tanggal)
				const tanggal_print = new Date(data.header.tanggal_print)
				const harga = new Intl.NumberFormat().format(data.header.harga)
				const bruto = new Intl.NumberFormat().format(data.header.bruto)
				const tara = new Intl.NumberFormat().format(data.header.tara)
				const netto1 = new Intl.NumberFormat().format(data.header.netto1)
				const netto2 = new Intl.NumberFormat().format(data.header.netto2)
				const potongan = new Intl.NumberFormat().format(data.header.potongan)
				const total = new Intl.NumberFormat().format(data.header.total)

				document.getElementById('kode_slip').innerHTML = data.header.kode_slip;
				document.getElementById('no_polisi').innerHTML = data.header.no_polisi;
				document.getElementById('tanggal').innerHTML = tanggal.toLocaleDateString('en-GB');
				document.getElementById('nama_barang').innerHTML = data.header.nama_barang;
				document.getElementById('nama_relasix').innerHTML = data.header.nama_relasi;
				document.getElementById('keterangan').innerHTML = data.header.keterangan;
				document.getElementById('harga').innerHTML = harga;
				document.getElementById('harga2').innerHTML = harga;
				document.getElementById('tanggal_print').innerHTML = tanggal_print.toLocaleTimeString('en-GB');
				document.getElementById('bruto').innerHTML = bruto;
				document.getElementById('tara').innerHTML = tara;
				document.getElementById('netto1').innerHTML = netto1;
				document.getElementById('potongan').innerHTML = potongan;
				document.getElementById('netto2').innerHTML = netto2;
				document.getElementById('total').innerHTML = total;
				document.getElementById('kode_slip_r').innerHTML = data.header.kode_slip;
				$("#form-delete").find('input[name=kode_slip]').val(data.header.kode_slip);
			},
			error: function(e) {
				console.log(e);
			}
		})
	}

	function listRelasi() {
		let select = $("#form-filter").find('select[name=nama_relasi]');
		console.log($('#start').val())
		$.ajax({
			url: "<?= base_url('History_Penjualan_dedak/list_relasi') ?>",
			method: "post",
			dataType: "json",
			data: {
				start: $('#start').val(),
				end: $('#end').val()
			},
			success: function(data) {
				if (data) {
					let html = '<option value="">Pilih Relasi (Optional)</option>';
					$.each(data, function(index, value) {
						html += '"<option value="' + value.nama_relasi + '">' + value.nama_relasi + '</option>';
					});
					$(select).html(html);

				}
			},
			error: function(e) {
				console.log(e);
			}
		})
	}
</script>