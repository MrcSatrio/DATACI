<?= $this->extend('template/index'); ?>

<?= $this->section('page_content'); ?>

<div class='container'>
    <div class='card shadow mx-5'>
        <h5 class="card-header">Tambah Data User</h5>
        <div class="card-body">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Error</h4>
                    <hr>
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success" role="alert">
                    <h4>Akun Berhasil Dibuat!</h4>
                    <hr>
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('admin/insert'); ?>" method="post">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Pokok Mahasiswa</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="npm" placeholder="NPM Mahasiswa" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Mahasiswa" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control form-control-user" name="email" placeholder="Email Mahasiswa" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Saldo Awal</label>
                    <div class="col-sm-9">
                        <select name="saldo" class="custom-select form-control" required>
                            <option value="0">Rp.0</option>
                            <option value="20000">Rp.20.000</option>
                            <option value="50000">Rp.50.000</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis</label>
                    <div class="col-sm-9">
                        <select id="id_status" name="id_status" class="custom-select form-control" required>
                            <option value="1">E-Biu</option>
                            <option value="2">Member</option>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="password" value="ABCD1234">

                <div class="form-group row align-items-center tanggal" style="display: none;">
                    <label class="col-sm-3 col-form-label">Masa Berlaku</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="masa_berlaku">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                        <select name="id_role" class="custom-select form-control" required>
                            <?php foreach ($role as $r) : ?>
                                <?php $selected = ($r['id_role'] == 4) ? 'selected' : ''; ?>
                                <option value="<?= $r['id_role'] ?>" <?= $selected ?>>
                                    <?= ucfirst($r['nama_role']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>



                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Input Kartu Parkir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-user" name="nomor_kartu" placeholder="Scan / masukkan nomor manual">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 mt-5 text-right">
                        <button type="submit" class="btn btn-primary col-sm-3">Buat Akun</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
