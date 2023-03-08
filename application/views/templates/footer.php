      <!-- Main Footer -->
      <footer class="main-footer <?php if ($this->uri->segment(1) == 'home') {
                                        echo "dark-mode";
                                    } ?>">
          <!-- To the right -->
          <div class="float-right d-none d-sm-inline">
              Version 1.1
          </div>
          <!-- Default to the left -->
          <strong>Copyright &copy; 2022 <a href="#">Selamat Makmur</a>.</strong> All rights reserved.
      </footer>
      </div>
      <!-- ./wrapper -->

      <!-- REQUIRED SCRIPTS -->


      <!-- Bootstrap 4 -->
      <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- AdminLTE App -->
      <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
      <!-- Select2 -->
      <script src="<?= base_url('assets/') ?>plugins/select2/js/select2.full.min.js"></script>
      <script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.js"></script>
      <script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <!-- sweetaler2 -->
      <script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>
      <!-- price format -->
      <script src="<?= base_url('assets/') . 'plugins/price/jquery.price_format.min.js' ?>"></script>

      <script>
          $(document).ready(function() {
              $('.select2').select2({
                  theme: 'bootstrap4'
              })

          });
      </script>
      </body>

      </html>