<?= $this->extend('template/index');

$this->section('page_content'); ?>

<div class='container'>
    <div class='card shadow mx-5 '>
        <h5 class="card-header">Tambah Data User</h5>
        <div class="card-body">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Error</h4>
                    </hr>
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success" role="alert">
                    <h4>Akun Berhasil Dibuat !</h4>
                    </hr>
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>keuangan/insert" method="post">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Pokok Mahasiswa</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="npm" placeholder="NPM Mahasiswa" required><br>
                    </div>
                    <input type="hidden" name="password" value="ABCD1234">
                    <input type="hidden" name="id_role" value="4">
                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Mahasiswa" required><br>
                    </div>
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control form-control-user" name="email" placeholder="Email Mahasiswa"><br>
                    </div>
                    <label class="col-sm-3 col-form-label">Saldo Awal</label>
                    <div class="col-sm-9">
                        <select name="saldo" class="custom-select form-control" id="" required>
                            <option value="20000">Rp.20.000</option>
                            <option value="50000">Rp.50.000</option>
                        </select><br><br>
                    </div>
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select name="id_status" class="custom-select form-control" id="" required>
                            <option value="1">E-Biu</option>
                            <!-- <option value="2">Member</option> -->
                        </select><br><br>
                    </div>
                    <label class="col-sm-3 col-form-label">Input Kartu Parkir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-user" name="nomor_kartu" placeholder="Scan / masukan nomor manual"><br>
                    </div>
                    <div class="col-sm-12 mt-5 text-right">
                        <button type="submit" class="btn btn-primary col-sm-3">Buat Akun</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>