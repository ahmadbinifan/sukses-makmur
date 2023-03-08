        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?= base_url('assets/') ?>dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Selamat Makmur</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets/') ?>dist/img/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $this->session->userdata('fullname') ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url('home') ?>" class="nav-link <?php if ($this->uri->segment('1') == "home") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('cashier') ?>" class="nav-link <?php if ($this->uri->segment('1') == "cashier") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Cashier
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('absensi') ?>" class="nav-link <?php if ($this->uri->segment('1') == "absensi") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>
                                    Absensi
                                </p>
                            </a>
                        </li>
                        <?php if ($this->session->userdata('level') == "admin") { ?>
                            <li class="nav-header">Owner Menu</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == "Data_Barang" || $this->uri->segment(1) == "Satuan" || $this->uri->segment(1) == "Kategori" || $this->uri->segment(1) == "History_Penjualan" || $this->uri->segment(1) == "Data_Karyawan") {
                                                                echo 'active';
                                                            } ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Master Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Data_Barang') ?>" class="nav-link <?php if ($this->uri->segment('1') == "Data_Barang") {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('Data_Karyawan') ?>" class="nav-link <?php if ($this->uri->segment('1') == "Data_Karyawan") {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Karyawan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('Satuan') ?>" class="nav-link <?php if ($this->uri->segment('1') == "Satuan") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Satuan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('Kategori') ?>" class="nav-link <?php if ($this->uri->segment('1') == "Kategori") {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kategori</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('History_Penjualan') ?>" class="nav-link <?php if ($this->uri->segment('1') == "History_Penjualan") {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>History Penjualan</p>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="./index3.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Laporan Penjualan</p>
                                        </a>
                                    </li> -->
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('User') ?>" class="nav-link <?php if ($this->uri->segment('1') == "User") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Users
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>