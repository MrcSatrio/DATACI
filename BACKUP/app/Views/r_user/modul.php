<?php
$no = 1;
?>

<?= $this->extend('template/index'); ?>

<?= $this->section('page_content'); ?>
</head>
<body>
    <br>
    <div class="container">

        <div class="card">
            <div class="card-header">
                Modul Penggunaan
            </div>
            <iframe width="1090" height="345" src="https://www.youtube.com/embed/VRlXHeBqLuQ">
</iframe>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Unduh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Dashboard</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/Um5n2b8v9c1x/Modul Dashboard.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Top-Up</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/Um5n2b8v9c1x/Modul TopUp.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Kartu Hilang</td>
                            <td>
                            <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/Um5n2b8v9c1x/Modul Kartu Hilang.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Pengumuman</td>
                            <td>
                            <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/Um5n2b8v9c1x/Modul Pengumuman.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Riwayat Transaksi</td>
                            <td>
                            <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/Um5n2b8v9c1x/Modul Riwayat Transaksi.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Login</td>
                            <td>
                            <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/Um5n2b8v9c1x/Modul Login.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Lupa Password</td>
                            <td>
                            <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/Um5n2b8v9c1x/Modul Lupa Password.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Cek Saldo</td>
                            <td>
                            <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/Um5n2b8v9c1x/Modul Cek Saldo.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Profil</td>
                            <td>
                            <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/Um5n2b8v9c1x/Modul Profil.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        
                        <!-- Tambahkan baris ini untuk setiap data yang ingin ditampilkan -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
