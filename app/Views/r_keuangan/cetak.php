<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-success mb-3 shadow mx-2">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        Kode Booking: <b><?= $transaksi['kodebooking_transaksi']; ?></b><br>
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
                                    <td>Nomor Pokok Mahasiswa</td>
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
        </div>
    </div>

    <!-- Bootstrap and jQuery scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>

    <!-- Custom script for printing -->
    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>

</html>
