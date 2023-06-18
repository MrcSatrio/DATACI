<?= $this->extend('template/index');

$this->section('page_content');

?>

<div class="row justify-content-center">
    <div class="col">
        <div class="card shadow mx-2 mb-3">
            <div class="card-body">
                <h4 class="card-title">DATA DITEMUKAN <?= $keyword; ?></h4>
                <div class="row justify-content-center mb-4">
                    <div class="col-md-6">
                        <div class="table-responsive-lg">
                            <table class="table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Nomor Pokok Mahasiswa </td>
                                        <td>:<?= $result[0]['npm']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama </td>
                                        <td>:<?= $result[0]['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email </td>
                                        <td>:<?= $result[0]['email']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive-lg">
                            <table class="table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Nomor Kartu Mahasiswa </td>
                                        <td>:<?= $result[0]['nomor_kartu']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Saldo </td>
                                        <td>:<?= 'Rp ' . number_format($result[0]['saldo'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Role </td>
                                        <td>:<?= ucfirst($result[0]['nama_role']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <h4 class="card-title">Transaksi <?= $result[0]['nama']; ?>(<?= $result[0]['npm']; ?>)</h4>
                
                <div class="table-responsive-lg">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Kode Booking</th>
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
                            $i = 1; // Variabel penomoran

                            foreach ($result as $res) :
                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $res['kodebooking_transaksi']; ?></td>
                                    <td>
                                        <?php if ($res['id_jenis_transaksi'] == 1) : ?>
                                            <span class="badge badge-info"><?= $res['nama_jenis_transaksi']; ?></span>
                                        <?php elseif ($res['id_jenis_transaksi'] == 2) : ?>
                                            <span class="badge badge-warning"><?= $res['nama_jenis_transaksi']; ?></span>
                                        <?php elseif ($res['id_jenis_transaksi'] == 3) : ?>
                                            <span class="badge badge-success"><?= $res['nama_jenis_transaksi']; ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td><?= 'Rp ' . number_format($res['saldoawal_transaksi']); ?></td>
                                    <td><?= 'Rp ' . number_format($res['nominal_transaksi']); ?></td>
                                    <td><?= 'Rp ' . number_format($res['saldoakhir_transaksi']); ?></td>
                                    <td>
                                        <?php if ($res['id_status_transaksi'] == 1) : ?>
                                            <span class="badge badge-danger"><?= $res['nama_status_transaksi']; ?></span>
                                        <?php else : ?>
                                            <span class="badge badge-success"><?= $res['nama_status_transaksi']; ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td><?= $res['updated_at']; ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>