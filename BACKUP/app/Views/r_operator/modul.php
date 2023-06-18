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
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/user/login.pdf" download>Unduh</a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Top-Up</td>
                            <td>
                                <a class="btn btn-info" href="<?= base_url() ?>uploads/berkas/user/topup.pdf" download>Unduh</a>
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
