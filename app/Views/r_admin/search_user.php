<?= $this->extend('template/index'); ?>

<?= $this->section('page_content'); ?>
<div class="card mx-2 shadow">
    <div class="card-header">
        Users List
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100" action="<?= base_url() ?>admin/search_user" method="POST">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="NPM" name="keyword">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
</form>
    </div>
<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow mx-2 mb-3">
            <div class="card-body">

                <?php if (!empty($result)) : ?>
                    <div class="table-responsive-lg">
                        <table class="table table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th>No.</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>E-Mail</th>
                                    <th>Nomor Kartu</th>
                                    <th>Jenis</th>
                                    <th>Masa Berlaku</th>
                                    <th>Saldo</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($result as $u) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= isset($u['npm']) ? $u['npm'] : 'Data tidak ditemukan'; ?></td>
                                        <td><?= isset($u['nama']) ? $u['nama'] : 'Data tidak ditemukan'; ?></td>
                                        <td><?= isset($u['email']) ? $u['email'] : 'Data tidak ditemukan'; ?></td>
                                        <td><?= isset($u['nomor_kartu']) ? $u['nomor_kartu'] : 'Data tidak ditemukan'; ?></td>
                                        <td>
                                            <?php
                                            if (isset($u['id_status'])) {
                                                switch ($u['id_status']) {
                                                    case '1':
                                                        echo '<div class="badge badge-danger">E-Biu</div>';
                                                        break;
                                                    case '2':
                                                        echo '<div class="badge badge-success">Member</div>';
                                                        break;
                                                }
                                            } else {
                                                echo 'Data tidak ditemukan';
                                            }
                                            ?>
                                        </td>
                                        <td><?= isset($u['masa_berlaku']) ? $u['masa_berlaku'] : 'Data tidak ditemukan'; ?></td>
                                        <td><?= isset($u['saldo']) ? 'Rp ' . number_format($u['saldo'], 0, ',', '.') : 'Data tidak ditemukan'; ?></td>
                                        <td><?= isset($u['nama_role']) ? ucfirst($u['nama_role']) : 'Data tidak ditemukan'; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-warning btn-sm" href="<?= base_url(); ?>admin/update/<?= $u['npm']; ?>?season=<?= $u['npm']; ?>"><i class="bi bi-pencil-square"></i></a>

                                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" data-reference="parent">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu shadow">
                                                    <a class="dropdown-item" href="<?= base_url(); ?>admin/delete/<?= $u['npm']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger">Tidak ada data user ditemukan.</div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
