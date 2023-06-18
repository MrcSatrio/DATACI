<?= $this->extend('template/index'); ?>

<?= $this->section('page_content'); ?>
    <?php if (!empty(session()->getFlashdata('hapus'))) : ?>
        <div class="alert alert-success" role="alert">
            <h4>User Berhasil Dihapus!</h4>
            <hr>
            <?= session()->getFlashdata('hapus'); ?>
        </div>
    <?php endif; ?>
    <div class="card mx-5 shadow">
        <div class="card-header">
            UBAH DATA USER
        </div>
        <form action="<?= base_url(); ?>admin/edit/<?= $user['npm']; ?>" method="post">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Pokok Mahasiswa</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="npm" value="<?= $user['npm']; ?>" disabled>

                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" value="<?= $user['nama'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="email" value="<?= $user['email'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Kartu</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nomor_kartu" value="<?= $user['nomor_kartu'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Saldo</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="saldo" value="<?= $user['saldo'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                    <select class="form-control" name="id_role">
                        <option value="1" <?php if ($user['id_role'] == '1') echo 'selected'; ?>>Admin</option>
                        <option value="2" <?php if ($user['id_role'] == '2') echo 'selected'; ?>>Keuangan</option>
                        <option value="3" <?php if ($user['id_role'] == '3') echo 'selected'; ?>>Operator</option>
                        <option value="4" <?php if ($user['id_role'] == '4') echo 'selected'; ?>>Mahasiswa</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-5">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary onclick">Ubah Data</button>
                </div>
            </div>
        </form>
    </div>
<?= $this->endSection(); ?>
