<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #f6d365;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
    }

    div.scroll {
        width: 100%;
        height: 110px;
        overflow: auto;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Karyawan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Karyawan</li>
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
                                                <th>Foto Karyawan</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>ID Karyawan</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Agama</th>
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
<div id="modalAdd" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5>Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="create">
                    <label>Foto Karyawan</label>
                    <input type="file" class="form-control" name="avatar" accept="image/png, image/jpeg , image/jpg" />
                    <div class="row">
                        <div class="col-md-6">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik" placeholder="Nomor Induk Karyawan">
                        </div>
                        <div class="col-md-6">
                            <label>ID Karyawan</label>
                            <input type="text" class="form-control" name="id_karyawan" id="id_karyawan" placeholder="ID Karyawan">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="-">-Jenis Kelamin-</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir">
                        </div>
                        <div class="col-md-4">
                            <label>Agama</label>
                            <input type="text" class="form-control" name="agama" placeholder="Agama">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Alamat</label>
                            <textarea name="alamat" name="alamat" rows="3" class="form-control" placeholder="Alamat.."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modalEdit" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="edit">
                    <!-- <label>Foto Karyawan</label>
                    <input type="file" class="form-control" name="avatar" accept="image/png, image/jpeg , image/jpg" /> -->
                    <div class="row">
                        <div class="col-md-6">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik" placeholder="Nomor Induk Karyawan" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>ID Karyawan</label>
                            <input type="text" class="form-control" name="id_karyawan" placeholder="ID Karyawan" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="-">-Jenis Kelamin-</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir">
                        </div>
                        <div class="col-md-4">
                            <label>Agama</label>
                            <input type="text" class="form-control" name="agama" placeholder="Agama">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Alamat</label>
                            <textarea name="alamat" name="alamat" rows="3" class="form-control" placeholder="Alamat.."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modalDetail" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5>Detail Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="detail">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img alt="Avatar" id="avatar_detail" class="img-fluid my-5" style="width: 80px;" />
                            <h5 id="nama_detail"></h5>
                            <p id="id_karyawan_detail"></p>
                            <input type="hidden" name="idx" id="idx">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Information</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Tanggal Lahir</h6>
                                        <p class="text-muted" id="tanggal_lahir_detail"></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Jenis Kelamin</h6>
                                        <p class="text-muted" id="jenis_kelamin_detail"></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Agama</h6>
                                        <p class="text-muted" id="agama_detail"></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Alamat</h6>
                                        <p class="text-muted" id="alamat_detail"></p>
                                    </div>
                                </div>
                                <h6>Absensi</h6>
                                <hr class="mt-0 mb-4">
                                <form id="filter">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Bulan / Tahun</label>
                                            <input type="month" name="month" id="month" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <div class="float-right">
                                            <button type="button" class="btn btn-success" onclick="get_presensi()"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="loading"></div>
                                <div class="mt-3" id="result_report"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
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
                "url": "<?= base_url('Data_Karyawan/list_ajax') ?>",
                "type": "POST",
                "data": function(data) {}
            },
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }],
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
                    url: '<?= base_url('Data_Karyawan/create') ?>',
                    type: "post",
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function(response) {
                        $('#modalAdd').modal('hide');
                        if (response == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Data Karyawan Berhasil di Tambahkan',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            table.ajax.reload()
                        }
                        if (response == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'ID Karyawan exist',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            table.ajax.reload()
                        }
                    }
                })
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
                    url: '<?= base_url('Data_Karyawan/update') ?>',
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
        resetAdd();
    }

    function getNew() {
        let process = $.ajax({
            url: "<?= base_url('Data_Karyawan/getNew') ?>",
            method: "post",
            dataType: "json",
        });
        return process;
    }

    function get_presensi() {
        let id = $('#idx').val();
        let month = $('#month').val();
        let datas = {
            id,
            month
        }
        $('.loading').html(` <div class="text-center">
                        <h5>Loading..</h5>
                    </div>`)
        $.ajax({
            url: "<?= base_url('Data_Karyawan/get_presensi') ?>",
            type: "POST",
            data: datas,
            success: function(response) {
                $('.loading').html('')
                $('#result_report').html(response);
            }
        })
    }

    function get(id, type) {
        $.ajax({
            url: "<?= base_url('Data_Karyawan/get') ?>",
            method: "post",
            dataType: "json",
            data: {
                id_karyawan: id,
            },
            success: function(data) {
                fillData(data.header, type);
                $('#result_report').html('');

            },
            error: function(e) {
                console.log(e);
            }
        })
    }

    function fillData(data, type) {
        let form = $('#' + type);
        // let ces = $('#' + type).is(":checked");
        if (type == "detail") {
            $("#avatar_detail").attr("src", "<?= base_url('assets/avatar/') ?>" + data.avatar);
            $('#nama_detail').text(data.nama);
            form.find('input[name=idx]').val(data.id_karyawan);
            $('#id_karyawan_detail').text(data.id_karyawan);
            $('#tanggal_lahir_detail').text(data.tanggal_lahir);
            $('#jenis_kelamin_detail').text(data.jenis_kelamin);
            $('#agama_detail').text(data.agama);
            $('#alamat_detail').text(data.alamat);
        }
        if (type == "edit") {
            form.find('input[name=nik]').val(data.nik);
            form.find('input[name=id_karyawan]').val(data.id_karyawan);
            form.find('input[name=nama]').val(data.nama);
            form.find('select[name=jenis_kelamin]').val(data.jenis_kelamin).trigger("change");
            form.find('input[name=tanggal_lahir]').val(data.tanggal_lahir);
            form.find('input[name=agama]').val(data.agama);
            form.find('textarea[name=alamat]').val(data.alamat);

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
                    url: "<?= base_url('Data_Karyawan/remove') ?>",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id_karyawan: id
                    },
                    success: function(response) {
                        if (response == "success") {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        } else if (response == "failed") {
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

    function resetAdd() {
        let form = $('#create');
        form.find('input[name=id_karyawan]').val(null);
        form.find('input[name=nik]').val(null);
        form.find('input[name=avatar]').val(null);
        form.find('input[name=nama]').val(null);
        form.find('input[name=tanggal_lahir]').val(null);
        form.find('input[name=agama]').val(null);
        form.find('textarea[name=alamat]').val(null);
        form.find('select[name=jenis_kelamin]').val("-").trigger("change");
    }
</script>