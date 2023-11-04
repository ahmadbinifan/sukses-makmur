<style>
	.ui-autocomplete {
		z-index: 1050;
		max-height: 200px;
		overflow-y: auto;
		overflow-x: hidden;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Penjualan Dedak</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Penjualan Dedak</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<center><?php echo $this->session->flashdata('msg'); ?></center>
			<div class="col-lg-12">
				<form action="<?= base_url('cashier_dedak/create') ?>" method="POST">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Kode Slip</label>
										<div class="col-sm-4" style="margin-right: 4em;">
											<input type="text" class="form-control" name="kode_slip" value="<?= $generate_kode ?>" readonly>
										</div>
										<label class="col-sm-2 col-form-label">Tanggal</label>
										<div class="col-sm-3">
											<input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">No. Polisi</label>
										<div class="col-sm-4 " style="margin-right: 4em;">
											<input type="text" class="form-control" name="no_polisi" placeholder="BK 1234 AA" required>
										</div>
										<label class="col-sm-2 col-form-label">Nama Barang</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" name="nama_barang" value="Dedak" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Nama Relasi</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="nama_relasi" placeholder="Nama Relasi" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Keterangan</label>
										<div class="col-sm-4">
											<textarea name="keterangan" class="form-control"></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Harga / Kg</label>
										<div class="col-sm-4">
											<input type="text" class="form-control text-right angka" id="harga" name="harga" placeholder="10.000" required>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<h3>Timbangan</h3>
							<div class="row">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Berat Bruto</label>
										<div class="col-sm-4">
											<div class="input-group-append">
												<input type="text" class="form-control text-right angka" id="bruto" name="bruto" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required>
												<span class="input-group-text">Kg</span>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Berat Tara</label>
										<div class="col-sm-4">
											<div class="input-group-append">
												<input type="text" class="form-control text-right angka" id="tara" name="tara" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required>
												<span class="input-group-text">Kg</span>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Berat Netto 1</label>
										<div class="col-sm-4">
											<div class="input-group-append">
												<input type="text" class="form-control text-right angka" readonly id="netto1" name="netto1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
												<span class="input-group-text">Kg</span>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Potongan</label>
										<div class="col-sm-4">
											<div class="input-group-append">
												<input type="text" class="form-control text-right angka" name="potongan" id="potongan" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
												<span class="input-group-text">Kg</span>
											</div>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Berat Netto 2</label>
										<div class="col-sm-4">
											<div class="input-group-append">
												<input type="text" class="form-control text-right angka" readonly id="netto2" name="netto2" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
												<span class="input-group-text">Kg</span>
											</div>
										</div>
										<label class="col-sm-2 col-form-label">Total Harga</label>
										<div class="col-sm-4">
											<input type="text" class="form-control text-right angka" readonly id="total" name="total">
										</div>
									</div>
									<hr>
									<div class="card-body">
										<div class="float-right">
											<button class="btn btn-success">Submit <i class="fa fa-paper-plane"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.angka').priceFormat({
			prefix: '',
			centsLimit: 0,
			thousandsSeparator: '.'
		});
		$('[id=harga]').on('keyup', function() {
			let bruto = $("#bruto").val().replace(/[^0-9]/g, '');
			let tara = $("#tara").val().replace(/[^0-9]/g, '');
			let netto2 = $("#netto2").val().replace(/[^0-9]/g, '');
			let harga = $("#harga").val().replace(/[^0-9]/g, '');
			let potongan = $("#potongan").val().replace(/[^0-9]/g, '');
			let netto1 = bruto - tara;
			total_netto2 = netto1 - potongan
			total = harga * netto2
			$("#total").val(total).trigger("keyup")
			$("#netto1").val(netto1).trigger("keyup")
			$("#netto2").val(total_netto2).trigger("keyup")

		})
		$('[id=tara]').on('keyup', function() {
			let bruto = $("#bruto").val().replace(/[^0-9]/g, '');
			let tara = $("#tara").val().replace(/[^0-9]/g, '');
			let netto2 = $("#netto2").val().replace(/[^0-9]/g, '');
			let harga = $("#harga").val().replace(/[^0-9]/g, '');
			let potongan = $("#potongan").val().replace(/[^0-9]/g, '');
			let netto1 = bruto - tara;
			total_netto2 = netto1 - potongan
			total = harga * netto2
			$("#total").val(total).trigger("keyup")
			$("#netto1").val(netto1).trigger("keyup")
			$("#netto2").val(total_netto2).trigger("keyup")
		})
		$('[id=potongan]').on('keyup', function() {
			let bruto = $("#bruto").val().replace(/[^0-9]/g, '');
			let tara = $("#tara").val().replace(/[^0-9]/g, '');
			let netto2 = $("#netto2").val().replace(/[^0-9]/g, '');
			let harga = $("#harga").val().replace(/[^0-9]/g, '');
			let potongan = $("#potongan").val().replace(/[^0-9]/g, '');
			let netto1 = bruto - tara;
			total_netto2 = netto1 - potongan
			total = harga * netto2
			$("#total").val(total).trigger("keyup")
			$("#netto1").val(netto1).trigger("keyup")
			$("#netto2").val(total_netto2).trigger("keyup")
		})
	});
</script>