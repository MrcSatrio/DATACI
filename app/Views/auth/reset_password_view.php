<?= $this->extend('auth/template/index');

$this->section('content'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Lupa Password</h1>
                                </div>
                                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <h4>Error</h4>
                                        </hr>
                                        <?php echo session()->getFlashdata('error'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->has('success')) : ?>
                                    <div class="alert alert-success">
                                        <?= session()->getFlashdata('success') ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->has('errortoken')) : ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashdata('errortoken') ?>
                                    </div>
                                <?php endif; ?>

                                <form action="<?= base_url() ?>updatepassword" method="post" class="user">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="token" placeholder="Input Token">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="confirmpassword" placeholder="Repeat New Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Ubah Password
                                    </button>
                                </form>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?= $this->endSection(); ?>