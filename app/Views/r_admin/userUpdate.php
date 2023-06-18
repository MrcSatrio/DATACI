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
                    <option value="1" <?= ($user['id_role'] == '1') ? 'selected' : ''; ?>>Admin</option>
                    <option value="2" <?= ($user['id_role'] == '2') ? 'selected' : ''; ?>>Keuangan</option>
                    <option value="3" <?= ($user['id_role'] == '3') ? 'selected' : ''; ?>>Operator</option>
                    <option value="4" <?= ($user['id_role'] == '4') ? 'selected' : ''; ?>>Mahasiswa</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <select name="id_status" class="custom-select form-control" id="id_status" required>
                    <option value="1" <?= ($user['id_status'] == '1') ? 'selected' : ''; ?>>E-Biu</option>
                    <option value="2" <?= ($user['id_status'] == '2') ? 'selected' : ''; ?>>Member</option>
                </select>
            </div>
        </div>
        <div class="form-group row align-items-center tanggal" style="display: none;">
    <label class="col-sm-3 col-form-label">Masa Berlaku</label>
    <div class="col-sm-9">
        <input type="date" class="form-control" name="masa_berlaku">
    </div>
</div>
        <div class="form-group row mt-5">
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary onclick">Ubah Data</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('id_status').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex].value;
        var tanggalForm = document.querySelector('.tanggal');

        if (selectedOption === '2') {
            tanggalForm.style.display = 'block';
        } else {
            tanggalForm.style.display = 'none';
        }
    });
</script>

<?= $this->endSection(); ?>
