<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2 ">
                <div class="col-lg-12">
                    <button class="btn btn-sm btn-primary" onclick="create()"> <i class="fas fa-plus"> Tambah User</i> </button>
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
                                                <th>Fullname</th>
                                                <th>Username</th>
                                                <th>Level</th>
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
                "url": "<?= base_url('User/list_user') ?>",
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
                    url: "<?= base_url('User/remove') ?>",
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
            url: "<?= base_url('User/get') ?>",
            method: "post",
            dataType: "json",
            data: {
                id: id,
            },
            success: function(data) {
                <?php
                $list_level = ['Admin', 'Kasir'];
                ?>
                Swal.fire({
                    title: 'Update User',
                    html: `
                    <div class='container'>
                    <div class='row mb-2'>
                        <div class='col-md-4'>
                            Fullname
                        </div>
                        <div class='col-md-8'>
                            <input id="fullname" type="text" class="form-control" value=${data.fullname} required />
                        </div>
                    </div>
                    <div class='row mb-2'>
                        <div class='col-md-4'>
                            Username
                        </div>
                        <div class='col-md-8'>
                            <input id="username" type="text" class="form-control" value=${data.username} required />
                        </div>
                    </div>
                    <div class='row mb-2'>
                        <div class='col-md-4'>
                            Fullname
                        </div>
                        <div class='col-md-8'>
                        <select class="form-control">
                        <?php
                        foreach ($list_level as $level) {
                        ?>
${data.level == '<?= $level ?>' ? '<?php echo '<option value=' . $level . ' selected>' . $level . '</option>'; ?>' : '<?php echo '<option value="' . $level . '">' . $level . '</option>'; ?>'}
<?php

                        }
?>
                        </select> </div> </div> </div>
                    `,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: '#d33',
                }).then(function(result) {
                    if (result.value) {
                        let fullname = $('#fullname').val();
                        let username = $('#username').val();
                        let level = $('#level').val();
                        $.ajax({
                            url: "<?= base_url('User/update') ?>",
                            method: "post",
                            dataType: "json",
                            data: {
                                id: data.id,
                                fullname: fullname,
                                username: username,
                                password: password,
                                level: level,
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
            title: 'Create User',
            html: '<input id="fullname" type="text" class="swal2-input" placeholder="Fullname" required />' +
                '<input id="username" type="text" class="swal2-input" placeholder="Username" required />' +
                '<input id="password" type="password" class="swal2-input" placeholder="Password" required/>' +
                '<select id="level" class="swal2-input" style="width:64%"><option value="" selected>-Level-</option> <option value="admin">Admin</option><option value="kasir">Kasir</option></select> ',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Create',
            cancelButtonText: 'Cancel',
            cancelButtonColor: '#d33',
        }).then(function(result) {
            if (result.value) {
                let fullname = $('#fullname').val();
                let username = $('#username').val();
                let password = $('#password').val();
                let level = $('#level').val();
                if (fullname != '' && username != '' && password != '' && level != '') {
                    $.ajax({
                        url: "<?= base_url('User/create') ?>",
                        method: "post",
                        dataType: "json",
                        data: {
                            fullname: fullname,
                            username: username,
                            password: password,
                            level: level,
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
                } else {
                    Swal.fire(
                        'Tambah User!',
                        'Data Inputan Masih Kosong!',
                        'error'
                    )
                }

            }
        });

    }
</script>