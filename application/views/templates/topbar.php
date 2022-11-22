 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Messages Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-user"></i>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="<?= base_url('assets/') ?>dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 <?= $this->session->userdata('username') ?>
                                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm"><?= $this->session->userdata('fullname') ?></p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <div class="container">
                     <div class="col-6">
                         <a class="dropdown-item dropdown-footer" href="<?= base_url('account') ?>">
                             <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>Account
                         </a>
                     </div>
                     <div class="col-6">
                         <a href="<?= base_url('auth/logout') ?>" class="dropdown-item dropdown-footer">
                             <i class="fas fa-sign-out-alt fa-md fa-fw mr-2 text-gray-400"></i>Logout
                         </a>
                     </div>
                 </div>
             </div>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->