<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Satuan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Satuan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2 ">
                <div class="col-lg-12">
                    <button class="btn btn-sm btn-primary" onclick="create()"> <i class="fas fa-plus"> Tambah Data</i> </button>
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
                                                <th style="width:40px;">No.</th>
                                                <th>Satuan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
<script type="text/javascript">
    $(document).ready(function() {
        table = $('#table').DataTable({
            "lengthChange": false,
            "paging": false,
            "ordering": false,
            "info": false,
            "processing": true,
            "serverSide": true,
            "retrieve": true,
            "ajax": {
                "url": "<?= base_url('Satuan/list_satuan') ?>",
                "type": "POST",
            },
            "columnDefs": [{}, ],
        });
    });

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
                    url: "<?= base_url('Satuan/remove') ?>",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data) {
                            Swal.fire(
                                'Deleted!',
                                'Section has been deleted.',
                                'success'
                            )
                            table.ajax.reload();
                        }
                    }
                })

            }
        })
    }

    function get(id) {
        $.ajax({
            url: "<?= base_url('Satuan/get') ?>",
            method: "post",
            dataType: "json",
            data: {
                id: id,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Update List Satuan',
                    html: '<input id="name" type="text" class="swal2-input" value="' + data.satuan + '"/>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: '#d33',
                }).then(function(result) {
                    if (result.value) {
                        let satuan = $('#name').val();
                        $.ajax({
                            url: "<?= base_url('Satuan/update') ?>",
                            method: "post",
                            dataType: "json",
                            data: {
                                id: id,
                                satuan: satuan,
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Success!',
                                    'Data has been updated!',
                                    'success'
                                )
                                table.ajax.reload();
                            }
                        })
                    }
                })

            }
        })
    }

    function create() {
        Swal.fire({
            title: 'Create Satuan',
            html: '<input id="name" type="text" class="swal2-input" />',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Create',
            cancelButtonText: 'Cancel',
            cancelButtonColor: '#d33',
        }).then(function(result) {
            if (result.value) {
                let satuan = $('#name').val();
                $.ajax({
                    url: "<?= base_url('Satuan/create') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        satuan: satuan,
                    },
                    success: function(data) {
                        Swal.fire(
                            'Success!',
                            'Data has been created!',
                            'success'
                        )
                        table.ajax.reload();
                    }
                })
            }
        });

    }
</script>