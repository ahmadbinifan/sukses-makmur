  <div class="content-wrapper dark-mode">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Dashboard</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-3 col-6">

                      <div class="small-box bg-info">
                          <div class="inner">
                              <h3><?= $count_cashier ?></h3>

                              <p>Kasir</p>
                          </div>
                          <div class="icon">
                              <i class="fas fa-tags"></i>
                          </div>
                          <a href="<?= base_url('cashier') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <?php if ($this->session->userdata('level') == "admin") { ?>
                      <div class="col-lg-3 col-6">

                          <div class="small-box bg-success">
                              <div class="inner">
                                  <h3><?= $count_product ?></h3>

                                  <p>Data Barang</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-toolbox"></i>
                              </div>
                              <a href="<?= base_url('data_barang') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-6">

                          <div class="small-box bg-warning">
                              <div class="inner">
                                  <h3><?= $count_employee ?></h3>
                                  <p>Data Karyawan</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-user-tie"></i>
                              </div>
                              <a href="<?= base_url('data_karyawan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>

                      <div class="col-lg-3 col-6">

                          <div class="small-box bg-danger">
                              <div class="inner">
                                  <h3><?= $count_absensi ?> / <?= $count_employee ?></h3>
                                  <p>Absensi</p>
                              </div>
                              <div class="icon">
                                  <i class="fas fa-th-list"></i>
                              </div>
                              <a href="<?= base_url('absensi') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                  <?php } ?>
              </div>

          </div>
      </section>
      <!-- /.content -->
  </div>