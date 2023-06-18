<?= $this->extend('template/index');

$this->section('page_content'); ?>

<div class='container'>
    <div class='card shadow mx-5 '>
        <h5 class="card-header">Profile Saya</h5>
        <div class="card-body">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Error</h4>
                    </hr>
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?><?= $user['nama_role']; ?>/update_profil" method="post">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Pokok Mahasiswa</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="npm" value="<?= $user['npm']; ?>" disabled><br>
                    </div>
                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-user" name="nama" value="<?= $user['nama'] ?>" disabled><br>
                    </div>
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-user" name="email" value="<?= $user['email'] ?>">
                    </div>
                    <div class="col-sm-12 mt-5 text-right">
                        <button type="submit" class="btn btn-primary col-sm-3">Ubah Email</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>