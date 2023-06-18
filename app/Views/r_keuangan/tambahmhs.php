<?= $this->extend('r_keuangan/template/index');

$this->section('page_content'); ?>

    <div class='container'>
        <div class='card o-hidden border-10 '>
            <div class="card-body p-6">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mt-3 mb-4">Tambah Data Mahasiswa</h1>
                
            </div>
            <?= $success = session()->getFlashdata('success'); 
                // If there is flash data, display it in the form
                if ($success) {
                    echo '<div class="alert alert-success mb-2">Data Berhasil Ditambah</div>';
                }?>
            <form action="/register" method="post">
            <div class="form-group row">
                
                <div class="col-sm-7 mb-2 mb-sm-0">
                
                <label for="">Nomor Pokok Mahasiswa</label>
                <?= $success = session()->getFlashdata('error_npm'); 
                // If there is flash data, display it in the form
                if ($success) {
                    echo '<div class="badge badge-pill badge-danger mb-2">NPM harus terdiri dari minimal 10 angka</div>';
                }?>
                    <input type="text" class="form-control form-control-user" name="npm"placeholder="" required>
                </div>
                <input type="hidden" name="nomor_kartu" value="0">
                <input type="hidden" name="saldo" value="0">
                <div class="col-sm-7 mt-2 mb-2 mb-sm-0">
                <label for="">Role</label><br>
                    <select name="id_role" class="form-control form-control-user" id="" required>
                        <option value="1">admin</option>
                        <option value="2">keuangan</option>
                        <option value="3">operator</option>
                        <option value="4">user</option>
                    </select>
                </div>
                <div class="col-sm-7 mt-2 mb-2 mb-sm-0">
                <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-user" name="nama"placeholder="" required>
                </div>
                <div class="col-sm-7 mt-2 mb-2 mb-sm-0">
                <label for="">Password</label>
                <?= $success = session()->getFlashdata('error_pass'); 
                // If there is flash data, display it in the form
                if ($success) {
                    echo '<div class="badge badge-pill badge-danger mb-2">Password harus terdiri dari minimal 8 huruf dan harus mengandung unsur huruf dan angka</div>';
                }?>
                    <input type="password" class="form-control form-control-user" name="password"placeholder="" required>
                </div>
                <div class="col-sm-7 mt-5 ">
                <button type="submit" class="btn btn-primary btn-user btn-block">Buat Akun</button> 
                </div>
            </form>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>