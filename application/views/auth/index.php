<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">SUKSES MAKMUR</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4 text-center">Login Page</h3>
                            </div>
                        </div>
                        <form action="<?= base_url('auth') ?>" method="post" class="login-form">
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center" style="background-color: #28a745;"><span class="fa fa-user"></span></div>
                                <input type="text" class="form-control rounded-left" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center" style="background-color: #28a745;"><span class="fa fa-lock"></span></div>
                                <input type="password" class="form-control rounded-left" name="password" placeholder="Password" required>
                            </div>
                            <div class="w-100 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success rounded submit">Login</button>
                            </div>
                            <div class="w-100 text-center">
                                <p class="mb-1">Something wrong? <a href="#"></a></p>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>