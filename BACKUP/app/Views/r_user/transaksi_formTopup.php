    <?= $this->extend('template/index');

    $this->section('page_content'); ?>

    <div class="card shadow mx-5">
        <div class="card-body">
            <h1 class="card-title">Top-Up</h1>
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Error</h4>
                    </hr>
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url() ?>user/transaksi_topup" method="POST">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Pokok Mahasiswa</label>
                    <div class="col-sm-9">
                        <input type="text" readonly class="form-control" value="<?= $user['npm']; ?>" name="npm">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nominal</label>
                    <div class="col-sm-9">
                        <select name="nominal" class="form-control form-control-user custom-select">
                            <option selected>Pilih Nominal Saldo</option>
                            <option value="20000">20.000</option>
                            <option value="50000">50.000</option>
                            <option value="100000">100.000</option>
                            <option value="150000">150.000</option>
                            <option value="200000">200.000</option>
                        </select>
                    </div>
                    <!-- JENIS TRANSAKSI -->
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" value="1" name="jenis_transaksi">
                    </div>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" value="<?= $user['saldo']; ?>" name="saldoawal">
                    </div>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" value="1" name="status_transaksi">
                    </div>
                    <div class="col-sm-9 mt-4">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?= $this->endSection(); ?>