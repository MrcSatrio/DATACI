<?= $this->extend('template/index');

$this->section('page_content'); ?>
<?php if (!empty(session()->getFlashdata('berhasil'))) : ?>
    <div class="alert alert-success" role="success">
        <h4>Data Berhasil Diubah</h4>
        </hr>
        <?php echo session()->getFlashdata('berhasil'); ?>
    </div>
<?php endif; ?>
<div class="card mx-5 shadow">
    <div class="card-header">
        Users List
    </div>
    <div class="card-body">
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
                        <!-- <th>Tipe Kartu</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody><?php
                        $i = 1 + ($limit * ($currentPage - 1)); ?>
                    <?php foreach ($users as $u) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $u['npm']; ?></td>
                            <td><?= $u['nama']; ?></td>
                            <td><?= $u['email']; ?></td>
                            <td><?= $u['nomor_kartu']; ?></td>
                            <td>
                                <?php
                                switch ($u['id_status']) {
                                    case '1':
                                        echo '<div class="badge badge-danger">E-Biu</div>';
                                        break;
                                    case '2':
                                        echo '<div class="badge badge-success">Member</div>';
                                        break;
                                }
                                ?>
                            </td>
                            <td><?= $u['masa_berlaku']; ?></td>
                            <td>Rp<?= number_format($u['saldo']); ?></td>
                            <td>
                                <?php
                                switch ($u['id_role']) {
                                    case '1':
                                        echo '<div class="badge badge-danger">Admin</div>';
                                        break;
                                    case '2':
                                        echo '<div class="badge badge-success">Keuangan</div>';
                                        break;
                                    case '3':
                                        echo '<div class="badge badge-secondary">operator</div>';
                                        break;
                                    case '4':
                                        echo '<div class="badge badge-info">Mahasiswa</div>';
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                <a class="btn btn-warning btn-sm" href="<?= base_url(); ?>admin/update/<?= $u['npm']; ?>?season=<?= $user['npm']; ?>"><i class="bi bi-pencil-square"></i></a>

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
            <?= $pager->links('pagination', 'pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>