<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cashier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cashier</li>
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
            <div class="row">
                <div class="col-lg-12">
                    <form action="<?= base_url() . 'Cashier/add_to_cart' ?>" method="post" id="detail">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nama Barang</label>
                                                    <select class="form-control select2" name="nama_barang" id="nama_barang" style="width: 100%;" onchange="selectBarang()">
                                                        <option value="-">-Nama Barang-</option>
                                                        <?php foreach ($listBarang as $row) { ?>
                                                            <option value="<?= $row->id_barang; ?>"><?= $row->nama_barang; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="satuan">
                                            </div>
                                            <div id="stok">
                                            </div>
                                            <div id="harga">
                                            </div>
                                            <div id="jumlah">
                                            </div>
                                            <div id="submit">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Items Detail</h4>
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Barang</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Subtotal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="detail_cart">
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($this->cart->contents() as $items) : ?>

                                                        <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                                                        <tr>
                                                            <td><?= $items['name']; ?></td>
                                                            <td style="text-align:right;"><?php echo number_format($items['price']); ?></td>
                                                            <td style="text-align:right;"><?php echo number_format($items['qty']); ?></td>
                                                            <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?></td>
                                                            <td style="text-align:center;"><a href="<?php echo base_url() . 'Cashier/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                                                        </tr>

                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url() . 'Cashier/simpan_penjualan' ?>" method="post">
                                <div class="row mb-2">
                                    <div class="col-9">
                                        <label>Customer Name</label>
                                        <div class="col-7">
                                            <input type="text" name="customer_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label>Total Belanja (Rp)</label>
                                        <div class="col-12">
                                            <input type="text" name="jual_total" id="jual_total" class="form-control" value="<?php echo number_format($this->cart->total()); ?>" readonly>
                                            <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total(); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-9">
                                        <button type="submit" class="btn btn-success ml-2">Submit<i class="fa fa-paper-plane"></i></button>
                                        <div class="col-7">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label>Tunai (Rp)</label>
                                        <div class="col-12">
                                            <input type="text" name="jual_jumlah_uang" id="jual_jumlah_uang" class="form-control">
                                            <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-9">
                                        <label></label>
                                        <div class="col-7">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label>Kembalian (Rp)</label>
                                        <div class="col-12">
                                            <input type="text" name="jual_kembalian" id="jual_kembalian" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#jual_jumlah_uang').on("input", function() {
            var total = $('#total').val();
            var jumuang = $('#jual_jumlah_uang').val();
            var hsl = jumuang.replace(/[^\d]/g, "");
            $('#jml_uang2').val(hsl);
            $('#jual_kembalian').val(hsl - total);
        })
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#jual_jumlah_uang').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('#jml_uang2').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ''
        });
        $('#jual_kembalian').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });

    });
</script>
<script>
    $(document).ready(function() {
        $("#nama_barang").focus();

    });

    function selectBarang() {
        let nama_barang = $("#detail").find('select[name=nama_barang]').val();
        console.log("nama", nama_barang)
        $.ajax({
            url: "<?= base_url('Cashier/getBarang') ?>",
            method: "POST",
            dataType: "json",
            data: {
                nama_barang: nama_barang
            },
            success: function(data) {
                if (data) {
                    let satuan = `<label style="width:90px;margin-right:5px;">Satuan</label><input type="text" class="form-control"  style="width:90px;margin-right:5px;" name="satuan" value="` + data.satuan_barang + `" readonly>`
                    $("#satuan").html(satuan);
                    let stok = `<label style="width:90px;margin-right:5px;">Stok</label><input type="text" class="form-control"  style="width:90px;margin-right:5px;" name="satuan" value="` + data.stok_barang + `" readonly>`
                    $("#stok").html(stok);
                    let harga = `<label style="width:90px;margin-right:5px;">Harga</label><input type="text"  style="width:110px;margin-right:5px;" class="form-control" name="harga" value="` + data.harga_jual_grosir_barang + `" readonly>`
                    $("#harga").html(harga);
                    let jumlah = `<label style="width:90px;margin-right:5px;">Jumlah</label><input type="number" style="width:90px;margin-right:5px;" class="form-control" name="jumlah" value="` + 1 + `">`
                    $("#jumlah").html(jumlah);
                    let submit = `<label style="width:90px;margin-right:5px;"></label><input type="submit" class="form-control btn-primary mt-2" name="simpan2" value="Submit">`
                    $("#submit").html(submit);
                }
            }
        })
    }
</script>