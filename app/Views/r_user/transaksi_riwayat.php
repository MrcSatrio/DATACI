<?= $this->extend('template/index'); ?>

<?= $this->section('page_content'); ?>
<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>
<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow mx-2">
            <div class="card-header">
                Riwayat Transaksi
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100" action="<?= base_url().$user['nama_role']; ?>/search" method="post">
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
                                <th>Metode</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
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
                                    <td>Rp.<?= number_format($tr['saldoawal_transaksi'], 0, ',', '.'); ?></td>
                                    <td>Rp.<?= number_format($tr['nominal_transaksi'], 0, ',', '.'); ?></td>
                                    <td>Rp.<?= number_format($tr['saldoakhir_transaksi'], 0, ',', '.'); ?></td>
                                    <td>
                                        <?php if ($tr['id_status_transaksi'] == 1) : ?>
                                            <span class="badge badge-warning"><?= $tr['nama_status_transaksi']; ?></span>
                                        <?php elseif ($tr['id_status_transaksi'] == 2 || $tr['id_status_transaksi'] == 3) : ?>
                                            <span class="badge badge-success"><?= $tr['nama_status_transaksi']; ?></span>
                                        <?php elseif ($tr['id_status_transaksi'] == 4) : ?>
                                            <span class="badge badge-danger"><?= $tr['nama_status_transaksi']; ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($tr['id_jenis_pembayaran'] == 1) : ?>
                                            <span class="badge badge-info"><?= $tr['nama_jenis_pembayaran']; ?></span>
                                        <?php elseif ($tr['id_jenis_pembayaran'] == 2) : ?>
                                            <span class="badge badge-info"><?= $tr['nama_jenis_pembayaran']; ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td><?= $tr['updated_at']; ?></td>
                                    <td>
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" data-reference="parent">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <?php if ($tr['id_status_transaksi'] == 1) : ?>
            <div class="dropdown-menu shadow">
                <form method="POST" action="<?= base_url(); ?>user/cancel/<?= $tr['id_transaksi']; ?>">
                    <input type="hidden" name="id_status_transaksi" value="4">
                    <button type="submit" class="dropdown-item btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan?')">Batalkan</button>
                </form>
                <?php if ($tr['id_jenis_pembayaran'] == 2 && empty($tr['bukti_pembayaran'])) : ?>
                    <button type="button" class="dropdown-item btn btn-warning" data-toggle="modal" data-target="#uploadModal<?= $tr['id_transaksi']; ?>">Upload Bukti</button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</td>

                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="uploadModal<?= $tr['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel<?= $tr['id_transaksi']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title" id="uploadModalLabel<?= $tr['id_transaksi']; ?>">Upload Bukti Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?= base_url(); ?>user/bukti/<?= $tr['id_transaksi']; ?>" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="bukti_pembayaran<?= $tr['id_transaksi']; ?>">Pilih File Bukti Pembayaran:</label>
                                                        <input type="file" class="form-control-file" id="bukti_pembayaran<?= $tr['id_transaksi']; ?>" name="bukti_pembayaran" accept=".jpg, .jpeg, .png" required maxFileSize="4194304">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning">Upload</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
