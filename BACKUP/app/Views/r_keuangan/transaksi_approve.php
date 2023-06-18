<?php
echo $this->extend('template/index');

echo $this->section('page_content');
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-success mb-3 shadow mx-2">
            <div class="card-body">
                <h4 class="card-title text-center">
                    Kode Booking : <b><?= $transaksi['kodebooking_transaksi']; ?></b><br>
                    <img src="<?= base_url() ?>assets/img/ceklis.png" width="15%"><br>
                    Transaksi Berhasil
                </h4>
                <div class="table-responsive-md">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <h5>Informasi Mahasiswa</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Pokok Mahasiswa </td>
                                <td><?= $transaksi['npm']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td><?= $transaksi['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?= $transaksi['email']; ?></td>
                            </tr>
                            <tr>

                                <td colspan="2">
                                    <h5>Transaksi</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Transaksi</td>
                                <td>
                                    <?php if ($transaksi['id_jenis_transaksi'] == 1) : ?>
                                        <span class="badge badge-info"><?= $transaksi['nama_jenis_transaksi']; ?></span>
                                    <?php elseif ($transaksi['id_jenis_transaksi'] == 2) : ?>
                                        <span class="badge badge-warning"><?= $transaksi['nama_jenis_transaksi']; ?></span>
                                    <?php elseif ($transaksi['id_jenis_transaksi'] == 3) : ?>
                                        <span class="badge badge-success"><?= $transaksi['nama_jenis_transaksi']; ?></span>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Nominal</td>
                                <td><?= 'Rp ' . number_format($transaksi['nominal_transaksi'], 0, ',', '.'); ?></td>

                            </tr>
                            <tr>
                                <td>Saldo Akhir</td>
                                <td><?= 'Rp ' . number_format($transaksi['saldoakhir_transaksi'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-active">
                                <td>Total</td>
                                <th class="text-danger"><?= 'Rp ' . number_format($harga, 0, ',', '.'); ?></th>

                            </tr>
                            <tr>
                                <td>Tanggal Transaksi</td>
                                <td><?= $transaksi['created_at']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Approved</td>
                                <td><?= $transaksi['updated_at']; ?></td>
                            </tr>
                            <tr>
                                <td>Approved by</td>
                                <td><?= $user['nama']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">
        <button onclick="window.print()">Cetak</button>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>
