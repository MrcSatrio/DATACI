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
                            <td>Login</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul Login.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Dashboard</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul Dashboard.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Input Kode Booking</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul Input Kode Booking.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Riwayat</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul Riwayat Keuangan.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Daftar Pengguna</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul User List.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Tambah Pengguna</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul Tambah User.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Profil</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul Profil.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Lupa Password</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul Lupa Password.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Cek Saldo</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul Cek Saldo.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Pengumuman</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/K2h5j6k1l3v8/Modul Pengumuman.pdf" download>Unduh</a>
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
