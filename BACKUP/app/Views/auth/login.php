<?= $this->extend('auth/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                
                                <div class="text-center">
                                    
  <img src="<?= base_url() ?>assets/img/png.png" style="width: 180px; height: 180px;">
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                </div>
                                <?php if (session()->get('msg')) : ?>
                                    <div class="alert alert-danger">
                                        <?= session()->get('msg') ?>
                                    </div>
                                <?php endif ?>

                                <?php if (!empty(session()->getFlashdata('berhasil'))) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <h4>Error</h4>
                                        <hr>
                                        <?= session()->getFlashdata('berhasil'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->getFlashdata('salah')) : ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashdata('salah'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-success">
                                        <?= session()->getFlashdata('success'); ?>
                                    </div>
                                <?php endif; ?>

                                <form class="user" method="post" action="<?= base_url('login') ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="npm" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="password-field">
                                            <input id="password" type="password" class="form-control form-control-user" placeholder="Password" name="password" required>
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                </form>

                                <div class="text-center">
                                    <a class="small" href="<?= base_url() ?>forgotpassword">Lupa Password</a><br>
                                    <a class="small" href="#" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Cek saldo</a>
                                </div>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cek Saldo Pengguna</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url() ?>ceksaldo" method="Post">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">NPM</label>
                                                        <input type="text" class="form-control" id="recipient-name" name="npm" placeholder="Masukan NPM Anda" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Cek</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var passwordField = document.getElementById("password");
    var togglePassword = document.querySelector(".toggle-password");

    togglePassword.addEventListener("click", function() {
        var type = passwordField.getAttribute("type");
        if (type === "password") {
            passwordField.setAttribute("type", "text");
            togglePassword.classList.remove("fa-eye");
            togglePassword.classList.add("fa-eye-slash");
        } else {
            passwordField.setAttribute("type", "password");
            togglePassword.classList.remove("fa-eye-slash");
            togglePassword.classList.add("fa-eye");
        }
    });
</script>

<?= $this->endSection(); ?>