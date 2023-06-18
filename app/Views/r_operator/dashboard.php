<?= $this->extend('template/index'); ?>

<?php $this->section('page_content'); ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card border-warning mb-3 shadow mx-2 h-100">
            <div class="card-body">
            </form>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <h2 class="card-title text-center">
                    <b>PEMBAYARAN PARKIR</b>
                </h2>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url($user['nama_role']) ?>/check-out" method="post">
                <div class="mb-3">
    <label class="form-label"><b>No Kartu</b></label>
    <input type="number" class="form-control form-control-lg" placeholder="Masukkan Nomor Kartu" name="nomor_kartu" onkeydown="return event.key !== 'Enter';" autofocus>
</div>
<br>
                    <div class="text-center align-items-center h-500 d-flex">
    <button type="submit" class="btn btn-outline-info flex-fill mx-5" name="nominal_transaksi" value="<?= $parkir_motor['nominal']; ?>" style="font-size: 24px; padding: 20px 40px;">
        <i class="fas fa-motorcycle"></i>
        MOTOR
    </button>
    <button type="submit" class="btn btn-outline-info flex-fill mx-5" name="nominal_transaksi" value="<?= $parkir_mobil['nominal']; ?>" style="font-size: 24px; padding: 20px 40px;">
        <i class="fas fa-car"></i>
        MOBIL
    </button>
</div>

                    <input type="hidden" name="id_jenis_transaksi" value="3">
                    <input type="hidden" name="id_status_transaksi" value="2">
             
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
