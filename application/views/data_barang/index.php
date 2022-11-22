<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2 ">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-info btn-sm" onclick="input()" data-toggle="modal" data-target="#modalAdd">Tambah Data <i class="fa fa-plus"></i></button>
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
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Harga Pokok</th>
                                                <th>Harga (Grosir)</th>
                                                <th>Stok</th>
                                                <th>Min Stok</th>
                                                <th>Kategori</th>
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
        // var table;
        table = $('#table').DataTable({
            "scrollCollapse": true,
            "select": true,
            "processing": true,
            "serverSide": true,
            "retrieve": true,
            "bInfo": false,
            "ajax": {
                "url": "<?= base_url('Data_Barang/list_data_barang') ?>",
                "type": "POST",
                "data": function(data) {}
            },
            // columnDefs: [{
            //     "defaultContent": "-",
            //     "targets": "_all"
            // }],
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
                    url: "<?= base_url('Data_Barang/remove') ?>",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id_barang: id
                    },
                    success: function(data) {
                        if (data == "success") {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else if (data == "failed") {
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