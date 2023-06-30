<!-- search_result.php -->
<link href="<?= base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="<?= base_url(); ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

<!-- Bootstrap -->
<script src="https://unpkg.com/xlsx-style/dist/xlsx-style.min.js"></script>
<!-- ExcelJS -->
<script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>

<!-- XlsxPopulate -->
<script src="https://unpkg.com/xlsx-populate/browser/xlsx-populate.min.js"></script>
<!-- ExcelJS -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
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
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100" action="<?= base_url() ?><?= $user['nama_role']; ?>/search" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Keyword" name="keyword">
                        <div class="form-group">
                            <label for="start_date"> Tanggal Mulai: </label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="end_date"> Tanggal Akhir: </label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="jenis_transaksi"> Status Transaksi: </label>
                            <select name="id_status_transaksi" id="id_status_transaksi" class="form-control">
                                <option value="3">Approved</option>
                                <option value="1">Pending</option>
                                <option value="4">Cancel</option>
                            </select>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <button class="btn btn-primary" onclick="printPage()">Cetak</button>
                <button class="btn btn-primary" onclick="exportToExcel()">Unduh Excel</button>
                <button class="btn btn-primary" onclick="window.location.href='<?= base_url(); ?>keuangan/transaksi_riwayat'">Kembali</button>
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
                                <th>Bukti Transfer</th>
                                <th>Tanggal</th>
                                <th>Validator</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            usort($transaksi, function ($a, $b) {
                                return strtotime($b['created_at']) - strtotime($a['created_at']);
                            });
                            foreach ($transaksi as $tr) : ?>
                                <tr>
                                    <td><?= $tr['id_transaksi']; ?></td>
                                    <td><?= $tr['kodebooking_transaksi']; ?></td>
                                    <td><?= $tr['npm']; ?></td>
                                    <td>
                                        <?php if ($tr['id_jenis_transaksi'] == 1) : ?>
                                            <span class="badge badge-info">Top_Up</span>
                                        <?php elseif ($tr['id_jenis_transaksi'] == 2) : ?>
                                            <span class="badge badge-warning">Kartu-Hilang</span>
                                        <?php elseif ($tr['id_jenis_transaksi'] == 3) : ?>
                                            <span class="badge badge-warning">Parkir</span>
                                        <?php endif ?>
                                    </td>
                                    <td><?= 'Rp ' . number_format($tr['nominal_transaksi']); ?></td>
                                    <td>
                                        <?php if ($tr['id_status_transaksi'] == 1) : ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php elseif ($tr['id_status_transaksi'] == 2) : ?>
                                            <span class="badge badge-success">Complete</span>
                                        <?php elseif ($tr['id_status_transaksi'] == 3) : ?>
                                            <span class="badge badge-success">Approved</span>
                                        <?php elseif ($tr['id_status_transaksi'] == 4) : ?>
                                            <span class="badge badge-danger">Cancel</span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($tr['id_jenis_pembayaran'] == 1) : ?>
                                            <span class="badge badge-primary">Cash</span>
                                        <?php elseif ($tr['id_jenis_pembayaran'] == 2) : ?>
                                            <span class="badge badge-secondary">Transfer</span>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($tr['id_jenis_pembayaran'] == 2 && $tr['id_status_transaksi'] != 4 && !empty($tr['bukti_pembayaran'])) : ?>
                                            <a target="_blank" href="<?= base_url('uploads/bukti/' . $tr['bukti_pembayaran']); ?>" class="btn btn-primary" style="padding: 5px 5px;">Lihat Bukti</a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $tr['updated_at']; ?></td>
                                    <td><?= $tr['validator']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>/assets/js/sb-admin-2.min.js"></script>
<script>
    function printPage() {
        window.print();
    }

    function openImageInNewTab(imageUrl) {
        window.open(imageUrl, '_blank');
    }
</script>
<script>
    function exportToExcel() {
        const table = document.querySelector('.table');
        const workbook = new ExcelJS.Workbook();
        const worksheet = workbook.addWorksheet('Transactions');

        // Add table headers to the worksheet
        const headerRow = worksheet.addRow([]);
        const headerCells = table.querySelectorAll('th');
        headerCells.forEach(cell => {
            headerRow.getCell(cell.cellIndex + 1).value = cell.textContent.trim();
        });

        // Iterate over each table row and column to populate the worksheet
        const rows = table.getElementsByTagName('tr');
        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const columns = row.getElementsByTagName('td');
            const values = [];

            for (let j = 0; j < columns.length; j++) {
                // Check if the current column is the "Bukti Transfer" column
                if (j === 7) {
                    const buktiCell = columns[j];
                    const buktiLink = buktiCell.querySelector('a');
                    if (buktiLink) {
                        // If there is a link, add the link address to the cell as a formula
                        const linkFormula = `HYPERLINK("${buktiLink.href}", "Lihat Bukti")`;
                        values.push({ formula: linkFormula });
                    } else {
                        values.push('');
                    }
                } else {
                    values.push(columns[j].innerText);
                }
            }

            worksheet.addRow(values);
        }

        // Apply hyperlink style to the "Bukti Transfer" column
        worksheet.getColumn(8).eachCell(cell => {
            if (cell.value && cell.value.hyperlink) {
                cell.font = { color: { argb: '0563C1' }, underline: true };
            }
        });

        // Save the workbook as a Blob
        workbook.xlsx.writeBuffer().then(function (buffer) {
            const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'transactions.xlsx';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        });
    }
</script>
