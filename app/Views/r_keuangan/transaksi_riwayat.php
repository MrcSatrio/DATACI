<?= $this->extend('template/index');

$this->section('page_content');
?>

<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow mx-2">
            <div class="card-header">
                Riwayat Transaksi
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100" action="<?= base_url() ?><?= $user['nama_role']; ?>/search" method="post">
                    <div class="input-group">
                        <input type="date" class="form-control bg-light border-0 small" placeholder="Cari Transaksi" aria-label="Search" aria-describedby="basic-addon2" name="keyword">
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
                                <th>Nominal Transaksi</th>
                                <th>Status</th>
                                <th>Metode Pembayaran</th>
                                <th>Bukti Pembayaran</th>
                                <th>Tanggal</th>
                                <th>Cetak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
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
                                    <td><?= 'Rp ' . number_format($tr['nominal_transaksi']); ?></td>
                                    <td>
                                        <?php if ($tr['id_status_transaksi'] == 1) : ?>
                                            <span class="badge badge-warning"><?= $tr['nama_status_transaksi']; ?></span>
                                        <?php elseif ($tr['id_status_transaksi'] == 2) : ?>
                                            <span class="badge badge-success"><?= $tr['nama_status_transaksi']; ?></span>
                                        <?php elseif ($tr['id_status_transaksi'] == 3) : ?>
                                            <span class="badge badge-success"><?= $tr['nama_status_transaksi']; ?></span>
                                        <?php elseif ($tr['id_status_transaksi'] == 4) : ?>
                                            <span class="badge badge-danger"><?= $tr['nama_status_transaksi']; ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($tr['id_jenis_pembayaran'] == 1) : ?>
                                            <span class="badge badge-primary"><?= $tr['nama_jenis_pembayaran']; ?></span>
                                        <?php elseif ($tr['id_jenis_pembayaran'] == 2) : ?>
                                            <span class="badge badge-secondary"><?= $tr['nama_jenis_pembayaran']; ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($tr['id_jenis_pembayaran'] == 2 && $tr['id_status_transaksi'] != 4): ?>
                                            <button type="button" class="btn btn-primary" style="padding: 5px 5px;" onclick="openImageInNewTab('<?= base_url('uploads/bukti/' . $tr['bukti_pembayaran']); ?>')">Lihat Bukti</button>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $tr['updated_at']; ?></td>
<td>
                                    <?php if ($tr['id_status_transaksi'] == 3) : ?>

        <form method="POST" action="<?= base_url(); ?>keuangan/cetak/<?= $tr['id_transaksi']; ?>">
            <button type="submit" class="btn btn-primary">Cetak</button>
        </form>
    </td>
<?php endif; ?>

                                    </td>
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
