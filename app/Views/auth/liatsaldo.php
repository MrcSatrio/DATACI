<?= $this->extend('auth/template/index');

$this->section('content'); ?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><b> SISA SALDO ANDA</b></h1>
                                </div>
                                <div class="form-group">
                                    <div class="card">
                                        <H3>
                                            <center>Rp.<?= number_format($ceksaldo['saldo']); ?></center>
                                        </H3>
                                    </div>
                                </div>
                                <center><a href="<?= site_url('/') ?>" class="btn btn-success">Kembali</a></center>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?= $this->endSection(); ?>