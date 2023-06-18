<?= $this->extend('template/index'); ?>

<?= $this->section('page_content'); ?>

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
                        <th>Jenis</th>
                        <th>Nomor Kartu</th>
                        <th>Saldo</th>
                        
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + ($limit * ($currentPage - 1)); ?>
                    <?php foreach ($users as $u) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $u['npm']; ?></td>
                            <td><?= $u['nama']; ?></td>
                            <td><?= $u['email']; ?></td>
                            <td>
                                <?php
                                switch ($u['id_status']) {
                                    case '1':
                                        echo '<div class="badge badge-success">E-Biu</div>';
                                        break;
                                    case '2':
                                        echo '<div class="badge badge-info">Member</div>';
                                        break;
                                }
                                ?>
                            </td>
                            <td><?= $u['nomor_kartu']; ?></td>
                            <td>Rp<?= number_format($u['saldo'], 0, ',', '.'); ?></td>
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
                                        echo '<div class="badge badge-secondary">Operator</div>';
                                        break;
                                    case '4':
                                        echo '<div class="badge badge-info">Mahasiswa</div>';
                                        break;
                                    default:
                                        echo 'Unknown Role';
                                        break;
                                }
                                ?>
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
