<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">History Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">History Penjualan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form id="form-filter" target="_blank" class="form-horizontal" action="<?php echo base_url() . 'History_Penjualan/exportPdf/'; ?>" method="post">
                        <div class="row mb-2">
                            <label class="col-2 col-md-3">Period</label>
                            <div class="col-3 col-md-3">
                                <input type="date" class="form-control" name="tgl1" id="start" placeholder="Choice Start Date" />
                            </div>
                            <label class="col-6 col-md-2">To</label>
                            <div class="col-md-3 col-6">
                                <input type="date" class="form-control" name="tgl2" id="end" onchange="listCustomer()" placeholder=" Choice End Date" />
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-6 col-md-3">Customer</label>
                            <div class="col-md-4 col-6">
                                <select name="jual_customer" class="form-control select2" id="jual_customer" />
                                <option value="" selected>Choose Customer</option>
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
                                                <th>Nama Customer</th>
                                                <th>Tanggal</th>
                                                <th>No Faktur</th>
                                                <th>Total Harga</th>
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
                <h5>Detail Penjualan Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-6 mb-2">
                    <label>Nama Customer :</label>
                    <!-- <input type="text" class="form-control" name="jual_customer" id="jual_customer" readonly> -->
                    <span id="jual_customer">Isi</span>
                </div>
                <center style="font-weight: bold; font-style: italic; font-size: 18px">- Detail -</center>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="tableDetail">
                    </tbody>
                    <tfoot>

                        <th colspan="3" style="text-align : right">Grand Total :</th>
                        <th style="margin-left: 100px;"><span id="total_semua"></span></th>
                    </tfoot>
                </table>

            </div>
        </div>
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
                "url": "<?= base_url('History_Penjualan/list_ajax') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl1 = $('#start').val();
                    data.tgl2 = $('#end').val();
                    data.jual_customer = $('#jual_customer').val();
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
        form.find('select[name=completion]').val("");
        form.find('select[name=nm_rls]').val("");
        form.find('select[name=nm_brg]').val("");
        form.find('select[name=completion]').trigger("change");
        form.find('select[name=no_ref]').trigger("change");
        form.find('select[name=nm_rls]').trigger("change");
        form.find('select[name=nm_brg]').trigger("change");
        table.ajax.reload(); //just reload table
    });

    function get(id, type) {
        // console.log(id)
        $.ajax({
            url: "<?= base_url('History_Penjualan/get') ?>",
            method: "post",
            dataType: "json",
            data: {
                id: id,
            },
            success: function(data) {
                // $('#total_semua').val(data.header.jual_total)
                document.getElementById('jual_customer').innerHTML = data.header.jual_customer;
                document.getElementById('total_semua').innerHTML = "Rp. " + data.header.jual_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                detailTable(data)
            },
            error: function(e) {
                console.log(e);
            }
        })
    }

    function fillData(data, type) {
        let form = $('#' + type);
        // let ces = $('#' + type).is(":checked");

        if (type == "edit") {
            form.find('input[name=id_barang]').val(data.id_barang);
            form.find('input[name=nama_barang]').val(data.nama_barang);
            form.find('select[name=id_kategori_barang]').val(data.id_kategori_barang);
            form.find('select[name=id_kategori_barang]').trigger("change");
            form.find('select[name=satuan_barang]').val(data.satuan_barang);
            form.find('select[name=satuan_barang]').trigger("change");
            form.find('input[name=harga_pokok_barang]').val(data.harga_pokok_barang);
            form.find('input[name=harga_jual_grosir_barang]').val(data.harga_jual_grosir_barang);
            form.find('input[name=stok_barang]').val(data.stok_barang);
            form.find('input[name=minimal_stok_barang]').val(data.minimal_stok_barang);
        }
    }

    function detailTable(data) {
        $.ajax({
            url: "<?= base_url('History_Penjualan/getDetail') ?>",
            method: "post",
            dataType: "json",
            data: {
                id: data.header.jual_nofak,
            },
            success: function(data) {
                $.each(data.detail, function(i, order) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(order.d_jual_barang_nama),
                        $('<td>').text('Rp. ' + order.d_jual_barang_harpok.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")),
                        $('<td>').text(order.d_jual_qty),
                        $('<td>').text('Rp. ' + order.d_jual_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))).appendTo('#tableDetail');

                });
            }
        })
    }

    function listCustomer() {
        let select = $("#form-filter").find('select[name=jual_customer]');
        $.ajax({
            url: "<?= base_url('History_Penjualan/list_customer') ?>",
            method: "post",
            dataType: "json",
            data: {
                tgl1: $('#start').val(),
                tgl2: $('#end').val()
            },
            success: function(data) {
                if (data) {
                    let html = '<option value="">Choose Customer (Optional)</option>';
                    $.each(data, function(index, value) {
                        html += '"<option value="' + value.jual_customer + '">' + value.jual_customer + '</option>';
                    });
                    $(select).html(html);

                }
            },
            error: function(e) {
                console.log(e);
            }
        })
    }

    function resetAdd(no) {
        let form = $('#create');
        form.find('input[name=id_barang]').val(no);
    }
</script>