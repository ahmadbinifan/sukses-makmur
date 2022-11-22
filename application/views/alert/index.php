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
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="alert alert-success">
                    <strong>Transaksi Berhasil Silahkan Cetak Faktur Penjualan!</strong>
                    <a class="btn btn-primary" href="<?php echo base_url() . 'Cashier' ?>"><span class="fa fa-backward"></span>Kembali</a>
                    <a class="btn btn-dark" href="<?php echo base_url() . 'Cashier/cetak_faktur' ?>" target="_blank"><span class="fa fa-print"></span>Cetak Faktur</a>
                    <a class="btn btn-danger" href="<?php echo base_url() . 'Cashier/cetak_invoice' ?>" target="_blank"><span class="fa fa-print"></span>Cetak Invoice</a>
                </div>
            </div>
        </div>
    </div>
</div>