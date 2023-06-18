<?= $this->extend('template/index'); ?>

<?= $this->section('page_content'); ?>

<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow mx-2">
            <div class="card-header">
                Riwayat Transaksi
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100" action="<?= base_url() ?><?= $user['nama_role']; ?>/search" method="post">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Transaksi" aria-label="Search" aria-describedby="basic-addon2" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Kode Booking</th>
                                <th>NIM</th>
                                <th>Jenis Transaksi</th>
                                <th>Saldo Awal</th>
                                <th>Nominal</th>
                                <th>Saldo Akhir</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
// Fungsi untuk membandingkan nilai created_at
                            $i = 1 + ($limit * ($currentPage - 1)); // Variabel penomoran

                            foreach ($transaksi as $tr) :
                            ?>
    <tr>
    <td><?= $i++; ?></td>
        <td><?= $tr['kodebooking_transaksi']; ?></td>
        <td><?= $tr['npm']; ?></td>
        <td>
            <?php if ($tr['id_jenis_transaksi'] == 1) : ?>
                <span class="badge badge-info"><?= $tr['nama_jenis_transaksi']; ?></span>
            <?php elseif ($tr['id_jenis_transaksi'] == 2) : ?>
                <span class="badge badge-warning"><?= $tr['nama_jenis_transaksi']; ?></span>
            <?php elseif ($tr['id_jenis_transaksi'] == 3) : ?>
                <span class="badge badge-success"><?= $tr['nama_jenis_transaksi']; ?></span>
            <?php endif ?>
        </td>
        <td><?= $tr['saldoawal_transaksi']; ?></td>
        <td><?= $tr['nominal_transaksi']; ?></td>
        <td><?= $tr['saldoakhir_transaksi']; ?></td>
        <td>
            <?php if ($tr['id_status_transaksi'] == 1) : ?>
                <span class="badge badge-danger"><?= $tr['nama_status_transaksi']; ?></span>
            <?php else : ?>
                <span class="badge badge-success"><?= $tr['nama_status_transaksi']; ?></span>
            <?php endif ?>
        </td>
        <td><?= $tr['created_at']; ?></td>
    </tr>
<?php endforeach; ?>

                        </tbody>
                    </table>
                    <?= $pager->links('pagination', 'pagination'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
