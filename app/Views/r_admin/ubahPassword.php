<?= $this->extend('template/index');

$this->section('page_content'); ?>


<div class='container'>
    <div class='card shadow mx-5 '>
        <h5 class="card-header">Ubah Password</h5>
        <div class="card-body">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error_lm')) : ?>
                <div class="alert alert-danger">
                    <?php echo session()->getFlashdata('error_lm'); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Error</h4>
                    </hr>
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url($user['nama_role']); ?>/update_password" method="post">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password Lama Anda</label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="oldpassword" placeholder=""><br>
                    </div>
                    <label class="col-sm-3 col-form-label">Masukan Password Baru</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-user" name="password" placeholder=""><br>
                    </div>
                    <label class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-user" name="repassword" placeholder="">
                    </div>
                    <div class="col-sm-12 mt-5 text-right">
                        <button type="submit" class="btn btn-primary col-sm-3">Ubah Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>