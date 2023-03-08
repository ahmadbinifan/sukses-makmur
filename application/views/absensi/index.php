<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Absensi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Absensi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2 ">
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="filter">
                                <div class="col-6">
                                    <label>ID Karyawan / Nama Karyawan</label>
                                    <input type="text" name="id_karyawan" id="id_karyawan" class="form-control">
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                </div>
                                <div class="float-right">
                                    <button type="button" id="btn-filter" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                    <a href="<?= base_url('home/get_absen') ?>" class="btn btn-success"><i class="fas fa-sync-alt"></i> Refresh</a>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12" id="divTable">
                                    <table class="table table-bordered table-condensed" style="font-size:11px;width:100%" id="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;width:40px;">No</th>
                                                <th>ID Karyawan</th>
                                                <th>Nama Karyawan</th>
                                                <th>Tanggal Absen Masuk</th>
                                                <th>Jam Absen Masuk</th>
                                                <th>Tanggal Absen Pulang</th>
                                                <th>Jam Absen Pulang</th>
                                                <th>Keterangan</th>
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
<div id="modalAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5>Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="create">
                    <label>Kode Barang</label>
                    <input type="text" class="form-control" name="id_barang" id="id_barang" readonly>
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang">
                    <label>Kategori Barang</label>
                    <select class="form-control select2" name="id_kategori_barang" id="id_kategori_barang">
                        <option value="-">-</option>
                        <?php foreach ($kategori as $row) { ?>
                            <option value="<?= $row->kategori_id; ?>"><?= $row->kategori_nama; ?></option>
                        <?php } ?>
                    </select>
                    <label>Satuan</label>
                    <select class="form-control select2" name="satuan_barang">
                        <option value="-">-</option>
                        <?php foreach ($satuan as $row) { ?>
                            <option value="<?= $row->satuan; ?>"><?= $row->satuan; ?></option>
                        <?php } ?>
                    </select>
                    <label>Harga Pokok Barang</label>
                    <input type="text" class="form-control" name="harga_pokok_barang">
                    <label>Harga Jual Grosir</label>
                    <input type="text" class="form-control" name="harga_jual_grosir_barang">
                    <label>Stok Barang</label>
                    <input type="text" class="form-control" name="stok_barang">
                    <label>Minimal Stok</label>
                    <input type="text" class="form-control" name="minimal_stok_barang">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div id="modalEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="edit">
                    <label>Kode Barang</label>
                    <input type="text" class="form-control" name="id_barang" id="id_barang" readonly>
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang">
                    <label>Kategori Barang</label>
                    <select class="form-control select2" name="id_kategori_barang" id="id_kategori_barang">
                        <option value="-">-</option>
                        <?php foreach ($kategori as $row) { ?>
                            <option value="<?= $row->kategori_id; ?>"><?= $row->kategori_nama; ?></option>
                        <?php } ?>
                    </select>
                    <label>Satuan</label>
                    <select class="form-control select2" name="satuan_barang">
                        <option value="-">-</option>
                        <?php foreach ($satuan as $row) { ?>
                            <option value="<?= $row->satuan; ?>"><?= $row->satuan; ?></option>
                        <?php } ?>
                    </select>
                    <label>Harga Pokok Barang</label>
                    <input type="text" class="form-control" name="harga_pokok_barang">
                    <label>Harga Jual Grosir</label>
                    <input type="text" class="form-control" name="harga_jual_grosir_barang">
                    <label>Stok Barang</label>
                    <input type="text" class="form-control" name="stok_barang">
                    <label>Minimal Stok</label>
                    <input type="text" class="form-control" name="minimal_stok_barang">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#divTable').hide();
        $('#btn-filter').on('click', function() {
            $('#divTable').show();
            table.page.len(-1).draw();
        });
        var table;
        table = $('#table').DataTable({
            "scrollCollapse": true,
            "select": true,
            "processing": true,
            "serverSide": true,
            "retrieve": true,
            "bInfo": false,
            "ajax": {
                "url": "<?= base_url('Absensi/list_ajax') ?>",
                "type": "POST",
                "data": function(data) {
                    data.id_karyawan = $('#id_karyawan').val();
                    data.start_date = $('#start_date').val();
                    data.end_date = $('#end_date').val();
                }
            },
            "columnDefs": [{
                "targets": [1], //first column / numbering column
                "orderable": false,
            }, ],
            "ordering": true,
            lengthMenu: [
                [25, 50, 125, -1],
                ['25 File', '50 File', '125 File', 'Show All']
            ],

        });
    });


    $('#create').submit(function(e) {
        e.preventDefault();
        let data = new FormData(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "Please check again, if it is complete please submit",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit Now!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('Data_Barang/create') ?>',
                    type: "post",
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function(data) {
                        $('#modalAdd').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        })
    });
    $('#edit').submit(function(e) {
        e.preventDefault();
        let data = new FormData(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "Please check again, if it is complete please submit",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit Now!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('Data_Barang/update') ?>',
                    type: "post",
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function(data) {
                        $('#modalEdit').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        })
    });

    function input() {
        getNew().done(function(res) {
            resetAdd(res);
        });
    }

    function getNew() {
        let process = $.ajax({
            url: "<?= base_url('Data_Barang/getNew') ?>",
            method: "post",
            dataType: "json",
        });
        return process;
    }

    function get(id, type) {
        $.ajax({
            url: "<?= base_url('Data_Barang/get') ?>",
            method: "post",
            dataType: "json",
            data: {
                id_barang: id,
            },
            success: function(data) {
                fillData(data.header, type);
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

    function remove(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to remove this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('Data_karyawan/remove') ?>",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id_karyawan: id
                    },
                    success: function(response) {
                        if (response == true) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else if (response == false) {
                            Swal.fire(
                                'Failed!',
                                'Failed to delete data.',
                                'error'
                            )
                        }
                        table.ajax.reload();
                    }
                })

            }
        })
    }

    function resetAdd(no) {
        let form = $('#create');
        form.find('input[name=id_barang]').val(no);
    }
</script>